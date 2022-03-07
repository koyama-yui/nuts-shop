<?php session_start();?>
<?php require 'header.php'; ?>
<?php require 'menu.php';?>

<style>
	input[type="number"]::-webkit-outer-spin-button,
	input[type="number"]::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	}
	/* Firefox */
	input[type="number"] {
	  -moz-appearance: textfield;
			}
	.result{color: #a44; display: block;} /*ブロック要素になる,全幅*/
</style>

<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

<form action="newcustomer-output.php" method="post" class="h-adr">

<table>
<tr><td> お名前(*) </td><td>
<input type="text" name="name" required>
</td></tr>

<tr><td> 郵便番号</td><td>
<span class="p-country-name" style="display:none;">Japan</span>
      <input type="text" class="p-postal-code" size="8" maxlength="8" name="zip">
</td></tr>

<tr><td> ご住所(*) </td><td>
<input type="text" name="address"
class="p-region p-locality p-street-address p-extended-address"required>
</td></tr>

<tr><td> メールアドレス(*) </td><td>
<input type="email" name="email" required>
</td></tr>

<tr><td> ログイン名(*) </td><td>
<input type="text" name="login" autocomplete="off" required>
<b class="result"><!--警告を埋め込む所--></b>
</td></tr>

<tr><td> パスワード(*) </td><td>
<input type="password" name="password" required>
</td></tr>
</table>

<input type="submit" value="確定">
</form>

<?php require 'footer.php'; ?>



<!--<div class = "result"></div>-->

<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<!-- 先にjqueryを読み込み -->
<script>

$(function(){
  //.sampleをクリックしてajax通信を行う
$('[name="login"]').change(function(){
        var login = $(this).val();

        $.ajax({
          url: '/nuts-shop/newcustomer-check.php',
          type: 'GET',
            dataType: 'html', //受け取るデータの型
            data: {login:login}

        }).done(function(res){
            /* 通信成功時 */
            $('.result').html(res); //取得したHTMLを.resultに反映
            
        }).fail(function(res){
            /* 通信失敗時 */
            alert('通信失敗！');
                    
        });
    });
});
</script>