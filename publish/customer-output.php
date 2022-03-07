<?php session_start();?>
<?php require 'header.php'; ?>
<?php require 'menu.php';?>
<?php
require 'connect.php';

if (isset($_SESSION['customer'])) {
  // //ログインしてたら = セッションがあれば
  $id=$_SESSION['customer'] ['id'];
  if ( $_REQUEST['login'] != $_SESSION['customer']['login']) {
    // ログイン名を変更しようとしてる
  $sql=$pdo->prepare('select count(*) 
                      from customer 
                      where login=? 
                      and id=?');  //自分のidではない
  $sql->execute([$id, $_REQUEST['login'],$_SESSION['customer']['id'] ]);
  
  if( $sql->fetch()['count(*)'] > 0 ){
    echo "ログイン名が使われてるので戻って入れ直してください";
    exit; // 中断
  }
} elseif( $_REQUEST['email'] != $_SESSION['customer']['email'] ) {
  // メールを変更しようとしている
    $sql = $pdo->prepare(
      'SELECT count(*) from customer 
      WHERE email = ?
      AND id != ? ' //自分のidではない
    );
    $sql->execute([ $_REQUEST['email'],  $_SESSION['customer']['id'] ]);
    if( $sql->fetch()['count(*)'] > 0 ){
      echo "そのメールアドレスは使われてます";
      exit; // 中断
    }
  }$sql=$pdo->prepare(
    '	UPDATE customer set 
          name=?, 
          address=? ,
          email=?,
          login=?,           
          password=? 
      WHERE id=?');
// 既存顧客情報の上書き

      $sql->execute([      // ?の数だけ書く
      $_REQUEST['name'],
      $_REQUEST['address'],
      $_REQUEST['email'],     //変更があってもなくても上書きする
      $_REQUEST['login'],       //変更があってもなくても上書きする
      password_hash($_REQUEST['password'],PASSWORD_DEFAULT),
      $id]);
      //ログインセッションに値を代入
    $_SESSION['customer']=[
      'id'=>$id,       //配列全体が上書きされるので入れる           
      'name'=>$_REQUEST['name'],
      'address'=>$_REQUEST['address'],
      'email'=>$_REQUEST['email'],
      'login'=>$_REQUEST['login'],
      ];
      echo 'お客様情報を更新しました。';
      //既存ユーザの処理は終わり
  }

      ?>
      <?php require "footer.php";?>