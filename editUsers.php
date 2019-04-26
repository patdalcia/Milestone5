<?php
require_once 'functions/myfuncs.php';
checkSessionTime();
$db = dbConnect();
$row = "";

$query = "SELECT * FROM users";
$results = $db->query($query) or die("Error: Could not connect get All users");

foreach($results as $row){
    $ID = $row['ID'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $emailAddress = $row['emailAddress'];
    $userName = $row['userName'];
    $user_role = $row['user_role'];
    
    echo nl2br($ID . $firstName . $lastName . $emailAddress . $userName . $user_role . "\n");
}
?>