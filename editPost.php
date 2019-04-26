
<?php 
require 'functions/myfuncs.php';
$db = dbConnect();
$postID = $_POST["selectedPost"];
$query = "SELECT title FROM 'posts' WHERE ID = $postID";
$results = $db->query($query);

foreach($results as $row){
    echo $row["title"];
}
?>
