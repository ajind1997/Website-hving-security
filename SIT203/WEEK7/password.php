<?php //file login.php
session_start(); 
session_regenerate_id(true); 

$username = $_REQUEST['username'];
$pass = $_REQUEST['pass'];

//$lname = $_REQUEST['lname']; 
/*
$_SESSION['id'] = $id; 
$_SESSION['fname'] = $fname; 
$_SESSION['lname'] = $lname;*/

         // build SELECT query
         $query ="SELECT * FROM Customers WHERE Username  = '$username'";

		$flag=false;
         // Connect to Oracle
         /* Set oracle user login and password info */
		$dbuser = "shang"; /* your deakin login */
		$dbpass = "sit104"; /* your oracle access password */
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
		while(oci_fetch_array($stmt)) {
			if(oci_result($stmt,"PASSWORD")==$pass) {
			$flag=true;	
		
			$fname=oci_result($stmt,"FIRSTNAME");
			$lname=oci_result($stmt,"LASTNAME");
			$password=oci_result($stmt,"PASSWORD");
			$email=oci_result($stmt,"EMAIL");
			$phone=oci_result($stmt,"PHONE");
			$address=oci_result($stmt,"ADDRESS");
			//set up session values
			//session_start();
			$_SESSION['id'] = oci_result($stmt,"ID"); 
			$_SESSION['fname'] = $fname; 
			$_SESSION['lname'] = $lname;
			$_SESSION['pass'] = $password;	
			//$_SESSION['sessionID']=$PHPSESSID;
			}
		} //end of while
		
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
		if ($flag) {
		
			$fname = $_SESSION['fname'];
			$lname = $_SESSION['lname']; 
			$pass = $_SESSION['pass']; 
			$id= $_SESSION['id'];
			echo "<h1>Hello $fname $lname, welcome to our System! </h1>";
			echo "Welcome $username <br /><br />";	
			echo "Do you want to change your profile? <br /><br />";
			echo "<form method='post' action='profile.php'>";
			echo "First Name: <input type='text' name='fname' value='$fname'> <br /><br />";

			echo "Last Name: <input type='text' name='lname' value='$lname'> <br /><br />";
			echo "Password: <input type='password' name='pass' value='$pass'> <br /><br />";
			echo "<input type='submit' value='submit'>";
			echo "</form>";
			
		} //end of if
		else {
		
			echo "Your password is wrong or your username doesn't exist. Sorry.<br /><br />";
		}
		
		//echo "this is your session id: ".$_SESSION['sessionID']."<br /><br />";
		echo "this is your session_id(): ".session_id();
		oci_close($connect);
?> 




</body>
</html>