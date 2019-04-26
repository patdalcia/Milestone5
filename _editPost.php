<?php
require 'functions/myfuncs.php';

$title=trim($_POST['editTitle']);
$content=trim($_POST['editContent']);
$postID = $_POST['postID'];


if (!$title || !$content)
{
    echo '<script language="javascript">alert("Input fields were left blank! Click OK to try again.")</script>';
    echo '<script language="javascript">location.replace("editPost.php");</script>';
}
$db = dbConnect();
session_start();



$query = "UPDATE posts SET title = ?, content= ? WHERE ID = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('ssi', $title, $content, $postID);
if($stmt->execute())
{
    $db->close();
    header("location: blog.php");
} else { echo 'Error: Could not save post';}
?>