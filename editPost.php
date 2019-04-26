
<?php 
function getTitle(){
require 'functions/myfuncs.php';
$db = dbConnect();


$query = "SELECT title FROM 'posts' WHERE ID = " . $_POST["selectedPost"];;
$postInfo = $db->query($query);
$info = $postInfo["title"];
$db->close();
return $info;
}


  $yeet = getTitle();
  echo $yeet;
?>
