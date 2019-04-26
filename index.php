
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


echo $_SESSION['user_role'];
?>

