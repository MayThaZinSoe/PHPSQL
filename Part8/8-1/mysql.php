<?php
//======================================================================
//   ■：MySQL クラス
//======================================================================
class MySQL{
	//---------------------------
	// □：変数の宣言
	//---------------------------
	var $m_Con;
	var $m_HostName = "";
	var $m_UserName = "";
	var $m_Password = "";
	var $m_Database = "";
	var $m_Rows = 0;
	//---------------------------
	// □：コンストラクタ
	//---------------------------
	function MySQL(){
		$filename = "C:\common/mysql.ini";	//＜＝＝Windows
		//$filename = "/etc/mysql.ini";		//＜＝＝Linun

		if (!file_exists($filename)){
			die("mysql.iniファイルが存在しません。");
		}Else{
			$fp = fopen($filename,"r");
			if (!$fp){
				die("mysql.iniファイルが存在しません。");
			}Else{
				$this->m_HostName=trim(fgets($fp));
				$this->m_UserName=trim(fgets($fp));
				$this->m_Password=trim(fgets($fp));
				$this->m_Database=trim(fgets($fp));
			}
			fclose($fp);
		}
		
		//MYSQLへ接続	
		$this->m_con = mysql_connect($this->m_HostName,$this->m_UserName,$this->m_Password);
		if (!$this->m_con){
			die("MYSQLの接続に失敗しました。");
		}
		//データベースを選択
		if (!mysql_select_db($this->m_Database,$this->m_con)){
			die("データベースの選択に失敗しました。DB:{$this->m_Database}");
		}
	}
	//---------------------------
	// SQLクエリの処理
	//---------------------------
	function query($sql){
		$this->m_Rows = mysql_query($sql,$this->m_con);
		if (!$this->m_Rows){
			 die("MySQLでエラーが発生しました。<br><b>$sql</b><br>" .mysql_errno().": ".mysql_error());
		}
		return $this->m_Rows;
	}
	//---------------------------
	// 検索結果をfetch
	//---------------------------
	function fetch(){
		return mysql_fetch_array($this->m_Rows);
	}
}
?>
