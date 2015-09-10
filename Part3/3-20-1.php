<?php
//--------------------------------------------------------------------
// ■　クッキーを保存する
//--------------------------------------------------------------------
setcookie("myinfo[onamae]", "フミコ");
setcookie("myinfo[mail]", "aaa@bbb.ccc");
setcookie("myinfo[password]", "fumikoo");
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：3-20 クッキーの利用</title>
</head>
<body>
<?php
//--------------------------------------------------------------------
// ■　クッキーを取得する
//--------------------------------------------------------------------
if (isset($_COOKIE['myinfo'])) {
	foreach ($_COOKIE['myinfo'] as $key => $value) {
		echo "$key : $value <br />\n";
	}
}
?>
</body>
</html>
