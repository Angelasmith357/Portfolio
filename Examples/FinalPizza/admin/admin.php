<?php
// start a session in order to work with session variables 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Admin Log In</title>
     
       <meta name="author" content="Duncan Smith">
       <meta name="keywords" content="final project 'Pizza Parlor'">
       <meta name="description" content="Log in page for Pizza Parlor Deluxe Admin site">
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <meta name="robots" content="none">
       <script type="text/javascript" src="admin.js"></script>
       <link rel="stylesheet" href="adminStyle.css" type="text/css">

<!-- Start decision Check Number of Attempts -->

<?php

$blnShowForm = true;

// check to see if this is the first time the user has attempted to log into the administrative site, if so, the session variable will not exist
// use the isset() method to determine if the variable exists
if (!isset($_SESSION["logOnAttempt"])) {
    // create a session variable to determine the number of log in attempts
    $_SESSION["logOnAttempt"] = 0;
    $blnShowForm = true;
}
// check to see if the there have been 10 or more log in attempts
elseif ($_SESSION["logOnAttempt"] >= 10){
    $_SESSION["loginWarn"] = "There is a problem with the log in capabilities.  Contact the administrator of this site for access.";
    // to help secure your site, you would acquire the IP addresses and write it to a table in your database to block this IP Address
    $blnShowForm = false;
}
// check to see if there have been 3 or more log in attempts
elseif ($_SESSION["logOnAttempt"] >= 3) {
    $_SESSION["loginWarn"] = "There is a problem with your credentials. Contact the administrator of this site for access.";
    // to help secure your site, you would remove the log in form and have the user call the administrator of the site
    $blnShowForm = false;
}

?>
</head>
<body>
<div id="container">
    <div id="head">
        <img src="../graphics/pizza.jpeg" width="238" height="120" alt="" id="logo">
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
	<!--Links do not work yet-->
        <a href="../home.html" class="orderSum">Home</a><br>
        <a href="../contact.html" class="orderSum">Contact Us</a><br>
        <a href="../order.html" class="orderSum">Order Now</a>
    </div>
<?php 
    if ($blnShowForm == true){
?>
    <form method="post" action="login.php" onsubmit="return chkForm(0)">
    
    <div id="main">
        <p>
        Please enter your administrator log in:<br><br>
        User name: <input type="text" name="txtUser" class="input" value=""><br>
        Password: &nbsp;&nbsp;<input type="password" name="pswWord" class="input"><br><br>
        <input type="submit" value="Log in">
        </p>
<?php
    }
?>
        <span id="loginWarn">
            <?php
            // Session variable to display login in warning
            if (isset($_SESSION["loginWarn"])){
                echo $_SESSION["loginWarn"];
            }
            ?>
        </span>
    </div>
    
    </form>
    
</div>
</body>

</html>