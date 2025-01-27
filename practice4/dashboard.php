<?php
session_start();

if (!isset($_SESSION['user'])) {
    // クッキーが存在する場合、セッションを復元
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    } else {
        header('Location: login.php');
        exit;
    }
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ダッシュボード</title>
</head>
<body>
    <h1>ようこそ、<?= htmlspecialchars($user, ENT_QUOTES) ?>さん！</h1>
    <a href="logout.php">ログアウト</a>
</body>
</html>
