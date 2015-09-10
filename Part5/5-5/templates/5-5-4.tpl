<html>
<head>
<meta http-equive="Content-type" content="text/html; charset=utf-8">
<title>Smartyを使ったテーブル出力</title>
</head>
<body>
<br>
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *<br>
{$title}<br>
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *<br>
<br>
<table border="1">
{section name=cnt loop=$data}
<tr>
<td><font size="2">{$smarty.section.cnt.index}</font></td>
<td>{$data[cnt]}</td>
</tr>
{/section}
</table>
<br><br>
- - - - - - - - - - - - - - - - - - - - - - - - - - - -<br>
{$ymdhis}作成
</body>
</html>
