<?php
	$x=10;
	$y=3;
	echo ($x == 10) && ($y == 3);			//AもBもTRUEのとき
	echo ($x == 10) || ($y == 8);			//AかBがTRUEのとき
	echo ($x == 10) and ($y == 3);			//AもBもTRUEのとき
	echo ($x == 2) or ($y == 3);			//AかBがTRUEのとき
	echo ($x == 4) xor ($y == 3);			//AかBがどちらかが片方のみがTUREのとき
	echo !($x == 5);				//AがTRUEでないとき
	echo ($x == 10) && ($y == 3) && ($x * $y == 30);//AもBもCもTRUEのとき

?>