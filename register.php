<?php include 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>EZDonor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700,800" rel='stylesheet' type='text/css'>

    <?php
    include("dbCon.php");
    if (isset($_SESSION['AdminID']) && $_SESSION['DonorID'] == true) {
        header("Location:admin_dashboard.html");
    }
    if (isset($_SESSION['DonorID']) && $_SESSION['DonorID'] == true) {
        header("Location:donor_dashboard.html");
    }
    if (isset($_SESSION['DoneeID']) && $_SESSION['DonorID'] == true) {
        header("Location:donee_dashboard.html");
    }
    if (isset($_SESSION['DapurID']) && $_SESSION['DonorID'] == true) {
        header("Location:dapur_dashboard.html");
    }
    ?>

</head>

<body>

    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="request.html">Request</a>
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
        <a href="#about">About</a>
        <div class="topnav-right">
            <a class="active" href="login.php">Login</a>
        </div>
    </div>

    <div class="registerform">

        <div class="login">

            <header class="login__header">
                <h2><svg class="icon">
                        <use xlink:href="#icon-lock" />
                    </svg>Register</h2>
            </header>

            <form action="operation.php" class="login__form" method="POST">

                <div>
                    <label for="text">Username</label>
                    <input type="text" id="text" name="registerUsername" placeholder="username" required>
                </div>
                <div>
                    <label for="text">Account Type</label>
                    <select name="registerAccountType">
                        <option value="1">Admin</option>
                        <option value="2">Donor</option>
                        <option value="3">Donee</option>
                        <option value="4">Dapur</option>
                    </select>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="registerPassword" placeholder="password" required>
                </div>
                <div>
                    <label for="password">Confirm Password</label>
                    <input type="password" id="password" name="registerConfirmPassword" placeholder="password" required>
                </div>

                <div>
                    <input class="button" type="submit" name="registerSubmit" value="Log In">
                </div>

            </form>

        </div>

        <svg xmlns="http://www.w3.org/2000/svg" class="icons">

            <symbol id="icon-lock" viewBox="0 0 448 512">
                <path d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z" />
            </symbol>

        </svg>
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

    //loginform
    @use postcss-preset-env {
        stage: 0;
    }

    /* ---------- GENERAL ---------- */
    * {
        box-sizing: inherit;
    }



    .registerform {
        background-color: #c0c0c0;
        font-family: 'Varela Round', sans-serif;
        line-height: 1.5;
        margin: 0;
        min-block-size: 100vh;
        padding: 5vmin;
    }

    h2 {
        font-size: 1.75rem;
    }

    input,
    select {
        background-image: none;
        border: none;
        font: inherit;
        margin: 0;
        padding: 0;
        transition: all 0.3s;
    }

    svg {
        height: auto;
        max-width: 100%;
        vertical-align: middle;
    }

    /* ---------- ALIGN ---------- */
    .align {
        display: grid;
        place-items: center;
    }

    /* ---------- BUTTON ---------- */

    .button {
        background-color: #33cc77;
        color: #fff;
        padding: 0.25em 1.5em;
    }

    .button:focus,
    .button:hover {
        background-color: #28ad63;
    }

    /* ---------- ICONS ---------- */
    .icons {
        display: none;
    }

    .icon {
        fill: currentcolor;
        display: inline-block;
        height: 1em;
        width: 1em;
    }

    /* ---------- LOGIN ---------- */
    .login {
        width: 400px;
    }

    .login__header {
        background-color: #f95252;
        border-top-left-radius: 1.25em;
        border-top-right-radius: 1.25em;
        color: #fff;
        padding: 1.25em 1.625em;
    }

    .login__header :first-child {
        margin-top: 0;
    }

    .login__header :last-child {
        margin-bottom: 0;
    }

    .login h2 .icon {
        margin-right: 14px;
    }

    .login__form {
        background-color: #fff;
        border-bottom-left-radius: 1.25em;
        border-bottom-right-radius: 1.25em;
        color: #777;
        display: grid;
        gap: 0.875em;
        padding: 1.25em 1.625em;
    }

    .login input {
        border-radius: 0.1875em;
    }

    .login input[type="text"],
    .login input[type="password"],
    .login select {
        background-color: #eee;
        color: #777;
        padding: 0.25em 0.625em;
        width: 100%;
    }

    .login input[type="submit"] {
        display: block;
        margin: 0 auto;
    }
</style>

</html>