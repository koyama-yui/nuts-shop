<?php require "../header.php";?>

<div class="container">
  <aside>
    <?php require 'sidebar.php'; ?>
  </aside>
  <main>

<table>
  <tr>
    <th> 商品番号 </th>
    <th> 商品名 </th>
    <th> 価格 </th> 
  <tr>
    
<?php
require 'connect.php';

foreach ($pdo->query('select * from product') as $row) {
  echo '<tr>';
  echo '<td>', $row['id'], '</td>';
  echo '<td>', $row['name'], '</td>';
  echo '<td>', $row['price'], '</td>';
  echo '<td>';
  echo '<a href="delete-output.php?id=', $row['id'], '"
        onclick="return del()"> 削除 </a>';
  echo '</td>';
  echo '</tr>';
  echo "\n";
}
?>
</table>
</main>  
</div>

<script>
function del(){
  //任意のタイミングで実行したいから囲む
  //複数の箇所から呼び出して同じ処理をしたいから
  //ネイティブな(組み込み)関数の引数にするため
if(!confirm('削除していいですか')){
document.bgColor="green";  //この行を実行
return false; //リンク先へ行かない
}
}
</script>
<?php require "../footer.php";?>