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
        //echo "User Name is required";
        header("Location:index.php?error=User Name is required");
        exit();
    } else if (empty($UserPassword)) {
        //echo "Password is required";
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
                //echo "Incorect User name or password";
                header("Location:index.php?error=Incorect User name or password");
                exit();
            }
        } else {
            //echo "Incorect User name or password";
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
    $RequestMap = 'map.png';
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

    $query = "INSERT INTO request(RequestName, RequestIC, RequestPhone, PackageID , RequestLocation, RequestICPic, ApprovalID, RequestMap) VALUES('$RequestName', '$RequestIC', '$RequestPhone', '$PackageID' , '$RequestLocation', '$filename', '$ApprovalID', '$RequestMap')";

    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname,$folder)) {
        //echo "<h3>  Image uploaded successfully!</h3>";
    } else {
       //echo "<h3>  Failed to upload image!</h3>";
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
    $RequestMap = "map.png";
    $ApprovalID = 0;

    $query = "INSERT INTO request(RequestName, RequestIC, RequestPhone, PackageID , RequestLocation, RequestICPic, ApprovalID, RequestMap) VALUES('$RequestName', '$RequestIC', '$RequestPhone', '$PackageID' , '$RequestLocation', '$RequestICPic', '$ApprovalID', '$RequestMap')";

    $result = mysqli_query($con, $query);

    $con->close();

    header("Location:donee_dashboard.php");
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

    //echo $filename;

    $query = "INSERT INTO package(PackageName, PackagePrice, PackageMinOrder, DapurID, PackageImage) VALUES('$PackageName', '$PackagePrice', '$PackageMinOrder', '$DapurID', '$filename')";

    $result = mysqli_query($con, $query);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        //echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        //echo "<h3>  Failed to upload image!</h3>";
    }

    $con->close();

    header("Location:dapur_packageInfo.php");
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

    //echo "Menjadi";

    $RequestID = $_POST["RequestID"];
    $AdminID = $_SESSION["AdminID"];
    $ApprovalStatus = "Approve";

    $queryApproval = "INSERT INTO approval(RequestID , AdminID, ApprovalStatus) VALUES('$RequestID', '$AdminID' , '$ApprovalStatus')";
    $resultApproval = mysqli_query($con, $queryApproval);

    //echo "$AdminID";
    //echo "$RequestID";
    //echo "$ApprovalStatus";

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

    //echo "Menjadi";

    $RequestID = $_POST["RequestID"];
    $AdminID = $_SESSION["AdminID"];
    $ApprovalStatus = "Decline";

    $queryApproval = "INSERT INTO approval(RequestID , AdminID, ApprovalStatus) VALUES('$RequestID', '$AdminID' , '$ApprovalStatus')";
    $resultApproval = mysqli_query($con, $queryApproval);

    //echo "$AdminID";
    //echo "$RequestID";
    //echo "$ApprovalStatus";

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
    $_SESSION['RequestID'] = NULL;
    //echo $_SESSION['DoneeCatalogueID'];
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
//if (isset($_GET["paymentPayPal"])) {
//    
//}
