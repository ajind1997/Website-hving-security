<?php //file login.php
session_start(); 
$id= $_SESSION['id']; 
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
//$lname = $_REQUEST['lname']; 
/*
$_SESSION['id'] = $id; 
$_SESSION['fname'] = $fname; 
$_SESSION['lname'] = $lname;*/

         // build SELECT query
         $query ="SELECT * FROM Customers WHERE ID  = '$id'";

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

					
			$fname=oci_result($stmt,"FIRSTNAME");
			$lname=oci_result($stmt,"LASTNAME");
			$pass=oci_result($stmt,"PASSWORD");
			$email=oci_result($stmt,"EMAIL");
			$phone=oci_result($stmt,"PHONE");
			$address=oci_result($stmt,"ADDRESS");


		} //end of while
		

			echo "Welcome $username <br /><br />";	
			echo "Here is the updated info <br /><br />";
			echo "<form method='post' action='profile.php'>";
			echo "First Name: <input type='text' name='fname' value='$fname'> <br /><br />";

			echo "Last Name: <input type='text' name='lname' value='$lname'> <br /><br />";
			echo "Password: <input type='text' name='pass' value='$pass'> <br /><br />";
			echo "<input type='submit' value='submit'>";
			echo "</form>";
			
		
		
		oci_close($connect);
		
?> 


<a href="logout.php">Logout</a><br /><br />


</body>
</html>