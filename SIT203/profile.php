<?php //file login.php
session_start();

if (!isset($_SESSION['id'])){
	echo "error!";
	die();
	/*
	$id = $_REQUEST['id'];
	$_SESSION['id'] = $id;
	*/
}
/*
//if (!isset($_SESSION['id'])){
$fname = $_REQUEST['fname'];
//}
//if (!isset($_SESSION['id'])){
$lname = $_REQUEST['lname']; 
//}

$_SESSION['fname'] = $fname; 
$_SESSION['lname'] = $lname;
*/
//otherwise write the updated info to db
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname']; 
$pass = $_REQUEST['pass']; 
$id= $_SESSION['id'];

         // build update sql: update a specific record
		//UPDATE <table_name>
		//SET <column_name> = <value>
		//WHERE <column_name> = <value>
         $query ="UPDATE Customers SET Firstname='$fname' , Lastname='$lname' , Password='$pass' WHERE ID= $id";

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

?>






<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
<title> profile page </title>
<style type = "text/css">
   td { padding: 4px }
   img { border: 1px solid black }
</style>

</head>
<body>



<h1><?php echo "Hello ". $fname. " ". $lname. ", welcome to our System!" ?></h1>

View your updated record in db? <a href="readdb.php">Read updated record</a> <br /><br />

Your profile: <br /><br /> user id: <?php echo $_SESSION['id']; ?> <br /><br />

First Name: <input type="text" name="fname" value="<?php echo $_SESSION['fname']; ?>"> <br /><br />

Last Name: <input type="text" name="lname" value="<?php echo $_SESSION['lname'] ?>"> <br /><br />


<form method="POST" action="logout.php" >

<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

<input type="hidden" name="fname" value="<?php echo $_SESSION['fname']; ?>">

<input type="hidden" name="lname" value="<?php echo $_SESSION['lname']; ?>">

<input type="submit" value="Logout" > <input type="reset" value="reset" > <br /><br />

</form>

</body>
</html>