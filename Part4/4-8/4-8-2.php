<?php
//====================================================================
// ●：4-8 メール操作
//====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>●：4-8 メールの受信</title>
</head>
<body>
<table border="1" cellpadding="5" cellspacing="0" bordercolor="#666666">
<tr bgcolor="#EEEEBB">
<td align="center"></td>
<td align="center">件名</td>
<td align="center">名前</td>
<td align="center">E-MAIL</td>
<td align="center">受信日時</td>
<td align="center">内容</td>

</tr>
<tr>
<?php
//------------------------------------
// ◎メールの受信
//------------------------------------
$mbox = imap_open("{mail.aaa.net:110/pop3}INBOX", "teru", "san");
if ($mbox){
	$mboxes = imap_check($mbox);
	$mailcnt = $mboxes->Nmsgs;
	if ($mailcnt > 0){
            	for ($i = 1;$i <= $mailcnt;$i++){
                	$header = imap_header($mbox, $i);
			$title = htmlspecialchars(mb_decode_mimeheader($header->subject));
			
			$fromdate= $header->date; 
			$from = $header->from; 
			$mailbox = $from[0]->mailbox;
			$email = $from[0]->mailbox."@".$from[0]->host;
			$namae = mb_decode_mimeheader($from[0]->personal);
		
			$content = imap_fetchbody($mbox,$i,1,FT_PEEK);
			$content = htmlspecialchars(mb_convert_encoding($content,"UTF-8","ISO-2022-JP"));

?>
<tr>
<td align="center"><?= $i ?></td>
<td align="left"><?= $title ?></td>
<td align="left"><?= $namae ?></td>
<td align="left"><?= $email ?></td>
<td align="left"><?= $fromdate ?></td>
<td align="left"><?= $content ?></td>

</tr>
<?php
		}
	}
	imap_close($mbox);
}else{
        echo "メールボックスに接続できませんでした。";
}
?>

</table>
<br><?=$mailcnt ?>件のメールを受信しました<p>

</body>
</html>
