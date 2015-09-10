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
if (mysql_select_db("cooking",$my_Con)){
	echo "cookingデータベースの選択成功！";
}else{
	die("データベースの選択に失敗しました。");
}
?>
