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
        $sql = "INSERT INTO users (name, age) VALUES (:name, :age)";// 1. SQL文の「型」を作る（:name と :age の枠を作っておく）
        $stmt = $pdo->prepare($sql);// 2. SQL文をPDOに渡して「準備」する（この時点ではまだ実行されない）prepareは「安全に処理できるように準備してね」ってお願いするイメージ
        $stmt->execute([':name' => $name, ':age' => $age]);// 3. 実際にデータを埋め込んで実行

        echo "保存しました！<br>";
    } else {
        echo "名前と年齢を入力してください。<br>";
    }
}

// ====== データの一覧表示（SELECT） ======
$sql = "SELECT * FROM users ORDER BY id DESC"; // 新しい順に並べる
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
?>

<!-- ====== 入力フォーム(html部分) ====== -->
<form method="post">
    名前: <input type="text" name="name"><br>
    年齢: <input type="number" name="age"><br>
    <button type="submit">保存</button>
</form>

<!-- ====== データ一覧表示 ====== -->
<h2>登録されたユーザー一覧</h2>
<?php if (count($results) > 0): ?>
    <ul>
        <?php foreach ($results as $row): ?>
            <li><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['age']) ?>歳)</li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>まだデータがありません。</p>
<?php endif; ?>
