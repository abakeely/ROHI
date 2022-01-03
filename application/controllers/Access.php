<?php
/**
* @package ROHI
* @subpackage Accès
* @author Division Recherche et Développement Informatique
*/
ob_start();
class Access extends MY_Controller {

	/**  
	* Classe qui concerne accès
	* @package  ROHI  
	* @subpackage ACCES */ 

	public function __construct(){
		parent::__construct();
	}
	
	/** 
	* Insertion de données matricule
	*
	* @param tableau $oData 
	* @return view
	*/
	public function index(){
        
		global $oSmarty ;
		$oData = $this->session->flashdata('oData');

		if(!$oData){
			$oData = array();
		}
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 76;
		$corps = $this->corps->get_corps();
		$grade = $this->grade->get_grade();
		$indice = $this->indice->get_indice();
		$statut = $this->statut->get_statut();
		$oData['list_corps'] = $corps;
		$oData['list_grade'] = $grade;
		$oData['list_indice'] = $indice;
		$oData['list_statut'] = $statut;
		$this->load_my_view_Common('access/access.tpl',$oData,$iModuleId);
    }
	
	/** 
	* Sauvegarde ECD
	*
	* @return view
	*/
	public function save_ecd(){
		
		$nom           = $_POST['nom'];
		$prenom		   = $_POST['prenom'];
		$cin           = $_POST['cin'];
		$genre           = $_POST['sexe'];
		$login		   = $_POST['login'];
		$mdp		   = $_POST['password'];
		$conf_mdp	   = $_POST['confirm_password'];
		
		$oData = array();
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		
		
		$oData['login'] = $login;
		$oData['password'] = $mdp;
		$oData['im'] = "ECD";
		$oData['role'] = 'user';
		$oData['sexe'] = $genre;
		$oData['cin'] = $cin;
		$oData['nom'] = $nom;
		$oData['prenom'] = $prenom;
		$oData['corps_id'] = null;
		$oData['indice_id'] = null;
		$oData['grade_id'] = null;
		$oData['statut'] = 2;
		$oData['validate'] = true;
		
		$isError = false;
		if($login!='' && $mdp!='' && $nom!='' && $prenom!='' && $cin!=''){
			if(!$this->user->existe($login)){
				if($mdp == $conf_mdp){
					$iUserId = $this->user->createUser($oData);
					$dataPassword['password'] = $mdp;
					$this->user->update_password($iUserId,$dataPassword);
				}
				else{
					$isError = true;
					$msg_error = "Votre mot de passe ne correspond pas à sa confirmation";
				}
			}
			else{
				 $isError = true;
				 $msg_error = "Le Pseudo existe déjà";
			}
		}
		else{
			$isError = true;
			$msg_error = "Veuillez remplir les champs obligatoires";
		}
		
		if($isError){
			$oData['msg_error'] = $msg_error;
		}
		else{
			$oData['msg_success'] = "Votre compte a été créé avec succès";
		}
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 77;
		return $this->load_my_view_Common('access/ecd.tpl',$oData,$iModuleId);
	}
	
	/** 
	* Sauvegarde matricule
	*
	* @return view
	*/
	public function save_im(){
		$im           = $_POST['im'];
		$cin           = $_POST['cin'];
		$nom           = $_POST['nom'];
		$prenom		   = $_POST['prenom'];
		$statut		   = $_POST['statut'];
		$corps		   = $_POST['corps'];
		$grade		   = $_POST['grade'];
		$indice		   = $_POST['indice'];
		$date_service  = $_POST['date_prise_service'];
		$date_naiss	   = $_POST['date_naiss'];
		$nb_enfant	   = $_POST['nbr_enfant'];
		$isError = false;
		$dataIM = array();
		if(!$this->matricule->existe($im)){
			$dataIM['libele'] = $im;
			$dataIM['cin'] = $cin;
			$dataIM['nom'] = $nom;
			$dataIM['prenom'] = $prenom; 
			$dataIM['corps_id'] = $corps; 
			$dataIM['grade_id'] =  $grade;
			$dataIM['indice_id'] = $indice	;
			$dataIM['date_naissance'] = $date_naiss;
			$dataIM['nb_enfant'] = $nb_enfant;
			$dataIM['date_service'] = $date_service;
			$dataIM['statut'] = $statut;
			$this->matricule->insert($dataIM);
			$dataIM['msg_success'] = "Votre compte a été créé avec succès";
			$this->session->set_flashdata('oData', $dataIM);
			redirect('access/index', 'refresh');
		}else{
			$dataIM['msg_error'] = $msg_error;
			$this->session->set_flashdata('oData', $dataIM);
			redirect('access/index', 'refresh');
		}
	}
   
	/** 
	* Affichage ECD
	*
	* @return view
	*/
	public function ecd(){
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['menu'] = 77;
		
		return $this->load_my_view_Common('access/ecd.tpl',$oData,$iModuleId);

 }	
}