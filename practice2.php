<?php
echo'
<center>
<h1>PHP基礎</h1>
<form method="post">
    <input type="text" id="input" name="input">
    <button type="submit">go</button>
</form>
</center>
';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $inputPass = htmlspecialchars($_POST['input'],ENT_QUOTES,'UTF-8');
    if ($inputPass === "example") {
        echo "<center>hello login user</center>";
    }
    else {
        echo "<center>who are you</center>";
    }
}
?>
