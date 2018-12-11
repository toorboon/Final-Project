<?php 

include 'db.php';


?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" accept-charset="utf-8">
	<input type="number" name="teamsize" min="1" required>please choose Team size
	
	<button type="submit">submit</button>
</form>



<?php 

if (isset($_POST['teamsize'])){

	pairGenerator($_POST['teamsize'],1,1);
}
function pairGenerator($teamsize,$courseId,$day){
	global $obj;

	$allStudents = getStudents($courseId);

	// need input to filter available students from door entry system
	$availableStudents = $allStudents;

	$courseDays = getCourseDays($courseId);
	$CoursePairIds = getCoursePairIds($courseDays);

	// Get Number of students
	$nrOfStudents = count($availableStudents);

	// Make sure teamsize is not greater than Number of available students
	$teamsize = ($teamsize > $nrOfStudents) ? $nrOfStudents : $teamsize;
	echo 'Number of students: '.$nrOfStudents.'<br>';

	$pairs = [];
	// Create Pairs
	for ($i = 0;  $i != -1 ; $i++)  {
		// Pick random user 
		$pairpartner = random_int(0, $nrOfStudents-1);
		// Get pastPairIds for that user
		$pastPairIds = getPastPairIds($availableStudents[$pairpartner]['id'],$courseId);

		// Prepare $pairs Array, push Pairpartner to the array and remove him from the available students
		if (!isset($pairs[$i])) {
			$pairs[$i] = [];
		}
		array_push($pairs[$i],$availableStudents[$pairpartner]['id']);
		array_splice($availableStudents,$pairpartner,1);
		$nrOfStudents = count($availableStudents);
		// Add Pairpartner until the teamsize is reached
			for ($j=1; $j < $teamsize ; $j++) { 
		// choose partner who fits most...
				$pairpartner = findPartner($pairs[$i][0],$availableStudents,$nrOfStudents,$pastPairIds);
				array_push($pairs[$i],$availableStudents[$pairpartner]['id']);
				array_splice($availableStudents,$pairpartner,1);
				$nrOfStudents = count($availableStudents);	
			}
			if (count($availableStudents) < $teamsize){
				break;
			}	
	}

	if ($nrOfStudents > 0) {
		$count = $nrOfStudents;
		$pairsCount = count($pairs);
		echo 'Nr. of pairs: '.$pairsCount.'<br>';
		echo 'Nr. of students left: '.$nrOfStudents.'<br>';

		for ($i=0; $i < $count ; $i++) { 
			$j = $i % $pairsCount;
			$pairpartner = findPartner($pairs[$j][0],$availableStudents,$nrOfStudents,$pastPairIds);
			array_push($pairs[$j],$availableStudents[$pairpartner]['id']);
			array_splice($availableStudents,$pairpartner,1);
			$nrOfStudents = count($availableStudents);

		}
	}
		echo '<hr>';
		echo '<p><u>Pairs</u></p><pre>';
		print_r($pairs);
		echo '</pre>';
		echo '<br>';
		echo '<p><u>Remaining students</u></p><pre>';
		print_r($availableStudents);
}

function getStudents($courseId) {
	Global $obj;
	$table = 'user';
	$fields = ['user.id','user.door_entry_id'];
	$join = 	'INNER JOIN enrollment e
				 ON user.id = e.user_id';
	$where = 'WHERE user.user_role_id = 2 AND e.course_id = '.$courseId;
	return $obj->read($table, $fields, $join, $where);
}


function findPartner($id, $availableStudents,$nrOfStudents,$pastPairIds) {
	Global $obj;

// Algorithm with database needs to be created to find best Pair Parntner
	// for now we just take a random number to test the other functions

	// Step 1 get all course_day.id(s) where course.id = $courseId
	//$courseDays = getCourseDays($courseId);
	// This is only necessary once per pair Generation and will be done in advance


	// Step 2 get all pair.id(s) for all course_day.id(s)
	//$CoursePairIds = getCoursePairIds($courseDays);
	// This is only necessary once per pair Generation and will be done in advance

	// Step 3 get all user.id(s) for each pair.id
	//$pairPartners = getPairs($CoursePairIds);
	// This is only necessary once per pair Generation and will be done in advance

	if ($pastPairIds == []) {
		return random_int(0, $nrOfStudents-1);
		exit;
	}

	$pairCondition = '';
	foreach ($pastPairIds as $value) {
		foreach ($value as $val) {
			if ($pairCondition == ''){
				$pairCondition = '(pp.pair_id = '.$val;
			} else {
				$pairCondition .= ' or pp.pair_id = '.$val;
			}
		}
	}
	$pairCondition = ($pairCondition == '') ? '' : 'and '.$pairCondition.=')';

	$table = '';
	
	foreach ($availableStudents as $key => $value) {
		$table = ($table == '') ? $table.='(SELECT ' : $table.='UNION SELECT ';
		$table .= $key.' as position, ';
		foreach ($value as $k => $val) {
			if ($k == 'id') {
			$val = (empty($val)) ? 'NULL' : $val;
			$table .= $val.' as id, count(pp.id) as count FROM pair_partner pp where pp.user_id = '.$val.' '.$pairCondition.' ';
			}
		}
		$table = substr($table, 0, -1).' ';
	}
	$table = substr($table, 0, -1).') as test';
	$fields = 'position';

	for ($i=0; $i >= 0 ; $i++) { 
		$where = 'WHERE count = '.$i;
		$possiblePartner = $obj->read($table, $fields, $where);
		$i = (count($possiblePartner) != 0) ? -5 : $i;
	}

	$nrOfPossibleStudents = count($possiblePartner);
	$x = ($nrOfPossibleStudents == 1) ? 0 : random_int(1, $nrOfPossibleStudents)-1;

	return $possiblePartner[$x]['position'];
	
}

function getCourseDays($courseId) {
	Global $obj;
	$table = 'course_day';
	$fields = 'id';
	$condition = 'WHERE course_id = '.$courseId;

	return $obj->read($table, $fields, '',$condition);
}

function getCoursePairIds($courseDays) {
	Global $obj;
	$table = 'pair';
	$fields = 'id';
	$condition = '';

	foreach ($courseDays as $value) {
		if ($condition == '') {
			$condition .= 'WHERE course_day_id = ';
		} else {
			$condition .=' OR course_day_id = ';
		}
		$condition .= $value['id'];
	}

	return $obj->read($table, $fields, '',$condition);
}

function getPairs($CoursePairIds) {
	Global $obj;
	$table = 'pair_partner';
	$fields = '*';
	$condition = '';

	foreach ($CoursePairIds as $value) {
		if ($condition == '') {
			$condition .= 'WHERE pair_id = ';
		} else {
			$condition .=' OR pair_id = ';
		}
		$condition .= $value['id'];
	}

	return $obj->read($table, $fields, '',$condition);
}

function getPastPairIds ($userId, $courseId) {
	Global $obj;
	$table = 'pair_partner pp';
	$fields = 'pair_id';
	$join = 'LEFT JOIN pair p ON p.id = pp.pair_id
			LEFT JOIN course_day cd ON cd.id = p.course_day_id';
	$where = 'WHERE user_id = '.$userId;
	return $obj->read($table, $fields, $join,$where); 
}

 ?>