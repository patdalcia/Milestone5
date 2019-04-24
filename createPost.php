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
 	<td>Post category: <input type="text" name="category" size ='10' maxlength='30' /></td>
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
if(isset($_POST["categories"])){
    require 'functions/myfuncs.php';
    
    $db = dbConnect();
    
    echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">category Name</font> </td>
      </tr>';
    
    $query = 'SELECT name FROM categories';
    if ($result = $db->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["name"];
            echo '<tr>
                  <td>'.$field1name.'</td>
              </tr>';
        }
    }
    echo '</table>';
}
?>