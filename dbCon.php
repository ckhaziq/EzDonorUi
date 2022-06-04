<?php
/* Database connection settings */
session_start();

//$_SESSION['UserUsername'] = "";
//$_SESSION['UserID'] = "";
//$_SESSION['UserAccountType'] = "";

$host = 'localhost';
$user = 'ezdonor1_admin';
$pass = 'ezdonor1_admin';
$database = 'ezdonor1_ezdonor';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$con=mysqli_connect($host,$user,$pass,$database);
if($con){
}else{
     echo"Connection not successful";
     die($con);
}
// PayPal Configuration
define('PAYPAL_EMAIL', 'sb-40adh16866719@business.example.com'); 
define('RETURN_URL', 'http://ez-donor.com/return.php'); 
define('CANCEL_URL', 'http://ez-donor.com/cancel.php'); 
define('NOTIFY_URL', 'http://ez-donor.com/operation.php'); 
define('CURRENCY', 'MYR'); 
define('SANDBOX', TRUE); // TRUE or FALSE 
define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

if (SANDBOX === TRUE){
$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}else{
$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
// PayPal IPN Data Validate URL
define('PAYPAL_URL', $paypal_url);
