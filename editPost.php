
<?php 
require 'functions/myfuncs.php';
$db = dbConnect();

$query = "SELECT title FROM 'posts' WHERE ID =" . $_POST["selectedPost"];
$results = $db->query($query);

echo $results["title"] . $results["content"];
?>
