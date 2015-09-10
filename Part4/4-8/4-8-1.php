<?php
//====================================================================
// ●：4-8 メールの送信
//====================================================================

$mailto = "aaa@bbb.ccc";
$subject = "タイトルですよ";
$content = "内容を入れます\nあああ\nいいい";
//$mailfrom = "From:aaaa@bbb.ccc";
$mailfrom="From:" .mb_encode_mimeheader("あやこ") ." <ddd@eee.fff>";
if (mb_send_mail($mailto,$subject,$content,$mailfrom)){
	echo "送信完了！♪";
}else{
	echo "送信失敗・・・";
}
?>

