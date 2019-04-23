
<!DOCTYPE html>

<!--Created by Patrick Garcia for CST-126
This program allows the user to register with a new account, or log into an existing one.
The program stores all user info in mySQL databse, and even keeps track of the number of failed login attempts
for each userName and resets this number after a succesful login -->


<html>
	<head>
		<title>Login page Results</title>
	</head>
	<body>
	<h1>Login page results</h1>
	<?php 

	require 'functions/myfuncs.php';
	//Creating variables
	$username=trim($_POST['username']);
	$password=trim($_POST['password']);
	$id = 0;
	$id2 = -1;
	
	//making sure that theres input for both username and password fields
	if (!$password || !$username)
	{
	    if(!$username){ echo 'Username field cannot be left blank!</p>'; exit;}
	    if(!$password){ echo 'Password field cannot be left blank!</p>'; exit;}
	    exit;
	}
	//establishing connection to database
	$db = dbConnect();
	
	$query = "SELECT ID FROM users WHERE userName = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('s', $username);
	$stmt->execute() or die("Encountered a problem connecting to database(query INSERT 1)"); 
	$stmt->bind_result($id);
	$stmt->fetch();
	$stmt->free_result();
	
	$query2 = "SELECT id FROM users_passwords WHERE password = ? and id = ?";
	$stmt2 = $db->prepare($query2);
	$stmt2->bind_param('si', $password, $id);
	$stmt2->execute() or die("Encountered a problem connecting to database(query INSERT 1)");
	$stmt2->bind_result($results);
	$stmt2->fetch();
	$stmt2->free_result();
	
	if(!$results){
	    echo nl2br('<a href="register.html">Create an account!</a>\nYou have not been logged in!!');
	    if(isset($_COOKIE['submit']))
	    {
	        if($_COOKIE['submit'] < 3)
	        {
	            $attempts = $_COOKIE['submit'] + 1;
	            setcookie('submit', $attempts,time()+60*10);
	        } else {echo 'you are banned for 10 minutes. try again later';}
	    } else {setcookie('login',1,time()+60*10);}
	}else {
	    echo 'You have been logged in!!';
	}
	?>
		
	
	</body>

</html>