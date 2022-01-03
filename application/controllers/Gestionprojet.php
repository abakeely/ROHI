<?php 
/**
* @package ROHI
* @subpackage Gestion de projet
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestionprojet extends MY_Controller {
    function __construct()
    {
        parent::__construct();
		
		$this->load->model('utilisateur_model','utilisateur');
        $this->load->model('projet_model','projet');
		$this->load->model('tache_model','tache');
		
		$this->load->library('form_validation');
    }
	
	/**
     * Redirige l'utilisateur vers la page creation_projet
     * l'utilisateur doit être connecté
     */
    function creation_projet()
    {
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$oData['menu_lucia'] =1 ;
		
		// on récupère la liste des responsables
		// nécessaire pour assigner la création de projet
	    $oData['sResponsable'] = $this->utilisateur->getResponsable();
		return $this->load_my_view('gestionprojet/creation_projet',$oData);
    }
	/**
     * Créer un projet grâce aux données présentes
     * dans l'envoi de formulaire par méthode POST
     */
    function creation()
    {
        $sPnom = $_POST['nom_du_projet'];
        $sPdescr = $_POST['description_du_projet'];
        $sRespoId = $_POST['responsable'];
        
		$idProjet = $this->projet->create($sPnom, $sPdescr);
		
        $this->projet->createAffectation($sRespoId, $idProjet);
        redirect('gestionprojet/liste_projet');
    }
	
    public function liste_projet(){
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$oData['menu_lucia'] =1 ;
		
        $oData['sProjets']= $this->projet->all();
		$oData['dep']=$this->projet->get_projet();
		$oData['sResponsable'] = $this->user->get_responsable_projet();
		return $this->load_my_view('gestionprojet/liste_projet',$oData);
	}
	public function delete($iPnum){
			$this->projet->deleteProjet($iPnum);
			 redirect('gestionprojet/liste_projet');
	}
	
	public function list_chart(){
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$oData['menu_lucia'] =1 ;
		
		$oData['projets']= $this->projet->all();
		$oData['dep']=$this->projet->get_projet();
		return $this->load_my_view('gestionprojet/list_chart',$oData);
	}
	
	
	function view_gantt(){
		
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		
		$sPnom = "projet1";
		$projets = $this->projet->get_projet();
		$new_projets = array();
		foreach($projets as $projet){
			$projet->taches = $this->projet->get_all_tache_by_projet_id($projet->pnum);
			array_push($new_projets,$projet);
		}
		$oData['projets'] = $new_projets;
		$this->load_my_view('gestionprojet/view_gantt',$oData);
	}
	
	function view_calendrier(){
		
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$sPnom = "projet1";
		$projets = $this->projet->get_projet();
		$new_projets = array();
		foreach($projets as $projet){
			$projet->taches = $this->projet->get_all_tache_by_projet_id($projet->pnum);
			array_push($new_projets,$projet);
		}
		$oData['projets'] = $new_projets;
		$this->load_my_view('gestionprojet/view_calendrier',$oData);
	}
	
	public function view_imprimer(){
		
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$oData['menu_lucia'] =1 ;
		
         $oData['sProjets']= $this->projet->all();
		 $oData['dep']=$this->projet->get_projet();
		return $this->load_my_view('gestionprojet/view_imprimer',$oData);
	}
    /**
     * Charge le projet sélectionné et lance la fonction GestionView
     */
    function index(){
		 
        if(isset($_POST['pnom'])){
            $currentProject = array('pnom' => $_POST['pnom']);
            $this->session->set_userdata('projet_actuel',$currentProject);
        }
        $this->GestionView();
    }
    /**
     * Redirige l'utilisateur en fonction de son statut de profil
     *
     */
    function GestionView(){
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$sPnom = $this->session->userdata['projet_actuel']['pnom'];
		
		$oData['projet'] = $this->projet->get($sPnom);
		$iPnum = $this->projet->getNum($sPnom)->pnum;
		$oData['utilisateur_actuel'] = $this->session->userdata;
		$oData['utilisateurs'] = $this->projet->getAllUsersByProjectNumero($iPnum);
		$oData['equipier'] = $this->projet->getAllUsersByProjectNumero($iPnum);
		$oData['utilisateurs_non_affecte'] = $this->projet->getAllUsersNonAffectes($iPnum);
		$oData['taches'] = $this->projet->getAllTachesByProjectNumero($iPnum);
		return $this->load_my_view('gestionprojet/gestion_projet',$oData);
    }
	
	function consulter($idProjet=false){
		if($idProjet){
			$oData = array();
			$oData['menu'] = 3;
			$oData['iModuleActif'] = -51;
			$oData['projet'] = $this->projet->get_by_id($idProjet);
			$iPnum = $this->projet->getNum($sPnom)->pnum;
			//$oData['utilisateur_actuel'] = $this->session->userdata;
			$oData['utilisateurs'] = $this->projet->getAllUsersByProjectNumero($idProjet);
			$oData['equipier'] = $this->projet->getAllUsersByProjectNumero($idProjet);
			$oData['utilisateurs_non_affecte'] = $this->projet->getAllUsersNonAffectes($idProjet);
			$oData['taches'] = $this->projet->getAllTachesByProjectNumero($idProjet);
			return $this->load_my_view('gestionprojet/gestion_projet',$oData);
		}
	}
    /**
     * Modifie la descripition et le nom d'un projet
     */
    function modificationProjet(){
		
		$sPnom =  $_POST['pnom'];
		$sPdescr = $_POST['pdescr'];
		$iPnum =  $_POST['pnum'];
		$currentProject = array('pnom' => $_POST['pnom']);
		$this->session->set_userdata('projet_actuel',$currentProject);
		$this->projet->setName($iPnum,$sPnom);
		$this->projet->setDescr($iPnum,$sPdescr);
        redirect('gestionprojet');
    }
    /**
     * Ajoute une tache au projet
     */
    function addTache(){
		
		$sPnom = $this->session->userdata['projet_actuel']['pnom'];
		$iPnum = $this->projet->getNum($sPnom)->pnum;
		$iUnum = $_POST['user_id'];
		$sText = $_POST['text'];
		$sTdescr = $_POST['tdescr'];
		$start_date = $_POST['start_date'];
		$iDuration = $_POST['duration'];
		$progress = $_POST['progress'];
		$iParent = $_POST['parent'];
		$end_date = $_POST['end_date'];
		$iId = $_POST['gantt_id'];
		$tetat = 'À faire';
		$dep_id = $_POST['dep_id'];
		$iUnum = intval($iUnum);
		$iPnum = intval($iPnum);
		$this->tache->create($iId,$iPnum,$iUnum,$sText,$sTdescr,$start_date,$iDuration,$progress,$iParent,$end_date,$tetat );
		$iId = $this->tache->get($sText)->gantt_id;
        redirect('gestionprojet');
    }
    /**
     * Ajoute un membre au projet
    */
    function addMembre(){
		
		$iUnum = $_POST['id'];
		$sPnom = $this->session->userdata['projet_actuel']['pnom'];
		$iPnum = $this->projet->getNum($sPnom)->pnum;
		$this->projet->createAffectation($iUnum, $iPnum);
        redirect('gestionprojet');
    }
    /**
     * Supprime un membre du projet
     */
    function delMembre(){
		
		$iUnum = $_POST['id'];
		$sPnom = $this->session->userdata['projet_actuel']['pnom'];
		$iPnum = $this->projet->getNum($sPnom)->pnum;
		$this->projet->delAffectation($iUnum, $iPnum);
        redirect('gestionprojet');
    }
    /**
     * Affecte un membre à une tache
    */
    function affectationTache(){
        $iId =  $_POST['id'];
        $iUnum =  $this->session->userdata['logged_in']['id'];
        $sPnom =  $this->session->userdata['projet_actuel']['pnom'];
        $iPnum = $this->projet->getNum($sPnom)->pnum;
        $this->projet->createAffectation($iUnum, $iPnum);
	    $this->tache->setUser($id,$iUnum);
        redirect('gestionprojet');
    }
	
	/*public function delete($iGanttId){
		$this->projet->deleteTache($iGanttId);	
	redirect('gestionprojet');
	}*/
	
	public function edit($iGanttId){
		
		$oData = array();
		$oData['menu'] = 3;
		$oData['iModuleActif'] = -51;
		$oData['menu_lucia'] =1 ;
		$oData['tache'] = $this->tache->getAllRecords($iGanttId);
		return $this->load_my_view('gestionprojet/modificationTache',$oData);
    }
	
	public function update($iGanttId){
		
		$this->form_validation->set_rules('text','NomTache','required');
		$this->form_validation->set_rules('tdescr','Description','required');
		$this->form_validation->set_rules('start_date','date initiale','required');
		$this->form_validation->set_rules('end_date','date finale','required');
		$this->form_validation->set_rules('duration','duree','required');
		$this->form_validation->set_rules('parent','parent','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if($this->form_validation->run() )
		{
			$oData= $this->input->post();
		
			if($this->tache->updateRecords($iGanttId,$oData)){
				$this->session->set_flashdata('response','utilisateur modifié!');
			}
			else{
				$this->session->set_flashdata('response','');
			}
			 redirect('gestionprojet');
		}
		else{
			return $this->load_my_view('gestionprojet/modificationTache',$oData);
		}
   }
}
?>