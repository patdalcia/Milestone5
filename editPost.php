
<?php 
function getTitle(){
require 'functions/myfuncs.php';
$db = dbConnect();
$postID = $_POST["selectedPost"];
echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Post name</font> </td>
      </tr>';

$query = "SELECT title FROM posts WHERE ID = $postID";
if ($result = $db->query($query)) {
        $row = $result->fetch_assoc();
        $field1name = $row["title"];
        $db->close();
        return $field1name;
}
$result->free();
$db->close();
}


echo "The title is: " . getTitle();;
?>
