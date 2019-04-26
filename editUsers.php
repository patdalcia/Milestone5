<?php 
require 'functions/myfuncs.php';
checkSessionTime();
session_start();
$db = dbConnect();

$query = "SELECT ID, user_id, title, content, date_created FROM `posts` ";
$result = $db->query($query) or die('Error inside utility.php');

echo '
        <form action="_editUsers.php" method="post"> 
        <table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Title of post</font> </td>
          <td> <font face="Arial">User ID</font> </td>
          <td> <font face="Arial">Post ID</font> </td>
          <td> <font face="Arial">Body of Post</font> </td>
          <td> <font face="Arial">Date post was created</font> </td>
      </tr>';


if ($result = $db->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["title"];
        $field2name = $row["user_id"];
        $field3name = $row["ID"];
        $field4name = $row["content"];
        $field5name = $row["date_created"];
        
        
        echo '<tr>
                  <td>'.$field1name.' </td>
                  <td>'.$field2name.'</td>
                  <td>'.$field3name.'</td>
                  <td>'.$field4name.'</td>
                  <td>'.$field5name.'</td>
                  <td> <input type="submit" name="editUser"value="Edit this user"> </td>
                  <td> <input type="submit" name="deleteUser"value="Delete this user"> </td>
              </tr>';
    }
    
    echo '
         </table>
         </form>
         ';
    
    $result->free();
    $db->close();
} 

if(isset($_POST['deleteUser'])){
    header("location: myAdmin.php");
}
?>