<?php session_start();?>
<?php require 'header.php'; ?>
<?php require 'menu.php';?>
<?php
if (isset($_SESSION['customer'])) {
  require 'connect.php';
  $sql=$pdo->prepare('DELETE FROM favorite where customer_id=? and product_id=?');
  $sql->execute([$_SESSION['customer']['id'],$_REQUEST['id']]);
  echo 'お気に入りから商品を削除しました。';
  echo '<hr>';
  } else {
    echo 'お気に入りから商品を削除するには、ログインしてください。';
  }
  require 'favorite.php';
?>
<?php require 'footer.php'; ?>
