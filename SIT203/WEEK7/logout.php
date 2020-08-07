<?php //file login.php
session_start();

if (isset($_SESSION['id'])){
	unset($_SESSION['id']);
}
if (isset($_SESSION['fname'])){
	$fname = $_SESSION['fname'];
	unset($_SESSION['fname']);
}
if (isset($_SESSION['lname'])){
	$lname = $_SESSION['lname'];
	unset($_SESSION['lname']);
}
// Finally, destroy the session.
//session_destroy();
?>

<html>
<head>
<title> profile page </title>
<style type = "text/css">
   td { padding: 4px }
   img { border: 1px solid black }
</style>

</head>
<body>

<h1><?php echo "Bye bye $fname". " ". $lname; ?></h1>



</body>
</html>