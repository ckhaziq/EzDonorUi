<?php
/* Database connection settings */
session_start();

//$_SESSION['UserUsername'] = "";
//$_SESSION['UserID'] = "";
//$_SESSION['UserAccountType'] = "";

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'ezdonordb';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$con=mysqli_connect($host,$user,$pass,$database);
if($con){
}else{
     echo"Connection not successful" . mysqli_error($con);
     die($con);
}
?>