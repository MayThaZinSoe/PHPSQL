<?php
//======================================================================
// ■： お料理日記表示画面　cookingread.php
//======================================================================
//----------------------------------------	
// ■　共通　require_once
//----------------------------------------	
require_once("com_require.php");
//----------------------------------------	
// ■　POSTされたとき
//----------------------------------------	
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ POSTされたデータを取得
	//--------------------------------
	$usr_no =$_POST["usr_no"];
	$log_no =$_POST["log_no"];
	$contentres = htmlspecialchars($_POST["contentres"], ENT_QUOTES);	//コメント
	//--------------------------------
	// □ コメントボタンが押されたとき
	//--------------------------------
	if (isset($_POST["submit_res"])){
		//--------------------------------
		// □ 入力内容チェック
		//--------------------------------
		//コメント
		if (strlen($contentres)==0){$error ="コメントが未入力です";}
		if (strlen($error)==0){
			//--------------------------------------------------
			// □ コメントテーブル(cookingres)を読む
			//--------------------------------------------------
			//レス番号の最大値を取得
			$res_no = 0;
			$mysql->query("SELECT MAX(resno) AS maxno FROM cookingres");
			if ($mysql->rows()>0){
				$row = $mysql->fetch();
				$res_no = $row["maxno"];
			}
			$res_no++;
			//--------------------------------------------------
			// □ コメントテーブル(cookingres)に新規追加
			//--------------------------------------------------
			$sql = "INSERT INTO cookingres VALUES(";
			$sql.= "$usr_no,$log_no,$res_no,$my_no,'$contentres',0,now())";
			$mysql->query($sql);
			$error = "コメントを追加しました。";
		}
	}
	//--------------------------------
	// □ 変更ボタンが押されたとき
	//--------------------------------
	if (isset($_POST["submit_upd"])){
		header("Location: http://$host/cookinglog.php?log_no=$log_no");
		exit;
	}
	//-----------------------------------------
	// □ 削除ボタンが押されたとき
	//-----------------------------------------
	if (isset($_POST["submit_del"])){
		//--------------------------------------------------
		// □　画像削除
		//--------------------------------------------------
		$sql = "SELECT pic FROM cookinglog WHERE no=$my_no AND logno=$log_no";
		$mysql->query($sql);
		if ($mysql->rows()>0){
			$row = $mysql->fetch();
			$pic = $row["pic"];
		}
		if (strlen($pic)>0 && file_exists("$pic_path/$pic")){
			unlink("$pic_path/$pic");	//削除
		}
		//元のログを削除
		$sql = "DELETE FROM cookinglog WHERE no=$my_no AND logno=$log_no";	
		$mysql->query($sql);
		//コメントも削除
		$sql = "DELETE FROM cookingres WHERE no=$my_no AND logno=$log_no";	
		$mysql->query($sql);
		//マイページにジャンプ
		header("Location: http://$host/mypage.php");	
		exit;
	}
	//-----------------------------------------
	// □ コメントの削除ボタンが押されたとき
	//-----------------------------------------
	if (isset($_POST["submit_resdel"])){
		$res_no = key($_POST[submit_resdel]);
		$sql = "DELETE FROM cookingres WHERE no=$usr_no AND logno=$log_no AND resno=$res_no";	
		$mysql->query($sql);
		$error = "コメントを1件削除しました";
	}
}
//=====================================================================
// ■　H T M L
//=====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title><?=$my_id ?> マイページ[お料理日記を読む]♪</title>
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
<td align="left" valign="top">
<font size="2">
<?php
//--------------------------------------------------------------
// □：お料理日記テーブル(cookinglog)からデータを読む
//--------------------------------------------------------------
$sql = "SELECT * FROM cookinglog WHERE no=$usr_no AND logno=$log_no";
$mysql->query($sql);
if ($mysql->rows()>0){
	$row = $mysql->fetch();
	$title = $row["title"];
	$upddate = $row["upddate"];
	$content = $row["content"];
	list($y,$m,$d) = explode("-", $upddate);
	echo "<font color=\"#6b8e23\"><b>{$y}年{$m}月{$d}日</b></font>&nbsp;&nbsp;&nbsp;";
	if ($my_no==$usr_no){
		echo "<input type=\"submit\" name=\"submit_upd[$log_no]\" value=\"変更\">\n";
		echo "<input type=\"submit\" name=\"submit_del[$log_no]\" value=\"削除\"><p>\n";
	}
	echo "お料理名：<b>$title</b><p>";
	if (strlen($row["pic"])>0){
		$pic = "http://$host/image/" .$row["pic"];
		echo "<a href=\"cookingread.php?usr_no=$usr_no&log_no=$log_no\">";
		echo "<img src=\"$pic\" border=\"0\">\n";
		echo "</a><br><br>\n";
	}
	echo "【材料・作り方】<p>\n";
	get_url($content);
	echo "<font color=\"#2b8e57\">$content</font><br>\n";
}
//--------------------------------------------------------------
// □：お料理日記コメントテーブル(cookingres)からデータを読む
//--------------------------------------------------------------
$sql = "SELECT cookingres.*,friendinfo.usrid AS tomoid FROM cookingres";
$sql.= " LEFT JOIN friendinfo ON cookingres.tomono =friendinfo.no";
$sql.= " WHERE cookingres.no=$usr_no AND cookingres.logno=$log_no";
$sql.= " ORDER BY cookingres.resno";
$mysql->query($sql);
while($row = $mysql->fetch()){
	$res_no = $row["resno"];
	$tomo_no = $row["tomono"];
	$tomo_id = $row["tomoid"];
	if ($tomo_no<>$my_no){
		$tomo_id.="さん";
	} 
	$upddate = $row["upddate"];
	$contentres = $row["contentres"];
	echo "<br>" .str_repeat("_",80) ."<br>";
	list($y,$m,$d) = explode("-", $upddate);
	echo "<font color=\"#6b8e23\"><b>{$y}年{$m}月{$d}日</b></font>&nbsp;&nbsp;&nbsp;";
	echo "<b>{$tomo_id}</b>&nbsp;&nbsp;";
	if ($my_no==$usr_no || $my_no==$tomo_no){
		echo "<input type=\"submit\" name=\"submit_resdel[$res_no]\" value=\"削除\">";
	}
	echo "<p>\n";
	get_url($contentres);
	echo $contentres;
}
//--------------------------------------------------------------
// □：お料理日記コメントテーブル(cookingres)を既読に更新
//--------------------------------------------------------------
$sql = "UPDATE cookingres SET readflg=1 WHERE no=$my_no AND logno=$log_no";
$mysql->query($sql);
//--------------------------------------------------------------
// □：お料理日記コメントテーブル(cookingres)を既読に更新
//--------------------------------------------------------------
$sql = "UPDATE cookingres SET readflg=1 WHERE no=$my_no AND logno=$log_no";
$mysql->query($sql);
?>
<br><br>
<table border="1" cellspacing="0" cellpadding="3" width="500" bordercolor="#666666"><tr>
<td align="center" valign="top"><font size="2">コメント</font></td></tr>
<tr><td align="center" valign="top"><font size="2">
<textarea name="contentres" cols="60" rows="5"></textarea><br>
<input type="submit" name="submit_res" value="コメントする">
</font></td></tr></table>
</font></td>
</tr></table>
<input type="hidden" name="usr_no" value="<?=$usr_no ?>">
<input type="hidden" name="log_no" value="<?=$log_no ?>">
</form>
</body>
</html>