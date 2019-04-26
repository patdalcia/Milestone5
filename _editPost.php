<?php
//require 'functions/myfuncs.php';

$title=trim($_POST['editTitle']);
$content=trim($_POST['editContent']);
$postID = $_POST["selectedPost"];

echo $title . $content . $postID;

?>