<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["content"]) && !empty($_POST["content"])) {
        $content = $_POST["content"];
        $dir = 'output';
        $file = $dir . '/output.txt';

        // ディレクトリが存在しない場合は作成させるぞ！！！
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                $message = "ディレクトリの作成に失敗しました。";
            }
        }

        // ファイルに書き込みできるかな...？
        //できたどおおお
        if (empty($message)) {
            if (file_put_contents($file, $content . PHP_EOL, FILE_APPEND) !== false) {
                $message = "ファイルに書き込みました:　" . htmlspecialchars($content);
            } else {
                $message = "ファイルの書き込みに失敗しました。";
            }
        }
    } else {
        $message = "内容を入力してください。";
    }
} elseif ($_SERVER["REQUEST_METHOD"] != "GET") {
    $message = "無効なリクエストです。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フォーム送信</title>
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="content">内容:</label>
        <input type="text" id="content" name="content" required>
        <button type="submit">送信</button>
    </form>
</body>
</html>
