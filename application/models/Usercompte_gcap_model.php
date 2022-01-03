<?php
class Usercompte_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('usercompte', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function get_all_list_compte(&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "ASC", $_zFieldOrder = "nom"){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "select SQL_CALC_FOUND_ROWS * from $zDatabaseOrigin.candidat 
		INNER JOIN usercompte ON userCompte_userId = user_id
		INNER JOIN compte ON userCompte_compteId = compte_id";

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;
		

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $oRow;
	}

	public function delete_compte_candidat($_iUserId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('delete from usercompte where userCompte_userId = '.$_iUserId . " AND userCompte_compteId <> " . COMPTE_EVALUATEUR);
	}

	public function delete_compte_candidat_evaluateur($_iUserId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('delete from usercompte where userCompte_userId = '.$_iUserId . " AND userCompte_compteId = " . COMPTE_EVALUATEUR);
	}


	public function getCompteDelegue($_iUserId){
		
		$iUserReturn = $_iUserId ; 
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select * from usercompte where userCompte_userId = '$_iUserId'";
		$zQuery = $DB1->query($zSql);
		$toUserCompte = $zQuery->result_array();

		if (sizeof($toUserCompte)>0)
		{
			$iUserReturn = $toUserCompte[0]['userCompte_titulaireUserId'] ; 
		}

		return $iUserReturn ; 
	}

	public function getRoleAgent() {

		global $db;
		$zDatabaseRohi =  $db['default']['database'] ; 

		$zSql= "select * from ".$zDatabaseRohi.".user where role = 'chef'";
		$zQuery = $this->db->query($zSql);
		$toAgentChef = $zQuery->result_array();

		foreach ($toAgentChef as $oAgentChef){
			
			echo $oAgentChef['id'] . " > " .$oAgentChef['nom'] . "-" . $oAgentChef['prenom'] . "\n" ; 
			$this->setCompteRespPers($oAgentChef['id']);
		}

	}

	public function setCompteRespPers($_iUserId){
		
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql= "select * from ".$zDatabaseGcap.".usercompte where userCompte_userId = '$_iUserId' AND userCompte_compteId = " . COMPTE_RESPONSABLE_PERSONNEL;
		$zQuery = $this->db->query($zSql);
		$toUserCompte = $zQuery->result_array();

		if (sizeof($toUserCompte)>0){

		} else {
			$zSql = "INSERT INTO ".$zDatabaseGcap.".usercompte VALUES (".$_iUserId .",". COMPTE_RESPONSABLE_PERSONNEL.",'')" ;

			echo $zSql ; 
			$this->db->query($zSql);
		}

		return $iUserReturn ; 
	}
	
	
}
?>