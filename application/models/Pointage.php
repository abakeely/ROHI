<?php
session_start();
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

	    	$this->load_my_view_Pointage('gcap/index.tpl',$oData, $iModuleId);
	    	
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

		if ($iCompteActif == COMPTE_ADMIN || $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL  || $iCompteActif == COMPTE_EVALUATEUR)
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
				$this->load_my_view_Pointage('pointage/moderation.tpl',$oData, -3);
			
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

				if ($iValue == 1) {
					$toModeration = $this->Transaction->setModeration($iModerationId);

					foreach ($toModeration as $oModeration) {
						$oData = array();
						$oData['login'] = $oModeration['moderation_login'];
						$oData['password'] = $oModeration['moderation_motDePasse'];
						$this->Transaction->update_password($oModeration['moderation_userId'],$oData,FALSE);
						$this->Transaction->update_moderationUser($oModeration['moderation_userId'], $iValue);
					}
				}  else {
					$this->Transaction->update_moderation($iModerationId, $iValue);
				}
				redirect("pointage/moderation/pointage-electronique/moderer");
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	public function liste($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$zDateDebut = $this->postGetValue ("date_debut",''); 
			$zDateFin = $this->postGetValue ("date_fin",'');
			$iMatricule = $this->postGetValue ("iMatricule",'');

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iCompteActif = $this->getSessionCompte();

			$oData['zDateDebut'] = $zDateDebut ; 
			$oData['zDateFin']	 = $zDateFin ; 

			$oData['iMatricule']	 = $iMatricule ; 

			$oUserMatricule = array();
			if ($iMatricule != "") {
				$oUserMatricule = $this->Transaction->get_by_matricule($iMatricule) ; 
			}

			$oData['oUserMatricule'] = $oUserMatricule;
			

			switch ($_zHashUrl) {

				case 'transaction':
					$oData['menu'] = 36;
					$zMessage = "";
					switch ($iCompteActif)
					{
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
							$toCandidatUser = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn);
							$toCandidatUser = unserialize($toCandidatUser);
							

							if (sizeof($toCandidatUser)>0) {
								$toCandidatUserMatricule = array();
								foreach ($toCandidatUser as $oCandidatUser)
								{
									 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["matricule"]);
								}
							}
							if (in_array($iMatricule, $toCandidatUserMatricule)) {

								$toGetAllTransaction = $this->Transaction->get_transaction($iMatricule,$iCompteActif,$oUser['id'],$oCandidat,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);

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

					$oData['zPagination'] = $zPagination ; 
					$oData['zMessage']	   = $zMessage ; 
					$oData['iCompteActif'] = $iCompteActif ; 
					$oData['iCurrPage'] = $_iCurrPage ; 
					$oData['toGetAllTransaction'] = $toGetAllTransaction ; 

					
					$this->load_my_view_Pointage('pointage/transaction.tpl',$oData, $iModuleId);
					break;

				case 'rang' :
					$oData['menu'] = 38;
					$iNbrTotal = 0 ; 

					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
						
						$toGetAllRang = $this->Transaction->get_Rang($iMatricule,$iCompteActif,$oUser['id'],$oCandidat,$zDateDebut,$zDateFin,$this, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);
						

						$oData['toGetAllRang'] = $toGetAllRang ; 
						$oData['iCompteActif'] = $iCompteActif ; 
						$this->load_my_view_Pointage('pointage/rang.tpl',$oData, $iModuleId);
							
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_EVALUATEUR :
						case COMPTE_AUTORITE :
						case COMPTE_ADMIN :
							
							
							if ($zDateDebut != "" && $zDateFin != "") {
								$this->load->model('decision_gcap_model','Decision');
								$zNotIn = "";
								$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn);
								$toListe = $this->Transaction->getRangRattache($zUserId, $oCandidat, $zDateDebut, $zDateFin, $this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);

								$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
								$oData['zPagination'] = $zPagination ; 
							} else {
								$toListe = array();
							}
							$iDepartementId = $this->postGetValue ("iDepartementId",0) ;
							$oData['oDataSearch']["iDepartementId"]	= $iDepartementId ;
							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['oDepartement'] = $this->Gcap->get_Organisation();
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$this->load_my_view_Pointage('pointage/rattacheRang.tpl',$oData, $iModuleId);
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
								$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn);
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
								$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn);
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
							$this->load_my_view_Pointage('pointage/rattache.tpl',$oData, $iModuleId);
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
							$this->load->model('gcap_gcap_model','Gcap');
							$toListe = $this->Gcap->get_all_gcap("",$oUser, $oCandidat, $oUser['id'], 0, $iCompteActif,1, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

							$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
							$oData['zPagination'] = $zPagination ; 

							$oData['oListe'] = $toListe ; 
							$oData['iCurrPage'] = $_iCurrPage ; 
							$oData['zHashUrl'] = $_zHashUrl ; 
							$oData['zHashModule'] = $_zHashModule ;
							$this->load_my_view_Pointage('pointage/GcapPointage.tpl',$oData, $iModuleId);
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
									$zUserId = $this->Transaction->getAllUserSubordonneesIsPointage ($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zNotIn);
									$toListe = $this->Transaction->RapportTransaction($zUserId,$iSeuil,$iNbrRetard,$zHeureSeuil,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);
								
									$oData['oListe'] = $toListe ; 

								} else {
									$toListe = array();
								}
								
								$this->load_my_view_Pointage('pointage/rapport.tpl',$oData, $iModuleId);

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
								$zUserId = $this->Transaction->getAllUserSubordonneesIsPointage ($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zNotIn);
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
								$zUserId = $this->Transaction->getAllUserSubordonneesIsPointage ($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zNotIn);
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

	    	switch ($_zHashUrl) {

				case 'conges-et-autres':

					$oData['toGetCongeAutre'] = $this->AutreConge->toGetAutreConge($_iId);
					$this->load_my_view_Pointage('pointage/conges-et-autres.tpl',$oData, $iModuleId);
					break;

				case 'mission':

					$oData['toMission'] = $this->InOut->toGetMission($_iId);
					$this->load_my_view_Pointage('pointage/mission.tpl',$oData, $iModuleId);
					break;

				case 'entree-et-sortie' :

					$oData['toGetInOut'] = $this->InOut->toGetInOut($_iId);
					$this->load_my_view_Pointage('pointage/entree-et-sortie.tpl',$oData, $iModuleId);

					break;
			
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }


	public function badge($_zHashModule = FALSE, $_zHashUrl = FALSE) {

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
					$oData['toGetBadge'] = $this->Badge->toGetBadge($oUser['id'], $iCompteActif);
					break;

				case COMPTE_RESPONSABLE_PERSONNEL :
				case COMPTE_EVALUATEUR :
				case COMPTE_AUTORITE :
				case COMPTE_ADMIN :
					$zUserId = $this->Transaction->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn);
					$oData['toGetBadge'] = $this->Badge->toGetBadge($zUserId, $iCompteActif);
					break;
			}
			
			$oData['iCompteActif'] = $iCompteActif;
			$this->load_my_view_Pointage('pointage/badge.tpl',$oData, $iModuleId);

			
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
				$oDataSave["badge_document"]	= $_FILES['zFileDeclaration']['name'] ; 

				switch ($oDataSave["badge_demandeType"]) {

					case '2':
						move_uploaded_file($_FILES['zFileDeclaration']['tmp_name'], "assets/upload/Badge/Perdu/".$_FILES['zFileDeclaration']['name']);
						break;

					case '4':
						move_uploaded_file($_FILES['zFileDeclaration']['tmp_name'], "assets/upload/Badge/Piece/".$_FILES['zFileDeclaration']['name']);
						break;
				}
				
				
				
			}

			$oDataSave["badge_motifs"]		= $this->postGetValue ("zMotif",0) ; 
			$oDataSave["badge_date"]		= date("Y-m-d H:m:s") ;
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

	public function testRapport() {
		
		$this->Transaction->testTransaction($this);
	}


	public function transcription() {
		
		$this->Transaction->transcription_note();
	}

	/*public function transcriptiondgd() {
		
		$this->Transaction->transcriptionDgd();
	}

	public function UpdateComptedgd() {
		
		$this->Transaction->setEvaluateurDgd();
	}

	public function UpdateCompteDge() {
		
		$this->Transaction->setEvaluateurDGE();
	}*/

}