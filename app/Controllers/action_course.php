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
	} elseif ($category == 'fetch_course_day_pairs') {
		fetchCourseDayPairs($_POST['course_day_id']);
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

	$obj -> insert('user', $fields_user, $values_user);
	
	return $obj;
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
	
	$fields = ['id', 'concat(technology,"_DAY ",technology_day) as name'];
	$temp = $obj -> read('course_day', $fields,'','WHERE course_id ='.$course_id.' ');
	
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
?>