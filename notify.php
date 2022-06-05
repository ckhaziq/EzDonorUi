<?php

include 'dbCon.php';

if ((isset($_SESSION['DoneeID']) && $_SESSION['DoneeID'] != "")) {
    $DoneeID = $_SESSION['DoneeID'];
}
if ((isset($_SESSION['RequestID']) && $_SESSION['RequestID'] != "")) {
    $DoneeID = $_SESSION['RequestID'];
}


$PackageID = $_SESSION['PackageID'];
$PackagePrice = $_SESSION['PackagePrice'];
$DapurID = $_SESSION['DapurID'];
$PaymentAmount = $_SESSION['PaymentAmount'];
$item_name = $_SESSION['item_name'];
$PaymentTotalPrice = $_SESSION['PaymentTotalPrice'];
$PaymentMethod = $_SESSION['PaymentMethod'];
$Currency = $_SESSION['Currency'];
$txn_id = $_SESSION['txn_id'];
$ReceiverEmail = $_SESSION['ReceiverEmail'];
$date = $_SESSION['date'];
$DonorID = $_SESSION['DonorID'];
$OrderStatus = $_SESSION['OrderStatus'];


$OrderID = $_SESSION['OrderID'];

$PaymentStatus = "Paid";

$sqlPayment = "INSERT INTO payment(DoneeID, PackageID, PackagePrice, DapurID, PaymentAmount, item_name, PaymentTotalPrice, PaymentMethod, Currency, txn_id, PaymentStatus, ReceiverEmail, OrderID) VALUES ('$DoneeID', '$PackageID', '$PackagePrice', '$DapurID','$PaymentAmount', '$item_name', '$PaymentTotalPrice', '$PaymentMethod', '$Currency', '$txn_id', '$PaymentStatus', '$ReceiverEmail', '$OrderID')";

$resultPayment = $con->query($sqlPayment);

//law row
//last id payment
$queryLastIDP = "SELECT * FROM payment";
$resultLastIDP = $con->query($queryLastIDP);
if ($resultLastIDP->num_rows > 0) {
while ($rowP = $resultLastIDP->fetch_assoc()) {
$LastIDP = $rowP['PaymentID'];
}
}

$PaymentID = $LastIDP;
$OrderStatus = 'Paid';

//insert order
$queryUpdate = "UPDATE ordertable SET PaymentID='$PaymentID', OrderStatus='$OrderStatus''WHERE PaymentID='$PaymentID'";
$resultUpdate = mysqli_query($con, $queryUpdate);

$con->close();

header("Location:donor_cart.php");


?>