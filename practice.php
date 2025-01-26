<?php
// 配列の定義
$a = [8, 12, 21];  
$Test = ["world", "user"];
$today = date("Y-m-d H:i:s");

echo "<h1>Hello PHP!</h1>";
echo "<h3>hello," . $Test[1] . "!<br></h3>";
echo "朝食は" . $a[0] . "時です<br>";
echo "昼食は" . $a[1] . "時です<br>";
echo "夕飯は" . $a[2] . "時です<br>";
echo "現在は" . $today . "です!<br>";
echo "<h2>Hello," . $Test[0] . "!</h2><br>";
?>

<form method="post">
    <input name="example" type="text">
    <input type="submit">
</form>

<?php
// フォームが送信されている場合、送信された内容を表示
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $example = $_POST['example'];  // フォームの内容を取得
    echo "<h3>入力された内容: " . htmlspecialchars($example) . "</h3>";  // 入力内容を表示
    if($example == "test"){
        echo "testと入力されました";
    }
    elseif($example == "example"){
        echo "貴様！これが例題だと気づいているな！！";
    }
    else{
        echo "else";
    }
}
?>
