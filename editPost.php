
<?php 
function getInfo(){
    
require 'functions/myfuncs.php';
$db = dbConnect();
$postID = $_POST["selectedPost"];

$query = "SELECT title FROM posts WHERE ID = $postID";
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
 <td>Title of Post: <input type="text" name="title" value="<?php echo $GLOBALS['title'];?>" height="30" maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea id="editTextArea" rows="4" cols="50" name="body" form="usrform"><script>add();</script></textarea></td>
 </tr>
  <tr>
  <td><input type="submit" value="Create Post"></td>
  </tr>
 </table>
</form>
</body>
<script>
function add() {
//We first get the current value of the textarea
var x = document.getElementById("editTextArea").value;
//Then we concatenate the string "content" onto it
document.getElementById("test").value = x+ <?php $GLOBALS['content'];?>;
}
</script>

</html>


