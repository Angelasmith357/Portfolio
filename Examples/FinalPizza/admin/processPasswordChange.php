<?php
// start a session
session_start();
// Create a variable to hold the correct referring page URL
// change for Marti's Machine
//$httpReferer = "http://localhost:8080/DuncanSmith/admin/changePass.php";
$httpReferer = "http://localhost:8080/Php/Pizza/admin/changePass.php";

//echo $_SESSION['loggedIn'];

// Set up variables for use 
$oldPassCorrect = false; 
$newPassCorrect = false;
$hashPass = ""; 

// set up session variables
// Clear previous error message
$_SESSION["loginWarn"] = "";


// check to see if the user is authorized, by checking the session variable
// if the user is not authenticated, send them back to the log in page with a warning
if ($_SESSION['loggedIn'] != 1){
	$_SESSION["loginWarn"] = "You must be logged into the system to access the page. <b>not logged in. if</b>";
	header('Location: '."admin.php");
	
}
// check to see if the user came from the correct page.
elseif ($_SERVER['HTTP_REFERER'] != $httpReferer) {
     // The user did not come from the password change form, redirect them to the log in page
     $_SESSION["loginWarn"] = "You must be logged into the system to access the page. <b>elseif</b>"; 
     //header('Location: '."admin.php"); 
}
// all remaining processing will be done within the else statement
else {
	 // requiring the db connection file, this file must exist and included only once
    require_once("../includes/dbconstants.php");

    // check to see if the session variable for number of password has been created.  If not create it
     if (!isset($_SESSION["passChangeAttempt"])){
           $_SESSION["passChangeAttempt"] = 0;
    }
	
    // create SQL statement to get old password from database
     // $_SESSION variables work best if concatenation to a string
     $sql = "SELECT password FROM admins WHERE userID = " . $_SESSION['userID'] . ";"; 
 
	//echo $sql;
	
     // execute the SQL statement against the database and assign returned records to a variable
     $result = mysqli_query($con, $sql) or die(mysqli_error);
	 
	 // check to see if data was returned from the query
     if ($result) { 
         // place result in associative array and capture the returned data
         while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) { 
               $storedPass = $row["password"];
        }
	}
   // no data was returned from query, send user back to password change page with error message
    else {
        $_SESSION["loginWarn"] = "Record could not be found in database.";
		$_SESSION["passChangeAttempt"] += 1;
		header('Location: '."changePass.php");
    }
	 // encrypt / hash the password submitted through form and assign it to a variable
     $hashPass = hash('sha256', $_POST['pswOld']);
 
    // check for first log in
     if (($_POST['pswOld'] == 'Noth1ng$') && ($storedPass == 'Noth1ng$')){
          $oldPassCorrect = true;
    }
     // else check stored, hashed password against against entered, hashed password
     elseif ($hashPass == $storedPass){
          $oldPassCorrect = true;
    }
     // entered old password does not match stored password, up the attempts at changing the password
     else {
        $_SESSION["passChangeAttempt"] += 1;
        $_SESSION["loginWarn"] = "Old password is incorrect."; 
        header('Location: '."changePass.php"); 
    }
	
	 // if the user entered the old password correctly, $oldPassCorrect will have a value of true
     if ($oldPassCorrect){
        // check to see if new password and confirmed password match
        if ($_POST['pswWord'] == $_POST['pswConf']){ 
           // create a regular expression to check of new password meets complexity requirements
            $re = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{8,}/";
            // check to see if new password meets complexity
            if (preg_match($re, $_POST['pswWord'])) {
                 // all complexity requirements have been met
                 $newPassCorrect = true;
            }
            // new password does not meet complexity, return to password change, up attempts, give warning 
            else {
                $_SESSION["passChangeAttempt"] += 1;
				$_SESSION["loginWarn"] = "Password does not meet complexity requirements";
                header('Location: '."changePass.php");
            }
        }
         // new password and confirmed password do not match return to password change page, up attempts, give warning
         else {
             $_SESSION["passChangeAttempt"] += 1;
             $_SESSION["loginWarn"] = "Passwords do not match. Please retype your new password.";
             header('Location: '."changePass.php");
        } 
	}
	
	  // all conditions have been met to write the new password to the database if $oldPassCorrect and $newPassCorrect are both true
	  
	  if ($oldPassCorrect && $newPassCorrect){
        // Hash the new password for storage in the database
		
		$hashPass = hash('sha256', $_POST['pswWord']); 

		// create SQL statement
		$sql = "UPDATE admins SET password = '". $hashPass . "' WHERE userID = " . $_SESSION['userID'] . ";";

        // execute the sql statement
        $result = mysqli_query($con, $sql) or die(mysqli_error);

        // send the user to the administrative menu page.
        header('Location: '."adminMenu.php");
    }
}
?>