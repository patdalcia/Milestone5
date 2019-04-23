<!DOCTYPE html>


<!--Created by Patrick Garcia for CST-126
This program allows the user to register with a new account, or log into an existing one.
The program stores all user info in mySQL databse, and even keeps track of the number of failed login attempts
for each userName and resets this number after a succesful login -->

<html>
	<head>
		<title>Pat's Website - Order Results</title>
	</head>
	<body>
	<h1>Pat's Website Results</h1>
	<?php 
	require 'myfuncs.php';
	//Creating variables
	$nameFirst=trim($_POST['nameFirst']); 
	$nameLast=trim($_POST['nameLast']); 
	$email=trim($_POST['email']);
	$password=trim($_POST['password']);
	$userName=trim($_POST['username']);
	
	//Makes sure that no text fields were left blank
	if (!$nameFirst || !$nameLast || !$email || !$password || !$userName) 
	{ 
	    echo '<p>You have not entered search details.<br/> Please go back and try again.</p>'; 
	    exit; 
	} 
	
	//Establishing connection to database
	$db = dbConnect();
	
	//mySQL query to add new user to database table called 'users'
	$query = "INSERT INTO users (firstName, lastName, emailAddress, userName) VALUES (?, ?, ?, ?)"; 
	$stmt = $db->prepare($query); 
	$stmt->bind_param('ssss', $nameFirst, $nameLast, $email, $userName); 
	$stmt->execute() or die("Encountered a problem connecting to database(query INSERT 1)"); 
	
	$userId = $db->insert_id or die("Encountered a problem connecting to databse(query ID)");
	
	//mySQL query to add new user password to database table called 'users_passwords'
	$query2 = "INSERT INTO users_passwords (user_id, password) VALUES (?, ?)";
	$stmt2 = $db->prepare($query2);
	$stmt2->bind_param('is', $userId, $password);
	$stmt2->execute() or die("Encountered a problem connecting to database(query INSERT 2)");; 
	
	if ($stmt->affected_rows > 0 ) 
	{ 
	    echo "<p>Account has been created!</p>"; 
	} else { 
	    echo "<p>An error has occurred.<br/> The account was not created!</p>"; 
	}
	
	//Closing database connection
	$db->close(); 
	?>
	
	
		
			<footer><a href="index.html">Return to Main page</a>
		<a href="login.html">Return to Login Page</a>
		</footer>
			
		
	</body>

</html>