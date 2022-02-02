<?php
if (isset($_SESSION['customer'])){
?>
<table>
<th> 商品番号 </th> <th> 商品名 </th> <th> 価格 </th>
<?php
require 'connect.php';

$sql=$pdo->prepare('SELECT * FROM favorite, product where customer_id=? and product_id=product.id');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql as $row) {
  $id=$row['id'];
?>
  <tr>
  <td> <?=$id?> </td>
  <td> <a href ="detail.php?id=<?=$id?>"> <?=$row['name']?> </a> </td>
  <td> <?=$row['price']?> </td>
  <td> <a href ="favorite-delete.php?id=<?=$id?>"> 削除 </a> </td>
  </tr>
<?php  } ?>
</table>
<?php } else { 
   echo    'お気に入りを表示するにはログインしてください。';
} 
?>
