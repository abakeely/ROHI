<?php
/**
* @package ROHI
* @subpackage Reclassement
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Reclassement extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->sessionStartCompte();

		$this->load->model('reclassement_sgrh_model','Reclassement');
		$this->load->model('gcap_gcap_model','Gcap');
	}


	public function getTableSearch(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

		$zType = 1;

		if (isset ($_GET['zType']))
        {
            $zType = $_GET['zType'] ;
        }

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

		$toListe = $this->Reclassement->get_all_Table_Reclassement($zTerm, $zType);

		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe[$zType.'_id'];
            $toTemp["text"] = $oListe[$zType.'_libelle'] ;
            $toRes []       = $toTemp ;
        }

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
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

	public function getInfoReclassement($_iReclassementId) {
		global $oSmarty ; 

		$iUserId	= $this->postGetValue ("iUserId",-1) ;
		$iReclassementId = 0;
		$iNombreTotal = 0;
		$oInfoReclassement = $this->Reclassement->getInfoReclassement($iUserId, $iReclassementId,$iNombreTotal) ; 
		$oPiecesJointesManquante = $this->Reclassement->getPieceJointeReclassement($_iReclassementId);
		$oCircuitReclassement = $this->Reclassement->getCircuitReclassement($_iReclassementId);
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oInfoReclassement",$oInfoReclassement);
		$oSmarty->assign("oPiecesJointesManquante",$oPiecesJointesManquante);
		$oSmarty->assign("oCircuitReclassement",$oCircuitReclassement);
		$zReturn = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getVisualisationUser.tpl" );
		
		echo $zReturn ;  
	} 


	public function getModificationReclassement($_iReclassementId) {
		global $oSmarty ; 

		$this->load->model('province_model','Province');
		$toProvince = $this->Province->get_province_by_pays_id(2);

		$this->load->model('region_model','Region');
		$toRegion = $this->Region->get_region_by_province_id();

		$this->load->model('district_model','District');
		$toDistrict = $this->District->get_district_by_region_id();

		$this->load->model('departement_model','Departement');
		$oDepartement = $this->Departement->get_departement();

		$iUserId	= $this->postGetValue ("iUserId",-1) ;
		$iReclassementId = 0;
		$iNombreTotal = 0;
		$oInfoReclassement = $this->Reclassement->getInfoReclassement($iUserId, $iReclassementId,$iNombreTotal) ; 
		$oPiecesJointesManquante = $this->Reclassement->getPieceJointeReclassement($_iReclassementId);
		$oCircuitReclassement = $this->Reclassement->getCircuitReclassement($_iReclassementId);

		/*echo "<pre>";
		print_r ($oInfoReclassement);
		echo "</pre>";*/


		$oCandidat = $this->Gcap->get_candidat_object($iUserId);

		$iDepartementId = $oCandidat[0]->departement ;  
		$iDirectionId = $oCandidat[0]->direction;
		$iServiceId = $oCandidat[0]->service;

		


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
		$oSmarty->assign("oDepartement",$oDepartement);
		$oSmarty->assign("oDirection",$oDirection);
		$oSmarty->assign("oService",$oService);
		$oSmarty->assign("oDivision",$oDivision);
		$oSmarty->assign("oCandidat",$oCandidat);
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oInfoReclassement",$oInfoReclassement);
		$oSmarty->assign("oPiecesJointesManquante",$oPiecesJointesManquante);
		$oSmarty->assign("oCircuitReclassement",$oCircuitReclassement);
		$oSmarty->assign("iAnnee",date("Y"));
		$oSmarty->assign("toProvince",$toProvince);
		$zReturn = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getModifReclassementUser.tpl" );
		
		echo $zReturn ;  
	} 



	public function getMajPieceJointe($_iReclassementId) {
		global $oSmarty ; 

		$iUserId	= $this->postGetValue ("iUserId",-1) ;
		$iReclassementId = 0;
		$iNombreTotal = 0;
		$oInfoReclassement = $this->Reclassement->getInfoReclassement($iUserId, $iReclassementId,$iNombreTotal) ; 
		$oPiecesJointes = $this->Reclassement->getAllPJReclassement($_iReclassementId, "");
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oInfoReclassement",$oInfoReclassement);
		$oSmarty->assign("oPiecesJointes1",$oPiecesJointes);
		$oSmarty->assign("iReclassementId",$_iReclassementId);
		$zReturn = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getPjUpdateUser.tpl" );
		
		echo $zReturn ;  
	} 

	public function getInstitut(){

		global $oSmarty ; 

		$zGetInstitut = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getInstitut.tpl" );
		
		echo $zGetInstitut ;  
	}

	public function getDiplome(){

		global $oSmarty ; 

		$zGetDiplome = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getDiplome.tpl" );
		
		echo $zGetDiplome ;  
	}


	public function getMajSuiviDossier($_iReclassementId) {
		global $oSmarty ; 

		$iUserId	= $this->postGetValue ("iUserId",-1) ;
		$iReclassementId = 0;
		$iNombreTotal = 0;
		$oInfoReclassement = $this->Reclassement->getInfoReclassement($iUserId, $iReclassementId,$iNombreTotal) ; 
		$oCircuitDossier = $this->Reclassement->getAllCircuitDossier($_iReclassementId, "");
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oInfoReclassement",$oInfoReclassement);
		$oSmarty->assign("oCircuitDossier1",$oCircuitDossier);
		$oSmarty->assign("iReclassementId",$_iReclassementId);
		$zReturn = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getCircuitUpdateUser.tpl" );
		
		echo $zReturn ;  
	} 

	public function getInfoPieceJointe($_iReclassementId) {
		global $oSmarty ; 

		$iUserId	= $this->postGetValue ("iUserId",-1) ;
		$iReclassementId = 0;
		$iNombreTotal = 0;
		$oInfoReclassement = $this->Reclassement->getInfoReclassement($iUserId, $iReclassementId,$iNombreTotal) ; 
		$oPiecesJointes = $this->Reclassement->getPieceJointeReclassement($_iReclassementId, "");
		
		$oSmarty->assign("zBasePath",base_url());
		$oSmarty->assign("oInfoReclassement",$oInfoReclassement);
		$oSmarty->assign("oPiecesJointes",$oPiecesJointes);
		$oSmarty->assign("iReclassementId",$_iReclassementId);
		$zReturn = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "reclassement/getPjUser.tpl" );
		
		echo $zReturn ;  
	} 


	public function save($_zHashModule = FALSE, $_zHashUrl = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

			switch ($_zHashUrl) {
			
				case 'reclassement':
				
					$oData = array();
					
					$iReclasssementId	= $this->postGetValue ("iReclasssementId",0) ;
					$iInstituId			= $this->postGetValue ("iInstituId",0) ;
					$iDiplomeId			= $this->postGetValue ("iDiplomeId",0) ;
					$iUserId			= $this->postGetValue ("iUserId",-1) ;
					$zDomaine			= $this->postGetValue ("zDomaine",'') ;
					$zDateEnvoi			= $this->date_fr_to_en($this->postGetValue ("zDateEnvoi"),'/','-'); 
					$iTypeDossierId		= $this->postGetValue ("iTypeDossierId",0) ;
					$iDepartementId		= $this->postGetValue ("iDepartementId",0) ;
					$iDirectionId		= $this->postGetValue ("iDirectionId",0) ;
					$iServiceId			= $this->postGetValue ("iServiceId",0) ;
					
					$iResponsableId		= $this->postGetValue ("iResponsableId",0) ;
					$iAnneeReclassement	= $this->postGetValue ("iAnneeReclassement",0) ;
					$iDivisionId		= $this->postGetValue ("iDivisionId",0) ;
					$iManuel			= $this->postGetValue ("iManuel",0) ;
					$iCategOrig			= $this->postGetValue ("iCategOrig",0) ;
					$iCategAccueil		= $this->postGetValue ("iCategAccueil",0) ;
					$zSignataireId		= $this->postGetValue ("zCandidat",'') ;
					$zAutoriteManuel	= $this->postGetValue ("zAutoriteManuel",'') ;

					$oData['reclassement_responsableUserId'] = $oUser['id'];
					$oData['reclassement_dateArrivee'] = $zDateEnvoi;
					$oData['reclassement_session'] = $iAnneeReclassement;
					$oData['reclassement_typeReclassementId'] = $iTypeDossierId;
					$oData['reclassement_userId'] = $iUserId;
					$oData['reclassement_dateEnvoi'] = $zDateEnvoi;
					$oData['reclassement_institutId'] = $iInstituId;
					$oData['reclassement_diplomeId'] = $iDiplomeId;
					$oData['reclassement_responsableUserId'] = $iResponsableId;
					$oData['reclassement_domaine'] = $zDomaine;
					$oData['reclassement_categorieOrigine'] = $iCategOrig;
					$oData['reclassement_categorieAccueil'] = $iCategAccueil;
					$oData['reclassement_departementId'] = $iDepartementId;

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

					$zDirection = implode("-",$toDirection);
					$zService = implode("-",$toService);

					$oData['reclassement_directionId']	= $zDirection;
					$oData['reclassement_serviceId']	= $zService;

					/*$oData['reclassement_directionId'] = $iDirectionId;
					$oData['reclassement_serviceId'] = $iServiceId;*/
					if ($iManuel==1){
						$oData['reclassement_userAutoriteId'] = '';
						$oData['reclassement_autoriteSaisi'] = $zAutoriteManuel;
					} else {
						$oData['reclassement_userAutoriteId'] = $zSignataireId;
						$oData['reclassement_autoriteSaisi'] = '';
					}

					if ($iReclasssementId == 0){
						$this->Reclassement->insert($oData);
						redirect("reclassement/gestion/gestion-reclassement/reclassement?iSave=1");
					} else {
						$this->Reclassement->update($oData, $iReclasssementId);
						echo "1";
					}

				break;

				case 'dossiers':
				
					$iReclassementId		= $this->postGetValue ("iReclassementId",0) ;
					$oPiecesJointes = $this->Reclassement->getAllPJReclassement($iReclassementId, "");
					$toPJarray = array();
					
					foreach ($oPiecesJointes as $oPiecesJointes){
						
						if (isset($_POST['pieceJointe_'.$oPiecesJointes->pieceJointe_id]) && $_POST['pieceJointe_'.$oPiecesJointes->pieceJointe_id]==1) {
						
							array_push($toPJarray,$oPiecesJointes->pieceJointe_id);
							$oData = array();
							$oData['reclassPieceJointe_reclassementId'] = $iReclassementId;
							$oData['reclassPieceJointe_pieceJointeId'] = $oPiecesJointes->pieceJointe_id;
							if (isset($_FILES['filePieceJointe_'.$oPiecesJointes->pieceJointe_id]) && trim($_FILES['filePieceJointe_'.$oPiecesJointes->pieceJointe_id]['name']) != "") {
								$oFile = $_FILES['filePieceJointe_'.$oPiecesJointes->pieceJointe_id];
								$zFileName = $oFile['name'];
								$zTmpName = $oFile["tmp_name"];
								@move_uploaded_file($zTmpName, "assets/reclassement/upload/$zFileName");
								
								$oData['reclassPieceJointe_nomFichier'] = $_FILES['filePieceJointe_'.$oPiecesJointes->pieceJointe_id]['name']; 
							}

							if ($oPiecesJointes->reclassPieceJointe_pieceJointeId == $oPiecesJointes->pieceJointe_id){
								$this->Reclassement->updatePJ($oData, $iReclassementId, $oPiecesJointes->pieceJointe_id);
							} else {
								$this->Reclassement->insertPJ($oData);
							}

							
						}
					}

					if (sizeof($toPJarray)> 0){
						$this->Reclassement->deletePJ($iReclassementId, $toPJarray);
					} else {
						$this->Reclassement->deletePJSansArray($iReclassementId);
					}

					echo "1";

				break;


				case 'suivis-et-circuits':
				
					$iReclassementId		= $this->postGetValue ("iReclassementId",0) ;
					$oSuiviCircuit = $this->Reclassement->getAllCircuitDossier($iReclassementId, "");
					$toCircuitDossierarray = array();

					foreach ($oSuiviCircuit as $oSuiviCircuit){
						
						if (isset($_POST['suiviCircuit_'.$oSuiviCircuit->suivi_id]) && $_POST['suiviCircuit_'.$oSuiviCircuit->suivi_id]==1) {
						
							array_push($toCircuitDossierarray,$oSuiviCircuit->suivi_id);
							$oData = array();
							$oData['circuitReclassement_reclassementId'] = $iReclassementId;
							$oData['circuitReclassement_suiviId'] = $oSuiviCircuit->suivi_id;
							$oData['circuitReclassement_date'] = $this->date_fr_to_en($_POST['dateSuivi_'.$oSuiviCircuit->suivi_id],'/','-'); 
							$oData['circuitReclassement_reference'] = $_POST['referenceSuivi_'.$oSuiviCircuit->suivi_id];

							if ($oSuiviCircuit->circuitReclassement_suiviId == $oSuiviCircuit->suivi_id){
								$this->Reclassement->updateSuiviReclassement($oData, $iReclassementId, $oSuiviCircuit->suivi_id);
							} else {
								$this->Reclassement->insertSuiviReclassement($oData);
							}
						}
					}

					if (sizeof($toCircuitDossierarray)> 0){
						$this->Reclassement->deleteSuiviReclassement($iReclassementId, $toCircuitDossierarray);
						$this->Reclassement->updateEncryptSuiviReclassement($iReclassementId);
					} else {
						$this->Reclassement->deleteSuiviReclassementSansArray($iReclassementId);
					}

					echo "1";

				break;

			case 'saveInstitut':
				
					$zInstitut		= $this->postGetValue ("zInstitut",0) ;
					$zSigle			= $this->postGetValue ("zSigle",0) ;
					$zCoordonnee	= $this->postGetValue ("zCoordonnee",0) ;
					
					$oData = array();
					$oData['institut_libelle'] = $zInstitut;
					$oData['institut_sigleLong'] = $zSigle;
					$oData['institut_coordonnee'] = $zCoordonnee; 
					
					$this->Reclassement->insertInstitut($oData);
							
					echo "1";

				break;

			case 'saveDiplome':
				
					$zLibelle		= $this->postGetValue ("zLibelle",0) ;
					
					$oData = array();
					$oData['diplome_libelle'] = $zLibelle;
					
					$this->Reclassement->insertDiplome($oData);
							
					echo "1";

				break;
			
		}
    	
		} else {
			$this->mon_cv();
		}
	}

	public function gestion($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);

			$oData['menu'] = 36;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;
			$oData['iCompteActif'] = $iCompteActif;
			$iReclassementId = 0;

			switch ($_zHashUrl) {

				case 'reclassement':
					
					$oData['menu'] = 86;
					$oData['zTitle'] = "Reclassement" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RECLASSEMENT:
							$oDepartement = $this->Gcap->get_Organisation();
							$oData = $this->toLocaliteAgent($oData, array(),1);
							$oData['oDepartement'] = $oDepartement ; 
							$iSave = $this->postGetValue ("iSave",0) ;
							$oData['iSave']  = $iSave ; 
							$oData['iAnnee'] = date("Y") ; 
							$this->load_my_view_Common('reclassement/dossier.tpl',$oData, $iModuleId);
							break;

						default:
							redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							break;
					}
					
					break;

				case 'archives':
					
					$oData['menu'] = 88;
					$oData['zTitle'] = "Archives" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RECLASSEMENT:
							$zUserId = -1;
							$toInfoReclassement = array();
							$oData['toInfoReclassement'] = $toInfoReclassement ;
							$oData['iAnnee'] = date("Y") ;
							$this->load_my_view_Common('reclassement/dossiers-all-archives.tpl',$oData, $iModuleId);
							break;

						default:
							redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							break;
					}
					
					break;

				case 'statistiques':
					
					$oData['menu'] = 89;
					$oData['zTitle'] = "Statistiques" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RECLASSEMENT:
							
							$iAnnee = $this->postGetValue ("iAnnee",date("Y")) ;
							$toStatParAnnee = $this->Reclassement->statistiqueParAnnee() ; 
							$toStatParDepartementAnnee = $this->Reclassement->statistiqueParDepartement($iAnnee) ; 
							$toStatParDirectionAnnee = $this->Reclassement->statistiqueParDirection($iAnnee) ; 
							$toStatParServiceAnnee = $this->Reclassement->statistiqueParService($iAnnee) ; 
							$oData['toStatParAnnee'] = $toStatParAnnee ;
							$oData['toStatParDepartementAnnee'] = $toStatParDepartementAnnee ;
							$oData['toStatParDirectionAnnee'] = $toStatParDirectionAnnee ;
							$oData['toStatParServiceAnnee'] = $toStatParServiceAnnee ;
							$oData['iAnnee'] = date("Y") ;
							$this->load_my_view_Common('reclassement/statistiques.tpl',$oData, $iModuleId);
							break;

						default:
							redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							break;
					}
					
					break;

				
				case 'dossiers-data':
					
					$oData['menu'] = 85;
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RECLASSEMENT:


							$zUserId = -1;
							$oRequest = $_REQUEST;

							$iNombreTotal = 0;
							$toInfoReclassement = $this->Reclassement->getInfoReclassement($zUserId, $iReclassementId,$iNombreTotal) ; 

							$oDataAssign = array();
							foreach ($toInfoReclassement as $oInfoReclassement){
								
								$oDataTemp=array(); 

								$oDataTemp[] = $oInfoReclassement['matricule'];
								$zNom = "";
								if ($oInfoReclassement['nom'] != "" || $oInfoReclassement['prenom']!=""){
									$zNom = $oInfoReclassement['nom'] . " " . $oInfoReclassement['prenom'];
								} else {
									$zNom = $oInfoReclassement['reclassement_nomPrenom'];

								}
								
								$zSigleAffiche = "";
								if ($oInfoReclassement['sigle_departement'] != ""){
									$zSigleAffiche .= $oInfoReclassement['sigle_departement'];
								}

								if ($oInfoReclassement['sigle_direction'] != "" && $oInfoReclassement['sigle_departement'] != $oInfoReclassement['sigle_direction']){
									$zSigleAffiche .= "/" . $oInfoReclassement['sigle_direction'];
								}

								if ($oInfoReclassement['sigle_service'] != "" && $oInfoReclassement['sigle_direction'] != $oInfoReclassement['sigle_service']){
									$zSigleAffiche .= "/" . $oInfoReclassement['sigle_direction'];
								}
								
								$zNom .= "<span class='showw'>".$zSigleAffiche."</span>";

								$oDataTemp[] = $zNom ; 

								$oDataTemp[] = $oInfoReclassement['sigle_departement'];
								$oDataTemp[] = $oInfoReclassement['sigle_direction'];
								$oDataTemp[] = $oInfoReclassement['sigle_service'];
								//$oDataTemp[] = $oInfoReclassement['sigle_service'];

								$zColonne = "- Date Envoi : ".$this->date_en_to_fr($oInfoReclassement['reclassement_dateEnvoi'],'-','/')."<br/><br/>
											 - Catégorie d'origine : ".$oInfoReclassement['reclassement_categorieOrigine']."<br/><br/>
											 - Catégorie d'accueil : ".$oInfoReclassement['reclassement_categorieAccueil']."<br/><br/>
											 - Domaine : ".$oInfoReclassement['reclassement_domaine']."<br/><br/>";
								$oDataTemp[] = $zColonne;

								switch ($oRequest['iActif']){
									case '1':
										$zAction = '<a title="Consulter" alt="Consulter" href="#" title="" iUserId="'.$oInfoReclassement['user_id'].'" iReclassementId="'.$oInfoReclassement['reclassement_id'].'" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-edit"></i></a>
										<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="'.$oInfoReclassement['reclassement_id'].'" class="action suppr"><i style="font-size:22px;color: #F10610;" class="la la-close"></i></a>' ; 
										$oDataTemp[] = $zAction;
										break;

									
									case '2':
										$zAction = '<a title="fichier-joint" alt="fichier-joint" href="#" title="" iUserId="'.$oInfoReclassement['user_id'].'" iReclassementId="'.$oInfoReclassement['reclassement_id'].'" class="action dialog-join"><i style="font-size:22px;color:#12105A" class="la la-paperclip"></i></a>' ; 
										$oDataTemp[] = $zAction;
										break;

									case '3':
										$zAction = '<a title="Suivi et Circuit" alt="Suivi et Circuit" href="#" title="" iUserId="'.$oInfoReclassement['user_id'].'" iReclassementId="'.$oInfoReclassement['reclassement_id'].'" class="action suivi-circuit"><i style="font-size:22px;color:#12105A" class="la la-exchange"></i></a>' ; 
										$oDataTemp[] = $zAction;
										break;

								}
								
								
								$oDataAssign[] = $oDataTemp;
							}

							$iSave = $this->postGetValue ("iSave",0) ;
							$taJson = array(
											"draw"            => intval( $oRequest['draw'] ),
											"recordsTotal"    => intval( $iNombreTotal ),
											"recordsFiltered" => intval( $iNombreTotal ),
											"data"            => $oDataAssign
										);

							/*echo "<pre>";
							print_r ($taJson);
							echo "</pre>";*/
							echo json_encode($taJson);

							break;
					}
					
					break;


				
				case 'dossiers':
					
					$oData['menu'] = 85;
					$oData['zTitle'] = "les dossiers de reclassement" ; 
					$zMessage = "";

					switch ($iCompteActif)
					{
						case COMPTE_RECLASSEMENT:
							$zUserId = -1;
							$toInfoReclassement = array();//$this->Reclassement->getInfoReclassement($zUserId, $iReclassementId) ; 
							$iSave = $this->postGetValue ("iSave",0) ;
							$oData['toInfoReclassement'] = $toInfoReclassement ;
							$oData['iActif'] = 1 ;
							$oData['iSave'] = $iSave ; 
							$this->load_my_view_Common('reclassement/dossiers-all.tpl',$oData, $iModuleId);
							break;
						
						default:
							redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							break;
					}
					
					break;

				case 'suivis-circuits':
					
					$oData['menu'] = 87;
					$oData['zTitle'] = "suivis et circuits" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RECLASSEMENT:
							$zUserId = -1;
							$toInfoReclassement = $this->Reclassement->getInfoReclassement($zUserId, $iReclassementId) ; 

							$oData['toInfoReclassement'] = $toInfoReclassement ;
							$oData['iActif'] = 3 ;
							$this->load_my_view_Common('reclassement/dossiers-all.tpl',$oData, $iModuleId);
							break;
						
						default:
							redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							break;
					}
					
					break;


				case 'visualisation':
					$oData['menu'] = 83;
					$oData['zTitle'] = "Visualisations" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_AGENT :
							
							$toInfoReclassement = $this->Reclassement->getInfoReclassement($oUser['id'], $iReclassementId) ; 

							
							
							if (sizeof($toInfoReclassement)>0){

								$iIncrement = 0;
								foreach ($toInfoReclassement as $oInfoReclassement){
									$toInfoReclassement[$iIncrement]['oPiecesJointesManquante'] = array();
									$toInfoReclassement[$iIncrement]['oCircuitReclassement'] = array();
									$oPiecesJointesManquante = $this->Reclassement->getPieceJointeReclassement($oInfoReclassement['reclassement_id']);
									$oCircuitReclassement = $this->Reclassement->getCircuitReclassement($oInfoReclassement['reclassement_id']);
									$toInfoReclassement[$iIncrement]['oPiecesJointesManquante'] = $oPiecesJointesManquante;
									$toInfoReclassement[$iIncrement]['oCircuitReclassement'] = $oCircuitReclassement;
									$iIncrement++;
								}

								/*echo "<pre>";
								print_r ($toInfoReclassement);
								echo "</pre>";*/

								$oData['oInfoReclassement'] = $toInfoReclassement ; 
								$oData['iSize'] = sizeof($toInfoReclassement) ; 
								$this->load_my_view_Common('reclassement/visualisation.tpl',$oData, $iModuleId);
							} else {
								redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							}
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
						case COMPTE_ADMIN :

							$zUserId = $this->Reclassement->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
							$toInfoReclassement = $this->Reclassement->getInfoReclassement(-1, $iReclassementId) ; 

							$oData['toInfoReclassement'] = $toInfoReclassement ;
							$this->load_my_view_Common('reclassement/visualisation-hierarchique.tpl',$oData, $iModuleId);
							break;


						case COMPTE_RECLASSEMENT:
							redirect("reclassement/gestion/gestion-reclassement/reclassement");
							break;
					}

					
					break;

				case 'visualisation-data':
					
					$oData['menu'] = 83;
					$oData['zTitle'] = "Vislualisation" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
						case COMPTE_ADMIN :
						case COMPTE_RECLASSEMENT:

							$iUserIdReclass = $this->postGetValue ("iUserIdReclass",'') ;

							if ($iUserIdReclass != ''){
								$zUserId = $iUserIdReclass ; 
							} else {
								$zUserId = $this->Reclassement->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
							}
							$zDate = $this->postGetValue ("zDate",0) ;
							
							$oRequest = $_REQUEST;

							$iNombreTotal = 0;
							$toInfoReclassement = $this->Reclassement->getInfoReclassement($zUserId, $iReclassementId,$iNombreTotal,$zDate) ; 

							$oDataAssign = array();
							foreach ($toInfoReclassement as $oInfoReclassement){
								
								$oDataTemp=array(); 

								$oDataTemp[] = $oInfoReclassement['matricule'];
								if ($oInfoReclassement['nom'] != "" || $oInfoReclassement['prenom']!=""){
									$oDataTemp[] = $oInfoReclassement['nom'] . " " . $oInfoReclassement['prenom'];
								} else {
									$oDataTemp[] = $oInfoReclassement['reclassement_nomPrenom'];
								}
								$oDataTemp[] = $oInfoReclassement['sigle_departement'];
								$oDataTemp[] = $oInfoReclassement['sigle_direction'];
								$oDataTemp[] = $oInfoReclassement['sigle_service'];

								$zColonne = "- Date Envoi : ".$this->date_en_to_fr($oInfoReclassement['reclassement_dateEnvoi'],'-','/')."<br/><br/>
											 - Catégorie d'origine : ".$oInfoReclassement['reclassement_categorieOrigine']."<br/><br/>
											 - Catégorie d'accueil : ".$oInfoReclassement['reclassement_categorieAccueil']."<br/><br/>
											 - Domaine : ".$oInfoReclassement['reclassement_domaine']."<br/><br/>";
								$oDataTemp[] = $zColonne;

								$zAction = '<a title="Consulter" alt="Consulter" href="#" title="" iUserId="'.$oInfoReclassement['user_id'].'" iReclassementId="'.$oInfoReclassement['reclassement_id'].'" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-search"></i></a>
								<a title="fochier-joint" alt="fochier-joint" href="#" title="" iUserId="'.$oInfoReclassement['user_id'].'" iReclassementId="'.$oInfoReclassement['reclassement_id'].'" class="action dialog-join"><i style="font-size:22px;color:#12105A" class="la la-paperclip"></i></a>';

								$oDataTemp[] = $zAction;
										
								
								
								$oDataAssign[] = $oDataTemp;
							}

							$iSave = $this->postGetValue ("iSave",0) ;
							$taJson = array(
											"draw"            => intval( $oRequest['draw'] ),
											"recordsTotal"    => intval( $iNombreTotal ),
											"recordsFiltered" => intval( $iNombreTotal ),
											"data"            => $oDataAssign
										);

							/*echo "<pre>";
							print_r ($taJson);
							echo "</pre>";*/
							echo json_encode($taJson);

							break;
						
						default:
							redirect("reclassement/gestion/gestion-reclassement/notes-et-textes");
							break;
					}
					
					break;

				case 'pieces-jointes':
					$oData['menu'] = 84;
					$oData['zTitle'] = "les pièces jointes" ; 
					$zMessage = "";
					switch ($iCompteActif)
					{
						case COMPTE_AGENT :

							$iReclassementId = 0;
							$oInfoReclassement = $this->Reclassement->getInfoReclassement($oUser['id'], $iReclassementId) ; 
							$oPiecesJointes = $this->Reclassement->getPieceJointeReclassement($iReclassementId, "");
							$oData['oPiecesJointes'] = $oPiecesJointes ; 
							$this->load_my_view_Common('reclassement/pieces-jointes.tpl',$oData, $iModuleId);
							break;

						case COMPTE_RESPONSABLE_PERSONNEL :
						case COMPTE_AUTORITE :
						case COMPTE_EVALUATEUR :
						case COMPTE_ADMIN :
							redirect("reclassement/gestion/gestion-reclassement/visualisation");	
						
							break;


						case COMPTE_RECLASSEMENT:
							$zUserId = -1;
							$toInfoReclassement = $this->Reclassement->getInfoReclassement($zUserId, $iReclassementId) ; 

							$oData['toInfoReclassement'] = $toInfoReclassement ;
							$oData['iActif'] = 2 ;
							$this->load_my_view_Common('reclassement/dossiers-all.tpl',$oData, $iModuleId);
							break;
					}

					
					break;

				
				case 'notes-et-textes':
					$oData['menu'] = 90;
					$oData['zTitle'] = "notes et textes" ; 
					$oData['iActif'] = 2 ;
					$this->load_my_view_Common('reclassement/notes-et-textes.tpl',$oData, $iModuleId);
				break;

				
			}
    	}
	}


	public function delete($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	
			$iReclassementId = $this->postGetValue ("iElementId",0) ; 

			$this->Reclassement->delete_reclassement($iReclassementId);
			redirect("reclassement/gestion/gestion-reclassement/dossiers");
				

		} else {
			$this->mon_cv();
		}
    	
    }


	function load_my_view_Reclassement($zPage,$oData, $_iModuleId){

		global $oSmarty ; 
		global $oDataUser ; 

		$oUser = $oData['oUser'] ;

		$iSessionCompte = $this->getSessionCompte();
		$oData['iSessionCompte'] = $iSessionCompte ; 

		$oData['batimentLibelle'] = "" ; 

		if (isset($oCandidat[0]->candidat_batimentId) && ($oCandidat[0]->candidat_batimentId > 0)){
			$oBatiment = $this->candidat->get_batimentLibelle($oCandidat[0]->candidat_batimentId);
			if (sizeof($oBatiment)>0){
				$oData['batimentLibelle'] = $oBatiment[0]->batiment_libelle ; 
			}
		}

		/* Menu Gauche */
		$toModules = $this->module->get_module($oUser['id']);
		$oCandidat = $this->Gcap->get_by_user_id($oUser['id']);

		$toComptes = $this->Compte->get_by_compte_UserId($oUser['id']);
		
		$oData['iModuleId'] = $_iModuleId ;
		$oData['toModules'] = $toModules ;
		$oData['toComptes'] = $toComptes ;
		$oData['role'] = $oCandidat[0]->fonction_actuel ;

		if ($_iModuleId == FALSE){
			$_iModuleId = 2 ; 
		}

		$oData['iModuleActif'] = $_iModuleId ;

		$oModuleActif = $this->module->get_by_module_id ($_iModuleId);

		/* Menu Header */
		$toMenus = $this->Page->get_Menu($oUser['id'], $_iModuleId, $iSessionCompte);
		$oData['toMenus'] = $toMenus ; 
		$oData['oModuleActif'] = $oModuleActif ;

		$zControllerName =  $this->router->fetch_class();
		$oData['zControllerName'] = strtolower($zControllerName) ;

		/* Les événements */
		$toAllEvent = $this->Agenda->geAllEvenement($oUser['id']);
		$oData['toAllEvent'] = $toAllEvent ;

		$iReclassement1Id = 0;
		$iAfficheMenu = 1;
		if ($iSessionCompte == COMPTE_AGENT) {
			$oInfoReclassement = $this->Reclassement->getInfoReclassement($oCandidat[0]->user_id, $iReclassement1Id) ; 
			if (sizeof($oInfoReclassement)==0){
				$iAfficheMenu = 0;
			}
		}

		$oData['iAfficheMenu'] = $iAfficheMenu ;

		$oDataUser = $oData;

		

		$oSmarty->assign('zHeader', ADMIN_TEMPLATE_PATH . "reclassement/pages/header.page.php");
		$oSmarty->assign('zLeft', ADMIN_TEMPLATE_PATH . "pointage/pages/colonneGauche.page.php");
		$oSmarty->assign('zMenu', ADMIN_TEMPLATE_PATH . "reclassement/pages/menu.page.php");
		$oSmarty->assign('zRight', ADMIN_TEMPLATE_PATH . "pointage/pages/colonneRight.page.php");
		$oSmarty->assign('zFooter', ADMIN_TEMPLATE_PATH . "pointage/pages/footer.page.php");
		$oSmarty->assign('oData', $oData);
		$oSmarty->display( ADMIN_TEMPLATE_PATH . $zPage );


	}


	function importReclassement(){

		$iRow = 1;
		if (($oHandle = fopen(ADMIN_TEMPLATE_PATH."reclassement/reclassement.csv", "r")) !== FALSE) {
			while (($oData = fgetcsv($oHandle, 1000, ";")) !== FALSE) {
				$iColonne = count($oData);
				
				/*
				Institut : data 1
				Diplôme : data 2
				Domaine d'études : data 3
				Noms et prénoms : data 4
				IM : data 5
				Departement : data 6
				Direction: data 7
				Localité envoi diplôme : data 8
				Référence demande authentification départ : data 9
				Date reference départ : data 10
				Référence authentification arrivée : data 11
				Date reference arrivée : data 12
				Référence adéquation Formation/Emploi arrivée : data 13
				Date ref Adequation : data 14
				*/

				$oDataImport = array();

				$iRow++;

				$oDataImport['reclassement_responsableUserId'] = 3221;
				$oDataImport['reclassement_dateArrivee'] = "2015-05-15";
				$oDataImport['reclassement_session'] = "2017";
				$oDataImport['reclassement_typeReclassementId'] = 1;

				$toData = explode(" ",$oData[5]);
				$zMatricule =  $toData[0].$toData[1]; 

				$oUserImport = $this->Reclassement->getUserByMatricule($zMatricule) ; 
				if (sizeof($oUserImport)>0){
					$oDataImport['reclassement_userId'] = $oUserImport[0]['user_id'];
					$oDataImport['reclassement_departementId'] = $oUserImport[0]['departement'];
					$oDataImport['reclassement_directionId']   = $oUserImport[0]['direction'];
					$oDataImport['reclassement_serviceId']     = $oUserImport[0]['service'];
				} else {
					$oDataImport['reclassement_nomPrenom'] = $oData[4];
					
				}
				
				$oDataImport['reclassement_dateEnvoi'] = "2015-05-15";
				$oDataImport['reclassement_institutId'] = $this->Reclassement->getInstitutId(utf8_encode($oData[1]));
				$oDataImport['reclassement_diplomeId'] = $this->Reclassement->getDiplomeId(utf8_encode($oData[2]));
				$oDataImport['reclassement_domaine'] = $oData[3];

				$iReclassementId = $this->Reclassement->insert($oDataImport);
				//$this->Reclassement->updateEncryptReclassement($iReclassementId);

				if ($oData[9] != ''){
					$oDataImportSuivi = array(); 
					$oDataImportSuivi['circuitReclassement_reclassementId'] = $iReclassementId; 
					$oDataImportSuivi['circuitReclassement_suiviId'] = 13 ; 
					$oDataImportSuivi['circuitReclassement_reference'] = utf8_encode($oData[9]); 
					$oDataImportSuivi['circuitReclassement_date'] = $this->date_fr_to_en($oData[10],'/','-');
					$this->Reclassement->insertSuiviReclassement($oDataImportSuivi);
				}

				if ($oData[11] != ''){
					$oDataImportSuivi = array();
					$oDataImportSuivi['circuitReclassement_reclassementId'] = $iReclassementId ; 
					$oDataImportSuivi['circuitReclassement_suiviId'] = 14 ; 
					$oDataImportSuivi['circuitReclassement_reference'] = utf8_encode($oData[11]);
					$oDataImportSuivi['circuitReclassement_date'] = $this->date_fr_to_en($oData[12],'/','-');
					$this->Reclassement->insertSuiviReclassement($oDataImportSuivi);
				}

				if ($oData[13] != ''){
					$oDataImportSuivi = array();
					$oDataImportSuivi['circuitReclassement_reclassementId'] = $iReclassementId ; 
					$oDataImportSuivi['circuitReclassement_suiviId'] = 15 ; 
					$oDataImportSuivi['circuitReclassement_reference'] = utf8_encode($oData[13]); 
					$oDataImportSuivi['circuitReclassement_date'] = $this->date_fr_to_en($oData[14],'/','-');
					$this->Reclassement->insertSuiviReclassement($oDataImportSuivi);
				}
				if ($oData[9] != '' || $oData[11] != '' || $oData[13] != ''){
					$this->Reclassement->updateEncryptSuiviReclassement($iReclassementId);
				}
					
			}
			fclose($oHandle);
		}
	}

}