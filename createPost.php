<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>My Blog Page</title>

</head>
<body>
<h2>My Blog Page</h2>

<form action="postHandler.php" method="post" id="usrform">
  Title of Post: <input type="text" name="title" maxlength="30">
  <textarea rows="4" cols="50" name="body" form="usrform">
   Enter text here...</textarea>
   <select name='category'>
   
   </select>
  <input type="submit" value="Create Post">
</form>
<?php 
/*
require 'functions/myfuncs.php';

$db = dbConnect();
$query = "SELECT catID, name  FROM categories";
$result = $db->query($query) or die('Error AGAIANAINFNN :(');

echo "<select name='PcID'>";
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['PcID'] . "'>" . $row['PcID'] . "</option>";
}
echo "</select>";
*/
?>
<br>


</body>
</html>