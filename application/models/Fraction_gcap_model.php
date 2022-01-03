<?php
class Fraction_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('fraction', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateFraction($oData, $_iFraction){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.fraction', $oData, "fraction_id = $_iFraction");
	}

	public function get_fractions_by_conge_id($_iGcapId, $_iUserId){
		
		$DB1 = $this->load->database('gcap', TRUE);


		$zSql= "SELECT *,
					IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = ".$_iUserId."),0) AS nbrJourCumule, 
					(decision_nbrJour -(IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = ".$_iUserId."),0))) AS reste 
				FROM fraction 
				INNER JOIN decision 
				ON fraction_decisionId = decision_id where 
				fraction_congeId = ".$_iGcapId." 
				AND decision_userId =".$_iUserId."
				ORDER BY decision_annee";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();


	}

	public function delete_fraction_by_conge_id($_iGcapId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "delete from  fraction WHERE fraction_congeId = " . $_iGcapId;
		$DB1->query($zSql);
	}

	public function delete_fraction_by_id($_iId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "delete from  fraction WHERE fraction_id = " . $_iId;
		$DB1->query($zSql);
	}

	public function delete_decision1($_iId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "delete from  decision WHERE decision_id = " . $_iId;
		$DB1->query($zSql);
	}
	
}
?>