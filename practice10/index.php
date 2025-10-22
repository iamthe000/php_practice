<?php
$accountsFile = __DIR__ . '/accounts.json';
if (!file_exists($accountsFile)) {
    file_put_contents($accountsFile, json_encode([]));
}
$accounts = json_decode(file_get_contents($accountsFile), true);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (isset($_POST['register'])) {
        // 新規アカウント作成
        $exists = false;
        foreach ($accounts as $acc) {
            if ($acc['username'] === $username) {
                $exists = true;
                break;
            }
        }
        if ($exists) {
            $message = 'このユーザー名は既に使われています。';
        } elseif ($username === '' || $password === '') {
            $message = 'ユーザー名とパスワードを入力してください。';
        } else {
            $accounts[] = ['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)];
            file_put_contents($accountsFile, json_encode($accounts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            $message = 'アカウントを作成しました。ログインしてください。';
        }
    } elseif (isset($_POST['login'])) {
        // ログイン
        $found = false;
        foreach ($accounts as $acc) {
            if ($acc['username'] === $username && password_verify($password, $acc['password'])) {
                $found = true;
                break;
            }
        }
        if ($found) {
            $message = 'ログイン成功！ようこそ、' . htmlspecialchars($username) . 'さん。';
        } else {
            $message = 'ユーザー名またはパスワードが違います。';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>account for JSON</title>
</head>
<body>
    <h2>ログイン / 新規アカウント作成</h2>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>ユーザー名: <input type="text" name="username" required></label><br>
        <label>パスワード: <input type="password" name="password" required></label><br>
        <button type="submit" name="login">ログイン</button>
        <button type="submit" name="register">新規アカウント作成</button>
    </form>
</body>
</html>
