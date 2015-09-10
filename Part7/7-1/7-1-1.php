<?php
//------------------------------	
// □：サーバに接続
//------------------------------	
$my_Con = mysql_connect("localhost","masago","bunbun");
if ($my_Con == false){
	die("MYSQLの接続に失敗しました。");
}else{
	echo "接続成功！";
}
?>
