<?php
// start a session
session_start();

// check to see if the user is authorized, by checking the session variable
// if the user is not authenticated, send them back to the log in page with a warning
if ($_SESSION['loggedIn'] != 1){
	$_SESSION["loginWarn"] = "You must be logged into the system to access the page. <b>not logged in. if</b>";
	header('Location: '."admin.php");
	
}
else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Admin Menu</title>
      
    <meta name="author" content="Duncan Smith">
    <meta name="keywords" content="final project 'Pizza Parlor'">
    <meta name="description" content="Menu page for Pizza Parlor Deluxe Admin site">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="none">   
    <link rel="stylesheet" href="adminStyle.css" type="text/css">
	
</head>

<body>
<div id="container">
    <div id="head">
        <img src="Graphics/pizza.jpeg" width="238" height="120" alt="" id="logo">
        <span class="header">PizzaParlorDeluxe.com</span>
        <span class="contact">
            20000 68th Ave. W<br>
            Lynnwood, WA 98036<br>
            425.222.1234
        </span>
    </div>
    
    <div id="break">    
        <hr style="clear:both;margin-top:15px;">
    </div>
	<div id="nav">
	<!-- links do not work yet-->
        <a href="../home.html" class="orderSum">Home</a><br>
        <a href="../contact.html" class="orderSum">Contact Us</a><br>
        <a href="../order.html" class="orderSum">Order Now</a>
    </div>
	<div id="main">
		<a href="todaysOrders.php"> Todays Orders </a><br>
		<a href="closedOrders.php"> Todays Closed Orders </a><br>
		<a href="allOrders.php"> All Orders </a><br>
		<a href="changePass.php"> Change Password </a>
	</div>
</div>
</body>
</html>
<?php
}
?>