<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：3-18 HTMLの出力方法</title>
</head>
<body>
<?php
$word = "ヒアドキュメント";
//--------------------------------------------------------------------
// ■　ヒアドキュメントを使わないPHPコード
//--------------------------------------------------------------------
echo "<table border=\"1\">";
echo "<tr><td>";
echo "<b>ここは{$word}を使わないPHPコードです</b>";
echo "</td></tr>";
echo "</table>";
//--------------------------------------------------------------------
// ■　ヒアドキュメントを使ったPHPコード
//--------------------------------------------------------------------
echo <<<EOT
<table border="1">
<tr><td>
<b>ここは{$word}を使ったPHPコードです</b>
</td></tr>
</table>
EOT;
?>
</body>
</html>
