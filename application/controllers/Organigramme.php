<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Organigramme extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Organigramme_model','OrganigrammeService');
		$this->load->model('TraitementActe_model','TraitementActeService');
		$this->load->model('Gcap_gcap_model','GcapService');
		$this->load->model('GenericCruds_model','GenericCrudsService');
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
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$this->load_my_view_Common('gcap/organigramme.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	public function getTree($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$oUser						=	array();
		$oCandidat					=	array();
		$iRet						=	$this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$iNombreTotal			=	10;
			$iCompteActif			=	$this->getSessionCompte();
			//$iEvaluateurUserId		=	$this->GcapService->getEvaluateurAgent($oUser['id'],$this);
			$zAgentMemeEvaluateur	=	$this->GcapService->get_agents_evalues_par_user_id($oUser['id'],$this);
			$toListe				=	$this->OrganigrammeService->getTree($zAgentMemeEvaluateur);
			$torecords				=	array();
			$oDataTemp				=	array();
			$oDataTemp["id"]		=	$oUser['id'];
			$oDataTemp["pid"]		=	"";
			$oDataTemp["name"]		=	$oCandidat["0"]->nom ."  ".$oCandidat["0"]->prenom;
			$oDataTemp["title"]		=	$oCandidat["0"]->poste ;
			$oDataTemp["matricule"]	=	$oCandidat["0"]->matricule ;
			$oDataTemp["phone"]		=	$oCandidat["0"]->phone ;
			$oDataTemp["email"]		=	$oCandidat["0"]->email ;
			$oDataTemp["domaine"]	=	$oCandidat["0"]->domaine ;
			$oDataTemp["corps"]		=	$oCandidat["0"]->corps ;
			$oDataTemp["grade"]		=	$oCandidat["0"]->grade ;
			$oDataTemp["indice"]		=	$oCandidat["0"]->indice ;
			$oDataTemp["image"]		=	"http://rohi.mef.gov.mg:8088/ROHI/assets/upload/" .$oCandidat["0"]->id.".".$oCandidat["0"]->type_photo;
			array_push($torecords,$oDataTemp);
			foreach ($toListe as $oListe){
				//type_photo
				$oDataTemp				=	array();
				$oDataTemp["id"]		=	$oListe["id"];
				$oDataTemp["pid"]		=	$oUser['id'];
				$oDataTemp["name"]		=	$oListe["nom"] ."  ".$oListe["prenom"];
				$oDataTemp["title"]		=	$oListe["poste"] ;
				$oDataTemp["matricule"]	=	$oListe["matricule"] ;
				$oDataTemp["phone"]		=	$oListe["phone"] ;
				$oDataTemp["email"]		=	$oListe["email"] ;
				$oDataTemp["domaine"]	=	$oListe["domaine"] ;
				$oDataTemp["corps"]		=	$oListe["corps"] ;
				$oDataTemp["grade"]		=	$oListe["grade"] ;
				$oDataTemp["indice"]	=	$oListe["indice"] ;
				$oDataTemp["image"]		=	"http://rohi.mef.gov.mg:8088/ROHI/assets/upload/" .$oListe["id"].".".$oListe["type_photo"];
			//	print_r($oListe);die;
				array_push($torecords,$oDataTemp);
			}
		}
		$zReturn = json_encode($torecords);
		
		echo($zReturn);
    }
}