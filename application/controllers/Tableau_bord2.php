<?php 
/**
* @package ROHI
* @subpackage Tableau de bord
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tableau_bord extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pret_livre_model','pret_livre');
		$this->load->model('livre_model','livre');
		$this->load->model('pret_livre_model','pret_livre');
		$this->load->model('responsable_biblio_model','resp_biblio');
		$this->load->model('consultation_sur_place_model','consultation');
		$this->load->model('connexion_internet_model','connexion_net');
		$this->load->model('sad_bilan_model');
		
	}
	
	
	
	public function bilan(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10 ;
			
		
		$data['sListeAgentBcpLivre']= $this->sad_bilan_model->get_liste_agent_empreinte_bcp_livre();
		$data['sListeDepartement']= $this->sad_bilan_model->get_liste_departement();
		$data['sListeDirection']= $this->sad_bilan_model->get_liste_direction();
		$data['sListeService']= $this->sad_bilan_model->get_liste_service();
		$data['sListeAgentUnLivre']= $this->sad_bilan_model->get_liste_agent_empreinte_une_livre();
		$data['sListePlanning']= $this->sad_bilan_model->get_liste_planning();
		$data['sListeLivreEmpreinte'] = $this->sad_bilan_model->get_liste_plus_empreinte();
		
		$this->load_my_view('documentation/tableau_bord/bilan',$data);
		
		
		
		
	}
	

	public function consult_place(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10 ;
		
		$data['list_province'] = $this->province->get_province();
		$data['list_departement'] = $this->departement->get_departement();
		$data['list_respo'] = $this->resp_biblio->get_all_responsable();
	
		$this->load_my_view('documentation/tableau_bord/form_consult_place',$data);
	}
	
	public function connexion_internet(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10 ;
		
		$data['list_province'] = $this->province->get_province();
		$data['list_departement'] = $this->departement->get_departement();
		$data['list_respo'] = $this->resp_biblio->get_all_responsable();
		
		$this->load_my_view('documentation/tableau_bord/form_connexion',$data);
	}
	

	public function list_lecture_sur_place(){
		$list_consultation = $this->consultation->get_all_consultation_affiche();
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10 ;
		$data['list_consultation'] = $list_consultation;
		$this->load_my_view('documentation/tableau_bord/list_consultation',$data);
	}
	
	public function list_connexion_net(){
		$list_consultation = $this->connexion_net->get_all_connexion_internet_affiche();
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10 ;
		$data['list_consultation'] = $list_consultation;
		$this->load_my_view('documentation/tableau_bord/list_connexion_net',$data);
	}
	
	public function ajout_lecture(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data_lecture = array();
		$data_lecture['statut'] = $_POST['statut'];
		$data_lecture['matricule'] = $_POST['matricule'];
		$data_lecture['nom_prenom'] = $_POST['nom_prenom'];
		$data_lecture['etablissement'] = $_POST['etablissement'];
		$data_lecture['date_lecture'] = date('Y-m-d\TH:i:s');
		
		$data_lecture['adresse'] = $_POST['adresse'];
		$data_lecture['province_id'] = $_POST['province'];
		$data_lecture['region_id'] = $_POST['region'];
		$data_lecture['district_id'] = $_POST['district'];
		$data_lecture['departement_id'] = $_POST['departement'];
		$data_lecture['direction_id'] = $_POST['direction'];
		$data_lecture['service_id'] = $_POST['service'];
		$data_lecture['cote_livre'] = $_POST['cote'];
		
		$data_lecture['responsable'] = $_POST['statut'];
		$data_lecture['etat'] = 0;
		
		$this->consultation->insert($data_lecture);
		
		redirect('tableau_bord/list_lecture_sur_place');
	}
	
	public function ajout_connexion_internet(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data_lecture = array();
		$data_lecture['statut'] = $_POST['statut'];
		$data_lecture['matricule'] = $_POST['matricule'];
		$data_lecture['nom_prenom'] = $_POST['nom_prenom'];
		$data_lecture['etablissement'] = $_POST['etablissement'];
		$data_lecture['date_lecture'] = date('Y-m-d\TH:i:s');
		
		$data_lecture['adresse'] = $_POST['adresse'];
		$data_lecture['province_id'] = $_POST['province'];
		$data_lecture['region_id'] = $_POST['region'];
		$data_lecture['district_id'] = $_POST['district'];
		$data_lecture['departement_id'] = $_POST['departement'];
		$data_lecture['direction_id'] = $_POST['direction'];
		$data_lecture['service_id'] = $_POST['service'];
		$data_lecture['titre_recherche'] = $_POST['titre'];
		
		$data_lecture['responsable'] = $_POST['statut'];
		$data_lecture['etat'] = 0;
		
		$this->connexion_net->insert($data_lecture);
		
		redirect('tableau_bord/list_connexion_net');
	}
	
	/*public function bilan(){
		$data = array();
		$data['iModuleActif'] = -2;

		$data_stat_pret = array();
		$data_stat_consul_place = array();
		$data_stat_consul_net = array();

		$data['data_stat_pret'] = $data_stat_pret;
		$data['data_stat_consul_net'] = $data_stat_consul_net;
		$data['data_stat_consul_place'] = $data_stat_consul_place;
		
		$data['tot_pret'] = $this->somme($data_stat_pret);
		$data['tot_net'] = $this->somme($data_stat_consul_net);
		$data['tot_place'] = $this->somme($data_stat_consul_place);

		$this->load_my_view('documentation/tableau_bord/bilan',$data);
	}
	
	public function show_bilan(){
		$debut = $this->date_fr_to_en($_POST['debut'],"/","-");
		$fin = $this->date_fr_to_en($_POST['fin'],"/","-");
				
		$date_cours = $debut;
		$date_last = $debut;
		
		$data_stat_pret = array();
		$data_stat_consul_place = array();
		$data_stat_consul_net = array();
		
		while($date_cours!=$fin){
			$row_pret = array();
			$row_net = array();
			$row_place = array();
			$date_fr = $this->date_en_to_fr($date_cours,"-","/");
			$row_pret['date'] = $row_net['date'] = $row_place['date'] = $date_fr;
			
			$date_cours = $this->add_day_to_date($date_cours,1);
			
			$nbr_pret = $this->pret_livre->get_nombre_by_intervalle($date_last,$date_cours);
			$row_pret['nb'] =  $nbr_pret->nb;
			
			$nbr_net = $this->connexion_net->get_nombre_by_intervalle($date_last,$date_cours);
			$row_net['nb'] =  $nbr_net->nb;
			
			$nbr_place = $this->consultation->get_nombre_by_intervalle($date_last,$date_cours);
			$row_place['nb'] =  $nbr_place->nb;
			
			$date_last = $date_cours;
			
			array_push($data_stat_pret,$row_pret);
			array_push($data_stat_consul_net,$row_net);
			array_push($data_stat_consul_place,$row_place);
		}
		
		$data = array();
		$data['iModuleActif'] = -2;
		$data['data_stat_pret'] = $data_stat_pret;
		$data['data_stat_consul_net'] = $data_stat_consul_net;
		$data['data_stat_consul_place'] = $data_stat_consul_place;
		
		$data['tot_pret'] = $this->somme($data_stat_pret);
		$data['tot_net'] = $this->somme($data_stat_consul_net);
		$data['tot_place'] = $this->somme($data_stat_consul_place);
		$data['show_bilan'] = true;
		
		$this->load_my_view('documentation/tableau_bord/bilan',$data);
	}
	
	private function somme($list){
		$ret = 0;
		foreach($list as $row){
			$ret += $row['nb'];
		}
		return $ret;
	} */
	
}