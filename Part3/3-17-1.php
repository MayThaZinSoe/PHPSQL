<?php
	$data = array("キャベツ"=>100,"レタス"=>200,"トマト"=>300,"しいたけ"=>400);
	//----------------------------------------
	// ■ 配列のループ
	//----------------------------------------
	foreach($data as $value){
		echo $value ."円！<br>";
	}
	//----------------------------------------
	// ■ 配列のループ(拡張)
	//----------------------------------------
	foreach($data as $key => $value){
		echo $key ."は" .$value ."円です<br>";
	}
?>
