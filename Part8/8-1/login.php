<?php
//======================================================================
//  ■： ログイン画面 login.php
//======================================================================
//----------------------------------------	
// ■　MySQLクラスファイルの取り込み
//----------------------------------------	
require_once("mysql2.php");
//----------------------------------------	
// □：MYSQLクラスインスタンスの作成
//----------------------------------------	
$mysql = new MySQL;
//----------------------------------------	
// ■　外部ファイルの取り込み
//----------------------------------------	
require_once("com_define.php");		//定数
require_once("com_function.php");	//関数
//----------------------------------------	
// ■　HOSTの取得
//----------------------------------------	
$host = get_host();
//----------------------------------------	
// ■　SESSION設定
//----------------------------------------	
session_start();		//セッション開始
$_SESSION["my_no"] = 0;		//自分の番号
$_SESSION["my_id"] = "";	//自分のID
$_SESSION["my_login"] = 0;	//ログイン
//----------------------------------------	
// ■　変数初期化
//----------------------------------------	
$error = "";
$usr_no = 0;
$usr_id = "";
$usr_pw = "";
//----------------------------------------	
// ■　POSTされたとき
//----------------------------------------	
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------------------
	// □ ログインボタンが押されたとき
	//--------------------------------------------
	if (isset($_POST["submit"])){
		//--------------------------------
		// □ POSTされたデータを取得
		//--------------------------------
		$usr_id = htmlspecialchars($_POST["usr_id"], ENT_QUOTES);	//ID
		$usr_pw = htmlspecialchars($_POST["usr_pw"], ENT_QUOTES);	//パスワード
		//--------------------------------
		// □ 入力内容チェック
		//--------------------------------
		//ユーザID
		if (strlen($usr_id)==0){$error = "ユーザIDが入力されていません";}
		//パスワード
		if (strlen($usr_pw)==0){$error = "パスワードが入力されていません";}
		if (strlen($error)==0){
			//--------------------------------------------
			// □ 友達情報テーブル(friendinfo)をチェック
			//--------------------------------------------
			$mysql->query("SELECT * FROM friendinfo WHERE usrid='$usr_id'");
			if ($mysql->rows()>0){	//行が存在した場合
				$row = $mysql->fetch();
				if ($row["usrpw"] == $usr_pw){
					$_SESSION["my_no"] = $row["no"];
					$_SESSION["my_id"] = $usr_id;
					$_SESSION["my_login"] = 1;
					//------------------------------------
					// □ クッキーを保存する
					//------------------------------------
					setcookie("cooking[usr_id]",$usr_id);//ユーザIDを保存
					setcookie("cooking[usr_pw]",$usr_pw);//パスワードを保存
					//------------------------------------
					// □ マイページへジャンプ
					//------------------------------------
					header("Location: http://$host/mypage.php");
					exit;
				}
			}else{	//行が存在しない場合
				//------------------------------------
				// □ 友達テーブル(friends)をチェック
				//------------------------------------
				$sql = "SELECT friends.no,friendinfo.usrid FROM friends";
				$sql.= " LEFT JOIN friendinfo ON friends.no=friendinfo.no";
				$sql.= " WHERE friends.email='$usr_id'";
				$mysql->query($sql);
				if ($mysql->rows()>0){
					$row = $mysql->fetch();
					//----------------------------------------------
					// 一番最初にログインするときのチェック
					//----------------------------------------------
					if (!$row["usrid"] && $usr_pw == FIRST_PASS){
						$_SESSION["my_no"] = $row["no"];
						$_SESSION["my_login"] = 1;
						//------------------------------------
						// □ マイ情報設定ページへジャンプ
						//------------------------------------
						header("Location: http://$host/friendinfo.php");
						exit;
					}
				}
			}
			$error = "ユーザIDかパスワードに誤りがあります";
		}
	}
}
//--------------------------------------------------------------------
// ■　クッキーを取得する(POSTでないとき)
//--------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"]!="POST"){
	if (isset($_COOKIE["cooking"])) {
		$cooking = $_COOKIE["cooking"];	//クッキーを変数に保存
		$usr_id = $cooking["usr_id"];	//ユーザIDを取得
		$usr_pw= $cooking["usr_pw"];	//ユーザパスワードを取得
	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>お料理日記ページ</title>
</head>
<body>
<h3>お料理日記ページへようこそ♪</h3>
<?php
//--------------------------------------------------------------------
// ■　エラーメッセージがあったら表示
//--------------------------------------------------------------------
if (strlen($error)>0){
	echo "<font size=\"2\" color=\"#da0b00\">エラー：{$error}</font><p>";
}
?>
IDとパスワードを入れてログインしてくださいね♪<br>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
<table border="0">
<tr><td align="left">ユーザID</td><td><input type="text" name="usr_id" value="<?=$usr_id ?>" size="30"></td></tr>
<tr><td align="left">パスワード</td><td><input type="password" name="usr_pw" value="<?=$usr_pw ?>"></td></tr>
<tr><td align="right" colspan="2"><input type="submit" name="submit" value="ログインする"></td></tr>
</table>
<font size="2" color="#556b2f">初めてログインする方へ<br>
IDにメールアドレスを入力し、メールでお知らせした初期パスワードを入力してください。<br>
IDとパスワードはログイン後に独自パスワードに変更できます。<br><br>
</font>
</form>
</body>
</html>