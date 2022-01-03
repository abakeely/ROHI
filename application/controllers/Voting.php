<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Voting extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Voting_model','VotingService');
		
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
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ; 
			$tzConditions				=	array();
			array_push($tzConditions," electeur_user_id ='".$oUser['id']."' ");
			$toVotes					=	$this->GenericCruds->findBy("rohi","vote_delegue",$tzConditions);
			$oData['toVotes']			=	$toVotes ; 
		
			if(sizeof($toVotes) == 2){
				$candidat_user_id			=	$toVotes[0]['candidat_user_id'];
				$toCandidats				=	$this->VotingService->getMesCandidats($oUser['id']);
			}else{
				$toCandidats				=	$this->VotingService->getCandidatVoting($oUser['id']);
			}
								//print_r(sizeof($toVotes) );die;

			$oData['toCandidats']		=	$toCandidats ; 
			$oData['nombreVote']		=	sizeof($toVotes) ; 
			if( $oCandidat[0]->direction ==190 ){
				$this->load_my_view_Common('voting/index.tpl',$oData, $iModuleId);	
			}else{
				$this->load_my_view_Common('voting/en_cours.tpl',$oData, $iModuleId);
			}
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function voterCandidat($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$oUser						=  array();
		$oCandidat					=  array();
		$iRet						=  $this->check($oUser, $oCandidat);
		$iCompteActif				=  $this->getSessionCompte();
		if($iRet == 1 && $oCandidat[0]->direction ==190){	
			$candidat_user_id			=	$this->postGetValue ("candidat_user_id","") ; 
			$electeur_user_id			=	$oUser["id"] ; 
			$date_vote					=	date("Y-m-d H:m:s")  ;
			$isDejaVote					=	$this->VotingService->checkIfDejaVote($candidat_user_id,$electeur_user_id);
			if ( $isDejaVote == "NOTEXIST" ){
				$this->VotingService->voterCandidat($candidat_user_id,$electeur_user_id,$date_vote);
				echo json_encode("NOTEXIST");
			}else{
				echo json_encode("EXIST");
			}			
		}else{
			echo "Vous n'êtes pas un agent de la DRH";
		}
    }

}