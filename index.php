<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

<style>
	ul.row {list-style: none;}

  img {width: 100%;height: auto;}

  button {border: none}

  li.product { padding: 19px;}
	a{color: #999; text-decoration: none}
  
  a.pg {
    border: solid 1px;
    padding: 0 6px;
}
</style>



<?php require 'header.php'; ?>
<?php require 'menu.php';?>

<div class = "result"></div>

<form action ="index.php" method="post">
  商品検索
  <input type="text" name="keyword">
  <input type="submit" value="検索">
</form>
<hr>

<article class="container">

<botton class="fas fa-th-large" 
        style="color: #09aaf3; font-size: 2em;"></botton>

<button class="fas fa-list" style="font-size: 2em;"></button>

<ul class="row">

<?php
//echo '<table>';
//echo '<th> 商品番号 </th> <th> 商品名 </th> <th> 価格 </th>';
require 'connect.php';

$item_count=6; //1pに6商品
if(isset($_REQUEST['page'])){
	$current_page = ($_REQUEST['page'] - 1) * $item_count ;
}else{
	$current_page = 0 ; //パラメータをつけないとエラーが出るのでなかったら 0 を与える を付け足します
}


// 商品一覧のページ
if (isset($_REQUEST['keyword'])) {
  // 検索条件が来てたらこっち
  
  $sql = $pdo -> prepare ('select * from product where name like ?');
  $sql -> execute ([ '%' .$_REQUEST ['keyword']. '%' ]);
} else {
  // 無条件ならこっち
  $sql=$pdo->prepare("SELECT * from product LIMIT ?, $item_count");
  $sql->execute([$current_page]);
}
foreach ($sql as $row) {
  $id=$row['id'];
  //echo '<tr>';
  //echo '<td>', $id, '</td>';
  //echo '<td>';
  //echo '<a href ="detail.php?id=', $id, '">', $row['name'], '</a>';
  //echo '</td>';
  //echo '<td>', $row['price'], '</td>';
  //echo '</tr>';
//}
//echo '</table>';
?>
              <!--↓ 1 これをさすためのクラスをつけるimgにcol-3-->
<li class="product col-4">  <!-- 2 li自身にrowクラス付与 col-4削除-->
                               <!-- 3 imgにcol-3クラスを付与-->
<?php
  if( file_exists("image/$row[id].jpg")){
?>

<img class="" src="image/<?=$id?>.jpg">
  <!-- 4 要素に隣接したpにcol-9を付与-->
  <?php
	} 

	if( !empty($row['images'])){
		$product_imgs = unserialize($row['images']);
		
?>		
			<img src="../admin/<?=$product_imgs[0]?>" alt="">
<?php	}?>

<p> 
<a href="detail.php?id=<?=$id?>">
				<span><?=$row['name']?></span>
				<br><span><?=$row['price']?></span>
			</a>
</p>

</li>
<?php } ?>  
</ul>  
<!-- ページャーをつけてみる -->

<?php
		$sql=$pdo->query( 
			"SELECT count(*) as ct FROM product");

				// 最初の1行だけ取り出す
		$count=$sql->fetch(); // → 14

				//1ページの件数で割って切り上げる
		$count=ceil($count['ct'] / $item_count); // → 3
				// 1から始めた方が効率がいい
		for( $i=1 ;$i <= $count ; $i++ ){
?>

 	<!-- <a class="pg" href="./?page=1">1</a> -->
 	<a class="pg" href="index.php?page=<?= $i ?>"><?= $i ?></a>
   <?php } ?>

   <!--<a class="pg" href="index.php?page=1">1</a>
<a class="pg" href="index.php?page=2">2</a>
<a class="pg" href="index.php?page=3">3</a>-->

</article>

<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script> 
<script>
	$('.fa-list').click(function(){
		$(this).css('color','#09aaf3').prev().css('color','#000');
    // 自分の色を変える             →自分の前の要素の色を変える
		$('li.product').addClass('row').removeClass('col-4');
    // ↑この要素に rowクラス付与 			→ col-4 削除
		$('li.product img').addClass('col-3');
    // 	↑この要素の子のimgに col-3 付与
		$('li.product img + p').addClass('col-9');
    // ↑この要素の子のimgに隣接した pにcol-9 付与
	});
  $('.fa-th-large').click(function(){
		$(this).css('color','#000').next().css('color','#09aaf3');
		$('li.product').addClass('col-4').removeClass('row');
 		$('li.product img').removeClass('col-3');
		$('li.product img + p').removeClass('col-9');
	});

</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<!-- 先にjqueryを読み込み -->
<script>
$(function(){
  $.ajax({
    url: '/nuts-shop/slick.html',
    /* スライダーのフルパス */
        dataType: 'html', //受け取るデータの型
    }).done(function(res){
        /* 通信成功時 */
        $('.result').html(res); //取得したHTMLを.resultに反映
    }).fail(function(res){
        /* 通信失敗時 */
        alert('通信失敗！');
    });
});
</script>

<?php require 'footer.php'; ?>

