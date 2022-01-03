<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
ob_start();

class Reporting extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Reporting_model','ReportingService');
		$this->load->library('Phpword');
		$this->load->library('parser');
		$this->sessionStartCompte();
	}

	
	public function pointage($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		$string							= "answer_comments_1";
		$mois							= isset($_POST["mois"])?$_POST["mois"]:"";
		$annee							= isset($_POST["annee"])?$_POST["annee"]:"";
		
		if($iRet == 1){	
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ; 			
			$oData['annee']				= $annee ; 			
			$oData['mois']				= $mois ; 	
			if( $mois!="" && $annee!="" ){
				$numberRow				= $this->ReportingService->numberRows($mois,$annee)[0]["total"];
				$oData['numberRow']		= ceil($numberRow/2000) ;
				$oData['total']			= $numberRow ;
			}
			 			
			$this->load_my_view_Common('reporting/pointage.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("accueil/communique");
		}
    }
	
	
	public function setExcelRapports($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		$string							= "answer_comments_1";
		
		if($iRet == 1 ){	
			if( 
			$oUser["im"] == "333690" || 
			$oUser["im"] == "355577" || 
			$oUser["im"] == " 332026"|| 
			$oUser["im"] == " 391713"
		){	
				$oData['iUserId']			= $oUser['id'] ;
				$oData['iSessionCompte']	= $iSessionCompte ; 
				$mois						= $_GET["mois"];
				$annee						= $_GET["annee"];
				$line						= $_GET["line"];
				
				$this->ReportingService->setExcelRapports($mois,$annee,$line*2000,($line+1)*2000);
				$this->load_my_view_Common('reporting/pointage.tpl',$oData, $iModuleId);
			}			
		
		} else {
			redirect("accueil/communique");
		}
    }
	
	

	
}