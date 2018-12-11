<?php
include('db.php');
// print_r($_POST);
if (isset($_POST['category'])){
	$category = $_POST['category'];
	if ($category == 'new_course') {
		insertCourseData();
		
	} else if ($category == 'new_course_day') {
		print_r($_POST);
		insertCourseDayData();
	} else if ($category == 'fetch'){
		fetchFormData($_POST['element']);
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
	// print_r($temp);
	return true;
}

function fetchFormData($element){
	GLOBAL $obj;
	$fields = ['name', 'id'];
	$temp = $obj -> read($element, $fields);
	echo json_encode($temp);
	
	return true;
}

?>