<?php createSelect();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>My Blog Page</title>

</head>
<body>
<h2>My Blog Page</h2>

<form action="postHandler.php" method="post" id="usrform">
<table style="border: 0px;"> 

 <tr> 
 <td>Title of Post: <input type="text" name="title" maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="body" form="usrform">Enter text here...</textarea></td>
 </tr>
  <tr> 
 	<td><?php selectBox()?></td>
  </tr>
  <tr>
  <td><input type="submit" value="Create Post"></td>
  </tr>
 </table>
</form>

<form action="" method="post" id="showCategories">
<table style="border: 0px;">
<tr>
<td> 		</td>
<td><input type="submit" name="categories"value="View Category List"></td>
</tr>

</table>
</form>
<br>


</body>
</html>


<?php
function getPost(){
    
}

function createSelect(){
    session_start();
    
        require 'functions/myfuncs.php';
        $db = dbConnect();
        $postInfo = "";
        $field = '';
        $field1 = '';
        
        $query = "SELECT ID, user_id, title, content, date_created FROM `posts` WHERE user_id = " . $_SESSION['ID'];
        $postInfo = $db->query($query) or die('Error AGAIANAINFNN :(');
        
        
        echo '
            <form action="" method="post" id="editPost">
            <select name="userPosts">
            <option value="0">Select a category</option>';
        
        
        foreach($postInfo as $row) {
            
            $field = $row['catID'];
            $field1 = $row['name'];
            //echo '<option value="' . $field . '"name="' . $field1 . '>' . $field1 . '</option>';
            echo '<option value="'. $field .'">'. $field1  .'</option>';
            
        }
        //echo '<option value="'.$row["catID"].'">'.$row["name"].'</option>';
        
        
        echo '
                <input type="submit" name="submitEditPost value="Choose Post">
                </select>
                </form>';
        
        $db->close();
}

if(isset($_POST["submitEditPost"])){
    echo 'Form worked';
    echo $_POST["userPosts"];
}
?>


