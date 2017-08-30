<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>Pizza Parlor Order Page</title>
<link rel="stylesheet" type="text/css" href="PizzaCSS.css"/>
<script type="text/javascript" src="cookies.js"></script>
<script type="text/javascript" src="PizzaScript.js"></script>
</head>
<body>
<h1>Pizza Parlor</h1>


<?php




?>

<form action="custInfo.php" method="post" onsubmit="calcPizza()">
<table>
<tr>
	<td id="Pizza">
		Select your size: 
	</td>
	<td id="size">
		<input type="radio" name="size[]" value='12' onclick="calcPizza()">12"
		<br/>
		<input type="radio" name="size[]" value='16' checked="checked" onclick="calcPizza()">16"
		<br/>
		<input type="radio" name="size[]" value='20' onclick="calcPizza()">20"
	</td>
</tr>

<tr>
	<td>
		Select your crust:
	</td>
	<td id="crust">
		<input type="radio" name="crust[]" value="Hand-Tossed" checked="checked" onclick="calcPizza()">Hand-Tossed
		<br/>
		<input type="radio" name="crust[]" value="Thin Crust" onclick="calcPizza()">Thin Crust
	</td>
</tr>

<tr>
	<td>
		Build Your own
	</td>
	<td id="build">
	<input type="radio" name="specialty[]" value="Build Your Own" checked="checked" onclick="calcPizza()">
	</td>
</tr>	
	
<tr>
	<td id="toppings">
		<input type="checkbox" name="topping[]" value="Pepperoni" onclick="calcPizza()">Pepperoni	

		<input type="checkbox" name="topping[]" value="Sausage" onclick="calcPizza()">Sausage
		<br/>
		<input type="checkbox" name="topping[]" value="Tuna" onclick="calcPizza()">Tuna
		
		<input type="checkbox" name="topping[]" value="Chicken" onclick="calcPizza()">Chicken
		<br/>
		<input type="checkbox" name="topping[]" value="Anchovies" onclick="calcPizza()">Anchovies	
	
		<input type="checkbox" name="topping[]" value="Onions" onclick="calcPizza()">Onions
	</td>
	<td>&nbsp;</td>
</tr>

<tr>

	<td>
		Or select one of our Specialty Pizzas:
	</td>
	<td id="specialties">
		<input type="radio" name="specialty[]" value="Meat Lovers" onclick="calcPizza()">Meat Lovers
		<br/>
		<input type="radio" name="specialty[]" value="Supreme" onclick="calcPizza()">Supreme
		<br/>
		<input type="radio" name="specialty[]" value="Veggie" onclick="calcPizza()">Veggie
	</td>

</tr>


</table>
<input type="submit" value="Order Pizza">


</form>
<div id="cost">
</div>


</body>
</html>