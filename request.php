<?php include 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>EZDonor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <div class="topnav">
        <a href="index.php">Home</a>
        <a class="active" href="request.php">Request</a>
        <div class="dropdown">
            <button class="dropbtn">Catalogue
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

    <div>
        <section>
            <div class="container">
                <h1 id="title">Request Form</h1>
                <p id="description">
                    Please Fill The Form To Make Request
                </p>

                <form id="survey-form"  action="operation.php" method="POST" enctype="multipart/form-data">
                    <div class="inputwrap col">
                        <label for="name" id="name-label" class="bold">Name</label>
                        <input name="RequestName" type="text" id="name" required placeholder="Enter your Name" />
                    </div>
                    <div class="inputwrap col">
                        <label for="name" id="name-label" class="bold">MyKad Number</label>
                        <input name="RequestIC" type="text" id="name" required placeholder="Enter your MyKad Number" />
                    </div>
                    <div class="inputwrap col">
                        <label for="email" id="email-label" class="bold">Phone Number</label>
                        <input name="RequestPhone" type="text" id="name" required placeholder="Enter your Phone Number" />
                    </div>
                    <div class="inputwrap col">
                        <label for="email" id="email-label" class="bold">Request Package</label>
                        <input name="PackageID" type="number" id="number"  min="1" required placeholder="Enter your Requested Package" />
                    </div>
                    <div class="inputwrap col">
                        <label for="name" id="name-label" class="bold">MyKad Picture</label>
                        <input name="RequestICPic" type="file" id="name" required placeholder="Upload your Name MyKad" />
                    </div>
                    <div class="inputwrap col">
                        <label for="name" id="name-label" class="bold">Location</label>
                        <input name="RequestLocation" type="text" id="name" required placeholder="" />
                    </div>

                    <button name="requestSubmit" type="submit" id="submit">Submit</button>
                </form>
            </div>
        </section>
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

    @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        transition: 0.3s;
    }

    body {
        margin: 0;
    }

    section {
        background-image: url("image/light-background-with-calm-soft-colors-spring-shades-color-soft-gradient-backgrounds-posters-banners-postcards-vector-illustration_589396-89.png");
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        height: 100%;    
        overflow: scroll;
        background-position: fixed;
        display: flex;
        justify-content: center;
    }

    .container {
        background-color: white;
        height: fit-content;
        padding: 50px 80px;
        margin: 50px;
        width: 100%;
        max-width: 600px;
    }

    h1 {
        font-family: 'Abril Fatface', cursive;
        font-size: 3.2rem;
        margin: 0;
        text-align: center;
    }

    #description {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        margin-top: 50px;
    }

    .inputwrap {
        margin: 10px 0;
    }

    .col {
        display: flex;
        flex-direction: column;

    }

    .mt8 {
        margin-top: 8px;
    }

    input,
    select {
        padding: 15px;
        font-size: 0.9rem;
    }

    .bold {
        font-weight: 600;
        font-size: 1.1rem;
    }

    textarea {
        width: 100%;
    }

    button {
        margin-top: 50px;
        padding: 15px;
        font-size: 1.2rem;
        font-weight: 600;
        color: white;
        background-color: black;
    }

    button:hover {
        cursor: pointer;
        transform: scale(1.1);
    }

    label:hover,
    input[type="radio"],
    input[type="checkbox"] {
        cursor: pointer;
    }

    @media screen and (max-width: 600px) {
        h1 {
            font-size: 2rem;
        }
    }
</style>

</html>