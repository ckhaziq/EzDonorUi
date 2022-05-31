<!DOCTYPE html>
<html>

<head>
    <title>EZDonor Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel='stylesheet'>
    <link href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.jshttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel='stylesheet'
        type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css"
        rel="stylesheet" integrity="sha384-AfZ+8dl93QPpFmy0Q1kFwfwG1NBplh51QAw7oZCXARa9KWcl9Xx/7vk16PCDna/T"
        crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!╌Chart╌>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<?php
    include 'dbCon.php';
    //request
    //TotalRequest
    $resultTotalRequest = mysqli_query($con, "SELECT COUNT(*) AS TotalTotalRequest FROM request");
	$num_rowsTotalRequest = mysqli_fetch_assoc($resultTotalRequest);
    //Approved
    $resultApproved = mysqli_query($con, "SELECT COUNT(*) AS TotalApproved FROM approval WHERE ApprovalStatus='Approve'");
	$num_rowsApproved = mysqli_fetch_assoc($resultApproved);
    //WaitingApproval
    $resultWaitingApproval = mysqli_query($con, "SELECT COUNT(*) AS TotalWaitingApproval FROM request WHERE ApprovalID=0");
	$num_rowsWaitingApproval = mysqli_fetch_assoc($resultWaitingApproval);
    //Rejected
    $resultRejected = mysqli_query($con, "SELECT COUNT(*) AS TotalRejected FROM approval WHERE ApprovalStatus='Decline'");
	$num_rowsRejected = mysqli_fetch_assoc($resultRejected);

    $TotalTotalRequest100 = $num_rowsTotalRequest['TotalTotalRequest'];
    $TotalApproved100 = $num_rowsApproved['TotalApproved'] / $num_rowsTotalRequest['TotalTotalRequest'] * 100;
    $TotalWaitingApproval100 = $num_rowsWaitingApproval['TotalWaitingApproval'] / $num_rowsTotalRequest['TotalTotalRequest'] * 100;
    $TotalRejected100 = $num_rowsRejected['TotalRejected'] / $num_rowsTotalRequest['TotalTotalRequest'] * 100;
    
    $dataPointsRequest = array( 
        array("label"=>"Approved", "y"=>$TotalApproved100),
        array("label"=>"Waiting Approval", "y"=>$TotalWaitingApproval100),
        array("label"=>"Rejected", "y"=>$TotalRejected100)
    );


    //TotalPackage
    $resultTotalPackage = mysqli_query($con, "SELECT COUNT(*) AS TotalPackage FROM package WHERE DapurID = 1");
	$num_rowsTotalPackage = mysqli_fetch_assoc($resultTotalPackage);
    //PopularPackage
    $resultPopularPackage = mysqli_query($con, "SELECT COUNT(*) AS PopularPackage FROM ordertable GROUP BY PackageID ORDER BY 'value_occurrence' DESC LIMIT 1");
	$num_rowsPopularPackage = mysqli_fetch_assoc($resultPopularPackage);
    //TotalPopularPackage
    $PopularPackage = $num_rowsPopularPackage['PopularPackage'];
    $resultTotalPopularPackage = mysqli_query($con, "SELECT COUNT(*) AS TotalPopularPackage FROM ordertable WHERE DapurID = 1 AND PackageID = $PopularPackage");
	$num_rowsTotalPopularPackage = mysqli_fetch_assoc($resultTotalPopularPackage);
    //TotalOther
    $resultTotalOther = mysqli_query($con, "SELECT COUNT(*) AS TotalOther FROM ordertable WHERE DapurID = 1 AND PackageID != $PopularPackage");
	$num_rowsTotalOther = mysqli_fetch_assoc($resultTotalOther);
    //TotalOrder
    $resultTotalOrder = mysqli_query($con, "SELECT COUNT(*) AS TotalOrder FROM ordertable WHERE DapurID = 1");
	$num_rowsTotalOrder = mysqli_fetch_assoc($resultTotalOrder);
    //NewOrder
    $resultNewOrder = mysqli_query($con, "SELECT COUNT(*) AS NewOrder FROM ordertable WHERE DapurID = 1 AND OrderStatus = 'New'");
	$num_rowsNewOrder = mysqli_fetch_assoc($resultNewOrder);
    //PendingOrder
    $resultPendingOrder = mysqli_query($con, "SELECT COUNT(*) AS PendingOrder FROM ordertable WHERE DapurID = 1 AND OrderStatus = 'Pending'");
	$num_rowsPendingOrder = mysqli_fetch_assoc($resultPendingOrder);
    //FinishOrder
    $resultFinishOrder = mysqli_query($con, "SELECT COUNT(*) AS FinishOrder FROM ordertable WHERE DapurID = 1 AND OrderStatus = 'Pending'");
	$num_rowsFinishOrder = mysqli_fetch_assoc($resultFinishOrder);    


    $TotalOrder100 = $num_rowsTotalOrder['TotalOrder'];
    $TotalPopularPackage100 = $num_rowsTotalPopularPackage['TotalPopularPackage'] / $num_rowsTotalOrder['TotalOrder'] * 100;
    $TotalOther100 = $num_rowsTotalOther['TotalOther'] / $num_rowsTotalOrder['TotalOrder'] * 100;
    
    $dataPointsPopular = array( 
        array("label"=>"Most Popular", "y"=>$TotalPopularPackage100),
        array("label"=>"Others", "y"=>$TotalOther100)
    );

    $NewOrder100 = $num_rowsNewOrder['NewOrder'] / $num_rowsTotalOrder['TotalOrder'] * 100;
    $PendingOrder100 = $num_rowsPendingOrder['PendingOrder'] / $num_rowsTotalOrder['TotalOrder'] * 100;
    $FinishOrder100 = $num_rowsFinishOrder['FinishOrder'] / $num_rowsTotalOrder['TotalOrder'] * 100;
    
    $dataPointsOrder = array( 
        array("label"=>"New", "y"=>$NewOrder100,),
        array("label"=>"Pending", "y"=>$PendingOrder100),
        array("label"=>"Finished", "y"=>$FinishOrder100)
    );
?>

<script>
window.onload = function() {
    //popular
    var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        title: {
            text: "Total Most Popular Package"
        },
        subtitles: [{
            text: ""
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPointsPopular, JSON_NUMERIC_CHECK); ?>
        }]
    });

    chart1.render();

    //order
    var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title: {
            text: "The number of order"
        },
        subtitles: [{
            text: ""
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPointsOrder, JSON_NUMERIC_CHECK); ?>
        }]
    });

    chart2.render();

}
</script>


<body>

    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#request">Request</a>
        <div class="dropdown">
            <button class="dropbtn">Catalogue
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Donation Package Catalogue</a>
                <a href="#">Donee Package Catalogue</a>
                <a href="#">Donation Request</a>
            </div>
        </div>
        <a href="#about">About</a>
        <div class="topnav-right">
            <a href="#about">Login</a>
        </div>
    </div>

    <div>
        <div class="primary-nav">



            <nav role="navigation" class="menu">

                <a href="#" class="logotype">EZDonor</span></a>

                <div class="overflow-container">

                    <ul class="menu-dropdown">

                        <li><a href="#1">Dashboard</a><span class="icon"><i class="fa fa-dashboard"></i></span></li>


                        <li class="menu-hasdropdown">
                            <a href="#3">Info</a><span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle menu" for="settings">
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox" id="settings" />

                            <ul class="sub-menu-dropdown">
                                <li><a href="">Dapur Info</a></li>
                                <li><a href="">Package Info</a></li>
                            </ul>
                        </li>

                        <li class="menu-hasdropdown">
                            <a href="#3">Order</a><span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle2 menu2" for="settings">
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox2" id="settings" />

                            <ul class="sub-menu-dropdown2">
                                <li><a href="">All Order</a></li>
                                <li><a href="">New Order</a></li>
                                <li><a href="">New</a></li>
                                <li><a href="">Pending Order</a></li>
                            </ul>
                        </li>
                        <li class="menu-hasdropdown">
                            <a href="#3">History/Records</a><span class="icon"><i class="fa fa-gear"></i></span>

                            <label title="toggle3 menu3" for="settings">
                                <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                            </label>
                            <input type="checkbox" class="sub-menu-checkbox3" id="settings" />

                            <ul class="sub-menu-dropdown3">
                                <li><a href="">All</a></li>
                                <li><a href="">Pending</a></li>
                                <li><a href="">Finished</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>

            </nav>

        </div>

        <div class="new-wrapper">

            <div id="main">

                <div style="width: 100%; background-color: grey; margin-top: 13px;" id="main-contents">
                    <div style="margin: auto;  width: 80%;  padding: 10px;">
                        <div style="width: 100%;" class="container">
                            <div style="width: 100%;" class="row">
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget navy-bg">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>Total Package</span>
                                                <h2 class="font-bold">
                                                    <?php echo $num_rowsTotalPackage['TotalPackage']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget navy-bg">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>Popular Package</span>
                                                <h2 class="font-bold">
                                                    <?php echo $num_rowsPopularPackage['PopularPackage']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget navy-bg">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>Total Order</span>
                                                <h2 class="font-bold">
                                                    <?php echo $num_rowsTotalOrder['TotalOrder']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget navy-bg">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>New Order</span>
                                                <h2 class="font-bold">
                                                    <?php echo $num_rowsNewOrder['NewOrder']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget lazur-bg">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>Pending Order</span>
                                                <h2 class="font-bold">
                                                    <?php echo $num_rowsPendingOrder['PendingOrder']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget yellow-bg">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>Finish Order</span>
                                                <h2 class="font-bold">
                                                    <?php echo $num_rowsFinishOrder['FinishOrder']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget bg-danger">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>xxxx</span>
                                                <h2 class="font-bold">
                                                    xxxx
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div style="border-radius: 10px; margin: 10px;" class="widget bg-danger">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <i class="icon icon-search icon-white"></i>
                                            </div>
                                            <div class="span8 text-right">
                                                <span>xxx</span>
                                                <h2 class="font-bold">
                                                    xxx
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 100%; background-color: 	#989898; margin-top: 2px;" id="main-contents">
                    <div style="margin: auto;  width: 80%; padding: 10px;">
                        <div class="row">
                            <div class="col">
                                <div class="square-card">
                                    <div class="card-title">
                                        <h4>User</h4>
                                    </div>
                                    <div class="cta">
                                        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="square-card">
                                    <div class="card-title">
                                        <h4>Request</h4>
                                    </div>
                                    <div class="cta">
                                        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

.openNav2 .hamburger:before {
    content: "\2715";
    /* close icon */
    display: block;
    color: #000;
    line-height: 32px;
    font-size: 16px;
}

.openNav3 .hamburger:before {
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

#menu2:checked+ul.menu-dropdown2 {

    left: 0;
    -webkit-animation: all .45s cubic-bezier(0.77, 0, 0.175, 1);
    animation: all .45s cubic-bezier(0.77, 0, 0.175, 1);
}

#menu3:checked+ul.menu-dropdown3 {

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

.sub-menu-checkbox:checked+ul.sub-menu-dropdown3 {
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

.openNav2 .new-wrapper {
    position: absolute;
    transform: translate3d(200px, 0, 0);
    width: calc(100% - 250px);
    transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
}

.openNav3 .new-wrapper {
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

.menu2 {
    position: absolute;
    display: block;
    left: -200px;
    top: 0;
    width: 250px;
    transition: all 0.45s cubic-bezier(0.77, 0, 0.175, 1);
    background-color: #000;
    z-index: 999;
}

.menu3 {
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

.openNav2 .menu2:hover {
    position: absolute;
    left: -200px;
    top 73px;
}

.openNav3 .menu3:hover {
    position: absolute;
    left: -200px;
    top 73px;
}

.openNav .menu {
    top 73px;
    transform: translate3d(200px, 0, 0);
    transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
}

.openNav2 .menu2:hover {
    position: absolute;
    left: -200px;
    top 73px;
}

.openNav2 .menu2 {
    top 73px;
    transform: translate3d(200px, 0, 0);
    transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
}

.openNav3 .menu3:hover {
    position: absolute;
    left: -200px;
    top 73px;
}

.openNav3 .menu3 {
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

//card
.widget {
    border-radius: 5px;
    padding: 15px 20px;
    margin-bottom: 10px;
    margin-top: 10px;
}

.widget h2,
.widget h3 {
    font-size: 30px;
    margin-top: 5px;
    margin-bottom: 0;
}

.info-box {
    display: block;
    min-height: 90px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    margin-bottom: 15px;
}

.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0, 0, 0, 0.2);
}

.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}

.info-box-text {
    text-transform: uppercase;
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}

.navy-bg,
.bg-primary {
    background-color: #1ab394;
    color: #ffffff;
}

.lazur-bg,
.bg-info {
    background-color: #23c6c8;
    color: #ffffff;
}

.yellow-bg,
.bg-warning {
    background-color: #f8ac59;
    color: #ffffff;
}

.red-bg,
.bg-danger {
    background-color: #ED5565;
    color: #ffffff;
}

.bg-aqua,
.aqua-bg {
    background-color: #00c0ef !important;
}

.bg-green,
.green-bg {
    background-color: #00a65a !important;
}

.bg-red {
    background-color: #ED5565 !important;
}

.bg-navy {
    background-color: #1ab394 !important;
}

.gray-bg,
.bg-muted {
    background-color: #f3f3f4;
}

.ibox {
    clear: both;
    margin-bottom: 25px;
    margin-top: 0;
    padding: 0;
}

.ibox-title {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #ffffff;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 2px 0 0;
    color: inherit;
    margin-bottom: 0;
    padding: 15px 15px 7px;
    min-height: 48px;
}

.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
    clear: both;
}

//card graft
@import url('https://fonts.googleapis.com/css?family=Lato:300,400');

body {
    font-family: 'lato', sans-serif;
}

.square-card {
    margin-left: auto;
    margin-right: auto;
    max-width: 500px;
    /* 	height: 22.5rem; */
    border-radius: 6px;
    background: #fff;
    text-align: left;
    position: relative;
    transition: box-shadow 0.3s ease, border 0.3s;
    ease;
    box-shadow: 12px 15px 20px 0px rgba(46, 61, 73, 0.15);
    /* 	border-radius: 6px; */
    margin-bottom: 20px;
    margin-top: 20px;
}

.square-card:hover {
    box-shadow: 2px 4px 8px 0px rgba(46, 61, 73, 0.2);
    border: none;
}

/* square-card */
.square-card a {
    width: 100%;
    height: 100%;
    display: block;
    color: #525c65;
    border-bottom: none;
    text-decoration: none;
    transition: color 0.3s ease;
    max-width: 500px;
}

.square-card:hover {
    color: #24292d;
}

/* 	card-header */
.card-header {
    width: 255px;
    height: 200px;
    background-image: url('https://s4.postimg.org/ttdbuaw65/Card_item_img_255x200.jpg');
    background-repeat: no-repeat;
    /*     background-attachment: fixed; */
    background-position: center center;
    /* 	background-size: cover !important; */

    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}

/* card-header_overlay */
.card-header_overlay {
    /* 	background-color: rgba(2,179,228,0.8); */
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    height: 9.75em;
    width: 100%;
    z-index: 4000;
}

/* pill */
.pill {
    color: #fff;
    position: relative;
    top: 5px;
    left: 5px;
    /* 	background-color: #fff; */
    background-color: #aa8553;
    font-size: 0.8125rem;
    line-height: 1.5rem;
    height: 1.5rem;
    padding: 5px 5px;
    border-radius: 4px;
    letter-spacing: .03em;
    z-index: 5000;
    text-transform: uppercase;
    font-weight: 400;
    box-shadow: 4px 6px 8px 0px rgba(46, 61, 73, 0.2);
}

/* card-title */
.card-title {
    /* 	padding: 24px 32px; */
    position: relative;
}

/* card-title > h4 */
.card-title>h4 {
    padding: 1em;
    font-size: 1.25em;
    line-height: 1.5em;
    font-weight: 300;
    text-transform: capitalize;
    margin: 0;
    color: #aa8553;
    letter-spacing: .03em;
}

/* cta */
.cta {
    padding-bottom: 10px;
}

.cta a {
    /* 	color: #aa8553; */
    color: #999;
    text-transform: capitalize;
    letter-spacing: 1px;
    display: inline;
    /* 	padding: 10px; */
    margin-left: 10px;
    font-size: 14px;
    text-transform: uppercase;
}

.cta a:hover {
    text-decoration: underline;
    color: #141414;
}
</style>
<script>
$('.nav-toggle').click(function(e) {

    e.preventDefault();
    $("html").toggleClass("openNav");
    $(".nav-toggle").toggleClass("active");

});
$('.nav-toggle2').click(function(f) {

    f.preventDefault();
    $("html").toggleClass("openNav2");
    $(".nav-toggle2").toggleClass("active");

});
$('.nav-toggle3').click(function(g) {

    g.preventDefault();
    $("html").toggleClass("openNav3");
    $(".nav-toggle3").toggleClass("active");

});
</script>

</html>