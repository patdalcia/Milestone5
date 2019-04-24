
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>My Blog Page</title>

</head>
<body>
<h2>Main Blog index</h2>

<form action="" method="post" id="blogIndex">
<table style="border: 0px;"> 
<tr> 
          <td> <font face="Arial">Create Post</font> </td> 
          <td> <font face="Arial">View all posts</font> </td> 
          <td> <font face="Arial">View all posts for specific category</font> </td> 
          <td> <font face="Arial">View all categories</font> </td> 
          <td> <font face="Arial">Edit your posts</font> </td> 
      </tr>
      <tr>
 		  <td> <input type="submit" name="create"value="Create a Post"> </td>
 		  <td> <input type="submit" name="VallPosts"value="View all posts"> </td>
 		  <td> <input type="submit" name="VpostsByCategories"value="View all posts by categories"> </td>
 		  <td> <input type="submit" name="Vcategories"value="View all categories"> </td>
 		  <td> <input type="submit" name="editPosts"value="Edit your posts"> </td>
 	 </tr>	  
 </table>
</form>

<br>


</body>
</html>


<?php
if(isset($_POST['create'])) {
  echo '<table style="border: 0px;"> 
	<td>Create was clicked</td>
</table>';
} else if(isset($_POST['VallPosts'])){
    echo 'VallPosts was clicked';
} else if (isset($_POST['VpostsByCategories'])){
    echo 'VpostsByCategories was clicked';
} else if (isset($_POST['Vcategories'])){
    echo 'Vcategories was clicked';
} else if (isset($_POST['editPosts'])){
    echo 'Edit posts was clicked';
}

?>
