
<?php 
function getInfo(){
require 'functions/myfuncs.php';
$db = dbConnect();
$postID = $_POST["selectedPost"];

$query = "SELECT title, content FROM posts WHERE ID = $postID";
if ($result = $db->query($query)) {
        $row = $result->fetch_assoc();
       // $field1name = $row["title"];
        $db->close();
        return $row;
}
$result->free();
$db->close();
}
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

<form action="" method="post" id="editform">
<table style="border: 0px;"> 

 <tr> 
 <td>Title of Post: <input type="text" name="title" value="<?php echo 'hello'?>" maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="body" form="usrform">Enter text here...</textarea></td>
 </tr>
  <tr>
  <td><input type="submit" value="Create Post"></td>
  </tr>
 </table>
</form>
</body>
</html>