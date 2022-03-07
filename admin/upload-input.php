<?php require "../header.php";?>
<p>アップロードするファイルを指定してください。</p>
<form action="upload-output.php" method="post"
      enctype="multipart/form-data">

<p><input type="file" multiple="multiple" name="file[]"></p>
                  <!--  ↑ 複数枚アップロードするため   ↑ -->
<p><input type="submit" value="アップロード"></p>
</form>
<?php require "../footer.php";?>