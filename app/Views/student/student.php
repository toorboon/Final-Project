
<?php  include "header.php"; 
require_once "../../Controllers/CourseController.php"; 

// if session is not set this will redirect to login page
      if( !isset($_SESSION['student']) ) {
       header("Location: ../../index.php");
       exit;
      }

	  ob_end_flush();
	  ?>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

           <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Your Progress</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
		
	<div class="row">
		<div class="col-sm-4 col-md-3">
			<div class="progress" data-percentage="100">
				<span class="progress-left">
					<span class="progress-bar"></span>
				</span>
				<span class="progress-right">
					<span class="progress-bar"></span>
				</span>
				<div class="progress-value">
					<div class="ml-4">
						100%<br>
						<span>completed</span>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-center">HTML</h4>
			</div>
			<button class="btn btn-outline-primary btn-sm btn-block mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		    	Details
		  	</button>
		  	<div class="expand collapse mb-3" id="collapseExample">
				<div class="card card-body">
				   	<ul>Day 01
				   		<br>
						<strong>Total: 95%</strong>
				   		<li>Basic: 100%</li>
				   		<li>Intermediate: 100%</li>
				   		<li>Advanced: 100%</li>
				   		<li>Challenge: 95%</li>
				   	</ul>
					<ul>Day 02
						<br>
						<strong>Total: 95%</strong>
						<li>Basic</li>
				   		<li>Intermediate</li>
				   		<li>Advanced</li>
				   		<li>Challenge</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-sm-4 col-md-3">
			<div class="progress" data-percentage="85">
				<span class="progress-left">
					<span class="progress-bar"></span>
				</span>
				<span class="progress-right">
					<span class="progress-bar"></span>
				</span>
				<div class="progress-value">
					<div class="ml-4">
						85%<br>
						<span>completed</span>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-center">CSS</h4>
			</div>
			<button class="btn btn-outline-primary btn-sm btn-block mb-3" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
		    	Details
		  	</button>
		  	<div class="expand collapse mb-3" id="collapseExample2">
				<div class="card card-body">
				   	<ul>Day 01
				   		<br>
				   		<strong>Total: 90%</strong>
				   		<li>Basic: 99%</li>
				   		<li>Intermediate: 91%</li>
				   		<li>Advanced: 80%</li>
				   		<li>Challenge: 80%</li>
				   	</ul>
					<ul>Day 02
						<br>
				   		<strong>Total: 95%</strong>
						<li>Basic</li>
				   		<li>Intermediate</li>
				   		<li>Advanced</li>
				   		<li>Challenge</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-sm-4 col-md-3">
			<div class="progress" data-percentage="70">
				<span class="progress-left">
					<span class="progress-bar"></span>
				</span>
				<span class="progress-right">
					<span class="progress-bar"></span>
				</span>
				<div class="progress-value">
					<div class="ml-4">
						70%<br>
						<span>completed</span>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-center">SaSS</h4>
			</div>
			<button class="btn btn-outline-primary btn-sm btn-block mb-3" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
		    	Details
		  	</button>
		  	<div class="expand collapse mb-3" id="collapseExample3">
				<div class="card card-body">
				   	<ul>Day 01
				   		<br>
				   		<strong>Total: 75%</strong>
				   		<li>Basic: 100%</li>
				   		<li>Intermediate: 100%</li>
				   		<li>Advanced: 60%</li>
				   		<li>Challenge: 60%</li>
				   	</ul>
					<ul>Day 02
						<br>
				   		<strong>Total: 65%</strong>
						<li>Basic</li>
				   		<li>Intermediate</li>
				   		<li>Advanced</li>
				   		<li>Challenge</li>
					</ul>
				</div>
			</div>
		</div>
		
		
		<div class="col-sm-4 col-md-3">
			<div class="progress" data-percentage="90">
				<span class="progress-left">
					<span class="progress-bar"></span>
				</span>
				<span class="progress-right">
					<span class="progress-bar"></span>
				</span>
				<div class="progress-value">
					<div class="ml-4">
						90%<br>
						<span>completed</span>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-center">JavaScript</h4>
			</div>
			<button class="btn btn-outline-primary btn-sm btn-block mb-3" type="button" data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
		    	Details
		  	</button>
		  	<div class="expand collapse mb-3" id="collapseExample4">
				<div class="card card-body">
				   	<ul>Day 01
				   		<br>
				   		<strong>Total: 95%</strong>
				   		<li>Basic: 99%</li>
				   		<li>Intermediate: 100%</li>
				   		<li>Advanced: 90%</li>
				   		<li>Challenge: 85%</li>
				   	</ul>
					<ul>Day 02
						<br>
				   		<strong>Total: 95%</strong>
						<li>Basic</li>
				   		<li>Intermediate</li>
				   		<li>Advanced</li>
				   		<li>Challenge</li>
					</ul>
				</div>
			</div>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-5 col-sm-12 profile m-3">
			<p class="p-2">
			<?php 
			echo "<strong>" . date("l") . ", ";
			echo date("d-m-Y") . "</strong><hr>";
			?>	
			</p>

				<p>Technology:</p>
				<p>Exercises:</p>
				<ul>
					<li>Basic</li>
					<li>Intermediate</li>
					<li>Advanced</li>
					<li>Challenge</li>
				</ul>
				<p>Pair partner: </p>
				<p>GitHub Name: </p>		
		</div>

		<div class="col-md-5 col-sm-12 profile m-3">

			<h4 class="mt-2">Exercises</h4>

			<?php 
			$table = 'course_exercises ce';
			$fields = 'et.option_label as type, task_name, short_description';
			$join = 'INNER JOIN exercise_type et ON ce.exercise_type_id = et.id';
			$where = 'WHERE course_day_id = 1';
			$orderby = 'ORDER BY ce.order_nr';
				$result = $obj->read($table, $fields, $join, $where);

				foreach($result as $value) { 
					$test = (isset($test)) ? $test : '';
					if ($test != $value['type']){ ?>
					<p class="mt-2">Type: <?php echo $test = $value['type']; ?></p> <?php } ?>
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
					  <label class="form-check-label" for="defaultCheck1">
					    <?php echo $value['task_name'] ?>
					  </label>
					  <p>Description: <?php echo $value['short_description'] ?></p>
					</div>
				<?php } ?>
			
		</div>
	</div>
</main>

<?php include "../footer/footer.php"; ?>