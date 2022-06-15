<?php include 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>EZDonor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700,800" rel='stylesheet' type='text/css'>

</head>

<body>

    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="request.php">Request</a>
        <div class="dropdown">
            <button style="background-color: #04AA6D;" class="dropbtn">Catalogue
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
            <a href="catalogue_package.php">Donation Package Catalogue</a>
                <a href="catalogue_donee.php">Donee Package Catalogue</a>
                <a href="catalogue_request.php">Donation Request</a>
            </div>
        </div>
         
        <div class="topnav-right">
            <?php if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != "") {
                //echo $_SESSION['AdminID'] ?>
                <a href="logout.php">Log Out</a>

            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </div>
    </div>

    <div class="products products-table">
        <?php 
        
                                
        $sqlView = "SELECT * FROM request WHERE ApprovalID != 0";

        $resultView = $con->query($sqlView);

        if($resultView->num_rows>0){
            while($rowView = $resultView->fetch_assoc()){

        ?>
        <div class="product">
            <div class="product-img">
                <img src="./image/<?php echo $rowView['RequestMap']; ?>">
            </div>
            <div class="product-content">
                <h3>Requester Name: <?php echo $rowView["RequestName"]; ?>
                    <!--<small>Requested ID: <?php echo $rowView["PackageID"]; ?></small>-->
                </h3>
                <p class="product-text price">Requester Location:<?php echo $rowView["RequestLocation"]; ?></p>
            </div>
        </div>
        <?php 
            }
        } 
        ?>
    </div>

</body>
<style>
body,
html {
    height: 100%;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}

.topnav {
    overflow: hidden;
    background-color: #333;
}

.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.topnav a:hover {
    background-color: #ddd;
    color: black;
}

.topnav a.active {
    background-color: #04AA6D;
    color: white;
}

.topnav-right {
    float: right;
}

body {
    margin: 0;
    font-family: Arial
}

.topnav {
    overflow: hidden;
    background-color: #333;
}

.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.active {
    background-color: #04AA6D;
    color: white;
}

.topnav .icon {
    display: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 17px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.topnav a:hover,
.dropdown:hover .dropbtn {
    background-color: #555;
    color: white;
}

.dropdown-content a:hover {
    background-color: #ddd;
    color: black;
}

.dropdown:hover .dropdown-content {
    display: block;
}

@media screen and (max-width: 600px) {

    .topnav a:not(:first-child),
    .dropdown .dropbtn {
        display: none;
    }

    .topnav a.icon {
        float: right;
        display: block;
    }
}

@media screen and (max-width: 600px) {
    .topnav.responsive {
        position: relative;
    }

    .topnav.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
    }

    .topnav.responsive a {
        float: none;
        display: block;
        text-align: left;
    }

    .topnav.responsive .dropdown {
        float: none;
    }

    .topnav.responsive .dropdown-content {
        position: relative;
    }

    .topnav.responsive .dropdown .dropbtn {
        display: block;
        width: 100%;
        text-align: left;
    }
}

//catalog
@media screen and (max-width:400px) {
    .search-area {
        width: 100%;
    }
}

.products {
    width: 100%;
    font-family: Raleway;
}

.product {
    display: inline-block;
    width: calc(24% - 13px);
    margin: 10px 10px 30px 10px;
    vertical-align: top;
}

.product img {
    display: block;
    margin: 0 auto;
    width: auto;
    height: 200px;
    max-width: calc(100% - 20px);
    background-cover: fit;
    box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.8);
    border-radius: 2px;
}

.product-content {
    text-align: center;
}

.product h3 {
    font-size: 20px;
    font-weight: 600;
    margin: 10px 0 0 0;
}

.product h3 small {
    display: block;
    font-size: 16px;
    font-weight: 400;
    font-style: italic;
    margin: 7px 0 0 0;
}

.product .product-text {
    margin: 7px 0 0 0;
    color: #777;
}

.product .price {
    font-family: sans-serif;
    font-size: 16px;
    font-weight: 700;
}

.product .genre {
    font-size: 14px;
}


@media screen and (max-width:1150px) {
    .product {
        width: calc(33% - 23px);
    }
}

@media screen and (max-width:700px) {
    .product {
        width: calc(50% - 43px);
    }
}

@media screen and (max-width:400px) {
    .product {
        width: 100%;
    }
}

/* TABLE VIEW */
@media screen and (min-width:401px) {
    .settings {
        display: block;
    }

    #view {
        display: inline;
    }

    .products-table .product {
        display: block;
        width: auto;
        margin: 10px 10px 30px 10px;
    }

    .products-table .product .product-img {
        display: inline-block;
        margin: 0;
        width: 120px;
        height: 120px;
        vertical-align: middle;
    }

    .products-table .product img {
        width: auto;
        height: 120px;
        max-width: 120px;
    }

    .products-table .product-content {
        text-align: left;
        display: inline-block;
        margin-left: 20px;
        vertical-align: middle;
        width: calc(100% - 145px);
    }

    .products-table .product h3 {
        margin: 0;
    }
}
</style>

</html>