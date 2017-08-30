<?php 
session_start();
require_once("../includes/dbconstants.php");

$completed = $_POST["completed"];


$sql = "SELECT * FROM orders";


$result = mysqli_query($con, $sql);

foreach ($completed as $value){

     foreach ($result as $order){
	
          if ($value == $order["orderID"]) {   // This is where I'm not sure off the top of my head, not sure if it is $order or $order["orderID"]
              $sql = "UPDATE orders SET completed = 'y' WHERE orderID = " . $order["orderID"] . ";";
				
             mysqli_query($con, $sql) or die("could not update db");
			 
			echo "Order Time: " . $order["dateTimePlaced"];
			echo "<br/>Pizza Description: " . $order["pizzaDesc"];
			echo "<table>";
			echo "<tr><td>Subtotal:  </td><td>$" .  number_format($order['priceSub'], 2) . "</td></tr>";
			echo "<tr><td>Tax:  </td><td><ins>$" . number_format($order['tax'], 2) . "</ins></td></tr>";
			echo "<tr><td>Total:  </td><td>$" . number_format($order['priceTotal'], 2) . "</td></tr>";
			echo "</table>";
			echo "Purchase/Delivery to:<br/>";
			$sql = "SELECT * FROM customers WHERE custID =" . $order["custID"] . ";";
	
			$result2 = mysqli_query($con, $sql);
			while($row = $result2->fetch_assoc()){
				echo $row['custFName'] . " " . $row['custLName'] . "<br>";
				echo $row['custAddress'] . "<br>" . $row["custCity"] . " " . $row['custState']  . " " . $row['custZip'];
			}
		  }
     }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Order Completed</title>
      
    <meta name="author" content="Duncan Smith">
    <meta name="keywords" content="final project 'Pizza Parlor'">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="none">   

	
</head>

<body>
<div id="container">
   
	
	
</div>
</body>
</html>