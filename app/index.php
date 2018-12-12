<?php
		ob_start();
		session_start();

		include ('Views/login/a_login.php');

		//it will never let you open login page if session is set, redirection is based on user_role_id

		if ( isset($_SESSION['student'])!="" ) {
 		header("Location: Views/student/student.php");
 		exit;
		}

		if ( isset($_SESSION['trainer'])!="") {
  		header("Location: Views/trainer/trainer.php");
  		exit;
  		}
  
  		if ( isset($_SESSION['admin'])!="") {
  		header("Location: Views/admin/admin.php");
  		exit;
  		}
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>Final Project</title>
</head>
<body>
	<div class="container">

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
		<h2>Sign In.</h2>
	<hr>
	
	<?php
  		if ( isset($errMSG) ) {
		echo $errMSG; }
	?>
             
  	<div class="form-group">
   	 <label for="email">Email address</label>
   	 <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php if (isset($email)){echo $email;} ?>" maxlength="40" />
   	 <span class="text-danger"><?php if (isset($emailError)){echo $emailError;}?></span>
  	</div>
 	 
 	<div class="form-group">
   	 <label for="password">Password</label>
   	 <input type="password" name="pass" class="form-control" id="password" placeholder="Your Password">
   	 <span class="text-danger"><?php if (isset($passError)){echo $passError;} ?></span>
 	</div>

  	<button type="submit" name="btn-login" class="btn btn-primary">Sign In</button>
	</form>
	<div class="col-8 mt-3">
		<h4>user credentials for testing</h4>
		student: horst@gmail.com - testme <br>
		trainer: guenther@gmail.com - testme <br>
		admin: hubert@gmail.com - testme <br>
		enrolled student: dkear0@cdbaby.com - testme
	</div>
	</div> <!-- conatiner ends-->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php ob_end_flush(); ?>