<?php
class CongeLast_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){

		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('delete from congelast where conge_userId = '.$oData['conge_userId']);
		if($DB1->insert('congelast', $oData)){
			return $DB1->insert_id();
		}else return false;
	}
	
	public function get_all_list_congeCandidat($_zCandidat, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "ASC", $_zFieldOrder = "c.nom"){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "select SQL_CALC_FOUND_ROWS *, c.nom AS nomCandidat, c.prenom AS prenomCandidat from $zDatabaseOrigin.candidat c
		INNER JOIN $zDatabaseOrigin.user u ON c.user_id = u.id
		LEFT JOIN congelast cl ON cl.conge_userId = c.user_id";

		if ($_zCandidat != "") {
			$zSql .= " WHERE c.nom like '%" . $_zCandidat . "%' OR c.prenom like '%" . $_zCandidat . "%' " ;
		}

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;

		//echo $zSql ;
		

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

	public function getCongeLastUser($_iUserId)
	{

        $zQuery = "SELECT conge_value FROM congelast WHERE conge_userId = '$_iUserId' " ;

		$oQuery = $this->db->query($zSql);
		$oRow = $oQuery->result_array();
		$oQuery->free_result();

		foreach($oRow as $toData){
            $fCongeValue = $oRow [0] ;
        }


		return $fCongeValue;
	}

	public function getAllLastCongeUser($_iUserId)
	{

        //$zQuery = "SELECT * FROM lastconge WHERE lastConge_userId = '$_iUserId' ORDER BY lastConge_annee ASC " ;
		$DB1 = $this->load->database('gcap', TRUE);

		$zQuery = "SELECT * FROM decision 
					LEFT JOIN fraction ON decision_id = fraction_decisionId 
					INNER JOIN type ON decision_typeId = type_id 
					WHERE decision_userId = '$_iUserId' 
					AND decision_last = 1 
					ORDER BY decision_annee ASC " ;

        $zQuery = $DB1->query($zQuery);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		return $toRow ;

	}

	public function getAllLastCongeUserA($_iUserId)
	{

        global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$DB1 = $this->load->database('gcap', TRUE);

		$zQuery = "SELECT decision.*,fraction.*,nom,prenom,(SELECT COUNT(fraction_id) FROM fraction WHERE fraction_decisionId = decision_id) AS nb FROM decision 
		LEFT JOIN fraction ON ( decision_id = fraction_decisionId AND decision_userId = fraction_userId)
		INNER JOIN $zDatabaseOrigin.candidat on user_id = decision_userId
		INNER JOIN type ON decision_typeId = type_id WHERE decision_userId = '$_iUserId' ORDER BY decision_annee ASC " ;

        $zQuery = $DB1->query($zQuery);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		return $toRow ;

	}

	public function deleteLastConge($iLastCongeId) {

		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('delete from lastconge where lastConge_id = '.$iLastCongeId);
	}

	public function getLastCongeById($_iCongeLastId){

		$DB1 = $this->load->database('gcap', TRUE);
		$query = $DB1->get_where('lastconge', array('lastConge_id' => $_iCongeLastId));
		return $query->row_array();
	}

	public function insertLastConge($oData, $iLastCongeId){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if ($iLastCongeId == 0) {
			if($DB1->insert('lastconge', $oData)){
				return $DB1->insert_id();
			}
		} else {
			$DB1->update('lastconge', $oData, "lastConge_id = $iLastCongeId");
		}
	}
}
?>