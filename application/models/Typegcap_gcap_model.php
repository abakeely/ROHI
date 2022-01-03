<?php
class TypeGcap_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('typegcap', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function get_by_TypeGcap_zHashPageUrl($_zHashUrl){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select typeGcap_id from typegcap where typeGcap_zHashUrl = '$_zHashUrl' ORDER BY typeGcap_id";
		$zQuery = $DB1->query($zSql);

		$oResult = $zQuery->result_array(); 

		$iModuleId = 0 ; 
		if (sizeof($oResult)> 0)
		{
			$iModuleId = $oResult[0]['typeGcap_id'] ; 
		}
		return $iModuleId;
	}

	public function get_type_by_TypeGcapId($_iTypeGcapId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "select * from type where type_typeGcapId = $_iTypeGcapId AND type_affiche = 1 ORDER BY type_id";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function get_TypeDecision_by_TypeGcapId($_iTypeGcapId){
		
		$iTypeGcapDecision = 0;

		switch($_iTypeGcapId)
		{
			case CONGE_ANNUEL:
				$iTypeGcapDecision = DECISISON_CONGE_ANNUEL ; 
				break;

			case CONGE_ANNUEL_CUMULE:
				$iTypeGcapDecision = DECISISON_CONGE_ANNUEL_CUMULE ; 
				break;

			case CONGE_EDUCATION:
				$iTypeGcapDecision = DECISISON_CONGE_EDUCATION ; 
				break;

			case CONGE_MALADIE:
				$iTypeGcapDecision = DECISISON_CONGE_MALADIE ; 
				break;

			case CONGE_CURE_THERMAL:
				$iTypeGcapDecision = DECISISON_CONGE_CURE_THERMAL ; 
				break;

			case CONGE_LONG_DUREE:
				$iTypeGcapDecision = DECISISON_CONGE_LONG_DUREE ; 
				break;

			case CONGE_FIN_SEJOUR:
				$iTypeGcapDecision = DECISISON_CONGE_FIN_SEJOUR ; 
				break;
		}

		return $iTypeGcapDecision ;
	}

	public function getNomType($_iTypeId){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select type_libelle from type where type_id = '$_iTypeId'";
		$zQuery = $DB1->query($zSql);

		$oResult = $zQuery->result_array(); 

		$zLibelleType = 0 ; 
		if (sizeof($oResult)> 0)
		{
			$zLibelleType = $oResult[0]['type_libelle'] ; 
		}
		return $zLibelleType;
	}
	
}
?>