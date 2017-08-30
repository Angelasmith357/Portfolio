<?php
// start a session in order to work with session variables 
session_start();

// create variables from accepted refering pages
//$refer1 = "http://localhost:8080/Php/PizzaParlor/PizzaParlor4-23-2016/admin/";
// Marti's Machine
$refer1 = "http://localhost:8080/Php/Pizza/admin/admin.php";
$refer2 = "http://localhost:8080/Php/Pizza/admin/admin.php";

// check to see if the referring page is correct, if not, send the user back to the log in page
if (($_SERVER['HTTP_REFERER'] != $refer1) && ($_SERVER['HTTP_REFERER'] != $refer2)){
	//echo "In referer";
    header('Location: '."index.php");
}
elseif ((!isset($_POST['txtUser'])) && (!isset($_POST['pswWord']))) {
	//echo "isset";
    header('Location: '."index.php");
}
else {
	require_once("../includes/dbconstants.php");//ask marti where to find this
	
	//echo $_POST['txtUser']. "<br><br>";
	//echo $_POST['pswWord']. "<br><br>";
	
	$adminLogin = $_POST['txtUser'];
    $adminPass = $_POST['pswWord'];



    // used for encrypting the user's password, clear hash if exists
    $hash = "";

    // set default number of records found in DB
    $recCount = 0;

    // start SQL statement
    $sql = "SELECT userID, firstName, lastName, adminLevel, COUNT(*) AS numRecs FROM admins WHERE login = '$adminLogin' AND password = ";

    // check to see if default password is being used. End the SQL statement.
    if ($adminPass == 'Noth1ng$'){
        // User is signing for the first time
        $sql .= "'$adminPass';";
		$redirectURL = "changePass.php";
		//echo "in if";
    }
    else {
        // User has signed in before, encrypt the password
        $hash = hash('sha256', $adminPass);
        $sql .= "'$hash';";
		$redirectURL = "adminMenu.php";
		//echo "in else";
    }
    
	//echo $sql;
	
	
    // run the query using mysqli_query
    $result = mysqli_query($con, $sql) or die(mysqli_error);

    // Get data as an associative array
    // assign the count of records to a variable
    if ($result){
        while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)){
            $recCount = $row['numRecs'];
			if ($recCount > 0){
				$_SESSION['userID'] = $row['userID']; 
                $_SESSION['adminFName'] = $row['firstName'];
                $_SESSION['adminLName'] = $row['lastName'];
                $_SESSION['adminAuthLevel'] = $row['adminLevel'];
				$_SESSION['loggedIn'] = 1;
			}
			else {
				$_SESSION["loginWarn"] = "Log in failed; Invalid userID or password";
				$_SESSION["logOnAttempt"] += 1;
				$_SESSION["loggedIn"] = false;
				header('Location:admin.php');
			}
			echo "in first while <br><br>";
			// create Session variables to hold administrator's information
            echo "Session logged in is: " . $_SESSION['loggedIn'];
            // Information has been captured, redirect the user to the correct page
            header('Location: '. $redirectURL);
        }
		
    }
    //echo $recCount;
	
    // test number of records returned.  a value of 0 means no record found in DB
    /*if ($recCount == 0){
		$_SESSION["loginWarn"] = "Log in failed; Invalid userID or password";
        $_SESSION["logOnAttempt"] += 1;
        $_SESSION["loggedIn"] = false;
        header('Location:admin.php');        
    }
    // a user record was found
    else {
		//echo "in else";
		  if ($result) {
			//echo "in if after else";
			//echo $result;
			
			//echo $redirectURL;
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				echo "in while";
                // create Session variables to hold administrator's information
                $_SESSION['userID'] = $row['userID']; 
                $_SESSION['adminFName'] = $row['firstName'];
                $_SESSION['adminLName'] = $row['lastName'];
                $_SESSION['adminAuthLevel'] = $row['adminLevel'];
				$_SESSION['loggedIn'] = true;
            }
            echo "Session logged in is: " . $_SESSION['loggedIn'];
            // Information has been captured, redirect the user to the correct page
            //header('Location: '. $redirectURL);
        }
    }*/
}
?>