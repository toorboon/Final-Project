<?php 

include './Models/config.php';

?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" accept-charset="utf-8">
	<input type="number" name="teamsize" min="1" required>please choose Team size
	
	<button type="submit">submit</button>
</form>



<?php 

class Course extends Database {

	function pairGenerator($teamsize,$courseId){

		$allStudents = $this->getStudents($courseId);

		// need input to filter available students from door entry system
		$availableStudents = $allStudents;

		$courseDays = $this->getCourseDays($courseId);
		$CoursePairIds = $this->getCoursePairIds($courseDays);

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
			$pastPairIds = $this->getPastPairIds($availableStudents[$pairpartner]['id'],$courseId);

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
					$pairpartner = $this->findPartner($pairs[$i][0],$availableStudents,$nrOfStudents,$pastPairIds);
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
				$pairpartner = $this->findPartner($pairs[$j][0],$availableStudents,$nrOfStudents,$pastPairIds);
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

		// find leader for each pair
			for ($i=0; $i < count($pairs); $i++) { 
				$leaderId = $this->findLeader($pairs[$i]);
				echo 'leader id: '.$leaderId.'<br>';
				$key = array_search($leaderId, $pairs[$i]);
				echo 'leader position: '.$key.'<br>';

				if ($key != 0) {
					$value = $pairs[$i][$key];
					array_splice($pairs[$i],$key,1);
					array_unshift($pairs[$i], $value);
				}
			}

			echo '<p><u>Pairs</u></p><pre>';
			print_r($pairs);
			echo '</pre>';
			echo '<br>';
	}

	function getStudents($courseId) {
		$table = 'user';
		$fields = ['user.id','user.door_entry_id'];
		$join = 	'INNER JOIN enrollment e
					 ON user.id = e.user_id';
		$where = 'WHERE user.user_role_id = 2 AND e.course_id = '.$courseId;
		return $this->read($table, $fields, $join, $where);
	}

	function findPartner($id, $availableStudents,$nrOfStudents,$pastPairIds) {
		//Global $obj;

		// Algorithm with database needs to be created to find best Pair Parntner

		// If student has not paired up yet, a random student to pair up with him will be choosen
		if ($pastPairIds == []) {
			return random_int(0, $nrOfStudents-1);
			exit;
		}

		// Create Query to find pair partner with whom the student paired up the less
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
		$table = substr($table, 0, -1).') as findPartner';
		$fields = 'position';

		for ($i=0; $i >= 0 ; $i++) { 
			$where = 'WHERE count = '.$i;
			$possiblePartner = $this->read($table, $fields, $where);
			$i = (count($possiblePartner) != 0) ? -5 : $i;
		}

		$nrOfPossibleStudents = count($possiblePartner);
		$x = ($nrOfPossibleStudents == 1) ? 0 : random_int(1, $nrOfPossibleStudents)-1;

		return $possiblePartner[$x]['position'];	
	}

	function findLeader($pair) {
		$table = '';

		foreach ($pair as $value) {
			$table = ($table == '') ? $table.='(SELECT ' : $table.='UNION SELECT ';
			$table .= $value.' as id, count(pp.pair_id) as count FROM pair_partner pp where pp.user_id = '.$value.' AND pp.leader = 1 ';
		}
		$table .= ') as findLeader';
		$fields = 'id';
		for ($i=0; $i >= 0 ; $i++) { 
			$where = 'WHERE count = '.$i;
			$possibleLeader = $this->read($table, $fields, $where);
			$i = (count($possibleLeader) != 0) ? -5 : $i;
		}
		$nrOfPossibleLeaders = count($possibleLeader);
		$x = ($nrOfPossibleLeaders == 1) ? 0 : random_int(1, $nrOfPossibleLeaders)-1;
		return $possibleLeader[$x]['id'];
	}

	function getCourseDays($courseId) {
		$table = 'course_day';
		$fields = 'id';
		$where = 'WHERE course_id = '.$courseId;

		return $this->read($table, $fields, '',$where);
	}

	function getCoursePairIds($courseDays) {
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

		return $this->read($table, $fields, '',$condition);
	}

	function getPairs($CoursePairIds) {
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

		return $this->read($table, $fields, '',$condition);
	}

	function getPastPairIds ($userId, $courseId) {
		$table = 'pair_partner pp';
		$fields = 'pair_id';
		$join = 'LEFT JOIN pair p ON p.id = pp.pair_id
				LEFT JOIN course_day cd ON cd.id = p.course_day_id';
		$where = 'WHERE user_id = '.$userId;
		return $this->read($table, $fields, $join,$where); 
	}

	function getStudentInfos ($courseId) {
		$table = 'user';
		$join = 'INNER JOIN enrollment e
				 ON user.id = e.user_id';
		$where = 'WHERE user.user_role_id = 2 AND e.course_id = '$courseId;
		return $this->read($table, '*', $join, $where, '');
	}
}

$course = new Course ();

if (isset($_POST['teamsize'])){




$course->pairGenerator($_POST['teamsize'],1);
}

 ?>