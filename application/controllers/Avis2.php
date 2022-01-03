<?php
/**
* @package ROHI
* @subpackage Avis
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Avis2 extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('compte_gcap_model','Compte');
		$this->load->model('decision_gcap_model','Decision');
		$this->load->model('etatcompte_gcap_model','EtatCompte');
		$this->load->model('fluxdecision_gcap_model','FluxDecision');
		$this->load->model('gcap_gcap_model','Gcap');
		$this->load->model('module_gcap_model','module');
		$this->load->model('modulepage_gcap_model','modulePage');
		$this->load->model('page_gcap_model','Page');
		$this->load->model('privilege_gcap_model','Privilege');
		$this->load->model('signataire_gcap_model','Signataire');
		$this->load->model('statut_gcap_model','Statut');
		$this->load->model('statutdecision_gcap_model','StatutDecision');
		$this->load->model('type_gcap_model','Type');
		$this->load->model('typegcap_gcap_model','TypeGcap');
		$this->load->model('usercompte_gcap_model','UserCompte');
		$this->load->model('fraction_gcap_model','Fraction');
		$this->load->model('congeLast_gcap_model','CongeLast');
		//add by Garina
		$this->load->model('avis_gcap_model','Avis');
		$this->load->model('localite_gcap_model','Localite');
		//end adding
		$this->load->model('service_model','service');
		$this->load->model('division_model','division');
		$this->load->model('departement_model','departement');
		$this->load->model('direction_model','direction');
		$this->load->model('candidat_model','candidat');

		$this->sessionStartCompte();	
	}

	
	public function module($_zHashModule = FALSE){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['iNotificationAffiche'] = 1;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

	    	$this->load_my_view_Common('gcap/index.tpl',$oData, $iModuleId);
	    	
    	}
    	
    }
	/*commentaire setToCredit1*/
	private function setToCredit1($iMatricule, $_iMois, $_iAnnee) 
	{
		$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/mission_all_texte.txt"); 
		$toCredit = json_decode ($zData);

		$toCandidatAffiche = array();
		if (sizeof ($toCredit)>0) {
			$toCandidatAffiche = $toCredit->MissionAll ;
		}

		return $toCandidatAffiche ; 
	}

	private function setOv($_zNumTitre) 
	{
		ini_set('default_socket_timeout', 10);
		$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/solde_ov.txt"); 
		$zData = str_replace("%SOLD%", trim($_zNumTitre), $zData) ; 

		$toReturn = array();

		$oCtx = stream_context_create(array('http'=>
			array(
				'timeout' => 3,  
			)
		));

		/*$toSoldeOv = @file_get_contents($zData,false,$oCtx);

		if ($toSoldeOv!="") {
			$toReturn = json_decode ($toSoldeOv);
		}*/

		return $toReturn ; 
	}

	private function AvancementAgent($iMatricule) 
	{
		
		ini_set('default_socket_timeout', 10);
		$zData1 = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/avance.txt"); 

		$zData1 = str_replace("%MATRICULE%",trim($iMatricule), $zData1) ; 

		$oCtx = stream_context_create(array('http'=>
			array(
				'timeout' => 3,  
			)
		));


		$zAvancementAffiche = @file_get_contents($zData1,false,$oCtx);

		if ($zAvancementAffiche != "") {
			$oAvancementAffiche = json_decode ($zAvancementAffiche);

			foreach ($oAvancementAffiche as $iKey => $zValue) {
				$oAvancementAffiche = $zValue ; 
			}
			
		} else {
			
			$oAvancementAffiche = array();
		}

		return $oAvancementAffiche ; 
	}

	private function AvancementAgent1($iMatricule) 
	{
		$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/avance_texte.txt"); 
		$toAvancement = json_decode ($zData);

		$toAvancement = $toAvancement->TAvance ;

		return $toAvancement ; 
	}

	private function setCandidatAffiche1($iMatricule,$_iMois, $_iAnnee) 
	{
		$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/recap_texte.txt"); 
		$oCandidatAffiche = json_decode ($zData);

		$oCandidatAffiche = $oCandidatAffiche->TFicRecap ;

		return $oCandidatAffiche ; 
	}

	private function setToCredit($iMatricule, $_iMois, $_iAnnee,$_zSpecial='',$_zLastParameter=',String_SEPARATOR_schema,cloture,String') 
	{
		$toCredit = array();

		/*$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/mission_all_ecd.txt"); 

			$iCin = str_replace(" ","","508992011123");
			$zData = str_replace("%MATRICULE%", $iCin, $zData) ; 
			$zData = str_replace("%MOIS%", '02', $zData) ; 
			$zData = str_replace("%ANNEE%", '18', $zData) ; 

			echo $zData ; 
			$zContent = $this->get_content(trim($zData));
			//$zContent = file_get_contents("http://app.dggfpe.mg/com.dggfpe.com.rest/dggfpe/services/ws_mission_all_ecd_agent/508992011123,18,12");

			echo "----" . $zContent ; 
			die();

			$toCandidatAffiche = array();
			if ($zContent != 'null'){


				echo $zContent ; 

				if($zContent != 'null'){
					$toCredit = json_decode ($zContent);
					if (is_object($toCredit)) {
						$toCandidatAffiche = $toCredit ; 
					} 
				}
			}

		return $toCandidatAffiche ; */
		$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/mission_all.txt"); 

		$zData = str_replace("%MATRICULE%", $iMatricule, $zData) ; 
		$zData = str_replace("%MOIS%", trim($_iMois), $zData) ; 
		$zData = str_replace("%ANNEE%", trim($_iAnnee), $zData) ; 
		//$zData = str_replace("%SPECIAL%", "_speciale", $zData) ; 
		$zData = str_replace("%SPECIAL%", $_zSpecial, $zData) ; 
		$zData = str_replace("%LASTPARAMETER%", $_zLastParameter, $zData) ;

		if ($_zSpecial == ''){
			if ($_iAnnee > '17'){
				$zData = str_replace("%iAnnee%",  "_20" . trim($_iAnnee), $zData) ; 
				$zData = str_replace("%iAnneeS%",  "_20" . trim($_iAnnee), $zData) ; 
			} else {
				$zData = str_replace("%iAnnee%", "", $zData) ; 
				$zData = str_replace("%iAnneeS%", "", $zData) ; 
			}
		} else {
			$zData = str_replace("%iAnnee%", "_20" . trim($_iAnnee), $zData) ; 
			$zData = str_replace("%iAnneeS%", "", $zData) ; 
		} 
		//echo $zData;

		/*//echo $zData;
		ini_set('default_socket_timeout', 10);

		$oCtx = stream_context_create(array('http'=>
			array(
				'timeout' => 3,  
			)
		));*/

		//$zContent = @file_get_contents($zData, false, $oCtx);

		/*if (!$zContent = file_get_contents($zData)) {
			$error = error_get_last();
			echo $error['message'];
			die();
		} */

		$zContent = $this->get_content($zData,$_iMois, $_iAnnee);
		//$zContent = urlencode($zData);

		$toCandidatAffiche = array();
		if ($zContent == 'null' && $_zSpecial==''){
			//$this->setToCredit($iMatricule, $_iMois, $_iAnnee ,"_speciale",'');
		} else {

			if($zContent != 'null'){
				$toContent = explode('{"MissionAll"',$zContent);
				$toCredit = json_decode ('{"MissionAll"'.$toContent[1]);
				if (is_object($toCredit)) {
					$toCandidatAffiche = $toCredit->MissionAll ; 
				} 
			}
		}
		return $toCandidatAffiche ; 
	}

	private function setCandidatAffiche($iMatricule, $_iMois, $_iAnnee,$_zSpecial='',$_zLastParameter=',String_SEPARATOR_schema,cloture,String') 
	{
		$oCandidatAffiche = array();

		$zData1 = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/recap.txt"); 

		$zData1 = str_replace("%MATRICULE%", $iMatricule, $zData1) ; 
		$zData1 = str_replace("%MOIS%", trim($_iMois), $zData1) ; 
		$zData1 = str_replace("%ANNEE%", trim($_iAnnee), $zData1) ; 
		$zData1 = str_replace("%SPECIAL%", $_zSpecial, $zData1) ; 
		$zData1 = str_replace("%SPECIAL%", "", $zData1) ; 
		//$zData1 = str_replace("%iAnnee%",  "20" . trim($_iAnnee), $zData1) ; 
		$zData1 = str_replace("%LASTPARAMETER%", $_zLastParameter, $zData1) ;

		
		if ($_zSpecial == ''){
			if ($_iAnnee > '17'){
				$zData1 = str_replace("%iAnnee%",  "_20" . trim($_iAnnee), $zData1) ; 
				$zData1 = str_replace("%iAnneeS%",  "_20" . trim($_iAnnee), $zData1) ; 
			} else {
				$zData1 = str_replace("%iAnnee%", "", $zData1) ; 
				$zData1 = str_replace("%iAnneeS%", "", $zData1) ; 
			}
		} else {
			$zData1 = str_replace("%iAnnee%", "_20" . trim($_iAnnee), $zData1) ; 
			$zData1 = str_replace("%iAnneeS%", "", $zData1) ; 
		} 

		ini_set('default_socket_timeout', 10);

		$oCtx = stream_context_create(array('http'=>
			array(
				'timeout' => 10,  
			)
		));


		//$zContent = @file_get_contents($zData1, false, $oCtx);
		$zContent = $this->get_content($zData1,$_iMois, $_iAnnee);
		$oCandidatAffiche = array();
		if ($zContent == 'null' && $_zSpecial==''){
			
		} else {
			
			if($zContent != 'null'){
				$toContent = explode('{"TFicRecap"',$zContent);
				$oCandidatAffiche = json_decode ('{"TFicRecap"'.$toContent[1]);
				//$oCandidatAffiche = json_decode ($zContent);
				if (!is_object($oCandidatAffiche)) {

					if ($oCandidatAffiche) {
						$oCandidatAffiche = $oCandidatAffiche->TFicRecap ;
					}
					
				} else {
					$oCandidatAffiche = $oCandidatAffiche->TFicRecap ;
				}
			}
		}

		return $oCandidatAffiche ; 
	}


	
	public function __fiche($_zHashModule = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iMatricule = $oUser['im'];

			 
			//$iMois = $this->postGetValue ("iAnnee",date('m')); 
			$iMois = $this->postGetValue ("iMois",date('m')); 
			$iAnnee = $this->postGetValue ("iAnnee",date('Y'));

			$iMois = sprintf("%'.02d\n", $iMois);
			$iAnnee = substr($iAnnee, 2, 2); 
			
				
			$toCandidatAffiche = $this->setToCredit($iMatricule, $iMois, $iAnnee) ; 
			$oCandidatAffiche  = $this->setCandidatAffiche($iMatricule, $iMois, $iAnnee) ; 

			$toSetSlOv = array();

			if ($iMois < date('m') || date("Y-m-d") > date("Y-m-16") ) {
				if (sizeof($oCandidatAffiche)> 0) {
					$toSetSlOv  = $this->setOv($oCandidatAffiche->numTitre) ;
				}
			}
			//$toAvancement  = $this->Avancement($iMatricule) ;	

			
			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'F&eacute;vrier',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Ao&ucirc;t',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'D&eacute;cembre'
			);

			

			$oData['menu'] = 41;
			$oData['iMois'] = $iMois;
			$oData['iAnnee'] = $iAnnee;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['toSetSlOv'] = $toSetSlOv;
			$oData['toMonth'] = $toMonth;
			$oData['zAnneeAffiche'] = date("Y");
			$oData['zAnneeValue'] = date("y");
			$oData['zMoisAffiche'] = date("m");
			$oData['iSizetoSetSlOv'] = sizeof($toSetSlOv);
			$oData['oCandidatAffiche'] = $oCandidatAffiche;
			$oData['toCandidatAffiche'] = $toCandidatAffiche;
			$oData['zBasePath'] = base_url() ;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

	    	$this->load_my_view_Common('Avis/fiche.tpl',$oData, $iModuleId);

    	
		} else {
			$this->mon_cv();
		}
	}


	/** 
	* fiche avis de credit d'un agent
	*
	* @param string $_zHashModule Hashage du module 
	* @return view
	*/
	public function fiche($_zHashModule = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iMatricule	= (isset($_POST['iSendBas']) && ($_POST['iSendBas']))?$_POST['iSendBas']:$oUser['im'];
			$iUserId = $oUser['id'] ; 
			

			$oCandidatAfficheTpl = array();
			$iMois = $this->postGetValue ("iMois",date('m')); 
			$iAnnee = $this->postGetValue ("iAnnee",date('Y'));
			$iAnneeActif = $this->postGetValue ("iAnnee",date('Y'));

			$iMois = sprintf("%'.02d\n", $iMois);
			$iAnnee = substr($iAnnee, 2, 2); 

			$zEcd = "";

			$zSetCredit  = 'setToCredit'.$zEcd ; 
			$zSetAffiche = 'setCandidatAffiche'.$zEcd ;  
				
			$toCandidatAffiche = $this->$zSetCredit($iMatricule, $iMois, $iAnnee) ;
			
			$iEditionSpecial = 0;
			if (sizeof($toCandidatAffiche)==0){	
				$toCandidatAffiche = $this->$zSetCredit($iMatricule, $iMois, $iAnnee ,"_speciale",'');
				if (sizeof($toCandidatAffiche)>0){
					$iEditionSpecial = 1;
				}
			}

			$oCandidatAffiche = array();
			if (sizeof($toCandidatAffiche)>0){
				$oCandidatAffiche  = $this->$zSetAffiche($iMatricule, $iMois, $iAnnee) ;

				if (!is_object($oCandidatAffiche)){
					
					if(is_array($oCandidatAffiche) && sizeof($oCandidatAffiche)>0){
					} else {
						$oCandidatAffiche = $this->$zSetAffiche($iMatricule, $iMois, $iAnnee ,"_speciale",'');
					}
				}

			}
			
			$oCandidatAfficheFiche = $oCandidatAffiche ;

			/****************************** fin disposition salaire **********************************/

			$iIncrement = 0;
			foreach ($toCandidatAffiche as $oCandidatAffiche1){
				$zRubrique = $this->module->get_module_rubrique($oCandidatAffiche1->codeRubrique);
				$toCandidatAffiche[$iIncrement]->rubriqueLibelle = $zRubrique ; 
				$iIncrement++;
			}

			$iObject = 0;
			if (is_object($oCandidatAffiche) || $oCandidatAffiche == array()) {
				$iObject = 1;
			}

			$toSetSlOv = array();

				if (is_object($oCandidatAfficheFiche)) {
					$oCandidatAfficheTpl = $oCandidatAfficheFiche ;
					$toCandidatAfficheTpl = $toCandidatAffiche ; 
					
				} else {

					if(isset($oCandidatAffiche)){
					
						foreach ($oCandidatAffiche as $oCandidatAffiche1) {
							
							$toCode = array();

							foreach ($toCandidatAffiche as $toCandidatAffiche1){
								if ($oCandidatAffiche1->posteAgentNumero == $toCandidatAffiche1->posteAgentNumero){
									array_push($toCode, $toCandidatAffiche1);
								}
							}

							$iIncrement = 0;
							foreach ($toCode as $oCode){
								$zRubrique = $this->module->get_module_rubrique($oCode->codeRubrique);
								$toCode[$iIncrement]->rubriqueLibelle = $zRubrique ; 
								$iIncrement++;
							}

							$oCandidatAffiche1->toCode = $toCode ; 

							array_push($oCandidatAfficheTpl, $oCandidatAffiche1);
							
						}
					}
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
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'D&eacute;cembre'
			);
			
			$oData['iCheckId'] = $iCheckId;
			$oData['iUserId']  = $oUser['id'] ;

			
			$oData['menu'] = 41;
			$oData['bPhoto'] = $bPhoto;
			$oData['iMois'] = $iMois;
			$oData['iMatricule'] = $iMatricule;
			$oData['iAnnee'] = $iAnnee;
			$oData['oUser'] = $oUser;
			$oData['iEditionSpecial'] = $iEditionSpecial;
			$oData['oCandidat'] = $oCandidat;
			$oData['toSetSlOv'] = $toSetSlOv;
			$oData['toMonth'] = $toMonth;
			$oData['zAnneeAffiche'] = date("Y");
			$oData['zAnneeValue'] = date("y");
			$oData['zAnneeBoucle'] = date("Y");
			$oData['iAnneeActif'] = $iAnneeActif;
			$oData['iLastBoucle'] = date("Y")-2016;
			$oData['zMoisAffiche'] = date("m");
			$oData['oCandidatAffiche'] = $oCandidatAfficheTpl;
			$oData['toCandidatAffiche'] = $toCandidatAffiche;
			$oData['iObject'] = $iObject;
			$oData['zBasePath'] = base_url() ;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

	    	$this->load_my_view_Common('Avis/fiche2.tpl',$oData, $iModuleId);

    	
		} else {
			$this->mon_cv();
		}
	}
	
	
//Add by Garina
	
	public function getInfoChangeManuel($_iUserId) {
		global $oSmarty ; 

		$oReturn		= $this->Gcap->get_candidat_object($_iUserId);
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

			
			$oDetache = $this->Gcap->getDetacheId($oCandidat[0]->user_id);
			$iDetache = $oCandidat[0]->detache;
			
			$iDepartementId = $oCandidat[0]->departement ;  
			$iDirectionId = $oCandidat[0]->direction;
			$iServiceId = $oCandidat[0]->service;

			$this->load->model('province_model','Province');
			$toProvince = $this->Province->get_province_by_pays_id(2);

			$this->load->model('region_model','Region');
			$toRegion = $this->Region->get_region_by_province_id();

			$this->load->model('district_model','District');
			$toDistrict = $this->District->get_district_by_region_id();

			$this->load->model('departement_model','Departement');
			$oDepartement = $this->Departement->get_departement();
			
			$oFonction = $this->Avis->getFonction();


			//oDepartement = $this->Gcap->get_Organisation();
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

			$oSmarty->assign("oFonction",$oFonction);
			$oSmarty->assign("oDetache",$oDetache);
			$oSmarty->assign("iDetache",$iDetache);
			
			$oSmarty->assign("toProvince",$toProvince);
			$oSmarty->assign("toRegion",$toRegion);
			$oSmarty->assign("toDistrict",$toDistrict);
			$oSmarty->assign("oDepartement",$oDepartement);
			$oSmarty->assign("oDirection",$oDirection);
			$oSmarty->assign("iUserId",$_iUserId);
			$oSmarty->assign("iUserTarget",$iUserTarget);
			$oSmarty->assign("oService",$oService);
			$oSmarty->assign("oDivision",$oDivision);		
			$oSmarty->assign("oReturn",$oReturn);
			$oSmarty->assign("oCandidat",$oCandidat);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
			$oSmarty->assign("zName",$zName);
			$oSmarty->assign("zMessage",$zMessage);
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "Avis/getInfoUserChangeManuel.tpl" );
			echo $zInfoUser ; 
		} else {
			echo "<h1><strong>L'agent recherché n'est pas dans ROHI</strong></h1>" ; 
		}

	}


	//Add by Garina
	
	public function getTemplatePhoto($_iUserId) {
		global $oSmarty ; 

		$oReturn		= $this->Gcap->get_candidat_object($_iUserId);
		$iRedirect		= $this->postGetValue ("iRedirect",0) ;

		if (sizeof($oReturn)>0){

			$oCandidat = $this->Gcap->get_candidat_object($oReturn[0]->user_id);

			$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

			$zPathWithPhoto = base_url() . "assets/evaluation/images/no_image_user.png";
			$iTestPhoto = "";
			if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
				$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
				$iTestPhoto = "OK";
			} 


			$this->load->model('province_model','Province');
			$toProvince = $this->Province->get_province_by_pays_id(2);

			$this->load->model('region_model','Region');
			$toRegion = $this->Region->get_region_by_province_id();

			$this->load->model('district_model','District');
			$toDistrict = $this->District->get_district_by_region_id();

			$this->load->model('Accueil_gcap_model','Accueil');
			$toBatiment = $this->Accueil->getBatiment();

			

			$oSmarty->assign("toProvince",$toProvince);
			$oSmarty->assign("iTestPhoto",$iTestPhoto);
			$oSmarty->assign("toRegion",$toRegion);
			$oSmarty->assign("toDistrict",$toDistrict);
			$oSmarty->assign("iUserId",$_iUserId);
			$oSmarty->assign("iUserTarget",$iUserTarget);
			$oSmarty->assign("oService1",$oService);
			$oSmarty->assign("oDivision1",$oDivision);		
			$oSmarty->assign("oReturn",$oReturn);
			$oSmarty->assign("toBatiment",$toBatiment);
			$oSmarty->assign("oCandidat",$oCandidat);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
			$oSmarty->assign("zName",$zName);
			$oSmarty->assign("zMessage",$zMessage);
			$oSmarty->assign("iUserId",$_iUserId);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('oReturn', $oReturn);
			$oSmarty->assign('iRedirect', $iRedirect);
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "Avis/getTemplateAvis.tpl" );
			echo $zInfoUser ; 
		} else {
			echo "<h1><strong>L'agent recherché n'est pas dans ROHI</strong></h1>" ; 
		}

	}
	
	public function getSousFonction() {

		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iFonctionId	= $this->postGetValue ("iFonctionId",0) ;
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		if($iRet == 1){	
			$toListe = $this->Avis->get_sous_fonction($iFonctionId);
		}

		$oSmarty->assign("toListe",$toListe);
		$oSmarty->assign("iType",0);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/portion_option.tpl" );
	
		echo $zSelect;
	}
	
	public function saveLocaliteAvis()
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
		$iFonctionId		= $this->postGetValue ("iFonctionId",0) ;
		$iSousFonctionId	= $this->postGetValue ("iSousFonctionId",0) ;
		$iMiseADispo		= $this->postGetValue ("iMiseADispo",0) ;
		$iInstitutionId		= $this->postGetValue ("iInstitutionId",0) ;
		$zPhone				= $this->postGetValue ("zPhone","") ;
		$zLocalite			= $this->postGetValue ("zLocalite","") ;
		$zPorte				= $this->postGetValue ("zPorte","") ;
		$zDepartement		= $this->postGetValue ("zDepartement","") ;
		$zDirection			= $this->postGetValue ("zDirection","") ;
		$zService			= $this->postGetValue ("zService","") ;
		$zLocaliteMad		= $this->postGetValue ("zLocaliteMad","") ;
    	
		if($iRet == 1){	

			$oDataInfo = array();
			$oDataInfo['phone'] = $zPhone;
			$this->Localite->update_Candidat($oDataInfo, $iUserId);

			$oCandidat = $this->Gcap->get_candidat_object($iUserId);

			$oDataCheck = array();
			$oDataCheck['checkavis_userId']  = $iUserId;
			$oDataCheck['checkavis_affiche'] = 1;
			$oDataCheck['checkavis_date']	 = date("Y-m-d H:i:s");
			$this->Avis->insertCheck($oDataCheck);

			$oDataLocalitePassive = array();
			if ($iMiseADispo==1){
				$this->Gcap->delete_detache($iUserId);
				$oData = array();
				$oData['detache_userId'] = $iUserId ; 
				$oData['detache_institutionId'] = $iInstitutionId ; 
				$oData['detache_departement'] = $zDepartement ;
				$oData['detache_direction'] = $zDirection ;
				$oData['detache_service'] = $zService ;
				$oData['detache_localite'] = $zLocaliteMad ;
				$this->Gcap->insertDetache($oData);
				$oDataLocalitePassive['localite_detache'] = $iMiseADispo;
			}
	
			
			$oDataLocalitePassive['localite_userId'] = $iUserId;
			$oDataLocalitePassive['localite_paysId'] = 1;
			$oDataLocalitePassive['localite_provinceId'] = $iProvinceId;
			$oDataLocalitePassive['localite_regionId'] = $iRegionId;
			$oDataLocalitePassive['localite_districtId'] = $iDistrictId;
			$oDataLocalitePassive['localite_departementId'] = $iDepartementId;
			$oDataLocalitePassive['localite_directionId'] = $iDirection;
			$oDataLocalitePassive['localite_serviceId'] = $iService;
			$oDataLocalitePassive['localite_divisionId'] = $iDivisionId;
			$oDataLocalitePassive['localite_date'] = date("Y-m-d");
			$oDataLocalitePassive['localite_statut'] = 1;
			$oDataLocalitePassive['localite_localiteService'] = $zLocalite;
			$oDataLocalitePassive['localite_porte'] = $zPorte;
			$oDataLocalitePassive['localite_fonctionId'] = $iFonctionId;
			if($iSousFonctionId && $iSousFonctionId > 0) $oDataLocalitePassive['localite_sousfonctionId'] = $iSousFonctionId;
			
			$this->Avis->insertLocalite($oDataLocalitePassive) ; 
			
			
    	
		} else {
			$this->mon_cv();
		}
	}


//End

	public function avancement($_zHashModule = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iMatricule = $oUser['im'];

			$toAvancement = $this->AvancementAgent('332026');
			
			$oData['menu'] = 44;
			
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['toAvancement'] = $toAvancement;
			
			
			$oData['zBasePath'] = base_url() ;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

	    	$this->load_my_view_Common('Avis/avanceAgent.tpl',$oData, $iModuleId);

    	
		} else {
			$this->mon_cv();
		}
	}


	public function rubrique($_zHashModule = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			 
			 $toRubrique = array();
			 $iRow = 1;
			 if (($oHandle = fopen(ADMIN_TEMPLATE_PATH ."Avis/code_rubrique.txt", "r")) !== FALSE) {
				while (($tzData = fgetcsv($oHandle, 1000, ":")) !== FALSE) {
					if ($iRow > 1 && is_array($tzData)) {
						
						$oRubrique = new StdClass();
						$oRubrique->code = $tzData[0];
						$oRubrique->rubrique = $tzData[1];

						array_push ($toRubrique, $oRubrique);
					}
					$iRow++;
				}
				fclose($oHandle);
			}

			$oData['menu'] = 43;
			$oData['zBasePath'] = base_url() ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['toRubrique'] = $toRubrique;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

	    	$this->load_my_view_Common('Avis/rubrique.tpl',$oData, $iModuleId);

    	
		} else {
			$this->mon_cv();
		}
	}


	public function imprimer($_zHashModule = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$_SESSION["session_compte"] = 1 ; 
    	
		if($iRet == 1){	

			$iMatricule	= (isset($_POST['iSendBas']) && ($_POST['iSendBas']))?$_POST['iSendBas']:$oUser['im'];
			$iUserId = $oUser['id'] ; 
			

			$oCandidatAfficheTpl = array();
			$iMois = $this->postGetValue ("iMois",date('m')); 
			$iAnnee = $this->postGetValue ("iAnnee",date('Y'));
			$iAnneeActif = $this->postGetValue ("iAnnee",date('Y'));
			$iPostAgentNumero = $this->postGetValue ("iPostAgentNumero",'');

			$iMois = sprintf("%'.02d\n", $iMois);
			$iAnnee = substr($iAnnee, 2, 2); 

			$zEcd = "";

			$zSetCredit  = 'setToCredit'.$zEcd ; 
			$zSetAffiche = 'setCandidatAffiche'.$zEcd ;  
				
			$toCandidatAffiche = $this->$zSetCredit($iMatricule, $iMois, $iAnnee) ;
			
			$iEditionSpecial = 0;
			if (sizeof($toCandidatAffiche)==0){	
				$toCandidatAffiche = $this->$zSetCredit($iMatricule, $iMois, $iAnnee ,"_speciale",'');
				
				if (sizeof($toCandidatAffiche)>0){
					$iEditionSpecial = 1;
				}
			}

			$toCandidatAfficheTpl = $toCandidatAffiche; 

			$oCandidatAffiche = array();
			if (sizeof($toCandidatAffiche)>0){
				$oCandidatAffiche  = $this->$zSetAffiche($iMatricule, $iMois, $iAnnee) ;

				if (!is_object($oCandidatAffiche)){
					
					if(is_array($oCandidatAffiche) && sizeof($oCandidatAffiche)>0){
					} else {
						$oCandidatAffiche = $this->$zSetAffiche($iMatricule, $iMois, $iAnnee ,"_speciale",'');
					}
				}

			}
			
			$oCandidatAfficheFiche = $oCandidatAffiche ;
			$oCandidatAfficheTpl = $oCandidatAffiche;
			/****************************** fin disposition salaire **********************************/

			$iIncrement = 0;
			foreach ($toCandidatAffiche as $oCandidatAffiche1){
				$zRubrique = $this->module->get_module_rubrique($oCandidatAffiche1->codeRubrique);
				$toCandidatAffiche[$iIncrement]->rubriqueLibelle = $zRubrique ; 
				$iIncrement++;
			}

			$iObject = 0;
			if (is_object($oCandidatAffiche) || $oCandidatAffiche == array()) {
				$iObject = 1;
			}

			if (is_object($oCandidatAfficheTpl)) {
				$toSetSlOv  = $this->setOv($oCandidatAfficheTpl->numTitre) ;

				if (is_object($toSetSlOv)) {
					$oCandidatAfficheTpl->toSetSlOv = $toSetSlOv ; 
				}
				$oCandidatAffiche = $oCandidatAfficheTpl ;
				$toCandidatAffiche = $toCandidatAfficheTpl ; 

			} else {

				$toCandidatAffiche = array();
				foreach ($oCandidatAfficheTpl as $oCandidatAffiche1) {
					
					if ($iPostAgentNumero == $oCandidatAffiche1->posteAgentNumero) {
						
						$oCandidatAffiche = array();
						foreach ($toCandidatAfficheTpl as $toCandidatAffiche1){

							if ($oCandidatAffiche1->posteAgentNumero == $toCandidatAffiche1->posteAgentNumero){
								array_push($toCandidatAffiche, $toCandidatAffiche1);
							}
						}

						$oCandidatAffiche = $oCandidatAffiche1 ;
					} 
				}
			}
				
			require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf = new FPDF();
			$oPdf->AddPage();

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
			$oPdf->SetFont('trebuc','',9);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(45);
			$oPdf->Cell(125,5,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(45);
			$oPdf->SetFont('Helvetica','I');
			$oPdf->Cell(125,5,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
			$oPdf->SetFont('trebuc','');
			$oPdf->Ln();

			$oPdf->SetFont('trebuc','',9);

			$oPdf->SetX(45);
			if (isset($oCandidatAffiche->etsFinancierNom)) {
				$oPdf->Cell(125,5,'AVIS DE CREDIT',0,0,'C',1);
			} else {
				//$oPdf->Cell(125,5,strtoupper($toCandidatAffiche[0]->etsFinancierNom),0,0,'C',1);
				$oPdf->Cell(125,5,'BULLETIN DE SOLDE',0,0,'C',1);
			}
			$oPdf->Ln();

			$oPdf->SetX(45);
			//$oPdf->Cell(125,5,"(Ce document n'a aucune portée juridique)",0,0,'C',1);

			//$oPdf->Ln();


			$oPdf->SetX(10);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(125,5,'NOM ET PRENOMS / ADRESSE',1,0,'C',1);

			$oPdf->SetX(135);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(20,5,'LOGT',"TLR",0,'C',0);


			$oPdf->SetX(155);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(20,5,'AMEUB',"TLR",0,'C',0);

			$oPdf->SetX(175);

			$oPdf->Cell(30,5,'EMISSION',1,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetFillColor(255,255,255);

			//Now show the 3 columns

			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(strlen(trim(utf8_decode($oCandidatAffiche->agentNom))),5,trim(utf8_decode($oCandidatAffiche->agentNom)),"LTB",0,'L',1);

			/*$oPdf->SetX(50 - strlen(trim($oCandidatAffiche->agentNom)));
			$oPdf->Cell(20,5,$oCandidatAffiche->agentPrenoms,"TB",0,'L',1);*/

			$oPdf->SetX(135);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(155);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(175);
			$oPdf->SetFillColor(255,255,255);
			$oPdf->Cell(15,5,'MOIS',1,0,'C',1);

			$oPdf->SetX(190);
			$oPdf->Cell(15,5,'EXER',1,0,'C',1);

			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(125,5,$oCandidatAffiche->soa . utf8_decode(" N° ") . $oCandidatAffiche->numTitre,1,0,'L',1);

			$oPdf->SetX(135);
			$oPdf->Cell(20,5,0,1,0,'C',1);

			$oPdf->SetX(155);
			$oPdf->Cell(20,5,0,1,0,'C',1);

			$oPdf->SetX(175);
			$oPdf->Cell(15,5,$oCandidatAffiche->mois,1,0,'C',1);

			$oPdf->SetX(190);
			$oPdf->Cell(15,5,$oCandidatAffiche->exercice,1,0,'C',1);

			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$oPdf->SetFillColor(232,232,232);
			$oPdf->SetX(10);
			$oPdf->Cell(30,5,'Matricule',"TLR",0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(20,5,'BUD',"TLR",0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(40,5,'CHAPITRE',"TLR",0,'C',1);

			$oPdf->SetX(100);
			$oPdf->Cell(20,5,'ARTICLE',"TLR",0,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(20,5,'CADRE',"TLR",0,'C',1);

			$oPdf->SetX(140);
			$oPdf->Cell(20,5,'CL/MAJ/ECH',"TLR",0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(20,5,'INDICE',"TLR",0,'C',1);

			$oPdf->SetX(180);
			$oPdf->Cell(25,5,'ENFANTS',1,0,'C',1);

			$oPdf->Ln();


			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(30,5,'',"LRB",0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(40,5,'',"LRB",0,'C',1);

			$oPdf->SetX(100);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(140);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(20,5,'',"LRB",0,'C',1);

			$oPdf->SetX(180);
			$oPdf->Cell(12.5,5,'-15',1,0,'C',1);

			$oPdf->SetX(192.5);
			$oPdf->Cell(12.5,5,'+15',1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);

			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(30,5,$oCandidatAffiche->agentMatricule,1,0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(20,5,$oCandidatAffiche->budgetCode,1,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(40,5,$oCandidatAffiche->ministereCode,1,0,'C',1);

			$oPdf->SetX(100);
			$oPdf->Cell(20,5,substr($oCandidatAffiche->sectionCode, -3),1,0,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(20,5,$toCandidatAffiche[0]->corpsCode,1,0,'C',1);

			$oPdf->SetX(140);
			$oPdf->Cell(20,5,$toCandidatAffiche[0]->gradeCode,1,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(20,5,$oCandidatAffiche->indice,1,0,'C',1);

			$oPdf->SetX(180);
			$oPdf->Cell(12.5,5,isset($toCandidatAffiche[0]->agentNbenfantMoins15)?$toCandidatAffiche[0]->agentNbenfantMoins15:0,1,0,'C',1);

			$oPdf->SetX(192.5);
			$oPdf->Cell(12.5,5,isset($toCandidatAffiche[0]->agentNbenfantPlus15)?$toCandidatAffiche[0]->agentNbenfantPlus15:0,1,0,'C',1);

			$oPdf->Ln();


			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$oPdf->SetFillColor(232,232,232);
			$oPdf->SetX(10);
			$oPdf->Cell(60,5,utf8_decode('N° Ordre'),1,0,'C',1);

			$oPdf->SetX(70);
			$oPdf->Cell(40,5,'LOCALITE',1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(80,5,'SERVICE LOCALITE',1,0,'C',1);

			$oPdf->SetX(190);
			$oPdf->Cell(15,5,'ZONE',1,0,'C',1);

			$oPdf->Ln();
			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(60,5,$oCandidatAffiche->rang,1,0,'C',1);

			$oPdf->SetX(70);
			$oPdf->Cell(40,5,$oCandidatAffiche->fivCode,1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(80,5,$oCandidatAffiche->serviceLocalite,1,0,'C',1);

			$oPdf->SetX(190);
			$oPdf->Cell(15,5,$toCandidatAffiche[0]->fivZone,1,0,'C',1);

			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			if ($oCandidatAffiche->modePaiement == 2) {

				$oPdf->SetFillColor(232,232,232);
				$oPdf->SetX(10);
				$oPdf->Cell(100,5,'Etablissement Bancaire',1,0,'C',1);

				

				$oPdf->SetX(110);
				//$oPdf->Cell(80,5,'N° DE COMPTE',1,0,'C',1);
				$oPdf->Cell(80,5,utf8_decode('N° DE COMPTE'),1,0,'C',1);

				$oPdf->SetX(180);
				$oPdf->Cell(25,5,'PIECE JUSTIF',1,0,'C',1);

				$oPdf->Ln();
				$oPdf->SetFillColor(255,255,255);
				//=================================================================
				$oPdf->SetFont('trebuc','',9);


				$oPdf->SetX(10);
				$oPdf->Cell(100,5,$oCandidatAffiche->etsFinancierNom,1,0,'C',1);

				$oPdf->SetX(110);
				$oPdf->Cell(80,5,$oCandidatAffiche->agentNumeroCompte,1,0,'C',1);

				$oPdf->SetX(180);
				$oPdf->Cell(25,5,'',1,0,'C',1);

				$oPdf->Ln();
			} else {

				$oPdf->SetFillColor(232,232,232);
				$oPdf->SetX(10);
				$oPdf->Cell(100,5,'',1,0,'C',1);

				

				$oPdf->SetX(110);
				$oPdf->Cell(80,5,'',1,0,'C',1);

				$oPdf->SetX(180);
				$oPdf->Cell(25,5,'',1,0,'C',1);

				$oPdf->Ln();
				$oPdf->SetFillColor(255,255,255);
				//=================================================================
				$oPdf->SetFont('trebuc','',9);


				$oPdf->SetX(10);

				$oPdf->Cell(100,5,"BON DE CAISSE ",1,0,'C',1);

				$oPdf->SetX(110);
				$oPdf->Cell(80,5,'',1,0,'C',1);

				$oPdf->SetX(180);
				$oPdf->Cell(25,5,'',1,0,'C',1);

				$oPdf->Ln();

			}

			//=================================================================

			//=================================================================
			$oPdf->SetFont('trebuc','',9);
			$oPdf->SetFillColor(232,232,232);

			$oPdf->SetX(10);
			$oPdf->Cell(30,5,'CODE',"TLR",0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(10,5,'PN',"TLR",0,'C',1);

			$oPdf->SetX(50);
			$oPdf->Cell(10,5,'IDN',"TLR",0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(30,5,'MONTANT',"TLR",0,'C',1);

			$oPdf->SetX(90);
			$oPdf->Cell(20,5,'TAUX',"TLR",0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(25,5,'NOMBRE',"TLR",0,'C',1);

			$oPdf->SetX(135);
			$oPdf->Cell(35,5,'DATE DEBUT',1,0,'C',1);

			$oPdf->SetX(170);
			$oPdf->Cell(35,5,'DATE FIN',1,0,'C',1);

			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(30,5,'RUBRIQUE',"LRB",0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(10,5,'',"LRB",0,'C',1);

			$oPdf->SetX(50);
			$oPdf->Cell(10,5,'',"LRB",0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(30,5,'',"LRB",0,'C',1);

			$oPdf->SetX(90);
			$oPdf->Cell(20,5,'UNITAIRE',"LRB",0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(25,5,'D\'UNITES',"LRB",0,'C',1);

			$oPdf->SetX(135);
			$oPdf->Cell(12.5,5,'J',1,0,'C',1);

			$oPdf->SetX(147.5);
			$oPdf->Cell(12.5,5,'M',1,0,'C',1);

			$oPdf->SetX(159);
			$oPdf->Cell(12.5,5,'A',1,0,'C',1);

			$oPdf->SetX(170);
			$oPdf->Cell(12.5,5,'J',1,0,'C',1);

			$oPdf->SetX(182.5);
			$oPdf->Cell(12.5,5,'M',1,0,'C',1);

			$oPdf->SetX(195);
			$oPdf->Cell(10,5,'A',1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$i=0;
			foreach ($toCandidatAffiche as $oCandidatAffiche1) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($toCandidatAffiche)-1) {
					$zBorder = "BLR";
				}
				$oPdf->SetX(10);
				$oPdf->Cell(30,5,$oCandidatAffiche1->codeRubrique,$zBorder,0,'C',1);

				$oPdf->SetX(40);
				$oPdf->Cell(10,5,isset($oCandidatAffiche1->rubriquePermanent)?$oCandidatAffiche1->rubriquePermanent:'',$zBorder,0,'C',1);

				$oPdf->SetX(50);
				$oPdf->Cell(10,5,isset($oCandidatAffiche1->rubriqueImposable)?$oCandidatAffiche1->rubriqueImposable:'',$zBorder,0,'C',1);

				$oPdf->SetX(60);
				$oPdf->Cell(30,5,number_format($oCandidatAffiche1->montant, 2, ',', ' '),$zBorder,0,'R',1);

				$oPdf->SetX(90);
				$oPdf->Cell(20,5,$oCandidatAffiche1->tauxUnitaire,$zBorder,0,'C',1);

				$oPdf->SetX(110);
				$oPdf->Cell(25,5,$oCandidatAffiche1->nombreUnite,$zBorder,0,'C',1);

				$iJourDeb = "";
				$iMoisDeb = "";
				$iAneeDeb = "";

				if (isset($oCandidatAffiche1->dateDebut)) {

					$zDateDebut = strtotime($oCandidatAffiche1->dateDebut);
					$iJourDeb =  date("d", $zDateDebut);
					$iMoisDeb =  date("m", $zDateDebut);
					$iAneeDeb =  date("y", $zDateDebut);
				}

				$oPdf->SetX(135);
				$oPdf->Cell(12.5,5,$iJourDeb,$zBorder,0,'L',1);

				$oPdf->SetX(147.5);
				$oPdf->Cell(12.5,5,$iMoisDeb,$zBorder,0,'L',1);

				$oPdf->SetX(159);
				$oPdf->Cell(12.5,5,$iAneeDeb,$zBorder,0,'L',1);

				
				$iJourFin = "";
				$iMoisFin = "";
				$iAneeFin = "";

				if (isset($oCandidatAffiche1->dateFin)) {

					$zDateFin = strtotime($oCandidatAffiche1->dateFin);
					$iJourFin =  date("d", $zDateFin);
					$iMoisFin =  date("m", $zDateFin);
					$iAneeFin =  date("y", $zDateFin);
				}

				$oPdf->SetX(170);
				$oPdf->Cell(12.5,5,$iJourFin,$zBorder,0,'L',1);

				$oPdf->SetX(182.5);
				$oPdf->Cell(12.5,5,$iMoisFin,$zBorder,0,'L',1);

				$oPdf->SetX(195);
				$oPdf->Cell(10,5,$iAneeFin ,$zBorder,0,'L',1);
				
				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(46,5,'MONTANTS',0,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(46,5,'IMPOSABLES',0,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(46,5,'SOLDE MENSUELLE',0,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(46,5,'ELEMENT NP',0,0,'C',1);

			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}


			$oPdf->SetX(10);
			$oPdf->Cell(46,5,'BRUTS',0,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(46,5,'NET',0,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(46,5,'PERMANENTE',0,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(46,5,'DU MOIS',0,0,'C',1);

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			//=================================================================
			$oPdf->SetFont('trebuc','',9);


			$oPdf->SetX(10);
			$oPdf->Cell(45,5,'',1,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(45,5,'',1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(45,5,'',1,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(45,5,'',1,0,'C',1);

			$oPdf->Ln();
			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			//===============================================================

			$oPdf->SetX(10);
			$oPdf->Cell(44,5,'TOTAL GAIN',0,0,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(85,5,'COUPON DE CORRESPONDANCE',0,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(45,5,number_format($toCandidatAffiche[0]->totalGain, 2, ',', ' '),'TLR',1,'C',1);


			//===============================================================

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->SetX(10);
			$oPdf->Cell(50,5,'TOTAL RETENUE',0,0,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(85,5,'',"TLR",0,'C',1);

			$oPdf->SetX(60);
			
			$oPdf->Cell(45,5,number_format($toCandidatAffiche[0]->totalRetenu, 2, ',', ' '),'LRB',1,'C',1);
			
			//===============================================================

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->SetX(10);
			$oPdf->Cell(45,5,'NET A PAYER',0,0,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(85,5,'',"LRB",0,'C',1);

			$oPdf->SetX(60);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(45,5,number_format($oCandidatAffiche->netAPayer, 2, ',', ' '),1,1,'C',1);
			$oPdf->SetFillColor(255,255,255);


			//===============================================================

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->SetX(10);
			$oPdf->Cell(44,5,'PRECOMPTE',0,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(45,5,'',1,1,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(80,5,'VIREMENT A UN COMPTE OUVERT DANS ',0,0,'C',1);

			//===============================================================

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->SetX(10);
			$oPdf->Cell(36,5,'TOTAL',0,0,'C',1);

			$oPdf->SetX(60);
			$oPdf->Cell(45,5,number_format($oCandidatAffiche->netAPayer, 2, ',', ' '),'LRB',1,'C',1);

			$oPdf->SetX(120);
			$oPdf->Cell(80,5,'UN ETABLISSEMENT DE CREDIT OU',0,0,'C',1);

			$oPdf->Ln();

			//===============================================================

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->SetX(10);
			$oPdf->Cell(50,5,'OBJET DU PAIEMENT : SOLDE',0,0,'L',1);

			$oPdf->SetX(120);
			$oPdf->Cell(80,5,'CHEZ UN COMPTABLE DU TRESOR',0,0,'C',1);

			$oPdf->Ln();
			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->SetX(10);
			$oPdf->Cell(50,5,utf8_decode('N° TITRE DE PAIEMENT : '),0,0,'L',1);

			$oPdf->SetX(120);
			$oPdf->Cell(80,5,'DATE CREDIT : ',0,0,'C',1);
			$oPdf->Ln();
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->Cell(50,5,utf8_decode('NB : Veuillez vous adresser au bureau du Service du Mandatement de la Solde Analamanga (Sonaco Ambanidia) ou du Service Régional'),0,0,'L',1);
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(50,5,utf8_decode('de la Solde et des Pensions pour toute réclamation '),0,0,'L',1);
			$oPdf->Output();


    	
		} else {
			$this->mon_cv();
		}
	}
	
}