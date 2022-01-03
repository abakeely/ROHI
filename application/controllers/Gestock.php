<?php
/**
* @package ROHI
* @subpackage Gestock
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Gestock extends MY_Controller {

	/**  
	* Classe qui concerne Gestock
	* @package  ROHI  
	* @subpackage GESTOCK */ 

	public function __construct(){
		parent::__construct();

		$this->sessionStartCompte();
		$this->load->model('gestock_sgrh_model','GeStock');
		define ("COMMANDE_NORMAL",1);
		define ("EXPRESSION_BESOIN",2);

		define ("EN_COURS",1);
		define ("VALIDER",2);
		define ("REFUSER",3);
		define ("LIVRER",4);
		define ("DIRECTION_DRHA",3);
		
		DEFINE ("MENU_ACCUEIL_STOCK", 153);
		DEFINE ("MENU_ENTREE_STOCK", 155);
		DEFINE ("MENU_COMMANDE", 156);
		DEFINE ("MENU_MERCURIALE", 157);
		DEFINE ("MENU_LISTE_PV", 158);
		DEFINE ("MENU_FICHE_PV", 159);
		DEFINE ("MENU_TAUX", 161);
		DEFINE ("MENU_EXPRESSION_BESOIN", 162);
		DEFINE ("MENU_UNITE", 195);
		DEFINE ("MENU_FOURNITURE", 196);
		DEFINE ("MENU_CONTROLE", 164);
		DEFINE ("MENU_GSTOCK", 165);
	}

	/** 
	* recherche fourniture
	*
	* @return Json
	*/
	public function getFourniture(){

		global $oSmarty ;
		
		$zTerm = "aa" ;
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

		if (isset ($_GET['iTypeFournitureId']))
        {
            $iFiltre = $_GET['iTypeFournitureId'] ;
        }

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();


		$toListe = $this->GeStock->getAllListFournitureEnStock($zTerm, $iFiltre);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->fourniture_id;
            $toTemp["text"] = $oListe->fourniture_article ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* recherche consommateur
	*
	* @return Json
	*/
	public function getConsommateurDRHA(){

		global $oSmarty ;
		
		$zTerm = "aa" ;
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

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();


		$toListe = $this->GeStock->getConsommateurDRHA($zTerm, $iFiltre);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->user_id;
            $toTemp["text"] = $oListe->nom . " " . $oListe->prenom ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* accueil
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function accueil($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCompteActif = $this->getSessionCompte();

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	$oData['menu'] = MENU_ACCUEIL_STOCK;
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$zLibelle = "Inventaire permanent" ; 

	    	$oData['zLibelle'] = $zLibelle ; 
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			

				switch ($_zHashUrl) {
					case 'home':
						if ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN )
						{
							$oData['zLibelle'] = $zLibelle ; 
							$oData['zTitle'] = "GeStock - " . $zLibelle ; 
							$oData['zDate'] = date("Y-m-d") ; 
							$this->load_my_view_Common('gestock/accueil.tpl',$oData, $iModuleId);
						} else {
							redirect("gestock/outils/stock/commande");
						}
						break;

					case 'inventaire':
						if ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN )
						{
								$oRequest = $_REQUEST;
								$iNombreTotal = 0;
								$zDate = $this->postGetValue ("zDate",0) ;
								$toGetListe = $this->GeStock->getInfoInventaire($iNombreTotal,$this) ; 

								$oDataAssign = array();
								foreach ($toGetListe as $oGetListe){
									
									$oDataTemp=array(); 

									$oDataTemp[] = $oGetListe['fourniture_id'];
									$oDataTemp[] = $oGetListe['fourniture_article'];
									$oDataTemp[] = $oGetListe['typeUnite_libelle'];
									$oDataTemp[] = $oGetListe['iQuantiteTotal'];
									$oDataTemp[] = $oGetListe['commandePris'] ;

									$iPourcentage = (int)$oGetListe['pourcentage'];

									if ($iPourcentage >= 20){
										$oDataTemp[] = "<span style='color:green'>Correct</span>";
									} elseif (($iPourcentage > 7)  && ($iPourcentage < 20)){
										$oDataTemp[] = "<span style='color:#31b901'>Limite</span>";
									} elseif (($iPourcentage > 0) && ($iPourcentage <= 7) ){ 
										$oDataTemp[] = "<span style='color:#FFA500'>Alerte</span>";
									} elseif ($iPourcentage== 0){ 
										$oDataTemp[] = "<span style='color:red'>Epuisé</span>";
									}
									
									$oDataAssign[] = $oDataTemp;
								}
								$taJson = array(
												"draw"            => intval( $oRequest['draw'] ),
												"recordsTotal"    => intval( $iNombreTotal ),
												"recordsFiltered" => intval( $iNombreTotal ),
												"data"            => $oDataAssign
											);
								echo json_encode($taJson);
							} else {
								redirect("gestock/outils/stock/commande");
							}
						break;

					case 'controle':
						if ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN  || $iCompteActif == COMPTE_AUTORITE)
						{
								$oRequest = $_REQUEST;
								$iNombreTotal = 0;
								$zDate = $this->postGetValue ("zDate",0) ;
								$toGetListe = $this->GeStock->getInfoInventaire($iNombreTotal,$this) ; 

								$oDataAssign = array();
								foreach ($toGetListe as $oGetListe){
									
									$oDataTemp=array(); 

									$oDataTemp[] = $oGetListe['fourniture_id'];
									$oDataTemp[] = $oGetListe['typeFourniture_libelle'];
									$oDataTemp[] = $oGetListe['fourniture_article'];
									$oDataTemp[] = $oGetListe['typeUnite_libelle'];
									$oDataTemp[] = $oGetListe['iQuantiteTotal'];

									$iPourcentage = (int)$oGetListe['pourcentage'];

									if ($iPourcentage >= 20){
										$oDataTemp[] = "<span style='color:green'>Correct</span>";
									} elseif (($iPourcentage > 7)  && ($iPourcentage < 20)){
										$oDataTemp[] = "<span style='color:#31b901'>Limite</span>";
									} elseif (($iPourcentage > 0) && ($iPourcentage <= 7) ){ 
										$oDataTemp[] = "<span style='color:#FFA500'>Alerte</span>";
									} elseif ($iPourcentage== 0){ 
										$oDataTemp[] = "<span style='color:red'>Epuisé</span>";
									}
									
									$oDataAssign[] = $oDataTemp;
								}
								$taJson = array(
												"draw"            => intval( $oRequest['draw'] ),
												"recordsTotal"    => intval( $iNombreTotal ),
												"recordsFiltered" => intval( $iNombreTotal ),
												"data"            => $oDataAssign
											);
								echo json_encode($taJson);
						} else {
							redirect("gestock/outils/stock/commande");
						}
						break;
				}
			
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* redirect
	*
	* @param integer $_iParameters 
	*
	* @return view
	*/
	public function redirect($_iParameters = 1){
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;
		$zDate	= $this->postGetValue ("zDateStock",date("d/m/Y")) ;
		$zDate = $this->date_fr_to_en($zDate,'/','-'); 

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

			$oData = array();

			switch ($_iParameters){

				
				case '1':
					$oData['notification_date'] = date("Y-m-d");
					$oData['notification_userId'] = $oUser['id'];
					$oData['notification_effectuer'] = 1;
					$oData['notification_mois'] = date("m");
					$oData['notification_annee'] = date("Y");
					$this->GeStock->insertNotification($oData);
					redirect("gestock/outils/stock/nouveau-pv");
					break;

				case '2';

					echo "2";
					$toNotification = $this->GeStock->getNotificationMoisEtAnnee($oUser['id']);

					if (sizeof($toNotification)>0){
						$oData['notification_effectuer'] = 0;
						if ($toNotification[0]['notification_dateRappel1']== '' || $toNotification[0]['notification_dateRappel1']== '0000-00-00'){
							$oData['notification_dateRappel1'] = $zDate;
						} else {
							$oData['notification_dateRappel2'] = $zDate;
						}
						$this->GeStock->updateNotification($oData, $toNotification[0]['notification_id']);
						echo "3";
					} else {

						$oData['notification_date'] = date("Y-m-d");
						$oData['notification_userId'] = $oUser['id'];
						$oData['notification_effectuer'] = 0;
						$oData['notification_mois'] = date("m");
						$oData['notification_annee'] = date("Y");
						$oData['notification_dateRappel1'] = $zDate;
						$this->GeStock->insertNotification($oData);
						echo "2";
					}

					break;

			}

		}
	}

	/** 
	* outils
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function outils($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			switch ($_zHashUrl) {
				case 'entree':
					$oData['zLibelle'] = "Entrée en stock" ; 
					$oData['zTitle'] = "GeStock - Entrée en stock" ; 
					$oData['menu'] = MENU_ENTREE_STOCK;
					$this->load_my_view_Common('gestock/entree.tpl',$oData, $iModuleId);
					break;

				case 'unite':
					$oData['zLibelle'] = "Gestion type unité" ; 
					$oData['zTitle'] = "GeStock - Gestion type unité" ; 
					$oData['menu'] = MENU_UNITE;
					$this->load_my_view_Common('gestock/unite.tpl',$oData, $iModuleId);
					break;

				case 'fourniture':
					$oData['zLibelle'] = "Gestion type fourniture" ; 
					$oData['zTitle'] = "GeStock - Gestion type fourniture" ; 
					$oData['menu'] = MENU_FOURNITURE;
					$this->load_my_view_Common('gestock/fourniture.tpl',$oData, $iModuleId);
					break;

				case 'commande':
					$oData['zLibelle'] = "Commande" ; 
					$oData['zTitle'] = "GeStock - Commande" ; 
					$oData['menu'] = MENU_COMMANDE;
					$oData['iCompteActif'] = $iCompteActif;
					$this->load_my_view_Common('gestock/commande.tpl',$oData, $iModuleId);
					break;

				case 'mercuriale':
					$oData['zLibelle'] = "Mecuriale" ; 
					$oData['menu'] = MENU_MERCURIALE;
					$oData['zTitle'] = "GeStock - Mercuriale" ; 
					$this->load_my_view_Common('gestock/mercuriale.tpl',$oData, $iModuleId);
					break;

				case 'inventaire':
					$oData['zLibelle'] = "Inventaire PV" ; 
					$oData['zTitle'] = "GeStock - Inventaire PV" ; 
					$oData['menu'] = MENU_LISTE_PV;
					$this->load_my_view_Common('gestock/inventaire-pv.tpl',$oData, $iModuleId);
					break;

				case 'nouveau-pv':
					$iPvId	= $this->postGetValue ("iPvId",0) ;
					$oData['menu'] = MENU_FICHE_PV;
					$toListePv =  array();
					$oPv =  array();
					$toListeRebut = 0;
					if ($iPvId != 0){
						$oPv = $this->GeStock->getPvId($iPvId);
						$toGetListeArticlePv = $this->GeStock->getListeArticlePv($iPvId) ;
					}

					$toGetListeFourniture = $this->GeStock->getTypeFourniture() ;
					$oData['zLibelle'] = "Nouveau PV" ; 
					$oData['zTitle'] = "GeStock - Nouveau PV" ; 
					$oData['toGetListeFourniture'] = $toGetListeFourniture ;
					$oData['toGetListeArticlePv'] = $toGetListeArticlePv ;
					$oData['iPvId'] = $iPvId ;
					$oData['zDate'] = date("Y-m-d") ;
					$oData['oPv'] = $oPv ;
					$oData['iNombre'] = sizeof($toGetListeArticlePv);
					$this->load_my_view_Common('gestock/nouveau-pv.tpl',$oData, $iModuleId);
					break;

			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* imprimer stock
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function imprimer($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			$iNombreTotal = 0;

			switch ($_zHashUrl) {
				case 'home':
					$zDate = (isset($_POST["zDate"])&&$_POST["zDate"]!='')?$_POST["zDate"]:date("d/m/Y") ;
					$iSetImprimer = $this->postGetValue ("iSetImprimer",0) ;
					$toGetListe = $this->GeStock->getInfoInventaire($iNombreTotal,$this,1) ;
					$this->GeStock->InventairePermanentPdf($toGetListe,$iSetImprimer,$zDate);
					
					break;
				
				case 'entree':
					$toGetListe = $this->GeStock->getListeStock($iNombreTotal,$this,1) ; 	
					$this->GeStock->ListeStockPdf($toGetListe,0);
					break;

				case 'entree-output':
					$toGetListe = $this->GeStock->getListeStock($iNombreTotal,$this,1) ; 
					$this->GeStock->ListeStockPdf($toGetListe,1);
					break;
				
				case 'mercuriale':
					$toGetListe = $this->GeStock->getListeMercuriale($iNombreTotal,$this,1) ; 
					$this->GeStock->ListeMercurialePdf($toGetListe,0);
					break;

				case 'mercuriale-output':
					$toGetListe = $this->GeStock->getListeMercuriale($iNombreTotal,$this,1) ; 
					$this->GeStock->ListeMercurialePdf($toGetListe,1);
					break;
				
				case 'invetaire-pv':
					
					$zCheckList = $this->postGetValue ("CheckList",0) ;
					$toGetListe = $this->GeStock->getListeInventairePv($zCheckList,$iNombreTotal,$this,1) ; 
					$this->GeStock->ListeInventairePvPdf($toGetListe,$this,0);
					break;

				case 'invetaire-pv-output':
					$zCheckList = $this->postGetValue ("CheckList",0) ;
					$toGetListe = $this->GeStock->getListeInventairePv($zCheckList,$iNombreTotal,$this,1) ; 
					$this->GeStock->ListeInventairePvPdf($toGetListe,$this,1);
					break;

				case 'pv-edit':
					$iPvId	= $this->postGetValue ("iPvId",0) ;
					
					$toListePv =  array();
					$oPv =  array();
					$toListeRebut = 0;
					if ($iPvId != 0){
						$oPv = $this->GeStock->getPvId($iPvId);
						$toGetListeArticlePv = $this->GeStock->getListeArticlePv($iPvId) ;
					}

					$this->GeStock->PvEditPdf($oPv,$toGetListeArticlePv,$this,0);
					break;

				case 'pv-edit-output':
					$iPvId	= $this->postGetValue ("iPvId",0) ;
					
					$toListePv =  array();
					$oPv =  array();
					$toListeRebut = 0;
					if ($iPvId != 0){
						$oPv = $this->GeStock->getPvId($iPvId);
						$toGetListeArticlePv = $this->GeStock->getListeArticlePv($iPvId) ;
					}

					$this->GeStock->PvEditPdf($oPv,$toGetListeArticlePv,$this,1);
					break;
				
			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* edition Gestock
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function edit($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			switch ($_zHashUrl) {
				case 'entree':
					$oData['zLibelle'] = "Entrée en stock" ; 
					$oData['zTitle'] = "GeStock - Entrée en stock" ; 
					$oData['menu'] = MENU_ENTREE_STOCK;
					$iFournitureId		= $this->postGetValue ("iFournitureId",'') ;
					$toGetEnteeStock = $this->GeStock->getStockFournitureId($iFournitureId);
					$oData['iNombre'] = sizeof($toGetEnteeStock);
					$oData['zDate'] = date("d/m/Y");
					$oData['toGetEnteeStock'] = $toGetEnteeStock;
					$oData['iFournitureId'] = $iFournitureId;
					$this->load_my_view_Common('gestock/getFicheStock.tpl',$oData, $iModuleId);
					break;

				case 'commande':
					$oData['zLibelle'] = "Fiche commande" ; 
					$oData['zTitle'] = "GeStock - fiche commande" ; 
					$oData['menu'] = MENU_COMMANDE;
					$this->load_my_view_Common('gestock/getFicheCommande.tpl',$oData, $iModuleId);
					break;
				
				case 'new-commande':

					$iCommandeId		= $this->postGetValue ("iCommandeId",'') ;

					$toGetListeCommande = array();
					if ($iCommandeId != ""){
						$toGetListeCommande = $this->GeStock->getListeCommandeFiche($iCommandeId);
					}
					$oData['toGetListeCommande'] = $toGetListeCommande;
					$oData['zLibelle'] = "Fiche commande" ; 
					$oData['zTitle'] = "GeStock - fiche commande" ; 
					$oData['menu'] = MENU_COMMANDE;
					$this->load_my_view_Common('gestock/getNewCommande.tpl',$oData, $iModuleId);
					break;

				case 'new-unite':

					$iTypeUniteId		= $this->postGetValue ("iTypeUniteId",0) ;

					$toGetListeTypeUnite = array();

					if ($iTypeUniteId != 0){
						$toGetListeTypeUnite = $this->GeStock->getTypeUniteId($iTypeUniteId);
					}

					$oData['toGetListeTypeUnite'] = $toGetListeTypeUnite;
					$oData['zLibelle'] = "Fiche unité" ; 
					$oData['iTypeUniteId'] = $iTypeUniteId ; 
					$oData['zTitle'] = "GeStock - fiche unité" ; 
					$oData['menu'] = MENU_COMMANDE;
					$this->load_my_view_Common('gestock/getFicheUnite.tpl',$oData, $iModuleId);
					break;

				case 'new-fourniture':

					$iTypeFournitureId		= $this->postGetValue ("iTypeFournitureId",0) ;

					$toGetListeTypeFourniture = array();

					if ($iTypeFournitureId != 0){
						$toGetListeTypeFourniture = $this->GeStock->getTypeFournitureId($iTypeFournitureId);
					}

					$oData['toGetListeTypeFourniture'] = $toGetListeTypeFourniture;
					$oData['zLibelle'] = "Fiche unité" ; 
					$oData['iTypeFournitureId'] = $iTypeFournitureId ; 
					$oData['zTitle'] = "GeStock - fiche unité" ; 
					$oData['menu'] = MENU_COMMANDE;
					$this->load_my_view_Common('gestock/getFicheFourniture.tpl',$oData, $iModuleId);

					break;

				case 'expression':

					$iFournitureId		= $this->postGetValue ("iFournitureId",'') ;

					$toGetListeCommande = array();
					if ($iFournitureId != ""){
						$toGetListeCommande = $this->GeStock->getListeFournitureCommandeFiche($iFournitureId);
					}
					$oData['toGetListeCommande'] = $toGetListeCommande;
					$oData['zLibelle'] = "Fiche commande" ; 
					$oData['zTitle'] = "GeStock - fiche commande" ; 
					$oData['menu'] = MENU_COMMANDE;
					$this->load_my_view_Common('gestock/getNewExpression.tpl',$oData, $iModuleId);
					break;


				case 'mercuriale':
					$oData['zLibelle'] = "Mecuriale" ; 
					$oData['menu'] = MENU_MERCURIALE;
					$oData['zTitle'] = "GeStock - Mercuriale" ; 
					$iFournitureId		= $this->postGetValue ("iFournitureId",'') ;
					$toGetListeFourniture = $this->GeStock->getTypeFourniture() ;
					$toGetUnite = $this->GeStock->getUnite() ;

					$toGetFourniture = array();
					$toGetMercuriale = array();
					if ($iFournitureId != ""){
						$toGetFourniture = $this->GeStock->getFournitureId($iFournitureId);
						$toGetMercuriale = $this->GeStock->getMercurialFournitureId($iFournitureId);
					}

					$oData['toGetListeFourniture'] = $toGetListeFourniture;
					$oData['toGetUnite'] = $toGetUnite;
					$oData['zDate'] = date("d/m/Y");
					$oData['iFournitureId'] = $iFournitureId;
					$oData['toGetFourniture'] = $toGetFourniture;
					$oData['iNombre'] = sizeof($toGetMercuriale)+1;
					$oData['toGetMercuriale'] = $toGetMercuriale;

					$this->load_my_view_Common('gestock/getFicheMercurial.tpl',$oData, $iModuleId);
					break;

				case 'inventaire':
					$oData['menu'] = MENU_LISTE_PV;
					$oData['zLibelle'] = "Inventaire PV" ; 
					$oData['zTitle'] = "GeStock - Inventaire PV" ; 
					$this->load_my_view_Common('gestock/inventaire.tpl',$oData, $iModuleId);
					break;

				case 'nouveau-pv':
					$oData['menu'] = MENU_FICHE_PV;
					$oData['zLibelle'] = "Nouveau PV" ; 
					$oData['zTitle'] = "GeStock - Nouveau PV" ; 
					$this->load_my_view_Common('gestock/nouveau-pv.tpl',$oData, $iModuleId);
					break;

				
				case 'notification':
					$oData['menu'] = MENU_LISTE_PV;
					$oData['zLibelle'] = "Inventaire PV" ; 
					$oData['zTitle'] = "GeStock - Inventaire PV" ; 
					$this->load_my_view_Common('gestock/getFicheNotification.tpl',$oData, $iModuleId);
					break;

				
				case 'previsionTaux':
					$oData['menu'] = MENU_LISTE_PV;
					$oData['zLibelle'] = "Inventaire PV" ; 
					$oData['zTitle'] = "GeStock - Inventaire PV" ; 
					$toGetPrevisionArticle = $this->GeStock->getPrevisionArticle();
					$oData['toGetPrevisionArticle'] = $toGetPrevisionArticle ;
					$this->load_my_view_Common('gestock/getFichePrevisionTaux.tpl',$oData, $iModuleId);
					break;

			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Sauvegarde stock
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function save($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			switch ($_zHashUrl) {
				case 'entree':
					$iFournitureId	= $this->postGetValue ("iFournitureId",0) ;
					$iRow			= $this->postGetValue ("iRow",0) ;
					$toGetEnteeStock = $this->GeStock->getStockFournitureId($iFournitureId);

					$toGetMercurialFournitureApplicableId = $this->GeStock->getMercurialFournitureApplicableId($iFournitureId);

					$iMercurialeId = 0;
					$iMercurialePrix = 0;
					foreach ($toGetMercurialFournitureApplicableId as $oGetMercurialFournitureApplicableId){
						$iMercurialeId		= $oGetMercurialFournitureApplicableId["mercuriale_id"];
						$iMercurialePrix	= $oGetMercurialFournitureApplicableId["mercuriale_prix"];
					}

					$toAllModif = array();
					if (sizeof ($toGetEnteeStock)>0){
						foreach ($toGetEnteeStock as $oGetEnteeStock){
							array_push($toAllModif, $oGetEnteeStock["stock_id"]);
						}
					}
					$toModif = array();
					for ($iBoucle=1;$iBoucle<=$iRow;$iBoucle++){
						if(isset($_POST["date_" . $iBoucle]) && ($_POST["date_" . $iBoucle]!='') && isset($_POST["iQuantite_" . $iBoucle]) && ($_POST["iQuantite_" . $iBoucle]!='')){
							$oData = array();
							$oData['stock_fournitureId'] = $iFournitureId;
							
							$oData['stock_date'] = date("Y-m-d");//$this->date_fr_to_en($_POST["date_" . $iBoucle],'/','-');
							$oData['stock_quantite'] = $_POST["iQuantite_" . $iBoucle];

							if(isset($_POST["iModif_" . $iBoucle]) && ($_POST["iModif_" . $iBoucle]!='')){
								array_push($toModif, $_POST["iModif_" . $iBoucle]);
								$this->GeStock->updateStock($oData, $_POST["iModif_" . $iBoucle]);
							} else {
								$oData['stock_mercurialeId'] = $iMercurialeId;
								$oData['stock_prix'] = $iMercurialePrix;
								$this->GeStock->insertStock($oData);
							}
						}
					}

					if (sizeof ($toModif)>0){
						foreach ($toAllModif as $iModifSingle){
							if (!in_array($iModifSingle, $toModif)){
								$this->GeStock->deleteEnteeStockId($iModifSingle);
							}
						}
					}

					echo "1";

					break;

				case 'commande':
					$oData = array();
					
					$iCommandeId		= $this->postGetValue ("iCommandeId",0) ;
					$iArticleId			= $this->postGetValue ("iArticleId",0) ;
					$iQuantite			= $this->postGetValue ("iQuantite",0) ;
					$oResponse			= array();

					$toGetTestCommandeQuantite = $this->GeStock->getTestCommandeQuantite($iArticleId);

					$oData = array();
					$oDataExprression = array();
					$iQuantiteReel = 0;
					if (sizeof($toGetTestCommandeQuantite)>0){

						/* quantité total et quantité commandé */
						$iQuantiteTotal		= $toGetTestCommandeQuantite[0]['iQuantiteTotal'];
						$iQuantiteCommande  = $toGetTestCommandeQuantite[0]['commandePris'];
						$iQuantiteDisponible = $iQuantiteTotal - $iQuantiteCommande ; 

						if (($iQuantiteDisponible - $iQuantite) >= 0){
							$iQuantiteReel = $iQuantite ; 
						} else {
							$iQuantiteReel = $iQuantiteDisponible ; 
						}
	
						$oGetInformation = $this->GeStock->getInfoFourniture($iArticleId);
						$zSigle			 = $this->GeStock->getInfoUser($oUser['id']);

						$oData['commande_numero'] = $oGetInformation['countCommande']."-".$oGetInformation['typeFourniture_Sigle']."-".$zSigle."-".date("dmY");
						$oData['commande_date'] = date("Y-m-d H:i:s");
						$oData['commande_userId'] = $oUser['id'];
						$oData['commande_fournitureId'] = $iArticleId;
						$oData['commande_quantite'] = $iQuantiteReel;
						$oData['fournitureCommande_statutId'] = EN_COURS;
						$oData['commande_typeId'] = COMMANDE_NORMAL;

						if ($iQuantiteReel > 0) {

							if ($iCommandeId == 0){
								$iCommandeId = $this->GeStock->insertCommande($oData);
								
							} else {
								$this->GeStock->updateCommande($oData, $iCommandeId);
							}
						

							$toListeFractionStock = $this->GeStock->getFractionStock($iArticleId);

							$iTest = 0 ; 
							$oDataFraction = array();
							foreach($toListeFractionStock as $oListe){
								
								if ($iTest != 1) {
									if ($iQuantiteReel < $oListe['quantiteReel']){

										$iTest = 1 ; 
										$oDataFraction["fractionStock_fournitureCommandeId"] = $iCommandeId ; 
										$oDataFraction["fractionStock_stockId"] = $oListe["iSotckId"] ; 
										$oDataFraction["fractionStock_quantite"] = $iQuantiteReel ; 
										$this->GeStock->insertFraction($oDataFraction);

									} else {
										
										$iTest = 1 ; 
										$oDataFraction["fractionStock_fournitureCommandeId"] = $iCommandeId ; 
										$oDataFraction["fractionStock_stockId"] = $oListe["iSotckId"] ; 
										$oDataFraction["fractionStock_quantite"] = $oListe['quantiteReel'] ; 
										$this->GeStock->insertFraction($oDataFraction);
									}
								}
							}

						} 

						if (($iQuantiteDisponible - $iQuantite) <0){

							$oDataExprression = $oData ; 
							$oDataExprression['commande_quantite'] = (int)($iQuantite-$iQuantiteDisponible);
							$oDataExprression['commande_typeId'] = EXPRESSION_BESOIN;
							$this->GeStock->insertCommande($oDataExprression);
							echo "2";
						}
					
					} else {
						echo "0";
					}


					
					break;

				case 'new-commande':
					$oData = array();
					
					$iRow			= $this->postGetValue ("iRow",0) ;
					$iCommandeId	= $this->postGetValue ("iCommandeId",0) ;
					$zSigle			= $this->GeStock->getInfoUser($oUser['id']);
					$oCommande		= $this->GeStock->getLastCommande();
					$oResponse		= array();
					$oData			= array();
					$oData['commande_numero'] = $oCommande['iCount']."-".$zSigle."-".date("dmY");
					$oData['commande_date'] = date("Y-m-d H:i:s");
					$oData['commande_userId'] = $oUser['id'];
					if ($iCommandeId == 0){
						$iCommandeId = $this->GeStock->insertCommande($oData);
					} else {
						$this->GeStock->updateCommande($oData, $iCommandeId);
					}

					$zRuptures = "";
					$iBoucleRuptures = 0;
					for ($iBoucle=1;$iBoucle<=$iRow;$iBoucle++){

						if(isset($_POST["iArticleId_" . $iBoucle]) && ($_POST["iArticleId_" . $iBoucle]!='') && isset($_POST["iQuantite_" . $iBoucle]) && ($_POST["iQuantite_" . $iBoucle]!='')){

								$iArticleId = $_POST["iArticleId_" . $iBoucle];
								$iQuantite = $_POST["iQuantite_" . $iBoucle] ; 
								$toGetTestCommandeQuantite = $this->GeStock->getTestCommandeQuantite($iArticleId);
								$oDataExprression = array();
								$iQuantiteReel = 0;
								if (sizeof($toGetTestCommandeQuantite)>0){

									/* quantité total et quantité commandé */
									$iQuantiteTotal		= $toGetTestCommandeQuantite[0]['iQuantiteTotal'];
									$iQuantiteCommande  = $toGetTestCommandeQuantite[0]['commandePris'];
									$iQuantiteDisponible = $iQuantiteTotal - $iQuantiteCommande ; 

									if (($iQuantiteDisponible - $iQuantite) >= 0){
										$iQuantiteReel = $iQuantite ; 
									} else {
										$iQuantiteReel = $iQuantiteDisponible ; 
									}

									$oData = array();
									$oData['fournitureCommande_fournitureId'] = $iArticleId;
									$oData['fournitureCommande_commandeId'] = $iCommandeId;
									$oData['fournitureCommande_quantite'] = $iQuantiteReel;
									$oData['fournitureCommande_statutId'] = EN_COURS;
									$oData['fournitureCommande_typeId'] = COMMANDE_NORMAL;

									$iFournitureCommande = $this->GeStock->insertFournitureCommande($oData);

									if ($iQuantiteReel > 0) {

										$toListeFractionStock = $this->GeStock->getFractionStock($iArticleId);

										$iTest = 0 ; 
										$oDataFraction = array();
										foreach($toListeFractionStock as $oListe){
											
											if ($iTest != 1) {
												if ($iQuantiteReel < $oListe['quantiteReel']){

													$iTest = 1 ; 
													$oDataFraction["fractionStock_fournitureCommandeId"] = $iFournitureCommande ; 
													$oDataFraction["fractionStock_stockId"] = $oListe["iSotckId"] ; 
													$oDataFraction["fractionStock_quantite"] = $iQuantiteReel ; 
													$this->GeStock->insertFraction($oDataFraction);

												} else {
													
													$iTest = 1 ; 
													$oDataFraction["fractionStock_fournitureCommandeId"] = $iFournitureCommande ; 
													$oDataFraction["fractionStock_stockId"] = $oListe["iSotckId"] ; 
													$oDataFraction["fractionStock_quantite"] = $oListe['quantiteReel'] ; 
													$this->GeStock->insertFraction($oDataFraction);
												}
											}
										}

									} 

									if (($iQuantiteDisponible - $iQuantite) <0){

										if ($zRuptures ==""){
											$zRuptures = $toGetTestCommandeQuantite[0]['fourniture_article'];
										} else {
											$zRuptures .= " et " .$toGetTestCommandeQuantite[0]['fourniture_article'];
										}

										$oDataExprression = $oData ; 
										$oDataExprression['fournitureCommande_quantite'] = (int)($iQuantite-$iQuantiteDisponible);
										$oDataExprression['fournitureCommande_typeId'] = EXPRESSION_BESOIN;
										$this->GeStock->insertFournitureCommande($oDataExprression);
										
										$iBoucleRuptures++;
									}
								
								} else {
									$oResponse["value"] = 0;
								}
								
						}

					}

					if ($iBoucleRuptures == 1){
						$oResponse["value"] = 2;
						$oResponse["message"] = " l'article " . $zRuptures . " demandé " ;
					} else if ($iBoucleRuptures > 1) {
						$oResponse["value"] = 2;
						$oResponse["message"] = " les articles " . $zRuptures . " demandés " ;
					} else {
						$oResponse["value"] = 1;
					}

					echo json_encode($oResponse);
					
					break;

				case 'mercuriale':

					$iFournitureId				= $this->postGetValue ("iFournitureId",0) ;
					$iTypeFournitureId			= $this->postGetValue ("iTypeFournitureId",0) ;
					$zArticle					= $this->postGetValue ("zArticle",0) ;
					$zSpecification				= $this->postGetValue ("zSpecification",0) ;
					$iUniteId					= $this->postGetValue ("iUniteId",0) ;
					$iAppliquer					= $this->postGetValue ("appliquer",0) ;
					$iRow						= $this->postGetValue ("iRow",0) ;

					$oData = array();
					$oData['fourniture_typeId'] = $iTypeFournitureId;
					$oData['fourniture_article'] = $zArticle;
					$oData['fourniture_specification'] = $zSpecification;
					$oData['fourniture_uniteId'] = $iUniteId;

					if ($iFournitureId == 0){
						$iFournitureId = $this->GeStock->insertFourniture($oData);
					} else {
						//$this->GeStock->updateFourniture($oData, $iFournitureId);
					}
					$toGetMercuriale = $this->GeStock->getMercurialFournitureId($iFournitureId);

					$toAllModif = array();
					if (sizeof ($toGetMercuriale)>0){
						foreach ($toGetMercuriale as $oGetMercuriale){
							array_push($toAllModif, $oGetMercuriale["mercuriale_id"]);
						}
					}
					$toModif = array();
					for ($iBoucle=1;$iBoucle<=$iRow;$iBoucle++){
						if(isset($_POST["date_" . $iBoucle]) && ($_POST["date_" . $iBoucle]!='') && isset($_POST["zPrix_" . $iBoucle]) && ($_POST["zPrix_" . $iBoucle]!='')){
							$oData = array();
							$oData['mercuriale_fournitureId'] = $iFournitureId;
							$oData['mercuriale_date'] = $this->date_fr_to_en($_POST["date_" . $iBoucle],'/','-');
							$oData['mercuriale_prix'] = $_POST["zPrix_" . $iBoucle];
							$oData['mercuriale_applicable'] = 0;

							if(isset($_POST["iModif_" . $iBoucle]) && ($_POST["iModif_" . $iBoucle]!='')){
								array_push($toModif, $_POST["iModif_" . $iBoucle]);
								$this->GeStock->updateMercuriale($oData, $_POST["iModif_" . $iBoucle]);
							} else {
								$this->GeStock->insertMercuriale($oData);
							}
						}
					}

					$this->GeStock->SetApplicableMercuriale($iFournitureId);

					if (sizeof ($toModif)>0){
						foreach ($toAllModif as $iModifSingle){
							if (!in_array($iModifSingle, $toModif)){
								$this->GeStock->deleteMercurialeId($iModifSingle);
							}
						}
					}

					echo "1";

					break;

				case 'inventaire':
					$iPvId	= $this->postGetValue ("iPvId",0) ;
					$iRow	= $this->postGetValue ("iRow",0) ;
					$iTypeFournitureId	= $this->postGetValue ("iTypeFournitureIdSelected",0) ;
					$oDataPv = array();

					if ($iPvId == 0){
						$oDataPv['pv_date'] = date("Y-m-d");
						$oDataPv['pv_typeFournitureId'] = $iTypeFournitureId;
						$iPvId = $this->GeStock->insertPv($oDataPv);

						$zFourniture = "";
						$oTypeFourniture = $this->GeStock->getTypeArticleId($iTypeFournitureId);
						if (sizeof($oTypeFourniture)>0){
							$zFourniture = $oTypeFourniture[0]['typeFourniture_sigle'];
						}

						$oDataPv['pv_reference'] = sprintf("%'.04d\n", $iPvId)." ".$zFourniture."/".date("Y")."/MEF/SG/DRH";
						$this->GeStock->updatePv($oDataPv,$iPvId);
						
					} 

					$toGetListeArticlePv = $this->GeStock->getListeArticlePv($iPvId) ;

					$toAllModifRebut = array();
					$toAllArticlePv = array();
					if (sizeof ($toGetListeArticlePv)>0){
						foreach ($toGetListeArticlePv as $oGetListeArticlePv){
							array_push($toAllModifRebut, $oGetListeArticlePv["rebut_id"]);
							array_push($toAllArticlePv, $oGetListeArticlePv["pvArticle_id"]);
						}
					}

					$toModifRebus =  array();
					$toModifArticlePv =  array();
					for ($iBoucle=1;$iBoucle<=$iRow;$iBoucle++){
						if(isset($_POST["iArticleId_" . $iBoucle]) && ($_POST["iArticleId_" . $iBoucle]!='') && isset($_POST["iStockFinal_" . $iBoucle]) && ($_POST["iStockFinal_" . $iBoucle]!='')){
							$oDataRebus = array();
							$oDataPvArticle = array();
								

							$oDataPvArticle['pvArticle_pvId'] = $iPvId;
							$oDataPvArticle['pvArticle_articleId'] = $_POST["iArticleId_" . $iBoucle];
							$oDataPvArticle['pvArticle_stockInitiale'] = $_POST["iStockInital_" . $iBoucle];
							$oDataPvArticle['pvArticle_StockPhysique'] = $_POST["iStockPhysique_" . $iBoucle];
							$oDataPvArticle['pvArticle_rebut'] = $_POST["iRebus_" . $iBoucle];
							$oDataPvArticle['pvArticle_stockFinale'] = $_POST["iStockFinal_" . $iBoucle];
							$oDataPvArticle['pvArticle_observation'] = $_POST["Observation_" . $iBoucle];

							if(isset($_POST["iModif_" . $iBoucle]) && ($_POST["iModif_" . $iBoucle]!='')){
								array_push($toModifArticlePv, $_POST["iModif_" . $iBoucle]);
								$iFournitureId = $_POST["iModif_" . $iBoucle] ; 
								$this->GeStock->updatePvArticle($oDataPvArticle, $_POST["iModif_" . $iBoucle]);
							} else {
								$iFournitureId = $this->GeStock->insertPvArticle($oDataPvArticle);
							}

							$oDataRebus['rebut_quantite'] = $_POST["iRebus_" . $iBoucle];
							$oDataRebus['rebut_pvArticleId'] = $iFournitureId;
							if(isset($_POST["iModifRebus_" . $iBoucle]) && ($_POST["iModifRebus_" . $iBoucle]!='')){
								array_push($toModifRebus, $_POST["iModifRebus_" . $iBoucle]);
								$this->GeStock->updateRebut($oDataRebus, $_POST["iModifRebus_" . $iBoucle]);
							} else {
								$oDataRebus['rebut_fournitureId'] = $_POST["iArticleId_" . $iBoucle];
								$oDataRebus['rebut_date'] = date("Y-m-d");
								$this->GeStock->insertRebut($oDataRebus);
							}
						}
					}

					if (sizeof ($toModifRebus)>0){
						foreach ($toAllModifRebut as $iModifSingle){
							if (!in_array($iModifSingle, $toModifRebus)){
								$this->GeStock->deleteRebusId($iModifSingle);
							}
						}
					}

					if (sizeof ($toModifArticlePv)>0){
						foreach ($toAllArticlePv as $iModifSingle){
							if (!in_array($iModifSingle, $toModifArticlePv)){
								$this->GeStock->deletePvArticleId($iModifSingle);
							}
						}
					}
	
					redirect('gestock/outils/stock/inventaire');
					break;

				case 'statut':
					$iFournitureCommandeId	= $this->postGetValue ("iFournitureCommandeId",0) ;
					$iAction		= $this->postGetValue ("iAction",0) ;
					$iCompteActif	= $this->getSessionCompte();

					$oData = array();

					$oData['fournitureCommande_statutId'] = $iAction;
					if ($iCompteActif == COMPTE_AUTORITE){
						$oData['fournitureCommande_autoriteId'] = $oUser['id'];
						$oData['fournitureCommande_dateAutorite'] = date("Y-m-d H:i:s");
					} elseif ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN  ) {
						$oData['fournitureCommande_magasinId'] = $oUser['id'];
						$oData['fournitureCommande_dateMagasin'] = date("Y-m-d H:i:s");
					}
					$this->GeStock->updateFournitureCommande($oData, $iFournitureCommandeId);
					echo "1";

					break;
				
				case 'unite':
					$iTypeUniteId	= $this->postGetValue ("iTypeUniteId",0) ;
					$zTypeUniteLibelle	 = $this->postGetValue ("typeUnite_libelle",'') ;
					$zTypeUnitePlurielle = $this->postGetValue ("typeUnite_plurielle",'') ;
					$iCompteActif	= $this->getSessionCompte();

					$oData = array();
					if ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN  ) {
						$oData['typeUnite_libelle'] = $zTypeUniteLibelle;
						$oData['typeUnite_plurielle'] = $zTypeUnitePlurielle;

						if ($iTypeUniteId == 0){
							$this->GeStock->insertUnite($oData);
						} else {
							$this->GeStock->updateUnite($oData, $iTypeUniteId);
						}
					}
					
					echo "1";

					break;

				case 'fourniture':
						$iTypeFournitureId	= $this->postGetValue ("iTypeFournitureId",0) ;
						$zTypeFournitureLibelle	 = $this->postGetValue ("typeFourniture_libelle",'') ;
						$zTypeFournitureSigle = $this->postGetValue ("typeFourniture_sigle",'') ;
						$iCompteActif	= $this->getSessionCompte();

						$oData = array();
						if ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN  ) {
							$oData['typeFourniture_libelle'] = $zTypeFournitureLibelle;
							$oData['typeFourniture_sigle'] = $zTypeFournitureSigle;

							if ($iTypeFournitureId == 0){
								$this->GeStock->insertTypeFourniture($oData);
							} else {
								$this->GeStock->updateTypeFourniture($oData, $iTypeFournitureId);
							}
						}

						echo "1";

						break;

				case 'compte':
					$iUserId	= $this->postGetValue ("iUserId",0) ;
					$iValueAttr	= $this->postGetValue ("iValueAttr",0) ;

					$this->GeStock->deleteCompte($iUserId);

					if ($iValueAttr==1){
					
						$oData = array();
						$oData["userCompte_userId"]		= $iUserId ;
						$oData["userCompte_compteId"]	= COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN  ;
						$this->UserCompte->insert($oData);
					}

					echo "1";

					break;


			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* suppression
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
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

	    	
			$oData['iNotificationAffiche'] = 1;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iCompteActif = $this->getSessionCompte();

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeGcapId = $this->TypeGcap->get_by_TypeGcap_zHashPageUrl($_zHashUrl);
			
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			switch ($_zHashUrl) {
				case 'entree':
					break;

				case 'commande':
					break;

				case 'mercuriale':
					$iFournitureId = $this->postGetValue ("iElementId",0) ; 

					$this->GeStock->deleteMercuriale($iFournitureId);
					$this->GeStock->deleteFourniture($iFournitureId);
					echo "1";

					break;

				
				case 'unite':
					$iTypeUniteId = $this->postGetValue ("iElementId",0) ; 

					$this->GeStock->deleteUnite($iTypeUniteId);
					echo "1";

					break;

				case 'fourniture':
					$iTypeFournitureId = $this->postGetValue ("iElementId",0) ; 

					$this->GeStock->deleteTypeFourniture($iTypeFournitureId);
					echo "1";

					break;

				case 'inventaire-pv':
					$iPvId = $this->postGetValue ("iElementId",0) ; 

					$toGetListeArticlePv = $this->GeStock->getListeArticlePv($iPvId) ;
					if (sizeof ($toGetListeArticlePv)>0){
						foreach ($toGetListeArticlePv as $oGetListeArticlePv){
							$this->GeStock->deleteRebusId($oGetListeArticlePv["rebut_id"]);
						}
					}

					$this->GeStock->deleteArticlePv($iPvId);
					$this->GeStock->deletePv($iPvId);
					echo "1";
					break;

				case 'nouveau-pv':
					
					break;

			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* Ajax
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function getAjax($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

		$iCurrPage      = $_iCurrPage ;
    	
		if($iRet == 1){	

			$iCompteActif = $this->getSessionCompte();
			switch ($_zHashUrl) {
				case 'entree':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;

						$toGetListe = $this->GeStock->getListeStock($iNombreTotal,$this) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe['fourniture_id'];
							//$oDataTemp[] = $this->date_en_to_fr($oGetListe['stock_date'],'-','/');
							$oDataTemp[] = $oGetListe['typeFourniture_libelle'];
							$oDataTemp[] = $oGetListe['fourniture_article'];
							$oDataTemp[] = $oGetListe['typeUnite_libelle'];
							$oDataTemp[] = $oGetListe['stock_quantite'];
							$oDataTemp[] = $oGetListe['quantiteConsomme'];

							$zAction = '<a title="Consulter" alt="Consulter" href="#" title="" iFournitureId="'.$oGetListe['fourniture_id'].'" class="action dialog-link"><i style="font-size:18px;color:#12105A" class="la la-plus-square"></i></a>' ; 
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

				case 'unite':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;

						$toGetListe = $this->GeStock->getListeUnite($iNombreTotal,$this) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe['typeUnite_id'];
							$oDataTemp[] = $oGetListe['typeUnite_libelle'];

							$zAction = '<a title="Modifier le prix" alt="Modifier" href="#" title="Modifier" style="cursor:pointer;" iTypeUniteId="'.$oGetListe['typeUnite_id'].'" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-edit"></i></a>
							<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="'.$oGetListe['typeUnite_id'].'" class="action suppr"><i style="font-size:22px;color: #F10610;" class="la la-times-rectangle"></i></a>' ; 
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

				case 'fourniture':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;

						$toGetListe = $this->GeStock->getListeFourniture($iNombreTotal,$this) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe['typeFourniture_id'];
							$oDataTemp[] = $oGetListe['typeFourniture_libelle'];

							$zAction = '<a title="Modifier le prix" alt="Modifier" href="#" title="Modifier" style="cursor:pointer;" iTypeFournitureId="'.$oGetListe['typeFourniture_id'].'" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-edit"></i></a>
							<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="'.$oGetListe['typeFourniture_id'].'" class="action suppr"><i style="font-size:22px;color: #F10610;" class="la la-times-rectangle"></i></a>' ; 
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

				case 'commandeAgent':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;
						$iTypeId = $this->postGetValue ("iTypeId",COMMANDE_NORMAL) ;
						$zNotIn = "";

						$zUserId = $this->GeStock->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);
						$toGetListe = $this->GeStock->getListeCommandeAgent($iNombreTotal,$this,$iTypeId,$zUserId) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe['commande_id'];
							$oDataTemp[] = $oGetListe['commande_numero'];

							$toDate = explode(" ",$oGetListe['commande_date']);
							
							$oDataTemp[] = $this->date_en_to_fr($toDate[0],'-','/') . "&nbsp;&nbsp;" . $toDate[1]; 
							$oDataTemp[] = $oGetListe['fourniture'];

							$zAction = '<span style="text-align:center"><a title="Voir" alt="Voir" href="#" title="" iCommandeId="'.$oGetListe['commande_id'].'" class="action dialog-link"><i style="font-size:18px;color:#12105A" class="la la-search"></i></a></span>' ; 
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

				
				case 'expression':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;
						$zNotIn = "";

						$toGetListe = $this->GeStock->getListeCommandeExpression($iNombreTotal,$this,2) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = $oGetListe['fourniture_id'];
							$oDataTemp[] = $oGetListe['fourniture_article'];


							$zAfficheUnite = $oGetListe['typeUnite_libelle'] ; 
							if ((int)$oGetListe['fournitureCommande_quantite'] > 1){
								$zAfficheUnite = $oGetListe['typeUnite_plurielle'] ; 
							}
							$oDataTemp[] = $oGetListe['fournitureCommande_quantite']. " " . $zAfficheUnite ;
							if ($iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN ){
								$oDataTemp[] = $oGetListe['typeFourniture_libelle'];
							}
							

							$zAction = '<span style="text-align:center"><a title="Voir" alt="Voir" href="#" title="" iFournitureId="'.$oGetListe['fourniture_id'].'" class="action dialog-link"><i style="font-size:18px;color:#12105A" class="la la-search"></i></a></span>' ; 
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


				case 'commande':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;
						$iTypeId = $this->postGetValue ("iTypeId",COMMANDE_NORMAL) ;
						$zNotIn = "";

						$zUserId = $this->GeStock->getAllUserSubordonnees ($oUser,$oCandidat,$oUser['id'], $iCompteActif, $zNotIn,1);

						if ($oUser['im'] == '307381'){
							$zUserId = '';
						}
						$toGetListe = $this->GeStock->getListeCommande($iNombreTotal,$this,$iTypeId,$zUserId) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							if ($iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN ){
								$oDataTemp[] = $oGetListe['nom']." ".$oGetListe['prenom'] ;
							}
							$oDataTemp[] = $oGetListe['sigle_service'];

							if ($iTypeId == COMMANDE_NORMAL){
								$oDataTemp[] = $oGetListe['commande_numero'];
								$oDataTemp[] = $this->date_en_to_fr($oGetListe['commande_date'],'-','/'); 
							}
							
							$oDataTemp[] = $oGetListe['fourniture_article'];


							$zAfficheUnite = $oGetListe['typeUnite_libelle'] ; 
							if ((int)$oGetListe['fournitureCommande_quantite'] > 1){
								$zAfficheUnite = $oGetListe['typeUnite_plurielle'] ; 
							}
							$oDataTemp[] = $zAfficheUnite;
							$oDataTemp[] = $oGetListe['fournitureCommande_quantite']. " " . $zAfficheUnite ;
							if ($iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN ){
								//$oDataTemp[] = $oGetListe['typeFourniture_libelle'];
							}
							

							if ($iCompteActif == COMPTE_AUTORITE ){
								if ($oGetListe['fournitureCommande_statutId'] == EN_COURS){
									$oDataTemp[] = '<button class="btn btn-info dialog-link-validation" action="2" type="button" style="border: 5px solid #6fb3e0;width:108px;" title="Valider" alt="Valider" iFournitureCommandeId="'.$oGetListe['fournitureCommande_id'].'"><i class="ace-icon la la-check bigger-110"></i>&nbsp;&nbsp;Valider</button><button class="btn btn-danger dialog-link-validation" action="3" type="button"style="border: 5px solid #d15b47;width:130px;" title="Refuser" alt="Refuser" iFournitureCommandeId="'.$oGetListe['fournitureCommande_id'].'"><i class="ace-icon la la-close bigger-110"></i>&nbsp;&nbsp;Refuser</button>';
								} else {
									$oDataTemp[] = '<span style="text-align:center">'.$oGetListe['statut_libelle']."</span>";
								}
								
							} elseif ($iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $iCompteActif == COMPTE_ADMIN  ){
								if ($oGetListe['fournitureCommande_statutId'] == VALIDER){
									$oDataTemp[] = '<button class="btn btn-info dialog-link-validation" action="4" type="button" style="border: 5px solid #6fb3e0;width:108px;" title="Livrer" alt="Livrer" iFournitureCommandeId="'.$oGetListe['fournitureCommande_id'].'"><i class="ace-icon la la-check bigger-110"></i>&nbsp;&nbsp;Livrer</button>';
								} else {
									$oDataTemp[] = '<span style="text-align:center">'.$oGetListe['statut_libelle']."</span>";
								}
								
							} else {
								if ($iTypeId == COMMANDE_NORMAL){
									$oDataTemp[] = '<span style="text-align:center">'.$oGetListe['statut_libelle']."</span>";
								} else {
									$oDataTemp[] = '<span style="text-align:center">'.$oGetListe['statut_libelle']."</span>";
									//$oDataTemp[] = $oGetListe['typeCommande_libelle'];
								}
							}
							
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

				case 'mercuriale':
						$oRequest = $_REQUEST;
						$iNombreTotal = 0;

						$toGetListe = $this->GeStock->getListeMercuriale($iNombreTotal,$this) ; 

						$oDataAssign = array();
						foreach ($toGetListe as $oGetListe){
							
							$oDataTemp=array(); 

							$oDataTemp[] = trim($oGetListe['fourniture_id']);
							$oDataTemp[] = $oGetListe['typeFourniture_libelle'] ;
							$oDataTemp[] = $oGetListe['fourniture_article'];
							$oDataTemp[] = nl2br($oGetListe['fourniture_specification']);
							$oDataTemp[] = $oGetListe['typeUnite_libelle'];
							$oDataTemp[] = number_format($oGetListe['mercuriale_prix'], 2, ',', ' '). " Ar";

							$zAction = '<a title="Modifier le prix" alt="Modifier le prix" href="#" title="Modifier le prix" style="cursor:pointer;" iFournitureId="'.$oGetListe['fourniture_id'].'" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-dollar"></i></a>
							<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="'.$oGetListe['fourniture_id'].'" class="action suppr"><i style="font-size:22px;color: #F10610;" class="la la-times-rectangle"></i></a>' ; 
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

				case 'invetaire-pv':
					$oRequest = $_REQUEST;
					$iNombreTotal = 0;

					$toGetListe = $this->GeStock->getListeInventairePv($iNombreTotal,$this) ; 

					$oDataAssign = array();
					foreach ($toGetListe as $oGetListe){
						
						$oDataTemp=array(); 

						$oDataTemp[] = '<input type="checkbox" style="width:20px;" class="checkPv" checkAttr="'.$oGetListe['pv_id'].'" name="pv_'.$oGetListe['pv_id'].'" id="pv_'.$oGetListe['pv_id'].'"/>';
						$oDataTemp[] = $oGetListe['pv_id'];
						$oDataTemp[] = $oGetListe['pv_reference'] ;
						$oDataTemp[] = $this->date_en_to_fr($oGetListe['pv_date'],'-','/'); 
						$oDataTemp[] = $oGetListe['typeFourniture_libelle'];

						$zAction = '<a title="Consulter" alt="Consulter" href="'.BASE_PATH.'/gestock/outils/stock/nouveau-pv?iPvId='.$oGetListe['pv_id'].'" title="" iPvId="'.$oGetListe['pv_id'].'" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-edit"></i></a><a href="'.BASE_PATH.'/gestock/imprimer/stock/pv-edit?iPvId='.$oGetListe['pv_id'].'" target="_blank" title="Imprimer" alt="imprimer" iPrintId="'.$oGetListe['pv_id'].'" class="action print"><i style="font-size:22px;color:#12105A" class="la la-print"></i></a>';

						/*$zAction .= '<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="'.$oGetListe['pv_id'].'" class="action suppr"><i style="font-size:22px;color: #F10610;" class="la la-times-rectangle"></i></a>
						' ; */
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

				case 'nouveau-pv':
					$iFournitureId	= $this->postGetValue ("iFournitureId",0) ;
					$toGetTestCommandeQuantite = $this->GeStock->getTestCommandeQuantite($iFournitureId);

					$iQuantiteDisponible = 0;

					if (sizeof($toGetTestCommandeQuantite)>0){
						$iQuantiteTotal		= $toGetTestCommandeQuantite[0]['iQuantiteTotal'];
						$iQuantiteCommande  = $toGetTestCommandeQuantite[0]['commandePris'];
						$iQuantiteDisponible = $iQuantiteTotal - $iQuantiteCommande ; 
					}

					$toReturn = array();
					$toReturn['iQuantiteDisponible'] = $iQuantiteDisponible;
					
					echo json_encode($toReturn); 
					break;

				
				case 'flux-consommation':
					$oRequest = $_REQUEST;
					$iNombreTotal = 0;
					$iTypeId = $this->postGetValue ("iTypeId",COMMANDE_NORMAL) ;
					$zNotIn = "";

					$toGetListe = $this->GeStock->getListeCommande($iNombreTotal,$this,$iTypeId,"") ; 

					$oDataAssign = array();
					foreach ($toGetListe as $oGetListe){

						$oDataTemp=array(); 

						$oDataTemp[] = $oGetListe['fournitureCommande_id'];
						$oDataTemp[] = $this->date_en_to_fr($oGetListe['commande_date'],'-','/'); 
						$oDataTemp[] = $oGetListe['typeFourniture_libelle'];
						$oDataTemp[] = $oGetListe['fourniture_article'];
						$oDataTemp[] = $oGetListe['fournitureCommande_quantite'];
						$oDataTemp[] = $oGetListe['typeUnite_libelle'];
						$oDataTemp[] = $oGetListe['nom']." ".$oGetListe['prenom'] ;
						
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

				case 'compte':

					$iNombreTotal = 0;
					
					$toGetListe = $this->GeStock->getListeAgent(DIRECTION_DRHA,$iNombreTotal) ; 


					$oDataAssign = array();
					foreach ($toGetListe as $oGetListe){

						$oDataTemp=array(); 

						$oDataTemp[] = $oGetListe['user_id'];
						$oDataTemp[] = $oGetListe['nom'];
						$oDataTemp[] = $oGetListe['prenom'];
						$oDataTemp[] = $oGetListe['matricule'];
						$oDataTemp[] = $oGetListe['libele'];
						$zReadonly = "";
						if ($oGetListe['iCompteSotck']>0){
							$zReadonly = 'checked="checked"';
						} 
						$oDataTemp[] = '<input type="checkbox" iId="'.$oGetListe['user_id'].'" class="checkBoxCompte" name="iCompte_'.$oGetListe['user_id'].'" id="iCompte_'.$oGetListe['user_id'].'" '.$zReadonly.' value="1">' ;
						
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

			}
    	
		} else {
			$this->mon_cv();
		}
    	
    }

	/** 
	* statistiques
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function statistique($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

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

			$oData['zLibelle'] = $zLibelle ; 
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;

			switch ($_zHashUrl) {
				case 'taux':
					$oData['menu'] = MENU_TAUX;
					$iNombreTotal = 0;
					$iTypeId = $this->postGetValue ("iTypeId",COMMANDE_NORMAL) ;
					$zNotIn = "";

					//$toGetListeStat = $this->GeStock->getListeCommande($iNombreTotal,$this,$iTypeId,"") ; 
				
					//$toGetListeStat = $this->GeStock->statistiqueTaux() ; 
					$toStatistiqueCSTotal = $this->GeStock->statistiqueConsommeeSurTotal() ; 
					$toStatistiqueArticleSTotal = $this->GeStock->statistiqueArticleSurTotal();
					$toStatistiqueTe = $this->GeStock->statistiqueTe();
					$toStatistiqueRc = array();//$this->GeStock->statistiqueRc();
					$toGetFourniture = $this->GeStock->getFournitureId();
					$toGetTypeFourniture = array();//$this->GeStock->getTypeFourniture();

					$oData['zLibelle'] = "Taux de consommation" ; 
					$oData['zLibelle'] = "Taux de consommation" ; 
					$oData['zTitle'] = "GeStock - Taux de consommation" ;
					$oData['toGetListeStat'] = $toGetListeStat ;
					$oData['toStatistiqueCSTotal'] = $toStatistiqueCSTotal ;
					$oData['toStatistiqueArticleSTotal'] = $toStatistiqueArticleSTotal ;
					$oData['toStatistiqueTe'] = $toStatistiqueTe ;
					$oData['toStatistiqueRc'] = $toStatistiqueRc ;
					$oData['toGetFourniture'] = $toGetFourniture ;
					$oData['toGetTypeFourniture'] = $toGetTypeFourniture ;
					$this->load_my_view_Common('gestock/taux.tpl',$oData, $iModuleId);
					break;

				case 'expression':
					$oData['menu'] = MENU_EXPRESSION_BESOIN;
					$oData['zLibelle'] = "Expression de besoins" ; 
					$oData['zTitle'] = "Expression de besoins" ;
					$this->load_my_view_Common('gestock/expression.tpl',$oData, $iModuleId);
					break;

			}
    	
		} else {
			$this->mon_cv();
		}
    	
    } 

	/** 
	* statistique commande consommateurs
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function getStatCommandeConsommateur() {
		global $oSmarty ; 

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iUserId		= $this->postGetValue ("iUserId",0) ;
		$iArticleId		= $this->postGetValue ("iArticleId",0) ;
		$iTypeArticleId	= $this->postGetValue ("iTypeArticleId",0) ;
	
		if($iRet == 1){	
			
		
			$iNombreTotal = 0;
			$iTypeId = $this->postGetValue ("iTypeId",COMMANDE_NORMAL) ;
			$zNotIn = "";
			$toGetListeStat = $this->GeStock->statistiqueConsommeeSurTotal($iUserId) ; 
			$toStatistiqueArticleSTotal = $this->GeStock->statistiqueArticleSurTotal($iArticleId);

			$toAssgin = array();
			$toAssgin['consomateur'] = $toGetListeStat;
			$toAssgin['article'] = $toStatistiqueArticleSTotal;
			
			echo json_encode($toAssgin); 
		}
	} 

	/** 
	* ratio consommation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function getStatRatioConsommation() {
		global $oSmarty ; 

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iArticleId		= $this->postGetValue ("iArticleId",0) ;
	
		if($iRet == 1){	
			
			$toGetListeStat = $this->GeStock->statistiqueRc($iArticleId) ; 

			/*for($iBoucle=0;$iBoucle<=sizeof($toGetListeStat);$iBoucle++){
				$toGetListeStat[$iBoucle]['fraction'] = number_format($toGetListeStat[$iBoucle]['fraction'], 2, ',', ' ');
			}*/
			
			echo json_encode($toGetListeStat); 
		}

	} 

	/** 
	* paramètrage stock
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function parametres($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$zCandidat	= $this->postGetValue ("zCandidat",'') ;

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

			$oData['zLibelle'] = $zLibelle ; 
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oCandidat'] = $oCandidat;


			switch ($_zHashUrl) {
				case 'controle':
					$oData['menu'] = MENU_CONTROLE;
					$oData['zLibelle'] = "Contrôle" ; 
					$oData['zTitle'] = "GeStock - contrôle" ;
					$this->load_my_view_Common('gestock/controle.tpl',$oData, $iModuleId);
					break;

				case 'gestion-compte':
					$oData['menu'] = MENU_GSTOCK;
					$oData['zLibelle'] = "Gestion compte" ; 
					$oData['zTitle'] = "GeStock - Gestion compte" ;
					$this->load_my_view_Common('gestock/gestion-compte.tpl',$oData, $iModuleId);

					break;
			}

		} else {
			$this->mon_cv();
		}
    	
    }
}