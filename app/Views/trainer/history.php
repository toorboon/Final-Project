<?php

include "header.php"; 
require_once "../../Controllers/CourseController.php";

// if session is not set this will redirect to login page
      if( !isset($_SESSION['trainer']) ) {
       header("Location: ../../index.php");
       exit;
      }
?>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
		<div class="row">
			<div class="col-12">
				<p class="p-2 m-3">        
				<?php 
			    echo "<strong>" . date("l") . ", ";
			    echo date("d-m-Y") . "</strong><br>";
				?>	
				</p>
			</div>
			
			<?php  
			// Get all courses where trainer with ID = xy is enrolled
			$courses = $course->getCourses($_SESSION['trainer']);
			?>

			<div class="col-3">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="inputGroupCourse">Course</label>
				  </div>
				  <select class="custom-select" id="inputGroupCourse">
				    <option selected disabled>Choose...</option>
				    <?php foreach ($courses as $value) { ?>
				    <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?> </option>
				    <?php } ?>
				  </select>
				</div>
			</div>
			<div class="col-4">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="inputGroupCourseDay">Course Day</label>
				  </div>
				  <select class="custom-select" id="inputGroupCourseDay">
				    <option selected>Choose Course first</option>
				  </select>
				</div>
			</div>
			<div class="col-4">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="inputGroupStudent">Student</label>
				  </div>
				  <select class="custom-select" id="inputGroupStudent">
				    <option selected>Choose Course & Day first</option>
				  </select>
				</div>
			</div>
			
		</div>
		

	</main>
	
<script src="../../js/trainer.js" type="text/javascript" charset="utf-8"></script>

<?php  include "../footer/footer.php"; ?>