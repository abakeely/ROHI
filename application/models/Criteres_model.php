<?php
class Criteres_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->model('Gcap_gcap_model','GcapService');
	}
	

	public function ajaxCountAgent($evaluateur_id,$exercice,$parameters){
		$sql= " select count(*) as nb_records from candidat ";
		$zUserId	=	$this->GcapService->get_agents_evalues_par_user_id($evaluateur_id) ;
		$sql	=	$sql . " WHERE user_id IN ($zUserId)  "  ;
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$query = $this->db->query($sql); 
		return $query->row_array();
    }

	public function ajaxGetAgent($evaluateur_id,$exercice,$parameters,$ofset =0, $limit =100000000){
		$sql= " SELECT *,
		    (SELECT groupe FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='1' LIMIT 1 ) groupe,
		    (SELECT premier_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='1' LIMIT 1 ) critere011, 
		    (SELECT deuxieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='1' LIMIT 1 ) critere021, 
		    (SELECT troisieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='1' LIMIT 1 ) critere031,
		    (SELECT quatrieme_trimestre FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='1' LIMIT 1 ) critere041, 
		 
		    (SELECT  premier_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='2' AND trimestre='2'  ) critere012, 
		    (SELECT deuxieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='2' LIMIT 1 ) critere022, 
		    (SELECT troisieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='2' LIMIT 1 ) critere032,
		    (SELECT quatrieme_trimestre FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='2' LIMIT 1 ) critere042, 
		    (SELECT premier_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='3' LIMIT 1 ) critere013, 
		    (SELECT deuxieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='3' LIMIT 1 ) critere023, 
		    (SELECT troisieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='3' LIMIT 1 ) critere033, 
		    (SELECT quatrieme_trimestre FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='3' LIMIT 1 ) critere043,
		    (SELECT premier_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='4' LIMIT 1 )critere014, 
		    (SELECT deuxieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='4' LIMIT 1 ) critere024, 
		    (SELECT troisieme_critere FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='4' LIMIT 1 ) critere034, 
		    (SELECT quatrieme_trimestre FROM rohi.t_evaluation WHERE a.user_id = user_id AND exercice ='".$exercice."' AND trimestre='4' LIMIT 1 ) critere044 
		FROM rohi.candidat a 
				   ";
		$zUserId	=	$this->GcapService->get_agents_evalues_par_user_id($evaluateur_id) ;
		$sql	=	$sql . " WHERE a.user_id IN ($zUserId)  "  ;
		if( count($parameters) > 0 ){
			$sql	=	$sql . " AND " . implode(" AND ",$parameters) ;
		} 
		$sql	=	$sql . " LIMIT $ofset , $limit ";
		//	print_r($sql);die;

		$query = $this->db->query($sql);

		return $query->result_array();
    }

	public function ajaxGetDetailAgent($user_id){
		$sql= " SELECT * ,
				CASE
					WHEN sanction = 0  THEN 'En activite'
					WHEN sanction = 34 THEN 'Contrat expire'
					WHEN sanction = 40 THEN 'Personnel exterieur'
				END AS sanction_libelle,
				(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,autorite_id) > 0 GROUP BY b.child_id) autorite,
				(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,evaluateur_id) > 0 GROUP BY b.child_id) evaluateur,
				(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,respers_id) > 0 GROUP BY b.child_id) responsablepers
				FROM rohi.candidat a
				INNER JOIN rohi.t_structure b
				ON a.structureId = b.child_id
				WHERE user_id='".$user_id."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
    }

	public function majEvaluation($sql){
		
		$this->db->query($sql);
	}

	public function getNote($user_id,$trimestre,$exercice){
		$sql		= " select * from t_evaluation where user_id ='".$user_id."' and trimestre ='".$trimestre."' and exercice ='".$exercice."' ";
		$query		= $this->db->query($sql);
		$row		= $query->row_array();
		$note		=	$row["premier_critere"] + $row["deuxieme_critere"] +$row["troisieme_critere"] +$row["quatrieme_trimestre"] ;
		return $note;
    }

	public function getPeriode(){
		$sql			= " select * from rohi.t_periode_evaluation where actif='1' ";
		$query			= $this->db->query($sql);
		$row			= $query->row_array();
		//$trimestre		=	$row["trimestre"] ;

		return $row;
    }

	/**
    * Formatte les variables de type mon?taire
    * @param string $currency montant ? formatter
    * @return string montant formatt?
    * @access public
    */
    public function formatCurrency($currency) {
        if (is_nan($currency)) $currency = 0;
        $currency = number_format($currency, 2, ',', '');
        return ($currency);
    }

}
?>
