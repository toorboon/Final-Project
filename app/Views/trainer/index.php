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
			
			<div class="col-12">
				<button type="button" class="btn btn-primary btn-lg m-3">Generate pairs</button>
			</div>	
			
			<div class="col-4">
				<div class="card m-3" style="width: 18rem;">
				  <div class="card-body">
				    <h5 class="card-title">Pair</h5>
				    <h6 class="card-subtitle mb-2 text-muted">Names:</h6>
				    <p class="card-text">Indicators</p>
				    <p class="card-text">Git created</p>
				    <a href="#" class="card-link">Card link</a>
				    <a href="#" class="card-link">Another link</a>
				  </div>
				</div>
			</div>
			
		</div>
	</main>

<?php  include "footer.php"; ?>