
<?php 
require 'functions/myfuncs.php';
$db = dbConnect();

echo '<table border="0" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Post name</font> </td>
      </tr>';

$query = "SELECT title FROM posts";
if ($result = $db->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["title"];
        echo '<tr>
                  <td>'.$field1name.'</td>
              </tr>';
    }
}
echo '</table>';
$result->free();
$db->close();
?>
