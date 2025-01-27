<?php
setcookie("username","tarou",time()+3600);
if(isset($_COOKIE["username"])){
	echo "hello".$_COOKIE["username"]."さん!!!";
}
else{
	echo "クッキーが無いぞ!!!🍪もう一度アクセスしてみろ！！！";
}
?>
