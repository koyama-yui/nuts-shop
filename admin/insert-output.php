<?php
session_start();
require "../header.php";?>
<?php
require 'connect.php';

// アップしたファイルが有れば
//複数アップのループ処理をここに追加
$count = count($_FILES["file"]["name"]);
$upfiles = [];      // カラの配列を作っておく 初期化
for($i = 0; $i < $count; $i++){
	if (is_uploaded_file($_FILES['file']['tmp_name'][$i] )) {

		if (!file_exists('upload')) mkdir('upload');
		// なければフォルダを作る

		// ファイル形式の精査
		$mime = mime_content_type($_FILES['file']['tmp_name'][$i]);
		
		if($mime == 'image/jpeg'){  // jpg イメージなら
			 
					//移動先のパス
					$file = 'upload/'.basename($_FILES['file']['name'][$i]);

					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $file)) {
						echo $file, 'のアップロードに成功しました。';
						echo '<p><img src="', $file, '"></p>';

							$upfiles[] = $file; //ファイルパスの配列を作成
						

					} else {
						echo 'アップロードに失敗しました。';
					}
							}else{
				echo "アップできるファイルはjpgのみ｡";
			}
	} else {
		echo 'ファイルを選択してください。';
	}
} //for
$upfile = serialize($upfiles); // 配列をシリアライズ
//ここまでペースト

$sql = $pdo->prepare('insert into product values(null, ?, ?,?)');
if ($sql->execute([$_REQUEST['name'],
                   $_REQUEST['price'],
									 $upfile
									 ])) {
	echo '追加に成功しました。';
} else {
	echo '追加に失敗しました。';
}
?>
<?php require '../footer.php'; ?>