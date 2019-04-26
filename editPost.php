
<?php 
function getTitle(){
require 'functions/myfuncs.php';
$db = dbConnect();


$query = "SELECT title FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
$postInfo = $db->query($query);

$db->close();
return $postInfo["title"];
}

function getContent(){
    require 'functions/myfuncs.php';
    $db = dbConnect();
    
    
    $query = "SELECT content FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
    $postInfo = $db->query($query);
    
    
    $db->close();
    return $postInfo["content"];
}

echo getTitle();
echo getContent();
?>
