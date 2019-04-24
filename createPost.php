<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>My Blog Page</title>

</head>
<body>
<h2>My Blog Page</h2>

<form action="" method="post" id="usrform">
<table style="border: 0px;"> 

 <tr> 
 <td>Title of Post: <input type="text" name="title" maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="body" form="usrform">Enter text here...</textarea></td>
 </tr>
  <tr> 
 	<td>Post category: <input type="text" name="category" size ='10' maxlength='30' /></td>
  </tr>
  <tr>
  <td><input type="submit" value="Create Post"></td>
  </tr>
 </table>
</form>



<br>


</body>
</html>

<?php
if(isset($_POST["submit"])){
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
    
}
?>

<?php 
function showAllCategories(){
    require 'functions/myfuncs.php';
    
    $db = dbConnect();
    
    echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">category Name</font> </td>
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
}
?>