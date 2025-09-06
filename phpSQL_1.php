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
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "接続成功！";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
