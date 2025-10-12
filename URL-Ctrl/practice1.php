<?php
$url = 'https://www.example.com/path/to/page.php?id=123&lang=ja#section1';

// URL全体の構成要素を取得
$parts = parse_url($url);
// $parts['host'] は 'www.example.com'
// $parts['path'] は '/path/to/page.php'
// $parts['query'] は 'id=123&lang=ja'

// クエリ文字列を配列に変換
parse_str($parts['query'], $query_array);
// $query_array['id'] は '123'
// $query_array['lang'] は 'ja'
?>
