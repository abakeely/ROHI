<?php
/**
* @package ROHI
* @subpackage Common
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Common extends MY_Controller {

	/**  
	* Classe qui concerne les modules commun de ROHI
	* @package  ROHI  
	* @subpackage common */ 
	public function __construct(){
		parent::__construct();

		$this->sessionStartCompte();
		$this->load->model('Agenda_avenant_model','Agenda');
		$this->load->model('Common_model','common');
		$this->load->model('Transaction_pointage_model','Transaction');
	}

	/** 
	* Affichage objet 
	*
	* @param objet $_oObjet objet à afficher
	* @return 
	*/
	public static function pre_print($_oObjet) {

		echo "<pre>" ; 
		print_r($_oObjet);
		echo "</pre>";
	}

	/** 
	* Sauvegarde theme d'un utilisateur connecté
	*
	* @return 
	*/
	function saveChangeTheme(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		
		$zTheme = $this->postGetValue ("zTheme",'');
		$zFond = $this->postGetValue ("zFond",'');
    	
		if($iRet == 1){	
		
			$oData  = array();
			$oData['fondPage_userId']			= $oUser['id'];
			if($zTheme != ''){
				$oData['fondPage_photo']			= $zTheme;
			}

			if($zFond != ''){
				$oData['fondPage_couleur']			= $zFond;
			}

			$this->common->saveConfiguration($oData);
		}
	}

	/** 
	* Sauvegarde Fond d'ecran d'un utilisateur connecté
	*
	* @return 
	*/
	function saveChangeBackGround(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData  = array();
			
			if (isset($_FILES['imagefond']) && trim($_FILES['imagefond']['name']) != "") {
				$oFile = $_FILES['imagefond'];
				$zFileName = $oFile['name'];
				$zTmpName = $oFile["tmp_name"];
				@move_uploaded_file($zTmpName, "assets/common/upload/$zFileName");
				
				$oData['fondPage_couleur'] = $_FILES['imagefond']['name']; 

				$oData['fondPage_userId']			= $oUser['id'];

				$this->common->saveConfiguration($oData);

				echo trim($_FILES['imagefond']['name']) ; 
			}
			
			
		}
	}

	/** 
	* Sauvegarde contact
	*
	* @return 
	*/
	public function contact(){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['iNotificationAffiche'] = 1;
			$oData['oCandidat'] = $oCandidat;

			$oData['zBasePath'] = base_url() ;
			$oData['iPrivModif'] = $iPrivModif ;
			$oData['zContent'] = '' ;
			$oData['zTile'] = '' ;
			$oData['iPageId'] = '' ;
			$oData['zHashUrl'] = '' ;
	    	$this->load_my_view_Gcap('gcap/contact.tpl',$oData, -100);
	    	
    	}
    	
    }

	/** 
	* Sauvegarde contactez nous
	*
	* @return 
	*/
	public function contacteznous(){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['iNotificationAffiche'] = 1;
			$oData['oCandidat'] = $oCandidat;

			$oData['zBasePath'] = base_url() ;
			$oData['iPrivModif'] = $iPrivModif ;
			$oData['zContent'] = '' ;
			$oData['zTile'] = '' ;
			$oData['iPageId'] = '' ;
			$oData['zHashUrl'] = '' ;
	    	$this->load_my_view_Gcap('gcap/contact-us.tpl',$oData, -100);
	    	
    	}
    	
    }

	/** 
	* plan du site
	*
	* @return 
	*/
	public function plandusite(){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['iNotificationAffiche'] = 1;
			$oData['oCandidat'] = $oCandidat;

			$oData['zBasePath'] = base_url() ;
			$oData['iPrivModif'] = $iPrivModif ;
			$oData['iCompteActif'] = $iCompteActif ;
			$oData['zContent'] = '' ;
			$oData['zTile'] = '' ;
			$oData['iPageId'] = '' ;
			$oData['zHashUrl'] = '' ;
	    	$this->load_my_view_Gcap('gcap/plan-du-site.tpl',$oData, -100);
	    	
    	}
    	
    }

	/** 
	* resultat de recherche
	*
	* @return 
	*/
	public function searchResult($iCurrPage=1){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$iNbrTotal = 0 ; 
			$iSearch = 0 ; 

			$toUserAutorise = array ('354816','355857','283611','389671', '355037', '374987','332026','307381','355577');

			$iAfficheEdit = 0;
			if (in_array($oUser['im'], $toUserAutorise)) {

				$iAfficheEdit = 1;
			}

			$iDepartementId		= $this->postGetValue ("iDepartementId",'') ;
			$iDirectionId		= $this->postGetValue ("iDirectionId",'') ;
			$iServiceId			= $this->postGetValue ("iServiceId",'') ;
			$iDivisionId		= $this->postGetValue ("iDivisionId",'') ;
			$iDivisionId		= $this->postGetValue ("iDivisionId",'') ;
			$iMatricule			= $this->postGetValue ("iMatricule",'') ;
			$iCin				= $this->postGetValue ("iCin",'') ;
			$zLocalite			= $this->postGetValue ("zLocalite",'') ;
			$zParcoursDiplome	= $this->postGetValue ("zParcoursDiplome",'') ;

			$oData['oDataSearch']["iDepartementId"]		= $iDepartementId ;
			$oData['oDataSearch']["iDirectionId"]		= $iDirectionId ;
			$oData['oDataSearch']["iServiceId"]			= $iServiceId ;
			$oData['oDataSearch']["iDivisionId"]		= $iDivisionId ;
			$oData['oDataSearch']["zLocalite"]			= $zLocalite ;
			$oData['oDataSearch']["iMatricule"]			= $iMatricule ;
			$oData['oDataSearch']["iCin"]				= $iCin ;
			$oData['oDataSearch']["zParcoursDiplome"]	= $zParcoursDiplome ;

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

			$oData['zLocalite'] = $zLocalite ; 
			$oData['zParcoursDiplome'] = $zParcoursDiplome ; 

			$oListe = $this->candidat->get_all_candidat($iSearch, $oData['oDataSearch'],$iNbrTotal, NB_PER_PAGE, $iCurrPage);
			$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE,1) ;

			$oData['oListe'] = $oListe ; 
			$oData['zPagination'] = $zPagination ; 

			$oData['zBasePath']		= base_url() ;
			$oData['iAfficheEdit']	= $iAfficheEdit ;
			$oData['iSearch']		= $iSearch ;

	    	$this->load_my_view_Gcap('gcap/resultPage.tpl',$oData, -100);
	    	
    	}
    	
    }

	/** 
	* les evenements concernant un utilisateur connecté
	*
	* @return 
	*/
	public function getAddEvent() {
		global $oSmarty ; 

		$iUserId = $this->postGetValue ("iUserId",'');
		$iInOutId = $this->postGetValue ("iInOutId",'');

		$oEvenement = $this->Agenda->geTypeEvenement();
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oEvenement",$oEvenement);
		$zGetGetPopHeure = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "event/getEventForm.tpl" );
		
		echo $zGetGetPopHeure ;  
	} 

	/** 
	* Suppression d'un événement
	*
	* @return 
	*/
	public function delEvent() {
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iEventId = $this->postGetValue ("iEventId",'');
		$this->Agenda->delete($iEventId);
		$toAllEvent = $this->Agenda->geAllEvenement($oUser['id']);

		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("toAllEvent",$toAllEvent);
		$zGetTemplateAllEvent = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "event/getEventPart.tpl" );
		
		echo $zGetTemplateAllEvent ;  
	} 

	/** 
	* session d'un agenda
	*
	* @return 
	*/
	public function setSessionAgenda(){

		if (!isset($_SESSION["session_agenda"]))
		{
			$_SESSION["session_agenda"] = 1 ; 
		}

		$iAgendaStatut = $this->postGetValue ("iAgendaStatut",1);

		$_SESSION["session_agenda"] =  $iAgendaStatut ;
		echo $iAgendaStatut;
	}

	/** 
	* suppresion doublon
	*
	* @return 
	*/
	public function suppressionDoublon() {
		
		$this->Transaction->suppressionDoublon();
	}

	/** 
	* Ajax événement concernant un utilisateur
	*
	* @return 
	*/
	public function getAjaxEvent() {
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	
			$toAllEvent = $this->Agenda->geAllEvenement($oUser['id']);

			foreach ($toAllEvent as $oAllEvent)
			{
				$toTemp	= array () ;
				$toTemp["title"]	= strtoupper($oAllEvent['evenement_intitule']);
				$toTemp["intitule"]	= ucfirst($oAllEvent['evenement_intitule']);
				$toTemp["start"]	= $oAllEvent['evenement_dateDeb']."T".$oAllEvent['evenement_heure'];
				$toTemp["debut"]	= date("d/m/Y", strtotime($oAllEvent['evenement_dateDeb'])) ; 
				$toTemp["heure"]	= $oAllEvent['evenement_heure'] ; 
				if ($oAllEvent['evenement_dateFin'] != "") {
					$toTemp["end"]	= $oAllEvent['evenement_dateFin'] ;
					$toTemp["fin"]	= date("d/m/Y", strtotime($oAllEvent['evenement_dateFin'])) ;
				} else {
					$toTemp["fin"]	= date("d/m/Y", strtotime($oAllEvent['evenement_dateDeb'])) ;
				}
				$toTemp["description"] = ucfirst($oAllEvent['evenement_desccription']) ; 
				$toTemp["lieu"] = $oAllEvent['evenement_lieu'] ; 
				

				if ($oAllEvent['evenement_degre'] == 1) {
					$toTemp["className"] = "label-info" ; 
				} elseif ($oAllEvent['evenement_degre'] == 2){
					$toTemp["className"] = "label-success" ; 
				} else {
					$toTemp["className"] = "label-important" ; 
				}
				$toRes []				= $toTemp ;
			}

			$zToReturn = json_encode ($toRes) ;

			echo $zToReturn ; 
		}
	}

	/** 
	* Sauvegarde événement concernant un utilisateur
	*
	* @return 
	*/
	public function saveEvent() {

		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	
			$zTypeEvent			= $this->postGetValue ("zTypeEvent",0) ;
			$zIntitule			= $this->postGetValue ("zIntitule",0) ; 
			$zDateDeb			= $this->postGetValue ("zDateDeb",0) ; 
			$zDateFin			= $this->postGetValue ("zDateFin",0) ;
			$zHeureEntree		= $this->postGetValue ("zHeureEntree",0) ;
			$zMinuteEntree		= $this->postGetValue ("zMinuteEntree",0) ;
			$zSecondeEntree		= $this->postGetValue ("zSecondeEntree",0) ;
			$zLieuEvent			= $this->postGetValue ("zLieuEvent",0) ;
			$zDescription		= $this->postGetValue ("zDescription",0) ;
			$iDegre				= $this->postGetValue ("iDegre",0) ;

			$oDataEvent  = array();
			$oDataEvent['evenement_userId']			= $oUser['id'];
			$oDataEvent['evenement_typeId']			= $zTypeEvent;
			$oDataEvent['evenement_intitule']		= $zIntitule;
			$oDataEvent['evenement_dateDeb']		= $this->date_fr_to_en($zDateDeb,'/','-');
			if ($zDateFin != '') {
				$oDataEvent['evenement_dateFin']	= $this->date_fr_to_en($zDateFin,'/','-');
			}
			$oDataEvent['evenement_heure']			= $zHeureEntree . ":" . $zMinuteEntree . ":" . $zSecondeEntree ;
			$oDataEvent['evenement_lieu']			= $zLieuEvent;
			$oDataEvent['evenement_desccription']	= $zDescription;
			$oDataEvent['evenement_degre']			= $iDegre;

			$iIventId = $this->Agenda->insert($oDataEvent);

			$zGetTemplateAllEvent = "" ; 
			if (isset($iIventId)){

				$toAllEvent = $this->Agenda->geAllEvenement($oUser['id']);

				if (!isset($_SESSION["session_agenda"]))
				{
					$_SESSION["session_agenda"] = 1 ; 
				}

				$zAssignJs = "";
				foreach ($toAllEvent as $oAllEvent){
					$zAssignJs .= "{";
					$zAssignJs .= "time:''," ; 
					$zAssignJs .= "title: '".strtoupper($oAllEvent['evenement_intitule'])."'," ; 

					$iMois = (int)date("m",strtotime($oAllEvent['evenement_dateDeb'])) - 1 ; 
					$iJour = (int)date("d",strtotime($oAllEvent['evenement_dateDeb'])) ; 
					$zAssignJs .= "start: new Date(".date("Y",strtotime($oAllEvent['evenement_dateDeb'])).", ".$iMois.", ".$iJour.",'',0)," ;
					
					if ($oAllEvent['evenement_dateFin'] != "") {
						$iMois = (int)date("m",strtotime($oAllEvent['evenement_dateFin'])) - 1 ; 
						$iJour = (int)date("d",strtotime($oAllEvent['evenement_dateFin'])) + 1 ; 
						$zAssignJs .= "end: new Date(".date("Y",strtotime($oAllEvent['evenement_dateFin'])).", ".$iMois.", ".$iJour.",'',0)," ;
					} 
						
					$zAssignJs .= "allDay: false," ; 

					
					if ($oAllEvent['evenement_degre'] == 1) {
						$zAssignJs .= "className: 'label-info'" ; 
					} elseif ($oAllEvent['evenement_degre'] == 2){
						$zAssignJs .= "className: 'label-success'" ; 
					} else {
						$zAssignJs .= "className: 'label-important'" ; 
					}
					
					$zAssignJs .= "},";
				}

				$oSmarty->assign("zBasePath",base_url());
				$oSmarty->assign('oUser', $oUser);
				$oSmarty->assign("toAllEvent",$toAllEvent);
				$oSmarty->assign("zAssignJs",$zAssignJs);
				$oSmarty->assign('iModuleActif', $iModuleActif);
				$oSmarty->assign('iAfficheAgenda', $_SESSION["session_agenda"]);
				$zGetTemplateAllEvent = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "event/getEventPart.tpl" );
			}

			echo $zGetTemplateAllEvent ; 
		}
	}
}