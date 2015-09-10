<?php
//====================================================================
// ●：5-4 クラスを使う PHP5
//====================================================================
//-------------------------------------------------------
// ■　外部ファイルの取り込み(わざとエラーにして__autoload使用)
//-------------------------------------------------------
//require_once("jelly5.php");	//ゼリークラス
//require_once("pudding5.php");	//プリンクラス
//require_once("babaroa5.php");	//ババロアクラス
//-------------------------------------------------------
// ■　__autoload
//-------------------------------------------------------
function __autoload($className) {
  include_once($className . ".php");
}
//-------------------------------------------------------
// ■　初期値設定
//-------------------------------------------------------
$syurui = "1";
$aji = "1";
$amasa = "0";
$topping = "0";
$kansei = "";
//-------------------------------------------------------
// ■　POSTされたとき
//-------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ 注文するボタンの押下
	//--------------------------------
	if (isset($_POST["submit"])){
		//------------------------------------------------------
		// □　$_POSTから値を取得
		//------------------------------------------------------
		if (isset($_POST["syurui"])){		//種類
			$syurui = $_POST["syurui"];
		}
		if (isset($_POST["aji"])){		//味
			$aji = $_POST["aji"];
		}
		if (isset($_POST["amasa"])){		//甘さ
			$amasa = $_POST["amasa"];
		}
		if (isset($_POST["topping"])){		//トッピング
			$topping = $_POST["topping"];
		}

		//------------------------------------------------------
		// □　クラスのインスタンス作成
		//------------------------------------------------------
		//味の設定
		switch($syurui){
			case "1"://ゼリー
				$obj = new jelly5($aji);
				break;
			case "2"://プリン
				$obj = new pudding5($aji);
				break;
			case "3"://ババロア
				$obj = new babaroa5($aji);
				break;
		}
		$obj->toudo($amasa);
		$obj->ue($topping);
		$kansei = $obj->dekiagari();


	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：5-4 クラスを使う(PHP5)</title>
</head>
<body>
<h2>ぷるぷるスィーツ♪ご注文♪</h2>
<?php
//--------------------------------------------------
// ■　送信された内容を表示
//--------------------------------------------------
if ($kansei>""){
	echo "お客さまのご注文は<br><br>";
	echo "<b>$kansei</b><br><br>";
	echo "ですね(*^_^*)♪";
}
?>
<hr>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
こちらからお好みをお選びください！<br>
<table border="1" width="600" cellspacing="0" cellpadding="0">
<?php
//--------------------------------------------------
// □　種類
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#e9967a">種類</td>
<td align="left" width="450">
&nbsp;<input type="radio" name="syurui" value="1"<?if ($syurui=="1"){echo " checked";}?>>ゼリー
&nbsp;<input type="radio" name="syurui" value="2"<?if ($syurui=="2"){echo " checked";}?>>プリン
&nbsp;<input type="radio" name="syurui" value="3"<?if ($syurui=="3"){echo " checked";}?>>ババロア
</td>
</tr>

<?php
//--------------------------------------------------
// □　味
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#e9967a">味</td>
<td align="left" width="450">
&nbsp;<input type="radio" name="aji" value="1"<?if ($aji=="1"){echo " checked";}?>>オレンジ
&nbsp;<input type="radio" name="aji" value="2"<?if ($aji=="2"){echo " checked";}?>>苺
&nbsp;<input type="radio" name="aji" value="3"<?if ($aji=="3"){echo " checked";}?>>マンゴー
&nbsp;<input type="radio" name="aji" value="4"<?if ($aji=="4"){echo " checked";}?>>珈琲
&nbsp;<input type="radio" name="aji" value="5"<?if ($aji=="5"){echo " checked";}?>>ミルク

</td>
</tr>
<?php
//--------------------------------------------------
// □　甘さ
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#e9967a">甘さ</td>
<td align="left" width="450">
&nbsp;<input type="radio" name="amasa" value="0"<?if ($amasa=="0"){echo " checked";}?>>なし
&nbsp;<input type="radio" name="amasa" value="1"<?if ($amasa=="1"){echo " checked";}?>>ちょっぴり
&nbsp;<input type="radio" name="amasa" value="2"<?if ($amasa=="2"){echo " checked";}?>>ほんのり
&nbsp;<input type="radio" name="amasa" value="3"<?if ($amasa=="3"){echo " checked";}?>>とっても
&nbsp;<input type="radio" name="amasa" value="4"<?if ($amasa=="4"){echo " checked";}?>>めちゃめちゃ

</td>
</tr>
<?php
//--------------------------------------------------
// □　トッピング
//--------------------------------------------------
?>
<tr>
<td align="center" width="150" bgcolor="#e9967a">トッピング</td>
<td align="left" width="450">
&nbsp;<input type="radio" name="topping" value="0"<?if ($topping=="0"){echo " checked";}?>>なし
&nbsp;<input type="radio" name="topping" value="1"<?if ($topping=="1"){echo " checked";}?>>生クリーム
&nbsp;<input type="radio" name="topping" value="2"<?if ($topping=="2"){echo " checked";}?>>フルーツソース
&nbsp;<input type="radio" name="topping" value="3"<?if ($topping=="3"){echo " checked";}?>>苺
&nbsp;<input type="radio" name="topping" value="4"<?if ($topping=="4"){echo " checked";}?>><font color="#e9967a">秘密
</font>
</td>
</tr>

</table>
<font color="#e9967a">秘密のトッピングについてはお楽しみです♪</font>
<br>
<input type="submit" name="submit" value="　　　注文する　　　">
</form>

</body>
</html>

