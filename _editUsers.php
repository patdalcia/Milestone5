<?php 
require 'functions/myfuncs.php';
checkSessionTime();
session_start();

$userID = $_SESSION['userID'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$emailAddress = $_SESSION['emailAddress'];
$userName = $_SESSION['userName'];
$user_role = $_SESSION['user_role'];
    
    $db = dbConnect();
    session_start();
    
    $query = "UPDATE users SET firstName= ?, lastName = ?, emailAddress = ?, userName = ?, user_role = ? WHERE ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssii', $firstName, $lastName, $emailAddress, $userName, $user_role, $userID);
    if($stmt->execute())
    {
        $db->close();
        echo '<script language="javascript">alert("Post was updated succsesfully! Click ok to return to main blog page.")</script>';
        echo '<script language="javascript">location.replace("myAdmin.php");</script>';
    } else { echo 'Error: Could not save post';}
    

?>