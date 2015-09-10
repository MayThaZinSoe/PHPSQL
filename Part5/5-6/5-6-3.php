<?php
//====================================================================
// ●：5-6 PEAR(HTML_QuickForm)ライブラリを読み込み
//====================================================================
//--------------------------------------
// □ PEAR(Calendar)ライブラリを読み込み
//--------------------------------------
require_once("HTML/QuickForm.php");
//--------------------------------------
// □ インスタンスの作成
//--------------------------------------
$form = new HTML_QuickForm('frmObj', 'get');
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>5-5 PEAR(HTML_QuickForm)ライブラリを読み込み</title>
</head>
<body>
<?php
//--------------------------------------
// □ 表示
//--------------------------------------
$form->addElement("header", "title", "フォームチェック");
$form->addElement("text", "name", "名前");
$form->addElement("text", "mail", "メールアドレス");
$form->addElement("submit", "send", "送信");
//--------------------------------------
// ■　入力内容チェック
//--------------------------------------
$form->addRule("name", "お名前を入力してください", "required",NULL);
$form->addRule("mail", "メールアドレスを入力してください", "required",NULL);
$form->addRule("mail", "メールアドレスが正しくありません", "email",NULL);
if ($form->validate()) {
	echo "正しくチェックできました！！<br>";
	echo "<a href=\"{$_SERVER["PHP_SELF"]}\">もう一度チェック♪</a>";
	//フォームの検証が成功したら、内容を凍結する。
	$form->freeze();
}
$form->display();
?>
</body>
</html>
