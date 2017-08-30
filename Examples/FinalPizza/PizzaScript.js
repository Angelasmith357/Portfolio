var strSize = "";
var fltSubTotal = 0;
var strCrust = "";
var strType = "";
var strToppings = "<br>";

/*
function calcPizza()
purpose: calculates pizza cost and dynamically updates both cost and pizza ingredients
author: Duncan Smith
date: 8/21/2015
*/
function calcPizza(){
	var intSizeLen = document.forms[0].elements["size[]"].length;
	// do the same for each radio button or check box group
	var intCrustLen = document.forms[0].elements["crust[]"].length;
	var intTypeLen = document.forms[0].elements["specialty[]"].length;
	var intToppingLen = document.forms[0].elements["topping[]"].length;
	fltSubTotal = 0;
	strToppings = "";
	
	for (var i = 0; i < intSizeLen; i++){
		if (document.forms[0].elements["size[]"][i].checked){
			strSize = document.forms[0].elements["size[]"][i].value;
		}
	}
	//document.write(strSize + "<br>");
	switch (strSize){
		case '12':
			fltSubTotal = 3;
			break;
		case '16':
			fltSubTotal = 4;
			break;
		case '20':
			fltSubTotal = 5;
			break;
		default:
			fltSubTotal = 99;
	}
	
	for (var i = 0; i < intCrustLen; i++){
		if(document.forms[0].elements["crust[]"][i].checked){
			strCrust = document.forms[0].elements["crust[]"][i].value;
		}
	}
	
	switch (strCrust){
		case "Hand-Tossed":
			fltSubTotal = fltSubTotal + 2;
			break;
		case "Thin Crust":
			fltSubTotal = fltSubTotal + 3;
			break;
		default:
			fltSubTotal = fltSubTotal + 99;
	}
	
	for (var i = 0; i < intTypeLen; i++){
		if(document.forms[0].elements["specialty[]"][i].checked){
			strType = document.forms[0].elements["specialty[]"][i].value;
			
			
		}
	
	}
	
	/*
	function BuildOwn()
	purpose: show build you own options when build your own is seleceted, add options to list and cost.
	date: 8/21/2015
	author: Duncan Smith
	*/
	function BuildOwn() {
		var fltToppingsCost = 0;
		
		for (var i = 0; i <intToppingLen; i++){
			if (document.forms[0].elements["topping[]"][i].checked){
				fltToppingsCost += .5;
				if (strToppings == "<br>"){
					strToppings += document.forms[0].elements["topping[]"][i].value + "\n";
				}
				else {
					strToppings += ", " + document.forms[0].elements["topping[]"][i].value;
				}
			}
		}
		
		fltSubTotal += fltToppingsCost;
			
		strType = strType + strToppings;
		
	
	}
	
	/*
	function DisableBuildOptions()
	purpose : disables build your own options when specialties are chosen
	author: Duncan Smith
	notes: taken from a fellow students project, renamed to fit this code
	date: 8/21/2015
	*/
	function DisableBuildOptions(){
		// get the number of toppings offered to the customer
		var intTopLen = document.forms[0].elements["topping[]"].length;
			
		// loop through the toppings making sure they are enabled
		for (var i = 0; i < intTopLen; i++){
			document.forms[0].elements["topping[]"][i].disabled = true;
			document.forms[0].elements["topping[]"][i].checked = false;
		}
	
		// create a return value for your function
		return true;
	}
	
	
	/*
	function EnableBuildOptions()
	purpose: enables build your own options when Build Your Own is selected
	author: Duncan Smith
	date: 8/21/2015
	
	*/
	function EnableBuildOptions(){
		var intTopLen = document.forms[0].elements["topping[]"].length;
		for (var i = 0; i < intTopLen; i++){
			document.forms[0].elements["topping[]"][i].disabled = false;
		}
	return true;
	}
	
	
	
	switch (strType){
		case "Build Your Own":
			fltSubTotal = fltSubTotal + 1;
			BuildOwn();
			EnableBuildOptions();
			break;
		case "Meat Lovers":
			fltSubTotal = fltSubTotal + 4;
			DisableBuildOptions();
			break;
		case "Supreme":
			fltSubTotal = fltSubTotal + 3.25;
			DisableBuildOptions();
			break;
		case "Veggie":
			fltSubTotal = fltSubTotal + 1.5;
			DisableBuildOptions();
			break;
	}
	
	
	// do similar for crust and type as above
	
	// if build your own is selected
	// use a switch like above for strSize 
	// If build is chosen - call another function that enables all the checkboxes (a loop)
	// If others are chosen - call a different function that disables all the checkboxes (a loop)
	//document.write(fltSubTotal + "<br>");
	var fltTax = fltSubTotal * .10;

	var fltTotal = parseFloat(fltSubTotal) + parseFloat(fltTax);
	//document.write(fltTotal);
	// check out the toFixed function
	document.getElementById("cost").innerHTML = strSize + "<br>" + strCrust + "<br>" + strType + "<br> Subtotal: $" + fltSubTotal.toFixed(2) + "<br> Tax: $" + fltTax.toFixed(2) + "<br> Total: $" + fltTotal.toFixed(2);
	
	SetCookie ("PizzaDesc", strSize + ", " + strCrust + ", " + strType);
	
	// set a cookie for the price information
	SetCookie ("tax", fltTax.toFixed(2));
	SetCookie ("subTotal", fltSubTotal.toFixed(2));
	SetCookie ("PizzaCost", fltTotal.toFixed(2));
	
	
}



/*
function chkForm()
purpose: Validate the information in the form
author: Duncan Smith
date: 7/27/2015
parameters: none
notes:updated 8/20/2015
*/

function chkForm(){
	
	var intLen = document.forms[0].elements.length;
	var strEmail = document.forms[0].email.value;
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	var strCustInfo = "";
	var phoneRegEx = /^[1-9]\d{2}-\d{3}-\d{4}/i;
	var strPhone = document.forms[0].phone.value;
	
	
	for(var i = 0; i < intLen; i++) {
		if (document.forms[0].elements[i].name != "apartment"){
			if(document.forms[0].elements[i].value == ""){
				document.getElementById(document.forms[0].elements[i].name).innerHTML = "Fill this out";
				document.forms[0].elements[i].focus();
				return false;
			}
			else{
				if (document.forms[0].elements[i].name != "cmdSubmit"){
					
					strCustInfo += document.forms[0].elements[i].value + ", ";
					
				}
			}
		}
	}
	
	if (strEmail.search(emailRegEx) == -1){          
          document.getElementById("email").innerHTML = "Please enter a valid email address.";
          document.forms[0].email.value = "";
          document.forms[0].email.focus();
          return false;
    }
	 
	if (isNaN(document.forms[0].zip.value)){
          document.getElementById("zip").innerHTML = "Please enter 5 digits for your zip code.";
          document.forms[0].zip.value = "";
          document.forms[0].zip.focus();
          return false;
	}
	
		if(strPhone.search(phoneRegEx) == -1){
		document.getElementById("phone").innerHTML = "Please enter a valid phone number.";
		document.forms[0].phone.value = "";
		document.forms[0].phone.focus();
		return false;
	}
	

	SetCookie("CustInfo", strCustInfo);
	
	

	return true; 
}

function clearErr(fieldName){
	document.getElementById(fieldName).innerHTML = "";
	return true;
}

/*
function startTimer()
purpose: create a countdown timer for pizza arrival
source: http://stackoverflow.com/questions/20618355/the-simplest-possible-javascript-countdown-timer
notes: changed the var fiveMinutes to thirtyMinutes to fit my timeframe. 
*/

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
	if(display){
        display.textContent = minutes + ":" + seconds;
	}
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

