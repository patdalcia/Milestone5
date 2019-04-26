
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>My Blog Page</title>

</head>
<body>
<h2>Main Blog index</h2>

<form action="" method="post" id="blogIndex">
<table style="border: 0px;"> 
<tr> 
          <td> <font face="Arial">Create Post</font> </td> 
          <td> <font face="Arial">View all posts</font> </td> 
          <td> <font face="Arial">View all posts for specific category</font> </td> 
          <td> <font face="Arial">View all categories</font> </td> 
          <td> <font face="Arial">Edit your posts</font> </td> 
      </tr>
      <tr>
 		  <td> <input type="submit" name="create"value="Create a Post"> </td>
 		  <td> <input type="submit" name="VallPosts"value="View all posts"> </td>
 		  <td> <input type="submit" name="VpostsByCategories"value="View all posts by categories"> </td>
 		  <td> <input type="submit" name="Vcategories"value="View all categories"> </td>
 		  <td> <input type="submit" name="editPosts"value="Edit your posts"> </td>
 	 </tr>	  
 </table>
</form>

<br>


</body>
</html>


<?php
if(isset($_POST['create'])) {
    header('location: createPost.php');
} else if(isset($_POST['VallPosts'])){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    
    $query = "SELECT ID, user_id, title, content, date_created FROM `posts` ";
    $result = $db->query($query) or die('Error inside utility.php');
    
    echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Title of post</font> </td>
          <td> <font face="Arial">User ID</font> </td>
          <td> <font face="Arial">Post ID</font> </td>
          <td> <font face="Arial">Body of Post</font> </td>
          <td> <font face="Arial">Date post was created</font> </td>
      </tr>';
    
    if ($result = $db->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["title"];
            $field2name = $row["user_id"];
            $field3name = $row["ID"];
            $field4name = $row["content"];
            $field5name = $row["date_created"];
           
            
            echo '<tr>
                  <td>'.$field1name.'</td>
                  <td>'.$field2name.'</td>
                  <td>'.$field3name.'</td>
                  <td>'.$field4name.'</td>
                  <td>'.$field5name.'</td>
              </tr>';
        }
        $result->free();
        $db->close();
    } 
    
} else if (isset($_POST['VpostsByCategories'])){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    $catInfo = "";
    $field = '';
    $field1 = '';
    
    $query = "SELECT name, catID FROM `categories` ";
    $catInfo = $db->query($query) or die('Error AGAIANAINFNN :(');
    
    
            echo '
            <form action="" method="post" id="catSelect">
            <select name="cat"> 
            <option value="0">Select a category</option>';
            
            
            foreach($catInfo as $row) {
                
                $field = $row['catID'];
                $field1 = $row['name'];
                //echo '<option value="' . $field . '"name="' . $field1 . '>' . $field1 . '</option>';
                echo '<option value="'. $field .'">'. $field1  .'</option>';
  
            }
            //echo '<option value="'.$row["catID"].'">'.$row["name"].'</option>';
            
            
            echo '
                <input type="submit" name="ChooseCat" value="Select Category">
                </select>
                </form>';
       
        $db->close();
    
} else if (isset($_POST['Vcategories'])){
    require 'functions/myfuncs.php';
   
    $db = dbConnect();
    
    echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Category Name</font> </td>
      </tr>';
    
    $query = 'SELECT name FROM categories';
    if ($result = $db->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["name"];
            echo '<tr>
                  <td>'.$field1name.'</td>
              </tr>';
        }
    }
    echo '</table>';
    $result->free();
    $db->close();
} else if (isset($_POST['editPosts'])){
    require 'functions/myfuncs.php';
   sessionStart();
    
   $db = dbConnect();
   
   $query = "SELECT title, ID FROM `posts` WHERE user_id=" . $_SESSION["ID"];
   $postInfo = $db->query($query);
   
   echo '
            <form action="editPost.php" method="post" id="ps">
            <select name="cat">
            <option value="0">Select a category</option>';
   
   foreach($postInfo as $row) {
       
       $field = $row['ID'];
       $field1 = $row['title'];
       echo '<option value="'. $field .'">'. $field1  .'</option>';
       
   }
   
   echo '
                <input type="submit" name="choosePost" value="Select Category">
                </select>
                </form>';
   
   $db->close();
   
   
}

if(isset($_POST["ChooseCat"])){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    $cat = $_POST["cat"];
    
    $query = "SELECT ID, user_id, title, content, date_created FROM `posts` WHERE catID = $cat";
    $result = $db->query($query) or die('Error inside utility.php');
    
    echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Title of post</font> </td>
          <td> <font face="Arial">User ID</font> </td>
          <td> <font face="Arial">Post ID</font> </td>
          <td> <font face="Arial">Body of Post</font> </td>
          <td> <font face="Arial">Date post was created</font> </td>
      </tr>';
    
    if ($result = $db->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["title"];
            $field2name = $row["user_id"];
            $field3name = $row["ID"];
            $field4name = $row["content"];
            $field5name = $row["date_created"];
            
            
            echo '<tr>
                  <td>'.$field1name.'</td>
                  <td>'.$field2name.'</td>
                  <td>'.$field3name.'</td>
                  <td>'.$field4name.'</td>
                  <td>'.$field5name.'</td>
              </tr>';
        }
        $result->free();
        $db->close();
    } 
}

?>
