
<?php 
require 'functions/myfuncs.php';
$db = dbConnect();

$query = "SELECT title FROM 'posts' WHERE ID =" . $_POST["selectedPost"];
$results = $db->query($query);

foreach($results as $row){
    echo $row["title"];
}
?>
