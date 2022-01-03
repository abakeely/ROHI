<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Confirmation extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();		
		$this->sessionStartCompte();
	}
	
	
	public function index($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
		if($iRet == 1){	
			/*$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ; 
			$tzConditions				=	array();
			array_push($tzConditions," electeur_user_id ='".$oUser['id']."' ");
			$toVotes					=	$this->GenericCruds->findBy("rohi","vote_delegue",$tzConditions);
			$oData['toVotes']			=	$toVotes ; 
		

			if( $oCandidat[0]->direction ==190 ){
				$this->load_my_view_Common('voting/index.tpl',$oData, $iModuleId);	
			}else{
				$this->load_my_view_Common('voting/en_cours.tpl',$oData, $iModuleId);
			}*/
			$this->load_my_view_Common('voting/en_cours.tpl',$oData, $iModuleId);
		} else {
			redirect("cv/mon_cv");
		}
    }


}