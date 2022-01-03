<?php
class Decision_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('decision', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function get_agents_evalues_par_user_id_taloha($_iUserEvaluateurId = 0) {
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


	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
			case COMPTE_SERVICE_ACCUIEL : 
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :

				$zUserId = $this->get_sous_ma_responsabilite($_oCandidat);
				
				break;

			case COMPTE_AUTORITE :

				$sqllist	=	"SELECT  t_structure_new.child_id
						FROM    (SELECT * FROM t_structure
								 ORDER BY parent_id, child_id) t_structure_new,
								(SELECT @pv := '".$_oCandidat[0]->structureId."') initialisation
						WHERE   FIND_IN_SET(parent_id, @pv)
						AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
						union
						select child_id from rohi.t_structure where child_id ='".$_oCandidat[0]->structureId."'
						";
				$query		=   $this->db->query($sqllist);
				$toList		=   $query->result_array();
				$tzLists	=	array() ;
				array_push($tzLists,"'".$_oCandidat[0]->structureId."'") ;
				foreach($toList as $oList){
					array_push($tzLists,"'".$oList["child_id"]."'") ;
				}
				$zList		=	implode(",",$tzLists);

				$zSql= "select *
						from rohi.candidat a
						inner join rohi.t_structure b
						on a.structureId = b.child_id
						where structureId in ($zList) 
						AND		sanction IN('0','00','34','40')
						LIMIT 0,1000
						   ";
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_EVALUATEUR :
				
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);
				
				break;

			case COMPTE_ADMIN :
				$zUserId = "" ; 
				$zNotIn = " AND user_id <> " . $_iUserId ; 
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
	
	
	public function getAllUserSubordonnees_taloha ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
			case COMPTE_SERVICE_ACCUIEL : 
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :

				if ($_oUser['serv'] != 0) {
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = ".$_oUser['serv']." " ; 
					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				} elseif ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				
				} elseif ($_oUser['dep'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = ".$_oUser['dep']." " ;

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				} else {
					
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.service=''" ;
					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				}
				

				if ((isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "")  ||  (isset($_POST["iCin"]) && $_POST["iCin"]!="")) {

					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 INNER JOIN $zDatabaseOrigin.departement s ON c12.departement = s.id
						WHERE 1= 1 " ;
					if( (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") ){
						" AND s.id  = (SELECT departement FROM $zDatabaseOrigin.candidat  WHERE matricule = ".$_POST["iMatricule"].")";
					}
					if( (isset($_POST["iCin"]) && $_POST["iCin"] != "") ){
						" AND s.id  = (SELECT departement FROM $zDatabaseOrigin.candidat  WHERE cin = ".$_POST["iCin"].")";
					}

					if ($_oUser['im'] == '350210' ||  $_oUser['im'] == '260011' ||  $_oUser['im'] == '389671' ||  $_oUser['im'] == '355857' ||  $_oUser['im'] == '355577') {
						$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14) " ;
					}
				}
				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				//$zSql  .= " AND detache=0 " ;

				//echo $zSql;
				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_AUTORITE :

				if ($_oCandidat[0]->service != '') {
			
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."'" ;
					
				} elseif ($_oCandidat[0]->direction != '') {

					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."'" ;
				} else {

					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."' " ;
				}


				if ($iAffiche == 0) {
					$zSql  .= " AND c12.user_id <> $_iUserId  " ;
				}


				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;

				$zSql  .= " AND detache=0 " ;


				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_EVALUATEUR :
				
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);
				
				break;

			case COMPTE_ADMIN :
				$zUserId = "" ; 
				$zNotIn = " AND user_id <> " . $_iUserId ; 
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
	
	
	public function get_all_decision($_zCandidat,$_oUser,$_oCandidat,$_iUserId, $_iCompteActif,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "decision_id"){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn);

		$zSql= "SELECT SQL_CALC_FOUND_ROWS *,REPLACE(cin,' ','') as cin FROM decision
				INNER JOIN type ON decision_typeId = type_id
				INNER JOIN statut ON  decision_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat ON user_id = decision_userId
				WHERE 1 ";
				//$zSql .= " AND decision_statutId IN (" . STATUT_CREATION .",".STATUT_RECEPTION_RESP_PERSONNEL.")";

		
		if ($_zCandidat != "")
		{
			$zSql .= " AND decision_userId IN ($_zCandidat) " ;

		} else {

			if ($zUserId != "") {
				$zSql .= " AND decision_userId IN ($zUserId) " ;
			}
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
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

		return $oRow;

	}



	public function get_all_User_rattache($oUser,$_oCandidat,$_iUserId, $_iCompteActif,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "ASC", $_zFieldOrder = "c.id"){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$iAffiche = 0;
		if ($_iCompteActif == COMPTE_AUTORITE  || $_iCompteActif == COMPTE_RESPONSABLE_PERSONNEL) {
			$iAffiche = 1;
		}

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,$iAffiche);

		$zSql= "SELECT SQL_CALC_FOUND_ROWS *,c.nom as nom,REPLACE(cin,' ','') as cin, c.prenom as prenom,c.id as id, d.libele as zDirection, s.libele as zService, m.libele as zDivision,c.user_id AS userId, IFNULL((select userCompte_compteId from usercompte WHERE userCompte_userId = userId AND userCompte_compteId = ".COMPTE_EVALUATEUR." LIMIT 0,1),0) as iCompte,
				(SELECT COUNT(decision_id) FROM decision WHERE decision_userId = userId AND decision_statutId = ".STATUT_CREATION.") As nbDecision
				FROM $zDatabaseOrigin.candidat c
				LEFT JOIN $zDatabaseOrigin.departement de ON de.id = c.departement
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
				LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division
				WHERE 1 ";

		if ($zUserId != ""){
			$zSql .= " AND user_id IN ($zUserId) " ;
		}
		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
		}
		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			$iCin  = $_POST["iCin"] ;  
			$zSql .= " AND cin = '" . $iCin . "'" ;
		}
		if ($zNotIn != ""){
			$zSql .= $zNotIn ;
		}

		$zSql .= " GROUP BY c.id " ;
		

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;
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

		return $oRow;

	}

	public function get_all_decision_extrant($_oUser,$_oCandidat,$_iUserId, $_iCompteActif,&$_iNbrTotal = 0,  $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "decision_id"){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn);


		$zSql= "SELECT SQL_CALC_FOUND_ROWS *, d.libele as zDirection, s.libele as zService,REPLACE(cin,' ','') as cin, m.libele as zDivision,c.user_id AS userId FROM decision
				INNER JOIN $zDatabaseOrigin.candidat c ON decision_userId = user_id
				INNER JOIN type ON decision_typeId = type_id
				INNER JOIN statut ON  decision_statutId = statut_id
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
				LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division
				WHERE 1
				AND decision_statutId >=1 ";

		if ($zUserId != "")
		{
			$zSql .= " AND decision_userId IN ($zUserId) " ;
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
		}


		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;

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

		return $oRow;

	}

	public function notification_validate_Decision($_oUser,$_oCandidat, $_iUserId, $_iSessionCompte){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iSessionCompte)
		{
			case COMPTE_AGENT : 
			case COMPTE_SERVICE_ACCUIEL : 
				$zSql= " SELECT COUNT(decision_id) as nb
				FROM decision WHERE decision_statutId > 2 AND decision_vue = 0 AND decision_userId = $_iUserId";
				break;
			
			case COMPTE_EVALUATEUR :
				$zUserId = $this->get_agents_evalues_par_user_id ($_oUser['id']);

				if ($zUserId != '') {
					$zSql= " SELECT COUNT(decision_id) as nb
					FROM decision WHERE decision_statutId =1 AND decision_userId IN ($zUserId)";
				} else {
					$zSql= " SELECT COUNT(decision_id) as nb
					FROM decision WHERE decision_statutId > 2 AND decision_vue = 0 AND decision_userId = $_iUserId";
				}
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :

				if ($_oUser['serv']!= '') {

						$zUserId  = "SELECT user_id FROM $zDatabaseOrigin.candidat c WHERE c.service = ".$_oUser['serv']." AND c.user_id <> $_iUserId " ; 

					} elseif ($_oUser['dir']!= '') {
						
						$zUserId  = "SELECT user_id FROM $zDatabaseOrigin.candidat c WHERE c.direction = ".$_oUser['dir']." AND c.user_id <> $_iUserId " ; 
					} elseif ($_oUser['dep']!= '') {

						$zUserId  = "SELECT user_id FROM $zDatabaseOrigin.candidat c WHERE c.departement = ".$_oUser['dep']." AND c.user_id <> $_iUserId " ;

					} else {
						
						if ($_oCandidat[0]->service!='') {
					
							/* même service */
							$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.service s ON c.service = s.id
								WHERE s.id  = (SELECT service FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
							
						} else {
							/* même direction */
							$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.direction d ON c.direction = d.id
								WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
						}
					}

					$zSql= "SELECT COUNT(decision_id) as nb
							FROM decision WHERE decision_statutId = ".STATUT_CREATION."  AND decision_userId IN ($zUserId) ";
					break;

			case COMPTE_AUTORITE :


					if ($_oCandidat[0]->service!='') {
				
						/* même service */
						$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.service s ON c.service = s.id
							WHERE s.id  = (SELECT service FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.")  AND c.user_id <> $_iUserId " ;
						
					} else {
						/* même direction */
						$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.direction d ON c.direction = d.id
							WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
					}
					

					$zSql= "SELECT COUNT(decision_id) as nb
							FROM decision WHERE decision_statutId IN (".STATUT_CREATION.",".STATUT_RECEPTION_RESP_PERSONNEL.")  AND decision_userId IN ($zUserId) ";


				break;

			case COMPTE_ADMIN :	
				 $zNotIn = " AND decision_userId <> " . $_iUserId ;
				 $zSql= "SELECT COUNT(decision_id) as nb
							FROM decision WHERE decision_statutId IN (".STATUT_CREATION.",".STATUT_RECEPTION_RESP_PERSONNEL.")";
				 if ($zNotIn != "")
				 {
					$zSql .= $zNotIn ;
				 }
				 break;
			
		}
		$zQuery = $DB1->query($zSql);

		$oResult = $zQuery->result_array(); 

		$iModuleId = 0 ; 
		if (sizeof($oResult)> 0)
		{
			$iModuleId = $oResult[0]['nb'] ; 
		}
		return $iModuleId;
	}

	public function delete_decision($_iDecisionId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('delete from decision where decision_id = '.$_iDecisionId);
	}

	public function _get_decision($iId = FALSE){
		
		$DB1 = $this->load->database('gcap', TRUE);

		if ($iId === FALSE)
		{
			$zQuery = $DB1->get('decision');
			return $zQuery->result_array();
		}

		$zQuery = $DB1->get_where('decision', array('decision_id' => $iId));
		return $zQuery->row_array();
	}

	public function get_decision($_iId)
	{

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select * from decision INNER JOIN type ON decision_typeId = type_id where decision_id = '$_iId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->row_array();
	}

	public function update_decision($oData, $_iDecisionId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('decision', $oData, "decision_id = $_iDecisionId");
	}

	public function setVue($_iDecisionId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "update decision SET decision_vue = 1 WHERE decision_id = " . $_iDecisionId;
		$DB1->query($zSql);
	}

	public function getDecisonValide($_iUserId, $_iTypeGcapDecision, $_iTest=0){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "select *,IFNULL((SELECT SUM(fraction_nbrJour)  FROM fraction
				WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId'),0) AS nbrJourCumule, 
				(decision_nbrJour -(IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId'),0))) AS reste
				FROM decision INNER JOIN type ON decision_typeId = type_id where decision_userId = '$_iUserId' AND decision_finalisation = 1 " ; 
					
		if ($_iTypeGcapDecision != 0) {	
			$zSql  .= " AND  decision_typeId = '$_iTypeGcapDecision' " ;
		}
				
		$zSql  .= " AND decision_statutId = ".STATUT_RECEPTION_AUTORITE."" ; 
		
		if ($_iTest == 0) {
			$zSql .= " HAVING nbrJourCumule < decision_nbrJour ";
		}

		$zSql .= " ORDER BY decision_annee ASC,decision_nbrJour DESC,decision_numero ASC";
			

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function setCongeAnnuelCumule($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "select (decision_nbrJour -(IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId'),0))) AS reste
				FROM decision INNER JOIN type ON decision_typeId = type_id where decision_userId = '$_iUserId' AND decision_finalisation = 1 " ; 
					
		$zSql  .= " AND  decision_typeId = ".DECISISON_CONGE_ANNUEL." " ;
				
		$zSql  .= " AND decision_statutId = ".STATUT_RECEPTION_AUTORITE."" ; 

		$zSql .= " ORDER BY decision_annee ";

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function getDecisonValideFractionGcap($_iUserId, $_iTypeGcapDecision, $_iTest=0){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "select *,IFNULL((SELECT SUM(fraction_nbrJour)  FROM fraction
				WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId'),0) AS nbrJourCumule, 
				(decision_nbrJour -(IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId'),0))) AS reste
				FROM decision 
				INNER JOIN type ON decision_typeId = type_id 
				INNER JOIN Fraction ON fraction_decisionId = decision_id
				INNER JOIN gcap ON gcap_id = fraction_congeId
				where decision_userId = '$_iUserId' AND decision_finalisation = 1 " ; 
					
		if ($_iTypeGcapDecision != 0) {	
			$zSql  .= " AND  decision_typeId = '$_iTypeGcapDecision' " ;
		}
				
		$zSql  .= " AND decision_statutId = ".STATUT_RECEPTION_AUTORITE."" ; 
		
		if ($_iTest == 0) {
			$zSql .= " HAVING nbrJourCumule < decision_nbrJour ";
		}

		$zSql .= " ORDER BY decision_annee ";

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	
	public function get_agents_evalues_par_user_id($_iUserEvaluateurId = 0) {
		$DB1 			= $this->load->database('gcap', TRUE);
		
		$sql			= " SELECT child_id FROM rohi.t_structure WHERE premier_responsable_id = '".$_iUserEvaluateurId."'	 ";
		
		$query 			= $this->db->query($sql);
		$toRow 			= $query->result_array();
		
		$structures 	=  array();
		foreach ($toRow as $oRow){
			$child_id 	= $oRow["child_id"];
			array_push($structures, $child_id);
		}
		
		$zReturn 		= 	"";
		
		if( sizeof($structures) > 0 ){
			$structureId	=	implode("," , $structures) ;
			$zSql			= " SELECT user_id 
								  FROM rohi.candidat 
								 WHERE structureId IN (".$structureId.")
								 AND sanction IN ('00','34','40')
								UNION
								SELECT user_id 
								  FROM rohi.candidat 
								 WHERE user_id IN ( SELECT premier_responsable_id FROM rohi.t_structure WHERE parent_id IN (".$structureId.") ) 
								  AND sanction IN ('00','34','40')
							  ";
			

			$zQuery 		= $DB1->query($zSql);
			$toRow1 		= $zQuery->result_array();
			$zQuery->free_result(); 
			
			
			$i				=	0;
			$toReturnAll 	= 	array();
			foreach ($toRow1 as $oRow){
				$user_id 	= $oRow["user_id"];
				array_push($toReturnAll, $user_id);
			}
			$zReturn = implode("," , $toReturnAll) ;
		}else{
			$zReturn		=	$_iUserEvaluateurId;
		}
		
		return $zReturn;
	}
	
	public function get_agents_mef() {
		$DB1 			= $this->load->database('gcap', TRUE);
	
		$zSql			= " SELECT user_id 
		                      FROM rohi.candidat 
							 WHERE  sanction IN ('00','34','40')
						  ";
		

		$zQuery 		= $DB1->query($zSql);
		$toRow1 		= $zQuery->result_array();
		$zQuery->free_result(); 
		
		$zReturn 		= 	"";
		$i				=	0;
		$toReturnAll 	= 	array();
		foreach ($toRow1 as $oRow){
			$user_id 	= $oRow["user_id"];
			array_push($toReturnAll, $user_id);
		}
		$zReturn = implode("," , $toReturnAll) ;
		
	
		return $zReturn;
	}
	
	public function get_sous_ma_responsabilite($_oCandidat) {
		
		$DB1 			= $this->load->database('gcap', TRUE);
		
		//testons si l'utilisateur a un compte RESPERS MAJUSCULE, le compte comporte comme AUTORITE
		
		$zSql  = "  SELECT userCompte_compteId 
		             FROM gcap.usercompte 
					WHERE userCompte_userId ='".$_oCandidat[0]->user_id."' 
					  AND userCompte_compteId ='12'
				" ;
				
		$zQuery				= $DB1->query($zSql);
		$oRowResult 		= $zQuery->row_array();
		$compte 			= $oRowResult['userCompte_compteId'];
		
		if($compte){
			//get structure parent_id
			
			$sqlparent			= " SELECT min(child_id) child_id 
			                          FROM rohi.t_structure 
									WHERE ( 
										respers_id ='".$_oCandidat[0]->user_id."'
										OR respers_id LIKE '%,".$_oCandidat[0]->user_id.",%' 
										OR  respers_id LIKE '".$_oCandidat[0]->user_id.",%' 
										OR respers_id LIKE '%,".$_oCandidat[0]->user_id."'
									)
								";
			//echo $sqlparent;die;
			$zQuery				= $DB1->query($sqlparent);
			$oRowResult 		= $zQuery->row_array();
			$parent_id 			= $oRowResult['child_id'];
		
			$sqllist			=" SELECT  t_structure_new.child_id
								     FROM    (SELECT * FROM rohi.t_structure
											 ORDER BY parent_id, child_id) t_structure_new,
											(SELECT @pv := '".$parent_id."') initialisation
								    WHERE   FIND_IN_SET(parent_id, @pv)
									  AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
									union
									select child_id from rohi.t_structure where child_id ='".$parent_id."'
								";
			
				$query		=   $this->db->query($sqllist);
				$toList		=   $query->result_array();
				$tzLists	=	array() ;
				array_push($tzLists,"'".$_oCandidat[0]->structureId."'") ;
				foreach($toList as $oList){
					array_push($tzLists,"'".$oList["child_id"]."'") ;
				}
				$zList		=	implode(",",$tzLists);

				$zSql= "SELECT *
						FROM rohi.candidat a
						inner join rohi.t_structure b
						on a.structureId = b.child_id
						where structureId in ($zList) 
						AND		sanction IN('0','00','34','40')
						";
		
		}else{
			$zSql			= " SELECT * 
			                  FROM rohi.candidat a
						     WHERE a.structureId IN ( SELECT child_id FROM rohi.t_structure 
						        WHERE (
								    respers_id ='".$_oCandidat[0]->user_id."'
									OR respers_id LIKE '%,".$_oCandidat[0]->user_id.",%' 
									OR  respers_id LIKE '".$_oCandidat[0]->user_id.",%' 
									OR respers_id LIKE '%,".$_oCandidat[0]->user_id."'
								)
						   ) 
						  AND a.sanction='00' 
				        ";
		}
	
		
		$zQuery 		= $DB1->query($zSql);
		$toRow1 		= $zQuery->result_array();
		$zQuery->free_result(); 
		
		$zReturn 		= 	"";
		$i				=	0;
		$toReturnAll 	= 	array();
		foreach ($toRow1 as $oRow){
			$user_id 	= $oRow["user_id"];
			array_push($toReturnAll, $user_id);
		}
		$zReturn = implode("," , $toReturnAll) ;
	
		return $zReturn;
	}
	
	
	
	
	public function get_agents_evalues_par_user_id_vavao($_iUserEvaluateurId = 0) {
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= " SELECT b.* 
				  FROM rohi.t_structure a
				  inner join rohi.candidat b
				  on a.child_id = b.structureId
				  WHERE (a.evaluateur_id ='".$_iUserEvaluateurId."' OR a.evaluateur_id LIKE '%,".$_iUserEvaluateurId.",%'  OR  a.evaluateur_id LIKE '".$_iUserEvaluateurId.",%'  OR a.evaluateur_id LIKE '%,".$_iUserEvaluateurId."')
				 union
				SELECT b.*
				  FROM rohi.t_structure a
				  inner join rohi.candidat b
				  on a.premier_responsable_id = b.user_id
				 where a.parent_id =(select structureId from rohi.candidat where user_id ='".$_iUserEvaluateurId."')
					" ;
		$zQuery		=	$DB1->query($zSql);
		$toRow		=	$zQuery->result_array();
		$zQuery->free_result(); 
		$zReturn	=	"";
		$toReturnAll=	array();
		if( sizeof($toRow) > 0){
			foreach ($toRow as $oRow){
				$user_id = $oRow["user_id"];
				array_push($toReturnAll, $user_id);
			}
			$zReturn .= implode (",", $toReturnAll);
		}else{
			$zReturn		=	$_iUserEvaluateurId;
		}
		return $zReturn;
	}
	
}
?>