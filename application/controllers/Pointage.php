<?php
/**
* @package ROHI
* @subpackage Pointage
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Pointage extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('compte_gcap_model','Compte');
		$this->load->model('module_gcap_model','module');
		$this->load->model('gcap_gcap_model','Gcap');
		$this->load->model('modulepage_gcap_model','modulePage');
		$this->load->model('usercompte_gcap_model','UserCompte');
		$this->load->model('page_gcap_model','Page');
		$this->load->model('Transaction_pointage_model','Transaction');
		$this->load->model('Badge_pointage_model','Badge');
		$this->load->model('Autreconge_pointage_model','AutreConge');
		$this->load->model('Inout_pointage_model','InOut');
		$this->load->model('user_model','user');
		$this->load->model('evaluation2_gcap_model','evaluation2');
		$this->load->model('Pointage_model','PointageService');

		$this->sessionStartCompte();
	}

	public static function pre_print($_oObjet) {

		echo "<pre>" ; 
		print_r($_oObjet);
		echo "</pre>";
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

	public function getPopUpHeure() {
		global $oSmarty ; 

		$iUserId = $this->postGetValue ("iUserId",'');
		$iInOutId = $this->postGetValue ("iInOutId",'');

		$oCandidat = $this->Gcap->get_by_user_id($iUserId);
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iUserId",$iUserId);
		$oSmarty->assign("iInOutId",$iInOutId);
		$oSmarty->assign("oCandidat",$oCandidat);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "pointage/getPopUpHeure.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 


	public function getPopUpBadgeRetour() {
		global $oSmarty ; 

		$iBadegId = $this->postGetValue ("iBadegId",'');
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iBadegId",$iBadegId);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "pointage/getPopUpBadgeRetour.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 

	public function getPopUpBadgeValidation() {
		global $oSmarty ; 

		$iBadegId = $this->postGetValue ("iBadegId",'');
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iBadegId",$iBadegId);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "pointage/getPopUpBadgeValidation.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 


	public function getPopUpHeureEntree() {
		global $oSmarty ; 

		$iUserId = $this->postGetValue ("iUserId",'');
		$iMissionId = $this->postGetValue ("iMissionId",'');

		$oCandidat = $this->Gcap->get_by_user_id($iUserId);
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iUserId",$iUserId);
		$oSmarty->assign("iMissionId",$iMissionId);
		$oSmarty->assign("oCandidat",$oCandidat);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "pointage/getPopUpHeureEntree.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 


	public function getPopUpBadge() {
		global $oSmarty ; 

		$iUserId = $this->postGetValue ("iUserId",'');
		$iBadgeId = $this->postGetValue ("iBadgeId",'');

		$oCandidat = $this->Gcap->get_by_user_id($iUserId);
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iUserId",$iUserId);
		$oSmarty->assign("iBadgeId",$iBadgeId);
		$oSmarty->assign("oCandidat",$oCandidat);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "pointage/getPopUpBadge.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 

	

	public function updateMahandry(){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();

			$zWhere = " AND DevID=12 AND DateTime BETWEEN '07/05/2016 14:34:08.000' AND '02/06/2016  01:05:50' " ;
	    	$toGetAllTransaction = $this->Transaction->updateMahandry(10, $zWhere, $this);

			echo "<pre>" ; 
			print_r($toGetAllTransaction);
			echo "</pre>" ;

			die();

	    	
    	}
    	
    }


	public function moderation($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
    	global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();

		/*if ($iCompteActif == COMPTE_ADMIN || $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL  || $oUser['im']=='353060' || $oUser['im']=='377036' || $oUser['im']=='374986' || $oUser['im']=='355857' || $oUser['im']=='357208' || $oUser['im']=='355564' || $oUser['im']=='351101' || $oUser['im'] =='10750' || $oUser['im']=='355857' || $oUser['im'] =='374987')*/

		if ($iCompteActif == COMPTE_ADMIN || $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL  || $iCompteActif == COMPTE_EVALUATEUR || $oUser['im'] =='355651')
		{
			$zUserId = '';

			if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL) {
				$zUserId = $this->Gcap->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
			}

			if ($iCompteActif == COMPTE_EVALUATEUR) {
				$zUserId = $this->evaluation2->get_agents_evalues_par_user_id ($oUser['id']);
			}
			
			if($iRet == 1) {

				$oData = array();
				
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;

				$iCompteActif = $this->getSessionCompte();

				$iStatut = 0 ; 
				$iArchive = 0 ; 
				switch ($_zHashUrl) {
					case 'moderer':
						$iStatut = 0 ; 
						break;

					case 'archiver':
						$iStatut = 0 ; 
						$iArchive = 1 ; 
						break;

					case 'valider':
						$iStatut = 1 ; 
						break;

					case 'refuser':
						$iStatut = 2 ; 
						break;

				}

				$iModuleId = "-3"; // $this->module->get_by_module_zHashModule($_zHashModule);
				
				$oData['toGetModeration'] = $this->Transaction->getAllModeration($zUserId, $iArchive, $iStatut, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);
				$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;

				$oData['zPagination'] = $zPagination ; 
				$oData['zHashUrl'] = $_zHashUrl ; 
				$oData['zTitle'] = "Modération mot de passe" ; 
				$this->load_my_view_Common('pointage/moderation.tpl',$oData, -3);
			
			} 
		} else {
			redirect("cv/index");
			//die("Vous n'avez pas accès à cet URL.");
		}
    	
    }

	public function saveUpdateModeration(){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iCompteActif = $this->getSessionCompte();

			//if ($iCompteActif == COMPTE_ADMIN){
			if ($iCompteActif == COMPTE_ADMIN || $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL  || $iCompteActif == COMPTE_EVALUATEUR){

				$zListe	= $this->postGetValue ("zListe",'') ;
				
				$oData = array();

				if ($zListe != '') {

					$toListe = explode("-", $zListe) ; 

					foreach ($toListe as $iListe){

						$oData = array();
						$oData["moderation_archive"]	= 1 ; 

						$this->Transaction->updateModeration($oData, $iListe);
					
					}
				}
			}
    	
		} else {
			redirect("cv/index");
		}
	}

	public function saveModeration($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
    	global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		

		if($iRet == 1) {

			$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModerationId = $this->postGetValue ("iModerationId",'');
			$iValue = $this->postGetValue ("iValue",'');

			if ($iModerationId != '') {

					$toModeration = $this->Transaction->setModeration($iModerationId);

					foreach ($toModeration as $oModeration) {

						if ($iValue == 1) {
							$oData = array();
							$oData['login'] = $oModeration['moderation_login'];
							$oData['password'] = $oModeration['moderation_motDePasse'];
							$this->Transaction->update_password($oModeration['moderation_userId'],$oData,FALSE);
						}

						$this->Transaction->update_moderationUser($oModeration['moderation_userId'], $iValue);
					}
				
				redirect("pointage/moderation/pointage-electronique/moderer");
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	function get_client_ip_env() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}

	public function liste($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser			= array();
		$oCandidat		= array();
		$iRet			= $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData					= array();
		
			$oData['oUser']			= $oUser;
			$oData['oCandidat']		= $oCandidat;
			$zDateDebut				= $this->postGetValue ("date_debut",'')?$this->postGetValue ("date_debut",''):date("d/m/Y"); 
			$zDateFin				= $this->postGetValue ("date_fin",'')?$this->postGetValue ("date_fin",''):date("d/m/Y");
			$iMatricule				= $this->postGetValue ("iMatricule",'')?$this->postGetValue ("iMatricule",''):$oUser["im"];
			$iModuleId				= $this->module->get_by_module_zHashModule($_zHashModule);
			$iCompteActif			= $this->getSessionCompte();
			$iCompteActif			= $this->getSessionCompte();
			$oData['zDateDebut']	= $zDateDebut ; 
			$oData['zDateFin']		= $zDateFin ; 

			$oData['iMatricule']	 = $iMatricule ; 

			$oUserMatricule = array();


			if ($iMatricule != ''){
				$zSearchMatricule = $iMatricule ; 
				if (strlen($iMatricule) > 6){
					$zSearchMatricule = str_replace(" ","",substr($iMatricule, -12, 12)); 
					$oUserMatricule = $this->Transaction->get_by_matricule($zSearchMatricule) ; 
				} else {

					$oUserMatricule = $this->Transaction->get_by_matricule($zSearchMatricule) ; 
				}
			}
			$oData['oUserMatricule'] = $oUserMatricule;
			
			switch ($_zHashUrl) {
				case 'lg-pass':
					$oData['menu']		= 36;
					$zLocal				= getHostByName(getHostName());
					$toLocal			= explode(".",$zLocal);
					$zMessage			= "";
					if($oUser['id'] == '3' || $oUser['id'] == '9961' || $oUser['id'] == '617' || $oUser['id'] == '11' || $oUser['id'] == '9312'){
							$oData['zTitle'] = "Login et mot de passe" ; 
							$this->load_my_view_Common('pointage/lg-pass.tpl',$oData, $iModuleId);
					}
					break;
				
				case 'lg-pass-ajax':
					global $oSmarty ; 
					$oData['menu']		= 36;
					$zLocal				= getHostByName(getHostName());
					$toLocal			= explode(".",$zLocal);
					$zMessage			= "";
					if($oUser['id'] == '3' || $oUser['id'] == '617' || $oUser['id'] == '11' || $oUser['id'] == '9312'){
						$iMatricule		= $this->postGetValue ("iMatricule",'') ;
						$iCin			= $this->postGetValue ("iCin",'') ;
						$toUser			= $this->Gcap->get_login_by_cin_matricule ($iCin,$iMatricule,0);
						$oSmarty->assign("toUser",$toUser);
						$zSelect		= $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "pointage/lg-pass-ajax.tpl" );
						
						echo $zSelect ; 
					}
					break;

				case 'transaction':
					$oData['menu'] = 36;
					$zMessage = "";
					switch ($iCompteActif){
						case COMPTE_AGENT :
							$toGetAllTransaction = $this->Transaction->get_transaction($iMatricule,$iCompteActif,$oUser['id'],$oCandidat,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);
							$zPagination = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							break;
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
						case COMPTE_ADMIN :

							$iNbrTotal = 0 ; 
							$zNotIn = "";
							$toCandidatUser = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn, FALSE);
							//print_r ($toCandidatUser);
							$toCandidatUser = unserialize($toCandidatUser);
							if (sizeof($toCandidatUser)>0) {
								$toCandidatUserMatricule = array();
								$toCandidatUserByCIN = array();
								foreach ($toCandidatUser as $oCandidatUser)
								{
									 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
									 array_push ($toCandidatUserByCIN, (int)$oCandidatUser["cin1"]);
								}
							}
							$zSearchMatricule = $iMatricule ; 
							if (strlen($iMatricule) > 6){
								$zSearchMatricule = str_replace(" ","",substr($iMatricule, -12, 12)); 
							} 
							$iMatriculeSearch = $iMatricule;
							if (strlen($iMatricule) > 6){
								for($i=0;$i<sizeof($toCandidatUserByCIN);$i++){
									if ($zSearchMatricule == $toCandidatUserByCIN[$i]){
										$iMatriculeSearch = $toCandidatUserMatricule[$i];
									}
								}
							}
							if (in_array($iMatriculeSearch, $toCandidatUserMatricule) || in_array($zSearchMatricule, $toCandidatUserByCIN)) {
								$toGetAllTransaction = $this->Transaction->get_transaction($iMatriculeSearch,$iCompteActif,$oUser['id'],$oCandidat,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);
								$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							} else {
								$toGetAllTransaction = array();
								$zPagination    = '' ;
								if ($iMatricule != '') {
									$zMessage = "Le matricule entr&eacute; n'est pas sous votre responsabilit&eacute;" ; 
								}
							}
							break;
					}
					$oData['zPagination']				= $zPagination ; 
					$oData['zMessage']					= $zMessage ; 
					$oData['iLongMatriculeOrCin']		= strlen($iMatricule) ;
					$oData['iCompteActif']				= $iCompteActif ; 
					$oData['iCurrPage']					= $_iCurrPage ; 
					$oData['toGetAllTransaction']		= $toGetAllTransaction ; 
					$oData['zTitle']					= "Liste des transactions" ; 
					$this->load_my_view_Common('pointage/transaction.tpl',$oData, $iModuleId);
					break;
				case 'rang_vaovao' :
					$oData['menu']			= 38;
					$iNbrTotal				= 0 ; 
					$oData['iCompteActif']	= $iCompteActif;
					switch ($iCompteActif){
						case COMPTE_AGENT :
							$zDateDebut				= $this->date_fr_to_en($zDateDebut,'/','-');
							$zDateFin				= $this->date_fr_to_en($zDateFin,'/','-');
							$rang					= $this->PointageService->get_rang_meme_structure($zDateDebut,$zDateFin,$oCandidat[0]->matricule,$oCandidat[0]->structureId);
							$oData['toGetAllRang']	= $list_pointage ; 
							$oData['zDateDebut']	= $zDateDebut ; 
							$oData['zDateFin']		= $zDateFin ; 
							$oData['rang']			= $rang ; 
							$oData['iCompteActif']	= $iCompteActif ; 
							$this->load_my_view_Common('pointage/rang.tpl',$oData, $iModuleId);
						break;
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_EVALUATEUR :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
						
							$zDateDebut				= $this->date_fr_to_en($zDateDebut,'/','-');
							$zDateFin				= $this->date_fr_to_en($zDateFin,'/','-');
							$list_pointage			= $this->PointageService->get_rang($zDateDebut,$zDateFin,$oCandidat[0]->structureId);
							//print_r($list_pointage);die;
							$oData['toGetAllRang']	= $list_pointage ; 
							$oData['zDateDebut']	= $zDateDebut ; 
							$oData['zDateFin']		= $zDateFin ; 
							$oData['rang']			= $rang ; 
							$oData['iCompteActif']	= $iCompteActif ; 
							$this->load_my_view_Common('pointage/rattacheRang.tpl',$oData, $iModuleId);
						break;
					}
				break;
				case 'rang' :
					$oData['menu']			= 38;
					$iNbrTotal				= 0 ; 
					$oData['iCompteActif']	= $iCompteActif;
					switch ($iCompteActif){
						case COMPTE_AGENT :
						$toGetAllRang			= $this->Transaction->get_Rang($iMatricule,$iCompteActif,$oUser['id'],$oCandidat,$zDateDebut,$zDateFin,$this, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);
						$oData['toGetAllRang']	= $toGetAllRang ; 
						$oData['iCompteActif']	= $iCompteActif ; 
						$this->load_my_view_Common('pointage/rang.tpl',$oData, $iModuleId);
						break;
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_EVALUATEUR :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							if ($zDateDebut != "" && $zDateFin != "") {
								$this->load->model('decision_gcap_model','Decision');
								$zNotIn			= "";
								$zUserId		= $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,FALSE);
								
								$toListe		= $this->Transaction->getRangRattache($zUserId, $oCandidat, $zDateDebut, $zDateFin, $this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);

								/*echo "<pre>";
								print_r ($toListe);
								echo "</pre>";
								die();*/

								$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
								$oData['zPagination'] = $zPagination ; 
							} else {
								$toListe = array();
							}
							$iDepartementId							= $this->postGetValue ("iDepartementId",0) ;
							$oData['oDataSearch']["iDepartementId"]	= $iDepartementId ;
							$oData['toGetAllRang']					= $toListe ; 
							$oData['oListe']						= $toListe ; 
							$oData['iCurrPage']						= $_iCurrPage ; 
							$oData['oDepartement']					= $this->Gcap->get_Organisation();
							$oData['zHashUrl']						= $_zHashUrl ; 
							$oData['zHashModule']					= $_zHashModule ;
							$oData['zTitle']						= "les rangs" ; 
							$this->load_my_view_Common('pointage/rattacheRangLast.tpl',$oData, $iModuleId);
							break;
					}

					
					break;

				case 'pdf' :
					$oData['menu'] = 38;
					$iNbrTotal = 0 ; 

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						

							die();
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_EVALUATEUR :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							
							
							if ($zDateDebut != "" && $zDateFin != "") {
								$this->load->model('decision_gcap_model','Decision');
								$zNotIn = "";
								$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,FALSE);
								$toListe = $this->Transaction->getRangRattache($zUserId, $oCandidat, $zDateDebut, $zDateFin, $this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);

								$this->Transaction->setPdf($toListe, $zDateDebut, $zDateFin);
							} else {
								$toListe = array();
							}

							break;
					}

					
					break;

				case 'excel' :
					$oData['menu'] = 38;
					$iNbrTotal = 0 ; 

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						case COMPTE_EVALUATEUR :

							die();
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							
							
							if ($zDateDebut != "" && $zDateFin != "") {
								$this->load->model('decision_gcap_model','Decision');
								$zNotIn = "";
								$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,FALSE);
								$toListe = $this->Transaction->getRangRattache($zUserId, $oCandidat, $zDateDebut, $zDateFin, $this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);

								$this->Transaction->setExcel($toListe, $zDateDebut, $zDateFin);

							} else {
								$toListe = array();
							}
							
							break;
					}

					
					break;


				case 'agents-rattaches' :
					$oData['menu'] = 39;

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
							break;

						case COMPTE_EVALUATEUR :
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							$this->load->model('decision_gcap_model','Decision');
							
							$toListe = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['iAfficheEvaluateur'] = 0 ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['zTitle'] = "Liste des agents rattachés" ; 
							$this->load_my_view_Common('pointage/rattache.tpl',$oData, $iModuleId);
							break;
					}

					
					break;

				case 'les-conges' :
					$oData['menu'] = 40;

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						case COMPTE_EVALUATEUR :
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							$iNbrTotal = 0;
							$this->load->model('gcap_gcap_model','Gcap');
							$toListe = $this->Gcap->get_all_gcap("",$oUser, $oCandidat, $oUser['id'], 0, $iCompteActif,1, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$oData['zTitle'] = "Liste des congés" ; 
							$this->load_my_view_Common('pointage/GcapPointage.tpl',$oData, $iModuleId);
							break;
					}

					
					break;
			
			}
    	}
	}

	public function rapports($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$iCompteActif = $this->getSessionCompte();


			$zDateDebut		= $this->postGetValue ("date_debut",''); 
			$zDateFin		= $this->postGetValue ("date_fin",'');
			$iMatricule		= $this->postGetValue ("iMatricule",'');
			$iSeuil			= $this->postGetValue ("iSeuil",0);
			$iNbrRetard		= $this->postGetValue ("iNbrRetard",0);

			$zHeureSeuil = '' ; 
			$iNbrFois = '' ; 
			if ($iSeuil == 1) {
				if ($this->postGetValue ("heure_seuil") != '00') {
					
					$zHeureSeuil = ((int)$this->postGetValue ("heure_seuil") * 3600) + (int)$this->postGetValue ("minute_seuil") * 60 + (int) $this->postGetValue ("seconde_seuil") ; 
				}
			}

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iCompteActif = $this->getSessionCompte();

			$oData['zDateDebut'] = $zDateDebut ; 
			$oData['zDateFin']	 = $zDateFin ;
			$oData['iSeuil']	 = $iSeuil ;
			$oData['iNbrRetard'] = $iNbrRetard ;
			$oData['iMatricule']	 = $iMatricule ; 
			$oData['heure_seuil']	 = $this->postGetValue ("heure_seuil") ; 
			$oData['minute_seuil']	 = $this->postGetValue ("minute_seuil") ; 
			$oData['seconde_seuil']	 = $this->postGetValue ("seconde_seuil") ; 
			$oData['iCompteActif'] = $iCompteActif ; 
			$oData['iCurrPage'] = $_iCurrPage ; 

			$oUserMatricule = array();
			if ($iMatricule != "") {
				$oUserMatricule = $this->Transaction->get_by_matricule($iMatricule) ; 
			}

			$oData['oUserMatricule'] = $oUserMatricule;
			
			switch ($_zHashUrl) {

				case 'recherche':
					$oData['menu'] = 52;
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :

								if ($zDateDebut != "" && $zDateFin != "") {
									$zNotIn = "";
									$zUserId = $this->Transaction->getAllUserSubordonneesIsPointage ($_iCurrPage,$oUser,$oCandidat,$oUser['id'], $iCompteActif,$zNotIn);
									$toListe = $this->Transaction->RapportTransaction($zUserId,$iSeuil,$iNbrRetard,$zHeureSeuil,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);
								} else {
									$toListe = array();
								}
								$oData['oListe'] = $toListe ; 
								$oData['zTitle'] = "Recherche" ; 
								$this->load_my_view_Common('pointage/rapport.tpl',$oData, $iModuleId);

							break;

						default:
							break;
					}

					
					break;

				case 'excel' :
					$oData['menu'] = 38;
					$iNbrTotal = 0 ; 

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						case COMPTE_EVALUATEUR :

							die();
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							
							
							if ($zDateDebut != "" && $zDateFin != "") {
								$this->load->model('decision_gcap_model','Decision');
								$zNotIn = "";
								$zUserId = $this->Transaction->getAllUserSubordonneesIsPointage ($_iCurrPage,$oUser,$oCandidat,$oUser['id'], $iCompteActif,$zNotIn);
								$toListe = $this->Transaction->RapportTransaction($zUserId,$iSeuil,$iNbrRetard,$zHeureSeuil,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);

								$this->Transaction->setExcelRapports($toListe, $zDateDebut, $zDateFin);

							} else {
								$toListe = array();
							}
							
							break;
					}

					
					break;

				case 'pdf' :
					$oData['menu'] = 38;
					$iNbrTotal = 0 ; 

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						case COMPTE_EVALUATEUR :

							die();
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							
							
							if ($zDateDebut != "" && $zDateFin != "") {
								$oData = array();
								$this->load->model('decision_gcap_model','Decision');
								$this->load->model('dgcap_gcap_model','Gcap');
								$zNotIn = "";
								$oData['toSigle'] = $this->Gcap->get_sigle($this,$oUser['id'],3);
								$zUserId = $this->Transaction->getAllUserSubordonneesIsPointage ($_iCurrPage,$oUser,$oCandidat,$oUser['id'], $iCompteActif,$zNotIn);
								$toListe = $this->Transaction->RapportTransaction($zUserId,$iSeuil,$iNbrRetard,$zHeureSeuil,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);
								$this->Transaction->setPdfRapports($oData,$toListe, $zDateDebut, $zDateFin);

							} else {
								$toListe = array();
							}
							
							break;
					}

					
					break;
			
			}
    	}
	}

	public function saisi($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat ;
		$oData['oCandidat1'] = $this->Gcap->get_by_user_id($_iId);
		$oData['menu'] = 39;

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
    	
		if($iRet == 1){	

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
							die("Votre compte ne permet pas d'acceder Ã  cette page. Merci!");
							
							break;

						case COMPTE_EVALUATEUR :
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :

								switch ($_zHashUrl) {

									case 'conges-et-autres':
										$oData['zTitle'] = utf8_encode("CongÃ©s et autres") ; 
										$oData['toGetCongeAutre'] = $this->AutreConge->toGetAutreConge($_iId);
										$this->load_my_view_Common('pointage/conges-et-autres.tpl',$oData, $iModuleId);
										break;

									case 'mission':

										$oData['toMission'] = $this->InOut->toGetMission($_iId);
										$oData['zTitle'] = "Missions" ; 
										$this->load_my_view_Common('pointage/mission.tpl',$oData, $iModuleId);
										break;

									case 'badge-perdu':
										$oData['toBadgePerdue'] = $this->InOut->toGetBadgePerdue($_iId);
										$oData['zTitle'] = "Badge perdu" ; 
										$this->load_my_view_Common('pointage/badge-perdu.tpl',$oData, $iModuleId);
										break;

									case 'entree-et-sortie' :

										$oData['toGetInOut'] = $this->InOut->toGetInOut($_iId);
										$oData['zTitle'] = utf8_encode("EntrÃ©e et sortie") ; 
										$this->load_my_view_Common('pointage/entree-et-sortie.tpl',$oData, $iModuleId);

										break;

									case 'formation':

									$oData['toFormation'] = $this->InOut->toGetFormation($_iId);
									$oData['zTitle'] = "Formations" ; 
									$this->load_my_view_Common('pointage/formation.tpl',$oData, $iModuleId);
									break;
								
								}
					}
    	
		} else {
			$this->mon_cv();
		}
    	
    }


	public function badge($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iValid = 0) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 37;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iCompteActif = $this->getSessionCompte();

			switch ($iCompteActif)
			{
				case COMPTE_AGENT :
					$iCompteActif = COMPTE_AGENT ; 

					$this->Transaction->updateNotificationCarte($oUser['id']);

					$zImCarte = '' ; 
					$iBadgeNumber = $this->Transaction->getBadgeNumber($oUser['id']);
					if ($iBadgeNumber != ''){
						$zImCarte = $this->Transaction->getImCarte($iBadgeNumber);
					}
					$oData['zImCarte'] = $zImCarte ; 
					$oData['toGetBadge'] = $this->Badge->toGetBadge($oUser['id'], $iCompteActif);
					break;

				case COMPTE_RESPONSABLE_PERSONNEL :
				case COMPTE_EVALUATEUR :
				case COMPTE_AUTORITE :
				case COMPTE_ADMIN :
					$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn);
					$oData['toGetBadge'] = $this->Badge->toGetBadge($zUserId, $iCompteActif,$_iValid);
					break;
			}
			
			$oData['iCompteActif'] = $iCompteActif;
			$oData['iValid'] = $_iValid;
			$oData['zTitle'] = "Badge" ; 
			$this->load_my_view_Common('pointage/badge.tpl',$oData, $iModuleId);

			
    	}
	}

	public function saveBadge($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$oDataSave["badge_userId"]		= $oUser["id"] ;
			$oDataSave["badge_demandeType"] = $this->postGetValue ("iRadioMotif",1) ; 

			if (trim($_FILES['zFileDeclaration']['name']) != "") {

				$zFileName = utf8_decode($_FILES["zFileDeclaration"]["name"]);
				$zFileName = str_replace(" ","_",$zFileName);
				$zFileName = strtr($zFileName, 
				'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

				$oDataSave["badge_document"]	= $zFileName; 


				switch ($oDataSave["badge_demandeType"]) {

					case '2':
						move_uploaded_file($_FILES['zFileDeclaration']['tmp_name'], "assets/upload/Badge/Perdu/".$zFileName);
						break;

					case '4':
						move_uploaded_file($_FILES['zFileDeclaration']['tmp_name'], "assets/upload/Badge/Piece/".$zFileName);
						break;
				}
			}

			$oDataSave["badge_motifs"]		= $this->postGetValue ("zMotif",0) ; 
			$oDataSave["badge_numero"]		= $this->postGetValue ("badge_numCarte","") ; 
			$oDataSave["badge_datePerdue"]	= $this->date_fr_to_en($this->postGetValue ("badge_datePerdue"),'/','-'); 
			$oDataSave["badge_date"]		= date("Y-m-d H:i:s") ;
			$this->Badge->insert($oDataSave);
			 
			redirect("pointage/badge/pointage-electronique/saisie");
			
    	}
	}


	public function saveCongeAutre($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$oDataSave["autreConge_userId"]		= $this->postGetValue ("user_id",0) ; 		
			$oDataSave["autreConge_dateDebut"]	= $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
			$oDataSave["autreConge_dateFin"]	= $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-');
			$oDataSave["autreConge_motif"]		= $this->postGetValue ("zMotif",0) ;
			$this->AutreConge->insert($oDataSave);
			 
			redirect("pointage/saisi/pointage-electronique/conges-et-autres/".$oDataSave["autreConge_userId"]);
			
    	}
	}

	public function saveInOut($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iUserSearchId = $this->postGetValue ("user_id",0) ;
			
			$zDate = $this->date_fr_to_en($this->postGetValue ("zDate"),'/','-'); 
			/*$zHeureEntree = $this->postGetValue ("heure_entree");
			$zHeureSortie = $this->postGetValue ("heure_sortie");*/

			$zHeureEntree = $this->postGetValue ("heure_entree") . ":" . $this->postGetValue ("minute_entree") . ":" . $this->postGetValue ("seconde_entree") ;
			//$zHeureSortie = $this->postGetValue ("heure_sortie") . ":" . $this->postGetValue ("minute_sortie") . ":" . $this->postGetValue ("seconde_sortie") ;

			
			$oDataSave["inOut_userId"]		= $iUserSearchId ; 		
			$oDataSave["inOut_date"]		= $zDate ;
			$oDataSave["inOut_userSendId"]	= $oUser['id'] ;
			$oDataSave["inOut_HeureDebut"]	= $zHeureEntree;
			//$oDataSave["inOut_HeureFin"]	= $zHeureSortie;

			$this->InOut->insert($oDataSave);

			$oUserSearch = $this->Gcap->get_candidat($iUserSearchId);

			if (sizeof ($oUserSearch)> 0){
				 
				$iMatricule = $oUserSearch['matricule'];
				$zDateTraitement = $this->postGetValue ("zDate");

				$toDateTraitement = explode("/", $zDateTraitement);

				$zDate = $toDateTraitement[2] . "-" . $toDateTraitement[0] . "-" . $toDateTraitement[1];
				$zDateEntree = $zDate . " " . $zHeureEntree ; 
				//$zDateSortie = $zDate . " " . $zHeureSortie ;  
				//$this->Transaction->SavePointageDirect ($iMatricule,$zDateEntree,$zDateSortie);
			}
			 
			redirect("pointage/saisi/pointage-electronique/entree-et-sortie/".$oDataSave["inOut_userId"]);
			
    	}
	}


	public function saveMission($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iUserSearchId	= $this->postGetValue ("user_id",0) ;
			$zMotif			= $this->postGetValue ("zMotif",0) ;
			
			$zDate = $this->date_fr_to_en($this->postGetValue ("zDate"),'/','-'); 

			//$zHeureEntree = $this->postGetValue ("heure_entree") . ":" . $this->postGetValue ("minute_entree") . ":" . $this->postGetValue ("seconde_entree") ;
			$zHeureSortie = $this->postGetValue ("heure_sortie") . ":" . $this->postGetValue ("minute_sortie") . ":" . $this->postGetValue ("seconde_sortie") ;

			
			$oDataSave["mission_userId"]		= $iUserSearchId ; 		
			$oDataSave["mission_date"]			= $zDate ;
			$oDataSave["mission_userSendId"]	= $oUser['id'] ;
			//$oDataSave["mission_HeureDebut"]	= $zHeureEntree;
			$oDataSave["mission_heureSortie"]	= $zHeureSortie;
			$oDataSave["mission_motif"]			= $zMotif;

			$this->InOut->insertMission($oDataSave);
			 
			redirect("pointage/saisi/pointage-electronique/mission/".$iUserSearchId);
			
    	}
	}
	
	public function saveFormation($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iUserSearchId	= $this->postGetValue ("user_id",0) ;
			$zMotif			= $this->postGetValue ("zMotif",0) ;
			
			$zDate = $this->date_fr_to_en($this->postGetValue ("zDate"),'/','-'); 

			//$zHeureEntree = $this->postGetValue ("heure_entree") . ":" . $this->postGetValue ("minute_entree") . ":" . $this->postGetValue ("seconde_entree") ;
			$zHeureSortie = $this->postGetValue ("heure_sortie") . ":" . $this->postGetValue ("minute_sortie") . ":" . $this->postGetValue ("seconde_sortie") ;

			
			$oDataSave["formation_userId"]		= $iUserSearchId ; 		
			$oDataSave["formation_date"]			= $zDate ;
			$oDataSave["formation_userSendId"]	= $oUser['id'] ;
			//$oDataSave["mission_HeureDebut"]	= $zHeureEntree;
			$oDataSave["formation_heureSortie"]	= $zHeureSortie;
			$oDataSave["formation_motif"]			= $zMotif;

			$this->InOut->insertFormation($oDataSave);
			 
			redirect("pointage/saisi/pointage-electronique/formation/".$iUserSearchId);
			
    	}
	}

	public function saveHourUser($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iInOutId = $this->postGetValue ("iInOutId",0) ;
			
			$zHeureSortie = $this->postGetValue ("zHeureSortie") . ":" . $this->postGetValue ("zMinuteSortie") . ":" . $this->postGetValue ("zSecondeSortie") ;

			$oDataSave["inOut_HeureFin"]	= $zHeureSortie;

			$this->InOut->update($oDataSave, $iInOutId);

			echo $zHeureSortie ; 
			
    	}
	}

	public function saveHourUserMission($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iMissionId		= $this->postGetValue ("iMissionId",0) ;
			$zDateEntree	= $this->date_fr_to_en($this->postGetValue ("zDateEntrer"),'/','-'); 
			$zHeureEntree	= $this->postGetValue ("zHeureEntree") . ":" . $this->postGetValue ("zMinuteEntree") . ":" . $this->postGetValue ("zSecondeEntree") ;

			$oDataSave["mission_heureEntree"]	= $zHeureEntree;
			$oDataSave["mission_dateEntree"]	= $zDateEntree;

			$this->InOut->updateMission($oDataSave, $iMissionId);

			$toReturn = array();
			$toReturn['zHeureEntree'] = $zHeureEntree;
			$toReturn['zDateEntrer'] = $this->postGetValue ("zDateEntrer");
			
			echo json_encode($toReturn); 
			
    	}
	}
	
	public function saveHourUserFormation($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iFormationId		= $this->postGetValue ("iFormationId",0) ;
			$zDateEntree	= $this->date_fr_to_en($this->postGetValue ("zDateEntrer"),'/','-'); 
			$zHeureEntree	= $this->postGetValue ("zHeureEntree") . ":" . $this->postGetValue ("zMinuteEntree") . ":" . $this->postGetValue ("zSecondeEntree") ;

			$oDataSave["formation_heureEntree"]	= $zHeureEntree;
			$oDataSave["formation_dateEntree"]	= $zDateEntree;

			$this->InOut->updateFormation($oDataSave, $iFormationId);

			$toReturn = array();
			$toReturn['zHeureEntree'] = $zHeureEntree;
			$toReturn['zDateEntrer'] = $this->postGetValue ("zDateEntrer");
			
			echo json_encode($toReturn); 
			
    	}
	}


	public function saveBadgeRetour($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iBadegId				= $this->postGetValue ("iBadegId",0) ;
			$zDateRetourBadge		= $this->date_fr_to_en($this->postGetValue ("zDateEntrer"),'/','-'); 
			$zNumDechargeRetour		= $this->postGetValue ("zNumDechargeRetour",0) ;
			
			$oDataSave["badge_dateRenduBadge"]		= $zDateRetourBadge;
			$oDataSave["badge_numDechargeRetour"]	= $zNumDechargeRetour;

			$this->Transaction->updateBadge($oDataSave, $iBadegId);

			$toReturn = array();
			$toReturn['zDateEntrer'] = $this->postGetValue ("zDateEntrer"). " (Num : ".$zNumDechargeRetour.")";
			
			echo json_encode($toReturn); 
			
    	}
	}

	public function saveBadgeValidation($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iBadegId			= $this->postGetValue ("iBadegId",0) ;
			$zDateRetourBadge	= $this->date_fr_to_en($this->postGetValue ("zDateEntrer"),'/','-'); 
			$zNumDechargeValidation	= $this->postGetValue ("zNumDechargeValidation",0) ;
			
			$oDataSave["badge_validation"]	= $zDateRetourBadge;
			$oDataSave["badge_numDechargeValidation"]	= $zNumDechargeValidation;

			$this->Transaction->updateBadge($oDataSave, $iBadegId);

			$toReturn = array();
			$toReturn['zDateEntrer'] = $this->postGetValue ("zDateEntrer") . " (Num : ".$zNumDechargeValidation.")";
			
			echo json_encode($toReturn); 
			
    	}
	}

	public function saveObtentionBadge($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iBadgeId		= $this->postGetValue ("iBadgeId",0) ;
			$zDateEntree	= $this->date_fr_to_en($this->postGetValue ("zDateEntrer"),'/','-'); 
			
			$oDataSave["badge_dateObtention"]	= $zDateEntree;

			$this->InOut->updateBadgeObtention($oDataSave, $iBadgeId);

			$toReturn = array();
			$toReturn['zDateEntrer'] = $this->postGetValue ("zDateEntrer");
			
			echo json_encode($toReturn); 
			
    	}
	}

	public function __testRapport() {
		
		$this->Transaction->testTransaction($this);
	}


	public function __transcription() {
		
		$this->Transaction->transcription_note();
	}

	public function insertZkGcap() {
		
		//$this->Transaction->insertGcapZkGcap();
	}


	public function MAJTransaction() {
		
		$this->Transaction->majTransaction();
	}

	public function ___insertZkInout() {
		
		$this->Transaction->insertGcapZkInout();
	}

	public function ____insertZkMission() {
		
		$this->Transaction->insertGcapZkMission();
	}

	/*public function transcriptiondgd() {
		
		$this->Transaction->transcriptionDgd();
	}

	public function UpdateComptedgd() {
		
		$this->Transaction->setEvaluateurDgd();
	}*/
	
	
	/*************************************/
	
	//PointageService
	
	
	
	public function testRangMysql() {
		///echo"ddddddd";die;
		//$total_heure	=	 $this->PointageService->calculTempsDeTravailMysql("2020-09-02","2020-09-02","332026");
		//echo $total_heure;die;
		$list_pointage	=	 $this->PointageService->get_repport("2020-01-03","2020-01-03","204");

		$this->PointageService->print_report_pdf($list_pointage,"2020-01-03","2020-01-03");
		die;
		echo $this->PointageService->calculTempsDeTravailMysql("2020-01-03","2020-01-03","283611");die;
	}

}