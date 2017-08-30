<?php
session_start();

// insert all pizza and customer information into database

$first = $_POST["first"];
$last = $_POST["last"];
$address = $_POST["address"];
if (isset($_POST["apartment"])){
	$apartment = $_POST["apartment"];
}
else {
	$apartment = "";
}
$address .= " " . $apartment;
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$phone = $_POST["phone"];
$pizzaDesc = $_POST["pizzaDesc"];
$priceSub = $_POST["subTotal"];
$priceTotal = $_POST["total"];
$priceTax = $_POST["tax"];

require_once("includes/dbconstants.php");

$sql = 'INSERT INTO customers(custFName, custLName, custAddress, custCity, custState, custZip, custPhone) VALUES ("'.$first.'", "'.$last.'", "'.$address.'", "'.$city.'", "'.$state.'", "'.$zip.'", "'.$phone.'")';

// check values


// run query
mysqli_query ($con, $sql);
//Pull new customer ID from database using mysql_insert_id()
$newid = mysqli_insert_id($con);
//echo $newid;
$today = date("Y.m.d");
// create a new SQL statement to add pizza information to orders
$sql = 'INSERT INTO orders(dateTimePlaced, custID, pizzaDesc, priceSub, tax, priceTotal, completed) VALUES("'.$today.'", "'.$newid.'", "'.$pizzaDesc.'", '.$priceSub.', '.$priceTax.', '.$priceTotal.', "n")';
// check values echo out sql
//echo $sql;
// run query
mysqli_query ($con, $sql);
//Display your summary page



?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Pizza Parlor Order Summary</title>
<link rel="stylesheet" type="text/css" href="PizzaCSS.css">
<script type="text/javascript" src="cookies.js"></script>
<script type="text/javascript" src="PizzaScript.js"></script>
<script type="text/javascript">
window.onload = function () {
    var thirtyMinutes = 60 * 30,
        display = document.querySelector('#time');
    startTimer(thirtyMinutes, display);
};

</script>
</head>

<body>
<h1>Pizza Parlor</h1>
<hr/>
<?php


?>
<div id="custinfo">
	<script type="text/javascript">
		
		document.write(GetCookie("CustInfo"));
	</script>
</div>

<div id="countdown">
Your pizza is on its way! It should arrive in: <span id="time"> 30:00</span> minutes
</div>
<div id="pizzaorder">
	<script type="text/javascript">
		document.write(GetCookie("PizzaDesc") + "<br>" + GetCookie("PizzaCost"));
	</script>
</div>


</body>
</html>