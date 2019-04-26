
<?php 
function getTitle(){
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

function getContent(){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    $postID = $_POST["selectedPost"];
    
    $query = "SELECT content FROM posts WHERE ID = $postID";
    if ($result = $db->query($query)) {
        $row = $result->fetch_assoc();
        $field1name = $row["content"];
        $db->close();
        return $field1name;
    }
    $result->free();
    $db->close();
}


$info = getTitle();
echo $info["title"];

?>
