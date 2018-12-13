<?php

require_once 'Models/config.php';

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
    $table = "user";
    $fields = '*';
    $condition = "WHERE email = '".$email."'";
    $row = $obj->read($table,$fields='*',$condition);
  
  $password = hash('sha256', $pass); // password hashing
  // It doesn't work with existing passwords in database because they weren't created with hashing

  // if uname/pass is correct it returns must be 1 row
  
  if ( $row != [] && $pass =  $row[0]['password'] ) { //password_verify($pass, $row[0]['password'])
        $_SESSION['name'] = $row[0]['fname'];
        $_SESSION['urole'] = $row[0]['user_role_id'];
        if ( $row[0]['user_role_id'] == 2) {
          $_SESSION['student'] = $row[0]['id'];
          header("Location: Views/student/student.php");
          exit;
        } elseif ( $row[0]['user_role_id'] == 3){
          $_SESSION['trainer'] = $row[0]['id'];
          header("Location: Views/trainer/trainer.php");
          exit;
        } elseif ( $row[0]['user_role_id'] == 4){
          $_SESSION['admin'] = $row[0]['id'];
          header("Location: Views/admin/admin.php");
          exit;
    } else {
        $errMSG = "Incorrect Credentials, Try again...";
        header("Location: index.php?email=".$email."&error=".$errMSG);
        exit;
    }
  }
  
 }

}
?>