<?php
//====================================================================
// ●：4-6 ファイル操作(1)
//====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：4-6 ファイル操作</title>
</head>
<body>
<b>更新ボタンで更新してください。<br>
[現在時刻 ==> 乱数]のデータがファイルに追加されます</b><p>
<?php
//----------------------------------------------- 
// □　ファイルの作成(1)
//----------------------------------------------- 
$filename = date("H") .".txt";		//hh(XX時)をファイル名にする
$fh = @fopen($filename,"a"); 		//追加書き込みモードで開く（ファイルが無いときは作成) 
if (!$fh){ 
	//メッセージを出してスクリプトを終了
	exit("ファイル書き込みのオープンで失敗しました");
}else{ 
        //排他ロック 
        flock($fh,LOCK_EX); 
        //乱数を保存
        $msg = date("Y/m/d H:i:s") ." ==> ";
	$msg.= rand(1,9999) ."\n";
        //書き出し 
        fputs($fh,$msg); 
        //ロックを解除 
        flock($fh,LOCK_UN);     
        //ファイルを閉じる 
        fclose($fh);         
} 
//--------------------------------------------- 
// □　ファイルを読む(fgets関数) 
//--------------------------------------------- 
echo "<b>■fgets関数</b><br>";
if (file_exists($filename)){ 
	//読み取りモードで開く 
	$fh = @fopen($filename,"r"); 
	if (!$fh){ 
		//メッセージを出してスクリプトを終了
		exit("ファイル読み込みのオープンで失敗しました");
	}else{ 
        	while(!feof($fh)){ 
			//一行ずつ（改行記号まで）読み込み
			$temp = fgets($fh); 
			//内容を出力
			if ($temp>""){echo str_replace("\n","<br>",$temp);}
        	} 
        	//ファイルを閉じる 
        	fclose($fh);                 
	} 
} 
//--------------------------------------------- 
// □　ファイルを読む(file関数)
//--------------------------------------------- 
echo "<b>■file関数</b><br>";
if (file_exists($filename)){ 
	//内容を配列に取り込む
	$temp = file($filename);
	//内容を出力
	foreach ($temp as $num => $line) {

    		if ($line>""){echo str_replace("\n","<br>",$line);}
	} 
} 
//--------------------------------------------- 
// □　ファイルを読む(file_get_contents関数)
//--------------------------------------------- 
echo "<b>■file_get_contents関数</b><br>";

if (file_exists($filename)){ 
	//内容を文字列に取り込む
	$temp = file_get_contents($filename);
	//内容を出力
	if ($temp>""){echo str_replace("\n","<br>",$temp);}
} 

?>
</body>
</html>
