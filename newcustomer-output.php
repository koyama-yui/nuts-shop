<?php session_start();?>
<?php require 'header.php'; ?>
<?php require 'menu.php';?>
<?php
require 'connect.php';

$sql=$pdo->prepare('select count(*) 
                      from customer 
                      where login=?');
  $sql->execute([$_REQUEST['login']]);
  //  ※同じログイン名があるかないか(重複不許可のため)

// var_dump($sql->fetch()['count(*)']);
// exit;

  if ($sql->fetch()['count(*)']==0) {
    //作ろうとしてる(変更しようとしてる)ログイン名がない場合
    
    //同じメールの登録がないか
		$sql=$pdo->prepare(
			'SELECT count(*) from customer 
			 WHERE email = ?');
			$sql->execute([$_REQUEST['email']]);

      if ( $sql->fetch()['count(*)'] == 0 ) {
           $sql=$pdo->prepare('insert into customer values (null,?,?,?,?,?)');
        $sql->execute([
            $_REQUEST['name'],
            $_REQUEST['address'],
            $_REQUEST['email'],
            $_REQUEST['login'],
            password_hash($_REQUEST['password'],PASSWORD_DEFAULT)]);
            // パスワードハッシュ化
            echo '新規会員登録しました。';
        } else {
          echo 'このメールアドレスは登録済みです<br>
          <a href="">パスワードをお忘れですか?</a>';   
        }
      } else {
        echo 'ログイン名がすでに使用されていますので、変更してください。';
    }
        ?>
        <?php require "footer.php";?>