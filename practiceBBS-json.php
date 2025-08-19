<?php
$message='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!is_dir('messages')){
        mkdir('messages');
    }
    $name = $_POST['name'];
    $message = $_POST['message'];
    $data = [
        'name' => $name,
        'message' => $message
    ];
    file_put_contents('messages/messages.json', json_encode($data, JSON_UNESCAPED_UNICODE));
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
        }
    </style>
    </head>
    <body>
        <h1>掲示板</h1>
        <form method="post" action="">
            <label for="message">メッセージ:</label><br>
            <input placeholder="名前" type="text" id="name" name="name"><br>
            <textarea id="message" name="message" rows="4" cols="40" placeholder="メッセージ"></textarea><br>
            <input type="submit" value="送信">
        </form>
        <section class="output">
            <?php
            if (file_exists('messages/messages.json')) {
                $messages = json_decode(file_get_contents('messages/messages.json'), true);
                echo '<h2>投稿一覧</h2>';
                echo '<div class="output-content">';
                echo htmlspecialchars($messages['name']) . ': ' . "<b>" . htmlspecialchars( $messages['message']) . "</b>";
                echo '</div>';
            } else {
                echo '<p>まだ投稿がありません。</p>';
            }
            ?>
        </section>
    </body>
</html>