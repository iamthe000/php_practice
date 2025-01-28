<?php
session_start();
$_SESSION["変数名"]="代入する値";//これが書式らしいよ！！！すごいね
$_SESSION["user"]="tester";
$age=$_SESSION["age"]=20;
$sid=session_id();//セッションidを取得できるよ！！
echo "セッションidは".$sid."<br>";
echo "年齢は".$age."です！！";
/*これセッションにする意味あった？後で分かるのかな...？*/
?>
