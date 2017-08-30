<?php
// start a session in order to work with session variables
session_start();
// file contains connection string to database
require_once("dbconstants.php");
?>



       <!-- Start decision Check Number of Attempts -->
<?php

       $blnShowForm = true;

       // check to see if this is the first time the user has attempted to login to the administrative site, if so, the session variable will not exist
       // use the isset() method to determine if the variable exists
       /*if (!isset($_SESSION["logOnAttempt"])) {
           // create a session variable to determine the number of login attempts
           $_SESSION["logOnAttempt"] = 0;
           $blnShowForm = true;
       }
       // check to see if the there have been 10 or more login attempts
       elseif ($_SESSION["logOnAttempt"] >= 10){
           $_SESSION["loginWarn"] = "There is a problem with the login capabilities.  Contact the administrator of this site for access.";
           // to help secure your site, you would acquire the IP addresses and write it to a table in your database to block this IP Address
           $blnShowForm = false;
       }
       // check to see if there have been 3 or more log in attempts
       elseif ($_SESSION["logOnAttempt"] >= 3) {
           //$_SESSION["loginWarn"] = "There is a problem with your credentials. Contact the administrator of this site for access.";
           // to help secure your site, you would remove the login form and have the user call the administrator of the site
           $blnShowForm = false;
       }*/
// echo "Logon attempts = ".$_SESSION['logOnAttempt'];

// create variables from accepted refering pages
$refer1 = "http://localhost:8888/login.php";
// changed for Marti's Machine
$refer2 = $_SERVER['HTTP_REFERER'];
//$refer2 = "http://localhost:8888/process.php";

// check to see if the referring page is correct, if not, send the user back to the log in page
if (($_SERVER['HTTP_REFERER'] != $refer1) && ($_SERVER['HTTP_REFERER'] != $refer2)){
    header('Location: '."login.php");
}
elseif ((!isset($_POST['txtUser'])) && (!isset($_POST['pswWord']))) {
    //header('Location: '."processlogin.php");
}
else {
  // requiring the db connection file, this file must exist and included only once
   $host = "localhost:8080";
   $user = "root";          // user for MySQL RDBMS on bucket is "root"
   // changed for Marti's machine
   $password = "";
   //$password = "root";      // password for MySQL RDBMS on bucket is "Vy$@G3cyb"
   $dbname="ds_pizzaParlor";

   $con = new mysqli($host, $user, $password, $dbname)
       or die ('Could not connect to the database' . mysqli_connect_error());

$adminLogin = $_POST['txtUser'];
$adminPass = $_POST['pswWord'];

// used for encrypting the user's password, clear hash if exists
$hash = "";

// set default number of records found in DB
$recCount = 0;

// start SQL statement
$sql = "SELECT AdminID, Username, FirstName, LastName, AdminLevel, COUNT(*) AS numRecs FROM Admin WHERE Username = '$adminLogin' AND Password = ";

// check to see if default password is being used. End the SQL statement.
// changed if condition, double quotes
if ($adminPass == "Noth1ng!"){
    // User is signing for the first time
    $sql .= "'$adminPass';";
}
else {
    // User has signed in before, encrypt the password
    $hash = hash('sha256', $adminPass);
    $sql .= "'$hash';";
}

// run the query using mysqli_query
$result = mysqli_query($con, $sql) or die(mysqli_error);

// Get data as an associative array
// assign the count of records to a variable
if ($result){
    while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)){
        $recCount = $row['numRecs'];
    }
}

// test number of records returned.  a value of 0 means no record found in DB
if ($recCount == 0){
	// no records found
	$_SESSION["loginWarn"] = "User name or password is incorrect. Please try again.";
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Admin Login</title>
       <!-- author: Duncan Smith / Marti Baker
       CIS 243 -->
       <meta name="author" content="Marti Baker">
       <meta name="keywords" content="final project 'Pizza Parlor'">
       <meta name="description" content="Log in page for Pizza Parlor Deluxe Admin site">
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <meta name="robots" content="none">
       <script type="text/javascript" src="admin.js"></script>
       <link rel="stylesheet" href="adminStyle.css" type="text/css">
</head>
<body>
<div id="container">
    <div id="head">
      <!-- <img id="pizzatxt" src="pizza.png" alt="stylistic pizza text"> -->
      <img src="pizza.png" alt="pizza slice graphic" width="200" height="200">
        <!-- <img src="../pizzaSlice.PNG" width="238" height="120" alt="" id="logo"> -->
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
        <a href="contact.html" class="orderSum">Contact Us</a><br>
    </div>

    

    <form method="post" action="login.php" onsubmit="return chkForm(0)">

    <div id="main">
        <p>
        Please enter your administrator login details:<br><br>
        Username: <input type="text" name="txtUser" class="input" value=""><br>
        Password: &nbsp;<input type="password" name="pswWord" class="input"><br><br>
        <input type="submit" value="Log in">
        </p>

        

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
<?php
// a user record was found
else {
	// 
}
?>
