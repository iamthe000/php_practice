<?php
session_start();

// 仮のユーザーデータ（通常はデータベースから取得）
$valid_username = 'iamhoshi';
$valid_password = 'password123';

// ログイン処理
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ユーザー認証
    if ($username == $valid_username && $password == $valid_password) {
        // セッションにユーザー情報を保存
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    } else {
        $error = 'Invalid username or password';
    }
}

// ログアウト処理
if (isset($_GET['logout'])) {
    // セッションを破棄
    session_destroy();
    // セッション変数をすべて解除
    $_SESSION = array();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Session Example</title>
</head>
<body>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>You are logged in.</p>
        <a href="?logout">Logout</a>
    <?php else: ?>
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
    <?php endif; ?>
</body>
</html>