<?php include 'dbCon.php'; ?>
<html>

<head>
    <title>Payment Confirmed</title>
</head>

<body>
    <div style="width:700px; margin:50 auto;">
        <h1>Your paymeny has been received successfully.<br /> Thank you!</h1>
        <form action="<?php echo NOTIFY_URL; ?>" method="POST">            
            <?php
                $_SESSION['PayerID'] = $_GET['PayerID'];
            ?>
            <input name="paymentPayPal" type="submit" value="PayPal Payment">
        </form>
    </div>
</body>

</html>