<?
//================================================================
// ■　プリンクラス　PHP5
//================================================================
class pudding5 extends jelly5{
	//---------------------------
	// □　秘密
	//---------------------------
	protected function himitsu(){
		return "一口食べると寿命が10年延びる♪";
	}
	//---------------------------
	// □　出来上がり！
	//---------------------------
	function dekiagari(){			
		return $this->m_amasa .$this->m_topping .$this->m_aji ."プリン";
	}
}
?>