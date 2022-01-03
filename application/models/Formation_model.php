<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formation_model extends CI_Model {

	public function getFormation()
	{
		//$this->db->order_by('id', 'desc');
		$zQuery = $this->db->get('contenuformation');
		if ($zQuery->num_rows() > 0) {
			return $zQuery->result();
		}else{
			return false;
		}
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

	public function getMenuOffre()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuoffre WHERE menuoffre_flag = 1 ORDER BY menuoffre_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getMenuReporting()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menureporting WHERE menureporting_flag = 1 ORDER BY menureporting_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	
	public function getAssocier()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.associer WHERE associer_flag = 1 AND associer_formationId = 1 ORDER BY associer_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getFormationA()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.formation WHERE formation_flag = 1  ORDER BY formation_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getMenuFormation2()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuformation2 WHERE menuformation2_flag = 1  ORDER BY menuformation2_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getAssocierReporting($_iMenu=0)
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql = " SELECT * FROM $zDatabaseBO.associer WHERE associer_flag = 1 AND associer_formationId = 2 ";

		switch ($_iMenu){

			case '7':
				$zSql .= " AND associer_id NOT IN (82,67) ";
				break;

			case '8':
				$zSql .= " AND associer_id IN (82,67) ";
				break;

			default :
				break;
		}

		$zSql .= " ORDER BY associer_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getAssocierLienUtile()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.associer WHERE associer_flag = 1 AND associer_formationId = 3 ORDER BY associer_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function __getCalendrier()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.calendrier WHERE calendrier_flag = 1 ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function ___getAgentForme()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.agentforme ORDER BY agentforme_id ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getAgentForme(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;

		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toColumns = array( 
			0  => 'agentforme_intitule', 
			1  => 'agentforme_type',
			2  => 'agentforme_lieu', 
			4  => 'agentforme_nom', 
			5  => 'agentforme_matricule',
			6  => 'agentforme_departement', 
			7  => 'agentforme_region',
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseBO.agentforme WHERE 1 " ; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( agentforme_intitule LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  agentforme_type LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  agentforme_lieu LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  agentforme_nom LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  agentforme_matricule LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  agentforme_departement LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  agentforme_region LIKE '%".$oRequest['search']['value']."%' ) ";
		}
		
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY agentforme_intitule ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY agentforme_intitule ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $this->db->query($zSql);
		$toGetListe = $zQuery->result_array();
		$zQuery->free_result();

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$zQuery = $this->db->query($zQueryDataCount);
		$toDataCount = $zQuery->result_array();
		$zQuery->free_result();

		foreach ($toDataCount as $oDataCount){
			$_iNbrTotal = $oDataCount['iNumRows'] ;
		}


		return $toGetListe;

	}


	public function getCalendrier(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;

		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toColumns = array( 
			0  => 'calendrier_id', 
			1  => 'calendrier_date',
			2  => 'calendrier_cible', 
			4  => 'calendrier_aPropos', 
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseBO.calendrier WHERE 1 " ; 


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( calendrier_date LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  calendrier_cible LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  calendrier_aPropos LIKE '%".$oRequest['search']['value']."%' ) ";
		}
		
		if (sizeof($oRequest)>0){
			
			
			$zSql.=" ORDER BY calendrier_ordre ASC ";
			

			if ($_iLimit==0){
				if (isset($oRequest['start'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY calendrier_ordre ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		//echo $zSql ; 

		$zQuery = $this->db->query($zSql);
		$toGetListe = $zQuery->result_array();
		$zQuery->free_result();

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$zQuery = $this->db->query($zQueryDataCount);
		$toDataCount = $zQuery->result_array();
		$zQuery->free_result();

		foreach ($toDataCount as $oDataCount){
			$_iNbrTotal = $oDataCount['iNumRows'] ;
		}


		return $toGetListe;

	}


	public function __getCandidature()
	{
		global $db;
 		$zDatabaseRohi =  $db['rohi']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseRohi.candidat_recu_formation ORDER BY id ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}


	public function getCandidature(&$_iNbrTotal = 0,$_this='',$_iLimit=0){
		global $db;

		$zDatabaseRohi =  $db['rohi']['database'] ;

		$toColumns = array( 
			0  => 'id', 
			1  => 'type_offre',
			2  => 'intitule', 
			3  => 'lieu_institut',
			4  => 'date_formation', 
			5  => 'nom_prenom',
			6  => 'matricule', 
			7  => 'poste',
			8  => 'dep_dir', 
			9  => 'service',
			10 => 'region', 
			11 => 'action',
		);

		$oRequest = $_REQUEST;
		

		$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseRohi.candidat_recu_formation WHERE 1 " ; 

		if( !empty($oRequest['search']['value']) ) {   
			//$zSql.=" AND ( id LIKE '%".$oRequest['search']['value']."%' ) ";
			$zSql.=" AND ( type_offre LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  intitule LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  lieu_institut LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  date_formation LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  matricule LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  poste LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  dep_dir LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  service LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  region LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  action LIKE '%".$oRequest['search']['value']."%' ) ";
		}
		
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY id ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY id ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $this->db->query($zSql);
		$toGetListe = $zQuery->result_array();
		$zQuery->free_result();

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$zQuery = $this->db->query($zQueryDataCount);
		$toDataCount = $zQuery->result_array();
		$zQuery->free_result();

		foreach ($toDataCount as $oDataCount){
			$_iNbrTotal = $oDataCount['iNumRows'] ;
		}


		return $toGetListe;

	}

	

	public function getAssocierOffre($iFormationId,$iMenuformationId)
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

 		$zSql= " SELECT A.* FROM $zDatabaseBO.associer A JOIN $zDatabaseBO.contenuformation B ON B.contenuformation_associerId = A.associer_Id WHERE B.contenuformation_flag = 1 AND B.contenuformation_formationId = ".$iFormationId." AND B.contenuformation_menuformationId = ".$iMenuformationId." AND A.associer_flag = 1 GROUP BY B.contenuformation_associerId ORDER BY B.contenuformation_ordre ASC ";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}

	public function getContenuAssocier($iFormationId,$iMenuformationId)
	{

		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT * FROM contenuformation WHERE contenuformation_flag = 1 AND contenuformation_formationId = ".$iFormationId." AND contenuformation_menuformationId = ".$iMenuformationId;

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		//echo"<pre>"; print_r($oRow);echo "</pre>"; die();
		$zQuery->free_result();
		
		return $oRow;
	}


	public function insertOffre($oData)
	{
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		if($this->db->insert($zDatabaseBO.'.contenuformation', $oData)){
			return $this->db->insert_id();
		}else return false;
		
	}

	public function insertAgentForme($oData)
	{
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		if($this->db->insert($zDatabaseBO.'.agentforme', $oData)){
			return $this->db->insert_id();
		}else return false;
		
	}

	public function insertCandidatureRecue($oData)
	{
		global $db;
		$zDatabaseRohi =  $db['rohi']['database'] ;
		if($this->db->insert($zDatabaseRohi.'.candidat_recu_formation', $oData)){
			return $this->db->insert_id();
		}else return false;
		
	}

	public function insertContenuFormation($oData)
	{
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		if($this->db->insert($zDatabaseBO.'.contenuformation', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertCalendrier($oData)
	{
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		if($this->db->insert($zDatabaseBO.'.calendrier', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertAssocier($oData)
	{
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;
		$this->db->insert($zDatabaseBO.'.associer', $oData);
	}

	public function insertMenuforamtion($oData)
	{
		$this->db->insert('menuformation2', $oData);
	}

	public function insertMenuoffre($oData)
	{
		$this->db->insert('menuoffre', $oData);
	}

	public function insertMenureporting($oData)
	{
		$this->db->insert('menuoffre', $oData);
	}

	public function update_rc($oData, $_iContenuId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.contenuformation', $oData, "contenuformation_id = ".$_iContenuId);
	}

	public function update_calendrier($oData, $_iCalendrierId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.calendrier', $oData, "calendrier_id = ".$_iCalendrierId);
	}

	public function update_agentForme($oData, $_iAgentId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.agentforme', $oData, "agentforme_id = ".$_iAgentId);
	}

	public function update_candidatureRecu($oData, $_iCandidatId){
		global $db;
		$zDatabaseRohi		=  $db['rohi']['database'] ; 
		$this->db->update($zDatabaseRohi.'.candidat_recu_formation', $oData, "id = ".$_iCandidatId);
	}

	public function update_accueil($oData, $_iAssocierId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.associer', $oData, "associer_id = ".$_iAssocierId);
	}

	public function update_menuformation($oData, $_iMenuformationId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.menuformation2', $oData, "menuformation2_id = ".$_iMenuformationId);
	}

	public function update_menu_offre($oData, $_iMenuformationId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.menuoffre', $oData, "menuoffre_id = ".$_iMenuformationId);
	}

	public function update_menu_reporting($oData, $_iMenuformationId){
		global $db;
		$zDatabaseBO		=  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.menureporting', $oData, "menureporting_id = ".$_iMenuformationId);
	}

	public function delete_associer($_iAssocierId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.associer where associer_id = '.$_iAssocierId);
	}

	public function delete_menuformation($_iMenuformationId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.menuformation2 where menuformation2_id = '.$_iMenuformationId);
	}

	public function delete_menu_offre($_iMenuformationId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.menuoffre where menuoffre_id = '.$_iMenuformationId);
	}

	public function delete_menu_reporting($_iMenuformationId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.menureporting where menureporting_id = '.$_iMenuformationId);
	}

	public function update_contenu($oData, $_iContenu){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->update($zDatabaseBO.'.contenuformation', $oData, 'contenuformation_id = '.$_iContenu);
	}

	public function delete_contenu($_iContenuId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.contenuformation where contenuformation_id = '.$_iContenuId);
	}

	public function delete_calendrier($_iCalendrierId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.calendrier where calendrier_id = '.$_iCalendrierId);
	}

	public function delete_AgentForme($_iAgentId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.agentforme where agentforme_id = '.$_iAgentId);
	}

	public function delete_CandidatureRecu($_iCandidatureId){
		global $db;
 		$zDatabaseRohi =  $db['rohi']['database'] ; 
		$this->db->query('delete from '.$zDatabaseRohi.'.candidat_recu_formation where id = '.$_iCandidatureId);
	}

	public function ___delete_calendrier($_iContenuId){
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ; 
		$this->db->query('delete from '.$zDatabaseBO.'.calendrier where calendrier_id = '.$_iContenuId);
	}

	public function submit()
	{

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function getContenuId($_iContenuId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.contenuformation where contenuformation_id = '.$_iContenuId);
		$toRow =  $zQuery->result_array();

		for($iBoucle=0;$iBoucle<sizeof($toRow);$iBoucle++){
			$toFichier = explode("/", $toRow[$iBoucle]['contenuformation_fichier_pdf']);
			$toRow[$iBoucle]['contenuformation_fichier_pdf'] = $toFichier[sizeof($toFichier)-1];
		}

		return $toRow ; 
	}

	public function getAgentFormeId($_iContenuId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.agentforme where agentforme_id = '.$_iContenuId);
		$toRow =  $zQuery->result_array();

		return $toRow ; 
	}

	public function getCandidatureRecueId($_iCandidatureRecuId){
		global $db;
		$zDatabaseRohi =  $db['rohi']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseRohi.'.candidat_recu_formation where id = '.$_iCandidatureRecuId);
		$toRow =  $zQuery->result_array();

		return $toRow ; 
	}

	public function getCalendrierId($_iContenuId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.calendrier where calendrier_id = '.$_iContenuId);
		return $zQuery->result_array();
	} 


	public function getAssocierId($_iAssocierId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.associer where associer_id = '.$_iAssocierId);
		return $zQuery->result_array();
	}

	public function getMenuformationId($_iMenuformationId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.menuformation2 where menuformation2_id = '.$_iMenuformationId);
		return $zQuery->result_array();
	}

	public function getMenuOffreId($_iMenuformationId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.menuoffre where menuoffre_id = '.$_iMenuformationId);
		return $zQuery->result_array();
	}

	public function getMenuReportingId($_iMenuformationId){
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.menureporting where menureporting_id = '.$_iMenuformationId);
		return $zQuery->result_array();
	}


	public function getFormationId($_iFormationId){
		
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;  
		$zQuery = $this->db->query('select * from '.$zDatabaseBO.'.formation where formation_id = '.$_iFormationId);
		return $zQuery->result_array();
				
 	}


	public function update(){
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function supprimer($iId)
	{
		$this->db->where('id',$iId);
		$this->db->delete('agent');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	
	

	/*************************************************************************************************************************/



	
	public function get_All_Formation(){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.formation WHERE formation_flag = 1 ORDER BY formation_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
				
 	}
	
	public function get_All_Theme(){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.formation WHERE formation_flag = 1 ORDER BY formation_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
				
 	}
	
	public function get_All_Associer(){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.associer WHERE associer_flag = 1 ORDER BY associer_sigle ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
				
 	}
 	
	public function get_All_Theme_By_Formation($_zSearchFormation){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuformation WHERE menuformation_formationId = $_zSearchFormation AND menuformation_flag = 1 ORDER BY menuformation_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
				
 	} 
	
	public function get_All_Menu_By_Formation($_zSearchFormation){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.menuformation WHERE menuformation_formationId = $_zSearchFormation AND menuformation_flag = 1 ORDER BY menuformation_ordre ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
				
 	}
	
	public function get_All_Associer_By_Menu($_zSearchFormation){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		$zSql= " SELECT * FROM $zDatabaseBO.associer WHERE associer_formationId = $_zSearchFormation AND associer_flag = 1 ORDER BY associer_sigle ASC ";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
				
 	}


	public function getSigle(&$_iNbrTotal = 0,$_this='',$_iLimit=0,$iReOrder=0){
		global $db;


		$toColumns = array( 
			0  => 'associer_ordre', 
			1  => 'formation_lib',
			2  => 'associer_sigle', 
			3  => 'associer_lib',
			4  => 'associer_photo', 
		);

		$oRequest = $_REQUEST;
		

		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql=" SELECT SQL_CALC_FOUND_ROWS *,
				(SELECT f.formation_lib FROM $zDatabaseBO.formation f WHERE a.associer_formationId = f.formation_id) as formation_lib
 				FROM $zDatabaseBO.associer a WHERE 1 ";

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( associer_sigle LIKE '%".$oRequest['search']['value']."%'  ";
			$zSql.=" OR  associer_lib LIKE '%".$oRequest['search']['value']."%' ) ";
		}
		
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY associer_ordre ASC ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			} else {
				$zSql.=" LIMIT 0,10   ";
			}
		} else {
			$zSql.=" ORDER BY associer_ordre ASC ";
			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		}

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();

		for($iBoucle=0;$iBoucle<sizeof($toRow);$iBoucle++){

			/*$toFichier = explode("/", $toRow[$iBoucle]['associer_photo']);
			$toRow[$iBoucle]['associer_photo'] = $toFichier[sizeof($toFichier)-1];*/

			if($iReOrder==1){
				$iOrdre = $iBoucle+1;
				$zSql  = " UPDATE $zDatabaseBO.associer SET associer_ordre = " . $iOrdre . " WHERE associer_id = " .$toRow[$iBoucle]['associer_id'] ;
				$this->db->query($zSql);
				$toRow[$iBoucle]['associer_ordre'] = $iOrdre ; 
			}
		}

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$zQuery = $this->db->query($zQueryDataCount);
		$toDataCount = $zQuery->result_array();
		$zQuery->free_result();

		foreach ($toDataCount as $oDataCount){
			$_iNbrTotal = $oDataCount['iNumRows'] ;
		}


		return $toRow;

	}






	public function get_All_Associer_By_Search($_zSearchFormation, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "associer_id"){

 		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql=" SELECT SQL_CALC_FOUND_ROWS *,
				(SELECT f.formation_lib FROM $zDatabaseBO.formation f WHERE a.associer_formationId = f.formation_id) as formation_lib
 				FROM $zDatabaseBO.associer a  
				
				";
  		
		if($_zSearchFormation != '' )
		{
 			$zSql.=" WHERE a.associer_formationId = '$_zSearchFormation' "; 
			
		}
		
 		$zSql .= " ORDER BY associer_id DESC, " . $_zFieldOrder . " " . $_zSortSens . " " ;
	//	$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;
		
	//  echo $zSql;

 
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $zQueryCount = $this->db->query ($zQueryDataCount) ;
		$toDataCount = $zQueryCount->result();
		$zQueryCount->free_result(); 

        if (sizeof($toDataCount)>0)
        {
            $_iNbrTotal = $toDataCount[0]->iNumRows ;
        }
		
		 // print_r($oRow);
		
 		return $oRow;
		
	}

	public function get_All_Formation_AutreRapport_By_Search($_iSearchFormation, $_iSearchMenu,$iReOrder=0, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "contenuformation_ordre"){

 		global $db;

 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql=" SELECT SQL_CALC_FOUND_ROWS *,c.contenuformation_actif,
				(SELECT f.formation_lib FROM $zDatabaseBO.formation f WHERE c.contenuformation_formationId = f.formation_id) as formation_lib,
				(SELECT t.menuformation_lib FROM $zDatabaseBO.menuformation t WHERE  c.contenuformation_menuformationId = t.menuformation_id) as menuformation_lib,
				(SELECT p.associer_sigle FROM $zDatabaseBO.associer p WHERE  c.contenuformation_associerId = p.associer_id) as associer_sigle,
				(SELECT p.associer_photo FROM $zDatabaseBO.associer p WHERE  c.contenuformation_associerId = p.associer_id) as associer_photo
				FROM $zDatabaseBO.contenuformation c ";

		
		$zSql.=" INNER JOIN  associer p ON c.contenuformation_associerId = p.associer_id "; 
		$zSql.=" AND associer_id IN (82,67) "; 
		
		$iWhereCount = 0;
		
		if($_iSearchFormation != '' )
		{
 			$zSql.=" WHERE c.contenuformation_formationId = '$_iSearchFormation' "; 
 			$iWhereCount++;
 		}
		
		if($_iSearchMenu != '' && $iWhereCount > 0)
		{
 			$zSql.=" AND c.contenuformation_menuformationId = '$_iSearchMenu' "; 
 			$iWhereCount++;
 		}

				

		$zSql .= " ORDER BY contenuformation_ordre ASC, " . $_zFieldOrder . " " . $_zSortSens . " " ;
 
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		for($iBoucle=0;$iBoucle<sizeof($toRow);$iBoucle++){

			$toFichier = explode("/", $toRow[$iBoucle]['contenuformation_fichier_pdf']);
			$toRow[$iBoucle]['contenuformation_fichier_pdf'] = $toFichier[sizeof($toFichier)-1];

			if($iReOrder==1){
				$iOrdre = $iBoucle+1;
				$zSql  = " UPDATE $zDatabaseBO.contenuformation SET contenuformation_ordre = " . $iOrdre . " WHERE contenuformation_id = " .$toRow[$iBoucle]['contenuformation_id'] ;
				$this->db->query($zSql);
				$toRow[$iBoucle]['contenuformation_ordre'] = $iOrdre ; 
			}
		}

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $zQueryCount = $this->db->query ($zQueryDataCount) ;
		$toDataCount = $zQueryCount->result();
		$zQueryCount->free_result(); 

        if (sizeof($toDataCount)>0)
        {
            $_iNbrTotal = $toDataCount[0]->iNumRows ;
        }
		
		 // print_r($oRow);
		
 		return $toRow;
		
	}	
	 	
	public function get_All_Formation_By_Search($_iSearchFormation, $_iSearchMenu,$iReOrder=0, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "contenuformation_ordre"){

 		global $db;

 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql=" SELECT SQL_CALC_FOUND_ROWS *,c.contenuformation_actif,
				(SELECT f.formation_lib FROM $zDatabaseBO.formation f WHERE c.contenuformation_formationId = f.formation_id) as formation_lib,
				(SELECT t.menuformation_lib FROM $zDatabaseBO.menuformation t WHERE  c.contenuformation_menuformationId = t.menuformation_id) as menuformation_lib,
				(SELECT p.associer_sigle FROM $zDatabaseBO.associer p WHERE  c.contenuformation_associerId = p.associer_id) as associer_sigle,
				(SELECT p.associer_photo FROM $zDatabaseBO.associer p WHERE  c.contenuformation_associerId = p.associer_id) as associer_photo
				FROM $zDatabaseBO.contenuformation c ";

		
		switch ($_iSearchMenu){

			case '7':
				$zSql.=" INNER JOIN  associer p ON c.contenuformation_associerId = p.associer_id "; 
				$zSql.=" AND associer_id NOT IN (82,67)  "; 
				break;


			case '8':
				$zSql.=" INNER JOIN  associer p ON c.contenuformation_associerId = p.associer_id "; 
				$zSql.=" AND associer_id IN (82,67) "; 
				break;
		}

		$iWhereCount = 0;
		
		if($_iSearchFormation != '' )
		{
 			$zSql.=" WHERE c.contenuformation_formationId = '$_iSearchFormation' "; 
 			$iWhereCount++;
 		}
		
		if($_iSearchMenu != '' && $iWhereCount > 0)
		{
 			$zSql.=" AND c.contenuformation_menuformationId = '$_iSearchMenu' "; 
 			$iWhereCount++;
 		}

				

		$zSql .= " ORDER BY contenuformation_ordre ASC, " . $_zFieldOrder . " " . $_zSortSens . " " ;
 
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		for($iBoucle=0;$iBoucle<sizeof($toRow);$iBoucle++){

			$toFichier = explode("/", $toRow[$iBoucle]['contenuformation_fichier_pdf']);
			$toRow[$iBoucle]['contenuformation_fichier_pdf'] = $toFichier[sizeof($toFichier)-1];

			if($iReOrder==1){
				$iOrdre = $iBoucle+1;
				$zSql  = " UPDATE $zDatabaseBO.contenuformation SET contenuformation_ordre = " . $iOrdre . " WHERE contenuformation_id = " .$toRow[$iBoucle]['contenuformation_id'] ;
				$this->db->query($zSql);
				$toRow[$iBoucle]['contenuformation_ordre'] = $iOrdre ; 
			}
		}

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $zQueryCount = $this->db->query ($zQueryDataCount) ;
		$toDataCount = $zQueryCount->result();
		$zQueryCount->free_result(); 

        if (sizeof($toDataCount)>0)
        {
            $_iNbrTotal = $toDataCount[0]->iNumRows ;
        }
		
		 // print_r($oRow);
		
 		return $toRow;
		
	}	
	
	public function get_All_Photo_By_Search($_zPhoto, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "ASC", $_zFieldOrder = "photo_ordre"){

 		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql=" SELECT SQL_CALC_FOUND_ROWS * FROM $zDatabaseBO.photosfao ";
  								
 		$iWhereCount = 0;
		
		if($_zPhoto != '' )
		{
 			$zSql.=" WHERE photo_type = '$_zPhoto' "; 
 			$iWhereCount++;
 		}
		else
		{
 			$zSql.=" WHERE photo_type = 0 "; 
 			$iWhereCount++;
		}
		$zSql .= " ORDER BY photo_flag DESC, " . $_zFieldOrder . " " . $_zSortSens . " " ;
	//	$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;
		
	//  echo $zSql;

 
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $zQueryCount = $this->db->query ($zQueryDataCount) ;
		$toDataCount = $zQueryCount->result();
		$zQueryCount->free_result(); 

        if (sizeof($toDataCount)>0)
        {
            $_iNbrTotal = $toDataCount[0]->iNumRows ;
        }
		
	//	   print_r($oRow);
		
 		return $oRow;
		
	}		
	
	public function insertAgentFormation($_zFichier){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;
		
		$zSql  = " LOAD DATA LOCAL INFILE '$_zFichier' REPLACE INTO TABLE $zDatabaseBO.agentforme ";
		$zSql .= " FIELDS TERMINATED BY ';' ";
		$zSql .= " LINES TERMINATED BY '\\r\\n' ";
		$zSql .= " IGNORE 1 LINES ";
		$zSql .= " (agentforme_id,agentforme_date,agentforme_lieu,agentforme_nom,agentforme_prenom,agentforme_departement,agentforme_region,agentforme_intitule,agentforme_madagascar) ";
  		
		$zQuery = $this->db->query($zSql);
 		
  	}


	public function flux_ordre($_iMode,$_iOrdre,$_iId,$_iFormationId,$_iMenuformationId){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toRow = array();
		switch ($_iMode) {

			// monter
			case '1':
				$zSql  = " SELECT contenuformation_id,contenuformation_ordre FROM $zDatabaseBO.contenuformation WHERE contenuformation_formationId = ".$_iFormationId." AND contenuformation_menuformationId = ".$_iMenuformationId." AND contenuformation_ordre < " . $_iOrdre . " ORDER BY contenuformation_ordre DESC LIMIT 0,1" ;

				$zQuery = $this->db->query($zSql);
				$toRow = $zQuery->result();

				break;

			// Descendre
			case '2':
				$zSql  = " SELECT contenuformation_id,contenuformation_ordre FROM $zDatabaseBO.contenuformation WHERE contenuformation_formationId = ".$_iFormationId." AND contenuformation_menuformationId = ".$_iMenuformationId." AND contenuformation_ordre > " . $_iOrdre . " ORDER BY contenuformation_ordre ASC LIMIT 0,1" ;

				$zQuery = $this->db->query($zSql);
				$toRow = $zQuery->result();

				break;
		}
		

		foreach($toRow as $oRow){
			$zSql  = " UPDATE $zDatabaseBO.contenuformation SET contenuformation_ordre = " . $oRow->contenuformation_ordre . " WHERE contenuformation_id = " . $_iId ;
			$this->db->query($zSql);

			$zSql  = " UPDATE $zDatabaseBO.contenuformation SET contenuformation_ordre = " . $_iOrdre . " WHERE contenuformation_id = " . $oRow->contenuformation_id ;
			$this->db->query($zSql);
		}
 		
  	}

	public function flux_ordreCalendrier($_iMode,$_iOrdre,$_iId){
		
		global $db;
		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toRow = array();
		switch ($_iMode) {

			// monter
			case '1':
				$zSql  = " SELECT calendrier_id,calendrier_ordre FROM $zDatabaseBO.calendrier WHERE calendrier_ordre < " . $_iOrdre . " ORDER BY calendrier_ordre DESC LIMIT 0,1" ;

				$zQuery = $this->db->query($zSql);
				$toRow = $zQuery->result();

				break;

			// Descendre
			case '2':
				$zSql  = " SELECT calendrier_id,calendrier_ordre FROM $zDatabaseBO.calendrier WHERE calendrier_ordre > " . $_iOrdre . " ORDER BY calendrier_ordre ASC LIMIT 0,1" ;

				$zQuery = $this->db->query($zSql);
				$toRow = $zQuery->result();

				break;
		}

		foreach($toRow as $oRow){
			$zSql  = " UPDATE $zDatabaseBO.calendrier SET calendrier_ordre = " . $oRow->calendrier_ordre . " WHERE calendrier_id = " . $_iId ;
			$this->db->query($zSql);

			$zSql  = " UPDATE $zDatabaseBO.calendrier SET calendrier_ordre = " . $_iOrdre . " WHERE calendrier_id = " . $oRow->calendrier_id ;
			$this->db->query($zSql);
		}
	}

	public function maxOrdre($_iFormationId,$_iMenuformationId){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toRow = array();
		
		$zSql  = " SELECT MAX(contenuformation_ordre) as iOrdre FROM $zDatabaseBO.contenuformation WHERE contenuformation_formationId = ".$_iFormationId." AND contenuformation_menuformationId = ".$_iMenuformationId." LIMIT 0,1" ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result();

		$iMax = 1;
		foreach($toRow as $oRow){
			$iMax = $oRow->iOrdre + 1;
		}

		return $iMax;
		
  	}

	public function maxOrdreassocier(){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toRow = array();
		
		$zSql  = " SELECT MAX(associer_ordre) as iOrdre FROM $zDatabaseBO.associer LIMIT 0,1" ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result();

		$iMax = 1;
		foreach($toRow as $oRow){
			$iMax = $oRow->iOrdre + 1;
		}

		return $iMax;
		
  	}

	public function maxOrdreCalendrier(){
		
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$toRow = array();
		
		$zSql  = " SELECT MAX(calendrier_ordre) as iOrdre FROM $zDatabaseBO.calendrier LIMIT 0,1" ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result();

		$iMax = 1;
		foreach($toRow as $oRow){
			$iMax = $oRow->iOrdre + 1;
		}

		return $iMax;
		
  	}


}
