
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
	require 'myfuncs.php';
	//require 'Session_start.php';
	//Creating variables
	$username=trim($_POST['username']);
	$password=trim($_POST['password']);
	$aCount = 1;
	$bCount = 0;
	
	//making sure that theres input for both username and password fields
	if (!$password || !$username) 
	{ 
	    if(!$username){ echo 'Username field cannot be left blank!</p>'; exit;}
	    if(!$password){ echo 'Password field cannot be left blank!</p>'; exit;}
	    exit; 
	} 
	//establishing connection to database
	$db = dbConnect();
	
	$query = "SELECT userName, ID FROM `users` WHERE userName = '$username'";
	$result = $db->query($query) or die('Error: inside loginHandler.php');
	
	
	if ($result->num_rows > 0 ){
	    
	    $row = $result->fetch_assoc();
	    $ID = $row['ID'];
	    
	    $query = "SELECT password FROM `users_passwords` WHERE id = '$ID' && password = '$password'";
	    $result = $db->query($query) or die('Error inside passwordCheck');
	    
	    if($result->num_rows > 0){
	        saveUserInfo($ID, $username);
	        include 'loginResponse.php';
	        
	        // Save User ID in the Session
	       
	        //resetCounter();
	    }
	    else{
	    if (isset($_COOKIE['submit']))
	    {
	        if ($_COOKIE['submit'] < 3)
	        {
	            $attempts = $_COOKIE['submit'] + 1;
	            setcookie('login',$attempts,time()+60*10);
	        }else {echo 'you are banned for 10 minutes. try again later or click link to create account';}
	    } else {setcookie('login',1,time()+60*10);}
	    //attemptUpdate();
	    }
	}
	 
	//keeps track of login attempts
	function attemptUpdate(){
	    global $db, $username, $aCount;
	   
	    $query = "SELECT userName, attemptCount FROM `login_attempts` WHERE userName = '$username'";
	    $result = $db->query($query) or die('Error inside: attemptUpdate()');
	    
	    if($result->num_rows > 0){
	        $query = "UPDATE login_attempts SET attemptCount=attemptCount+1 WHERE userName='$username'";
	        
	        if ($db->query($query) === TRUE) {
	            echo "Record updated successfully";
	        } else {
	            echo "Error updating record: " . $db->error;
	        }
	    }
	    else{
	        $query = "INSERT INTO login_attempts (userName, attemptCount) VALUES (?, ?)";
	        $stmt = $db->prepare($query);
	        $stmt->bind_param('si', $username,$aCount);
	        $stmt->execute() or die("Encountered a problem connecting to database(adding to attemptTable)"); 
	    }
	}//End of attemptUpdate
	
	function resetCounter(){
	    global $db, $username, $bCount;
	    
	    $query = "SELECT userName, attemptCount FROM `login_attempts` WHERE userName = '$username'";
	    $result = $db->query($query) or die('Error inside: resetCounter()');
	    
	    if($result->num_rows > 0){
	        $query = "UPDATE login_attempts SET attemptCount=0 WHERE userName='$username'";
	        
	        if ($db->query($query) === TRUE) {
	            //echo "Record updated successfully";
	        } else {
	            echo "Error updating record: " . $db->error;
	        }
	    }
	    else{
	        $query = "INSERT INTO login_attempts (userName, attemptCount) VALUES (?, ?)";
	        $stmt = $db->prepare($query);
	        $stmt->bind_param('si', $username,$bCount);
	        $stmt->execute() or die("Encountered a problem: inside resetCounter()");
	    }
	}
	
	$db->close(); 
	?>		
		
	</body>

</html>