<?php
session_start();
require_once("../includes/dbconstants.php");
$today = date('Y.m.d');
$sql = "SELECT * FROM orders WHERE completed = 'n' AND dateTimePlaced = '" . $today . "';";

$result = mysqli_query ($con, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Todays Orders</title>
      
    <meta name="author" content="Duncan Smith">
    <meta name="keywords" content="final project 'Pizza Parlor'">
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
	<!-- Links no work... -->
        <a href="../home.html" class="orderSum">Home</a><br>
        <a href="../contact.html" class="orderSum">Contact Us</a><br>
        <a href="../order.html" class="orderSum">Order Now</a>
    </div>
	<form action="completedOrders.php" method="post">
	<table border="1" style="border:thin black solid">
		<tr>
			<th>Order Number</th>
			<th>Date / Time</th>
			<th>Cust ID</th>
			<th>Pizza Desc</th>
			<th>Price </th>
			<th>Completed</th>
		</tr>
		<?php
		foreach ($result as $order){
			echo "<tr>";
				echo "<td>" . $order["orderID"] . "</td>";
				echo "<td>" . $order["dateTimePlaced"] . "</td>";
				echo "<td>" . $order["custID"] . "</td>";
				echo "<td>" . $order["pizzaDesc"] . "</td>";
				echo "<td>" . $order["priceTotal"] . "</td>";
				echo "<td><input type='checkbox' value='" . $order["orderID"] . "' name='completed[]' /></td>";
			echo "</tr>";
		}
		
		?>
		
	</table>
	<input type="submit" value="Complete Order"/>
	</form>
	</div>
	</body>
</html>