<?php 
$base = __DIR__;


echo $base;

include '../../app/Controllers/CourseController.php';


echo "<pre>";
print_r($course->pairGenerator(2,1));
echo "</pre>";
?>