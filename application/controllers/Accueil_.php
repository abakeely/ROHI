<?php
/**
* @package ROHI
* @subpackage Accueil
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Accueil extends MY_Controller {

	/**  
	* Classe qui concerne l'accueil
	* @package  ROHI  
	* @subpackage ACCUEIL */ 
 
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
		$this->load->model('accueil_gcap_model','Accueil');
		$this->load->model('localite_gcap_model','Localite');
		$this->load->model('agenda_avenant_model','Agenda');
		$this->load->model('reclassement_sgrh_model','Reclassement');
		$this->load->model('departement_model','Departement');
		$this->load->model('Candidat_diplome_model','CandidatDiplome');
		$this->load->model('GestionStructure_model','GestionStructure');
		$this->sessionStartCompte();
	}

	
	/** 
	* Listing des communiqués et revues de presse
	* Accessible pour tous agents ayant un compte communication
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iCurrPage pagination
	* @return view
	*/
	public function liste($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		$oUser					= array();
		$oCandidat				= array();
		$iRet					= $this->check($oUser, $oCandidat);
		$iCurrPage				= $_iCurrPage ;
		$iCompteActif			= $this->getSessionCompte();
		$oData['oUser']			= $oUser;
		$oData['oCandidat']		= $oCandidat;
		$oData['zHashModule']	= $_zHashModule;
		$oData['zHashUrl']		= $_zHashUrl;
		$oData['menu']			= 39;
		
    	
		if ($iCompteActif == COMPTE_COMMUNICATION) {
			if($iRet == 1){	
				switch ($_zHashModule){

					case 'communique' : 
						$iTypeId = 1 ;
						$toListe = $this->Accueil->getAllAccueil(1);
						$iModuleId = -4;
						break;

					case 'revue-de-presse':
						$iTypeId = 2 ; 
						$toListe = $this->Accueil->getAllAccueil(2);
						$iModuleId = -5;
							
						break;
				}

				$oData['toListe'] = $toListe ; 
				$oData['iTypeId'] = $iTypeId;
				$this->load_my_view_Common('accueil/listeCommunique.tpl',$oData, $iModuleId);
			} else {
				die();
			}
		} else {
			switch ($_zHashModule){

					case 'communique' : 
						redirect("accueil/communique");
						break;

					case 'revue-de-presse':
						redirect("accueil/revueDePresse");
						break;
				}
			
		}
	}


	/** 
	* Listing des fiches de poste
	* Accessible pour tous agents ayant un compte communication
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iCurrPage pagination
	* @return view
	*/
	public function listeFicheDePoste($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCurrPage=1){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashModule'] = $_zHashModule;
		$oData['zHashUrl'] = $_zHashUrl;
		$oData['menu'] = 39;
		
		$toListe = $this->Accueil->getAllFicheDePoste();
				
		$oData['toListe'] = $toListe;
		$this->load_my_view_Common('accueil/listeFichePoste.tpl',$oData, $iModuleId);
			
	}


	/** 
	* Gestion division : listing
	* Accessible pour le compte responsable personnel
	*
	* @param int $_zHashUrl Hashage de la page  
	* @return view
	*/
	public function division($_zHashUrl = FALSE){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();

		$toListe = $this->Accueil->getListeDivision($oCandidat);

		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashModule'] = "accueil";
		$oData['zHashUrl'] = $_zHashUrl;
		$oData['toListe'] = $toListe;
		$oData['menu'] = 751;

		$iModuleId = 1;

		if ($iCompteActif != COMPTE_RESPONSABLE_PERSONNEL){
			die("page reservée au compte responsable personnel");
		}
		
		

		$this->load_my_view_Common('accueil/division-liste.tpl',$oData, $iModuleId);
			
	}

	/** 
	* Edition Division
	* Accessible pour les responsables personnel
	*
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iId Identification du revue / communiqué
	* @return view
	*/
	public function editDivision($_zHashUrl = FALSE, $_iId = 0){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();

		if ($iCompteActif != COMPTE_RESPONSABLE_PERSONNEL){
			die("page reservée au compte responsable personnel");
		}

		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 751;

		$iModuleId = 1;
    	
		if($iRet == 1){	
			
			$toDivision = $this->Accueil->preRemplissageFicheDePoste($_iId);
			
			$oData['toDivision'] = $toDivision;
			$oData['iId'] = $_iId;
			
			$this->load_my_view_Common('accueil/divisionEdit.tpl',$oData, $iModuleId);	
		} else {
			die();
		}
		
	}

	/** 
	*
	* recherche fiche de poste
	*
	* @return Json
	*/
	public function setFicheDePosteSearch(){

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


		$toListe = $this->Accueil->getAllFicheDePoste($zTerm);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe['fichePoste_id'];
            $toTemp["text"] = $oListe['fichePoste_intitule'] ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* page d'accueil de l'application
	*
	* @return view
	*/
	public function index(){
		$this->session->sess_destroy();
		$oStatut = $this->statut->get_statut();
		$oData = $this->get_all_corps_indice_grade();
		$oData['list_statut'] = $oStatut;
		$oData['zTitle'] = ucfirst(strtolower("Authentification")) ;
		$oData['zLibelle'] = ucfirst(strtolower("Authentification")) ;
		$iModuleId=0;

		$toGetHomeArticle = $this->Accueil->getHomeArticle();
		$oData['toGetHomeArticle'] = $toGetHomeArticle;
		$oData['date'] = date("YmdHis");

		$this->load_my_view_Login('common/login/login.tpl',$oData);
	}

	
	/** 
	* permettant de retourner le template photo d'un agent connecté
	*  
	* @param int $_iUserId Identifiant de l'utilisateur
	* @return template accueil
	*/
	public function getTemplatePhoto1($_iUserId) {
		global $oSmarty ; 
		
		$oSmarty->assign('zBasePath', base_url());
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "accueil/getTemplateAccueil.tpl" );
		echo $zInfoUser ; 
		
	}

	/** 
	* page d'accueil par défaut, page d'authentification de ROHI
	* accessible à tous internautes
	*
	* @return view
	*/
	public function login(){

		$this->session->sess_destroy();
		$oStatut = $this->statut->get_statut();
		$oData = $this->get_all_corps_indice_grade();
		$oData['list_statut'] = $oStatut;
		$oData['zTitle'] = ucfirst(strtolower("Authentification")) ;
		$oData['zLibelle'] = ucfirst(strtolower("Authentification")) ;
		$iModuleId=0;

		$toGetHomeArticle = $this->Accueil->getHomeArticle();
		$oData['toGetHomeArticle'] = $toGetHomeArticle;
		$oData['date'] = date("YmdHis");

		$this->load_my_view_Login('common/login/login.tpl',$oData);
	}

	/** 
	* Edition des communiqués et revues de presse
	* Accessible pour tous agents ayant un compte communication
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iId Identification du revue / communiqué
	* @return view
	*/
	public function edit($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = 0){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		
		$iModuleId = -4;
    	
		if ($iCompteActif == COMPTE_COMMUNICATION) {
			if($iRet == 1){	
				switch ($_zHashModule){

					case 'communique' : 
						$iTypeId = 1 ; 
						$iModuleId = -4;
						break;

					case 'revue-de-presse':
						$iTypeId = 2 ; 
						$iModuleId = -5;
						break;
				}

				$toCategorieRc = $this->Accueil->getCategorieRc($iTypeId);
				$toOrganePresse = $this->Accueil->getOrganePresse();
				$toRevueCommunique = $this->Accueil->preRemplissage($_iId);
				
				$oData['iTypeId']		= $iTypeId;
				$oData['toCategorieRc'] = $toCategorieRc;
				$oData['toOrganePresse'] = $toOrganePresse;
				$oData['zHashModule'] = $_zHashModule;
				$oData['zHashUrl'] = $_zHashUrl;
				$oData['toRevueCommunique'] = $toRevueCommunique;
				$oData['iId'] = $_iId;
				$this->load_my_view_Common('accueil/fiche.tpl',$oData, $iModuleId);	
			} else {
				die();
			}
		} else {
			switch ($_zHashModule){

					case 'communique' : 
						redirect("accueil/communique");
						break;

					case 'revue-de-presse':
						redirect("accueil/revueDePresse");
						break;
				}
			
		}
	}

	/** 
	* Edition fiche de poste
	* Accessible pour tous agents ayant un compte communication
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iId Identification du revue / communiqué
	* @return view
	*/
	public function editFiche($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = 0){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		
		$iModuleId = -4;
    	
		if($iRet == 1){	
			
			$toFicheDePoste = $this->Accueil->preRemplissageFicheDePoste($_iId);
			$zMission = $this->setFckEditor('fichePoste_mission', $toFicheDePoste['fichePoste_mission'],100);
			$zAcvtivitePrincipale = $this->setFckEditor('fichePoste_activitePrinc', $toFicheDePoste['fichePoste_activitePrinc'],150);
			$zActiviteEncadrement = $this->setFckEditor('fichePoste_activiteEncad', $toFicheDePoste['fichePoste_activiteEncad'],150);
			$zExigenceNiveau = $this->setFckEditor('fichePoste_exigenceNiveau', $toFicheDePoste['fichePoste_exigenceNiveau'],150);
			$zExigenceDiplome = $this->setFckEditor('fichePoste_exigenceDiplome', $toFicheDePoste['fichePoste_exigenceDiplome'],150);

			$oData['toFicheDePoste'] = $toFicheDePoste;
			$oData['iId'] = $_iId;
			$oData['zMission'] = $zMission;
			$oData['zAcvtivitePrincipale'] = $zAcvtivitePrincipale;
			$oData['zActiviteEncadrement'] = $zActiviteEncadrement;
			$oData['zExigenceNiveau'] = $zExigenceNiveau;
			$oData['zExigenceDiplome'] = $zExigenceDiplome;
			
			$this->load_my_view_Common('accueil/ficheDePosteEdit.tpl',$oData, $iModuleId);	
		} else {
			die();
		}
		
	}
	
	/** 
	* Import fichier excel
	*
	* @return view
	*/
	public function import_excel(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		

			$iModuleId = 1;
		
			$toArrayAffiche = array();
			if($iRet == 1){	

				$oData = array();
				
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;
				$oData['menu'] = 58;

				if (isset($_FILES['fichierExcel']) && trim($_FILES['fichierExcel']['name']) != "") {

					require(APPLICATION_PATH ."/Classes/PHPExcel.php");

					error_reporting(0);
					ini_set('display_errors', TRUE);
					ini_set('display_startup_errors', TRUE);
					date_default_timezone_set('Europe/London');

					define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
					
					$oPhpExcel = new PHPExcel();

					$zFichier = $_FILES['fichierExcel']['tmp_name'];

					$toExtension = explode(".",$_FILES['fichierExcel']['name']);

					if($toExtension[1]!="xlsx" && $toExtension[1]!="xls"){

						die("Veuiller entrer un fichier Excel");

					} else {

						//$zFileInput = $zFichier ; 
			
						$zFileName = utf8_decode($_FILES["fichierExcel"]["name"]);
						$zFileName = str_replace(" ","_",$zFileName);
						$zFileName = strtr($zFileName, 
						'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

						@move_uploaded_file($zFichier, APPLICATION_PATH . '/ASCAL/'.$zFileName);

						$zFileInput = APPLICATION_PATH . '/ASCAL/'.$zFileName;

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
									if ($toBoucleData1[0]!="" || $toBoucleData1[1]!=""){
										
										$oInsert['ascal_imCin'] = $toBoucleData1[1];
										$oInsert['ascal_nom'] = $toBoucleData1[2];
										$oInsert['ascal_prenom'] = $toBoucleData1[3];
										$oInsert['ascal_discipline'] = $toBoucleData1[4];
										$oInsert['ascal_region'] = $toBoucleData1[5];

										

										$this->Accueil->insertImportExcel($oInsert);
									}
									
							}
						}
					}
					$oData['noError'] = true;
				}

				
				$this->load_my_view_Common('accueil/import_excel.tpl',$oData,1);
		}
		

		echo "1";
	}
	
	/** 
	* Import fichier excel ASCAL
	*
	* @return view
	*/
	private function exportAscal(){
		global $oSmarty;
		$oData = $this->Accueil->getAscal(1);
		$oData2 = $this->Accueil->getAscal(2);
		//print_r($oListeTableau);
		
		$oSmarty->assign("oData",$oData);
		$oSmarty->assign("oDataNull",$oData2);
		$oSmarty->display(ADMIN_TEMPLATE_PATH . "accueil/exportAscal.tpl");
	}
	
	/** 
	* Import fichier excel ASCAL
	*
	* @return view
	*/
	private function exportAscalSimple(){
		global $oSmarty;
		$oData = $this->Accueil->getAscal(0);
		//print_r($oListeTableau);
		
		$oSmarty->assign("oData",$oData);
		$oSmarty->display(ADMIN_TEMPLATE_PATH . "accueil/exportAscalSimple.tpl");
	}

	/** 
	* enregistrement des communiqués et revues de presse
	* Accessible pour tous agents ayant un compte communication
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iId Identification du revue / communiqué
	* @return view
	*/
	public function save($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;
		$iModuleId = -4;
    	
		if ($iCompteActif == COMPTE_COMMUNICATION) {
			if($iRet == 1){	

				$oData = array();
				
				$iId = $this->postGetValue ("iId",0) ; 
				$oData["revueCommunique_typeRcId"]		= $this->postGetValue ("iTypeId",0) ; 
				$oData["revueCommunique_urgent"]		= $this->postGetValue ("revueCommunique_urgent",0) ; 
				$oData["revueCommunique_titre"]			= $this->postGetValue ("revueCommunique_titre",0) ; 
				$oData["revueCommunique_descCourt"]		= $this->postGetValue ("zDescriptionCourte",0) ; 
				$oData["revueCommunique_categorieRcId"] = $this->postGetValue ("iCategorieRcId",0) ; 
				$oData["revueCommunique_url"]			= $this->postGetValue ("zUrlVideo",'') ; 
				$oData["revueCommunique_type"]			= $this->postGetValue ("IchoiceRadio",1) ; 
				if (isset($_FILES['zImage']) && trim($_FILES['zImage']['name']) != "") {
					$oData["revueCommunique_image"]		= $_FILES['zImage']['name'] ; 

					$oFile = $_FILES['zImage'];
					//$zFileName = $oFile['name'];

					$zFileName = utf8_decode($_FILES["zImage"]["name"]);
					$zFileName = str_replace(" ","_",$zFileName);
					$zFileName = strtr($zFileName, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

					$oConfigImage = array(
						'upload_path' 	=>  'assets/accueil/upload',
						'allowed_types' => '*',
						'file_name'		=>	$id ,
						'overwrite'		=> 	true
					);
					
					$this->load->library('upload', $oConfigImage);
					$this->upload->initialize($oConfigImage);
					$this->upload->do_upload('zImage');
					$this->resizePictureRC(PATH_ROOT_DIR . '/assets/accueil/upload/' . $zFileName, $zFileName , "300", "300");

				}
				$oData["revueCommunique_organeId"]		= $this->postGetValue ("iOrganeId",0) ; 
				$oData["revueCommunique_pageParution"]	= $this->postGetValue ("zPageParution",0) ; 
				$oData["revueCommunique_journaliste"]	= $this->postGetValue ("zJournaliste",0) ; 
				$oData["revueCommunique_tendance"]		= $this->postGetValue ("iTendanceId",0) ; 
				

				if (isset($_FILES['zFile']) && trim($_FILES['zFile']['name']) != "") {


					$zUploadDir = PATH_ROOT_DIR . '/assets/accueil/upload';
					$zTmpName = $_FILES["zFile"]["tmp_name"];
					$zFileName = utf8_decode($_FILES["zFile"]["name"]);
					$zFileName = str_replace(" ","_",$zFileName);
					$zFileName = strtr($zFileName, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					
					$oData["revueCommunique_fichier"]		= $zFileName ; 
					@move_uploaded_file($zTmpName, "$zUploadDir/$zFileName");
					

				}
				$oData["revueCommunique_userId"]		= $oUser['id'] ; 
				$oData["revueCommunique_date"]			= $this->date_fr_to_en($this->postGetValue ("zDate"),'/','-'); 

				if ($iId > 0) {
					$this->Accueil->update_rc($oData, $iId);
				} else {
					$this->Accueil->insert($oData);
				}

				redirect("accueil/liste/$_zHashModule/$_zHashUrl");
			}
		}
	}


	/** 
	* enregistrement fiche de poste
	* Accessible pour tous agents ayant un compte communication
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iId Identification du revue / communiqué
	* @return view
	*/
	public function saveFicheDePoste($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCurrPage      = $_iCurrPage ;

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;
		$iModuleId = -4;
		
		if($iRet == 1){	

			$oData = array();
			
			$iId = $this->postGetValue ("iId",0) ; 
			$oData["fichePoste_intitule"]			= $this->postGetValue ("fichePoste_intitule",'') ; 
			$oData["fichePoste_mission"]			= html_entity_decode($this->postGetValue ("fichePoste_mission",'')) ; 
			$oData["fichePoste_activitePrinc"]		= html_entity_decode($this->postGetValue ("fichePoste_activitePrinc",'')) ; 
			$oData["fichePoste_activiteEncad"]		= html_entity_decode($this->postGetValue ("fichePoste_activiteEncad",'')) ; 
			$oData["fichePoste_exigenceNiveau"]		= html_entity_decode($this->postGetValue ("fichePoste_exigenceNiveau",'')) ; 
			$oData["fichePoste_exigenceDiplome"]	= html_entity_decode($this->postGetValue ("fichePoste_exigenceDiplome",'')) ; 
		
			if ($iId > 0) {
				$this->Accueil->update_ficheDePoste($oData, $iId);
			} else {
				$this->Accueil->insertFicheDePoste($oData);
			}

			redirect("accueil/listeFicheDePoste/module/liste");
		}
	}

	/** 
	* FCK Editor
	* retourner le wysiwig
	*
	* @return view
	*/
	public function setFckEditor($_zName, $_zValue, $_iHeight){
		
		require_once (APPLICATION_PATH.'assets/fckeditor/fckeditor.php');

		$oFCKeditor = new FCKeditor ($_zName) ;
		$oFCKeditor->BasePath = base_url().'assets/fckeditor/' ;
		$oFCKeditor->ToolbarSet	= 'Basic' ;
		$oFCKeditor->Width	= '100%' ;
		$oFCKeditor->Height	= $_iHeight ;
		$oFCKeditor->Value = $_zValue ;
		$zHtml =  $oFCKeditor->CreateHtml () ;

		return $zHtml;
    	
    }


	/** 
	* Fiche communiqué FCKEditor
	* Accessible pour tous agents ayant un compte communication
	*
	* @return view
	*/
	public function ficheCommunique(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

		require_once (APPLICATION_PATH.'assets/fckeditor/fckeditor.php');

		$iModuleId = -4;
    	
		if($iRet == 1){	

			$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."accueil/content.txt"); 

			$oFCKeditor = new FCKeditor ('accueil') ;
			$oFCKeditor->BasePath = base_url().'assets/fckeditor/' ;
			$oFCKeditor->ToolbarSet	= 'Default' ;
			$oFCKeditor->Width	= '100%' ;
			$oFCKeditor->Height	= 100 ;
			$oFCKeditor->Value = $zData ;
			$zHtml =  $oFCKeditor->CreateHtml () ;
			$oData['zData'] = $zHtml ; 
			$this->load_my_view_Common('accueil/ficheCommunique1.tpl',$oData, $iModuleId);	
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* revue de presse
	* Accessible pour tous agents ayant un compte communication
	*
	* @return view
	*/
	public function revueDePresse1(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

		require_once (APPLICATION_PATH.'assets/fckeditor/fckeditor.php');

		$iModuleId = -5;
    	
		if($iRet == 1){	

			$zData = @file_get_contents(ADMIN_TEMPLATE_PATH ."accueil/revueDePresse.txt"); 

			$oFCKeditor = new FCKeditor ('revueDePresse') ;
			$oFCKeditor->BasePath = base_url().'assets/fckeditor/' ;
			$oFCKeditor->ToolbarSet	= 'Default' ;
			$oFCKeditor->Width	= '100%' ;
			$oFCKeditor->Height	= 600 ;
			$oFCKeditor->Value = $zData ;
			$zHtml =  $oFCKeditor->CreateHtml () ;
			$oData['zData'] = $zHtml ; 
			$this->load_my_view_Common('accueil/ficheRevueDePresse.tpl',$oData, $iModuleId);	
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* Avancement des agents
	*
	* @param string $iMatricule matricule de l'agent
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
	* Code sanction des agents
	*
	* @param string $iMatricule matricule de l'agent
	* @return view
	*/
	private function codeSanction($iMatricule) 
	{
		$zData1 = @file_get_contents(ADMIN_TEMPLATE_PATH ."Avis/tPosteAgent.txt"); 

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
	* attribution sanction
	*
	* @return view
	*/
	public function setSanction (){
	
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id']);

		if (empty($candidat)){
			redirect("cv2/mon_cv");
    	}else{

			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 58;
			$oData['zBasePath'] = base_url();
			$iModuleId = 1;
			
			if($iRet == 1){	

				$toUserAutorise = array ('332026','355577');

				if (in_array($oUser['im'], $toUserAutorise)) {
					
					$toCandidat = $this->candidat->candidat_matricule_isSanction();

					foreach ($toCandidat as $oCandidat){
						$toSanction = $this->codeSanction($oCandidat['matricule']);
						$this->candidat->update_Sanction($oCandidat['user_id'],$toSanction) ; 
 
					}

				} else {
					die("Accès refusé");
				}

			} else {
				redirect("cv2/mon_cv");
			}
		}
	}

	/** 
	* mise à jour corps grade indice
	*
	* @return 
	*/
	public function setCorpsGradeIndice (){
	
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id']);

		if (empty($candidat)){
			redirect("cv2/mon_cv");
    	}else{

			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 58;
			$oData['zBasePath'] = base_url();
			$iModuleId = 1;
			
			if($iRet == 1){	

				$toUserAutorise = array ('332026','355577');

				if (in_array($oUser['im'], $toUserAutorise)) {
					
					$toCandidat = $this->candidat->candidat_matricule();

					

					foreach ($toCandidat as $oCandidat){
						$toAvancement = $this->AvancementAgent($oCandidat['matricule']);
						$iMois = sprintf("%'.02d\n", date("m")-1);
						$iAnnee = substr(date("Y"), 2, 2); 
						$iIndice = "";
						$toCandidatAffiche = $this->setToCredit($oCandidat['matricule'], $iMois, $iAnnee) ;

						//print_r ($toCandidatAffiche);

						if (sizeof($toCandidatAffiche)>0){
							if (is_array($toCandidatAffiche)) {
								$iIndice = $toCandidatAffiche[sizeof($toCandidatAffiche)-1]->indice;
								echo "miditra 1  " . $iIndice . "\n<br>";
							} else {
								$iIndice = $toCandidatAffiche->indice;
								echo "miditra " . $iIndice . "\n<br>";
							}
						}

						$this->candidat->update_corpsGradeIndice2($oCandidat['user_id'],$toAvancement,$iIndice) ; 
 
					}

				} else {
					die("Accès refusé");
				}

			} else {
				redirect("cv2/mon_cv");
			}
		}
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
		
		$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

		$zPathWithPhoto = base_url() . "assets/evaluation2/images/no_image_user.png";
		if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
			$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
		} 

		$toFicheDePoste = $this->Accueil->preRemplissageFicheDePoste($oCandidat[0]->fichePosteId);

		$oSmarty->assign("toFicheDePoste",$toFicheDePoste);
		$oSmarty->assign("oCandidat",$oCandidat);
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
		$oSmarty->clear_cache( ADMIN_TEMPLATE_PATH . "accueil/getInfoUser.tpl" );
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "accueil/getInfoUser.tpl" );
		
		echo $zInfoUser ;  
	}


	/** 
	* sauvegarde date service
	*
	* @return 
	*/
	public function updateDateService (){
	
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id']);

		if (empty($candidat)){
			redirect("cv2/mon_cv");
    	}else{

			$iRet = $this->check($oUser, $oCandidat);
			
			
			if($iRet == 1){	

				$toUserAutorise = array ('332026','355577');

				if (in_array($oUser['im'], $toUserAutorise)) {
					
					$toCandidat = $this->candidat->candidat_matricule2();

					foreach ($toCandidat as $oCandidat){
						$toAvancement = $this->AvancementAgent($oCandidat['matricule']);
						$this->candidat->update_datePriseService($oCandidat['user_id'],$toAvancement) ; 
						//sdie();
					}

				} else {
					die("Accès refusé");
				}

			} else {
				redirect("cv2/mon_cv");
			}
		}
	}

	/** 
	* Goodies
	*
	* @return 
	*/
	public function goodies (){
	
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id']);

		if (empty($candidat)){
			redirect("cv2/mon_cv");
    	}else{

			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 58;
			$oData['zBasePath'] = base_url();
			$iModuleId = 1;
			
			if($iRet == 1){	

				$this->load_my_view_Common('accueil/getGoodies.tpl',$oData, $iModuleId);	

			} else {
				redirect("cv2/mon_cv");
			}
		}
	}

	/** 
	* Affichage publicité 
	*
	* @return 
	*/
	public function publicite (){
	
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id']);

		if (empty($candidat)){
			redirect("cv2/mon_cv");
    	}else{

			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 58;
			$oData['zBasePath'] = base_url();
			$iModuleId = 1;
			
			if($iRet == 1){	

				$this->load_my_view_Common('accueil/publicite.tpl',$oData, $iModuleId);	

			} else {
				redirect("cv2/mon_cv");
			}
		}
	}

	/** 
	* questionnaire fiche de poste
	*
	* @return 
	*/
	public function questionnaire($_iCategorieId=0){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		if($oUser['id'] != '11' || $oUser['id'] == '4430') {
			die();
		}

		/*$iReturn = $this->Gcap->setTestQuestionnaire($oUser['id']);
		
		if ($iReturn == 1){
			
			$oQuestionnaire = $this->Gcap->setTestQuestionnaireObject($oUser['id']);
			if (sizeof($oQuestionnaire)>0 ){
				if ($oQuestionnaire[0]->question_partiel == 4){
					redirect("accueil/communique");
				}
			}
		}*/

		$iErr = $this->postGetValue ("iErr",0) ;

		$toFormulaire = array();
		if ($iErr==1 && (isset($_SESSION['assignation2']) && $_SESSION['assignation2'] != '')){
			$toFormulaire = unserialize($_SESSION['assignation2']);
			unset($_SESSION['assignation2']);
		}

		
		$oQuestionnaire = $this->Gcap->setTestQuestionnaireObject($oUser['id']);

		//print_r ($oQuestionnaire);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 1002;
		$iModuleId = 1;
		$toDepartement = $this->Departement->get_departement();
		$oLocalite = $this->Gcap->getLocaliteService($oUser['id']);
		
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('oLocalite', $oLocalite);
		$oSmarty->assign('oQuestionnaire', $oQuestionnaire);
		$oSmarty->assign('iErr', $iErr);
		$oSmarty->assign('toFormulaire', $toFormulaire);
		$oSmarty->assign('zServer', $_SERVER['HTTP_HOST']);
		$oSmarty->assign('toDepartement', $toDepartement);
		$this->load_my_view_Common('accueil/questionnaire.tpl',$oData, $iModuleId);	
	}

	/** 
	* formulaire fiche de poste
	*
	* @return 
	*/
	public function __formulaire($_z="fiche-de-poste"){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkQuestion($oUser, $oCandidat);
		$iReturnAgent = $this->Gcap->setFicheDePoste($oUser['id']);

		
		if ($iReturnAgent == 1){
			redirect("accueil/communique");
		}

		$iErr = $this->postGetValue ("iErr",0) ;

		$toFormulaire = array();
		if ($iErr==1 && (isset($_SESSION['assignation']) && $_SESSION['assignation'] != '')){
			$toFormulaire = unserialize($_SESSION['assignation']);
			unset($_SESSION['assignation']);
		}

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 1001;
		$iModuleId = 1;
		$toDepartement = $this->Departement->get_departement();
		$oLocalite = $this->Gcap->getLocaliteService($oUser['id']);
		
		$oSmarty->assign('zBasePath', base_url());
		$oSmarty->assign('oLocalite', $oLocalite);
		$oSmarty->assign('iIncrement_b', 4);
		$oSmarty->assign('iErr', $iErr);
		$oSmarty->assign('toFormulaire', $toFormulaire);
		$oSmarty->assign('zServer', $_SERVER['HTTP_HOST']);
		$oSmarty->assign('toDepartement', $toDepartement);
		$this->load_my_view_Common('accueil/fiche-de-poste.tpl',$oData, $iModuleId);	
	}

	/** 
	* enregistrement question
	*
	* @return 
	*/
	public function saveQuestion(){

		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$iRet = $this->checkQuestion($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	

			$toFormulaire =  $_REQUEST;

			/* ici c'est partiel */
			$oQuestionnaire = $this->Gcap->setTestQuestionnaireObject($oUser['id']);

			$iQuestionPartiel	= $this->postGetValue ("question_partiel",0) ;
			$toFormulaire['question_userId'] = $oUser['id'];
			if ($iQuestionPartiel != 4){

				$toFormulaire['question_partiel'] = 2;
				if (sizeof($oQuestionnaire) >0 ){
						$iQuestionnaireId = $oQuestionnaire[0]->question_id; 
						$this->Gcap->updateQuestionnaire($toFormulaire, $iQuestionnaireId);
				} else {
						$this->Gcap->insertQuestionnaire($toFormulaire);
				}

				echo "1";

			} else {

				$toFormulaire['question_partiel'] = 4;
				if (sizeof($oQuestionnaire) >0 ){
						$iQuestionnaireId = $oQuestionnaire[0]->question_id; 
						$this->Gcap->updateQuestionnaire($toFormulaire, $iQuestionnaireId);
				} else {
						$this->Gcap->insertQuestionnaire($toFormulaire);
				}
				redirect("accueil/communique?suc=1");
			}
		}
	}

	/** 
	* sauvegarde fiche de poste
	*
	* @return 
	*/
	public function saveFichePoste(){

		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$iRet = $this->checkQuestion($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1){	
			$toFormulaire =  $_REQUEST;
			$toFormulaire['fichePoste_userId'] = $oUser['id'];

			$this->Gcap->insertFichePoste($toFormulaire);
			redirect("accueil/communique?suc=1");
		}
	}

	/** 
	* communiqué
	*
	* @param int $_iCategorieId Identificant catégorie
	* @return 
	*/
	public function communique($_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id']);

		$iAfficheSmile = 0;
		if(empty($_SESSION['iAfficheSmile'])){
			$_SESSION['iAfficheSmile'] = 'ok';
			$iAfficheSmile = 1;
		}
		if( $user["im"] == "278203" ){
			redirect("GestionStructure/statistiques");
		}
		if (empty($candidat)){
			redirect("cv2/mon_cv");
    	}else{
			

			$iRet = $this->check($oUser, $oCandidat);

			
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 58;

			$iModuleId = 1;
			 
			if($iRet == 1){	

				//$iPopUpId = $this->Accueil->getPopNouveauBadge($user['id']);

				$iPopUpId			= $this->Accueil->getPopConfirmationBadge($user['id']);
				$toCategorieRc		= $this->Accueil->getCategorieRc(1);
				$toListe			= $this->Accueil->getAllAccueil(1,$_iCategorieId);
				$zCategorieLibelle	= $this->Accueil->getCategorieById($_iCategorieId);
				$toReclassement		= $this->Agenda->reclassement($user['id'],1);
				$iAfficheMFBNC	= 0;
				if (empty($_SESSION["mfbNc"])){

					$iAfficheMFBNC = 1;
					$_SESSION["mfbNc"] = 1;
				}

				
				if (!isset($_SESSION["session_agenda"]))
				{
					$_SESSION["session_agenda"] = 1 ; 
				}

				$toChangeLocalite = array();
				if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL) {
					$zUserId = $this->Accueil->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
					$toChangeLocalite = $this->Localite->getInfoChangeLocaliteEvaluateur($zUserId) ; 
				}

				$iRetBadgeNotification = $this->Transaction->getNotificationCarte($oUser['id']);

				$oData['iNotificationCarte'] = '' ;
				if ($iRetBadgeNotification == 1) {
					$oData['iNotificationCarte'] = 3 ;
				}
				
				$iSuc = $this->postGetValue ("suc",0) ;
				$iIncrement = 0;
				foreach ($toListe as $oListe){
					$toListe[$iIncrement]['photo'] = "";
					$oListe['annee']==1?redirect($this->notAddHash('n5Wg2JGcpZ/O2KOioaya')):'';
					if ($oListe['revueCommunique_image'] != ""){
						$zPhoto = $oListe['revueCommunique_image'] ; 
						
						if (file_exists(APPLICATION_PATH . "assets/accueil/upload/".$zPhoto)) {
							$toListe[$iIncrement]['photo'] = base_url() . "assets/accueil/upload/".$zPhoto ; 
						}  else {
							$toListe[$iIncrement]['photo'] = "";
						}
					}
					$iIncrement++;
				}
							
				$oData['toListe']		= $toListe ; 
				$oData['iAfficheSmile']	= $iAfficheSmile ; 
				$oData['iUserId']		= $user['id'] ;
				$oData['iPopUpId']		= $iPopUpId ;
				$oData['iSuc']			= $iSuc ;
				$oData['iAfficheMFBNC']	= $iAfficheMFBNC ;
				$oData['toReclassement'] = $toReclassement ;
				$oData['toChangeLocalite']	= $toChangeLocalite ;
				$oData['toCategorieRc'] = $toCategorieRc ; 
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Communiqué" ; 
				
				$this->load_my_view_Common('accueil/communique.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv2/mon_cv");
			}
		}
    	
    }


	/** 
	* enregistrement localité de service d'un évaluateur
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
		$zPhone				= $this->postGetValue ("zPhone","") ;
		$zEmail				= $this->postGetValue ("zEmail","") ;
    	
		if($iRet == 1){	

			$oDataInfo = array();
			$oDataInfo['phone'] = $zPhone;
			$oDataInfo['email'] = $zEmail;
			$this->Localite->update_Candidat($oDataInfo, $iUserId);

			$oCandidat = $this->Gcap->get_candidat_object($iUserId);

			$oDataPopUp = array();
			$oDataPopUp['popup_userId']  = $iUserId;
			$oDataPopUp['popup_affiche'] = 1;
			$oDataPopUp['popup_date']	 = date("Y-m-d H:i:s");
			$this->Accueil->insertPopUp($oDataPopUp);

			$iDepartementIdOrig = $oCandidat[0]->departement ;  
			$iDirectionIdOrig = $oCandidat[0]->direction;
			$iServiceIdOrig = $oCandidat[0]->service;
			$iDivisionOrig = $oCandidat[0]->division;

			$iAddLocalitePassive = 0;

			if ($iDivisionOrig != $iDivisionId && $iDivisionOrig != '999999' && $iDivisionId!=0 && $iDivisionId!='999999'){
				$iAddLocalitePassive = 1;
			}

			if (($iDepartementIdOrig != $iDepartementId) || ($iDirectionIdOrig != $iDirection) || ($iServiceIdOrig != $iService)){
				$iAddLocalitePassive = 1;
			}

			if ($iAddLocalitePassive==1){
	
				$oDataLocalitePassive = array();
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

				$this->load->model('localite_gcap_model','Localite');
				$this->Localite->insert($oDataLocalitePassive) ; 
			}
			
    	
		} else {
			redirect("cv/index");
		}
	}

	public function getQuestionnaire() {
		global $oSmarty ; 
		$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "accueil/getQuestionnaire.tpl" );
		echo $zInfoUser ; 
	}

	/** 
	* renseignement d'un utilisateur
	*
	* @param int $_iUserId Identificant User
	* @return 
	*/
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

			$oSmarty->assign("toProvince",$toProvince);
			$oSmarty->assign("toRegion",$toRegion);
			$oSmarty->assign("toDistrict",$toDistrict);
			$oSmarty->assign("oDepartement1",$oDepartement);
			$oSmarty->assign("oDirection1",$oDirection);
			$oSmarty->assign("iUserId",$_iUserId);
			$oSmarty->assign("iUserTarget",$iUserTarget);
			$oSmarty->assign("oService1",$oService);
			$oSmarty->assign("oDivision1",$oDivision);		
			$oSmarty->assign("oReturn",$oReturn);
			$oSmarty->assign("oCandidat",$oCandidat);
			$oSmarty->assign('zBasePath', base_url());
			$oSmarty->assign('zPathWithPhoto', $zPathWithPhoto);
			$oSmarty->assign("zName",$zName);
			$oSmarty->assign("zMessage",$zMessage);
			$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "accueil/getInfoUserChangeManuel.tpl" );
			echo $zInfoUser ; 
		} else {
			echo "<h1><strong>L'agent recherché n'est pas dans ROHI</strong></h1>" ; 
		}

	}

	/** 
	* Affichage revue de presse
	*
	* @param int $_iCategorieId Catégorie de revue de presse
	* @return 
	*/
	public function revuedepresse($_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 59;

		$iModuleId = 1;
    	
		if($iRet == 1){	

			$toCategorieRc = $this->Accueil->getCategorieRc(2);
			$toDistinctAnnee = $this->Accueil->getDistinctAnnee(2);
			$toDistinctMois = $this->Accueil->getDistinctMois();
			$toListe = $this->Accueil->getAllAccueil(2,$_iCategorieId);
			$zCategorieLibelle = $this->Accueil->getCategorieById($_iCategorieId);
			$oData['toCategorieRc'] = $toCategorieRc ; 
			$oData['toListe'] = $toListe ; 
			$oData['toDistinctAnnee'] = $toDistinctAnnee ;
			$oData['toDistinctMois'] = $toDistinctMois ;
			$oData['zDateEnCours']	= date("Y-m-d") ; 
			$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
			$oData['zTitle'] = "Revue de presse" ; 
			$this->load_my_view_Common('accueil/revue-de-presse.tpl',$oData, $iModuleId);	
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* supression communiqué
	*
	* @return 
	*/
	public function deleteCommunique(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$iElementId		= $this->postGetValue ("iElementId",0) ;

			$this->Accueil->delete_rcCommunique($iElementId);
			
			redirect("accueil/liste/communique/bo");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* supression fiche de poste
	*
	* @return 
	*/
	public function deleteFicheDePosteR(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$iElementId		= $this->postGetValue ("iElementId",0) ;

			$this->Accueil->delete_FicheDePosteR($iElementId);
			
			redirect("accueil/listeFicheDePoste/module/liste");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Suppression fiche de poste
	*
	* @return 
	*/
	public function deleteFicheDePoste(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$oData = array();

			$iElementId		= $this->postGetValue ("iElementId",0) ;

			$this->Accueil->delete_FicheDePoste($iElementId);
			
			redirect("accueil/outils/fiche-de-poste/liste");
			
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* test d'envoi de mail
	*
	* @return 
	*/
	public function testSendMail(){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			$zBody = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/gcapAutorite.tpl" );
			$zSujet = "titre";

			$oDestination = array();
			$oDestination['email'] = "tojo.drha@gmail.com";
			$oDestination['nom'] = "tojo";
			$oDestination['prenom'] = "tojo";
			$this->sendA();
			echo "tojoTest";
    	
		} else {
			$this->mon_cv();
		}
	}

	/** 
	* Sauvegarde communiqué
	*
	* @return 
	*/
	public function saveCommunique(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			$zContent	= $this->postGetValue ("accueil",'') ;

			file_put_contents(ADMIN_TEMPLATE_PATH ."accueil/content.txt", $zContent);

			redirect("accueil/ficheCommunique");
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* Sauvegarde revue de presse
	*
	* @return 
	*/
	public function saveRevue(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			$zContent	= $this->postGetValue ("revueDePresse",'') ;

			file_put_contents(ADMIN_TEMPLATE_PATH ."accueil/revueDePresse.txt", $zContent);

			redirect("accueil/revueDePresse");
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* Exportation fiche de poste par localité
	*
	* @return 
	*/
	public function setExportFichePoste(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			$iDepartement = $this->postGetValue ("iDepartement",0) ;
			$toListe = $this->Gcap->getAllFichePoste($iDepartement);

			$this->Gcap->setExcelExportFichePoste($toListe);
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* Exportation fiche de poste par recrutement
	*
	* @return 
	*/
	public function setExportFichePosteRecrutement(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			$iDepartement = $this->postGetValue ("iDepartement",0) ;
			$toListe = $this->Gcap->getAllFichePosteRecrutement($iDepartement);
			$this->Gcap->setExcelExportFichePosteRecrutement($toListe);
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* Exportation fiche de poste par localité
	*
	* @param string $_zType type de departement
	* @return 
	*/
	public function setExportFichePosteByLocalite($_zType="departement"){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			
			$toListe = $this->Gcap->getStatFichePoste($_zType);
			$this->Gcap->setExcelFichePosteByLocalite($toListe,$_zType);
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* Exportation fiche de poste par localité
	*
	* @param string $_zType type de departement
	* @return 
	*/
	private function miseAJourConfirmationBadge(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			$this->Gcap->miseAJourConfirmationBadge();
    	
		} else {
			redirect("cv2/mon_cv");
		}
    	
    }

	/** 
	* redimensionnement et deplacement d'une image
	*
	* @param string $_sImagePath chemin d'origine
	* @param int $_sImageResPath chemin de la redemensionnement
	* @param string $_sImageResPath chemin de la redemensionnement
	* @param int $_iMaxWidth maximum taille de l'image
	* @param int $_iMaxHeight minimum taille de l'image
	* @return 
	*/
    function resizePictureRC ($_sImagePath, $_sImageResPath, $_iMaxWidth = 0, $_iMaxHeight = 0)
    {

        
		$_sImageResPath = PATH_ROOT_DIR . "/assets/accueil/upload/resize/". $_sImageResPath ; 
		
		@ini_set ("memory_limit", -1) ;

        $tsImageInfos = getimagesize ($_sImagePath) ;

        $sImageMimeType = $tsImageInfos["mime"] ;
        $tsTokens = explode ("/", $sImageMimeType) ;
        $sImageType = strtoupper (trim ($tsTokens[1])) ;

        $createImageFromXXX = "imageCreateFrom" . $sImageType ;
        $imageXXX = "image" . $sImageType ;

        $oImgSrc = $createImageFromXXX ($_sImagePath) ;
        $iWidth = $tsImageInfos[0] ;
        $iHeight = $tsImageInfos[1] ;
        $iOrigWidth = $iWidth ;
        $iOrigHeight = $iHeight ;

        if (($iWidth < $_iMaxWidth) && ($iHeight < $_iMaxHeight))
        {
            @copy ($_sImagePath, $_sImageResPath) ;
        }
        elseif (($iWidth >= $_iMaxWidth) && ($iHeight >= $_iMaxHeight))
        {

            $rRatioWidth = $_iMaxWidth / $iWidth ;
            $rRationHeight = $_iMaxHeight / $iHeight ;

            $rRatio = ($rRatioWidth < $rRationHeight)  ? $rRatioWidth : $rRationHeight ;

            $iWidth = ceil ($iWidth * $rRatio) ;
            $iHeight = ceil ($iHeight * $rRatio) ;

            $oNewImg = imageCreateTrueColor ($iWidth, $iHeight) ;
            imageCopyResampled ($oNewImg, $oImgSrc, 0, 0, 0, 0, $iWidth, $iHeight, $iOrigWidth, $iOrigHeight) ;
            $imageXXX ($oNewImg, $_sImageResPath) ;

        }
        elseif ($iWidth >= $_iMaxWidth)
        {
            
            $rRatioWidth = $_iMaxWidth / $iWidth ;

            $iWidth = ceil ($iWidth * $rRatioWidth) ;
            $iHeight = ceil ($iHeight * $rRatioWidth) ;

            $oNewImg = imageCreateTrueColor ($iWidth, $iHeight) ;
            imageCopyResampled ($oNewImg, $oImgSrc, 0, 0, 0, 0, $iWidth, $iHeight, $iOrigWidth, $iOrigHeight) ;
            $imageXXX ($oNewImg, $_sImageResPath) ;

        }
        else
        {
            
            $rRationHeight = $_iMaxHeight / $iHeight ;
            
            $iWidth = ceil ($iWidth * $rRationHeight) ;
            $iHeight = ceil ($iHeight * $rRationHeight) ;

            $oNewImg = imageCreateTrueColor ($iWidth, $iHeight) ;
            imageCopyResampled ($oNewImg, $oImgSrc, 0, 0, 0, 0, $iWidth, $iHeight, $iOrigWidth, $iOrigHeight) ;
            $imageXXX ($oNewImg, $_sImageResPath) ;

        }
        
        @chmod ($_sImageResPath, 0666) ;

    }

	/** 
	* fonction ajout fiche de poste
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @return view
	*/
	public function ajout($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iModuleId = 9;//$this->module->get_by_module_zHashModule($_zHashModule);
	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			switch ($_zHashUrl) {

				case 'saveFichePoste':

					
		
							$iUserId = $this->postGetValue ("iUserId",0) ;
							$iFichePosteId = $this->postGetValue ("iFichePosteId",0) ;
							$iBoucleMission = $this->postGetValue ("iIncrement_b",0) ;
							$iBoucleActivite = $this->postGetValue ("iIncrement_c",0) ;
							$iBoucleEncadrement = $this->postGetValue ("iIncrement_d",0) ;
							$iBoucleExigence = $this->postGetValue ("iIncrement_e",0) ;

							$iReturnAgent = $this->Gcap->setFicheDePoste($iUserId);

							if ($iReturnAgent == 1) {

									$toGetUserFichePoste = $this->Gcap->getUserFichePoste($iUserId);
									$toGetUserMission = $this->Gcap->getUserMission($iUserId);
									$toGetUserActivite = $this->Gcap->getUserActivite($iUserId);
									$toGetUserEncadrement = $this->Gcap->getUserEncadrement($iUserId);
									$toGetUserExigence = $this->Gcap->getUserExigence($iUserId);

									
									$oFichePoste = array();
									$oFichePoste['fichePoste_intitule'] = $_POST['question_a'];
									$this->Gcap->updateFicheDePoste($oFichePoste, $iFichePosteId);

									/**** Mission ****/

									$toAllModifMission = array();
									if (sizeof ($toGetUserMission)>0){
										foreach ($toGetUserMission as $oGetUserMission){
											array_push($toAllModifMission, $oGetUserMission["missionPoste_id"]);
										}
									}

									$toModifMission = array();
									for($iIncrementM=1;$iIncrementM<=$iBoucleMission;$iIncrementM++){
										//echo "miditra" . $iIncrementM . " --" . "identifiant_b_" . $iIncrementM . " --";
										$oData = array();
										if(isset($_POST["identifiant_b_" . $iIncrementM]) && ($_POST["identifiant_b_" . $iIncrementM]!='')){
											array_push ($toModifMission, $_POST["identifiant_b_" . $iIncrementM]);
											$oData["missionPoste_text"] = $_POST["question_b_" . $iIncrementM] ;
											$this->Gcap->updateMission($oData, $_POST["identifiant_b_" . $iIncrementM]);
										} else {
											if ($_POST["question_b_" . $iIncrementM] != ""){
												$oData["missionPoste_fichePosteId"] = $iFichePosteId ; 
												$oData["missionPoste_userId"] = $iUserId ; 
												$oData["missionPoste_text"] = $_POST["question_b_" . $iIncrementM] ; 
												$this->Gcap->insertMission($oData);
											}
										}
									}

									if (sizeof ($toModifMission)>0){
										foreach ($toAllModifMission as $iModifSingle){
											if (!in_array($iModifSingle, $toModifMission)){
												$this->Gcap->deleteMission($iModifSingle);
											}
										}
									}

									/************ Fin mission ************************/


									/**** Activite ****/

									$toAllModifActivite = array();
									if (sizeof ($toGetUserActivite)>0){
										foreach ($toGetUserActivite as $oGetUserActivite){
											array_push($toAllModifActivite, $oGetUserActivite["activitePoste_id"]);
										}
									}

									$toModifActivite = array();
									for($iIncrementA=1;$iIncrementA<=$iBoucleActivite;$iIncrementA++){
										$oData = array();
										if(isset($_POST["identifiant_c_" . $iIncrementA]) && ($_POST["identifiant_c_" . $iIncrementA]!='')){
											array_push ($toModifActivite, $_POST["identifiant_c_" . $iIncrementA]);
											$oData["activitePoste_text"] = $_POST["question_c_" . $iIncrementA] ; 
											$this->Gcap->updateActivite($oData, $_POST["identifiant_c_" . $iIncrementA]);
										} else {
											if ($_POST["question_c_" . $iIncrementA] != ""){
												$oData["activitePoste_fichePosteId"] = $iFichePosteId ; 
												$oData["activitePoste_userId"] = $iUserId ; 
												$oData["activitePoste_text"] = $_POST["question_c_" . $iIncrementA] ; 
												$this->Gcap->insertActivite($oData);
											}
										}
									}

									if (sizeof ($toModifActivite)>0){
										foreach ($toAllModifActivite as $iModifSingle){
											if (!in_array($iModifSingle, $toModifActivite)){
												$this->Gcap->deleteActivite($iModifSingle);
											}
										}
									}

									/************ Fin activite ************************/

									/**** Encadrement ****/

									$toAllModifEncadrement = array();
									if (sizeof ($toGetUserEncadrement)>0){
										foreach ($toGetUserEncadrement as $oGetUserEncadrement){
											array_push($toAllModifEncadrement, $oGetUserEncadrement["encadrementPoste_id"]);
										}
									}
			

									$toModifEncadrement = array();
									for($iIncrementE=1;$iIncrementE<=$iBoucleEncadrement;$iIncrementE++){
										$oData = array();
										if(isset($_POST["identifiant_d_" . $iIncrementE]) && ($_POST["identifiant_d_" . $iIncrementE]!='')){
											array_push ($toModifEncadrement, $_POST["identifiant_d_" . $iIncrementE]);
											$oData["encadrementPoste_text"] = $_POST["question_d_" . $iIncrementE] ; 
											$this->Gcap->updateEncadrement($oData, $_POST["identifiant_d_" . $iIncrementE]);
										} else {
											if ($_POST["question_d_" . $iIncrementE] != ""){
												$oData["encadrementPoste_fichePosteId"] = $iFichePosteId ; 
												$oData["encadrementPoste_userId"] = $iUserId ; 
												$oData["encadrementPoste_text"] = $_POST["question_d_" . $iIncrementE] ; 
												$this->Gcap->insertEncadrement($oData);
											}
										}
									}

									if (sizeof ($toModifEncadrement)>0){
										foreach ($toAllModifEncadrement as $iModifSingle){
											if (!in_array($iModifSingle, $toModifEncadrement)){
												$this->Gcap->deleteEncadrement($iModifSingle);
											}
										}
									}

									/************ Fin encadrement ************************/


									/**** Exigence ****/

									$toAllModifExigence = array();
									if (sizeof ($toGetUserExigence)>0){
										foreach ($toGetUserExigence as $oGetUserExigence){
											//array_push($toAllModifExigence, $oGetUserExigence["exigencePoste_id"]);
										}
									}

									$toModifExigence = array();
									for($iIncrementF=1;$iIncrementF<=$iBoucleExigence;$iIncrementF++){
										$oData = array();
										if(isset($_POST["identifiant_e_" . $iIncrementF]) && ($_POST["identifiant_e_" . $iIncrementF]!='')){
											array_push ($toModifExigence, $_POST["identifiant_e_" . $iIncrementF]);
											$oData["exigencePoste_niveau"] = $_POST["question_e_1_" . $iIncrementF] ; 
											$oData["exigencePoste_experience"] = $_POST["question_e_2_" . $iIncrementF] ; 
											$this->Gcap->updateExigence($oData, $_POST["identifiant_e_" . $iIncrementF]);
										} else {

											if (($_POST["question_e_1_" . $iIncrementF]!="") || ($_POST["question_e_2_" . $iIncrementF] != '')){
												$oData["exigencePoste_fichePosteId"] = $iFichePosteId ; 
												$oData["exigencePoste_userId"] = $iUserId ; 
												$oData["exigencePoste_niveau"] = $_POST["question_e_1_" . $iIncrementF] ; 
												$oData["exigencePoste_experience"] = $_POST["question_e_2_" . $iIncrementF] ; 
												$this->Gcap->insertExigence($oData);
											}
										}
									}

									if (sizeof ($toModifExigence)>0){
										foreach ($toAllModifExigence as $iModifSingle){
											if (!in_array($iModifSingle, $toModifExigence)){
												$this->Gcap->deleteExigence($iModifSingle);
											}
										}
									}

									/************ Fin exigence ************************/
									redirect("accueil/communique?suc=1");
							
							} else {

								$toFormulaire =  $_REQUEST;

								/*print_r ($_REQUEST);
								die();*/
								$toFormulaire['fichePoste_userId'] = $iUserId;

								$this->Gcap->insertFichePoste($toFormulaire);
								redirect("accueil/communique?suc=1");
							}

							//die();
							
					
					break;

				case 'saisi':

							$iReturnAgent = $this->Gcap->setFicheDePoste($oUser['id']);
							if ($iReturnAgent == 1){
								redirect("accueil/communique");
							}else{
								$toGetUserFichePoste = array();
								$toGetUserMission = array();
								$toGetUserActivite = array();
								$toGetUserEncadrement = array();
								$toGetUserExigence = array();

								global $oSmarty ; 

								
								if($oUser['im'] =='ECD' || $oUser['im'] ==''){
									$oCandidat = $this->Gcap->get_candidat_by_cin_matricule ($oUser['cin'], '');
								} else {
									$oCandidat = $this->Gcap->get_candidat_by_cin_matricule ('', $oUser['im']);
								}

								$oSmarty->assign('zBasePath', base_url());
								$oSmarty->assign('toGetUserFichePoste', $toGetUserFichePoste);
								$oSmarty->assign('toGetUserMission', $toGetUserMission);
								$oSmarty->assign('toGetUserActivite', $toGetUserActivite);
								$oSmarty->assign('toGetUserEncadrement', $toGetUserEncadrement);
								$oSmarty->assign('toGetUserExigence', $toGetUserExigence);
								$oSmarty->assign('oCandidat', $oCandidat);
								$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "accueil/fiche-de-poste-modification.tpl" );
			
								$suc = $this->postGetValue ("suc",0) ;
								$oData['menu']  = 1002;
								$oData['zInfoUser']  = $zInfoUser;
								$oData['iMatriculeDRHA']  = "389671";
								$oData['suc']   = $suc;
								$iModuleId = 11;
								$this->load_my_view_Common('accueil/fichePosteSaisieAgent.tpl',$oData, 22);
							}
					
					break;
			}

		} else {
			redirect("cv/index");
		}
    	
    }

	/** 
	* fonction outils pour le sauvegarde fiche de poste ou listing
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iFichePosteId Identification fiche de poste
	* @return view
	*/
	public function SetFck($_zName, $_zData){

		require_once (APPLICATION_PATH.'assets/fckeditor/fckeditor.php');

		$oFCKeditor = new FCKeditor ($_zName) ;
		$oFCKeditor->BasePath = base_url().'assets/fckeditor/' ;
		$oFCKeditor->ToolbarSet	= 'Default' ;
		$oFCKeditor->Width	= '100%' ;
		$oFCKeditor->Height	= 125 ;
		$oFCKeditor->Value = $_zData ;
		$zHtml =  $oFCKeditor->CreateHtml () ;
		return $zHtml ; 
	}

	/** 
	* fonction outils pour le sauvegarde fiche de poste ou listing
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iFichePosteId Identification fiche de poste
	* @return view
	*/
	public function outils($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iFichePosteId = 0){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iModuleId = 9;//$this->module->get_by_module_zHashModule($_zHashModule);
	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			switch ($_zHashUrl) {

				case 'fiche':

					
					$iMatricule	= $this->postGetValue ("iMatricule",'389671') ;
					$iCin	= $this->postGetValue ("iCin",'') ;

					$toUserAutorise = array ('307381','287385','355857','332026','357018','321684','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {  

							global $oSmarty ; 

							$toGetUserFichePoste = array();
							$toGetUserMission = array();
							$toGetUserActivite = array();
							$toGetUserEncadrement = array();
							$toGetUserExigence = array();

							$iUserId = 0;
							if ($_iFichePosteId != 0){
								$oFichePoste = $this->Accueil->getFichePoste($_iFichePosteId);

								if (sizeof($oFichePoste)>0){
									$iUserId = $oFichePoste["fichePoste_userId"];
									$toGetUserFichePoste = $this->Gcap->getUserFichePoste($iUserId);
									$toGetUserMission = $this->Gcap->getUserMission($iUserId);
									$toGetUserActivite = $this->Gcap->getUserActivite($iUserId);
									$toGetUserEncadrement = $this->Gcap->getUserEncadrement($iUserId);
									$toGetUserExigence = $this->Gcap->getUserExigence($iUserId);
								}
							}

							$oCandidat = array();
							$oSmarty->assign('zBasePath', base_url());
							$oSmarty->assign('toGetUserFichePoste', $toGetUserFichePoste);
							$oSmarty->assign('toGetUserMission', $toGetUserMission);
							$oSmarty->assign('toGetUserActivite', $toGetUserActivite);
							$oSmarty->assign('toGetUserEncadrement', $toGetUserEncadrement);
							$oSmarty->assign('toGetUserExigence', $toGetUserExigence);
							$oSmarty->assign('oCandidat', $oCandidat);
							$oSmarty->assign('iUserId', $iUserId);
							$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "ficheDePoste/fiche-de-poste-modification.tpl" );
							$oData['zInfoUser']  = $zInfoUser;
							$this->load_my_view_Common('ficheDePoste/fichePosteFinale.tpl',$oData, 900);
							
					} else {
						die(utf8_decode("Cette page est strictement reservée au points focaux. Merci!"));
					}
					break;

				case 'saveFichePoste':
		
							$iFichePosteId = $this->postGetValue ("iFichePosteId",0) ;

							$oData = array();
							$oData["ficheDePoste_intitule"] = $this->postGetValue ("fiche_intitule",0) ;
							$oData["ficheDePoste_missions"] = $this->postGetValue ("fiche_mission",0) ;
							$oData["ficheDePoste_activite"] = $this->postGetValue ("fiche_activite",0) ;
							$oData["ficheDePoste_encadrement"] = $this->postGetValue ("fiche_encadrement",0) ;
							$oData["ficheDePoste_diplome"] = $this->postGetValue ("fiche_diplome",0) ;
							$oData["ficheDePoste_domaine"] = $this->postGetValue ("fiche_niveau",0) ;

							if ($iFichePosteId == 0){
								$this->Accueil->insertFichePosteFinale($oData);
							} else {
								$this->Accueil->updateFichePosteFinale($oData, $iFichePosteId);
							}

							redirect("accueil/outils/fiche-de-poste/liste");

					break;

				case 'liste':

					$toUserAutorise = array (' 332026','307381','287385','355857','332026','357018','321684','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {
		
							$suc = $this->postGetValue ("suc",0) ;
							$oData['iMatriculeDRHA']  = $oUser['im'];
							$toFicheDePoste = $this->Accueil->getAllFichePoste();
							$oData['toFicheDePoste']  = $toFicheDePoste;
							$oData['suc']   = $suc;
							$this->load_my_view_Common('ficheDePoste/listeFicheDePoste.tpl',$oData, 900);
					} else {
						die(utf8_decode("Cette page est strictement reservée au points focaux. Merci!"));
					}
					break;
			}

		} else {
			redirect("cv/index");
		}
    	
    }

	/** 
	* modification fiche de poste
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @return view
	*/
	public function modification($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iModuleId = 9;
	
		if($iRet == 1){	

	    	$oData['menu'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			switch ($_zHashUrl) {

				case 'ajax':

					
					$iMatricule	= $this->postGetValue ("iMatricule",'') ;
					$iCin	= $this->postGetValue ("iCin",'') ;

					$toUserAutorise = array (' 332026','307381','351101','355857','355857','355857','355857','266661','351275','347592','360085','346035',
					'318697','327024','309458','289399','287385','332026','382791','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {
		
							global $oSmarty ; 

							$toGetUserFichePoste = $this->Gcap->getUserFichePoste();
							$toGetUserMission = $this->Gcap->getUserMission();
							$toGetUserActivite = $this->Gcap->getUserActivite();
							$toGetUserEncadrement = $this->Gcap->getUserEncadrement();
							$toGetUserExigence = $this->Gcap->getUserExigence();

							$oCandidat = $this->Gcap->get_candidat_by_cin_matricule ($iCin, $iMatricule);

							$oSmarty->assign('zBasePath', base_url());
							$oSmarty->assign('toGetUserFichePoste', $toGetUserFichePoste);
							$oSmarty->assign('toGetUserMission', $toGetUserMission);
							$oSmarty->assign('toGetUserActivite', $toGetUserActivite);
							$oSmarty->assign('toGetUserEncadrement', $toGetUserEncadrement);
							$oSmarty->assign('toGetUserExigence', $toGetUserExigence);
							$oSmarty->assign('oCandidat', $oCandidat);
							$zInfoUser = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "accueil/fiche-de-poste-modification.tpl" );
							echo $zInfoUser ; 
							
					} else {
						die(utf8_decode("Cette page est strictement reservée au points focaux. Merci!"));
					}
					break;

				case 'saveFichePoste':
		
							$iUserId = $this->postGetValue ("iUserId",0) ;
							$iFichePosteId = $this->postGetValue ("iFichePosteId",0) ;
							$iBoucleMission = $this->postGetValue ("iIncrement_b",0) ;
							$iBoucleActivite = $this->postGetValue ("iIncrement_c",0) ;
							$iBoucleEncadrement = $this->postGetValue ("iIncrement_d",0) ;
							$iBoucleExigence = $this->postGetValue ("iIncrement_e",0) ;

							$iReturnAgent = $this->Gcap->setFicheDePoste($iUserId);

							if ($iReturnAgent == 1) {

									$toGetUserFichePoste = $this->Gcap->getUserFichePoste($iUserId);
									$toGetUserMission = $this->Gcap->getUserMission($iUserId);
									$toGetUserActivite = $this->Gcap->getUserActivite($iUserId);
									$toGetUserEncadrement = $this->Gcap->getUserEncadrement($iUserId);
									$toGetUserExigence = $this->Gcap->getUserExigence($iUserId);

									
									$oFichePoste = array();
									$oFichePoste['fichePoste_intitule'] = $_POST['question_a'];
									$this->Gcap->updateFicheDePoste($oFichePoste, $iFichePosteId);

									/**** Mission ****/

									$toAllModifMission = array();
									if (sizeof ($toGetUserMission)>0){
										foreach ($toGetUserMission as $oGetUserMission){
											array_push($toAllModifMission, $oGetUserMission["missionPoste_id"]);
										}
									}

									$toModifMission = array();
									for($iIncrementM=1;$iIncrementM<=$iBoucleMission;$iIncrementM++){
										//echo "miditra" . $iIncrementM . " --" . "identifiant_b_" . $iIncrementM . " --";
										$oData = array();
										if(isset($_POST["identifiant_b_" . $iIncrementM]) && ($_POST["identifiant_b_" . $iIncrementM]!='')){
											array_push ($toModifMission, $_POST["identifiant_b_" . $iIncrementM]);
											$oData["missionPoste_text"] = $_POST["question_b_" . $iIncrementM] ;
											$this->Gcap->updateMission($oData, $_POST["identifiant_b_" . $iIncrementM]);
										} else {
											if ($_POST["question_b_" . $iIncrementM] != ""){
												$oData["missionPoste_fichePosteId"] = $iFichePosteId ; 
												$oData["missionPoste_userId"] = $iUserId ; 
												$oData["missionPoste_text"] = $_POST["question_b_" . $iIncrementM] ; 
												$this->Gcap->insertMission($oData);
											}
										}
									}

									if (sizeof ($toModifMission)>0){
										foreach ($toAllModifMission as $iModifSingle){
											if (!in_array($iModifSingle, $toModifMission)){
												$this->Gcap->deleteMission($iModifSingle);
											}
										}
									}

									/************ Fin mission ************************/


									/**** Activite ****/

									$toAllModifActivite = array();
									if (sizeof ($toGetUserActivite)>0){
										foreach ($toGetUserActivite as $oGetUserActivite){
											array_push($toAllModifActivite, $oGetUserActivite["activitePoste_id"]);
										}
									}

									$toModifActivite = array();
									for($iIncrementA=1;$iIncrementA<=$iBoucleActivite;$iIncrementA++){
										$oData = array();
										if(isset($_POST["identifiant_c_" . $iIncrementA]) && ($_POST["identifiant_c_" . $iIncrementA]!='')){
											array_push ($toModifActivite, $_POST["identifiant_c_" . $iIncrementA]);
											$oData["activitePoste_text"] = $_POST["question_c_" . $iIncrementA] ; 
											$this->Gcap->updateActivite($oData, $_POST["identifiant_c_" . $iIncrementA]);
										} else {
											if ($_POST["question_c_" . $iIncrementA] != ""){
												$oData["activitePoste_fichePosteId"] = $iFichePosteId ; 
												$oData["activitePoste_userId"] = $iUserId ; 
												$oData["activitePoste_text"] = $_POST["question_c_" . $iIncrementA] ; 
												$this->Gcap->insertActivite($oData);
											}
										}
									}

									if (sizeof ($toModifActivite)>0){
										foreach ($toAllModifActivite as $iModifSingle){
											if (!in_array($iModifSingle, $toModifActivite)){
												$this->Gcap->deleteActivite($iModifSingle);
											}
										}
									}

									/************ Fin activite ************************/

									/**** Encadrement ****/

									$toAllModifEncadrement = array();
									if (sizeof ($toGetUserEncadrement)>0){
										foreach ($toGetUserEncadrement as $oGetUserEncadrement){
											array_push($toAllModifEncadrement, $oGetUserEncadrement["encadrementPoste_id"]);
										}
									}
									
									/*echo "<pre>";
									print_r ($toAllModifMission);
									echo "</pre>";*/

			

									$toModifEncadrement = array();
									for($iIncrementE=1;$iIncrementE<=$iBoucleEncadrement;$iIncrementE++){
										$oData = array();
										if(isset($_POST["identifiant_d_" . $iIncrementE]) && ($_POST["identifiant_d_" . $iIncrementE]!='')){
											array_push ($toModifEncadrement, $_POST["identifiant_d_" . $iIncrementE]);
											$oData["encadrementPoste_text"] = $_POST["question_d_" . $iIncrementE] ; 
											$this->Gcap->updateEncadrement($oData, $_POST["identifiant_d_" . $iIncrementE]);
										} else {
											if ($_POST["question_d_" . $iIncrementE] != ""){
												$oData["encadrementPoste_fichePosteId"] = $iFichePosteId ; 
												$oData["encadrementPoste_userId"] = $iUserId ; 
												$oData["encadrementPoste_text"] = $_POST["question_d_" . $iIncrementE] ; 
												$this->Gcap->insertEncadrement($oData);
											}
										}
									}

									if (sizeof ($toModifEncadrement)>0){
										foreach ($toAllModifEncadrement as $iModifSingle){
											if (!in_array($iModifSingle, $toModifEncadrement)){
												$this->Gcap->deleteEncadrement($iModifSingle);
											}
										}
									}

									/************ Fin encadrement ************************/


									/**** Exigence ****/

									$toAllModifExigence = array();
									if (sizeof ($toGetUserExigence)>0){
										foreach ($toGetUserExigence as $oGetUserExigence){
											//array_push($toAllModifExigence, $oGetUserExigence["exigencePoste_id"]);
										}
									}

									$toModifExigence = array();
									for($iIncrementF=1;$iIncrementF<=$iBoucleExigence;$iIncrementF++){
										$oData = array();
										if(isset($_POST["identifiant_e_" . $iIncrementF]) && ($_POST["identifiant_e_" . $iIncrementF]!='')){
											array_push ($toModifExigence, $_POST["identifiant_e_" . $iIncrementF]);
											$oData["exigencePoste_niveau"] = $_POST["question_e_1_" . $iIncrementF] ; 
											$oData["exigencePoste_experience"] = $_POST["question_e_2_" . $iIncrementF] ; 
											$this->Gcap->updateExigence($oData, $_POST["identifiant_e_" . $iIncrementF]);
										} else {

											if (($_POST["question_e_1_" . $iIncrementF]!="") || ($_POST["question_e_2_" . $iIncrementF] != '')){
												$oData["exigencePoste_fichePosteId"] = $iFichePosteId ; 
												$oData["exigencePoste_userId"] = $iUserId ; 
												$oData["exigencePoste_niveau"] = $_POST["question_e_1_" . $iIncrementF] ; 
												$oData["exigencePoste_experience"] = $_POST["question_e_2_" . $iIncrementF] ; 
												$this->Gcap->insertExigence($oData);
											}
										}
									}

									if (sizeof ($toModifExigence)>0){
										foreach ($toAllModifExigence as $iModifSingle){
											if (!in_array($iModifSingle, $toModifExigence)){
												$this->Gcap->deleteExigence($iModifSingle);
											}
										}
									}

									/************ Fin exigence ************************/

									$iRedirect	= $this->postGetValue ("iRedirect",0) ;
									if ($iRedirect == 1) {
										redirect("accueil/outils/fiche-de-poste/liste?suc=1");
									} else {
										redirect("accueil/communique?suc=1");
									}
							
							} else {

								$toFormulaire =  $_REQUEST;

								/*print_r ($_REQUEST);
								die();*/
								$toFormulaire['fichePoste_userId'] = $iUserId;

								$this->Gcap->insertFichePoste($toFormulaire);
								redirect("accueil/communique?suc=1");
							}

							//die();
							
					
					break;

				case 'saisi':

					$toUserAutorise = array (' 332026','307381','351101','355857','355857','355857','355857','266661','351275','347592','360085','346035',
					'318697','327024','309458','289399','287385','352600','332026','382791','355577');

					if (in_array($oUser['im'], $toUserAutorise)) {
		
							$suc = $this->postGetValue ("suc",0) ;
							$oData['menu']  = 48;
							$oData['iMatriculeDRHA']  = $oUser['im'];
							$oData['suc']   = $suc;
							$iModuleId = 11;
							$this->load_my_view_Common('accueil/fichePosteSaisiManuel.tpl',$oData, 21);
					} else {
						die(utf8_decode("Cette page est strictement reservée au points focaux. Merci!"));
					}
					break;
			}

		} else {
			redirect("cv/index");
		}
    }
	
	/** 
	* Vérification 
	*
	* @return view
	*/
	private function verification(){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$toUserAutorise= array('307381','351101','355857','332026',' 332026','221913','350506','351273','288691','312044','278536','276059','288635','327655','353694','323541','300958','295865','353977','174011','012245','352895','312702','293354','321328','276469','354801','319334','209208','354808','354808','308718','291192','355577');

			if (in_array($oUser['im'], $toUserAutorise)) {

				$iModuleId = 1;
			
				$toArrayAffiche = array();
				if($iRet == 1){	

					$oData = array();
					
					$oData['oUser'] = $oUser;
					$oData['oCandidat'] = $oCandidat;
					$oData['menu'] = 58;

					if (isset($_FILES['fichierExcel']) && trim($_FILES['fichierExcel']['name']) != "") {

						require(APPLICATION_PATH ."/Classes/PHPExcel.php");

						error_reporting(0);
						ini_set('display_errors', TRUE);
						ini_set('display_startup_errors', TRUE);
						date_default_timezone_set('Europe/London');

						define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
						
						$oPhpExcel = new PHPExcel();

						$zFichier = $_FILES['fichierExcel']['tmp_name'];

						$toExtension = explode(".",$_FILES['fichierExcel']['name']);

						if($toExtension[1]!="xlsx" && $toExtension[1]!="xls"){

							die("Veuiller entrer un fichier Excel");

						} else {

							//$zFileInput = $zFichier ; 
				
							$zFileName = utf8_decode($_FILES["fichierExcel"]["name"]);
							$zFileName = str_replace(" ","_",$zFileName);
							$zFileName = strtr($zFileName, 
							'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
							'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

							@move_uploaded_file($zFichier, APPLICATION_PATH . '/ASCAL/'.$zFileName);

							$zFileInput = APPLICATION_PATH . '/ASCAL/'.$zFileName;

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
								if ($iBoucle > 3) {

										$toBoucleData1 = $toBoucleData[0];
										$oInsert = array();
										if ($toBoucleData1[0]!="" || $toBoucleData1[1]!=""){
											
											$oInsert['color'] = '';
											$oInsert['parentheseNom'] = '';
											$oInsert['parenthesePrenom'] = '';
											$oInsert['numero'] = $toBoucleData1[0];
											$oInsert['matricule'] = $toBoucleData1[1];
											$oInsert['nom'] = $toBoucleData1[2];
											$oInsert['prenom'] = $toBoucleData1[3];
											$oInsert["photo"] = "http://rohi.mef.gov.mg:8088/ROHI/assets/upload/default.jpg" ;

											if($toBoucleData1[0]==''){
												$oInsert['color'] = '#ffb1b1!important';
												$oAgent = $this->Gcap->getCandidatNomPrenom(trim($oInsert['nom']),trim($oInsert['prenom']));
												if(sizeof($toAgent)>0){
													$oInsert['color'] = '';
												}
											} else {
												
												$iSize = strlen($toBoucleData1[1]);
												$oInsert['color'] = '#ffb1b1!important';
												$oAgent = array();
												switch ($iSize){
													case '6':
														$oAgent = $this->Gcap->getCandidatCinMatricule('',trim($toBoucleData1[1]),trim($oInsert['nom']),trim($oInsert['prenom']));
														break;

													default:
														$oAgent = $this->Gcap->getCandidatCinMatricule(trim($toBoucleData1[1]),'',trim($oInsert['nom']),trim($oInsert['prenom']));
														break;
												}

												if(sizeof($oAgent)>0){
													$oInsert['color'] = '';
												} else {
													switch ($iSize){
														case '6':
															$oAgentMatricule = $this->Gcap->getCandidatCinMatricule('',trim($toBoucleData1[1]));
															break;

														default:
															$oAgentMatricule = $this->Gcap->getCandidatCinMatricule(trim($toBoucleData1[1]),'');
															break;
													}

													if(sizeof($oAgentMatricule)>0){
														$oInsert['parentheseNom'] = $oAgentMatricule[0]->nom;
														$oInsert['parenthesePrenom'] = $oAgentMatricule[0]->prenom;
													}
												}
											}
											
											$oInsert['discipline'] = $toBoucleData1[4];
											$oInsert['entite'] = $toBoucleData1[5];
											//$oInsert['photo'] = $toBoucleData1[6];

											if(sizeof($oAgent)>0){
												if ($oAgent[0]->type_photo != ''){
													$oInsert["photo"] = "http://rohi.mef.gov.mg:8088/ROHI/assets/upload/" . $oAgent[0]->id . "." . $oAgent[0]->type_photo  ;
												} else {
													$oInsert["photo"] = "http://rohi.mef.gov.mg:8088/ROHI/assets/upload/default.jpg" ;
												}
											}

											array_push($toArrayAffiche, $oInsert);
										}
										
								}
							}
						}
					}

					$oData['toArrayAffiche'] = $toArrayAffiche;
					$this->load_my_view_Common('accueil/form_search.tpl',$oData,1);
			}
		} else {
			die("Accès réservé ASCAL et Responsable Discipline!");
		}

		echo "1";
	}

	/** 
	* Listing des agents du MEF 
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @return view
	*/
	public function cvAll($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 400;

			if($oUser['id'] == '10215'){
				$oUser['im'] = "AZERTY";
			}

			$toUserAutorise = array (	'332026',
										'353108',
										'322060',
										'355857',
										'322509',
										'293785',
										'295046',
										'438353'
			);
			
			if (in_array($oUser['im'], $toUserAutorise)) {
				
				switch ($_zHashUrl) {

					case 'ajax':
						
						$this->load->model('fonctionsSelectGlobales', 'select');
						$iNombreTotal = 0;
						$toGetListe = $this->select->getSimpleListJoin($iNombreTotal,'candidat', "matricule, candidat.nom, prenom, cin,CONCAT(departement.libele,direction.libele) as localite",0);
						
						$oRequest = $_REQUEST;
						$oDataAssign = array();
							//print_r($toGetListe);die;
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe->id;
							$oDataTemp[] = $oGetListe->photo;
							$oDataTemp[] = $oGetListe->matricule. "<br><br>" . $oGetListe->sanction;
							$oDataTemp[] = $oGetListe->cin;
							$oDataTemp[] = $oGetListe->nom;
							$oDataTemp[] = $oGetListe->prenom;
							$oDataTemp[] = $oGetListe->phone . "<br><br>" . $oGetListe->email;
							//$oDataTemp[] = $oGetListe->sanction;
			
							$zLocalite  = "";
							if($oGetListe->path != ""){
								$zLocalite .= "<br><br>-" . $oGetListe->path;
							}
							if($oGetListe->porte != ""){
								$zLocalite .= "- (Porte :" . $oGetListe->porte.')';
							}

							if($oGetListe->ministere_payeur != ""){
								$zLocalite .= "<br><br><p style='font-size:10px'>- Payé par :($oGetListe->ministere_payeur) " . $this->GestionStructure->getMinistereLibelle($oGetListe->ministere_payeur).'</p>';
							}
							if($oGetListe->ministere_employeur != ""){
								$zLocalite .= "<br><br><p style='font-size:10px'>- AUGURE  :($oGetListe->ministere_employeur)	" . $this->GestionStructure->getUadmLibelle($oGetListe->uadm).'</p>';
							}

							$oDataTemp[] = $zLocalite;
							//$oDataTemp[] = substr($this->CandidatDiplome->getDiplome($oGetListe->id)["diplome"],0,50);
							$oDataTemp[] =  $oGetListe->diplome;
							
							$zAction = '<a href="'.base_url().'cv2/mon_cv?id='.$oGetListe->id.'" target="_blank" title="Voir CV" alt="Voir CV"><i style="font-size:22px;" class="fa fa-list-alt"></i></a>' ; 
							$zAction = $zAction . '&nbsp;&nbsp;'. '<a href="'.base_url().'cv/fpdf_cv/'.$oGetListe->id.'" target="_blank" title="Imprimer CV" alt="Imprimer CV"><i style="font-size:22px;" class="fa fa-print"></i></a>' ; 
							$oDataTemp[] = $zAction;
							
							
							$oDataAssign[] = $oDataTemp;
						}

						$taJson = array(
										"draw"            => intval( $oRequest['draw'] ),
										"recordsTotal"    => intval( $iNombreTotal ),
										"recordsFiltered" => intval( $iNombreTotal ),
										"data"            => $oDataAssign
									);
						echo json_encode($taJson);

					break;


					default:
					$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

					$this->load_my_view_Common('accueil/annuaire.tpl',$oData, 500);
					break;
				}
			} else {
				redirect("cv/index");
			}

			
    	}
	}

	/** 
	* Listing des photos des agents dand ROHI
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @return view
	*/
	public function photoAll($_zHashModule = FALSE, $_zHashUrl = FALSE) {

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 400;

			if($oUser['id'] == '10215'){
				$oUser['im'] = "AZERTY";
			}

			$toUserAutorise = array (' 332026','307381','351101','355857','332026','409711','357018','377036','AZERTY','355577');

			if (in_array($oUser['im'], $toUserAutorise)) {

				switch ($_zHashUrl) {

					case 'ajax':

						$this->load->model('fonctionsSelectGlobales', 'select');
						$iNombreTotal = 0;
						$toGetListe = $this->select->getSimpleListJoinPhoto($iNombreTotal,'candidat', "matricule, candidat.nom, prenom, cin,CONCAT(departement.libele,direction.libele) as localite",0);

						$oRequest = $_REQUEST;
						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe->id;
							$oDataTemp[] = $oGetListe->photo;
							$oDataTemp[] = $oGetListe->matricule;
							$oDataTemp[] = $oGetListe->cin;
							$oDataTemp[] = $oGetListe->nom;
							$oDataTemp[] = $oGetListe->prenom;
							$oDataTemp[] = $oGetListe->sanction;
							$oDataTemp[] = $oGetListe->localite;

							$zAction = '<a href="'.base_url().'cv2/mon_cv?id='.$oGetListe->id.'" target="_blank" title="Voir CV" alt="Voir CV"><i style="font-size:22px;" class="fa fa-list-alt"></i></a>' ; 
							$oDataTemp[] = $zAction;
							
							
							$oDataAssign[] = $oDataTemp;
						}

						$taJson = array(
										"draw"            => intval( $oRequest['draw'] ),
										"recordsTotal"    => intval( $iNombreTotal ),
										"recordsFiltered" => intval( $iNombreTotal ),
										"data"            => $oDataAssign
									);
						echo json_encode($taJson);

					break;


					default:
					$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

					$this->load_my_view_Common('accueil/photoAnnuaire.tpl',$oData, 500);
					break;
				}
			} else {
				redirect("cv/index");
			}

			
    	}
	}

	/** 
	* mise à jour fiche de poste d'un agent
	*
	* @return view
	*/
	public function saveCandidatFicheDePoste(){

		$iUserId		= $this->postGetValue ("iUserId",'') ;
		$iSearchFicheDePoste = $this->postGetValue ("iSearchFicheDePoste",'') ;

		$oData = array();
		$oData['fichePosteId'] = $iSearchFicheDePoste ; 

		$this->candidat->update($oData,$iUserId);
				
		echo "1";
	}
}