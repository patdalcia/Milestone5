
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
	
	if (!empty($_POST)) 
	{
	    if($_COOKIE['login'] < 3){
    session_start(); 
	require 'functions/myfuncs.php';
	//Creating variables
	$username=trim($_POST['username']);
	$password=trim($_POST['password']);
	$id = 0;
	$user_role = 1;
	
	//making sure that theres input for both username and password fields
	if (!$password || !$username)
	{
	    if(!$username){ echo 'Username field cannot be left blank!</p>'; exit;}
	    if(!$password){ echo 'Password field cannot be left blank!</p>'; exit;}
	    exit;
	}
	//establishing connection to database
	$db = dbConnect();
	
	$query = "SELECT ID, user_role FROM users WHERE userName = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('s', $username);
	if($stmt->execute() or die("Encountered a problem connecting to database(query INSERT 1)"))
	{
	    $stmt->store_result();
	    if($stmt->num_rows > 0){ 
	        $stmt->bind_result($id, $user_role);
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
	                    $_SESSION['user_role'] = $user_role;
	                    $_SESSION['username'] = $username;
	                    $stmt->free_result();
	                    $db->close();
	                    if (isset($_COOKIE['login'])) {
	                        unset($_COOKIE['login']);
	                        setcookie('login', '', time() - 3600, '/'); // empty value and old timestamp
	                    }
	                    checkSessionTime(); //Checks if session has expired
	                    header("location: index.php"); //Succsesful login, redirects to index.php
	                }
	                } else {
	                    echo '<script language="javascript">alert("Incorrect Username OR Password, please try again!")</script>';
	                    echo '<script language="javascript">location.replace("login.html");</script>';
	                    if(isset($_COOKIE['login']))
	                    {
	                        if($_COOKIE['login'] < 3)
	                        {
	                            $attempts = $_COOKIE['login'] + 1;
	                            setcookie('login', $attempts, time()+60*10);
	                            header('location: login.html');
	                            die();
	                        } else {
	                            echo '<script language="javascript">alert("3 Login attempts failed. Wait for 10 minutes then try again.")</script>';
	                            echo '<script language="javascript">location.replace("login.html");</script>';
	                        }
	                    } else {
	                        setcookie('login', 1, time() + 60 * 10);
	                    }
	                    exit; 
	                }
	            }else {echo 'Oops something went wrong. Try again later';}
	        }
	    }else {
	        echo '<script language="javascript">alert("Incorrect Username OR Password, please try again!")</script>';
	        echo '<script language="javascript">location.replace("login.html");</script>';
	        exit;
	    }
	}else {echo 'Oops something went wrong. Try again later';}
	
	    } else {
	        echo '<script language="javascript">alert("3 Login attempts failed. Wait for 10 minutes then try again.")</script>';
	        echo '<script language="javascript">location.replace("login.html");</script>';
	    }
	
	} else {echo 'Oops something went wrong. Try again later';} //End of big if
	
	
	
	?>
		
	
	<footer><a href="register.html">No account? Create one!</a></footer>
	</body>

</html>