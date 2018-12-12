<?php  
session_start();

include "header.php"; 
require_once "../../Controllers/CourseController.php";

// if session is not set this will redirect to login page
      if( !isset($_SESSION['trainer']) ) {
       header("Location: ../../index.php");
       exit;
      }

ob_end_flush();
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
				<div class="input-group mb-3 generate d-none">
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
			<div class="col-12 text-center d-none generate">
				<button class="btn btn-primary btn-lg m-3" id="generateBtn">Generate pairs</button>
			</div>
		</div>
		<div class="row" id="content"></div>
				
				
			
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
				    
				  </div>
				</div>
			</div>
			<?php $i++; }  } ?>
			
		</div>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

		function getCourseday(courseId) {
			$('.generate').addClass('d-none');
			$('#content').html('');
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

		function getPairs(course_day_id) {
			$.ajax({
	          url:"../../Controllers/action_course.php",
	          method: "post",
	          data:{'category':'fetch_course_day_pairs', 'course_day_id':course_day_id},
	          dataType:"text",
	          success:function(response)
	          {
	          	var response = $.parseJSON(response);
	          	if (response.length == 0) {
	          		$('.generate').removeClass('d-none');
	          		$('#content').html('');
	          	} else {
	          		var pairId = '';
					var pairs = [];
					var count = 1;
		      		for (var i = 0 ; i < response.length; i++) {
		      			if (pairId != '' && pairId != response[i].pair_id) {
		      				count += 1;
		      			}
		      			pairId = response[i].pair_id;
		      			if (pairs[count] == undefined){ pairs[count]=[]}
		      			pairs[count].push(response[i].name);
		      		}
	          		PrintPairs(pairs);
	          	}
	          }

			});
		}

		function PrintPairs(pairs){
			$('.generate').addClass('d-none');
				
      		var content = '';
      		for (var i = 1; i < pairs.length; i++) {
      			content+="<div class='col-4'><div class='card m-3' style='width: 18rem;'><div class='card-body'><h5 class='card-title'>Pair "+i+"</h5>";
      			for (var j = 0; j < pairs[i].length; j++) {
      				if (j == 0){
      					content+="<p><b>"+pairs[i][j]+"</b></p>"
      				} else {
      					content+="<p>"+pairs[i][j]+"</p>"
      				}
      			}
      			content+="</div></div></div>"
		}
		$('#content').html(content);
      	}
		
		function generatePairs(courseId,courseDayId,teamsize) {
			$.ajax({
	          url:"../../Controllers/actions/action_pairgenerator.php",
	          method: "post",
	          data:{'courseId':courseId, 'courseDayId':courseDayId,'teamsize':teamsize},
	          dataType:"text",
	          success:function(response)
	          {
	          	var response = $.parseJSON(response);
	          
	          	if (response.length == 0) {
	          		$('.generate').removeClass('d-none');
	          		$('#content').html('');
	          	} else {
	          		getPairs(courseDayId);
	          	}
	          }
			});
		}

		$('#inputGroupCourse').change(function(){
			getCourseday($(this).val());
		})
		$('#inputGroupCourseDay').change(function(){
			getPairs($(this).val());
		})
		$('#generateBtn').click(function(){
			generatePairs($('#inputGroupCourse').val(),$('#inputGroupCourseDay').val(),$('#inputPairSize').val());
		})

	</script>

<?php  include "../footer/footer.php"; ?>