<?php

class TraitementActe_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function getFieldsByMouvementCode($_mouvement_code){
		$sql= " SELECT *
				  FROM sgrh.t_mouvement 
				  WHERE mouvement_code ='".$_mouvement_code."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getNiveauSuivantTicket($ticket_niveau){
		$sql= " SELECT *
				 FROM sgrh.t_niveau_ticket
				 WHERE niveau_id =(select niveau_id+1 from sgrh.t_niveau_ticket WHERE niveau_code='".$ticket_niveau."') ";

		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function getInfoTicket($ticket_code){
		$sql= " SELECT * 
				  FROM sgrh.t_ticket a 
				 INNER JOIN sgrh.t_mouvement b 
				 ON a.ticket_processus_code = b.mouvement_code
				 WHERE ticket_code ='".$ticket_code."' ";

		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getInfoAgent($poste_agent_numero){
		$agent_matricule	= 	substr($poste_agent_numero,1, 7); 
		$mois				= 	date("m");
		/*echo $mois;die;*//***a modifier par mois*/
		
		$mois_courant	= date("m");
		$annee_courant	= date("Y");
		
		if ($mois_courant!=01){
			//do nothing
			$annee_courant	=	$annee_courant ;
			$mois_courant	=	$mois_courant - 1;
			if( $mois_courant < 10 ){
				$mois_courant	=	"0" . $mois_courant;
			}
		}else{
			$annee_courant	=	$annee_courant -1 ;
			$mois_courant	=	"12";
		}
		
		$fichierRecap		=	"t_fic_recap_".$mois_courant."_".$annee_courant;
		
		$sql= " select  distinct a.matricule,
						(select poste_agent_numero  from rohi.t_poste_agent_rohi where poste_agent_numero='".$poste_agent_numero."') poste_agent_numero,
						a.nom,
						a.prenom,
						a.cin,
						a.date_naiss,
						a.sexe,
						a.sit_mat,
						a.date_prise_service,
						a.corps,
						a.grade,
						a.indice,
						b.soa as soa,
						a.uadm as uadm,
						b.section_code as section,
						'' as date_debut_contrat,
						'' date_fin_contrat,
						concat( '  ',b.fiv_code) localite_service,
						b.fiv_code region_code,
						a.sanction,
						'' hee_code,
						a.categorie,
						a.fonction_actuel,
						a.sexe,
						a.phone,
						a.address,
						a.sanction,
						a.cadre,
						a.date_prise_service date_entree_admin,
						'0' as enfant_mineur,
						'0' as enfant_majeur,
						'L' as code_logement,
						'N' as code_ameublement,
						SUBSTR(b.soa,1,2) as code_budget,
						b.mode_paiement,
						b.agent_numero_compte as numero_compte
					from rohi.candidat a
					left join archives.$fichierRecap b
					on a.matricule = b.agent_matricule
					where a.matricule='".$agent_matricule."' ";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function getInfoAgent_taloha($poste_agent_numero){
		$agent_matricule	= substr($poste_agent_numero,1, 7); 
		$sql= " SELECT *
				  FROM sgrh.t_agent_situation 
				  WHERE poste_agent_numero ='".$poste_agent_numero."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function getMouvementAgent($ticket_code){
		$sql= " SELECT *
				  FROM sgrh.t_mouvement_agent 
				  WHERE ticket_code ='".$ticket_code."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getAllTicket($params){
		$sql= " SELECT *
				  FROM sgrh.t_ticket 
				  WHERE 1 = 1
			  ";
		if ( sizeof($params) > 0 ){
			$sql = $sql . implode(" AND ", $params);
		}
		$sql = $sql . " ORDER BY ticket_id DESC ";
		/*$sql = $sql . " LIMIT 0, 100";*/
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getMissionAll($poste_agent_numero){
		// modifier par mois
		$sql= " SELECT *
				  FROM archives.mission_all_10_2020 
				  WHERE poste_agent_numero ='".$poste_agent_numero."'";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getVisa($ticket_code){
		$sql= " SELECT *
				  FROM sgrh.t_visa 
				  WHERE ticket_code ='".$ticket_code."' ";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getProduitLiquidation($ticket_code){
		$sql= " SELECT *
				  FROM sgrh.t_produit_iquidation 
				  WHERE ticket_code ='".$ticket_code."'";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getPosteAgentNumero($agent_matricule){
		// modifier par mois
		$sql= " SELECT DISTINCT poste_agent_numero
				  FROM rohi.t_poste_agent_rohi 
				  WHERE agent_matricule ='".$agent_matricule."'";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>