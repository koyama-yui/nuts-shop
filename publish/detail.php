<?php require 'header.php'; ?>
<?php require 'menu.php';?>
<?php
require 'connect.php';

$sql=$pdo->prepare('SELECT * FROM product where id=?');
$sql->execute([$_REQUEST['id']]);
//var_dump($sql);//配列ではない,特殊なオブジェクト 表の格好=2次元配列
foreach ($sql as $row) { // 表から行を取り出してる
   // $sqlは1行しか無いが,2次元の格好をしてる
    // ループは1回しかしない
   // row '行' 列 col 
    // 3	ひまわりの種	210 
?>
<p>
<?php
//ここでファイルの存在を調べる image/3.jpgあれば表示する
if( file_exists("image/$row[id].jpg")){
?>
   <img src="image/<?=$row['id']?>.jpg">
<?php
}
        /* ここでDBから取り出したシリアライズがあるかどうか調べる 
           あればアンシリアライズして,配列を回して画像を表示する 
           TOPページも同じ(全部ではなく最初の1枚だけ)  */
if( !empty($row['images'])){
	$product_imgs = unserialize($row['images']);
	foreach( $product_imgs as $product_img){
?>
		<img src="../admin/<?=$product_img?>" alt=""
		   style="width:200px;height:auto">

<?php			
} //foreach 
} //if 
?>
</p>

<form action ="cart-insert.php" method="post">
<p> 商品番号:<?=$row['id']?></p>
<p> 商品名:<?=$row['name']?></p>
<p> 価格:<?=$row['price']?></p>
<p> 個数: <select name="count">

<?php
for ($i=1; $i<=10; $i++) {
   echo "<option value='$i'> $i</option>";
} 
?>
</select> </p>
<!-- 隠しフィールド -->
<input type="hidden" name="id" value="<?=$row['id']?>">
<input type="hidden" name="name" value="<?=$row['name']?>">
<input type="hidden" name="price" value="<?=$row['price']?>">
<p> <input type="submit" value="カートに追加"> </p>
</form>
<p>

<?php
// ログインしてたら
if( isset( $_SESSION['customer']['id'] ) ){
// この商品がfavoriteテーブルにあるか調べる
	$sql =$pdo->query(
		"SELECT count(*) FROM favorite 
		WHERE customer_id = {$_SESSION['customer']['id']}
		AND product_id = $_REQUEST[id]
		");
		$count = $sql->fetch();
		// var_dump( $count );
		if( $count["count(*)"] === 0 ){ 
?>		
<a href="favorite-insert.php?id=<?= $row['id']?>">☆お気に入りに追加</a></p>

<?php } else { ?>
<a href="favorite-delete.php?id=<?= $row['id']?>">🌟お気に入り解除</a></p>
      
<?php } // if end
}       // if end ログインしていない
}       //foreach end 
?>
<?php require 'footer.php'; ?>