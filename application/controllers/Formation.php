<?php
/**
* @package ROHI
* @subpackage Formation
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Formation extends MY_Controller {

	/**  
	* Classe qui concerne accès
	* @package  ROHI  
	* @subpackage ACCES */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('division_model','division');
		$this->load->model('demande_formation_model','demande_formation');
		$this->load->model('contenu_champ_formation_model','contenu_champ_formation');
		$this->load->model('theme_formation_model','theme_formation');
		$this->load->model('module_formation_model','module_formation');     
		$this->load->model('contenu_formation_model','contenu_formation');
		$this->load->model('photoformation_model','photoformation');
		$this->load->model('agentforme_model','agentforme');
		$this->load->model('listrepporting_model','listrepporting');
		$this->load->model('candidat_activite_model','candidat_activite');
		$this->load->model('listeoffre_model','listeoffre');
		$this->load->model('formation_modelback','formod');
		$this->load->model('inscription_model','inscription');
		$this->load->model('candidat_recu_formation_model','candidat_recu_formation');
		$this->load->model('champs_model');
		$this->load->model('rubrique_model');
		$this->load->model('fonction_model');
		$this->load->model('famillepro_model');
		$this->load->model('sousfamillepro_model');
		$this->load->model('emploi_model');
		$this->load->model('poste_model');
		$this->load->model('formation_model');
		$this->load->model('institut_model');
		$this->load->model('intitule_model');
		$this->load->model('valeur_model');
		$this->load->model('service_model');
		$this->load->model('inscriptionligne_model');
		$this->load->model('user_model');
	}

	/** 
	* Affichage menu accueil du module formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function menu($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
	
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		
			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 212;
			$iModuleId = 14;

			//images dynamiques
			$toColors = array("#A52A2A","#2E8B57","#D02090","#D19275","#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc","#d2d6de","#FFA07A","#3CB371","#9ACD32","#00BFFF","#778899");
			$oData['menuformation2'] = $this->formod->getMenu2();
			$oData['toColors'] = $toColors;
			
			/*print_r($oData['menuformation']);
			die();*/
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				$oData['zTitle'] = "Menu principal" ; 
				$this->load_my_view_Common('formation/menu.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }

	
	/** 
	* Affichage menu secondaire du module formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
    public function menu2($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
	
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		
			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = "rapport-formation" ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 224;
			$iModuleId = 14;

			//images dynamiques
			$oData['menuformation'] = $this->formod->getMenuReporting();
			
			/*print_r($oData['menuformation']);
			die();*/
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Menu réalisation anterieur" ; 
				$this->load_my_view_Common('formation/menu_reporting.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	
	/** 
	* menu base
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function menu_base($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
	
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		
			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 225;
			$iModuleId = 14;

			//images dynamiques
			$oData['menuformation'] = $this->formod->getMenu();
			
			/*print_r($oData['menuformation']);
			die();*/
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Menu base" ; 
				$this->load_my_view_Common('formation/menu_base.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }

	
	/** 
	* menu offre
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function offre($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
	
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);

			$iCompteActif 			= $this->getSessionCompte();
			$oData['zHashUrl'] 		= $_zHashUrl ; 
			$oData['zHashModule'] 	= $_zHashModule ;
			$oData['oUser'] 		= $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 125;
			$iModuleId = 14;

			//images dynamiques
			$toColors = array("","#007FFF","#0095B6","#1034A6","#BB0B0B","#DB0073","#CC4E5C","#f39c12","#00c0ef","#3c8dbc","#d2d6de","#FFA07A","#3CB371","#9ACD32","#00BFFF","#778899");
			$oData['menuformation'] = $this->formod->getMenuOffre();
			$oData['toColors'] = $toColors;
			
			/*print_r($oData['menuformation']);
			die();*/
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				$oData['zCategorieLibelle'] = "" ; 
				$oData['zTitle'] = "Offres" ; 
				$this->load_my_view_Common('formation/offre.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	
	/** 
	* menu locales
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function locales($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 108;
			$iModuleId = 14;
			$iFormationId = 1;
			$iMenuformationId = 1;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			// var_dump($oData['contenuformation']);die();

			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Offres locales" ; 
				$this->load_my_view_Common('formation/offres_locales.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	
	/** 
	* Menu brs
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function brs($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 109;
			$iModuleId = 14;
			$iFormationId = 1;
			$iMenuformationId = 2;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Bourses" ; 
				$this->load_my_view_Common('formation/bourses.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	
	/** 
	* Menu Conc
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function conc($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 110;
			$iModuleId = 14;
			$iFormationId = 1;
			$iMenuformationId = 3;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Concours" ; 
				$this->load_my_view_Common('formation/concours.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	
	/** 
	* Menu forma
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param integer $_iCategorieId Catégorie de menu à afficher
	*
	* @return view
	*/
	public function forma($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 111;
			$iModuleId = 14;
			$iFormationId = 1;
			$iMenuformationId = 4;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Formations payantes à l'extérieur" ; 
				$this->load_my_view_Common('formation/formations_payantes.tpl',$oData, $iModuleId);	
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	
	/** 
	* get Data
	*
	*
	* @return view
	*/
	public function getData(){
		$iValeur = $this->postGetValue ("valeur",0) ;
		$iType = $this->postGetValue ("type",0) ;
		$zTable="";$zParam="";
		switch($iType){
			case 1 :
				$zTable = "famillepro";
				$zParam = "famillepro_fonctionId";
				break;
			case 2 :
				$zTable = "sousfamillepro";
				$zParam = "sousfamillepro_familleproId";
				break;
			case 3 :
				$zTable = "emploi";
				$zParam = "emploi_sousfamilleproId";
				break;
			case 4 :
				$zTable = "institut";
				$zParam = "institut_formationId";
				break;
			case 5 :
				$zTable = "intitule";
				$zParam = "intitule_institutId";
				break;
		}

		$res = $this->inscription->getData($zTable,$zParam,$iValeur);
		echo json_encode($res);
	}
	
	
	/** 
	* inscription en ligne
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param string $_param paramètre
	*
	* @return view
	*/
	public function insc($_zHashModule = FALSE, $_zHashUrl = FALSE, $_param=false){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$this->checkConnexion();

		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 124;
		$iModuleId = 14;
		$iFormationId = 1;
		$iMenuformationId = 5;
		/*$oDemandeFormation = $this->demande_formation->get_demande_formation_by_user_id($oUser['id']);
		$is_vide = empty($demande_formation);*/
		if($iRet){
			$candidat = current($this->candidat->get_by_user_id($oUser['id']));
			$region_id = $candidat->region_id;
			$oData['oFonction'] = $this->inscription->getFonction();
			$oData['oTypeFormation'] = $this->inscription->getTypeFormation();
			if(!$_param)
				$oData['oDiplome'] = $this->inscription->getLastDiplome($candidat->id);
			$oData['oThemeFormation'] = $this->inscription->getThemeFormation();
			$oData['oAttenteFormation'] = $this->inscription->getAttenteFormation();
			$oData['oOrganisme'] = $this->inscription->getOrganisme();
			/*$nbr = $this->demande_formation->get_nbr_rest_by_user_id($oUser['id']);
			$nbr *= 1;
			$oDemandeFormation['nbr_place_restant'] = MAX_NBR_FORMATION - $nbr;
			$oDemandeFormation['exist_place'] = ($nbr<MAX_NBR_FORMATION);
			$oDemandeFormation['is_vide'] = $is_vide;*/
			$oData['cd_id'] = $candidat->id;
			$isResponsable = $this->inscription->checkResponsable($candidat->id);
			if($_param) $oData['ajoutManuel'] = true;
			else $oData['ajoutManuel'] = false;

			$oData['isEditing'] = false;
			
			$this->load_my_view_Common('formation/demande_formation.tpl',$oData, $iModuleId);
		}else{
			redirect("cv/mon_cv");
		}

	}
	
	/** 
	* Edition inscription
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function edit_inscription($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$iInscriptionId = $this->input->post("valeur",0);
		//$oDemandeFormation = $this->demande_formation->get_demande_formation_by_user_id($oUser['id']);
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$this->checkConnexion();

		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 124;
		$iModuleId = 14;
		$oData['isEditing'] = true;
		$oData['ajoutManuel'] = false;

		$oData['isResponsable'] = $this->inscription->checkResponsable($oCandidat[0]->id);
		$oData['oUser'] = $oUser;
		$oData['iModuleActif'] = -1;
		$oData['oCurrentCandidat'] = $oCandidat;
		$oData['oTypeFormation'] = $this->inscription->getTypeFormation();
		$oData['oInstitutFormation'] = $this->inscription->getInstitutFormation();
		$oData['oIntituleFormation'] = $this->inscription->getIntituleFormation();
		$oData['oThemeFormation'] = $this->inscription->getThemeFormation();
		$oData['oAttenteFormation'] = $this->inscription->getAttenteFormation();
		$oData['oOrganisme'] = $this->inscription->getOrganisme();
		if($iInscriptionId){
			$oInscription = $this->inscription->getInscription((int)$iInscriptionId);
			$oInscription['oCandidat'] = $this->inscription->getInfoCandidat($oInscription['inscriptionligne_userId']);
			if($oInscription['inscriptionligne_organismeId'] < 9) $oInscription['zOrganisme'] = $this->inscription->getOrganisme($oInscription['inscriptionligne_organismeId']);
			$oInscription['oActivite'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'activite','activite_inscriptionId');
			$oData['oAttente'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'oattente','oattente_inscriptionId');
			if($oData['oAttente'][0]['oattente_attenteId'] < 8) $oData['zAttente'] = $this->inscription->getAttenteFormation($oData['oAttente'][0]['oattente_attenteId']);
			$oInscription['oStage'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'stage','stage_inscriptionId');
			$oInscription['oTechnique'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'technique','technique_inscriptionId');
			$oInscription['oTheorique'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'theorique','theorique_inscriptionId');
			$oInscription['oComportementale'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'comportementale','comportementale_inscriptionId');

			$oData['oTache'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'tache','tache_inscriptionId');		
			$oData['oAboutFormation'] = $this->inscription->getAboutFormation((int)$oInscription['inscriptionligne_intituleId']);
			$oData['oInscription'] = $oInscription;
			$this->load_my_view_Common('formation/demande_formation.tpl',$oData,$iModuleId);
		}else redirect("formation/candidature_recu");

	}
	
	/** 
	* inscription en ligne
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	public function candidature_recu($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$this->checkConnexion();

		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 211;
		$iModuleId = 14;
		$oData['isResponsable'] = $this->inscription->checkResponsable($oCandidat[0]->id);
		$oData['oCurrentCandidat'] = $oCandidat;
		$oInscription = $this->inscription->getInscription();
		foreach ($oInscription as $iKey => $value) {
			$oInscription[$iKey]['oCandidat'] = $this->inscription->getInfoCandidat($value['inscriptionligne_userId']);
			$oInscription[$iKey]['theme_intitule'] = $this->inscription->getIntituleTheme($value['inscriptionligne_themeId']);
			$oInscription[$iKey]['intituleFormation'] = $this->inscription->getIntituleFormation((int)$value['inscriptionligne_intituleId']);
			//$oInscription[$iKey]['iExist'] = $this->inscription->check
		}

		/*if($oUser['role'] == 'chef'){
			$list_candidat = $this->get_candidat_subordonnee($oUser,$candidat);
		}
		else{
			$list_candidat = $this->candidat->get_all_list_valide();
		}

		$list_inscrit = array();

		foreach($list_candidat as $candidat){
			if($this->demande_formation->is_exist_formation_by_user_id($candidat->user_id)){
				array_push($list_inscrit, $candidat);
			}
		}*/

		$oData['oCandidature'] = $oInscription;
		$this->load_my_view_Common('formation/liste_demande_formation.tpl',$oData,$iModuleId);

	}
	
	/** 
	* ajout demande formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	*
	* @return view
	*/
	function ajout_demande_formation(){
		$this->checkConnexion();
		$data = array();
		$isEdit = false;
		$data_demande_formation = array();
		$oUser = $this->get_current_user();
		$candidat = current($this->candidat->get_by_user_id($oUser['id']));
		$isAjoutManuel = (int)$this->input->post("isAjoutManuel",0);
		$iOrganismeId = (int)$this->input->post("partenaire");
		if($isAjoutManuel == 1){
			$iUserId = (int)$this->input->post("zCandidatSearch");
			$oInscription['inscriptionligne_userId'] = $iUserId;
		}else $oInscription['inscriptionligne_userId'] = $oUser['id'];
		$oInscription['inscriptionligne_poste'] = $this->input->post("adresse_professionel");
		$oInscription['inscriptionligne_anciennete'] = $this->input->post("anciennete_poste");
		$oInscription['inscriptionligne_intituleId'] = $this->input->post("intitule_formation");
		$oInscription['inscriptionligne_themeId'] = $this->input->post("theme_formation");
		$oInscription['inscriptionligne_lieuFormation'] = $this->input->post("lieu_formation");
		$oInscription['inscriptionligne_dateFormation'] = $this->input->post("date_formation");
		$oInscription['inscriptionligne_organismeId'] = $iOrganismeId;
		$oInscription['inscriptionligne_partenaire'] = (int)$this->input->post("partenaire_radio");
		if($iOrganismeId == 9) $oInscription['inscriptionligne_autrepartenaire'] = (int)$this->input->post("partenaire_autre");
		
		if($this->input->post("iInscriptionId",0)){
			$iInscriptionId = $this->input->post("iInscriptionId",0);
			$oInscription['inscriptionligne_userId'] = $this->input->post("iUserId",0);
			$this->inscription->updateMultiple($oInscription,$iInscriptionId,'inscriptionligne');
			$isEdit = true;
		}else	$iInscriptionId = $this->inscription->insert($oInscription,'inscriptionligne');
/*eto zao... vitao n inscriptionligne table aloh de aveo n sasany...... vita zay de mi-afficher candidature recu*/
		$iAttenteId = (int)$this->input->post("attente");
		$iFormationAnnexe = (int)$this->input->post("formation_annexe");
		
		$oAttente['oattente_inscriptionId'] = $iInscriptionId;
		$oAttente['oattente_motivation'] = $this->input->post("motivation_pers");
		$oAttente['oattente_interloc'] = $this->input->post("interloc");
		$oAttente['oattente_demandeperso'] = $this->input->post("demande_personnelle");
		$oAttente['oattente_attenteId'] = $iAttenteId;
		if($iAttenteId == 8) $oAttente['oattente_autreattente'] = $this->input->post("attente_autre");
		$oAttente['oattente_lacune'] = $this->input->post("lacune_competence");
		$oAttente['oattente_objectif'] = $this->input->post("objectif_operationnel");
		$oAttente['oattente_cas'] = $this->input->post("cas_concret");
		$oAttente['oattente_formation'] = $this->input->post("formation_annexe");
		if($iFormationAnnexe == 1){
			$oAttente['oattente_themeFormation'] = $this->input->post("formation_theme");
			$oAttente['oattente_dateFormation'] = $this->input->post("formation_date");
			$oAttente['oattente_lieuFormation'] = $this->input->post("formation_lieu");
			$oAttente['oattente_institutFormation'] = $this->input->post("formation_institut");
			$oAttente['oattente_organisme'] = $this->input->post("formation_organisme");
		}
		if($isEdit) $this->inscription->updateMultiple($oAttente,$iInscriptionId,'oattente');
		else	$this->inscription->insert($oAttente,'oattente');
		
		
		
		$oInputTache = $this->input->post("tache_journaliere");
		$oInputTheorique = $this->input->post("savoir_requi");
		$oInputTechnique = $this->input->post("savoir_faire");
		$oInputComportementale = $this->input->post("savoir_etre");

		if($isEdit){
			$this->inscription->deleteMultiple($iInscriptionId,'tache');
			$this->inscription->deleteMultiple($iInscriptionId,'theorique');
			$this->inscription->deleteMultiple($iInscriptionId,'technique');
			$this->inscription->deleteMultiple($iInscriptionId,'comportementale');
		}

			foreach ($oInputTache as $elem){
				$row = array();
				$row['tache_value'] = $elem;
				$row['tache_inscriptionId'] = $iInscriptionId;
				$this->inscription->insert($row,'tache');
			}
			foreach ($oInputTheorique as $elem){
				$row = array();
				$row['theorique_value'] = $elem;
				$row['theorique_inscriptionId'] = $iInscriptionId;
				$this->inscription->insert($row,'theorique');
			}
			foreach ($oInputTechnique as $elem){
				$row = array();
				$row['technique_value'] = $elem;
				$row['technique_inscriptionId'] = $iInscriptionId;
				$this->inscription->insert($row,'technique');
			}
			foreach ($oInputComportementale as $elem){
				$row = array();
				$row['comportementale_value'] = $elem;
				$row['comportementale_inscriptionId'] = $iInscriptionId;
				$this->inscription->insert($row,'comportementale');
			}

		redirect("formation/candidature_recu/sfao/candidature");
	}
	
	/** 
	* valide inscription
	*
	* @return view
	*/
	public function valide_inscription(){
		$_iValue = $this->input->post("value",0);
		$_iInscriptionId = $this->input->post("iInscriptionId",0);
		if($_iValue && $_iInscriptionId){
			$oInscription['inscriptionligne_valide'] = $_iValue;
			$this->inscription->update($oInscription,$_iInscriptionId);
			return true;
		}else return false;
	}

	/** 
	* avoir l'information sur l'inscription
	*
	*
	* @return view
	*/
	public function getInfoInscription(){
		global $oSmarty;
		$iInscriptionId = $this->input->post("valeur");
		$oInscription = $this->inscription->getInscription((int)$iInscriptionId);
		$oInscription['oCandidat'] = $this->inscription->getInfoCandidat($oInscription['inscriptionligne_userId']);
		if($oInscription['inscriptionligne_organismeId'] < 9) $oInscription['zOrganisme'] = $this->inscription->getOrganisme($oInscription['inscriptionligne_organismeId']);
		$oInscription['oActivite'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'activite','activite_inscriptionId');
		$oInscription['oAttente'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'oattente','oattente_inscriptionId');
		if($oInscription['oAttente'][0]['oattente_attenteId'] < 8) $oInscription['zAttente'] = $this->inscription->getAttenteFormation((int)$oInscription['oAttente'][0]['oattente_attenteId']);
		$oInscription['oStage'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'stage','stage_inscriptionId');
		$oInscription['oTache'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'tache','tache_inscriptionId');
		$oInscription['oTechnique'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'technique','technique_inscriptionId');
		$oInscription['oTheorique'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'theorique','theorique_inscriptionId');
		$oInscription['oComportementale'] = $this->inscription->getMultipleInOne($oInscription['inscriptionligne_id'],'comportementale','comportementale_inscriptionId');
		$oInscription['oAboutFormation'] = $this->inscription->getAboutFormation((int)$oInscription['inscriptionligne_intituleId']);
		$oSmarty->assign("oInscription",$oInscription);
		$zAffiche = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "formation/showInscription.tpl" );
		echo $zAffiche;
	}
	
	/** 
	* programme de formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function programme($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 112;
			$iModuleId = 14;
			$iFormationId = 2;
			$iMenuformationId = 6;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				$oData['zTitle'] = "Programme de formation" ; 
				$this->load_my_view_Common('formation/programme_formation.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Rapport de la formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function rapport($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 113;
			$iModuleId = 14;
			$iFormationId = 2;
			$iMenuformationId = 7;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId,7);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Rapports de formation" ; 
				$this->load_my_view_Common('formation/rapport_formation.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* autre formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function autre($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 114;
			$iModuleId = 14;
			$iFormationId = 2;
			$iMenuformationId = 8;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,7,8);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,7);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Autres rapports" ; 
				$this->load_my_view_Common('formation/autre_rapport.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
    
	/** 
	* participant à la formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function participant( $_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

		$iCompteActif = $this->getSessionCompte();

		if ($iCompteActif == COMPTE_SFAO)
		{

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 230;
			$iModuleId = 14;

			$oData['oListeParticipant']  = $this->formod->getParticipantFormation();
			
			if($iRet == 1){	
				$oData['oUser']		= $oUser;
				$oData['oCandidat'] = $oCandidat;
				$oData['iUserId']	= $oUser['id'] ;
				$oData['zTitle']	= "Liste participant à la formation" ; 
				$this->load_my_view_Common('formation/listeParticipant.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
		} else {
			die("Page reservée au compte SFAO");
		}
    }

	/** 
	* bases données
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function bd( $_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 115;
			$iModuleId = 14;
			
			$oData['local'] = $this->postGetValue('lieu',1);

			if( $oData['local'] != '')
			{
				 $oData['agentformeAnnee']  = $this->formod->getAnneeFormationExistant($oData['local']);
				 
				 $oData['annee'] = $this->postGetValue('annee',$oData['agentformeAnnee'][0]['agentforme_date']);

				if($oData['annee'] != '')
				{
					// $oData['agentformeAnnee']  = $this->formod->getAnneeFormationExistant($oData['local']);
					$oData['agentforme'] 	  = $this->formod->getAgentFormParAnneeLocalite($oData['annee'], $oData['local']);
				//	var_dump($oData['agentforme']); die;
				}
			}
			
		 	if($iRet == 1){	
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Base de données des agents formés" ; 
				$this->load_my_view_Common('formation/base_donnee.tpl',$oData, $iModuleId);
		 	} else {
		 		redirect("cv/mon_cv");
		 	}
    }

	/** 
	* calendrier à la formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function calendrier( $_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 120;
			$iModuleId = 14;
			
		 	if($iRet == 1){	
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['calendrier']  = $this->formod->getCalendrier();

				$oData['zTitle'] = "Base de données des agents formés" ; 
				$this->load_my_view_Common('formation/calendrier1.tpl',$oData, $iModuleId);
		 	} else {
		 		redirect("cv/mon_cv");
		 	}
    }


	/** 
	* statistique
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function sta($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 116;
			$iModuleId = 14;
			$iFormationId = 2;
			$iMenuformationId = 10;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Statistiques" ; 
				$this->load_my_view_Common('formation/statistique.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Album
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function album($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 117;
			$iModuleId = 14;
		
			//print_r($oData['partenaire']);
			
			$oData['photosfao'] = $this->formod->getPhotoFormation();
			$oData['trombinoscopesfao'] = $this->formod->getTrombinoscopeFormation();
			//var_dump($oData['photoformation']);
			//die();
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Album" ; 
				$this->load_my_view_Common('formation/album.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* texte
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function texte($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 118;
			$iModuleId = 14;
			$iFormationId = 3;
			$iMenuformationId = 12;
			//images dynamiques
			/*$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);*/

			$oData['toGetAllData'] = $this->formod->getTexteReference();
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Textes de références" ; 
				$this->load_my_view_Common('formation/texte_reference.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
    
	/** 
	* Document
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function document($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 119;
			$iModuleId = 14;
			$iFormationId = 3;
			$iMenuformationId = 13;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Documents points focaux" ; 
				$this->load_my_view_Common('formation/document_point_focaux.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* information
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
    public function info($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		redirect("formation/calendrier/$_zHashModule/$_zHashUrl");
    }

	/** 
	* Nomenclature
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function nomencl($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 121;
			$iModuleId = 14;
			$iFormationId = 5;
			$iMenuformationId = 15;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Nomenclature des postes" ; 
				$this->load_my_view_Common('formation/nomenclature_poste.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Cartographie
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function cartograph($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 122;
			$iModuleId = 14;
			$iFormationId = 5;
			$iMenuformationId = 16;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Cartographie des effectifs et des emplois" ; 
				$this->load_my_view_Common('formation/cartographie.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* fiche
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $_iCategorieId Idetifiant de la catégorie
	*
	* @return view
	*/
	public function fiche($_zHashModule = FALSE, $_zHashUrl = FALSE,  $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 123;
			$iModuleId = 14;
			$iFormationId = 6;
			$iMenuformationId = 17;
			//images dynamiques
			$oData['associer'] = $this->formod->getAssocierOffre($iFormationId,$iMenuformationId);
			$oData['contenuformation'] = $this->formod->getContenuAssocier($iFormationId,$iMenuformationId);
			//print_r($oData['partenaire']);
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Fiches emplois" ; 
				$this->load_my_view_Common('formation/fiche_emploi.tpl',$oData, $iModuleId);
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Candidature reçu à la formation
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl Hashage du URL
	* @param int $type_candidat_recu_formation type de candidature
	*
	* @return view
	*/
	public function candidat_recu_formation($_zHashModule = FALSE, $_zHashUrl = FALSE,$type_candidat_recu_formation=false){
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData = array();
			$liste = array();
			if($type_candidat_recu_formation){
				$liste = $this->candidat_recu_formation->get_candidat_recu_formation($type_candidat_recu_formation);
			}
			else{
				$liste = $this->candidat_recu_formation->get_candidat_recu_formation();
			}
			$oData['liste'] = $liste;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 211;
			$iModuleId = 14;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
 
				$oData['zTitle'] = "Candidture Reçues" ; 
				$this->load_my_view_Common('formation/candidat_recu_formation.tpl',$oData, $iModuleId);	
			} else {
				redirect("cv/mon_cv");
			}
	}

	/** 
	* Importation candidature reçue
	*
	* @return view
	*/
	private function importCandidadureRecue(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/candidatures_recues-ROHI-2018_RINDRA.xlsx';

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
					$oInsert['type_offre'] = $toBoucleData1[0];
					$oInsert['intitule'] = $toBoucleData1[1];
					$oInsert['lieu_institut'] = $toBoucleData1[2];
					$oInsert['date_formation'] = $toBoucleData1[3];
					$oInsert['nom_prenom'] = $toBoucleData1[4];
					$oInsert['matricule'] = $toBoucleData1[5];
					$oInsert['poste'] = $toBoucleData1[6];
					$oInsert['dep_dir'] = $toBoucleData1[7];
					$oInsert['service'] = $toBoucleData1[8];
					$oInsert['region'] = $toBoucleData1[9];
					$oInsert['action'] = $toBoucleData1[10];

					echo "<pre>";
					print_r ($oInsert);
					echo "</pre>";
					//die();
					$this->candidat_recu_formation->insert($oInsert);
			}
		}

		echo "1";
	}


	/** 
	* Importation Agent formé
	*
	* @return view
	*/
	private function importAgentFormer(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/FORMATION.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(3); 
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
					$oInsert['formation_numero'] = $toBoucleData1[0];
					$oInsert['formation_departement'] = $toBoucleData1[1];
					$oInsert['formation_region']  = $toBoucleData1[2];
					$oInsert['formation_service'] = $toBoucleData1[7];
					$oInsert['formation_userId']  = '';

					if($toBoucleData1[5] != ""){
						$iMatricule = str_replace(" ","",$toBoucleData1[5]);
						$iMatricule = str_replace(".","",$iMatricule);
						$zNom = utf8_decode($toBoucleData1[3]);
						$Prenom = utf8_decode($toBoucleData1[4]);
						//echo "--" . $iMatricule ; 

						if (trim($iMatricule) != 'ECD'){
							$oAgent = $this->Gcap->getCandidatCinMatricule('',trim($iMatricule),'','');
							if(sizeof($oAgent)>0){
								$oInsert['formation_userId'] = $oAgent[0]->iUserId ;
							} else {
								$oInsert['formation_userId'] = $toBoucleData1[5];
							}
						} else {
							$zNom = $toBoucleData1[3];
							$zPrenom = $toBoucleData1[4];
							
							$oAgent = $this->Gcap->getCandidatCinMatricule('','',$zNom,$zPrenom);
							if(sizeof($oAgent)>0){
								$oInsert['formation_userId'] = $oAgent[0]->iUserId ;
							} else {
								$oInsert['formation_userId'] = $toBoucleData1[5];
							}
						}
					}
					
					$oInsert['formation_poste'] = $toBoucleData1[6];
					$oInsert['formation_phone'] = $toBoucleData1[8];
					$oInsert['formation_mail'] = $toBoucleData1[9];
					$oInsert['formation_type'] = $toBoucleData1[10];
					$oInsert['formation_session'] = $toBoucleData1[11];
					$oInsert['formation_regionNom'] = $toBoucleData1[12];

					/*echo "<pre>";
					print_r ($oInsert);
					echo "</pre>";*/
					//die();
					$this->formod->insertFormationR($oInsert);
			}
		}

		echo "1";
	}

	/** 
	* Importation agent formé 
	*
	* @return view
	*/
	public function importAgentFormer2(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/BOURSE EXT BASE 2016-2017.xlsx';
		//$zFileInput = APPLICATION_PATH . '/Classes/FORMATION-2016-2017.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(2); 
		$iLongeurExcel = $oSheet->getHighestRow(); 
		$iLongeurColonne = $oSheet->getHighestColumn();

		for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
			
			$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
											NULL,
											TRUE,
											FALSE);
			if ($iBoucle > 1) {
					$toBoucleData1 = $toBoucleData[0];

					/*echo "<pre>";
					print_r ($toBoucleData1);
					echo "</pre>";
					die();*/


					$oInsert = array();
					$oInsert['formation_numero'] = $toBoucleData1[0];
					$oInsert['formation_departement'] = $toBoucleData1[1];
					$oInsert['formation_region']  = $toBoucleData1[2];
					$oInsert['formation_service'] = $toBoucleData1[8];
					$oInsert['formation_userId']  = '';

					if($toBoucleData1[5] != ""){
						$iMatricule = str_replace(" ","",$toBoucleData1[5]);
						$iMatricule = str_replace(".","",$iMatricule);
						$zNom = utf8_decode($toBoucleData1[3]);
						$Prenom = utf8_decode($toBoucleData1[4]);
						//echo "--" . $iMatricule ; 

						if (trim($iMatricule) != 'ECD'){
							$oAgent = $this->Gcap->getCandidatCinMatricule('',trim($iMatricule),'','');
							if(sizeof($oAgent)>0){
								$oInsert['formation_userId'] = $oAgent[0]->iUserId ;
							} else {
								$oInsert['formation_userId'] = $toBoucleData1[5];
							}
						} else {
							$zNom = $toBoucleData1[3];
							$zPrenom = $toBoucleData1[4];
							
							$oAgent = $this->Gcap->getCandidatCinMatricule('','',$zNom,$zPrenom);
							if(sizeof($oAgent)>0){
								$oInsert['formation_userId'] = $oAgent[0]->iUserId ;
							} else {
								$oInsert['formation_userId'] = $toBoucleData1[5];
							}
						}
					}
					
					$oInsert['formation_poste'] = $toBoucleData1[6];
					/*$oInsert['formation_phone'] = $toBoucleData1[8];
					$oInsert['formation_mail'] = $toBoucleData1[9];
					$oInsert['formation_type'] = $toBoucleData1[10];
					$oInsert['formation_session'] = $toBoucleData1[11];*/
					$oInsert['formation_regionNom'] = $toBoucleData1[11];

					/*echo "<pre>";
					print_r ($oInsert);
					echo "</pre>";
					die();*/
					$this->formod->insertFormationR($oInsert);
			}
		}

		echo "1";
	}

	/** 
	* importation batiment
	*
	* @return view
	*/
	public function importBatiment(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/SITE.xlsx';

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
					$oInsert['batiment_libelle'] = $toBoucleData1[0];
					
					$this->candidat->insertBatiment($oInsert);
			}
		}

		echo "1";
	}


	/** 
	* importation batiment
	*
	* @return view
	*/
	private function importStructure(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/parent-child.xlsx';

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
					$oInsert['structure_id']			= $toBoucleData1[3];
					$oInsert['structure_libelle']		= $toBoucleData1[2];
					$oInsert['structure_parent']		= $toBoucleData1[1];
					$oInsert['structure_rang']			= $toBoucleData1[4];
					$oInsert['structure_sigle']			= $toBoucleData1[5];
					$oInsert['structure_soa']			= $toBoucleData1[6];
					$oInsert['structure_paysId']		= $toBoucleData1[14];
					$oInsert['structure_provinceId']	= $toBoucleData1[12];
					$oInsert['structure_regionId']		= $toBoucleData1[10];
					$oInsert['structure_districtId']	= $toBoucleData1[8];
					
					$this->candidat->structureMef($oInsert);
			}
		}

		echo "1";
	}


	/** 
	* importation batiment
	*
	* @return view
	*/
	private function importStructureLocalite(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/parent-child.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(1); 
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

					if($toBoucleData1[5] != ""){
						$oPays = $this->candidat->searchDistrict($toBoucleData1[1]);

						if (sizeof($oPays) == 0){
							$oInsert['district_id']			= $toBoucleData1[1];
							$oInsert['district_regionId']	= $toBoucleData1[3];
							$oInsert['district_libelle']	= $toBoucleData1[0];
							/*$oInsert['structure_parent']		= $toBoucleData1[1];
							$oInsert['structure_rang']			= $toBoucleData1[4];
							$oInsert['structure_sigle']			= $toBoucleData1[5];
							$oInsert['structure_soa']			= $toBoucleData1[6];
							$oInsert['structure_paysId']		= $toBoucleData1[14];
							$oInsert['structure_provinceId']	= $toBoucleData1[12];
							$oInsert['structure_regionId']		= $toBoucleData1[10];
							$oInsert['structure_districtId']	= $toBoucleData1[8];*/
							
							$this->candidat->structureOther('mef_district',$oInsert);
						}
					}
			}
		}

		echo "1";
	}


	/** 
	* importation batiment
	*
	* @return view
	*/
	private function rapprochement(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/rapprochement.xlsx';

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

					if($toBoucleData1[0] != ""){
						$this->candidat->updateCandidatStructure($toBoucleData1[0],$toBoucleData1[1]);
					}
			}
		}

		echo "1";
	}



	/** 
	* importation batiment
	*
	* @return view
	*/
	public function insertTable(){

		
			/*$toDepartement = $this->candidat->searchAllDepartement();

			foreach ($toDepartement as $oDepartement){
				$oInsert = array();
				$oInsert['libele']				= $oDepartement['structure_libelle'];
				$oInsert['sigle_departement']	= $oDepartement['structure_sigle'];
				$oInsert['soa']					= $oDepartement['structure_soa'];
				$oInsert['structureId']			= $oDepartement['structure_id'];
				$this->candidat->structureOther('mef_departement',$oInsert);
			}*/
				
			/*$toDirection = $this->candidat->searchAllDirection();

			foreach ($toDirection as $oDirection){
				$oInsert = array();
				$oInsert['libele']				= $oDirection['structure_libelle'];
				$oInsert['sigle_direction']		= $oDirection['structure_sigle'];
				$oInsert['soa']					= $oDirection['structure_soa'];
				$oInsert['departement_id']		= $oDirection['departement_id'];
				$oInsert['structureId']			= $oDirection['structure_id'];
				$oInsert['structureParentId']	= $oDirection['structure_parent'];
				$this->candidat->structureOther('mef_direction',$oInsert);
			}*/


			/*$toService = $this->candidat->searchAllService();

			foreach ($toService as $oService){
				$oInsert = array();
				$oInsert['libele']				= $oService['structure_libelle'];
				$oInsert['sigle_service']		= $oService['structure_sigle'];
				$oInsert['soa']					= $oService['structure_soa'];
				$oInsert['direction_id']		= $oService['direction_id'];
				$oInsert['structureId']			= $oService['structure_id'];
				$oInsert['structureParentId']	= $oService['structure_parent'];
				$this->candidat->structureOther('mef_service',$oInsert);
			}*/

			//$this->candidat->TraitementService();
			//$this->candidat->majLocalite();
			//$this->candidat->viderDepDirSer();
			//$this->candidat->majLocaliteDepDirSer();
			//$this->candidat->majUserDepartement();
			//$this->candidat->majUserDirection();
			//$this->candidat->majUserService();
	}


	/** 
	* Decision de congé RGA
	*
	* @return view
	*/
	public function importDecisionRGA(){

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$oPhpExcel = new PHPExcel();
	
		$zFileInput = APPLICATION_PATH . '/Classes/dgeae_scd02.xlsx';

		$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
		$oReader = PHPExcel_IOFactory::createReader($iTypeFile);

		$oPhpExcel = $oReader->load($zFileInput);
	
		$oSheet = $oPhpExcel->getSheet(0); 
		$iLongeurExcel = $oSheet->getHighestRow(); 
		$iLongeurColonne = $oSheet->getHighestColumn();
		$this->load->model('decision_gcap_model','Decision');
		for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
			$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,NULL,TRUE,FALSE);
			if ($iBoucle > 1) {
					$toBoucleData1 = $toBoucleData[0];
					

					if($toBoucleData1[8] != ''){
						$oData = array();
						$oData["decision_typeId"] = 1 ; 
						$tzConditions	=	array() ;
						array_push($tzConditions," 1 = 1 ");
						if( trim($toBoucleData1[0]) == "ECD" ){
							array_push($tzConditions," 
								REPLACE(candidat.cin,' ','') = '".trim($toBoucleData1[1])."' 
							     OR 
								TRIM(candidat.cin) = '".trim($toBoucleData1[1])."' 
							");
							$oCandidat		=	$this->GenericCruds->findByOne("rohi","candidat",$tzConditions);
						}else{
							array_push($tzConditions," REPLACE(candidat.matricule,' ','') = '".$toBoucleData1[0]."'");
							$oCandidat		=	$this->GenericCruds->findByOne("rohi","candidat",$tzConditions);
						}
						
						if( sizeof($oCandidat) > 0 ){
								//$oAgent			=	$this->Gcap->getCandidatCinMatricule(trim($toBoucleData1[1]),trim($toBoucleData1[0]),'','');
								
								$iUserSend = '';
								if($oCandidat>0){
									$iUserSend								= $oCandidat["user_id"];
									$oData["decision_userId"]				= $iUserSend;
									$oData["decision_annee"]				= (int)$toBoucleData1[2];
									$oData["decision_vue"]					= 1 ;

									$oData["decision_dateDebut"]			= date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($toBoucleData1[3])); 
									$oData["decision_dateFin"]				= date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($toBoucleData1[4]));
									$oData["decision_nbrJour"]				= str_replace(",",".",$toBoucleData1[5]);
									
									$oData["decision_numero"]				= $toBoucleData1[7];
									$oData["decision_statutId"]				= STATUT_RECEPTION_AUTORITE ; 
									$oData["decision_userAutoriteId"]		= "6763"; 
									$oData["decision_userValidId"]			= "6763"; 
									$oData["decision_finalisation"]			= 1 ; 
									$oData["decision_autoriteSaisi"]		= "SYSTEM" ;
									$oData["decision_dateFinalisation"]		= date("Y-m-d") ; 
									$oData["decision_caracteristique"]		= "ANNUEL" ; 
									$oData["decision_date"]					= date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($toBoucleData1[3])); 
									$oData["decision_last"]					= 1 ; 
									$oData["decision_valide"]				= 1 ; 
									$iDecisionId							= $this->Decision->insert($oData);
									$iNombreDeJourPris						= (double)str_replace(",",".",$toBoucleData1[6]);
									$oDataFraction							= array();
									$oDataFraction['fraction_decisionId']	= $iDecisionId ; 
									$oDataFraction['fraction_date']			= date("Y-m-d") ; 
									$oDataFraction['fraction_nbrJour']		= $iNombreDeJourPris ; 
									$oDataFraction['fraction_userId']		= $iUserSend ; 
									//$this->Fraction->insert($oDataFraction);
								} else {
									$iUserSend = $toBoucleData1[0];
									echo "<pre>---CIN---: ".$toBoucleData1[1]."</pre>";
									echo "</pre>";
									echo "</br>";
								}
						}else{
								echo "<pre>---TSY INSCRIT ROHI---: ".$toBoucleData1[1]."</pre>";
								echo "</pre>";
								echo "</br>";
						}
				}

			}
		}

		echo "1";
	}

	/** 
	* Fraction decision RGA
	*
	* @return view
	*/
	private function FractionDecisionRGA(){

		$toBoucleData1 = $toBoucleData[0];

		$oData = array();
		$oData["decision_typeId"] = 1 ; 

		$toAgent = $this->Gcap->getRgaSansFraction();

		foreach ($toAgent as $oAgent){
			$oDataFraction = array();
			$oDataFraction['fraction_decisionId'] = $oAgent['decision_id'] ; 
			$oDataFraction['fraction_date'] = date("Y-m-d") ; 
			$oDataFraction['fraction_nbrJour'] = 0; 
			$oDataFraction['fraction_userId'] = $oAgent['decision_userId'] ; 
			$this->Fraction->insert($oDataFraction);
		}

				
		echo "1";
	}

	/** 
	* Mise à jour Decision RGA
	*
	* @return view
	*/
	private function miseAJourDecisionRGA(){

		

		$toBoucleData1 = $toBoucleData[0];

		$oData = array();
		$oData["decision_typeId"] = 1 ; 

		//$this->Gcap->miseAJourDecisionRGA();
		$this->Gcap->updateDebutFinRGA();

				
		echo "1";
	}

	public function date_fr_to_en($date_to_convert, $separator_fr, $separtor_en){
		if($date_to_convert && isset($date_to_convert)){
			$tab = explode($separator_fr, $date_to_convert);
			if (count($tab) == 3) {
				$res = $tab[2] . $separtor_en . $tab[1] . $separtor_en . $tab[0];
				return $res;
			}
		}
		return $date_to_convert;
	}


}