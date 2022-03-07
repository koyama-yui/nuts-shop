<?php require "header.php";?>
<?php
// アップしたファイルが有れば
//複数アップのループ処理をここに追加
$count=count($_FILES["file"]["name"]);

for($i = 0; $i < $count; $i++){
	if (is_uploaded_file($_FILES['file']['tmp_name'][$i] )) {

		if (!file_exists('upload')) mkdir('upload');// なければフォルダを作る

		// ファイル形式の精査
		$mime=mime_content_type($_FILES['file']['tmp_name'][$i]);
		
		if($mime == 'image/jpeg'){  // jpg イメージなら
			 
					//移動先のパス
					$file = 'upload/'.basename($_FILES['file']['name'][$i]);

					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $file)) {
						echo $file, 'のアップロードに成功しました。';
						echo '<p><img src="', $file, '"></p>';
					} else {
						echo 'アップロードに失敗しました。';
					}
				


			}else{
				echo "アップできるファイルはjpgのみ｡";
			}
	} else {
		echo 'ファイルを選択してください。';
	}
}

  ?>
  <?php require "footer.php";?>