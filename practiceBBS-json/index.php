<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!is_dir('messages')) {
        mkdir('messages');
    }

    $name = $_POST['name'];
    $message = $_POST['message'];

    // 既存のメッセージを読み込む
    $existingMessages = [];
    if (file_exists('messages/messages.json')) {
        $jsonContent = file_get_contents('messages/messages.json');
        // JSONが空でないか、または不正な形式でないか確認
        if ($jsonContent !== false && !empty($jsonContent)) {
            $decoded = json_decode($jsonContent, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // デコードされたデータが配列でない場合（例: 以前のコードのように単一のオブジェクトが保存されていた場合）
                // 新しい構造に合わせて配列として扱う
                if (is_array($decoded) && array_keys($decoded) === range(0, count($decoded) - 1)) {
                    $existingMessages = $decoded;
                } else if (is_array($decoded)) {
                    // 単一のオブジェクトとして保存されていた場合、それを新しい配列の要素として扱う
                    $existingMessages[] = $decoded;
                }
            }
        }
    }

    // 新しいメッセージを作成
    $newMessage = [
        'name' => $name,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s') // 投稿日時を追加すると便利です
    ];

    // 新しいメッセージを既存のメッセージ配列に追加
    $existingMessages[] = $newMessage;

    // 更新された配列をJSONとして保存
    // JSON_PRETTY_PRINT を追加すると、ファイルが見やすくなります
    file_put_contents('messages/messages.json', json_encode($existingMessages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>習作-掲示板-forJSON</title>
        <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        input{
            width: 200px;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            width: 200px;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            margin-bottom: 10px; /* 各投稿の間隔を空ける */
        }
        .message-header {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .message-body {
            margin-top: 0;
            padding-left: 10px;
            border-left: 2px solid #eee;
        }
    </style>
    </head>
    <body>
        <h1>掲示板</h1>
        <form method="post" action="">
            <label for="name">名前:</label><br>
            <input placeholder="名前" type="text" id="name" name="name" required><br>
            <label for="message">メッセージ:</label><br>
            <textarea id="message" name="message" rows="4" cols="40" placeholder="メッセージ" required></textarea><br>
            <input type="submit" value="送信">
        </form>
        <section class="output">
            <?php
            if (file_exists('messages/messages.json')) {
                $jsonContent = file_get_contents('messages/messages.json');
                $messages = [];
                if ($jsonContent !== false && !empty($jsonContent)) {
                    $decoded = json_decode($jsonContent, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                         // JSON_PRETTY_PRINT を使用していても、デコード後に数値キーの配列になることを確認
                        if (array_keys($decoded) === range(0, count($decoded) - 1)) {
                            $messages = $decoded;
                        } else {
                            // 以前の単一オブジェクト形式の場合、配列に変換
                            $messages[] = $decoded;
                        }
                    }
                }

                if (!empty($messages)) {
                    echo '<h2>投稿一覧</h2>';
                    // 最新の投稿が上に表示されるように逆順にする
                    $messages = array_reverse($messages);
                    foreach ($messages as $msg) {
                        echo '<div class="output-content">';
                        echo '<div class="message-header">';
                        echo htmlspecialchars($msg['name']) . ' (' . (isset($msg['timestamp']) ? htmlspecialchars($msg['timestamp']) : '日時不明') . ')';
                        echo '</div>';
                        echo '<div class="message-body">';
                        echo nl2br(htmlspecialchars($msg['message'])); // 改行を反映させる
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>まだ投稿がありません。</p>';
                }
            } else {
                echo '<p>まだ投稿がありません。</p>';
            }
            ?>
        </section>
    </body>
</html>
