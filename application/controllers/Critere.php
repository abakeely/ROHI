<?php
/**
* @package ROHI
* @subpackage Critere
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Critere extends MY_Controller {

	/**  
	* Classe qui concerne le critere evaluation
	* @package  ROHI  
	* @subpackage CRITERE */ 
	public function __construct(){
		parent::__construct();
		$this->load->model('evaluation2_gcap_model','evaluation2');
		$this->load->model('evaluation_gcap_model','evaluation');
		$this->load->model('localite_gcap_model','Localite');
		$this->sessionStartCompte();
	}

	/** 
	* Affichage des informations d'un agent pour être évaluer
	*
	* @param int $_iUserId identifiant de l'utilisateur
	* @return html
	*/
	public function getInfoUser($_iUserId){

		global $oSmarty ; 

		$oCandidat		= $this->Gcap->get_candidat_object($_iUserId);
		$iEvaluateur	= $this->postGetValue ("iEvaluateur",0) ;
		
		$iAnneeSelected = $this->postGetValue ("iAnneeSelected",0) ;
		$iMoisSelected = $this->postGetValue ("iMoisSelected",0) ;
		
		$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

		$zPathWithPhoto = base_url() . "assets/evaluation2/images/no_image_user.png";
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

		$toCritereCroup = $this->evaluation2->getCritereEtGroup(1);
		$toPeriode = $this->evaluation2->getPeriode();

		$oListeHistoriqueAgent = $this->evaluation2->get_note_all_agent($oCandidat[0]->user_id) ; 

		$oSmarty->assign("toMonth",$toMonth);
		//$oSmarty->assign("zAnneeAffiche",date("Y"));
		$oSmarty->assign("zAnneeAffiche","2017");
		$oSmarty->assign("zMoisAffiche",date("m"));
		$oSmarty->assign("toPeriode",$toPeriode);
		$oSmarty->assign("toCritereCroup",$toCritereCroup);
		$oSmarty->assign("oCandidat",$oCandidat);
		$oSmarty->assign("iEvaluateur",$iEvaluateur);
		$oSmarty->assign("oListeHistoriqueAgent",$oListeHistoriqueAgent);
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
		$oSmarty->assign("iAnneeSelected",$iAnneeSelected);
		$oSmarty->assign("iMoisSelected",$iMoisSelected);
		$oSmarty->clear_cache( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoUser.tpl" );
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoUser.tpl" );
		
		echo $zInfoUser ;  
	}

	/** 
	* Affichage des informations d'un agent avec localité de service
	*
	* @param int $_iUserId identifiant de l'utilisateur
	* @return html
	*/
	public function getInfoUserChangeLocalite($_iUserId) {
		global $oSmarty ; 

		$toLocalite = $this->Localite->getInfoChangeLocalite($_iUserId) ; 
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("toLocalite",$toLocalite);
		$zGetPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoChangeLocalite.tpl" );
		
		echo $zGetPorte ;  
	} 

	/** 
	* mise à jour photo dans ROHI
	* 
	* @return html
	*/
	public function updatePhotoCV(){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

				$zSujet = "ROHI : Mise à jour photo dans le CV de ROHI " ;
				
				if ($oUser["id"] == '11' || $oUser['id'] == '4430'){
					$toAgentSansPhoto = $this->Gcap->getUserSansPhotoSendMail();
					$iIncrement = 0;
					foreach ($toAgentSansPhoto as $oAgentSansPhoto){
						
						$zUrlScript = $this->addHash($oAgentSansPhoto['user_id']."----cv2/mon_cv----1");
						$zUrlScript = str_replace("+","__xxxx__",$zUrlScript);
						$oSmarty->assign('zBasePath', "http://rohi.mef.gov.mg:8088/ROHI/");
						$oSmarty->assign('zUrlCrypt', $zUrlScript);
						$oSmarty->assign('oAgentSansPhoto', $oAgentSansPhoto);
						$zBody = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/mailAgentSansPhoto.tpl" );

						echo $zBody;
						die();

						$iNotifEnvoi = 2;
						if ($iIncrement > 500){
							$iNotifEnvoi = 2;
						} 
						$this->sendMailAgentSansPhotoMailer($oAgentSansPhoto,$zSujet,$zBody,$iNotifEnvoi);
						
						echo utf8_decode("E-mail envoyé à : " . $oAgentSansPhoto['nom'] . " --- " . $iIncrement . " ----- Boucle : " . $iNotifEnvoi ."--\n\n <br>") ; 
						$iIncrement++;
						
					}	

				} else {
					die();
				}
			
    	
		} else {
			$this->mon_cv();
		}
	}
	
	/** 
	* envoie de mail au evaluateur
	* 
	* @return 
	*/
	public function __sendMailEvaluateur(){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

				$zSujet = "ROHI : Mise à jour photo dans le CV" ;
				
				if ($oUser["id"] == '11' || $oUser['id'] == '4430'){
					$toEvaluateurSend = $this->evaluation2->getUserEvaluateurSendMail();
					$iIncrement = 0;
					foreach ($toEvaluateurSend as $oEvaluateurSend){
					
						$oSmarty->assign('zBasePath', base_url());
						$oSmarty->assign('oEvaluateurSend', $oEvaluateurSend);
						$zBody = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/mailCv.tpl" );

						$iNotifEnvoi = 2;
						if ($iIncrement > 500){
							$iNotifEnvoi = 2;
						} 
						$this->sendMailEvaluateurMailer($oEvaluateurSend,$zSujet,$zBody,$iNotifEnvoi);
						
						echo utf8_decode("E-mail envoyé à : " . $oEvaluateurSend['nom'] . " --- " . $iIncrement . " ----- Boucle : " . $iNotifEnvoi ."--\n\n <br>") ; 
						$iIncrement++;

					}
					
					

				} else {
					die();
				}
			
    	
		} else {
			$this->mon_cv();
		}
	}


	/** 
	* envoie de mail au evaluateur
	* 
	* @return 
	*/
	public function sendMailEvaluateur(){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

				
				
				if ($oUser["id"] == '11' || $oUser['id'] == '4430'){
					
					$zSujet = "ROHI : Evaluation des agents du MEF pour le premier trimestre 2019" ;
					$toEvaluateurSend = $this->evaluation2->getUserEvaluateurSendMail();

					$oSmarty->assign('zBasePath', base_url());
					$oSmarty->assign('oEvaluateurSend', $oEvaluateurSend);
					$zBody = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/mailEvaluateur.tpl" );

					$this->sendMailEvaluateurMailer($toEvaluateurSend,$zSujet,$zBody);

				} else {
					die();
				}
			
    	
		} else {
			$this->mon_cv();
		}
	}


	/** 
	* affichage changement localité service évaluateur
	* 
	* @return 
	*/
	public function getChangeLocaliteEvaluateur() {
		global $oSmarty ; 


		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
	
		if($iRet == 1){	
			$zUserId = $this->evaluation2->get_agents_evalues_par_user_id ($oUser['id']);

			$toLocalite = array();
			if ($zUserId != ""){
				$toLocalite = $this->Localite->getInfoChangeLocaliteEvaluateur($zUserId) ; 
			}

			$zPhoto = $toLocalite[0]['id'] . "." . $toLocalite[0]['type_photo'] ; 

			$zPathWithPhoto = base_url() . "assets/evaluation2/images/no_image_user.png";
			if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
				$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
			} 
		
			$oSmarty->assign("zBasePath",base_url());
			$oSmarty->assign("toLocalite",$toLocalite);
			$oSmarty->assign("zPathWithPhoto",$zPathWithPhoto);
			$oSmarty->assign("iSize",sizeof($toLocalite)-1);
			$zGetPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoChangeLocaliteValide.tpl" );
		}
		
		
		echo $zGetPorte ;  
	} 

	/** 
	* affichage changement localité service responsable personnel
	* 
	* @return 
	*/
	public function getChangeLocaliteResPers() {
		global $oSmarty ; 


		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
	
		if($iRet == 1){	

			$iCompteActif = $this->getSessionCompte();
			$this->load->model('accueil_gcap_model','Accueil');
			$zUserId = $this->Accueil->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);

			$toLocalite = array();
			if ($zUserId != ""){
				$toLocalite = $this->Localite->getInfoChangeLocaliteEvaluateur($zUserId) ; 
			}

			$zGetPorte = "";
			if (sizeof ($toLocalite)>0){
				$zPhoto = $toLocalite[0]['id'] . "." . $toLocalite[0]['type_photo'] ; 

				$zPathWithPhoto = base_url() . "assets/evaluation2/images/no_image_user.png";
				if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
					$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
				} 
			
				$oSmarty->assign("zBasePath",base_url());
				$oSmarty->assign("toLocalite",$toLocalite);
				$oSmarty->assign("zPathWithPhoto",$zPathWithPhoto);
				$oSmarty->assign("iSize",sizeof($toLocalite));
				$zGetPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoChangeLocaliteValide.tpl" );
			}
		}
		
		
		echo $zGetPorte ;  
	} 


	/** 
	* affichage select localité de service
	* 
	* @return 
	*/
	public function getSelectLocaliteService() {
		global $oSmarty ; 

		$iUserId	= $this->postGetValue ("iUserId",0) ;
		
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

		$oSmartyDepartement = $oSmarty ; 
		$oSmartyDepartement->assign("oAssignation",$oDepartement);
		$oSmartyDepartement->assign("iName","iDepartementId");
		$oSmartyDepartement->assign("zLibelle","un département");
		$oSmartyDepartement->assign("concat","departement");
		$zReturnDepartement = $oSmartyDepartement->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getSelectDepartement.tpl" );

		$oSmartyDirection = $oSmarty ; 
		$oSmartyDirection->assign("oAssignation",$oDirection);
		$oSmartyDirection->assign("iName","iDirectionId");
		$oSmartyDirection->assign("zLibelle","une direction");
		$oSmartyDirection->assign("concat","direction");
		$zReturnDirection = $oSmartyDirection->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getSelectDirection.tpl" );

		$oSmartyService = $oSmarty ; 
		$oSmartyService->assign("oAssignation",$oService);
		$oSmartyService->assign("iName","iServiceId");
		$oSmartyService->assign("zLibelle","une service");
		$oSmartyDirection->assign("concat","service");
		$zReturnService = $oSmartyService->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getSelectService.tpl" );
		
		$toReturn = array();
		$toReturn['zReturnDepartement'] = $zReturnDepartement;
		$toReturn['zReturnDirection'] = $zReturnDirection;
		$toReturn['zReturnService'] = $zReturnService;


		echo json_encode($toReturn); 
	} 

	
	/** 
	* affichage liste des agents notés ou à noter
	* 
	* @return 
	*/
	public function getListeANoterOuDejaNoter() {
		global $oSmarty ; 

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModeId	= $this->postGetValue ("iModeId",0) ;
		$iPeriode	= $this->postGetValue ("iPeriode",0) ;
		$iAnnee		= $this->postGetValue ("iAnnee",0) ;
	
		if($iRet == 1){	
			
			$iCompteActif = $this->getSessionCompte();
			$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($oUser['id']);

			$toListe1 = $this->evaluation2->get_all_User_rattache($iPeriode,$iAnnee,1,$_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);
			$toListe2 = $this->evaluation2->get_all_User_rattache($iPeriode,$iAnnee,2,$_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);

			$toListe = array();
			switch ($iModeId) {
				case '1':
					$toListe = $toListe1;
					break;

				case '2':
					$toListe = $toListe2;
					break;
			}

			$iSpan1 = sizeof($toListe1);
			$iSpan2 = sizeof($toListe2);

			$oSmarty->assign("zBasePath",base_url());
			$oSmarty->assign("toListe",$toListe);
			$oSmarty->assign("iModeId",$iModeId);
			$oSmarty->assign("iSpan1",$iSpan1);
			$oSmarty->assign("iSpan2",$iSpan2);

			$zHtmlReturn = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getListeANoterOuDejaNoter.tpl" );

			$toReturn = array();
			$toReturn['zHtmlReturn'] = $zHtmlReturn;
			$toReturn['iSpan1'] = $iSpan1;
			$toReturn['iSpan2'] = $iSpan2;

			
			echo json_encode($toReturn); 
		}

	} 

	/** 
	* affichage recherche région, district, departement, direction, service
	* 
	* @return 
	*/
	public function organisation($_iType, $_iValue) {

		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iDistrictId	= $this->postGetValue ("iDistrictId",0) ;
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		if($iRet == 1){	
			switch($_iType){
				case 1:
					$zNomTable="region" ; 
					break;

				case 2:
					$zNomTable="district" ; 
					break;

				case 3:
					$zNomTable="departement" ; 
					break;

				case 4:
					$zNomTable="direction" ; 
					break;

				case 5:
					$zNomTable="service" ; 
					break;

				case 6:
					$zNomTable="module" ; 
					break;

			}
			$toListe = $this->evaluation2->get_Organisation($_iValue,$zNomTable, $_iType,$iDistrictId);
		}

		$oSmarty->assign("toListe",$toListe);
		$oSmarty->assign("iType",$_iType);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/portion_option.tpl" );
	
		echo $zSelect;
	}

	/** 
	* charge les informations d'un agent
	*
	* @param integer $_iUserId identifiant de l'utilisateur
	*
	* @return 
	*/
	public function getInfoChangeManuel($_iUserId) {
		global $oSmarty ; 

		$oReturn		= $this->Gcap->get_candidat_object($_iUserId);
		$iModeForChange	= $this->postGetValue ("iModeForChange",0) ;
		$iUserTarget	= $this->postGetValue ("iUserTarget",0) ;
		$zName			= $this->postGetValue ("zName",'') ;
		$zMessage		= $this->postGetValue ("zMessage",'') ;

		if (sizeof($oReturn)>0){

			$oCandidat = $this->Gcap->get_candidat_object($oReturn[0]->user_id);

			$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

			$zPathWithPhoto = base_url() . "assets/evaluation/images/no_image_user.png";
			if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
				$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
			} 


			$iDepartementId = $oCandidat[0]->departement ;  
			$iDirectionId = $oCandidat[0]->direction;
			$iServiceId = $oCandidat[0]->service;

			$this->load->model('province_model','Province');
			$toProvince = $this->Province->get_province_by_pays_id(1);

			$this->load->model('region_model','Region');
			$toRegion = $this->Region->get_region_by_province_id();

			$this->load->model('district_model','District');
			$toDistrict = $this->District->get_district_by_region_id();

			$this->load->model('departement_model','Departement');
			$oDepartement = $this->Departement->get_departement();

			$oData = array();


			$oData = $this->toLocaliteAgent($oData, $oCandidat[0],2);

			/*//oDepartement = $this->Gcap->get_Organisation();
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
			}*/

			$oSmarty->assign("toProvince",$toProvince);
			$oSmarty->assign("toRegion",$toRegion);
			$oSmarty->assign("toDistrict",$toDistrict);
			$oSmarty->assign("oDepartement",$oDepartement);
			$oSmarty->assign("oData",$oData);
			//$oSmarty->assign("oDirection",$oDirection);
			$oSmarty->assign("iUserId",$_iUserId);
			$oSmarty->assign("iModeForChange",$iModeForChange);
			$oSmarty->assign("iUserTarget",$iUserTarget);
			//$oSmarty->assign("oService",$oService);
			//$oSmarty->assign("oDivision",$oDivision);		
			$oSmarty->assign("oReturn",$oReturn);
			$oSmarty->assign("oCandidat",$oCandidat);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
			$oSmarty->assign("zName",$zName);
			$oSmarty->assign("zMessage",$zMessage);
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoUserChangeManuel.tpl" );
			echo $zInfoUser ; 
		} else {
			echo "<h1><strong>L'agent recherché n'est pas dans ROHI</strong></h1>" ; 
		}

	}

	/** 
	* chage l'historique des notes d'un agent
	*
	* @param integer $_iUserId identifiant de l'utilisateur
	*
	* @return 
	*/
	public function getHistoriqueNoteAgent($_iUserId){

		global $oSmarty ;
		$oListeHistoriqueAgent = $this->evaluation2->get_note_all_agent($_iUserId) ; 
		$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueUser.tpl" );
		echo $zInfoUser ; 
	}

	/** 
	* chage la recapitulation des critères et groupes
	*
	* @param integer $_iUserId identifiant de l'utilisateur
	*
	* @return 
	*/
	public function getRecapitulation(){

		global $oSmarty ;
		$toCritereCroup = $this->evaluation2->getCritereEtGroup(1);
		$oSmarty->assign("toCritereCroup",$toCritereCroup);
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getRecapitulation.tpl" );
		echo $zInfoUser ; 
	}

	/** 
	* chage les infos d'un utilisateur pour affichage manuel
	*
	* @param integer $_iUserSaisie identifiant de l'utilisateur
	*
	* @return 
	*/
	public function sendForSaisiManuel($_iUserSaisie){

		global $oSmarty ; 

		$iCin			= $this->postGetValue ("iCin",0) ;
		$iMatricule		= $this->postGetValue ("iMatricule",0) ;


		$oReturn = $this->evaluation2->get_user_by_cin_Matricule_other($iCin,$iMatricule);

		if (sizeof($oReturn)>0){

			$oCandidat = $this->Gcap->get_candidat_object($oReturn[0]->user_id);

			$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

			$zPathWithPhoto = base_url() . "assets/evaluation2/images/no_image_user.png";
			if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
				$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
			} 

			$toCritereCroup = $this->evaluation2->getCritereEtGroup(1);

			$oListeHistoriqueAgent = $this->evaluation2->get_note_all_agent($oCandidat[0]->user_id) ; 

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

			$toPeriode = $this->evaluation2->getPeriode();

			$oSmarty->assign("oDepartement",$oDepartement);
			$oSmarty->assign("toCritereCroup",$toCritereCroup);
			$oSmarty->assign("oDirection",$oDirection);
			$oSmarty->assign("iUserSaisie",$_iUserSaisie);
			$oSmarty->assign("oService",$oService);
			$oSmarty->assign("oDivision",$oDivision);
			$oSmarty->assign("toPeriode",$toPeriode);
			$oSmarty->assign("toMonth",$toMonth);
			$oSmarty->assign("zAnneeAffiche",date('Y'));
			$oSmarty->assign("zMoisAffiche",date("m"));
			$oSmarty->assign("oReturn",$oReturn);
			$oSmarty->assign("oCandidat",$oCandidat);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
			$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getInfoUserManuel.tpl" );
			echo $zInfoUser ; 
		} else {
			echo "<h1><strong>L'agent recherché n'est pas dans ROHI</strong></h1>" ; 
		}
	}

	/** 
	* envoi d'information pour recherche
	*
	* @return 
	*/
	public function sendSearch(){

		$iCin			= $this->postGetValue ("iCin",0) ;
		$iMatricule		= $this->postGetValue ("iMatricule",0) ;

		$toCandidat = $this->evaluation2->get_candidat_by_cin_or_matricule($iMatricule, $iCin);


		if (sizeof($toCandidat)>0) {

			$iUserId = 0;
			if (sizeof($toCandidat)>0){
				$iUserId = $toCandidat[0]['user_id'];
			}

			$zReturn  = $this->evaluation2->get_agents_deja_inclus($iUserId, $this) ;

			if ($zReturn != ""){
				$toReturn = array();
				$toReturn['user_id'] = 0;
				$toReturn['message'] = $zReturn;
			} else {
				$zUserSearch = $this->evaluation2->get_agents_evalues_par_user_id() ;
				$toReturn = $this->evaluation2->get_user_by_cin_Matricule($iCin,$iMatricule, $zUserSearch);
			}
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}

	/** 
	* chargement de critere
	*
	* @param integer $_iClassification 
	* @return 
	*/
	public function getClassification($_iClassification){

		global $oSmarty ; 

		$toCritereCroup = $this->evaluation2->getCritereEtGroup($_iClassification);

		$iUserANoteId = $this->postGetValue ("iUserANoteId",0) ;

		$oCandidat = $this->Gcap->get_by_user_id($iUserANoteId);
		$zInMatriculeUser = $this->Transaction->getMatriculeAgent(1, $iUserANoteId, $oCandidat);
		
		$iPeriode = $this->postGetValue ("iPeriode",0) ;
		$iAnneeSelected = $this->postGetValue ("iAnnee",0) ;
		if($iPeriode == 4 ){
			$iAnneeDeb = $iAnneeSelected;
			$iAnneeFin = $iAnneeSelected + 1;
		}else{
			$iAnneeDeb = $iAnneeSelected;
			$iAnneeFin = $iAnneeSelected;
		}
		
		/*$iMois = (int)date("m");

		if ($iMois <3 || $iMois==12){
			$iPeriode = 3;
			$iAnneeDeb = (int)date('Y')-1;
			$iAnneeFin = (int)date('Y')-1;
		}elseif ($iMois >= 3 && $iMois <6) {
			$iPeriode = 4;
			$iAnneeDeb = (int)date('Y')-1;
			$iAnneeFin = (int)date('Y');
		}elseif ($iMois >= 6 && $iMois <9) {
			$iPeriode = 1;
			$iAnneeDeb = (int)date('Y');
			$iAnneeFin = (int)date('Y');
		}elseif ($iMois >= 9 && $iMois <12) {
			$iPeriode = 2;
			$iAnneeDeb = (int)date('Y');
			$iAnneeFin = (int)date('Y');
		}*/
		

		$toPeriode = $this->evaluation2->getPeriode($iPeriode);

		foreach ($toPeriode as $oPeriode){
			$zDateDebut = "01/".$oPeriode->periode_debut."/".$iAnneeDeb ; 
			$zDateFin = "31/".$oPeriode->periode_fin."/".$iAnneeFin ; 
		}

		$iMoyenneUserInfoPointage11 = $this->Transaction->TempsDeTravailDunAgentAvecDenominateur($zInMatriculeUser, $zDateDebut, $zDateFin, $iDenominateur,$this,$iAnneeDeb);

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
		}
		
		
		//$iMoyenneUserInfoPointage = '' ; 

		$oSmarty->assign('oCandidat', $oCandidat);
		$oSmarty->assign('toCritereCroup', $toCritereCroup);
		$oSmarty->assign('iMoyenneUserInfoPointage', $iMoyenneUserInfoPointage);
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "evaluation2/getClassification.tpl" );

		$toRes         = array () ;
		$toRes["zInfoUser"]   = $zInfoUser;
		$toRes["iMoyenneUserInfoPointage"]   = $iMoyenneUserInfoPointage;
		
        $zToReturn = json_encode ($toRes) ;
		echo $zToReturn ; 
	}

	/** 
	* notation user
	*
	* @return 
	*/
	public function notationUser(){

		global $oSmarty ; 

		$zAllNote						= $this->postGetValue ("zAllNote",'') ;
		$fFloatNoteOfUser				= $this->postGetValue ("fFloatNoteOfUser",0) ;
		$iClassificationValue			= $this->postGetValue ("iClassificationValue",'') ;
		$iNoteEvaluationUserSendNoteId	= $this->postGetValue ("noteEvaluation_userSendNoteId",'') ;
		$iUserANoteId					= $this->postGetValue ("userANoteId",0) ;
		$iMois							= $this->postGetValue ("iMois",0) ;
		$iAnnee							= $this->postGetValue ("iAnnee",0) ;

		/*$iPeriode						= $this->postGetValue ("iPeriode",0) ;
		$iAnneeSelected					= $this->postGetValue ("iAnnee",0) ;*/

		$iValueEvaluable				= $this->postGetValue ("iValueEvaluable",1) ;

		$toListeNoteAgent = $this->evaluation2->get_search_note_by_agent($iUserANoteId, (int)$iMois, (int)$iAnnee);
		$oData = array();
		
		$iReturn = 1;
		if (sizeof ($toListeNoteAgent)>0) {
			$iReturn = 0;
		} else {
			
			$oData["noteEvaluation_userSendNoteId"]		= $iNoteEvaluationUserSendNoteId ;
			$oData["noteEvaluation_userNoteId"]			= $iUserANoteId ;
			

			$toAllNote = explode(";",$zAllNote) ; 

			$zNoteDefinitif = "" ; 
			foreach ($toAllNote as $oAllNote) {

				$toSeparator = explode ("-", $oAllNote) ;

				
							if ($toSeparator[0] == 7) {
											if ($toSeparator[1] != '') {
												$zNoteDefinitif .= $toSeparator[0] . "-" . $toSeparator[1] . ";";
											} else {

															if ($iValueEvaluable == 1) {
															
																$iNotePonctualiteAssign					= $this->postGetValue ("iNotePonctualiteAssign",0) ;

																if ($iNotePonctualiteAssign != ''){
																	$zNoteDefinitif .= $toSeparator[0] . "-" . $iNotePonctualiteAssign . ";";
																	$oData["noteEvaluation_isPointage"]			= 1 ;
																} else {
																	$zNoteDefinitif .= $toSeparator[0] . "-;";
																}
																
																/*/$oCandidat = $this->Gcap->get_by_user_id($iUserANoteId);
																$zInMatriculeUser = $this->Transaction->getMatriculeAgent(1, $iUserANoteId, $oCandidat);*/


																/*switch ($iMois){

																	case 3:
																		$iAnneeDeb = (int)date('Y');
																		$iAnneeFin = (int)date('Y');
																		break;

																	case 4:
																		$iAnneeDeb = (int)date('Y')-1;
																		$iAnneeFin = (int)date('Y');
																		break;

																	case 1:
																		$iAnneeDeb = (int)date('Y');
																		$iAnneeFin = (int)date('Y');
																		break;

																	case 2:
																		$iAnneeDeb = (int)date('Y');
																		$iAnneeFin = (int)date('Y');
																		break;
																}*/

																/*if($iPeriode == 4 ){
																	$iAnneeDeb = $iAnneeSelected;
																	$iAnneeFin = $iAnneeSelected + 1;
																}else{
																	$iAnneeDeb = $iAnneeSelected;
																	$iAnneeFin = $iAnneeSelected;
																}
															

																$toPeriode = $this->evaluation2->getPeriode($iPeriode);

																foreach ($toPeriode as $oPeriode){
																		$zDateDebut = "01/".$oPeriode->periode_debut."/".$iAnneeDeb ; 
																		$zDateFin = "31/".$oPeriode->periode_fin."/".$iAnneeFin ; 
																}
																
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

																							$zNoteDefinitif .= $toSeparator[0] . "-" . $iMoyenneUserInfoPointage . ";";
																							$oData["noteEvaluation_isPointage"]			= 1 ;
																						} else {

																							$zNoteDefinitif .= $toSeparator[0] . "-;";
																						}*/
															} 
											}

							} else {
								$zNoteDefinitif .= $oAllNote . ";" ; 
							}


			}
			
			$oData["noteEvaluation_NoteAll"]			= $zNoteDefinitif ;
			$oData["noteEvaluation_categorieId"]		= $iClassificationValue ;
			$oData["noteEvaluation_dateNotation"]		= date("Y-m-d") ;
			$oData["noteEvaluation_periodeId"]			= (int)$iMois;
			$oData["noteEvaluation_anneeNote"]			= (int)$iAnnee;
			$oData["noteEvaluation_evaluable"]			= $iValueEvaluable ;
			$oData["noteEvaluation_saisiUserId"]		= $_iUserSaisie ;
			$this->evaluation2->insertnoteevaluation2($oData);
			$iReturn = 1;
		}
		
		echo $iReturn ; 
	}


	public function notationUserSaisiManuel($_iUserSaisie){

		global $oSmarty ; 

		$zAllNote						= $this->postGetValue ("zAllNote",'') ;
		$fFloatNoteOfUser				= $this->postGetValue ("fFloatNoteOfUser",0) ;
		$iClassificationValue			= $this->postGetValue ("iClassificationValue",'') ;
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
				$this->evaluation2->insertHistoriqueLocalisationByNotation($oData);

				$oData = array();
				$oData['departement']	= $iDepartementId ; 
				$oData['direction']		= $iDirectionId ; 
				$oData['service']		= $iServiceId ; 
				$oData['division']		= $iDivisionId ; 
				$this->load->model('candidat_model','candidat');
				$this->candidat->update($oData, $oCandidat[0]->id) ;
				
			}


		}

		$toListeNoteAgent = $this->evaluation2->get_search_note_by_agent($iUserANoteId, (int)$iMois, (int)$iAnnee);
		$oData = array();
		
		$iReturn = 1;
		if (sizeof ($toListeNoteAgent)>0) {
			$iReturn = 0;
		} else {
			
			$oData["noteEvaluation_userSendNoteId"]		= $iNoteEvaluationUserSendNoteId ;
			$oData["noteEvaluation_userNoteId"]			= $iUserANoteId ;
			

			$toAllNote = explode(";",$zAllNote) ; 

			$zNoteDefinitif = "" ; 
			foreach ($toAllNote as $oAllNote) {

				$toSeparator = explode ("-", $oAllNote) ;

				
							if ($toSeparator[0] == 7) {
											if ($toSeparator[1] != '') {
												$zNoteDefinitif .= $toSeparator[0] . "-" . $toSeparator[1] . ";";
											} else {

															if ($iValueEvaluable == 1) {
															
																$oCandidat = $this->Gcap->get_by_user_id($iUserANoteId);
																$zInMatriculeUser = $this->Transaction->getMatriculeAgent(1, $iUserANoteId, $oCandidat);
																$toPeriode = $this->evaluation2->getPeriode($iMois);

																switch ($iMois){

																	case 3:
																		$iAnneeDeb = (int)date('Y');
																		$iAnneeFin = (int)date('Y');
																		break;

																	case 4:
																		$iAnneeDeb = (int)date('Y')-1;
																		$iAnneeFin = (int)date('Y');
																		break;

																	case 1:
																		$iAnneeDeb = (int)date('Y');
																		$iAnneeFin = (int)date('Y');
																		break;

																	case 2:
																		$iAnneeDeb = (int)date('Y');
																		$iAnneeFin = (int)date('Y');
																		break;
																}

																
																foreach ($toPeriode as $oPeriode){
																		$zDateDebut = "01/".$oPeriode->periode_debut."/".$iAnneeDeb ; 
																		$zDateFin = "31/".$oPeriode->periode_fin."/".$iAnneeFin ; 
																}

																

																$iMoyenneUserInfoPointage11 = $this->Transaction->TempsDeTravailDunAgentAvecDenominateur($zInMatriculeUser, $zDateDebut, $zDateFin, $iDenominateur,$this,$iAnneeDeb);

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

																							$zNoteDefinitif .= $toSeparator[0] . "-" . $iMoyenneUserInfoPointage . ";";
																							$oData["noteEvaluation_isPointage"]			= 1 ;
																						}
															} 
											}

							} else {
								$zNoteDefinitif .= $oAllNote . ";" ; 
							}


			}
			
			$oData["noteEvaluation_NoteAll"]			= $zNoteDefinitif ;
			$oData["noteEvaluation_categorieId"]		= $iClassificationValue ;
			$oData["noteEvaluation_dateNotation"]		= date("Y-m-d") ;
			$oData["noteEvaluation_periodeId"]			= (int)$iMois;
			$oData["noteEvaluation_anneeNote"]			= (int)$iAnnee;
			$oData["noteEvaluation_evaluable"]			= $iValueEvaluable ;
			$oData["noteEvaluation_saisiUserId"]		= $_iUserSaisie ;
			$this->evaluation2->insertnoteevaluation2($oData);
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

	/** 
	* Listing des notes
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @return view
	*/
	public function vosNotes($_zHashModule = FALSE, $_zHashUrl = FALSE){
    	
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
    	
		if($iRet == 1){	

    		$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($oCandidat[0]->user_id) ; 
			$oListeHistoriqueAgentNew = $this->evaluation2->get_note_all_agent($oCandidat[0]->user_id) ; 

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
			$oSmarty->assign("zBasePath",base_url());
			$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
			$zReturn = $oSmarty->fetch(ADMIN_TEMPLATE_PATH . "evaluation/getHistoriqueAgentAll.tpl");

			

			$oSmarty2 = $oSmarty ; 
			$oSmarty->assign("zBasePath",base_url());
			$oSmarty2->assign('oListeHistoriqueAgentNew', $oListeHistoriqueAgentNew);
			$zReturn2 = $oSmarty2->fetch(ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueAgentAll.tpl");

			$oData['menu'] = 50;
			$oData['zReturn'] = $zReturn ; 
			$oData['zReturn2'] = $zReturn2 ; 
			$oData['zTitle'] = "Vos notes d'évaluation" ;
			/*$oData['iModuleActif'] = -13;
			$oData['iMenuActif'] = -13;*/

	    	$this->load_my_view_Common('evaluation2/historique.tpl',$oData, $iModuleId);
	    	
    	}
    	
    }

	/** 
	* Listing des agents rattachés
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iCurrPage pagination
	* @param int $_iUserId identifiant de l'utilisateur
	* @return view
	*/
	public function liste($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCurrPage=1, $_iUserId=1){
		
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
							$iNbrTotal = 0;
							$toListe = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['iUserId'] = $_iUserId ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['zTitle'] = "Les agents rattachés" ;
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

						//$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($_iUserId);
						$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ();


						$zInEvaluationUser = $this->evaluation2->get_agents_evalues_par_user_id ($_iUserId);

						$zListeAgent = '';

						$toListeIn = $this->evaluation2->get_all_User_rattache(0,0,0,$oData['oDataSearch'],$oUser,$oCandidat, $oUser['id'], $iCompteActif, $_iUserId, $zInEvaluation,1);
						$toListeNotIn = $this->evaluation2->get_all_User_rattache(0,0,0,$oData['oDataSearch'],$oUser,$oCandidat, $oUser['id'], $iCompteActif, $_iUserId, $zInEvaluationUser,0);

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
						$oData['zTitle'] = "Liste des agents évalués" ;
						$oData['menu']   = 46;
						$this->load_my_view_Common('evaluation2/evaluationListe.tpl',$oData, 9);

					} else {
						die("Vous n'avez pas accès à ce compte");
					}

					break;

				case 'a-evaluer':

					switch ($iCompteActif){

						case COMPTE_AGENT :
							redirect("critere/vosNotes/agent-evaluation/notes");
							break;
						case COMPTE_EVALUATEUR:
							$iMatricule	= $this->postGetValue ("iMatricule",'') ;
							$iCin	= $this->postGetValue ("iCin",'') ;

							$toPeriode = $this->evaluation2->getPeriode();

							$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($oUser['id']);

							$toListe = $this->evaluation2->get_all_User_rattache($toPeriode[sizeof($toPeriode)-1]->periode_id,$toPeriode[sizeof($toPeriode)-1]->periode_annee,1,$_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);

							$toListe2 = $this->evaluation2->get_all_User_rattache($toPeriode[sizeof($toPeriode)-1]->periode_id,$toPeriode[sizeof($toPeriode)-1]->periode_annee,2,$_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);

							$zLibelle = $this->evaluation2->getPeriodeLibelle();

							$iSpan1 = sizeof($toListe);
							$iSpan2 = sizeof($toListe2);

							$zNotInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ();

							$toListeApprouver = $this->evaluation2->getNotificationEvaluateurDesevaluateur($oCandidat, $zNotInEvaluation, $oUser) ; 

							$toChangeLocalite = array();
							if ($zInEvaluation != ""){
								$toChangeLocalite = $this->Localite->getInfoChangeLocaliteEvaluateur($zInEvaluation) ; 
							}

							$oData['user_id'] = $oUser['id'] ;
							$oData['toPeriode'] = $toPeriode ;
							$oData['oListe'] = $toListe ;
							$oData['zAnneeAffiche'] = "2017" ; //date("Y");
							$oData['zLibelle'] = $zLibelle ;
							$oData['menu']   = 45;
							$oData['iUserId'] = $oUser['id']; 
							$oData['toListeApprouver'] = $toListeApprouver; 
							$oData['toChangeLocalite'] = $toChangeLocalite; 
							$oData['iMatricule'] = $iMatricule ;
							$oData['iCin'] = $iCin ;
							$oData['iCurrPage'] = $_iCurrPage ;
							$oData['iSpan1'] = $iSpan1 ;
							$oData['iSpan2'] = $iSpan2 ;
							$oData['zTitle'] = "Liste des agents à évaluer" ;
							
							$this->load_my_view_Common('evaluation2/AgentListe.tpl',$oData, $iModuleId);
							break;


						case COMPTE_AUTORITE:
						case COMPTE_ADMIN:
							redirect("critere/liste/agent-evaluation/agents-rattaches");
							break;

						default :
							redirect("cv/index");
					}
					
					break;

				case 'global':
					if ($iCompteActif == COMPTE_AUTORITE){
		
							$iMatricule	= $this->postGetValue ("iMatricule",'') ;
							$iCin	= $this->postGetValue ("iCin",'') ;

							$iNbrTotal = 0;

							$this->load->model('decision_gcap_model','Decision');
							
							$toListe = $this->Decision->get_all_User_rattache(1,$oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['oRand'] = rand() ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['iUserId'] = $oUser['id']; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['menu']   = 53;
							$oData['iMatricule'] = $iMatricule ;
							$oData['iCin'] = $iCin ;
							$oData['zTitle'] = "Liste des agents globales" ;
							
							$this->load_my_view_Common('evaluation2/AgentListeGlobal.tpl',$oData, $iModuleId);
					} else {
						redirect("cv/index");
					}
					break;

				case 'classification':

					$oData['menu']   = 53;
					if ($iCompteActif >= COMPTE_AUTORITE){
							$oData['zTitle'] = "Classification" ;
							$this->load_my_view_Common('evaluation2/classification.tpl',$oData, $iModuleId);
					} else {
						redirect("cv/index");
					}
					break;

				case 'saisi':

					$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026',' 332026','307381','357208','355564','STG_SGRH','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {
		
							$oData['menu']   = 48;
							$iModuleId = 11;
							$oData['zTitle'] = "Saisie manuelle des notes d'evaluation" ;
							$this->load_my_view_Common('evaluation2/evaluationSaisiManuel.tpl',$oData, $iModuleId);
					} else {
						die(utf8_decode("Cette page est strictement reservÃ©e au personnel du DRHA. Si vous Ãªtes Ã©valuateur, veuillez sÃ©lectionner le compte Ã©valuateur en haut et Ã  cÃ´tÃ© de votre nom. Merci!"));
					}
					break;

				

				case 'fiche-de-poste-cv-notes' :
					$oData['menu'] = 197;

					switch ($iCompteActif)
					{
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
						case COMPTE_RESPONSABLE_PERSONNEL :
							$this->load_my_view_Common('evaluation2/annuaire.tpl',$oData, 9);
							break;

						default:
							die("Vous n'avez pas accÃ¨s Ã  cette page ");
							break;
					}

					
					break;

				case 'notes':

					switch ($iCompteActif)
					{
						case COMPTE_SFAO :
							global $oSmarty ;
							$oUser = array();
							$oCandidat = array();
							$iRet = $this->check($oUser, $oCandidat);

							$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
							
							if($iRet == 1){	

								$oData = array();
								$oData['oUser'] = $oUser;
								$oData['oCandidat'] = $oCandidat;

								$iUserId		= $this->postGetValue ("iUserId",'') ;
								$iDebut			= $this->postGetValue ("iDebut",'') ;
								$iFin			= $this->postGetValue ("iFin",'') ;

								$oUser = $this->user->get_user($iUserId);
								$oCandidatUser = $this->candidat->get_by_user_id($iUserId);

								$oListeHistoriqueAgentNew = $this->evaluation2->get_note_all_agent_sfao($iUserId,$iDebut,$iFin);

								$oSmarty2 = $oSmarty ; 
								$oSmarty->assign("zBasePath",base_url());
								$oSmarty->assign("oUser",$oUser);
								$oSmarty->assign("oCandidatUser",$oCandidatUser);
								$oSmarty->assign("zSuite"," avant et/ou après la formation");
								$oSmarty2->assign('oListeHistoriqueAgentNew', $oListeHistoriqueAgentNew);
								$zReturn2 = $oSmarty2->fetch(ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueAgentAllSpec.tpl");

								$oData['menu'] = 50;
								$oData['zReturn'] = "" ; 
								$oData['zReturn2'] = $zReturn2 ; 
								$oData['zNom'] = $oCandidatUser[0]->nom ; 
								$oData['zPrenom'] = $oCandidatUser[0]->prenom ; 

								$this->load_my_view_Common('evaluation2/historiqueNote.tpl',$oData, $iModuleId);
								
							}
							break;
						
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
							global $oSmarty ;
							$oUser = array();
							$oCandidat = array();
							$iRet = $this->check($oUser, $oCandidat);
							$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
							if($iRet == 1){	
								$oData = array();
								$oData['oUser'] = $oUser;
								$oData['oCandidat'] = $oCandidat;
								$iUserId		= $this->postGetValue ("iUserId",'') ;
								$oUser = $this->user->get_user($iUserId);
								$oCandidatUser = $this->candidat->get_by_user_id($iUserId);
								$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($iUserId) ; 
								$oListeHistoriqueAgentNew = $this->evaluation2->get_note_all_agent($iUserId) ; 
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
								$oSmarty->assign("zBasePath",base_url());
								$oSmarty->assign("oUser",$oUser);
								$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
								$zReturn = $oSmarty->fetch(ADMIN_TEMPLATE_PATH . "evaluation/getHistoriqueAgentAll.tpl");
								$oSmarty2 = $oSmarty ; 
								$oSmarty->assign("zBasePath",base_url());
								$oSmarty->assign("oUser",$oUser);
								$oSmarty->assign("oCandidatUser",$oCandidatUser);
								$oSmarty->assign("zSuite","");
								$oSmarty2->assign('oListeHistoriqueAgentNew', $oListeHistoriqueAgentNew);
								$zReturn2 = $oSmarty2->fetch(ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueAgentAllSpec.tpl");
								$oData['menu'] = 50;
								$oData['zReturn'] = $zReturn ; 
								$oData['zReturn2'] = $zReturn2 ; 
								$oData['zNom'] = $oCandidatUser[0]->nom ; 
								$oData['zPrenom'] = $oCandidatUser[0]->prenom ; 
								$oData['zSuite'] = " " ; 
								$this->load_my_view_Common('evaluation2/historiqueNote.tpl',$oData, $iModuleId);
							}
							break;
					}
					break;
				case 'ajax':
						
						$this->load->model('fonctionsSelectGlobales', 'select');
						$iNombreTotal = 0;
						$zNotIn = "";
						
						$zUserId = $this->Gcap->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
						
						$toGetListe = $this->select->getSimpleListJoin($iNombreTotal,'candidat', "matricule, candidat.nom, prenom, cin,CONCAT(departement.libele,direction.libele) as localite",0,$zUserId);
						$oRequest = $_REQUEST;
						$oDataAssign = array();
						
						foreach ($toGetListe as $oGetListe){
							$oDataTemp=array(); 
							$oDataTemp[]	= $oGetListe->id;
							$oDataTemp[]	= $oGetListe->photo;
							$oDataTemp[]	= $oGetListe->matricule;
							$oDataTemp[]	= $oGetListe->cin;
							$oDataTemp[]	= utf8_encode($oGetListe->nom);
							$oDataTemp[]	= utf8_encode($oGetListe->prenom);
							$oDataTemp[]	= utf8_encode($oGetListe->localite);
							$oDataTemp[]	= $oGetListe->sanction;
							$zFicheDePoste	= '
							<div  class="form form-group">
							<input placeholder="Veuillez sélectionner une fiche de poste" type="text" iAgentId="'.$oGetListe->id.'" identifiant="'.$oGetListe->fichePoste_id.'" valeur="'.$oGetListe->fichePoste_intitule.'" class="dfpSelect2" id="iSearchFicheDePoste_'.$oGetListe->id.'" style="width:300px;font-size: 13px!important;" name="iSearchFicheDePoste_'.$oGetListe->id.'"><p>&nbsp;</p>
							<button class="btn btn-info dialog-link-fdp" style="display:block;" type="button" title="Fiche de poste" alt="Fiche de poste" iIdent="'.$oGetListe->user_id.'" iAgentId="'.$oGetListe->id.'">
								<i class="ace-icon la la-check bigger-110"></i>
								Valider ce fiche de poste
							</button>
							</div>';
							$oDataTemp[]	= $zFicheDePoste;
							$zAction		= "";
							if($oGetListe->fichePoste_id >0){
								$zAction  .= '<span id="manatsofoka_'.$oGetListe->id.'"><a href="#" class="dialog-view-fdp" title="Voir fiche de poste" alt="Voir fiche de poste" iAgentId="'.$oGetListe->user_id.'"><i style="font-size:22px;" class="ace-icon la la-search bigger-110"></i></a>&nbsp;&nbsp;&nbsp;</span>' ; 
							} else {
								$zAction  .= '<span id="manatsofoka_'.$oGetListe->id.'">&nbsp;&nbsp;&nbsp;</span>' ; 
							}

							$zAction  .= '<a href="'.base_url().'cv2/mon_cv?id='.$oGetListe->id.'" target="_blank" title="Voir CV" alt="Voir CV"><i style="font-size:22px;" class="la la-list-alt"></i></a>&nbsp;&nbsp;&nbsp;' ; 
							$zAction .= '<a href="#" class="dialog-view-note" iUserId='.$oGetListe->user_id.' title="Voir les notes" alt="Voir les notes"><i style="font-size:22px;" class="la la-file-text"></i></a>' ;
							$zAction = $zAction . '&nbsp;&nbsp;'. '<a href="'.base_url().'gcap/printBC/'.$oGetListe->id.'" target="_blank" title="Imprimer BC" alt="Imprimer BC"><i style="font-size:22px;" class="la la-print"></i></a>' ; 
							$zAction = $zAction . '&nbsp;&nbsp;'. '<a href="'.base_url().'gcap/printFicheRenseignement?id='.$this->addHash($oGetListe->id).'" target="_blank" title="Imprimer Fiche de renseignement" alt="Imprimer BC"><i style="font-size:22px;" class="la la-user"></i></a>' ; 
							$oDataTemp[]	= $zAction;
							$oDataAssign[]	= $oDataTemp;
						}

						$toJson	= array(
								"draw"            => intval( $oRequest['draw'] ),
								"recordsTotal"    => intval( $iNombreTotal ),
								"recordsFiltered" => intval( $iNombreTotal ),
								"data"            => $oDataAssign
						 );
						echo json_encode($toJson);

					break;
			}

		} else {
			redirect("cv/index");
		}
    	
    }
	
	/** 
	* Listing des agents rattachés
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iCurrPage pagination
	* @param int $_iUserId identifiant de l'utilisateur
	* @return view
	*/
	public function evaluationvaovao($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCurrPage=1, $_iUserId=1){
	
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
							$iNbrTotal = 0;
							$toListe = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['iUserId'] = $_iUserId ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['zTitle'] = "Les agents rattachés" ;
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

						//$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($_iUserId);
						$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ();


						$zInEvaluationUser = $this->evaluation2->get_agents_evalues_par_user_id ($_iUserId);

						$zListeAgent = '';

						$toListeIn = $this->evaluation2->get_all_User_rattache(0,0,0,$oData['oDataSearch'],$oUser,$oCandidat, $oUser['id'], $iCompteActif, $_iUserId, $zInEvaluation,1);
						$toListeNotIn = $this->evaluation2->get_all_User_rattache(0,0,0,$oData['oDataSearch'],$oUser,$oCandidat, $oUser['id'], $iCompteActif, $_iUserId, $zInEvaluationUser,0);

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
						$oData['zTitle'] = "Liste des agents évalués" ;
						$oData['menu']   = 46;
						$this->load_my_view_Common('evaluation2/evaluationListe.tpl',$oData, 9);

					} else {
						die("Vous n'avez pas accès à ce compte");
					}

					break;

				case 'a-evaluer':

					/*switch ($iCompteActif){

						case COMPTE_AGENT :
							redirect("critere/vosNotes/agent-evaluation/notes");
							break;
						case COMPTE_EVALUATEUR:
							$iMatricule	= $this->postGetValue ("iMatricule",'') ;
							$iCin	= $this->postGetValue ("iCin",'') ;

							$toPeriode = $this->evaluation2->getPeriode();

							$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($oUser['id']);

							$toListe = $this->evaluation2->get_all_User_rattache($toPeriode[sizeof($toPeriode)-1]->periode_id,$toPeriode[sizeof($toPeriode)-1]->periode_annee,1,$_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);

							$toListe2 = $this->evaluation2->get_all_User_rattache($toPeriode[sizeof($toPeriode)-1]->periode_id,$toPeriode[sizeof($toPeriode)-1]->periode_annee,2,$_oDataSearch=array(),$oUser,$oCandidat, $oUser['id'], $iCompteActif, $oUser['id'], $zInEvaluation,0);

							$zLibelle = $this->evaluation2->getPeriodeLibelle();

							$iSpan1 = sizeof($toListe);
							$iSpan2 = sizeof($toListe2);

							$zNotInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ();

							$toListeApprouver = $this->evaluation2->getNotificationEvaluateurDesevaluateur($oCandidat, $zNotInEvaluation, $oUser) ; 

							$toChangeLocalite = array();
							if ($zInEvaluation != ""){
								$toChangeLocalite = $this->Localite->getInfoChangeLocaliteEvaluateur($zInEvaluation) ; 
							}

							$oData['user_id'] = $oUser['id'] ;
							$oData['toPeriode'] = $toPeriode ;
							$oData['oListe'] = $toListe ;
							$oData['zAnneeAffiche'] = "2017" ; //date("Y");
							$oData['zLibelle'] = $zLibelle ;
							$oData['menu']   = 45;
							$oData['iUserId'] = $oUser['id']; 
							$oData['toListeApprouver'] = $toListeApprouver; 
							$oData['toChangeLocalite'] = $toChangeLocalite; 
							$oData['iMatricule'] = $iMatricule ;
							$oData['iCin'] = $iCin ;
							$oData['iCurrPage'] = $_iCurrPage ;
							$oData['iSpan1'] = $iSpan1 ;
							$oData['iSpan2'] = $iSpan2 ;
							$oData['zTitle'] = "Liste des agents à évaluer" ;
							
							$this->load_my_view_Common('evaluation2/AgentListe.tpl',$oData, $iModuleId);
							break;


						case COMPTE_AUTORITE:
						case COMPTE_ADMIN:
							redirect("critere/liste/agent-evaluation/agents-rattaches");
							break;

						default :
							redirect("cv/index");
					}*/
					$this->load_my_view_Common('eval/index.tpl',$oData, $iModuleId);
					break;

				case 'global':
					if ($iCompteActif == COMPTE_AUTORITE){
		
							$iMatricule	= $this->postGetValue ("iMatricule",'') ;
							$iCin	= $this->postGetValue ("iCin",'') ;

							$iNbrTotal = 0;

							$this->load->model('decision_gcap_model','Decision');
							
							$toListe = $this->Decision->get_all_User_rattache(1,$oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['oRand'] = rand() ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['iAfficheEvaluateur'] = 1 ; 
							$oData['iUserId'] = $oUser['id']; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['menu']   = 53;
							$oData['iMatricule'] = $iMatricule ;
							$oData['iCin'] = $iCin ;
							$oData['zTitle'] = "Liste des agents globales" ;
							
							$this->load_my_view_Common('evaluation2/AgentListeGlobal.tpl',$oData, $iModuleId);
					} else {
						redirect("cv/index");
					}
					break;

				case 'classification':

					$oData['menu']   = 53;
					if ($iCompteActif >= COMPTE_AUTORITE){
							$oData['zTitle'] = "Classification" ;
							$this->load_my_view_Common('evaluation2/classification.tpl',$oData, $iModuleId);
					} else {
						redirect("cv/index");
					}
					break;

				case 'saisi':

					$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026',' 332026','307381','357208','355564','STG_SGRH','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {
		
							$oData['menu']   = 48;
							$iModuleId = 11;
							$oData['zTitle'] = "Saisie manuelle des notes d'evaluation" ;
							$this->load_my_view_Common('evaluation2/evaluationSaisiManuel.tpl',$oData, $iModuleId);
					} else {
						die(utf8_decode("Cette page est strictement reservÃ©e au personnel du DRHA. Si vous Ãªtes Ã©valuateur, veuillez sÃ©lectionner le compte Ã©valuateur en haut et Ã  cÃ´tÃ© de votre nom. Merci!"));
					}
					break;

				

				case 'fiche-de-poste-cv-notes' :
					$oData['menu'] = 197;

					switch ($iCompteActif)
					{
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
						case COMPTE_RESPONSABLE_PERSONNEL :
							$this->load_my_view_Common('evaluation2/annuaire.tpl',$oData, 9);
							break;

						default:
							die("Vous n'avez pas accÃ¨s Ã  cette page ");
							break;
					}

					
					break;

				case 'notes':

					switch ($iCompteActif)
					{
						case COMPTE_SFAO :
							global $oSmarty ;
							$oUser = array();
							$oCandidat = array();
							$iRet = $this->check($oUser, $oCandidat);

							$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
							
							if($iRet == 1){	

								$oData = array();
								$oData['oUser'] = $oUser;
								$oData['oCandidat'] = $oCandidat;

								$iUserId		= $this->postGetValue ("iUserId",'') ;
								$iDebut			= $this->postGetValue ("iDebut",'') ;
								$iFin			= $this->postGetValue ("iFin",'') ;

								$oUser = $this->user->get_user($iUserId);
								$oCandidatUser = $this->candidat->get_by_user_id($iUserId);

								$oListeHistoriqueAgentNew = $this->evaluation2->get_note_all_agent_sfao($iUserId,$iDebut,$iFin);

								$oSmarty2 = $oSmarty ; 
								$oSmarty->assign("zBasePath",base_url());
								$oSmarty->assign("oUser",$oUser);
								$oSmarty->assign("oCandidatUser",$oCandidatUser);
								$oSmarty->assign("zSuite"," avant et/ou après la formation");
								$oSmarty2->assign('oListeHistoriqueAgentNew', $oListeHistoriqueAgentNew);
								$zReturn2 = $oSmarty2->fetch(ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueAgentAllSpec.tpl");

								$oData['menu'] = 50;
								$oData['zReturn'] = "" ; 
								$oData['zReturn2'] = $zReturn2 ; 
								$oData['zNom'] = $oCandidatUser[0]->nom ; 
								$oData['zPrenom'] = $oCandidatUser[0]->prenom ; 

								$this->load_my_view_Common('evaluation2/historiqueNote.tpl',$oData, $iModuleId);
								
							}
							break;
						
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
							global $oSmarty ;
							$oUser = array();
							$oCandidat = array();
							$iRet = $this->check($oUser, $oCandidat);
							$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
							if($iRet == 1){	
								$oData = array();
								$oData['oUser'] = $oUser;
								$oData['oCandidat'] = $oCandidat;
								$iUserId		= $this->postGetValue ("iUserId",'') ;
								$oUser = $this->user->get_user($iUserId);
								$oCandidatUser = $this->candidat->get_by_user_id($iUserId);
								$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($iUserId) ; 
								$oListeHistoriqueAgentNew = $this->evaluation2->get_note_all_agent($iUserId) ; 
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
								$oSmarty->assign("zBasePath",base_url());
								$oSmarty->assign("oUser",$oUser);
								$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
								$zReturn = $oSmarty->fetch(ADMIN_TEMPLATE_PATH . "evaluation/getHistoriqueAgentAll.tpl");
								$oSmarty2 = $oSmarty ; 
								$oSmarty->assign("zBasePath",base_url());
								$oSmarty->assign("oUser",$oUser);
								$oSmarty->assign("oCandidatUser",$oCandidatUser);
								$oSmarty->assign("zSuite","");
								$oSmarty2->assign('oListeHistoriqueAgentNew', $oListeHistoriqueAgentNew);
								$zReturn2 = $oSmarty2->fetch(ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueAgentAllSpec.tpl");
								$oData['menu'] = 50;
								$oData['zReturn'] = $zReturn ; 
								$oData['zReturn2'] = $zReturn2 ; 
								$oData['zNom'] = $oCandidatUser[0]->nom ; 
								$oData['zPrenom'] = $oCandidatUser[0]->prenom ; 
								$oData['zSuite'] = " " ; 
								$this->load_my_view_Common('evaluation2/historiqueNote.tpl',$oData, $iModuleId);
							}
							break;
					}
					break;
				case 'ajax':
						$this->load->model('fonctionsSelectGlobales', 'select');
						$iNombreTotal = 0;
						$zNotIn = "";
						$zUserId = $this->Gcap->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
						$toGetListe = $this->select->getSimpleListJoin($iNombreTotal,'candidat', "matricule, candidat.nom, prenom, cin,CONCAT(departement.libele,direction.libele) as localite",0,$zUserId);
						$oRequest = $_REQUEST;
						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							$oDataTemp=array(); 
							$oDataTemp[]	= $oGetListe->id;
							$oDataTemp[]	= $oGetListe->photo;
							$oDataTemp[]	= $oGetListe->matricule;
							$oDataTemp[]	= $oGetListe->cin;
							$oDataTemp[]	= $oGetListe->nom;
							$oDataTemp[]	= $oGetListe->prenom;
							$oDataTemp[]	= $oGetListe->localite;
							$oDataTemp[]	= $oGetListe->sanction;
							$zFicheDePoste	= '
							<div  class="form form-group">
							<input placeholder="Veuillez sélectionner une fiche de poste" type="text" iAgentId="'.$oGetListe->id.'" identifiant="'.$oGetListe->fichePoste_id.'" valeur="'.$oGetListe->fichePoste_intitule.'" class="dfpSelect2" id="iSearchFicheDePoste_'.$oGetListe->id.'" style="width:300px;font-size: 13px!important;" name="iSearchFicheDePoste_'.$oGetListe->id.'"><p>&nbsp;</p>
							<button class="btn btn-info dialog-link-fdp" style="display:block;" type="button" title="Fiche de poste" alt="Fiche de poste" iIdent="'.$oGetListe->user_id.'" iAgentId="'.$oGetListe->id.'">
								<i class="ace-icon la la-check bigger-110"></i>
								Valider ce fiche de poste
							</button>
							</div>';
							$oDataTemp[]	= $zFicheDePoste;
							$zAction		= "";
							if($oGetListe->fichePoste_id >0){
								$zAction  .= '<span id="manatsofoka_'.$oGetListe->id.'"><a href="#" class="dialog-view-fdp" title="Voir fiche de poste" alt="Voir fiche de poste" iAgentId="'.$oGetListe->user_id.'"><i style="font-size:22px;" class="ace-icon la la-search bigger-110"></i></a>&nbsp;&nbsp;&nbsp;</span>' ; 
							} else {
								$zAction  .= '<span id="manatsofoka_'.$oGetListe->id.'">&nbsp;&nbsp;&nbsp;</span>' ; 
							}

							$zAction  .= '<a href="'.base_url().'cv2/mon_cv?id='.$oGetListe->id.'" target="_blank" title="Voir CV" alt="Voir CV"><i style="font-size:22px;" class="la la-list-alt"></i></a>&nbsp;&nbsp;&nbsp;' ; 
							$zAction .= '<a href="#" class="dialog-view-note" iUserId='.$oGetListe->user_id.' title="Voir les notes" alt="Voir les notes"><i style="font-size:22px;" class="la la-file-text"></i></a>' ;
							$oDataTemp[]	= $zAction;
							$oDataAssign[]	= $oDataTemp;
						}

						$toJson	= array(
								"draw"            => intval( $oRequest['draw'] ),
								"recordsTotal"    => intval( $iNombreTotal ),
								"recordsFiltered" => intval( $iNombreTotal ),
								"data"            => $oDataAssign
						 );
						echo json_encode($toJson);

					break;
			}

		} else {
			redirect("cv/index");
		}
    	
    }

	/** 
	* Sauvegarde des notes
	*
	* @return 
	*/
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
				
				$oData = array();

				$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($iEvaluateurId);

				if ($zInEvaluation != ""){
					
					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userEvalue"]	= $zListeAgent ; 

					$this->evaluation2->update_evaluation($oData, $iEvaluateurId);
				} else {

					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userId"]	= $iEvaluateurId ; 
					$oData["evaluation_userEvalue"]	= $zListeAgent ; 

					$this->evaluation2->insert($oData);
				}

				redirect("evaluation2/liste/agents/evalues/1/" . $iEvaluateurId);
			}
			
    	
		} else {
			redirect("cv/index");
		}
	}

	/** 
	* Sauvegarde localité de service
	*
	* @return 
	*/
	public function saveLocaliteService()
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iUserId		= $this->postGetValue ("iUserId",0) ;
		$iType			= $this->postGetValue ("iType",0) ;
    	
		if($iRet == 1){	
	
			$toLocalite = $this->Localite->getInfoChangeLocalite($iUserId) ; 
			$oData = array();
			$oDataLocalite = array();
			foreach ($toLocalite as $oLocalite) {
			
				$oData['district_id']	= $oLocalite['localite_districtId'];
				$oData['region_id']		= $oLocalite['localite_regionId'];
				$oData['province_id']	= $oLocalite['localite_provinceId'];
				$oData['pays_id']		= $oLocalite['localite_paysId'];
				$oData['departement']	= $oLocalite['localite_departementId'];
				$oData['direction']		= $oLocalite['localite_directionId'];
				$oData['service']		= $oLocalite['localite_serviceId'];
				$oData['division']		= $oLocalite['localite_divisionId'];
				
				if ($iType != 0){
					if ($iType == 2){
						$this->Localite->update_Candidat($oData, $iUserId);
					}
				} else {
					$this->Localite->update_Candidat($oData, $iUserId);
				}

				if ($iType != 0){
					$oDataLocalite['localite_statut'] = $iType ; 
				} else {
					$oDataLocalite['localite_statut'] = 2 ; 
				}

				
				$this->Localite->update_localite($oDataLocalite, $iUserId);
				
			}
    	
		} else {
			redirect("cv/index");
		}
	}

	/** 
	* localité de service Evaluateur
	*
	* @return 
	*/
	public function saveLocaliteServiceEvaluateur()
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iUserId			= $this->postGetValue ("iUserId",0) ;
		$iProvinceId		= $this->postGetValue ("iProvinceId",0) ; 
		$iRegionId			= $this->postGetValue ("iRegionId",0) ; 
		$iDistrictId		= $this->postGetValue ("iDistrictId",0) ;
		$iDepartementId		= $this->postGetValue ("iDepartementId",0) ; 
		$iDirection			= $this->postGetValue ("iDirectionId",0) ; 
		$iService			= $this->postGetValue ("iServiceId",0) ;
		$iDivisionId		= $this->postGetValue ("iDivisionId",0) ;
		$iModeForChange		= $this->postGetValue ("iModeForChange",0) ;
    	
		if($iRet == 1){	
	
			$oData = array();
			$oData['province_id']	= $iProvinceId;
			$oData['region_id']		= $iRegionId;
			$oData['district_id']	= $iDistrictId;
			$oData['departement']	= $iDepartementId;

			$zDirection = "";
			$zService = "";

			$toDirection = array();
			$toService = array();

			for ($i=sizeof($_POST['iRattachement'])-1;$i>=0;$i--){

				$zValue = $_POST['iRattachement'][$i];
				$toExplode = explode("_",$zValue);
				switch($toExplode[0]){

					case "DIR":
						array_push($toDirection,$toExplode[1]);
						break;

					case "SER":
						array_push($toService,$toExplode[1]);
						break;

				}
			}
			$toDirection		=	array_unique($toDirection);
			$toService			=	array_unique($toService);

			$zDirection			=	implode("-",$toDirection);
			$zService			=	implode("-",$toService);

			$oData['direction']	= $zDirection;
			$oData['service']	= $zService;
			

			/*$oData['direction']		= $iDirection;
			$oData['service']		= $iService;*/
			$oData['division']		= $iDivisionId;
			
			$this->Localite->update_Candidat($oData, $iUserId);

			$oDataTransfert = array();
			$oDataTransfert['desevaluation_evaluateurId'] = $oUser['id'];
			$oDataTransfert['desevaluation_userId']		  = $iUserId;
			$oDataTransfert['desevaluation_date']		  = date("Y-m-d");
			$oDataTransfert['desevaluation_etat']		  = 1;
			$oDataTransfert['desevaluation_motifs']		  = $iModeForChange;
			$this->evaluation2->insertDesevaluation ($oDataTransfert);

			/* suppression Agent */
			switch ($iModeForChange){

				case '1':

					/* suppression d'un agent dans l'autre evaluateur */
					$toReturn = $this->evaluation2->get_ALL_Agents_evalues_par_user_id ($oUser['id']);

					$toReturnNew = array();

					foreach ($toReturn as $zUserId){

						if ($iUserId != $zUserId) {
							array_push($toReturnNew, $zUserId);
						}
					}

					$oDataEvaluation = array();
					if (sizeof($toReturnNew)>0) {
						$oDataEvaluation["evaluation_userAutoriteId"]	= $oUser['id'] ; 
						$oDataEvaluation["evaluation_userEvalue"]	= implode("-", $toReturnNew) ;
						
					} else {
						$oDataEvaluation = array();
						$oDataEvaluation["evaluation_userEvalue"]	= "" ; 
					}

					$this->evaluation2->update_evaluation($oDataEvaluation, $oUser['id']);
					
					/* fin */
					break;

				case '2':

					$iEvaluateurId	= $oUser['id'] ;
					$zListeAgent	= $iUserId ;
					
					$oData = array();

					if ($zListeAgent != '') {

						$toReturnLast = $this->evaluation2->get_ALL_Agents_evalues_par_user_id ($iEvaluateurId);

						$iTrouve = 0;

						foreach ($toReturnLast as $iReturnLast) {

							if ($iReturnLast == $zListeAgent){
								$iTrouve = 1;
							}
						}	

						if ($iTrouve == 0){
							array_push($toReturnLast, $zListeAgent);
						}

						$iReturn = $this->evaluation2->getEvaluateur($iEvaluateurId);

						$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
						$oData["evaluation_userEvalue"]	=  implode("-", $toReturnLast) ; 


						$iReturn = $this->evaluation2->getEvaluateur($iEvaluateurId);

						if ($iReturn == 1){
							$this->evaluation2->update_evaluation($oData, $iEvaluateurId);
						} else {
							$oData["evaluation_userId"]	= $iEvaluateurId ; 
							$this->evaluation2->insert($oData);
						}

						
					}
					break;
			}
    	
		} else {
			redirect("cv/index");
		}
	}

	/** 
	* Sauvegarde et mije à jour utilisateur
	*
	* @return 
	*/
	public function saveUpdateUser(){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iUserId			= $this->postGetValue ("iUserId",0) ;
		$iProvinceId		= $this->postGetValue ("iProvinceId",0) ; 
		$iRegionId			= $this->postGetValue ("iRegionId",0) ; 
		$iDistrictId		= $this->postGetValue ("iDistrictId",0) ;
		$iDepartementId		= $this->postGetValue ("iDepartementId",0) ; 
		$iDirection			= $this->postGetValue ("iDirectionId",0) ; 
		$iService			= $this->postGetValue ("iServiceId",0) ;
		$iDivisionId		= $this->postGetValue ("iDivisionId",0) ;
		$iModeForChange		= $this->postGetValue ("iModeForChange",0) ;
    	
		if($iRet == 1){	

			$iCompteActif = $this->getSessionCompte();

			if ($iCompteActif == COMPTE_EVALUATEUR){

				$oData = array();
				$oData['province_id']	= $iProvinceId;
				$oData['region_id']		= $iRegionId;
				$oData['district_id']	= $iDistrictId;
				$oData['departement']	= $iDepartementId;
				$oData['direction']		= $iDirection;
				$oData['service']		= $iService;
				$oData['division']		= $iDivisionId;
				
				$this->Localite->update_Candidat($oData, $iUserId);
				
				$iEvaluateurId	= $oUser['id'] ;
				$zListeAgent	= $this->postGetValue ("zListe",'') ;
				
				$oData = array();

				if ($zListeAgent != '') {

					$zInEvaluation = $this->evaluation2->get_agents_evalues_par_user_id ($iEvaluateurId);

					$zInEvaluation = str_replace(",","-",$zInEvaluation) ; 

					if ($zInEvaluation != ""){
						$zInEvaluation = $zInEvaluation."-".$zListeAgent ; 
					} else {
						$zInEvaluation = $zListeAgent ; 
					}

					$iReturn = $this->evaluation2->getEvaluateur($iEvaluateurId);

					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userEvalue"]	= $zInEvaluation ; 

					if ($iReturn == 1){
						$this->evaluation2->update_evaluation($oData, $iEvaluateurId);
					} else {
						$oData["evaluation_userId"]	= $iEvaluateurId ; 
						$this->evaluation2->insert($oData);
					}

					
				}
			}
    	
		} else {
			redirect("cv/index");
		}
	}
	
	/** 
	* Sauvegarde utilisateurs 
	*
	* @return 
	*/
	public function saveUpdateUserAndDropLastListeEvaluateur(){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iUserId			= $this->postGetValue ("iUserId",0) ;
		$iProvinceId		= $this->postGetValue ("iProvinceId",0) ; 
		$iRegionId			= $this->postGetValue ("iRegionId",0) ; 
		$iDistrictId		= $this->postGetValue ("iDistrictId",0) ;
		$iDepartementId		= $this->postGetValue ("iDepartementId",0) ; 
		$iDirection			= $this->postGetValue ("iDirectionId",0) ; 
		$iService			= $this->postGetValue ("iServiceId",0) ;
		$iDivisionId		= $this->postGetValue ("iDivisionId",0) ;
		$iModeForChange		= $this->postGetValue ("iModeForChange",0) ;
    	
		if($iRet == 1){	

			$iCompteActif = $this->getSessionCompte();

			if ($iCompteActif == COMPTE_EVALUATEUR){

				$oData = array();
				$oData['province_id']	= $iProvinceId;
				$oData['region_id']		= $iRegionId;
				$oData['district_id']	= $iDistrictId;
				$oData['departement']	= $iDepartementId;
				$oData['direction']		= $iDirection;
				$oData['service']		= $iService;
				$oData['division']		= $iDivisionId;
				
				$this->Localite->update_Candidat($oData, $iUserId);
				
				$iEvaluateurId	= $oUser['id'] ;
				$zListeAgent	= $this->postGetValue ("zListe",'') ;

				$oData = array();
				/* suppression d'un agent dans l'autre evaluateur */
				$iAutreEvaluateurId = $this->evaluation2->get_agents_deja_inclus2($iUserId);

				if ($iAutreEvaluateurId != ''){

					$toReturn = $this->evaluation2->get_ALL_Agents_evalues_par_user_id ($iAutreEvaluateurId);

					$toReturnNew = array();

					foreach ($toReturn as $zUserId){

						if ($iUserId != $zUserId) {
							array_push($toReturnNew, $zUserId);
						}
					}

					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userEvalue"]	= implode("-", $toReturnNew) ; 

					$this->evaluation2->update_evaluation($oData, $iAutreEvaluateurId);
				}
				/* fin */
				
				$oData = array();

				if ($iUserId != '') {

					$toReturnLast = $this->evaluation2->get_ALL_Agents_evalues_par_user_id ($iEvaluateurId);

					$iTrouve = 0;

					foreach ($toReturnLast as $iReturnLast) {

						if ($iReturnLast == $iAgentEvaluer){
							$iTrouve = 1;
						}
					}	

					if ($iTrouve == 0){
						array_push($toReturnLast, $iUserId);
					}


					$iReturn = $this->evaluation2->getEvaluateur($iEvaluateurId);

					$oData["evaluation_userAutoriteId"]	= $oUser['id'] ; 
					$oData["evaluation_userEvalue"]	=  implode("-", $toReturnLast) ; 

					if ($iReturn == 1){
						$this->evaluation2->update_evaluation($oData, $iEvaluateurId);
					} else {
						$oData["evaluation_userId"]	= $iEvaluateurId ; 
						$this->evaluation2->insert($oData);
					}

					
				}
			}
    	
		} else {
			redirect("cv/index");
		}
	}

	/** 
	* permet d'avoir les evaluateurs
	*
	* @return 
	*/
	public function isEvaluateurAll(){
		$this->evaluation2->getEvaluateurAll();
	}

	/** 
	* recherche doublon
	*
	* @param integer $_iUserId
	*
	* @return 
	*/
	public function rechecheDoublon($_iUserId){
		$zReturn = $this->evaluation2->rechercheDoublon($_iUserId,$this);
	}
	
	/** 
	* permet d'avoir les agents ayant un pointage
	*
	* @return 
	*/
	public function isPointage(){
		$this->evaluation2->isPointage();
	}

	/** 
	* export
	*
	* @return 
	*/
	public function export(){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			if ($oUser['im']=='307381' || $oUser['im']==' 332026' || $oUser['im']=='332026' || $oUser['im']=='355577'){
				$this->evaluation2->setExcelRapports() ; 
			}
		}
	}

}