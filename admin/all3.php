<?php require "../header.php";?>
<?php
require 'connect.php';

foreach ($pdo -> query ('select * from product') as $row) {
  echo "<p> $row[id] : $row[name] : $row[price] </p>";
}
?>
<?php require "../footer.php";?>