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
$sql = "SELECT * FROM admins;";

echo $sql . "<br><br>";

?>
<table style="border:thin black solid;" border="1">
	<tr>
		<th>User Id</th>
		<th>Log In</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Password</th>
		<th>Admin Level</th>	
	</tr>



<?php
// run SQL statement and verify that it worked, display error
$result = mysqli_query($con, $sql);

if (!$result){
	die ("Could not complete sql");
}
else {
	while ($row = $result -> fetch_assoc()){
		echo "<tr>";
			echo "<td>".$row["userID"]."</td>"."<td>".$row["login"]."</td>"."<td>".$row["firstName"]."</td>"."<td>".$row["lastName"]."</td>"."<td>".$row["password"]."</td>"."<td>".$row["adminLevel"]."</td>";
		echo "</tr>";
	}
}

echo "<br /><br />";
echo "<h3>defaults created</h3>";
/**/

?>
</table>