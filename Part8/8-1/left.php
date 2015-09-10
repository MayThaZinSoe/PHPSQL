<?php
//===========================================================================
// ■ 左バーの表示内容記述　left.php
//===========================================================================
if ($usr_no==$my_no){
	$color = MY_COLOR;
}else{
	$color = TOMO_COLOR;
}
?>
<td align="left" valign="top" bgcolor="<?=$color?>" width="200">
<font size="2">
<?php
//-----------------------------------------------------
// □：友達情報テーブル(friendinfo)からデータを読む
//-----------------------------------------------------
$sql = "SELECT * FROM friendinfo WHERE no=$usr_no";
$mysql->query($sql);
if ($mysql->rows()>0){
	$row = $mysql->fetch();
	$msg = $row["msg"];
	echo "<b>[$usr_id]</b>";
	if ($my_no<>$usr_no){
		echo "さん";
	}
	echo "のヒトコト<p>";
	get_url($msg);
	echo "<font color=\"#2b8e57\">$msg</font>";
}
?>
<br><br>

<b>最新<?=LIST_NEW_COUNT ?>件お料理日記</b><p>
<?php
//-----------------------------------------------------
// □：クッキングログテーブル(cookinglog)からデータを読む
//-----------------------------------------------------
$sql = "SELECT cookinglog.*,friendinfo.usrid as usrid FROM cookinglog";
$sql.= " LEFT JOIN friendinfo ON cookinglog.no=friendinfo.no";
$sql.= " ORDER BY logno DESC LIMIT 0," .LIST_NEW_COUNT;
$mysql->query($sql);
while($row = $mysql->fetch()){
	$tm_no = $row["no"];
	$tm_id = $row["usrid"];
	$logno = $row["logno"];
	if ($tm_no<>$my_no){
		$tm_id.="さん";
	}
	$tm_title = mb_substr($row["title"],0,14) ."...";
	$tm_date = $row["upddate"];
	echo "<a href=\"./cookingread.php?usr_no=$tm_no&log_no=$logno\">$tm_id:$tm_title</a><p>";
}
?>
<b>お友達リンク</b><p>
<?php
//-----------------------------------------------------
// □：友達情報テーブル(friendinfo)からデータを読む
//-----------------------------------------------------
$sql = "SELECT * FROM friendinfo WHERE no<>$my_no";
$mysql->query($sql);
while($row = $mysql->fetch()){
	$tomo_no = $row["no"];
	$tomo_id = $row["usrid"];
	if ($tomo_no<>$my_no){
		$tomo_id.="さん";
	}
	echo "♪<a href=\"./mypage.php?usr_no=$tomo_no\">$tomo_id</a><p>";
}
?>
</font>
</td>