<?
//================================================================
// ■□　ゼリークラス
//================================================================
class jelly{
	var $m_aji = "味なし";
	var $m_amasa = "";
	var $m_topping = "";
	//---------------------------
	// □　コンストラクタ
	//---------------------------
	function jelly($aji){
		$this->m_aji = $this->aji($aji);
	}
	//---------------------------
	// □　味
	//---------------------------
	function aji($aji){
		switch($aji){
			case "1":
				return "オレンジ";
				break;
			case "2":
				return "苺";
				break;
			case "3":
				return "マンゴー";
				break;
			case "4":
				return "珈琲";
				break;
			case "5":
				return "ミルク";
				break;
		}
	}
	//---------------------------
	// □　甘さ
	//---------------------------
	function toudo($amasa){
		switch($amasa){
			case "0":
				$this->m_amasa= "甘くない";
				break;
			case "1":
				$this->m_amasa= "ちょっぴり甘い";
				break;
			case "2":
				$this->m_amasa= "ほんのりと甘い";
				break;
			case "3":
				$this->m_amasa= "とっても甘い";
				break;
			case "4":
				$this->m_amasa= "めちゃめちゃ甘～い";
				break;
		}
	}
	//---------------------------
	// □　トッピング
	//---------------------------
	function ue($topping){
		switch($topping){
			case "0":
				$this->m_topping= "";
				break;
			case "1":
				$this->m_topping= "生クリームがたっぷりのった";
				break;
			case "2":
				$this->m_topping= "フルーツソースがかかった";
				break;
			case "3":
				$this->m_topping= "苺がのった";
				break;
			case "4":
				$this->m_topping= $this->himitsu();
				break;
		}
	}
	//---------------------------
	// □　秘密
	//---------------------------
	function himitsu(){
		return "お肌がすべすべになるエキスが入っている";
	}
	//---------------------------
	// □　出来上がり！
	//---------------------------
	function dekiagari(){			
		return $this->m_amasa .$this->m_topping .$this->m_aji ."ゼリー";
	}
}
?>
