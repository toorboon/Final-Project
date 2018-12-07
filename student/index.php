<?php  include "header.php"; ?>
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
		<div class="col-sm-3 col-md-2">
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
		</div>

		<div class="col-sm-3 col-md-2">
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
		</div>
		
		<div class="col-sm-3 col-md-2">
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
		</div>
		
		
		<div class="col-sm-3 col-md-2">
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
		</div>
		
		
		<div class="col-sm-3 col-md-2">
			<div class="progress" data-percentage="0">
				<span class="progress-left">
					<span class="progress-bar"></span>
				</span>
				<span class="progress-right">
					<span class="progress-bar"></span>
				</span>
				<div class="progress-value">
					<div class="ml-4">
						0%<br>
						<span>completed</span>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-center">TypeScript</h4>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-sm-12 profile mt-5 mb-5">
			<h4 class="text-center">Profile</h4>
			<div class="row">
				<div class="col-6">
				<p>Name:</p>
				<p>Username:</p>
				<p>Email:</p>
				<p>GitHub:</p>
				<p>Course: FSWD60</p>
				</div>
				<div class="col-6">
					<img src="..." alt="..." class="img-thumbnail rounded">
				</div>
			</div>
		</div>
	</div>
		
          <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    </main>

<?php  include "footer.php"; ?>