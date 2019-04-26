
<?php 
session_start();

if (!empty($_SESSION['enterTime'])) {  //Checking if user has been idle for too long
    $timeDiffernce = time() - $_SESSION['enterTime'];
    if ($timeDiffernce > 3600) { // exprie after one hour (3600 seconds)
        // unset session
        session_destroy(); //Destroy session and return user to login page
        header("location: login.html");
        
    } else {
        // Reset to current time.
        $_SESSION['enterTime'] = time();
    }
} else {
    $_SESSION['enterTime'] = time();
}

$user_role = $_SESSION['user_role'];
?>

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
<h1>Index</h1>

<ul>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="search.php">Search</a></li>
	<?php 
	if($user_role = 0){
	    echo '
        <li><a href="blog.php">My Admin</a></li>
    ';
	}
	?>
</ul>
  
   
   
		
</body>
</html>