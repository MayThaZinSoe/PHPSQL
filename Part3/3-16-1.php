<?php
	$data = array("いちご","りんご","バナナ","みかん","スイカ","メロン");
	//----------------------------------------
	// ■ while
	//----------------------------------------
	echo "<b>while文を使って出力します!</b><br>";
	$i = 0;
	while($i <= 5){
		echo "$data[$i]<br>";
		if ($i >= 3){break;}
		$i++;
	} 
	echo "</pre>";
	//----------------------------------------
	// ■ for
	//----------------------------------------
	echo "<b>for文を使って出力します!</b><br>";
	for ($i = 3;$i <= 5;$i++){
		echo "$data[$i]<br>";
	} 
	echo "</pre>";
?>