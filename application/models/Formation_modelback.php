<?php
class Formation_modelback extends CI_Model {

	public function __construct(){
		$this->load->database('default');
		$this->load->database('backoffice');
		$this->load->database('gcap');
		$this->load->database('rohi');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		if($this->db->insert($zDatabaseGcap.'.sfao', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertAgentFormer($oData){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		if($this->db->insert($zDatabaseBO.'.agentforme', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertFormationR($oData){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		if($this->db->insert($zDatabaseBO.'.formationr', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function getMenu()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuformation WHERE menuformation_flag = 1 AND menuformation_formationId = 1 ORDER BY menuformation_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getMenuOffre()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuoffre WHERE 1 AND menuoffre_flag = 1 ORDER BY menuoffre_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getMenuReporting()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menureporting WHERE 1 AND menureporting_flag = 1 ORDER BY menureporting_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getCalendrier(){
		global $db;

		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseBO.calendrier WHERE 1 AND calendrier_actif = 1 ORDER BY calendrier_ordre DESC,calendrier_date DESC ";

		$zQuery = $this->db->query($zSql);
		$toGetListe = $zQuery->result_array();
		$zQuery->free_result();

		return $toGetListe;

	}

	public function getTexteReference()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.reference LIMIT 0,1 ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getMenu2()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuformation2 WHERE menuformation2_flag = 1 ORDER BY menuformation2_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}
	
	public function getAssocier()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.associer WHERE associer_flag = 1 AND associer_formationId = 1 AND associer_flag = 1 ORDER BY associer_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}
	
	public function getAssocierOffre($iFormationId,$iMenuformationId,$_iSearchMenu=0)
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT B.*,A.* FROM $zDatabaseBO.associer A JOIN $zDatabaseBO.contenuformation B ON B.contenuformation_associerId = A.associer_Id WHERE 1=1 AND associer_flag = 1 ";

		switch ($_iSearchMenu){

			case '7':
				$zSql.=" AND A.associer_id NOT IN (82,67)  "; 
				break;


			case '8':
				$zSql.=" AND A.associer_id IN (82,67) "; 
				break;

			default:
				break;
		}

		$zSql .= " AND B.contenuformation_flag = 1 AND B.contenuformation_formationId = ".$iFormationId." AND B.contenuformation_menuformationId = ".$iMenuformationId." AND A.associer_flag = 1 AND contenuformation_actif = 1  GROUP BY B.contenuformation_associerId ORDER BY B.contenuformation_ordre ASC ";
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		return $oRow;
		
	}

	public function getContenuAssocier($iFormationId,$iMenuformationId)
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT * FROM $zDatabaseBO.contenuformation WHERE contenuformation_flag = 1 AND contenuformation_actif = 1 AND contenuformation_formationId = ".$iFormationId." AND contenuformation_menuformationId = ".$iMenuformationId . " ORDER BY contenuformation_ordre ASC";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getParticipantFormation()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT r.*,c.nom,c.prenom,c.matricule FROM $zDatabaseBO.formationr r INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = r.formation_userId AND formation_actif = 1 ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}


	public function getAnneeFormationExistantMada()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT DISTINCT agentforme_date FROM $zDatabaseBO.agentforme WHERE agentforme_madagascar = 1 AND  agentforme_actif=1 ORDER BY  agentforme_date DESC ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getAnneeFormationExistantEtranger()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT DISTINCT agentforme_date FROM $zDatabaseBO.agentforme WHERE agentforme_madagascar = 0 AND  agentforme_actif=1  ORDER BY agentforme_date DESC ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getAnneeFormationExistant($local)
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT DISTINCT agentforme_date FROM $zDatabaseBO.agentforme WHERE agentforme_madagascar = $local AND  agentforme_actif=1  ORDER BY agentforme_date DESC ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}
	public function getAgentForme()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT * FROM $zDatabaseBO.agentforme WHERE agentforme_madagascar = 0 ORDER BY agentforme_date DESC ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}


/*
	public function getAnneeFormationExistantEtranger()
	{
		global $db;
 		$zDatabaseBO =  $db['rohi']['database'] ; 		

		$zSql= " SELECT DISTINCT agentforme_date FROM $zDatabaseBO.agentforme WHERE agentforme_madagascar = 0 ORDER BY agentforme_date DESC ";

		$zQuery = $this->db->query($zSql);
		$annee  =  $zQuery->result_array();
		$zQuery->free_result();

		
		
		$i=0;
		foreach ($annee as $resultat) {

			$zSql= " SELECT * FROM $zDatabaseBO.agentforme WHERE agentforme_date = '".$resultat['agentforme_date']."' AND agentforme_madagascar = 0 ";

			$zQuery = $this->db->query($zSql);
			$res = $zQuery->result_array();


			foreach($res as $agentdata){

				array_push($oRow[ $resultat['agentforme_date'] ]['agentforme_nomprenom'], $agentdata.agentforme_nomprenom);
			}

			$zQuery->free_result();	
			$i=$i+1;		
		}

	
		return $oRow;
	}
*/
	public function getAgentFormParAnneeLocalite($annee, $local)
	{
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		/*$zSql= " SELECT * FROM $zDatabaseBO.agentforme WHERE agentforme_date = $annee AND agentforme_madagascar =".$local." AND agentforme_actif = 1 ORDER BY agentforme_date DESC ";*/
		$zSql= " SELECT COUNT(*) agentforme_effectif,
		                agentforme_type,
						agentforme_intitule,
						agentforme_lieu,
						agentforme_departement,
						agentforme_region
					 FROM backoffice.agentforme 
					 WHERE agentforme_date = $annee 
					 AND agentforme_madagascar =".$local." 
					 AND agentforme_actif = 1 
					 GROUP BY agentforme_type,
						  agentforme_intitule,
						  agentforme_lieu,
						  agentforme_departement,
						  agentforme_region
					 ORDER BY agentforme_date DESC  ";
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	
	public function getInfoRegion()
	{
		$this->db->order_by('date', 'desc');
		$query = $this->db->get('inforegion');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return false;
		}
	}

	/*

	public function getAgentForme()
	{
		$this->db->order_by('agentforme_date', 'desc');
		$query = $this->db->get('agentforme');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return false;
		}
	}

	*/
/*
	public function getPhotoFormation($id_photoformation)
	{
		global $db;
 		$zDatabaseBO =  $db['rohi']['database'] ;

		$zSql= " SELECT * FROM $zDatabaseBO.photoformation where photoformation_id order by photoformation_id asc";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}
*/
	public function getPhotoFormation()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT * FROM $zDatabaseBO.photosfao WHERE photo_flag = 2 AND photo_type = 0 ORDER BY photo_ordre";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}


	public function getTrombinoscopeFormation()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT * FROM $zDatabaseBO.photosfao WHERE photo_flag = 2 AND photo_type = 1 ORDER BY photo_ordre";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}



}



?>