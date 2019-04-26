
<?php 
function getTitle(){
require 'functions/myfuncs.php';
$db = dbConnect();


$query = "SELECT title FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
$postInfo = $db->query($query);

echo $postInfo["title"];
$db->close();
}

function getContent(){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    
    
    $query = "SELECT content FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
    $postInfo = $db->query($query);
    
    echo $postInfo["content"];
    $db->close();
}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>Edit blog post</title>

</head>
<body>
<h2>Edit your post</h2>

<form action="" method="post" id="editfrm">
<table style="border: 0px;"> 

 <tr> 
 <td>Title of Post: <input type="text" name="title" value=<?php getTitle();?>  maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="body" form="usrform"><?php getContent();?></textarea></td>
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