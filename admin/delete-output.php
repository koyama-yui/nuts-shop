<?php require "../header.php";?>
<?php
require 'connect.php';

$sql = $pdo->prepare('delete from product where id=?');
if ($sql->execute([$_REQUEST['id']])) {
  echo '削除に成功しました。';
  } else {
    echo '削除に失敗しました。';
  }
  ?>
  <?php require '../footer.php'; ?>