<?php 
//====================================================================
// ●：5-7 GDライブラリを使う　四角と丸
//====================================================================
//HeaderにPNG画像タイプを指定
Header ("Content-type: image/png"); 

//領域作成 
$image = imagecreate(200, 200); 
//背景色の描画(白) 
$bcolor = imagecolorallocate($image, 255, 255, 255); 
//色の作成(青) 
$blue = imagecolorallocate($image, 0, 0, 255); 
//色の作成(緑) 
$green = imagecolorallocate($image, 0, 255, 0); 

//四角を描く 
imagefilledrectangle($image,50,50,100,100,$blue); 
//丸を描く 
imagefilledellipse($image,150,150,50,50,$green); 

//png画像作成 
imagepng($image); 
//色リソースの開放 
imagecolordeallocate ($image,$bcolor); 
imagecolordeallocate ($image,$blue); 
imagecolordeallocate ($image,$green); 
//画像リソースの開放 
imagedestroy($image); 
?> 
