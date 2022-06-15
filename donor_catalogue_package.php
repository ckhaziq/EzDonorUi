<?php include 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>EZDonor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel='stylesheet'>
    <link href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.jshttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet" integrity="sha384-AfZ+8dl93QPpFmy0Q1kFwfwG1NBplh51QAw7oZCXARa9KWcl9Xx/7vk16PCDna/T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!╌Chart╌>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<?php

?>

<body>

    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="request.php">Request</a>
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
    </div>

    <div>
        <div class="primary-nav">



            <nav role="navigation" class="menu">

                <a href="#" class="logotype">EZDonor</span></a>

                <div class="overflow-container">

                    <ul class="menu-dropdown">

                        <li><a href="donor_dashboard.php">Dashboard</a><span class="icon"><i class="fa fa-dashboard"></i></span></li>

                        <li><a href="donor_info.php">Info</a><span class="icon"><i class="fa fa-dashboard"></i></span></li>


                        <li class="menu-hasdropdown">
                            <a href="#3">Catalogue</a><span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle menu" for="settings">
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox" id="settings" />

                            <ul class="sub-menu-dropdown">
                                <li><a href="donor_catalogue_package.php">Donation Package Catalogue</a></li>
                                <li><a href="donor_catalogue_donee.php">Donee Catalogue</a></li>
                                <li><a href="donor_catalogue_request.php">Donation Request Catalogue</a></li>
                            </ul>
                        </li>

                        <li class="menu-hasdropdown">
                            <a href="#3">History/Records</a><span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle menu" for="settings">
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox" id="settings" />

                            <ul class="sub-menu-dropdown2">
                                <li><a href="donor_recordAll.php">All</a></li>
                                <li><a href="donor_recordPending.php">Pending</a></li>
                                <li><a href="donor_recordFinished.php">Finished</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>

            </nav>

        </div>

        <div class="new-wrapper">

            <div id="main">

                <div style="width: 100%; background-color: grey; margin-top: 13px;" id="main-contents">
                    <div style="margin: auto;  width: 40%;  padding: 10px;">
                        <div class="products products-table">
                            <?php

                            $sqlView = "SELECT * FROM package";

                            $resultView = $con->query($sqlView);

                            if ($resultView->num_rows > 0) {
                                while ($rowView = $resultView->fetch_assoc()) {

                            ?>
                                    <div style="background-color:white;" class="product">
                                        <div class="product-img">
                                            <img src="./image/<?php echo $rowView['PackageImage']; ?>">
                                        </div>
                                        <div class="product-content">
                                            <h3>Package Name: <?php echo $rowView["PackageName"]; ?>
                                                <small>ID: <?php echo $rowView["PackageID"]; ?></small>
                                            </h3>
                                            <p class="product-text price">Price: <?php echo $rowView["PackagePrice"]; ?></p>
                                            <p class="product-text genre">Minimum Order: <?php echo $rowView["PackageMinOrder"]; ?></p>
                                            <form action="operation.php" method="POST">
                                                <input name="PackageID" type="text" value="<?php echo $rowView["PackageID"]; ?>" hidden>
                                                <input name="PackageName" type="text" value="<?php echo $rowView["PackageName"]; ?>" hidden>
                                                <input name="PackagePrice" type="text" value="<?php echo $rowView["PackagePrice"]; ?>" hidden>
                                                <input name="PackageMinOrder" type="text" value="<?php echo $rowView["PackageMinOrder"]; ?>" hidden>
                                                <input name="DapurID" type="text" value="<?php echo $rowView["DapurID"]; ?>" hidden>
                                                <input name="donorPackage" type="submit" value="Donate">
                                            </form>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<style>
    body,
    html {
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

    footer {
        text-align: center;
        padding: 3px;
        background-color: #333;
        color: white;
    }

    //dashboard
    body {
        font-family: 'Work Sans', sans-serif;
        margin: 0;
        background-color: #eee;
    }

    /* Layout */

    #container {
        padding: 0;
        margin: 0;
        background-color: #fff;
    }

    #main {
        padding: 4% 1.5em;
        max-width: 100%;
        margin: 0 auto;
    }

    #header {
        padding: 1.5em;
        margin: 0 0 1em 0;
        background-color: #eee;
    }

    #footer {
        padding: 1.5em;
        margin: 2em 0 0 0;
        background-color: #eee;

    }


    /* Menu Styles */

    .primary-nav {
        position: fixed;
        z-index: 999;
    }

    .menu {
        position: relative;
    }

    .menu ul {
        margin: 0;
        padding: 0;
        list-style: none;

    }

    .open-panel {
        border: none;
        background-color: #fff;
        padding: 0;
    }

    .hamburger {
        background: #fff;
        position: relative;
        display: block;
        text-align: center;
        padding: 13px 0;
        width: 50px;
        height: 73px;
        left: 0;
        top: 0;
        z-index: 1000;
        cursor: pointer;
    }

    .hamburger:before {
        content: "\2630";
        /* hamburger icon */
        display: block;
        color: #000;
        line-height: 32px;
        font-size: 16px;
    }

    .openNav .hamburger:before {
        content: "\2715";
        /* close icon */
        display: block;
        color: #000;
        line-height: 32px;
        font-size: 16px;
    }

    .hamburger:hover:before {
        color: #777;
    }

    .primary-nav .menu li {
        position: relative;
    }

    .menu .icon {
        position: absolute;
        top: 12px;
        right: 10px;
        pointer-events: none;
        width: 24px;
        height: 24px;
        color: #fff;
    }

    .menu,
    .menu a,
    .menu a:visited {
        color: #aaa;
        text-decoration: none !important;
        position: relative;
    }

    .menu a {
        display: block;
        white-space: nowrap;
        padding: 1em;
        font-size: 14px;
    }

    .menu a:hover {
        color: #fff;
    }

    .menu {
        margin-bottom: 3em;
    }

    .menu-dropdown li .icon {
        color: #777;
    }

    .menu-dropdown li:hover .icon {
        color: #fff;
    }



    .menu label {
        margin-bottom: 0;
        display: block;
    }

    .menu label:hover {
        cursor: pointer;
    }

    .menu input[type="checkbox"] {
        display: none;
    }

    input#menu[type="checkbox"] {
        display: none;
    }






    .sub-menu-dropdown {
        display: none;
    }

    .new-wrapper {
        position: absolute;
        left: 50px;
        width: calc(100% - 50px);
        transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
    }

    #menu:checked+ul.menu-dropdown {

        left: 0;
        -webkit-animation: all .45s cubic-bezier(0.77, 0, 0.175, 1);
        animation: all .45s cubic-bezier(0.77, 0, 0.175, 1);
    }

    .sub-menu-checkbox:checked+ul.sub-menu-dropdown {
        display: block !important;
        -webkit-animation: grow .45s cubic-bezier(0.77, 0, 0.175, 1);
        animation: grow .45s cubic-bezier(0.77, 0, 0.175, 1);
    }

    .sub-menu-checkbox:checked+ul.sub-menu-dropdown2 {
        display: block !important;
        -webkit-animation: grow .45s cubic-bezier(0.77, 0, 0.175, 1);
        animation: grow .45s cubic-bezier(0.77, 0, 0.175, 1);
    }


    .openNav .new-wrapper {
        position: absolute;
        transform: translate3d(200px, 0, 0);
        width: calc(100% - 250px);
        transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
    }


    .downarrow {
        background: transparent;
        position: absolute;
        right: 50px;
        top: 12px;
        color: #777;
        width: 24px;
        height: 24px;
        text-align: center;
        display: block;
    }

    .downarrow:hover {
        color: #fff;
    }

    .menu {
        position: absolute;
        display: block;
        left: -200px;
        top: 0;
        width: 250px;
        transition: all 0.45s cubic-bezier(0.77, 0, 0.175, 1);
        background-color: #000;
        z-index: 999;
    }

    .menu-dropdown {
        top: 0;
        overflow-y: auto;
    }

    .overflow-container {
        position: relative;
        height: calc(100vh - 73px) !important;
        overflow-y: auto;
        border-top: 73px solid #fff;
        z-index: -1;
        display: block;
    }

    .menu a.logotype {
        position: absolute !important;
        top: 11px;
        left: 55px;
        display: block;
        font-family: 'Work Sans', sans-serif;
        text-transform: uppercase;
        font-weight: 800;
        color: #000;
        font-size: 21px;
        padding: 10px;
    }

    .menu a.logotype span {
        font-weight: 400;
    }

    .menu a.logotype:hover {
        color: #777;
    }

    .sub-menu-dropdown {
        background-color: #333;
    }

    .menu:hover {
        position: absolute;
        left: 0;
        top: 0;
    }

    .openNav .menu:hover {
        position: absolute;
        left: -200px;
        top 73px;
    }

    .openNav .menu {
        top 73px;
        transform: translate3d(200px, 0, 0);
        transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
    }

    /* label.hamburger {
		display: none;
	} */













    /* look and feel only, not needed for core menu*/

    @-webkit-keyframes grow {

        0% {
            display: none;
            opacity: 0;
        }

        50% {
            display: block;
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }

    }

    @keyframes grow {

        0% {
            display: none;
            opacity: 0;
        }

        50% {
            display: block;
            opacity: 0.5;
        }

        100% {
            opacity: 1
        }

    }










    /* Text meant only for screen readers. */

    .screen-reader-text {
        clip: rect(1px, 1px, 1px, 1px);
        position: absolute !important;
        height: 1px;
        width: 1px;
        overflow: hidden;
    }

    .screen-reader-text:focus {
        background-color: #f1f1f1;
        border-radius: 3px;
        -webkit-box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
        box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
        clip: auto !important;
        color: #21759b;
        display: block;
        font-size: 14px;
        font-size: 0.875rem;
        font-weight: bold;
        height: auto;
        left: 5px;
        line-height: normal;
        padding: 15px 23px 14px;
        text-decoration: none;
        top: 5px;
        width: auto;
        z-index: 100000;
        /* Above WP toolbar. */
    }











    /* Resposive Typography */


    body,
    button,
    input,
    select,
    optgroup,
    textarea {
        color: #000;
        font-size: 1em;
        line-height: 1.5;
        font-weight: 300;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        clear: both;
        font-weight: 800;
    }

    dfn,
    cite,
    em,
    i {
        font-style: italic;
    }

    blockquote {
        margin: 0 1.5em;
    }

    address {
        margin: 0 0 1.5em;
    }

    pre {
        background: #eee;
        font-family: "Courier 10 Pitch", Courier, monospace;
        font-size: 15px;
        font-size: 0.9375rem;
        line-height: 1.6;
        margin-bottom: 1.6em;
        max-width: 100%;
        overflow: auto;
        padding: 1.6em;
    }

    code,
    kbd,
    tt,
    var {
        font-family: Monaco, Consolas, "Andale Mono", "DejaVu Sans Mono", monospace;
        font-size: 15px;
        font-size: 0.9375rem;
    }

    abbr,
    acronym {
        border-bottom: 1px dotted #666;
        cursor: help;
    }

    mark,
    ins {
        background: #fff9c0;
        text-decoration: none;
    }

    big {
        font-size: 125%;
    }

    .light {
        color: #ddd;
    }

    strong {
        font-weight: 600;
    }

    cite,
    em,
    i {
        font-style: italic;
    }

    p.big {
        font-size: 140%;
        line-height: 1.3em;
    }

    p.small {
        font-size: 80%;
    }

    blockquote {
        display: block;
        margin: 1em 20px;
        padding: 0 1em;
        position: relative;
    }

    blockquote:before {}

    blockquote cite,
    blockquote em,
    blockquote i {
        font-style: italic;
    }

    abbr,
    acronym {
        border-bottom: 1px dotted #666;
        cursor: help;
    }

    sup,
    sub {
        height: 0;
        line-height: 1;
        vertical-align: baseline;
        position: relative;
    }

    sup {
        bottom: 1ex;
    }

    sub {
        top: .5ex;
    }


    p {
        font-size: 1em;
        margin: 0 0 2em 0;
    }

    article:last-of-type,
    p:last-of-type {
        margin-bottom: 0;
    }

    p.intro {
        font-size: 1.25em;
        line-height: 1.5;
        font-weight: 300;
        margin: 0 0 1.5em 0;
    }

    h1,
    h2 {
        letter-spacing: -1px;
    }

    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3,
    h4,
    .h4 {
        margin: 0 0 0.5em 0;
        line-height: 1.1;
    }

    h1,
    .h1 {
        font-size: 2.074em;
    }

    h2,
    .h2 {
        font-size: 1.728em;
    }

    h3,
    .h3 {
        font-size: 1.44em;
    }

    h4,
    .h4 {
        font-size: 1.2em;
    }



    /* Medium Screen Typography - Scale: 1.333 Perfect Fourth (thanks http://type-scale.com/)  */

    @media screen and (min-width: 42em) {

        h1,
        .h1 {
            letter-spacing: -2px;
        }

        h1,
        .h1 {
            font-size: 3.157em;
        }

        h2,
        .h2 {
            font-size: 2.369em;
        }

        h3,
        .h3 {
            font-size: 1.777em;
        }

        h4,
        .h4 {
            font-size: 1.333em;
        }

        p {
            font-size: 1.0625em;
        }

        p.intro {
            font-size: 1.3em;
        }

    }


    /* Large Screen Typography  - Scale: 1.414 Augmented Fourth (thanks http://type-scale.com/)  */

    @media screen and (min-width: 72em) {

        h1 {
            letter-spacing: -3px;
        }

        h1,
        .h1 {
            margin-bottom: 0.35em;
            font-size: 3.998em;
        }

        h2,
        .h2 {
            font-size: 2.827em;
        }

        h3,
        .h3 {
            font-size: 1.999em;
        }

        h4,
        .h4 {
            font-size: 1.414em;
        }

        p {
            font-size: 1.125em;
        }

        p.intro {
            font-size: 1.4em;
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
<script>
    $('.nav-toggle').click(function(e) {

        e.preventDefault();
        $("html").toggleClass("openNav");
        $(".nav-toggle").toggleClass("active");

    });
</script>

</html>