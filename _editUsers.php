<?php 
require 'functions/myfuncs.php';
session_start();

$userID = $_SESSION['userID'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$emailAddress = $_SESSION['emailAddress'];
$userName = $_SESSION['userName'];
$user_role = $_SESSION['user_role'];

echo $userID . $firstName . $lastName . $emailAddress . $userName . $user_role;
?>