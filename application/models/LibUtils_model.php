<?php
class LibUtils_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public  function date_fr_to_en($date_to_convert, $separator_fr, $separtor_en){
		if($date_to_convert && isset($date_to_convert)){
			$tab = explode($separator_fr, $date_to_convert);
			if (count($tab) == 3) {
				$res = $tab[2] . $separtor_en . $tab[1] . $separtor_en . $tab[0];
				return $res;
			}
		}
			
		return $date_to_convert;
	}

	public  function date_en_to_fr($date_to_convert, $separator_en, $separtor_fr){
		if($date_to_convert && isset($date_to_convert)){
			$tab = explode($separator_en, $date_to_convert);
			if (count($tab) == 3) {
				$res = $tab[2] . $separtor_fr . $tab[1] . $separtor_fr . $tab[0];
				return $res;
			}
		}
		return $date_to_convert;
	}
}
?>