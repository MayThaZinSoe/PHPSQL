<?
//================================================================
// ■　ババロアクラス
//================================================================
class babaroa extends jelly{
	//---------------------------
	// □　コンストラクタ
	//---------------------------
	function babaroa($aji){
		$this->m_aji = $this->aji($aji);
	}
	//---------------------------
	// □　秘密
	//---------------------------
	function himitsu(){
		return "食べると中からダイアモンドが出てくる＼(^o^)／";
	}
	//---------------------------
	// □　出来上がり！
	//---------------------------
	function dekiagari(){			
		return $this->m_amasa .$this->m_topping .$this->m_aji ."ババロア";
	}
}
?>
