<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $input_name = htmlspecialchars($_POST['input'],ENT_QUOTES,'UTF-8');
  setcookie("username",$input_name,time()+3600);//クッキーを作る部分
}
?>
<form method="post">
    <input type="text" id="input" name="input">
    <button type="submit">go</button>
</form>
<?php
if (isset($_COOKIE['username'])) {
  $input_name = htmlspecialchars($_POST['input'],ENT_QUOTES,'UTF-8');
echo "hello".$_COOKIE['username']."!<br>";
}
else {
echo "<center>who are you</center>";
}
?>
</center>
