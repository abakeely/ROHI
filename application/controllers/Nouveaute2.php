<?php 
/**
* @package ROHI
* @subpackage Nouveauté 2
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nouveaute extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->checkConnect()){
			redirect('login');
		}
		$this->active_connect_to_sad();
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
	}
	
	public function nouveaute_liste(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/nouveaute_liste',$data);
	}
	public function nouveaute_liste1(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/nouveaute_liste1',$data);
	}
	public function collection_num(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num',$data);
	}
	public function collection_num_new(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new',$data);
	}
	public function collection_num_new_dico(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_dico',$data);
	}
	
	
	public function collection_num_new_info(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_info',$data);
	}
	
	
	public function collection_num_new_droit(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_droit',$data);
	}
	
	
	
	public function collection_num_new_envir(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_envir',$data);
	}
	public function collection_num_new_eco(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_eco',$data);
	}
	
	
	
	public function collection_num_new_gst(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_gst',$data);
	}
	
	public function collection_num_new_pas(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_pas',$data);
	}
	public function collection_num_new_voirplus(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_voirplus',$data);
	}
	public function collection_num_new_voirplus_2(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_voirplus_2',$data);
	}
	public function collection_num_new_voirplus_2_2(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/collection_num_new_voirplus_2_2',$data);
	}
	public function dico(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/dico',$data);
	}
	public function droit(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/droit',$data);
	}
	public function gestion(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/gestion',$data);
	}
		public function budget(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/budget',$data);
	}
		public function douane(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/douane',$data);
	}
		public function eco(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/eco',$data);
	}
		public function impot(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/impot',$data);
	}
	public function pas(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =2 ;
			
		$this->load_my_view('documentation/nouveaute/pas',$data);
	}
	public function autre(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();

		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =3 ;
			
		$this->load_my_view('documentation/nouveaute/autre',$data);
	}
	public function slade1(){
		if(!$this->checkConnect()){
			redirect('login');
		}
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =6 ;
		return $this->load_my_view('documentation/nouveaute/slade1',$data);
	}
}