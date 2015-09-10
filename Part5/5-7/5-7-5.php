<?php 
//====================================================================
// ●：5-7 GDライブラリを使う　画像の大きさを変える
//====================================================================
//縦横サイズを取得
list($width,$height)=getimagesize("image.png");
$src = @imagecreatefrompng("./image.png");

//縦横サイズを半分に
$width2 = $width / 2;
$height2 = $width / 2;

//変更後の画像領域を作成
$dst=imagecreatetruecolor($width2 ,$height2);

//画像の大きさを変更
imagecopyresized($dst,$src,0,0,0,0,$width2,$height2,$width,$height);

//画像を保存
imagepng($dst,"image2.png");

//ブラウザに出力
?>             
<img src="image.png"><br><br>
<img src="image2.png">
