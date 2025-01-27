<?php
setcookie("username","tarou",time()+3600);//クッキーを作る部分
if(isset($_POST['delete_example'])){
  setcookie("username","",time()-3600);//一時間クッキーが保たれるらしいよ!秒単位で指定するらしい!
  echo "クッキーを食べたよ！もうクッキーは無いよ！";
}
elseif(isset($_COOKIE["username"])){
  echo "はろー！".$_COOKIE["username"]."さん!!!これがクッキーだよ!";
}
else{
  echo "ぼくちんのクッキーが無いぞ!!!🍪もう一度アクセスしてみろ！！！";
}
?>
<form method="post">
  <button type="submit" name="delete_example">削除</button>
</form><!--フォームだよ-->
