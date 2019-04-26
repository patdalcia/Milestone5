
<?PHP
function renderForm($id, $firstname, $lastname, $error)

{
    
    ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<input type="text" name="title" value="<?php echo $title; ?>"/>

<div>

<p><strong>Body</strong> <?php echo $content; ?></p>


<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}

?>

<?php renderForm($id, $firstname, $lastname, $error)?>
