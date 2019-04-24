<?php

    require 'functions/myfuncs.php';
    
    $title=trim($_POST['title']);
    $body=trim($_POST['body']);
    $category=trim($_POST['category']);
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
    
    $query = "SELECT catID FROM categories WHERE name = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $category);
  
    if($stmt->execute()){
        $stmt->store_result();
        if($stmt->num_rows > 0){
            $stmt->bind_result($results);
            if($stmt->fetch()){
                $stmt->free_result();
                
                $query = "INSERT INTO posts (title, content, user_id, catID, date_created) VALUES (?, ?, ?, ?, NOW())";
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssis', $title, $body, $_SESSION['ID'], $results);
                if($stmt->execute())
                {
                    echo 'Post has been saved succsesfully!';
                } else { echo 'Error: Could not save post';}
            }
        } else{  //Category could not be found
            
            $query = "INSERT INTO categories (name, date) VALUES (?, NOW())";
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $category);
            if($stmt->execute())
            {
                $catID = $db->insert_id;
                $stmt->free_result();
                
                $query = "INSERT INTO posts (title, content, user_id, catID, date_created) VALUES (?, ?, ?, ?, NOW())";
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssis', $title, $body, $_SESSION['ID'], $catID);
                if($stmt->execute())
                {
                    echo 'Post has been saved succsesfully! Created new category!!';
                } else { echo 'Error: Could not save post';}
                
                
            } else { echo 'Error: Could not create new category';}
        }
    }
    
   
?>