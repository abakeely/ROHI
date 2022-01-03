<?php
/**
* @package ROHI
* @subpackage Evaluation
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Evaluation extends MY_Controller {

	/**  
	* Classe qui concerne accès
	* @package  ROHI  
	* @subpackage ACCES */ 

	public function __construct(){
		parent::__construct();
		$this->load->model('evaluation2_gcap_model','evaluation2');
		$this->sessionStartCompte();
	}

	
	/** 
	* information concenrnant l'utilisateur
	*
	* @param int $_iUserId identifiant de l'utilisateur
	* @return 
	*/
	public function getInfoUser($_iUserId){

		global $oSmarty ; 

		$oCandidat		= $this->Gcap->get_candidat_object($_iUserId);
		$iEvaluateur	= $this->postGetValue ("iEvaluateur",0) ;

		$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

		$zPathWithPhoto = base_url() . "assets/evaluation/images/no_image_user.png";
		if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
			$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
		} 

		$toMonth = array(
			 1 => 'Janvier',
			 2 => 'F&eacute;vrier',
			 3 => 'Mars',
			 4 => 'Avril',
			 5 => 'Mai',
			 6 => 'Juin',
			 7 => 'Juillet',
			 8 => 'Ao&ucirc;t',
			 9 => 'Septembre',
			10 => 'Octobre',
			11 => 'Novembre',
			12 => 'D&eacute;cembre'
		);

		$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($oCandidat[0]->user_id) ; 

		$oSmarty->assign("toMonth",$toMonth);
		$oSmarty->assign("zAnneeAffiche",'2016');
		$oSmarty->assign("zMoisAffiche",date("m"));
		$oSmarty->assign("oCandidat",$oCandidat);
		$oSmarty->assign("iEvaluateur",$iEvaluateur);
		$oSmarty->assign("oListeHistoriqueAgent",$oListeHistoriqueAgent);
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation/getInfoUser.tpl" );
		
		echo $zInfoUser ;  
	}

	/** 
	* historique de note d'un agent
	*
	* @param int $_iUserId identifiant de l'utilisateur
	* @return 
	*/
	public function getHistoriqueNoteAgent($_iUserId){

		global $oSmarty ;
		$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($_iUserId) ; 

		$toMonth = array(
			 1 => 'Janvier',
			 2 => 'F&eacute;vrier',
			 3 => 'Mars',
			 4 => 'Avril',
			 5 => 'Mai',
			 6 => 'Juin',
			 7 => 'Juillet',
			 8 => 'Ao&ucirc;t',
			 9 => 'Septembre',
			10 => 'Octobre',
			11 => 'Novembre',
			12 => 'D&eacute;cembre'
		);
		$oSmarty->assign("toMonth",$toMonth);
		$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation/getHistoriqueUser.tpl" );
		echo $zInfoUser ; 
	}

	/** 
	* Saisie manuel de note d'un agent
	*
	* @param int $_iUserSaisie identifiant de l'agent qui fait la saisie
	* @return 
	*/
	public function sendForSaisiManuel($_iUserSaisie){

		global $oSmarty ; 

		$iCin			= $this->postGetValue ("iCin",0) ;
		$iMatricule		= $this->postGetValue ("iMatricule",0) ;


		$oReturn = $this->evaluation->get_user_by_cin_Matricule_other($iCin,$iMatricule);

		if (sizeof($oReturn)>0){

			$oCandidat = $this->Gcap->get_candidat_object($oReturn[0]->user_id);

			$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

			$zPathWithPhoto = base_url() . "assets/evaluation/images/no_image_user.png";
			if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
				$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
			} 

			$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($oCandidat[0]->user_id) ; 

			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'F&eacute;vrier',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Ao&ucirc;t',
				 9 => 'Septembre',
				10 => 'Octobre',
				11 => 'Novembre',
				12 => 'D&eacute;cembre'
			);

			$iDepartementId = $oCandidat[0]->departement ;  
			$iDirectionId = $oCandidat[0]->direction;
			$iServiceId = $oCandidat[0]->service;


			$oDepartement = $this->Gcap->get_Organisation();
			$oDirection = array();
			if ($iDepartementId > 0) {
				$oDirection = $this->Gcap->get_Organisation($iDepartementId, 'direction', 1);
			}
			$oService = array();
			if ($iDirectionId > 0) {
				$oService = $this->Gcap->get_Organisation($iDirectionId, 'service', 2);
			}
			$oDivision = array();
			if ($iServiceId > 0) {
				$oDivision = $this->Gcap->get_Organisation($iServiceId, 'module', 3);
			}

			$oSmarty->assign("oDepartement",$oDepartement);
			$oSmarty->assign("oDirection",$oDirection);
			$oSmarty->assign("iUserSaisie",$_iUserSaisie);
			$oSmarty->assign("oService",$oService);
			$oSmarty->assign("oDivision",$oDivision);
			$oSmarty->assign("toMonth",$toMonth);
			$oSmarty->assign("zAnneeAffiche",'2016');
			$oSmarty->assign("zMoisAffiche",date("m"));
			$oSmarty->assign("oReturn",$oReturn);
			$oSmarty->assign("oCandidat",$oCandidat);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
			$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation/getInfoUserManuel.tpl" );
			echo $zInfoUser ; 
		} else {
			echo "<h1><strong>L'agent recherché n'est pas dans ROHI</strong></h1>" ; 
		}
		
		 
	}
	
	/** 
	* Saisie manuel de note d'un agent
	*
	* @param int $_iUserSaisie identifiant de l'agent qui fait la saisie
	* @return 
	*/
	public function getEvalueEvaluateur(){
		global $oSmarty;
		$oListeTableau = $this->evaluation->get_liste_evaluateur_evalue();
		//print_r($oListeTableau);
		
		$oSmarty->assign("oEvalue",$oListeTableau["oEvalueReturn"]);
		$oSmarty->assign("oEvaluateur",$oListeTableau["oEvaluateurReturn"]);
		$oSmarty->display(ADMIN_TEMPLATE_PATH . "evaluation/getEvalueEvaluateur.tpl");
	}
	
	/** 
	* liste agent statistique
	*
	* @return 
	*/
	public function getListAgentStat(){
		global $oSmarty;
		$oListeTableau = $this->evaluation->get_liste_evaluateur_evalue();
		$oEvaluateur = $oListeTableau["oEvaluateurReturn"];
		$toEvalue = $oListeTableau["oEvalueReturn"];
		
		$oEvalue = array();
		$iCond = 0;
			$iCondIntern = 0;
			$oEvalueStat = array();
			foreach($toEvalue[$iCond] as $zEvalue){
				
				$oEvalueStat[$iCondIntern]['iUserId'] = $zEvalue;
				$oEvalueStat[$iCondIntern]['oNote'] = $this->evaluation->get_liste_agent_stat((int)$zEvalue);
				$iCondIntern++;
			}
			$oEvalue[$iCond] = $oEvalueStat;
			
		
		highlight_string("<?php\n\$data =\n" . var_export($oEvalue, true) . ";\n?>");die();
		$oSmarty->assign("oEvalueStat",$oEvalueStat);
		$oSmarty->display(ADMIN_TEMPLATE_PATH . "evaluation/getStatNoteAgent.tpl");
	}

	/** 
	* portion statiqtique
	*
	* @return 
	*/
	public function getPortionStat($id = 0){
		global $oSmarty;
		$oListeTableau = $this->evaluation->get_liste_evaluateur_evalue();
		
		$oEvaluateur = $oListeTableau["oEvaluateurReturn"];
		$toEvalue = $oListeTableau["oEvalueReturn"];
		
		$iCondIntern = 0;
		$oEvalueStat = array();
		foreach($toEvalue[$id] as $zEvalue){
			
			$oEvalueStat[$iCondIntern]['iUserId'] = $zEvalue;
			$oEvalueStat[$iCondIntern]['oNote'] = $this->evaluation->get_liste_agent_stat((int)$zEvalue);
			$iCondIntern++;
		}

	//	print_r($oEvalueStat);die;
		
		/*highlight_string("<?php\n\$data =\n" . var_export($oEvalue, true) . ";\n?>");die();*/
		$oSmarty->assign("id",$id);
		$oSmarty->assign("oEvaluateur",$oEvaluateur);
		$oSmarty->assign("oEvalueStat",$oEvalueStat);
		$oSmarty->assign("zBasePath",base_url());
		if($id == 0){
			$oSmarty->display(ADMIN_TEMPLATE_PATH . "evaluation/getStatNoteAgent.tpl");
		}else{
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation/getPortionStat.tpl" );
			echo $zInfoUser ; 
		}
	}
	
	/** 
	* statistique evaluation par rapport à la periode
	*
	* @return 
	*/
	public function statEval(){
		global $oSmarty;
		
		$oRegion = $this->region->get_region();
		$oPeriodeTrait = $this->evaluation->getPeriode();
		$oPeriode = array();
		foreach($oPeriodeTrait as $toPeriodeTrait){
			$iPeriode = $toPeriodeTrait['periode_id'];
			$iTotal = (int)$this->evaluation->get_count_each_periode((int)$iPeriode);
			$oPeriode[$iPeriode]['iTotal'] = $iTotal;
			foreach($oRegion as $toRegion){
				$iTotalRegion = (int)$this->evaluation->get_count_by_region($toRegion['id'],(int)$iPeriode);
				$oPeriode[$iPeriode]['iTotalRegion'.$toRegion['id']] = $iTotalRegion;
				if($iTotal!=0)
					$oPeriode[$iPeriode]['iPourcentRegion'.$toRegion['id']] = number_format((($iTotalRegion/$iTotal)*100) ,2) ;
				else
					$oPeriode[$iPeriode]['iPourcentRegion'.$toRegion['id']] = 0;
			}
		}
		$oSmarty->assign("toRegion",$oRegion);
		$oSmarty->assign("oPeriode",$oPeriode);
		$oSmarty->display(ADMIN_TEMPLATE_PATH . "evaluation/statEval.tpl");
		
	}
	
	/** 
	* sendSearch
	*
	* @return 
	*/
	public function sendSearch(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCin			= $this->postGetValue ("iCin",0) ;
		$iMatricule		= $this->postGetValue ("iMatricule",0) ;

		$toCandidat = $this->evaluation->get_candidat_by_cin_or_matricule($iMatricule, $iCin);

		if (sizeof($toCandidat)>0) {

			$iUserId = 0;
			if (sizeof($toCandidat)>0){
				$iUserId = $toCandidat[0]['user_id'];
			}

			/* recherche déjà l'agent si déjà inclus dans votre liste */
			$tzListeEvalueUserConnecte = $this->evaluation2->get_ALL_Agents_evalues_par_user_id($oUser['id']);

			if($iUserId == $oUser["id"]) {

				$zReturn = "ne peut pas evaluer lui-même";
				$toReturn = array();
				$toReturn['user_id'] = -3;
				$toReturn['iUserId'] = $iUserId;
				$toReturn['zName']	 = $toCandidat[0]['nom'] . " " . $toCandidat[0]['prenom'] ;
				$toReturn['message'] = $zReturn;

			} else {

				/* recherche déjà l'agent si déjà inclus dans votre liste */
				$tzListeEvalueUserConnecte = $this->evaluation2->get_ALL_Agents_evalues_par_user_id($oUser['id']);

				if (in_array($iUserId, $tzListeEvalueUserConnecte)){
					
					$zReturn = "Agent déjà dans votre liste";
					$toReturn = array();
					$toReturn['user_id'] = -2;
					$toReturn['iUserId'] = $iUserId;
					$toReturn['zName']	 = $toCandidat[0]['nom'] . " " . $toCandidat[0]['prenom'] ;
					$toReturn['message'] = $zReturn;
				} else {

					$zReturn  = $this->evaluation->get_agents_deja_inclus($iUserId, $this) ;

					if ($zReturn != ""){
						$toReturn = array();
						$toReturn['user_id'] = 0;
						$toReturn['iUserId'] = $iUserId;
						$toReturn['zName']	 = $toCandidat[0]['nom'] . " " . $toCandidat[0]['prenom'] ;
						$toReturn['message'] = $zReturn;
					} else {
						$zUserSearch = $this->evaluation->get_agents_evalues_par_user_id() ;
						$toReturn = $this->evaluation->get_user_by_cin_Matricule($iCin,$iMatricule, $zUserSearch);
					}
				}
			}
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['iUserId'] = $iUserId;
				$toReturn['zName']	 = $toCandidat[0]['nom'] . " " . $toCandidat[0]['prenom'] ;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}

	/** 
	* compte Admin recherche agent
	*
	* @return 
	*/
	public function sendSearchAdmin(){

		$iCin			= $this->postGetValue ("iCin",0) ;
		$iMatricule		= $this->postGetValue ("iMatricule",0) ;

		$toCandidat = $this->evaluation->get_candidat_by_cin_or_matricule($iMatricule, $iCin);


		if (sizeof($toCandidat)>0) {
				$toReturn = $this->evaluation->get_user_by_cin_Matricule($iCin,$iMatricule, '');
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}



	public function notationUser(){

		global $oSmarty ; 

		$fFloatNoteOfUser				= $this->postGetValue ("fFloatNoteOfUser",'') ;
		$fFloatNotePonctualiteOfUser	= $this->postGetValue ("fFloatNotePonctualiteOfUser",'') ;
		$iNoteEvaluationUserSendNoteId	= $this->postGetValue ("noteEvaluation_userSendNoteId",'') ;
		$iUserANoteId					= $this->postGetValue ("userANoteId",'') ;
		$iMois							= $this->postGetValue ("iMois",'') ;
		$iAnnee							= $this->postGetValue ("iAnnee",'') ;
		$iValueEvaluable				= $this->postGetValue ("iValueEvaluable",1) ;
		
		$toListeNoteAgent = $this->evaluation->get_search_note_by_agent($iUserANoteId, (int)$iMois, (int)$iAnnee);
		
		$iReturn = 1;
		if (sizeof ($toListeNoteAgent)>0) {
			$iReturn = 0;
		} else {
			$oData = array();
			$oData["noteEvaluation_userSendNoteId"]		= $iNoteEvaluationUserSendNoteId ;
			$oData["noteEvaluation_userNoteId"]			= $iUserANoteId ;
			$oData["noteEvaluation_noteValue"]			= $fFloatNoteOfUser ;
			//$oData["noteEvaluation_notePonctualite"]	= $fFloatNotePonctualiteOfUser ;

			if ($fFloatNotePonctualiteOfUser != "") {
				$oData["noteEvaluation_notePonctualite"]	= $fFloatNotePonctualiteOfUser ;
			} else {

				if ($iValueEvaluable == 1) {
				
					$oCandidat = $this->Gcap->get_by_user_id($iUserANoteId);
					$zInMatriculeUser = $this->Transaction->getMatriculeAgent(1, $iUserANoteId, $oCandidat);
					$zDateDebut = "01/".$iMois."/".$iAnnee ; 
					$zDateFin = "31/".$iMois."/".$iAnnee ; 
					$iMoyenneUserInfoPointage11 = $this->Transaction->TempsDeTravailDunAgentAvecDenominateur($zInMatriculeUser, $zDateDebut, $zDateFin, $iDenominateur,$this);

					if ($iMoyenneUserInfoPointage11 != ''){
					
						//$iMoyenneUserInfoPointage = $iMoyenneUserInfoPointage, 2, '.', ''));
						$notFloor1 = floor($iMoyenneUserInfoPointage11);
						$notFloor = number_format($iMoyenneUserInfoPointage11, 2, '.', '');


						$iMoyenneUserInfoPointage = number_format($iMoyenneUserInfoPointage11, 2, ',','');


						$toMoyenneUserInfoPointage = explode(',', $iMoyenneUserInfoPointage) ; 

						$iAvantVirgule = $toMoyenneUserInfoPointage[0] ; 
						if ($toMoyenneUserInfoPointage[1] != "00"){

							if ($toMoyenneUserInfoPointage[1] <= 25) {
								$iMoyenneUserInfoPointage = $iAvantVirgule . ".25" ; 
							} elseif ($toMoyenneUserInfoPointage[1] > 25 && $toMoyenneUserInfoPointage[1] <=65) {
								$iMoyenneUserInfoPointage = $iAvantVirgule . ".50" ; 
							} elseif ($toMoyenneUserInfoPointage[1] > 65 && $toMoyenneUserInfoPointage[1] <=80) {
								$iMoyenneUserInfoPointage = $iAvantVirgule . ".75" ; 
							} elseif ($toMoyenneUserInfoPointage[1] > 80 && $toMoyenneUserInfoPointage[1] <=99) {
								$iAvantVirgule++ ; 
								$iMoyenneUserInfoPointage = $iAvantVirgule;
							} else {
								$iMoyenneUserInfoPointage = $iAvantVirgule;
								$iMoyenneUserInfoPointage = number_format($iMoyenneUserInfoPointage, 2, '.',''); 
							}
						} else {
							$iMoyenneUserInfoPointage = $iAvantVirgule ; 
						}

						$oData["noteEvaluation_notePonctualite"]	= $iMoyenneUserInfoPointage ;
						$oData["noteEvaluation_isPointage"]			= 1 ;
					}
				} 

			}

			
			$oData["noteEvaluation_dateNotation"]		= date("Y-m-d") ;
			$oData["noteEvaluation_moisNote"]			= (int)$iMois;
			$oData["noteEvaluation_anneeNote"]			= (int)$iAnnee;
			$oData["noteEvaluation_evaluable"]			= $iValueEvaluable ;
			$this->evaluation->insertNoteEvaluation($oData);
			$iReturn = 1;
		}
		
		echo $iReturn ; 
	}


	public function notationUserSaisiManuel($_iUserSaisie){

		global $oSmarty ; 

		$fFloatNoteOfUser				= $this->postGetValue ("fFloatNoteOfUser",'') ;
		$fFloatNotePonctualiteOfUser	= $this->postGetValue ("fFloatNotePonctualiteOfUser",'') ;
		$iNoteEvaluationUserSendNoteId	= $this->postGetValue ("noteEvaluation_userSendNoteId",'') ;
		$iUserANoteId					= $this->postGetValue ("userANoteId",0) ;
		$iMois							= $this->postGetValue ("iMois",0) ;
		$iAnnee							= $this->postGetValue ("iAnnee",0) ;

		$iDepartementId					= $this->postGetValue ("iDepartementId",0) ;
		$iDirectionId					= $this->postGetValue ("iDirectionId",0) ;
		$iServiceId						= $this->postGetValue ("iServiceId",0) ;
		$iDivisionId					= $this->postGetValue ("iDivisionId",0) ;
		$iValueEvaluable				= $this->postGetValue ("iValueEvaluable",1) ;

		$oCandidat = $this->Gcap->get_candidat_object($iUserANoteId);

		if (sizeof($oCandidat)> 0) {

			$iDepartementIdLast = $oCandidat[0]->departement ; 
			$iDirectionIdLast	= $oCandidat[0]->direction ; 
			$iServiceIdLast		= $oCandidat[0]->service ; 
			$iDivisionIdLast	= $oCandidat[0]->division ; 

			$iModif = 0;
			if ($iDepartementIdLast != $iDepartementId) {
				$iModif = 1;
			}

			if ($iDirectionIdLast != $iDirectionId) {
				$iModif = 1;
			}

			if ($iServiceIdLast != $iServiceId) {
				$iModif = 1;
			}

			if ($iDivisionIdLast != $iDivisionId) {
				$iModif = 1;
			}

			if ($iModif == 1){

				$oData = array();
				$oData["historiqueCandidat_userId"]			= $oCandidat[0]->user_id ;
				$oData["historiqueCandidat_date"]			= date("Y-m-d") ;
				$oData["historiqueCandidat_departemenId"]	= $iDepartementIdLast ;
				$oData["historiqueCandidat_directionId"]	= $iDirectionIdLast ;
				$oData["historiqueCandidat_serviceId"]		= $iServiceIdLast ; 
				$oData["historiqueCandidat_divisionId"]		= $iDivisionIdLast;
				$this->evaluation->insertHistoriqueLocalisationByNotation($oData);

				$oData = array();
				$oData['departement']	= $iDepartementId ; 
				$oData['direction']		= $iDirectionId ; 
				$oData['service']		= $iServiceId ; 
				$oData['division']		= $iDivisionId ; 
				$this->load->model('candidat_model','candidat');
				$this->candidat->update($oData, $oCandidat[0]->id) ;
				
			}


		}

		$toListeNoteAgent = $this->evaluation->get_search_note_by_agent($iUserANoteId, (int)$iMois, (int)$iAnnee);
		
		$iReturn = 1;
		if (sizeof ($toListeNoteAgent)>0) {
			$iReturn = 0;
		} else {
			$oData = array();
			$oData["noteEvaluation_userSendNoteId"]		= $iNoteEvaluationUserSendNoteId ;
			$oData["noteEvaluation_userNoteId"]			= $iUserANoteId ;
			$oData["noteEvaluation_noteValue"]			= $fFloatNoteOfUser ;

			if ($fFloatNotePonctualiteOfUser != "") {
				$oData["noteEvaluation_notePonctualite"]	= $fFloatNotePonctualiteOfUser ;
			} else {

				if ($iValueEvaluable == 1) {
				
					$oCandidat = $this->Gcap->get_by_user_id($iUserANoteId);
					$zInMatriculeUser = $this->Transaction->getMatriculeAgent(1, $iUserANoteId, $oCandidat);
					$zDateDebut = "01/".$iMois."/".$iAnnee ; 
					$zDateFin = "31/".$iMois."/".$iAnnee ; 
					$iMoyenneUserInfoPointage11 = $this->Transaction->TempsDeTravailDunAgentAvecDenominateur($zInMatriculeUser, $zDateDebut, $zDateFin, $iDenominateur,$this);

					if ($iMoyenneUserInfoPointage11 != ''){
					
						//$iMoyenneUserInfoPointage = $iMoyenneUserInfoPointage, 2, '.', ''));
						$notFloor1 = floor($iMoyenneUserInfoPointage11);
						$notFloor = number_format($iMoyenneUserInfoPointage11, 2, '.', '');

						$iMoyenneUserInfoPointage = number_format($iMoyenneUserInfoPointage11, 2, ',','');

						$toMoyenneUserInfoPointage = explode(',', $iMoyenneUserInfoPointage) ; 

						$iAvantVirgule = $toMoyenneUserInfoPointage[0] ; 
						if ($toMoyenneUserInfoPointage[1] != "00"){

							if ($toMoyenneUserInfoPointage[1] <= 25) {
								$iMoyenneUserInfoPointage = $iAvantVirgule . ".25" ; 
							} elseif ($toMoyenneUserInfoPointage[1] > 25 && $toMoyenneUserInfoPointage[1] <=65) {
								$iMoyenneUserInfoPointage = $iAvantVirgule . ".50" ; 
							} elseif ($toMoyenneUserInfoPointage[1] > 65 && $toMoyenneUserInfoPointage[1] <=80) {
								$iMoyenneUserInfoPointage = $iAvantVirgule . ".75" ; 
							} elseif ($toMoyenneUserInfoPointage[1] > 80 && $toMoyenneUserInfoPointage[1] <=99) {
								$iAvantVirgule++ ; 
								$iMoyenneUserInfoPointage = $iAvantVirgule;
							} else {
								$iMoyenneUserInfoPointage = $iAvantVirgule;
								$iMoyenneUserInfoPointage = number_format($iMoyenneUserInfoPointage, 2, '.',''); 
							}
						} else {
							$iMoyenneUserInfoPointage = $iAvantVirgule ; 
						}

						$oData["noteEvaluation_notePonctualite"]	= $iMoyenneUserInfoPointage ;
						$oData["noteEvaluation_isPointage"]			= 1 ;
					}
				} 

			}
			
			$oData["noteEvaluation_dateNotation"]		= date("Y-m-d") ;
			$oData["noteEvaluation_moisNote"]			= (int)$iMois;
			$oData["noteEvaluation_anneeNote"]			= (int)$iAnnee;
			$oData["noteEvaluation_evaluable"]			= $iValueEvaluable ;
			$oData["noteEvaluation_saisiUserId"]		= $_iUserSaisie ;
			$this->evaluation->insertNoteEvaluation($oData);
			$iReturn = 1;
		}
		
		echo $iReturn ; 
	}


	public function setCompte(){

		global $oSmarty ; 

		$iSend		= $this->postGetValue ("iSend",0) ;
		$iUserId	= $this->postGetValue ("iUserId",0) ;
		$iReturn = 0 ;

		switch ($iSend) {

			case '1' : 
				$oData = array();
				$oData["userCompte_userId"]			= $iUserId ;
				$oData["userCompte_compteId"]		= COMPTE_EVALUATEUR ;
				$this->UserCompte->insert($oData);
				$iReturn = 1 ;
				break;

			case '0' :
				$this->UserCompte->delete_compte_candidat_evaluateur($iUserId);
				$iReturn = 2 ;
				break;
		}
		
		echo $iReturn ; 
	}

	public function liste($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCurrPage=1, $_iUserId=0){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			switch ($_zHashUrl) {

				case 'agents-rattaches' :
					$oData['menu'] = 46;

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						case COMPTE_EVALUATEUR :
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							$this->load->model('decision_gcap_model','Decision');
							$iMatricule		= $this->postGetValue ("iMatricule",'') ;
							$iCin			= $this->postGetValue ("iCin",'') ;

							$iNbrTotal = 0;
							$toListe = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['iUserId'] = $_iUserId ; 
							$oData['iMatricule'] = $iMatricule ; 
							$oData['iCin'] = $iCin ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['zTitle'] = "Liste des agents rattachés" ;
							$this->load_my_view_Common('pointage/rattache.tpl',$oData, $iModuleId);
							break;
					}

					
					break;

				case 'evalues':

					if ($iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_ADMIN){

						$oData['zHashUrl'] = $_zHashUrl ; 
						$oData['zHashModule'] = $_zHashModule ;
						$oData['oCandidat'] = $oCandidat;

						$oUserEvaluateur = $this->Gcap->get_candidat_object($_iUserId);


						$iDepartementId = $this->postGetValue ("iDepartementId",0) ;
						$iDirectionId = $this->postGetValue ("iDirectionId",0) ;
						$iServiceId = $this->postGetValue ("iServiceId",0) ;
						$iDivisionId = $this->postGetValue ("iDivisionId",0) ;
						$zLocalite = $this->postGetValue ("zLocalite",'') ;

						$oData['oDataSearch']["iDepartementId"]	= $iDepartementId ;
						$oData['oDataSearch']["iDirectionId"]	= $iDirectionId ;
						$oData['oDataSearch']["iServiceId"]		= $iServiceId ;
						$oData['oDataSearch']["iDivisionId"]	= $iDivisionId ;
						$oData['oDataSearch']["zLocalite"]		= $zLocalite ;

						$oData['oDepartement'] = $this->Gcap->get_Organisation();
						$oData['oDirection'] = array();
						if ($iDepartementId > 0) {
							$oData['oDirection'] = $this->Gcap->get_Organisation($iDepartementId, 'direction', 1);
						}
						$oData['oService'] = array();
						if ($iDirectionId > 0) {
							$oData['oService'] = $this->Gcap->get_Organisation($iDirectionId, 'service', 2);
						}
						$oData['oDivision'] = array();
						if ($iServiceId > 0) {
							$oData['oDivision'] = $this->Gcap->get_Organisation($iServiceId, 'module', 3);
						}

						$iNbrTotal = 0;

						//$zInEvaluation = $this->evaluation->get_agents_evalues_par_user_id ($_iUserId);
						$zInEvaluation = $this->evaluation->get_agents_evalues_par_user_id ();


						$zInEvaluationUser = $this->evaluation->get_agents_evalues_par_user_id ($_iUserId);

						$zListeAgent = '';

						$toListeIn = $this->evaluation->get_all_User_rattache($oData['oDataSearch'],$oUser,$oCandidat, $oUser['id'], $iCompteActif, $_iUserId, $zInEvaluation,1);
						$toListeNotIn = $this->evaluation->get_all_User_rattache($oData['oDataSearch'],$oUser,$oCandidat, $oUser['id'], $iCompteActif, $_iUserId, $zInEvaluationUser,0);

						if (sizeof($toListeNotIn)>0){
							$toListeAgent = array();
							foreach($toListeNotIn as $oListeNotIn){
								array_push($toListeAgent, $oListeNotIn['user_id']);
							}

							$zListeAgent = implode("-", $toListeAgent);
						}
						
						$oData['oListeIn']	  = $toListeIn ; 
						$oData['zListeAgent'] = $zListeAgent ; 
						$oData['oListeNotIn'] = $toListeNotIn ; 
						$oData['oUserEvaluateur'] = $oUserEvaluateur;
						$oData['menu']   = 46;
						$oData['zTitle'] = "Liste des agents évalués" ;
						$this->load_my_view_Common('evaluation/evaluationListe.tpl',$oData, 9);

					} else {
						die("Vous n'avez pas accès à ce compte");
					}

					break;

				case 'a-evaluer':
					if ($iCompteActif == COMPTE_EVALUATEUR){
		
							$iMatricule	= $this->postGetValue ("iMatricule",'') ;
							$iCin	= $this->postGetValue ("iCin",'') ;

							$zInEvaluation = $this->evaluation->get_agents_evalues_par_user_id ($oUser['id']);

							$toListe = $this->evaluation->get_all_User_rattache($_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);

							$oData['user_id'] = $oUser['id'] ;
							$oData['oListe'] = $toListe ;
							$oData['menu']   = 45;
							$oData['iMatricule'] = $iMatricule ;
							$oData['iCin'] = $iCin ;
							$oData['zTitle'] = "Liste des agents à évaluer" ;
							$this->load_my_view_Common('evaluation/AgentListe.tpl',$oData, $iModuleId);
					} else {
						redirect("cv/index");
					}
					break;

				case 'global':
					if ($iCompteActif == COMPTE_AUTORITE){
		
							$iMatricule	= $this->postGetValue ("iMatricule",'') ;
							$iCin	= $this->postGetValue ("iCin",'') ;

							$iNbrTotal = 0;

							$this->load->model('decision_gcap_model','Decision');

							
							$toListe = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['iUserId'] = $_iUserId ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['menu']   = 47;
							$oData['iMatricule'] = $iMatricule ;
							$oData['iCin'] = $iCin ;
							$oData['zTitle'] = "Liste des agents globales" ;
							
							$this->load_my_view_Common('evaluation/AgentListeGlobal.tpl',$oData, $iModuleId);
					} else {
						redirect("cv/index");
					}
					break;

				case 'gestion-eval':

					if ($iCompteActif == COMPTE_ADMIN){

							$iMatricule	= $this->postGetValue ("iMatriculeSearch",'') ;
							$iCin		= $this->postGetValue ("iCinSearch",'') ;
							$iSearch	= $this->postGetValue ("iSearch",0) ;

							$toListeIn = array();
							$oUserProprietaire = array();
							$zListeAgent = "";
							if ($iSearch == 1) {

								$toCandidat = $this->evaluation->get_candidat_by_cin_or_matricule($iMatricule, $iCin);

								$zInEvaluation = $this->evaluation->get_agents_evalues_par_user_id ($toCandidat[0]['user_id']);

								$oUserProprietaire = $this->Gcap->get_candidat_object($toCandidat[0]['user_id']);

								$oCandidat = $this->Gcap->get_candidat($toCandidat[0]['user_id']);

								$zInEvaluationUser = $this->evaluation->get_agents_evalues_par_user_id ();

								$toListeIn = $this->evaluation->get_all_User_rattache($_oDataSearch=array(),$oUserProprietaire,$oCandidat, $toCandidat[0]['user_id'], $iCompteActif, $toCandidat[0]['user_id'], $zInEvaluationUser,1);

								$toListeNotIn = $this->evaluation->get_all_User_rattache($_oDataSearch=array(),$oUserProprietaire,$oCandidat, $toCandidat[0]['user_id'], $iCompteActif, $toCandidat[0]['user_id'], $zInEvaluation,0);
								$iNbrTotal = 0;
							} else {
								if ($_iUserId > 0) {

									$oCandidat = $this->Gcap->get_candidat($_iUserId);
									$oUserProprietaire = $this->Gcap->get_candidat_object($_iUserId);
									$zInEvaluation = $this->evaluation->get_agents_evalues_par_user_id ($_iUserId);
									$zInEvaluationUser = $this->evaluation->get_agents_evalues_par_user_id ();

									$toListeIn = $this->evaluation->get_all_User_rattache($_oDataSearch=array(),$oUserProprietaire,$oCandidat, $_iUserId, $iCompteActif, $_iUserId, $zInEvaluationUser,1);

									$toListeNotIn = $this->evaluation->get_all_User_rattache($_oDataSearch=array(),$oUserProprietaire,$oCandidat, $_iUserId, $iCompteActif, $_iUserId, $zInEvaluation,0);
									$iNbrTotal = 0;

									if ($oCandidat['matricule'] != 'ECD') {
										$iMatricule = $oCandidat['matricule'] ; 
									} else {
										$iCin = $oCandidat['cin'] ; 
									}

								}
							}

							if (sizeof($toListeNotIn)>0){
								$toListeAgent = array();
								foreach($toListeNotIn as $oListeNotIn){
									array_push($toListeAgent, $oListeNotIn['user_id']);
								}

								$zListeAgent = implode("-", $toListeAgent);
							}

							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['zListeAgent'] = $zListeAgent ; 
							$oData['iUserId'] = $_iUserId ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['oListeNotIn'] = $toListeNotIn ; 
							$oData['oListeIn']	  = $toListeIn ; 
							$oData['menu']   = 51;
							$oData['iMatriculeSearch'] = $iMatricule ;
							$oData['oUserEvaluateur'] = $oUserProprietaire;
							$oData['iCinSearch'] = $iCin ;
							$oData['iSearch'] = $iSearch ;
							$oData['zTitle'] = "évaluateur / évalué" ;
							
							$this->load_my_view_Common('evaluation/gestion-eval.tpl',$oData, $iModuleId);

					} else {
						redirect("cv/index");
					}
					break;

				case 'saisi':

					$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026','389671','307381','357208','355564','STG_SGRH','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {
		
							$oData['menu']   = 48;
							$iModuleId = -12;
							$oData['zTitle'] = "Saisie manuelle" ;
							$this->load_my_view_Common('evaluation/evaluationSaisiManuel.tpl',$oData, $iModuleId);
					} else {
						die(utf8_decode("Cette page est strictement reservée au personnel du DRHA. Si vous êtes évaluateur, veuillez sélectionner le compte évaluateur en haut et à côté de votre nom. Merci!"));
					}
					break;
			}

		} else {
			redirect("cv/index");
		}
    	
    }

	public function save()
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iCompteActif = $this->getSessionCompte();

			if ($iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_ADMIN){
				
				$iEvaluateurId	= $this->postGetValue ("iEvaluateurId",'') ;
				$zListeAgent	= $this->postGetValue ("zListeAgent",'') ;
				$iRedirectAdmin	= $this->postGetValue ("iRedirectAdmin",'') ;
				
				
				$oData = array();

				$zInEvaluation = $this->evaluation->get_agents_evalues_par_user_id ($iEvaluateurId);

				if ($zInEvaluation != ""){
					
					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userEvalue"]	= $zListeAgent ; 

					$this->evaluation->update_evaluation($oData, $iEvaluateurId);
				} else {

					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userId"]	= $iEvaluateurId ; 
					$oData["evaluation_userEvalue"]	= $zListeAgent ; 

					$this->evaluation->insert($oData);
				}

				if ($iRedirectAdmin != '') {
					redirect("evaluation/liste/agent-evaluation/gestion-eval/1/" . $iEvaluateurId);
				} else {
					redirect("evaluation/liste/agents/evalues/1/" . $iEvaluateurId);
				}
			}
			
    	
		} else {
			redirect("cv/index");
		}
	}



	public function isPointage(){
		
		
		$this->evaluation->isPointage();
	}

}