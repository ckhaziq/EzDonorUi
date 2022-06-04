<?php include 'dbCon.php'; ?>
<html>

<head>
    <title>Payment</title>
</head>
<?php
$_SESSION['PayerID'] = $_GET['PayerID'];

//paymentPayPal
if (isset($_GET["paymentPayPal"])) {
    $DoneeID = $_POST['DoneeID'];
    $RequestID = $_POST['RequestID'];
    $PackageID = $_POST['PackageID'];
    $PackagePrice = $_POST['DapurID'];
    $DapurID = $_POST['PackagePrice'];
    $PaymentAmount = $_POST['PaymentAmount'];
    $item_name = $_POST['item_name'];
    $PaymentTotalPrice = $_POST['amount'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $Currency = $_POST['currency_code'];
    $txn_id = $_POST['txn_id'];
    $ReceiverEmail = $_POST['business'];
    $date = date("l jS \of F Y h:i:s A");
    $DonorID = $_SESSION['DonorID'];
    $OrderStatus = "Pending";

    $queryOrder = "INSERT INTO dapur(DonorID, DoneeID, DapurID, PackageID, OrderAmount ,OrderDate, OrderStatus) VALUES('$DonorID', '$DoneeID', '$DapurID', '$PackageID', '$PaymentTotalPrice', '$date', '$OrderStatus')";

    $resultOrder = mysqli_query($con, $queryOrder);

    $queryLastID = "SELECT * FROM ordertable";
    $resultLastID = $con->query($queryLastID);
    if ($resultLastID->num_rows > 0) {
        while ($row = $resultLastID->fetch_assoc()) {
            $LastID = $row['OrderID'];
        }
    }



    $con->close();
}
?>

<body>
    <div style="width:700px; margin:50 auto;">
        <h1>YOu order have being added.<br /> Please proceed to make payment<br />Thank you!</h1>
        <form action="<?php echo PAYPAL_URL; ?>" method="POST">
            <input name="DoneeID" type="text" value="<?php echo $DoneeID; ?>" hidden>
            <input name="RequestID" type="text" value="<?php echo $RequestID; ?>" hidden>
            <input name="PackageID" type="text" value="<?php echo $PackageID; ?>" hidden>
            <input name="PackagePrice" type="text" value="<?php echo $PackagePrice; ?>" hidden>
            <input name="$DapurID" type="text" value="<?php echo $$DapurID; ?>" hidden>
            <input name="PaymentAmount" type="text" value="<?php echo $_SESSION['calcPackage']; ?>" hidden>
            <input name="item_name" type="text" value="<?php echo $PackageName; ?>" hidden>
            <input name="amount" type="text" value="<?php echo $_SESSION['calcTotalALL']; ?>" hidden>
            <input name="PaymentMethod" type="text" value="PayPal" hidden>
            <input name="currency_code" type="text" value="<?php echo CURRENCY; ?>" hidden>
            <input name="business" type="text" value="<?php echo PAYPAL_EMAIL; ?>" hidden>

            <input name="return" type="text" value="<?php echo RETURN_URL; ?>" hidden>
            <input name="cancel_return" type="text" value="<?php echo CANCEL_URL; ?>" hidden>
            <input name="notify_url" type="text" value="<?php echo NOTIFY_URL; ?>" hidden>

            <input type="hidden" name="cmd" value="_xclick">

            <input name="paymentPayPal" type="submit" value="PayPal Payment">
        </form>
    </div>
</body>

</html>