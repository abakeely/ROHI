<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Documentation extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('pret_livre_model','pret_livre');
		$this->load->model('besoin_livre_model','besoin_livre');
		
		$this->load->model('theme_livre_model','theme_livre');
		$this->load->model('auteur_livre_model','auteur_livre');
		$this->load->model('lieu_livre_model','lieu_livre');
		$this->load->model('langue_livre_model','langue_livre');
		$this->load->model('livre_model','livre');
		$this->load->model('texte_reglementaire_model','texte_reglementaire');
		$this->load->model('catalogue_livre_model','catalogue_livre');
		$this->load->model('autre_numerise_model','autre_numerise');
		$this->load->model('planning_model','planning');
		$this->load->model('enam_model','enam');
		$this->load->model('restitution_model','restitution');
		
		$this->load->model('listeform_model','listeform');
		$this->load->model('texte_model','texte_model');

		$this->sessionStartCompte();
	}
	
	/** 
	* Menu principale
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function infprat($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iSessionCompte = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 91;
			$iModuleId = 13;
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				$oData['iSessionCompte'] = $iSessionCompte ; 
				$oData['zTitle'] = "Menu Principal SAD" ; 
				$this->load_my_view_Sad('documentation/infprat.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* informations pratique
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function info($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 91;
			$iModuleId = 13;
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Information Pratique" ; 
				$this->load_my_view_Sad('documentation/info.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* règlement
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function reglement($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 92;
			$iModuleId = 13;
			
			if($iRet == 1){	
				$texte = $this->texte_model->get_by_type(2);
				$oData['titre'] = $texte['titre'];
				$oData['contenue'] = $texte['contenue'];
				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Reglement Interieur" ; 
				$this->load_my_view_Common('documentation/reglement.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }

	/** 
	* guide pratique
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function guide($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 93;
			$iModuleId = 13;
			
			if($iRet == 1){	
				$texte = $this->texte_model->get_by_type(2);
			//	print_r($texte);die;
				$oData['titre'] = $texte['titre'];
				$oData['contenue'] = $texte['contenue'];
				
				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Guide Pratique" ; 
				$this->load_my_view_Common('documentation/guide.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* plan de masse
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function plan($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 94;
			$iModuleId = 13;
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Plan Acces" ; 
				$this->load_my_view_Sad('documentation/plan.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }

	/** 
	* personnel de la SAD
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function personnel($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 95;
			$iModuleId = 13;
			
			if($iRet == 1){	
				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Les Personnels" ; 
				$this->load_my_view_Sad('documentation/personnel.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Catalogue
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function catalogue($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 96;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Catalogue" ; 
				$this->load_my_view_Sad('documentation/catalogue.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Ouvrage
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function ouvrage($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 97;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Divers Ouvrages" ; 
				$this->load_my_view_Sad('documentation/ouvrage.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	

	/** 
	* prêt livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $theme_livre thème du livre
	* @param int $id identification du livre
	*
	* @return view
	*/
	public function pret_livre($_zHashModule = FALSE, $_zHashUrl = FALSE,$theme_livre=false,$id=false){
	
	global $oSmarty ; 
	$oUser = array();
	$oCandidat = array();
	
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			
			$user = $this->get_current_user();
			$oData = array();
			$critere = array();
			
			if($theme_livre){
			$critere['theme_livre_id'] = $theme_livre;
			if($id){
				$critere['id'] = $id;
			}
			}
			else{
				
			}
			
			/*$list_livre = $this->livre->get_livre_by_critere($critere);
			$list_livre = $this->complete_list_livre($list_livre);
			$oData['list_livre'] = $list_livre;	*/
			
			$oData['display_btn_valide'] =true ;
			if($theme_livre==13)
			$oData['display_btn_valide'] = false ;
			
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['theme_livre'] = $theme_livre ;
			$oData['menu'] = 126;
			$iModuleId = 13;
			
			if($iRet == 1){	
				 
				$oData['zTitle'] = "Pret Livre" ; 
				$this->load_my_view_Sad('documentation/pret_livre.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }

	/** 
	* Information du livre en finction du thème
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iThemeId identification du thème
	*
	* @return view
	*/
	public function get_livre($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iThemeId){
	
			global $oSmarty ; 
			$oUser = array();
			$oCandidat = array();
			$zBasePath =  base_url();
	
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			
			if($iRet == 1){	
				
				$iNombreTotal = 0;
				$toListeLivre = $this->livre->get_livre_by_critere($_iThemeId,$iNombreTotal);
				$oDataAssign = array();
				foreach ($toListeLivre as $oListe){
					
					$oDataTemp=array(); 
					$oDataTemp[] = $oListe->Id;
					$oDataTemp[] = $oListe->zThemeLivre;
					$oDataTemp[] = $oListe->cote_livre;
					$oDataTemp[] = $oListe->titre_livre;
					$oDataTemp[] = $oListe->zAuteur;
					$oDataTemp[] = $oListe->edition_livre;
					$oDataTemp[] = $oListe->zLieuLivre;
					$oDataTemp[] = $oListe->zLangue;
					
					$oDataTemp[] = $oListe->format_livre;
					$oDataTemp[] = $oListe->nombre_page_livre;
					$oDataTemp[] = $oListe->nombre_explaire_livre;
					
					$zAction = '<span></span>' ; 

					if (file_exists(APPLICATION_PATH . "assets/pdf_sad/".$oListe->cote_livre.".jpg")) {
							$zAction = '<a href="'.$zBasePath.'assets/pdf_sad/'.$oListe->cote_livre.'.jpg"><img onmouseout="mouseSortie('.$oListe->Id.')" onmouseover="mouseEntre('.$oListe->Id.')" id="img_'.$oListe->Id.'" src="'.$zBasePath.'assets/pdf_sad/'.$oListe->cote_livre.'.jpg"  title="Cliquer pour visualiser" border="0" height="50" width="60"></a>' ; 
					}

					if (file_exists(APPLICATION_PATH . "assets/pdf_sad/".$oListe->cote_livre.".JPG")) {
							$zAction = '<a href="'.$zBasePath.'assets/pdf_sad/'.$oListe->cote_livre.'.jpg"><img onmouseout="mouseSortie('.$oListe->Id.')" onmouseover="mouseEntre('.$oListe->Id.')" id="img_'.$oListe->Id.'" src="'.$zBasePath.'assets/pdf_sad/'.$oListe->cote_livre.'.JPG"  title="Cliquer pour visualiser" border="0" height="50" width="60"></a>' ; 
					}
					

					$oDataTemp[] = $zAction;

					$zAction = '' ; 
					$zAction = '<a onclick="emprunter('.$oListe->Id.')" href="#"><button>Emprunter</button></a>' ; 
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
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* mémoire
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function memoire($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 98;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Memoire de Fin d'Etude" ; 
				$this->load_my_view_Sad('documentation/memoire.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* complete liste livre
	*
	* @param string $list_livre 
	*
	* @return view
	*/
	private function complete_list_livre($list_livre){
		$ret = array();
		
		foreach($list_livre as $livre){
			$livre = $this->complete_livre($livre);
			array_push($ret, $livre);
		}
		return $ret;
	}
	
	/** 
	* completer le livre
	*
	* @param objet $livre 
	*
	* @return view
	*/
	private function complete_livre($livre){
		if(isset($livre->theme_livre_id))
			$livre->theme_livre = $this->theme_livre->get_theme_livre($livre->theme_livre_id);
		
		if(isset($livre->auteur_livre_id))
			$livre->auteur_livre = $this->auteur_livre->get_auteur_livre($livre->auteur_livre_id);
		
		if(isset($livre->lieu_livre_id))
			$livre->lieu_livre = $this->lieu_livre->get_lieu_livre($livre->lieu_livre_id);
		
		if(isset($livre->langue_livre_id))
			$livre->langue_livre = $this->langue_livre->get_langue_livre($livre->langue_livre_id);
		
		return $livre;
	}
	
	/** 
	* ENAM
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	* @param int $_iType_enam type Enam
	*
	* @return view
	*/
	public function enam($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iType_enam=false){
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData = array();
			$oListe = array();
			if($_iType_enam){
				$oListe = $this->enam->get_enam($_iType_enam);
			}
			else{
				$oListe = $this->enam->get_enam();
			}
			$oData['liste'] = $oListe;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 128;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "ENAM" ; 
				$this->load_my_view_Sad('documentation/enam.tpl',$oData, $iModuleId);	
			} else {
				redirect("cv/mon_cv");
			}
	}
	
	/** 
	* texte
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	* @param int $_iType_enam type
	*
	* @return view
	*/
	public function texte($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iType=false){	
		global $oSmarty ; 
		$this->checkConnexion();

			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			
			$oData = array();
			$oListe_texte = array();
			if($_iType){
				$oListe_texte = $this->texte_reglementaire->get_texte_reglementaire($_iType);
			}
			else{
				$oListe_texte = $this->texte_reglementaire->get_texte_reglementaire();
			}
			
			$oData['liste_texte'] = $oListe_texte;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 99;
			$iModuleId = 13;
			
				 
				$oData['zTitle'] = "Texte Reglementaire" ; 
				$this->load_my_view_Sad('documentation/texte.tpl',$oData, $iModuleId);	
		
    }
	
	/** 
	* collection
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collection($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 100;

			$iModuleId = 13;
			
			if($iRet == 1){	


				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Collection Numerique" ; 
				$this->load_my_view_Sad('documentation/collection.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	

	/** 
	* nouveau couverture
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function couverture_nouveau($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 191;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Nouveautes" ; 
				$this->load_my_view_Sad('documentation/couverture_nouveau.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* collection numérique
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionnum($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 101;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Nouveau" ; 
				$this->load_my_view_Sad('documentation/collectionnum.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* collection dico PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionDico_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 101;
		$iModuleId = 13;
			
			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveau" ; 
			$this->load_my_view_Sad('documentation/collectionDico_pdf.tpl',$oData, $iModuleId);	
    }
	
	/** 
	* collection info PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionInfo_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 101;
		$iModuleId = 13;
			
		if($iRet == 1){	

			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveau" ; 
			$this->load_my_view_Sad('documentation/collectionInfo_pdf.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* collection Droit PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionDroit_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 101;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Nouveau" ; 
				$this->load_my_view_Sad('documentation/collectionDroit_pdf.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* collection Env 
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionEnv_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 101;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Nouveau" ; 
				$this->load_my_view_Sad('documentation/collectionEnv_pdf.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* collection Eco PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionEco_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 101;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Nouveau" ; 
				$this->load_my_view_Sad('documentation/collectionEco_pdf.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* collection Gestion PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionGestion_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 101;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Nouveau" ; 
				$this->load_my_view_Sad('documentation/collectionGestion_pdf.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* collection pas PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function collectionPas_pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ;

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 101;
		$iModuleId = 13;
		
		if($iRet == 1){	

			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveau" ; 
			$this->load_my_view_Sad('documentation/collectionPas_pdf.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* collection PDF
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function pdf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 102;

		$iModuleId = 13;
		
		if($iRet == 1){	


			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveautés" ; 
			$this->load_my_view_Sad('documentation/pdf.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	public function pdf1($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 102;

		$iModuleId = 13;
		
		if($iRet == 1){	


			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveautés" ; 
			$this->load_my_view_Sad('documentation/pdf1.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	public function pdf2($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 102;

		$iModuleId = 13;
		
		if($iRet == 1){	


			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveautés" ; 
			$this->load_my_view_Sad('documentation/pdf2.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* nouveau liste
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function nouveaute_liste1($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iCategorieId=0){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 102;
		$iModuleId = 13;
		
		if($iRet == 1){	

			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveautés voir plus" ; 
			$this->load_my_view_Sad('documentation/nouveaute_liste1.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* nouveau liste
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function nouveaute_liste2($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 102;
		$iModuleId = 13;
		
		if($iRet == 1){	


			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveautés voir plus plus" ; 
			$this->load_my_view_Sad('documentation/nouveaute_liste2.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* nouveau liste 3
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function nouveaute_liste3($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ;
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();


		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 102;
		$iModuleId = 13;
		
		if($iRet == 1){	

			$oData['iUserId']		= $oUser['id'] ;
			 
			$oData['zTitle'] = "Nouveautés voir plus plus plus" ; 
			$this->load_my_view_Sad('documentation/nouveaute_liste3.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* Planning
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/	
	public function planning($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iAnnee=false){
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			
				$oData = array();
				$liste = array();
				
			if($_iAnnee){
			$liste = $this->planning->get_planning_by_annee($_iAnnee);
			}
			else{
			$liste = $this->planning->get_planning();
			$liste = $this->changeDateToFr($liste);
			}
			
			$oData['liste'] = $liste;		
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 103;
			$iModuleId = 13;
						
			if($iRet == 1){	
				$oData['oUser'] = $oUser;
				$oData['oCandidat'] = $oCandidat;
				 
				$oData['zTitle'] = "Planning de Restitution" ; 
				$this->load_my_view_Sad('documentation/planning.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Planning restitution
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function planningRestitution($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ;		
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 182;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		    = $oUser['id'] ;
				 
				$oData['zTitle'] = "Planning de Restitution" ; 
				$this->load_my_view_Sad('documentation/planningRestitution.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }
	
	/** 
	* Photo
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function photo($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 104;
		$iModuleId = 13;
		
		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "Images et Videos" ; 
			$this->load_my_view_Sad('documentation/photo.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	/** 
	* Visualisation livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function visualisation_du_livre($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData = array();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 150;
		$iModuleId = 13;

		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "Images et Videos" ; 
			$this->load_my_view_Sad('documentation/visualisation_du_livre',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
	
	/** 
	* recherch avancé
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function recherche_avance($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$user = $this->get_current_user();
		$pret_livre = $this->pret_livre->get_pret_livre_by_user_id($user['id']);
		
		$oData = array();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 150;
		$iModuleId = 13;
		
		if($iRet == 1){	
			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "" ; 
			$this->load_my_view_Sad('documentation/recherche_avance.tpl',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
	
	/** 
	* restitution
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page 
	*
	* @return view
	*/
	public function restitution($_zHashModule = FALSE, $_zHashUrl = FALSE,$restitution_annee=false){
		global $oSmarty ;	
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData = array();
		$oListe = array();
		
		/*if($restitution_annee){
			$oListe = $this->restitution->get_restitution_by_restitution_annee($restitution_annee);
		}
		
		else{
			$oListe = $this->restitution->get_restitution_by_restitution_annee();
		}*/
		
		$oListe					= $this->restitution->get_all_restitution();
		$oListe					= $this->group_by_for($oListe);
		$oData['liste_groupe']	= $oListe;
		$oData['oUser']			= $oUser;
		$oData['oCandidat']		= $oCandidat;
		$oData['zHashUrl']		= $_zHashUrl ; 
		$oData['zHashModule']	= $_zHashModule ;
		$oData['menu']			= 150;
		$iModuleId				= 13;
		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "Planning de Restitution" ; 
			$this->load_my_view_Sad('documentation/restitution.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
		
	}
	
	/** 
	* Load my view SAD
	*
	* @param string $zPage Hashage du module 
	* @param objet $oData Hashage de la page 
	* @param int $_iModuleId identification du module de la page
	*
	* @return view
	*/
	function load_my_view_Sad($zPage,$oData, $_iModuleId){

		global $oSmarty ; 
		global $oDataUser ; 

		$oUser = $oData['oUser'] ;

		$iSessionCompte = $this->getSessionCompte();
		$oData['iSessionCompte'] = $iSessionCompte ; 

		/* Menu Gauche */
		$toTete = $this->planning->get_tete_restitution();
		$toModules = $this->module->get_module($oUser['id']);
		$oCandidat = $this->Gcap->get_by_user_id($oUser['id']);

		
		
		$oData['batimentLibelle'] = "" ; 

		if (isset($oCandidat[0]->candidat_batimentId) && ($oCandidat[0]->candidat_batimentId > 0)){
			$oBatiment = $this->candidat->get_batimentLibelle($oCandidat[0]->candidat_batimentId);
			if (sizeof($oBatiment)>0){
				$oData['batimentLibelle'] = $oBatiment[0]->batiment_libelle ; 
			}
		}
		
		$toComptes = $this->Compte->get_by_compte_UserId($oUser['id']);
		
		$oData['toTete'] = $toTete ;
		$oData['toModules'] = $toModules ;
		$oData['toComptes'] = $toComptes ;
		$zHashUrl = isset($oData['zHashUrl'])?$oData['zHashUrl']:'' ;

		$oData['role'] = $oCandidat[0]->fonction_actuel ;

		if ($_iModuleId == FALSE){
			$_iModuleId = 2 ; 
		}

		$oData['iModuleActif'] = $_iModuleId ;

		$oModuleActif = $this->module->get_by_module_id ($_iModuleId);
		

		/* Notification */
		$iNotificationDecision = 0;
		$iNotificationConge = 0;
		$iNotificationAbscence = 0;
		$iNotificationPermission = 0;
		$iNotificationReposMedical = 0;
		$iNotification = 0; 
		if ($iSessionCompte < 6) {
			$iNotificationDecision = $this->Decision->notification_validate_Decision($oUser,$oCandidat, $oUser['id'],$iSessionCompte);
			$iNotificationConge = $this->Gcap->notification_validate_Gcap($oUser,$oCandidat, $oUser['id'],CONGE,$iSessionCompte);
			$iNotificationAbscence = $this->Gcap->notification_validate_Gcap($oUser,$oCandidat,$oUser['id'],AUTORISATION_ABSENCE,$iSessionCompte);
			$iNotificationPermission = $this->Gcap->notification_validate_Gcap($oUser,$oCandidat, $oUser['id'],PERMISSION,$iSessionCompte);
			$iNotificationReposMedical = $this->Gcap->notification_validate_Gcap($oUser,$oCandidat, $oUser['id'],REPOS_MEDICAL_LUCIA,$iSessionCompte);
			$iNotification = $iNotificationDecision + $iNotificationConge + $iNotificationAbscence + $iNotificationPermission + $iNotificationReposMedical; 
		}

		$oRowUserTheme = $this->common->setConfigurationUser($oUser['id']);
		$oNotificationGestock = $this->Agenda->NotificationGestock($oUser['id']);
		$oNotificationGestock2 = $this->Agenda->NotificationGestock2($oUser['id']);

		$iTestPv = $this->Agenda->NotificationPv($oUser['id']);

		if (sizeof($oNotificationGestock)>0){
			if ($oNotificationGestock[0]['notification_effectuer']==1){
				$iTestPv = 0;
			} else {
				$iTestPv = 0;
				if (($oNotificationGestock[0]['notification_dateRappel1']==date("Y-m-d")) || ($oNotificationGestock[0]['notification_dateRappel2']==date("Y-m-d"))){
					$iTestPv = 1;
				} 
			}
		}

		$oController = $this->router->fetch_class();

		$oData['oModuleActif'] = $oModuleActif ; 
		$oData['oRowUserTheme'] = $oRowUserTheme ; 
		$oData['iModuleId'] = $_iModuleId ; 
		$oData['iNotification'] = $iNotification ; 
		$oData['iNotificationDecision'] = $iNotificationDecision  ; 
		$oData['iNotificationConge'] = $iNotificationConge  ; 
		$oData['iNotificationAbscence'] = $iNotificationAbscence  ; 
		$oData['iNotificationPermission'] = $iNotificationPermission  ;
		$oData['$iNotificationReposMedical'] = $iNotificationReposMedical  ;
		$oData['oNotificationGestock'] = $oNotificationGestock ; 
		$oData['oNotificationGestock2'] = $oNotificationGestock2 ; 
		$oData['iTestPv'] = $iTestPv ; 
		$oData['oController'] = $oController ; 
		
		/* Menu Header */
		$toMenus = $this->Page->get_Menu($oUser['id'], $_iModuleId, $iSessionCompte,isset($oData['zHashUrl'])?$oData['zHashUrl']:'');
		

		/* Les événements */
		$toAllEvent = $this->Agenda->geAllEvenement($oUser['id']);
		$oData['toAllEvent'] = $toAllEvent ;
		$oData['toMenus'] = $toMenus ; 

		$oDataUser = $oData;
		$oSmarty->assign('zCssJs', ADMIN_TEMPLATE_PATH . "common/pages/zCssJs.page.php");
		$oSmarty->assign('zHeader', ADMIN_TEMPLATE_PATH . "common/pages/header.page.php");
		$oSmarty->assign('zLeft', ADMIN_TEMPLATE_PATH . "common/pages/colonneGauche.page.php");
		$oSmarty->assign('zFooter', ADMIN_TEMPLATE_PATH . "common/pages/footer.page.php");
		$oSmarty->assign('zRight', ADMIN_TEMPLATE_PATH . "common/pages/colonneRight.page.php");
		$oSmarty->assign('zTete_restitution', ADMIN_TEMPLATE_PATH . "documentation/pages/tete_restitution.page.php");
		$oSmarty->assign('oData', $oData);
		$oSmarty->assign('zBasePath',  base_url());
		$oSmarty->clear_cache( ADMIN_TEMPLATE_PATH . $zPage );
		$oSmarty->display( ADMIN_TEMPLATE_PATH . $zPage );

	}
	
	/** 
	* par groupe de livre
	*
	* @param objet $list objet liste
	*
	* @return view
	*/
	private function group_by_for($list){
	global $oSmarty ;
		
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			
		$ret = array();
		$cpt = 1;
		$is_sup4 = false;
		$group = array();
		foreach($list as $row){
			if($cpt==1){
				$group = array();
			}
			array_push($group,$row);
			if($cpt==4){
				array_push($ret,$group);
				$cpt = 0;
				$is_sup4 = true;
			}
			$cpt++;
		}
		$size = sizeof($list);
		if($size>0 && (($size % 4)<4)){
			array_push($ret,$group);
		}
		return $ret;
	}
	
	/** 
	* Detail de restitution partie image
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $id_restitution identifiant de la restitution
	* @return view
	*/
	public function detail_restitution_image($_zHashModule = FALSE, $_zHashUrl = FALSE, $id_restitution){
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
		
	
		$restitution = $this->restitution->get_restitution_by_id($id_restitution);
		$list_image = explode(',',$restitution->restitution_url_image);
		
		$oData['restitution'] = $restitution;
		$oData['list_image'] = $list_image;
		
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 104;
		$iModuleId = 13;
		
		if($iRet == 1){	
			
			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "Images" ; 
			$this->load_my_view_Sad('documentation/detail_restitution_image.tpl',$oData, $iModuleId);
		
		} else {
				redirect("cv/mon_cv");
		}
		
	}
	
	/** 
	* Detail de restitution partie vidéo
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $id_restitution identifiant de la restitution
	* @return view
	*/
	public function detail_restitution_video($_zHashModule = FALSE, $_zHashUrl = FALSE, $id_restitution){
		global $oSmarty ;
		
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			
		$restitution = $this->restitution->get_restitution_by_id($id_restitution);
		$oData['restitution'] = $restitution;
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 104;
		$iModuleId = 13;
		
		if($iRet == 1){	
			 
			$oData['zTitle'] = "Videos" ;
			$this->load_my_view_Sad('documentation/detail_restitution_video.tpl',$oData, $iModuleId);
		
		} else {
				redirect("cv/mon_cv");
		}
	}
	
	/** 
	* changement de la date en français
	*  
	* @param objet $list liste des restitution
	* @return view
	*/
	public function changeDateToFr($list){
		
		global $oSmarty ; 
		
		$ret = array();
		foreach($list as $row){
			$row->date_restitution = $this->date_en_to_fr($row->date_restitution,'-','-');
			array_push($ret,$row);
		}
		return $ret;
	}
		
	
	/** 
	* Prolongation de prêt
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function prolongation_pret($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$user = $this->get_current_user();
		
		if ($iCompteActif == COMPTE_SAD){
			$list_pret_livre = $this->pret_livre->get_all_pret_valide();
		}
		else{
			$list_pret_livre = $this->pret_livre->get_pret_valide_by_user_id($user['id']);
		}
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 106;
			$iModuleId = 13;
			$oData['list_pret'] = $this->complete_pret_list($list_pret_livre);
	
		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "Prolongement de pret" ; 
			$this->load_my_view_Sad('documentation/prolongation_pret.tpl',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
	
	/** 
	* liste de besoin
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function liste_besoin($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$user = $this->get_current_user();
		$liste_besoin_livre = array();
		if ($iCompteActif == COMPTE_SAD){
			$liste_besoin_livre = $this->besoin_livre->get_all_besoin();
		}
		else{
			$liste_besoin_livre = $this->besoin_livre->get_besoin_livre_by_user_id($user['id']);
		
			$liste_besoin_livre = $this->complete_besoin_list($liste_besoin_livre);
		}
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['iSessionCompte'] = $iCompteActif;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 107;
			$iModuleId = 13;
			$oData['liste_besoin'] = $liste_besoin_livre;
		
		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "Listes Besoins" ; 
			$this->load_my_view_Sad('documentation/liste_besoin.tpl',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
	
	/** 
	* complete besoin liste
	*
	* @param objet $list liste des prêts
	*
	* @return view
	*/
	private function complete_besoin_list($list){
		$ret = array();
		foreach($list as $besoin){
			$besoin->candidat = current($this->candidat->get_by_user_id($besoin->user_id));;
			array_push($ret, $besoin);
		}
		return $ret;
	}
	
	/** 
	* besoin de livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function besoin_livre($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 181;
			$iModuleId = 13;
		
		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "" ; 
			$this->load_my_view_Sad('documentation/besoin_livre.tpl',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
		
	
	/** 
	* Service des Archives et de la documentation
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function service($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 127;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $oUser['id'] ;
				 
				$oData['zTitle'] = "Service Proposé" ; 
				$this->load_my_view_Sad('documentation/service.tpl',$oData, $iModuleId);	
			
			} else {
				redirect("cv/mon_cv");
			}
    }	
	
	/** 
	* liste des prêts
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function liste_pret($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$user = $this->get_current_user();	
		if ($iCompteActif == COMPTE_SAD){
			 $list_pret_livre = $this->pret_livre->get_all_pret_livre();
		}
		else{
			$list_pret_livre = $this->pret_livre->get_pret_livre_by_user_id($user['id']);
		}
			$list_pret_livre = $this->complete_pret_list($list_pret_livre);
	
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['iSessionCompte'] = $iCompteActif;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 105;
			$iModuleId = 13;
			$oData['list_pret'] = $list_pret_livre;
	
		if($iRet == 1){	

			$oData['iUserId']		    = $oUser['id'] ;
			 
			$oData['zTitle'] = "" ; 
			$this->load_my_view_Sad('documentation/liste_pret.tpl',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
	
	
	
	/** 
	* recherche de livre
	*
	* @param string $texte texte à rechercher
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	
	public function search_livre($texte=false,$_zHashModule = FALSE, $_zHashUrl = FALSE){
		$critique = "";
		if($texte){
			$critique = $texte;
		}
		else{
			$critique = $_POST['texte'];
		}
		$list_livre = $this->livre->search_livre($critique);
		$list_livre = $this->complete_list_livre($list_livre);
		$oData['list_livre'] = $list_livre;
		return $this->load_my_view_Sad('documentation/pret_livre',$oData, $iModuleId);
	}
	
	/** 
	* action prêt
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param string $action action
	* @param int $id_pret identifiant du pret
	*
	* @return view
	*/
	public function action_pret($_zHashModule = FALSE, $_zHashUrl = FALSE, $action, $id_pret){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		$oData = array();
		$oData['statut'] = $action;
		
		if($action==1){
			$oData['date_validation'] = date('Y-m-d\TH:i:s');
			$oData['date_retour'] = date('Y-m-d\TH:i:s',strtotime("+10 days"));
			
		}
		else if(statut==4){
		 $oData['date_validation'] = date('Y-m-d\TH:i:s');
		 $oData['date_retour'] = date('Y-m-d\TH:i:s',strtotime("+10 days"));
	    }
		
		else if($action==3){
			$oData['date_retour2'] = date('Y-m-d\TH:i:s');
		}
		
		$this->pret_livre->update($oData,$id_pret);
		redirect('documentation/liste_pret/sad/liste-pret',$oData, $iModuleId);
	}
	
	/** 
	* action besoin de livre
	*
	* @param string $action action
	* @param int $id_besoin identifiant du besoin
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	public function action_besoin($action,$id_besoin,$_zHashModule = FALSE, $_zHashUrl = FALSE){
		$oData = array();
		$oData['statut'] = $action;
		$this->besoin_livre->update($oData,$id_besoin);
		redirect('documentation/liste_besoin',$oData, $iModuleId);
	}
		
	/** 
	* ajout pret livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	function ajout_pret_livre($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
				
		$oData = array();
		$oData_pret_livre = array();
		$user = $this->get_current_user();
				
		$oData_pret_livre['user_id'] = $oUser['id'];
		$oData_pret_livre['date_pret_livre'] = date('Y-m-d\TH:i:s');
		$oData_pret_livre['cote_livre'] = $this->input->post("cote_livre");
		$oData_pret_livre['titre_livre'] = $this->input->post("titre_livre");
		$oData_pret_livre['auteur_livre'] = $this->input->post("auteur_livre");
		$oData_pret_livre['editeur_livre'] = $this->input->post("editeur_livre");
		$oData_pret_livre['lieu_livre'] = $this->input->post("lieu_livre");
		$oData_pret_livre['statut'] = 3;
		$oData_pret_livre['annee_parution_livre'] = $this->input->post("annee_parution_livre");
		
		$this->pret_livre->insert($oData_pret_livre);
		
		if($iRet == 1){	
				 
				$oData['zTitle'] = "Pret Livre" ; 
				$this->load_my_view_Sad('documentation/liste_pret.tpl',$oData, $iModuleId);	
			
		} else {
			redirect("cv/mon_cv");
		}
	}
	
	/** 
	* ajout besoin livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	function ajout_besoin_livre($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		
		$oData = array();
		$oData_besoin_livre = array();
		$user = $this->get_current_user();
		
		$oData_besoin_livre['user_id'] = $user['id'];
		$oData_besoin_livre['date_demande_besoin'] = date('Y-m-d\TH:i:s');
		$oData_besoin_livre['description_besoin'] = $this->input->post("description_besoin");
		$oData_besoin_livre['theme_besoin'] = $this->input->post("theme_besoin");
		$oData_besoin_livre['titre_besoin'] = $this->input->post("titre_besoin");
		$oData_besoin_livre['auteur_besoin'] = $this->input->post("auteur_besoin");
		
		$oData_besoin_livre['edition_besoin'] = $this->input->post("edition_besoin");
		$oData_besoin_livre['lieu_besoin'] = $this->input->post("lieu_besoin");
		$oData_besoin_livre['langue_besoin'] = $this->input->post("langue_besoin");	
		
		$this->besoin_livre->insert($oData_besoin_livre);
		
		redirect('documentation/liste_besoin/sad/ajout-besoins-specifiques',$oData, $iModuleId);
	}
	
	/** 
	* reserver un livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/
	function reserver_livre($_zHashModule = FALSE, $_zHashUrl = FALSE, $id){
		global $oSmarty ; 
		
		$oUser = array();
		$oCandidat = array();
		$oData = array();
		$user = $this->get_current_user();
		
		$pret = array();
		$pret['livre_id'] = $id;
		$pret['user_id'] = $user['id'];
		$pret['statut'] = 0;
		$pret['date_reservation'] = date('Y-m-d\TH:i:s');
		
		$this->pret_livre->insert($pret);
		
		redirect('documentation/liste_pret/sad/liste-pret',$oData, $iModuleId);
	}
	

	/** 
	* rechercher un livre
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	*
	* @return view
	*/

	function recherche_livre($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$oData = array();
		if(isset($_POST['theme_livre_id']) && $_POST['theme_livre_id'] != 0)
			$oData['theme_livre_id'] = $_POST['theme_livre_id'];
		
		if(isset($_POST['titre_livre']))
			$oData['titre_livre'] = $_POST['titre_livre'];
		
		if(isset($_POST['cote_livre']))
			$oData['cote_livre'] = $_POST['cote_livre'];
			
		if(isset($_POST['auteur_livre_id']))
			$oData['auteur_livre_id'] = $_POST['auteur_livre_id'];
		
		if(isset($_POST['edition_livre']))
			$oData['edition_livre'] = $_POST['edition_livre'];
			
		if(isset($_POST['lieu_livre_id']))
			$oData['lieu_livre_id'] = $_POST['lieu_livre_id'];
		
		if(isset($_POST['langue_livre_id']))
			$oData['langue_livre_id'] = $_POST['langue_livre_id'];
		
		if(isset($_POST['format_livre']))
			$oData['format_livre'] = $_POST['format_livre'];
		
		if(isset($_POST['nombre_page_livre']))
			$oData['nombre_page_livre'] = $_POST['nombre_page_livre'];
						
		if(isset($_POST['nombre_explaire_livre']))
			$oData['nombre_explaire_livre'] = $_POST['nombre_explaire_livre'];
		
		$result = $this->livre->get_livre_by_critere($oData);
		
		
		if(sizeof($result>0)){
			$data_json = array();
			$data_json['list_livre'] = $this->complete_list_livre($result);
			
			$list_edition = $this->livre->get_list_edition_by_critere($oData);
			$list_langue = $this->livre->get_list_langue_by_critere($oData);
			$list_lieu = $this->livre->get_list_lieu_by_critere($oData);
			$list_auteur = $this->livre->get_list_auteur_by_critere($oData);
			
			$list_titre = $this->livre->get_list_titre_by_critere($oData);
			$list_cote = $this->livre->get_list_cote_by_critere($oData);
		
			
			if(sizeof($list_edition>0))
				$data_json['list_edition'] = $list_edition;
			
			if(sizeof($list_langue>0))
				$data_json['list_langue'] = $this->complete_list_langue($list_langue);
			
			if(sizeof($list_lieu>0))
				$data_json['list_lieu'] = $this->complete_list_lieu($list_lieu);
			
			if(sizeof($list_auteur>0))
				$data_json['list_auteur'] = $this->complete_auteur($list_auteur);
				
					
			if(sizeof($list_titre>0))
				$data_json['list_titre'] = $this->complete_list_titre($list_titre);
			
			if(sizeof($list_cote>0))
				$data_json['list_cote'] = $this->complete_list_cote($list_cote);
			
						
		}
		echo json_encode($data_json);
	}
	
	/** 
	* completer la langue 
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param objet $list_langue liste de la langue
	*
	* @return view
	*/
	private function complete_list_langue($_zHashModule = FALSE, $_zHashUrl = FALSE, $list_langue){
		$ret = array();
		foreach($list_langue as $langue){
			$lang = $this->langue_livre->get_langue_livre($langue->langue_livre_id);
			array_push($ret, $lang);
		}
		return $ret;
	}
	
	/** 
	* completer la liste des lieu
	*
	* @param objet $list_lieu liste des lieu 
	*
	* @return view
	*/
	private function complete_list_lieu($list_lieu){
		$ret = array();
		foreach($list_lieu as $lieu){
			$lang = $this->lieu_livre->get_lieu_livre($lieu->lieu_livre_id);
			array_push($ret, $lang);
		}
		return $ret;
	}
	
	/** 
	* completer l'auteur
	*
	* @param string $_zHashModule Hashage du module 
	* @param integer $_iCurrPage page courrante
	* @param objet $list_auteur liste  
	*
	* @return view
	*/
	private function complete_auteur($_zHashModule = FALSE, $_zHashUrl = FALSE, $list_auteur){
		$ret = array();
		foreach($list_auteur as $auteur){
			$au = $this->auteur_livre->get_auteur_livre($auteur->auteur_livre_id);
			array_push($ret, $au);
		}
		return $ret;
	}
	
	/** 
	* completer liste titre
	*
	* @param objet $list_titre liste  
	*
	* @return view
	*/
	private function complete_list_titre($list_titre){
		$ret = array();
		foreach($list_titre as $titre){
			$tit = $this->titre_livre->get_titre_livre($titre->titre_livre);
			array_push($ret, $tit);
		}
		return $ret;
	}
	
	/** 
	* completer liste cote
	*
	* @param objet $list_cote liste  
	*
	* @return view
	*/
	private function complete_list_cote($list_cote){
		$ret = array();
		foreach($list_cote as $cote){
			$co = $this->cote_livre->get_cote_livre($cote-cote_livre);
			array_push($ret, $co);
		}
		return $ret;
	}
	
	/** 
	* completer pret liste 
	*
	* @param objet $list liste  
	*
	* @return view
	*/
	private function complete_pret_list($list){
		$ret = array();
		foreach($list as $pret){
			$livre = $this->livre->get_livre($pret->livre_id);
			$livre = $this->complete_livre($livre);
			$pret->livre = $livre;
			$pret->candidat = current($this->candidat->get_by_user_id($pret->user_id));;
			array_push($ret, $pret);
		}
		return $ret;
	}
	
	/** 
	* listing prêt livre de l'agent connecté
	*
	* @return view
	*/
	private function checkMyPretList(){
		$user = $this->get_current_user();
		$list_pret_livre = $this->pret_livre->get_pret_valide_by_user_id($user['id']);
		$this->notification->clearNotificationNow($user['id']);
		foreach($list_pret_livre as $pret){
			$livre = $this->livre->get_livre($pret->livre_id);
			$diff = $this->dateDiff(date('Y-m-d H:i:s'),$pret->date_retour);
			if($diff<=2){
				 if($diff>0){
					$msg = "Il vous reste $diff jours pour rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"reste quelques jours");
				}
				else if($diff>=0 && $diff<1){
					$msg = "Il est temps de rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"Rendre livre");
				}
				else{
					$msg = "Vous etes en retard pour rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"retard de retour");
				}
			}
		}
	}
	
	/** 
	* difference de deux date 
	*
	* @param date $date1 date1
	* @param date $date2 date2
	*
	* @return view
	*/
	private function dateDiff($date1, $date2){
		$s = strtotime($date2)-strtotime($date1);
		$d = intval($s/86400)+1;
	 
		return $d;
	}
	
	/** 
	* Vérification livre
	*
	* @param string $_sCote
	*
	* @return view
	*/
	public function verifier_livre($_sCote){
		$oData = array();
		
		$livre = $this->livre->get_livre_by_cote($_sCote);
		
		if($livre){
			$livre =  $this->complete_livre($livre);
			$oData['livre'] = $livre;
			$oData['statut'] = "ok";
		}
		else{
			$oData['statut'] = "ko";
		}
		echo json_encode($oData);
	}
}