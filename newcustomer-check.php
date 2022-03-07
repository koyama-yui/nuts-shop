<?php
  require 'connect.php';

	$sql=$pdo->prepare(
		"SELECT count(*) from customer 
		where login=?"
	);
	$sql->execute([$_REQUEST['login']]);
 //  ※同じログイン名があるかないか(重複不許可のため)

	if ( $sql->fetch()['count(*)'] > 0 ) {
		//作ろうとしてるログイン名があればに変える
		 echo '⚠ログイン名がすでに使用されていますので、変更してください。';
	}
?>
<?php require 'footer.php'; ?>




