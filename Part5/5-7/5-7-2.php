<?php 
//====================================================================
// ●：5-7 GDライブラリを使う　線引き
//====================================================================
//HeaderにPNG画像タイプを指定
Header ("Content-type: image/png"); 

//領域作成 
$image = imagecreate(300, 300); 
//背景色の描画(赤) 
$bcolor = imagecolorallocate($image, 255, 0, 0); 
//色の作成(白) 
$fcolor = imagecolorallocate($image, 255, 255, 255); 
//線を引く 
imageline($image,50,50,250,250,$fcolor); 
//png画像作成 
imagepng($image); 
//色リソースの開放 
imagecolordeallocate ($image,$bcolor); 
imagecolordeallocate ($image,$fcolor); 

//画像リソースの開放 
imagedestroy($image); 
?> 
