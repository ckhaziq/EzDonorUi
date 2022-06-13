<?php include 'dbCon.php'; ?>
<html>

<head>
    <title>Payment</title>
</head>


<body>
    <div style="width:700px; margin:50 auto;">
    <?php
$_SESSION['PayerID'] = $_GET['PayerID'];

//paymentPayPal

if ((isset($_POST['DoneeID']) && $_POST['DoneeID'] != "")) {
    $DoneeID = $_POST['DoneeID'];
    $_SESSION['DoneeID'] = $DoneeID;
}
if ((isset($_POST['RequestID']) && $_POST['RequestID'] != "")) {
    $RequestID = $_POST['RequestID'];
    $_SESSION['RequestID'] = $RequestID;
}

$PackageID = $_POST['PackageID'];
$PackagePrice = $_POST['PackagePrice'];
$DapurID = $_POST['DapurID'];
$PaymentAmount = $_POST['PaymentAmount'];
$item_name = $_POST['item_name'];
$PaymentTotalPrice = $_POST['amount'];
$PaymentMethod = $_POST['PaymentMethod'];
$Currency = $_POST['currency_code'];
$txn_id = $_POST['txn_id'];
$ReceiverEmail = $_POST['business'];
$date = date(DATE_ATOM);
$DonorID = $_SESSION['DonorID'];
$OrderStatus = "New";
$PaymentStatus = "Pending";

$_SESSION['PackageID'] = $PackageID;
$_SESSION['PackagePrice'] = $PackagePrice;
$_SESSION['DapurID'] = $DapurID;
$_SESSION['PaymentAmount'] = $PaymentAmount;
$_SESSION['item_name'] = $item_name;
$_SESSION['PaymentTotalPrice'] = $PaymentTotalPrice;
$_SESSION['PaymentMethod'] = $PaymentMethod;
$_SESSION['Currency'] = $Currency;
$_SESSION['txn_id'] = $txn_id;
$_SESSION['ReceiverEmail'] = $ReceiverEmail;
$_SESSION['date'] = $date;
$_SESSION['DonorID'] = $DonorID;
$_SESSION['OrderStatus'] = $OrderStatus;

if ((isset($_POST['DoneeID']) && $_POST['DoneeID'] != "")) {
    $queryOrder = "INSERT INTO ordertable(DonorID, DoneeID, DapurID, PackageID, OrderAmount ,OrderDate, OrderStatus, PaymentStatus) VALUES('$DonorID', '$DoneeID', '$DapurID', '$PackageID', '$PaymentTotalPrice', '$date', '$OrderStatus', '$PaymentStatus')";
}
if ((isset($_POST['RequestID']) && $_POST['RequestID'] != "")) {
    $queryOrder = "INSERT INTO ordertable(DonorID, DoneeID, DapurID, PackageID, OrderAmount ,OrderDate, OrderStatus, PaymentStatus) VALUES('$DonorID', '$RequestID', '$DapurID', '$PackageID', '$PaymentTotalPrice', '$date', '$OrderStatus', '$PaymentStatus')";
}


$resultOrder = mysqli_query($con, $queryOrder) or mysqli_error($con);

//last id order
$queryLastID = "SELECT * FROM ordertable";
$resultLastID = $con->query($queryLastID);
if ($resultLastID->num_rows > 0) {
    while ($row = $resultLastID->fetch_assoc()) {
        $LastID = $row['OrderID'];
    }
}

$OrderID = $LastID;
$_SESSION['OrderID'] = $OrderID;

$con->close();

?>
        <h1>You order have being added.<br /> Please proceed to make payment<br />Thank you!</h1>
        <form action="<?php echo PAYPAL_URL; ?>" method="POST">
            <?php
            if ((isset($_POST['DoneeID']) && $_POST['DoneeID'] != "")) {
            ?>
                <input hidden name="DoneeID" type="text" value="<?php echo $DoneeID; ?>">
            <?php
            }
            if ((isset($_POST['RequestID']) && $_POST['RequestID'] != "")) {
            ?>
                <input hidden name="RequestID" type="text" value="<?php echo $RequestID; ?>">
            <?php
            }
            ?>
            <input hidden name="PackageID" type="text" value="<?php echo $PackageID; ?>">
            <input hidden name="PackagePrice" type="text" value="<?php echo $PackagePrice; ?>">
            <input hidden name="DapurID" type="text" value="<?php echo $DapurID; ?>">
            <input hidden name="PaymentAmount" type="text" value="<?php echo $_SESSION['calcPackage']; ?>">
            <input hidden name="item_name" type="text" value="<?php echo $item_name; ?>">
            <input hidden name="amount" type="text" value="<?php echo $_SESSION['calcTotalALL']; ?>">
            <input hidden name="PaymentMethod" type="text" value="PayPal">
            <input hidden name="currency_code" type="text" value="<?php echo CURRENCY; ?>">
            <input hidden name="business" type="text" value="<?php echo PAYPAL_EMAIL; ?>">
            <input hidden name="OrderID" type="text" value="<?php echo $OrderID; ?>">

            <input hidden name="return" type="text" value="<?php echo RETURN_URL; ?>">
            <input hidden name="cancel_return" type="text" value="<?php echo CANCEL_URL; ?>">
            <input hidden name="notify_url" type="text" value="<?php echo NOTIFY_URL; ?>">

            <input type="hidden" name="cmd" value="_xclick">

            <input name="paymentPayPal" type="submit" value="PayPal Payment">
        </form>
    </div>
</body>

</html>