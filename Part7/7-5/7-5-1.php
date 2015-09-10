<?php
//======================================================================
//  ■： 7-5 MySQL 追加・更新・削除
//======================================================================
//----------------------------------------	
// ■　MySQLクラスファイルの取り込み
//----------------------------------------	
require_once("mysql2.php");
//----------------------------------------	
// ■　変数初期化
//----------------------------------------	
$sql = "";
$error = "";
$new_no = "";
$new_name = "";
$new_birth = "";
$new_email = "";
//----------------------------------------	
// □：MYSQLクラスインスタンスの作成
//----------------------------------------	
$mysql = new MySQL;
//----------------------------------------	
// ■　POSTされたとき
//----------------------------------------	
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ 新規追加
	//--------------------------------
	if (isset($_POST["submit_add"])){
		//--------------------------------
		// □ POSTされたデータを取得
		//--------------------------------
		//新規追加
		$new_no = htmlspecialchars($_POST["new_no"], ENT_QUOTES);	//追加番号
		$new_name = htmlspecialchars($_POST["new_name"], ENT_QUOTES);	//追加名前
		$new_birth = htmlspecialchars($_POST["new_birth"], ENT_QUOTES);	//追加誕生日
		$new_email = htmlspecialchars($_POST["new_email"], ENT_QUOTES);	//追加メールアドレス
		//--------------------------------
		// □ 全角文字を半角に変換
		//--------------------------------
		$new_no = mb_convert_kana($new_no,"as");
		$new_birth = mb_convert_kana($new_birth,"as");
		$new_email = mb_convert_kana($new_email,"as");
		//--------------------------------
		// □ チェック
		//--------------------------------
		//番号
		if (!preg_match("/^[0-9]*$/",$new_no)){$error = "新規番号[$new_no]に誤りがあります";}
		//最大番号を取得
		$mysql->query("SELECT MAX(no) AS maxno FROM friends");
		$row = $mysql->fetch();
		if ($new_no<=$row["maxno"]){
			$error = "新規番号[$new_no]は最大番号よりも大きくしてください";
		}
		//誕生日
		if (!preg_match("/^[0-9-]*$/",$new_birth)){
			$error= "新規誕生日[$new_birth]に誤りがあります";
		}else{
			list($y,$m,$d) = explode("-", $new_birth);
			if (!checkdate($m,$d,$y)){
				$error = "新規誕生日[$new_birth]に誤りがあります";
			}
		}
		//メールアドレス
		if (!preg_match("/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/", $new_email)){
			$error = "メールアドレス[$new_email]に誤りがあります<br>";
		}
		//--------------------------------
		// □ SQL文作成
		//--------------------------------
		if ($error==""){
			$sql = "INSERT INTO friends VALUES($new_no,'$new_name','$new_birth','$new_email')";
		}
	}
	//--------------------------------
	// □ 変更
	//--------------------------------
	if (isset($_POST["submit_upd"])){

		$no = key($_POST["submit_upd"]);	//押下したボタン番号を取得
		//--------------------------------
		// □ POSTされたデータを取得
		//--------------------------------
	 	$name = htmlspecialchars($_POST["name"][$no], ENT_QUOTES);	//名前
	 	$birth = htmlspecialchars($_POST["birth"][$no], ENT_QUOTES);	//誕生日
	 	$email = htmlspecialchars($_POST["email"][$no], ENT_QUOTES);	//メールアドレス
		//--------------------------------
		// □ 全角文字を半角に変換
		//--------------------------------
	 	$email = mb_convert_kana($email ,"as");
	 	$birth= mb_convert_kana($birth ,"as");
		//--------------------------------
		// □ チェック
		//--------------------------------
		//誕生日
		if (!preg_match("/^[0-9-]*$/",$birth)){
			$error = "{$no}番の誕生日[{$birth}]に誤りがあります";
		}else{
			list($y,$m,$d) = explode("-", $birth);
			if (!checkdate($m,$d,$y)){
				$error = "{$no}番の誕生日[{$birth}]に誤りがあります";
			}
		}
		//メールアドレス
		if (!preg_match("/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/", $email)){
			$error = "{$no}番のメールアドレス[{$email}]に誤りがあります";
		}

		//--------------------------------
		// □ SQL文作成
		//--------------------------------
		if ($error==""){
			$sql = "UPDATE friends SET name='$name',birth='$birth',email='$email' WHERE no=$no";
		}
	}
	//--------------------------------
	// □ 削除
	//--------------------------------
	if (isset($_POST["submit_del"])){
		$no = key($_POST["submit_del"]);		//押下したボタン番号を取得
		$sql = "DELETE FROM friends WHERE no=$no";
	}
	//--------------------------------
	// □ SQL文をMySQLへ渡す
	//--------------------------------
	if ($error==""){
		$mysql->query($sql);
		$new_no = "";
		$new_name = "";
		$new_birth = "";
		$new_email = "";
	}
	
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>7-5 追加・更新・削除</title>
</head>
<body>
<?=$error ?><br>
<h3>* * お友達リスト * * </h3>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
<?php
//----------------------------------------	
// □：テーブルからデータを読む
//----------------------------------------
$mysql->query("SELECT * FROM friends ORDER BY no");
while($row = $mysql->fetch()){
	$no = $row["no"];
	$name = $row["name"];
	$birth = $row["birth"];
	$email = $row["email"];
	echo <<<EOT
$no:
<input type="text" name="name[$no]" value="$name" size="10">
<input type="text" name="birth[$no]" value="$birth">
<input type="text" name="email[$no]" value="$email">
<input type="submit" name="submit_upd[$no]" value="変更">
<input type="submit" name="submit_del[$no]" value="削除">
<br>
EOT;
}
//ここまでwhileループ[終了の閉じカッコ]
?>
<br>
お友達リストに新規追加　(番号、名前、誕生日、メールアドレス)<br>
<input type="text" name="new_no" value="<?=$new_no ?>" size="5">
<input type="text" name="new_name" value="<?=$new_name ?>" size="10">
<input type="text" name="new_birth" value="<?=$new_birth ?>">
<input type="text" name="new_email" value="<?=$new_email ?>">
<input type="submit" name="submit_add" value="追加♪">
</form>
<br>
<?php
//----------------------------------------	
// □：発行したSQL文
//----------------------------------------
if ($sql>""){
	echo "発行したSQL文：<br>$sql";
}
?>
</body>
</html>