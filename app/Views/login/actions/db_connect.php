<?php 
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_project";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error){
	die ("Connection failed : " . $connect->connect_error);
}

?>