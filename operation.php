<?php
include 'dbCon.php';

//login function
if (isset($_POST["loginSubmit"])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $UserUsername = $_POST["loginUsername"];
    $UserPassword = $_POST["loginPassword"];

    if (empty($UserUsername)) {
        echo "User Name is required";
        header("Location:index.php?error=User Name is required");
        exit();
    } else if (empty($UserPassword)) {
        echo "Password is required";
        header("Location:index.php?error=Password is required");
        exit();
    } else {

        $sql = "SELECT * FROM user WHERE UserUsername='$UserUsername' AND UserPassword='$UserPassword'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['UserUsername'] === $UserUsername && $row['UserPassword'] === $UserPassword) {

                //echo "Logged in!";
                $_SESSION['UserUsername'] = $row['UserUsername'];
                $_SESSION['UserID'] = $row['UserID'];
                $UserID = $row['UserID'];
                $_SESSION['UserAccountType'] = $row['UserAccountType'];


                if ($row['UserAccountType'] == 1) {
                    //echo "Admin";
                    $sqlAdmin = "SELECT * FROM admin WHERE UserID='$UserID'";
                    $resultAdmin = $con->query($sqlAdmin);
                    $rowAdmin = mysqli_fetch_assoc($resultAdmin);
                    $_SESSION['AdminID'] = $rowAdmin['AdminID'];

                    header("Location:admin_dashboard.php");
                }
                if ($row['UserAccountType'] == 2) {
                    //echo "Donor";
                    $sqlDonor = "SELECT * FROM donor WHERE UserID='$UserID'";
                    $resultDonor = $con->query($sqlDonor);
                    $rowDonor = mysqli_fetch_assoc($resultDonor);
                    $_SESSION['DonorID'] = $rowDonor['DonorID'];
                    header("Location:donor_dashboard.php");
                }
                if ($row['UserAccountType'] == 3) {
                    //echo "Donee";
                    $sqlDonee = "SELECT * FROM donee WHERE UserID='$UserID'";
                    $resultDoneer = $con->query($sqlDonee);
                    $rowDonee = mysqli_fetch_assoc($resultDoneer);
                    $_SESSION['DoneeID'] = $rowDonor['DoneeID'];
                    header("Location:donee_dashboard.php");
                }
                if ($row['UserAccountType'] == 4) {
                    //echo "Dapur";
                    $sqlDapur = "SELECT * FROM dapur WHERE UserID='$UserID'";
                    $resultDapur = $con->query($sqlDapur);
                    $rowDapur = mysqli_fetch_assoc($resultDapur);
                    $_SESSION['DapurID'] = $rowDonor['DapurID'];
                    header("Location:dapur_dashboard.php");
                }

                exit();
            } else {
                echo "Incorect User name or password";
                header("Location:index.php?error=Incorect User name or password");
                exit();
            }
        } else {
            echo "Incorect User name or password";
            header("Location:index.php?error=Incorect User name or password");
            exit();
        }
    }
}

// REGISTER USER

if (isset($_POST['registerSubmit'])) {
    //declararion variable
    $errors = array();

    // receive all input values from the form
    $username = mysqli_real_escape_string($con, $_POST['registerUsername']);
    $password_1 = mysqli_real_escape_string($con, $_POST['registerPassword']);
    $password_2 = mysqli_real_escape_string($con, $_POST['registerConfirmPassword']);
    $accountType = mysqli_real_escape_string($con, $_POST['registerAccountType']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
        header("Location:register.php?error=Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
        header("Location:register.php?error=Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
        header("Location:register.php?error=The two passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user WHERE UserUsername='$username' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // if user exists
        if ($user['UserUsername'] === $username) {
            array_push($errors, "Username already exists");
            header("Location:register.php?error=Username already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        //$password = md5($password_1);//encrypt the password before saving in the database
        $password = $password_1;

        $query = "INSERT INTO user (UserUsername, UserPassword, UserAccountType) VALUES('$username', '$password', '$accountType')";
        mysqli_query($con, $query);
        //$_SESSION['UserUsername'] = $row['UserUsername'];    
        //$_SESSION['UserID'] = $row['UserID'];    
        //$_SESSION['UserAccountType'] = $row['UserAccountType']; 
        header('Location:login.php');
    }
}

//request form submit
if (isset($_POST["requestSubmit"])) {

    //echo "Menjadi";

    $RequestName = $_POST["RequestName"];
    $RequestIC = $_POST["RequestIC"];
    $RequestPhone = $_POST["RequestPhone"];
    $PackageID = $_POST["PackageID"];
    $RequestLocation = $_POST["RequestLocation"];
    //$RequestICPic = $_POST["RequestICPic"];
    $ApprovalID = 0;
    /*echo $RequestName;
        echo $RequestIC;
        echo $RequestPhone;
        echo $PackageID;
        echo $RequestLocation;
        echo $RequestICPic;
        echo $ApprovalID;*/

    //picture
    //$_FILES['PackageImage']['error'];
    $filename = $_FILES["RequestICPic"]["name"];
    $tempname = $_FILES["RequestICPic"]["tmp_name"];
    $folder = "./image/" . $filename;

    //echo $filename;

    $query = "INSERT INTO request(RequestName, RequestIC, RequestPhone, PackageID , RequestLocation, RequestICPic, ApprovalID) VALUES('$RequestName', '$RequestIC', '$RequestPhone', '$PackageID' , '$RequestLocation', '$filename', '$ApprovalID')";

    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
       echo "<h3>  Failed to upload image!</h3>";
    }

    $con->close();

    header("Location:request.html");
}

//donee request form submit
if (isset($_POST["doneeRequestSubmit"])) {

    //echo "Menjadi";

    $RequestName = $_POST["RequestName"];
    $RequestIC = $_POST["RequestIC"];
    $RequestPhone = $_POST["RequestPhone"];
    $PackageID = $_POST["PackageID"];
    $RequestLocation = $_POST["RequestLocation"];
    $RequestICPic = $_POST["RequestICPic"];
    $ApprovalID = 0;

    $query = "INSERT INTO request(RequestName, RequestIC, RequestPhone, PackageID , RequestLocation, RequestICPic, ApprovalID) VALUES('$RequestName', '$RequestIC', '$RequestPhone', '$PackageID' , '$RequestLocation', '$RequestICPic', '$ApprovalID')";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:donee_dashboard.html");
}

//dapur info form submit
//insert
if (isset($_POST["dapurInfoSubmit"])) {

    //echo "Menjadi";

    $DapurName = $_POST["DapurName"];
    $DapurLocation = $_POST["DapurLocation"];
    $DapurDescription = $_POST["DapurDescription"];
    $DapurDeliveryHours = $_POST["DapurDeliveryHours"];
    $UserID = 4;    //$_POST["DapurDeliveryHours"];

    $query = "INSERT INTO dapur(DapurName, DapurLocation, DapurDescription, DapurDeliveryHours , UserID) VALUES('$DapurName', '$DapurLocation', '$DapurDescription', '$DapurDeliveryHours' , '$UserID')";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:dapur_restaurantInfo.php");
}
//insert
if (isset($_POST["dapurInfoUpdate"])) {

    //echo "Menjadi";

    $DapurName = $_POST["DapurName"];
    $DapurLocation = $_POST["DapurLocation"];
    $DapurDescription = $_POST["DapurDescription"];
    $DapurDeliveryHours = $_POST["DapurDeliveryHours"];
    $UserID = 4;    //$_POST["UserID"];

    $query = "UPDATE dapur SET DapurName='$DapurName', DapurLocation='$DapurLocation', DapurDescription='$DapurDescription', DapurDeliveryHours='$DapurDeliveryHours'WHERE UserID='$UserID'";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:dapur_restaurantInfo.php");
}

//dapur package submit
if (isset($_POST["dapurPackageSubmit"])) {


    //echo "Menjadi";

    $PackageName = $_POST["PackageName"];
    $PackagePrice = $_POST["PackagePrice"];
    $PackageMinOrder = $_POST["PackageMinOrder"];
    $DapurID = 1;    //$_POST["DapurID"];

    //picture
    //$_FILES['PackageImage']['error'];
    $filename = $_FILES["PackageImage"]["name"];
    $tempname = $_FILES["PackageImage"]["tmp_name"];
    $folder = "./image/" . $filename;

    echo $filename;

    $query = "INSERT INTO package(PackageName, PackagePrice, PackageMinOrder, DapurID, PackageImage) VALUES('$PackageName', '$PackagePrice', '$PackageMinOrder', '$DapurID', '$filename')";

    $result = mysqli_query($con, $query);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }

    $con->close();

    //header("Location:dapur_packageInfo.php");
}

//package update
if (isset($_POST["dapurPackageUpdate"])) {

    //echo "Menjadi";

    $PackageID = $_POST["PackageID"];
    $PackageName = $_POST["PackageName"];
    $PackagePrice = $_POST["PackagePrice"];
    $PackageMinOrder = $_POST["PackageMinOrder"];

    $query = "UPDATE package SET PackageName='$PackageName', PackagePrice=$PackagePrice, PackageMinOrder=$PackageMinOrder WHERE PackageID = $PackageID";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:dapur_packageInfo.php");
}
//package delete
if (isset($_POST["PackageDelete"])) {

    //echo "Menjadi";

    $PackageID = $_POST["PackageID"];

    $query = "DELETE FROM package WHERE PackageID = $PackageID";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:dapur_packageInfo.php");
}
//order accept
if (isset($_POST["OrderAccept"])) {

    //echo "Menjadi";

    $OrderID = $_POST["OrderID"];

    $query = "UPDATE ordertable SET OrderStatus = 'Pending' WHERE OrderID = $OrderID";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:dapur_orderNew.php");
}
//order finish
if (isset($_POST["OrderFinished"])) {

    //echo "Menjadi";

    $OrderID = $_POST["OrderID"];

    $query = "UPDATE ordertable SET OrderStatus = 'Finished' WHERE OrderID = $OrderID";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:dapur_orderPending.php");
}

//admin approval
if (isset($_POST["adminApprove"])) {

    echo "Menjadi";

    $RequestID = $_POST["RequestID"];
    $AdminID = $_SESSION["AdminID"];
    $ApprovalStatus = "Approve";

    $queryApproval = "INSERT INTO approval(RequestID , AdminID, ApprovalStatus) VALUES('$RequestID', '$AdminID' , '$ApprovalStatus')";
    $resultApproval = mysqli_query($con, $queryApproval);

    echo "$AdminID";
    echo "$RequestID";
    echo "$ApprovalStatus";

    $sqlApprocalID = "SELECT * FROM approval WHERE RequestID = '$RequestID'";
    $resultApprocalID = mysqli_query($con, $sqlApprocalID);
    $row = mysqli_fetch_assoc($resultApprocalID);
    $ApprovalID = $row['ApprovalID'];

    $queryRequest = "UPDATE request SET ApprovalID = '$ApprovalID' WHERE RequestID = '$RequestID'";
    $resultRequest = mysqli_query($con, $queryRequest);

    $con->close();

    header("Location:admin_requestApplication.php");
}
//admin declibne
if (isset($_POST["adminDecline"])) {

    echo "Menjadi";

    $RequestID = $_POST["RequestID"];
    $AdminID = $_SESSION["AdminID"];
    $ApprovalStatus = "Decline";

    $queryApproval = "INSERT INTO approval(RequestID , AdminID, ApprovalStatus) VALUES('$RequestID', '$AdminID' , '$ApprovalStatus')";
    $resultApproval = mysqli_query($con, $queryApproval);

    echo "$AdminID";
    echo "$RequestID";
    echo "$ApprovalStatus";

    $sqlApprocalID = "SELECT * FROM approval WHERE RequestID = '$RequestID'";
    $resultApprocalID = mysqli_query($con, $sqlApprocalID);
    $row = mysqli_fetch_assoc($resultApprocalID);
    $ApprovalID = $row['ApprovalID'];

    $queryRequest = "UPDATE request SET ApprovalID = '$ApprovalID' WHERE RequestID = '$RequestID'";
    $resultRequest = mysqli_query($con, $queryRequest);

    $con->close();

    header("Location:admin_requestApplication.php");
}
//donorPackage
if (isset($_POST["donorPackage"])) {
    $_SESSION['PackageID'] = $_POST["PackageID"];
    header("Location:donor_cart.php");
    //echo "Login";
}

//donorDonee
if (isset($_POST["donorDonee"])) {
    $_SESSION['DoneeCatalogueID'] = $_POST["DoneeCatalogueID"];
    $_SESSION['RequestID'] = "";
    header("Location:donor_cart.php");
    //echo "Login";
}

//donorRequest
if (isset($_POST["donorRequest"])) {
    $_SESSION['RequestID'] = $_POST["RequestID"];
    $_SESSION['PackageID'] = $_POST["PackageID"];

    $_SESSION['DoneeCatalogueID'] = "";
    header("Location:donor_cart.php");
    //echo "Login";
}

//paymentPayPal
if (isset($_GET["paymentPayPal"])) {
    /*
Read POST data
reading posted data directly from $_POST causes serialization
issues with array data in POST.
Reading raw POST data from input stream instead.
*/
    define("IPN_LOG_FILE", "ipn.log");
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }

    // Build the body of the verification post request, 
    // adding the _notify-validate command.
    $req = 'cmd=_notify-validate';
    if (function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }

    /*
Post IPN data back to PayPal using curl to 
validate the IPN data is valid & genuine
Anyone can fake IPN data, if you skip it.
*/
    $ch = curl_init(PAYPAL_URL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

    /*
This is often required if the server is missing a global cert
bundle, or is using an outdated one.
Please download the latest 'cacert.pem' from 
http://curl.haxx.se/docs/caextract.html
*/
    if (LOCAL_CERTIFICATE == TRUE) {
        curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cert/cacert.pem");
    }

    // Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Connection: Close',
        'User-Agent: PHP-IPN-Verification-Script'
    ));

    $res = curl_exec($ch);

    // cURL error
    if (curl_errno($ch) != 0) {
        curl_close($ch);
        exit;
    } else {
        curl_close($ch);
    }

    /* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));
    if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
        // assign posted variables to local variables
        $DoneeID = $_POST['DoneeID'];
        $RequestID = $_POST['RequestID'];
        $PackageID = $_POST['PackageID'];
        $PackagePrice = $_POST['PackagePrice'];
        $PaymentAmount = $_POST['PaymentAmount'];
        $PaymentTotalPrice = $_POST['PaymentTotalPrice'];
        $PaymentMethod = $_POST['PaymentMethod'];
        $Currency = $_POST['Currency'];
        $txn_id = $_POST['txn_id'];
        $ReceiverEmail = $_POST['ReceiverEmail'];

        // $payer_email = $_POST['payer_email'];

        // check that receiver_email is your PayPal business email
        if (strtolower($receiver_email) != strtolower(PAYPAL_EMAIL)) {
            error_log(date('[Y-m-d H:i e] ') .
                "Invalid Business Email: $req" . PHP_EOL, 3, IPN_LOG_FILE);
            exit();
        }

        // check that payment currency is correct
        if (strtolower($Currency) != strtolower(CURRENCY)) {
            error_log(date('[Y-m-d H:i e] ') .
                "Invalid Currency: $req" . PHP_EOL, 3, IPN_LOG_FILE);
            exit();
        }

        //Check Unique Transcation ID
        //$db = new DB;
        //$db->query("SELECT * FROM payment WHERE txn_id=:txn_id");
        //$db->bind(':txn_id', $txn_id);
        //$db->execute();
        //$unique_txn_id = $db->rowCount();

        $sqlView = "SELECT * FROM payment WHERE txn_id = txn_id";

        $resultView = $con->query($sqlView);

        if ($resultView->num_rows > 0) {
            while ($rowView = $resultView->fetch_assoc()) {
                $unique_txn_id = $rowView["PackageName"];
            }
        }
        if (!empty($unique_txn_id)) {
            error_log(date('[Y-m-d H:i e] ') .
                "Invalid Transaction ID: $req" . PHP_EOL, 3, IPN_LOG_FILE);
            //$db->close();
            exit();
        } else {
            $sqlInsert = "INSERT INTO payment(DoneeID, PackageID, PackagePrice, PaymentAmount, PaymentTotalPrice, PaymentMethod, Currency, txn_id, PaymentStatus, ReceiverEmail)	
			VALUES ('$DoneeID', '$PackageID', '$PackagePrice', '$PaymentAmount', '$PaymentTotalPrice', '$PaymentMethod', '$Currency', '$txn_id', '$PaymentStatus', '$ReceiverEmail')";

            $resultInsert = $con->query($sqlInsert);

            //$db->bind(":item_number", $item_number);
            //$db->bind(":item_name", $item_name);
            //$db->bind(":payment_status", $payment_status);
            //$db->bind(":amount", $amount);
            //$db->bind(":currency", $currency);
            //$db->bind(":txn_id", $txn_id);
            //$db->execute();
            /* error_log(date('[Y-m-d H:i e] '). 
		"Verified IPN: $req ". PHP_EOL, 3, IPN_LOG_FILE);
		*/
        }
        //$db->close();
    } else if (strcmp($res, "INVALID") == 0) {
        //Log invalid IPN messages for investigation
        error_log(date('[Y-m-d H:i e] ') .
            "Invalid IPN: $req" . PHP_EOL, 3, IPN_LOG_FILE);
    }
}
