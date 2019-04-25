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
<table style="border: 0px;"> 

 <tr> 
 <td>Title of Post: <input type="text" name="title" maxlength="30"></td>
 </tr>
 <tr>
 <td>Body of post: <textarea rows="4" cols="50" name="body" form="usrform">Enter text here...</textarea></td>
 </tr>
  <tr> 
 	<td><?php selectBox()?></td>
  </tr>
  <tr>
  <td><input type="submit" value="Create Post"></td>
  </tr>
 </table>
</form>

<form action="" method="post" id="showCategories">
<table style="border: 0px;">
<tr>
<td> 		</td>
<td><input type="submit" name="categories"value="View Category List"></td>
</tr>

</table>
</form>
<br>


</body>
</html>
<?php 
function selectBox(){
require 'functions/myfuncs.php';
$db = dbConnect();
$catInfo = "";
$field = '';
$field1 = '';

$query = "SELECT name, catID FROM `categories` ";
$catInfo = $db->query($query) or die('Error AGAIANAINFNN :(');


echo '
            <select name="Cat">
            <option value="0">Select a category</option>';


foreach($catInfo as $row) {
    
    $field = $row['catID'];
    $field1 = $row['name'];
    //echo '<option value="' . $field . '"name="' . $field1 . '>' . $field1 . '</option>';
    echo '<option value="'. $field .'">'. $field1  .'</option>';
    
}
//echo '<option value="'.$row["catID"].'">'.$row["name"].'</option>';


echo '
                </select>
                </form>';

$db->close();

}

?>
