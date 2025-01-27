<?php
setcookie("username","tarou",time()+3600);
if(isset($_POST['delete_example'])){
  setcookie("username","",time()-3600);
  echo "クッキーを食べたよ";
}
elseif(isset($_COOKIE["username"])){
  echo "はろー！".$_COOKIE["username"]."さん!!!";
}
else{
  echo "クッキーが無いぞ!!!🍪もう一度アクセスしてみろ！！！";
}
?>
<form method="post"><button type="submit" name="delete_example">削除</button></form>
