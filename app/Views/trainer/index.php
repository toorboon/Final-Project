<?php  
session_start();

include "header.php"; 
require_once "../../Controllers/CourseController.php";
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
			// Get all courses where trainer with ID = 32 is enrolled
			$courses = $course->getCourses(32);
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
			<div class="col-3">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="inputPairSize">Teamsize</label>
				  </div>
				  <select class="custom-select" id="inputPairSize">
				  	<?php for ($i=1; $i <= 50 ; $i++) { ?>
				  	<option <?php if ($i==2) {echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				  	<?php }  ?>
				  </select>
				</div>
			</div>






				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
					 Choose team size
					<input type="number" min="1" max="1" name="courseId" required> 
					<button type="submit" class="btn btn-primary btn-lg m-3">Generate pairs</button>
					<button type="submit" class="btn btn-info btn-sm m-2">Generate again</button>
					<button type="submit" class="btn btn-info btn-sm m-2">Save</button>
				</form>
				
			</div>	
			
			<?php if(isset($_POST['teamSize'])) {
				$studentsInfo = $course->getStudentInfos($_POST['courseId']);
				/*echo "<pre>";
				print_r($studentsInfo);
				echo "</pre>";*/
				$dailyPairs = $course->pairGenerator($_POST['teamSize'], $_POST['courseId']);
				$i = 1;
				foreach($dailyPairs as $value) { 
					?>
			<div class="col-4">
				<div class="card m-3" style="width: 18rem;">
				  <div class="card-body">
				    <h5 class="card-title">Pair <?php echo $i; ?></h5>
				    <?php foreach ($value as $key => $val) {
				    	for ($j=0; $j < count($studentsInfo); $j++) { 
				    		if ($studentsInfo[$j]['id'] == $val) {
				    			$pos = $j;
				    			break;
				    		}
				    	}
				    	
				    	if ($key == 0) {
				    		echo '<p><b>Pair leader: '.$studentsInfo[$pos]['fname'].' '.$studentsInfo[$pos]['lname'].'</b></p>';
				    	} else {
				    		echo '<p>Pair partner: '.$studentsInfo[$pos]['fname'].' '.$studentsInfo[$pos]['lname'].'</p>';
				    	} 
				    } ?>
				    
				    <a href="#" class="card-link">Card link</a>
				    <a href="#" class="card-link">Another link</a>
				  </div>
				</div>
			</div>
			<?php $i++; }  } ?>
			
		</div>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

		function getCourseday(courseId) {

			$.ajax({
	          url:"../../Controllers/action_course.php",
	          method: "post",
	          data:{'category':'fetch_course_days', 'course_id':courseId},
	          dataType:"text",
	          success:function(response)
	          {
	          	$('#inputGroupCourseDay').html('<option value="" selected disabled>Choose...</option>');

	          	var response = $.parseJSON(response);
	          	
	          	for(var i=0; i< response.length;i++){
				// creates option tag
	  				$('<option/>', {
	        			html: response[i].name,
	        			value: response[i].id
	        		}).appendTo('#inputGroupCourseDay'); //appends to select if parent div has id dropdown
				}
	          }
			});
		}

		$('#inputGroupCourse').change(function(){
			getCourseday($(this).val());
		})
		$('#inputGroupCourseDay').change(function(){
			console.log($(this).val());
		})
	</script>

<?php  include "../footer/footer.php"; ?>