<?php
//require 'functions/myfuncs.php';
session_start();
$title=trim($_POST['editTitle']);
$content=trim($_POST['editContent']);
$postID = $_SESSION['selectedPost'];

echo $_SESSION['selectedPost'];

?>