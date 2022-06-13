<?php
/* Database connection settings */
session_start();
// Show banner
/*echo '<b>Session Support Checker</b><hr />';
// Check if the page has been reloaded
if (!isset($_GET['reload']) or $_GET['reload'] != 'true') {
     // Set the message
     $_SESSION['MESSAGE'] = 'Session support enabled!<br />';
     // Give user link to check
     echo '<a href="?reload=true">Click HERE</a> to check for PHP Session Support.<br />';
} else {
     // Check if the message has been carried on in the reload
     if (isset($_SESSION['MESSAGE'])) {
          echo $_SESSION['MESSAGE'];
    } else {
          echo 'Sorry, it appears session support is not enabled, or your PHP version is too old. <a href="?reload=false">Click HERE</a> to go back.<br />';
     }
}*/

//$_SESSION['UserUsername'] = "";
//$_SESSION['UserID'] = "";
//$_SESSION['UserAccountType'] = "";

$host = 'localhost';
$user = 'ezdonor1_admin';
$pass = 'ezdonor1_admin';
$database = 'ezdonor1_ezdonor';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$con = mysqli_connect($host, $user, $pass, $database);
if ($con) {
} else {
     echo "Connection not successful";
     die($con);
}
// PayPal Configuration
define('PAYPAL_EMAIL', 'sb-40adh16866719@business.example.com');
define('RETURN_URL', 'https://ez-donor.com/return.php');
define('CANCEL_URL', 'https://ez-donor.com/cancel.php');
define('NOTIFY_URL', 'https://ez-donor.com/notify.php');
define('CURRENCY', 'MYR');
define('SANDBOX', TRUE); // TRUE or FALSE 
define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

if (SANDBOX === TRUE) {
     $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
     $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
// PayPal IPN Data Validate URL
define('PAYPAL_URL', $paypal_url);

//if(isset($_SESSION['UserID'])){
//     echo $_SESSION['UserID'];
//}
