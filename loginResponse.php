<?php 

/*
 * 
 * this file redirects the user based on their login credentials. If logged in as Admin you are redirected to adminZone. If loggedin as user 
 * redirect to post creation page
 */

/*
if ( in_array($_SESSION['USERNAME'], ["Admin"])) {
    $_SESSION['message'] = "You are now logged in";
    // redirect to admin area
    header('location: https://patdalcia-milestone4.azurewebsites.net/adminZone.php');
    exit(0);
} else {
    $_SESSION['message'] = "You are now logged in";
    // redirect to public area
    header('location: https://patdalcia-milestone4.azurewebsites.net/createPost.html');
    exit(0);
}
*/
//header('location: https://www.google.com');

echo 'LOGGED INNNNN';
?>