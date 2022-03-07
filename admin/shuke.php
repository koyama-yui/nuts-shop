<?php require "../header.php";?>
<?php require 'connect.php';?>

<style>
.row{
  display: flex;
}
aside{
  width:25%;
}
main{
  width:75%;
}
</style>

<div class="row">
  <aside>
    <?php require 'sidebar.php'; ?>
  </aside>
  <main>

<?php
/*
	購入履歴テーブルと顧客と購入明細と商品台帳を結合
	伝票idでグループ化して小計をグループ集計する｡
*/	

$sql = "SELECT product_id , name , sum(price*count) as shoke
FROM purchase_detail AS d
LEFT JOIN product AS p ON p.id=d.product_id
GROUP BY product_id
ORDER BY shoke DESC
LIMIT 50";

//$sql_purchase = $pdo->prepare( $sql );
	//$sql_purchase->execute();
	$sql_purchase = $pdo->query($sql); //?が無いならこれでもいい
?>

<h2>商品別売上集計</h2>
	<table>
		<tr>
			<th>商品番号</th><th>商品名</th><th>合計金額</th>
		</tr>

<?php	
	foreach ($sql_purchase as $row_detail) {
?>
		<tr>
			<td> <?=$row_detail['product_id']?> </td>
			<td> <?=$row_detail['name']?> </td>
			<td> <?=number_format($row_detail['shoke'])?> </td>
		</tr>

<?php } ?>
		
		</table>
	</main>
</div>
<?php require '../footer.php'; ?>
