<?php
//======================================================================
//  ■： 7-3 MySQLへ接続 - データベースの選択 - データの表示
//======================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=euc-jp">
<title>7-3 MySQL　データの表示</title>
</head>
<body>
<?php
//------------------------------	
// □：サーバに接続
//------------------------------	
$my_Con = mysql_connect("localhost","masago","bunbun");
if ($my_Con == false){
	die("MYSQLの接続に失敗しました。");
}
//------------------------------	
// □：データベースに接続
//------------------------------	
if (!mysql_select_db("cooking",$my_Con)){
	die("データベースの接続に失敗しました。");
}
//------------------------------	
// □：テーブルからデータを読む
//------------------------------	
$my_Row = mysql_query("SELECT * FROM friends",$my_Con);
if (!$my_Row){
	die(mysql_error());
}
while($row = mysql_fetch_array($my_Row)){
	echo $row["no"];
	echo $row["name"];
	echo $row["birth"];
	echo $row["email"];
	echo "<br>";
}
?>
</body>
</html>