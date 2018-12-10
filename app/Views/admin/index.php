<?php  include "header.php"; ?>

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
			
			<div class="col-md-6 col-sm-12">
				<h4 class="text-center m-2">User</h4>
				<table class="table table-striped">
				  <thead class="bg-primary">
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">First Name</th>
				      <th scope="col">Last Name</th>
				      <th scope="col">Role</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>student</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Jacob</td>
				      <td>Thornton</td>
				      <td>student</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Larry</td>
				      <td>the Bird</td>
				      <td>trainer</td>
				    </tr>
				  </tbody>
				</table>
			</div>

			<div class="col-md-6 col-sm-12">
				<h4 class="text-center m-2">Course</h4>
				<table class="table table-striped">
				  <thead class="bg-primary">
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Start Date</th>
				      <th scope="col">End Date</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>FSWD60</td>
				      <td></td>
				      <td></td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Python</td>
				      <td></td>
				      <td></td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Data Analysis</td>
				      <td></td>
				      <td></td>
				    </tr>
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

<?php  include "footer.php"; ?>