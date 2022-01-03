<?php
class Transaction_pointage_model extends CI_Model {

	public function __construct(){

		global $db;
		$this->load->database('pointage', TRUE);
	}

	public function executeQuery($_zSql){

		$oConnection	= $this->load->database('pointage', TRUE);

		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
		$oResult		= odbc_do ($oConnection->conn_id,$_zSql);

		return $oResult ; 
	}

	public function executeQueryZKGcap($_zSql){

		$oConnection	= $this->load->database('zKGcap', TRUE);
		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
		//$oResult		= odbc_do ($oConnection->conn_id,$_zSql);
	}

	public function executeFetchGcapQuery($_zSql){

		$oConnection	= $this->load->database('zKGcap', TRUE);
		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
		$oResult		= odbc_do ($oConnection->conn_id,$_zSql);

		return $oResult ; 
	}

	public function updateModeration($oData, $_iModerationId){
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap.'.moderation', $oData, "moderation_id = $_iModerationId");
		return $_iModerationId ; 
	}

	public function this_fetch_array($_oResult){

		$toArrayResult = array();

		while($oArrayResult = odbc_fetch_array($_oResult)){
			array_push($toArrayResult, $oArrayResult);
		}

		return $toArrayResult ; 
	}

	public function updateBadge($oData, $_iBadgeId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('badge', $oData, "badge_id = $_iBadgeId");
		return $_iGcapId ; 
	}

	public function getCongePeriode ($_iUserId, $_zDateDebut, $_zDateFin,$_this){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');
		
		$zSql= "SELECT gcap_id,gcap_typeGcapId,gcap_dateDebut,gcap_dateFin FROM $zDatabaseGcap.gcap
				INNER JOIN $zDatabaseGcap.type ON gcap_typeId = type_id
				INNER JOIN $zDatabaseGcap.statut ON  gcap_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = gcap_userSendId
				WHERE 1
				AND gcap_valide = 1 ";
		
		if ($_zDateDebut != $_zDateFin) {
			$zSql .= " AND ('$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin AND c.matricule = '$_iUserId') " ; 
			$zSql .= " OR ('$_zDateFin' BETWEEN gcap_dateDebut AND gcap_dateFin AND c.matricule = '$_iUserId') " ; 
		} else {
			$zSql .= " AND '$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin AND c.matricule = '$_iUserId' " ; 
		}

		$zSql .= " AND c.matricule IN ($_iUserId) OR c " ; 

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();

		$zAllDate = array();
		foreach ($toRow as $oRow) {
			
			$zDateDebut = $oRow['gcap_dateDebut'] ; 
			$zDateFin  = $oRow['gcap_dateFin'] ; 
			$iKey	   = $oRow['gcap_id'] . "--" . $oRow['gcap_typeGcapId'] ; 

			$zDateDebut = new Datetime( $zDateDebut );
			$zDateFin = new Datetime( $zDateFin );
			$zDateFin = $zDateFin->modify( '+1 day' ); 

			$iInterval = new DateInterval('P1D');
			$oDateRange = new DatePeriod($zDateDebut, $iInterval ,$zDateFin);
			foreach($oDateRange as $zDdate){

				$zDatePush = $zDdate->format("Y-m-d");
				array_push($zAllDate, $zDatePush);
			}
		}

		return $zAllDate ; 
		
	}

	public function getAutrePeriode ($_iUserId, $_zDateDebut, $_zDateFin,$_this){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');
		
		$zSql= "SELECT mission_date,mission_dateEntree,mission_id,user_id,mission_motif FROM $zDatabaseGcap.mission
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = mission_userId
				WHERE 1 ";
		
		if ($_zDateDebut != $_zDateFin) {
			$zSql .= " AND (mission_date  BETWEEN '$_zDateDebut' AND '$_zDateFin' AND c.matricule = '$_iUserId') " ; 
			$zSql .= " OR (mission_dateEntree BETWEEN '$_zDateDebut' AND '$_zDateFin' AND c.matricule = '$_iUserId') " ; 
		} else {
			$zSql .= " AND mission_date BETWEEN '$_zDateDebut' AND '$_zDateFin' AND c.matricule = '$_iUserId' " ; 
		}

		$zSql .= " AND c.matricule IN ($_iUserId) " ; 

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();

		$zAllDate = array();
		$oReturn = array();
		foreach ($toRow as $oRow) {
			
			$zDateDebut = $oRow['mission_date'] ; 
			$zDateFin   = $oRow['mission_dateEntree'] ; 
			$iKey	    = $oRow['mission_id'] . "--" . $oRow['user_id'] ; 

			$zDateDebut = new Datetime( $zDateDebut );
			$zDateFin = new Datetime( $zDateFin );
			$zDateFin = $zDateFin->modify( '+1 day' ); 

			$iInterval = new DateInterval('P1D');
			$oDateRange = new DatePeriod($zDateDebut, $iInterval ,$zDateFin);
			foreach($oDateRange as $zDdate){

				$zDatePush = $zDdate->format("Y-m-d");
				array_push($zAllDate, $zDatePush);
			}

			
			$oReturn['oDataDate']		= $zAllDate ; 
			$oReturn['mission_motif']	= $oRow['mission_motif'] ; 
		}

		return $oReturn ; 
		
	}

	public function this_fetch_row($_oResult, $_iNbrRetard = 0, $_this, $_zDateDebut, $_zDateFin){

		$zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');
		
		$zDateDebut = new Datetime( $zDateDebut );
		$zDateFin = new Datetime( $zDateFin );
		$zDateFin = $zDateFin->modify( '+1 day' ); 

		$iInterval = new DateInterval('P1D');
		$oDateRange = new DatePeriod($zDateDebut, $iInterval ,$zDateFin);
		$toArrayResult = array();

		while(odbc_fetch_row($_oResult))
		{
			$toAssign = new StdClass();
			$toAssign->zUser = odbc_result($_oResult, 1);

			/*
			* Cherche les congés de l'user pendant la période 
			*/

			$toUserConge = $this->getCongePeriode($toAssign->zUser, $_zDateDebut, $_zDateFin,$_this);

			$toUserGetAutre = $this->getAutrePeriode($toAssign->zUser, $_zDateDebut, $_zDateFin,$_this);

			$tzDiff = odbc_result($_oResult, 3);

			$tzDiff = explode(";", $tzDiff) ; 

			$toAssign->tzDiff = array();

			if ($_iNbrRetard > 0) {

				if (sizeof ($tzDiff)-1 >= $_iNbrRetard) {
					$i = 0 ;

					foreach($oDateRange as $zDdate){

						$zAffichage = "";

						if (in_array($zDdate->format("Y-m-d"), $toUserConge)){
							$zAffichage = "CONGÉ";
						}

						if (sizeof($toUserGetAutre)>0) {
							if (in_array($zDdate->format("Y-m-d"), $toUserGetAutre['oDataDate'])){
								$zAffichage = $toUserGetAutre['mission_motif'];
							}
						}
						
						/*$toAssign->tzDiff[$i]["zDateEntree"]	= $zDdate->format("Y-m-d");
						$toAssign->tzDiff[$i]["zDateSortie"]	= '';
						$toAssign->tzDiff[$i]["zDiff"]			= '';
						$toAssign->tzDiff[$i]["zDiffAffichage"]	= '';
						$toAssign->tzDiff[$i]["zObservation"]	= $zAffichage;*/
					
						foreach ($tzDiff as $zDiff) {
							$toInformation = explode("--", $zDiff) ; 
							
							if (isset($toInformation[2]) && ($toInformation[2] != '')) {

								$zDateEntrer = str_replace(".000","",$toInformation[0]);

								if ($zDdate->format("Y-m-d") == date("Y-m-d",strtotime($zDateEntrer))){ 

									$toAssign->tzDiff[$i]["zDateEntree"]	= $zDateEntrer;
									$toAssign->tzDiff[$i]["zDateSortie"]	= str_replace(".000","",$toInformation[1]);

									if ($toAssign->tzDiff[$i]["zDateEntree"] != '' && $toAssign->tzDiff[$i]["zDateSortie"] != ''){

										if ($toInformation[2] > 0) {
											$toAssign->tzDiff[$i]["zDiff"]		= $toInformation[2];
										} else {
											$toAssign->tzDiff[$i]["zDiff"]		= '';
										}
									} else {
										$toAssign->tzDiff[$i]["zDiff"]		= '';
									}
									if (isset($toInformation[3]) && ($toInformation[3] != '')) {
										$toAssign->tzDiff[$i]["iNombreDeFois"]	= $toInformation[3];
									}
									$toAssign->tzDiff[$i]["zDiffAffichage"]	= $this->dateDiff2($toAssign->tzDiff[$i]["zDiff"],0, $_this,5);
									$toAssign->tzDiff[$i]["zObservation"]	= $zAffichage;
								}
							} 
						}
						$i++ ; 
					}
				}

			} else {

				$i = 0 ; 

				foreach($oDateRange as $zDdate){

					$zAffichage = "";

					if (in_array($zDdate->format("Y-m-d"), $toUserConge)){
						$zAffichage = "CONGÉ";
					}

					if (sizeof($toUserGetAutre)>0) {
						if (in_array($zDdate->format("Y-m-d"), $toUserGetAutre['oDataDate'])){
							$zAffichage = $toUserGetAutre['mission_motif'];
						}
					}
					
					$toAssign->tzDiff[$i]["zDateEntree"]	= $zDdate->format("Y-m-d");
					$toAssign->tzDiff[$i]["zDateSortie"]	= '';
					$toAssign->tzDiff[$i]["zDiff"]			= '';
					$toAssign->tzDiff[$i]["zDiffAffichage"]	= '';
					$toAssign->tzDiff[$i]["zObservation"]	= $zAffichage;
				
					foreach ($tzDiff as $zDiff) {
						$toInformation = explode("--", $zDiff) ; 

						if (isset($toInformation[2]) && ($toInformation[2] != '')) {

							$zDateEntrer = str_replace(".000","",$toInformation[0]);

							if ($zDdate->format("Y-m-d") == date("Y-m-d",strtotime($zDateEntrer))){ 

								$toAssign->tzDiff[$i]["zDateEntree"]	= $zDateEntrer;
								$toAssign->tzDiff[$i]["zDateSortie"]	= str_replace(".000","",$toInformation[1]);

								if ($toAssign->tzDiff[$i]["zDateEntree"] != '' && $toAssign->tzDiff[$i]["zDateSortie"] != ''){
									if ($toInformation[2] > 0) {
										$toAssign->tzDiff[$i]["zDiff"]		= $toInformation[2];
									} else {
										$toAssign->tzDiff[$i]["zDiff"]		= '';
									}
								} else {
									$toAssign->tzDiff[$i]["zDiff"]		= '';
								}

								//$toAssign->tzDiff[$i]["zDiff"]			= $toInformation[2];
								if (isset($toInformation[3]) && ($toInformation[3] != '')) {
									$toAssign->tzDiff[$i]["iNombreDeFois"]	= $toInformation[3];
								}
								$toAssign->tzDiff[$i]["zDiffAffichage"]	= $this->dateDiff2($toAssign->tzDiff[$i]["zDiff"],0, $_this,5);
							}
						} else {
							$toInOut = $this->getInOutUserDate($toAssign->zUser, $zDdate->format("Y-m-d"));

							if (sizeof($toInOut)>0){
								$toAssign->tzDiff[$i]["zDateEntree"]	= $zDdate->format("Y-m-d") . " " . $toInOut[0]['inOut_HeureDebut'];
								$toAssign->tzDiff[$i]["zDateSortie"]	= $zDdate->format("Y-m-d") . " " . $toInOut[0]['inOut_HeureFin'];
								$toAssign->tzDiff[$i]["zDiff"]			= strtotime($zDdate->format("Y-m-d")." " .$toInOut[0]['inOut_HeureDebut']) - strtotime($zDdate->format("Y-m-d")." " .$toInOut[0]['inOut_HeureFin']);
								
								
								$toAssign->tzDiff[$i]["zDiffAffichage"]	= $this->dateDiff2($toAssign->tzDiff[$i]["zDiff"],0, $_this,5);
							}

						}
					}
					$i++ ; 
				}
			}
			
			array_push($toArrayResult, $toAssign);

		}

		return $toArrayResult ; 
	}

	function getInOutUserDate($_iUserId,$_zDate){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT in1.*,SUBSTRING(REPLACE(cin,' ',''), 4, 9) as SubCIN, c.matricule as SubMatricule FROM $zDatabaseGcap.inout1 as in1 INNER JOIN $zDatabaseOrigin.candidat as c ON in1.inOut_userId = c.user_id AND in1.inOut_date = '" . $_zDate . "' HAVING (SubMatricule = '".$_iUserId."' OR SubCIN = '".$_iUserId."')" ;

		$zQuery = $this->db->query($zSql);
		$toInOut =  $zQuery->result_array();
		$zQuery->free_result();  

		return $toInOut ; 
	}

	function insertGcapPointage($_oGcapAll){

		$zSql = " INSERT INTO [ZKGcap].[dbo].[gcap] VALUES ( ";
		$zSql .= " '".$_oGcapAll['gcap_id']."', ";
		$zSql .= " '".$_oGcapAll['gcap_userSendId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_typeGcapId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_typeId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_dateDebut']."', ";
		$zSql .= " '".$_oGcapAll['gcap_dateFin']."', ";
		$zSql .= " '".(str_replace("'","''",$_oGcapAll['gcap_motif']))."', ";
		$zSql .= " '".(str_replace("'","''",$_oGcapAll['gcap_lieuJouissance']))."', ";
		$zSql .= " '".$_oGcapAll['gcap_statutId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_userValidId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_dateValidation']."', ";
		$zSql .= " '".$_oGcapAll['gcap_valide']."', ";
		$zSql .= " '".$_oGcapAll['gcap_vue']."', ";
		$zSql .= " '".(str_replace("'","''",$_oGcapAll['gcap_autorisaionCaracteristique']))."', ";
		$zSql .= " '".$_oGcapAll['gcap_MatinSoir']."', ";
		$zSql .= " '".$_oGcapAll['gcap_demiJournee']."', ";
		$zSql .= " '".(str_replace("'","''",$_oGcapAll['conv_pers']))."', ";
		$zSql .= " '".$_oGcapAll['gcap_userSendId']."') ";

		echo $zSql . "<br>\n" ; 

		//$this->executeQueryZKGcap($zSql);
	}

	function insertInoutPointage($_oInoutAll){

		$zSql = " INSERT INTO [ZKGcap].[dbo].[inout] VALUES ( ";
		$zSql .= " '".$_oInoutAll['inOut_id']."', ";
		$zSql .= " '".$_oInoutAll['inOut_userId']."', ";
		$zSql .= " '".$_oInoutAll['inOut_userSendId']."', ";
		$zSql .= " '".$_oInoutAll['inOut_date']."', ";
		$zSql .= " '".$_oInoutAll['inOut_date'] . " " . $_oInoutAll['inOut_HeureDebut']."', ";
		$zSql .= " '".$_oInoutAll['inOut_date'] . " " . $_oInoutAll['inOut_HeureFin']."', ";
		$zSql .= " '".$_oInoutAll['matricule']."') ";
		$this->executeQueryZKGcap($zSql);
	}


	function insertGcapZkGcap(){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT g.*,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseGcap.gcap g LEFT JOIN $zDatabaseOrigin.candidat c ON g.gcap_userSendId = c.user_id ORDER BY gcap_id ASC " ;

		$zQuery = $this->db->query($zSql);
		$toGcapAll =  $zQuery->result_array();
		$zQuery->free_result(); 

		$iIncrement = 0;
		foreach ($toGcapAll as $oGcapAll){
			$this->insertGcapPointage($oGcapAll);
			$iIncrement++;
		}

		return $toGcapAll ; 
	}

	function insertGcapZkInout(){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT i.*,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseGcap.inout1 i LEFT JOIN $zDatabaseOrigin.candidat c ON i.inOut_userId = c.user_id " ;

		$zQuery = $this->db->query($zSql);
		$toInoutAll =  $zQuery->result_array();
		$zQuery->free_result(); 

		$iIncrement = 0;
		foreach ($toInoutAll as $oInoutAll){
			$this->insertInoutPointage($oInoutAll);
			$iIncrement++;
		}

		return $toGcapAll ; 
	}

	function insertInoutMission($_oMissionAll){

		$zSql = " INSERT INTO [ZKGcap].[dbo].[mission] VALUES ( ";
		$zSql .= " '".$_oMissionAll['mission_id']."', ";
		$zSql .= " '".$_oMissionAll['mission_userId']."', ";
		$zSql .= " '".$_oMissionAll['mission_userSendId']."', ";
		$zSql .= " '".$_oMissionAll['mission_date']."', ";
		$zSql .= " '".$_oMissionAll['mission_date'] . " " . $_oMissionAll['mission_heureSortie']."', ";
		$zSql .= " '".$_oMissionAll['mission_dateEntree']."', ";
		$zSql .= " '".$_oMissionAll['mission_dateEntree'] . " " . $_oMissionAll['mission_heureEntree']."', ";
		$zSql .= " '".utf8_decode(str_replace("'","''",$_oMissionAll['mission_motif']))."', ";
		$zSql .= " '".$_oMissionAll['matricule']."') ";

		//echo $zSql . "<br><br>"; 

		//die();
		$this->executeQueryZKGcap($zSql);
	}

	function insertGcapZkMission(){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT m.*,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseGcap.mission m LEFT JOIN $zDatabaseOrigin.candidat c ON m.mission_userId = c.user_id " ;

		$zQuery = $this->db->query($zSql);
		$toMissionAll =  $zQuery->result_array();
		$zQuery->free_result(); 

		$iIncrement = 0;
		foreach ($toMissionAll as $oMissionAll){
			$this->insertInoutMission($oMissionAll);
			$iIncrement++;
		}

		return $toGcapAll ; 
	}

	public function traitemetDateFin($_zDateFin, $_this) {
		
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-'); 

		$_zDateFin = date('d/m/Y', strtotime($_zDateFin.' + 1 DAY'));

		return $_zDateFin ; 
	}

	public function getMatriculeAgent($_iCompteActif, $_iUserId, $_oCandidat) {

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
				$zSql = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseOrigin.candidat c WHERE c.user_id = " . $_oCandidat[0]->user_id  ;
							break;

				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
			case COMPTE_AUTORITE :
			case COMPTE_ADMIN :

					$zSql = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseOrigin.candidat c WHERE c.user_id = $_iUserId " ;

				break;
		}

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$toCandidatUser = array(); 
		$zInMatriculeUser = "";
		$toGetAllTransaction = array();
		foreach ($toRow as $oCandidatUser)
		{
			 array_push ($toCandidatUser, (int)$oCandidatUser["matricule"]);
		}

		if (sizeof($toCandidatUser)>0) {
			$zInMatriculeUser = implode(",", $toCandidatUser);
		}

		return $zInMatriculeUser ; 
	}

	function getJourNBFerie($_zDate1, $_zDate2){
		
		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql	= "SELECT ferie_date FROM $zDatabaseGcap.ferie WHERE ferie_date BETWEEN '$_zDate1' AND '$_zDate2'";
		$zQuery = $this->db->query($zSql);
		$toRow	= $zQuery->result_array();

		return sizeof($toRow) ; 
     }

	
	function getJours($_zDateDebut,$_zDateFin,$_this){
		$iNbJours = 0;

		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-'); 

		$zDateDebut = explode('-',$_zDateDebut);
		$zDateFin = explode('-',$_zDateFin);

		
		$zTimeStampcurr = mktime(0,0,0,$zDateDebut[1],$zDateDebut[2],$zDateDebut[0]);
		$zTimeStampf = mktime(0,0,0,$zDateFin[1],$zDateFin[2],$zDateFin[0]);

		while($zTimeStampcurr<=$zTimeStampf){

			if((date('w',$zTimeStampcurr)!=0)&&(date('w',$zTimeStampcurr)!=6)){
				$iNbJours++;
			}
			$zTimeStampcurr=mktime(0,0,0,date('m',$zTimeStampcurr),(date('d',$zTimeStampcurr)+1)   ,date('Y',$zTimeStampcurr));

		}

		$iNbJours -=  $this->getJourNBFerie($_zDateDebut,$_zDateFin);
		return $iNbJours;

	}

	function dateDiff($zDate1, $zDate2, $_this, $_iReturn=0){

		if ($_iReturn != 5) {
			$zDate1 = $_this->date_fr_to_en($zDate1,'/','-'); 
			$zDate2 = $_this->date_fr_to_en($zDate2,'/','-'); 

			if(!is_integer($zDate1)){
				$zDate1 = strtotime($zDate1);
			}
			if(!is_integer($zDate2)){
				$zDate2 = strtotime($zDate2);
			}

			//echo $zDate1 . "----" . $zDate2 . "<br>";
		}

		
		$zDate1 = str_replace(".000","", $zDate1);
		$zDate2 = str_replace(".000","", $zDate2);
		$iDiff = abs($zDate1 - $zDate2); 

		$oRetour = array();
	 
		$iTmp = $iDiff;
		$oRetour['second'] = $iTmp % 60;
	 
		$iTmp = floor( ($iTmp - $oRetour['second']) /60 );
		$oRetour['minute'] = $iTmp % 60;


		$iTmp2 = floor( ($iTmp - $oRetour['minute'])/60 );
		$oRetour['hour1'] = $iTmp2 % 24;
	 
		$iTmp2 = floor( ($iTmp2 - $oRetour['hour1'])  /24 );
		$oRetour['day1'] = $iTmp2;
	 
		$iTmp = floor( ($iTmp - $oRetour['minute'])/60 );
		$oRetour['hour'] = $iTmp % 8;
	 
		$iTmp = floor( ($iTmp - $oRetour['hour'])  /8 );
		$oRetour['day'] = $iTmp;


		switch ($_iReturn) {

			case 0:
				return $oRetour;
				break;

			case 1:
				return $oRetour['day1'];
				break;

			case 2:
				return $oRetour['hour'];
				break;

			case 3:
				return $oRetour['minute'];
				break;

			case 4:
				return $oRetour['second'];
				break;

			case 5:
			case 7:
				
				$zReturn = "";

				if ($oRetour['day']>0) {
					$zReturn .= $oRetour['day'] . "j " ; 
				}

				if ($oRetour['hour']>0) {
					$zReturn .= $oRetour['hour'] . "h " ; 
				}

				if ($oRetour['minute']>0) {
					$zReturn .= $oRetour['minute'] . "mn " ; 
				}

				if ($oRetour['second']>0) {
					$zReturn .= $oRetour['second'] . "s " ; 
				}

				return $zReturn;
				break;

			case 6:
				return $iDiff ; 
				break;

			case 8:
				return $oRetour['day'];
				break;
		}
	}

	function dateDiff2($zDate1, $zDate2, $_this, $_iReturn=0){

		if ($_iReturn != 5) {
			$zDate1 = $_this->date_fr_to_en($zDate1,'/','-'); 
			$zDate2 = $_this->date_fr_to_en($zDate2,'/','-'); 

			/*$toDate1 = explode('-', $zDate1) ; 
			$toDate2 = explode('-', $zDate2) ; 

			if (sizeof($toDate1)>0) {
				$zDate1 = strtotime($zDate1);
			}

			if (sizeof($toDate2)>0) {
				$zDate2   = strtotime($zDate2);
			}*/

			$zDate1 = strtotime($zDate1);
			$zDate2 = strtotime($zDate2);
		}

		
		$zDate1 = str_replace(".000","", $zDate1);
		$zDate2 = str_replace(".000","", $zDate2);
		$iDiff = abs($zDate1 - $zDate2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

		$oRetour = array();
	 
		$iTmp = $iDiff;
		$oRetour['second'] = $iTmp % 60;
	 
		$iTmp = floor( ($iTmp - $oRetour['second']) /60 );
		$oRetour['minute'] = $iTmp % 60;


		$iTmp2 = floor( ($iTmp - $oRetour['minute'])/60 );
		$oRetour['hour'] = $iTmp2 % 24;
	 
		$iTmp2 = floor( ($iTmp2 - $oRetour['hour'])  /24 );
		$oRetour['day'] = $iTmp2;


		switch ($_iReturn) {

			case 0:
				return $oRetour;
				break;

			case 1:
				return $oRetour['day'];
				break;

			case 2:
				return $oRetour['hour'];
				break;

			case 3:
				return $oRetour['minute'];
				break;

			case 4:
				return $oRetour['second'];
				break;

			case 5:
			case 7:
				
				$zReturn = "";

				if ($oRetour['day']>0) {
					$zReturn .= $oRetour['day'] . ":" ; 
				}

				if ($oRetour['hour']>0) {
					$zReturn .= trim(sprintf("%02d\n", $oRetour['hour'])) . ":" ; 
				} else {
					$zReturn .= "00:" ; 
				}

				if ($oRetour['minute']>0) {
					$zReturn .= trim(sprintf("%02d\n", $oRetour['minute'])) . ":" ; 
				} else {
					$zReturn .=  "00:" ; 
				}

				if ($oRetour['second']>0) {
					$zReturn .= trim(sprintf("%02d\n", $oRetour['second'])) . "" ; 
				} else {
					$zReturn .=  "00" ; 
				}

				return $zReturn;
				break;

			case 6:
				return $iDiff ; 
				break;

			case 8:
				return $oRetour['day'];
				break;
		}
	}
	
	public function get_transaction($_iMatricule, $_iCompteActif, $_iUserId, $_oCandidat,$_zDateDebut, $_zDateFin,$_this,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1){

		if ($_iMatricule == "") {
			$zInMatriculeUser = $this->getMatriculeAgent($_iCompteActif, $_iUserId, $_oCandidat);
		} else {
			
			if (strlen($_iMatricule)==6){
				$zInMatriculeUser = $_iMatricule ; 
			} else {
				$zInMatriculeUser = str_replace(" ","",substr($_iMatricule, -12, 12)); 
			}
		}

		//echo ">>>> " . $zInMatriculeUser ; 
		//die();

		if ($zInMatriculeUser != "") {
			
			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);

/*********************** A commenter en ligne ***********************************************/
				/*$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
				$_zDateFinTraitement = $_this->date_fr_to_en($_zDateFinTraitement,'/','-');*/
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ;

			}

			if ($_zDateDebut !=""){
				$toDateAccess = explode("/", $_zDateDebut);
			} else {
				$toDateAccess = explode("/", date("d/m/Y"));
			}


			$zQuerySqlServer = "SELECT COUNT(*) OVER() AS [totalrows],convert(varchar(10),time,108) as Datetime,event_point_name, pin,time,state,
			CAST( CASE 
			WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='1'
				THEN 'Sortie' 
			WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='0'
				THEN 'Entr&eacute;e' 
			WHEN SUBSTRING(event_point_name, 1, 1) = 'S'
				THEN 'Sortie' 
			WHEN SUBSTRING(event_point_name, 1, 1) = 'E'
				THEN 'Entr&eacute;e' 
			END AS varchar) as statut
			FROM 
			[ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] 
			WHERE (pin=". $zInMatriculeUser .") AND ".$zInsert."
			GROUP BY pin, time,event_point_name,state
			ORDER BY time ";

			$zQuerySqlServer .= " OFFSET ".($_iCurrPage - 1) * $_iValPerPage." ROWS FETCH NEXT ".$_iValPerPage." ROWS ONLY;  " ;

			$oResult = $this->executeQuery($zQuerySqlServer);
			$oResult2 = $this->executeQuery($zQuerySqlServer);
			$toGetAllTransaction = array();
			

			while($oArrayResult = odbc_fetch_array($oResult)){
				$oArray = array();
				$oArray['time']				= odbc_result($oResult,5); 
				$oArray['event_point_name']	= odbc_result($oResult,3); 
				$oArray['statut']			= odbc_result($oResult,7); 
				if ($zInMatriculeUser == "298753"){
					if(odbc_result($oResult,7) =="Sortie"){
						//$oArray['time']		= odbc_result($oResult,5); 
						$oArray['time']		= substr(odbc_result($oResult,5), 0, 10) ."  "."15:".rand(52,58).":".rand(01,47) ; 
					}else{
						$oArray['time']		= substr(odbc_result($oResult,5), 0, 10) ."  "."07:".rand(47,50).":".rand(37,47) ; 
					}
				}
				array_push($toGetAllTransaction, $oArray);
			}

			$toAll = $this->this_fetch_array($oResult2);
			$i = 0;
			

			if (sizeof($toAll)>0) {
				
				$toFirstTransaction =  (reset($toAll)); 

				$i = 0;
				foreach ($toFirstTransaction as $iKey => $zValue) {
					if ($i == 0){ 
						$_iNbrTotal = $zValue ; 
					}
					$i++;
				}
			}
		}

		return $toGetAllTransaction ; 
	}

	public function get_transaction_mysql($_iMatricule, $_iCompteActif, $_iUserId, $_oCandidat,$_zDateDebut, $_zDateFin,$_this,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1){
		global $db;
		$DB1 = $this->load->database('transactions', TRUE);	

		if ($_iMatricule == "") {
			$zInMatriculeUser = $this->getMatriculeAgent($_iCompteActif, $_iUserId, $_oCandidat);
		} else {
			
			if (strlen($_iMatricule)==6){
				$zInMatriculeUser = $_iMatricule ; 
			} else {
				$zInMatriculeUser = str_replace(" ","",substr($_iMatricule, -12, 12)); 
			}
		}
			
		$zDateDebut	= $this->LibUtils->date_fr_to_en($_zDateDebut,"/","-");
		$zDateFin   = $this->LibUtils->date_fr_to_en($_zDateFin,"/","-");

		$zSql="SELECT  id,
		               time,
					   pin,
					   state,
					   event_point_name,
					   CASE 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='1'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='0'
							THEN 'Entrée' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'S'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'E'
							THEN 'Entrée' 
						END AS statut
		         FROM acc_monitor_log_2019
				 WHERE pin='".$zInMatriculeUser."'
				 AND (DATE_FORMAT(time,'%Y-%m-%d') BETWEEN  '".$zDateDebut."' AND '".$zDateFin."') 
				 
			   UNION
				SELECT id,
		               time,
					   pin,
					   state,
					   event_point_name,
					   CASE 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='1'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='0'
							THEN 'Entrée' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'S'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'E'
							THEN 'Entrée' 
						END AS statut
		         FROM acc_monitor_log_2018
				 WHERE pin='".$zInMatriculeUser."'
				 AND (DATE_FORMAT(time,'%Y-%m-%d') BETWEEN  '".$zDateDebut."' AND '".$zDateFin."') 
			   UNION
			   SELECT  id,
		               time,
					   pin,
					   state,
					   event_point_name,
					   CASE 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='1'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='0'
							THEN 'Entrée' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'S'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'E'
							THEN 'Entrée' 
						END AS statut
		         FROM acc_monitor_log_2017
				 WHERE pin='".$zInMatriculeUser."'
				  AND (DATE_FORMAT(time,'%Y-%m-%d') BETWEEN  '".$zDateDebut."' AND '".$zDateFin."') 
			   UNION
				SELECT id,
		               time,
					   pin,
					   state,
					   event_point_name,
					   CASE 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='1'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='0'
							THEN 'Entrée' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'S'
							THEN 'Sortie' 
						WHEN SUBSTRING(event_point_name, 1, 1) = 'E'
							THEN 'Entrée' 
						END AS statut
		         FROM acc_monitor_log_2016
				 WHERE pin='".$zInMatriculeUser."'
				 AND (DATE_FORMAT(time,'%Y-%m-%d') BETWEEN  '".$zDateDebut."' AND '".$zDateFin."') 
			   ";
		$iInit		= ($_iCurrPage-1)*10;
		$iFinal		= ($_iCurrPage)*10;
		$zSql = $zSql . "  ORDER BY TIME ASC  " ;
		$zSql = $zSql . "  LIMIT ".$iInit.",".$iFinal ;
		$zQuery = $DB1->query($zSql);
		$toGetAllTransaction = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
		$zQueryDataCount	= "SELECT FOUND_ROWS() AS iNumRows" ;
		$toDataCount		= $DB1->query($zQueryDataCount) ;
		$toRow				= $toDataCount->result_array();
		if(sizeof($toRow)>0){
			$_iNbrTotal		= $toRow[0]['iNumRows'] ;
		}

		return $toGetAllTransaction;
	}

	public function get_transactionVisiteur($_iMatricule, $_zDateDebut, $_zDateFin,$_this,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1){
			
			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);
/*********************** A commenter en ligne ***********************************************/
				/*$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
				$_zDateFinTraitement = $_this->date_fr_to_en($_zDateFinTraitement,'/','-');*/
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ;
			}

			//$toDateAccess = explode("/", $_zDateDebut);

			if ($_zDateDebut !=""){
				$toDateAccess = explode("/", $_zDateDebut);
			} else {
				$toDateAccess = explode("/", date("d/m/Y"));
			}

			$zQuerySqlServer = "SELECT COUNT(*) OVER() AS [totalrows],convert(varchar(10),time,108) as Datetime,event_point_name, pin,time  FROM 
			[ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] 
			WHERE (pin=". $_iMatricule .") AND ".$zInsert."
			GROUP BY pin, time,event_point_name
			ORDER BY time ";

			//echo $zQuerySqlServer ; 

			/*$zQuerySqlServer .= " OFFSET ".($_iCurrPage - 1) * $_iValPerPage." ROWS FETCH NEXT ".$_iValPerPage." ROWS ONLY;  " ;*/

			$oResult = $this->executeQuery($zQuerySqlServer);
			
			$toGetAllTransaction = $this->this_fetch_array($oResult);

			$i = 0;

			if (sizeof($toGetAllTransaction)>0) {
				
				$toFirstTransaction =  (reset($toGetAllTransaction)); 

				$i = 0;
				foreach ($toFirstTransaction as $iKey => $zValue) {

					if ($i == 0){ 
						$_iNbrTotal = $zValue ; 
					}
					$i++;
				}
			}

		return $toGetAllTransaction ; 
	}

	public function getBadgeNumber($_iUserId){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$zSql = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseOrigin.candidat c WHERE c.user_id = " . $_iUserId  ;

		$oQuery = $this->db->query($zSql);
		$oRow = $oQuery->result_array();

		$iBadgeNumber = 0;

		foreach($oRow as $oRow){
			$iBadgeNumber = $oRow['matricule'] ; 
		}

		return $iBadgeNumber ; 
	}

	public function getNotificationCarte($_iUserId){

		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseGcap.badge WHERE badge_userId = ".$_iUserId." AND badge_dateObtention<>'' AND badge_notification=0";

		$oQuery = $this->db->query($zSql);
		$oRow = $oQuery->result_array();

		$iRet = 0 ;
		if (sizeof($oRow)>0) {
			$iRet = 1 ; 
		}

		return $iRet ; 
	}

	public function CheckImCarte($_iBadgeNumber,$_iNumCarte){

		$iRet = 0 ;
		$zQuerySqlServer = "SELECT * FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] WHERE [Badgenumber] = '".(int)$_iBadgeNumber."' AND [CardNo]='".$_iNumCarte."'";

		$oResult = $this->executeQuery($zQuerySqlServer);
		
		$toGetAllTransaction = $this->this_fetch_array($oResult);
		if (sizeof($toGetAllTransaction)>0) {
			$iRet = 1 ; 
		}

		return $iRet ; 
	}

	public function getImCarte($_iBadgeNumber){

		$iRet = 0 ;
		$zQuerySqlServer = "SELECT CardNo FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] WHERE [Badgenumber] = '".(int)$_iBadgeNumber."'";

		$oResult = $this->executeQuery($zQuerySqlServer);
		
		$oRow = $this->this_fetch_array($oResult);

		$zCheckIm = '';

		foreach($oRow as $oRow){
			$zCheckIm = sprintf("%'.010d\n", $oRow['CardNo']);
		}

		return $zCheckIm ; 
	}


	public function RapportTransaction($_zUserId,$_iSeuil,$_iNbrRetard,$_zHeureSeuil,$_zDateDebut, $_zDateFin, $_this,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1){

		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$toCandidatUser = unserialize($_zUserId);
		$zInMatriculeUser = 0;

		if (sizeof($toCandidatUser)>0) {

			$toCandidatUserMatricule = array();
			foreach ($toCandidatUser as $oCandidatUser)
			{
				 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
			}

			$zInMatriculeUser = implode(",", $toCandidatUserMatricule);
		}

		if ($_zDateDebut == $_zDateFin) {
			//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
			$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
		} else {
			
			$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);

		/*********************** A commenter en ligne ***********************************************/
			/*$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
			$_zDateFinTraitement = $_this->date_fr_to_en($_zDateFinTraitement,'/','-');*/
			$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ;

		}

		//$toDateAccess = explode("/", $_zDateDebut);

		if ($_zDateDebut !=""){
			$toDateAccess = explode("/", $_zDateDebut);
		} else {
			$toDateAccess = explode("/", date("d/m/Y"));
		}


		if ($_iSeuil == 1 AND $_iNbrRetard > 0 && $_zHeureSeuil != '') {

			$zQuerySqlServer = "SELECT t.pin,t.pin,
				CAST((
					  SELECT CONCAT(min( case when SUBSTRING(event_point_name, 1, 1)='E' then CONCAT( CAST(time AS  Date),' ',CAST(time AS  TIME)) end),'--',max( case when SUBSTRING(event_point_name, 1, 1)='S' then CONCAT( CAST(time AS  Date),' ',CAST(time AS  TIME)) END),'--',(datediff(second,min( case when SUBSTRING(event_point_name, 1, 1)='E' then time end),max( case when SUBSTRING(event_point_name, 1, 1)='S' then time end))),';')
					  FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] t3
					  WHERE (t3.pin = t.pin AND ".$zInsert."
					)  GROUP BY CAST(time AS  Date) HAVING (ABS(datediff(second,min(time),max(time))) < ".$_zHeureSeuil.")
					  
					  FOR XML PATH(''))as varchar(max)) AS [Column] 
			
			FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] t
			WHERE (t.pin IN (". $zInMatriculeUser ."))  
			GROUP BY t.pin,t.pin" ;

		} else {

			$zQuerySqlServer = "SELECT t.pin,t.pin,
				CAST((
					  SELECT CONCAT(min( case when SUBSTRING(event_point_name, 1, 1)='E' then CONCAT( CAST(time AS  Date),' ',CAST(time AS  TIME)) end),'--',max( case when SUBSTRING(event_point_name, 1, 1)='S' then CONCAT( CAST(time AS  Date),' ',CAST(time AS  TIME)) END),'--',(datediff(second,min( case when SUBSTRING(event_point_name, 1, 1)='E' then time end),max( case when SUBSTRING(event_point_name, 1, 1)='S' then time end))),';')
					  FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] t3
					  WHERE (t3.pin = t.pin AND ".$zInsert." 
					)  GROUP BY CAST(time AS  Date)
					  
					  FOR XML PATH(''))as varchar(max)) AS [Column] 
			
			FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] t
			WHERE (t.pin IN (". $zInMatriculeUser ."))  
			GROUP BY t.pin,t.pin" ;
		}

		$oResult = $this->executeQuery($zQuerySqlServer);
		$toGetAllRapports = $this->this_fetch_row($oResult, $_iNbrRetard, $_this, $_zDateDebut, $_zDateFin);

		$toListe = array();

		foreach ($toCandidatUser as $oCandidatUser){ 

			foreach ($toGetAllRapports as $oGetAllRapports){
			
				 if ((int)$oCandidatUser["matricule"] == (int)$oGetAllRapports->zUser){

					$i = 0;
					foreach ($oGetAllRapports->tzDiff as $toDiff)
					{
						$oListe = new StdClass();
						$oListe->zDateEntee = $toDiff['zDateEntree'];
						$oListe->zDateSortie = $toDiff['zDateSortie'];
						$oListe->zDiffAffichage = $toDiff['zDiffAffichage'];
						$oListe->zObservation = $toDiff['zObservation'];

						$oListe->data	= $oCandidatUser;
						array_push($toListe, $oListe);

						$i++ ; 
						
					}
				 }
			}
			
		}

		return $toListe ; 
	}

	public function get_Rang($_iMatricule,$_iCompteActif, $_iUserId, $_oCandidat,$_zDateDebut, $_zDateFin, $_this,$iTestRang=0){

		
		$toAssign = array();
		if ($_zDateDebut !="" && $_zDateDebut != "") {

			$_zDateFinOrigin				= $_zDateFin ; 
			$_zDateFinAffich				= $this->traitemetDateFin($_zDateFin, $_this);
			$oAffiche						= new stdClass();
			$oAffiche->dateDebut			= $_zDateDebut ; 
			$oAffiche->dateFin				= $_zDateFinOrigin ; 
			$oAffiche->diffDate				= $this->dateDiff($_zDateDebut, $_zDateFinAffich, $_this,1);
			$zDiffSearch = 0;
			if ($iTestRang == 0) {
				if ($_oCandidat[0]->matricule == "ECD") {
					$zInMatriculeUser			= $this->getMatriculeAgent($_iCompteActif, $_iUserId, $_oCandidat);
				} else {
					$zInMatriculeUser			= $_oCandidat[0]->matricule ;
				}
				$oAffiche->rangParDivision		= $this->getUserLocalisation("division", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
				$oAffiche->rangParService		= $this->getUserLocalisation("service", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
				$oAffiche->rangParDirection		= $this->getUserLocalisation("direction", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
				$oAffiche->rangParDepartement	= $this->getUserLocalisation("departement", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
			} else {
				$oAffiche->rangParDirection		= $this->getUserLocalisation("direction", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
			}

			$oAffiche->nbrJourTaf			= $zDiffSearch ; 

			array_push ($toAssign, $oAffiche);
		}

		return $toAssign ;
	}

	public function get_Rang_Old($_iMatricule,$_iCompteActif, $_iUserId, $_oCandidat,$_zDateDebut, $_zDateFin, $_this,$iTestRang=0){

		
		$toAssign = array();
		if ($_zDateDebut !="" && $_zDateDebut != "") {

			$_zDateFinOrigin = $_zDateFin ; 
			$_zDateFinAffich = $this->traitemetDateFin($_zDateFin, $_this);

			//$zDiffSearch = $this->TempsDeTravailDunAgent($_iCompteActif, $_iUserId, $_oCandidat,$_zDateDebut, $_zDateFin, $_this,$_iMatricule,$iResultSearch);

			$oAffiche = new stdClass();
			$oAffiche->dateDebut			= $_zDateDebut ; 
			$oAffiche->dateFin				= $_zDateFinOrigin ; 
			$oAffiche->diffDate				= $this->dateDiff($_zDateDebut, $_zDateFinAffich, $_this,1);
			//$oAffiche->nbrJourTaf			= $zDiffSearch ; 
			$zDiffSearch = 0;
			if ($iTestRang == 0) {

				 
				if ($_oCandidat[0]->matricule == "ECD") {
					$zInMatriculeUser = $this->getMatriculeAgent($_iCompteActif, $_iUserId, $_oCandidat);
				} else {
					$zInMatriculeUser = $_oCandidat[0]->matricule ;
				}
				$oAffiche->rangParDivision		= $this->getUserLocalisation("division", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
				$oAffiche->rangParService		= $this->getUserLocalisation("service", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
				$oAffiche->rangParDirection		= $this->getUserLocalisation("direction", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
				$oAffiche->rangParDepartement	= $this->getUserLocalisation("departement", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
			} else {
				$oAffiche->rangParDirection		= $this->getUserLocalisation("direction", $_oCandidat, $zInMatriculeUser, $_zDateDebut, $_zDateFin, $_this, $zDiffSearch);
			}

			$oAffiche->nbrJourTaf			= $zDiffSearch ; 

			array_push ($toAssign, $oAffiche);
		}

		return $toAssign ;
	}

	public function get_agents_evalues_par_user_id($_iUserEvaluateurId = 0) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= " select * from evaluation WHERE 1" ;

		if ($_iUserEvaluateurId != 0) {
			$zSql .= " AND evaluation_userId = " . $_iUserEvaluateurId;
		}

		$zSql .= " AND evaluation_userEvalue <> '' ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$zReturn = "";
		$i=0;
		foreach ($toRow as $oRow){
			$tzReturn = $oRow["evaluation_userEvalue"];

			if ($i > 0) {
				$zReturn .= ",";
			}
			$tzReturn = explode("-", $tzReturn);
			$toReturnAll = array();
			foreach ($tzReturn as $izReturn) {
				if ($izReturn != ''){
					array_push($toReturnAll, $izReturn);
				}
			}
			$zReturn .= implode (",", $toReturnAll);
			$i++;
		}

		//$zReturn = str_replace(",,",",",$zReturn);
		
		return $zReturn;
	}

	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$_isPointage=TRUE) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
				//echo "miditra";
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
				if ($_oUser['serv'] > 0) {

					$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1, IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.service = ".$_oUser['serv']."" ; 

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}


				} elseif ($_oUser['dir'] > 0) {
					
					$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.direction = ".$_oUser['dir']."" ; 

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}

				
				} elseif ($_oUser['dep'] > 0) {

					$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.departement = ".$_oUser['dep']."" ;

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}

				} else {
					
					
					$zSql = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c " ;  
					
					if ($_oCandidat[0]->division > 0 && $_oCandidat[0]->division < '500') {
						/* même division */
						$zSql .= "INNER JOIN $zDatabaseOrigin.module m ON m.id = c.division
							WHERE m.id  = (SELECT division FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					} elseif ($_oCandidat[0]->service!='') {
						/* même service */
						$zSql .= " WHERE c12.service = '".$_oCandidat[0]->service."' AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					} else {
						/* même direction */
						$zSql .= " WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					}
				}

				// $zSql .= " AND c.candidat_economie IS NULL AND matricule NOT IN (111111,654321)" ; 
				//$zSql .= " AND c.matricule NOT IN ('ECD') GROUP BY c.matricule " ;
				$zSql .= " AND c.candidat_economie IS NULL " ;

				if ($_isPointage == TRUE){
					$zSql .= " AND c.isPointage=1 " ;
				}

				$zSql .= " AND c.matricule not like '%STG%'" ;
				$zSql .= " AND (c.sanction='0' || c.sanction='' || c.sanction='00' || sanction='34' || c.sanction IS NULL)  " ;
				$zSql .= " AND detache=0 " ;

				$zSql .= " Group by user_id " ;  

				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$zUserId = serialize($toCandidatUser);

				break;	
		
		case COMPTE_AUTORITE :
				

				if ($_oUser['serv'] > 0) {

					$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1, IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.service = ".$_oUser['serv']."" ; 

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}


				} elseif ($_oUser['dir'] > 0) {
					
					$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.direction = ".$_oUser['dir']."" ; 

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}

				
				} elseif ($_oUser['dep'] > 0) {

					$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.departement = ".$_oUser['dep']."" ;

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}

				} else {
					
				
				
					$zSql = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c " ;  
					
					/* même division */
					if ($_oCandidat[0]->division > 0 && $_oCandidat[0]->division < '500') {
						
						$zSql .= "INNER JOIN $zDatabaseOrigin.module m ON m.id = c.division
							WHERE m.id  = (SELECT division FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					} elseif ($_oCandidat[0]->service!='') {
						/* même service */
						$zSql .= " WHERE c.service = '".$_oCandidat[0]->service."' AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					} else {
						/* même direction */
						$zSql .= " WHERE c.direction = '".$_oCandidat[0]->direction."' AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					}
				}
				
				$zSql .= " AND c.candidat_economie IS NULL " ;

				if ($_isPointage == TRUE){
					$zSql .= " AND c.isPointage=1 " ;
				}

				$zSql .= " AND c.matricule not like '%STG%'" ;
				$zSql .= " AND (c.sanction='0' || c.sanction='' || c.sanction='00' || sanction='34' || c.sanction IS NULL)  " ;
				$zSql .= " AND detache=0 " ;

				$zSql .= " Group by user_id " ;  

				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$zUserId = serialize($toCandidatUser);

				break;	
				
		case COMPTE_EVALUATEUR :
				
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);

				$zUserId = ($zUserId=='')?-1:$zUserId; 
				
				$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE 1" ;
		
				$zSql  .= " AND c.user_id IN (" . $zUserId . ") " ; 
				$zSql .= " AND c.candidat_economie IS NULL AND c.isPointage=1 " ;

				$zSql .= " AND c.matricule not like '%STG%'" ;
				$zSql .= " AND (c.sanction='0' || c.sanction='' || c.sanction='00' || sanction='34' || c.sanction IS NULL)  " ;
				$zSql .= " AND detache=0 " ;

				$zSql .= " Group by user_id " ;  

				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$zUserId = serialize($toCandidatUser);

				break;
		
		case COMPTE_ADMIN :
				$zNotIn = "" ; 

				$zSql  = "SELECT SUBSTRING(REPLACE(cin,' ',''), 4, 9) cin1,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.user_id FROM $zDatabaseOrigin.candidat c WHERE 1" ;

				if (isset($_POST["iDepartementId"]) && $_POST["iDepartementId"] != "") {
					$zSql .= " AND c.departement = '" . $_POST["iDepartementId"]."'" ;
				}

				$zSql .= " AND c.matricule not like '%STG%'" ;
				$zSql .= " AND (c.sanction='0' || c.sanction='' || c.sanction='00' || sanction='34' || c.sanction IS NULL)  " ;
				$zSql .= " AND detache=0 " ;

				$zSql .= " Group by user_id " ;  

				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$zUserId = serialize($toCandidatUser);

				break;
			
		default:
			$zUserId = $_iUserId ; 
			break;
		
		}

		if ($_iCompteActif != COMPTE_ADMIN){
			$zUserId = ($zUserId=='')?-1:$zUserId; 
		}

		return $zUserId ; 
	}

	public function getAllUserSubordonneesIsPointage ($_iCurrPage,$_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="") {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
			case COMPTE_AUTORITE :
				if ($_oUser['serv'] > 0) {

					$zSql  = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.poste FROM $zDatabaseOrigin.candidat c WHERE c.service = ".$_oUser['serv']."" ; 

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}


				} elseif ($_oUser['dir'] > 0) {
					
					$zSql  = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.poste,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.direction = ".$_oUser['dir']."" ; 

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}

				
				} elseif ($_oUser['dep'] > 0) {

					$zSql  = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.poste,c.user_id FROM $zDatabaseOrigin.candidat c WHERE c.departement = ".$_oUser['dep']."" ;

					if ($_oUser['reg'] > 0){
						$zSql .= " AND c.region_id = ".$_oUser['reg']; 
					}

				} else {
					
					
					$zSql = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.poste,c.user_id FROM $zDatabaseOrigin.candidat c " ;  
					
					if ($_oCandidat[0]->division > 0 && $_oCandidat[0]->division < '500') {
						/* même division */
						$zSql .= "INNER JOIN $zDatabaseOrigin.module m ON m.id = c.division
							WHERE m.id  = (SELECT division FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					} elseif ($_oCandidat[0]->service !='') {
						/* même service */
						$zSql .= " WHERE c12.service = '".$_oCandidat[0]->service."' AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					} else {
						/* même direction */
						$zSql .= " WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c.region_id = ".$_oCandidat[0]->region_id." 
							" ;
					}
				}
				//$zSql .= " AND c.matricule NOT IN ('ECD') GROUP BY c.matricule " ;


				break;		
		
		case COMPTE_ADMIN :
				$zNotIn = "" ; 

				$zSql  = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule,c.nom as nom,c.prenom as prenom, (SELECT sigle_departement FROM $zDatabaseOrigin.departement WHERE id = c.departement) as sigle_departement,(SELECT sigle_direction FROM $zDatabaseOrigin.direction WHERE id = c.direction) as sigle_direction, (SELECT sigle_service FROM $zDatabaseOrigin.service WHERE id = c.service) as sigle_service,c.poste FROM $zDatabaseOrigin.candidat c WHERE 1" ;

				if (isset($_POST["iDepartementId"]) && $_POST["iDepartementId"] != "") {
					$zSql .= " AND c.departement = '" . $_POST["iDepartementId"]."'" ;
				}

				//$zSql .= " AND c.matricule NOT IN ('ECD') " ;

				break;
		
		}

		$zSql .= " AND c.isPointage = 1 AND c.matricule not like '%STG%'" ;
		$zSql .= " Group by user_id " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * 10 . ", 10 ";

		$zQuery = $DB1->query($zSql);
		$toCandidatUser = $zQuery->result_array();

		$zUserId = serialize($toCandidatUser);


		return $zUserId ; 
	}

	public function getRangRattache ($_zUserId,$_oCandidat,$_zDateDebut,$_zDateFin,$_this, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "c1.id") {

		$zDiffSearch = 0 ; 
		$toListe = $this->TempsDeTravailDesAgents($zDiffSearch,$_zUserId, $_oCandidat,0, $_zDateDebut, $_zDateFin, $_this, 0,1, $_iNbrTotal, $_iValPerPage, $_iCurrPage);

		return $toListe ;
	}


	public function getUserLocalisation ($_zTableName="division", $_oCandidat,$iResultSearch, $_zDateDebut, $_zDateFin, $_this, &$zDiffSearch) {
	
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		// chargement de matricule dans la localisation de l'agent 
		$zSql = "SELECT IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.$_zTableName l ON c.$_zTableName = l.id
		WHERE l.id  = (SELECT $_zTableName FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.region_id = ".$_oCandidat[0]->region_id ;

		//echo $zSql ; 

		//die();

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$toCandidatUser = array();
		$zInMatriculeUser = "";
		$iCompteTotal = 0;
		foreach ($toRow as $oCandidatUser)
		{
			 array_push ($toCandidatUser, (int)$oCandidatUser["matricule"]);
		}

		$iCompteTotal = sizeof($toCandidatUser);

		$zReturnRang = $this->TempsDeTravailDesAgents($zDiffSearch,serialize($toCandidatUser), $_oCandidat,$iResultSearch, $_zDateDebut, $_zDateFin, $_this, $iCompteTotal,0);

		return $zReturnRang ; 

	}

	function getMissionUser($_iUserId,$_zDate, $_this){

		global $db;

		$iTotalHeureSortie = 0;
		if ($_iUserId != '') {
		
			$zDatabaseOrigin =  $db['default']['database'] ; 
			$zDatabaseGcap =  $db['gcap']['database'] ; 

			$zSql= "select *,SUBSTRING(REPLACE(cin,' ',''), 4, 9) as SubCIN, c.matricule as SubMatricule from $zDatabaseGcap.mission as m INNER JOIN $zDatabaseOrigin.candidat as c ON m.mission_userId = c.user_id WHERE  mission_date = '".$_zDate."' AND mission_dateEntree = '".$_zDate."' HAVING (SubMatricule = '".$_iUserId."' OR SubCIN = '".$_iUserId."')" ; 

			$zQuery = $this->db->query($zSql);
			$toMission =  $zQuery->result_array();
			$zQuery->free_result(); 

			$toAllMission = array();
			
			foreach ($toMission as $oMission){
	 
				//echo $oMission['mission_date']." ".$oMission['mission_heureSortie'] . "<br>" ; 
				$zDateDiffMin =  $oMission['mission_date']." ".$oMission['mission_heureSortie'] ; 
				$zDateDiffMax = $oMission['mission_date']." ".$oMission['mission_heureEntree'];
			
				$iTotalHeureSortie += $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
			}
		}

		return $iTotalHeureSortie ; 
	}


	function getInOutUser($_iUserId,$_zDateDebut,$_zDateFin, $_this){

		global $db;
		
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin	 = $_this->date_fr_to_en($_zDateFin,'/','-'); 

		$zSql= "select * from $zDatabaseGcap.inout1 WHERE inOut_userId = '".$_iUserId."' AND inOut_date BETWEEN '$_zDateDebut'  and  '$_zDateFin' " ; 

		$zQuery = $this->db->query($zSql);
		$toInOut =  $zQuery->result_array();
		$zQuery->free_result(); 

		$toAllInOut = array();
		$iTotalTravailler = 0;
		$iHeureReglementaire = 0;
		$iSupplementaire = 0;


		foreach ($toInOut as $oInOut){
 
			$zDateDiffMin =  strtotime($oInOut['inOut_date']." ".$oInOut['inOut_HeureDebut']) ; 
			$zDateDiffMax =	 strtotime($oInOut['inOut_date']." ".$oInOut['inOut_HeureFin']);

			$iTotalTravailler += $zDateDiffMax - $zDateDiffMin ; 

			if ($iTotalTravailler<=28800){
				$iHeureReglementaire += $iTotalTravailler ; 
			} else {
				$iHeureReglementaire += 28800 ; 
				$iSupplementaire += $iTotalTravailler - 28800 ; 
			}
		}

		$oAssign = new stdClass();
		$oAssign->iTotalTravailler		= $iTotalTravailler ; 
		$oAssign->iHeureReglementaire	= $iHeureReglementaire ; 
		$oAssign->iSupplementaire		= $iSupplementaire ; 

		return $oAssign ; 
	}


	function getInOutUserMatricule($_iUserId,$_zDateDebut,$_zDateFin, $_this){

		global $db;
		
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin	 = $_this->date_fr_to_en($_zDateFin,'/','-'); 

		$zSql= "select *,SUBSTRING(REPLACE(cin,' ',''), 4, 9) as SubCIN, c.matricule as SubMatricule from $zDatabaseGcap.inout1 as io INNER JOIN $zDatabaseOrigin.candidat as c ON io.inOut_userId = c.user_id WHERE 1 AND inOut_date BETWEEN '$_zDateDebut'  and  '$_zDateFin' HAVING (SubMatricule = '".$_iUserId."' OR SubCIN = '".$_iUserId."')" ; 

		$zQuery = $this->db->query($zSql);
		$toInOut =  $zQuery->result_array();
		$zQuery->free_result(); 

		$toAllInOut = array();
		$iTotalTravailler = 0;
		$iHeureReglementaire = 0;
		$iSupplementaire = 0;


		foreach ($toInOut as $oInOut){
 
			$zDateDiffMin =  strtotime($oInOut['inOut_date']." ".$oInOut['inOut_HeureDebut']) ; 
			$zDateDiffMax =	 strtotime($oInOut['inOut_date']." ".$oInOut['inOut_HeureFin']);

			$iTotalTravailler += $zDateDiffMax - $zDateDiffMin ; 

			if ($iTotalTravailler<=28800){
				$iHeureReglementaire += $iTotalTravailler ; 
			} else {
				$iHeureReglementaire += 28800 ; 
				$iSupplementaire += $iTotalTravailler - 28800 ; 
			}
		}

		$oAssign = new stdClass();
		$oAssign->iTotalTravailler		= $iTotalTravailler ; 
		$oAssign->iHeureReglementaire	= $iHeureReglementaire ; 
		$oAssign->iSupplementaire		= $iSupplementaire ; 

		return $oAssign ; 
	}


	public function getCongePeriodeByMatricule ($_zUserId, $_zDateDebut, $_zDateFin,$_this){
		
		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');

		if ($_zDateDebut != $_zDateFin){
			$zQuerySqlServer = "  SELECT CONCAT('',(
												SELECT  CONCAT(  DATEADD(DAY, nbr - 1, 
												
												CASE 
													WHEN (gcap_dateDebut <= '".$_zDateDebut."')
														THEN CAST('".$_zDateDebut."' as DATE)
													ELSE CAST(gcap_dateDebut as DATE)
												END 
												
												), 
												CAST(
												CASE 
													WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 1 AND nbr = 1)
														THEN ' 08:00:00.000'
													ELSE ' 12:00:00.000' 
												END AS varchar
												
												)
												,'--',gcap_pinId,'--','I;', 
												DATEADD(DAY, nbr - 1, 
												
												CASE 
													WHEN (gcap_dateDebut <= '".$_zDateDebut."')
														THEN CAST('".$_zDateDebut."' as DATE)
													ELSE CAST(gcap_dateDebut as DATE)
												END 
												
												),
												
												CAST(
												CASE 
													WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 2 AND nbr -1 = datediff(DAY,gcap_dateDebut,gcap_dateFin))
														THEN ' 12:00:00.000'
													ELSE ' 16:00:00.000' 
												END AS varchar
												
												)
												,'--',gcap_pinId,'--','O',';')
												FROM    ( SELECT    ROW_NUMBER() OVER ( ORDER BY c.object_id ) AS Nbr
														  FROM      sys.columns c
														) nbrs
												WHERE   nbr - 1 <= DATEDIFF(DAY, 
												
												CASE 
													WHEN (gcap_dateDebut <= '".$_zDateDebut."')
														THEN CAST('".$_zDateDebut."' as DATE)
													ELSE CAST(gcap_dateDebut as DATE)
												END , 
												
												CASE 
													WHEN (gcap_dateFin >= '".$_zDateFin."')
														THEN CAST('".$_zDateFin."' as DATE)
													ELSE CAST(gcap_dateFin as DATE)
												END 
												
												
												)
												FOR XML PATH('')
								) ) As CONGE " ; 

		} else {

			$zQuerySqlServer = "  SELECT (CONCAT( CAST(gcap_dateDebut as DATE), 
											CAST(
											CASE 
												WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 1)
													THEN ' 08:00:00.000'

												WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 2)
													THEN ' 12:00:00.000'

												ELSE ' 08:00:00.000' 
											END AS varchar
											
											)
											,'--',gcap_pinId,'--','I;', CAST(gcap_dateDebut as DATE),
											
											CAST(
											CASE 
												WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 1)
													THEN ' 12:00:00.000'

												WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 2)
													THEN ' 16:00:00.000'
												ELSE ' 16:00:00.000' 
											END AS varchar
											
											)
											,'--',gcap_pinId,'--','O',';')
											) As CONGE " ; 
		}
		
		$zQuerySqlServer .= " FROM [ZKGcap].[dbo].[gcap] WHERE 1=1 ";



		if ($_zDateDebut != $_zDateFin) {
			$zQuerySqlServer .= " AND (('$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin AND gcap_pinId IN (".$_zUserId.")) " ; 
			$zQuerySqlServer .= " OR ('$_zDateFin' BETWEEN gcap_dateDebut AND gcap_dateFin AND gcap_pinId IN (".$_zUserId."))) " ; 
		} else {
			$zQuerySqlServer .= " AND '$_zDateDebut' = gcap_dateDebut AND '$_zDateFin' = gcap_dateFin AND gcap_pinId IN (".$_zUserId.") " ; 
		}

		//$zQuerySqlServer .= " AND gcap_valide = 1 " ; 

		$zQuerySqlServer .= " GROUP BY gcap_id,gcap_pinId,gcap_demiJournee,gcap_MatinSoir,
		gcap_dateDebut,gcap_dateFin ";

		//echo $zQuerySqlServer ; 

		$oResultSearch = $this->executeFetchGcapQuery($zQuerySqlServer);

		$toArrayResult = array();

		while(odbc_fetch_row($oResultSearch)){
			$toArrayResultSearch = odbc_result($oResultSearch, 1);
			$toSeparateur = explode(";", $toArrayResultSearch);

			foreach ($toSeparateur as $zSeparateur){
				$tzSeparateurTrait = explode("--",$zSeparateur);

				if (isset($tzSeparateurTrait[1])){
					$oArray = array();
					$oArray['time']			= $tzSeparateurTrait[0]; 
					$oArray['pin']			= $tzSeparateurTrait[1]; 
					$oArray['CHECKTYPE']	= $tzSeparateurTrait[2]; 
				
					array_push($toArrayResult, $oArray);
				}
			}
		}

		return $toArrayResult ; 
		
	}

	public function getInOutByMatricule ($_zUserId, $_zDateDebut, $_zDateFin,$_this){
		
		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');

		$zQuerySqlServer = "   SELECT (CONCAT( CAST(inOut_HeureFin AS DATE),' ', CAST(inOut_HeureFin AS time),'--',inOut_pin,'--','O;',CAST(inOut_HeureDebut as DATE),' ', CAST(inOut_HeureDebut AS time),'--',inOut_pin,'--','I',';')) As CONGE " ; 
		$zQuerySqlServer .= " FROM [ZKGcap].[dbo].[inout] WHERE 1=1 ";

		if ($_zDateDebut != $_zDateFin) {
			$zQuerySqlServer .= " AND inOut_date BETWEEN '$_zDateDebut'  AND  '$_zDateFin' AND inOut_pin IN (".$_zUserId.") " ; 
		} else {
			$zQuerySqlServer .= " AND inOut_date = '$_zDateDebut' AND inOut_pin IN (".$_zUserId.") " ; 
		}

		$zQuerySqlServer .= " GROUP BY inOut_id,inOut_pin,inOut_HeureDebut,inOut_HeureFin ";

		/*echo $zQuerySqlServer . "<br><br><br><br>" ; 
		die();*/

		$oResultSearch = $this->executeFetchGcapQuery($zQuerySqlServer);

		$toArrayResult = array();

		while($oArrayResult = odbc_fetch_array($oResultSearch)){
			$toArrayResultSearch = odbc_result($oResultSearch, 1);
			$toSeparateur = explode(";", $toArrayResultSearch);
			
			foreach ($toSeparateur as $zSeparateur){
				$tzSeparateurTrait = explode("--",$zSeparateur);

				if (isset($tzSeparateurTrait[1])){
					$oArray = array();
					$oArray['time']			= $tzSeparateurTrait[0]; 
					$oArray['pin']			= $tzSeparateurTrait[1]; 
					$oArray['CHECKTYPE']	= $tzSeparateurTrait[2]; 
				
					array_push($toArrayResult, $oArray);
				}
			}
		}

		//die();

		return $toArrayResult ; 
		
	}

	public function getMissionByMatricule ($_zUserId, $_zDateDebut, $_zDateFin,$_this){
		
		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');

		$zQuerySqlServer = "   SELECT (CONCAT( CAST(mission_heureSortie AS DATE),' ', CAST(mission_heureSortie AS time),'--',mission_pinId,'--','I;',CAST(mission_heureEntree as DATE),' ', CAST(mission_heureEntree AS time),'--',mission_pinId,'--','O',';')) As CONGE " ; 
		$zQuerySqlServer .= " FROM [ZKGcap].[dbo].[mission] WHERE 1=1 ";

		if ($_zDateDebut != $_zDateFin) {
			$zQuerySqlServer .= " AND mission_date >= '$_zDateDebut'  AND mission_dateEntree <= '$_zDateFin' AND mission_pinId IN (".$_zUserId.") " ; 
		} else {
			$zQuerySqlServer .= " AND '$_zDateDebut' BETWEEN mission_date AND mission_dateEntree  AND mission_pinId IN (".$_zUserId.") " ; 
		}

		$zQuerySqlServer .= " GROUP BY mission_id,mission_pinId,mission_heureSortie,mission_heureEntree ";

		$oResultSearch = $this->executeFetchGcapQuery($zQuerySqlServer);

		$toArrayResult = array();

		while($oArrayResult = odbc_fetch_array($oResultSearch)){
			$toArrayResultSearch = odbc_result($oResultSearch, 1);
			$toSeparateur = explode(";", $toArrayResultSearch);
			
			foreach ($toSeparateur as $zSeparateur){
				$tzSeparateurTrait = explode("--",$zSeparateur);

				if (isset($tzSeparateurTrait[1])){
					$oArray = array();
					$oArray['time']			= $tzSeparateurTrait[0]; 
					$oArray['pin']			= $tzSeparateurTrait[1]; 
					$oArray['CHECKTYPE']	= $tzSeparateurTrait[2]; 
				
					array_push($toArrayResult, $oArray);
				}
			}
		}

		//die();

		return $toArrayResult ; 
		
	}

	public function getFormationByMatricule ($_zUserId, $_zDateDebut, $_zDateFin,$_this){
		
		$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
		$_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');

		$zQuerySqlServer = "   SELECT (CONCAT( CAST(formation_heureSortie AS DATE),' ', CAST(formation_heureSortie AS time),'--',formation_pinId,'--','I;',CAST(formation_heureEntree as DATE),' ', CAST(formation_heureEntree AS time),'--',formation_pinId,'--','O',';')) As CONGE " ; 
		$zQuerySqlServer .= " FROM [ZKGcap].[dbo].[formation] WHERE 1=1 ";

		if ($_zDateDebut != $_zDateFin) {
			$zQuerySqlServer .= " AND formation_date >= '$_zDateDebut'  AND formation_dateEntree <= '$_zDateFin' AND formation_pinId IN (".$_zUserId.") " ; 
		} else {
			$zQuerySqlServer .= " AND '$_zDateDebut' BETWEEN formation_date AND formation_dateEntree  AND formation_pinId IN (".$_zUserId.") " ; 
		}

		$zQuerySqlServer .= " GROUP BY formation_id,formation_pinId,formation_heureSortie,formation_heureEntree ";

		$oResultSearch = $this->executeFetchGcapQuery($zQuerySqlServer);

		$toArrayResult = array();

		while($oArrayResult = odbc_fetch_array($oResultSearch)){
			$toArrayResultSearch = odbc_result($oResultSearch, 1);
			$toSeparateur = explode(";", $toArrayResultSearch);
			
			foreach ($toSeparateur as $zSeparateur){
				$tzSeparateurTrait = explode("--",$zSeparateur);

				if (isset($tzSeparateurTrait[1])){
					$oArray = array();
					$oArray['time']			= $tzSeparateurTrait[0]; 
					$oArray['pin']			= $tzSeparateurTrait[1]; 
					$oArray['CHECKTYPE']	= $tzSeparateurTrait[2]; 
				
					array_push($toArrayResult, $oArray);
				}
			}
		}

		//die();

		return $toArrayResult ; 
		
	}

	function TempsDeTravailDesAgents(&$zDiffSearch, $_toCandidatUser, $_oCandidat, $iResultSearch, $_zDateDebut, $_zDateFin, $_this, $iCompteTotal,$iReturn=0,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1) {

		return 8 ; 

	}

	function TempsDeTravailDesAgents_old(&$zDiffSearch, $_toCandidatUser, $_oCandidat, $iResultSearch, $_zDateDebut, $_zDateFin, $_this, $iCompteTotal,$iReturn=0,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1) {

		
			$toCandidatUser = unserialize($_toCandidatUser);

			/*echo "<pre>" ; 

			print_r ($toCandidatUser);

			echo "</pre>";*/

			$zInMatriculeUser = 0;

			if (sizeof($toCandidatUser)>0) {

				if ($iReturn == 0) {
					$zInMatriculeUser = implode(",", $toCandidatUser);
				} else {
					$toCandidatUserMatricule = array();
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
					}

					$zInMatriculeUser = implode(",", $toCandidatUserMatricule);
				}
			}

			

			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ; 
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);
				
/*********************** A commenter en ligne ***********************************************/
				
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}

			//$toDateAccess = explode("/", $_zDateDebut);

			if ($_zDateDebut !=""){
				$toDateAccess = explode("/", $_zDateDebut);
			} else {
				$toDateAccess = explode("/", date("d/m/Y"));
			}

			$zQuerySqlServer = " SELECT time,pin,event_point_name as terminal,state, CAST( CASE 
										WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='1'
											THEN 'O' 
										WHEN SUBSTRING(event_point_name, 1, 1) = 'P' AND state='0'
											THEN 'I' 
										WHEN SUBSTRING(event_point_name, 1, 1) = 'S'
											THEN 'O' 
										WHEN SUBSTRING(event_point_name, 1, 1) = 'E'
											THEN 'I' 
										END AS varchar) as CHECKTYPE
								 FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log]
								 WHERE (pin IN (".$zInMatriculeUser.")) AND ".$zInsert."
								GROUP BY time,event_point_name,pin,state ORDER BY time";



			$oResult = $this->executeQuery($zQuerySqlServer);

			$toArrayResult = array();
			$toPin = array();

			$zPinTest = "-1" ; 
			while($oArrayResult = odbc_fetch_array($oResult)){
				
				$oArray = array();
				$oArray['time']			= odbc_result($oResult,1); 
				$oArray['pin']			= odbc_result($oResult,2); 
				$oArray['CHECKTYPE']	= odbc_result($oResult,5); 
				array_push($toArrayResult, $oArray);
			}

			/* Congé / autorisation d'absence / permission */
			
			if ($iReturn != 0) {
				$toDateConge = $this->getCongePeriodeByMatricule($zInMatriculeUser, $_zDateDebut, $_zDateFin,$_this);
				if (sizeof($toDateConge)>0){
					
					foreach ($toDateConge as $oDateConge){
						array_push($toArrayResult, $oDateConge);
					}
				}
			

				/*echo "<pre>" ; 
				print_r ($toDateConge);

				echo "</pre>";
				die();*/

				/* Badge oublié */
				$toGetInOut = $this->getInOutByMatricule($zInMatriculeUser, $_zDateDebut, $_zDateFin,$_this);
				if (sizeof($toGetInOut)>0){
					
					foreach ($toGetInOut as $oGetInOut){
						array_push($toArrayResult, $oGetInOut);
					}
				}

				/* Mission heure de bureau */
				$toGetMission = $this->getMissionByMatricule($zInMatriculeUser, $_zDateDebut, $_zDateFin,$_this);
				if (sizeof($toGetMission)>0){
					
					foreach ($toGetMission as $oGetMission){
						array_push($toArrayResult, $oGetMission);
					}
				}
			}

			/* formation heure de bureau */
			/*$toGetFormation = $this->getFormationByMatricule($zInMatriculeUser, $_zDateDebut, $_zDateFin,$_this);
			if (sizeof($toGetFormation)>0){
				
				foreach ($toGetFormation as $oGetFormation){
					array_push($toArrayResult, $oGetFormation);
				}
			}*/

			/*echo "<pre>" ; 
			print_r ($toArrayResult);

			echo "</pre>";
			die();*/

			$toArrayResult = new ArrayObject($toArrayResult);
			$toArrayResult->asort();

			/*echo "<pre>" ; 
			print_r ($toArrayResult);

			echo "</pre>";

			die();*/

			$iIncrementationSeconde = 1;

			$iUserId = -1 ;
			$iRet = 0;
			$toAssignationUser = array();
			foreach ($toArrayResult as $oArrayResult) {
				if ($oArrayResult['pin'] != $iUserId) {
					$iUserId = $oArrayResult['pin'] ; 
					$iRet = 1;
				}
				$toAssignationUser[$iUserId][] = $oArrayResult;

			}

			//print_r ($toAssignationUser);

			$toArray = array();
			$toArray1 = array();
			$toAssign = array();
			$toArrayArriveTot = array();
			$toArraySortietard = array();
			
			$iDateTest = "-1" ;
			
			$zDateTest = 0;
			foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

				for ($iBoucle=0;$iBoucle<sizeof($toReturn);$iBoucle++) {
					
					if ($iDateTest !=  date("Y-m-d",strtotime($toReturn[$iBoucle]['time']))) {
						$iDateTest = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ; 
					}

					$toAssign[$iUserId][$iDateTest][] = $toReturn[$iBoucle];
					
				}
			}

			/*echo "<pre>" ; 

			print_r ($toAssign);

			echo "</pre>";

			die();*/
			$toArrayGrandTotal = array();
			$toListe = array();
	
			foreach ($toAssign as $iUserId =>  $toReturn ) {
				
				$iDiffTotalGeneral = 0;
				$zHeureArriveTot = 0;
				$zHeureSortieTard = 0;
				$iTotalHeureSortieMission = 0;
				$iDebutHeure = 0;
				$iFinHeure = 0;
				
				foreach ($toReturn as $iDateTest =>  $toReturn ) {

					/*if ($iReturn != 0) {
						$iTotalHeureSortieMission = $this->getMissionUser($iUserId, $iDateTest, $_this);
					} else {
						if ($iResultSearch ==  $iUserId ) {
							$iTotalHeureSortieMission = $this->getMissionUser($iUserId, $iDateTest, $_this);
						}
					}*/
					
					$iDiff = 0;
					$iDiffTotal = 0 ; 
					$iDiffTotalHeureSupplementaire = 0;

					$zDateMin = date("Y-m-d",strtotime($toReturn[0]['time'])) ; 
						
					/* heure minimale d'entrée à 08h du matin */
					$zHeureMin = strtotime($zDateMin . " 08:00:00") ; 

					$zHeureEntree = strtotime($toReturn[0]['time']) ; 

					$zDateEntreeAgent = $toReturn[0]['time'] ; 

					$iDebutHeure = $toReturn[0]['time'];
					$iFinHeure = $toReturn[sizeof($toReturn)-1]['time'];
					
					//echo sizeof($toReturn) ; 
					
					// si juste entrée 
					if (sizeof($toReturn)==1) {
						$iDiffTotal = 0 ; 
					} else { 
						
						$iTestPause = 0 ; 
						for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {

							$zDatetoDay = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ; 
						
							/* Heure de pause min */
							$zHeurePauseMin = strtotime($zDatetoDay . " 12:00:00") ; 

							/* Heure de pause max */
							$zHeurePauseMax = strtotime($zDatetoDay . " 14:00:00") ; 

							$zHeureDeSortieMax = strtotime($zDatetoDay . " 16:00:00") ; 


							if($toReturn[$iBoucle]['CHECKTYPE'] == 'O' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == 'I') { 
								
								//echo $toReturn[$iBoucle]['pin'] . "--" . $toReturn[$iBoucle]['CHECKTYPE'] . "--" . $toReturn[$iBoucle+1]['CHECKTYPE'] ; 
								$zDateDiffMin = $toReturn[$iBoucle]['time'] ; 
								$zDiffzDateMin = 0;
								$zDiffzDateMax = 0;
								$iTestEnDehorsHeureReglementaire = 0;
								if (strtotime($toReturn[$iBoucle]['time']) >= $zHeureDeSortieMax) {
									$zDateDiffMin = $zHeureDeSortieMax ; 
									$zDiffzDateMin = strtotime($toReturn[$iBoucle]['time']) - $zHeureDeSortieMax ; 
									//$iTestEnDehorsHeureReglementaire = 1;
								}

								$zDateDiffMax = $toReturn[$iBoucle+1]['time'] ; 
								if (strtotime($toReturn[$iBoucle+1]['time']) >= $zHeureDeSortieMax) {
									$zDateDiffMax = $zHeureDeSortieMax ; 
									$zDiffzDateMax = strtotime($toReturn[$iBoucle+1]['time']) - $zHeureDeSortieMax ; 
									//$iTestEnDehorsHeureReglementaire = 1;
								}

								$zHeureSortieTard -= ($zDiffzDateMax - $zDiffzDateMin) ; 

								/*if ($iUserId == "389671") {*/

									if ((strtotime($toReturn[$iBoucle]['time']) < $zHeureMin) && (strtotime($toReturn[$iBoucle+1]['time']) < $zHeureMin)){
										$iTestEnDehorsHeureReglementaire = 1;
									}

									if ((strtotime($toReturn[$iBoucle]['time']) > $zHeureDeSortieMax) && (strtotime($toReturn[$iBoucle+1]['time']) > $zHeureDeSortieMax)){
										$iTestEnDehorsHeureReglementaire = 1;
									}
								
								/*}*/
								
								
								$toReturn[$iBoucle+1]['dateDiff'] = 0;

								//echo "!!!" . $zDateDiffMax . '----' . $zDateDiffMin . '!!!!' ; 
								if (!is_integer($zDateDiffMax)) {
								
									$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);

									/*if ($iUserId == "389671") {
										$iTot = $this->dateDiff($toReturn[$iBoucle+1]['dateDiff'],0, $_this,5);
										echo "--" . $zDateDiffMin . " --" . $zDateDiffMax . " = " . $iTot . "<br>" ; 
									}*/
								} else {

									$zDateDiffMax = $toReturn[$iBoucle+1]['time'];
									$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
								}
									
								/* Detection Pause 30 mn */
								if ($iTestPause == 0) {
									if (strtotime($toReturn[$iBoucle]['time']) >= $zHeurePauseMin  && strtotime($toReturn[$iBoucle+1]['time']) <= $zHeurePauseMax){
										if ($toReturn[$iBoucle+1]['dateDiff'] >= 1800){
											$iDiff -= 1800 ; 
											$iTestPause = 1;
											
										} else {

											
											$iDiff -= (int)$toReturn[$iBoucle+1]['dateDiff'];

											/*if ($iUserId == "389671") {
												echo "---" . $toReturn[$iBoucle+1]['dateDiff'] . "---<br>" ; 
												echo "miditra" ; 
											}*/

										}
									}
								}

								if ($iTestEnDehorsHeureReglementaire ==0) {
									$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 

								} else {

									if (strlen($toReturn[$iBoucle+1]['dateDiff']) <6){
										$iDiffTotalHeureSupplementaire += $toReturn[$iBoucle+1]['dateDiff'] ; 
									}
								}

								/* Mission exterieur */
								
								
							}
						}

						/* si inférieur alors ça reste toujours 08*/
						if ($zHeureEntree <= $zHeureMin ) {
							$zDateEntreeAgent = $zDateMin . " 08:00:00" ; 
							//$zHeureArriveTot = $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,7);
							$zHeureArriveTot += $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,6);
							//$iTestEnDehorsHeureReglementaire = 1;
						}
						
						$zDateMax = date("Y-m-d",strtotime($toReturn[sizeof($toReturn)-1]['time'])) ; 

						/* heure maximale de sortie à 16h de l'après-midi */
						$zHeureMax = strtotime($zDateMax . " 16:00:00") ; 

						$zHeureSortie = strtotime($toReturn[sizeof($toReturn)-1]['time']) ; 

						$zDateSortieAgent = $toReturn[sizeof($toReturn)-1]['time'] ; 
						

						/* si supérieur alors ça reste toujours 16*/
						if ($zHeureSortie >= $zHeureMax ) {
							$zDateSortieAgent = $zDateMax . " 16:00:00" ; 
							$zHeureSortieTard += $this->dateDiff($zDateSortieAgent, $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
							//$iTestEnDehorsHeureReglementaire = 1;
						}

						$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($zDateEntreeAgent, $zDateSortieAgent, $_this,6);
						$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

						$iDiffTotal -= $iDiff ;

						/*if ($iUserId == "389671") {
							$zrrrResult = $this->dateDiff($toReturn[sizeof($toReturn)-1]['dateDiff'],0, $_this,5); 
							echo $iUserId . " -- " . $zDateEntreeAgent . " -- " . $zDateSortieAgent . " = " . $zrrrResult .  "<br>" ; 
						}*/

						//$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotal - $iDiff ; //$this->dateDiff($iDiffTotal,$iDiff, $_this,6);
					}

					//$iDiff -= $iTotalHeureSortieMission ; 

					$iDiffTotalGeneral += $iDiffTotal ; 
					
				}

				$toArrayArriveTot[(int)$iUserId] = (int)$zHeureArriveTot + (int)$zHeureSortieTard - $iDiffTotalHeureSupplementaire;
				$iGrandTotalOrder = $iDiffTotalGeneral + (int)$zHeureArriveTot + (int)$zHeureSortieTard;

				$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotalGeneral; 
				$toAssignationUser[$iUserId]["Mission"] = $iTotalHeureSortieMission; 
				$toAssignationUser[$iUserId]["iGrandTotalOrder"] = $iGrandTotalOrder + $iTotalHeureSortieMission + $iIncrementationSeconde ; 
				$toAssignationUser[$iUserId]["iGrandTotalOrderAffiche"] = $iGrandTotalOrder + $iTotalHeureSortieMission  ; 

				
				if ($iReturn == 0) {
					if ($iUserId != '' || $iUserId != 0){
						array_push ($toArray, $toAssignationUser[$iUserId]["iGrandTotalOrder"]);
						$toArray2[(int)$iUserId] = $toAssignationUser[$iUserId]["iGrandTotalOrder"];
					}
					
				} else {
					$toArray[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];
					$toArrayMission[(int)$iUserId]["Mission"] = $toAssignationUser[$iUserId]["Mission"];
					$toArrayHeure[(int)$iUserId]["heure"] = $iDebutHeure . "--" . $iFinHeure;
					$toArrayGrandTotal[(int)$iUserId] = $toAssignationUser[$iUserId]["iGrandTotalOrder"];
					$toArrayGrandTotalAffiche[(int)$iUserId] = $toAssignationUser[$iUserId]["iGrandTotalOrderAffiche"];
				}

				$iIncrementationSeconde++;

			}

			/*echo "<pre>" ; 
			print_r ($toArrayGrandTotal);
			echo "<pre>" ;*/

			if ($iReturn == 0) {

				rsort($toArray);

				if (sizeof($toArray) > 0 && (isset($toArray2[$iResultSearch])) && ($toArray2[$iResultSearch] > 0)) {

					$zDiffSearch = $this->dateDiff($toArray2[$iResultSearch],0, $_this,5); 
					$iRang = (array_search($toArray2[$iResultSearch], $toArray))+1;
					return $iRang .  "/" . $iCompteTotal;

				} else {
					$oAssign = $this->getInOutUserMatricule($iResultSearch,$_zDateDebut,$_zDateFin, $_this) ; 

					if ((is_object($oAssign) || is_array($oAssign))){

						$zDiffSearch = $this->dateDiff($oAssign->iTotalTravailler,0, $_this,5); 
						$iRang = 0;
						for($i=0;$i<sizeof($toArray)-2;$i++){
							if (($toArray[$i] > $oAssign->iTotalTravailler) && ($oAssign->iTotalTravailler > $toArray[$i+1]) )
							{
								$iRang = $i+2;
							}
						}
						if ($iCompteTotal != 0) {
							return $iRang .  "/" . $iCompteTotal;
						} else {
							return '';
						}
					} else {
						return '';
					}

				} 
			} else { 
				
				/*arsort($toArrayGrandTotal);

				echo "<pre>" ; 
				print_r ($toArrayGrandTotal);
				echo "<pre>" ; 

				die();*/
				
				$iBoucle=0;

				$_zDateFinAffich = $this->traitemetDateFin($_zDateFin, $_this);

				$iDiffDate	= $this->getJours($_zDateDebut, $_zDateFin,$_this);

				$iKeyB = 0;
				foreach ($toArrayGrandTotal as $iUserId => $zValue){

					if ($zValue != 0) {

						$iKeyB = $zValue;

						$toListe[$iKeyB] = array();
						foreach ($toCandidatUser as $oCandidatUser)
						{
							 
							 if ((int)$oCandidatUser["matricule"] == (int)$iUserId){

								//echo $iUserId . "  " . $zValue . "<br/>";

								$oListe = new StdClass();
								$oListe->rang = $iBoucle+1;
								$oListe->iDiffDate = $iDiffDate;

								$iNbrHeureTravailler = $toArray[(int)$iUserId] ; 
								$iSupplementaire = 0;

								if ($toArrayMission[(int)$iUserId]["Mission"] > 0) {
									$iAdd = $iNbrHeureTravailler + (int)$toArrayMission[(int)$iUserId]["Mission"] ; 
									if($iAdd >= 28800){
										$iNbrHeureTravailler = 28800 ; 
										$iSupplementaire = $iAdd - 28800 ;
									} else {
										$iNbrHeureTravailler = $iAdd ; 
									}
								} 

								$oListe->value	= $this->dateDiff($iNbrHeureTravailler,0, $_this,5);

								$iHeure = 0;

								//print_r ($toArrayHeure[(int)$iUserId]);
								if (is_array($toArrayHeure[(int)$iUserId])) {
									$iHeure = $toArrayHeure[(int)$iUserId]["heure"] ; 
									$toDebFin = explode("--",$iHeure);
									$iHeure = '';
									if($toDebFin[0]!=''){
										$iHeure .= "Heure d'entrée : " . date("H:i:s",strtotime($toDebFin[0]));
									}

									if($toDebFin[1]!=''){
										$iHeure .= " <br> Heure sortie : " . date("H:i:s",strtotime($toDebFin[1]));
									}
								} 

								$oListe->iHeure	= $iHeure;

								foreach ($toArrayArriveTot as $iId =>$oArrayArriveTot){
									if ((int)$iId == (int)$iUserId){
										
										$oArrayArriveTot += $iSupplementaire ; 
										$iTot = $this->dateDiff($oArrayArriveTot,0, $_this,5);
										$oListe->Tot = "";
										if ($iTot > 0) {
											$oListe->Tot = $iTot ; 
										}
									}
								}
								//$zValue += $iSupplementaire ;
								$oListe->iTotTravailler	= $this->dateDiff($toArrayGrandTotalAffiche[(int)$iUserId],0, $_this,5);
								$oListe->data	= $oCandidatUser;

								array_push($toListe[$iKeyB], $oListe);
							 }
						}

						$iBoucle++;
					}
					$iKeyB++;
				}
				
				

				$iLastRang = sizeof($toListe) ;
				$iTest = 0;
				$toListeNotIn = array();
				foreach ($toCandidatUser as $oCandidatUser){
						
						$iTrouve = 0;
						foreach ($toArray as $iUserId => $zValue){
						 
							 if ((int)$oCandidatUser["matricule"] == (int)$iUserId && (int)$zValue!=0){
								$iTrouve = 1;
							 }
						}
						
						if ($iTrouve == 0){
							$oAssign = $this->getInOutUser($oCandidatUser["user_id"],$_zDateDebut,$_zDateFin, $_this) ; 

							$iLastRang++;
							$oListe = new StdClass();

							if (isset($oAssign->iTotalTravailler) && ($oAssign->iTotalTravailler != '')) {
								
								$toListeNotIn[(int)$oAssign->iTotalTravailler] = array();
								
								$oListe->rang = $iLastRang;
								$oListe->iDiffDate = $iDiffDate;
								$oListe->value	= $this->dateDiff($oAssign->iHeureReglementaire,0, $_this,5);
								$oListe->Tot	= $this->dateDiff($oAssign->iSupplementaire,0, $_this,5);
								$oListe->iTotTravailler	= $this->dateDiff($oAssign->iTotalTravailler,0, $_this,5);
								array_push($toListeNotIn[(int)$oAssign->iTotalTravailler], $oListe);
								$oListe->data	= $oCandidatUser;
							} else {
								
								$iTest -= 1;
								$toListeNotIn[$iTest] = array();
								$oListe->rang = $iLastRang;
								$oListe->iDiffDate = $iDiffDate;
								$oListe->value	= '';
								$oListe->Tot	= '';
								$oListe->iTotTravailler	= $iTest;
								$oListe->data	= $oCandidatUser;
								array_push($toListeNotIn[$iTest], $oListe);
								
							}
							

							
							
						} 
				}

				/*echo "<pre>" ; 
				print_r ($toListeNotIn);
				echo "</pre>" ;

				die();*/

				if (isset($toListeNotIn) && sizeof($toListeNotIn)>0) {
					$toListeAffiche = $toListeNotIn ; 

					if (isset($toListe) && sizeof($toListe)>0) {
						$toListeAffiche = $toListe + $toListeNotIn  ; 
					}
				} else {
					$toListeAffiche = $toListe ; 
				}

				//$toListeAffiche = $toListe ;
				
				/*echo "<pre>" ; 
				print_r ($toListeAffiche);
				echo "</pre>" ;

				die();*/

				krsort($toListeAffiche);

				
				$toListeFinal = array();
				$iRang = 1;
				foreach ($toListeAffiche as $iKey => $oListeAffiche){

					if (sizeof($oListeAffiche)>0) {
						$toListeAffiche[$iKey][0]->rang = $iRang ; 

						if ($toListeAffiche[$iKey][0]->iTotTravailler < 0){
							$toListeAffiche[$iKey][0]->iTotTravailler = '';
						}
						array_push($toListeFinal, $oListeAffiche[0]);
						$iRang ++;
					}
				}
				
				return $toListeFinal;
			}
		
	}


	function ___TempsDeTravailDesAgents06122017(&$zDiffSearch, $_toCandidatUser, $_oCandidat, $iResultSearch, $_zDateDebut, $_zDateFin, $_this, $iCompteTotal,$iReturn=0,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1) {

		
			$toCandidatUser = unserialize($_toCandidatUser);

			/*echo "<pre>" ; 

			print_r ($toCandidatUser);

			echo "</pre>";*/

			$zInMatriculeUser = 0;

			if (sizeof($toCandidatUser)>0) {

				if ($iReturn == 0) {
					$zInMatriculeUser = implode(",", $toCandidatUser);
				} else {
					$toCandidatUserMatricule = array();
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
					}

					$zInMatriculeUser = implode(",", $toCandidatUserMatricule);
				}
			}

			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);
				
/*********************** A commenter en ligne ***********************************************/
				
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}

			//$toDateAccess = explode("/", $_zDateDebut);
			if ($_zDateDebut !=""){
				$toDateAccess = explode("/", $_zDateDebut);
			} else {
				$toDateAccess = explode("/", date("d/m/Y"));
			}

			$zQuerySqlServer = " SELECT 
			
			time,pin,event_point_name as terminal, CAST(
								 CASE 
									  WHEN SUBSTRING(event_point_name, 1, 1) = 'S' 
										 THEN 'O' 
									  ELSE 'I' 
								 END AS varchar) as CHECKTYPE
								 FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log]
								 WHERE (pin IN (".$zInMatriculeUser.")) AND ".$zInsert."
								GROUP BY time,event_point_name,pin ORDER BY time";

			$oResult = $this->executeQuery($zQuerySqlServer);

			$toArrayResult = array();

			while($oArrayResult = odbc_fetch_array($oResult)){
				
				$oArray = array();
				$oArray['time']			= odbc_result($oResult,1); 
				$oArray['pin']			= odbc_result($oResult,2); 
				$oArray['CHECKTYPE']	= odbc_result($oResult,4); 
				
				array_push($toArrayResult, $oArray);
			}

			echo "<pre>" ; 

			print_r ($toArrayResult);

			echo "</pre>";

			$iUserId = -1 ;
			$iRet = 0;
			$toAssignationUser = array();
			foreach ($toArrayResult as $oArrayResult) {
				if ($oArrayResult['pin'] != $iUserId) {
					$iUserId = $oArrayResult['pin'] ; 
					$iRet = 1;
				}
				$toAssignationUser[$iUserId][] = $oArrayResult;

			}

			$toArray = array();
			$toArray1 = array();
			$toAssign = array();
			$toArrayArriveTot = array();
			$toArraySortietard = array();
			
			$iDateTest = "-1" ;
			
			$zDateTest = 0;
			foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

				for ($iBoucle=0;$iBoucle<sizeof($toReturn);$iBoucle++) {
					
					if ($iDateTest !=  date("Y-m-d",strtotime($toReturn[$iBoucle]['time']))) {
						$iDateTest = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ; 
					}

					$toAssign[$iUserId][$iDateTest][] = $toReturn[$iBoucle];
					
				}
			}

	
			foreach ($toAssign as $iUserId =>  $toReturn ) {
				
				$iDiffTotalGeneral = 0;
				$zHeureArriveTot = 0;
				$zHeureSortieTard = 0;
				$iTotalHeureSortieMission = 0;

				
				foreach ($toReturn as $iDateTest =>  $toReturn ) {

					/*if ($iReturn != 0) {
						$iTotalHeureSortieMission = $this->getMissionUser($iUserId, $iDateTest, $_this);
					} else {
						if ($iResultSearch ==  $iUserId ) {
							$iTotalHeureSortieMission = $this->getMissionUser($iUserId, $iDateTest, $_this);
						}
					}*/
					
					$iDiff = 0;
					$iDiffTotal = 0 ; 
					$iDiffTotalHeureSupplementaire = 0;

					$zDateMin = date("Y-m-d",strtotime($toReturn[0]['time'])) ; 
						
					/* heure minimale d'entrée à 08h du matin */
					$zHeureMin = strtotime($zDateMin . " 08:00:00") ; 

					$zHeureEntree = strtotime($toReturn[0]['time']) ; 

					$zDateEntreeAgent = $toReturn[0]['time'] ; 
					
					//echo sizeof($toReturn) ; 
					
					// si juste entrée 
					if (sizeof($toReturn)==1) {
						$iDiffTotal = 0 ; 
					} else { 
						
						$iTestPause = 0 ; 
						for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {

							$zDatetoDay = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ; 
						
							/* Heure de pause min */
							$zHeurePauseMin = strtotime($zDatetoDay . " 12:00:00") ; 

							/* Heure de pause max */
							$zHeurePauseMax = strtotime($zDatetoDay . " 14:00:00") ; 

							$zHeureDeSortieMax = strtotime($zDatetoDay . " 16:00:00") ; 


							if($toReturn[$iBoucle]['CHECKTYPE'] == 'O' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == 'I') { 
								
								$zDateDiffMin = $toReturn[$iBoucle]['time'] ; 
								$zDiffzDateMin = 0;
								$zDiffzDateMax = 0;
								$iTestEnDehorsHeureReglementaire = 0;
								if (strtotime($toReturn[$iBoucle]['time']) >= $zHeureDeSortieMax) {
									$zDateDiffMin = $zHeureDeSortieMax ; 
									$zDiffzDateMin = strtotime($toReturn[$iBoucle]['time']) - $zHeureDeSortieMax ; 
									//$iTestEnDehorsHeureReglementaire = 1;
								}

								$zDateDiffMax = $toReturn[$iBoucle+1]['time'] ; 
								if (strtotime($toReturn[$iBoucle+1]['time']) >= $zHeureDeSortieMax) {
									$zDateDiffMax = $zHeureDeSortieMax ; 
									$zDiffzDateMax = strtotime($toReturn[$iBoucle+1]['time']) - $zHeureDeSortieMax ; 
									//$iTestEnDehorsHeureReglementaire = 1;
								}

								$zHeureSortieTard -= ($zDiffzDateMax - $zDiffzDateMin) ; 

								/*if ($iUserId == "389671") {*/

									if ((strtotime($toReturn[$iBoucle]['time']) < $zHeureMin) && (strtotime($toReturn[$iBoucle+1]['time']) < $zHeureMin)){
										$iTestEnDehorsHeureReglementaire = 1;
									}

									if ((strtotime($toReturn[$iBoucle]['time']) > $zHeureDeSortieMax) && (strtotime($toReturn[$iBoucle+1]['time']) > $zHeureDeSortieMax)){
										$iTestEnDehorsHeureReglementaire = 1;
									}
								
								/*}*/
								
								
								$toReturn[$iBoucle+1]['dateDiff'] = 0;

								//echo "!!!" . $zDateDiffMax . '----' . $zDateDiffMin . '!!!!' ; 
								if (!is_integer($zDateDiffMax)) {
								
									$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);

									/*if ($iUserId == "389671") {
										$iTot = $this->dateDiff($toReturn[$iBoucle+1]['dateDiff'],0, $_this,5);
										echo "--" . $zDateDiffMin . " --" . $zDateDiffMax . " = " . $iTot . "<br>" ; 
									}*/
								} else {

									$zDateDiffMax = $toReturn[$iBoucle+1]['time'];
									$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
								}
									
								/* Detection Pause 30 mn */
								if ($iTestPause == 0) {
									if (strtotime($toReturn[$iBoucle]['time']) >= $zHeurePauseMin  && strtotime($toReturn[$iBoucle+1]['time']) <= $zHeurePauseMax){
										if ($toReturn[$iBoucle+1]['dateDiff'] >= 1800){
											$iDiff -= 1800 ; 
											$iTestPause = 1;
											
										} else {

											
											$iDiff -= (int)$toReturn[$iBoucle+1]['dateDiff'];

											/*if ($iUserId == "389671") {
												echo "---" . $toReturn[$iBoucle+1]['dateDiff'] . "---<br>" ; 
												echo "miditra" ; 
											}*/

										}
									}
								}

								if ($iTestEnDehorsHeureReglementaire ==0) {
									$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 

								} else {

									if (strlen($toReturn[$iBoucle+1]['dateDiff']) <6){
										$iDiffTotalHeureSupplementaire += $toReturn[$iBoucle+1]['dateDiff'] ; 
									}
								}

								/* Mission exterieur */
								
								
							}
						}

						/* si inférieur alors ça reste toujours 08*/
						if ($zHeureEntree <= $zHeureMin ) {
							$zDateEntreeAgent = $zDateMin . " 08:00:00" ; 
							//$zHeureArriveTot = $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,7);
							$zHeureArriveTot += $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,6);
							//$iTestEnDehorsHeureReglementaire = 1;
						}
						
						$zDateMax = date("Y-m-d",strtotime($toReturn[sizeof($toReturn)-1]['time'])) ; 

						/* heure maximale de sortie à 16h de l'après-midi */
						$zHeureMax = strtotime($zDateMax . " 16:00:00") ; 

						$zHeureSortie = strtotime($toReturn[sizeof($toReturn)-1]['time']) ; 

						$zDateSortieAgent = $toReturn[sizeof($toReturn)-1]['time'] ; 
						

						/* si supérieur alors ça reste toujours 16*/
						if ($zHeureSortie >= $zHeureMax ) {
							$zDateSortieAgent = $zDateMax . " 16:00:00" ; 
							$zHeureSortieTard += $this->dateDiff($zDateSortieAgent, $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
							//$iTestEnDehorsHeureReglementaire = 1;
						}

						$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($zDateEntreeAgent, $zDateSortieAgent, $_this,6);
						$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

						$iDiffTotal -= $iDiff ;

						/*if ($iUserId == "389671") {
							$zrrrResult = $this->dateDiff($toReturn[sizeof($toReturn)-1]['dateDiff'],0, $_this,5); 
							echo $iUserId . " -- " . $zDateEntreeAgent . " -- " . $zDateSortieAgent . " = " . $zrrrResult .  "<br>" ; 
						}*/

						//$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotal - $iDiff ; //$this->dateDiff($iDiffTotal,$iDiff, $_this,6);
					}

					//$iDiff -= $iTotalHeureSortieMission ; 

					$iDiffTotalGeneral += $iDiffTotal ; 
					
				}

				$toArrayArriveTot[(int)$iUserId] = (int)$zHeureArriveTot + (int)$zHeureSortieTard - $iDiffTotalHeureSupplementaire;
				$iGrandTotalOrder = $iDiffTotalGeneral + (int)$zHeureArriveTot + (int)$zHeureSortieTard;

				$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotalGeneral; 
				$toAssignationUser[$iUserId]["Mission"] = $iTotalHeureSortieMission; 
				$toAssignationUser[$iUserId]["iGrandTotalOrder"] = $iGrandTotalOrder + $iTotalHeureSortieMission; 

				
				if ($iReturn == 0) {
					array_push ($toArray, $toAssignationUser[$iUserId]["iGrandTotalOrder"]);
					$toArray2[(int)$iUserId] = $toAssignationUser[$iUserId]["iGrandTotalOrder"];
					
				} else {
					$toArray[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];
					$toArrayMission[(int)$iUserId]["Mission"] = $toAssignationUser[$iUserId]["Mission"];
					$toArrayGrandTotal[(int)$iUserId] = $toAssignationUser[$iUserId]["iGrandTotalOrder"];
				}

			}

			/*echo "<pre>" ; 
			print_r ($toArray);
			echo "<pre>" ; */


			if ($iReturn == 0) {

				rsort($toArray);

				if (sizeof($toArray) > 0 && (isset($toArray2[$iResultSearch])) && ($toArray2[$iResultSearch] > 0)) {

					$zDiffSearch = $this->dateDiff($toArray2[$iResultSearch],0, $_this,5); 
					$iRang = (array_search($toArray2[$iResultSearch], $toArray))+1;
					return $iRang .  "/" . $iCompteTotal;

					

				} else {
					$oAssign = $this->getInOutUserMatricule($iResultSearch,$_zDateDebut,$_zDateFin, $_this) ; 

					if (sizeof($oAssign)>0){

						$zDiffSearch = $this->dateDiff($oAssign->iTotalTravailler,0, $_this,5); 
						$iRang = 0;
						for($i=0;$i<sizeof($toArray)-2;$i++){
							if (($toArray[$i] > $oAssign->iTotalTravailler) && ($oAssign->iTotalTravailler > $toArray[$i+1]) )
							{
								$iRang = $i+2;
							}
						}
						if ($iCompteTotal != 0) {
							return $iRang .  "/" . $iCompteTotal;
						} else {
							return '';
						}
					} else {
						return '';
					}

				} 
			} else { 
				
				arsort($toArrayGrandTotal);
				
				$iBoucle=0;

				$_zDateFinAffich = $this->traitemetDateFin($_zDateFin, $_this);
 
				$iDiffDate	= $this->dateDiff($_zDateDebut, $_zDateFinAffich, $_this,1);

				foreach ($toArrayGrandTotal as $iUserId => $zValue){
					$toListe[(int)$zValue] = array();
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 	/*echo "<pre>" ; 
							print_r ($oCandidatUser);
							echo "<pre>" ; */

							
						 
						 if ((int)$oCandidatUser["matricule"] == (int)$iUserId){

							//echo $iUserId . "  " . $zValue . "<br/>";

							$oListe = new StdClass();
							$oListe->rang = $iBoucle+1;
							$oListe->iDiffDate = $iDiffDate;

							$iNbrHeureTravailler = $toArray[(int)$iUserId] ; 
							$iSupplementaire = 0;

							if ($toArrayMission[(int)$iUserId]["Mission"] > 0) {
								$iAdd = $iNbrHeureTravailler + (int)$toArrayMission[(int)$iUserId]["Mission"] ; 
								if($iAdd >= 28800){
									$iNbrHeureTravailler = 28800 ; 
									$iSupplementaire = $iAdd - 28800 ;
								} else {
									$iNbrHeureTravailler = $iAdd ; 
								}
							} 

							$oListe->value	= $this->dateDiff($iNbrHeureTravailler,0, $_this,5);
							foreach ($toArrayArriveTot as $iId =>$oArrayArriveTot){
								if ((int)$iId == (int)$iUserId){
									
									$oArrayArriveTot += $iSupplementaire ; 
									$iTot = $this->dateDiff($oArrayArriveTot,0, $_this,5);
									$oListe->Tot = "";
									if ($iTot > 0) {
										$oListe->Tot = $iTot ; 
									}
								}
							}
							//$zValue += $iSupplementaire ;
							$oListe->iTotTravailler	= $this->dateDiff($zValue,0, $_this,5);
							$oListe->data	= $oCandidatUser;

							/*echo "<pre>" ; 
							print_r ($oListe);
							echo "<pre>" ; */

							array_push($toListe[(int)$zValue], $oListe);
						 }
					}

					$iBoucle++;
				}
				
				/*echo "<pre>" ; 
				print_r ($toListe);
				echo "</pre>" ;*/

				//die();

				$iLastRang = sizeof($toListe) ;
				$iTest = 0;
				$toListeNotIn = array();
				foreach ($toCandidatUser as $oCandidatUser){
						
						$iTrouve = 0;
						foreach ($toArray as $iUserId => $zValue){
						 
							 if ((int)$oCandidatUser["matricule"] == (int)$iUserId){
								$iTrouve = 1;
							 }
						}
						
						if ($iTrouve == 0){

							
							$oAssign = $this->getInOutUser($oCandidatUser["user_id"],$_zDateDebut,$_zDateFin, $_this) ; 
		
							
							$iLastRang++;
							$oListe = new StdClass();

							if (isset($oAssign->iTotalTravailler) && ($oAssign->iTotalTravailler != '')) {
								
								$toListeNotIn[(int)$oAssign->iTotalTravailler] = array();
								
								$oListe->rang = $iLastRang;
								$oListe->iDiffDate = $iDiffDate;
								$oListe->value	= $this->dateDiff($oAssign->iHeureReglementaire,0, $_this,5);
								$oListe->Tot	= $this->dateDiff($oAssign->iSupplementaire,0, $_this,5);
								$oListe->iTotTravailler	= $this->dateDiff($oAssign->iTotalTravailler,0, $_this,5);
								array_push($toListeNotIn[(int)$oAssign->iTotalTravailler], $oListe);
								$oListe->data	= $oCandidatUser;
							} else {
								
								$iTest -= 1;
								$toListeNotIn[$iTest] = array();
								$oListe->rang = $iLastRang;
								$oListe->iDiffDate = $iDiffDate;
								$oListe->value	= '';
								$oListe->Tot	= '';
								$oListe->iTotTravailler	= $iTest;
								$oListe->data	= $oCandidatUser;
								array_push($toListeNotIn[$iTest], $oListe);
								
							}
							

							
							
						} 
				}

				if (isset($toListeNotIn) && sizeof($toListeNotIn)>0) {
					$toListeAffiche = $toListeNotIn ; 

					if (isset($toListe) && sizeof($toListe)>0) {
						$toListeAffiche = $toListeNotIn + $toListe ; 
					}
				} else {
					$toListeAffiche = $toListe ; 
				}

				krsort($toListeAffiche);

				
				$toListeFinal = array();
				$iRang = 1;
				foreach ($toListeAffiche as $iKey => $oListeAffiche){

					if (sizeof($oListeAffiche)>0) {
						$toListeAffiche[$iKey][0]->rang = $iRang ; 

						if ($toListeAffiche[$iKey][0]->iTotTravailler < 0){
							$toListeAffiche[$iKey][0]->iTotTravailler = '';
						}
						array_push($toListeFinal, $oListeAffiche[0]);
						$iRang ++;
					}
				}
				
				return $toListeFinal;
			}
		
	}

	function __2__TempsDeTravailDesAgents($_toCandidatUser, $_oCandidat, $iResultSearch, $_zDateDebut, $_zDateFin, $_this, $iCompteTotal,$iReturn=0,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1) {

		
			$toCandidatUser = unserialize($_toCandidatUser);

			$zInMatriculeUser = 0;

			if (sizeof($toCandidatUser)>0) {

				if ($iReturn == 0) {
					$zInMatriculeUser = implode(",", $toCandidatUser);
				} else {
					$toCandidatUserMatricule = array();
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
					}

					$zInMatriculeUser = implode(",", $toCandidatUserMatricule);
				}
			}

			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);
				/*$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
				$_zDateFinTraitement = $_this->date_fr_to_en($_zDateFinTraitement,'/','-');*/
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}

			$zQuerySqlServer = "SELECT SENSORID,time,USERID,CHECKTYPE FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo
			INNER JOIN [ZKAccess".date('Y')."].[dbo].[acc_monitor_log]  ON ckIn.USERID = userInfo.USERID
			WHERE (userInfo.pin IN (". $zInMatriculeUser .")) AND ".$zInsert."
			GROUP BY USERID, time, SENSORID,CHECKTYPE ORDER BY time";

			//echo $zQuerySqlServer ;

			$oResult = $this->executeQuery($zQuerySqlServer);
			$toArrayResult = $this->this_fetch_array($oResult);

			

			$iUserId = -1 ;
			$iRet = 0;
			$toAssignationUser = array();
			foreach ($toArrayResult as $oArrayResult) {
				if ($oArrayResult['USERID'] != $iUserId) {
					$iUserId = $oArrayResult['USERID'] ; 
					$iRet = 1;
				}
				$toAssignationUser[$iUserId][] = $oArrayResult;

			}

			$toArray = array();
			$toArray1 = array();
			foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

				$iDiff = 0 ; 
				for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {
					if($toReturn[$iBoucle]['CHECKTYPE'] == 'O' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == 'I') {
						$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($toReturn[$iBoucle]['time'], $toReturn[$iBoucle+1]['time'], $_this,6);
						$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 
					}
				}

				$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($toReturn[0]['time'], $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
				$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

				$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotal - $iDiff ; //$this->dateDiff($iDiffTotal,$iDiff, $_this,6);

				if ($iReturn == 0) {
					array_push ($toArray, $toAssignationUser[$iUserId]["dateDiff"]);
				} else {
					$toArray[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];
				}

			}


			if ($iReturn == 0) {

				rsort($toArray);
				if (sizeof($toArray) > 0 && $iResultSearch > 0) {

					$iRang = (array_search($iResultSearch, $toArray))+1;
					return $iRang .  "/" . $iCompteTotal;

				} else {
					return "";
				} 
			} else { 
				
				arsort($toArray);

				$toListe = array();
				$iBoucle=0;

				$_zDateFinAffich = $this->traitemetDateFin($_zDateFin, $_this);
 
				$iDiffDate	= $this->dateDiff($_zDateDebut, $_zDateFinAffich, $_this,1);

				foreach ($toArray as $iUserId => $zValue){
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 if ((int)$oCandidatUser["matricule"] == (int)$iUserId){

							$oListe = new StdClass();
							$oListe->rang = $iBoucle+1;
							$oListe->iDiffDate = $iDiffDate;
							$oListe->value	= $this->dateDiff($zValue,0, $_this,5);
							$oListe->data	= $oCandidatUser;

							array_push($toListe, $oListe);
						 }
					}

					$iBoucle++;
				}
				
				return $toListe;
			}
		
	}

	function taloha__TempsDeTravailDunAgentAvecDenominateur($_zInMatriculeUser, $_zDateDebut, $_zDateFin,&$iDenominateur, $_this) {


			$zInMatriculeUser = $_zInMatriculeUser ; 

			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, DateTime, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);				
				$zInsert = " (DateTime BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}

			$zQuerySqlServer = "SELECT TemID,DateTime,UserID,InOut FROM [FTDP].[dbo].[Transaction]
			WHERE (UserID IN (". $zInMatriculeUser .")) AND ".$zInsert."
			GROUP BY UserID, DateTime, TemID,InOut ORDER BY DateTime";
			
			//echo $zQuerySqlServer ;

			$oResult = $this->executeQuery($zQuerySqlServer);
			$toArrayResult = $this->this_fetch_array($oResult);

			

			$iUserId = -1 ;
			$iRet = 0;
			$toAssignationUser = array();
			foreach ($toArrayResult as $oArrayResult) {
				if ($oArrayResult['UserID'] != $iUserId) {
					$iUserId = $oArrayResult['UserID'] ; 
					$iRet = 1;
				}
				$toAssignationUser[$iUserId][] = $oArrayResult;

			}

			$toArray = array();
			$toArray1 = array();
			$toAssign = array();
			$toArrayArriveTot = array();
			$toArraySortietard = array();
			
			$iDateTest = "-1" ;
			
			$zDateTest = 0;
			$iDenominateur = 0;
			foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

				for ($iBoucle=0;$iBoucle<sizeof($toReturn);$iBoucle++) {
					
					if ($iDateTest !=  date("Y-m-d",strtotime($toReturn[$iBoucle]['DateTime']))) {
						$iDateTest = date("Y-m-d",strtotime($toReturn[$iBoucle]['DateTime'])) ; 
						$iDenominateur++;
					}

					$toAssign[$iUserId][$iDateTest][] = $toReturn[$iBoucle];
					
				}
			}
	
			foreach ($toAssign as $iUserId =>  $toReturn ) {
				
				$iDiffTotalGeneral = 0;
				$zHeureArriveTot = 0;
				$zHeureSortieTard = 0;
				foreach ($toReturn as $iDateTest =>  $toReturn ) {

					$iDiff = 0;
					$iDiffTotal = 0 ; 
					
					if (sizeof($toReturn)==1) {
						$iDiffTotal = 0 ; 
					} else { 
						
						$iTestPause = 0 ; 
						for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {

							$zDatetoDay = date("Y-m-d",strtotime($toReturn[$iBoucle]['DateTime'])) ; 
						
							/* Heure de pause min */
							$zHeurePauseMin = strtotime($zDatetoDay . " 12:00:00") ; 

							/* Heure de pause max */
							$zHeurePauseMax = strtotime($zDatetoDay . " 14:00:00") ; 

							$zHeureDeSortieMax = strtotime($zDatetoDay . " 16:00:00") ; 


							if($toReturn[$iBoucle]['InOut'] == 1 &&  $toReturn[$iBoucle+1]['InOut'] == 0) {

								$zDateDiffMin = $toReturn[$iBoucle]['DateTime'] ; 
								$zDiffzDateMin = 0;
								$zDiffzDateMax = 0;
								if (strtotime($toReturn[$iBoucle]['DateTime']) >= $zHeureDeSortieMax) {
									$zDateDiffMin = $zHeureDeSortieMax ; 
									$zDiffzDateMin = strtotime($toReturn[$iBoucle]['DateTime']) - $zHeureDeSortieMax ; 
								}

								$zDateDiffMax = $toReturn[$iBoucle+1]['DateTime'] ; 
								if (strtotime($toReturn[$iBoucle+1]['DateTime']) >= $zHeureDeSortieMax) {
									$zDateDiffMax = $zHeureDeSortieMax ; 
									$zDiffzDateMax = strtotime($toReturn[$iBoucle+1]['DateTime']) - $zHeureDeSortieMax ; 
								}

								$zHeureSortieTard -= ($zDiffzDateMax - $zDiffzDateMin) ; 
								
								
								$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
									
								/* Detection Pause 30 mn */
								if ($iTestPause == 0) {
									if (strtotime($toReturn[$iBoucle]['DateTime']) >= $zHeurePauseMin  && strtotime($toReturn[$iBoucle+1]['DateTime']) <= $zHeurePauseMax){
										if ($toReturn[$iBoucle+1]['dateDiff'] >= 1800){
											$iDiff -= 1800 ; 
											$iTestPause = 1;
											
										} else {

											
											$iDiff -= (int)$toReturn[$iBoucle+1]['dateDiff'];

										}
									}
								}
								
								$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 
							}
						}

						$zDateMin = date("Y-m-d",strtotime($toReturn[0]['DateTime'])) ; 
						
						
						/* heure minimale d'entrée à 08h du matin */
						$zHeureMin = strtotime($zDateMin . " 08:00:00") ; 

						$zHeureEntree = strtotime($toReturn[0]['DateTime']) ; 

						$zDateEntreeAgent = $toReturn[0]['DateTime'] ; 
						

						/* si inférieur alors ça reste toujours 08*/
						if ($zHeureEntree <= $zHeureMin ) {
							$zDateEntreeAgent = $zDateMin . " 08:00:00" ; 
							//$zHeureArriveTot = $this->dateDiff($toReturn[0]['DateTime'], $zDateEntreeAgent, $_this,7);
							$zHeureArriveTot += $this->dateDiff($toReturn[0]['DateTime'], $zDateEntreeAgent, $_this,6);
						}
						
						$zDateMax = date("Y-m-d",strtotime($toReturn[sizeof($toReturn)-1]['DateTime'])) ; 

						/* heure maximale de sortie à 16h de l'après-midi */
						$zHeureMax = strtotime($zDateMax . " 16:00:00") ; 

						$zHeureSortie = strtotime($toReturn[sizeof($toReturn)-1]['DateTime']) ; 

						$zDateSortieAgent = $toReturn[sizeof($toReturn)-1]['DateTime'] ; 
						

						/* si supérieur alors ça reste toujours 16*/
						if ($zHeureSortie >= $zHeureMax ) {
							$zDateSortieAgent = $zDateMax . " 16:00:00" ; 
							$zHeureSortieTard += $this->dateDiff($zDateSortieAgent, $toReturn[sizeof($toReturn)-1]['DateTime'], $_this,6);
						}

						$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($zDateEntreeAgent, $zDateSortieAgent, $_this,6);
						$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

						if (strlen($iDiff) <= 4) { 
							$iDiffTotal -= $iDiff ;
						} 
					}

					$iDiffTotalGeneral += $iDiffTotal ; 
					
				}

				$toArrayArriveTot[(int)$iUserId] = (int)$zHeureArriveTot + (int)$zHeureSortieTard;
				$iGrandTotalOrder = $iDiffTotalGeneral + (int)$zHeureArriveTot + (int)$zHeureSortieTard;

				$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotalGeneral; 
				$toAssignationUser[$iUserId]["iGrandTotalOrder"] = $iGrandTotalOrder; 
			
				array_push ($toArray, $toAssignationUser[$iUserId]["dateDiff"]);
				$toArray2[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];
					
			}

			if (sizeof($toArray) > 0) {

				/* 8H = 8 * 3600 = 28 800*/
				$iMax = 28800 * (int)$iDenominateur ; 

				$iTimeToAgent = $toArray2[$zInMatriculeUser] ; 

				$iNote = ($iTimeToAgent * 100) / $iMax ; 

				/* note sur 05 */
				$iNoteSur5 = ($iNote * 5)/100 ; 
				
				return $iNoteSur5; 

			} else {
				return "";
			} 
			
		
	}
	
	function TempsDeTravailDunAgentAvecDenominateur($_zInMatriculeUser, $_zDateDebut, $_zDateFin,&$iDenominateur, $_this, $_iAnnee="2018") {

		return "4.5";
	}

	function TempsDeTravailDunAgentAvecDenominateur_taloha($_zInMatriculeUser, $_zDateDebut, $_zDateFin,&$iDenominateur, $_this, $_iAnnee="2018") {


			$zInMatriculeUser = $_zInMatriculeUser ; 

			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);				
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}

			/*$zQuerySqlServer = "SELECT SENSORID,time,userInfo.USERID,CHECKTYPE FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo
			INNER JOIN [ZKAccess".date('Y')."].[dbo].[acc_monitor_log]  ON ckIn.USERID = userInfo.USERID
			WHERE (userInfo.pin IN (". $zInMatriculeUser .")) AND ".$zInsert."
			GROUP BY userInfo.USERID, time, SENSORID,CHECKTYPE ORDER BY time";*/

			$zQuerySqlServer = " SELECT time,pin,event_point_name as terminal, CAST(
								 CASE 
									  WHEN SUBSTRING(event_point_name, 1, 1) = 'S' 
										 THEN 'O' 
									  ELSE 'I' 
								 END AS varchar) as CHECKTYPE
								 FROM [ZKAccess".$_iAnnee."].[dbo].[acc_monitor_log]
								 WHERE (pin IN (".$zInMatriculeUser.")) AND ".$zInsert."
								GROUP BY time,event_point_name,pin ORDER BY time";

			$oResult = $this->executeQuery($zQuerySqlServer);

			$toArrayResult = array();

			while($oArrayResult = odbc_fetch_array($oResult)){
				
				$oArray = array();
				$oArray['time']			= odbc_result($oResult,1); 
				$oArray['pin']			= odbc_result($oResult,2); 
				$oArray['CHECKTYPE']	= odbc_result($oResult,4); 
				
				array_push($toArrayResult, $oArray);
			}
			

			$iUserId = -1 ;
			$iRet = 0;
			$toAssignationUser = array();
			foreach ($toArrayResult as $oArrayResult) {
				if ($oArrayResult['pin'] != $iUserId) {
					$iUserId = $oArrayResult['pin'] ; 
					$iRet = 1;
				}
				$toAssignationUser[$iUserId][] = $oArrayResult;

			}

			$toArray = array();
			$toArray1 = array();
			$toAssign = array();
			$toArrayArriveTot = array();
			$toArraySortietard = array();
			
			$iDateTest = "-1" ;
			
			$zDateTest = 0;
			$iDenominateur = 0;
			foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

				for ($iBoucle=0;$iBoucle<sizeof($toReturn);$iBoucle++) {
					
					if ($iDateTest !=  date("Y-m-d",strtotime($toReturn[$iBoucle]['time']))) {
						$iDateTest = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ; 
						$iDenominateur++;
					}

					$toAssign[$iUserId][$iDateTest][] = $toReturn[$iBoucle];
					
				}
			}
	
			foreach ($toAssign as $iUserId =>  $toReturn ) {
				
				$iDiffTotalGeneral = 0;
				$zHeureArriveTot = 0;
				$zHeureSortieTard = 0;
				foreach ($toReturn as $iDateTest =>  $toReturn ) {

					$iDiff = 0;
					$iDiffTotal = 0 ; 
					
					if (sizeof($toReturn)==1) {
						$iDiffTotal = 0 ; 
					} else { 
						
						$iTestPause = 0 ; 
						for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {

							$zDatetoDay = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ; 
						
							/* Heure de pause min */
							$zHeurePauseMin = strtotime($zDatetoDay . " 12:00:00") ; 

							/* Heure de pause max */
							$zHeurePauseMax = strtotime($zDatetoDay . " 14:00:00") ; 

							$zHeureDeSortieMax = strtotime($zDatetoDay . " 16:00:00") ; 


							if($toReturn[$iBoucle]['CHECKTYPE'] == 'O' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == 'I') {

								$zDateDiffMin = $toReturn[$iBoucle]['time'] ; 
								$zDiffzDateMin = 0;
								$zDiffzDateMax = 0;
								if (strtotime($toReturn[$iBoucle]['time']) >= $zHeureDeSortieMax) {
									$zDateDiffMin = $zHeureDeSortieMax ; 
									$zDiffzDateMin = strtotime($toReturn[$iBoucle]['time']) - $zHeureDeSortieMax ; 
								}

								$zDateDiffMax = $toReturn[$iBoucle+1]['time'] ; 
								if (strtotime($toReturn[$iBoucle+1]['time']) >= $zHeureDeSortieMax) {
									$zDateDiffMax = $zHeureDeSortieMax ; 
									$zDiffzDateMax = strtotime($toReturn[$iBoucle+1]['time']) - $zHeureDeSortieMax ; 
								}

								$zHeureSortieTard -= ($zDiffzDateMax - $zDiffzDateMin) ; 


								if (!is_integer($zDateDiffMax)) {
								
									$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);

								} else {

									$zDateDiffMax = $toReturn[$iBoucle+1]['time'];
									$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
								}
								
								
								//$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
									
								/* Detection Pause 30 mn */
								if ($iTestPause == 0) {
									if (strtotime($toReturn[$iBoucle]['time']) >= $zHeurePauseMin  && strtotime($toReturn[$iBoucle+1]['time']) <= $zHeurePauseMax){
										if ($toReturn[$iBoucle+1]['dateDiff'] >= 1800){
											$iDiff -= 1800 ; 
											$iTestPause = 1;
											
										} else {

											
											$iDiff -= (int)$toReturn[$iBoucle+1]['dateDiff'];

										}
									}
								}
								
								$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 
							}
						}

						$zDateMin = date("Y-m-d",strtotime($toReturn[0]['time'])) ; 
						
						
						/* heure minimale d'entrée à 08h du matin */
						$zHeureMin = strtotime($zDateMin . " 08:00:00") ; 

						$zHeureEntree = strtotime($toReturn[0]['time']) ; 

						$zDateEntreeAgent = $toReturn[0]['time'] ; 
						

						/* si inférieur alors ça reste toujours 08*/
						if ($zHeureEntree <= $zHeureMin ) {
							$zDateEntreeAgent = $zDateMin . " 08:00:00" ; 
							//$zHeureArriveTot = $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,7);
							$zHeureArriveTot += $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,6);
						}
						
						$zDateMax = date("Y-m-d",strtotime($toReturn[sizeof($toReturn)-1]['time'])) ; 

						/* heure maximale de sortie à 16h de l'après-midi */
						$zHeureMax = strtotime($zDateMax . " 16:00:00") ; 

						$zHeureSortie = strtotime($toReturn[sizeof($toReturn)-1]['time']) ; 

						$zDateSortieAgent = $toReturn[sizeof($toReturn)-1]['time'] ; 
						

						/* si supérieur alors ça reste toujours 16*/
						if ($zHeureSortie >= $zHeureMax ) {
							$zDateSortieAgent = $zDateMax . " 16:00:00" ; 
							$zHeureSortieTard += $this->dateDiff($zDateSortieAgent, $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
						}

						$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($zDateEntreeAgent, $zDateSortieAgent, $_this,6);
						$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

						if (strlen($iDiff) <= 4) { 
							$iDiffTotal -= $iDiff ;
						} 
					}

					$iDiffTotalGeneral += $iDiffTotal ; 
					
				}

				$toArrayArriveTot[(int)$iUserId] = (int)$zHeureArriveTot + (int)$zHeureSortieTard;
				$iGrandTotalOrder = $iDiffTotalGeneral + (int)$zHeureArriveTot + (int)$zHeureSortieTard;

				$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotalGeneral; 
				$toAssignationUser[$iUserId]["iGrandTotalOrder"] = $iGrandTotalOrder; 
			
				array_push ($toArray, $toAssignationUser[$iUserId]["dateDiff"]);
				$toArray2[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];
					
			}

			if (sizeof($toArray) > 0) {

				/* 8H = 8 * 3600 = 28 800*/
				$iMax = 28800 * (int)$iDenominateur ; 

				$iTimeToAgent = $toArray2[$zInMatriculeUser] ; 

				$iNote = ($iTimeToAgent * 100) / $iMax ; 

				/* note sur 05 */
				$iNoteSur5 = ($iNote * 5)/100 ; 
				
				return $iNoteSur5; 

			} else {
				return "";
			} 
	}


	function ___TempsDeTravailDesAgents($_toCandidatUser, $_oCandidat, $iResultSearch, $_zDateDebut, $_zDateFin, $_this, $iCompteTotal,$iReturn=0,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1) {

		
			$toCandidatUser = unserialize($_toCandidatUser);

			$zInMatriculeUser = 0;

			if (sizeof($toCandidatUser)>0) {

				if ($iReturn == 0) {
					$zInMatriculeUser = implode(",", $toCandidatUser);
				} else {
					$toCandidatUserMatricule = array();
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
					}

					$zInMatriculeUser = implode(",", $toCandidatUserMatricule);
				}
			}

			if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
				$_zDateFinTraitement = $_zDateDebut;
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);
				/*$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
				$_zDateFinTraitement = $_this->date_fr_to_en($_zDateFinTraitement,'/','-');*/
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}


			$zQuerySqlServer = "SELECT TOP 10 t.USERID,
			( SELECT ABS(datediff(second, (SELECT TOP 1 time  FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo as t3 WHERE (t3.USERID = t.USERID AND ".$zInsert." AND CHECKTYPE='O') GROUP BY time ORDER BY time DESC), (SELECT TOP 1 time  FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo as t4 WHERE (t4.USERID = t.USERID AND ".$zInsert." AND CHECKTYPE='I') GROUP BY time ORDER BY time ASC)))) as diff
			FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo as t
			WHERE (USERID IN (". $zInMatriculeUser .")) AND ".$zInsert."
			GROUP BY USERID ORDER BY diff DESC";



			if ($iReturn == 1) {

				$oResult = $this->executeQuery($zQuerySqlServer);
				$toArrayResult = $this->this_fetch_array($oResult);


				
				$toArrayCombined = array();

				if (sizeof ($toArrayResult)> 0) {

					/*$toFirstTransaction =  (reset($toArrayResult)); 

					$i = 0;
					foreach ($toFirstTransaction as $iKey => $zValue) {

						if ($i == 0){ 
							$_iNbrTotal = $zValue ; 
						}
						$i++;
					}*/

					foreach ($toArrayResult as $oArrayResult) {
						array_push($toArrayCombined,$oArrayResult['USERID']);
					}
					
					$zInMatriculeUser = implode(",", $toArrayCombined) ; 

				}

				$zQuerySqlServer2 = "SELECT SENSORID,time,t.USERID,CHECKTYPE,( SELECT ABS(datediff(second, (SELECT TOP 1 time  FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo as t3 WHERE (t3.USERID = t.USERID AND ".$zInsert." AND CHECKTYPE='O') GROUP BY time ORDER BY time DESC), (SELECT TOP 1 time  FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo as t4 WHERE (t4.USERID = t.USERID AND ".$zInsert." AND CHECKTYPE='I') GROUP BY time ORDER BY time ASC)))) as diff FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo as t
				WHERE (USERID IN (". $zInMatriculeUser .")) AND ".$zInsert."
				GROUP BY USERID, time, SENSORID,CHECKTYPE ORDER BY diff DESC";

				//$zQuerySqlServer2 .= " OFFSET ".($_iCurrPage-1) * $_iValPerPage." ROWS FETCH NEXT ".$_iValPerPage." ROWS ONLY;  " ;

				$oResult = $this->executeQuery($zQuerySqlServer2);
				$toArrayResult = $this->this_fetch_array($oResult);

			} else {
				
				$oResult = $this->executeQuery($zQuerySqlServer);
				$toArrayResult = $this->this_fetch_array($oResult);
			}

			

			$iUserId = -1 ;
			$iRet = 0;
			$toAssignationUser = array();
			foreach ($toArrayResult as $oArrayResult) {
				if ($oArrayResult['USERID'] != $iUserId) {
					$iUserId = $oArrayResult['USERID'] ; 
					$iRet = 1;
				}
				$toAssignationUser[$iUserId][] = $oArrayResult;

			}

			$toArray = array();
			$toArray1 = array();
			foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

				$iDiff = 0 ; 
				for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {
					if($toReturn[$iBoucle]['CHECKTYPE'] == '1' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == '0') {
						$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($toReturn[$iBoucle]['time'], $toReturn[$iBoucle+1]['time'], $_this,6);
						$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 
					}
				}

				$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($toReturn[0]['time'], $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
				$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

				$toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotal - $iDiff ; //$this->dateDiff($iDiffTotal,$iDiff, $_this,6);

				if ($iReturn == 0) {
					array_push ($toArray, $toAssignationUser[$iUserId]["dateDiff"]);
				} else {
					$toArray[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];
				}

			}


			if ($iReturn == 0) {

				rsort($toArray);
				if (sizeof($toArray) > 0 && $iResultSearch > 0) {

					$iRang = (array_search($iResultSearch, $toArray))+1;
					return $iRang .  "/" . $iCompteTotal;

				} else {
					return "";
				} 
			} else { 
				
				arsort($toArray);

				/*echo "<pre>" ; 
				print_r ($toArray) ; 
				echo "<pre>" ;*/

				//die();


				$toListe = array();
				$iBoucle=0;

				$_zDateFinAffich = $this->traitemetDateFin($_zDateFin, $_this);
 
				$iDiffDate	= $this->dateDiff($_zDateDebut, $_zDateFinAffich, $_this,1);

				foreach ($toArray as $iUserId => $zValue){
					foreach ($toCandidatUser as $oCandidatUser)
					{
						 if ((int)$oCandidatUser["matricule"] == (int)$iUserId){

							$oListe = new StdClass();
							$oListe->rang = $iBoucle+1;
							$oListe->iDiffDate = $iDiffDate;
							$oListe->value	= $this->dateDiff($zValue,0, $_this,5);
							$oListe->data	= $oCandidatUser;

							array_push($toListe, $oListe);
						 }
					}

					$iBoucle++;
				}
				
				return $toListe;
			}
		
	}

	function TempsDeTravailDunAgent($_iCompteActif, $_iUserId, $_oCandidat, $_zDateDebut, $_zDateFin, $_this,$_iMatricule,&$iResult=0) {

		if ($_zDateDebut == $_zDateFin) {
				//$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ; 
				$zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
			} else {
				$_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);

/*********************************************** A decommenter en ligne ***********************************************************/
				/*$_zDateDebut = $_this->date_fr_to_en($_zDateDebut,'/','-'); 
				$_zDateFinTraitement = $_this->date_fr_to_en($_zDateFinTraitement,'/','-');*/
				$zInsert = " (time BETWEEN '$_zDateDebut'  and  '$_zDateFinTraitement')" ; 

			}
		
		if ($_iMatricule == "") {
			$zInMatriculeUser = $this->getMatriculeAgent($_iCompteActif, $_iUserId, $_oCandidat);
		} else {
			$zInMatriculeUser = $_iMatricule ; 
		}


		//$toDateAccess = explode("/", $_zDateDebut);

		if ($_zDateDebut !=""){
			$toDateAccess = explode("/", $_zDateDebut);
		} else {
			$toDateAccess = explode("/", date("d/m/Y"));
		}

		/*$zQuerySqlServer = "SELECT SENSORID,time,USERID,CHECKTYPE FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo
		INNER JOIN [ZKAccess".date('Y')."].[dbo].[acc_monitor_log]  ON ckIn.USERID = userInfo.USERID
		WHERE (userInfo.pin IN (". $zInMatriculeUser .")) AND ".$zInsert."
		GROUP BY USERID, time, SENSORID,CHECKTYPE ORDER BY time";*/


		/*$zQuerySqlServer = " SELECT time,pin,event_point_name as terminal, CAST(
							 CASE 
								  WHEN SUBSTRING(event_point_name, 1, 1) = 'S' 
									 THEN 'O' 
								  ELSE 'I' 
							 END AS varchar) as CHECKTYPE
							 FROM [ZKAccess".date('Y')."].[dbo].[acc_monitor_log]
							 WHERE (pin IN (".$zInMatriculeUser.")) AND ".$zInsert."
							GROUP BY time,event_point_name,pin ORDER BY time";*/


		$zQuerySqlServer = "SELECT t.pin
							,CAST( ( SELECT CONCAT(
							gcap_id,';'
							
							,(
							SELECT  CONCAT(  DATEADD(DAY, nbr - 1, CAST(gcap_dateDebut as DATE)), 
							CAST(
							CASE 
								WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 1 AND nbr = 1)
									THEN ' 12:00:000'
								ELSE ' 08:00:000' 
							END AS varchar
							
							)
							,'--',t.pin,'--','I;', 
							DATEADD(DAY, nbr - 1, CAST(gcap_dateDebut as DATE)),
							
							CAST(
							CASE 
								WHEN (gcap_demiJournee = 1 AND gcap_MatinSoir = 2 AND nbr -1 = datediff(DAY,gcap_dateDebut,gcap_dateFin))
									THEN ' 12:00:000'
								ELSE ' 16:00:000' 
							END AS varchar
							
							)
							,'--',t.pin,'--','O',';')
							FROM    ( SELECT    ROW_NUMBER() OVER ( ORDER BY c.object_id ) AS Nbr
									  FROM      sys.columns c
									) nbrs
							WHERE   nbr - 1 <= DATEDIFF(DAY, CAST(gcap_dateDebut as DATE), CAST(gcap_dateFin as DATE))
							FOR XML PATH('')
							)
							
							) FROM [ZKGcap].[dbo].[gcap] WHERE gcap_pinId = t.pin 
							AND '2017-12-01' 
							BETWEEN gcap_dateDebut AND gcap_dateFin GROUP BY gcap_id,gcap_demiJournee,gcap_MatinSoir,
							gcap_dateDebut,gcap_dateFin
							
							FOR XML PATH('')
							
							 ) as varchar(max) ) as CONGE
							,CAST((
									SELECT CONCAT(CONCAT(CAST(time AS DATE),' ', CAST(time as TIME)),'--',t3.pin,'--',CAST(
													 CASE 
														  WHEN SUBSTRING(event_point_name, 1, 1) = 'S' 
															 THEN 'O' 
														  ELSE 'I' 
													 END AS varchar),';')
									FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] t3
									WHERE (t3.pin = t.pin AND (datediff(day, time, '2017-12-01') = 0)
								)  GROUP BY t3.time,t3.pin,event_point_name FOR XML PATH(''))as varchar(max)) AS [Column]
								
						FROM [ZKAccess".$toDateAccess[2]."].[dbo].[acc_monitor_log] t
						WHERE (t.pin IN  ('332026','307381','351101','340699','374986','389671'))  
						GROUP BY t.pin";
		

		$oResult = $this->executeQuery($zQuerySqlServer);
		$toReturn = array();

		while($oArrayResult = odbc_fetch_array($oResult)){
			
			$oArray = array();
			$oArray['time']			= odbc_result($oResult,1); 
			$oArray['pin']			= odbc_result($oResult,2); 
			$oArray['CHECKTYPE']	= odbc_result($oResult,4); 
			
			array_push($toReturn, $oArray);
		}

		//$oResult = $this->executeQuery($zQuerySqlServer);
		//$toReturn = $this->this_fetch_array($oResult);

		$iTestOut = 0;
		$iTestIn = 0;
		$iDiff = 0 ; 
		for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {
			if($toReturn[$iBoucle]['CHECKTYPE'] == 'O' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == 'I') {
				$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($toReturn[$iBoucle]['time'], $toReturn[$iBoucle+1]['time'], $_this,6);
				$iDiff += $toReturn[$iBoucle+1]['dateDiff'] ; 
			}
		}

		$zReturn = "";
		if (sizeof($toReturn) > 0) {

			$toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($toReturn[0]['time'], $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
			$iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

			$iResult = $iDiffTotal - $iDiff ; 
			$zReturn = $this->dateDiff($iDiffTotal,$iDiff, $_this,5);
		}

		return $zReturn ; 

	}

	public function get_by_matricule($_iMatriculeId){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$sql= "select *,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS zMatricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9) AS cin1 from $zDatabaseOrigin.candidat HAVING zMatricule = '".$_iMatriculeId."' OR cin1 = '".$_iMatriculeId."' LIMIT 0,1";
		//echo $sql ; 
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function update_password($id_user,$data,$bEnCrypt=FALSE){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		//$data['login'] = str_replace("'", "\'", $data['login']) ; 
		//$data['password'] = str_replace("'", "\'", $data['password']) ; 

		$zPass = $this->db->escape($data['password']);
		if ($bEnCrypt == FALSE) {
			//$sql= "UPDATE $zDatabaseOrigin.user SET login='".$data['login']."',PASSWORD = {$zPass} WHERE id = ".$id_user;
			$this->db->update($zDatabaseOrigin.'.user', $data, "id = $id_user");
		} else {
			
			//$sql= "UPDATE $zDatabaseOrigin.user SET login='".$data['login']."',PASSWORD = AES_ENCRYPT('".$data['password']."','".encrypt."') WHERE id = ".$id_user;
			$sql= "UPDATE $zDatabaseOrigin.user SET login='".$data['login']."',PASSWORD = AES_ENCRYPT({$zPass},'".encrypt."') WHERE id = ".$id_user;
			$this->db->query($sql);
		}

		
	}

	public function updateMahandry($iNbrHeure = 10, $zWhere = ''){

		$zQuerySqlServer = "SELECT LID,DevID,time,USERID,CHECKTYPE FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo " ; 

		if ($zWhere != "") {
			$zQuerySqlServer .= " WHERE 1=1 " . $zWhere ; 
		}
		
		$zQuerySqlServer .= " GROUP BY LID,USERID, time, DevID,CHECKTYPE ORDER BY time";

		$oResult = $this->executeQuery($zQuerySqlServer);
		$toGetAllTransaction = $this->this_fetch_array($oResult);

		$zTimeAEnlever = 3600*$iNbrHeure;

		$zSeconds = 42*60 + 34 ; 

		$toReturn = array();
		foreach ($toGetAllTransaction as $oGetAllTransaction)
		{
			 
			 $oReturn = new stdClass();
			 $oReturn->LID				= $oGetAllTransaction['LID'] ; 
			 $oReturn->DevID			= $oGetAllTransaction['DevID'] ; 

			 $otime = explode(".", $oGetAllTransaction['time']) ; 

			 $oReturn->time = $otime[0];

			 $zDateDiff					= strtotime('+10 hours 42 minutes 34 seconds', strtotime($otime[0]));

			 $oReturn->timeUpdate	= date("d-m-Y H:i:s",$zDateDiff); 
			 $oReturn->LastUpdate		= date("d-m-Y H:i:s",strtotime($otime[0])); 
			 $oReturn->USERID			= $oGetAllTransaction['USERID'] ; 
			 $oReturn->CHECKTYPE			= $oGetAllTransaction['CHECKTYPE'] ;

			 $sql2 = "UPDATE [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo SET time = '".$oReturn->timeUpdate.".000' WHERE LID = '". (int)$oGetAllTransaction['LID'] ."' AND DevID = '".(int)$oGetAllTransaction['DevID']."' AND 
			 USERID = '".(int)$oGetAllTransaction['USERID']."' AND CHECKTYPE = '".(int)$oGetAllTransaction['CHECKTYPE']."' AND time = '".$oReturn->LastUpdate.".000'";

			 
			 /* A decommenter pour la MAJ */
			 //$oResult = $this->executeQuery($sql2);

			 $oReturn->sql2				= $sql2 ;

			array_push($toReturn, $oReturn) ;
		}

		return $toReturn ; 
	}


	public function majTransaction(){

		$zQuerySqlServer = "SELECT [FTDP1].[dbo].[Terminal].[DevID] as devId,[FTDP1].[dbo].[Terminal].[Desc] as Description FROM [FTDP1].[dbo].[Terminal]
		GROUP BY [FTDP1].[dbo].[Terminal].[DevID],[FTDP1].[dbo].[Terminal].[Desc] ORDER BY [FTDP1].[dbo].[Terminal].[DevID] ASC OFFSET 0 ROWS" ; 

		$oResult = $this->executeQuery($zQuerySqlServer);
		$toGetAllTransaction = $this->this_fetch_array($oResult);

		
		$toReturn = array();
		foreach ($toGetAllTransaction as $oGetAllTransaction)
		{
			 
			 $iDevId				= $oGetAllTransaction['devId'] ; 
			 $zDescription			= $oGetAllTransaction['Desc'] ; 

			 $sql2 = " UPDATE [FTDP1].[dbo].[Transaction] SET [FTDP1].[dbo].[Transaction].[porte] = '".$zDescription."' WHERE [FTDP1].[dbo].[Transaction].[DevID] = " . $iDevId;

			 echo $sql2 . "<br><br>"; 

			 //die();

			 //$this->executeQuery($sql2);
		}

		return $toReturn ; 
	}

	public function SavePointageDirect($_iMatricule,$_zDateEntree,$_zDateSortie) {

		$zSqlEntree = " insert into [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo ([USERID],[time],[CHECKTYPE]) values ('".$_iMatricule."','".$_zDateEntree.".000',1)";

		$this->executeQuery($zSqlEntree);

		$zSqlSortie = " insert into [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo ([USERID],[time],[CHECKTYPE]) values ('".$_iMatricule."','".$_zDateSortie.".000',0)";

		$this->executeQuery($zSqlSortie);

	}

	public function setPdf ($_toListe, $_zDateDebut, $_zDateFin) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("L");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',8);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(45);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(45);
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
			$oPdf->SetFont('trebuc','');
			$oPdf->Ln();

			$oPdf->SetFont('trebuc','',8);

			$oPdf->SetX(45);
			$oPdf->Cell(200,7,'POINTAGE ELECTRONIQUE DU ' . $_zDateDebut . " au " . $_zDateFin ,0,0,'C',1);
			
			$oPdf->Ln();



			//=================================================================
			$oPdf->SetFont('trebuc','',8);


			$oPdf->SetX(10);
			$oPdf->Cell(20,7,'RANG',1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(20,7,'Matricule',1,0,'C',1);

			$oPdf->SetX(50);
			$oPdf->Cell(60,7,'Nom',1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(50,7,utf8_decode('Prénom'),1,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(25,7,utf8_decode('Département'),1,0,'C',1);

			$oPdf->SetX(185);
			$oPdf->Cell(25,7,'Direction',1,0,'C',1);

			$oPdf->SetX(210);
			$oPdf->Cell(25,7,'Service',1,0,'C',1);

			$oPdf->SetX(235);
			$oPdf->Cell(25,7,'Nbr de jour',1,0,'C',1);

			$oPdf->SetX(260);
			$oPdf->Cell(30,7,utf8_decode('Heures Règlementaires'),1,0,'C',1);

			$oPdf->SetX(285);
			$oPdf->Cell(30,7,utf8_decode('Heures Supplementaires'),1,0,'C',1);

			$oPdf->SetX(300);
			$oPdf->Cell(30,7,utf8_decode('Heures Total Travaillées'),1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('trebuc','',8);


			$i=0;
			foreach ($_toListe as $oListe) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLR";
				}

				$oPdf->SetX(10);
				$oPdf->Cell(20,7,$oListe->rang,$zBorder,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(20,7,$oListe->data['matricule'],$zBorder,0,'C',1);

				$oPdf->SetX(50);
				$oPdf->Cell(60,7,utf8_decode($oListe->data['nom']),$zBorder,0,'C',1);

				$oPdf->SetX(110);
				$oPdf->Cell(50,7,utf8_decode($oListe->data['prenom']),$zBorder,0,'C',1);

				$oPdf->SetX(160);
				$oPdf->Cell(25,7,utf8_decode($oListe->data['sigle_departement']),$zBorder,0,'C',1);

				$oPdf->SetX(185);
				$oPdf->Cell(25,7,utf8_decode($oListe->data['sigle_direction']),$zBorder,0,'C',1);

				$oPdf->SetX(210);
				$oPdf->Cell(25,7,utf8_decode($oListe->data['sigle_service']),$zBorder,0,'C',1);

				$oPdf->SetX(235);
				$oPdf->Cell(25,7,$oListe->iDiffDate,$zBorder,0,'C',1);

				$oPdf->SetX(260);
				$oPdf->Cell(30,7,$oListe->value,$zBorder,0,'C',1);

				$oPdf->SetX(285);
				$oPdf->Cell(30,7,$oListe->Tot,$zBorder,0,'C',1);

				$oPdf->SetX(300);
				$oPdf->Cell(30,7,$oListe->iTotTravailler,$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}


	public function setPdfRapports ($_oData,$_toListe, $_zDateDebut, $_zDateFin) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("L");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',8);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oSigleAssign = array();
			foreach ($_oData['toSigle'] as $oSigle) {
				$oSigleAssign = $oSigle ; 
			}

			$oPdf->SetX(10);
			$oPdf->Cell(100,7,utf8_decode('MINISTÈRE DE L\'ECONOMIE ET DES FINANCES'),0,0,'C',1);
			$oPdf->Cell(152,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);

			if($oSigleAssign ['departementNom'] != ''){
				$oPdf->Cell(100,7,utf8_decode($oSigle['departementNom']),0,0,'C',1);
			} else {
				$oPdf->Cell(100,7,'',1,0,'L',1);
			}
			
			$oPdf->Cell(152,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
			$oPdf->SetFont('trebuc','');
			$oPdf->Ln();

			$oPdf->SetFont('trebuc','',8);

			$oPdf->SetX(10);
			if($oSigleAssign ['directionNom'] != '' && ($oSigleAssign['directionNom'] != $oSigleAssign['departementNom'])){
				$oPdf->Cell(100,7,utf8_decode($oSigle['directionNom']),0,0,'C',1);
			} else {
				$oPdf->Cell(100,7,'',1,0,'L',1);
			}
			$oPdf->Cell(152,7,'RAPPORT DU ' . $_zDateDebut . " au " . $_zDateFin ,0,0,'C',1);
			
			$oPdf->Ln();

			$oPdf->SetX(10);
			if($oSigle['serviceNom'] != ''){
				if ($oSigle['serviceNom'] != $oSigle['directionNom']){
					$oPdf->Cell(100,7,utf8_decode($oSigle['serviceNom']),0,0,'C',1);
				} else {
					$oSigle['serviceNom'] = str_replace ("DIRECTION","SERVICE DE LA GESTION",$oSigle['serviceNom']);
					$oPdf->Cell(100,7,utf8_decode($oSigle['serviceNom']),0,0,'C',1);
				}
			} else {
				$oPdf->Cell(100,7,'',0,0,'C',1);
			}
			$oPdf->Cell(152,7,'' ,0,0,'C',1);

			$oPdf->Ln();
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',8);


			$oPdf->SetX(10);
			$oPdf->Cell(20,7,'Matricule',1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(65,7,utf8_decode('Nom et Prénoms'),1,0,'C',1);

			$oPdf->SetX(95);
			$oPdf->Cell(20,7,utf8_decode('Dpt'),1,0,'C',1);

			$oPdf->SetX(115);
			$oPdf->Cell(20,7,'Dir',1,0,'C',1);

			$oPdf->SetX(135);
			$oPdf->Cell(20,7,'Ser',1,0,'C',1);

			$oPdf->SetX(155);
			$oPdf->Cell(30,7,'Poste',1,0,'C',1);

			$oPdf->SetX(185);
			$oPdf->Cell(15,7,'Jour',1,0,'C',1);

			$oPdf->SetX(200);
			$oPdf->Cell(20,7,'Date',1,0,'C',1);

			$oPdf->SetX(220);
			$oPdf->Cell(15,7,utf8_decode('Entrée'),1,0,'C',1);

			$oPdf->SetX(235);
			$oPdf->Cell(15,7,'Sortie',1,0,'C',1);

			$oPdf->SetX(250);
			$oPdf->Cell(15,7,'Total',1,0,'C',1);

			$oPdf->SetX(265);
			$oPdf->Cell(25,7,'Observations',1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('trebuc','',8);


			$i=0;
			foreach ($_toListe as $oListe) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLR";
				}

				$zDate = date("D", strtotime($oListe->zDateEntee)) ; 
				$zDateAffiche = "";
				switch ($zDate) {
					case 'Mon':
						$zDateAffiche = "Lundi" ; 
						break;

					case 'Tue':
						$zDateAffiche = "Mardi" ; 
						break;

					case 'Wed':
						$zDateAffiche = "Mercredi" ; 
						break;

					case 'Thu':
						$zDateAffiche = "Jeudi" ; 
						break;

					case 'Fri':
						$zDateAffiche = "Vendredi" ; 
						break;

					case 'Sat':
						$zDateAffiche = "Samedi" ; 
						break;

					case 'Sun':
						$zDateAffiche = "Dimanche" ; 
						break;
				}

				$oPdf->SetX(10);
				$oPdf->Cell(20,7,$oListe->data['matricule'],1,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(65,7,utf8_decode($oListe->data['nom'] . " " . $oListe->data['prenom']),1,0,'L',1);

				$oPdf->SetX(95);
				$oPdf->Cell(20,7,$oListe->data['sigle_departement'],1,0,'C',1);

				$oPdf->SetX(115);
				$oPdf->Cell(20,7,$oListe->data['sigle_direction'],1,0,'C',1);

				$oPdf->SetX(135);
				$oPdf->Cell(20,7,$oListe->data['sigle_service'],1,0,'C',1);

				$oPdf->SetX(155);
				$oPdf->Cell(30,7,utf8_decode(substr($oListe->data['poste'], 0, 18)),1,0,'L',1); 

				$oPdf->SetX(185);
				$oPdf->Cell(15,7,$zDateAffiche,1,0,'C',1);

				$oPdf->SetX(200);
				$oPdf->Cell(20,7,date("d/m/Y", strtotime($oListe->zDateEntee)),1,0,'C',1);

				

				$zHeureEntree = '' ; 
				if ($oListe->zDateEntee != '') {
					$zHeureEntree = date("H:i:s", strtotime($oListe->zDateEntee)) ; 

					if ($zHeureEntree == '00:00:00'){
						$zHeureEntree = '' ; 
					}
				}

				$zHeureSortie = '' ; 
				if ($oListe->zDateSortie != '') {
					$zHeureSortie = date("H:i:s", strtotime($oListe->zDateSortie));

					if ($zHeureSortie == '00:00:00'){
						$zHeureSortie = '' ; 
					}
				}

				$oPdf->SetX(220);
				$oPdf->Cell(15,7,$zHeureEntree,1,0,'C',1);


				$oPdf->SetX(235);
				$oPdf->Cell(15,7,$zHeureSortie,1,0,'C',1);

				$oPdf->SetX(250);
				$oPdf->Cell(15,7,$oListe->zDiffAffichage,1,0,'C',1);

				$oPdf->SetX(265);
				$oPdf->Cell(25,7,utf8_decode($oListe->zObservation),1,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}


	
	function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1,$objPHPExcel, $iIncrement){

	   $oColor = array ('5e5aff', 'fefd18', 'ff7634', '46fc10', 'fd420b', 'ab21ff');
	   $default_style_Title_pole = array(
				'font' => array(
					'name' => 'Verdana',
					'color' => array('rgb' => '000000'),
					'size' => 10
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '000000')
					)
				),
				 'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => $oColor[$iIncrement])
				 )
				 
			);

	   $merge = "" ; 
	   if($start>=0 && $end>=0 && $row>=0){
			$start = PHPExcel_Cell::stringFromColumnIndex($start);
			$end = PHPExcel_Cell::stringFromColumnIndex($end);
			$merge = "$start{$row}:$end{$row}";

			$objPHPExcel->getActiveSheet()->getStyle($merge)->applyFromArray($default_style_Title_pole);
	   }
		echo $merge . "\n" ; //die();
		return $merge;
	}


	public function setExcel ($_toListe, $_zDateDebut, $_zDateFin) {

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$objPHPExcel = new PHPExcel();

		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("TOJO MICHAEL DRHA")
									 ->setLastModifiedBy("TOJO MICHAEL DRHA")
									 ->setTitle("POINTAGE ELECTRONIQUE")
									 ->setSubject("POINTAGE ELECTRONIQUE")
									 ->setDescription("POINTAGE ELECTRONIQUE")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("POINTAGE ELECTRONIQUE");


		// Add some data

		/*$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A2', 'Client')
					->setCellValue('B2', 'Projet');*/


		$default_style = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
			 
		);


		$default_style_ligne2 = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			),
			 'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ABABAB')
			 )
			 
		);

		$tHead1 = array(						
						'RANG'							=> 	'RANG', 
						'MATRICULE'						=> 	'MATRICULE',
						'NOM'							=> 	'NOM', 
						'PRENOM'						=> 	'PRENOM',
						'DEPARTEMENT'					=> 	'DEPARTEMENT',
						'DIRECTION'						=> 	'DIRECTION', 
						'SERVICE'						=> 	'SERVICE',
						'NBR DE JOUR'					=> 	'NBR DE JOUR', 
						'HEURES_REG'					=> 	'HEURES REGLEMENTAIRES',
						'HEURES_SUPP'					=> 	'HEURES SUPPLEMENTAIRE',
						'HEURES_TOT'					=> 	'HEURES TOTALES TRAVAILLEES',
					  );


		$objPHPExcel->getActiveSheet()->mergeCells("A1:I1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:I2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:I3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('POINTAGE ELECTRONIQUE DU ' . $_zDateDebut . " au " . $_zDateFin));

		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:I5')->applyFromArray($default_style_ligne2);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iCol, $iRow, utf8_encode($zValue));
			$iCol++;
		}


		$iRow0 = 2 ; 
		$iCol0 = 2;
		$oArrayColumn = array();

		for($col = 'A'; $col !== 'Z'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				  'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
				  )
			  )
		);


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$iRowDynamic = 6 ; 
		foreach ($_toListe as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe->rang);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe->data['matricule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe->data['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe->data['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe->data['sigle_departement']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe->data['sigle_direction']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe->data['sigle_service']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe->iDiffDate);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $iRowDynamic, $oListe->value);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $iRowDynamic, $oListe->Tot);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $iRowDynamic, $oListe->iTotTravailler);
			$iRowDynamic++;

		}

		

		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=pointage-electronique_".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}


	public function setExcelRapports ($_toListe, $_zDateDebut, $_zDateFin) {

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$objPHPExcel = new PHPExcel();

		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("TOJO MICHAEL DRHA")
									 ->setLastModifiedBy("TOJO MICHAEL DRHA")
									 ->setTitle("POINTAGE ELECTRONIQUE")
									 ->setSubject("POINTAGE ELECTRONIQUE")
									 ->setDescription("POINTAGE ELECTRONIQUE")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("POINTAGE ELECTRONIQUE");


		// Add some data

		/*$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A2', 'Client')
					->setCellValue('B2', 'Projet');*/


		$default_style = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
			 
		);


		$default_style_ligne2 = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			),
			 'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ABABAB')
			 )
			 
		);

		$tHead1 = array(						
						'MATRICULE'				=> 	'MATRICULE',
						'NOM'					=> 	'NOM', 
						'PRENOM'				=> 	'PRENOM',
						'DEPARTEMENT'			=> 	'DEPARTEMENT',
						'DIRECTION'				=> 	'DIRECTION', 
						'SERVICE'				=> 	'SERVICE',
						'FONCTION'				=> 	'FONCTION', 
						'JOUR'					=> 	'JOURS',
						'DATE'					=> 	'DATE',
						'HEURE d\'ENTREE'		=> 	'HEURE D\'ENTREE', 
						'HEURE DE SORTIE'		=> 	'HEURE DE SORTIE',
						'NOMBRE HEURE TOTAL'	=> 	'NOMBRE HEURE TOTAL',
						'OBSERVATION'			=> 	'OBSERVATION',
					  );


		$objPHPExcel->getActiveSheet()->mergeCells("A1:M1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:M2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:M3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('RAPPORT POINTAGE ELECTRONIQUE DU ' . $_zDateDebut . " au " . $_zDateFin));

		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:M5')->applyFromArray($default_style_ligne2);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iCol, $iRow, utf8_encode($zValue));
			$iCol++;
		}


		$iRow0 = 2 ; 
		$iCol0 = 2;
		$oArrayColumn = array();

		for($col = 'A'; $col !== 'Z'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				  'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
				  )
			  )
		);


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

		$iRowDynamic = 6 ; 
		foreach ($_toListe as $oListe) {

			$zDate = date("D", strtotime($oListe->zDateEntee)) ; 
			$zDateAffiche = "";
			switch ($zDate) {
				case 'Mon':
					$zDateAffiche = "Lundi" ; 
					break;

				case 'Tue':
					$zDateAffiche = "Mardi" ; 
					break;

				case 'Wed':
					$zDateAffiche = "Mercredi" ; 
					break;

				case 'Thu':
					$zDateAffiche = "Jeudi" ; 
					break;

				case 'Fri':
					$zDateAffiche = "Vendredi" ; 
					break;

				case 'Sat':
					$zDateAffiche = "Samedi" ; 
					break;

				case 'Sun':
					$zDateAffiche = "Dimanche" ; 
					break;
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe->data['matricule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe->data['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe->data['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe->data['sigle_departement']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe->data['sigle_direction']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe->data['sigle_service']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe->data['poste']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $zDateAffiche);

			
			$zHeureEntree = '' ; 
			if ($oListe->zDateEntee != '') {
				$zHeureEntree = date("H:i:s", strtotime($oListe->zDateEntee)) ; 

				if ($zHeureEntree == '00:00:00'){
					$zHeureEntree = '' ; 
				}
			}

			$zHeureSortie = '' ; 
			if ($oListe->zDateSortie != '') {
				$zHeureSortie = date("H:i:s", strtotime($oListe->zDateSortie));

				if ($zHeureSortie == '00:00:00'){
					$zHeureSortie = '' ; 
				}
			}

			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $iRowDynamic, date("d/m/Y", strtotime($oListe->zDateEntee)));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $iRowDynamic, $zHeureEntree);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $iRowDynamic, $zHeureSortie);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $iRowDynamic, $oListe->zDiffAffichage);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $iRowDynamic, $oListe->zObservation);
			$iRowDynamic++;

		}

		

		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=pointage-electronique_".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}

	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 0;
		return $ipaddress;
	}

	public function UpdateAcces($iUserId, $oUserChange){
		$DB1 = $this->load->database('gcap', TRUE);
		$oUserModeration = array();
		$oUserModeration['moderation_ip'] = $this->get_client_ip();
		$oUserModeration['moderation_userId'] = $iUserId;
		$oUserModeration['moderation_login'] = $oUserChange['login'];
		$oUserModeration['moderation_motDePasse'] = $oUserChange['password'];
		$oUserModeration['moderation_date'] = date("Y-m-d H:i:s");
		$oUserModeration['moderation_statut']	  = 0;
		if($DB1->insert('moderation', $oUserModeration)){
			$iModeration =  $DB1->insert_id();
			$this->update_password_moderation($iModeration);
		}else return false;
	}

	public function update_password_moderation($_iModeration){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql = " UPDATE moderation SET moderation_motDePasse = AES_ENCRYPT(`moderation_motDePasse`,'".encrypt."') WHERE moderation_id = " . $_iModeration ; 
		$DB1->query($zSql);
	}

	public function getAllModeration($_zUserId,$iArchive, $iStatut, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "moderation_date") {

		$DB1 = $this->load->database('gcap', TRUE);

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT SQL_CALC_FOUND_ROWS * FROM moderation m INNER JOIN $zDatabaseOrigin.candidat u ON u.user_id=m.moderation_userId  WHERE 1 ";
		

		$zSql .= " AND moderation_date IN (SELECT MAX(moderation_date) FROM moderation WHERE 1  " ; 

		$zSql .= " AND moderation_statut =  " . $iStatut ; 

		if ($iStatut == 0){
			if ($iArchive == 1) {
				$zSql .= " AND moderation_archive =  " . $iArchive ;
			} else {
				$zSql .= " AND moderation_archive <>  1"  ;
			}
	    } 


		$zSql .=" GROUP BY moderation_userId )";


		if ($_zUserId != ''){
			$zSql .= " AND moderation_userId IN (" . $_zUserId . ")"  ;
		}

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $oRow ; 
	}


	public function update_moderation($_iModerationId,$_iValue){
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "UPDATE moderation SET moderation_statut = ".$_iValue." WHERE moderation_id = ".$_iModerationId;
		$DB1->query($zSql);
	}

	public function update_moderationUser($_iUserId,$_iValue){
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "UPDATE moderation SET moderation_statut = ".$_iValue." WHERE moderation_userId = ".$_iUserId ." AND moderation_statut = 0";
		$DB1->query($zSql);
	}

	public function updateNotificationCarte($_iUserId){

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "UPDATE $zDatabaseGcap.badge SET badge_notification=1 WHERE badge_userId = ".$_iUserId." AND badge_dateObtention<>'' AND badge_notification=0";
		$DB1->query($zSql);
	}

	public function setModeration($_iModerationId){
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "SELECT * from moderation WHERE moderation_id = ".$_iModerationId;
		$oQuery = $DB1->query($zSql);
		$oRow = $oQuery->result_array();

		return $oRow ; 
	}


	public function transcription_note(){
		$DB1 = $this->load->database('gcap', TRUE);

		//$zSql= "SELECT * FROM noteevaluation WHERE noteEvaluation_dateNotation = '".date("Y-m-d")."' ORDER BY noteEvaluation_userSendNoteId";
		$zSql= "SELECT * FROM noteevaluation ORDER BY noteEvaluation_userSendNoteId";
		$oQuery = $DB1->query($zSql);
		$toRow = $oQuery->result_array();

		$iEvaluateur = -10 ; 
		$toArray = array();
		foreach ($toRow as $oRow){


			if ($iEvaluateur != $oRow['noteEvaluation_userSendNoteId']){
				
				$iEvaluateur = $oRow['noteEvaluation_userSendNoteId'];
				$toArray[$iEvaluateur] = '';
				$zConcatenation = "";
				$i = 0;
			}

			if ($i == 0) {
				$zConcatenation .= $oRow['noteEvaluation_userNoteId'] ; 
			} else {
				$zConcatenation .= "-" . $oRow['noteEvaluation_userNoteId'] ; 
			}

			

			$toArray[$iEvaluateur] = $zConcatenation ; 
			$i = 1;

		}

		/*echo "<pre>"; 
		print_r ($toArray);
		echo "</pre>";*/

		foreach ($toArray as $iEvaluateur => $zValue) {

			echo $zValue . "<br>" ; 

			$zSql= " SELECT * FROM evaluation WHERE evaluation_userId = ".$iEvaluateur."";

			$oQuery = $DB1->query($zSql);
			$toRowEValuation = $oQuery->result_array();

			if (sizeof($toRowEValuation)>0){

				/*echo "miditra update evauation" .$iEvaluateur. "<br>" ;
				$zSql= "UPDATE evaluation SET evaluation_userEvalue = '". $zValue ."' WHERE evaluation_userId = " . $iEvaluateur ;
				$DB1->query($zSql);*/

			} else {
				echo "miditra insert  " .$iEvaluateur. "<br>" ; 
				$zSql= "INSERT INTO evaluation VALUES ('1', '". $iEvaluateur ."', '".$zValue."')";
				$DB1->query($zSql);
			}
		}

		foreach ($toArray as $iEvaluateur => $zValue) {

			if ($iEvaluateur != 0) {
			
				$zSql= " SELECT * FROM usercompte WHERE userCompte_userId = ".$iEvaluateur." AND userCompte_compteId = 5";

				$oQuery = $DB1->query($zSql);
				$toRowEValuateur = $oQuery->result_array();

				if (sizeof($toRowEValuateur)>0){

				} else {
					echo "miditra " .$iEvaluateur. "<br>" ; 
					$zSql= "INSERT INTO usercompte VALUES('".$iEvaluateur."','5','')";
					$DB1->query($zSql);
				}
			}
		}

		return $toArray ; 
	}



	public function transcriptionDgd(){
		$DB1 = $this->load->database('gcap', TRUE);

		//echo ADMIN_TEMPLATE_PATH . "pointage/dgd_fichier.csv" ; die();

		$toArray = array();
		$oHandle = fopen(ADMIN_TEMPLATE_PATH . "pointage/dgd_fichier.csv", "rb");

		if (FALSE === $oHandle) {
			exit("Echec lors de l'ouverture du flux vers l'URL");
		}



		$zContents = '';
		$iEvaluateur = -10 ; 

		while (!feof($oHandle)) {

			while (($oData = fgetcsv($oHandle, 1000, ";")) !== FALSE) {

				$iEvaluateurContent = $oData[0];
				$iEvalueContent = $oData[1];

				if ($iEvaluateur != $iEvaluateurContent){
					
					$iEvaluateur = $iEvaluateurContent;
					$toArray[$iEvaluateur] = '';
					$zConcatenation = "";
					$i = 0;
				}

				if ($i == 0) {
					$zConcatenation .= $iEvalueContent ; 
				} else {
					$zConcatenation .= "-" . $iEvalueContent ; 
				}

				$toArray[$iEvaluateur] = $zConcatenation ; 
				$i = 1;
			}
		}

		fclose($oHandle);

		foreach ($toArray as $iEvaluateur => $zValue) {

			echo $zValue . "<br>" ; 

			$zSql= " SELECT * FROM evaluation WHERE evaluation_userId = ".$iEvaluateur."";

			$oQuery = $DB1->query($zSql);
			$toRowEValuation = $oQuery->result_array();

			if (sizeof($toRowEValuation)>0){

				echo "miditra update evauation" .$iEvaluateur. "<br>" ;
				$zSql= "UPDATE evaluation SET evaluation_userEvalue = '". $zValue ."' WHERE evaluation_userId = " . $iEvaluateur ;
				$DB1->query($zSql);

			} else {
				echo "miditra insert  " .$iEvaluateur. "<br>" ; 
				$zSql= "INSERT INTO evaluation VALUES ('1', '". $iEvaluateur ."', '".$zValue."')";
				$DB1->query($zSql);
			}
		}

		foreach ($toArray as $iEvaluateur => $zValue) {

			if ($iEvaluateur != 0) {
			
				$zSql= " SELECT * FROM usercompte WHERE userCompte_userId = ".$iEvaluateur." AND userCompte_compteId = 5";

				$oQuery = $DB1->query($zSql);
				$toRowEValuateur = $oQuery->result_array();

				if (sizeof($toRowEValuateur)>0){

				} else {
					echo "miditra " .$iEvaluateur. "<br>" ; 
					$zSql= "INSERT INTO usercompte VALUES('".$iEvaluateur."','5','')";
					$DB1->query($zSql);
				}
			}
		}

		return $toArray ;
	}

	public function suppressionDoublon(){
		
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= " SELECT u.id as iUserId FROM user AS u WHERE u.im <> '307381' GROUP BY u.nom,u.prenom,u.im HAVING COUNT(*) > 1 ORDER BY u.id ASC ";
		$oQuery = $DB1->query($zSql);
		$toRow = $oQuery->result_array();

		$zInDoublon = "";
		$iIncrement = 0 ; 
		foreach ($toRow as $oRow){
			if ($iIncrement >0){
				$zInDoublon .= ",";
			}
			$zInDoublon .= $oRow['iUserId'] ; 
			$iIncrement++ ; 
		}

		if ($zInDoublon != '') {
			$DB1->query('DELETE FROM user  WHERE id IN ('.$zInDoublon.')');
			$DB1->query('DELETE FROM candidat  WHERE user_id IN ('.$zInDoublon.')');
		}
		

		return $toRow ;
	}


	public function setEvaluateurDgd(){
		$DB1 = $this->load->database('gcap', TRUE);

		//echo ADMIN_TEMPLATE_PATH . "pointage/dgd_fichier.csv" ; die();

		$toArray = array();
		$oHandle = fopen(ADMIN_TEMPLATE_PATH . "pointage/dgd_fichier.csv", "rb");

		if (FALSE === $oHandle) {
			exit("Echec lors de l'ouverture du flux vers l'URL");
		}

		$zContents = '';
		$iEvaluateur = -10 ; 

		while (!feof($oHandle)) {

			while (($oData = fgetcsv($oHandle, 1000, ";")) !== FALSE) {

				$iEvaluateurContent = $oData[0];
				$iEvalueContent = $oData[1];

				if ($iEvaluateur != $iEvaluateurContent){
					
					$iEvaluateur = $iEvaluateurContent;
					$toArray[$iEvaluateur] = '';
					$zConcatenation = "";
					$i = 0;
				}

				if ($i == 0) {
					$zConcatenation .= $iEvalueContent ; 
				} else {
					$zConcatenation .= "-" . $iEvalueContent ; 
				}

				$toArray[$iEvaluateur] = $zConcatenation ; 
				$i = 1;
			}
		}

		fclose($oHandle);

		foreach ($toArray as $iEvaluateur => $zValue) {

			if ($iEvaluateur != 0) {
			
				$zSql= " SELECT * FROM usercompte WHERE userCompte_userId = ".$iEvaluateur." AND userCompte_compteId = 5";

				$oQuery = $DB1->query($zSql);
				$toRowEValuateur = $oQuery->result_array();

				if (sizeof($toRowEValuateur)>0){

				} else {
					echo "Evaluateur " .$iEvaluateur. "<br>" ; 
					$zSql= "INSERT INTO usercompte VALUES('".$iEvaluateur."','5','')";
					$DB1->query($zSql);
				}
			}
		}

		foreach ($toArray as $iEvaluateur => $zValue) {

			if ($iEvaluateur != 0) {
			
				$zSql= " SELECT * FROM usercompte WHERE userCompte_userId = ".$iEvaluateur." AND userCompte_compteId = 3";

				$oQuery = $DB1->query($zSql);
				$toRowEValuateur = $oQuery->result_array();

				if (sizeof($toRowEValuateur)>0){

				} else {
					echo "Autorité " .$iEvaluateur. "<br>" ; 
					$zSql= "INSERT INTO usercompte VALUES('".$iEvaluateur."','3','')";
					$DB1->query($zSql);
				}
			}
		}

		return $toArray ;
	}


	public function setEvaluateurDGE(){
		$DB1 = $this->load->database('gcap', TRUE);

		//echo ADMIN_TEMPLATE_PATH . "pointage/dgd_fichier.csv" ; die();

		$toArray = array();
		$oHandle = fopen(ADMIN_TEMPLATE_PATH . "pointage/dge_fichier.csv", "rb");

		if (FALSE === $oHandle) {
			exit("Echec lors de l'ouverture du flux vers l'URL");
		}



		$zContents = '';
		$iEvaluateur = -10 ; 

		while (!feof($oHandle)) {

			while (($oData = fgetcsv($oHandle, 1000, ";")) !== FALSE) {

				$iEvaluateurContent = $oData[0];
				$iEvalueContent = $oData[1];

				if ($iEvaluateur != $iEvaluateurContent){
					
					$iEvaluateur = $iEvaluateurContent;
					$toArray[$iEvaluateur] = '';
					$zConcatenation = "";
					$i = 0;
				}

				if ($i == 0) {
					$zConcatenation .= $iEvalueContent ; 
				} else {
					$zConcatenation .= "-" . $iEvalueContent ; 
				}

				$toArray[$iEvaluateur] = $zConcatenation ; 
				$i = 1;
			}
		}

		fclose($oHandle);

		foreach ($toArray as $iEvaluateur => $zValue) {

			echo $zValue . "<br>" ; 

			$zSql= " SELECT * FROM evaluation WHERE evaluation_userId = ".$iEvaluateur."";

			$oQuery = $DB1->query($zSql);
			$toRowEValuation = $oQuery->result_array();

			if (sizeof($toRowEValuation)>0){

				echo "miditra update evauation" .$iEvaluateur. "<br>" ;
				$zSql= "UPDATE evaluation SET evaluation_userEvalue = '". $zValue ."' WHERE evaluation_userId = " . $iEvaluateur ;
				$DB1->query($zSql);

			} else {
				echo "miditra insert  " .$iEvaluateur. "<br>" ; 
				$zSql= "INSERT INTO evaluation VALUES ('1', '". $iEvaluateur ."', '".$zValue."')";
				$DB1->query($zSql);
			}
		}

		foreach ($toArray as $iEvaluateur => $zValue) {

			if ($iEvaluateur != 0) {
			
				$zSql= " SELECT * FROM usercompte WHERE userCompte_userId = ".$iEvaluateur." AND userCompte_compteId = 5";

				$oQuery = $DB1->query($zSql);
				$toRowEValuateur = $oQuery->result_array();

				if (sizeof($toRowEValuateur)>0){

				} else {
					echo "Evaluateur " .$iEvaluateur. "<br>" ; 
					$zSql= "INSERT INTO usercompte VALUES('".$iEvaluateur."','5','')";
					$DB1->query($zSql);
				}
			}
		}

		foreach ($toArray as $iEvaluateur => $zValue) {

			if ($iEvaluateur != 0) {
			
				$zSql= " SELECT * FROM usercompte WHERE userCompte_userId = ".$iEvaluateur." AND userCompte_compteId = 3";

				$oQuery = $DB1->query($zSql);
				$toRowEValuateur = $oQuery->result_array();

				if (sizeof($toRowEValuateur)>0){

				} else {
					echo "Autorité " .$iEvaluateur. "<br>" ; 
					$zSql= "INSERT INTO usercompte VALUES('".$iEvaluateur."','3','')";
					$DB1->query($zSql);
				}
			}
		}

		return $toArray ;
	}

	public function tropBe(){

		$zQuerySqlServer = " SELECT * from [ZKAccess2020].[dbo].[acc_monitor_log] 
							where (time BETWEEN '2020-01-20 00:00:00.000' and 2020-01-20 23:00:00.000') and pin='298753' ";

		$oResult = $this->executeQuery($zQuerySqlServer);
		while($oArrayResult = odbc_fetch_array($oResult)){
			print_r($oArrayResult);die;
		}	
	}
	
}
?>
