<?php
$expire=time()+60*60*24*30;
setcookie("user", "Alex Porter", $expire);
?>

<!doctype html>
<html>
<body>



<?php
// Print a cookie
echo $_COOKIE["user"];

// A way to view all cookies
// print_r($_COOKIE);
?>

<?php
if (isset($_COOKIE["user"]))
  echo "Welcome " . $_COOKIE["user"] . "!<br />";
else
  echo "Welcome guest!<br />";
?>

<?php
  phpinfo();
?>

<?php
session_start();
if (isset($_SESSION['username'])){
echo "User : ".$_SESSION['username'];
session_destroy();
} else {
echo "Set the username";
$_SESSION['username'] = 'John';
}
?>

<form action="week8.php" method="post">
Name: <input type="text" name="name" />
Age: <input type="text" name="age" />
<input type="submit" />
</form>

Welcome <?php echo $_POST["name"]; ?>.<br />
You are <?php echo $_POST["age"]; ?> years old.

</body>
</html>