<?php

include('../../Controllers/CourseController.php');

if (isset($_POST['courseId']) && isset($_POST['courseDayId']) && isset($_POST['teamsize'])) {
	$result = $course->pairGenerator($_POST['teamsize'],$_POST['courseId']);

	// save ids to Database
	$courseDayId = $_POST['courseDayId'];
	foreach ($result as $value) {
		$table = 'pair';
		$fields = 'course_day_id';
		$pairId = $course->insert($table,$fields,$courseDayId);

		foreach ($value as $key => $val) {
			$leader = ($key == 0) ? 1 : 0;
			
			$table = 'pair_partner';
			$fields = 'pair_id, user_id, leader';
			$values = [$pairId,$val,$leader];
			$course->insert($table,$fields,$values);
			
		}
	}
	echo json_encode($result);
	return true;
}

?>