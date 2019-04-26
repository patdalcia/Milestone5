

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
    $catInfo = "";
    $field = '';
    $field1 = '';
    
    $query = "SELECT name, catID FROM `categories` ";
    $catInfo = $db->query($query) or die('Error AGAIANAINFNN :(');
    
    
    echo '
            <form action="" method="post" id="catView">
            <table border="0" cellspacing="2" cellpadding="2"
            <tr>
            <select name="viewCategory">
            <option value="0">Select a category</option>';
    
    
    foreach($catInfo as $row) {
        
        $field = $row['catID'];
        $field1 = $row['name'];
        //echo '<option value="' . $field . '"name="' . $field1 . '>' . $field1 . '</option>';
        echo '<option value="'. $field .'">'. $field1  .'</option>';
        
    }
    
    echo '</tr>';
    
    echo '      <tr>
                <td><input type="submit" name="deleteCat" value="Delete selected category"></td>
                <td><input type="submit" name="updateCat" value="Update selected category"></td>
                <td><input type="submit" name="createCat" value="Create new category"></td>
                <td><input type="submit" name="cancel" value="Cancel"></td>
                </tr>
                </form>
                </select>
                </form>';
    
    $db->close();
    echo '</table>';
    $result->free();
    $db->close();
} else if (isset($_POST['editPosts'])){
    session_start();
    require 'functions/myfuncs.php';
    
    $db = dbConnect();
    
    $query = "SELECT title, ID FROM `posts` WHERE user_id=" . $_SESSION["ID"];
    $postInfo = $db->query($query) or die('Error inside utility.php');
    
    echo '
            <form action="editPost.php" method="post" id="ps">
            <select name="selectedPost">
            <option value="0">Select a post</option>';
    
    
    foreach($postInfo as $row) {
        
        $field = $row['ID'];
        $field1 = $row['title'];
        //echo '<option value="' . $field . '"name="' . $field1 . '>' . $field1 . '</option>';
        echo '<option value="'. $field .'">'. $field1  .'</option>';
        
    }
    //echo '<option value="'.$row["catID"].'">'.$row["name"].'</option>';
    
    
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
if(isset($_POST['deleteCat'])){
    require_once 'functions/myfuncs.php';
    $db = dbConnect();
    $catid = $_POST['viewCategory'];
    $query = "DELETE FROM `categories` WHERE `catID` = " . $catid;
    $db->query($query) or die("Error: Could not delete post");
    $db->close();
    echo '<script language="javascript">alert("Category was deleted succsesfully! Click ok to return to main admin page.")</script>';
    echo '<script language="javascript">location.replace("myAdmin.php");</script>';
} else if(isset($_POST['updateCat'])){
        session_start();
        $_SESSION['viewCategory'] = $_POST['viewCategory'];
    echo '
            <form action="" method="post" id="updateC">
            <table border="0" cellspacing="2" cellpadding="2">
            <tr>
            <td><input type="text" name="upCat" value="Insert updated Category name here"  maxlength="70"></td>
            </tr>
            <tr>
            <td><input type="submit" name="submitUpCat" value="Update"></td>
            </tr>
            </table>
            </form>
';
} else if(isset($_POST['createCat'])){
    echo '
            <form action="" method="post" id="createC">
            <table border="0" cellspacing="2" cellpadding="2">
            <tr>
            <td><input type="text" name="newCat" value="Insert new Category here"  maxlength="100"></td>
            </tr>
            <tr>
            <td><input type="submit" name="createNewCat" value="Create"></td>
            </tr>
            </table>
            </form>
';
} else if(isset($_POST['cancel'])){
    header("location: blog.php");
}

if(isset($_POST['createNewCat'])){
    require 'functions/myfuncs.php';
    
    $newCat=trim($_POST['newCat']);
    
    if (!$newCat)
    {
        echo '<script language="javascript">alert("Input fields were left blank! Click OK to try again.")</script>';
        echo '<script language="javascript">location.replace("myAdmin.php");</script>';
    }
    $db = dbConnect();
    
    $query = "INSERT INTO categories (name, date) VALUES (?, NOW())";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $newCat);
    if($stmt->execute())
    {
        $db->close();
        echo '<script language="javascript">alert("Category was created succsesfully! Click ok to return to main blog page.")</script>';
        echo '<script language="javascript">location.replace("blog.php");</script>';
    } else { echo '<script language="javascript">alert("Category not created! Try a different name.")</script>';
    echo '<script language="javascript">location.replace("myAdmin.php");</script>';}
}

if(isset($_POST['submitUpCat'])){
    require 'functions/myfuncs.php';
    session_start();
    
    $updatedCat =trim($_POST['upCat']);
    $updatedCatID = $_SESSION['viewCategory']; 
   
    if (!$updatedCatID)
    {
        echo '<script language="javascript">alert("Input fields were left blank! Click OK to try again.")</script>';
        echo '<script language="javascript">location.replace("myAdmin.php");</script>';
    }
    $db = dbConnect();
    
    $query = "UPDATE categories SET name = ?, date = NOW() WHERE catID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $updatedCat, $updatedCatID);
    if($stmt->execute())
    {
        $db->close();
        echo '<script language="javascript">alert("Category was updated succsesfully! Click ok to return to main blog page.")</script>';
        echo '<script language="javascript">location.replace("myAdmin.php");</script>';
    } else { echo 'Error: Could not update category. Try a new name!';}
}

?>
