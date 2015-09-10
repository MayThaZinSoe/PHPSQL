<?php
//======================================================================
//  ■：マイページ画面 mypage.php
//======================================================================
//----------------------------------------	
// ■　共通　require_once
//----------------------------------------	
require_once("com_require.php");
//=====================================================================
// ■　H T M L
//=====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title><?=$my_id ?> マイページ[ホーム]♪</title>
</head>
<body>
<?php
//----------------------------------------	
// ■　ヘッダーの取り込み
//----------------------------------------	
require_once("header.php");
//----------------------------------------	
// ■　エラーメッセージがあったら表示
//----------------------------------------	
if (strlen($error)>0){
	echo "<font size=\"2\" color=\"#da0b00\">{$error}</font><p>";
}
?>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
<table border="0" cellspacing="3" cellpadding="3" width="100%" height="100%"><tr>
<?php
//----------------------------------------	
// ■　左バーの取り込み
//----------------------------------------	
require_once("left.php");
//----------------------------------------	
// ■　右表示エリア
//----------------------------------------	
?>
<td align="left" valign="top"><font size="2">
<?php
if ($usr_no==$my_no){	//マイページのとき
	//-----------------------------------------------------
	// □：メッセージテーブル(friendmsg)からデータを読む
	//-----------------------------------------------------
	$sql = "SELECT count(*) AS kensu FROM friendmsg";
	$sql.= " WHERE no=$my_no AND readflg=0";
	$mysql->query($sql);
	if ($mysql->rows()>0){
		$row = $mysql->fetch();
		$kensu = $row["kensu"];
		if ($kensu>0){
			echo "<font color=\"ff6347\"><b>{$kensu}件のメッセージがあります♪</b>";
			echo "&nbsp;&nbsp;&nbsp;<a href=\"friendmsglist.php\">メッセージを読む</a>";
			echo "</font><p>";
		}
	}
	//-----------------------------------------------------
	// □：コメントテーブル(cookingres)からデータを読む
	//-----------------------------------------------------
	$sql = "SELECT logno,count(*) AS kensu FROM cookingres";
	$sql.= " WHERE no=$my_no AND tomono<>$my_no AND readflg=0";
	$sql.= "  GROUP BY logno ORDER BY upddate";
	$mysql->query($sql);
	$kensu=0;
	while($row = $mysql->fetch()){
		$kensu+= $row["kensu"];
		$log_no = $row["logno"];
	}
	if ($kensu>0){
		echo "<font color=\"ff6347\"><b>マイ・クッキングに{$kensu}件のコメントがあります♪</b>";
		echo "&nbsp;&nbsp;&nbsp;<a href=\"cookingread.php?log_no=$log_no\">コメントを読む</a></font><p>";
	}
}
?>
<font color=\"#6b8e23\">最新の<?=LIST_COUNT?>件</font><br><br>
<?php
//-----------------------------------------------------
// □：お料理日記テーブル(cookinglog)からデータを読む
//-----------------------------------------------------
$sql = "SELECT * FROM cookinglog";
$sql.= " WHERE no=$usr_no ORDER BY logno DESC";
$mysql->query($sql);
$allkensu = $mysql->rows();
$maxpage=intval($allkensu/LIST_COUNT);
if ($allkensu % LIST_COUNT > 0){$maxpage++;}
$start = ($page-1)*LIST_COUNT;

$sql = "SELECT * FROM cookinglog";
$sql.= " WHERE no=$usr_no ORDER BY upddate DESC,logno DESC LIMIT $start," .LIST_COUNT;
$mysql->query($sql);
$count = 0;
while($row = $mysql->fetch()){
	$upddate = $row["upddate"];
	$title = mb_substr($row["title"],0,30) ."...";
	$log_no = $row["logno"];
	if ($count==0){
		//--------------------------------------------------
		// □ 画像パスを取得
		//--------------------------------------------------
		if (strlen($row["pic"])>0){
			$count++;
			$pic = "http://$host/image/" .$row["pic"];
			echo "<a href=\"cookingread.php?usr_no=$usr_no&log_no=$log_no\">\n";
			echo "<img src=\"$pic\" border=\"0\">\n";
			echo "</a><br><br>\n";
		}
	}
	echo "$upddate&nbsp;<a href=\"cookingread.php?usr_no=$usr_no&log_no=$log_no\">$title</a><p>\n";
}
//----------------------------------------	
// ■　ページコントロールの取り込み
//----------------------------------------
$list_count = LIST_COUNT;
require_once("page.php");
?>
</font></td>
</tr></table>
</form>
</body>
</html>