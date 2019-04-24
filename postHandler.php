<?php
if (!empty($_POST))
{
    require 'myfuncs.php';
    
    $title=trim($_POST['title']);
    $body=trim($_POST['body']);
    
    if (!$title || !$body)
    { 
        echo '<script language="javascript">alert("Input fields were left blank! Click OK to try again.")</script>';
        echo '<script language="javascript">location.replace("blog.html");</script>';
    }
}

?>