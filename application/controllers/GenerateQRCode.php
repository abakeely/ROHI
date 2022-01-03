<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
ob_start();

class GenerateQRCode extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		$this->load->model('Candidat_model','CandidatService');
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
			
			// DECRYPTER000012g
			/*$decrypted_chaine = openssl_decrypt($encrypted_chaine, "AES-128-ECB" ,
			$key_password);
			var_dump($decrypted_chaine);*/
			$qrcode_content				=	$this->postGetValue('qrcode_content') ;
			//echo $qrcode_content;die;
			//$key_password 				= 	"ROHI";
			//$ztexte						=	openssl_encrypt($qrcode_content, "AES-128-ECB" ,$key_password);
			$absolute_path				=	"generateqrcode.png";
			$file						=	base_url() . "/" . "generateqrcode.png";
			QRcode::png($qrcode_content,$file);
			$oData['qrcode_content']	=   $qrcode_content;
			$oData['file']				=   $file;
			$this->load_my_view_Common('generate_qr_code/index.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("accueil/communique");
		}
    }
	
	
	
}