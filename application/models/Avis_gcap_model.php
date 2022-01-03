<?php
class Avis_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insertCheck($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('checkavis', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertToBe($oData){
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseGcap =  "tobeornottobe" ;
		if($DB1->insert($zDatabaseGcap.'.tobe', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function get_all_list($_iMois, $_iAnnee){
		$DB1 = $this->load->database('gcap', TRUE);
		$sql= "select user_id,matricule,REPLACE(cin,' ','') as cin from rohi.candidat WHERE user_id NOT IN (SELECT tobe_userId FROM tobeornottobe.tobe where tobe_mois='".(int)$_iMois."' AND tobe_annee='".$_iAnnee."')";
		$query = $DB1->query($sql);
		$row = $query->result();
		$query->free_result(); 
		return $row;
	}
	
	public function insertLocalite($oData){
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($DB1->insert($zDatabaseGcap.'.localiteavis', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function get_check_by_user_id($_iUserId){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql= "SELECT checkavis_userId from checkavis WHERE checkavis_userId = '". trim($_iUserId) ."'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iPopUpId = 0;
		if (sizeof($oRow)>0){
			$iPopUpId = $oRow[0]['checkavis_userId'] ; 
		} 

		return $iPopUpId ; 

	}
	
	public function getFonction(){
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql="SELECT * FROM fonction ORDER BY fonction_ordre ASC";
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function getAvisUserId($_iUserId, $_iMois, $_iAnnee){
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql="SELECT * FROM tobeornottobe.tobe WHERE tobe_userId = " . $_iUserId . " AND tobe_mois = '" . (int)$_iMois . "' AND tobe_annee = '" . $_iAnnee . "'" ;
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function get_sous_fonction($_iFonctionId){
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql="SELECT * FROM sousfonction WHERE sousfonction_fonctionId = $_iFonctionId";
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function get_all_tobe1(){
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql="SELECT * FROM tobeornottobe.tobe1";
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function searchToBe($_oSearch){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql="SELECT * FROM tobeornottobe.tobe WHERE tobe_userId = ".$_oSearch["tobe_userId"]." AND tobe_mois = ".$_oSearch["tobe_mois"]." AND tobe_annee = ".$_oSearch["tobe_annee"]." ";
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		
		$iReturn = 0;

		if(sizeof($oRow)>0){
			$iReturn = 1;
		}

		return $iReturn;
	}
	public function getListMajoration($iMatricule,$iMois,$iAnnee){
		global $db;
		if( $iMois > 1 ){
			/*$iMois	= $iMois -1;
			if($iMois<10){
				$iMois = "0".$iMois;
			}*/
		}else{
			$iMois = "01";
		}
		
		$DB1 	= $this->load->database('archives', TRUE);	
		$zSql	= " SELECT DISTINCT SUBSTRING(poste_agent_numero,1,1) majoration,
		            soa 
				    FROM mission_all_".$iMois."_".$iAnnee." 
				    WHERE agent_matricule='".$iMatricule."'";

		/*if( $iMatricule == "355577" ){
			echo $zSql;die;
		}*/
		//echo $zSql;
		$zQuery = $DB1->query($zSql);
		$oRow 	= $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}
	public function getFichierRecap($soa,$iMatricule,$iMois,$iAnnee){
		global $db;

		$DB1 = $this->load->database('archives', TRUE);	
		$zSql= "SELECT * FROM t_fic_recap_".$iMois."_".$iAnnee." WHERE agent_matricule like '%".$iMatricule."%' AND POSTE_AGENT_NUMERO = '".$soa.$iMatricule."' LIMIT 1";
		/*if( $iMatricule == "355577" ){
			echo $zSql;die;
		}*/
		$zQuery 	= $DB1->query($zSql);
		$oRow 		= $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}
	public function getMissionAll($soa,$iMatricule,$iMois,$iAnnee){
		global $db;
		$DB1 = $this->load->database('archives', TRUE);	
		$zSql="SELECT AGENT_MATRICULE,
					  AGENT_NOM,
					  AGENT_PRENOMS,
					  AGENT_ADRESSE,
					  AGENT_CODE_LOGEMENT,
					  AGENT_CODE_AMEUBLEMENT,
					  BUDGET_CODE,
					  SECTION_CODE,
					  CORPS_CODE,
					  GRADE_CODE,
					  INDICE,
					  IF(AGENT_NBENFANT_MOINS15='null','0',AGENT_NBENFANT_MOINS15)AGENT_NBENFANT_MOINS15,
					  IF(AGENT_NBENFANT_PLUS15='null','0',AGENT_NBENFANT_PLUS15)AGENT_NBENFANT_PLUS15,
					  FIV_CODE,
					  ETS_FINANCIER_CODE,
					  AGENT_NUMERO_COMPTE,
					  FIV_ZONE,
					  SERVICE_LOCALITE,
					  MOIS,
					  EXERCICE,
					  CODE_RUBRIQUE,
					  IF(RUBRIQUE_PERMANENT='null','',RUBRIQUE_PERMANENT)RUBRIQUE_PERMANENT,
					  RUBRIQUE_IMPOSABLE,
					  MONTANT,
					  TAUX_UNITAIRE,
					  NOMBRE_UNITE,
					  IF(DATE_DEBUT='null','',DATE_DEBUT)DATE_DEBUT,
					  IF(DATE_FIN='null','',DATE_FIN) DATE_FIN,
					  NUMERO,
					  TOTAL_CR,
					  TOTAL_GAIN,
					  TOTAL_RETENU,
					  TOTAL_IMPOSABLE,
					  TOTAL_DEDUCTIBLE,
					  TOTAL_IMPOSITION,
					  MONTANT_BRUT,
					  IMPOSABLE_NET,
					  SOLDE_MENSUEL_PERMANENT,
					  ELEMENT_NP_MOIS,
					  PRECOMPTE,
					  TOTAL_SOLDE,
					  NET_A_PAYER,
					  BULLETIN_SOLDE_NUMERO,
					  POSTE_AGENT_NUMERO,
					  BULLETIN_SOLDE_DATE_PAIEMENT,
					  MODE_PAIEMENT,
					  COMMUNE_CODE,
					  SECTION_LIBELLE,
					  COMMUNE_NOM,
					  ETS_FINANCIER_NOM,
					  BC_BNQ_BILT_CODE,
					  MINISTERE_CODE,
					  FAR_CODE,
					  SOA,
					  RESEAU_BANQUE 
		FROM mission_all_".$iMois."_".$iAnnee." 
		where agent_matricule='".$iMatricule."' 
		AND POSTE_AGENT_NUMERO = '".$soa.$iMatricule."'
		ORDER BY code_rubrique ASC ";
		
						

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function getFichierRecapEcd($iMatricule,$iMois,$iAnnee){
		global $db;
		$iMatricule	= str_replace(" ","",$iMatricule);
		$DB1 = $this->load->database('archives', TRUE);	
		$zSql="SELECT * FROM t_fic_recap_ecd where agent_matricule='".$iMatricule."' ";
		if($iMois){
			$zSql= $zSql . " AND mois ='".$iMois."' ";
		}
		if($iAnnee){
			$zSql= $zSql . " AND exercice ='".substr($iAnnee,2,4)."' ";
		}
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}
	public function getMissionAllEcd($iMatricule,$iMois,$iAnnee){
		global $db;
		$iMatricule	= str_replace(" ","",$iMatricule);
		$DB1 = $this->load->database('archives', TRUE);	
		$zSql="SELECT * FROM mission_all_ecd where agent_matricule='".$iMatricule."' ";
		if($iMois){
			$zSql= $zSql . " AND mois ='".$iMois."' ";
		}
		if($iAnnee){
			$zSql= $zSql . " AND exercice ='".substr($iAnnee,2,4) ."' ";
		}
		$zSql= $zSql . " ORDER BY code_rubrique ASC ";
					//	print_r($zSql);die;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}
	
}
?>

