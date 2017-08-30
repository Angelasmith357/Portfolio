<?php
session_start();

$size = $_POST["size"];
$crust = $_POST["crust"];
$specialty = $_POST["specialty"];

if (isset ($_POST["topping"])){
	$topping = $_POST["topping"];
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8"/>
<title>Pizza Parlor Customer Info</title>
<link rel="stylesheet" type="text/css" href="PizzaCSS.css"/>
<script type="text/javascript" src="cookies.js"></script>
<script type="text/javascript" src="PizzaScript.js"></script>
<script src="jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>
<script src="additional-methods.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(
	function(){
		$('#CustInfoForm').validate({
			rules:{
				email:{email:true},
				zip:{digits:true},
				phone:{phoneUS:true}
			}
		});
	
	});
	
var subTotal = 	GetCookie("subTotal");
var tax = GetCookie("tax");
var total = GetCookie("PizzaCost");
var pizzaDesc = GetCookie("PizzaDesc");

document.forms[0].subTotal.value = subTotal;
document.forms[0].tax.value = tax;
document.forms[0].total.value = total;
document.forms[0].pizzaDesc.value = pizzaDesc;

</script>	
<style>
label 
{
padding: 10px;
width: 20em; 
float: left; 
}

label.error
{
color:red;
float:none;
}

p 
{ 
clear: both; 
}



</style>
</head>

<body>




<?php





?>
<h1>Pizza Parlor</h1>
<hr/>
<form action="OrderSummary.php" method="post" id="CustInfoForm" onSubmit="chkForm()">

	
	<p>	
		<label>	Delivery Information (* required field)</label>
		
	</p>

	<p>
		<label for="first">First Name: *</label>
		<input type="text" size="20" id="first" name="first" value="Duncan" class="required"/>
	</p>
	<p>
		<label for="last">Last Name: *</label>
		<input type="text" size="20" id="last" name="last" value="Smith" class="required"/>
	</p>
	<p>
		<label for="email">Email: *</label>
		<input type="text" size="30" id="email" name="email" value="duncansmith357@hotmail.com" class="required"/>
	</p>
	<p>
		<label for="address">Address: *</label>
		<input type="text" size="20" id="address" name="address" value="123 Armar Rd" class="required"/>
	</p>
	<p>
		<label for="apartment">Apartment: </label>
		<input type="text" size="20" id="apartment" name="apartment"/>
	</p>
	<p>
		<label for="city">City, State, Zip: *</label>
		
		<input type="text" size="20" id="city" name="city" value="Marysville" class="required"/>
		<input type="text" size="2" name="state" value="WA" class="required"/>
		<input type="text" size="5" name="zip" value="98270" class="required"/>
	</p>
	<p>
		<label for="phone">	Phone: * (XXX-XXX-XXXX)</label>
		<input type="text" size="16" id="phone" name="phone" value="360-913-3258" class="required"/>
	</p>
	<input type="hidden" name="pizzaDesc" value='<?php echo $_COOKIE["PizzaDesc"]?>'/>
	<input type="hidden" name="subTotal" value='<?php echo $_COOKIE["subTotal"]?>'/>
	<input type="hidden" name="tax" value='<?php echo $_COOKIE["tax"]?>'/>
	<input type="hidden" name="total" value='<?php echo $_COOKIE["PizzaCost"]?>'/>

	
<input type="submit" value="Order your Pizza" name="cmdSubmit" />

</form>
<div id="pizzaorder">
	<script type="text/javascript">

		document.write(GetCookie("PizzaDesc") + "<br>" + GetCookie("PizzaCost"));
	</script>
</div>
</body>
</html>