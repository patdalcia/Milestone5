
<?php 
function getInfo($switch){
    
    if($switch = 1){
require 'functions/myfuncs.php';
$db = dbConnect();
$postID = $_POST["selectedPost"];

$query = "SELECT title FROM posts WHERE ID = $postID";
if ($result = $db->query($query)) {
        $row = $result->fetch_assoc();
       $field1name = $row["title"];
        $db->close();
        return $field1name;
}
$result->free();
$db->close();
    } else if ($switch = 2){
        require 'functions/myfuncs.php';
        $db = dbConnect();
        $postID = $_POST["selectedPost"];
        
        $query = "SELECT content FROM posts WHERE ID = $postID";
        if ($result = $db->query($query)) {
            $row = $result->fetch_assoc();
            $field1name = $row["title"];
            $db->close();
            return $field1name;
        }
        $result->free();
        $db->close();
    }
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
 <td>Title of Post: <input type="text" name="title" value="<?php echo getInfo(1);?>" maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="body" form="usrform"><?php echo getInfo(2);?></textarea></td>
 </tr>
  <tr>
  <td><input type="submit" value="Create Post"></td>
  </tr>
 </table>
</form>
</body>
</html>