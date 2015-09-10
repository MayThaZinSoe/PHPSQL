<?php
	//----------------------------------------
	// ■ 曜日を確認します
	//----------------------------------------
	switch(date("w")){
	    case 0:
	        echo "今日は日曜日です。";
	        break;
	    case 1:
	        echo "今日は月曜日です。";
	        break;
	    case 2:
	        echo "今日は火曜日です。";
	        break;
	    case 3:
	        echo "今日は水曜日です。";
	        break;
	    case 4:
	        echo "今日は木曜日です。";
	        break;
	    case 5:
	        echo "今日は金曜日です。";
	        break;
	    case 6:
	        echo "今日は土曜日です。";
	        break;
	    default:
	        echo "ここにはきません(*^_^*)";
}
?> 
