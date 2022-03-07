<?php @session_start(); 
     //@はエラー制御演算子(Notice)ができなくなる
     ?>
<a href="index.php">HOME</a>

<?php 
  // var_dump(isset($_SESSION['customer'])); 

  if (isset($_SESSION['customer'])) {
	 //  ※ログインしてるか
?>

<a href="favorite-show.php">お気に入り</a>
<a href="history.php">購入履歴</a>
<a href="cart-show.php">カート</a>
<a href="purchase-input.php">購入</a>
<a href="logout-input.php">ログアウト</a>
<a href="customer-input.php">会員情報変更</a>

<?php }else{ 
  //ログインしてない ?>

<a href="login-input.php">ログイン</a>
<a href="newcustomer-input.php">新規会員登録</a>

<?php } ?>
<hr>

