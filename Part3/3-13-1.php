<?php
	//ネコ何回？

	$neko = "ネコ";
	$kotoba = $neko ;
	echo "$kotoba<br>";

	$kotoba = $kotoba .$neko .$neko .$neko;
	echo "$kotoba<br>";

	$kotoba .= $neko;
	$kotoba .= $neko;
	$kotoba .= $neko;
	$kotoba .= $neko;
	$kotoba .= $neko;
	echo "$kotoba<br>";
?>