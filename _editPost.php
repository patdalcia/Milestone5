<?php
require 'functions/myfuncs.php';

if(isset($_POST['deletePost'])){
    $postID = $_POST['postID'];
    
    require_once 'functions/myfuncs.php';
    $db = dbConnect();
    $query = "DELETE FROM `posts` WHERE `ID` = " . $postID;
    $db->query($query) or die("Error: Could not delete post");
    $db->close();
    echo '<script language="javascript">alert("Post was deleted succsesfully! Click ok to return to main blog page.")</script>';
    echo '<script language="javascript">location.replace("blog.php");</script>';
    
} else if(isset($_POST['submitEdit'])){

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
    echo '<script language="javascript">alert("Post was updated succsesfully! Click ok to return to main blog page.")</script>';
    echo '<script language="javascript">location.replace("blog.php");</script>';
} else { echo 'Error: Could not save post';}

}
?>