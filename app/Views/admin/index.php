<?php  include "header.php"; 
require_once "../../Controllers/CourseController.php"; ?>

	<main role="main" class="col-lg-10 col-md-10 ml-sm-auto px-4">
		<div class="container">
			<p class="p-2 m-3">        
			<?php 
			echo "<strong>" . date("l") . ", ";
			echo date("d-m-Y") . "</strong><br>";
			?>
			</p>

			<div class="col-lg-7 col-md-7 col-sm-12">
				<h4 class="text-center m-2">User</h4>
				<table class="table table-striped">
				  <thead class="bg-primary">
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
				      <th scope="col">GitHub</th>
				      <th scope="col">Role</th>
				      <th></th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody>
				  <?php
				  $table = 'user';
				  $result = $obj->read($table);

				  foreach ($result as $value) {
				  ?>
				    <tr>
				      <th scope="row"><?php echo $value['id'] ?></th>
				      <td><?php echo $value['fname']. ' ' .$value['lname'] ?></td>
				      <td><?php echo $value['email'] ?></td>
				      <td><?php echo $value['github'] ?></td>
				      <td><?php echo $value['user_role_id'] ?></td>
				      <td><button type="button" class="btn btn-success btn-sm">Update</button></td>
				      <td><button type="button" class="btn btn-danger btn-sm">Delete</button></td>
				    </tr>
				<?php } ?>
				  </tbody>
				</table>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-12">
				<h4 class="text-center m-2">Course</h4>
				<table class="table table-striped">
				  <thead class="bg-primary">
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Start Date</th>
				      <th scope="col">End Date</th>
				      <th></th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
					  $table = 'course';
					  $result = $obj->read($table);

					  foreach ($result as $value) {
					?>
				    <tr>
				      <th scope="row"><?php echo $value['id'] ?></th>
				      <td><?php echo $value['name'] ?></td>
				      <td><?php echo $value['startdate'] ?></td>
				      <td><?php echo $value['enddate'] ?></td>
				      <td><button type="button" class="btn btn-success btn-sm">Update</button></td>
				      <td><button type="button" class="btn btn-danger btn-sm">Delete</button></td>
				    </tr>
				    <?php } ?>
				  </tbody>
				</table>
			</div>
		</div>

		<div class="col-12">
			<h4 class="text-center m-2">Calendar</h4>
			<div id="show_calendar">&nbsp;</div>
			<div id="current_month">&nbsp;</div>
		</div>
			
	</main>

<?php  include "../footer/footer.php"; ?>
<!-- necessary for the forms -->
<script src="../../js/form.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- for the calendar -->
<script type="text/javascript" src="../../js/calendar.js"></script>