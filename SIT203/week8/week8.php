<?php
$expire=time()+60*60*24*30;
setcookie("user", "Alex Porter", $expire);


// Print a cookie
echo $_COOKIE["user"];

// A way to view all cookies
print_r($_COOKIE);



?>