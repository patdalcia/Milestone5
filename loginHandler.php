
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
	
	if(isset($_POST['submit']))
	{
    session_start(); 
	require 'functions/myfuncs.php';
	//Creating variables
	$username=trim($_POST['username']);
	$password=trim($_POST['password']);
	$id = 0;
	
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
	if($stmt->execute() or die("Encountered a problem connecting to database(query INSERT 1)"))
	{
	    $stmt->store_result();
	    if($stmt->num_rows > 0){ 
	        $stmt->bind_result($id);
	        if($stmt->fetch()){
	            $stmt->free_result();
	            $query = "SELECT id, password FROM users_passwords WHERE id = ? and password = ?";
	            $stmt = $db->prepare($query);
	            $stmt->bind_param('is', $id, $password);
	            if($stmt->execute() or die("Encountered a problem connecting to database(query INSERT 1)"))
	            {
	                $stmt->store_result();
	                if($stmt->num_rows > 0){
	                $stmt->bind_result($id, $password);
	                if($stmt->fetch()){
	                    $_SESSION['ID'] = $id;
	                    $_SESSION['password'] = $password;
	                    $stmt->free_result();
	                    $db->close();
	                    header("location: welcome.php");
	                }
	                } else {echo 'Password is incorrect';exit; }
	            }else {echo 'Oops something went wrong. Try again later';}
	        }
	    }else {echo 'No accounts found with that userName!';exit;}
	}else {echo 'Oops something went wrong. Try again later';}
	} else {echo 'it didnt work';}
	?>
		
	
	</body>

</html>