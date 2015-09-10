<?php 
//====================================================================
// ●：5-7 GDライブラリを使う　ファイルに保存
//====================================================================
//HeaderにPNG画像タイプを指定
Header ("Content-type: image/png"); 

//領域作成 
$image = imagecreate(200, 200); 
//背景色の描画
$bcolor = imagecolorallocate($image, 255, 0, 255); 
//色の作成
$fcolor = imagecolorallocate($image, 255, 0, 0); 

//丸を描く 
imagefilledellipse($image,100,100,150,150,$fcolor); 

//png画像作成 
imagepng($image); 

//ファイルに保存 
@imagepng($image,"image.png"); 

//色リソースの開放 
imagecolordeallocate ($image,$bcolor); 
imagecolordeallocate ($image,$fcolor); 
//画像リソースの開放 
imagedestroy($image); 
?>             
