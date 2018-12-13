<?php

include('../Models/config.php');

if (isset($_POST['category'])){
	$category = $_POST['category'];
	if ($category == 'new_course') {
		insertCourseData();
	} else if ($category == 'new_course_day') {
		insertCourseDayData();
	} else if ($category == 'new_course_exercise') {
		insertCourseExerciseData();
	} else if ($category == 'new_user') {
		insertUserData();
	} else if ($category == 'fetch_courses'){
		fetchFormData($_POST['element']);
	} else if ($category == 'fetch_course_days'){
		fetchCourseDaysData($_POST['course_id']);
	} else if ($category == 'fetch_exercise_type'){
		fetchExerciseTypeData();
	} else if ($category == 'fetch_user_role'){
		fetchUserRoleData();

	} else if ($category == 'fetch_pairs'){
		fetchPairs($_POST['courseDayId'], $_POST['userId']);

	} elseif ($category == 'fetch_course_day_pairs') {
		fetchCourseDayPairs($_POST['course_day_id']);
	} elseif ($category == 'fetch_exercises'){
		fetchExercises($_POST['pairId'], $_POST['courseDayId']);
	} elseif ($category == 'insert_pair_exercise'){
		insertPairExercise();
	} elseif ($category == 'delete_pair_exercise'){
		deletePairExercise();
	} elseif ($category == 'fetch_students'){
		fetchStudents($_POST['course_id']);
	} elseif ($category == 'fetch_pair_room'){
		fetchPairRoom($_POST['studentId'],$_POST['courseDayId']);
	}
	 
}

function insertCourseData(){
	GLOBAL $obj;
	$fields_course = [
		'name',
		'startdate',
		'enddate',
		'office_start',
		'office_end',
		'description'
	];

	$values_course = [
		$_POST['course_name'],
		$_POST['start_date'],
		$_POST['end_date'],
		$_POST['office_start'],
		$_POST['office_end'],
		$_POST['description']	
	];

	$obj -> insert('course', $fields_course, $values_course);

	return true;
}

function insertCourseDayData(){
	GLOBAL $obj;
	$fields_course_day = [
		'course_id',
		'date',
		'technology',
		'technology_day'
	];

	$values_course_day = [
		$_POST['selected_course'],
		$_POST['course_day_date'],
		$_POST['technology'],
		$_POST['tech_day']	
	];

	$obj -> insert('course_day', $fields_course_day, $values_course_day);
	
	return true;
}

function insertCourseExerciseData(){
	GLOBAL $obj;
	$fields_course_exercise = [
		'course_day_id',
		'exercise_type_id',
		'task_name',
		'short_description'
	];

	$values_course_exercise = [
		$_POST['selected_course'],
		$_POST['exercise_type'],
		$_POST['task_name'],
		$_POST['short_description']	
	];

	$obj -> insert('course_exercises', $fields_course_exercise, $values_course_exercise);
	
	return true;
}

function insertUserData(){
	GLOBAL $obj;

	$hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$fields_user = [
		'fname',
		'lname',
		'username',
		'password',
		'email',
		'github',
		'info',
		'user_role_id'
	];

	$values_user = [
		$_POST['fname'],
		$_POST['lname'],
		$_POST['username'],
		$hashedPwd,
		$_POST['email'],
		$_POST['github'],
		$_POST['info_field'],
		$_POST['user_role']
	];

	$temp = $obj -> insert('user', $fields_user, $values_user);
	
	echo json_encode($temp);

	return true;
}

function insertPairExercise(){
	GLOBAL $obj;
	$fields = [
		'pair_id',
		'course_exercise_id',
	];

	$values =[
		$_POST['pair_id'],
		$_POST['ce_id'],	
	];

	$obj -> insert('pair_exercises_history', $fields, $values);

	return true;
}

function fetchFormData($element){
	GLOBAL $obj;
	$fields = ['name', 'id'];
	$temp = $obj -> read($element, $fields);
	echo json_encode($temp);
	
	return true;
}

function fetchCourseDaysData($course_id){
	GLOBAL $obj;
	if (isset($_POST['userId'])) {
		$where = ' AND user_id = '.$_POST['userId'];
		$join = ' INNER JOIN pair ON pair.course_day_id = course_day.id INNER JOIN pair_partner ON pair.id = pair_partner.pair_id ';
	} else {
		$where = '';
		$join = '';
	}
	$fields = ['course_day.id', 'concat(technology,"_DAY ",technology_day) as name'];
	
	$temp = $obj -> read('course_day', $fields, $join,'WHERE course_id ='.$course_id.$where.' ');
	
	echo json_encode($temp);
	
	return true;
}

function fetchExerciseTypeData(){
	GLOBAL $obj;
	
	$fields = ['id', 'option_label as name'];
	$temp = $obj -> read('exercise_type', $fields);
	
	echo json_encode($temp);
	
	return true;
}

function fetchUserRoleData(){
	GLOBAL $obj;
	// echo 'in fetch user';

	$fields = ['id', 'description as name'];
	$temp = $obj -> read('user_role', $fields);
	
	echo json_encode($temp);
	
	return true;
}


function fetchPairs($courseDayId, $userId){
	GLOBAL $obj;
	$fields = ['fname', 'lname', 'pair_partner.pair_id','github'];
	$join = 'INNER JOIN user ON user.id = pair_partner.user_id';
	$where = 'WHERE pair_partner.pair_id = (SELECT pair.id FROM pair INNER JOIN pair_partner ON pair.id = pair_partner.pair_id WHERE pair_partner.user_id = '.$userId.' AND pair.course_day_id = '.$courseDayId.')';

	$temp = $obj -> read('pair_partner', $fields, $join , $where);

	echo json_encode($temp);
	
	return true;
}

function fetchCourseDayPairs($courseDayId){
	GLOBAL $obj;
	$table = 'pair_partner';
	$fields = 'pair_id, user_id, CONCAT(user.fname," ",user.lname) as name';
	$join = 'INNER JOIN pair
			 ON pair.id = pair_partner.pair_id
			 INNER JOIN user
			 ON user.id = user_id';
	$where = 'WHERE course_day_id = '.$courseDayId;
	$temp = $obj -> read($table, $fields, $join, $where);

	
	echo json_encode($temp);
	
	return true;
}

function fetchExercises($pairId, $courseDayId){
	GLOBAL $obj;
	$table = 'course_exercises ce';
	$fields = 'et.option_label as type, task_name, short_description, ce.id, count(peh.id) as checked';
	$join = 'INNER JOIN exercise_type et 
			 ON ce.exercise_type_id = et.id 
			 LEFT JOIN pair_exercises_history peh
			 ON peh.course_exercise_id = ce.id
			 AND pair_id = '.$pairId;
	$where = 'WHERE course_day_id = '.$courseDayId.' GROUP BY ce.id';
	$orderby = 'ORDER BY ce.exercise_type_id asc, ce.order_nr, ce.id asc';
	$temp = $obj->read($table, $fields, $join, $where, $orderby);

	echo json_encode($temp);
	
	return true;
}

function fetchStudents($courseId){
	GLOBAL $obj;
	$table = 'user u';
	$fields = 'u.id, concat(fname," ",lname) as name';
	$join = 'join enrollment e
			 on e.user_id = u.id';
	$where = 'WHERE u.user_role_id = 2 AND e.course_id = '.$courseId;
	$orderby = 'ORDER BY name';
	$temp = $obj -> read($table, $fields, $join, $where,$orderby);
	echo json_encode($temp);
	
	return true;
}

function deletePairExercise(){
	GLOBAL $obj;
	$condition = [];
	$condition['pair_id'] = $_POST['pair_id'];
	$condition['course_exercise_id'] = $_POST['ce_id'];


	$obj -> delete('pair_exercises_history', $condition);

	return true;
}
?>