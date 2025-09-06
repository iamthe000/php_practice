<?php
$host = 'localhost';  // データベースサーバー
$db   = 'testdb';     // データベース名
$user = 'root';       // ユーザー名
$pass = '';           // パスワード
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // エラーを例外として扱う
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // 連想配列で取得
    PDO::ATTR_EMULATE_PREPARES   => false,                  // 本物のプリペアドステートメント
//「::」 は クラス定数・静的メソッド・静的プロパティにアクセスするものらしい
//よくみる「=>」はキーと値を結びるける連想配列ってやつらしい。
  //「このキーを作るよ。初期値はこれだけど後で変えることもできるよ」ってことだと思う
  //キーは動作ではなく、文字列や数字などの値を設定する ってことよね...？
  //$a = "test"だと $a でしか取り出せず、$a => "test" だと$array['a']でしか取り出せない
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "接続成功！";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


//データの作成

$sql = "INSERT INTO users (name, age) VALUES (:name, :age)";
$stmt = $pdo->prepare($sql);
//「->」は保存とかじゃなくて、呼び出し、それに[$a="test"]とかで設定した普通の変数を呼び出すのに使う。この場合は$stmt = $pdo->prepare($sql);だと、$stmtの関数に$pdoのprepareってやつを実行した結果を設定するってっこと
$stmt->execute([
    ':name' => '太郎',
    ':age' => 20
]);
echo "データを追加しました";
?>
