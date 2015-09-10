<?php
//====================================================================
// ●：5-1 ：フォームを扱う
//====================================================================
//-------------------------------------------------------
// ■　初期値設定
//-------------------------------------------------------
$kname = "";
$mail = "";
$pw = "";
$ken = "1";
$seibetsu = "1";
$flg = array("0","0");
$postflg = "0";
$biko = "";
//-------------------------------------------------------
// ■　POSTされたとき
//-------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$postflg ="1";
	//--------------------------------
	// □ 登録
	//--------------------------------
	if (isset($_POST["submit"])){
		//------------------------------------------------------
		// □　$_POSTから値を取得
		//------------------------------------------------------
		$kname = htmlspecialchars($_POST["kname"], ENT_QUOTES);	//会員名
		$mail = htmlspecialchars($_POST["mail"], ENT_QUOTES);	//メールアドレス
		$pw = htmlspecialchars($_POST["pw"], ENT_QUOTES);	//パスワード
		$biko = htmlspecialchars($_POST["biko"], ENT_QUOTES);	//備考
		$ken = $_POST["ken"];					//件
		if (isset($_POST["seibetsu"])){				//性別(1:男,2:女)
			$seibetsu = $_POST["seibetsu"];
		}
		if (isset($_POST["flg"])){				//フラグ(0:表示フラグ,1:画像表示フラグ)
			foreach($_POST["flg"] as $key =>$value){
				$flg[$key] = $value;
			} 
		}
		$pic_name = $_FILES["pic"]["name"]; 			//ローカルファイル名 
		$pic_tmp = $_FILES["pic"]["tmp_name"]; 			//テンポラリファイルの名前 
		//------------------------------------------------------
		// □　全角文字を半角に変換
		//------------------------------------------------------
		$mail = mb_convert_kana($mail,"as");
		//------------------------------------------------------
		// □　チェック
		//------------------------------------------------------
		//会員名
		if (strlen($kname)==0){
			echo "会員名が未入力です<br>";
		}
		//メールアドレス
		if (!preg_match("/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/", $mail)){
			echo "メールアドレスに誤りがあります<br>";
		}
		//パスワード
		if (!preg_match("/^[0-9]{1,5}$/",$pw)){
			echo "パスワードに誤りがあります<br>";
		}
		//ファイル
		$path = getcwd();
		//スーパーグローバル変数の環境変数$ENVの連想配列「OS」の値に
		//「Windows」という文字があるかどうかをチェック
		if (isset($_ENV["OS"]) && preg_match("/window/i", $_ENV["OS"])){
			$path .= "\\";
		}else{
			$path .= "/";
		}
		if (strlen($pic_name)>0 && strlen($pic_tmp)>0){
			if (is_uploaded_file($pic_tmp)) {
				if (!move_uploaded_file($pic_tmp, $path .basename($pic_name))){
					echo "ファイルのアップロードに失敗しました<br>";
				}
			}
		}

	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：5-1 フォームを扱う</title>
</head>
<body>
<h2>フォーム送信テスト</h2>
<?php
//--------------------------------------------------
// ■　送信された内容を表示
//--------------------------------------------------
if ($postflg=="1"){
	if ($flg[0]=="1"){
		//-------------------------------------
		// ■ 表示フラグがオンの時表示
		//-------------------------------------
		echo "<b>送信された内容</b><br>";
		echo "会員名：$kname<br>";
		echo "パスワード：$pw<br>";
		switch($ken){
			case "1":
				$ken ="北海道";
				break;
			case "2":
				$ken ="青森県";
				break;
			case "3":
				$ken ="秋田県";
				break;
			case "4":
				$ken ="岩手県";
				break;
		}
		echo "住所：$ken<br>";
		if ($seibetsu=="1"){
			echo "性別：男<br>";
		}else{
			echo "性別：女<br>";
		}
		echo "Email：$mail<br>";
		$biko_br = nl2br($biko);
		echo "備考:<br>";
		echo $biko_br;
		echo "<br>";
		//画像
		if (strlen($pic_tmp)>0){
			echo $path .basename($pic_name) ."にアップロードしました";
			if ($flg[1]=="1"){
				echo "<br><img src=\"" .basename($pic_name) ."\">";
			}

		}else{
			echo "ファイルはアップロードされませんでした";

			//ファイル名に入力があったらファイルは設定されているけれど
			//MAX_FILE_SIZEの大きさを超過していることになるのでメッセージを表示
			if (strlen($pic_name)>0){
				echo "(ファイルサイズが30KBを超過しています)";
			}
		}
	}else{
		//-------------------------------------
		// ■ 表示フラグがオンの時
		//-------------------------------------
		echo "送信した内容は表示されません";
	}
}
?>
<hr>
<b>会員登録フォーム)</b><p>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
<table border="1" width="600" cellspacing="0" cellpadding="0">
<?php
//--------------------------------------------------
// □　会員名
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">会員名</td>
<td align="left" width="450">
&nbsp;<input type="text" name="kname" value="<?=$kname?>" size="40">
</td>
</tr>
<?php
//--------------------------------------------------
// □　住所
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">住所</td>
<td align="left" width="450">
&nbsp;<select name="ken">
<option value="1"<?if ($ken=="1"){echo " selected";}?>>北海道</option>
<option value="2"<?if ($ken=="2"){echo " selected";}?>>青森県</option>
<option value="3"<?if ($ken=="3"){echo " selected";}?>>秋田県</option>
<option value="4"<?if ($ken=="4"){echo " selected";}?>>岩手県</option>
</select>
</td>
</tr>
<?php
//--------------------------------------------------
// □　性別
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">性別</td>
<td align="left" width="450">
&nbsp;<input type="radio" name="seibetsu" value="1"<?if ($seibetsu=="1"){echo " checked";}?>>男性
&nbsp;<input type="radio" name="seibetsu" value="2"<?if ($seibetsu=="2"){echo " checked";}?>>女性
</td>
</tr>
<?php
//--------------------------------------------------
// □　メールアドレス
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">メールアドレス</td>
<td align="left" width="450">
&nbsp;<input type="text" name="mail" value="<?=$mail?>" size="30">
</td>
</tr>

<?php
//--------------------------------------------------
// □　パスワード
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">パスワード</td>
<td align="left" width="450">
&nbsp;<input type="password" name="pw" value="<?=$pw?>" size="30"><br>
&nbsp;5文字以下の半角数字を入力して下さい。
</td>
</tr>
<?php
//--------------------------------------------------
// □　画像ファイル
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">画像ファイル</td>
<td align="left" width="450">
&nbsp;<input type="hidden" name="MAX_FILE_SIZE" value="30000">
&nbsp;<input type="file" name="pic" size="40">
</font>
</td>
</tr>
<?php
//--------------------------------------------------
// □　フラグ
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">フラグ</td>
<td align="left" width="450">
&nbsp;<input type="checkbox" name="flg[0]" value="1"<?if ($flg[0]=="1"){echo " checked";}?>>内容を表示する
&nbsp;<input type="checkbox" name="flg[1]" value="1"<?if ($flg[1]=="1"){echo " checked";}?>>画像を表示する
</td>
</tr>
<?php
//--------------------------------------------------
// □　備考
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">備考</td>
<td align="left" width="450">
&nbsp;<textarea name="biko" cols="60" rows="10"><?=$biko?></textarea>
<input type="hidden" name="no" value="abc">
</td>
</tr>
</table>
<br>
<?php
//--------------------------------------------------
// □　登録ボタン
//--------------------------------------------------
?>
<input type="submit" name="submit" value="　　　登録する　　　">
</form>
</body>
</html>

