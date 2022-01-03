<?php
class Votingdelegue_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function insert($oData){
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		if($this->db->insert($zDatabaseCommon.'.votingdelegue', $oData)){

			$iVoteDelegueId = $this->db->insert_id();
			return $iVoteDelegueId ;

		}else return false;
	}

	public function getCandidatVoting($_iUserId){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT * FROM ".$zDatabaseCommon.".votingdelegue WHERE votingDelegue_userId = " . $_iUserId;

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iVote = 0;

		if(sizeof($toRow)> 0){
			$iVote = 1;
		}
		return $iVote;
	}


	public function getDepartementCandidatVoting(){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT t_structure.path as path FROM rohi.candidat INNER JOIN rohi.t_structure ON child_id = structureId WHERE candidat.user_id = " . $_SESSION["userdata"]["id"];

		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result(); 

		$zPath = $oRowResult['path'];

		$toPath = explode("/", $zPath);

		$zWordSeek = ""; 

		if(isset($toPath[2]) && $toPath[2]!=""){
			
			$zWordSeek = $toPath[2];

			if($toPath[1]=="SG"){
				$zWordSeek = $toPath[1];
			} 

		} else {
			if(isset($toPath[1]) && $toPath[1]!=""){ 
				$zWordSeek = $toPath[1];
			} else {
				$zWordSeek = $toPath[0];
			}
		}
		
		return $zWordSeek;
	}

	public function getDepartementId(){
		
		global $db;

		$zWordSeek = $this->getDepartementCandidatVoting();
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT child_id, child_libelle,path FROM t_structure WHERE niveau = 'DEPT' AND t_structure.path LIKE '%" . $zWordSeek . "%'" ;

		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result();

		$iDepartementId = $oRowResult['child_id'];
		
		return $iDepartementId;
	}

	public function get_all_list_candidat($_oUser,$_oCandidat,$_iUserId, $_iCompteActif,$zTerm= "aa",$_iFiltre=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zWordSeek = $this->getDepartementCandidatVoting();
		
		$zSql= "SELECT candidat.* from $zDatabaseOrigin.candidat 
		INNER JOIN $zDatabaseOrigin.t_structure ON t_structure.child_id = candidat.structureId
		WHERE (nom LIKE '%$zTerm%' OR prenom LIKE '%$zTerm%' OR cin LIKE '%$zTerm%'  OR matricule LIKE '%$zTerm%')";
		
		$zSql .= " AND t_structure.path LIKE '%" . $zWordSeek . "%'" ; 
			

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}


	public function getIDepartementId(){
		
		$zSql= "SELECT * FROM common.departementvoting WHERE structureId = " . $_iId;
		
		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result(); 
		
		return $oRowResult['id'];

	}

	public function getAgentAVoterParDepartement(){
		
		$_iDepartementId = $this->getDepartementId();
		
		$zSql= " SELECT user_id,nom,prenom,matricule FROM common.delegueagent 
		INNER JOIN rohi.candidat ON candidat.user_id = delegueAgent_userId AND delegueAgent_departementId = " . $_iDepartementId ;
		$query = $this->db->query($zSql);
		return $query->result_array();
	}

	public function voterCandidat($candidat_user_id,$electeur_user_id,$date_vote){
		$zSql= " ";

		$this->db->query($zSql);
	}

	public function checkIfDejaVote($candidat_user_id,$electeur_user_id){
		$zSql= " ";
		$query = $this->db->query($zSql);
		$results	=	$query->result_array();
		
	}
}
?>