<?php
function getUserList(){
    require_once 'functions/myfuncs.php';
    checkSessionTime();
    $db = dbConnect();
    $row = "";
    
    $query = "SELECT * FROM users";
    $results = $db->query($query) or die("Error: Could not connect get All users");
    
    foreach($results as $row){
        $ID = $row['ID'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $emailAddress = $row['emailAddress'];
        $userName = $row['userName'];
        $user_role = $row['user_role'];
        
        echo '
    <form action="" method="post" id="editform">
<table style="border: 0px;">
            
 <tr>
 <td>User ID: <input type="text" name="userID" value="'. $ID .'"  maxlength="30"></td>
 </tr>
 <tr>
 <td>First Name: <input type="text" name="firstName" value="' . $firstName . '"  maxlength="30"></td>
 </tr>
 <tr>
 <td>Last Name: <input type="text" name="lastName" value="' . $lastName . '"  maxlength="30"></td>
 </tr>
 <tr>
 <td>Email Address: <input type="text" name="emailAddress" value="' . $emailAddress . '"  maxlength="30"></td>
 </tr>
 <tr>
 <td>UserName: <input type="text" name="userName" value="' . $userName . '"  maxlength="30"></td>
 </tr>
 <tr>
 <td>User role: <input type="text" name="user_role" value="' . $user_role . '"  maxlength="30"></td>
 </tr>
  <tr>
  <td><input type="submit" name="editUser" value="Update user"></td>
  <td><input type="submit" name="deletePost" value="Delete user"></td>
  </tr>
 </table>
</form> ';
    }
}

if(isset($_POST[deletePost])){
    session_start();
    $_SESSION['userID'] = $_POST['userID'];
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['emailAddress'] = $_POST['emailAddress'];
    $_SESSION['userName'] = $_POST['userName'];
    $_SESSION['user_role'] = $_POST['user_role'];
    header("location: _editUsers.php");
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="styles/styles.css">
<title>Edit post</title>

</head>
<body>
<h2>Edit user page</h2>
<?php 
getUserList();
?>

</body>
</html>