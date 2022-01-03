<?php
/**
* @package ROHI
* @subpackage SAU
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Sau extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->sessionStartCompte();
		define ('MENU_VISITEUR', 56);
		define ('MENU_AGENT_SITUATION_PARTICULIER', 200);
		define ('MENU_LISTES_NOIRES', 201);
		define ('MENU_ESPACE_ECHANGE', 202);
		define ('MENU_STATISTIQUES', 203);

		$this->load->model('Transaction_pointage_model','Transaction');
		$this->load->model('Badge_pointage_model','Badge');
		$this->load->model('visiteur_sau_model','Visiteur');
		$this->load->model('candidat_model','candidat');
	}
	
	public function getPorte(){

		global $oSmarty ; 

		$oDepartement = $this->Gcap->get_Organisation();
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oDepartement",$oDepartement);
		$zGetPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getPorte.tpl" );
		
		echo $zGetPorte ;  
	}

	public function getPopUpBadgeRetour() {
		global $oSmarty ; 

		$iBadegId = $this->postGetValue ("iBadegId",'');
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iBadegId",$iBadegId);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getPopUpBadgeRetour.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 


	public function saveBadgeValidation1() {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oDataSave = array();

			$iBadegId	= $this->postGetValue ("iBadegId",0) ;
			$zMotif		= $this->postGetValue ("zMotif"); 
			
			$oDataSave["badge_actif"]	= 0;
			$oDataSave["badge_agentSignalUserId"]	= $oUser['id'];
			$oDataSave["badge_motif"]	= $zMotif;

			$this->Visiteur->updateBadge($oDataSave, $iBadegId);

			$toReturn = array();
			$toReturn['zMotif'] = $this->postGetValue ("zMotif");
			
			echo json_encode($toReturn); 
			
    	}
	}

	public function getBadge(){

		global $oSmarty ; 

		$zGetBadge = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getBadge.tpl" );
		
		echo $zGetBadge ;  
	}

	public function getPorteSelect2(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		if (isset ($_GET['iFiltre']))
        {
            $iFiltre = $_GET['iFiltre'] ;
        }

		$toListe = $this->Visiteur->get_all_porte($zTerm);

		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe['porte_id'];
            $toTemp["text"] = $oListe['porte_nom'] ;
            $toRes []       = $toTemp ;
        }

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	public function getBadgeSelect2(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		if (isset ($_GET['iFiltre']))
        {
            $iFiltre = $_GET['iFiltre'] ;
        }

		$toListe = $this->Visiteur->get_all_badgeDispoToDay($zTerm);

		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe['badge_id'];
            $toTemp["text"] = $oListe['badge_nom'] ;
            $toRes []       = $toTemp ;
        }

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}


	public function getBadgeSelect22(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		if (isset ($_GET['iFiltre']))
        {
            $iFiltre = $_GET['iFiltre'] ;
        }

		$toListe = $this->Visiteur->get_all_badgeTransaction($zTerm);

		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe['badge_id'];
            $toTemp["text"] = $oListe['badge_nom'] ;
            $toRes []       = $toTemp ;
        }

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}


	public static function pre_print($_oObjet) {

		echo "<pre>" ; 
		print_r($_oObjet);
		echo "</pre>";
	}

	public function addUser() {
		global $oSmarty ; 

		$toPorte = $this->Visiteur->get_all_porte();
		$toBadge = $this->Visiteur->get_all_badge();
		$oSmarty->assign("toPorte", $toPorte);
		$oSmarty->assign("toBadge", $toBadge);
		$oSmarty->assign('zBasePath', base_url());
		$zFormUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getFormUser.tpl" );
		
		echo $zFormUser ;  
	}

	public function getInfoNumBadge() {
		global $oSmarty ; 

		$iAttributionId	= $this->postGetValue ("iAttributionId",0) ;
		
		$oGetInfoBadge = $this->Visiteur->getInfoBadgeId($iAttributionId) ; 
		$toBadge = $this->Visiteur->get_all_badgeDispo();

		$toAttribution = $this->Visiteur->getBadgeAttributionId($iAttributionId);
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("iAttributionId",$iAttributionId);
		$oSmarty->assign("oGetInfoBadge",$oGetInfoBadge);
		$oSmarty->assign("toBadge",$toBadge);
		$oSmarty->assign("toAttribution",$toAttribution);
		$zGetPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getInfoNumBadge.tpl" );
		
		echo $zGetPorte ;  
	}

	public function getInfoVisiteur(){

		$iVisiteurId	= $this->postGetValue ("idSelect",0) ;

		$toVisiteur = $this->Visiteur->getVisteurId($iVisiteurId);

		if (sizeof($toVisiteur)>0) {
				$toReturn = $toVisiteur[0];
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}


	public function getInfoVisiteurByCin(){

		$iCinVisiteur	= $this->postGetValue ("iCinVisiteur",0) ;

		$toVisiteur = $this->Visiteur->getVisteurByCin($iCinVisiteur);

		$iIncrement=0;
		foreach ($toVisiteur as $oVisiteur){
			if ($oVisiteur['visiteur_listeNoire'] == 1){

				

				$zNomCandidat = "" ; 
				if ($oVisiteur['visiteur_listeNoirUserId'] != ''){
					$oCandidat = $this->candidat->get_by_user_id($oVisiteur['visiteur_listeNoirUserId']);
					if (sizeof($oCandidat)>0){
						$zNomCandidat = $oCandidat[0]->nom . " " . $oCandidat[0]->prenom ; 
					}
				}

				$toVisiteur[$iIncrement]['zNom'] = $zNomCandidat ; 

				$oPoste = $this->Visiteur->getPoste($oVisiteur['visiteur_posteId']);
				$zLibellePoste = "" ; 
				if (sizeof($oPoste)>0){
					$zLibellePoste = $oPoste[0]->poste_libelle ; 
				}

				$toVisiteur[$iIncrement]['zPoste'] = $zLibellePoste ; 
			}
			$iIncrement++;
		}

		if (sizeof($toVisiteur)>0) {
				$toReturn = $toVisiteur[0];
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}


	public function GetAgent(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		if (isset ($_GET['iFiltre']))
        {
            $iFiltre = $_GET['iFiltre'] ;
        }

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();


		$toListe = $this->Visiteur->get_all_list_candidat2($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zTerm, $iFiltre);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->user_id;
            $toTemp["text"] = $oListe->nom ." " . $oListe->prenom ;
			$toTemp["badgeNonRendu"] = $this->Visiteur->check_if_exist_badge_attribution($oListe->user_id);
			if ($oListe->type_photo != ''){
				$toTemp["photo"] = "<img src='http://rohi.mef.gov.mg:8088/ROHI/assets/upload/" . $oListe->id . "." . $oListe->type_photo . "' width='200' />"  ;
			} else {
				$zImageDefault = base_url().'assets/upload/default.jpg'; 
				$toTemp["photo"] = "<img src='".$zImageDefault."' width='100' />"  ;
			}
            $toRes []       = $toTemp ;
        }
		
        $zToReturn = json_encode ($toTemp) ;
		
		echo $zToReturn ; 
		
	}


	public function setUpdateVisit(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();

		$iVisitId	= $this->postGetValue ("iVisitId",0) ;

		$oData = array();
		$oData['visite_userSaisieSortieId'] = $oUser['id'];
		$oData['visite_dateSortie'] = date("Y-m-d") ;
		$oData["visite_heureSortie"] = date("H:i:s") ;  
		$this->Visiteur->updateVisite($oData, $iVisitId);

		if (sizeof($toVisiteur)>0) {
				$toReturn = $toVisiteur[0];
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}

	public function getInfoCandidat(){

		$iCandidatId	= $this->postGetValue ("idSelect",0) ;

		$oCandidat = $this->candidat->get_by_user_id($iCandidatId);

		if (sizeof($oCandidat)>0) {
				$toReturn = $oCandidat[0];
		} else {
				$toReturn = array();
				$toReturn['user_id'] = -1;
				$toReturn['message'] = '';
		}

		echo json_encode($toReturn); 
	}

	public function getVisiteur(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		if (isset ($_GET['iFiltre']))
        {
            $iFiltre = $_GET['iFiltre'] ;
        }

		if (isset ($_GET['iRechercheId']))
        {
            $iRechercheId = $_GET['iRechercheId'] ;
        }

		$toListe = $this->Visiteur->get_all_list_visiteur($zTerm, $iRechercheId);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->visiteur_id;
            $toTemp["text"] = $oListe->visiteur_nom ." " . $oListe->visiteur_prenom ;
            $toRes []       = $toTemp ;
        }

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	public function __visiteurs($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	$oData['menu'] = MENU_VISITEUR;
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iMatricule	= $this->postGetValue ("iMatricule",'') ;
	    	
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			switch ($_zHashUrl) {
				
				case "ajout" :

					$toPorte = $this->Visiteur->get_all_porte();
					$toBadge = $this->Visiteur->get_all_badge();
					
					$oData['oListe'] = $this->Visiteur->get_all_visiteur();
					$oData['toPorte']= $toPorte;
					$oData['toBadge']= $toBadge;

					$this->load_my_view_Sau('sau/ajoutVisiteur.tpl',$oData, $iModuleId);
					break;
				
				case "liste" :

					$toPorte = $this->Visiteur->get_all_porte();
					$toBadge = $this->Visiteur->get_all_badge();
					
					$oData['oListe'] = $this->Visiteur->get_all_visiteur();
					$oData['toPorte']= $toPorte;
					$oData['toBadge']= $toBadge;

					$this->load_my_view_Sau('sau/listeVisiteur.tpl',$oData, $iModuleId);
					break;
			}

		} else {
			$this->mon_cv();
		}
    	
    }

	public function listeVisiteToDay (){
		global $oSmarty ; 

		$zDateDebutInit = $this->postGetValue ("zDateDebut",'') ; 
		$zDateFinInit = $this->postGetValue ("zDateFin",'') ; 
		$zDateDebut = $this->date_fr_to_en($zDateDebutInit,'/','-'); 
		$zDateFin = $this->date_fr_to_en($zDateFinInit,'/','-'); 

		$oListe = $this->Visiteur->get_all_visiteur($zDateDebut, $zDateFin,1);
		//$oListeSortie = $this->Visiteur->get_all_visiteur($zDateDebut, $zDateFin,2);
		
		$oSmarty->assign("toListe", $oListe);
		$oSmarty->assign("oListeSortie", $oListe);
		$oSmarty->assign("iCountListe", sizeof($oListe));
		$oSmarty->assign("iCountSortie", sizeof($oListe));
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('zDateDebut', $zDateDebutInit);
		$oSmarty->assign('zDateFin', $zDateFinInit);
		//$zFormListeVisiteur = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getVisiteur.tpl" );

		$toReturn = array();
		
		$toReturn['iCount'] = sizeof($oListe);
		$toReturn['zFormListeVisiteur'] = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getVisiteur.tpl" );
			
		echo json_encode($toReturn);  
	}

	public function agent ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$oData['menu'] = MENU_AGENT_SITUATION_PARTICULIER;
		$oData['iNotificationAffiche'] = 1;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		$iCompteActif = $this->getSessionCompte();

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['oCandidat'] = $oCandidat;
    	
		if($iRet == 1){	

			$toPorte = $this->Visiteur->get_all_porte();
			$toBadge = $this->Visiteur->get_all_badge();
			
			$oData['oListe'] = $this->Visiteur->get_all_visiteur();
			$oData['toPorte']= $toPorte;
			$this->load_my_view_Sau('sau/agent.tpl',$oData, $iModuleId);

		} else {
			$this->mon_cv();
		}

	}

	public function login ($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		
		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
    	
		if($iRet == 1){

			if(isset($_POST["iSiteId"]) && ($_POST["iSiteId"] != 0)){
				$iSiteId			= $this->postGetValue ("iSiteId",0) ; 
				$_SESSION["session_PosteSAU"] = $iSiteId ; 
				redirect("sau/visiteurs/gestion-visiteur/ajout") ; 
			}
			$toPoste = $this->Visiteur->get_all_poste($oUser['id']);
			$oData['toPoste']	= $toPoste;
			$this->load_my_view_Sau('sau/login.tpl',$oData, $iModuleId, 0);
		} else {
			$this->mon_cv();
		}
	}

	public function logout ($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		if($iRet == 1){

			if(isset($_SESSION["session_PosteSAU"]) && ($_SESSION["session_PosteSAU"] != "")){
				unset($_SESSION["session_PosteSAU"]);
				redirect("sau/login/gestion-visiteur/accueil") ; 
			}

		} else {
			$this->mon_cv();
		}
	}

	public function listesNoires ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$oData['menu'] = 755;
		$oData['iNotificationAffiche'] = 1;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		$iCompteActif = $this->getSessionCompte();

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['oCandidat'] = $oCandidat;
    	
		if($iRet == 1){	
			$oListe = $this->Visiteur->get_all_ListeNoirs();
			$oData['oListe']	= $oListe;
			$this->load_my_view_Sau('sau/listesNoires.tpl',$oData, $iModuleId, 3);
		} else {
			$this->mon_cv();
		}
	}

	public function visiteurs ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$oData['menu'] = 54;
		$oData['iNotificationAffiche'] = 1;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		$iCompteActif = $this->getSessionCompte();

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['oCandidat'] = $oCandidat;
    	
		if($iRet == 1){	
			/*$toPorte = $this->Visiteur->get_all_porte();
			$toBadge = $this->Visiteur->get_all_badgeDispoToDay();*/
			
			
			/*$oData['toPorte']	= $toPorte;
			$oData['toBadge']	= $toBadge;*/
			/*$oData['oListe']	= $oListe;*/
			$oData['iCount']	= $iNombre = $this->Visiteur->countAll();
			$this->load_my_view_Sau('sau/echange.tpl',$oData, $iModuleId, 2);
		} else {
			$this->mon_cv();
		}
	}

	public function badge($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 756;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

			//$oData['toGetBadge'] = $this->Visiteur->toGetBadge();

			$this->load_my_view_Sau('sau/badge.tpl',$oData, $iModuleId,4);

			
    	}
	}

	public function annuaire($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 757;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

			$this->load->model('fonctionsSelectGlobales', 'select');

			$oData['liste'] = json_encode($this->select->getSimpleList('candidat', 'matricule, nom, prenom, cin, lacalite_service, porte'));
	

			$this->load_my_view_Sau('sau/annuaire.tpl',$oData, $iModuleId,5);

			
    	}
	}

	public function statistiques ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);
    	
		if($iRet == 1){	
			$oData = array();

			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 753;

			$zDateDebutInit = $this->postGetValue ("zDateDebut",'') ; 
			$zDateFinInit = $this->postGetValue ("zDateFin",'') ; 
			$zDateDebut = $this->date_fr_to_en($zDateDebutInit,'/','-'); 
			$zDateFin = $this->date_fr_to_en($zDateFinInit,'/','-'); 

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

			$toStatistiqueCirculaire = $this->Visiteur->statistiqueCirculaire($zDateDebut, $zDateFin);
			$toStatistiqueGraph = $this->Visiteur->statistiqueVisite();
			$toStatistiqueDepartement = $this->Visiteur->statistiqueLocalite($zDateDebut, $zDateFin, 1);
			$toStatistiqueDirection = $this->Visiteur->statistiqueLocalite($zDateDebut, $zDateFin, 2);
			$toStatistiqueService = $this->Visiteur->statistiqueLocalite($zDateDebut, $zDateFin, 3);

			$oData['toStatistiqueCirculaire']	= $toStatistiqueCirculaire ; 
			$oData['toStatistiqueGraph']		= $toStatistiqueGraph ; 
			$oData['toStatistiqueDepartement']	= $toStatistiqueDepartement ; 
			$oData['toStatistiqueDirection']	= $toStatistiqueDirection ; 
			$oData['toStatistiqueService']		= $toStatistiqueService ; 
			$oData['zDateDebut']				= $zDateDebutInit ; 
			$oData['zDateFin']					= $zDateFinInit ; 
			$this->load_my_view_Sau('sau/statistiques.tpl',$oData, $iModuleId, 1);
		} else {
			$this->mon_cv();
		}
	}

	public function transactions ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
	
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);
		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
    	
		if($iRet == 1){	
			$oData = array();

			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 758;

			$iBadgeId 			= $this->postGetValue ("badge_id",'') ; 
			$zDateDebutInit 	= $this->postGetValue ("zDateDebut",'') ; 
			$zDateFinInit 		= $this->postGetValue ("zDateFin",'') ; 
			$zDateDebut 		= $this->date_fr_to_en($zDateDebutInit,'/','-'); 
			$zDateFin 			= $this->date_fr_to_en($zDateFinInit,'/','-'); 
			
			$toGetAllTransaction = array();
			$toAllVisiteur = array();
			$zPagination ="";
			if ($zDateDebutInit != '' && $zDateFinInit != '' && $iBadgeId != ''){
				$toGetAllTransaction = $this->Transaction->get_transactionVisiteur($iBadgeId,$zDateDebut,$zDateFin,$this,$iNbrTotal, NB_PER_PAGE, $_iCurrPage);
				//$zPagination = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
			}

			$zTextBadge = "";
			if ($iBadgeId > 0){
				$toAttribution = $this->Visiteur->getBadge($iBadgeId);
				$zTextBadge = $toAttribution[0]->badge_nom;
				$toAllVisiteur = $this->Visiteur->getVisiteAllDateAndBadge($iBadgeId, $zDateDebut, $zDateFin);
			}

			$oData['zDateDebut']				= $zDateDebutInit ; 
			$oData['zDateFin']					= $zDateFinInit ; 
			$oData['toGetAllTransaction']		= $toGetAllTransaction ; 
			$oData['toAllVisiteur']				= $toAllVisiteur ; 
			$oData['iBadgeId']					= $iBadgeId ; 
			$oData['zMessage']					= "" ; 
			$oData['zTextBadge']				= $zTextBadge ; 
			$this->load_my_view_Sau('sau/transaction.tpl',$oData, $iModuleId, 6);
		} else {
			$this->mon_cv();
		}
	}


	public function badgeListing ($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);
		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
    	
		if($iRet == 1){	
			$oData = array();

			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 759;

			$toAllBadge = $this->Visiteur->listeDesBadgesVisiteursEtProvisoires();
			
			$oData['toAllBadge']				= $toAllBadge ;  
			$this->load_my_view_Sau('sau/allBadge.tpl',$oData, $iModuleId, 7);
		} else {
			$this->mon_cv();
		}
	}

	function save ($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$idSelect 		= $this->postGetValue ("idSelect",0) ; 
		$zVisiteurNom	= $this->postGetValue ("visiteur_nom",0) ; 
		$zVisteurPrenom = $this->postGetValue ("visiteur_prenom",0) ; 
		$zVisiteurCin	= $this->postGetValue ("visiteur_cin",0) ; 

		$iBadgeId			= $this->postGetValue ("badge_id",0) ; 
		$iPorteId			= $this->postGetValue ("porte_id",0) ;
		$isListeNoire		= $this->postGetValue ("listeNoire",0) ;
		$zMotifsListeNoires	= $this->postGetValue ("visiteur_motifs",0) ;
		$zPermis			= $this->postGetValue ("visiteur_permis",'') ;
		$zAutreIntitule		= $this->postGetValue ("visiteur_autreIntitule",'') ;
		$zAutreValue		= $this->postGetValue ("visiteur_autreValue",'') ;

		if($iRet == 1){	

			$iVisiteurId = $idSelect ; 
			
			if ($idSelect == "" || $idSelect ==0) {
			
				$oDataVisiteurNew = array();
				$oDataVisiteurNew["visiteur_nom"]				= $zVisiteurNom ; 
				$oDataVisiteurNew["visiteur_userSendId"]		= $oUser["id"] ; 
				$oDataVisiteurNew["visiteur_prenom"]			= $zVisteurPrenom ;
				$oDataVisiteurNew["visiteur_cin"]				= $zVisiteurCin ; 
				$oDataVisiteurNew["visiteur_posteId"]			= $_SESSION["session_PosteSAU"] ; 

				if ($isListeNoire == 1) {
					$oDataVisiteurNew["visiteur_listeNoire"]		= $isListeNoire ; 
					$oDataVisiteurNew["visiteur_motifsListeNoire"]	= $zMotifsListeNoires ; 
					$oDataVisiteurNew["visiteur_listeNoirUserId"]	= $oUser["id"] ; 
				}
				

				$oDataVisiteurNew["visiteur_permis"]			= $zPermis ; 
				$oDataVisiteurNew["visiteur_autreIntitule"]		= $zAutreIntitule ; 
				$oDataVisiteurNew["visiteur_autreValue"]		= $zAutreValue ; 

				$iVisiteurId = $this->Visiteur->insertVisiteur($oDataVisiteurNew);
			} else {
				$oDataVisiteurLast = array();
				$oDataVisiteurLast["visiteur_userSendId"]		= $oUser["id"] ; 
				$oDataVisiteurLast["visiteur_nom"]				= $zVisiteurNom ; 
				$oDataVisiteurLast["visiteur_prenom"]			= $zVisteurPrenom ; 

				if ($isListeNoire == 1) {
					$oDataVisiteurLast["visiteur_listeNoire"]		= $isListeNoire ; 
					$oDataVisiteurLast["visiteur_motifsListeNoire"]	= $zMotifsListeNoires ; 
					$oDataVisiteurLast["visiteur_listeNoirUserId"]	= $oUser["id"] ; 
				}
 
				$oDataVisiteurLast["visiteur_permis"]			= $zPermis ; 
				$oDataVisiteurLast["visiteur_autreIntitule"]	= $zAutreIntitule ; 
				$oDataVisiteurLast["visiteur_autreValue"]		= $zAutreValue ; 
				$this->Visiteur->updateVisiteurs($oDataVisiteurLast,$idSelect);
			}


			$oVisite = array();

			$oVisite["visite_visiteurId"]	= $iVisiteurId ; 
			$oVisite["visite_userSaisieId"] = $oUser['id'] ; 
			$oVisite["visite_badgeId"]		= $iBadgeId ;
			$oVisite["visite_posteId"]		= $_SESSION["session_PosteSAU"] ;
			if ($iPorteId != 0) {
				$oVisite["visite_porteId"]		= $iPorteId ; 
			}
			$oVisite["visite_date"]			= date("Y-m-d") ; 
			$oVisite["visite_heureEntree"]	= date("H:i:s") ;

			$this->Visiteur->insertVisite($oVisite);

			$oListe = $this->Visiteur->get_all_visiteur();
			echo sizeof($oListe) ;  
			
    	
		} else {
			$this->mon_cv();
		}
	}

	function savePorte() {
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iDepartementId		= $this->postGetValue ("iDepartementId",0) ; 
		$iDirection			= $this->postGetValue ("iDirection",0) ; 
		$iService			= $this->postGetValue ("iService",0) ; 
		$zPorte				= $this->postGetValue ("zPorte",0) ; 

		if($iRet == 1){	
			
			$oDataPorte = array();

			$oDataPorte["porte_departementId"]		= $iDepartementId ; 
			$oDataPorte["porte_directionId"]		= $iDirection ;
			$oDataPorte["porte_serviceId"]			= $iService ; 
			$oDataPorte["porte_nom"]				= $zPorte ; 

			$this->Visiteur->insertPorte($oDataPorte);

			$toPorte = $this->Visiteur->get_all_porte();
		
			$oSmarty->assign("toPorte", $toPorte);
			$oSmarty->assign('zBasePath', base_url());
			$zFormPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getFormPorte.tpl" );
			echo $zFormPorte ;  
			
    	
		} else {
			$this->mon_cv();
		}
	}

	function saveBadgeNumBadge() {

		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iUserId		= $this->postGetValue ("iUserId",0) ; 
		$iNumBadgeId	= $this->postGetValue ("iNumBadgeId",0) ;  

		if($iRet == 1){	
			
			$oDataAttribution = array();

			$oDataAttribution["attribution_userId"]		 = $iUserId ; 
			$oDataAttribution["attribution_numBadgeId"]	 = $iNumBadgeId ;
			$oDataAttribution["attribution_dateEntree"]	 = date("Y-m-d") ; 
			$oDataAttribution["attribution_heureEntree"] = date("H:i:s") ;
			$oDataAttribution["attribution_userSaisieId"] = $oUser['id'] ;
			$this->Visiteur->insertAttribution($oDataAttribution);

			$toBadge = $this->Visiteur->get_all_badge($iNumBadgeId);
		
			echo $iUserId ;  
			
    	
		} else {
			$this->mon_cv();
		}
	}


	function GeTableBadge(){

		global $oSmarty ; 

		$iUserId		= $this->postGetValue ("iUserId",0) ; 

		$toBadgeUser = $this->Visiteur->getBadgeUser($iUserId);

		$oSmarty->assign("toBadgeUser", $toBadgeUser);
		$oSmarty->assign('zBasePath', base_url());
		$zFormPorte = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/geTableBadge.tpl" );
		echo $zFormPorte ;   
	}

	function setUpdateAttributionDate() {

		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iAttributionId		= $this->postGetValue ("iAttributionId",0) ;  

		if($iRet == 1){	
			
			$oDataAttribution = array();

			$oDataAttribution["attribution_dateSortie"]			= date("Y-m-d") ; 
			$oDataAttribution["attribution_heureSortie"]		= date("H:i:s") ;
			$oDataAttribution["attribution_userSortieId"]		= $oUser['id'] ;
			
			$this->Visiteur->updateAttribution($oDataAttribution, $iAttributionId);

			$toAttribution = $this->Visiteur->getBadgeAttributionLastId($iAttributionId);

			$zDateAttribution = $this->date_en_to_fr($toAttribution[0]->attribution_dateSortie,'-','/');
		
			$toReturn = array();
			$toReturn['zDateAttribution']  = $zDateAttribution;
			$toReturn['zHeureAttribution'] = $toAttribution[0]->attribution_heureSortie;
			$toReturn['zPrenomSortie'] = $oCandidat[0]->prenom;
		
			echo json_encode($toReturn); 
			
    	
		} else {
			$this->mon_cv();
		}
	}

	function leverSanction() {

		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$iVisiteurId		= $this->postGetValue ("iVisiteurId",0) ;  

		if($iRet == 1){	
			
			$oData = array();

			$oData["visiteur_listeNoire"] = 0 ; 
			
			$this->Visiteur->update($oData, $iVisiteurId);

			redirect("sau/listesNoires/gestion-visiteur/liste") ; 
    	
		} else {
			$this->mon_cv();
		}
	}

	function import() {

		$this->Visiteur->import();
	}

	function importPorte() {

		$this->Visiteur->importPorte();
	}

	function importBadge() {

		$row = 1;
		if (($handle = fopen(ADMIN_TEMPLATE_PATH . "sau/insertBadge.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$num = count($data);
				echo "<p> $num champs à la ligne $row: <br /></p>\n";
				$row++;

				$oDataBadge= array();
				$oDataBadge["badge_posteId"]	= $data[1] ; 
				$oDataBadge["badge_numIdent"]	= $data[0] ; 
				$oDataBadge["badge_nom"]		= $data[2] ; 

				$this->Visiteur->insertBadge($oDataBadge);
			}
			fclose($handle);
		}

	}

	function saveBadge() {
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkSAU($oUser, $oCandidat);

		$zNumBadge		= $this->postGetValue ("zNumBadge",0) ; 
		$zNomBadge		= $this->postGetValue ("zNomBadge",0) ; 

		if($iRet == 1){	
			
			$oDataBadge= array();

			$oDataBadge["badge_posteId"]	= $_SESSION["session_PosteSAU"] ; 
			$oDataBadge["badge_numIdent"]	= $zNumBadge ; 
			$oDataBadge["badge_nom"]		= $zNomBadge ; 

			$this->Visiteur->insertBadge($oDataBadge);

			$toBadge = $this->Visiteur->get_all_badgeDispoToDay();
		
			$oSmarty->assign("toBadge", $toBadge);
			$oSmarty->assign('zBasePath', base_url());
			$zFormBadge = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sau/getFormBadge.tpl" );
			echo $zFormBadge ;  
			
    	
		} else {
			$this->mon_cv();
		}
	}
}