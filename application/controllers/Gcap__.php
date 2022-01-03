<?php
/**
* @package ROHI
* @subpackage Gcap
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Gcap extends MY_Controller {

	/**  
	* Classe qui concerne gcap
	* @package  ROHI  
	* @subpackage GCAP */ 

	public function __construct(){
		parent::__construct();
		DEFINE ("MENU_DECISION",4);
		DEFINE ("MENU_CONGE",5);
		DEFINE ("MENU_AUTORISATION_ABSENCE",6);
		DEFINE ("MENU_PERMISSION",7);
		DEFINE ("MENU_REPOS_MEDICAL",49);

		$this->sessionStartCompte();
	}

	/** 
	* Affichage en tableau d'un objet
	*
	* @param objet/tableau $_oObjet objet ou tableau 
	*
	* @return view
	*/
	public static function pre_print($_oObjet) {

		echo "<pre>" ; 
		print_r($_oObjet);
		echo "</pre>";
	}

	/** 
	* function permettant de retourner l'année de prise de service d'un agent
	*
	* @param objet $_oCandidat tableau d'objet d'un candidat
	*
	* @return date
	*/
	public static function getAnneePriseService($_oCandidat) {

		if (isset($_oCandidat)){
			$oDate = $_oCandidat[0]->date_prise_service ; 
			$toDate = explode("-", $oDate);

			return $toDate[0];
		} else {
			return date('Y');
		}
	}

	/** 
	* retourne le libellé d'un motif d'absence
	*
	* @param integer $_iValue Identifiant du motif
	*
	* @return libellé
	*/
	public function getMotif($_iValue){

		global $oSmarty ; 

		$toListe = $this->Gcap->get_Gcap_motif($_iValue);
		$iActif = 0;

		$oSmarty->assign("toListe",$toListe);
		$oSmarty->assign("iActif",$iActif);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/motif_select.tpl" );
		
		echo $zSelect ; 
	}

	/** 
	* retourne le libellé de la décision
	*
	* @param integer $_iValue Identifiant de la décision
	*
	* @return libellé
	*/
	public function getDecision($_iValue){

		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		if($iRet == 1){	

			$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($_iValue);
			$toListe = $this->Decision->getDecisonValide($oUser['id'], $iTypeGcapDecision);
			$zLibelleType = $this->TypeGcap->getNomType($iTypeGcapDecision);
			$iActif = 0;
		}

		$oSmarty->assign("toListe",$toListe);
		$oSmarty->assign("iActif",$iActif);
		$oSmarty->assign("iTypeId",$_iValue);
		$oSmarty->assign("zLibelleType",$zLibelleType);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/decision_select.tpl" );
		
		echo $zSelect ; 
	}

	/** 
	* localité de service en AJAX
	*
	* @param integer $_iType type localité de servcice
	* @param integer $_iValue Identifiant de la table localité de service
	*
	* @return AJAX
	*/
	public function organisation($_iType, $_iValue) {

		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		if($iRet == 1){	
			switch($_iType){
				case 0:
					$zNomTable="departement" ; 
					break;

				case 1:
					$zNomTable="direction" ; 
					break;

				case 2:
					$zNomTable="service" ; 
					break;

				case 3:
					$zNomTable="module" ; 
					break;
			}
			$toListe = $this->Gcap->get_Organisation($_iValue,$zNomTable, $_iType);
		}

		$oSmarty->assign("toListe",$toListe);
		$oSmarty->assign("iType",$_iType);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/portion_option2.tpl" );
	
		echo $zSelect;
	}

	/** 
	*
	* recherche candidat à partir d'un function json
	*
	* @return Json
	*/
	public function candidat(){

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


		$toListe = $this->Gcap->get_all_list_candidat1($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zTerm, $iFiltre);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->user_id;
            $toTemp["text"] = $oListe->nom ." " . $oListe->prenom ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* recherche institution (CENI,INFP,..)
	*
	* @return Json
	*/
	public function getInstitution(){

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
            $zTerm = "-1111" ;
        }

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();

		$toListe = $this->Gcap->get_all_list_institution($zTerm);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->institution_id;
            $toTemp["text"] = $oListe->institution_libelle ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* listing autres absences
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage Page courante
	*
	* @return view
	*/
	public function autres($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	$oData['menu'] = 55;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$zLibelle = "Autres absences" ; 

	    	$oData['zLibelle'] = $zLibelle ; 
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;
			
			$this->load_my_view_Common('gcap/autres-absences.tpl',$oData, $iModuleId);	
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Czandidat rataché
	*
	* @return view
	*/
	public function candidatRattache(){

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


		$toListe = $this->Gcap->get_all_list_candidat($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zTerm, 1);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->user_id;
            $toTemp["text"] = $oListe->nom ." " . $oListe->prenom ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* get content type
	*
	* @param integer $_iTypeId type de contenu
	*
	* @return view
	*/
	public function getContentType($_iTypeId){

		global $oSmarty ; 

		$toListe = $this->Type->get_type_by_id($_iTypeId);

		$oSmarty->assign("toListe",$toListe);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/getContentType.tpl" );
		
		echo $zSelect ; 
	}

	/** 
	* function permettant de modifier le module en cours
	*
	* @param string $_zHashModule Hashage du module 
	*
	* @return view
	*/	
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
			$oData['iModuleId'] = $iModuleId;
			$this->load_my_view_Common('gcap/index.tpl',$oData, $iModuleId);
	    	
    	}
    	
    }

	/** 
	* impression PDF
	*
	* @param string $_zHashModule Hashage du module 
	*
	* @return view
	*/	
	public function imprimerPdf($_zHashModule = FALSE){
    	$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['iNotificationAffiche'] = 1;
			$oData['oCandidat'] = $oCandidat;

			$this->Gcap->setImprimerDecisionPdf();

	    	$this->load_my_view_Common('gcap/index.tpl',$oData, $iModuleId);
	    	
    	}
    	
    }

	/** 
	* liste gcap
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage page courante
	*
	* @return view
	*/
	public function liste($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		if (isset($_iCurrPage) && ($_iCurrPage!='')){
			$_SESSION['iCurrpageListe'] = $_iCurrPage ; 
		} else {
			$_SESSION['iCurrpageListe'] = 1;
		}

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$zLibelle = "" ; 
			switch ($iTypeGcapId) {
				
				case DECISION : 
					$zLibelle = "LISTE DES D&Eacute;CISIONS" ; 
					$oData['menu'] = MENU_DECISION;
					break;

				case CONGE :
					$zLibelle = "LISTE DES CONG&Eacute;S" ; 
					$oData['menu'] = MENU_CONGE;
					break;

				case AUTORISATION_ABSENCE :
					$zLibelle = "LISTE DES AUTORISATIONS D'ABSENCE" ; 
					$oData['menu'] = MENU_AUTORISATION_ABSENCE;
					break;

				case PERMISSION :
					$zLibelle = "LISTE DES PERMISSIONS" ; 
					$oData['menu'] = 0;
					break;

				case MISSION :
					$zLibelle = "LISTE DES MISSION" ; 
					$oData['menu'] = 0;
					break;

				case FORMATION :
					$zLibelle = "LISTE DES FORMATIONS" ; 
					$oData['menu'] = 0;
					break;

				/*modif lucia*/	
				case REPOS_MEDICAL :
				case REPOS_MEDICAL_LUCIA :
					$oData['menu'] = MENU_REPOS_MEDICAL;
					$zLibelle = "LISTE DES REPOS MEDICAL" ; 
					break;
				/*fin*/

			}

			$oData['zTitle'] = ucfirst(strtolower($zLibelle)) ;

			$oCandidatSearch = array();
			if ($zCandidat != "") {
				//$oCandidatSearch= $this->Gcap->get_by_user_id($zCandidat)[0] ;
				if (sizeof($toCandidatSearch)>0 && isset($toCandidatSearch[0])) {
					$oCandidatSearch = $toCandidatSearch[0] ; 
				}
			}

			$toListe = $this->Decision->getDecisonValide($oUser['id'], 1);

			$iNombreTotalDispo = 0;

			foreach($toListe as $oListe){
				$iNombreTotalDispo += $oListe['reste'];
			}


			$iMatricule	= $this->postGetValue ("iMatricule",'') ;
			$iCin	= $this->postGetValue ("iCin",'') ;

	    	$oData['zLibelle'] = $zLibelle ; 
			$oData['oCandidatSearch'] = $oCandidatSearch ;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;
			$oData['iNombreTotalDispo'] = $iNombreTotalDispo;
			$oData['iTypeGcapId'] = $iTypeGcapId ;
			$oData['iMatricule'] = $iMatricule ;
			$oData['iCin'] = $iCin ;


			switch ($iTypeGcapId) {
				
				case DECISION :

					$oData['oListe'] = $this->Decision->get_all_decision($zCandidat,$oUser, $oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
					$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE,1) ;

					$oData['zPagination'] = $zPagination ; 
					$this->load_my_view_Common('gcap/decision.tpl',$oData, $iModuleId);
					break;

				case CONGE :
				case AUTORISATION_ABSENCE :
				case PERMISSION :
				case REPOS_MEDICAL :
					
					$oData['oListe'] = $this->Gcap->get_all_gcap($zCandidat,$oUser,$oCandidat, $oUser['id'], $iTypeGcapId, $iCompteActif,0, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
					$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE,1) ;

					$oData['zPagination'] = $zPagination ; 
					$this->load_my_view_Common('gcap/listeGcap.tpl',$oData, $iModuleId);
					break;
				/*modif lucia*/	
				case 5 :
				$oData['oListe'] = $this->Gcap->get_all_gcap($zCandidat,$oUser,$oCandidat, $oUser['id'], $iTypeGcapId, $iCompteActif,0, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
					$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE,1) ;

					$oData['zPagination'] = $zPagination ; 
					$this->load_my_view_Common('gcap/listeGcap.tpl',$oData, $iModuleId);
					break;
				/*fin*/

			}
			
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Avancement d'un agent
	*
	* @param integer $iMatricule matricule
	*
	* @return view
	*/
	private function AvancementAgent($iMatricule) 
	{
		$zData1 = @file_get_contents(ADMIN_TEMPLATE_PATH ."cv/avance.txt"); 

		$zData1 = str_replace("%MATRICULE%",trim($iMatricule), $zData1) ; 

		$zAvancementAffiche = @file_get_contents($zData1);

		$oAvancementAffiche = array();
		if ($zAvancementAffiche != "") {
			$oAvancementAffiche = json_decode ($zAvancementAffiche);

			if (sizeof($oAvancementAffiche)>0){
				foreach ($oAvancementAffiche as $iKey => $zValue) {
					$oAvancementAffiche = $zValue ; 
				}
			}
			
		} else {

			$oAvancementAffiche = array();
		}

		return $oAvancementAffiche ; 
	}

	/** 
	* Recherche agent
	*
	* @return view
	*/
	public function search_AgentCompte() {
    	$oData = array();
    	
		$iType = $_POST['type'];
		$iImOrCin = $_POST['im'];
		$zCandidatSearch = $_POST['zCandidat'];
		
		$iCompteActif = $this->getSessionCompte();

		$oUser = array();
		$oCandidat = array();

		$iRet = $this->check($oUser, $oCandidat);

		/*$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026','389671','307381','357208','352287', '351101', 'STG_SGRH');*/

		$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026','389671','307381','357208','355564', '351101', 'STG_SGRH','382791', '293785', '260942', '287385','355857','355577');

		$iAll = 1 ; 
		if (in_array($oUser['im'], $toUserAutorise)) {
			$iAll = 0 ; 
		}

		$toUserAutoriseId = array ('9312');

		if (in_array($oUser['id'], $toUserAutoriseId)) {
			$iAll = 0 ; 
		}

		switch ($iType) {
			case 'im':
				$oCandidatAffiche = $this->candidat->get_candidat_by_matricule($iImOrCin, $zCandidatSearch, $iAll, $oCandidat);
				break;

			case 'cin':
				$oCandidatAffiche = $this->candidat->get_candidat_by_cin($iImOrCin, $zCandidatSearch,$iAll, $oCandidat) ;
				break;
		}
    	
    	if(!empty($oCandidatAffiche)){
			
    		$toCompte = $this->Compte->get_compte();
			$toCompteUser = $this->Compte->get_by_compte_UserId($oCandidatAffiche[0]->user_id);
			$oData['menu'] = 32;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['oCandidatAffiche'] = $oCandidatAffiche;
			$oData['toCompte']		   = $toCompte ; 
			$oData['toCompteUser']	   = $toCompteUser ; 
			$this->load_my_view_Common('gcap/getCompte_search.tpl',$oData, 4);
		}
		else{
			$oData['msg'] = "Matricule incorrect";
			$oData['menu'] = 32;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$this->load_my_view_Common('gcap/getCompte.tpl',$oData, 4);
		}
    }
    
	/** 
	* Compte
	*
	* @param integer $_iCurrPage page courrante
	*
	* @return view
	*/
	public function compte($_iCurrPage=1){
		
		$iCompteActif = $this->getSessionCompte();

		if ($iCompteActif == COMPTE_ADMIN)
		{
		
			$oUser = array();
			$oCandidat = array();
			$iRet = $this->check($oUser, $oCandidat);

			$iCurrPage      = $_iCurrPage ;
			$iNbrTotal = 0 ; 
			
			if($iRet == 1){	

				$oData['menu'] = 32;
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;

				$iCompteActif = $this->getSessionCompte();

				$toCompte = $this->Compte->get_compte();
						
				$oData['oListe'] = $this->UserCompte->get_all_list_compte($iNbrTotal, NB_PER_PAGE, $iCurrPage);
				$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;

				$oData['zPagination'] = $zPagination ; 
				$oData['toCompte']	  = $toCompte ; 
				$this->load_my_view_Common('gcap/listeCompte.tpl',$oData, 4);
				//break;
				
			
			} else {
				$this->mon_cv();
			}
		}
		else
		{	
			redirect("gcap/liste/gestion-absence/decision");
		}
    	
    }

	/** 
	* Assignation compte pour un agent
	*
	* @param integer $_iCurrPage page courrante
	*
	* @return view
	*/
	public function AssignCompte($_iCurrPage=1){
		
		$iCompteActif = $this->getSessionCompte();

		if ($iCompteActif == COMPTE_ADMIN)
		{
		
			$oUser = array();
			$oCandidat = array();
			$iRet = $this->check($oUser, $oCandidat);

			$iCurrPage      = $_iCurrPage ;
			$iNbrTotal = 0 ; 
			
			if($iRet == 1){	

				$oData['menu'] = 32;
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;

				$iCompteActif = $this->getSessionCompte();

				$toCompte = $this->Compte->get_compte();
				$oData['toCompte']	  = $toCompte ; 
				$this->load_my_view_Common('gcap/getCompte.tpl',$oData, 4);
				//break;
				
			
			} else {
				$this->mon_cv();
			}
		}
		else
		{	
			redirect("gcap/liste/gestion-absence/decision");
		}
    	
    }

	/** 
	* congé passé d'un candidat
	*
	* @param integer $_iCurrPage page courrante
	*
	* @return view
	*/
	public function congeCandidatPasse($_iCurrPage=1){
		
		$iCompteActif = $this->getSessionCompte();

		if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL || $iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_ADMIN)
		{
		
			$oUser = array();
			$oCandidat = array();
			$iRet = $this->check($oUser, $oCandidat);

			$iCurrPage      = $_iCurrPage ;
			$iNbrTotal = 0 ; 
			
			if($iRet == 1){	

				$oData['menu'] = 33;
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;

				$iMatricule	= $this->postGetValue ("iMatricule",'') ;
				$iCin	= $this->postGetValue ("iCin",'') ;


				$iCompteActif = $this->getSessionCompte();
						
				/*$oData['oListe'] = $this->CongeLast->get_all_list_congeCandidat($zCandidat, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
				$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;*/

				$iNbrTotal = 0;

				$this->load->model('decision_gcap_model','Decision');
				$toListe = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $_iCurrPage);

				$zPagination    = $this->getPagination ($_iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
				
				$oData['iMatricule'] = $iMatricule ;
				$oData['iCin'] = $iCin ;
				$oData['oListe'] = $toListe ;
				$oData['zPagination'] = $zPagination ; 
				$oData['zHashModule'] = 'gestion-compte' ; 
				$oData['zHashUrl'] = 'edit-user' ; 
				
				$this->load_my_view_Common('gcap/congeCandidat.tpl',$oData, 4);
				
			
			} else {
				$this->mon_cv();
			}
		}
		else
		{	
			redirect("gcap/liste/gestion-absence/decision");
		}
    	
    }

	/** 
	* Edition congé
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iUserId Identifiant d'un agent
	*
	* @return view
	*/
	public function editConge($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iUserId = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL || $iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_ADMIN)
			{
				$oData['menu'] = 33;
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;

				$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
				$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);

				$oType = $this->TypeGcap->get_type_by_TypeGcapId(DECISION);

				$oData['oDataExtrant']	= $this->Decision->get_all_decision_extrant($oUser,$oCandidat, $_iUserId, COMPTE_AGENT);
				
				$oUserConge = $this->Gcap->get_candidat_object($_iUserId);

				$oData['annee']		= date("Y") ; 
				$oData['iAnnePriseDecision']		= $this->getAnneePriseService($oUserConge) ; 

				if (date("Y") - $this->getAnneePriseService($oUserConge) < 40) {
					$oData['iLastBoucle'] = date("Y") - $oData['iAnnePriseDecision'] ; 
				} else {
					$oData['iLastBoucle'] = 5 ; 
				}
				
				
				$oData['oType'] = $oType;
				
				$oData['zHashUrl'] = $_zHashUrl ; 
				$oData['zHashModule'] = $_zHashModule ;

				
				$oUserConge = $this->Gcap->get_candidat($_iUserId);
				$oData['oUserConge']	 = $oUserConge;
				$oData['oDataLastConge'] = $this->CongeLast->getAllLastCongeUser($_iUserId);
				$oData['iUserId'] = $_iUserId ; 
				$oData['zHashModule'] = 'gestion-compte' ; 
				$oData['zHashUrl'] = 'edit-user' ; 
				$this->load_my_view_Common('gcap/editConge.tpl',$oData, $iModuleId);
			} else {
				die();
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Destinée à modifier / supprimer un congé d'un agent
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function commConge($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
		$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	switch ($_zHashUrl) {

				case 'fiche':
					$oData['menu'] = -1;
					$zMessage = "";

					if($oUser['id'] == '9961' || $oUser['id'] == '617' || $oUser['id'] == '4430'){
						$oData['zTitle'] = "Modification / suppression congé" ; 
						$oData['oUser'] = $oUser;
						$oData['oCandidat'] = $oCandidat;
						$this->load_my_view_Common('gcap/congeComm.tpl',$oData, $iModuleId);
					}

					break;
				
				case 'lg-pass-ajax':
					global $oSmarty ; 
					$oData['menu'] = -1;
					$zMessage = "";

					if($oUser['id'] == '9961' || $oUser['id'] == '617' || $oUser['id'] == '4430'){
						$iMatricule	= $this->postGetValue ("iMatricule",'') ;
						$iCin	= $this->postGetValue ("iCin",'') ;

						$toUser = $this->Gcap->get_login_by_cin_matricule ($iCin,$iMatricule,1);

						$toDataLastConge = array();
						if (sizeof($toUser)>0){
							$toDataLastConge = $this->CongeLast->getAllLastCongeUserA($toUser[0]->id);
						}
						$oSmarty->assign("toDataLastConge",$toDataLastConge);
						$oSmarty->assign("zBasePath",base_url());
						$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/conge-comm-ajax.tpl" );
						
						echo $zSelect ; 
					}

					break;

				case 'deleteDecision':

					global $oSmarty ; 
					$oData['menu'] = -1;
					$zMessage = "";

					if($oUser['id'] == '9961' || $oUser['id'] == '617' || $oUser['id'] == '4430'){
						$iFraction	= $this->postGetValue ("iFraction",'') ;
						$iDecision	= $this->postGetValue ("iDecision",'') ;

						$this->Fraction->delete_fraction_by_id($iFraction);
						$this->Fraction->delete_decision1($iDecision);

						echo "1" ; 
					}

					break;

				case 'editDecision':

					global $oSmarty ; 
					$oData['menu'] = -1;
					$zMessage = "";

					if($oUser['id'] == '9961' || $oUser['id'] == '617' || $oUser['id'] = '4430'){
						$iFractionId	= $this->postGetValue ("iFraction",'') ;
						$iValue			= $this->postGetValue ("iValue",'') ;
						$iDecisionId	= $this->postGetValue ("iDecision",'') ;

						$oDataFraction = array();

						$oDataFraction['fraction_decisionId'] = $iDecisionId ; 
						$oDataFraction['fraction_nbrJour'] = $iValue ; 

						$this->Fraction->updateFraction($oDataFraction,$iFractionId);

						echo "1" ; 
					}

					break;
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* permettant d'avoir le dernier congé d'un agent
	*
	* @param integer $_iValueId 
	*
	* @return view
	*/
	public function getLastCongeById($_iValueId){

		global $oSmarty ; 

		$toListe = $this->CongeLast->getLastCongeById($_iValueId);
		
		echo json_encode($toListe) ; 
	}

	/** 
	* test date
	*
	*
	* @return view
	*/
	public function TestDate(){

		global $oSmarty ; 

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$zDateDebut = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
		$zDateFin = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-'); 
		$iTypeId	= $this->postGetValue ("iTypeId",'') ;

		$toDate = $this->Gcap->TestDate($oUser['id'], $zDateDebut, $zDateFin, $iTypeId);

		$iReturn = 0;
		if (sizeof($toDate)>0){
			$iReturn = 1;
		}
		
		echo $iReturn; 
	}

	/** 
	* congé annuel cumulé
	*
	* @param integer $_iValueId 
	*
	* @return view
	*/
	public function setCongeAnnuelCumule(){

		global $oSmarty ; 

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iUserId	= $this->postGetValue ("iUserId",'') ;
		$iTypeId	= $this->postGetValue ("iTypeId",'') ;

		$toCummuleeDecision = $this->Decision->setCongeAnnuelCumule($iUserId, $iTypeId);

		//print_r ($toCummuleeDecision);

		$iReturn = 0;
		$iNombreDeJour = 0;
		if (sizeof($toCummuleeDecision)>0){
			
			foreach ($toCummuleeDecision as $oCummuleeDecision){
				$iNombreDeJour += $oCummuleeDecision["reste"];
			}

			// 60 jours
			if ($iNombreDeJour >= 60) {
				$iReturn = 1;
			}
		}
		
		echo $iReturn; 
	}

	/** 
	* Sauvegarde congé
	*
	* @param integer $iUserId identifiant de l'utilisateur
	* @param integer $iValue valeur réel du congé
	*
	* @return view
	*/
	public function saveConge($iUserId = FALSE, $iValue = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$oData["conge_userId"]	= $iUserId ; 
			$oData["conge_value"]	= $iValue ; 

			$this->CongeLast->insert($oData);
			
			redirect("gcap/congeCandidatPasse");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Sauvegarde congé passé
	*
	* @param integer $iUserId identifiant de l'utilisateur
	*
	* @return view
	*/
	public function saveCongeLast($iUserId = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			/*$oData["lastConge_id"]			= $this->postGetValue ("lastCongeId",0) ;
			$oData["lastConge_userId"]		= $iUserId ;
			$oData["lastConge_numDecision"]	= $this->postGetValue ("numDecision",0) ;
			$oData["lastConge_nombre"]		= $this->postGetValue ("nbrJour",0) ;
			$oData["lastConge_pris"]		= $this->postGetValue ("nbrJourPris",0) ;
			$oData["lastConge_annee"]		= $this->postGetValue ("AnneeDecision",0) ;

			$this->CongeLast->insertLastConge($oData, $oData["lastConge_id"]);*/

			$oData["decision_typeId"] = $this->postGetValue ("type_id",0) ; 
			$zSignataireId	= $this->postGetValue ("zCandidat",'') ;
			$zAutoriteManuel	= $this->postGetValue ("zAutoriteManuel",'') ;

			$iSignataireId = $oUser['id'] ; 
			if ($zSignataireId != "") {
				$iSignataireId = $zSignataireId ; 
			}

			$iNombreDeJour = $this->postGetValue ("nbrJour",0) ; 
			$iNombreDeJour = str_replace(",", ".", $iNombreDeJour) ;
			

			$iNombreDeJourPris = $this->postGetValue ("nbrJourPris",0) ; 
			$iNombreDeJourPris = str_replace(",", ".", $iNombreDeJourPris) ;
			
			$oData["decision_annee"] = $this->postGetValue ("annee",0) ;
			$oData["decision_userId"] = $iUserId ;
			$oData["decision_vue"] = 0 ;
			$oData["decision_caracteristique"] = $this->postGetValue ("caracteristique",0) ; 
			$oData["decision_dateDebut"] = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
			$oData["decision_dateFin"] = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-');
			$oData["decision_numero"] = $this->postGetValue ("numero",0) ; 
			$oData["decision_nbrJour"] = $iNombreDeJour ; 
					
			$oData["decision_numero"] = $this->postGetValue ("numero",0) ; 
			$oData["decision_statutId"] = STATUT_RECEPTION_AUTORITE ; 
			$oData["decision_userAutoriteId"] = $iSignataireId ; 
			$oData["decision_userValidId"] = $iSignataireId ; 
			$oData["decision_finalisation"] = 1 ; 
			$oData["decision_autoriteSaisi"] = $zAutoriteManuel ;
			$oData["decision_last"] = 1 ; 
			$oData["decision_valide"] = 1 ; 
			$oData["decision_dateValidation"] = $this->date_fr_to_en($this->postGetValue ("date_decision"),'/','-')  ; 
			$oData["decision_dateFinalisation"] = $this->date_fr_to_en($this->postGetValue ("date_decision"),'/','-') ; 
			
			$this->load->model('decision_gcap_model','Decision');
			$iDecisionId = $this->Decision->insert($oData);


			$oDataFraction = array();

			$oDataFraction['fraction_decisionId'] = $iDecisionId ; 
			$oDataFraction['fraction_date'] = $this->date_fr_to_en($this->postGetValue ("date_decision"),'/','-') ; 
			$oDataFraction['fraction_nbrJour'] = $iNombreDeJourPris ; 
			$oDataFraction['fraction_userId'] = $iUserId ; 

			$this->Fraction->insert($oDataFraction);

			/*if ($_iId != FALSE){
				$this->Decision->update_decision($oData, $_iId);
			} else {
				$this->Decision->insert($oData);
			}*/
			
			redirect("gcap/editConge/gestion-compte/edit-user/" . $iUserId);
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* suppression congé passé
	*
	* @param integer $iUserId identifiant de l'utilisateur
	*
	* @return view
	*/
	public function deleteLastConge($iUserId = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iElementId		= $this->postGetValue ("iElementId",0) ;

			$this->CongeLast->deleteLastConge($iElementId);
			
			redirect("gcap/editConge/gestion-compte/edit-user/" . $iUserId);
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Demande d'absence
	*
	* @return view
	*/
	public function demandeAbsence(){

		global $oSmarty ; 
		$iCompteActif = $this->getSessionCompte();

		$oListeRegion  = $this->region->get_region();
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('oListeRegion', $oListeRegion);
		$oSmarty->assign('iCompteActif', $iCompteActif);
		$oSmarty->assign('zDateToDay', date("Y-m-d"));
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/demandeFiche.tpl" );
		
		echo $zSelect ; 
	}

	/** 
	* Changement type
	*
	* @return view
	*/
	public function ChangeTypeSet(){

		global $oSmarty ; 

		$zUrl		= $this->postGetValue ("zUrl",0) ;
		$_iId		= $this->postGetValue ("iId",'') ;
		$zHashUrl	= $this->postGetValue ("zHashUrl",0) ;
		$iSessionCompte = $this->getSessionCompte();

		$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($zHashUrl);

		switch ($zHashUrl){

			case 'mission':
				$iTypeGcapId = MISSION ; 
				break;

			case 'formation':
				$iTypeGcapId = FORMATION ; 
				break;
		}

		switch ($iTypeGcapId) {
				
				case DECISION :
					if ($_iId == FALSE){
						$zTitre = "AJOUT D&Eacute;CISION" ;
					}else{
						$zTitre = "MODIFICATION D&Eacute;CISION" ;
					}
					
					$zLibelle = "de d&eacute;cision" ; 
					break;

				case CONGE :
					if ($_iId == FALSE){
						$zTitre = "AJOUT CONG&Eacute;" ;
					}else{	
						$zTitre = "MODIFICATION CONG&Eacute;" ; 
					}
					$zLibelle = " de cong&eacute;" ;
					break;

				case AUTORISATION_ABSENCE :
					if ($_iId == FALSE){
						$zTitre = "AJOUT AUTORISATION D'ABSENCE" ;
					}else{		
						$zTitre = "MODIFICATION AUTORISATION D'ABSENCE" ; 
					}

					$zLibelle = "d'autorisation d'absence" ;
					$oData['zTitle'] = ucfirst(strtolower($zTitre)) ;
					
					break;

				case PERMISSION :
					if ($_iId == FALSE){
						$zTitre = "AJOUT PERMISSION" ;
					}else{		
						$zTitre = "MODIFICATION PERMISSION" ;
					}

					$zLibelle = "de permission" ;
					break;
				/*modif lucia*/
				case REPOS_MEDICAL :
				case REPOS_MEDICAL_LUCIA :
					if ($_iId == FALSE){
						$zTitre = "AJOUT REPOS MEDICAL" ;
					}else{		
						$zTitre = "MODIFICATION MEDICAL" ;
					}

					$zLibelle = "de repos medical" ;
					break;
				/*fin*/

			}

			$zTitle = ucfirst(strtolower($zTitre)) ;

	    	$zTitre = $zTitre ; 
			$zLibelle = $zLibelle ; 
			$iTypeGcapId = $iTypeGcapId;

			$oType = $this->TypeGcap->get_type_by_TypeGcapId($iTypeGcapId);

			$oSmarty->assign("zTitre",$zTitre);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign("zLibelle",$zLibelle);
			$oSmarty->assign("iTypeGcapId",$iTypeGcapId);
			$oSmarty->assign('iSessionCompte', $iSessionCompte);
			$oSmarty->assign("oType",$oType);

			$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/setType.tpl" );
		
		echo $zSelect ; 
	}

	/** 
	* Edition gcap
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iId Identifiant gcap
	*
	* @return view
	*/
	public function edit($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	$oData['menu'] = 9;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oData["iError"]		= $this->postGetValue ("iError",0) ;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);

			if($_zHashUrl == "demande"){
				$oGcap = $this->Gcap->get_Gcap ($_iId);
				$iTypeGcapId = $oGcap["gcap_typeGcapId"];

				if (count($oGcap)==0){
					redirect("gcap/extrants/gestion-absence/demande");
				}
			}

			if ($_iId == '') {

				switch ($iCompteActif) {

					case COMPTE_AGENT:
					case COMPTE_RESPONSABLE_PERSONNEL:
						break;

					case COMPTE_AUTORITE:
					case COMPTE_EVALUATEUR:
						redirect("gcap/liste/$_zHashModule/$_zHashUrl");
						break;

					default:
						$_SESSION["session_compte"] = COMPTE_AGENT ; 
						break;
				}
			}

			$iCompteActif = $this->getSessionCompte();
			
			$zLibelle = "" ; 
			$zTitre	= "" ; 
			$zSelect = "" ; 

			switch ($iTypeGcapId) {
				
				case DECISION :
					if ($_iId == FALSE){
						$zTitre = "AJOUT D&Eacute;CISION" ;
					}else{
						$zTitre = "FICHE D&Eacute;CISION" ;
					}

					$oData['menu'] = MENU_DECISION;
					
					$zLibelle = "de d&eacute;cision" ; 
					break;

				case CONGE :
					if ($_iId == FALSE){
						$zTitre = "AJOUT CONG&Eacute;" ;
					}else{	
						$zTitre = "FICHE CONG&Eacute;" ; 
					}
					$zLibelle = " de cong&eacute;" ;

					$oData['menu'] = 9;
					
					break;

				case AUTORISATION_ABSENCE :
					if ($_iId == FALSE){
						$zTitre = "AJOUT AUTORISATION D'ABSENCE" ;
					}else{		
						$zTitre = "FICHE AUTORISATION D'ABSENCE" ; 
					}

					$zLibelle = "d'autorisation d'absence" ;
					$oData['menu'] = 9;
					$oData['zTitle'] = ucfirst(strtolower($zTitre)) ;
					
					break;

				case PERMISSION :
					if ($_iId == FALSE){
						$zTitre = "AJOUT PERMISSION" ;
					}else{		
						$zTitre = "MODIFICATION PERMISSION" ;
					}

					$zLibelle = "de permission" ;
					$oData['menu'] = 9;
					break;
				
				case MISSION :
					if ($_iId == FALSE){
						$zTitre = "AJOUT MISSION" ;
					}else{		
						$zTitre = "FICHE MISSION" ;
					}

					$zLibelle = "de permission" ;
					$oData['menu'] = 9;
					break;
				
				case FORMATION :
					if ($_iId == FALSE){
						$zTitre = "AJOUT FORMATION" ;
					}else{		
						$zTitre = "FICHE FORMATION" ;
					}

					$zLibelle = "de permission" ;
					$oData['menu'] = 9;
					break;
				/*modif lucia*/
				case REPOS_MEDICAL :
				case REPOS_MEDICAL_LUCIA :
					if ($_iId == FALSE){
						$zTitre = "AJOUT REPOS MEDICAL" ;
					}else{		
						$zTitre = "FICHE MEDICAL" ;
					}

					$zLibelle = "de repos medical" ;
					$oData['menu'] = 9;
					break;
				/*fin*/

			}

			$oData['zTitle'] = ucfirst(strtolower($zTitre)) ;

	    	$oData['zTitre'] = $zTitre ; 
			$oData['zLibelle'] = $zLibelle ; 
			$oData['iTypeGcapId'] = $iTypeGcapId;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;

			$oType = $this->TypeGcap->get_type_by_TypeGcapId($iTypeGcapId);
			$oData['oType'] = $oType ;

			switch ($iTypeGcapId) {
				
				case DECISION :

					$oDecision = array();
					$oUserValid = array();

					if ($_iId != FALSE){
						$oDecision = $this->Decision->get_decision ($_iId);
						$oUserValid = $this->user->get_user($oDecision['decision_userValidId']);

						if($iCompteActif == COMPTE_AGENT || $iCompteActif == COMPTE_EVALUATEUR) {
							$this->Decision->setVue($_iId);
						}
					}

					$oData['oEdit']			= $this->Decision->get_all_decision('',$oUser,$oCandidat, $oUser['id'],$iCompteActif);
					$oData['oDataExtrant']	= $this->Decision->get_all_decision_extrant($oUser,$oCandidat, $oUser['id'], $iCompteActif);

					$oData['annee']		= date("Y") ; 
					$oData['iAnnePriseDecision']		= $this->getAnneePriseService($oCandidat) ; 

					if (date("Y") - $this->getAnneePriseService($oCandidat) < 20) {
						$oData['iLastBoucle'] = date("Y") - $oData['iAnnePriseDecision'] ; 
					} else {
						$oData['iLastBoucle'] = 5 ; 
					}

					$oData['oDecision']		= $oDecision ; 
					$oData['oUserValid']	= $oUserValid ; 

					$oData['iId'] = $_iId ; 
					$this->load_my_view_Common('gcap/decision_edit.tpl',$oData, $iModuleId);
					break;

				case CONGE :
				case AUTORISATION_ABSENCE :
				case PERMISSION :

					if ($iCompteActif == COMPTE_AGENT && $_iId!='')
					{
						$iReturn = $this->Gcap->testAppartenance($oUser['id'], $_iId);
						if($iReturn == 0){
							die("Cet Absence ne vous appartient pas");
						}
					}

					$oGcap = array();
					$toListe = array();
					$iActif = 0;
					
					global $oSmarty ; 

					$oCandidatAgent = array();

					if ($_iId != FALSE){
						$oGcap = $this->Gcap->get_Gcap ($_iId);
						$toListe = $this->Gcap->get_Gcap_motif($oGcap["gcap_typeId"]);
						$oCandidatAgent = $this->candidat->get_by_user_id($oGcap['gcap_userSendId']);
						$iActif = (int)$oGcap["gcap_motif"] ; 

						if($iCompteActif == COMPTE_AUTORITE) {
							$this->Gcap->setVue($_iId);
						} elseif (($iCompteActif == COMPTE_AGENT && $oGcap["gcap_valide"] == 1) || ($iCompteActif == COMPTE_AGENT && $oGcap["gcap_valide"] == 2) ) {
							$this->Gcap->setVue($_iId);
						}
					}

					$oSmarty->assign("toListe",$toListe);
					$oSmarty->assign("iActif",$iActif);
					$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/motif_select.tpl" );

					$zLibelleType = "";
					$toDataListeFraction = array();
					if($iTypeGcapId == CONGE && $_iId != FALSE) {
						$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($oGcap['gcap_typeId']);
						$toDataListeFraction = $this->Fraction->get_fractions_by_conge_id ($_iId, $oGcap['gcap_userSendId']);
						$zLibelleType = $this->TypeGcap->getNomType($iTypeGcapDecision);
					}

					$this->load->model('region_model','region');
					$oListeRegion  = $this->region->get_region();
					$oData['oGcap'] = $oGcap ; 
					$oData['iId'] = $_iId ; 
					$oData['oCandidatAgent'] = $oCandidatAgent ; 
					$oData['oListeRegion'] = $oListeRegion ; 
					$oData['zSelect'] = $zSelect ; 
					$oData['zLibelleType'] = $zLibelleType ;
					$oData['toDataListeFraction'] = $toDataListeFraction ;
					$oData['zDateToDay'] = date("Y-m-d") ;
					$this->load_my_view_Common('gcap/gcap_edit.tpl',$oData, $iModuleId);
					break;
				/*modif lucia*/
				case REPOS_MEDICAL :
				case REPOS_MEDICAL_LUCIA:
				case MISSION :
				case FORMATION :

					if ($iCompteActif == COMPTE_AGENT && $_iId!='')
					{
						$iReturn = $this->Gcap->testAppartenance($oUser['id'], $_iId);
						if($iReturn == 0){
							die("Cet Absence ne vous appartient pas");
						}
					}
	
					$oGcap = array();
					$toListe = array();
					$iActif = 0;

					$oCandidatAgent = array();
					
					$oData['repos_medical'] = true ; 					
					
					global $oSmarty ; 

					if ($_iId != FALSE){
						$oGcap = $this->Gcap->get_Gcap ($_iId);
						$toListe = $this->Gcap->get_Gcap_motif($oGcap["gcap_typeId"]);
						$oCandidatAgent = $this->candidat->get_by_user_id($oGcap['gcap_userSendId']);
						$iActif = (int)$oGcap["gcap_motif"] ; 

						if($iCompteActif > 1) {
							$this->Gcap->setVue($_iId);
						} elseif (($iCompteActif == COMPTE_AGENT && $oGcap["gcap_valide"] == 1) || ($iCompteActif == COMPTE_AGENT && $oGcap["gcap_valide"] == 2) ) {
							$th->Gcap->setVue($_iId);
						}
					}

					$oSmarty->assign("toListe",$toListe);
					$oSmarty->assign("iActif",$iActif);
					$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/motif_select.tpl" );

					$zLibelleType = "";
					$toDataListeFraction = array();
					if($iTypeGcapId == CONGE && $_iId != FALSE) {
						$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($oGcap['gcap_typeId']);
						$toDataListeFraction = $this->Fraction->get_fractions_by_conge_id ($_iId, $oGcap['gcap_userSendId']);
						$zLibelleType = $this->TypeGcap->getNomType($iTypeGcapDecision);
					}

					$this->load->model('region_model','region');
					$oListeRegion  = $this->region->get_region();
					$oData['oGcap'] = $oGcap ; 
					$oData['iId'] = $_iId ; 
					$oData['oListeRegion'] = $oListeRegion ; 
					$oData['oCandidatAgent'] = $oCandidatAgent ; 
					$oData['zSelect'] = $zSelect ; 
					$oData['zLibelleType'] = $zLibelleType ;
					$oData['toDataListeFraction'] = $toDataListeFraction ;
					$oData['zDateToDay'] = date("Y-m-d") ;
					$this->load_my_view_Common('gcap/gcap_edit.tpl',$oData, $iModuleId);
					break;
					/*fin modif*/

			}
			
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Sauvegarde compte
	*
	*
	* @return view
	*/
	public function saveCompteAssign() {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$oData["userCompte_userId"]		= $this->postGetValue ("zCandidat",0) ;

			$toCompte = $this->Compte->get_compte();
			$this->Compte->delete_AllCompte($oData["userCompte_userId"]);

			$oDataRole = array();
			$oDataRole['role'] = 'user';
			$this->user->update_user($oData["userCompte_userId"], $oDataRole);


			foreach ($toCompte as $oCompte){
				if (isset($_POST['iCompte_'.$oCompte['compte_id']]) && ($_POST['iCompte_'.$oCompte['compte_id']] != '')){
					$oData["userCompte_compteId"]	= $_POST['iCompte_'.$oCompte['compte_id']];
					$this->UserCompte->insert($oData);

					$oDataRole = array();
					$oDataRole['role'] = 'chef';
					switch ($oData["userCompte_compteId"]) {

						case COMPTE_RESPONSABLE_PERSONNEL : 
						case COMPTE_AUTORITE:
								$oDataRole['role'] = 'chef';
								$this->user->update_user($oData["userCompte_userId"], $oDataRole);
							break;

						case COMPTE_ADMIN:
								$oDataRole['role'] = 'admin';
								$this->user->update_user($oData["userCompte_userId"], $oDataRole);
							break;
					}
				}
			}
			
			redirect("gcap/search_AgentCompte");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Sauvegarde compte
	*
	*
	* @return view
	*/
	public function saveCompte()
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$oData["userCompte_userId"]		= $this->postGetValue ("zCandidat",0) ;
			
			$iCompteId = $this->postGetValue ("iCompteId",0) ;

			switch ($iCompteId){

				case '2':

					$iSaveCompte = COMPTE_RESPONSABLE_PERSONNEL;
					//$this->Gcap->updateFunction($oData["userCompte_userId"], 'Responsable du personnel');
					break;

				case '3':
					$iSaveCompte = COMPTE_AUTORITE;
					//$this->Gcap->updateFunction($oData["userCompte_userId"], 'Chef de division');
					break;

				
				case '4':
					$iSaveCompte = COMPTE_ADMIN;
					//$this->Gcap->updateFunction($oData["userCompte_userId"], 'Chef de service');
					break;

				default:
					$iSaveCompte = COMPTE_ADMIN;
					//$this->Gcap->updateFunction($oData["userCompte_userId"], 'Directeur');
	
			}
			
			$oData["userCompte_compteId"]			= $iSaveCompte ;
			$iDelegue = $this->postGetValue ("delegue",0) ;

			if($iDelegue == 1) {
				$oData["userCompte_titulaireUserId"] = $oUser['id'];
			}

			$this->UserCompte->insert($oData);
			
			redirect("gcap/compte");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Suppression compte
	*
	* @return view
	*/
	public function deleteCompte()
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$iElementId		= $this->postGetValue ("iElementId",0) ;

			$this->UserCompte->delete_compte_candidat($iElementId);
			
			redirect("gcap/compte");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Sauvegarde congé
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iId Identifiant Gcap
	*
	* @return view
	*/
	public function save($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

			$iTypeGcapId	= $this->postGetValue ("iTypeGcapId",0) ;
			$iCompteActif	= $this->getSessionCompte();
			$iAutorisationDepassement = 0;

			$toGcapWeekEnd = array(CONGE,AUTORISATION_ABSENCE,PERMISSION);
			
			$oData = array();
			/*MODIF LUCIA*/
			$conv = $this->postGetValue("conv_pers");
			if($conv){
				$oData["conv_pers"] = $this->postGetValue ("conv_pers");
			}
			/* FIN MODIF LUCIA*/

			switch ($iTypeGcapId) {
				
				case DECISION :

					$oData["decision_typeId"] = $this->postGetValue ("type_id",0) ; 
					if ($iCompteActif == COMPTE_AGENT ||  $iCompteActif == COMPTE_EVALUATEUR)
					{
						$oData["decision_userId"] = $oUser['id'] ;

						$iNombreDeJour = $this->postGetValue ("nbrJour",0) ; 
						$iNombreDeJour = str_replace(",", ".", $iNombreDeJour) ; 
						
						$oData["decision_annee"] = $this->postGetValue ("annee",0) ;
						$oData["decision_caracteristique"] = $this->postGetValue ("caracteristique",0) ; 
						$oData["decision_dateDebut"] = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
						$oData["decision_dateFin"] = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-');
						$oData["decision_numero"] = $this->postGetValue ("numero",0) ; 
						$oData["decision_nbrJour"] = $iNombreDeJour ; 
						$oData["decision_date"] = date("Y-m-d") ; 

						/* La demande de décision de congé n'a pas besoin d'approbation préalable. Donc pas besoin du champ finalisation pour cette demande*/
						if ($oData["decision_typeId"] == DECISISON_CONGE_ANNUEL && $_iId == FALSE)
						{
							$oData["decision_finalisation"] = 1 ; 
							$oData["decision_valide"] = 1 ; 
							$oData["decision_dateValidation"] = date("Y-m-d"); 
							$oData["decision_dateFinalisation"] = date("Y-m-d"); 
							$oData["decision_userAutoriteId"] = $oUser['id'] ; 
							$oData["decision_userValidId"] = $oUser['id'] ;
						}
					}

					$oData["decision_statutId"] = STATUT_CREATION ;
					$oData["decision_vue"] = 0 ;

					if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
					{
						$oData["decision_statutId"] = STATUT_RECEPTION_RESP_PERSONNEL ;
						$oData["decision_numero"] = $this->postGetValue ("numero",0) ; 
					}

					if ($iCompteActif == COMPTE_AUTORITE)
					{
							
						$zSignataire = $this->postGetValue ("zCandidat","") ;

						$iSignataireId = $oUser['id'] ; 
						if ($zSignataire != "") {
							$iSignataireId = $zSignataire ; 
						}
						$oData["decision_statutId"] = STATUT_RECEPTION_AUTORITE ; 
						$oData["decision_userAutoriteId"] = $iSignataireId ; 
						$oData["decision_userValidId"] = $iSignataireId ;
						if ($oData["decision_typeId"] != DECISISON_CONGE_ANNUEL)
						{
							$oData["decision_finalisation"] = 1 ; 
							$oData["decision_valide"] = $this->postGetValue ("decision",0) ; 
							$oData["decision_dateValidation"] = $this->date_fr_to_en($this->postGetValue ("date_signature"),'/','-'); 
							$oData["decision_dateFinalisation"] = $this->date_fr_to_en($this->postGetValue ("date_signature"),'/','-'); 
							
						}
					}

					if ($iCompteActif == COMPTE_ADMIN)
					{
						
						/* delegué s'il y en a */
						$iUserIdDelegue = $this->UserCompte->getCompteDelegue($oUser['id']);

						$zSignataire = $this->postGetValue ("zCandidat","") ;

						$iSignataireId = $iUserIdDelegue ; 
						if ($zSignataire != "") {
							$iSignataireId = $zSignataire ; 
						}
						
						$oData["decision_statutId"] = STATUT_RECEPTION_AUTORITE ; 
						$oData["decision_userAutoriteId"] = $iSignataireId ; 
						$oData["decision_userValidId"] = $iSignataireId ;
						if ($oData["decision_typeId"] != DECISISON_CONGE_ANNUEL)
						{
							$oData["decision_finalisation"] = 1 ; 
							$oData["decision_valide"] = $this->postGetValue ("decision",0) ; 
							$oData["decision_dateValidation"] = $this->date_fr_to_en($this->postGetValue ("date_signature"),'/','-'); 
							$oData["decision_dateFinalisation"] = $this->date_fr_to_en($this->postGetValue ("date_signature"),'/','-'); 
						}
					}

					if ($_iId != FALSE){
						$this->Decision->update_decision($oData, $_iId);
					} else {
						$this->Decision->insert($oData);
					}
					
					break;

				default:

					$zNombreJourConge = 0 ; 

					$iDemiJournee = $this->postGetValue ("iDemiJournee",0) ;

					$iMatinSoir = $this->postGetValue ("matinSoir",0) ;

					if ($iDemiJournee == 1) {
						$oData["gcap_demiJournee"]	= $iDemiJournee ; 
						$oData["gcap_MatinSoir"]	= $this->postGetValue ("matinSoir",0) ;
					}

					$zDateDebut = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
					$zDateFin = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-'); 

					/* Test jour férié*/
					$zDateHierFerie = date("Y-m-d", strtotime($zDateDebut ."-1 days"));
					$zDateDemainFerie = date("Y-m-d", strtotime($zDateFin ."+1 days"));

					$toPasseFerie = $this->Gcap->getJourFerie ($zDateHierFerie);

					

					/*if(in_array($iTypeGcapId, $toGcapWeekEnd)){*/

						if (sizeof($toPasseFerie)>0){
							foreach ($toPasseFerie as $oPasseFerie){
								switch($oPasseFerie['ferie_jour']) {
									case 'Mon':
										if (date("Y-m-d") <= '2018-09-24'){
											$zNombreJourConge += 3 ; 
											if ($iDemiJournee == 1 && $iMatinSoir==2) {
												$zNombreJourConge -= 3 ; 
											}
										}
									break;

									default:
										if (date("Y-m-d") <= '2018-09-24'){
											$zNombreJourConge += 1 ; 
											if ($iDemiJournee == 1 && $iMatinSoir==2) {
												$zNombreJourConge -= 1 ; 
											}
										}
										break;

								}
							}
						}

						$toDemainFerie = $this->Gcap->getJourFerie ($zDateDemainFerie);

						if (sizeof($toDemainFerie)>0){
							foreach ($toDemainFerie as $oDemainFerie){
								switch($oDemainFerie['ferie_jour']) {
									case 'Fri':
										if (date("Y-m-d") <= '2018-09-24'){
											$zNombreJourConge += 3 ; 
											if ($iDemiJournee == 1 && $iMatinSoir==1) {
												$zNombreJourConge -= 3 ; 
											}
										}
									break;

									default:
										if (date("Y-m-d") <= '2018-09-24'){
											$zNombreJourConge += 1 ; 
											if ($iDemiJournee == 1 && $iMatinSoir==1) {
												$zNombreJourConge -= 1 ; 
											}
										}
										break;

								}
							}
						}
					


						$iTestDayFinFerie = date("D", strtotime($zDateFin));

						if ($iTestDayFinFerie == 'Fri') {
							$zDateLundiFerie = date("Y-m-d", strtotime($zDateFin ."+3 days"));

							$toLundiFerie = $this->Gcap->getJourFerie ($zDateLundiFerie);

							if (sizeof($toLundiFerie)>0){
								foreach ($toLundiFerie as $oLundiFerie){
									switch($oLundiFerie['ferie_jour']) {
										case 'Mon':
											if (date("Y-m-d") <= '2018-09-24'){
												$zNombreJourConge += 1 ; 

												$iTestDayDeb = date("D", strtotime($zDateDebut));
												$iTestDayFin = date("D", strtotime($zDateFin));

												if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
													$zNombreJourConge -= 1 ; 
												}
											}
										break;
									}
								}
							}
						}
					/*}*/

					/* Test fin jour férié*/


					if($iTypeGcapId == AUTORISATION_ABSENCE && $iCompteActif == COMPTE_AGENT)
					{

						$iType = $this->postGetValue ("type_id",0) ; 

						/* noombre de jour maximum à prendre */
						switch ($iType) {

							case AUTORISATION_ABSCENCE_ORDINAIRE:
								$iMax = 3; 
								break;

							case AUTORISATION_ABSCENCE_SPECIAL:
								$iMax = 7; 
								break;

							case AUTORISATION_SPECIAL_ABSCENCE:
								$iMax = 20;
								break;
						}

						
						$iTestDayDeb = date("D", strtotime($zDateDebut));
						$iTestDayFin = date("D", strtotime($zDateFin));
						

						$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;

						if ($iDemiJournee == 1) {
							$zNombreJourConge -= 0.5;
						}

						/* test week end si ça commence par lundi */
						if ($iTestDayDeb == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge += 2;
							}
						}

						/* test week end si ça termine par vendredi */
						if ($iTestDayFin == 'Fri') {
							$zNombreJourConge += 2;
						}

						/* test week end si ça termine par Samedi */
						if ($iTestDayFin == 'Sat') {
							$zNombreJourConge += 1;
						}

						if ($iDemiJournee == 1 && $iMatinSoir==2 &&  $iTestDayDeb == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge -= 2;
							}
						}

						if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
							$zNombreJourConge -= 2;
						}

						$toNombreTotal = $this->Gcap->nombreTotalPermissionAbscenceParAn ($oUser['id'], AUTORISATION_ABSENCE);

						$iDejaPris = 0;
						foreach ($toNombreTotal as $oNombreTotal){

						
							$iDifferenceAutorisation = floor($this->human_time_diff ($oNombreTotal['gcap_dateDebut'], $oNombreTotal['gcap_dateFin'])) ;

							if ($iDifferenceAutorisation>3){
								$iDejaPris +=3 ; 
							} else {
								$iDejaPris += $iDifferenceAutorisation ; 
							}

							$iTestDayDeb1 = date("D", strtotime($oNombreTotal['gcap_dateDebut']));
							$iTestDayFin1 = date("D", strtotime($oNombreTotal['gcap_dateFin']));
							
							if ($iTestDayDeb1 == 'Mon') {
								if (date("Y-m-d") <= '2018-09-24'){
									$iDejaPris += 2;
								}
							}

							if ($iTestDayFin1 == 'Fri') {
								$iDejaPris += 2;
							}

							if ($iTestDayFin1 == 'Sat') {
								$iDejaPris += 1;
							}

							if ($oNombreTotal['gcap_demiJournee'] == 1) {
								$iDejaPris -= 0.5 ; 
							}

							if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
								if (date("Y-m-d") <= '2018-09-24'){
									$iDejaPris -= 2;
								}
							}

							if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
								$iDejaPris -= 2;
							}
						}

						if($zNombreJourConge > $iMax){
							$iDejaPris += $iMax ; 
						} else {
							$iDejaPris += $zNombreJourConge ; 
						}
						

						if ($iDejaPris > 15) {
							$iError = 4;
							
							redirect("gcap/edit/gestion-absence/autorisation-abscence?iError=".$iError);
							
							die();
						}

						$oArrayFinalReste = array();
						if($zNombreJourConge > $iMax){

							/************** 29/09/2017 *****************/

							$iAutorisationDepassement = $zNombreJourConge - $iMax;

							$iType = $this->postGetValue ("type_id",0) ; 

							$toListe = $this->Decision->getDecisonValide($oUser['id'], 1);

							$iNombreTotalDispo = 0;

							foreach($toListe as $oListe){
								$iNombreTotalDispo += $oListe['reste'];
							}

							if ($iAutorisationDepassement > $iNombreTotalDispo){
	
								$iError = 3;
							
								redirect("gcap/edit/gestion-absence/autorisation-abscence?iError=".$iError);
							
								die();
							}
						}
					}

					//echo $iAutorisationDepassement;

					//echo $zNombreJourConge ; 

					

					if($iTypeGcapId == PERMISSION && $iCompteActif == COMPTE_AGENT)
					{
						$toNombreTotal = $this->Gcap->nombreTotalPermissionAbscenceParAn ($oUser['id'], PERMISSION);

						$iDejaPris = 0;
						foreach ($toNombreTotal as $oNombreTotal){
							$iDejaPris += floor($this->human_time_diff ($oNombreTotal['gcap_dateDebut'], $oNombreTotal['gcap_dateFin'])) ;

							$iTestDayDeb1 = date("D", strtotime($oNombreTotal['gcap_dateDebut']));
							$iTestDayFin1 = date("D", strtotime($oNombreTotal['gcap_dateFin']));
							
							if ($iTestDayDeb1 == 'Mon') {
								if (date("Y-m-d") <= '2018-09-24'){
									$iDejaPris += 2;
								}
							}

							if ($iTestDayFin1 == 'Fri') {
								$iDejaPris += 2;
							}

							if ($iTestDayFin1 == 'Sat') {
								$iDejaPris += 1;
							}

							if ($oNombreTotal['gcap_demiJournee'] == 1) {
								$iDejaPris -= 0.5 ; 
							}

							if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
								if (date("Y-m-d") <= '2018-09-24'){
									$iDejaPris -= 2;
								}
							}

							if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
								$iDejaPris -= 2;
							}
						}

						if ($iDejaPris > 20) {
							$iError = 5;
							
							redirect("gcap/edit/gestion-absence/autorisation-abscence?iError=".$iError);
							
							die();
						}

						$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;

						/* test week end si ça commence par lundi */
						if ($iTestDayDeb == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge += 2;
							}
						}

						/* test week end si ça termine par vendredi */
						if ($iTestDayFin == 'Fri') {
							$zNombreJourConge += 2;
						}

						/* test week end si ça termine par samedi */
						if ($iTestDayFin == 'Sat') {
							$zNombreJourConge += 1;
						}

						if ($iDemiJournee == 1) {
							$zNombreJourConge -= 0.5;
						}

						if ($iDemiJournee == 1 && $iMatinSoir==2 &&  $iTestDayDeb == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge -= 2;
							}
						}

						if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
							$zNombreJourConge -= 2;
						}
					}

					


					if($iTypeGcapId == CONGE && $iCompteActif == COMPTE_AGENT)
					{

						$iType = $this->postGetValue ("type_id",0) ; 
						$zDateDebut = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
						$zDateFin = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-'); 

						$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($iType);
						
						$iTestDayDeb = date("D", strtotime($zDateDebut));
						$iTestDayFin = date("D", strtotime($zDateFin));

						$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;

						/* test week end si ça commence par lundi */
						if ($iTestDayDeb == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge += 2;
							}
						}

						/* test week end si ça termine par vendredi */
						if ($iTestDayFin == 'Fri') {
							$zNombreJourConge += 2;
						}

						/* test week end si ça termine par Samedi */
						if ($iTestDayFin == 'Sat') {
							$zNombreJourConge += 1;
						}

						if ($iDemiJournee == 1) {
							$zNombreJourConge -= 0.5;
						}

						if ($iDemiJournee == 1 && $iMatinSoir==2 &&  $iTestDayDeb == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge -= 2;
							}
						}

						if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
							$zNombreJourConge -= 2;
						}

						$toListe = $this->Decision->getDecisonValide($oUser['id'], $iTypeGcapDecision);

						$iNombreTotalDispo = 0;

						foreach($toListe as $oListe){
							$iNombreTotalDispo += $oListe['reste'];
						}

						$oArrayFinalReste = array();
						if($zNombreJourConge > $iNombreTotalDispo){

							if($iNombreTotalDispo == 0){
								//echo "Aucune décision n'a été créée concernant ce typy de congé<br />" ; 
								$iError = 1;
							} else {
								//echo "Le nombre de jour de demandé est supérieur au nombre de jour disponible.<br />" ; 
								$iError = 2;
							}
							
							redirect("gcap/edit/gestion-absence/conge?iError=".$iError);
							
							die();
						}
					}

					$zUploadDir = PATH_ROOT_DIR . '/assets/gcap/upload';
					if (isset($_FILES['zFile']) && trim($_FILES['zFile']['name']) != "") {
						
						$zTmpName = $_FILES["zFile"]["tmp_name"];
						$zFileName = utf8_decode($_FILES["zFile"]["name"]);
						$zFileName = str_replace(" ","_",$zFileName);
						$zFileName = strtr($zFileName, 
						'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
						
						$oData["gcap_pieceJointe"]	= $zFileName ; 
						@move_uploaded_file($zTmpName, "$zUploadDir/$zFileName");

					}

					$iReposMedial = 0;
					if (isset($_POST['iUserAgentId']) && ($_POST['iUserAgentId'] != '')){
						$iReposMedial = 1;
					}

					if ($iCompteActif == COMPTE_AGENT  || ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL && $iReposMedial ==1))
					{
						if (isset($_POST['iUserAgentId']) && ($_POST['iUserAgentId'] != '')){
							$oData["gcap_userSendId"] = $_POST['iUserAgentId'] ; 
						} else {
							$oData["gcap_userSendId"] = $oUser['id'] ; 
						}
						
						$oData["gcap_statutId"] = STATUT_CREATION ; 

						$oData["gcap_typeGcapId"] = $this->postGetValue ("iTypeGcapId",0) ; 
						$oData["gcap_typeId"] = $this->postGetValue ("type_id",0) ; 
						$oData["gcap_dateDebut"] = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
						$oData["gcap_dateFin"] = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-');
						$oData["gcap_motif"] = $this->postGetValue ("motif",'') ; 
						$oData["gcap_lieuJouissance"] = $this->postGetValue ("lieu_jouissance",'') ; 
						$oData["gcap_autorisaionCaracteristique"] = $this->postGetValue ("caracteristique",'') ;
						$oData["gcap_vue"] = 0 ;
						//$oData["gcap_typeId"] = 22 ;
					}

					if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL && $iReposMedial ==0)
					{
						$oData["gcap_statutId"] = STATUT_RECEPTION_RESP_PERSONNEL ;
					}
					
					if ($iCompteActif == COMPTE_AUTORITE ||  $iCompteActif == COMPTE_EVALUATEUR)
					{
						$iValidation = $this->postGetValue ("decision",0) ;
						$oData["gcap_statutId"] = STATUT_RECEPTION_AUTORITE ; 
						$oData["gcap_userValidId"] = $oUser['id'] ; 
						$oData["gcap_dateValidation"] = date("Y-m-d") ; 
						$oData["gcap_valide"] = $iValidation ;
						$oData["gcap_vue"] = 0 ; 
						
						/* En cas de refus, on supprime dans la fraction*/
						if ($_iId != FALSE){
							if($iTypeGcapId == CONGE || $iTypeGcapId == AUTORISATION_ABSENCE){
								if($iValidation == 2 || $iValidation == 0){
									$this->Fraction->delete_fraction_by_conge_id($_iId);
								}
							}
						} 
					}

					if ($iCompteActif == COMPTE_ADMIN)
					{
						/* delegué s'il y en a */
						$iUserIdDelegue = $this->UserCompte->getCompteDelegue($oUser['id']);

						$oData["gcap_statutId"] = STATUT_RECEPTION_AUTORITE ; 
						$oData["gcap_userValidId"] = $iUserIdDelegue ; 
						$oData["gcap_dateValidation"] = date("Y-m-d") ; 
						$oData["gcap_valide"] = $this->postGetValue ("decision",0) ; 
						$oData["gcap_vue"] = 0 ; 
					}
					

					if ($_iId != FALSE){
						$iReturnId = $this->Gcap->update_gcap($oData, $_iId);
					} else {
						$iReturnId = $this->Gcap->insert($oData);
					}

					/* Autorisation de dépassement */
					if ($iAutorisationDepassement >0){

						if($iAutorisationDepassement <= $iNombreTotalDispo){
							
							$this->Fraction->delete_fraction_by_conge_id($iReturnId);
							
							$iTest = 0 ; 
							foreach($toListe as $oListe){
								if ($iTest != 1) {
									if ($iAutorisationDepassement < $oListe['reste']){
										$iTest = 1 ; 
										$oDataFraction["fraction_decisionId"] = $oListe["decision_id"] ; 
										$oDataFraction["fraction_congeId"] = $iReturnId ; 
										$oDataFraction["fraction_date"] = $zDateDebut ; 
										$oDataFraction["fraction_nbrJour"] = $iAutorisationDepassement ;
										$oDataFraction["fraction_userId"]	= $oUser['id'] ;

										$this->Fraction->insert($oDataFraction);

									} else {
										
										$iTest = 0 ; 
										$oDataFraction["fraction_decisionId"] = $oListe["decision_id"] ; 
										$oDataFraction["fraction_congeId"] = $iReturnId ; 
										$oDataFraction["fraction_date"] = $zDateDebut; 
										$oDataFraction["fraction_nbrJour"] = $oListe['reste'] ;
										$oDataFraction["fraction_userId"]	= $oUser['id'] ;

										$zNombreJourConge = $zNombreJourConge - $oListe['reste'];

										$this->Fraction->insert($oDataFraction);	 
									}
								}

							}
						}
					}

					// calcul fraction congé 
					if($iTypeGcapId == CONGE && $iCompteActif == COMPTE_AGENT)
					{
						if($zNombreJourConge <= $iNombreTotalDispo){
							
							$this->Fraction->delete_fraction_by_conge_id($iReturnId);
							
							$iTest = 0 ; 
							foreach($toListe as $oListe){
								
								if ($iTest != 1) {
									if ($zNombreJourConge < $oListe['reste']){

										$iTest = 1 ; 
										$oDataFraction["fraction_decisionId"] = $oListe["decision_id"] ; 
										$oDataFraction["fraction_congeId"] = $iReturnId ; 
										$oDataFraction["fraction_date"] = $zDateDebut ; 
										$oDataFraction["fraction_nbrJour"] = $zNombreJourConge ;
										$oDataFraction["fraction_userId"]	= $oUser['id'] ;

										$this->Fraction->insert($oDataFraction);

									} else {
										
										$iTest = 0 ; 
										$oDataFraction["fraction_decisionId"] = $oListe["decision_id"] ; 
										$oDataFraction["fraction_congeId"] = $iReturnId ; 
										$oDataFraction["fraction_date"] = $zDateDebut; 
										$oDataFraction["fraction_nbrJour"] = $oListe['reste'] ;
										$oDataFraction["fraction_userId"]	= $oUser['id'] ;

										$zNombreJourConge = $zNombreJourConge - $oListe['reste'];

										$this->Fraction->insert($oDataFraction);	 
									}
								}

							}

						}

					} 

					if ($_iId != FALSE){
						$this->sendMailGcap($_zHashModule,$_zHashUrl,$iReturnId,2);
					} else {
						$this->sendMailGcap($_zHashModule,$_zHashUrl,$iReturnId,1);
					}
					
					break;

			}
			
			$zLibelle = "" ; 
			$zTitre	= "" ; 
			$zRedirect	= "liste" ;
			switch ($iTypeGcapId) {
				
				case DECISION :

					if ($_iId != FALSE){
						$oDecision = $this->Decision->get_decision ($_iId);
						if($oDecision["decision_statutId"] == STATUT_CREATION || $oDecision["decision_statutId"] == STATUT_RECEPTION_RESP_PERSONNEL) {
							$zRedirect	= "liste" ;
						}
						else
						{
							$zRedirect	= "extrants" ;
						}
					}

					break;

				default :
					$zRedirect	= "extrants" ;
					$_zHashUrl  = "demande" ; 
					break;

				/*case CONGE :
						$zRedirect	= "liste" ;
						$_zHashUrl  = "conge" ; 

						break;
				case AUTORISATION_ABSENCE :
						$zRedirect	= "liste" ;
						$_zHashUrl  = "autorisation-abscence" ; 

						break;
				case PERMISSION :
						$zRedirect	= "liste" ;
						$_zHashUrl  = "permission" ; 

						break;

				case REPOS_MEDICAL_LUCIA :

					if ($_iId != FALSE){
						$oGcap = $this->Gcap->get_Gcap ($_iId);
						if($oGcap["gcap_statutId"] == STATUT_CREATION || $oDecision["gcap_statutId"] == STATUT_RECEPTION_RESP_PERSONNEL) {
							$zRedirect	= "liste" ;
						}
						else
						{
							
							$zRedirect	= "extrants" ;
							$_zHashUrl = "demande" ; 
						}
					}

					$zRedirect	= "liste" ;
					$_zHashUrl  = "repos-medical" ; 

					break;*/

			}

			if ( empty($_SESSION['iCurrpageListe'])){
				redirect("gcap/$zRedirect/$_zHashModule/$_zHashUrl");
			} else {

				if (is_integer($_SESSION['iCurrpageListe']) && ($_SESSION['iCurrpageListe'] > 0)){
					redirect("gcap/$zRedirect/$_zHashModule/$_zHashUrl/".$_SESSION['iCurrpageListe']);
				} else {
					
					if($_zHashUrl == 'demande'){
						redirect("gcap/extrants/gestion-absence/demande");
					} else {
						redirect("gcap/$zRedirect/$_zHashModule/$_zHashUrl");
					}
				}
			}
			
			
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* function permettant d'envoyer un mail
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iId identifiant Gcap
	* @param integer $_iMode Agent/supérieur hierarchique
	*
	* @return view
	*/
	public function sendMailGcap($_zHashModule, $_zHashUrl, $_iId = FALSE,$_iMode=1){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iNumId = sprintf("%'.06d\n", $_iId);

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			//$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);

			$oGcap = $this->Gcap->get_Gcap ($_iId);
			$iTypeGcapId = $oGcap["gcap_typeGcapId"];
			
			$zLibelle = "" ; 
			$zTitre	= "" ; 
			$zSelect = "" ; 

			$iCompteActif = $this->getSessionCompte();

			switch ($iTypeGcapId) {
				
				case CONGE :
					$zLibelle = " DEMANDE DE CONG&Eacute; " ; 
					$zSujetLibele = " demande de congé " ; 
					
					break;

				case AUTORISATION_ABSENCE :
					$zLibelle = " DEMANDE D'AUTORISATION D'ABSENCE " ; 
					$zSujetLibele = " demande d'autorisation d'absence " ; 
					break;

				case PERMISSION :
					$zLibelle = " DEMANDE DE PERMISSION " ; 
					$zSujetLibele = " demande de permission " ; 
					break;

				case MISSION :
					$zLibelle = " DEMANDE DE MISSION " ; 
					$zSujetLibele = " demande de mission " ; 
					break;

				case FORMATION :
					$zLibelle = " DEMANDE DE FORMATION " ; 
					$zSujetLibele = " demande de formation " ; 
					break;

				case REPOS_MEDICAL_LUCIA :
					$zLibelle = " REPOS MEDICAL " ; 
					$zSujetLibele = " repos médical " ; 
					break;

			}

			$oGcap = array();

			if ($_iId != FALSE){
				$oGcap = $this->Gcap->get_Gcap ($_iId);
				$oGcap["motif_libelle"] = $this->Gcap->get_motif_libelle($oGcap["gcap_motif"]);
			}

			$oCandidat = $this->Gcap->get_candidat($oGcap['gcap_userSendId']);
			$oData['oCandidat'] = $oCandidat ; 

			$oService = $this->Gcap->get_service($oData['oCandidat']['service']);
			$oData['oService'] = $oService ; 


			if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
			{
				$oData["gcap_statutId"] = STATUT_RECEPTION_RESP_PERSONNEL ;
				/*if ($_iId != FALSE){
					$this->Gcap->update_gcap($oData, $_iId);
				} */
			}

			$toGcapWeekEnd = array(CONGE,AUTORISATION_ABSENCE,PERMISSION);

			$zDateDebut = $oGcap['gcap_dateDebut'] ; 
			$zDateFin = $oGcap['gcap_dateFin'] ; 
			$iUserId = $oGcap['gcap_userSendId'] ; 
			$iType = $oGcap['gcap_typeId'];


	
			$iNombreConge = floor($this->human_time_diff ($oGcap["gcap_dateDebut"], $oGcap["gcap_dateFin"])) ; 

			$iTestDayDeb1 = date("D", strtotime($oGcap['gcap_dateDebut']));
			$iTestDayFin1 = date("D", strtotime($oGcap['gcap_dateFin']));

			/* Test jour férié*/
			$zDateHierFerie = date("Y-m-d", strtotime($oGcap['gcap_dateDebut'] ."-1 days"));
			$zDateDemainFerie = date("Y-m-d", strtotime($oGcap['gcap_dateFin'] ."+1 days"));

			/*if(in_array($iTypeGcapId, $toGcapWeekEnd)){*/

				$toPasseFerie = $this->Gcap->getJourFerie ($zDateHierFerie);

				if (sizeof($toPasseFerie)>0){
					foreach ($toPasseFerie as $oPasseFerie){
						switch($oPasseFerie['ferie_jour']) {
							case 'Mon':
								if (date("Y-m-d") <= '2018-09-24'){
									$iNombreConge += 3 ; 
									if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==2){
										$iNombreConge -= 3 ; 
									}
							   }

							break;

							default:
								if (date("Y-m-d") <= '2018-09-24'){
									$iNombreConge += 1 ; 
									if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==2){
										$iNombreConge -= 1 ; 
									}
								}
								break;

						}
					}
				}

				$toDemainFerie = $this->Gcap->getJourFerie ($zDateDemainFerie);

				if (sizeof($toDemainFerie)>0){
					foreach ($toDemainFerie as $oDemainFerie){
						switch($oDemainFerie['ferie_jour']) {
							case 'Fri':
								if (date("Y-m-d") <= '2018-09-24'){
									$iNombreConge += 3 ; 
									if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1){
										$iNombreConge -= 3 ; 
									}
								}
							break;

							default:
								if (date("Y-m-d") <= '2018-09-24'){
									$iNombreConge += 1 ; 
									if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1){
										$iNombreConge -= 1 ; 
									}
								}
								break;

						}
					}
				}

				$iTestDayFinFerie = date("D", strtotime($oGcap['gcap_dateFin']));

				if ($iTestDayFinFerie == 'Fri') {
					$zDateLundiFerie = date("Y-m-d", strtotime($oGcap['gcap_dateFin'] ."+3 days"));

					$toLundiFerie = $this->Gcap->getJourFerie ($zDateLundiFerie);

					if (sizeof($toLundiFerie)>0){
						foreach ($toLundiFerie as $oLundiFerie){
							switch($oLundiFerie['ferie_jour']) {
								case 'Mon':
									if (date("Y-m-d") <= '2018-09-24'){
										$iNombreConge += 1 ; 

										$iTestDayFin = date("D", strtotime($oGcap['gcap_dateFin']));

										if ($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1 &&  $iTestDayFin == 'Fri') {
											$iNombreConge -= 1 ; 
										}
									}
								break;
							}
						}
					}
				}

				/* Test fin jour férié*/

				if ($iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iNombreConge += 2;
					}
				}

				if ($iTestDayFin1 == 'Fri') {
					$iNombreConge += 2;
				}

				if ($iTestDayFin1 == 'Sat') {
					$iNombreConge += 1;
				}

				if ($oGcap['gcap_demiJournee'] == 1) {
					$iNombreConge -= 0.5 ; 
				}

				if ($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iNombreConge -= 2;
					}
				}

				if ($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
					$iNombreConge -= 2;
				}
			/*}*/

			$zCongeSuite = "" ; 
			if ($iTypeGcapId == AUTORISATION_ABSENCE && $iNombreConge){
		
				$iMax = 3;
				if ($oGcap['gcap_typeId'] == AUTORISATION_ABSCENCE_SPECIAL){
					$iMax = 7;
				}

				if ($oGcap['gcap_typeId'] == AUTORISATION_SPECIAL_ABSCENCE){
					$iMax = 20;
				}
				
				$iDiffAutorisation = $iNombreConge-$iMax;
				$zSAlaFinDiffAutorisation = "";
				if ($iDiffAutorisation > 1) {
					$zSAlaFinDiffAutorisation = "s";
				}
				
				if ($iDiffAutorisation > 0){
					$zCongeSuite .=  "(dont ".$iDiffAutorisation." jour".$zSAlaFinDiffAutorisation." cong&eacute;".$zSAlaFinDiffAutorisation.")";
				}
			}

			$oData['oGcap'] = $oGcap ; 
			$zDateDebut = $this->date_fr_to_en($oGcap['gcap_dateDebut'],'-','/'); 
			$zDateFin = $this->date_fr_to_en($oGcap['gcap_dateFin'],'-','/'); 
			$oData['iNombreConge'] = $iNombreConge ;
			$oData['zCongeSuite'] = $zCongeSuite ;
			$oData['iTypeGcapId']	= $iTypeGcapId ;
			$oData['zDateDebut']	= $zDateDebut ;
			$oData['zDateFin']	= $zDateFin ;
			$oData['zPieceJointe'] = $oGcap['gcap_pieceJointe'];
			$oData['sigle'] = $this->Gcap->get_sigle($this,$oGcap['gcap_userSendId']);
			$oData['sigleLong'] = $this->Gcap->get_sigle($this,$oGcap['gcap_userSendId'],0);
			$zLogo = $this->Gcap->get_logo($oGcap['gcap_userSendId']);
			$oData['getLogo'] = $zLogo ; 
			$oData['toSigle'] = $this->Gcap->get_sigle($this,$oGcap['gcap_userSendId'],3);

			/*echo "<pre>";
			print_r ($oData);
			echo "</pre>";*/

			$zSigleCourt = "/MEF";
			if ($oData['sigle'] !=""){
				
				$zSigleCourt .= "/";
				$zSigleCourt .= $oData['sigle'] ;
			}

			$oSmarty->assign('zHashModule', $_zHashModule);
			$oSmarty->assign('zHashUrl', $_zHashUrl);
			$oSmarty->assign('iId', $_iId);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zHashUrl', $_zHashUrl);
			$oSmarty->assign('iNumId', $iNumId);
			$oSmarty->assign('oData', $oData);
			$oSmarty->assign('zLibelle', $zLibelle);
			$oSmarty->assign('zCongeSuite', $zCongeSuite);
			$oSmarty->assign('zDateDebut', $zDateDebut);
			$oSmarty->assign('zDateFin', $zDateFin);
			$oSmarty->assign('zSigleCourt', $zSigleCourt);

			if ($_iMode == 1){

				$zSujet = "ROHI : " . ucfirst(strtolower(($zSujetLibele))). " pour l'agent " . $oCandidat["nom"] . " " . $oCandidat["prenom"];
				$oUserCorres = $this->user->get_user($oCandidat['user_id']);

				$iIsChefService = $this->Gcap->setChefService ($oCandidat['user_id']);
				$zUserId = $this->Gcap->getAllChefHierarchique ($this,$oUserCorres,$oCandidat,$oCandidat['user_id'],$zNotIn,0,$iIsChefService);
				$toCompteSend = $this->Compte->getCompteAutorite($zUserId);
				foreach ($toCompteSend as $oCompteSend){

					$zUrlScript = $this->addHash($oCompteSend['user_id']."----gcap/edit/".$_zHashModule."/".$_zHashUrl."/".$_iId."----3");
					$zUrlScript = str_replace("+","__xxxx__",$zUrlScript);
					$oSmarty->assign('zUrlCrypt', $zUrlScript);
					$oSmarty->assign('oCompteSend', $oCompteSend);
					$zBody = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/gcapAutorite.tpl" );
					$this->sendMail($oCompteSend,$zSujet,$zBody);
				}
			} else {

				$zSujet = "ROHI : validation ou refus de votre " . ucfirst(strtolower(($zSujetLibele)));

				$oAutorite = $this->user->get_user($oGcap["gcap_userValidId"]);

				$zUrlScript = $this->addHash($oCandidat['user_id']."----gcap/edit/".$_zHashModule."/".$_zHashUrl."/".$_iId."----1");
				$zUrlScript = str_replace("+","__xxxx__",$zUrlScript);

				$oSmarty->assign('zUrlCrypt', $zUrlScript);
				$oSmarty->assign('oCandidat', $oCandidat);
				$oSmarty->assign('iValid', $oGcap['gcap_valide']);
				$oSmarty->assign('oAutorite', $oAutorite);

				$zBody = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/gcapAgent.tpl" );
				$this->sendMail($oCandidat,$zSujet,$zBody);
				//echo $zBody;

			}
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Sauvegarde 2
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iId Identifiant Gcap
	*
	* @return view
	*/
	public function save2($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

			$iTypeGcapId	= $this->postGetValue ("iTypeGcapId",0) ;
			$iCompteActif	= $this->getSessionCompte();
			
			$oData = array();

			$oData["gcap_userSendId"] = $this->postGetValue ("iTypeGcapId",0) ; 
			$oData["gcap_typeGcapId"] = $this->postGetValue ("type_id",0) ; 
			$oData["gcap_dateDebut"] = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
			$oData["gcap_dateFin"] = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-');
			$oData["gcap_motif"] = $this->postGetValue ("motif",0) ; 
			$oData["gcap_lieuJouissance"] = $this->postGetValue ("lieu_jouissance",0) ; 

			if ($_iId != FALSE){
				$iReturnId = $this->Gcap->update_gcap2($oData, $_iId);
			} else {
				$iReturnId = $this->Gcap->insert2($oData);
			}

			redirect("gcap/autres/gestion-absence/autres-absences");
			
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Suppression Gcap
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function delete($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			$iElementId = $this->postGetValue ("iElementId",0) ; 


			switch ($iTypeGcapId) {
				
				case DECISION :

					$this->Decision->delete_decision($iElementId);
					redirect("gcap/liste/$_zHashModule/decision");
					break;

				default :
					$oGcap = $this->Gcap->get_Gcap ($iElementId);
					$iTypeGcapId = $oGcap["gcap_typeGcapId"];

					$oData = array();
					$oData["mic_date"] = date("Y-m-d") ; 
					$oData["mic_userId"] = $oUser["id"] ; 
					$oData["mic_gcapId"] = $iElementId; 
					$oData["mic_debut"] = $oGcap['gcap_dateDebut'];
					$oData["mic_fin"] =  $oGcap['gcap_dateFin'];
					$oData["mic_UserInfoId"] = $oGcap['gcap_userSendId']; 
					$oData["mic_motif"] =  $oGcap['gcap_motif'];
					$this->Gcap->insertMic($oData);


					$this->Gcap->delete_gcap($iElementId);

					if($iTypeGcapId == CONGE || $iTypeGcapId == AUTORISATION_ABSENCE){
						$this->Fraction->delete_fraction_by_conge_id($iElementId);
					}

					redirect("gcap/extrants/gestion-absence/demande");
					break;
				/*case AUTORISATION_ABSENCE :

					$oGcap = $this->Gcap->get_Gcap ($iElementId);

					$oData = array();
					$oData["mic_date"] = date("Y-m-d") ; 
					$oData["mic_userId"] = $oUser["id"] ; 
					$oData["mic_gcapId"] = $iElementId; 
					$oData["mic_debut"] = $oGcap['gcap_dateDebut'];
					$oData["mic_fin"] =  $oGcap['gcap_dateFin'];
					$oData["mic_UserInfoId"] = $oGcap['gcap_userSendId']; 
					$oData["mic_motif"] =  $oGcap['gcap_motif'];
					$this->Gcap->insertMic($oData);

					$this->Gcap->delete_gcap($iElementId);
					$this->Fraction->delete_fraction_by_conge_id($iElementId);
					redirect("gcap/liste/$_zHashModule/autorisation-abscence");
					break;
				case PERMISSION :

					$oGcap = $this->Gcap->get_Gcap ($iElementId);

					$oData = array();
					$oData["mic_date"] = date("Y-m-d") ; 
					$oData["mic_userId"] = $oUser["id"] ; 
					$oData["mic_gcapId"] = $iElementId; 
					$oData["mic_debut"] = $oGcap['gcap_dateDebut'];
					$oData["mic_fin"] =  $oGcap['gcap_dateFin'];
					$oData["mic_UserInfoId"] = $oGcap['gcap_userSendId']; 
					$oData["mic_motif"] =  $oGcap['gcap_motif'];
					$this->Gcap->insertMic($oData);

					$this->Gcap->delete_gcap($iElementId);
					redirect("gcap/liste/$_zHashModule/permission");
					break;

				case REPOS_MEDICAL_LUCIA :
					$this->Gcap->delete_gcap($iElementId);
					redirect("gcap/liste/$_zHashModule/repos-medical");
					break;*/

			}

			
			
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* recupération des rubriques salariales d'un agent EFA/ELD/Fonctionnaire
	*
	* @param int $iMatricule numéro matricule
	* @param int $_iMois Mois de recherche
	* @param int $_iAnnee Année de recherche
	* @param string $_zSpecial edition speciale ou pas
	* @param string $_zLastParameter separateur
	* @return view
	*/
	private function setCandidatAffiche($iMatricule, $_iMois, $_iAnnee,$_zSpecial='',$_zLastParameter=',String_SEPARATOR_schema,cloture,String') 
	{
		$oCandidatAffiche = array();

		$zData1 = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/recap.txt"); 

		$zData1 = str_replace("%MATRICULE%", $iMatricule, $zData1) ; 
		$zData1 = str_replace("%MOIS%", trim($_iMois), $zData1) ; 
		$zData1 = str_replace("%ANNEE%", trim($_iAnnee), $zData1) ; 
		$zData1 = str_replace("%SPECIAL%", $_zSpecial, $zData1) ; 
		$zData1 = str_replace("%SPECIAL%", "", $zData1) ; 
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

		$zContent = $this->get_content($zData1, $_iMois, $_iAnnee);
		$oCandidatAffiche = array();
		if ($zContent == 'null' && $_zSpecial==''){
			
		} else {
			
			if($zContent != 'null'){
				$toContent = explode('{"TFicRecap"',$zContent);
				$oCandidatAffiche = json_decode ('{"TFicRecap"'.$toContent[1]);
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

	private function __setCandidatAffiche($iMatricule, $_iMois, $_iAnnee,$_zSpecial='',$_zLastParameter=',String_SEPARATOR_schema,cloture,String') 
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
			if ($_iAnnee == '18'){
				$zData1 = str_replace("%iAnnee%",  "_20" . trim($_iAnnee), $zData1) ; 
			} else {
				$zData1 = str_replace("%iAnnee%", "", $zData1) ; 
			}
		} else {
			$zData1 = str_replace("%iAnnee%", "", $zData1) ; 
		} 

		ini_set('default_socket_timeout', 10);

		$oCtx = stream_context_create(array('http'=>
			array(
				'timeout' => 10,  
			)
		));

		$zContent = @file_get_contents($zData1, false, $oCtx);
		$oCandidatAffiche = array();
		if ($zContent == 'null' && $_zSpecial==''){
			
		} else {
			
			if($zContent != 'null'){
				$oCandidatAffiche = json_decode ($zContent);
				if (!is_object($oCandidatAffiche)) {

					if (sizeof($oCandidatAffiche)> 0) {
						$oCandidatAffiche = $oCandidatAffiche->TFicRecap ;
					}
					
				} else {
					$oCandidatAffiche = $oCandidatAffiche->TFicRecap ;
				}
			}
		}

		return $oCandidatAffiche ; 
	}

	/** 
	* Etat de congé
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage page courante
	* @param integer $_iUserId Identifant User
	*
	* @return view
	*/
	public function etat($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCurrPage=1, $_iUserId=0){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		if ($_iUserId > 0) {
			$oUser = $this->user->get_user($_iUserId);
    		$oCandidat =$this->candidat->get_by_user_id($oUser['id']);
		}

		$iCurrPage = $_iCurrPage ; 

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	
			$oData['menu'] = 3;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			$iCompteActif	= $this->getSessionCompte();

			$iMatricule	= $this->postGetValue ("iMatricule",'') ;
			$iCin	= $this->postGetValue ("iCin",'') ;


			$oData['iMatricule'] = $iMatricule ;
			$oData['iCin'] = $iCin ;

			switch ($iModuleId)
			{
				case GESTION_ABSCENCE : 
					
					if (($iCompteActif == COMPTE_AGENT) || ($iCompteActif != COMPTE_AGENT && $_iUserId > 0)) {
						$zLibelle = "" ; 
						switch ($iTypeGcapId) {
							
							case CONGE :
								$zLibelle = "ETAT > CONG&Eacute;S" ; 
								$zTitre = "CONG&Eacute;" ; 
								$zPrefixe = "DE" ; 
								$zMessageAucun = "aucun cong&eacute; &agrave; imprimer" ; 
								$toListe = $this->Decision->getDecisonValideFractionGcap($oUser['id'],0,1);

								$i=0;
								foreach ($toListe as $oListe){
									
									$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($oListe['type_id']);
									$toListe[$i]["sigle"] = $oListe['decision_numero']."/MEF/" . $this->Gcap->get_sigle($this,$oListe['decision_userId']);
									$toListe[$i]["NombreJour"] = $oListe['fraction_nbrJour'] ; 
									$i++;
								}

								break;

							case AUTORISATION_ABSENCE :
								$zLibelle = "ETAT > AUTORISATION D'ABSENCE" ; 
								$zTitre = "AUTORISATION D'ABSENCE" ;
								$zPrefixe = "D'" ; 
								$zMessageAucun = "aucune autorisation d'absence &agrave; imprimer" ; 
								$toListe = $this->Gcap->get_all_gcap_etat(array(),$oCandidat, $oUser['id'], $iTypeGcapId, $iCompteActif);
								$i=0;
								foreach ($toListe as $oListe){
									
									$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($oListe['type_id']);
									$toListe[$i]["sigle"] = "MEF/" . $this->Gcap->get_sigle($this,$oListe['gcap_userSendId']);
									$toListe[$i]["NombreJour"] = floor($this->human_time_diff ($oListe['gcap_dateDebut'], $oListe['gcap_dateFin'])) ; 
									$i++;
								}
								break;

							case PERMISSION :
								$zLibelle = "ETAT > PERMISSIONS" ;
								$zTitre = "PERMISSION" ;
								$zPrefixe = "DE" ; 
								$zMessageAucun = "aucune permission &agrave; imprimer" ; 
								$toListe = $this->Gcap->get_all_gcap_etat(array(),$oCandidat, $oUser['id'], $iTypeGcapId, $iCompteActif);
								$i=0;
								foreach ($toListe as $oListe){
									
									$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($oListe['type_id']);
									$toListe[$i]["sigle"] = "MEF/" . $this->Gcap->get_sigle($this,$oListe['gcap_userSendId']);
									$toListe[$i]["NombreJour"] = floor($this->human_time_diff ($oListe['gcap_dateDebut'], $oListe['gcap_dateFin'])) ; 
									$i++;
								}
								break;

						}

						$oData['zLibelle'] = $zLibelle ; 
						$oData['zTitre'] = $zTitre ; 
						$oData['zPrefixe'] = $zPrefixe ; 
						$oData['zHashUrl'] = $_zHashUrl ; 
						$oData['zHashModule'] = $_zHashModule ;
						$oData['zMessageAucun'] = $zMessageAucun ;
						$oData['date'] = date("Y-m-d") ;

						/*echo "<pre>" ; 

						print_r ($toListe);

						echo "</pre>";*/

						//die();

						
 
						$oData['zBasePath'] = base_url() ;
						$oData['oListe'] = $toListe ; 
						$oData['oCandidat'] = $this->Gcap->get_candidat($oUser['id']);
						$oData['oService'] = $this->Gcap->get_service($oData['oCandidat']['service']);

						/*echo "<pre>";
						print_r ($oData['oCandidat']);
						echo "</pre>";*/

						$this->load_my_view_Common('gcap/etat.tpl',$oData, $iModuleId);
					} else {
						redirect("gcap/etat_agent/gestion-absence/".$_zHashUrl."/");
					}
				break;

				case JOURNAL_ET_PLANNING : 
					if ($iCompteActif > COMPTE_AGENT)
					{
						
						$oData['zHashUrl'] = $_zHashUrl ; 
						$oData['zHashModule'] = $_zHashModule ;
						$oData['zMessageAucun'] = "Aucun r&eacute;sultat correspondant &agrave; votre recherche" ;

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

						$oData['zLocalite'] = $zLocalite ; 
						
						switch ($_zHashUrl) {
							case 'journal':
								$oData['menu'] = 60;
								$oData['zLibelle'] = "" ;
								$toListe = $this->Gcap->get_all_gcap_etat_journal_planning($oUser, $oData['oDataSearch'],$oCandidat, $oUser['id'],CONGE, $iCompteActif, $iNbrTotal, NB_PER_PAGE, $iCurrPage);

								$toListResult = array();
								foreach($toListe as $oListe){

									$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($oListe['gcap_typeId']);
									$toListeDecision = $this->Decision->getDecisonValide($oListe['gcap_userSendId'], $iTypeGcapDecision,1);


									$iNombreTotalDispo = 0;

									$zRefDecision = "";
									$iDecisionNbJour = 0;
									$iNombreTotalDeJourDispo = 0;
									$iNombreTotalDispoRestant = 0;
									foreach($toListeDecision as $toListeDecision) {
										//$oListe['iLastConge'] += $toListeDecision['nbrJourCumule'];
										$iNombreTotalDispoRestant += $toListeDecision['reste'];
										$zRefDecision += " " . $toListeDecision['decision_numero'] . "<br/>";
										//$iDecisionNbJour = $toListeDecision['decision_nbrJour'];
										$iNombreTotalDeJourDispo += $toListeDecision['decision_nbrJour'];
										$iDecisionNbJour = $iNombreTotalDeJourDispo - $iNombreTotalDispoRestant;
									}

									$oListe['iNombreTotalDispoRestant'] = $iNombreTotalDispoRestant ; 
									$oListe['zRefDecision'] = $zRefDecision ; 
									$oListe['iDecisionNbJour'] = $iDecisionNbJour ;
									$oListe['iNombreTotalDeJourDispo'] = $iNombreTotalDeJourDispo ;

									array_push($toListResult, $oListe);
								}

								$oData['oListe'] = $toListResult ; 

								$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
								$oData['zPagination'] = $zPagination ; 

								$this->load_my_view_Common('gcap/journal.tpl',$oData, 2);
								break;

							case 'planning':
								$oData['menu'] = 60;
								//$zUserId = $this->Gcap->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
								$oData['oListe'] = $this->Gcap->get_all_gcap_etat_journal_planning($oUser, $oData['oDataSearch'], $oCandidat, $oUser['id'],0, $iCompteActif,$iNbrTotal, NB_PER_PAGE, $iCurrPage);
								$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
								$oData['zPagination'] = $zPagination ;

								$this->load_my_view_Common('gcap/planning.tpl',$oData, 2);

								break;
						}
					}
					break;
			}
					
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* extrants demande
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage page courante
	*
	* @return view
	*/
	public function extrants($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage = 1){
		
		$oUser = array();
		$oCandidat = array();

		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

	    	$oData['menu'] = 2;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$zLibelle = "" ; 

			$iCompteActif	= $this->getSessionCompte();

			$iMatricule	= $this->postGetValue ("iMatricule",'') ;
			$iCin	= $this->postGetValue ("iCin",'') ;


			$oData['iMatricule'] = $iMatricule ;
			$oData['iCin'] = $iCin ;
			$zBasePath = base_url();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			switch ($_zHashUrl) {
				
				case "__decisions" : 
					$zLibelle = "Gestion d'absence > D&eacute;cision" ; 
					$oData['zLibelle'] = $zLibelle ;
					$iCurrPage = $_iCurrPage;
					$oData['oListe'] = $this->Decision->get_all_decision_extrant($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
					$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;

					$oData['zPagination'] = $zPagination ; 
					$oData['zHashUrl'] = "decision" ; 
					$oData['menu'] = 8;
					$oData['zTitle'] = ucfirst(strtolower($zLibelle)) ;
					$this->load_my_view_Common('gcap/extrant_decision.tpl',$oData, $iModuleId);

					break;

				
				case "decisions" : 
					$zLibelle = "Gestion d'absence > D&eacute;cision &agrave; imprimer" ; 
					$oData['zLibelle'] = $zLibelle ;
					$iCurrPage = $_iCurrPage;
					$toListe = $this->Decision->get_all_decision_extrant($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
					$toAnneeSigner = array();

					foreach($toListe as $oListe){
						array_push($toAnneeSigner,$oListe['decision_annee']);
					}
				
					$oData['annee']	= date("Y") ; 
					$oData['iAnnePriseDecision'] = $this->getAnneePriseService($oCandidat) ; 

					if (date("Y") - $this->getAnneePriseService($oCandidat) < 20) {
						$oData['iLastBoucle'] = date("Y") - $oData['iAnnePriseDecision'] ; 
					} else {
						$oData['iLastBoucle'] = 5 ; 
					}

					$oData['toAnneeSigner'] = $toAnneeSigner ; 
					$oData['iCompteActif'] = $iCompteActif ; 
					$oData['zHashUrl'] = "decision" ; 
					$oData['menu'] = 8;
					$oData['zTitle'] = ucfirst(strtolower($zLibelle)) ;
					$this->load_my_view_Common('gcap/extrant_decision_imprimer.tpl',$oData, $iModuleId);

					break;


				case "demande" :
				case "demandes" :
					$zLibelle = "Gestion d'absence > Liste des demandes" ;
					$oData['zLibelle'] = $zLibelle ;
					$oData['menu'] = 9;
					$oData['zTitle'] = ucfirst(strtolower($zLibelle)) ;

					/*$zLastMonth = date("m")-2;
					$zLastMonth = sprintf("%'.02d\n", $zLastMonth);
					$zFinMonth = date("m",date("m")+1);
					$zFinMonth = sprintf("%'.02d\n", $zFinMonth);
					$zDateMonth = "01/". trim($zLastMonth) ."/".date("Y");
					$zDateDebut = $this->postGetValue ("zDateDebut",$zDateMonth); 
					$zDateFin = $this->postGetValue ("zDateFin",intval(date("t","12"))."/".trim($zFinMonth)."/".date("Y"));*/

					$zDateMonth = date("d/m/Y", mktime(0,0,0,date("m")-2, 1, date("Y")));
					$zFinMonth = date("d/m/Y", mktime(0,0,0,date("m")+1, date("t","12"), date("Y")));


					$zDateDebut = $this->postGetValue ("zDateDebut",$zDateMonth); 
					$zDateFin = $this->postGetValue ("zDateFin",$zFinMonth);

					$oData['zDateDebut'] = $zDateDebut ; 
					$oData['zDateFin'] = $zDateFin ;

					$zHash = "";
					if($_zHashUrl == 'demandes'){
						$zHash = "add";	
					}
					$oData['zHash'] = $zHash ;			
					$oData['oDataSearch']['zDateDebut'] = $this->date_fr_to_en($zDateDebut,'/','-'); 
					$oData['oDataSearch']['zDateFin'] = $this->date_fr_to_en($zDateFin,'/','-'); 

					switch ($iCompteActif){

						case COMPTE_RESPONSABLE_PERSONNEL:
							$oList = $this->Gcap->get_all_gantt_planning($oUser, $oData['oDataSearch'], $oCandidat, $oUser['id'],0, COMPTE_AUTORITE,$iNbrTotal,1000, 1);
							break;

						case COMPTE_AUTORITE:
							
							$oList = $this->Gcap->get_all_gantt_planning($oUser, $oData['oDataSearch'], $oCandidat, $oUser['id'],0, COMPTE_AUTORITE,$iNbrTotal,1000, 1);
							break;

						case COMPTE_EVALUATEUR:
							$oList = $this->Gcap->get_all_gantt_planning($oUser, $oData['oDataSearch'], $oCandidat, $oUser['id'],0, COMPTE_EVALUATEUR,$iNbrTotal,1000, 1);
							break;

						default:
							$iEvaluateuruserId = $this->Gcap->getEvaluateurAgent($oUser['id'],$this);

							if($iEvaluateuruserId > 0){
								$oList = $this->Gcap->get_all_gantt_planning($oUser, $oData['oDataSearch'], $oCandidat, $iEvaluateuruserId,0, COMPTE_EVALUATEUR,$iNbrTotal,1000, 1);
							} else {
								$oList = $this->Gcap->get_all_gantt_planning($oUser, $oData['oDataSearch'], $oCandidat, $oUser['id'],0, COMPTE_AUTORITE,$iNbrTotal,1000, 1);
							}
							break;
					}

					//print_r ($oList);

					$tableJson = [];
					$cpt = 1;
					foreach($oList as $oRow){
						
						$oRowJson = new stdClass();
						$oRowJson->name = $oRow['nom'] . ' '. $oRow['prenom'];
						$oRowJson->desc = "";
						$oValues = [];

						$toGcap = explode(";",$oRow['GcapDate']);
						foreach ($toGcap as $zGcap){

							$toDate = explode("/",$zGcap);

							if (sizeof($toDate)>0){
							
								if (isset($toDate[0]) && isset($toDate[1])){

									$zDateDebut = strtotime($toDate[0]);
									$zDateFin = strtotime($toDate[1]);

									$zDesc = "";
									$zDemiJournee = "";
									if ($toDate[3] == 1){
										switch ($toDate[4]){

											case '1':
												$zDateDebut = strtotime($toDate[0]);
												$zDateFin = strtotime($toDate[1] . "12:00:00");
												$zDemiJournee = utf8_decode("Se termine le " . $this->date_en_to_fr($toDate[1],"-","/"). " matin") ;
												break;

											case '2':
												$zDemiJournee = utf8_decode("Commence le " . $this->date_en_to_fr($toDate[0],"-","/"). " apr&egrave;s-midi");
												break;
										}
									}

									$oValue = new stdClass();
									$oValue->id = $cpt;
									$oValue->from = "/Date(".$zDateDebut."000)/";
									$oValue->to = "/Date(".$zDateFin."000)/";
									$oValue->customClass = "";

									$zTitle = "";
									switch ($toDate[2]) {
										case CONGE:
											$oValue->customClass = "conge";
											$zTitle = utf8_decode("Cong&eacute;") ;
											break;

										case AUTORISATION_ABSENCE:
											$oValue->customClass = "abscence";
											$zTitle = utf8_decode("Autorisation d'absence") ;
											break;

										case PERMISSION:
											$oValue->customClass = "permision";
											$zTitle = utf8_decode("Permission") ;
											break;

										case REPOS_MEDICAL_LUCIA:
											$oValue->customClass = "repos";
											$zTitle = utf8_decode("Repos medical") ;
											break;

										case MISSION:
											$oValue->customClass = "mission";
											$zTitle = utf8_decode("Mission") ;
											break;

										case FORMATION:
											$oValue->customClass = "formation";
											$zTitle = utf8_decode("Formation") ;
											break;
									 }	

									$zDesc  = "<b>".$zTitle."</b><br><br>Du : ".$this->date_en_to_fr($toDate[0],"-","/")." au " . $this->date_en_to_fr($toDate[1],"-","/") ;
									$zDesc .= "<br><br>" . $zDemiJournee;

									$oValue->desc = $zDesc;

									
									
									array_push($oValues,$oValue);
								}
							}
						}

						$oRowJson->values = $oValues;
						array_push($tableJson,$oRowJson);
						$cpt++;
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
					
					$oData['jsonData'] = json_encode($tableJson);
					$oData['toMonth'] = $toMonth;
					$oData['iCompteActif'] = $iCompteActif;
					$oData['zAnneeBoucle'] = date("Y");
					$oData['iLastBoucle'] = date("Y")-2016;
					$oData['sizeTab'] = sizeof($oList);

					$this->load_my_view_Common('gcap/listeExtrantsDemandes.tpl',$oData, $iModuleId);
					break;

				
				case 'ajax':
					
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;
						$toListe = $this->Gcap->get_all_gcap_extrants("",$oUser, $oCandidat, $oUser['id'], $iCompteActif, $iNombreTotal);

						$oDataAssign = array();
						foreach ($toListe as $oListe){
							
							$oDataTemp=array(); 
							$oDataTemp[] = $oListe['type_libelle'];

							if(base_url() == 'http://localhost:8088/ROHI/'){
								$oDataTemp[] = utf8_encode($this->date_format($oListe['gcap_dateDebut'])); 
								$oDataTemp[] = utf8_encode($this->date_format($oListe['gcap_dateFin'])); 
							} else {
								$oDataTemp[] = $this->date_format($oListe['gcap_dateDebut']); 
								$oDataTemp[] = $this->date_format($oListe['gcap_dateFin']); 
							}

							$zNombreConge = $oListe['iNombreConge'];

							if ($oListe['gcap_typeGcapId'] == AUTORISATION_ABSENCE){
								$iMax = 3;
								if (($oListe['gcap_typeGcapId'] == AUTORISATION_ABSENCE) && ($oListe['gcap_typeId'] == AUTORISATION_ABSCENCE_SPECIAL)){
									$iMax = 7;
								}

								if (($oListe['gcap_typeGcapId'] == AUTORISATION_ABSENCE) && ($oListe['gcap_typeId'] == AUTORISATION_SPECIAL_ABSCENCE)){
									$iMax = 20;
								}

								if ($oListe['iNombreConge'] > $iMax){
									$zNombreConge = "";
									
									$iConge = $oListe['iNombreConge'] - $iMax;
									$zS = ($iConge>1)?"s":"";
									$zNombreConge .= '<span style="color:blue">- Autorisation d\'absence : '.$iMax.' jours</span> <br><br>';
									$zNombreConge .= '<span style="color:green">- Cong&eacute; : '.$iConge.' jour'.$zS.'</span> <br><br>';
								}
							}

							$oDataTemp[] = $zNombreConge;

							if ($oListe['gcap_valide'] == ''){
								$oDataTemp[] = $oListe['statut_libelle'];
							} else {
								$zValidation = "";
								if ($oListe['gcap_valide'] == 1){
									$zValidation .= '<span style="color:green"><strong>Valid&eacute;</strong></span>';
								} else {
									$zValidation .= '<span style="color:#bc2d2d"><strong>Refus&eacute;</strong></span>';
								}
								$oDataTemp[] = $zValidation;
							}

							if ($iCompteActif != COMPTE_AGENT){
								$oDataTemp[] = $oListe['agent'];
							}

							$zAction = '' ; 

							$zHashUrl = "";
							switch ($oListe['gcap_typeGcapId']){
								case CONGE:
									$zHashUrl = "conge";
									break;

								case AUTORISATION_ABSENCE:
									$zHashUrl = "autorisation-abscence";
									break;

								case PERMISSION:
									$zHashUrl = "permission";
									break;

								case REPOS_MEDICAL :
								case REPOS_MEDICAL_LUCIA :
									$zHashUrl = "repos-medical";
									break;

								case MISSION:
									$zHashUrl = "mission";
									break;

								case FORMATION:
									$zHashUrl = "formation";
									break;
							}

							if ($oListe['gcap_valide'] != 2){
								$zAction .= '<a title="Imprimer" alt="Imprimer" href="'.$zBasePath.'gcap/imprimer/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['gcap_id'].'" title="" target="_blank" class="action"><i style="color:#12105A" class="la la-print"></i></a>' ; 
							} 

							if ($iCompteActif == COMPTE_AGENT){
								if ($oListe['gcap_statutId'] == STATUT_CREATION){
									$zAction .= '<a href="'.$zBasePath.'gcap/edit/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['gcap_id'].'" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-eye"></i></a>' ; 
								} else {
									$zAction .= '<a title="Voir" alt="Voir" href="'.$zBasePath.'gcap/edit/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['gcap_id'].'" title="" class="action"><i style="color:#0089DC" class="la la-eye"></i></a>' ; 
								}
								
							} elseif ($iCompteActif > 1) {
								if ($oListe['gcap_statutId'] == STATUT_CREATION){
									$zAction .= '<a href="'.$zBasePath.'gcap/edit/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['gcap_id'].'" title="En attente de validation" alt="En attente de validation" class="action"><i class="la la-bookmark"></i></a>' ;
								} else {
									$zAction .= '<a title="Voir" alt="Voir" href="'.$zBasePath.'gcap/edit/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['gcap_id'].'"title="Voir fiche" alt="Voir fiche" class="action"><i class="la la-eye"></i></a>';
								}
							}

							if ($iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_EVALUATEUR || $iCompteActif == COMPTE_ADMIN){
								$zAction .= '<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="'.$oListe['gcap_id'].'" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>';
							} 


							$oDataTemp[] = $zAction;

							$oDataAssign[] = $oDataTemp;
						}

						/*die();*/

						$taJson = array(
										"draw"            => intval( $oRequest['draw'] ),
										"recordsTotal"    => intval( $iNombreTotal ),
										"recordsFiltered" => intval( $iNombreTotal ),
										"data"            => $oDataAssign
									);
						echo json_encode($taJson);
						
					break;

				case "arretes" :
					$zLibelle = "Les archives > arr&ecirc;t&eacute;es" ; 
					 
					break;

			}
			
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Affichage menu accueil du module formation
	*
	* @param date $_zDate date à transformer
	* @param date $_zFormat format date sortie
	* @param date $default_date date par defaut
	*
	* @return view
	*/
	function date_format($_zDate, $_zFormat = ' %e %B %Y',$default_date='')
	{
		setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
		if ($_zDate != '') {
			$timestamp = strtotime($_zDate);
		} elseif ($default_date != '') {
			$timestamp = strtotime($default_date);
		} else {
			return;
		}
		if (DIRECTORY_SEPARATOR == '\\') {
			$_win_from = array('%D',       '%h', '%n', '%r',          '%R',    '%t', '%T');
			$_win_to   = array('%m/%d/%y', '%b', "\n", '%I:%M:%S %p', '%H:%M', "\t", '%H:%M:%S');
			if (strpos($_zFormat, '%e') !== false) {
				$_win_from[] = '%e';
				$_win_to[]   = sprintf('%\' 2d', date('j', $timestamp));
			}
			if (strpos($_zFormat, '%l') !== false) {
				$_win_from[] = '%l';
				$_win_to[]   = sprintf('%\' 2d', date('h', $timestamp));
			}
			$_zFormat = str_replace($_win_from, $_win_to, $_zFormat);
		}
		return strftime($_zFormat, $timestamp);
	}

	/** 
	* Rattaché
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage Page courante
	*
	* @return view
	*/
	public function rattache($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		
		$oUser = array();
		$oCandidat = array();

		$iCurrPage      = $_iCurrPage ;

		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iMatricule	= $this->postGetValue ("iMatricule",'') ;
			$iCin	= $this->postGetValue ("iCin",'') ;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$zLibelle = "" ; 

			$iCompteActif = $this->getSessionCompte();
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;

			$oData['iMatricule'] = $iMatricule ;
			$oData['iCin'] = $iCin ;
			
			$zLibelle = "Les Archives > D&eacute;cision" ; 
			$oData['zLibelle'] = $zLibelle ;

			$oData['oListe'] = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
			$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;

			$oData['zPagination'] = $zPagination ; 
			$this->load_my_view_Common('gcap/rattache.tpl',$oData, $iModuleId);
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Etat agent
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage Page courante
	*
	* @return view
	*/
	public function etat_agent($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		
		$oUser = array();
		$oCandidat = array();

		$iCurrPage      = $_iCurrPage ;

		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();

		/*if ($iCompteActif == COMPTE_AGENT) {
			redirect("gcap/etat/gestion-absence/".$_zHashUrl."/");
		}*/
    	
		if($iRet == 1){	

	    	$oData['menu'] = 3;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			switch ($iTypeGcapId) {
						
				case CONGE :
					$zLibelle = "ETAT > CONG&Eacute;S" ; 
					$zTitre = "CONG&Eacute;" ; 
					$zPrefixe = "DE" ; 
					$zMessageAucun = "aucun cong&eacute; &agrave; imprimer" ; 
					break;

				case AUTORISATION_ABSENCE :
					$zLibelle = "ETAT > AUTORISATION D'ABSENCE" ; 
					$zTitre = "AUTORISATION D'ABSENCE" ;
					$zPrefixe = "D'" ; 
					$zMessageAucun = "aucune autorisation d'absence &agrave; imprimer" ; 
					break;

				case PERMISSION :
					$zLibelle = "ETAT > PERMISSIONS" ;
					$zTitre = "PERMISSION" ;
					$zPrefixe = "DE" ; 
					$zMessageAucun = "aucune permission &agrave; imprimer" ; 
					break;
				case REPOS_MEDICAL_LUCIA :
					$zLibelle = "ETAT > REPOS MEDICAL" ;
					$zTitre = "REPOS MEDICAL" ;
					$zPrefixe = "DE" ; 
					$zMessageAucun = "aucune repos medical a imprimer" ; 
					break;

			}

			$iCompteActif = $this->getSessionCompte();
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['zLibelle'] = $zLibelle ; 
			$oData['zTitre'] = $zTitre ; 
			$oData['zPrefixe'] = $zPrefixe ; 
			
			$zLibelle = "Les Archives > D&eacute;cision" ; 
			$oData['zLibelle'] = $zLibelle ;

			$oData['oListe'] = $this->Decision->get_all_User_rattache($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE, $iCurrPage);
			$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;

			$oData['zPagination'] = $zPagination ; 
			$this->load_my_view_Common('gcap/etat_agent.tpl',$oData, $iModuleId);
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Affichage menu accueil du module formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function imprimer($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		//require_once(APPPATH.'libraries/ion_auth.php');
    	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['iNumId'] = sprintf("%'.06d\n", $_iId);
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$zLibelle = "" ; 
			$zTitre	= "" ; 
			$zSelect = "" ; 

			$iCompteActif = $this->getSessionCompte();

			switch ($iTypeGcapId) {
				
				case DECISION :
					$zLibelle = "ETAT > CONGCONGÉS" ; 
					$zMessageAucun = "aucun congé à imprimer" ; 
					$zTitre = "de décision" ; 
					$zTitre1 = "une décision" ; 
					$zTitre2 = "DÉCISION" ; 
					break;
				
				case CONGE :
					$zLibelle = "ETAT > CONG&Eacute;S" ; 
					$zMessageAucun = "aucun cong&eacute; &agrave; imprimer" ; 
					$zTitre = utf8_decode("DE CONGÉ") ; 
					$zTitre1 = utf8_decode("un congé") ; 
					$zTitre2 = utf8_decode(" EN CONGÉ") ; 
					break;

				case AUTORISATION_ABSENCE :
					$zLibelle = "ETAT > AUTORISATION D'ABSENCE" ; 
					$zMessageAucun = "aucune autorisation d'absence &agrave; imprimer" ; 
					$zTitre = "D'AUTORISATION D'ABSENCE" ;
					$zTitre1 = "une autorisation d'abscence" ;
					$zTitre2 = "D'AUTORISATION D'ABSENCE" ; 
					break;

				case PERMISSION :
					$zLibelle = "ETAT > PERMISSIONS" ; 
					$zMessageAucun = "aucune permission &agrave; imprimer" ; 
					$zTitre = "DE PERMISSION" ;
					$zTitre1 = "une permission" ; 
					$zTitre2 = "DE PERMISSION" ;
					break;

				case REPOS_MEDICAL_LUCIA :
					$zLibelle = "ETAT > REPOS_MEDICAL_LUCIA" ; 
					$zMessageAucun = "aucun repos medical &agrave; imprimer" ; 
					$zTitre = "DE REPOS MEDICAL" ;
					$zTitre1 = "un repos medical" ; 
					$zTitre2 = "DE REPOS MEDICAL" ;
					break;
				

				case MISSION :
					$zLibelle = "ETAT > MISSION" ; 
					$zMessageAucun = "aucune mission &agrave; imprimer" ; 
					$zTitre = "DE DEPART EN MISSION" ;
					$zTitre1 = "une mission" ; 
					$zTitre2 = "DE DEPART EN  MISSION" ;
					break;

				case FORMATION :
					$zLibelle = "ETAT > FORMATION" ; 
					$zMessageAucun = "aucune formation &agrave; imprimer" ; 
					$zTitre = "DE DEPART EN FORMATION" ;
					$zTitre1 = "une formation" ; 
					$zTitre2 = "DE DEPART EN FORMATION" ;
					break;

			}

	    	$oData['zTitre'] = $zTitre ; 
			$oData['zLibelle'] = $zLibelle ; 
			$oData['iTypeGcapId'] = $iTypeGcapId;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;

			$oType = $this->TypeGcap->get_type_by_TypeGcapId($iTypeGcapId);
			$oData['oType'] = $oType;

			$oData['iId'] = $_iId ;
			$oData['zTitre'] = $zTitre ;
			$oData['zTitre1'] = $zTitre1 ;
			$oData['zTitre2'] = $zTitre2 ;
			$oData['toDay'] = date("Y-m-d") ; 
			$oData['zBasePath'] = base_url() ;

			switch ($iTypeGcapId) {
				
				case DECISION :

					/*if ($_iId != FALSE){
						$oDecision = $this->Decision->get_decision ($_iId);
					}*/

					/*if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
					{
						$oData["decision_statutId"] = STATUT_RECEPTION_RESP_PERSONNEL ;
						
					}*/

					$oCandidatAssign = $this->Gcap->get_candidat($oUser['id']);
					$oData['oService'] = $this->Gcap->get_service($oCandidatAssign['service']);
					$zSoa = $this->Gcap->get_soa_by_service_id($oCandidatAssign['service']);

					$zChapitre = $oCandidatAssign['chapitre'];
					if ($zChapitre != "") {

						$un = sprintf("%'.02d\n", $zChapitre);
						$deux = substr($un, 0, 2); 
						$trois = substr($un, 2, 1); 
						$quatre = substr($un, 3, 3);
						$zChapitre =  "00-" . $deux . "-" . $trois . "-" . $quatre ;
					}

					$toListe = $this->Decision->get_all_decision_extrant($oUser,$oCandidat, $oUser['id'], $iCompteActif, $iNbrTotal, NB_PER_PAGE,1);
					$toAnneeSigner = array();

					foreach($toListe as $oListe){
						array_push($toAnneeSigner,$oListe['decision_annee']);
					}

					$iMois = sprintf("%'.02d\n", date("m")-2);
					$iAnnee = substr(date("Y"), 2, 2); 
					$iIndice = "";
					$toCandidatAffiche  = $this->setCandidatAffiche($oCandidat[0]->matricule, $iMois, $iAnnee) ;

					/*print_r ($toCandidatAffiche);
					die();*/
					$oData['iAnnePriseDecision'] = $this->getAnneePriseService($oCandidat) ; 
					$oData['oCandidat'] = $oCandidatAssign;
					$oData['toAnneeSigner'] = $toAnneeSigner;
					$oData['zSoa'] = $zSoa;
					$oData['toCandidatAffiche'] = $toCandidatAffiche;
					$oData['zChapitre'] = $zChapitre;
					$oData['sigle'] = $this->Gcap->get_sigle($this,$oUser['id']);
					$oData['sigleLong'] = $this->Gcap->get_sigle($this,$oUser['id'],0);
					$oData['toSigle'] = $this->Gcap->get_sigle($this,$oUser['id'],3);
					$this->Gcap->setImprimerDecisionPdf($oData, $this, $_iId);
					//$this->load_my_view_Common('gcap/imprimerDecision.tpl',$oData, $iModuleId);
					 
					break;
			
				default:

					if ($iCompteActif == COMPTE_AGENT && $_iId!='')
					{
						$iReturn = $this->Gcap->testAppartenance($oUser['id'], $_iId);
						if($iReturn == 0){
							die("Cet Absence ne vous appartient pas");
						}
					}

					$oGcap = array();

					if ($_iId != FALSE){
						$oGcap = $this->Gcap->get_Gcap ($_iId);
						$oGcap["motif_libelle"] = $this->Gcap->get_motif_libelle($oGcap["gcap_motif"]);
					}

					$oCandidat = $this->Gcap->get_candidat($oGcap['gcap_userSendId']);
					$oData['oCandidat'] = $oCandidat ; 

					$oService = $this->Gcap->get_service($oData['oCandidat']['service']);
					$oData['oService'] = $oService ; 


					if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
					{
						$oData["gcap_statutId"] = STATUT_RECEPTION_RESP_PERSONNEL ;
						/*if ($_iId != FALSE){
							$this->Gcap->update_gcap($oData, $_iId);
						} */
					}

					$zDateDebut = $oGcap['gcap_dateDebut'] ; 
					$zDateFin = $oGcap['gcap_dateFin'] ; 
					$iUserId = $oGcap['gcap_userSendId'] ; 
					$iType = $oGcap['gcap_typeId'];

					$iNombreConge = floor($this->human_time_diff ($oGcap["gcap_dateDebut"], $oGcap["gcap_dateFin"])) ; 

					$iTestDayDeb1 = date("D", strtotime($oGcap['gcap_dateDebut']));
					$iTestDayFin1 = date("D", strtotime($oGcap['gcap_dateFin']));

					/* Test jour férié*/
					$zDateHierFerie = date("Y-m-d", strtotime($oGcap['gcap_dateDebut'] ."-1 days"));
					$zDateDemainFerie = date("Y-m-d", strtotime($oGcap['gcap_dateFin'] ."+1 days"));

					/*if(in_array($iTypeGcapId, $toGcapWeekEnd)){*/

						$toPasseFerie = $this->Gcap->getJourFerie ($zDateHierFerie);

						if (sizeof($toPasseFerie)>0){
							foreach ($toPasseFerie as $oPasseFerie){
								switch($oPasseFerie['ferie_jour']) {
									case 'Mon':
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 3 ; 
											if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==2){
												$iNombreConge -= 3 ; 
											}
										}
									break;

									default:
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 1 ; 
											if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==2){
												$iNombreConge -= 1 ; 
											}
										}
										break;

								}
							}
						}

						$toDemainFerie = $this->Gcap->getJourFerie ($zDateDemainFerie);

						if (sizeof($toDemainFerie)>0){
							foreach ($toDemainFerie as $oDemainFerie){
								switch($oDemainFerie['ferie_jour']) {
									case 'Fri':
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 3 ; 
											if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1){
												$iNombreConge -= 3 ; 
											}
										}
									break;

									default:
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 1 ; 
											if($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1){
												$iNombreConge -= 1 ; 
											}
										}
										break;

								}
							}
						}

						$iTestDayFinFerie = date("D", strtotime($oGcap['gcap_dateFin']));

						if ($iTestDayFinFerie == 'Fri') {
							$zDateLundiFerie = date("Y-m-d", strtotime($oGcap['gcap_dateFin'] ."+3 days"));

							$toLundiFerie = $this->Gcap->getJourFerie ($zDateLundiFerie);

							if (sizeof($toLundiFerie)>0){
								foreach ($toLundiFerie as $oLundiFerie){
									switch($oLundiFerie['ferie_jour']) {
										case 'Mon':
											if (date("Y-m-d") <= '2018-09-24'){
												$iNombreConge += 1 ; 

												$iTestDayFin = date("D", strtotime($oGcap['gcap_dateFin']));

												if ($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1 &&  $iTestDayFin == 'Fri') {
													$iNombreConge -= 1 ; 
												}
											}
										break;
									}
								}
							}
						}

						/* Test fin jour férié*/

						if ($iTestDayDeb1 == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$iNombreConge += 2;
							}
						}

						if ($iTestDayFin1 == 'Fri') {
							$iNombreConge += 2;
						}

						if ($iTestDayFin1 == 'Sat') {
							$iNombreConge += 1;
						}

						if ($oGcap['gcap_demiJournee'] == 1) {
							$iNombreConge -= 0.5 ; 
						}

						if ($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
							if (date("Y-m-d") <= '2018-09-24'){
								$iNombreConge -= 2;
							}
						}

						if ($oGcap['gcap_demiJournee'] == 1 && $oGcap['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
							$iNombreConge -= 2;
						}
					/*}*/

					$toDataListeFraction = array();
					if(($iTypeGcapId == CONGE  && $_iId != FALSE) || ($iTypeGcapId == AUTORISATION_ABSENCE  && $_iId != FALSE)) {
						$toDataListeFraction = $this->Fraction->get_fractions_by_conge_id ($_iId, $oGcap['gcap_userSendId']);

						/*$iBoucle = 0;
						foreach ($toDataListeFraction as $oDataListeFraction){
							$toDataListeFraction[$iBoucle]['decision_numero'] = sprintf("%'.06d\n", $oDataListeFraction['decision_numero']);
							$iBoucle++;
						}*/
					}

					$oData['oGcap'] = $oGcap ; 
					
					$oData['iNombreConge'] = $iNombreConge ;
					$oData['toDataListeFraction'] = $toDataListeFraction ;
					$oData['iSizeDataListeFraction'] = sizeof($toDataListeFraction) ;
					$oData['iTypeGcapId']	= $iTypeGcapId ;
					$oData['zPieceJointe'] = $oGcap['gcap_pieceJointe'];
					$oData['sigle'] = $this->Gcap->get_sigle($this,$oGcap['gcap_userSendId']);
					$oData['sigleLong'] = $this->Gcap->get_sigle($this,$oGcap['gcap_userSendId'],0);
					$zLogo = $this->Gcap->get_logo($oGcap['gcap_userSendId']);
					$oData['getLogo'] = $zLogo ; 
					$oData['toSigle'] = $this->Gcap->get_sigle($this,$oGcap['gcap_userSendId'],3);
					$this->Gcap->setImprimerPdf($oData, $this);
					//$this->load_my_view_Common('gcap/imprimer.tpl',$oData, $iModuleId);
					break;
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }


	/** 
	* responsable personnel
	*
	* @param boolean $succes redirection TRUE / FALSE dans parametrage
	*
	* @return view
	*/
	public function respers($succes=false){
		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		if($iRet == 1){	

			if($succes)
    		$oData['msg'] = "Operation effectu&eacute;e avec succ&egrave;s";
			$oData['iModuleActif'] = -13 ; 
			$oData['oUser'] = $oUser;
			$oData['zHashUrl'] = "" ; 
			$oData['zHashModule'] = "" ;
			$oData['oCandidat'] = $oCandidat;
    		$this->load_my_view_Common('gcap/form_search.tpl',$oData,2);
		}
    }

	/** 
	* imprimer etat
	*
	*
	* @return view
	*/
	public function imprimer_etat(){
		
		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		if($iRet == 1){	
			$oData = array();
			$oData['sigle'] = $this->Gcap->get_sigle($this,$oUser['id']);
			$oData['sigleLong'] = $this->Gcap->get_sigle($this,$oUser['id']);
			$oData['toSigle'] = $this->Gcap->get_sigle($this,$oUser['id'],3);
			$oService = $this->Gcap->get_service($oCandidat[0]->service);
			$toListe = $this->Decision->getDecisonValide($oUser['id'], 1);

			$oData['oService'] = $oService ; 
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['toListe'] = $toListe;
			$this->Gcap->setImprimerEtat($oData, $this);
		}

	}

	/** 
	* get Image
	*
	*
	* @return view
	*/
	public function getImage($succes=false){
		global $oSmarty ; 

		$toCandidat = $this->candidat->makaSary();

		foreach ($toCandidat as $oCandidat){
			echo " Prénom : ".$oCandidat->prenom.", Matricule : ".$oCandidat->matricule." : <img src='http://rohi.mef.gov.mg:8088/ROHI/assets/upload/".$oCandidat->id.".".$oCandidat->type_photo."'> <br>\n";
		}
    }

	/** 
	* categorie cadre
	*
	* @param boolean $succes redirection TRUE / FALSE dans parametrage
	*
	* @return view
	*/
	public function updateCategorieCadre($succes=false){
		global $oSmarty ; 

		$this->Gcap->updateCategorieCadre();

    }
    
    /*public function search_matricule() {
    	$oData = array();
    	
		$iType = $_POST['type'];
		$iImOrCin = $_POST['im'];
		$oData['iModuleActif'] = -13 ; 
		$zCandidatSearch = $_POST['zCandidatSearch'];
		$iCompteActif = $this->getSessionCompte();

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026','389671','307381','357208','355564', '351101', 'STG_SGRH');

		$iAll = 1 ; 
		if (in_array($oUser['im'], $toUserAutorise)) {
			$iAll = 0 ; 
		}


		if ($iAll == 1) {
			if ($iCompteActif != COMPTE_AUTORITE)
			{
				die("reservé au compte autorité") ; 
			}
		}
		switch ($iType) {
			case 'im':
				$oCandidat = $this->candidat->get_candidat_by_matricule($iImOrCin, $zCandidatSearch, $iAll, $oCandidat);
				break;

			case 'cin':
				$oCandidat = $this->candidat->get_candidat_by_cin($iImOrCin, $zCandidatSearch,$iAll, $oCandidat) ;
				break;
		}
    		
	if(!empty($oCandidat)){
			$oCandidat = current($oCandidat);
    		$oData['candidat'] = $oCandidat;
    		$oUser = $this->user->get_user($oCandidat->user_id);

			$oDetache = $this->Gcap->getDetacheId($oCandidat->user_id);
    		$oData['user_edit'] = $oUser;
    		$departement = $this->departement->get_departement();
    		$oData['list_departement'] = $departement;
    		    		
			$oData['departement_edit'] = $oCandidat->departement;
    		$oData['direction_edit'] = $oCandidat->direction;
    		$oData['service_edit'] = $oCandidat->service;
    		$oData['reg_edit'] = $oCandidat->region_id;
			$oData['province_edit'] = $oCandidat->province_id;
			$oData['division_edit'] = $oCandidat->division;
			$oData['detache'] = $oCandidat->detache;
			$oData['oDetache'] = $oDetache;
			
			$oData['district_edit'] = $oCandidat->district_id;
			$oData['pays_edit'] = $oCandidat->pays_id;
						 
			if($oData['departement_edit'])
    		$oData['list_direction'] = $this->direction->get_by_departement($oData['departement_edit']);
			if($oData['direction_edit'])
			$oData['list_service'] = $this->service->get_by_direction($oData['direction_edit']);
			$oData['list_division'] = $this->division->get_division_by_service_id($oData['service_edit']);
			
			$oData['list_pays'] = $this->pays->get_pays();
			$oData['list_province'] = $this->province->get_province();
			$oData['list_region'] = $this->region->get_region();
			$oData['list_district'] = $this->district->get_district();
						
			$oData['phone'] = $oCandidat->phone;
			$oData['cin'] = $oCandidat->cin;
			$this->load_my_view('gcap/result_search',$oData);
		}
		else{
			$oData['msg'] = "Matricule incorrect";
			$this->load_my_view('gcap/form_search',$oData);
		}
    }*/
	
	/** 
	* recherche matricule
	*
	*
	* @return view
	*/
	public function search_matricule() {
		global $oSmarty;
    	$oData = array();
    	
		$iType = $_POST['type'];
		$iImOrCin = $_POST['im'];
		$oData['iModuleActif'] = -13 ; 
		$zCandidatSearch = $_POST['zCandidatSearch'];
		$iCompteActif = $this->getSessionCompte();

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$oData['oCandidat'] = $oCandidat;

		/*$toUserAutorise = array ('654321','123456','377036','323939','374986','355857','332026','389671','307381','357208','355564', '351101', 'STG_SGRH');*/
		$toUserAutorise = array ('654321','123456','377036','357018','323939','374986','355857','332026','3896722','307381','357208','355564', '351101', 'STG_SGRH','382791', '293785', '260942', '287385','355857','355577' );

		
		$toUserAutoriseId = array ('9312');

		$iAll = 1 ; 
		if (in_array($oUser['im'], $toUserAutorise)) {
			$iAll = 0 ; 
		}

		if (in_array($oUser['id'], $toUserAutoriseId)) {
			$iAll = 0 ; 
		}
	
		$zUserId = "";
		if ($iAll == 1) {
			if (($iCompteActif != COMPTE_AUTORITE) && ($iCompteActif != COMPTE_EVALUATEUR))
			{
				die("reservé au compte autorité ou au compte évaluateur") ; 

			} else {
				
				if ($iCompteActif == COMPTE_AUTORITE) {
					$iAll = 1;				
				}

				if ($iCompteActif == COMPTE_EVALUATEUR) {
					$iAll = 2;				
					$zUserId = $this->Gcap->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], COMPTE_EVALUATEUR,$zNotIn,1);
				}
			}
		}
		
    	switch ($iType) {
			case 'im':
				$oCandidat = $this->candidat->get_candidat_by_matricule($iImOrCin, $zCandidatSearch, $iAll, array(),$zUserId);
				break;

			case 'cin':
				$oCandidat = $this->candidat->get_candidat_by_cin($iImOrCin, $zCandidatSearch,$iAll, array(),$zUserId) ;
				break;
		}
    	if(!empty($oCandidat)){
			$oCandidat = current($oCandidat);
    		$oData['candidat'] = $oCandidat;

			$oDetache = $this->Gcap->getDetacheId($oCandidat->user_id);

    		$oUser = $this->user->get_user($oCandidat->user_id);
    		$oData['user_edit'] = $oUser;
    		$departement = $this->departement->get_departement();
    		$oData['list_departement'] = $departement;
    		    		
			$oData['departement_edit'] = $oCandidat->departement;

			/*************************************/
			$this->getDispatchLocalisation($oCandidat,$oData,$oSmarty);
			/*************************************/
			
    		$oData['reg_edit'] = $oCandidat->region_id;
			$oData['province_edit'] = $oCandidat->province_id;
			$oData['division_edit'] = $oCandidat->division;
			
			$oData['district_edit'] = $oCandidat->district_id;
			$oData['pays_edit'] = $oCandidat->pays_id;

			$oData['detache'] = $oCandidat->detache;
			$oData['oDetache'] = $oDetache;

			if($oData['departement_edit'])
    		$oData['list_direction'] = $this->direction->get_by_departement($oData['departement_edit']);
			
			$oData['list_division'] = $this->division->get_division_by_service_id($oData['service_edit']);
			
			$oData['list_pays'] = $this->pays->get_pays();
			$oData['list_province'] = $this->province->get_province();
			$oData['list_region'] = $this->region->get_region();
			$oData['list_district'] = $this->district->get_district();
						
			$oData['phone'] = $oCandidat->phone;
			$oData['cin'] = $oCandidat->cin;
			$oData['email'] = $oCandidat->email;
			//$this->load_my_view('gcap/result_search',$oData);
			$oData['oUser'] = $oUser;
			$oData['zHashUrl'] = "" ; 
			$oData['zHashModule'] = "" ;
			$oData['lacalite_service'] = $oCandidat->lacalite_service;
    		$this->load_my_view_Common('gcap/result_search.tpl',$oData,2);
		}
		else{
			$oData['msg'] = "Matricule incorrect ou pas dans le même service que ou vous n'êtes pas son évaluateur";
			$oData['oUser'] = $oUser;
			$oData['zHashUrl'] = "" ; 
			$oData['zHashModule'] = "" ;
			$oData['oCandidat'] = $oCandidat;
    		$this->load_my_view_Common('gcap/form_search.tpl',$oData,2);
		}
    }

	private function getDispatchLocalisation($_oCandidat,&$oData,$oSmarty) {

		$oCandidat = $_oCandidat; 
		$toService = $this->Gcap->get_Organisation($oCandidat->departement,"service", 1);

		$zSelectDepartement = "";
		if(sizeof($toService)>0){

			$iSelected = ($oCandidat->direction=='')?1:0;
			$toListe = $this->Gcap->get_Organisation($oCandidat->departement,"direction", 1);

			$tzDataDirection = explode("-",$oCandidat->direction);
			$zSelectDirectionS = "";
			if(sizeof($tzDataDirection)>0 && isset($tzDataDirection[1])){
				$iDirectionSelected = $tzDataDirection[1];

				$toService = $this->Gcap->get_Organisation($oCandidat->departement,"service", 1);
				$toDirection = $this->Gcap->get_Organisation($tzDataDirection[1],"direction", 2);
				$toListe1 = $this->Gcap->get_Organisation($tzDataDirection[1],"service", 2);

				$oSmartyDirection = $oSmarty;
				$oSmartyDirection->assign("toListe",$toListe1);
				$oSmartyDirection->assign("toDirection",$toDirection);
				$oSmartyDirection->assign("toService",$toService);
				$oSmartyDirection->assign("iDirectionSelected",$tzDataDirection[0]);
				$oSmartyDirection->assign("zBasePath",base_url());
				$zSelectDirectionS = $oSmartyDirection->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_direction2.tpl" );
			} else {
				$iDirectionSelected = $oCandidat->direction;
			}

			$oSmartyDepartement = $oSmarty;
			$oSmartyDepartement->assign("toService",$toService);
			$oSmartyDepartement->assign("toListe",$toListe);
			$oSmartyDepartement->assign("iSelected",$iSelected);
			$oSmartyDepartement->assign("iServiceSelected",$oCandidat->service);
			$oSmartyDepartement->assign("iDirectionSelected",$iDirectionSelected);
			$oSmartyDepartement->assign("zSelectDirectionS",$zSelectDirectionS);
			$oSmartyDepartement->assign("zBasePath",base_url());
			$zSelectDepartement = $oSmartyDepartement->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_option22.tpl" );
		}
		
		$tzDataDirection = explode("-",$oCandidat->direction);

		$iAfficheSelectTag = 0;
		$zSelectDirection = "";

		/* Pour la direction double */
		if(sizeof($tzDataDirection)>0 && isset($tzDataDirection[1])){
			
			$iAfficheSelectTag = 1;
			$oData['direction_edit'] = $tzDataDirection[1];
			$oData['list_service'] = $this->service->get_by_direction($tzDataDirection[0]);

			$toService = $this->Gcap->get_Organisation($oCandidat->departement,"service", 1);
			$toDirection = $this->Gcap->get_Organisation($tzDataDirection[1],"direction", 2);
			$toListe = $this->Gcap->get_Organisation($tzDataDirection[1],"service", 2);

			$oSmartyDirection = $oSmarty;
			$oSmartyDirection->assign("toListe",$toListe);
			$oSmartyDirection->assign("toDirection",$toDirection);
			$oSmartyDirection->assign("iActif",1);
			$oSmartyDirection->assign("toService",$toService);
			$oSmartyDirection->assign("iDirectionSelected",$tzDataDirection[0]);
			$oSmartyDirection->assign("zBasePath",base_url());
			$zSelectDirection = $oSmartyDirection->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_direction1.tpl" );

		} else {
			$oData['direction_edit'] = $oCandidat->direction;
			if(isset($oData['direction_edit']) && $oData['direction_edit']!=''){
				$oData['list_service'] = $this->service->get_by_direction($oData['direction_edit']);
			}
		}

		$tzDataService = explode("-",$oCandidat->service);
		
		$zSelectDirectionSwitch = "";

		if($oCandidat->direction != ""){
			$toDirectionSwitch = $this->Gcap->get_Organisation($oCandidat->direction,"direction", 2);
			if(sizeof($toDirectionSwitch)>0){
				
				$toListe2 = $this->Gcap->get_Organisation($oCandidat->direction,"service", 2);
				$oSmartySwitch = $oSmarty;
				$oSmartySwitch->assign("toListe",$toListe2);
				$oSmartySwitch->assign("iActif",0);
				$oSmartySwitch->assign("toDirection",$toDirectionSwitch);
				$oSmartySwitch->assign("iDirectionSelected",$oCandidat->direction);
				$oSmartySwitch->assign("zBasePath",base_url());
				$zSelectDirectionSwitch = $oSmartySwitch->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_direction3.tpl" );
			}
		}

		/* Pour la direction double */
		if(sizeof($tzDataService)>0 && isset($tzDataService[1])){
			$oData['service_edit'] = $tzDataService[1];
			$toSousService = $this->Gcap->get_Organisation($tzDataService[1],"service", 3);
			$oSmartyService = $oSmarty;
			$oSmartyService->assign("toSousService",$toSousService);
			$oSmartyService->assign("toDirection",$toDirection);
			$oSmartyService->assign("iServiceSelected",$tzDataService[0]);
			$oSmartyService->assign("zBasePath",base_url());
			$zSelectService = $oSmartyService->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_service2.tpl" );

		} else {
			$oData['service_edit'] = $oCandidat->service;
		}
		
		$oData['zSelectDepartement'] = $zSelectDepartement;
		$oData['zSelectDirection'] = $zSelectDirection;
		$oData['zSelectService'] = $zSelectService;
		$oData['zSelectDirectionSwitch'] = $zSelectDirectionSwitch;
	}
 
	/*function valide_respers(){
    	$oData = array();

    	$oUser_id = $_POST['user_id'];
    	$dep= $_POST['departement'];
    	$dir = $_POST['direction'];
    	$serv = $_POST['service'];
    	$reg = $_POST['region'];
		$div = $_POST['division'];

		$iMiseDisposition = isset($_POST['iMiseDisposition'])?$_POST['iMiseDisposition']:0;
		$iInstitutionId = $_POST['iInstitutionId'];
		$zLocalite = $_POST['zLocalite'];

		$this->Gcap->delete_detache($oUser_id);
		if ($iMiseDisposition==1){
			$oData = array();
			$oData['detache_userId'] = $oUser_id ; 
			$oData['detache_institutionId'] = $iInstitutionId ; 
			$oData['detache_localite'] = $zLocalite ;
			$this->Gcap->insertDetache($oData);
		}
		
		$province = $_POST['province'];
		$district = $_POST['district'];
		$pays = $_POST['pays'];

    	if($oUser_id!=null){
    		$oUser = $this->user->get_user($oUser_id);
    		$oCandidat = current($this->candidat->get_by_user_id($oUser_id));
    		$oData = array();
			$oData['dep'] = null;
			$oData['dir'] = null ;
			$oData['serv'] = null;
			$oData['reg'] = null;
			$oData['distr'] = null;
			
			$oCandidat->detache = $iMiseDisposition;
			$oCandidat->region_id = $reg;
			$oCandidat->province_id = $province;
			$oCandidat->district_id = $district;
			$oCandidat->pays_id = $pays;
			
    		if($dep!='0' && $dep!='9999'){
    			$oData['dep'] = $dep*1;
    			$oCandidat->departement = $dep*1;
    			$oCandidat->direction = null;
    			$oCandidat->service = null;
    			$oCandidat->division = null;
				
    			if($dir!='0' && $dir!='9999'){
    				$oData['dir'] = $dir*1 ;
					$oCandidat->direction = $dir*1;
    				if($serv!='0' && $serv!='9999'){
    					$oData['serv'] = $serv*1;
						$oCandidat->service = $serv*1;

						if($div!='0' && $div!='9999'){
							$oData['div'] = $div*1;
							$oCandidat->division = $div*1;
						}
    				}
    			}

				if (isset($_POST['phone']) && ($_POST['phone'] != "")) {
					$phone 	= $_POST['phone'];
					$oCandidat->phone = $phone ;
				}

				if (isset($_POST['cin']) && ($_POST['cin'] != "")) {
					$cin 	= $_POST['cin'];
					$oCandidat->cin = $cin ;
				}

				$oData['reg'] = $reg*1 ;
    			$this->candidat->update($oCandidat,$oCandidat->id);
				
				$oUser = $this->user->get_user($oUser_id);
				$oCandidat = current($this->candidat->get_by_user_id($oUser_id));
    		}
    	}
    	
    	redirect('gcap/respers/succes');
		
    }*/
	
	/** 
	* valide responsable personnel
	*
	*
	* @return view
	*/
	function valide_respers(){
    	$oData = array();
    	$oUser_id = $_POST['user_id'];
    	$dep= $_POST['departement'];
    	$dir = $_POST['direction'];
    	$serv = $_POST['service'];
    	$reg = $_POST['region'];
		$div = $_POST['division'];
		$email = $_POST['email'];
		
		$province = $_POST['province'];
		$district = $_POST['district'];
		$pays = $_POST['pays'];
		
		
    	if($oUser_id!=null){
    		$oUser = $this->user->get_user($oUser_id);
    		$oCandidat = current($this->candidat->get_by_user_id($oUser_id));
    		$oData = array();
			$oData['dep'] = null;
			$oData['dir'] = null ;
			$oData['serv'] = null;
			$oData['reg'] = null;
			$oData['distr'] = null;

			$iMiseDisposition = isset($_POST['iMiseDisposition'])?$_POST['iMiseDisposition']:0;
			$iInstitutionId = $_POST['iInstitutionId'];
			$iDepartementMADId = $_POST['iDepartementMADId'];
			$iDirectionMADId = $_POST['iDirectionMADId'];
			$iServiceMADId = $_POST['iServiceMADId'];
			$zLocalite = $_POST['zLocalite'];

			$this->Gcap->delete_detache($oUser_id);
			if ($iMiseDisposition==1){
				$oData = array();
				$oData['detache_userId'] = $oUser_id ; 
				$oData['detache_institutionId'] = $iInstitutionId ; 
				$oData['detache_departement'] = $iDepartementMADId ;
				$oData['detache_direction'] = $iDirectionMADId ;
				$oData['detache_service'] = $iServiceMADId ;
				$oData['detache_localite'] = $zLocalite ;
				$this->Gcap->insertDetache($oData);
			}

			$oCandidat->detache = $iMiseDisposition;
			$oCandidat->region_id = $reg;		
			$oCandidat->region_id = $reg;
			$oCandidat->province_id = $province;
			$oCandidat->district_id = $district;
			$oCandidat->pays_id = $pays;
    		if($dep!='0' && $dep!='9999'){

				$iDepartementId	= $this->postGetValue ("departement",0) ;
				$iLocalite		= $this->postGetValue ("iLocalite",0) ;
				$zLocalite		= $this->postGetValue ("zLocaliteNiveau","") ;

				$oCandidat->departement = $iDepartementId;
    			$oCandidat->direction = null;
    			$oCandidat->service = null;
    			$oCandidat->division = null;

				/*echo "<pre>";
				print_r ($_POST);
				echo "</pre>";*/

				if($iLocalite != 0){
					switch($zLocalite){

						case '1':
							$oCandidat->departement = $iLocalite;
							break;

						case '2':
							$oCandidat->direction = $iLocalite;

							$oDirection = $this->departement->getDepartementByDirection($iLocalite);

							if(sizeof($oDirection)>0 && $oDirection['departement_id']!=''){
								$oCandidat->departement = $oDirection['departement_id'];
							} else {
								$oSousDirection = $this->departement->getDepartementByDirection($oDirection['direction_id']);

								if(sizeof($oSousDirection)>0 && $oSousDirection['departement_id']!=''){
									$oCandidat->departement = $oSousDirection['departement_id'];
									$oCandidat->direction = $iLocalite . "-" . $oDirection['direction_id'];
								}
							}
							break;

						case '3':
							$oCandidat->service = $iLocalite;

							$oService = $this->direction->getDirectionByService($iLocalite);
							
							if(sizeof($oService)>0 && $oService['departement_id']!=''){

								$oCandidat->departement = $oService['departement_id'];
								$oCandidat->direction = null;

							} elseif (sizeof($oService)>0 && $oService['direction_id']!='')  {
								
								
								$oDirection = $this->departement->getDepartementByDirection($oService['direction_id']);
								$oCandidat->direction = $oService['direction_id'];

								if(sizeof($oDirection)>0 && $oDirection['departement_id']!=''){
									$oCandidat->departement = $oDirection['departement_id'];
								}else {
									$oSousDirection = $this->departement->getDepartementByDirection($oDirection['direction_id']);
									if(sizeof($oSousDirection)>0){
										if($oSousDirection['departement_id']!=''){
											$oCandidat->departement = $oSousDirection['departement_id'];
										}
										$oCandidat->direction = $oService['direction_id'] . "-" . $oDirection['direction_id'];
									}
								}	
							} elseif (sizeof($oService)>0 && $oService['service_id']!='')  {

								echo "miditra1";
								$oSousService = $this->service->get_service($oService['service_id']);

								$oCandidat->service = $iLocalite . "-" . $oService['service_id'];
								
								if(sizeof($oSousService)>0 && $oSousService['direction_id']!=''){
									$oCandidat->direction = $oSousService['direction_id'];
									$oDirection = $this->departement->getDepartementByDirection($oSousService['direction_id']);

									if(sizeof($oDirection)>0 && $oDirection['departement_id']!=''){
										$oCandidat->departement = $oDirection['departement_id'];
									} else {
										$oSousDirection = $this->departement->getDepartementByDirection($oDirection['direction_id']);

										if(sizeof($oSousDirection)>0 && $oSousDirection['departement_id']!=''){
											$oCandidat->departement = $oSousDirection['departement_id'];
											$oCandidat->direction = $iLocalite . "-" . $oDirection['direction_id'];
										}
									}
								}
							}

							break;
					}

				}



    			/*$oData['dep'] = $dep*1;
    			$oCandidat->departement = $dep*1;
    			$oCandidat->direction = null;
    			$oCandidat->service = null;
    			$oCandidat->division = null;
				
    			if($dir!='0' && $dir!='9999'){
    				$oData['dir'] = $dir*1 ;
					$oCandidat->direction = $dir*1;
    				if($serv!='0' && $serv!='9999'){
    					$oData['serv'] = $serv*1;
						$oCandidat->service = $serv*1;

						if($div!='0' && $div!='9999'){
							$oData['div'] = $div*1;
							$oCandidat->division = $div*1;
						}
    				}
    			}*/




				if (isset($_POST['phone']) && ($_POST['phone'] != "")) {
					$phone 	= $_POST['phone'];
					$oCandidat->phone = $phone ;
				}

				if (isset($_POST['cin']) && ($_POST['cin'] != "")) {
					$cin 	= $_POST['cin'];
					$oCandidat->cin = $cin ;
				}

				if (isset($_POST['email']) && ($_POST['email'] != "")) {
					$email 	= $_POST['email'];
					$oCandidat->email = $email ;
				}

				if (isset($_POST['lacalite_service']) && ($_POST['lacalite_service'] != "")) {
					$lacalite_service 	= $_POST['lacalite_service'];
					$oCandidat->lacalite_service = $lacalite_service ;
				}

				/*echo "<pre>";
				print_r ($oCandidat);
				echo "</pre>";
				die();*/

				$oData['reg'] = $reg*1 ;
    			$this->candidat->update($oCandidat,$oCandidat->id);
				
				$oUser = $this->user->get_user($oUser_id);
				$oCandidat = current($this->candidat->get_by_user_id($oUser_id));
    		}
    	}
    	
    	redirect('gcap/respers/succes');
		
    }

	/** 
	* Diagramme de gantt 
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCurrPage page courante
	* @param integer $_iUserId identifiant user
	*
	* @return view
	*/
	public function planningGantt($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCurrPage=1, $_iUserId=0){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		if ($_iUserId > 0) {
			$oUser = $this->user->get_user($_iUserId);
    		$oCandidat =$this->candidat->get_by_user_id($oUser['id']);
		}

		$iCurrPage = $_iCurrPage ; 

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

	    	
			$oData['menu'] = 3;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			$iCompteActif	= $this->getSessionCompte();

			$iMatricule	= $this->postGetValue ("iMatricule",'') ;
			$iCin	= $this->postGetValue ("iCin",'') ;


			$oData['iMatricule'] = $iMatricule ;
			$oData['iCin'] = $iCin ;

			switch ($iModuleId)
			{

				case GESTION_ABSCENCE : 
					if ($iCompteActif > COMPTE_AGENT)
					{
						
						$oData['zHashUrl'] = $_zHashUrl ; 
						$oData['zHashModule'] = $_zHashModule ;
						$oData['zTitle'] = ucfirst(strtolower("journal et planning")) ;
						$oData['zMessageAucun'] = "Aucun r&eacute;sultat correspondant &agrave; votre recherche" ;
						
						switch ($_zHashUrl) {

							case 'planning':
								$oData['menu'] = 60;
								/*if(isset($_POST['iAnnee'])){									
									$oData['oDataSearch']['year'] = $_POST['iAnnee'];
									$oData['oDataSearch']['month'] = $_POST['iMois'];
								}
								else{
									$oData['oDataSearch']['month'] = date('m');
									$oData['oDataSearch']['year'] =  date('Y');
								}

								$zLastMonth = date("m")-2;
								$zLastMonth = sprintf("%'.02d\n", $zLastMonth);
								$zFinMonth = date("m")+1;
								$zFinMonth = sprintf("%'.02d\n", $zFinMonth);
								$zDateMonth = "01/". trim($zLastMonth) ."/".date("Y");
								$zDateDebut = $this->postGetValue ("zDateDebut",$zDateMonth); 
								$zDateFin = $this->postGetValue ("zDateFin",intval(date("t","12"))."/".trim($zFinMonth)."/".date("Y"));
								$oData['zDateDebut'] = $zDateDebut ; 
								$oData['zDateFin'] = $zDateFin ;		
								$oData['oDataSearch']['zDateDebut'] = $this->date_fr_to_en($zDateDebut,'/','-'); 
								$oData['oDataSearch']['zDateFin'] = $this->date_fr_to_en($zDateFin,'/','-');*/

								$zDateMonth = date("d/m/Y", mktime(0,0,0,date("m")-2, 1, date("Y")));
								$zFinMonth = date("d/m/Y", mktime(0,0,0,date("m")+1, date("t","12"), date("Y")));


								$zDateDebut = $this->postGetValue ("zDateDebut",$zDateMonth); 
								$zDateFin = $this->postGetValue ("zDateFin",$zFinMonth);

								$oData['zDateDebut'] = $zDateDebut ; 
								$oData['zDateFin'] = $zDateFin ;

								$zHash = "";
								if($_zHashUrl == 'demandes'){
									$zHash = "add";	
								}
								$oData['zHash'] = $zHash ;			
								$oData['oDataSearch']['zDateDebut'] = $this->date_fr_to_en($zDateDebut,'/','-'); 
								$oData['oDataSearch']['zDateFin'] = $this->date_fr_to_en($zDateFin,'/','-'); 

								$oList = $this->Gcap->get_all_gantt_planning($oUser, $oData['oDataSearch'], $oCandidat, $oUser['id'],0, $iCompteActif,$iNbrTotal,1000, $iCurrPage);

								$zPagination    = $this->getPagination ($iCurrPage, $iNbrTotal, NB_PER_PAGE) ;
								$oData['zPagination'] = $zPagination ;
								
								$tableJson = [];
								$cpt = 1;
								foreach($oList as $oRow){
									
									$oRowJson = new stdClass();
									$oRowJson->name = $oRow['nom'] . ' '. $oRow['prenom'];
									$oRowJson->desc = "";
									$oValues = [];

									$toGcap = explode(";",$oRow['GcapDate']);
									foreach ($toGcap as $zGcap){

										$toDate = explode("/",$zGcap);

										if (sizeof($toDate)>0){
										
											if (isset($toDate[0]) && isset($toDate[1])){

												$zDateDebut = strtotime($toDate[0]);
												$zDateFin = strtotime($toDate[1]);

												$zDesc = "";
												$zDemiJournee = "";
												if ($toDate[3] == 1){
													switch ($toDate[4]){

														case '1':
															$zDateDebut = strtotime($toDate[0]);
															$zDateFin = strtotime($toDate[1] . "12:00:00");
															$zDemiJournee = utf8_decode("Se termine le " . $this->date_en_to_fr($toDate[1],"-","/"). " matin") ;
															break;

														case '2':
															$zDemiJournee = utf8_decode("Commence le " . $this->date_en_to_fr($toDate[0],"-","/"). " apr&egrave;s-midi");
															break;
													}
												}

												$oValue = new stdClass();
												$oValue->id = $cpt;
												$oValue->from = "/Date(".$zDateDebut."000)/";
												$oValue->to = "/Date(".$zDateFin."000)/";
												$oValue->customClass = "";

												$zTitle = "";
												switch ($toDate[2]) {
													case 2:
														$oValue->customClass = "conge";
														$zTitle = utf8_decode("Cong&eacute;") ;
														break;

													case 3:
														$oValue->customClass = "abscence";
														$zTitle = utf8_decode("Autorisation d'absence") ;
														break;

													case 4:
														$oValue->customClass = "permision";
														$zTitle = utf8_decode("Permission") ;
														break;

													case 5:
														$oValue->customClass = "repos";
														$zTitle = utf8_decode("Repos medical") ;
														break;

													
													case 6:
														$oValue->customClass = "Mission";
														$zTitle = utf8_decode("Mission") ;
														break;

													case 7:
														$oValue->customClass = "Formation";
														$zTitle = utf8_decode("Formation") ;
														break;
												 }	

												$zDesc  = "<b>".$zTitle."</b><br><br>Du : ".$this->date_en_to_fr($toDate[0],"-","/")." au " . $this->date_en_to_fr($toDate[1],"-","/") ;
												$zDesc .= "<br><br>" . $zDemiJournee;

												$oValue->desc = $zDesc;

												
												
												array_push($oValues,$oValue);
											}
										}
									}

									$oRowJson->values = $oValues;
									array_push($tableJson,$oRowJson);
									$cpt++;
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

								
								$oData['jsonData'] = json_encode($tableJson);
								$oData['toMonth'] = $toMonth;
								$oData['zAnneeBoucle'] = date("Y");
								$oData['iLastBoucle'] = date("Y")-2016;
								$oData['sizeTab'] = sizeof($oList);
								$this->load_my_view_Common('gcap/planningGantt.tpl',$oData, 2);
								break;
						}
					}
					break;
			}
					
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Code corps
	*
	* @return view
	*/
	private function codeCorps(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/corps.xls';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(0); 
		$iLongeurExcel = $oSheet->getHighestRow(); 
		$iLongeurColonne = $oSheet->getHighestColumn();

		for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
			
			$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
											NULL,
											TRUE,
											FALSE);
			if ($iBoucle > 1) {
					$toBoucleData1 = $toBoucleData[0];
					$oInsert = array();
					$oInsert['codeCorps_code'] = $toBoucleData1[0];
					$oInsert['codeCorps_libelle'] = $toBoucleData1[1];
					$oInsert['codeCorps_categorie'] = $toBoucleData1[2];
					$oInsert['codeCorps_fonctionnaire'] = $toBoucleData1[3];
					$oInsert['codeCorps_conc'] = $toBoucleData1[4];
					/*echo "<pre>";
					print_r ($oInsert);
					echo "</pre>";
					die();*/
					$this->Gcap->insertCodeCorps($oInsert);
			}
		}

		echo "1";
	}

	/** 
	* Evaluation note et cadre
	*
	* @return view
	*/
	public function evaluationNoteEtCadre(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/BASE_EVALUATION_TRAITER.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(0); 
		$iLongeurExcel = $oSheet->getHighestRow(); 
		$iLongeurColonne = $oSheet->getHighestColumn();

		for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
			
			$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
											NULL,
											TRUE,
											FALSE);
			if ($iBoucle > 1) {
					$toBoucleData1 = $toBoucleData[0];
					$oInsert = array();
					$oInsert['Evaluateur'] = $toBoucleData1[0];
					$oInsert['IM'] = $toBoucleData1[1];
					$oInsert['NOM'] = $toBoucleData1[2];
					$oInsert['TEL'] = $toBoucleData1[3];
					$oInsert['MAIL'] = $toBoucleData1[4];

					$oInsert['SANCTION'] = $toBoucleData1[5];
					$oInsert['Evalue'] = $toBoucleData1[6];
					$oInsert['matricule'] = $toBoucleData1[7];
					$oInsert['nomEvalue'] = $toBoucleData1[8];
					$oInsert['tel_evalue'] = $toBoucleData1[9];

					$oInsert['mail_evalue'] = $toBoucleData1[10];
					$oInsert['sanction_evalue'] = $toBoucleData1[11];
					$oInsert['dept'] = $toBoucleData1[12];
					$oInsert['region'] = $toBoucleData1[13];
					$oInsert['4T-2016-2017'] = str_replace(".",",",$toBoucleData1[14]);

					$oInsert['1T-2017'] = str_replace(".",",",$toBoucleData1[15]);
					$oInsert['2T-2017'] = str_replace(".",",",$toBoucleData1[16]);
					$oInsert['3T-2017'] = str_replace(".",",",$toBoucleData1[17]);
					$oInsert['1T-2018'] = str_replace(".",",",$toBoucleData1[18]);
					$oInsert['2T-2018'] = str_replace(".",",",$toBoucleData1[19]);

					/*echo "<pre>";
					print_r ($oInsert);
					echo "</pre>";
					die();*/
					$this->Gcap->insertevaluationNoteEtCadre($oInsert);
			}
		}

		echo "1";
	}

	/** 
	* Sans photo
	*
	* @return view
	*/
	public function sansPhotoTojo(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/SANS_PHOTO.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(0); 
		$iLongeurExcel = $oSheet->getHighestRow(); 
		$iLongeurColonne = $oSheet->getHighestColumn();

		for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
			
			$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
											NULL,
											TRUE,
											FALSE);
			if ($iBoucle > 1) {
					$toBoucleData1 = $toBoucleData[0];
					$oInsert = array();

					if($toBoucleData1[0] != 'ECD' && $toBoucleData1[4] != "") {
						$oInsert['sans_matricule'] = $toBoucleData1[0];
						$oInsert['sans_nom'] = $toBoucleData1[1];
						$oInsert['sans_prenom'] = $toBoucleData1[2];
						$oInsert['sans_phone'] = $toBoucleData1[3];
						$oInsert['sans_email'] = $toBoucleData1[4];
						$this->Gcap->insertSansPhoto($oInsert);
					}
					
			}
		}

		echo "1";
	}


	/** 
	* Sans photo
	*
	* @return view
	*/
	public function photoJeremie(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/photo.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(0); 
		$iLongeurExcel = $oSheet->getHighestRow(); 
		$iLongeurColonne = $oSheet->getHighestColumn();

		for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
			
			$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
											NULL,
											TRUE,
											FALSE);
			if ($iBoucle > 1) {
					$toBoucleData1 = $toBoucleData[0];
					$oInsert = array();

					//echo $toBoucleData1[0] ;
					$oAgent = $this->Gcap->getAllMatricule($toBoucleData1[0]);
					if(sizeof($oAgent)>0){
						if ($oAgent['type_photo'] != ''){
							$zName = $oAgent['id'] . "." . $oAgent['type_photo'] ;
							$zImage = PATH_ROOT_DIR . '/assets/upload/' . $zName;
							if (file_exists($zImage)){
								
								$zImage1 = base_url()."assets/upload/" . $zName ; 
								echo "<img src='".$zImage1."' width='100' />" . "<br>"  ;
								
								$zFileName = $toBoucleData1[0] . "." . $oAgent['type_photo'];
								echo $zFileName . "<br>";
								@copy($zImage, PATH_ROOT_DIR . '/JEREMIE/'.$zFileName);
							}

						} 
					}

			}
		}

		echo "1";
	}
}