<?php session_start();?>
<?php require 'header.php'; ?>
<?php require 'menu.php';?>
<?php
unset($_SESSION['customer']);
require 'connect.php';

$sql=$pdo->prepare('select * from customer where login=?');
$sql->execute([$_REQUEST['login']]);

foreach ($sql as $row) {
  //$row は行データ loginで選択したので1行しかない
if (password_verify($_REQUEST['password']
                   ,$row['password'])) {
                        // ↑ データベースのフィールド名 $y$p...ハッシュ値
                        //trueならセッションに入れる(ログインしたことになる)
                        
                        $_SESSION['customer']=[
                          'id'=>$row['id'], 
                        'name'=>$row['name'],
                        'address'=>$row['address'],  
                        'email'=>$row['email'], 
                        'login'=>$row['login'],  //パスワードは消してください
                      ];
} // if end
} // foreach end

if (isset($_SESSION['customer'])) {
  echo 'いらっしゃいませ、', $_SESSION['customer']['name'], 'さん。
                  <meta http-equiv="refresh" content="1;URL=index.php">';
} else {
  echo 'ログイン名またはパスワードが違います。';
}
?>
<?php require "footer.php";?>
