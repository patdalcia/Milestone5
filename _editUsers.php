<?php 
require 'functions/myfuncs.php';
session_start();

$name = $_SESSION['firstName'];

echo $name;
?>