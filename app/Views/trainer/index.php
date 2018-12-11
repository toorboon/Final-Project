<?php  include "header.php"; 
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
			
			<div class="col-12">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
					<input type="number" min="1" name="teamSize" required> Choose team size
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

<?php  include "../footer/footer.php"; ?>