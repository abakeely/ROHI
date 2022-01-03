<?php
/**
* @package ROHI
* @subpackage Cv
* @author Division Recherche et Développement Informatique
*/

ob_start();
class Cv extends MY_Controller {

	/**  
	* Classe qui concerne le CV
	* @package  ROHI  
	* @subpackage CV */ 

	public function __construct(){
		parent::__construct();
		
		
		$this->load->model('user_historique_model','user_historique');
		$this->load->model('candidat_historique_model','candidat_historique');
		$this->load->model('mouvement_candidat_model','mouvement_candidat');
		$this->load->model('candidat_activite_model','candidat_activite');
		$this->load->model('histo_info_administra_model','histo_info_administra');
		$this->load->model('evaluation2_gcap_model','evaluation2');
		$this->load->model('Transaction_pointage_model','Transaction');
		$this->load->model('division_model','division');
		$this->load->model('demande_formation_model','demande_formation');
		$this->load->model('contenu_champ_formation_model','contenu_champ_formation');
		$this->load->model('theme_formation_model','theme_formation');
		$this->load->model('module_formation_model','module_formation');     
		$this->load->model('contenu_formation_model','contenu_formation');
		
	}
      
	/** 
	* form liste cv
	*
	* @param integer $candidat_id identifiant du candidat
	* @return view
	*/
    function get_data_list_for_form_cv($candidat_id=false){
            $data = array();
            if($candidat_id){
            	$candidat = current($this->candidat->get_by_id($candidat_id));
            }
            else{
            	$candidat = $this->get_connected_candidat();
            }
            
            $sit_mat = $this->situation_mat->get_situation();
            $niveau = $this->niveau->get_niveau();

            $corps = $this->corps->get_corps();
            $grade = $this->grade->get_grade();
            $indice = $this->indice->get_indice();
            
            $departement = array();
            
            if(empty($candidat->district_id)){
            	$departement = $this->departement->get_departement();
            }
            else{
            	$departement = $this->departement->get_depart_by_district_id($candidat->district_id);
            }
            $direction = array();
            if(isset($candidat->departement)){
            	$direction = $this->direction->get_by_departement($candidat->departement);
            }
            else{
            	//$direction = $this->direction->get_direction_by_district_id($candidat->district_id,$candidat->departement);
            }
            
            $service = array();
            //if($candidat->direction){
            if(isset($candidat->direction)){
            	$service = $this->service->get_by_direction($candidat->direction);
            }
            else{
            	//$service = $this->service->get_service_by_district_id($candidat->district_id,$candidat->direction);
            }
            $division = array();
            if(isset($candidat->service)){
           		 $division = $this->division->get_division_by_service_id($candidat->service);
            }
            
			$statut = $this->statut->get_statut();
            $district = $this->district->get_district();
           // var_dump($district);
            $pays = $this->pays->get_pays();
            
            
            $data['list_sit_mat'] = $sit_mat;
            $data['list_niveau'] =  $niveau;

            $data['list_corps'] = $corps;
            $data['list_grade'] = $grade;
            $data['list_indice'] = $indice;
            $data['list_departement'] = $departement;
            $data['list_direction'] = $direction;
            $data['list_service'] = $service;
            $data['list_district'] = $district;
            $data['list_pays'] = $pays;
            $data['list_division'] = $division;
            
			$data['list_statut'] = $statut;
			
            $data['edit'] = false;
            return $data;
            
        }
        
    /** 
	* preremplissage candidat pour le formulaire
	*
	* @return view
	*/
	 public function get_current_candidat_completed_for_form(){
          $candidat = $this->get_connected_candidat();
	      return $this->complete_candidat_for_form($candidat);
     }
     

	/** 
	* candidat connecté en cours
	*
	* @return view
	*/
     private function get_connected_candidat(){
     	$user_id = $this->get_user_data('id');
     	$candidat = current($this->candidat->get_by_user_id($user_id));
     	return $candidat;
     }
    
	/** 
	* complete candidat form
	*
	* @return view
	*/	
    private function complete_candidat_for_form($candidat){
    	if(!empty($candidat)){
    		$candidat->date_naiss = $this->date_en_to_fr($candidat->date_naiss,'-','/');
    		$candidat->date_prise_service = $this->date_en_to_fr($candidat->date_prise_service,'-','/');
    		$candidat->image_url = $this->calculImageUrl($candidat->id,$candidat->type_photo);
    		$candidat->diplome_list = $this->candidat_diplome->get_diplome_candidat($candidat->id);
    		$candidat->region = $this->region->get_region($candidat->region_id);
    		$candidat->province = $this->province->get_province($candidat->province_id);
    			
    		$candidat->date_prise_service = $this->date_en_to_fr($candidat->date_prise_service,'-','/');
    			
    		$parcours_list = array();
    		$parcours_list_bo = $this->candidat_parcours->get_parcours_candidat($candidat->id);
    		foreach($parcours_list_bo as $parcours){
    			$parcours['date_debut'] = $this->date_en_to_fr($parcours['date_debut'],'-','/');
    			$parcours['date_fin'] = $this->date_en_to_fr($parcours['date_fin'],'-','/');
    			array_push($parcours_list, $parcours);
    		}
    		$candidat->parcours_list = $this->candidat_parcours->get_parcours_candidat($candidat->id);
    		$candidat->activite_list = $this->candidat_activite->get_activite_candidat($candidat->id);
    		
    		$candidat->soa_list = $this->service->get_soa_by_service_id($candidat->service);
    	}
    	return $candidat;
    }

	/** 
	* redirection vers l'accueil
	*
	* @return view
	*/	
    public function index(){
		redirect('accueil/communique');	
    }


	/** 
	* preremplissage de la formation
	*
	* @return view
	*/	
	function complete_formation($demande){
		if(empty($demande))
			return null;
		
		$formation = $this->demande_formation->get_demande_formation_by_user_id($demande['user_id']);
		$id_formation = $formation['id'];
		$demande['list_attribution'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,1);
		$demande['list_tache'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,2);
		$demande['list_post'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,3);
		$demande['list_produit'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,4);
		$demande['list_formation_acad'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,5);
		$demande['list_formation_prof'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,6);
		$demande['list_requi'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,7);
		$demande['list_faire'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,8);
		$demande['list_etre'] = $this->contenu_champ_formation->get_contenu_champ_formation($id_formation,9);
		$demande['list_theme_formation'] = $this->theme_formation->get_theme_formation($formation['theme_formation']);
		$demande['list_module_formation'] = $this->module_formation->get_module_formation_by_theme($formation['theme_formation']);
		$demande['list_contenu_formation'] = $this->contenu_formation->get_contenu_by_module_id($formation['theme_formation']);
		
		$demande['list_theme_formation'] = $this->theme_formation->get_theme_formation();
		return $demande;
	}

	/** 
	* Webservice avancement des agent
	*
	* @param int $iMatricule matricule de l'agent
	* @return view
	*/	
	private function AvancementAgent($iMatricule) 
	{
		$zData1 = @file_get_contents(ADMIN_TEMPLATE_PATH ."cv/avance.txt"); 

		$zData1 = str_replace("%MATRICULE%",trim($iMatricule), $zData1) ; 

		$zAvancementAffiche = @file_get_contents($zData1);

		$oAvancementAffiche = array();
		if ($zAvancementAffiche != "") {
			$oAvancementAffiche = json_decode ($zAvancementAffiche);

			if (sizeof($oAvancementAffiche)>0){
				foreach ($oAvancementAffiche as $iKey => $zValue) {
					$oAvancementAffiche = $zValue ; 
				}
			}
			
		} else {

			$oAvancementAffiche = array();
		}

		return $oAvancementAffiche ; 
	}
	

	/** 
	* mon cv, page formulaire CV
	*
	* @return view
	*/	
	public function mon_cv($type = FALSE)
	{
		$this->checkConnexion();

		$oUser = $this->get_current_user();

		$data = $this->get_data_list_for_form_cv();

		$data['candidat_id_edit'] = 0;
		if (isset($_GET['id']) && ($_GET['id'] != '')){

			if ($oUser['role']=="admin" || $oUser['role']=="chef") {
				$candidat = current($this->candidat->get_by_id($_GET['id']));
				$candidat = $this->complete_candidat_for_form($candidat);
				$user =  $this->user->get_user($candidat->user_id);
				$data['candidat_id_edit'] = $candidat->id;
				$data['edit_cv'] = true;
			} else {
				$user = $this->get_current_user();
			}

		} else {
			$user = $this->get_current_user();
		}
		
		
		$role = $user['role']; 

		$iMatricule = $user['im'];
		
		

		$toAvancement = $this->AvancementAgent($iMatricule);
		$this->candidat->update_corpsGradeIndice($user['id'], $toAvancement) ; 
		
		 if($type){
			if($type==1)
				$data['msg'] = "Votre CV est enregistr&eacute;";
			if($type==2)
				$data['msg'] = "Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s,  veuillez remplir votre CV.";

			if($type==3)
				$data['msg'] = "Votre CV est enregistr&eacute;. <br/>Veuillez contacter votre &eacute;valuateur pour valider votre localit&eacute; de service";
		}
				
		if($user['exist_cv']){
			if (isset($_GET['id']) && ($_GET['id'] != '')){
				if ($oUser['role']=="admin" || $oUser['role']=="chef") {
				$candidat = current($this->candidat->get_by_id($_GET['id']));
				$candidat_bo = $this->complete_candidat_for_form($candidat);
				$data['candidat'] = $candidat_bo ;
				$user['statut'] = $candidat_bo->statut;
				} else {
				$user = $this->get_current_user();
			}
			} else {
				$candidat_bo = $this->get_current_candidat_completed_for_form(); 
				$data['candidat'] = $candidat_bo ;
				$user['statut'] = $candidat_bo->statut;
			}
		}
		else{
			$mat = null;
			$im = $user['im'];
			$nom = $user['nom'];
			if(!is_numeric($im))
				$mat =  current($this->matricule->get_matricule($im,$nom));
			else
				$mat =  current($this->matricule->get_matricule($im));
			
			if($mat){
				$user['exist_corps'] = true;
				$user['matricule'] = $mat;
			}
		}
		
		
		
		$data['user_edit'] = $user;
		$this->load->model('compte_gcap_model','Compte');
		$toComptes = $this->Compte->get_by_compte_evaluateur_UserId($user['id']);

		$data['toComptes'] = $toComptes;
		$data['iModuleActif'] = 0;
		$data['toAvancement'] = $toAvancement;
		$this->load_my_view('cv/form_cv',$data);
		
	}
       
	/** 
	* page view
	*
	* @param string $page home
	* @return view
	*/	
	public function view($page = 'home')
	{
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			show_404();
		}
                
		$data['title'] = ucfirst($page); 
        $this->load_my_view($page,$data);
	}
	
	/** 
	* nouveau CV
	*
	* @return view
	*/	
	public function new_cv(){
		$this->checkConnexion();
		
		$data = $this->get_data_list_for_form_cv();
		$data['edit'] = false;
                $data['menu'] = 2;
		$this->load_my_view('cv/form_cv',$data);
	}

	/** 
	* liste CV
	*
	* @return view
	*/
	public function list_cv($succes=false){
		$this->checkConnexion(array('admin','resp','chef'));
		
		$list_candidat = null;
		$user = $this->get_current_user();
		$candidat = current($this->candidat->get_by_user_id($user['id'] ));
		if($user['role'] == 'chef'){
			$list_candidat = $this->get_candidat_subordonnee($user,$candidat);
		}
		else if($user['role'] == 'admin'){
			$list_candidat = $this->candidat->get_all_list_valide($candidat->service);
		}
		
		
		$data = array();
		$list_fin = $this->complete_array_canditat($list_candidat);
		$data['list_candidat'] = $list_fin;
		
		$list_departement = $this->departement->get_departement();
		$data['list_departement'] = json_encode($list_departement);
		$list_region  = $this->region->get_region();
		$data['list_region'] = json_encode($list_region);
		$data['menu'] = 4;
		
		if($succes)
			$data['msg'] = "Op&eacute;ration effectu&eacute;e ";
		
        $this->load_my_view('cv/liste_cv_dep',$data);
	}
	
	/** 
	* liste all cv
	*
	* @return view
	*/
	public function list_all_cv(){
		$this->checkConnexion(array('admin','resp','chef'));
		
		$list_candidat = $this->candidat->get_all_list_valide();
		
		$data = array();
		$list_fin = $this->complete_array_canditat($list_candidat);
		$data['list_candidat'] = $list_fin;
		
		//var_dump($list_fin);
		$data['menu'] = 4;
		
        $this->load_my_view('cv/liste_cv',$data);
	}
	
	/** 
	* ajouter à mon departement
	*
	* @return view
	*/
	public function add_to_my_dep($candidat_id=false,$service_id=false){
		$this->checkConnexion(array('admin','resp','chef'));	
		if($candidat_id){
			$my_user = $this->get_current_user();
			$mouvement = array();
			$candidat = current($this->candidat->get_by_id($candidat_id));
			$mouvement['old_dep_id'] = $candidat->departement;
			$mouvement['old_dir_id'] = $candidat->direction;
			$mouvement['old_serv_id'] = $candidat->service;
			$mouvement['resp_id'] = $my_user['id'];
			
			$my_cand = current($this->candidat->get_by_user_id($my_user['id']));
			$candidat->departement = $my_cand->departement;
			$candidat->direction = $my_cand->direction;
			if($service_id)
				$candidat->service = $service_id;
			
			$mouvement['new_dep_id'] = $my_cand->departement;
			$mouvement['new_dir_id'] = $my_cand->direction;
			$mouvement['new_serv_id'] = $service_id;
			$mouvement['candidat_id'] = $candidat_id;
			
			$this->candidat->update($candidat,$candidat_id);
			$mouvement['type'] = 2;			
			$this->mouvement_candidat->create_mouvement($mouvement);
		}
		else{
		}
		redirect('cv/list_cv/succes');
	}
	
	/** 
	* supprimer à mon departement
	*
	* @return view
	*/
	public function remove_from_my_dep($candidat_id=false,$dep_dest=false,$dir_dest=false,$serv_dist=false,$reg_dest=false){
		$this->checkConnexion(array('admin','resp','chef'));
		$user = $this->get_current_user();		
		if($candidat_id){
			$mouvement = array();
			$candidat = current($this->candidat->get_by_id($candidat_id));
			$mouvement['old_dep_id'] = $candidat->departement;
			$mouvement['old_dir_id'] = $candidat->direction;
			$mouvement['old_serv_id'] = $candidat->service;
			$mouvement['old_reg_id'] = $candidat->region_id;
			$mouvement['resp_id'] = $user['id'];
			
			if($dep_dest){
				$candidat->departement = $dep_dest;
				$mouvement['new_dep_id'] = $dep_dest;
			}
			if($dir_dest){
				$candidat->direction = $dir_dest;
				$mouvement['new_dir_id'] = $dir_dest;
			}
			if($serv_dist){
				$candidat->service = $serv_dist;
				$mouvement['new_serv_id'] = $serv_dist;
			}
			
			if($reg_dest){
				$candidat->region_id = $reg_dest;
				$mouvement['new_reg_id'] = $reg_dest;
				$candidat->district_id = null;
						
			}
			$this->candidat->update($candidat,$candidat_id);
			$mouvement['candidat_id'] = $candidat_id;
			$mouvement['type'] = 1;			
			$this->mouvement_candidat->create_mouvement($mouvement);
		}
		else{
		}
		redirect('cv/list_cv/succes');
	}
	
	/** 
	* liste CV par departement
	*
	* @return view
	*/
	public function list_cv_per_dep(){
		$this->checkConnexion();
		$data = array();
	
		$candidat = $this->get_current_candidat_completed_for_form();
		
		if(isset($candidat->direction)){
			$list_service = $this->service->get_by_direction($candidat->direction);
			if(!empty($list_service)){
				$data['list_service'] = json_encode($list_service);
			}
		}
		
		$list_departement = $this->departement->get_departement();
		$data['list_departement'] = $list_departement;
		if(!empty($_POST)){
			$depart_id = $_POST['departement'];
			$direct_id = $_POST['direction'];
			
			if($direct_id==0){
				$list_direction = $this->direction->get_by_departement($depart_id);
				$list_candidat = $this->candidat->get_candidat_by_departement($depart_id);
			}
			else{
				$list_candidat = $this->candidat->get_candidat_by_direction($direct_id);
			}
			$list_direction = $this->direction->get_by_departement($depart_id);
		}else{
			$depart_id = current(current($list_departement));
			$list_direction = $this->direction->get_by_departement($depart_id);
			$direct_id = current(current($list_direction));	
			$list_candidat = $this->candidat->get_candidat_by_direction($direct_id);
		}
		
		$data['direction_edit'] = $direct_id;
		$data['departement_edit'] = $depart_id;
			
		$data['list_direction'] = $list_direction;
		
		$list_fin = $this->complete_array_canditat($list_candidat);
		$data['list_candidat'] = $list_fin;
		
		$data['menu'] = 4;
        $this->load_my_view('cv/liste_cv_with_form',$data);
	}
        
	/** 
	* liste invalide
	*
	* @return view
	*/
     public function list_invalide(){
		$this->checkConnexion();
		
		$list_candidat = null;
		$user = $this->get_current_user();
		$candidat = current($this->candidat->get_by_user_id($user['id']));
		if($user['role'] == 'chef'){
			$list_candidat = $this->get_candidat_subordonnee($user,$candidat,true);
		}
		else{
			$list_candidat = $this->candidat->get_all_list_invalide();
		}
		//var_dump($list_candidat);
		$data = array();
		$list_fin = $this->complete_array_canditat($list_candidat);
		//var_dump($list_fin);
		$data['list_candidat'] = $list_fin;
		//var_dump($list_fin);
		$data['menu'] = 5;
		$data['valide'] = 1;
		$this->load_my_view('cv/liste_cv',$data);
		
	}
       
	/** 
	* les cv valide
	*
	* @return view
	*/
    public function valide_cv($id=FALSE){
		$this->checkConnexion();
		$candidat = $this->candidat->get_by_id($id);
		$candidat = current($candidat);
		
		$this->user->valide($candidat->user_id);
		
		//insertion de nouveau matricule dans table matricule
		if($candidat->statut == 3 || $candidat->statut == 5 || $candidat->statut == 7 || $candidat->statut == 8){
			$data_matricule = array();
			$data_matricule['libele'] = $candidat->matricule;
			$data_matricule['nom'] = $candidat->nom;
			$data_matricule['prenom'] = $candidat->prenom;
			$this->matricule->insert($data_matricule);
		}
		//fin insertion nouveau matricule
		$this->list_cv();
		/*
		$list_candidat = $this->candidat->get_all_list_invalide();
		$data = array();
		$list_fin = $this->complete_array_canditat($list_candidat);
		$data['list_candidat'] = $list_fin;

		//var_dump($list_fin);
		$data['menu'] = 5;
		$data['valide'] = 1;
		$this->load_my_view('cv/liste_cv',$data);*/
	}
	
	/** 
	* edition CV
	*
	* @return view
	*/
	public function edit_cv(){
		$this->checkConnexion();
		
		$candidat = current($this->candidat->get_by_id($_GET['id']));

		$candidat = $this->complete_candidat_for_form($candidat);
		
		$data = $this->get_data_list_for_form_cv($candidat->id);
		
		$data['candidat'] = $candidat;
		
		$data['edit'] = true;
        $candidat->image_url = $this->calculImageUrl($candidat->id,$candidat->type_photo);
				
		//
		
        $user_edit =  $this->user->get_user($candidat->user_id);
        $user_edit['statut'] = $candidat->statut;
        
		$data['user_edit'] = $user_edit;
		$data['menu'] = 3;
		$data['edit_cv'] = true;
		$data['candidat_id_edit'] = $candidat->id;
		//var_dump( $data);
		$this->load_my_view('cv/form_cv_resp',$data);
		
	}

	/** 
	* les notes des agents
	*
	* @return view
	*/
	public function vosNotes(){
    	
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

    		$oData = array();
	    	$oData['menu'] = 0;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oListeHistoriqueAgent = $this->evaluation->get_note_all_agent($oCandidat[0]->user_id) ; 
			$oListeHistoriqueAgentNew = $this->evaluation2->get_note_all_agent($oCandidat[0]->user_id) ; 

				$toMonth = array(
				 1 => 'Janvier',
				 2 => 'F&eacute;vrier',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Ao&ucirc;t',
				 9 => 'Septembre',
				10 => 'Octobre',
				11 => 'Novembre',
				12 => 'D&eacute;cembre'
			);
			$oSmarty->assign("toMonth",$toMonth);
			$oSmarty->assign("zBasePath",base_url());
			$oSmarty->assign('oListeHistoriqueAgent', $oListeHistoriqueAgent);
			$zReturn = $oSmarty->fetch(ADMIN_TEMPLATE_PATH . "evaluation/getHistoriqueAgentAll.tpl");

			

			$oSmarty2 = $oSmarty ; 
			$oSmarty->assign("zBasePath",base_url());
			$oSmarty2->assign('oListeHistoriqueAgentNew', $oListeHistoriqueAgentNew);
			$zReturn2 = $oSmarty2->fetch(ADMIN_TEMPLATE_PATH . "evaluation2/getHistoriqueAgentAll.tpl");

			$oData['zReturn'] = $zReturn ; 
			$oData['zReturn2'] = $zReturn2 ; 
			$oData['iModuleActif'] = -13;
			$oData['iMenuActif'] = -13;

	    	$this->load_my_view('evaluation/historique.php',$oData);
	    	
    	}
    	
    }

    /** 
	* corps grade indice
	*
	* @return view
	*/    
	public function get_all_corps_indice_grade(){
		$data = array();
		$data['corps'] = $this->corps->get_corps();
		$data['indice'] = $this->indice->get_indice();
		$data['grade'] = $this->grade->get_grade();
		return  $data;
	}
        
	/** 
	* redirection vers la page login
	*
	* @return view
	*/
	public function login(){
		/*$this->session->sess_destroy();
		$statut = $this->statut->get_statut();
		$data = $this->get_all_corps_indice_grade();
		$data['list_statut'] = $statut;
		$this->load->view('login',$data);*/
		redirect("accueil/login");
	}

	/** 
	* page non accessible
	*
	* @return view
	*/
	public function access_denied(){
		$this->load->view('access_denied',null);
	}
	
	/** 
	* edition par les responsable personnel
	*
	* @return view
	*/
	public function edit_by_resp(){
		$this->checkConnexion(array('admin','resp','chef'));

		$autre_division = $_POST['autre_division'];
		$autre_direction = $_POST['autre_direction'];
		$autre_service = $_POST['autre_service'];

		$lacalite_service= $_POST['lacalite_service'];
		$porte           = $_POST['porte'];
		$poste           = $_POST['poste'];
		$nbr_enfant		 = $_POST['nbr_enfant'];
		//$district		 = $_POST['district'];

		if(isset($_POST['corps']))
			$corps 	= $_POST['corps'];
		if(isset($_POST['grade']))
			$grade = $_POST['grade'];
		if(isset($_POST['indice']))
			$indice = $_POST['indice'];
		
		$autre_corps 			= $_POST['autre_corps'];
		$autre_grade 			= $_POST['autre_grade'];
		$autre_indice			= $_POST['autre_indice'];
		
		$statut = null;
		if(isset($_POST['statut']))
			$statut	= $_POST['statut'];
		
		/*$departement 	= $_POST['departement'];
		$direction 		= $_POST['direction'];
		$service 		= $_POST['service'];
		$division 		= $_POST['division'];*/

		/*if (isset($_POST['departement1']) && ($_POST['departement1'] != "")) {
			$departement 	= $_POST['departement1'];
		}

		if (isset($_POST['direction1']) && ($_POST['direction1'] != "")) {
			$direction 		= $_POST['direction1'];
		}

		if (isset($_POST['service1']) && ($_POST['service1'] != "")) {
			$service 		= $_POST['service1'];
		}
		
		if (isset($_POST['division1']) && ($_POST['division1'] != "")) {
			$division 		= $_POST['division1'];
		}

		if (isset($_POST['pays1']) && ($_POST['pays1'] != "")) {
			$pays 	= $_POST['pays1'];
		}

		if (isset($_POST['province1']) && ($_POST['province1'] != "")) {
			$province 		= $_POST['province1'];
		}

		if (isset($_POST['region1']) && ($_POST['region1'] != "")) {
			$region 		= $_POST['region1'];
		}
		
		if (isset($_POST['district1']) && ($_POST['district1'] != "")) {
			$district 		= $_POST['district1'];
		}*/

		if (isset($_POST['pays']) && ($_POST['pays'] != "")) {
			$pays 	= $_POST['pays'];
		}

		if (isset($_POST['province']) && ($_POST['province'] != "")) {
			$province 		= $_POST['province'];
		}

		if (isset($_POST['region']) && ($_POST['region'] != "")) {
			$region 		= $_POST['region'];
		}
		
		if (isset($_POST['district']) && ($_POST['district'] != "")) {
			$district 		= $_POST['district'];
		}

		if (isset($_POST['departement']) && ($_POST['departement'] != "")) {
			$departement 	= $_POST['departement'];
		}

		if (isset($_POST['direction']) && ($_POST['direction'] != "")) {
			$direction 		= $_POST['direction'];
		}

		if (isset($_POST['service']) && ($_POST['service'] != "")) {
			$service 		= $_POST['service'];
		}
		
		if (isset($_POST['division']) && ($_POST['division'] != "")) {
			$division 		= $_POST['division'];
		}

	
		$date_prise_service	= $_POST['date_prise_service'];
		
		$candidat_id = $_POST['candidat_id'];
		
		$data = array();
		$data['autre_division'] = $autre_division;
		$data['autre_direction'] = $autre_direction;
		$data['autre_service'] = $autre_service;
		$data['date_prise_service'] = $this->date_fr_to_en($date_prise_service,'/','-');
		
		$data['corps'] = $corps;
		$data['grade'] = $grade;
		$data['indice'] = $indice;
		$data['statut'] = $statut;
		var_dump($statut);
		
		$data['autre_corps'] = $autre_corps;
		$data['autre_grade'] = $autre_grade;
		$data['autre_indice'] = $autre_indice;
		
		$data['departement'] = $departement;
		$data['direction'] = $direction;
		$data['service'] = $service;
		$data['division'] = $division;

		$data['lacalite_service'] = $lacalite_service;
		$data['porte']            = $porte;
		$data['poste']            = $poste;
		$data['nbr_enfant']		  = $nbr_enfant;
		
		$now = date('Y-m-d\TH:i:s');
		$data['date_last_modif'] = $now;
		
		$user  = $this->get_current_user();
		$candidat = current($this->candidat->get_candidat_by_id($candidat_id));
		$user_id = $user['id'];
		$data_histo = array();
		$data_histo['candidat_id'] = $candidat_id;
		$data_histo['resp_id'] = $user_id;
		$data_histo['type'] = "statut";
		$data_histo['old_value'] = $candidat->statut;
		$data_histo['new_value'] = $statut;
		$data_histo['piece'] = $_POST['justify_statut_piece'];
		$data_histo['num_piece'] = $_POST['justify_statut_num'];
		$data_histo['portant_piece'] = $_POST['justify_statut_portant'];
		$data_histo['date_piece'] = $_POST['justify_statut_date'];
		$this->histo_info_administra->create_histo($data_histo);
		
		$this->candidat->update($data,$candidat_id);

		
		redirect('cv/mon_cv?id='.$candidat_id);
	}

	/** 
	* Création CV
	*
	* @return view
	*/
	public function create_cv(){
		$this->checkConnexion();
		
		$diplome_name = $_POST['diplome_name'];
		$diplome_discipline = $_POST['diplome_discipline'];
		$diplome_date = $_POST['diplome_date'];
		$diplome_etablissement = $_POST['diplome_etablissement'];
		$diplome_pays = $_POST['diplome_pays'];
		
		$autre_division = $_POST['autre_division'];
		$autre_direction = $_POST['autre_direction'];
		$autre_service = $_POST['autre_service'];
		
		$autre_domaine = $_POST['autre_domaine'];
		
	   // var_dump($autre_division);
		$parcours_date_debut = $_POST['date_debut'];
		$parcours_date_fin = $_POST['date_fin'];
		$parcours_poste = $_POST['par_poste'];
		$parcours_departement = $_POST['par_departement'];               
                
		$date_naiss	 	= $_POST['date_naiss'];
		$sit_mat 		= $_POST['sit_mat'];
		$domaine 		= $_POST['domaine'];
		$phone 			= $_POST['phone'];
		$addresse 		= $_POST['addresse'];
		$id 			= $_POST['id'];
		
		//$matricule 		= $_POST['matricule'];
		//$cin 			= $_POST['cin'];
		$email 			= $_POST['email'];	
		
		if(isset($_POST['corps']))
			$corps 	= $_POST['corps'];
		if(isset($_POST['grade']))
			$grade = $_POST['grade'];
		if(isset($_POST['indice']))
			$indice = $_POST['indice'];
		
		$autre_corps 			= $_POST['autre_corps'];
		$autre_grade 			= $_POST['autre_grade'];
		$autre_indice			= $_POST['autre_indice'];
		
		$statut = null;
		if(isset($_POST['statut']))
			$statut	= $_POST['statut'];
		
		$departement 	= $_POST['departement'];
		$direction 		= $_POST['direction'];
		$service 		= $_POST['service'];
		$division 		= $_POST['division'];

		/* New */
		if (isset($_POST['pays']) && ($_POST['pays'] != "")) {
			$pays 	= $_POST['pays'];
		}

		if (isset($_POST['province']) && ($_POST['province'] != "")) {
			$province 		= $_POST['province'];
		}

		if (isset($_POST['region']) && ($_POST['region'] != "")) {
			$region 		= $_POST['region'];
		}
		
		if (isset($_POST['district']) && ($_POST['district'] != "")) {
			$district 		= $_POST['district'];
		}

		if (isset($_POST['departement']) && ($_POST['departement'] != "")) {
			$departement 	= $_POST['departement'];
		}

		if (isset($_POST['direction']) && ($_POST['direction'] != "")) {
			$direction 		= $_POST['direction'];
		}

		if (isset($_POST['service']) && ($_POST['service'] != "")) {
			$service 		= $_POST['service'];
		}
		
		if (isset($_POST['division']) && ($_POST['division'] != "")) {
			$division 		= $_POST['division'];
		}


		/* Last*/
		$iTestModifLocalite = 0;
		if (isset($_POST['pays1']) && ($_POST['pays1'] != "") && ($pays!= $_POST['pays1'])) {
			$iTestModifLocalite = 1;
		}

		if (isset($_POST['province1']) && ($_POST['province1'] != "") && ($province!= $_POST['province1'])) {
			$iTestModifLocalite = 1;
		}

		if (isset($_POST['region1']) && ($_POST['region1'] != "") && ($region!= $_POST['region1'])) {
			$iTestModifLocalite = 1;
		}

		if (isset($_POST['district1']) && ($_POST['district1'] != "") && ($district!= $_POST['district1'])) {
			$iTestModifLocalite = 1;
		}

		if (isset($_POST['departement1']) && ($_POST['departement1'] != "") && ($departement!= $_POST['departement1'])) {
			$iTestModifLocalite = 1;
		}

		if (isset($_POST['direction1']) && ($_POST['direction1'] != "") && ($direction!= $_POST['direction1'])) {
			$iTestModifLocalite = 1;
		}

		if (isset($_POST['service1']) && ($_POST['service1'] != "") && ($service!= $_POST['service1'])) {
			$iTestModifLocalite = 1;
		}
		
		if (isset($_POST['division1']) && ($_POST['division1'] != "") && ($division!= $_POST['division1'])) {
			$iTestModifLocalite = 1;
		}
		
		

		$lacalite_service= $_POST['lacalite_service'];
		$porte           = $_POST['porte'];
		$poste           = $_POST['poste'];
		$nbr_enfant		 = $_POST['nbr_enfant'];
		$district		 = $_POST['district'];
                
		$date_naiss = $_POST['date_naiss'];
		
		$list_activite = $_POST['activite'];
		
		//$soa = $_POST['soa'];
		
		$soa = $this->array_to_string($soa);
		
		//var_dump();
		//$region = "";
		//$province = "";
			
		if(isset($_POST['region']))
			$region = $_POST['region'];
		if(isset($_POST['province']))
			$province	= $_POST['province'];
		
		$pays	= $_POST['pays'];
		
		$date_prise_service	= $_POST['date_prise_service'];
		
        $user  = $this->get_current_user();
		$user_id = $user['id'];
		
		$data = array();
		
		$data['sit_mat'] = $sit_mat;
		$data['phone'] = $phone;
		$data['address'] = $addresse;
		$data['domaine'] = $domaine ;
         $data['autre_domaine'] = $autre_domaine;
		$data['nbr_enfant'] = $nbr_enfant;
                
		/* Modif 14/01/2017 modification passive CV */
		
		/*$data['district_id'] = $district;
		$data['region_id'] = $region;
		$data['province_id'] = $province;
		$data['pays_id'] = $pays;*/


		$data['autre_division'] = $autre_division;
		$data['autre_direction'] = $autre_direction;
		$data['autre_service'] = $autre_service;
		$data['date_prise_service'] = $this->date_fr_to_en($date_prise_service,'/','-');
                //var_dump($data);
		
		//var_dump($soa);
		$data['email'] = $email;
		$data['corps'] = $corps;
		$data['grade'] = $grade;
		$data['indice'] = $indice;
		//$data['soa'] = $soa;
		$data['statut'] = $user['statut'];     
		
		$data['autre_corps'] = $autre_corps;
		$data['autre_grade'] = $autre_grade;
		$data['autre_indice'] = $autre_indice;
		
		/* Modif 14/01/2017 modification passive CV */

		/* $data['departement'] = $departement;
		$data['direction'] = $direction;
		$data['service'] = $service;
		$data['division'] = $division;*/

		if ($iTestModifLocalite == 1){

			$oDataLocalitePassive = array();
			$oDataLocalitePassive['localite_userId'] = $user_id;
			$oDataLocalitePassive['localite_paysId'] = $pays;
			$oDataLocalitePassive['localite_provinceId'] = $province;
			$oDataLocalitePassive['localite_regionId'] = $region;
			$oDataLocalitePassive['localite_districtId'] = $district;
			$oDataLocalitePassive['localite_departementId'] = $departement;
			$oDataLocalitePassive['localite_directionId'] = $direction;
			$oDataLocalitePassive['localite_serviceId'] = $service;
			$oDataLocalitePassive['localite_divisionId'] = $division;
			$oDataLocalitePassive['localite_date'] = date("Y-m-d");
			$oDataLocalitePassive['localite_statut'] = 1;

			$this->load->model('localite_gcap_model','Localite');
			$this->Localite->insert($oDataLocalitePassive) ; 
		} else {

			$data['district_id'] = $district;
			$data['region_id'] = $region;
			$data['province_id'] = $province;
			$data['pays_id'] = $pays;
			$data['departement'] = $departement;
			$data['direction'] = $direction;
			$data['service'] = $service;
			$data['division'] = $division;
		}

		$data['lacalite_service'] = $lacalite_service;
		$data['porte']            = $porte;
		$data['poste']            = $poste;
		$data['matricule'] = $user['im'];
		
		$data['user_id'] = $user_id;
		//var_dump($user);
		if(isset($user['cin']))
			$data['cin'] = $user['cin'];
		
        $this->user->set_exist_cv($user_id);
		$photo = $_FILES['photo'];
		if($photo){
			$type = $photo['type'];
			$ext = substr($type, 6);
			if($ext == 'jpeg'){
				$name = $photo['name'];
				$len = strlen($name);
				$ext0 = substr($name,$len-4);
				if($ext0 != $ext){
					$ext = 'jpg';
				}
			}
			if(strlen($ext)>2){
				$data['type_photo'] = $ext;
			}
		}
		$bo_candidat = current($this->candidat->get_by_user_id($user_id));
		if(!$bo_candidat){
			$user = $this->user->get_user($user_id);
		   // var_dump($matricule);
			$data['nom'] =  $user['nom'];
			$data['prenom'] = $user['prenom'];
			$data['date_naiss'] = $this->date_fr_to_en($date_naiss,'/','-');
			$data['sexe'] = $user['sexe'];
			$now = date('Y-m-d\TH:i:s');
			$data['date_creation'] = $now;
			$this->candidat->insert($data);
			// creation historique
			$data_histo = array();
			$data_histo['user_id'] = $user_id;
			$data_histo['type'] = 'CREATE_CV';
			$data_histo['date'] = $now ;
			$data_histo['host_user'] = $this->get_user_data('ip_address');;
			$data_histo['agent_user'] = $_SERVER['HTTP_USER_AGENT'];
			
			$this->user_historique->create_user_historique($data_histo);
			// fin creatin historique
			
			$this->user->set_exist_cv($user_id);
		   // session_start() ;
			$user1 = $this->user->get_user($user_id);
			$matricule_bo = null;
			if($statut == 3 || $statut == 5 || $statut == 7 || $statut == 8)
				$matricule_bo =  current($this->matricule->get_matricule($user['im']));
			if($matricule_bo!=null)
				$user1['matricule'] = $this->complete_matricule($matricule_bo);
			
			
			$bo_candidat = current($this->candidat->get_by_user_id($user_id));
			$candidat = $bo_candidat;
			$id = $candidat->id;
			
			$size_diplome = sizeof($diplome_name);
			for($i=0;$i<$size_diplome;$i++){
				$data = array();
				$data['candidat_id'] =  $id;
				$data['diplome_name'] =  $diplome_name[$i];
				$data['diplome_etab'] =  $diplome_etablissement[$i];
				$data['diplome_date'] = $diplome_date[$i];
				$data['diplome_pays'] =  $diplome_pays[$i];
				$data['diplome_disc'] = $diplome_discipline[$i];
				$this->candidat_diplome->insert($data);
			}
			
			$this->candidat_parcours->delete_all_parcours_candidat($id);
			$size_parcours = sizeof($parcours_poste);
			for($i=0;$i<$size_parcours;$i++){
				$data_par = array();
				$data_par['candidat_id'] =  $id;
				$data_par['date_debut'] = $this->date_fr_to_en($parcours_date_debut[$i],'/','-');
				$data_par['date_fin'] = $this->date_fr_to_en($parcours_date_fin[$i],'/','-');
				$data_par['par_poste'] = $parcours_poste[$i];
				$data_par['par_departement'] =  $parcours_departement[$i];
				$this->candidat_parcours->insert($data_par);
			}
		}
		else{	
			$id = $bo_candidat->id;
			$this->candidat_diplome->delete_all_diplome_candidat($id);
			$size_diplome = sizeof($diplome_name);
			$data['date_naiss'] = $this->date_fr_to_en($date_naiss,'/','-'); 
			$now = date('Y-m-d\TH:i:s');
			$data['date_last_modif'] = $now;
			//var_dump($id);
			//var_dump($data);
			
			$this->candidat->update($data,$id);
			// creation historique
			$data_histo = array();
			$data_histo['user_id'] = $user_id;
			$data_histo['type'] = 'UPDATE_CV';
			$data_histo['date'] = $now ;
			$data_histo['host_user'] = $this->get_user_data('ip_address');;
			$data_histo['agent_user'] = $_SERVER['HTTP_USER_AGENT'];
			
			$this->user_historique->create_user_historique($data_histo);
			$user_histo = $this->user_historique->get_last_by_user_id($user_id);
			// fin creatin historique
			//historique candidat
			$candidat_histo = array();
			$candidat_histo['user_historique_id'] = $user_histo->id;
			$candidat_histo['nom'] = $bo_candidat->nom;
			$candidat_histo['prenom'] = $bo_candidat->prenom;
			$candidat_histo['date_naiss'] = $bo_candidat->date_naiss;
			$candidat_histo['phone'] = $bo_candidat->phone;
			$candidat_histo['address'] = $bo_candidat->address;
			//$candidat_histo['niveau'] = $bo_candidat->niveau;
			$candidat_histo['sit_mat'] = $bo_candidat->sit_mat;
			$candidat_histo['email'] = $bo_candidat->email;
			$candidat_histo['corps'] = $bo_candidat->corps;
			
			$candidat_histo['grade'] = $bo_candidat->grade;
			$candidat_histo['indice'] = $bo_candidat->indice;
			$candidat_histo['direction'] = $bo_candidat->direction;
			$candidat_histo['service'] = $bo_candidat->service;
			$candidat_histo['division'] = $bo_candidat->division;
			$candidat_histo['nbr_enfant'] = $bo_candidat->nbr_enfant;
			$candidat_histo['cin'] = $bo_candidat->cin;
			$candidat_histo['district_id'] = $bo_candidat->district_id;
			$candidat_histo['date_prise_service'] = $bo_candidat->date_prise_service;
			$candidat_histo['date_creation'] = date('Y-m-d\TH:i:s');
			
			$this->candidat_historique->create_candidat_historique($candidat_histo);
			
			
			for($i=0;$i<$size_diplome;$i++){
				$data = array();
				$data['candidat_id'] =  $id;
				$data['diplome_name'] =  $diplome_name[$i];
				$data['diplome_etab'] =  $diplome_etablissement[$i];
				$data['diplome_date'] = $diplome_date[$i];
				$data['diplome_pays'] =  $diplome_pays[$i];
				$data['diplome_disc'] = $diplome_discipline[$i];
				$this->candidat_diplome->insert($data);
			}
			$this->candidat_activite->delete_all_activite_candidat($id);
			$size_active = sizeof($list_activite);
			for($i=0;$i<$size_active;$i++){
				 $data_activite = array();
				 $data_activite['candidat_id'] =  $id;
				 $data_activite['libele'] =  $list_activite[$i];
				 $this->candidat_activite->insert($data_activite);
			}
			 
			$this->candidat_parcours->delete_all_parcours_candidat($id);
			$size_parcours = sizeof($parcours_poste);
			for($i=0;$i<$size_parcours;$i++){
				$data_par = array();
				$data_par['candidat_id'] =  $id;
				$data_par['date_debut'] =  $this->date_fr_to_en($parcours_date_debut[$i],'/','-');
				$data_par['date_fin'] =  $this->date_fr_to_en($parcours_date_fin[$i],'/','-'); 
				$data_par['par_poste'] = $parcours_poste[$i];
				$data_par['par_departement'] =  $parcours_departement[$i];
				$this->candidat_parcours->insert($data_par);
			}
		}
		
		if($photo){
			$file_name = $photo['name'];

			$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $id . "." . $ext ; 
			$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $id . "." . strtoupper($ext) ; 

			if (file_exists($zImagePath)){
				@unlink($zImagePath);
			}

			if (file_exists($zImagePath1)){
				@unlink($zImagePath1);
			}

			/*$config_photo = array(
				'upload_path' 	=>  'assets/upload',
				'allowed_types' => '*',
				'file_name'		=>	$id ,
				'overwrite'		=> 	true
			);
			
			$this->load->library('upload', $config_photo);
			$this->upload->initialize($config_photo);

			$this->upload->do_upload('photo');*/

			$zName = $id.'.'.strtolower($ext) ; 

			@move_uploaded_file($photo['tmp_name'], PATH_ROOT_DIR . '/assets/upload/' . $zName);

			/* Modif Îles aux trésors resizeimage */ 

			if(isset($ext) && ($ext != ''))
			{
				$this->resizePicture(BASE_PATH . '/assets/upload/' . $zName, $zName , "300", "300");
			}

		}
		$user = get_current_user();
		
		if ($iTestModifLocalite == 1){
			redirect('cv/mon_cv/3');
		} else {
			redirect('cv/mon_cv/1');
		}
		/*
		if($user['role'] != 'admin'){
		//	redirect('cv/mon_cv/1');
		}else{
			
			$this->load_my_view('',$data);
		}*/
	}
	
	
	/** 
	* calcul image URL
	*
	* @return view
	*/
	function calculImageUrl($id,$typePhoto){
		$ret = base_url().'assets/upload/';
		$logo = "default.jpg";
		if($typePhoto)
			$logo = $id.'.'.$typePhoto;
		$ret .=$logo; 
                $date = date('H:i:s');
		return $ret.'?'.$date ;
	}
        
	/** 
	* Certificat
	*
	* @return view
	*/
	function certificat($candidat_id=false){
		$data = array(); 
		if($candidat_id){
			$candidat = current($this->candidat->get_by_id($candidat_id));
			$candidat = $this->complete_candidat_for_form($candidat);
			$user = $this->user->get_user($candidat->user_id);
		}
		else{
			$candidat = $this->get_current_candidat_completed_for_form();
			$user = $this->get_current_user();
		}
		
	    $matr = $candidat->matricule;
	    $matricule = "";
	    if(strlen($matr)==6){
	    	$matricule = $matr[0].$matr[1].$matr[2].' '.$matr[3].$matr[4].$matr[5];
	    	$matricule = " IM : " .$matricule;
	    }
	    else{
	    	$matricule = ", ".$matr;
	    }
	    
		$data['id'] = $candidat->id;
		$data['nom_prenom'] = $candidat->nom .' '. $candidat->prenom;
		$data['matricule'] = $matricule;
		
		$data['genre'] = $candidat->sexe;
		$bo_direction = $this->direction->get_direction($candidat->direction);
		$direction  = '';
		if(sizeof($bo_direction)>0)
			$direction  = $bo_direction['libele'];
		$data['direction']  = $direction;
		$data['date'] = $this->date_en_to_fr(date('d/m/y'),'-','/');
		$data['date_service']  = $this->date_en_to_fr($candidat->date_prise_service,'-','/');
		
		$data['login'] = $user['login'];
		$data['password'] = $user['password'];
		$data['region'] = $this->region->get_region($candidat->region_id);
		
		// $data['password'] = $candidat->password .' '. $candidat->password;
		
	   // var_dump($candidat);
		$this->load->view('cv/certificat',$data);
	}
	
	/** 
	* impression CV sur ROHI
	*
	* @return view
	*/
	function fpdf_cv($candidat_id=false){
		$data = array();  
		
		if($candidat_id){
			$candidat = current($this->candidat->get_by_id($candidat_id));
			$candidat = $this->complete_candidat_for_form($candidat);
			$user = $this->user->get_user($candidat->user_id);
		}
		else{
			$candidat = $this->get_current_candidat_completed_for_form();
			$user = $this->get_current_user();
		}
		
            
	    $matr = $candidat->matricule;
	    $matricule = "";
	    if(strlen($matr)==6){
	    	$matricule = $matr[0].$matr[1].$matr[2].' '.$matr[3].$matr[4].$matr[5];
	    	$matricule = " IM : " .$matricule;
	    }
	    else{
	    	$matricule = ", ".$matr;
	    }
	    
		$data['id'] = $candidat->id;
		$data['type_photo'] = $candidat->type_photo;
		$data['corps'] = $candidat->corps;
		$data['grade'] = $candidat->grade;
		$data['indice'] = $candidat->indice;
		$data['date_prise_service'] = $candidat->date_prise_service;
		$data['nom_prenom'] = $candidat->nom .' '. $candidat->prenom;
		$data['matricule'] = $matricule;
		$data['date_naiss'] = $candidat->date_naiss;
		$data['phone'] = $candidat->phone;
		$data['email'] = $candidat->email;
		$data['porte'] = $candidat->porte;
		$data['poste'] = $candidat->poste;
		$data['lacalite_service'] = $candidat->lacalite_service;
		$data['domaine'] = $candidat->domaine;
		$data['autre_domaine'] = $candidat->autre_domaine;
		$data['nbr_enfant'] = $candidat->nbr_enfant;
		$bo_sit_mat = $this->situation_mat->get_situation($candidat->sit_mat);
		$sit_mat  = '';
		if(sizeof($bo_sit_mat)>0)
			$sit_mat  = $bo_sit_mat['libele'];
		$data['sit_mat']  = $sit_mat;
		$data['genre'] = $candidat->sexe;
		
                $data['address'] = $candidat->address;
                
				$bo_statut = $this->statut->get_statut($candidat->statut);
		$statut  = '';
		if(sizeof($bo_statut)>0)
			$statut  = $bo_statut['libele'];
		$data['statut']  = $statut;
				
				$bo_district = $this->district->get_district($candidat->district_id);
		$district  = '';
		if(sizeof($bo_district)>0)
			$district  = $bo_district['libele'];
		$data['district']  = $district;
		
			$bo_region = $this->region->get_region($candidat->region_id);
		$region  = '';
		if(sizeof($bo_region)>0)
			$region  = $bo_region['libele'];
		$data['region']  = $region;
		
		$bo_province = $this->province->get_province($candidat->province_id);
		$province  = '';
		if(sizeof($bo_province)>0)
			$province  = $bo_province['libele'];
		$data['province']  = $province;
		
                $bo_pays = $this->pays->get_pays($candidat->pays_id);
		$pays  = '';
		if(sizeof($bo_pays)>0)
			$pays  = $bo_pays['libele'];
		$data['pays']  = $pays;
		
		 $bo_departement = $this->departement->get_departement($candidat->departement);
		$departement  = '';
		if(sizeof($bo_departement)>0)
			$departement  = $bo_departement['libele'];
		$data['departement']  = $departement;
		
		 $bo_direction = $this->direction->get_direction($candidat->direction);
		$direction  = '';
		if(sizeof($bo_direction)>0)
		$direction  = $bo_direction['libele'];
		$data['direction']  = $direction;
		
				 $bo_service = $this->service->get_service($candidat->service);
		$service  = '';
		if(sizeof($bo_service)>0)
			$service  = $bo_service['libele'];
		$data['service']  = $service;
		
				 $bo_division = $this->division->get_division($candidat->division);
		$division  = '';
		if(sizeof($bo_division)>0)
			$division  = $bo_division['libele'];
		$data['division']  = $division;
		
                $candidat->parcours_list = $this->candidat_parcours->get_parcours_candidat($candidat->id);
                $candidat->image_url = $this->calculImageUrl($candidat->id,$candidat->type_photo);
				
		$this->load->view('cv/fpdf_cv',$data);
	}
	
	/** 
	* mouvement
	*
	* @return view
	*/
	function mouvement(){
		$this->checkConnexion(array('admin','chef'));
		
		$data = array();
		$list_mvt = $this->mouvement_candidat->get_mouvement_by_resp_id();
		$array_data = array();
		foreach($list_mvt as $mvt){
			$row = array();
			$candidat = current($this->candidat->get_candidat_by_id($mvt['candidat_id']));
			$resp = current($this->candidat->get_by_user_id($mvt['resp_id']));
			$row['candidat_nom'] = $candidat->nom.' '.$candidat->prenom;
			if($resp)
			$row['resp_nom'] = $resp->nom.' '.$resp->prenom;
			
			$old_dep = $this->departement->get_departement($mvt['old_dep_id']);
			$old_dir = $this->direction->get_direction($mvt['old_dir_id']);
			$old_serv = $this->service->get_service($mvt['old_serv_id']);
			
			$new_dep = $this->departement->get_departement($mvt['new_dep_id']);
			$new_dir = $this->direction->get_direction($mvt['new_dir_id']);
			$new_serv = $this->service->get_service($mvt['new_serv_id']);
			
			
			$old_dep_str = "";
			$new_dep_str = "";
			
			if($old_dep){
				$old_dep_str .= '-';
				$old_dep_str .= $old_dep['libele'];
			}
				
			if($old_dir){
				$old_dep_str .= '<br>-';
				$old_dep_str .= $old_dir['libele'];
			}
			
			if($old_serv){
				$old_dep_str .= '<br>-';
				$old_dep_str .= $old_serv['libele'];
			}
			
			if($new_dep){
				$new_dep_str .= '-';
				$new_dep_str .= $new_dep['libele'];
			}
			
			if($new_dir){
				$new_dep_str .= '<br>-';
				$new_dep_str .= $new_dir['libele'];
			}
			
			if($new_serv){
				$new_dep_str .= '<br>-';
				$new_dep_str .= $new_serv['libele'];
			}
			
			if($mvt['type'] == 1){
				$row['type'] = 'Transf&eacute;rer';
			}
			if($mvt['type'] == 2){
				$row['type'] = 'Exp&eacute;dier';
			}
			
			$row['old_dep_str'] = $old_dep_str;
			$row['new_dep_str'] = $new_dep_str;
			
			$row['date'] = $mvt['date_operation'];
			array_push($array_data, $row);
			
		}
		$data['list_mvt'] = $array_data;
		$this->load_my_view('cv/list_mvt',$data);
	}
	
	/** 
	* impression fiche evaluation
	*
	* @return view
	*/
	function fpdf_fe($candidat_id=false){
		$data = array();  
		
		if($candidat_id){
			$candidat = current($this->candidat->get_by_id($candidat_id));
			$candidat = $this->complete_candidat_for_form($candidat);
			$user = $this->user->get_user($candidat->user_id);
		}
		else{
			$candidat = $this->get_current_candidat_completed_for_form();
			$user = $this->get_current_user();
		}
		
      
		$data['id'] = $candidat->id;
		$data['type_photo'] = $candidat->type_photo;
		//$data['corps'] = $candidat->corps;
		$data['grade'] = $candidat->grade;
		$data['indice'] = $candidat->indice;
		$data['date_prise_service'] = $candidat->date_prise_service;
		$data['nom'] = $candidat->nom;
		$data['prenom'] = $candidat->prenom;
		$data['matricule'] = $candidat->matricule;
		$data['date_naiss'] = $candidat->date_naiss;
		$data['phone'] = $candidat->phone;
		$data['email'] = $candidat->email;
		$data['cin'] = $candidat->cin;
		$data['poste'] = $candidat->poste;
		$data['porte'] = $candidat->porte;
		$data['poste'] = $candidat->poste;
		$data['lacalite_service'] = $candidat->lacalite_service;
		$data['domaine'] = $candidat->domaine;
		$data['autre_domaine'] = $candidat->autre_domaine;
		$bo_sit_mat = $this->situation_mat->get_situation($candidat->sit_mat);
		$sit_mat  = '';
		if(sizeof($bo_sit_mat)>0)
			$sit_mat  = $bo_sit_mat['libele'];
		$data['sit_mat']  = $sit_mat;
		$data['sexe'] = $candidat->sexe;
        $data['address'] = $candidat->address;
		$bo_statut = $this->statut->get_statut($candidat->statut);
		$statut  = '';
		if(sizeof($bo_statut)>0)
			$statut  = $bo_statut['libele'];
		$data['statut']  = $statut;
				
				$bo_district = $this->district->get_district($candidat->district_id);
		$district  = '';
		if(sizeof($bo_district)>0)
			$district  = $bo_district['libele'];
		$data['district']  = $district;
		
			$bo_region = $this->region->get_region($candidat->region_id);
		$region  = '';
		if(sizeof($bo_region)>0)
			$region  = $bo_region['libele'];
		$data['region']  = $region;
		
		$bo_province = $this->province->get_province($candidat->province_id);
		$province  = '';
		if(sizeof($bo_province)>0)
			$province  = $bo_province['libele'];
		$data['province']  = $province;
		
                $bo_pays = $this->pays->get_pays($candidat->pays_id);
		$pays  = '';
		if(sizeof($bo_pays)>0)
			$pays  = $bo_pays['libele'];
		$data['pays']  = $pays;
		
		 $bo_departement = $this->departement->get_departement($candidat->departement);
		$departement  = '';
		if(sizeof($bo_departement)>0)
			$departement  = $bo_departement['libele'];
		$data['departement']  = $departement;
		
		 $bo_direction = $this->direction->get_direction($candidat->direction);
		$direction  = '';
		if(sizeof($bo_direction)>0)
		$direction  = $bo_direction['libele'];
		$data['direction']  = $direction;
		
				 $bo_service = $this->service->get_service($candidat->service);
		$service  = '';
		if(sizeof($bo_service)>0)
			$service  = $bo_service['libele'];
		$data['service']  = $service;
		
		$bo_corps = $this->corps->get_corps($candidat->corps);
		$corps  = '';
		if(sizeof($bo_corps)>0)
			$corps  = $bo_corps['libele'];
		$data['corps']  = $corps;
		
				 $bo_division = $this->division->get_division($candidat->division);
		$division  = '';
		if(sizeof($bo_division)>0)
			$division  = $bo_division['libele'];
		$data['division']  = $division;
		
                $candidat->parcours_list = $this->candidat_parcours->get_parcours_candidat($candidat->id);
                $candidat->image_url = $this->calculImageUrl($candidat->id,$candidat->type_photo);

		
		$zTimestampPremierMois = strtotime('noon first day of last month');
		$zDateDebut = date('d/m/Y', $zTimestampPremierMois); 

		$zTimestampDernierMois = strtotime('noon last day of last month');
		$zDateFin = date('d/m/Y', $zTimestampDernierMois); 


		if (isset($_GET['iDate']) && ($_GET['iDate'] > 0)) {

			$oEvaluation = $this->evaluation->getEvaluation_by_Id($_GET['iDate']) ; 

			$iMois = $oEvaluation["noteEvaluation_moisNote"];
			$iAnnee = $oEvaluation["noteEvaluation_anneeNote"];

			$toListeNoteAgent = $this->evaluation->get_search_note_by_agent($candidat->user_id, (int)$iMois, (int)$iAnnee);
			

		} else {

			$iMois = date("m") - 1;
			$iAnnee = date("Y");
			$toListeNoteAgent = $this->evaluation->get_search_note_by_agent($candidat->user_id, (int)$iMois, (int)$iAnnee);

			if (sizeof($toListeNoteAgent) == 0) {
				$iMois = date("m") - 2;
				$iAnnee = date("Y");
				$toListeNoteAgent = $this->evaluation->get_search_note_by_agent($candidat->user_id, (int)$iMois, (int)$iAnnee);

			}

			$zDateDebut = "01/".$iMois."/".$iAnnee ; 
			$zDateFin   = "30/".$iMois."/".$iAnnee ; 

		}

		$oCandidatEvaluateur = array();
		$iEvaluableValue = 1;
		if (sizeof($toListeNoteAgent) > 0) {

			$iEvaluableValue = $toListeNoteAgent[0]['noteEvaluation_evaluable'] ; 
			if ($iEvaluableValue == 1) {
			
				$iEvaluateurId = $toListeNoteAgent[0]['noteEvaluation_userSendNoteId'];
				$oCandidatEvaluateur = $this->candidat->get_by_user_id($iEvaluateurId);
			} else {
				$oCandidatEvaluateur = array();
			}
		}
		$data['iEvaluableValue']		= $iEvaluableValue;
		$data['toListeNoteAgent']		= $toListeNoteAgent;
		$data['oCandidatEvaluateur']	= $oCandidatEvaluateur;
		$data['iMois']	= $iMois;

		/* note pointage electronique */
		$oCandidat = array();
		$this->sessionStartCompte();
		$iCompteActif = $this->getSessionCompte();
		array_push($oCandidat, $candidat);
		if ($candidat->matricule == "ECD") {
			
			$zInMatriculeUser = $this->Transaction->getMatriculeAgent($iCompteActif, $candidat->user_id, $oCandidat);
		} else {
			$zInMatriculeUser = $candidat->matricule ;
		}

		$zMonth = date('m') ; 

		/* $zDateDebut		= strtotime('-1 month', strtotime(date('Y-'.$zMonth.'-01')."00:00:00"));*/

		$iMoyenneUserInfoPointage		= $this->Transaction->TempsDeTravailDunAgentAvecDenominateur($zInMatriculeUser, $zDateDebut, $zDateFin , $iDenominateur,$this);
		$data['iMoyenneUserInfoPointage']  = $iMoyenneUserInfoPointage;
				
		$this->load->view('cv/fpdf_fe',$data);
	}
	/* fin fiche evaluation*/


	/** 
	* impression fiche evaluation nouveau
	*
	* @param int $candidat_id identifiant du candidat
	* @return view
	*/
	function fpdf_feNew($candidat_id=false){
		$data = array();  
			

		if($candidat_id){
			$candidat = current($this->candidat->get_by_id($candidat_id));
			$candidat = $this->complete_candidat_for_form($candidat);
			$user = $this->user->get_user($candidat->user_id);
		}
		else{
			$candidat = $this->get_current_candidat_completed_for_form();
			$user = $this->get_current_user();
		}
		
      
		$data['id'] = $candidat->id;
		$data['type_photo'] = $candidat->type_photo;
		//$data['corps'] = $candidat->corps;
		$data['grade'] = $candidat->grade;
		$data['indice'] = $candidat->indice;
		$data['date_prise_service'] = $candidat->date_prise_service;
		$data['nom'] = $candidat->nom;
		$data['prenom'] = $candidat->prenom;
		$data['matricule'] = $candidat->matricule;
		$data['date_naiss'] = $candidat->date_naiss;
		$data['phone'] = $candidat->phone;
		$data['email'] = $candidat->email;
		$data['cin'] = $candidat->cin;
		$data['poste'] = $candidat->poste;
		$data['porte'] = $candidat->porte;
		$data['poste'] = $candidat->poste;
		$data['lacalite_service'] = $candidat->lacalite_service;
		$data['domaine'] = $candidat->domaine;
		$data['autre_domaine'] = $candidat->autre_domaine;
		$bo_sit_mat = $this->situation_mat->get_situation($candidat->sit_mat);
		$sit_mat  = '';
		if(sizeof($bo_sit_mat)>0)
			$sit_mat  = $bo_sit_mat['libele'];
		$data['sit_mat']  = $sit_mat;
		$data['sexe'] = $candidat->sexe;
        $data['address'] = $candidat->address;
		$bo_statut = $this->statut->get_statut($candidat->statut);
		$statut  = '';
		if(sizeof($bo_statut)>0)
			$statut  = $bo_statut['libele'];
		$data['statut']  = $statut;
				
				$bo_district = $this->district->get_district($candidat->district_id);
		$district  = '';
		if(sizeof($bo_district)>0)
			$district  = $bo_district['libele'];
		$data['district']  = $district;
		
			$bo_region = $this->region->get_region($candidat->region_id);
		$region  = '';
		if(sizeof($bo_region)>0)
			$region  = $bo_region['libele'];
		$data['region']  = $region;
		
		$bo_province = $this->province->get_province($candidat->province_id);
		$province  = '';
		if(sizeof($bo_province)>0)
			$province  = $bo_province['libele'];
		$data['province']  = $province;
		
                $bo_pays = $this->pays->get_pays($candidat->pays_id);
		$pays  = '';
		if(sizeof($bo_pays)>0)
			$pays  = $bo_pays['libele'];
		$data['pays']  = $pays;
		
		 $bo_departement = $this->departement->get_departement($candidat->departement);
		$departement  = '';
		if(sizeof($bo_departement)>0)
			$departement  = $bo_departement['libele'];
		$data['departement']  = $departement;
		
		 $bo_direction = $this->direction->get_direction($candidat->direction);
		$direction  = '';
		if(sizeof($bo_direction)>0)
		$direction  = $bo_direction['libele'];
		$data['direction']  = $direction;
		
				 $bo_service = $this->service->get_service($candidat->service);
		$service  = '';
		if(sizeof($bo_service)>0)
			$service  = $bo_service['libele'];
		$data['service']  = $service;
		
		$bo_corps = $this->corps->get_corps($candidat->corps);
		$corps  = '';
		if(sizeof($bo_corps)>0)
			$corps  = $bo_corps['libele'];
		$data['corps']  = $corps;
		
				 $bo_division = $this->division->get_division($candidat->division);
		$division  = '';
		if(sizeof($bo_division)>0)
			$division  = $bo_division['libele'];
		$data['division']  = $division;
		
                $candidat->parcours_list = $this->candidat_parcours->get_parcours_candidat($candidat->id);
                $candidat->image_url = $this->calculImageUrl($candidat->id,$candidat->type_photo);

		
		$zTimestampPremierMois = strtotime('noon first day of last month');
		$zDateDebut = date('d/m/Y', $zTimestampPremierMois); 

		$zTimestampDernierMois = strtotime('noon last day of last month');
		$zDateFin = date('d/m/Y', $zTimestampDernierMois); 


		if (isset($_GET['iDate']) && ($_GET['iDate'] > 0)) {

			$oEvaluation = $this->evaluation2->getEvaluation_by_Id($_GET['iDate']) ; 
			$toListeNoteAgent = explode(";", $oEvaluation['noteEvaluation_NoteAll']) ; 
			$zSigle = $this->Gcap->get_sigle($this,$oEvaluation['noteEvaluation_userNoteId']) ; 
			$toPeriode = $this->evaluation2->getPeriode($oEvaluation['noteEvaluation_periodeId']);

			$zPeriode = ""; 

			if (sizeof($toPeriode)>0){
				$zPeriode = $toPeriode[0]->periode_libelle; 
			}

		} 

		$oCandidatEvaluateur = array();
		$iEvaluableValue = 1;
		if (sizeof($oEvaluation) > 0) {

			$iEvaluableValue = $oEvaluation['noteEvaluation_evaluable'] ; 
			if ($iEvaluableValue == 1) {
			
				$iEvaluateurId = $oEvaluation['noteEvaluation_userSendNoteId'];
				$oCandidatEvaluateur = $this->candidat->get_by_user_id($iEvaluateurId);
			} else {
				$oCandidatEvaluateur = array();
			}
		}
		$data['iEvaluableValue']		= $iEvaluableValue;
		$data['toListeNoteAgent']		= $toListeNoteAgent;
		$data['oEvaluation']			= $oEvaluation;
		$data['zSigle']					= $zSigle;
		$data['zPeriode']					= $zPeriode;
		$data['oCandidatEvaluateur']	= $oCandidatEvaluateur;


		/* note pointage electronique */
		$oCandidat = array();
		$this->sessionStartCompte();
		$iCompteActif = $this->getSessionCompte();
		array_push($oCandidat, $candidat);
		/*if ($candidat->matricule == "ECD") {
			
			$zInMatriculeUser = $this->Transaction->getMatriculeAgent($iCompteActif, $candidat->user_id, $oCandidat);
		} else {
			$zInMatriculeUser = $candidat->matricule ;
		}*/
				
		$this->load->view('cv/fpdf_fe2',$data);
	}
	
	/** 
	* Historique information amdin
	* 
	*
	* @return view
	*/
	function histo_info_admin(){
		$this->checkConnexion(array('admin','chef'));
	
		$data = array();
		
		$user = $this->get_current_user();
		$list_mvt = $this->histo_info_administra->get_histo_by_resp_id($user["id"]);
		//var_dump($list_mvt);
		$array_data = array();
		
		foreach($list_mvt as $mvt){
			$row = array();
			//var_dump($mvt);
			$candidat = current($this->candidat->get_candidat_by_id($mvt['candidat_id']));
			$resp = current($this->candidat->get_by_user_id($mvt['resp_id']));
			$row['candidat_nom'] = $candidat->nom.' '.$candidat->prenom;
			if($resp)
				$row['resp_nom'] = $resp->nom.' '.$resp->prenom;
			
			/*
			$old_dep = $this->departement->get_departement($mvt['old_dep_id']);
			$old_dir = $this->direction->get_direction($mvt['old_dir_id']);
			$old_serv = $this->service->get_service($mvt['old_serv_id']);
				
			$new_dep = $this->departement->get_departement($mvt['new_dep_id']);
			$new_dir = $this->direction->get_direction($mvt['new_dir_id']);
			$new_serv = $this->service->get_service($mvt['new_serv_id']);
			*/	
				
			$old_dep_str = "";
			$new_dep_str = "";
			/*	
			if($old_dep){
				$old_dep_str .= '-';
				$old_dep_str .= $old_dep['libele'];
			}
	
			if($old_dir){
				$old_dep_str .= '<br>-';
				$old_dep_str .= $old_dir['libele'];
			}
				
			if($old_serv){
				$old_dep_str .= '<br>-';
				$old_dep_str .= $old_serv['libele'];
			}
				
			if($new_dep){
				$new_dep_str .= '-';
				$new_dep_str .= $new_dep['libele'];
			}
				
			if($new_dir){
				$new_dep_str .= '<br>-';
				$new_dep_str .= $new_dir['libele'];
			}
				
			if($new_serv){
				$new_dep_str .= '<br>-';
				$new_dep_str .= $new_serv['libele'];
			}
				
			if($mvt['type'] == 1){
				$row['type'] = 'Transf&eacute;rer';
			}
			if($mvt['type'] == 2){
				$row['type'] = 'Exp&eacute;dier';
			}
			*/	
			$row['type'] = $mvt['type'];
			$row['old_dep_str'] = $mvt['old_value'];
			$row['new_dep_str'] = $mvt['new_value'];
				
			$row['date'] = $mvt['date_operation'];
			array_push($array_data, $row);
				
		}
		$data['list_mvt'] = $array_data;
		$this->load_my_view('cv/list_mvt',$data);
	}
	
}