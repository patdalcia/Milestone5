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
  <?php 
require 'functions/myfuncs.php';

$db = dbConnect();
$query = "SELECT catID, name  FROM categories";
$result = $db->query($query) or die('Error AGAIANAINFNN :(');

echo "<select name='category' form='usrform'>";
echo "<option value=''>Select a Category</option>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['catID'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";

?>
  <input type="submit" value="Create Post">
</form>

<br>


</body>
</html>