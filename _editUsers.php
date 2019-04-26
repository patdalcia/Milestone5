<?php 
require 'functions/myfuncs.php';
session_start();

$_SESSION['userID'] = $_POST['userID'];
$_SESSION['firstName'] = $_POST['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$_SESSION['emailAddress'] = $_POST['emailAddress'];
$_SESSION['userName'] = $_POST['userName'];
$_SESSION['user_role'] = $_POST['user_role'];

$userID = $_SESSION['userID'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$emailAddress = $_SESSION['emailAddress'];
$userName = $_SESSION['userName'];
$user_role = $_SESSION['user_role'];

echo $userID . $firstName . $lastName . $emailAddress . $userName . $user_role;
?>