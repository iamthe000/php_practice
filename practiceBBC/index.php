<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["content"]) && !empty($_POST["content"])) {
        $content = $_POST["content"];
        $user = $_POST["user"];
        $dir = 'output';
        $file = $dir . '/output.txt';

        // ディレクトリが存在しない場合は作成させる
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                $message = "ディレクトリの作成に失敗しました。";
            }
        }


        if (empty($message)) {
            if (file_put_contents($file, $user . ": " . $content . PHP_EOL, FILE_APPEND) !== false) {
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        .output {
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
        .output-content {
            width: 500px;
            white-space: pre-wrap;
            background-color: #f9f9f9;
            padding: 5px;
            border: 1px solid #ddd;
        }
    </style>
    <meta charset="UTF-8">
    <title>習作-掲示板</title>
</head>
<body>
    <h1>習作-掲示板</h1>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="content">内容:</label>
        <input type="text" id="content" name="content" required>
        <label for="user">名前:</label>
        <input type="text" id="user" name="user" required>
        <button type="submit">送信</button>
    </form>
    <section class="output">
        <h2>投稿一覧</h2>
        <div class="output-content">
        <?php echo nl2br(htmlspecialchars(file_get_contents('output/output.txt'))); ?>
        </div>
    </section>
</body>
</html>
