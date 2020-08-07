<?php //file login.php
//session_start(); 
//session_regenerate_id(true); 

$oldPass = $_REQUEST['oldPass'];
$newPass = $_REQUEST['newPass'];

$id;

//$lname = $_REQUEST['lname']; 
/*
$_SESSION['id'] = $id; 
$_SESSION['fname'] = $fname; 
$_SESSION['lname'] = $lname;*/

		
		if($oldPass)
		{
			// Check whetherr old password is valid or not
			
				// build select query
				$sel_query = "SELECT * FROM CUSTOMERS WHERE Id=$id and Password='$oldPass'";
			
			
         // build UPDATE query for changing password
         $query ="Update table Customers set Password='$newPass' WHERE Id=$id";
		}
		 
		 
		$flag_email_exist=false;
         // Connect to Oracle
         /* Set oracle user login and password info */
		$dbuser = "ajind"; /* your deakin login */
		$dbpass = "ANOOP"; /* your oracle access password */
		$db = "SSID";
		$connect = oci_connect($dbuser, $dbpass, $db);

		if (!$connect) {
		echo "An error occurred connecting to the database";
		exit;
		}
   
         /* check the sql statement for errors and if errors report them */
		$stmt = oci_parse($connect, $query);

		if(!$stmt) {
		echo "An error occurred in parsing the sql string.\n";
		exit;
		}
		oci_execute($stmt);
		
		while(oci_fetch($stmt)) {
			
		$flag_email_exist = true; 
			/* if(oci_result($stmt,"PASSWORD")==$pass) {
			$flag=true;	
		
			$fname=oci_result($stmt,"FIRSTNAME");
			$lname=oci_result($stmt,"LASTNAME");
			$password=oci_result($stmt,"PASSWORD");
			$email=oci_result($stmt,"EMAIL");
			$phone=oci_result($stmt,"PHONE");
			$address=oci_result($stmt,"ADDRESS");
			 */
			 
			 //set up session values


//			$_SESSION['id'] = oci_result($stmt,"ID"); 
//			$_SESSION['fname'] = $fname; 
//			$_SESSION['lname'] = $lname;
//			$_SESSION['pass'] = $password;	

			//}
		} //end of while
		
		if(!$flag_email_exist)
		{
				// build INSERT query
		//		$lastIDQuery = "SELECT LAST_INSERT_ID()";
       	$sql="insert into USERS values('$user_fname','$email','$actual_Password')";
		 
		 

		 //echo "q: ".$query;
		 /* check the sql statement for errors and if errors report them */
		// $stmt_lastID = oci_parse($connect, $lastIDQuery);
		$stmt = oci_parse($connect, $query);

	 	if(!$stmt) {
		echo "An error occurred in parsing the sql string.\n";
		exit;
		}
 //		oci_execute($stmt_lastID);
		oci_execute($stmt);
		 
		 echo "Name: $user_fname. <br> Email: $email <br> Actual Password: $actual_Password";
		
		 //while()
		}
			
		
		
		?>
		
<html>
<head>
<title> login page </title>
<style type = "text/css">
   td { padding: 4px }
   img { border: 1px solid black }
</style>

</head>
<body>

		<?php
		if ($flag_email_exist) {
		
	//		$fname = $_SESSION['fname'];
	//		$lname = $_SESSION['lname']; 
	//		$pass = $_SESSION['pass']; 
	//		$id= $_SESSION['id'];
			/* echo "<h1>Hello $fname $lname, welcome to our System! </h1>";
			echo "Welcome $username <br /><br />";	
			echo "Do you want to change your profile? <br /><br />";
			echo "<form method='post' action='profile.php'>";
			echo "First Name: <input type='text' name='fname' value='$fname'> <br /><br />";

			echo "Last Name: <input type='text' name='lname' value='$lname'> <br /><br />";
			echo "Password: <input type='password' name='pass' value='$pass'> <br /><br />";
			echo "<input type='submit' value='submit'>";
			echo "</form>"; */
			
			echo "<b>Entered email id already exists.</b> Therefore, you can login or register with new email id.";
			echo '<br><a class="btn btn-primary" href="index.html"><b>Click to Proceed.</b></a>';
			
			
		} //end of if
		else {
		
			
			
			
			echo "Your password is wrong or your username doesn't exist. Sorry.<br /><br />";
			?>
			
			<p>Do you want to login again?</p>
			<a class="btn btn-primary" href="index.html">Click to Login</a>
			
			<?php
		}
		
		
		//echo "this is your session_id(): ".session_id();
		oci_close($connect);
?> 




</body>
</html>