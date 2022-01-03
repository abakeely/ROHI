<?php
class Module_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		if($this->db->insert('module', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_module($_iUserId = FALSE){

		$DB1 = $this->load->database('gcap', TRUE);

		/*$zSql= "SELECT module.* FROM module
		INNER JOIN privilege ON privilege_moduleId = module_id
		INNER JOIN compte ON privilege_compteId = compte_id
		INNER JOIN usercompte ON userCompte_compteId = compte_id
		WHERE userCompte_userId = $_iUserId";*/

		if (empty($_SESSION["session_compte"]))
		{
			$_SESSION["session_compte"] = COMPTE_AGENT ; 
		}

		$zSql= "SELECT module.* FROM module
		INNER JOIN privilege ON privilege_moduleId = module_id
		INNER JOIN compte ON privilege_compteId = compte_id
		WHERE module_active=1 AND privilege_compteId = ".$_SESSION["session_compte"]."  GROUP BY module_id ORDER BY module_ordre ASC";

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;

	}
	
	public function get_by_module_id($_iModuleId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "select * from module where module_id = $_iModuleId ORDER BY module_id";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function get_module_rubrique($_zRubrique){

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseCommon =  $db['common']['database'] ;

		$zSql= "select * from $zDatabaseCommon.rubrique where rubrique_code = '".$_zRubrique."'";
		$zQuery = $DB1->query($zSql);

		$zRubriqueLibelle = "";
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		if (sizeof($oRow)>0){
			$zRubriqueLibelle = $oRow[0]->rubrique_libelle;
		}
		return $zRubriqueLibelle;
	}

	public function get_by_module_zHashModule($_zHashModule){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select module_id from module where module_zHashUrl = '$_zHashModule' ORDER BY module_id";
		$zQuery = $DB1->query($zSql);

		$oResult = $zQuery->result_array(); 

		$iModuleId = 0 ; 
		if (sizeof($oResult)> 0)
		{
			$iModuleId = $oResult[0]['module_id'] ; 
		}
		return $iModuleId;
	}
}
?>