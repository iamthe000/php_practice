<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    // 簡易的な認証処理（実際にはデータベースを使用）
    $valid_username = 'user';
    $valid_password = 'password';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user'] = $username;

        if ($remember) {
            setcookie('user', $username, time() + (86400 * 30), '/'); // 30日間
        }

        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'ユーザー名またはパスワードが間違っています。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>ユーザー名: <input type="text" name="username" required></label><br>
        <label>パスワード: <input type="password" name="password" required></label><br>
        <label><input type="checkbox" name="remember"> ログイン状態を保持する</label><br>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
