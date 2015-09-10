<?php
//====================================================================
// ●：5-7 GDライブラリを使う　領域描画
//====================================================================
//HeaderにPNG画像タイプを指定
Header ("Content-type: image/png"); 
$image = imagecreate(200, 200);
$black = imagecolorallocate($image, 0, 0, 0);
imagepng($image);
imagedestroy($image);
?> 
</body>
</html>
