<?php
//======================================================================
//  ■： お料理日記作成画面　cookinglog.php
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
	$log_no =$_POST["log_no"];					//クッキングログ番号
	$title = htmlspecialchars($_POST["title"], ENT_QUOTES);		//料理名
	$content = htmlspecialchars($_POST["content"], ENT_QUOTES);	//材料・作り方
	//画像用変数
	$pic_name = $_FILES["pic"]["name"]; 				//ローカルファイル名 
	$pic_tmp = $_FILES["pic"]["tmp_name"]; 				//テンポラリファイルの名前 
	$pic_type = $_FILES["pic"]["type"]; 				//画像タイプ
	$pic_size = $_FILES["pic"]["size"]; 				//画像サイズ
	$chk_del = 0;							//画像削除フラグ(変更時のみ)
	if (isset($_POST["chk_pic"])){$chk_del = 1;}
	$upd_pic = "";							//初期画像名(変更時のみ)
	if (isset($_POST["upd_pic"])){$upd_pic = $_POST["upd_pic"];}
	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------
	//料理名
	if (strlen($title)==0){$error ="料理名が未入力です";}
	//材料・作り方
	if (strlen($content)==0){$error ="材料・作り方が未入力です";}
	//ファイル
	if (strlen($pic_name)>0){
		if (is_uploaded_file($pic_tmp)) {
			if ($pic_size==0){$error="画像が不正です。";}
			if ($pic_size>300000){$error="画像のサイズが大きすぎます。({$pic_size}バイト)";;}
			if ($pic_type=="image/gif"){$kaku="gif";}
			if ($pic_type=="image_png" || $pic_type=="image/x-png"){$kaku="png";}
			if ($pic_type=="image/jpeg" || $pic_type=="image/pjpeg"){$kaku="jpg";}
			if ($kaku ==""){$error ="画像種類に誤りがあります。";}
		}
	}
	if (strlen($error)==0){
		//--------------------------------
		// □ 登録ボタンが押されたとき
		//--------------------------------
		if (isset($_POST["submit_add"])){
			//--------------------------------------------------
			// □ お料理日記テーブル(cookinglog)を読む
			//--------------------------------------------------
			//ログの最大値を取得
			$log_no = 0;
			$mysql->query("SELECT MAX(logno) AS maxno FROM cookinglog");
			if ($mysql->rows()>0){
				$row = $mysql->fetch();
				$log_no = $row["maxno"];
			}
			$log_no++;
			//--------------------------------------------------
			// □ 画像の移動
			//--------------------------------------------------
			if (strlen($pic_name)>0){
				$ymdhis = date("YmdHis");
				$pic_name = "{$my_no}-{$log_no}-{$ymdhis}.{$kaku}";
				move_uploaded_file($pic_tmp, "$pic_path/$pic_name");
			}
			//--------------------------------------------------
			// □ お料理日記テーブル(cookinglog)に新規追加
			//--------------------------------------------------
			$sql = "INSERT INTO cookinglog VALUES(";
			$sql.= "$my_no,$log_no,'$title','$content','$pic_name',";
			$sql.= "now())";
			$mysql->query($sql);
			$error = "登録が完了しました";
		}
		//--------------------------------
		// □ 変更ボタンが押されたとき
		//--------------------------------
		if (isset($_POST["submit_upd"])){
			if ($chk_del == 0){
				if (strlen($pic_name)>0){
					//画像移動
					$ymdhis = date("YmdHis");
					$pic_name = "{$my_no}-{$log_no}-{$ymdhis}.{$kaku}";
					move_uploaded_file($pic_tmp, "$pic_path/$pic_name");
				}else{
					$pic_name = $upd_pic;
				}
			}else{
				if (strlen($pic)>0 && file_exists("$pic_path/$pic")){
					//画像削除
					unlink("$pic_path/$pic");	
				}
				$pic_name = "";//画像名クリア
			}
			//--------------------------------------------------
			// □ お料理日記テーブル(cookinglog)に新規追加
			//--------------------------------------------------
			$sql = "UPDATE cookinglog SET";
			$sql.= " title='$title',content='$content',pic='$pic_name',upddate=now()";
			$sql.= " WHERE no=$my_no AND logno=$log_no";
			$mysql->query($sql);
			$error = "変更が完了しました";
		}
	}
}
//=====================================================================
// ■　H T M L
//=====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title><?=$my_id ?> マイページ[お料理日記を書く]♪</title>
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
	if ($error == "登録が完了しました" || $error == "変更が完了しました"){
		echo "<br><center><a href=\"./mypage.php\">マイページへ</a></center>\n";
		echo "</body>\n";
		echo "</html>";
		exit;
	}
}
?>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
<table border="0" cellspacing="3" cellpadding="3" width="100%" height="100%">
<tr>
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
<table border="0" cellspacing="3" cellpadding="3"  width="100%">
<tr><td align="center" bgcolor="ffe4e1" colspan="2">
<font size="2">お料理日記を書く</font></td></tr>
<tr><td align="center" bgcolor="#ffe4e1"><font size="2">料理名</font></td>
<td><input type="text" name="title" value="<?=$title ?>" size="60"></td></tr>
<tr><td align="center" bgcolor="#ffe4e1"><font size="2">材料・作り方</font></td>
<td><textarea name="content" cols="50" rows="20"><?=$content?></textarea></td></tr>
<tr><td align="center" bgcolor="#ffe4e1"><font size="2">画像</font></td>
<td><font size="2">
<input type="file" name="pic" size="60">
<?php
//----------------------------------------	
// ■　変更のとき画像表示
//----------------------------------------
if (strlen($pic)>0){
	$disp_pic = "http://$host/image/" .$pic;
	echo "<img src=\"$disp_pic\" border=\"0\"><br>";
	echo "<input type=\"checkbox\" name=\"chk_pic\" value=\"1\">削除\n";
	echo "<input type=\"hidden\" name=\"upd_pic\" value=\"$pic\">\n";
}
?>
</font></td></tr>
<tr><td align="center" colspan="2">
<input type="hidden" name="log_no" value="<?= $log_no?>">
<input type="reset" name="submit_reset" value="リセット">
<?php
//----------------------------------------	
// ■　新規登録/変更ボタン
//----------------------------------------
if ($log_no==0){
	echo "<input type=\"submit\" name=\"submit_add\" value=\"登録する\">";
}else{
	echo "<input type=\"submit\" name=\"submit_upd\" value=\"変更する\">";
}
?>
</td></tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>