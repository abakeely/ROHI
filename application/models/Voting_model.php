<?php
class Voting_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function getCandidatVoting($electeur_user_id){
		$sql= " SELECT  b.*,
						a.candidat_user_id,
						a.description,
						(SELECT id FROM vote_delegue WHERE candidat_user_id=a.candidat_user_id AND electeur_user_id='".$electeur_user_id."') id_vote
					 FROM rohi.candidat_election_delegue a
					 INNER JOIN rohi.candidat b
					 ON a.candidat_user_id = b.user_id
					  ";
		$sql= $sql . "  ORDER BY RAND() " ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getMesCandidats($electeur_user_id){
		$sql= " SELECT  b.*,
						a.candidat_user_id,
						a.description
					 FROM rohi.candidat_election_delegue a
					 INNER JOIN rohi.candidat b
					 ON a.candidat_user_id = b.user_id
					  ";
		if( isset($electeur_user_id) ){
			$sql= $sql . "  WHERE candidat_user_id in( SELECT candidat_user_id from rohi.vote_delegue where electeur_user_id= '".$electeur_user_id."' ) " ;
		}
		$sql= $sql . "  ORDER BY RAND() " ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function voterCandidat($candidat_user_id,$electeur_user_id,$date_vote){
		$sql= " insert into vote_delegue (candidat_user_id,electeur_user_id,date_vote) 
						values 
				('".$candidat_user_id."','".$electeur_user_id."','".$date_vote."')";

		$this->db->query($sql);
	}

	public function checkIfDejaVote($candidat_user_id,$electeur_user_id){
		$sql= " SELECT * FROM vote_delegue WHERE candidat_user_id ='".$candidat_user_id."' AND electeur_user_id='".$electeur_user_id."' ";
		$query = $this->db->query($sql);
		$results	=	$query->result_array();
		if(sizeof($results) > 0 ){
			return "EXIST";
		}else{
			return "NOTEXIST";
		}
	}
}
?>