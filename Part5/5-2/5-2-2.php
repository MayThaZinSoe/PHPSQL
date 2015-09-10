<?php
//====================================================================
// ●：5-2 ユーザ定義関数を使う（関数）
//====================================================================
//------------------------------------
// ○ URLをリンクに変換
//------------------------------------
function check_1(&$str){

	//URLをリンクタグに変更
	$check = "{(https?|ftp|news)(://[[:alnum:]\+\$\;\?\.%,!#~*\/:@&=_-]+)}";	
	$str = preg_replace($check,"<a href=\"$1$2\" target=\"_blank\">$1$2</a>",$str);

	//メールアドレスをリンクタグに変更
	$check  = "/([a-zA-Z0-9_\.-]+\@)([a-zA-Z0-9_\.-]+)([a-zA-Z]+)/";
	$str = preg_replace($check,"<a href=\"mailto:$1$2$3\">$1$2$3</a>",$str);
	global $msg;
	$msg = "URLをリンクに変換しました！<br>";

	return strlen($str);
}
//------------------------------------
// ○ 入力内容に合わせて改行をする
//------------------------------------
function check_2(&$str,$nagasa=0){
	$str= nl2br($str);
	global $msg;
	$msg = "入力内容に合わせて改行しました！<br>";
	return strlen($str);
}
//------------------------------------
// ○ 文字列を置換しました
//------------------------------------
function check_3(&$str){
	$str= str_replace($GLOBALS["from"],$GLOBALS["to"],$str);
	global $msg;
	$msg = $GLOBALS["from"] ."から" .$GLOBALS["to"] ."へ置換しました！<br>";

	return strlen($str);
}
//------------------------------------
// ○ すべての関数を実行
//------------------------------------
function check_4(&$str){
	check_1($str);
	check_2($str);
	check_3($str);
	global $msg;
	$msg = "すべての関数チェックを行いました♪<br>";
	return strlen($str);
}
?>