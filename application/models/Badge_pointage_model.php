<?php
class Badge_pointage_model extends CI_Model {

	public function __construct(){
		global $db;
		$this->load->database('gcap');
	}
	
	public function insert($oDataSaveBadge){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('badge', $oDataSaveBadge)){
			return $DB1->insert_id();
		}else return false;
	}


	public function toGetBadge($_zUserId, $_iCompteActif,$_iValid=0)
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap	 =  $db['gcap']['database'] ;

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
				$zInMatriculeUser = $_zUserId ; 

				/*$zSql= "select * from badge INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = badge_userId WHERE c.user_id = ".$_zUserId." GROUP BY badge_demandeType,badge_userId ORDER BY badge_date DESC ";*/

				$zSql = "SELECT * FROM $zDatabaseGcap.badge INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = badge_userId WHERE badge_id IN (SELECT badge_id FROM $zDatabaseGcap.badge WHERE badge_userId = ".$_zUserId." ) ORDER BY badge_date DESC" ; 

				/*$zSql = "SELECT * FROM $zDatabaseGcap.badge INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = badge_userId WHERE badge_id IN (SELECT MAX(badge_id) FROM $zDatabaseGcap.badge WHERE badge_userId = ".$_zUserId." GROUP BY badge_demandeType) ORDER BY badge_date DESC" ; */

				//echo $zSql ;
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
			case COMPTE_AUTORITE :
			case COMPTE_EVALUATEUR :
			case COMPTE_ADMIN :
				$toCandidatUser = unserialize($_zUserId);

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
				}

				$zInMatriculeUser = implode(",", $toCandidatUserMatricule);

				$zSql  = " select * from $zDatabaseGcap.badge INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = badge_userId WHERE c.matricule IN (".$zInMatriculeUser.") ";
				
				if ($_iValid == 0) {
					$zSql .= " AND badge_validation IS NULL " ; 
				} else {
					$zSql .= " AND badge_validation IS NOT NULL " ; 
				}
				
				//$zSql .= " GROUP BY badge_demandeType,badge_userId ORDER BY badge_id ASC ";

				$zSql .= " ORDER BY badge_id ASC ";

				break;
		}

		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function toGetBadgeSau($_zUserId, $_iCompteActif)
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 


		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
				$zInMatriculeUser = $_zUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
			case COMPTE_AUTORITE :
			case COMPTE_ADMIN :
				$toCandidatUser = unserialize($_zUserId);

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
				}

				$zInMatriculeUser = implode(",", $toCandidatUserMatricule);

				break;
		}

		$zSql= "select * from badge INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = badge_userId WHERE c.matricule IN (".$zInMatriculeUser.") AND badge_demandeType > 1";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	
}
?>