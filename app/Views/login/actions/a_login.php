<?php
ob_start();
session_start();
require_once '../../../Models/config.php';

$error = false;

if( isset($_POST['btn-login']) ) {

 // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if(empty($pass)){
  $error = true;
  $passError = "Please enter your password.";
 }

 // if there's no error, continue to login
 if (!$error) {
  
  // $password = hash('sha256', $pass); // password hashing
  // It doesn't work with existing passwords in database because they weren't created with hashing

  $res=mysqli_query($this->connection, "SELECT * FROM user WHERE email='$email'");
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row
  
  if( $count == 1 && $row['password']==$pass && $row['user_role_id']==2 ) {
   $_SESSION['student'] = $row['id'];
   $_SESSION['urole'] = $row['user_role_id'];
   $_SESSION['name'] = $row['fname'];
   header("Location: ../../Views/student/index.php");

  } elseif( $count == 1 && $row['password']==$pass && $row['user_role_id']==3 ) {
   $_SESSION['trainer'] = $row['id'];
   $_SESSION['urole'] = $row['user_role_id'];
   $_SESSION['name'] = $row['fname'];
   header("Location: ../../Views/trainer/index.php");

  } elseif( $count == 1 && $row['password']==$pass && $row['user_role_id']==4 ) {
   $_SESSION['admin'] = $row['id'];
   $_SESSION['urole'] = $row['user_role_id'];
   $_SESSION['name'] = $row['fname'];
   header("Location: ../../Views/admin/index.php");

  } else {
   $errMSG = "Incorrect Credentials, Try again...";
  }
  
 }

}
?>