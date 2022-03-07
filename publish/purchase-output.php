<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
require 'connect.php';

$purchase_id=1;
// A_I と同じことをやってる
foreach ($pdo->query('select max(id) from purchase') as $row) {
	$purchase_id=$row['max(id)']+1;
}

try{
	//トランザクションの開始
	$pdo->beginTransaction();

$sql=$pdo->prepare(
	'INSERT into purchase(id, customer_id ) values(?,?)'
);	                      // このフィールド名が必要 ↑

$success = $sql->execute([
	$purchase_id, 							// 1
	$_SESSION['customer']['id'] // 2 
]);

if ($success) {
//$purchase_id=$sql->lastInsertId(); A_Iで登録されたidの取得

/*      一行実行のINSERT文は非効率なので1回のINSERTで複数行の注文をいれたい
    valuesの後ろの()をカンマ区切りでつなげて作ることができる
*/

	foreach ($_SESSION['product'] as $product_id=>$product) {
		$sql=$pdo->prepare(
			'INSERT into purchase_detail values(?,?,?)'
		);
		$sql->execute([
			$purchase_id, 
			$product_id, 
			$product['count']]
		);
	}
	$pdo->commit();  //commitでトランザクションが完了
	// カートをカラにする
	unset($_SESSION['product']);
	echo '購入手続きが完了しました。ありがとうございます。';

} //if END, else はいらない
//} else {
	//echo '購入手続き中にエラーが発生しました。申し訳ございません。';

} catch(PDOException $e) {
  echo $e->getMessage();  // (8) エラーメッセージを出力
	echo '購入手続き中にエラーが発生しました。申し訳ございません。';
  $pdo->rollBack();  // (9) ロールバック

}
?>
<?php require 'footer.php'; ?>
