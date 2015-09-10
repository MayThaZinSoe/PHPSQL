<?php
//====================================================================
// ●：5-6 PEAR(Calendar)ライブラリを読み込み
//====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>5-5 PEAR(Calendar)ライブラリを読み込み</title>
</head>
<body>
<?php
//--------------------------------------
// □ PEAR(Calendar)ライブラリを読み込み
//--------------------------------------
require_once("Calendar/Month/Weekdays.php");
//--------------------------------------
// □ インスタンスの作成
//--------------------------------------
$Month = new Calendar_Month_Weekdays(date("Y"),date("n"),0);
//--------------------------------------
// □ 表示
//--------------------------------------
$Month->build();
echo date("Y") ."年" .date("m") ."月";
echo "<table border=\"1\">\n";
echo "<tr>\n";
echo "<td>日</td>\n";

echo "<td>月</td>\n";
echo "<td>火</td>\n";
echo "<td>水</td>\n";
echo "<td>木</td>\n";
echo "<td>金</td>\n";
echo "<td>土</td>\n";

echo "</tr>\n";
while ($Day = $Month->fetch()) {
    if ($Day->isFirst()){
        echo "<tr>\n";
    }
    if ($Day->isEmpty()) {
        echo "<td>&nbsp;</td>\n";
    }else{
        echo "<td>" .$Day->thisDay()."</td>\n";
    }
    if ($Day->isLast()){
        echo "</tr>\n";
    }
}
echo "</table>\n";
?>
</body>
</html>
