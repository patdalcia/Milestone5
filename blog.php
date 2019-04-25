
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
    
    $query = "SELECT name, catID FROM `categories` ";
    $stmt = $db->prepare($query);
    if($stmt->execute()){
        $stmt->bind_result($catInfo);
        if($stmt->fetch()){
            $stmt->free_result();
            
            $query = "SELECT ID, user_id, title, content, date_created FROM `posts` WHERE catID = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $catInfo['catID']);
            if($stmt->execute()){
                $stmt->bind_result($result);
                if($stmt->fetch()){
                    echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Title of post</font> </td>
          <td> <font face="Arial">User ID</font> </td>
          <td> <font face="Arial">Category Name</font> </td>
          <td> <font face="Arial">Post ID</font> </td>
          <td> <font face="Arial">Body of Post</font> </td>
          <td> <font face="Arial">Date post was created</font> </td>
      </tr>';
                    
                   
                        while ($row = $result->fetch_assoc()) {
                            $field1name = $row["title"];
                            $field2name = $row["user_id"];
                            $field3name = $row["ID"];
                            $field4name = $row["content"];
                            $field5name = $row["date_created"];
                            
                            
                            echo '<tr>
                  <td>'.$field1name.'</td>
                  <td>'.$field2name.'</td>
                  <td>'.$catInfo['name'].'</td>  
                  <td>'.$field3name.'</td>
                  <td>'.$field4name.'</td>
                  <td>'.$field5name.'</td>
              </tr>';
                        }
                        $result->free();
                        $db->close();
                    
                }
            }
        }
    }
    
    
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
    echo '<table style="border: 0px;">
	<td>Edit posts was clicked</td>
</table>';
}

?>
