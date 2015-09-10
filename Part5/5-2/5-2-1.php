<?php
//====================================================================
// ●：5-2 ユーザ定義関数を使う
//====================================================================
//-------------------------------------------------------
// ■　外部ファイルの取り込み(ユーザ関数の入った5-2-2.phpを取り込む)
//-------------------------------------------------------
require_once("./5-2-2.php");	//ユーザ定義関数ファイル
//-------------------------------------------------------
// ■　初期値設定
//-------------------------------------------------------
$kubun = "1";
$content = "";
$from = "";
$to = "";
$postflg = "0";
//-------------------------------------------------------
// ■　POSTされたとき
//-------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$postflg = "1";
	//--------------------------------
	// □ 関数テストするボタンの押下
	//--------------------------------
	if (isset($_POST["submit"])){
		//------------------------------------------------------
		// □　$_POSTから値を取得
		//------------------------------------------------------
		if (isset($_POST["kubun"])){					//区分
			$kubun = $_POST["kubun"];
		}
		$content = htmlspecialchars($_POST["content"], ENT_QUOTES);	//内容
		$from = htmlspecialchars($_POST["from"], ENT_QUOTES);		//変換前
		$to = htmlspecialchars($_POST["to"], ENT_QUOTES);		//変換後
		//------------------------------------------------------
		// □　関数を呼び出す
		//------------------------------------------------------
		$func = "check_" .$kubun;
		$cont = $content;
		$value = $func($cont);

	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：5-2 ユーザ定義関数を使う</title>
</head>
<body>
<h2>ユーザ定義関数テスト</h2>
<?php
//--------------------------------------------------
// ■　送信された内容を表示
//--------------------------------------------------
if ($postflg=="1"){
	echo "<b>関数処理された内容</b><br>";
	echo "<font color=\"#b2ce77\">";
	echo $msg;
	echo "</font>";
	echo "$cont<br>";
	echo "内容の長さは<b>" .$value ."</b>バイトです<br>";
}
?>
<hr>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
<table border="1" width="600" cellspacing="0" cellpadding="0">
<?php
//--------------------------------------------------
// □　処理区分
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">処理区分</td>
<td align="left" width="450">
&nbsp;<input type="radio" name="kubun" value="1"<?if ($kubun=="1"){echo " checked";}?>>URLをリンクに変換<br>
&nbsp;<input type="radio" name="kubun" value="2"<?if ($kubun=="2"){echo " checked";}?>>入力内容に合わせて改行をする<br>&nbsp;<input type="radio" name="kubun" value="3"<?if ($kubun=="3"){echo " checked";}?>>
<input type="text" name="from" value="<?=$from?>">を<input type="text" name="to" value="<?=$to?>">に変換<br>
&nbsp;<input type="radio" name="kubun" value="4"<?if ($kubun=="4"){echo " checked";}?>>上記のすべてを行う<br>

</td>
</tr>
<?php
//--------------------------------------------------
// □　内容
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#b2ce77">内容</td>
<td align="left" width="450">
&nbsp;<textarea name="content" cols="60" rows="10"><?=$content?></textarea>
</td>
</tr>

</table>
<br>
<input type="submit" name="submit" value="　　　関数テストする　　　">
</form>

</body>
</html>

