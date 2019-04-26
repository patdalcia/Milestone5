
<?php 
function getTitle(){
require 'functions/myfuncs.php';
$db = dbConnect();


$query = "SELECT title FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
$postInfo = $db->query($query);
$info = $postInfo["title"];
$db->close();
echo $info;
}

function getContent(){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    
    
    $query = "SELECT content FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
    $postInfo = $db->query($query);
    
    
    $db->close();
   echo $postInfo["content"];
}

getTitle();
?>
