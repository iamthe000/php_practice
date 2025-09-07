<?php
// ====== DB接続設定 ======
$host = 'localhost';  // データベースサーバー
$db   = 'testdb';     // データベース名
$user = 'root';       // ユーザー名
$pass = '';           // パスワード
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // エラーを例外で投げる
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // fetchした結果を連想配列で返す
    PDO::ATTR_EMULATE_PREPARES   => false,                  // 本物のプリペアドステートメントを使う
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("接続失敗: " . $e->getMessage());
}

// ====== フォーム送信されたときの処理 ======
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $age  = $_POST['age'] ?? '';

/*「??」について
もし左の値が存在すればそれ、なければ右の値 という意味

例:
$a = null;
$b = $a ?? 'デフォルト';
echo $b; // $aがnullなので「デフォルト」と表示される
*/
  
    if ($name !== '' && $age !== '') {
        $sql = "INSERT INTO users (name, age) VALUES (:name, :age)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name, ':age' => $age]);

        echo "保存しました！<br>";
    } else {
        echo "名前と年齢を入力してください。<br>";
    }
}
?>

<!-- ====== 入力フォーム(html部分) ====== -->
<form method="post">
    名前: <input type="text" name="name"><br>
    年齢: <input type="number" name="age"><br>
    <button type="submit">保存</button>
</form>
