<?php
//====================================================================
// ●：4-5 正規表現
//====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：4-5 正規表現</title>
</head>
<body>
<?php
//---------------------------------------------------
// ○ 数字
//---------------------------------------------------
$moji = "ABCabc123";
echo "<b>$moji</b>を正規表現チェック";

echo "<br>0～9までの数字があるかをチェック:";
if (preg_match("/[0-9]/",$moji)){echo "○";}else{echo "×";}

echo "<br>5桁の4から9までの数字だけの文字が含まれているかどうかチェック";
if (preg_match("/[4-9]{5}/",$moji)){echo "○";}else{echo "×";}

echo "<br>2～4桁の1から5までの数字だけの文字が含まれているかどうかチェック:";
if (preg_match("/[1-5]{2,4}/",$moji)){echo "○";}else{echo "×";}

echo "<br>8桁以上の4から7までの数字だけの文字が含まれているかどうかチェック:";
if (preg_match("/[4-7]{8,}/",$moji)){echo "○";}else{echo "×";}

echo "<br>1桁以上の4から7までの数字だけの文字が含まれているかどうかチェック:";
if (preg_match("/[4-7]+/",$moji)){echo "○";}else{echo "×";}

echo "<br>0以上の4から7までの数字だけの文字が含まれているかどうかチェック:";
if (preg_match("/[4-7]*/",$moji)){echo "○";}else{echo "×";}
//---------------------------------------------------
// ○ 英字
//---------------------------------------------------

echo "<br>AからZまでの英字があるかないかをチェック:";
if (preg_match("/[A-Z]*/",$moji)){echo "○";}else{echo "×";}

echo "<br>aからzまでの英字があるかないかをチェック:";
if (preg_match("/[a-z]*/",$moji)){echo "○";}else{echo "×";}

echo "<br>aからzまたはAからZまでの英字があるかないかをチェック:";
if (preg_match("/[a-zA-Z]*/",$moji)){echo "○";}else{echo "×";}

echo "<br>8桁以上のの英字だけの文字が含まれているかどうかチェック:";
if (preg_match("/[a-zA-Z]{8,}/",$moji)){echo "○";}else{echo "×";}

echo "<br>Pが1文字以上含まれているかどうかチェック:";
if (preg_match("/P+/",$moji)){echo "○";}else{echo "×";}
//---------------------------------------------------
// ○ その他
//---------------------------------------------------

echo "<br>Aではない文字がある場合チェック:";
if (preg_match("/[^A]/",$moji)){echo "○";}else{echo "×";}

echo "<br>数字以外が1文字以上含まれている場合をチェック:";
if (preg_match("/[^0-9]+/",$moji)){echo "○";}else{echo "×";}

echo "<br>AAAではじまっているかチェック:";
if (preg_match("/^AAA/",$moji)){echo "○";}else{echo "×";}

echo "<br>BBで終わっているかチェック:";
if (preg_match("/BB$/",$moji)){echo "○";}else{echo "×";}
//---------------------------------------------------
// ○ 電話番号
//---------------------------------------------------
$tel = "03-1234-5678";
$check1 = "/^[0-9-]*$/";
$check2 = "/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/";
$check3 = "/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{4}$/";

echo "<br><b>電話番号：$tel</b>";

echo "<br>$check1:";
if (preg_match($check1,$tel)){echo "○";}else{echo "×";}

echo "<br>$check2:";
if (preg_match($check2,$tel)){echo "○";}else{echo "×";}

echo "<br>$check3:";
if (preg_match($check3,$tel)){echo "○";}else{echo "×";}

//---------------------------------------------------
// ○ メールアドレス
//---------------------------------------------------
$email = "aaa@bbb.ccc";
echo "<br><b>メールアドレス：$email</b>";

$check1 = "/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/";

$check2 = "/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/";

$check3 = "/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+\.[A-Za-z0-9_\.\-]+$/";

echo "<br>$check1:";
if (preg_match($check1,$email)){echo "○";}else{echo "×";}

echo "<br>$check2:";
if (preg_match($check2,$email)){echo "○";}else{echo "×";}

echo "<br>$check3:";
if (preg_match($check3,$email)){echo "○";}else{echo "×";}

//---------------------------------------------------
// ○ URL
//---------------------------------------------------
$url = "http://aaa.bbb.ccc";
echo "<br><b>URL：$url</b>";
$check = "{(https?|ftp|news)(://[[:alnum:]\+\$\;\?\.%,!#~*\/:@&=_-]+)}";
echo "<br>$check:";
if (preg_match($check,$url)){echo "○";}else{echo "×";}
?>
</body>
</html>
