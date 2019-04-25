<?php

    require 'functions/myfuncs.php';
    
    $title=trim($_POST['title']);
    $body=trim($_POST['body']);
    $category=trim($_POST['Cat']);
    $results = 0;
    $catID = 0;
    if (!$title || !$body || !$category)
    { 
        echo '<script language="javascript">alert("Input fields were left blank! Click OK to try again.")</script>';
        echo '<script language="javascript">location.replace("createPost.php");</script>';
    }
    $db = dbConnect();
    session_start();
    echo 'Made connections and session';

                
                $query = "INSERT INTO posts (title, content, user_id, catID, date_created) VALUES (?, ?, ?, ?, NOW())";
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssis', $title, $body, $_SESSION['ID'], $results);
                if($stmt->execute())
                {
                    echo 'Post has been saved succsesfully!';
                } else { echo 'Error: Could not save post';}
            
        
?>