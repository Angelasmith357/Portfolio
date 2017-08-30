<?php
/*
// ***** Warning this script should only be run during development and testing phase of this project ******
   ***** This script should only be run once at the start of production ******
Created by mbaker 4/8/2014
Purpose:  	add administrators to database.
			a consistant db for students to work with the final project
Updates:
*/

// create the connection string to MySQL
// arguments sent to mysqli_connect "name of connection", "user name", "user password", "database name"
$con = mysqli_connect("localhost","root","","mysql");

// verify the connection, display error if connection is not made
if (!$con)   {
	die('Could not connect: ');
}

// switch to using the pizza parlor database
// create SQL Statement
$sql = "USE ds_pizzaParlor;";

// run SQL statement and verify that it worked, display error
if (mysqli_query($con, $sql)){
	echo "Using ds_pizzaParlor <br />";
}
else {
	echo "Not using ds_pizzaParlor: " ;
}

// create a default login for the administrators table
// create SQL statement
$sql = "INSERT INTO ds_pizzaParlor.admins (adminLevel, login, firstName, lastName, password) ";
$sql = $sql . "VALUES (1, 'Duncan', 'Duncan', 'Smith', 'Noth1ng!'), (1, 'Minnie', 'Minnie', 'Mouse', 'Noth1ng!'), (1, 'Marti', 'Marti', 'Baker', 'Noth1ng!');";

echo $sql . "<br><br>";

// run SQL statement and verify that it worked, display error
if (mysqli_query($con, $sql)){
	echo "Added Admins <br />";
}
else {
	echo "Admins not added: ";
}


echo "<br /><br />";
echo "<h3>defaults created</h3>";
/**/