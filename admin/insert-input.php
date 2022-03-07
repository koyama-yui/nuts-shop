<?php
session_start();
require "../header.php";?>

<div class="container">
  <aside>
    <?php require 'sidebar.php'; ?>
  </aside>
  <main>

<p> 商品を追加します。</p>
<form action="insert-output.php" method="post" 
      enctype="multipart/form-data">

  <p>商品画像:
    <input type="file" multiple="multiple" name="file[]"></p>
  
  <p>商品名:<input type="text" name="name">
  <p>価格  :<input type="text" name="price">

  <input type="submit" value="追加">

</form>
</main>  
</div>

<?php require "../footer.php";?>