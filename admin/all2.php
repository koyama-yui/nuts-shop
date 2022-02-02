<?php require "../header.php";?>
<?php
require 'connect.php';

foreach ($pdo -> query ('select * from product') as $row) {
  echo '<p>';
  echo $row ['id'], ':';
  echo $row ['name'], ':';
  echo $row ['price'];
  echo '</p>';
}
?>
<?php require "../footer.php";?>