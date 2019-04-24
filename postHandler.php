<?php
if (isset($_POST['category']))
{
    require 'myfuncs.php';
    
    $title=trim($_POST['title']);
    $body=trim($_POST['body']);
    $category=($_POST['category']);
    
    if (!$title || !$body)
    { 
        echo '<script language="javascript">alert("Input fields were left blank! Click OK to try again.")</script>';
        echo '<script language="javascript">location.replace("blog.html");</script>';
    }
    $db = dbConnect();
    session_start();
    
    $query = "INSERT INTO posts (title, content, date_created, user_id, catID) VALUES (?, ?, NOW(), ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssss', $title, $body, $_SESSION['ID'], $category);
    if($stmt->execute())
    {
        echo 'Post has been saved succsesfully!';
    } else { echo 'Error: Could not save post';}
}

?>