
<?php 
require 'functions/myfuncs.php';
checkSessionTime();
session_start();

$user_role = $_SESSION['user_role'];


if($user_role == 0){
    
    echo '
             <!DOCTYPE html>


<!--Created by Patrick Garcia for CST-126
This program allows the user to register with a new account, or log into an existing one.
The program stores all user info in mySQL databse, and even keeps track of the number of failed login attempts
for each userName and resets this number after a succesful login -->


<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>Login page</title>
</head>
<body>
<h1>Welcome ' . $_SESSION['username'] .'</h1>

<ul>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="search.php">Search</a></li>
    <li><a href="myAdmin.php">My admin page</a></li>
</ul>
  
   
   
		
</body>
</html>

         ';
    
}else if($user_role == 1){
    
    echo '
        <!DOCTYPE html>


<!--Created by Patrick Garcia for CST-126
This program allows the user to register with a new account, or log into an existing one.
The program stores all user info in mySQL databse, and even keeps track of the number of failed login attempts
for each userName and resets this number after a succesful login -->


<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>Login page</title>
</head>
<body>
<h1>Welcome ' . $_SESSION['username'] .'</h1>

<ul>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="search.php">Search</a></li>
</ul>
  
   
   
		
</body>
</html>


         ';
    
}

?>



