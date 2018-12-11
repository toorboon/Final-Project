<?php
include('db.php');

if (isset($_POST['category'])){
	$category = $_POST['category'];
	if ($category == 'new_course') {
		insertCourseData();
	} else if ($category == 'new_course_day') {
		insertCourseDayData();
	} else if ($category == 'new_course_exercise') {
		insertCourseExerciseData();
	} else if ($category == 'new_user') {
		echo 'in new_user';
	} else if ($category == 'fetch_courses'){
		fetchFormData($_POST['element']);
	} else if ($category == 'fetch_course_days'){
		fetchCourseDaysData($_POST['course_id']);
	} else if ($category == 'fetch_exercise_type'){
		fetchExerciseTypeData();
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
?>