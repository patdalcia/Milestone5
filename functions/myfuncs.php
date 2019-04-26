<?php

/*
 * 
 * This file allows for the connection to the database and the allows user info to be saved in session
 */

function dbConnect() {
    
    define("SERVERNAME", "milestone5mysql.mysql.database.azure.com");
    define("USERNAME", "patdalcia@milestone5mysql");
    define("PASSWORD", "Devildog1");
    define("DBNAME", "milestone5");
    
    //Establishing connection to database
    @$db = new mysqli();
    $db -> init();
    
    
    $db-> ssl_set(null, null, 'ssl/BaltimoreCyberTrustRoot.crt.pem', null, null);
    $db->real_connect(SERVERNAME,USERNAME,PASSWORD,DBNAME,3306,MYSQLI_CLIENT_SSL);
    
    if ($db->connect_error)
    {
        echo '<p>Error: Could not connect to database.<br/>';
        echo $db;
        exit;
        
    }else{
        return $db;}
}

function saveUserInfo($id, $userName)
{
    $_SESSION["USER_ID"] = $id;
    $_SESSION["USERNAME"] = $userName;
}
function getUserId()
{
    return $_SESSION["USER_ID"];
}
function getUserName()
{
    return $_SESSION["USERNAME"];
}

function checkSessionTime(){
    session_start();
    if (!empty($_SESSION['enterTime'])) {  //Checking if user has been idle for too long
        $timeDiffernce = time() - $_SESSION['enterTime'];
        if ($timeDiffernce > 3600) { // exprie after one hour (3600 seconds)
            // unset session
            session_destroy(); //Destroy session and return user to login page
            header("location: login.html");
            // get login form
            
        } else {
            // Reset to current time.
            $_SESSION['enterTime'] = time();
        }
    } else {
        $_SESSION['enterTime'] = time();
    }
}
?>