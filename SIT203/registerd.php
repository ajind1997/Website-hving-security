<html>
 <body>
 <h1> Congratulations Registered successfuly!</h1>
   <?php

	 $user_fname = (isset($_POST["user_fname"]) && !empty($_POST["user_fname"])) ? $_POST["user_fname"] : null ;
	 $email = (isset($_POST["email"]) && !empty($_POST["email"])) ? $_POST["email"] : null ;
	 $actualPassword = (isset($_POST["password"]) && !empty($_POST["password"])) ? $_POST["password"] : null ;
	 $encryptedPassword = !empty($actualPassword) ? md5($actualPassword) : null;
   
	echo "Name: $user_fname. <br> Email: $email <br> Encrypted Password: $encryptedPassword";
  
	//insert into database when registering for the database.
	   
	$connect=ocilogon('ajind','ANOOP','SSID');
	$sql="insert into USERS values('$user_fname','$email','$encryptedPassword')";
	
	$stmt=ociparse($connect,$sql);
	ociexecute($stmt);	
	
   ?>
   
 </body>
</html>