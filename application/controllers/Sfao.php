<?php
/**
* @package ROHI
* @subpackage SFAO
* @author Division Recherche et Développement Informatique
*/

ob_start();
class Sfao extends MY_Controller {

	public function __construct(){
		parent::__construct();

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
			$toUserAutorise = array ('389671');
			
			$iPrivModif = 0;
			if (in_array($oUser['im'], $toUserAutorise)) {
				$iPrivModif = 1;
			} 

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$oData['zBasePath'] = base_url() ;
			$oData['iPrivModif'] = $iPrivModif ;
			$oData['zContent'] = '' ;
			$oData['zTile'] = '' ;
			$oData['iPageId'] = '' ;
			$oData['zHashUrl'] = '' ;
	    	$this->load_my_view_Gcap('sfao/index.tpl',$oData, -1);
	    	
    	}
    	
    }

	public function page($_zPage){

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	
			$iPageId	= $this->postGetValue ("iPageId",1) ;
			$oPage	= $this->Page->get_Content($_zPage);

			$zContent = $oPage["sfao_contenu"] ; 
			$zTitle   = $oPage["sfao_title"] ; 

			$toUserAutorise = array ('354816','355857','283611','389671', '355037','355577');

			$iAfficheEdit = 0;
			if (in_array($oUser['im'], $toUserAutorise)) {

				$iAfficheEdit = 1;
			}

    		$oData = array();
			$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['iAfficheEdit'] = $iAfficheEdit;
			$oData['oCandidat'] = $oCandidat;
			$oData['zBasePath'] = base_url() ;
			$oData['zTitle'] = $zTitle ;
			$oData['iPageId'] = $oPage['sfao_id'] ;
			$oData['zHashUrl'] = $oPage['sfao_zHashUrl'] ;
			/*$zContent = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "sfao/getPage.tpl" );*/
			$oData['zContent'] = $zContent ;
			$this->load_my_view_Gcap('sfao/index.tpl',$oData, -1);
		}
    }

	public function getModerationPage($_zPageId) {
		
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

		$oPage	= $this->Page->get_Content($_zPageId);
		$zContent = $oPage["sfao_contenu"] ; 

		require_once (APPLICATION_PATH.'assets/fckeditor/fckeditor.php');

		$iModuleId = -1;
    	
		if($iRet == 1){	

			$zData = $zContent; 

			$oFCKeditor = new FCKeditor ('sfao') ;
			$oFCKeditor->BasePath = base_url().'assets/fckeditor/' ;
			$oFCKeditor->ToolbarSet	= 'Default' ;
			$oFCKeditor->Width	= '100%' ;
			$oFCKeditor->Height	= 600 ;
			$oFCKeditor->Value = $zData ;
			$zHtml =  $oFCKeditor->CreateHtml () ;

			$toReturn = array();
			$toReturn['zPageId'] = $_zPageId;
			$toReturn['zHtml'] = $zHtml;

			echo json_encode($toReturn); 
			
    	
		} else {
			$this->mon_cv();
		}

	}

	public function savePage(){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 39;

    	
		if($iRet == 1){	

			$zContent	= $this->postGetValue ("sfao",'') ;
			$zPageId	= $this->postGetValue ("zPageId",'offres-locales') ;

			$oData = array();
			$oData["sfao_contenu"] = $zContent ; 
			$this->Page->update ($oData, $zPageId) ; 

			echo "1";
    	
		} else {
			$this->mon_cv();
		}
    	
    }
}