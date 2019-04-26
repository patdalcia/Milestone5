
<?php 

function getInfo(){

require 'functions/myfuncs.php';
$db = dbConnect();
$postID = $_POST["selectedPost"];

$query = "SELECT ID, title, content FROM posts WHERE ID = $postID";
if ($result = $db->query($query)) {
        $row = $result->fetch_assoc();
        $db->close();
        return $row;
}
$result->free();
$db->close();
    
}

$row = getInfo();
$title = $row["title"];
$content = $row["content"];
$postID = $row["ID"];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>Edit post</title>

</head>
<body>
<h2>Edit post page</h2>

<form action="_editPost.php" method="post" id="editform">
<table style="border: 0px;"> 

 <tr> 
 <td>Title of Post: <input type="text" name="editTitle" value="<?php echo $GLOBALS['title'];?>"  maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="editContent" form="editform"><?php echo $GLOBALS['content'];?></textarea></td>
 </tr>
 <tr>
 <td><input type="text" name="postID" value="<?php $GLOBALS['postID'];?>"></td>
 </tr>
  <tr>
  <td><input type="submit" name="submitEdit" value="Create Post"></td>
  </tr>
 </table>
</form>
</body>
</html>

