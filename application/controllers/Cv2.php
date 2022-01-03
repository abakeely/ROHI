<?php
/**
* @package ROHI
* @subpackage CV
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Cv2 extends MY_Controller {

	/**  
	* Classe qui concerne le CV, nouvelle version
	* @package  ROHI  
	* @subpackage CV2 */ 

	public function __construct(){
		parent::__construct();
		
		
		$this->load->model('user_historique_model','user_historique');
		$this->load->model('candidat_historique_model','candidat_historique');
		$this->load->model('mouvement_candidat_model','mouvement_candidat');
		$this->load->model('candidat_activite_model','candidat_activite');
		$this->load->model('candidat_loisirs_model','candidat_loisirs');
		$this->load->model('candidat_loisirsannexe_model','candidat_loisirsannexe');
		$this->load->model('candidat_stage_model','candidat_stage');
		$this->load->model('histo_info_administra_model','histo_info_administra');
		$this->load->model('evaluation2_gcap_model','evaluation2');
		$this->load->model('Transaction_pointage_model','Transaction');
		$this->load->model('division_model','division');
		$this->load->model('demande_formation_model','demande_formation');
		$this->load->model('contenu_champ_formation_model','contenu_champ_formation');
		$this->load->model('theme_formation_model','theme_formation');
		$this->load->model('module_formation_model','module_formation');     
		$this->load->model('contenu_formation_model','contenu_formation');
		$this->load->model('detache_mfb_model','detache_mfb');
		$this->load->model('detache_model','detache');
		$this->load->model('misedispo_model','misedispo');
		
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
				if(empty($candidat->diplome_list)){
					$temp1 = array('diplome_name'=>'','diplome_disc'=>'','diplome_etab'=>'','diplome_date'=>'','diplome_pays'=>'');
					$candidat->diplome_list = array(0=>$temp1);
				 }
			$candidat->stage_list = $this->candidat_stage->get_stage_candidat($candidat->id);
				if(empty($candidat->stage_list)){
					$temp6 = array('stage_name'=>'','stage_etablissement'=>'','stage_annee'=>'','diplome_pays'=>'');
					$candidat->stage_list = array(0=>$temp6);
				 }
    		$candidat->region = $this->region->get_region($candidat->region_id);
    		$candidat->province = $this->province->get_province($candidat->province_id);
    			
    		$candidat->date_prise_service = $this->date_en_to_fr($candidat->date_prise_service,'-','/');
    			
    		$parcours_list = array();
    		$parcours_list_bo = $this->candidat_parcours->get_parcours_candidat($candidat->id);
			if(!empty($parcours_list_bo)){
				foreach($parcours_list_bo as $parcours){
					$parcours['date_debut'] = $this->date_en_to_fr($parcours['date_debut'],'-','/');
					$parcours['date_fin'] = $this->date_en_to_fr($parcours['date_fin'],'-','/');
					array_push($parcours_list, $parcours);
				}
				$candidat->parcours_list = $parcours_list;
			}else{
				$temp2 = array('date_debut'=>'','date_fin'=>'','par_poste'=>'','par_departement'=>'');
				$candidat->parcours_list = array(0=>$temp2);
			}
    		$candidat->activite_list = $this->candidat_activite->get_activite_candidat($candidat->id);
    			if(empty($candidat->activite_list)){
					$temp3 = array('libele'=>'');
					$candidat->activite_list = array(0=>$temp3);
				 }
			$candidat->loisirs_list = $this->candidat_loisirs->get_loisirs_candidat($candidat->id);
				if(empty($candidat->loisirs_list)){
					$temp3 = array('libele'=>'');
					$candidat->loisirs_list = array(0=>$temp3);
				 }
			$candidat->loisirsannexe_list = $this->candidat_loisirsannexe->get_loisirsannexe_candidat($candidat->id);
				if(empty($candidat->loisirsannexe_list)){
					$temp3 = array('libele'=>'');
					$candidat->loisirsannexe_list = array(0=>$temp3);
				 }
    		$candidat->soa_list = $this->service->get_soa_by_service_id($candidat->service);
				if(empty($candidat->soa_list)){
					$candidat->soa_list = false;
				 }
			return $candidat;
    	}else{
			$temp1 = array('diplome_name'=>'','diplome_disc'=>'','diplome_etab'=>'','diplome_date'=>'','diplome_pays'=>'');
			$candidat->diplome_list = array(0=>$temp1);
			$temp2 = array('date_debut'=>'','date_fin'=>'','par_poste'=>'','par_departement'=>'');
			$candidat->parcours_list = array(0=>$temp2);
			$temp3 = array('libele'=>'');
			$candidat->activite_list = array(0=>$temp3);
			$candidat->loisirs_list = array(0=>$temp3);
			$candidat->loisirsannexe_list = array(0=>$temp3);
			$temp4 = array('stage_name'=>'','stage_etablissement'=>'','stage_annee'=>'','diplome_pays'=>'');
			$candidat->stage_list = array(0=>$temp4);
			return $candidat;
		}
    	
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
            
            
			$data = $this->toLocaliteAgent($data, $candidat);

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
            
           /* $data['list_direction'] = $direction;
            $data['list_service'] = $service;*/
            $data['list_district'] = $district;
            $data['list_pays'] = $pays;
            //$data['list_division'] = $division;
            
			$data['list_statut'] = $statut;
			$data['list_province'] = $this->province->get_province();
            $data['edit'] = false;
            return $data;
            
     }


	/** 
	* redirection vers l'accueil
	*
	* @return view
	*/	
    public function index(){
    	/*$this->checkConnexion();
    	$user = $this->get_current_user();
    	$candidat =$this->candidat->get_by_user_id($user['id'] );*/
    	
    	//$this->communique();

		redirect('accueil/communique');
    	
    	/*if (empty($candidat)){
    		$this->mon_cv();
    	}
    	else{
    		$data = array();
	    	$data['menu'] = 1;
	    	$this->load_my_view('cv/home',$data);
	    	
    	}*/
    	
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

		$oCurl = curl_init($zData1);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);
		$zResponse = curl_exec($oCurl);

		curl_close($oCurl);
		

		if ($zResponse != "") {
			$oAvancementAffiche = json_decode ($zResponse);
			foreach ($oAvancementAffiche as $iKey => $zValue) {
				$oAvancementAffiche = $zValue ; 
			}
		} else {
			$oAvancementAffiche = array();
		}

		return array();// $oAvancementAffiche ; 
	}

	/** 
	* mon cv, page formulaire CV
	*
	* @return view
	*/	
	public function mon_cv($type = FALSE)
	{
		global $oSmarty;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData['iCandidatEditId'] = 0;
		
		$oData['edit_cv'] = false;
		if (isset($_GET['id']) && ($_GET['id'] != '')){

			if ($oUser['role']=="admin" || $oUser['role']=="chef") {
				$candidat = current($this->candidat->get_by_id($_GET['id']));
				$candidat = $this->complete_candidat_for_form($candidat);
				$oData = $this->get_data_list_for_form_cv($candidat->id);
				$oUser =  $this->user->get_user($candidat->user_id);
				$oData['candidat'] = $candidat ;
				$oData['iCandidatEditId'] = $candidat->id;
				if ($candidat->province_id !=''){
					$oData['list_region'] = $this->region->get_region_by_province_id($candidat->province_id);
				}
				if ($candidat->departement !=''){
					$list_direction = $this->direction->get_by_departement($candidat->departement);
					$oData['list_direction'] = $list_direction;
				}
				if ($candidat->direction !=''){
					$list_service = $this->service->get_by_direction($candidat->direction);
					$oData['list_service'] = $list_service;
				}
				if ($candidat->service !=''){
					$list_division = $this->division->get_division_by_service_id($candidat->service);
					$oData['list_division'] = $list_division;
				}
				$oData['candidat_id_edit'] = $candidat->id;
				
				$oData['edit_cv'] = true;
			} else {
				$oUser = $this->get_current_user();
			}

		} else {
			$oData = $this->get_data_list_for_form_cv();
			$oUser = $this->get_current_user();
			
		}

		$zRole = $oUser['role']; 

		$iMatricule = $oUser['im'];
		
		$toAvancement = $this->candidat->getAvancement($iMatricule);
		$toArray = array();
		foreach($toAvancement as $oAvancement){
			array_push($toArray,(object)$oAvancement);
		}
		$toAvancement	=	$toArray;
		$this->candidat->update_corpsGradeIndice($oUser['id'], $toAvancement) ; 
		$oSmarty->assign('toAvancement',$toAvancement);
		 if($type){
			if($type==1)
				$oData['msg'] = "Votre CV est enregistr&eacute;";
			if($type==2)
				$oData['msg'] = "Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s,  veuillez remplir votre CV.";

			if($type==3)
				$oData['msg'] = "Votre CV est enregistr&eacute;. <br/>Veuillez contacter votre &eacute;valuateur pour valider votre localit&eacute; de service";
		}
		if($oUser['exist_cv'] && $oUser['exist_cv']!=0){
			if (isset($_GET['id']) && ($_GET['id'] != '')){
				if ($oUser['role']=="admin" || $oUser['role']=="chef") {
				$candidat = current($this->candidat->get_by_id($_GET['id']));
				$candidat_bo = $this->complete_candidat_for_form($candidat);
				$oData['candidat'] = $candidat_bo ;
				$oUser['statut'] = $candidat_bo->statut;
				$oData['list_region'] = $this->region->get_region_by_province_id($candidat->province_id);
				} else {
					$oUser = $this->get_current_user();
				}
			} else {
				$oData['list_region'] = $this->region->get_region();
				$oCandidat_bo = $this->get_current_candidat_completed_for_form(); 
				$oData['candidat'] = $oCandidat_bo ;
				$oUser['statut'] = $oCandidat_bo->statut;
			}
			$boolMiseDispo = $this->misedispo->getTrue($oUser['id']);
		}
		else{
			$oData['candidat'] = $this->complete_candidat_for_form(array());
			$mat = null;
			$iIm = $oUser['im'];
			$zNnom = $oUser['nom'];
			if(!is_numeric($iIm))
				$mat =  current($this->matricule->get_matricule($iIm,$zNom));
			else
				$mat =  current($this->matricule->get_matricule($iIm));
			
			if($mat){
				$oUser['exist_corps'] = true;
				$oUser['matricule'] = $mat;
			}
			/*$boolMiseDispo = $this->misedispo->getTrue($oUser['id']);*/
		}
		
		
		/*if($boolMiseDispo){
			$oData['miseDispo'] = true;
			$oMiseDispo = $this->misedispo->getMiseDispo($oUser['id']);
			$iTypeMiseDispo = (int)$oMiseDispo[0]['misedispo_type'];
			if($iTypeMiseDispo == 1){
				$oData['iTypeMiseDispo'] = 1;
				$oData['oDetacheMfb'] = $this->detache_mfb->getDetacheMfb($oUser['id']);
			}else{
				$oData['iTypeMiseDispo'] = 0;
				$oData['oDetache'] = $this->detache->getDetache($oUser['id']);
			}
		}*/
		
		/*.................Code Garina...........*/
		
		$oData['oDirectionForDetache'] = $this->direction->get_direction();
		$oData['oServiceForDetache'] = $this->service->get_service();
		$oData['oDivisionForDetache'] = $this->division->get_division();
		
		/*.................Code Garina...........*/
		$oData['user_edit'] = $oUser;
		$this->load->model('compte_gcap_model','Compte');
		$toComptes = $this->Compte->get_by_compte_evaluateur_UserId($oUser['id']);

		$oData['toComptes'] = $toComptes;
		$oData['iModuleActif'] = 0;
		$oData['toAvancement'] = $toAvancement;
		
		
		$oData['zPagination'] = "" ; 
		$oData['menu'] = 4;
		$oData['menu'] = 1;
		$oData['iNotificationAffiche'] = 0;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		
		if($oData['edit_cv']){
			$oSmarty->assign("zUrlPost",base_url(). "cv2/edit_by_resp") ;
		}else $oSmarty->assign("zUrlPost",base_url(). "cv2/create_cv") ;

		$oCandidatCv = $oData['candidat'];

		$zImage = base_url().'assets/upload/default.jpg'; 

		$isPhoto = 0;
		if(count($oCandidatCv)>0){
		
			$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $oCandidatCv->id . "." . $oCandidatCv->type_photo ; 
			$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $oCandidatCv->id . "." . strtoupper($oCandidatCv->type_photo) ; 

			if (file_exists($zImagePath)){
				$zImage = base_url()."assets/upload/" . $oCandidatCv->id . "." . $oCandidatCv->type_photo ; 
			}

			if (file_exists($zImagePath1)){
				$zImage = base_url()."assets/upload/" . $oCandidatCv->id . "." . strtoupper($oCandidatCv->type_photo) ; 
			}

			$isPhoto = 1;
		}
		$oSmarty->assign("oData",$oData) ;
		$oSmarty->assign("isPhoto",$isPhoto) ;
		$oSmarty->assign("zImage",$zImage) ;
		$oSmarty->assign("oCandidatCv",$oData['candidat']) ;
		$oSmarty->assign("oUser",$oUser) ;
		$oSmarty->assign("iExistCv",$oUser['exist_cv']) ;
		$oSmarty->assign("zRole",$oUser['role']) ;
		$oSmarty->assign("zBasePath",base_url());
		
		/*Condition..........*/
		$iFicheDePoste = 0;
		$toFicheDePoste = array();
		if (sizeof($oData['candidat'])>0) {

				$oCandidatCv = $oData['candidat'];
				$iFicheDePoste = $oCandidatCv->fichePosteId;

				if($iFicheDePoste > 0){
					$toFicheDePoste = $this->Accueil->preRemplissageFicheDePoste($iFicheDePoste);
				}

				$zLocaliteDeService		=	$this->candidat->getLocaliteService($oCandidatCv->structureId)["site_libelle"] ;
				$oSmarty->assign("zLocaliteDeService",$zLocaliteDeService) ;
				$oSmarty->assign("iCorp",$oCandidatCv->corps) ;
				$oSmarty->assign("zDatePriseService",$oCandidatCv->date_prise_service) ;
				if(!empty($oCandidatCv->statut))
					$oSmarty->assign("iStatus",$oCandidatCv->statut) ;
				else
					$oSmarty->assign("iStatus",'0') ;
				if(!empty($oCandidatCv->grade))
					$oSmarty->assign("iGrade",$oCandidatCv->grade) ;
				else
					$oSmarty->assign("iGrade",'0') ;
				if(!empty($oCandidatCv->indice))
					$oSmarty->assign("iIndice",$oCandidatCv->indice) ;
				else
					$oSmarty->assign("iIndice",'0') ;
				
		} else {
				
				//$oSmarty->assign("iCorp",$oCandidat[0]->corps) ;
				$oSmarty->assign("zDatePriseService",$oCandidat[0]->date_prise_service) ;
				$zLocaliteDeService		=	$this->candidat->getLocaliteService($oCandidat[0]->structureId)["site_libelle"] ;
				$oSmarty->assign("zLocaliteDeService",$zLocaliteDeService) ;
				if(!empty($oUser['statut']))
					$oSmarty->assign("iStatus",$oUser['statut']) ;
				else
					$oSmarty->assign("iStatus",'0') ;


				$iCorp = 0;
				if(!empty($oUser['corps_id']))
					$oSmarty->assign("iCorp",$oUser['corps_id']) ;
				else {
					if(!empty($oUser['statut']) && ($oUser['statut'] == 2)){
						$oSmarty->assign("iCorp","ECD") ;
					} else {
						$oSmarty->assign("iCorp",$iCorp) ;
					}
				}

				if(!empty($oCandidat[0]->indice))
					$oSmarty->assign("iIndice",$oCandidat[0]->indice) ;
				else
					$oSmarty->assign("iIndice",'0') ;
		}

		
		/*.........Condition End*/
		if($oCandidat[0]->corps=="0" || $oCandidat[0]->corps=="999999" )
			$oSmarty->assign("zAutreCorp",$oCandidat[0]->corps) ;
		if($oCandidat[0]->indice=="0" || $oCandidat[0]->indice=="999999" )
			$oSmarty->assign("zAutreIndice",$oCandidat[0]->indice) ;
		if($oCandidat[0]->grade=="0" || $oCandidat[0]->grade=="999999" )
			$oSmarty->assign("zAutreGarde",$oCandidat[0]->grade) ;
		
		$structureMad	=	$this->Gcap->getInstitutionByid($oCandidat[0]->structureMad);
		$structureMad	=	$structureMad["institution_libelle"] ."(".$structureMad["ministere"].")";
		$oSmarty->assign("structureMad",$structureMad) ;

		$oSmarty->assign("toFicheDePoste",$toFicheDePoste) ;
		$oSmarty->assign('zInfoAdmin', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/info_administrative.tpl" )) ;
		$oSmarty->assign('zCarriere', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/carriere.tpl" )) ;
		$oSmarty->assign('zFormation', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/formation.tpl" )) ;
		$oSmarty->assign('zLoisir', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/loisir.tpl" )) ;
		$oSmarty->assign('zClearCache', date("YmdHis")) ;
		$oSmarty->assign("zImage",$zImage) ;
		
		$this->load_my_view_Common('cv/new/cv.tpl',$oData, $iModuleId);
		
	}


	/** 
	* mon cv, page formulaire CV
	*
	* @return view
	*/	
	public function mon_cv2($type = FALSE)
	{
		global $oSmarty;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = $this->get_data_list_for_form_cv();
		$oData['iCandidatEditId'] = 0;
		
		$oData['edit_cv'] = false;
		if (isset($_GET['id']) && ($_GET['id'] != '')){

			if ($oUser['role']=="admin" || $oUser['role']=="chef") {
				$candidat = current($this->candidat->get_by_id($_GET['id']));
				$candidat = $this->complete_candidat_for_form($candidat);
				$oUser =  $this->user->get_user($candidat->user_id);
				$oData['candidat'] = $candidat ;
				$oData['iCandidatEditId'] = $candidat->id;


				if ($candidat->province_id !=''){
					$oData['list_region'] = $this->region->get_region_by_province_id($candidat->province_id);
				}

				if ($candidat->departement !=''){
					$list_direction = $this->direction->get_by_departement($candidat->departement);
					$oData['list_direction'] = $list_direction;
				}

				if ($candidat->direction !=''){
					$list_service = $this->service->get_by_direction($candidat->direction);
					$oData['list_service'] = $list_service;
				}

				if ($candidat->service !=''){
					$list_division = $this->division->get_division_by_service_id($candidat->service);
					$oData['list_division'] = $list_division;
				}

				$oData['candidat_id_edit'] = $candidat->id;
				
				$oData['edit_cv'] = true;
			} else {
				$oUser = $this->get_current_user();
			}

		} else {
			$oUser = $this->get_current_user();
		}
		
		
		$zRole = $oUser['role']; 

		$iMatricule = $oUser['im'];
		
		$toAvancement = $this->AvancementAgent($iMatricule);

		if (is_object($toAvancement)) {

			$toArray = array();
			array_push($toArray,$toAvancement);
			$toAvancement = $toArray;
		}

		$this->candidat->update_corpsGradeIndice($oUser['id'], $toAvancement) ; 
		$oSmarty->assign('toAvancement',$toAvancement);
		 if($type){
			if($type==1)
				$oData['msg'] = "Votre CV est enregistr&eacute;";
			if($type==2)
				$oData['msg'] = "Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s,  veuillez remplir votre CV.";

			if($type==3)
				$oData['msg'] = "Votre CV est enregistr&eacute;. <br/>Veuillez contacter votre &eacute;valuateur pour valider votre localit&eacute; de service";
		}
				
		if($oUser['exist_cv'] && $oUser['exist_cv']!=0){
			if (isset($_GET['id']) && ($_GET['id'] != '')){
				if ($oUser['role']=="admin" || $oUser['role']=="chef") {
				$candidat = current($this->candidat->get_by_id($_GET['id']));
				$candidat_bo = $this->complete_candidat_for_form($candidat);
				$oData['candidat'] = $candidat_bo ;
				$oUser['statut'] = $candidat_bo->statut;
				$oData['list_region'] = $this->region->get_region_by_province_id($candidat->province_id);
				} else {
					$oUser = $this->get_current_user();
				}
			} else {
				$oData['list_region'] = $this->region->get_region();
				$oCandidat_bo = $this->get_current_candidat_completed_for_form(); 
				$oData['candidat'] = $oCandidat_bo ;
				$oUser['statut'] = $oCandidat_bo->statut;
			}
			$boolMiseDispo = $this->misedispo->getTrue($oUser['id']);
		}
		else{
			$oData['candidat'] = $this->complete_candidat_for_form(array());
			$mat = null;
			$iIm = $oUser['im'];
			$zNnom = $oUser['nom'];
			if(!is_numeric($iIm))
				$mat =  current($this->matricule->get_matricule($iIm,$zNom));
			else
				$mat =  current($this->matricule->get_matricule($iIm));
			
			if($mat){
				$oUser['exist_corps'] = true;
				$oUser['matricule'] = $mat;
			}
			$boolMiseDispo = $this->misedispo->getTrue($oUser['id']);
		}
		
		
		if($boolMiseDispo){
			$oData['miseDispo'] = true;
			$oMiseDispo = $this->misedispo->getMiseDispo($oUser['id']);
			$iTypeMiseDispo = (int)$oMiseDispo[0]['misedispo_type'];
			if($iTypeMiseDispo == 1){
				$oData['iTypeMiseDispo'] = 1;
				$oData['oDetacheMfb'] = $this->detache_mfb->getDetacheMfb($oUser['id']);
			}else{
				$oData['iTypeMiseDispo'] = 0;
				$oData['oDetache'] = $this->detache->getDetache($oUser['id']);
			}
		}
		
		/*.................Code Garina...........*/
		
		$oData['oDirectionForDetache'] = $this->direction->get_direction();
		$oData['oServiceForDetache'] = $this->service->get_service();
		$oData['oDivisionForDetache'] = $this->division->get_division();
		
		/*.................Code Garina...........*/
		$oData['user_edit'] = $oUser;
		$this->load->model('compte_gcap_model','Compte');
		$toComptes = $this->Compte->get_by_compte_evaluateur_UserId($oUser['id']);

		$oData['toComptes'] = $toComptes;
		$oData['iModuleActif'] = 0;
		$oData['toAvancement'] = $toAvancement;
		
		
		$oData['zPagination'] = "" ; 
		$oData['menu'] = 4;
		$oData['menu'] = 1;
		$oData['iNotificationAffiche'] = 0;
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		
		if($oData['edit_cv']){
			$oSmarty->assign("zUrlPost",base_url(). "cv2/edit_by_resp") ;
		}else $oSmarty->assign("zUrlPost",base_url(). "cv2/create_cv") ;
		//$oSmarty->assign("zUrlPost",base_url(). "cv2/create_cv") ;

		$oCandidatCv = $oData['candidat'];

		$zImage = base_url().'assets/upload/default.jpg'; 

		$isPhoto = 0;
		if(count($oCandidatCv)>0){
		
			$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $oCandidatCv->id . "." . $oCandidatCv->type_photo ; 
			$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $oCandidatCv->id . "." . strtoupper($oCandidatCv->type_photo) ; 

			if (file_exists($zImagePath)){
				$zImage = base_url()."assets/upload/" . $oCandidatCv->id . "." . $oCandidatCv->type_photo ; 
			}

			if (file_exists($zImagePath1)){
				$zImage = base_url()."assets/upload/" . $oCandidatCv->id . "." . strtoupper($oCandidatCv->type_photo) ; 
			}

			$isPhoto = 1;
		}

		$oSmarty->assign("oData",$oData) ;
		$oSmarty->assign("isPhoto",$isPhoto) ;
		$oSmarty->assign("zImage",$zImage) ;
		$oSmarty->assign("oCandidatCv",$oData['candidat']) ;
		$oSmarty->assign("oUser",$oUser) ;
		$oSmarty->assign("iExistCv",$oUser['exist_cv']) ;
		$oSmarty->assign("zRole",$oUser['role']) ;
		$oSmarty->assign("zBasePath",base_url());
		
		/*Condition..........*/
		$iFicheDePoste = 0;
		$toFicheDePoste = array();
		if (sizeof($oData['candidat'])>0) {

				/*$oCandidatCv = $oData['candidat'];
				$oSmarty->assign("iCorp",$oCandidatCv->corps) ;
				$oSmarty->assign("zDatePriseService",$oCandidatCv->date_prise_service) ;
				if(!empty($oCandidat[0]->statut))
					$oSmarty->assign("iStatus",$oCandidat[0]->statut) ;
				else
					$oSmarty->assign("iStatus",'0') ;
				if(!empty($oCandidat[0]->grade))
					$oSmarty->assign("iGrade",$oCandidatCv->grade) ;
				else
					$oSmarty->assign("iGrade",'0') ;
				if(!empty($oCandidat[0]->indice))
					$oSmarty->assign("iIndice",$oCandidatCv->indice) ;
				else
					$oSmarty->assign("iIndice",'0') ;*/

				$oCandidatCv = $oData['candidat'];
				$iFicheDePoste = $oCandidatCv->fichePosteId;

				if($iFicheDePoste > 0){
					$toFicheDePoste = $this->Accueil->preRemplissageFicheDePoste($iFicheDePoste);
				}


				$oSmarty->assign("iCorp",$oCandidatCv->corps) ;
				$oSmarty->assign("zDatePriseService",$oCandidatCv->date_prise_service) ;
				if(!empty($oCandidatCv->statut))
					$oSmarty->assign("iStatus",$oCandidatCv->statut) ;
				else
					$oSmarty->assign("iStatus",'0') ;
				if(!empty($oCandidatCv->grade))
					$oSmarty->assign("iGrade",$oCandidatCv->grade) ;
				else
					$oSmarty->assign("iGrade",'0') ;
				if(!empty($oCandidatCv->indice))
					$oSmarty->assign("iIndice",$oCandidatCv->indice) ;
				else
					$oSmarty->assign("iIndice",'0') ;
				
		} else {
				
				//$oSmarty->assign("iCorp",$oCandidat[0]->corps) ;
				$oSmarty->assign("zDatePriseService",$oCandidat[0]->date_prise_service) ;
				if(!empty($oUser['statut']))
					$oSmarty->assign("iStatus",$oUser['statut']) ;
				else
					$oSmarty->assign("iStatus",'0') ;


				$iCorp = 0;
				if(!empty($oUser['corps_id']))
					$oSmarty->assign("iCorp",$oUser['corps_id']) ;
				else {
					if(!empty($oUser['statut']) && ($oUser['statut'] == 2)){
						$oSmarty->assign("iCorp","ECD") ;
					} else {
						$oSmarty->assign("iCorp",$iCorp) ;
					}
				}

				if(!empty($oCandidat[0]->indice))
					$oSmarty->assign("iIndice",$oCandidat[0]->indice) ;
				else
					$oSmarty->assign("iIndice",'0') ;
		}

		
		/*.........Condition End*/
		if($oCandidat[0]->corps=="0" || $oCandidat[0]->corps=="999999" )
			$oSmarty->assign("zAutreCorp",$oCandidat[0]->corps) ;
		if($oCandidat[0]->indice=="0" || $oCandidat[0]->indice=="999999" )
			$oSmarty->assign("zAutreIndice",$oCandidat[0]->indice) ;
		if($oCandidat[0]->grade=="0" || $oCandidat[0]->grade=="999999" )
			$oSmarty->assign("zAutreGarde",$oCandidat[0]->grade) ;

		/*echo "<pre>";
		print_r ($oData);
		echo "</pre>";*/

		$oSmarty->assign("toFicheDePoste",$toFicheDePoste) ;
		$oSmarty->assign('zInfoAdmin', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/info_administrative2.tpl" )) ;
		$oSmarty->assign('zCarriere', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/carriere.tpl" )) ;
		$oSmarty->assign('zFormation', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/formation.tpl" )) ;
		$oSmarty->assign('zLoisir', $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/loisir.tpl" )) ;
		$oSmarty->assign('zClearCache', date("YmdHis")) ;
		$oSmarty->assign("zImage",$zImage) ;
		/*$oData['zCarriere'] = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/carriere.tpl" ) ;
		$oData['zFormation'] = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/formation.tpl" ) ;
		$oData['zLoisir'] = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "cv/new/loisir.tpl" ) ;*/
		
		$this->load_my_view_Common('cv/new/cv2.tpl',$oData, $iModuleId);
		
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
			// Whoops, we don't have a page for that!
			show_404();
		}
                
		$data['title'] = ucfirst($page); // Capitalize the first letter
		//var_dump($data);
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
		global $oSmarty;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$list_candidat = null;
		$user = $this->get_current_user();
		$candidat = current($this->candidat->get_by_user_id($user['id'] ));
		if($user['role'] == 'chef'){
			$list_candidat = $this->get_candidat_subordonnee($user,$candidat);
		}
		else if($user['role'] == 'admin'){
			$list_candidat = $this->candidat->get_all_list_valide($candidat->service);
		}
		
		
		$oData = array();
		$list_fin = $this->complete_array_canditat($list_candidat);
		$oData['list_candidat'] = $list_fin;
		
		$list_departement = $this->departement->get_departement();
		$oData['list_departement'] = json_encode($list_departement);
		$list_region  = $this->region->get_region();
		$oData['list_region'] = json_encode($list_region);
		$oData['menu'] = 64;
		$oData['oCandidat'] = $oCandidat;
		$oData['oUser'] = $oUser;
		if($succes)
			$oData['msg'] = "Op&eacute;ration effectu&eacute;e ";
		
        $this->load_my_view_Common('cv/new/liste_cv_dep.tpl',$oData,$iModuleId);
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
		global $oSmarty;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$candidat = $this->get_current_candidat_completed_for_form();
		
		if(isset($candidat->direction)){
			$list_service = $this->service->get_by_direction($candidat->direction);
			if(!empty($list_service)){
				$oData['list_service'] = json_encode($list_service);
			}
		}
		
		$list_departement = $this->departement->get_departement();
		$oData['list_departement'] = $list_departement;
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
		}
		else{
			$depart_id = current(current($list_departement));
			$list_direction = $this->direction->get_by_departement($depart_id);
			$direct_id = current(current($list_direction));	
			$list_candidat = $this->candidat->get_candidat_by_direction($direct_id);
		}
		
		$oData['direction_edit'] = $direct_id;
		$oData['departement_edit'] = $depart_id;
			
		$oData['list_direction'] = $list_direction;
		
		$list_fin = $this->complete_array_canditat($list_candidat);
		$oData['list_candidat'] = $list_fin;
		$oData['oCandidat'] = $oCandidat;
		$oData['oUser'] = $oUser;
		$oData['menu'] = 64;
        $this->load_my_view_Common('cv/new/liste_cv_with_form.tpl',$oData,$iModuleId);
	}
        
	/** 
	* liste invalide
	*
	* @return view
	*/
     public function list_invalide(){
		$this->checkConnexion();
		global $oSmarty;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
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
		$oData = array();
		$list_fin = $this->complete_array_canditat($list_candidat);
		//var_dump($list_fin);
		$oData['list_candidat'] = $list_fin;
		//var_dump($list_fin);
		$oData['menu'] = 65;
		$oData['valide'] = 1;
		$oData['oCandidat'] = $oCandidat;
		$oData['oUser'] = $oUser;
		
		$this->load_my_view_Common('cv/new/liste_cv.tpl',$oData,$iModuleId);
		
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
	public function edit_by_resp() {

		$this->checkConnexion(array('admin','resp','chef'));
		
		$diplome_name = $_POST['diplome_name'];
		$diplome_discipline = $_POST['diplome_discipline'];
		$diplome_date = $_POST['diplome_date'];
		$diplome_etablissement = $_POST['diplome_etablissement'];
		$diplome_pays = $_POST['diplome_pays'];
		
		$autre_division = $_POST['autre_division'];
		$autre_direction = $_POST['autre_direction'];
		$autre_service = $_POST['autre_service'];
		
		$autre_domaine = $_POST['autre_domaine'];
		$parcours_date_debut = $_POST['date_debut'];
		$parcours_date_fin = $_POST['date_fin'];
		$parcours_poste = $_POST['par_poste'];
		$parcours_departement = $_POST['par_departement'];               
                
		$date_naiss	 	= $_POST['date_naiss'];
		$sit_mat 		= $_POST['sit_mat'];
		$domaine 		= $_POST['domaine'];
		$phone 			= $_POST['phone'];
		$addresse 		= $_POST['addresse'];
		//$id 			= $_POST['id'];

		$id	= $_POST['candidat_id'];
		
		$email 			= $_POST['email'];	
		
		if(isset($_POST['corps']))
			$corps 	= $_POST['corps'];
		if(isset($_POST['grade']))
			$grade = $_POST['grade'];
		if(isset($_POST['indice']))
			$indice = $_POST['indice'];
		
		$autre_corps 			= $_POST['corps'];
		$autre_grade 			= $_POST['grade'];
		$autre_indice			= $_POST['indice'];
		
		$statut = null;
		if(isset($_POST['statut']))
			$statut	= $_POST['statut'];
		
		$departement 	= $_POST['departement'];

		/****************** Sauvegarde direction et service ****************/
		
		$zDirection = "";
		$zService = "";

		$toDirection = array();
		$toService = array();

		for ($i=sizeof($_POST['iRattachement'])-1;$i>=0;$i--){

			$zValue = $_POST['iRattachement'][$i];
			$toExplode = explode("_",$zValue);
			switch($toExplode[0]){

				case "DIR":
					array_push($toDirection,$toExplode[1]);
					break;

				case "SER":
					array_push($toService,$toExplode[1]);
					break;

			}
		}

		$zDirection = implode("-",$toDirection);
		$zService = implode("-",$toService);

		$direction 	= $zDirection ;
		$service 	= $zService;

		/****************** fin Sauvegarde direction et service ****************/


		/*$direction 		= $_POST['direction'];
		$service 		= $_POST['service'];*/
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

		/*if (isset($_POST['direction']) && ($_POST['direction'] != "")) {
			$direction 		= $_POST['direction'];
		}

		if (isset($_POST['service']) && ($_POST['service'] != "")) {
			$service 		= $_POST['service'];
		}*/


		
		if (isset($_POST['division']) && ($_POST['division'] != "")) {
			$division 		= $_POST['division'];
		}

		$lacalite_service= $_POST['lacalite_service'];
		$porte           = $_POST['porte'];
		$poste           = $_POST['poste'];
		$nbr_enfant		 = $_POST['nbr_enfant'];
		$district		 = $_POST['district'];
                
		$date_naiss = $_POST['date_naiss'];
		
		$list_activite = $_POST['activite'];
		
		$soa = $this->array_to_string($soa);
		
		if(isset($_POST['region']))
			$region = $_POST['region'];
		if(isset($_POST['province']))
			$province	= $_POST['province'];
		
		$pays	= $_POST['pays'];
		
		$date_prise_service	= $_POST['date_prise_service'];
		
        $oCandidat  = $this->candidat->get_by_id($id);
		$user_id = $oCandidat[0]->user_id; //$user['id'];
		
		$data = array();
		
		$data['sit_mat'] = $sit_mat;
		$data['phone'] = $phone;
		$data['address'] = $addresse;
		$data['domaine'] = $domaine ;
        $data['autre_domaine'] = $autre_domaine;
		$data['nbr_enfant'] = $nbr_enfant;
                
		/* Modif 14/01/2017 modification passive CV */
		
		$data['autre_division'] = $autre_division;
		$data['autre_direction'] = $autre_direction;
		$data['autre_service'] = $autre_service;
		$data['date_prise_service'] = $this->date_fr_to_en($date_prise_service,'/','-');
	
		$data['email'] = $email;
		$data['corps'] = $corps;
		$data['grade'] = $grade;
		$data['indice'] = $indice;
		//$data['statut'] = $user['statut'];     
		
		$data['autre_corps'] = $corps;
		$data['autre_grade'] = $grade;
		$data['autre_indice'] = $indice;
		
		$data['district_id'] = $district;
		$data['region_id'] = $region;
		$data['province_id'] = $province;
		$data['pays_id'] = $pays;
		$data['departement'] = $departement;
		$data['direction'] = $direction;
		$data['service'] = $service;
		$data['division'] = $division;

		$data['lacalite_service'] = $lacalite_service;
		$data['porte']            = $porte;
		$data['poste']            = $poste;
		if(isset( $_POST["structure_id"] )){
			if (!empty($_POST['structure_id'])) {
				$data['structureId']	  = $_POST["structure_id"];
			}
		}
		
		//$data['matricule'] = $user['im'];
		
		$data['user_id'] = $user_id;
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
			
			//$this->candidat_historique->create_candidat_historique($candidat_histo);
			
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


		$list_loisirs  = $_POST['loisirs'];
		$list_loisirsannexe  = $_POST['loisirsannexe'];

		$toStageName = $_POST['stage_name'];
		$toStageEtablissement = $_POST['stage_etablissement'];
		$toStageAnnee = $_POST['stage_annee'];
		$toStagePays = $_POST['stage_pays'];
		$this->candidat_stage->delete_all_stage_candidat($id);
		if(isset($toStageEtablissement)){
			$size_stage = sizeof($toStageEtablissement);
			for($i=0;$i<$size_stage;$i++){
				$oDataStage = array();
				$oDataStage['candidat_id'] =  $id;
				$oDataStage['stage_name'] =  $toStageName[$i];
				$oDataStage['stage_etablissement'] =  $toStageEtablissement[$i];
				$oDataStage['stage_annee'] =  $toStageAnnee[$i];
				$oDataStage['stage_pays'] =  $toStagePays[$i];
				$this->candidat_stage->insert($oDataStage);
			}
		}

		$this->candidat_loisirs->delete_all_loisirs_candidat($id);
		$size_loisirs = sizeof($list_loisirs);
		for($i=0;$i<$size_loisirs;$i++){
			 $data_loisirs = array();
			 $data_loisirs['candidat_id'] =  $id;
			 $data_loisirs['libele'] =  $list_loisirs[$i];
			 $this->candidat_loisirs->insert($data_loisirs);
		}

		$this->candidat_loisirsannexe->delete_all_loisirsannexe_candidat($id);
		$size_loisirsannexe = sizeof($list_loisirsannexe);
		for($i=0;$i<$size_loisirsannexe;$i++){
			 $data_loisirsannexe = array();
			 $data_loisirsannexe['candidat_id'] =  $id;
			 $data_loisirsannexe['libele'] =  $list_loisirsannexe[$i];
			 $this->candidat_loisirsannexe->insert($data_loisirsannexe);
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


			//print_r($photo);die();
			$zName = $id.'.'.strtolower($ext);

			@move_uploaded_file($photo['tmp_name'], PATH_ROOT_DIR . '/assets/upload/' . $zName);

			if ($photo['name'] != ""){
				$oDataPhoto = array();
				$oDataPhoto["photo_nom"] = $zName;
				$oDataPhoto["photo_origine"] = $photo['name'];
				$oDataPhoto["photo_date"] = date("Y-m-d H:i:s") ;
				$oDataPhoto["photo_userId"] = $user_id;
				$this->candidat->insertCandidatPhoto($oDataPhoto);
			}

			/* Modif Îles aux trésors resizeimage */ 

			if(isset($ext) && ($ext != ''))
			{
				$this->resizePicture(PATH_ROOT_DIR . '/assets/upload/' . $zName, $zName , "300", "300");
			}

		}

		redirect('cv2/mon_cv?id='.$id);

	}

	/** 
	* Création CV
	*
	* @return view
	*/
	public function create_cv(){

		$this->checkConnexion();
		$user  = $this->get_current_user();
		$user_id = $user['id'];
		$toDirection = array();
		$toService = array();
		$zDirection = "";
		$zService = "";
	
				
		$boolMiseDispo 	= $this->misedispo->getTrue($user_id);
		$oMiseDispoType = $this->misedispo->getMiseDispo($user_id);
		$iMiseDispoType = $oMiseDispoType[0]['misedispo_tye'];
		//echo $_POST['radioMAD'];die;
		//print_r($_POST);die;
		/*if(isset($_POST['radioMAD']) && $_POST['radioMAD']=="1"){
			$iTypeMad								= (int)$_POST['iInstitutionId'];
			if($iTypeMad == 1){
				$oDataMiseDispo['misedispo_userId'] = $user_id;
				$oDataMiseDispo['misedispo_type']	= $iTypeMad;
				
				$oDataDetacheMfb['pays_id']			= $_POST['paysMAD'];
				$oDataDetacheMfb['province_id']		= $_POST['provinceMAD'];
				$oDataDetacheMfb['region_id']		= $_POST['regionMAD'];
				$oDataDetacheMfb['district_id']		= $_POST['districtMAD'];
				$oDataDetacheMfb['departement_id']	= $_POST['departementMAD'];
				$oDataDetacheMfb['direction_id']	= $_POST['directionMAD'];
				$oDataDetacheMfb['service_id']		= $_POST['serviceMAD'];
				if(isset($_POST['divisionMAD'])){
					$oDataDetacheMfb['division_id'] = $_POST['divisionMAD'];
				}
				$oDataDetacheMfb['porte']			= $_POST['porteMAD'];
				$oDataDetacheMfb['lieu_travail']	= $_POST['lacalite_serviceMAD'];
				$oDataDetacheMfb['user_id']			= $user_id;
				if($boolMiseDispo && $iMiseDispoType==1){
					$this->misedispo->update($oDataMiseDispo,$user_id);
					$this->detache_mfb->update($oDataDetacheMfb,$user_id);
				}else{
					$this->detache->delete($user_id);
					$this->misedispo->insert($oDataMiseDispo);
					$this->detache_mfb->insert($oDataDetacheMfb) ;
				}				
			}else{
				
				$oDataMiseDispo['misedispo_userId']		= $user_id;
				$oDataMiseDispo['misedispo_type']		= $iTypeMad;
				$oDataDetache['detache_userId']			= $user_id;
				$oDataDetache['detache_institutionId']	= $_POST['iInstitutionId'];
				$oDataDetache['detache_localite']		= $_POST['zLocalite'];
				$oDataDetache['detache_departement']	= $_POST['iDepartementMADId'];
				$oDataDetache['detache_direction']		= $_POST['iDirectionMADId'];
				$oDataDetache['detache_service']		= $_POST['iServiceMADId'];
				
				if($boolMiseDispo && $iMiseDispoType==0){
					$this->misedispo->update($oDataMiseDispo,$user_id);
					$this->detache->update($oDataDetache,$user_id);
				}else{
					$this->detache_mfb->delete($user_id);
					$this->misedispo->insert($oDataMiseDispo);
					$this->detache->insert($oDataDetache) ;
				}
			}
		}else{
			if($boolMiseDispo){
				$this->misedispo->delete($user_id);
				$this->detache_mfb->delete($user_id);
				$this->detache->delete($user_id);
				
			}
		}*/
			
		$toDiplomeName					= $_POST['diplome_name'];
		$toDiplomeDiscipline			= $_POST['diplome_discipline'];
		$toDiplomeDate					= $_POST['diplome_date'];
		$toDiplomeEtablissement			= $_POST['diplome_etablissement'];
		$toDiplomePays					= $_POST['diplome_pays'];
		$toStageName					= $_POST['stage_name'];
		$toStageEtablissement			= $_POST['stage_etablissement'];
		$toStageAnnee					= $_POST['stage_annee'];
		$toStagePays					= $_POST['stage_pays'];
		$autre_division					= $_POST['autre_division'];
		if(isset($_POST['autre_direction']))
			$autre_direction			= $_POST['autre_direction'];
		$autre_service					= $_POST['autre_service'];
		
		$autre_domaine					= $_POST['autre_domaine'];
		$parcours_date_debut			= $_POST['date_debut'];
		$parcours_date_fin				= $_POST['date_fin'];
		$parcours_poste					= $_POST['par_poste'];
		$parcours_departement			= $_POST['par_departement'];               
     
		$date_naiss	 					= $_POST['date_naiss'];
		$sit_mat 						= $_POST['sit_mat'];
		$domaine 						= $_POST['domaine'];
		$phone 							= $_POST['phone'];
		$addresse 						= $_POST['addresse'];
		$email 							= $_POST['email'];	
		if(isset($_POST['corps']))
			$corps 						= $_POST['corps'];
		if(isset($_POST['grade']))
			$grade						= $_POST['grade'];
		if(isset($_POST['indice']))
			$indice						= $_POST['indice'];
		
		$autre_corps 					= $_POST['corps'];
		$autre_grade 					= $_POST['grade'];
		$autre_indice					= $_POST['indice'];
		
		if(isset($_POST['statut']))
			$statut						= $_POST['statut'];
		if (isset($_POST['pays']) && ($_POST['pays'] != "")) {
			$pays 						= $_POST['pays'];
		}
		if (isset($_POST['province']) && ($_POST['province'] != "")) {
			$province 					= $_POST['province'];
		}
		if (isset($_POST['region']) && ($_POST['region'] != "")) {
			$region 					= $_POST['region'];
		}
		if (isset($_POST['district']) && ($_POST['district'] != "")) {
			$district 					= $_POST['district'];
		}
		if (isset($_POST['departement']) && ($_POST['departement'] != "")) {
			$departement 				= $_POST['departement'];
		}
		/* New direction and service */
		$direction 						= $zDirection ;
		$service 						= $zService;
		if (isset($_POST['division']) && ($_POST['division'] != "")) {
			$division 					= $_POST['division'];
		}
		/* Last*/
		$iTestModifLocalite				= 0;
		$lacalite_service				= $_POST['lacalite_service'];
		$porte           				= $_POST['porte'];
		$poste           				= $_POST['poste'];
		$nbr_enfant		 				= $_POST['nbr_enfant'];
		$district		 				= $_POST['district'];
                
		$date_naiss						= $_POST['date_naiss'];
		$list_activite					= $_POST['activite'];
		$list_loisirs					= $_POST['loisirs'];
		$list_loisirsannexe				= $_POST['loisirsannexe'];
		$structure_id					= $_POST['structure_id'];
		$structureMad					= $_POST['iInstitutionId'];
		//$soa = $this->array_to_string($soa);
		
		if(isset($_POST['region']))
			$region = $_POST['region'];
		if(isset($_POST['province']))
			$province	= $_POST['province'];
		
		$pays	= $_POST['pays'];
		
		$date_prise_service	= $_POST['date_prise_service'];
		
        
		
		$oDataCandidat = array();
		$oDataCandidat['sit_mat']			= $sit_mat;
		$oDataCandidat['phone']				= $phone;
		$oDataCandidat['address']			= $addresse;
		$oDataCandidat['domaine']			= $domaine ;
        $oDataCandidat['autre_domaine']		= $autre_domaine;
		$oDataCandidat['nbr_enfant']		= $nbr_enfant;
		$oDataCandidat['structureId']		= $structure_id;
		$oDataCandidat['structureMad']		= $structureMad;
                
		/* Modif 14/01/2017 modification passive CV */
		
		$oDataCandidat['autre_division']		= $autre_division;
		if(isset($autre_direction))
			$oDataCandidat['autre_direction']	= $autre_direction;
		$oDataCandidat['autre_service']			= $autre_service;
		$oDataCandidat['date_prise_service']	= $this->date_fr_to_en($date_prise_service,'/','-');
		$oDataCandidat['email']					= $email;
		$oDataCandidat['corps']					= $corps;
		$oDataCandidat['grade']					= $grade;
		$oDataCandidat['indice']				= $indice;
		if(isset($statut)){
			$oDataCandidat['statut']			= $statut;   
		}else{
			$oDataCandidat['statut']			= "";   
		}
		$oDataCandidat['autre_corps']			= "";
		$oDataCandidat['autre_grade']			= "";
		$oDataCandidat['autre_indice']			= "";
		
		/* Modif 14/01/2017 modification passive CV */

		if ($iTestModifLocalite == 1){

			$oDataLocalitePassive = array();
			$oDataLocalitePassive['localite_userId']		= $user_id;
			$oDataLocalitePassive['localite_paysId']		= $pays;
			$oDataLocalitePassive['localite_provinceId']	= $province;
			$oDataLocalitePassive['localite_regionId']		= $region;
			$oDataLocalitePassive['localite_districtId']	= $district;
			$oDataLocalitePassive['localite_departementId'] = $departement;
			$oDataLocalitePassive['localite_directionId']	= $direction;
			$oDataLocalitePassive['localite_serviceId']		= $service;
			$oDataLocalitePassive['localite_divisionId']	= $division;
			$oDataLocalitePassive['localite_date']			= date("Y-m-d");
			$oDataLocalitePassive['localite_statut']		= 1;

			$this->load->model('localite_gcap_model','Localite');
			$this->Localite->insert($oDataLocalitePassive) ; 
		} else {

			$oDataCandidat['district_id']					= $district;
			$oDataCandidat['region_id']						= $region;
			$oDataCandidat['province_id']					= $province;
			$oDataCandidat['pays_id']						= $pays;
			$oDataCandidat['departement']					= $departement;
			$oDataCandidat['direction']						= $direction;
			$oDataCandidat['service']						= $service;
			$oDataCandidat['division']						= $division;
		}

		$oDataCandidat['lacalite_service']					= $lacalite_service;
		$oDataCandidat['porte']								= $porte;
		$oDataCandidat['poste']								= $poste;
		$oDataCandidat['matricule']							= $user['im'];
		$oDataCandidat['user_id']							= $user_id;
		if(isset($user['cin']))
			$oDataCandidat['cin']							= $user['cin'];
		
        $this->user->set_exist_cv($user_id);
		$photo												= $_FILES['photo'];
		if($photo){
			$type = $photo['type'];
			$ext = substr($type, 6);
			if($ext == 'jpeg'){
				$name = $photo['name'];
				$len = strlen($name);
				$ext0 = substr($name,$len-4);
				print_r($ext);print_r($ext0);
				if($ext0 != $ext){
					$ext = 'jpg';
				}
			}

			if(strlen($ext)>2){
				$oDataCandidat['type_photo'] = $ext;
			}
			
		}

		$bo_candidat = current($this->candidat->get_by_user_id($user_id));
		if(!$bo_candidat){
			$user							= $this->user->get_user($user_id);
			$oDataCandidat['nom']			=  $user['nom'];
			$oDataCandidat['prenom']		= $user['prenom'];
			$oDataCandidat['date_naiss']	= $this->date_fr_to_en($date_naiss,'/','-');
			$oDataCandidat['sexe']			= $user['sexe'];
			$now							= date('Y-m-d\TH:i:s');
			$oDataCandidat['date_creation'] = $now;
			/*$oDataCandidat['categorie'] = 8;
			$oDataCandidat['chapitre'] = 8;*/
			
			$this->candidat->insert($oDataCandidat);
			// creation historique
			$data_histo						= array();
			$data_histo['user_id']			= $user_id;
			$data_histo['type']				= 'CREATE_CV';
			$data_histo['date']				= $now ;
			$data_histo['host_user']		= $this->get_user_data('ip_address');;
			$data_histo['agent_user']		= $_SERVER['HTTP_USER_AGENT'];
			
			$this->user_historique->create_user_historique($data_histo);
			// fin creatin historique
			
			$this->user->set_exist_cv($user_id);
		   // session_start() ;
			$user1							= $this->user->get_user($user_id);
			$matricule_bo					= null;
			if($statut == 3 || $statut == 5 || $statut == 7 || $statut == 8)
				$matricule_bo				=  current($this->matricule->get_matricule($user['im']));
			if($matricule_bo!=null)
				$user1['matricule']			= $this->complete_matricule($matricule_bo);
			
			$bo_candidat					= current($this->candidat->get_by_user_id($user_id));
			$candidat						= $bo_candidat;
			$id								= $candidat->id;
			if(isset($toDiplomeName)){
				$iSizeDiplome = sizeof($toDiplomeName);
				for($i=0;$i<$iSizeDiplome;$i++){
					$oDataDiplome					=  array();
					$oDataDiplome['candidat_id']	=  $id;
					$oDataDiplome['diplome_name']	=  $toDiplomeName[$i];
					$oDataDiplome['diplome_etab']	=  $toDiplomeEtablissement[$i];
					$oDataDiplome['diplome_date']	=  $toDiplomeDate[$i];
					$oDataDiplome['diplome_pays']	=  $toDiplomePays[$i];
					$oDataDiplome['diplome_disc']	=  $toDiplomeDiscipline[$i];
					$this->candidat_diplome->insert($oDataDiplome);
				}

			}
			if(isset($parcours_poste)){
				$this->candidat_parcours->delete_all_parcours_candidat($id);
				$size_parcours = sizeof($parcours_poste);
				for($i=0;$i<$size_parcours;$i++){
					$oDataParcours						= array();
					$oDataParcours['candidat_id']		=  $id;
					$oDataParcours['date_debut']		= $this->date_fr_to_en($parcours_date_debut[$i],'/','-');
					$oDataParcours['date_fin']			= $this->date_fr_to_en($parcours_date_fin[$i],'/','-');
					$oDataParcours['par_poste']			= $parcours_poste[$i];
					$oDataParcours['par_departement']	=  $parcours_departement[$i];
					$this->candidat_parcours->insert($oDataParcours);
				}
			}
			
			if(isset($toStageName)){
				$size_stage								= sizeof($toStageName);
				for($i=0;$i<$size_stage;$i++){
					$oDataStage							= array();
					$oDataStage['candidat_id']			=  $id;
					$oDataStage['stage_name']			=  $toStageName[$i];
					$oDataStage['stage_etablissement']	=  $toStageEtablissement[$i];
					$oDataStage['stage_annee']			=  $toStageAnnee[$i];
					$oDataStage['stage_pays']			=  $toStagePays[$i];
					$this->candidat_stage->insert($oDataStage);
				}
			}
			
			if($list_activite){
				$size_active							= sizeof($list_activite);
				for($i=0;$i<$size_active;$i++){
					 $data_activite						= array();
					 $data_activite['candidat_id']		=  $id;
					 $data_activite['libele']			=  $list_activite[$i];
					 $this->candidat_activite->insert($data_activite);
				}

			}
			if($list_loisirs){
				$size_loisirs							= sizeof($list_loisirs);
				for($i=0;$i<$size_loisirs;$i++){
					 $data_loisirs						= array();
					 $data_loisirs['candidat_id']		=  $id;
					 $data_loisirs['libele']			=  $list_loisirs[$i];
					 $this->candidat_loisirs->insert($data_loisirs);
				}
			}
			
			if($list_loisirsannexe){
				$size_loisirsannexe						= sizeof($list_loisirsannexe);
				for($i=0;$i<$size_loisirsannexe;$i++){
					 $data_loisirsannexe				= array();
					 $data_loisirsannexe['candidat_id'] =  $id;
					 $data_loisirsannexe['libele']		=  $list_loisirsannexe[$i];
					 $this->candidat_loisirsannexe->insert($data_loisirsannexe);
				}
			}
			
		}else{	
			$id									= $bo_candidat->id;
			$oDataCandidat['date_naiss']		= $this->date_fr_to_en($date_naiss,'/','-'); 
			$now								= date('Y-m-d\TH:i:s');
			$oDataCandidat['date_last_modif']	= $now;
			if(isset( $_POST["structure_id"] )){
				if (!empty($_POST['structure_id']) && $_POST['structure_id']!="1") {
					$oDataCandidat['structureId']	  = $_POST["structure_id"];
				}else{
					$oDataCandidat['structureId']	  = $bo_candidat->structureId;
				}
			}
			$oDataCandidat['path']				= $_POST["path"];
			
			// creation historique
			$data_histo							= array();
			$data_histo['user_id']				= $user_id;
			$data_histo['type']					= 'UPDATE_CV';
			$data_histo['date']					= $now ;
			$data_histo['host_user']			= $this->get_user_data('ip_address');;
			$data_histo['agent_user']			= $_SERVER['HTTP_USER_AGENT'];
			
			$this->user_historique->create_user_historique($data_histo);
			$user_histo 						= $this->user_historique->get_last_by_user_id($user_id);
			// fin creatin historique
			//historique candidat
			$candidat_histo								= array();
			$candidat_histo['user_historique_id']		= $user_histo->id;
			$candidat_histo['nom']						= $bo_candidat->nom;
			$candidat_histo['prenom']					= $bo_candidat->prenom;
			$candidat_histo['date_naiss']				= $bo_candidat->date_naiss;
			$candidat_histo['phone']					= $bo_candidat->phone;
			$candidat_histo['address']					= $bo_candidat->address;
			$candidat_histo['sit_mat']					= $bo_candidat->sit_mat;
			$candidat_histo['email']					= $bo_candidat->email;
			$candidat_histo['ancien_corps']				= $bo_candidat->corps;
			$candidat_histo['ancien_grade']				= $bo_candidat->grade;
			$candidat_histo['ancien_indice']			= $bo_candidat->indice;
			$candidat_histo['nouveau_corps']			= $oDataCandidat['corps'];
			$candidat_histo['nouveau_grade']			= $oDataCandidat['grade'];
			$candidat_histo['nouveau_indice']			= $oDataCandidat['indice'];
			$candidat_histo['cin']						= $bo_candidat->cin;
			$candidat_histo['ancien_structure_id']		= $bo_candidat->structureId;
			$candidat_histo['nouveau_structure_id']		= $oDataCandidat['structureId'];
			$candidat_histo['date_creation']			= date('Y-m-d\TH:i:s');
			
			//$this->candidat_historique->create_candidat_historique($candidat_histo);
			
			if(isset($toDiplomeName)){
				$this->candidat_diplome->delete_all_diplome_candidat($id);
				$iSizeDiplome = sizeof($toDiplomeName);
				for($i=0;$i<$iSizeDiplome;$i++){
					$oDataDiplome					= array();
					$oDataDiplome['candidat_id']	=  	$id;
					$oDataDiplome['diplome_name']	=  	$toDiplomeName[$i];
					$oDataDiplome['diplome_etab']	=  	$toDiplomeEtablissement[$i];
					$oDataDiplome['diplome_date']	= 	$toDiplomeDate[$i];
					$oDataDiplome['diplome_pays']	=  	$toDiplomePays[$i];
					$oDataDiplome['diplome_disc']	= 	$toDiplomeDiscipline[$i];
					$this->candidat_diplome->insert($oDataDiplome);
				}
			}
			
			
			$this->candidat_activite->delete_all_activite_candidat($id);
			$size_active							= sizeof($list_activite);
			for($i=0;$i<$size_active;$i++){
				 $data_activite						= array();
				 $data_activite['candidat_id']		=  $id;
				 $data_activite['libele']			=  $list_activite[$i];
				 $this->candidat_activite->insert($data_activite);
			}
			
			$this->candidat_loisirs->delete_all_loisirs_candidat($id);
			$size_loisirs = sizeof($list_loisirs);
			for($i=0;$i<$size_loisirs;$i++){
				 $data_loisirs = array();
				 $data_loisirs['candidat_id'] =  $id;
				 $data_loisirs['libele'] =  $list_loisirs[$i];
				 $this->candidat_loisirs->insert($data_loisirs);
			}
			
			$this->candidat_loisirsannexe->delete_all_loisirsannexe_candidat($id);
			$size_loisirsannexe = sizeof($list_loisirsannexe);
			for($i=0;$i<$size_loisirsannexe;$i++){
				 $data_loisirsannexe = array();
				 $data_loisirsannexe['candidat_id'] =  $id;
				 $data_loisirsannexe['libele'] =  $list_loisirsannexe[$i];
				 $this->candidat_loisirsannexe->insert($data_loisirsannexe);
			}
			 
			if(isset($parcours_poste)){
				$this->candidat_parcours->delete_all_parcours_candidat($id);
				$size_parcours = sizeof($parcours_poste);
				for($i=0;$i<$size_parcours;$i++){
					$oDataParcours = array();
					$oDataParcours['candidat_id'] =  $id;
					$oDataParcours['date_debut'] = $this->date_fr_to_en($parcours_date_debut[$i],'/','-');
					$oDataParcours['date_fin'] = $this->date_fr_to_en($parcours_date_fin[$i],'/','-');
					$oDataParcours['par_poste'] = $parcours_poste[$i];
					$oDataParcours['par_departement'] =  $parcours_departement[$i];
					$this->candidat_parcours->insert($oDataParcours);
				}
			}
			
			if(isset($toStageName)){
				$this->candidat_stage->delete_all_stage_candidat($id);
				$size_stage = sizeof($toStageName);
				for($i=0;$i<$size_stage;$i++){
					$oDataStage = array();
					$oDataStage['candidat_id'] =  $id;
					$oDataStage['stage_name'] =  $toStageName[$i];
					$oDataStage['stage_etablissement'] =  $toStageEtablissement[$i];
					$oDataStage['stage_annee'] =  $toStageAnnee[$i];
					$oDataStage['stage_pays'] =  $toStagePays[$i];
					$this->candidat_stage->insert($oDataStage);
				}
			}
			
			//MAJ CV CA
			$this->candidat->update($oDataCandidat,$id);
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
			
			$zName = $id.'.'.strtolower($ext);

			@move_uploaded_file($photo['tmp_name'], PATH_ROOT_DIR . '/assets/upload/' . $zName);

			if($photo['name'] !=""){
				$oDataPhoto = array();
				$oDataPhoto["photo_nom"] = $zName;
				$oDataPhoto["photo_origine"] = $photo['name'];
				$oDataPhoto["photo_date"] = date("Y-m-d H:i:s") ;
				$oDataPhoto["photo_userId"] = $user_id;
				$this->candidat->insertCandidatPhoto($oDataPhoto);
			}

			/* Modif Îles aux trésors resizeimage */ 

			if(isset($ext) && ($ext != ''))
			{
				$this->resizePicture(PATH_ROOT_DIR. '/assets/upload/' . $zName, $zName , "300", "300");
			}

		}


		$user = get_current_user();
		
		if ($iTestModifLocalite == 1){
			redirect('cv2/mon_cv/3');
		} else {
			redirect('cv2/mon_cv/1');
		}
	}

	/** 
	* Sauvegarde photo
	*
	* @return view
	*/
	function savePhoto(){
			
			
			$iUserIdConnecte = $this->postGetValue ("iUserIdConnecte",0) ;
			$zPhone			 = $this->postGetValue ("zPhone",0) ;
			$zEmail			 = $this->postGetValue ("zEmail",0) ;
			$iRedirect		 = $this->postGetValue ("iRedirect",0) ;
			$oCandidat		 = $this->Gcap->get_candidat_object($iUserIdConnecte);

			if (sizeof($oCandidat)>0){
				$oPhoto = $_FILES['photo'];
				$file_name = $oPhoto['name'];

				$iId = $oCandidat[0]->id;

				$oDataAll = array();

				$oDataAll['phone'] = $zPhone;
				$oDataAll['email'] = $zEmail;

				$type = $oPhoto['type'];
				$ext = substr($type, 6);
				if($ext == 'jpeg'){
					$name = $oPhoto['name'];
					$len = strlen($name);
					$ext0 = substr($name,$len-4);
					if($ext0 != $ext){
						$ext = 'jpg';
					}
				}
				if(strlen($ext)>2){
					$oDataAll['type_photo'] = $ext;
				}

				$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $id . "." . $ext ; 
				$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $id . "." . strtoupper($ext) ; 

				if (file_exists($zImagePath)){
					@unlink($zImagePath);
				}

				if (file_exists($zImagePath1)){
					@unlink($zImagePath1);
				}
			
				/* $config_photo = array(
					'upload_path' 	=>  'assets/upload',
					'allowed_types' => '*',
					'file_name'		=>	$iId ,
					'overwrite'		=> 	true
				);
				
				$this->load->library('upload', $config_photo);
				$this->upload->initialize($config_photo);

				$this->upload->do_upload('photo');*/

				$zName = $id.'.'.strtolower($ext);

				@move_uploaded_file($photo['tmp_name'], PATH_ROOT_DIR . '/assets/upload/' . $zName);

				//print_r ($oDataAll);

				$this->candidat->update($oDataAll,$iId);

				if($oPhoto['name'] !=""){
					$oDataPhoto = array();
					$oDataPhoto["photo_nom"] = $zName;
					$oDataPhoto["photo_origine"] = $oPhoto['name'];
					$oDataPhoto["photo_date"] = date("Y-m-d H:i:s") ;
					$oDataPhoto["photo_userId"] = $iUserIdConnecte; 
					$oDataPhoto["photo_isAvisCredit"] = 1;
					$this->candidat->insertCandidatPhoto($oDataPhoto);
				}

				//die();
				if($iRedirect == 1){
					redirect('accueil/communique');
				} else {
					redirect('avis/fiche/titre-de-paiement');
				}
			}
	}

	/** 
	* Sauvegarde badge
	*
	* @return view
	*/
	function saveBadge(){
			
			
			$iUserIdConnecte = $this->postGetValue ("iUserIdConnecte",0) ;
			$zPhone			 = $this->postGetValue ("zPhone",0) ;
			$zEmail			 = $this->postGetValue ("zEmail",0) ;
			$iCin			 = $this->postGetValue ("iCin",0) ;
			$iRegionId		 = $this->postGetValue ("iRegionId",0) ;
			$iDistrictId	 = $this->postGetValue ("iDistrictId",0) ;
			$iBatiment		 = $this->postGetValue ("iBatiment",0) ;
			$zPorte			 = $this->postGetValue ("zPorte",0) ;
			$iRedirect		 = $this->postGetValue ("iRedirect",0) ;
			$oCandidat		 = $this->Gcap->get_candidat_object($iUserIdConnecte);

			if (sizeof($oCandidat)>0){
				
				$oDataDemande = array();

				if (isset($_FILES['photo']) && $_FILES['photo']['name']) {
					$oPhoto = $_FILES['photo'];
					$file_name = $oPhoto['name'];

					$iId = $oCandidat[0]->id;

					$oDataAll = array();

					$oDataAll['phone'] = $zPhone;
					$oDataAll['email'] = $zEmail;

					$type = $oPhoto['type'];
					$ext = substr($type, 6);
					if($ext == 'jpeg'){
						$name = $oPhoto['name'];
						$len = strlen($name);
						$ext0 = substr($name,$len-4);
						if($ext0 != $ext){
							$ext = 'jpg';
						}
					}
					if(strlen($ext)>2){
						$oDataAll['type_photo'] = $ext;
					}

					$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $id . "." . $ext ; 
					$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $id . "." . strtoupper($ext) ; 

					if (file_exists($zImagePath)){
						@unlink($zImagePath);
					}

					if (file_exists($zImagePath1)){
						@unlink($zImagePath1);
					}
				
					/*$config_photo = array(
						'upload_path' 	=>  'assets/badge',
						'allowed_types' => '*',
						'file_name'		=>	$iId ,
						'overwrite'		=> 	true
					);
					
					$this->load->library('upload', $config_photo);
					$this->upload->initialize($config_photo);

					$this->upload->do_upload('photo');*/

					$zName = $id.'.'.strtolower($ext);

					@move_uploaded_file($photo['tmp_name'], PATH_ROOT_DIR . '/assets/badge/' . $zName);

					$oDataDemande["demande_photo"]		= base_url()."assets/badge/".$zName;
					$oDataDemande["demande_nom"]		= $zName;

				} else {

					$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 

					$zPathWithPhoto = base_url() . "assets/evaluation/images/no_image_user.png";
					if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
						$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
					} 
					$oDataDemande["demande_photo"]		= $zPathWithPhoto;
					$oDataDemande["demande_nom"]		= $zPhoto;
				}
				
				$oDataDemande["demande_date"]		= date("Y-m-d H:i:s") ;
				$oDataDemande["demande_userId"]		= $iUserIdConnecte; 
				$oDataDemande["demande_region"]		= $iRegionId;
				$oDataDemande["demande_district"]	= $iDistrictId;
				$oDataDemande["demande_batiment"]	= $iBatiment;
				$oDataDemande["demande_porte"]		= $zPorte;
				$oDataDemande["demande_email"]		= $zEmail;
				$oDataDemande["demande_phone"]		= $zPhone;
				$this->candidat->insertDemandeBadgeAgent($oDataDemande);

				//die();
				redirect('accueil/communique');
				
			}
	}


	/** 
	* Sauvegarde badge
	*
	* @return view
	*/
	function saveConfirmationBadge(){
			
			
			$iUserIdConnecte = $this->postGetValue ("iUserIdConnecte",0) ;
			$zPhone			 = $this->postGetValue ("zPhone",0) ;
			$zEmail			 = $this->postGetValue ("zEmail",0) ;
			$iCin			 = $this->postGetValue ("iCin",0) ;
			$iDepartement	 = $this->postGetValue ("departement",0) ;
			$iRegionId		 = $this->postGetValue ("iRegionId",0) ;
			$iDistrictId	 = $this->postGetValue ("iDistrictId",0) ;
			$iBatiment		 = $this->postGetValue ("iBatiment",0) ;
			$zPorte			 = $this->postGetValue ("zPorte",0) ;
			$iRedirect		 = $this->postGetValue ("iRedirect",0) ;
			$oCandidat		 = $this->Gcap->get_candidat_object($iUserIdConnecte);

			if (sizeof($oCandidat)>0){
				
				$oDataDemande = array();

				if (isset($_FILES['photo']) && $_FILES['photo']['name']) {
					$oPhoto = $_FILES['photo'];
					$file_name = $oPhoto['name'];

					$iId = $oCandidat[0]->id;

					$oDataAll = array();

					$oDataAll['phone'] = $zPhone;
					$oDataAll['email'] = $zEmail;

					$type = $oPhoto['type'];
					$ext = substr($type, 6);
					if($ext == 'jpeg'){
						$name = $oPhoto['name'];
						$len = strlen($name);
						$ext0 = substr($name,$len-4);
						if($ext0 != $ext){
							$ext = 'jpg';
						}
					}
					if(strlen($ext)>2){
						$oDataAll['type_photo'] = $ext;
					}

					$zImagePath = PATH_ROOT_DIR . "/assets/badge/". $iId . "." . $ext ; 
					$zImagePath1 = PATH_ROOT_DIR . "/assets/badge/". $iId . "." . strtoupper($ext) ; 

					if (file_exists($zImagePath)){
						@unlink($zImagePath);
					}

					if (file_exists($zImagePath1)){
						@unlink($zImagePath1);
					}
				
					$zName = $iId.'.'.strtolower($ext);

					@move_uploaded_file($oPhoto['tmp_name'], PATH_ROOT_DIR . '/assets/badge/' . $zName);

					$oDataDemande["confirmationBadge_photo"]		= base_url()."assets/badge/".$zName;
					$oDataDemande["confirmationBadge_nom"]			= $zName;

				} else {

					$zPhoto = $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 
					$oPopUp = $this->Accueil->getPopNouveauBadge($oCandidat[0]->user_id,1);
					$iTestPhoto = "";
					$zPathWithPhoto = "";
					
					if(sizeof($oPopUp)>0){
						$zPathWithPhoto = $oPopUp[0]['demande_photo'];
						$iTestPhoto = 1;
					} else {

						$zPathWithPhoto = base_url() . "assets/evaluation/images/no_image_user.png";
						$iTestPhoto = "";
						if (file_exists(APPLICATION_PATH . "assets/upload/".$zPhoto)) {
							$zPathWithPhoto = base_url() . "assets/upload/".$zPhoto ; 
							$iTestPhoto = 1;
						} 
					}
					$oDataDemande["confirmationBadge_photo"]	= $zPathWithPhoto;
					$oDataDemande["confirmationBadge_nom"]		= $zPhoto;
				}
				
				$oDataDemande["confirmationBadge_date"]			= date("Y-m-d H:i:s") ;
				$oDataDemande["confirmationBadge_userId"]		= $iUserIdConnecte; 

				$zDirection = "";
				$zService = "";

				$toDirection = array();
				$toService = array();

				for ($i=sizeof($_POST['iRattachement'])-1;$i>=0;$i--){

					$zValue = $_POST['iRattachement'][$i];
					$toExplode = explode("_",$zValue);
					switch($toExplode[0]){

						case "DIR":
							array_push($toDirection,$toExplode[1]);
							break;

						case "SER":
							array_push($toService,$toExplode[1]);
							break;

					}
				}

				$zDirection = implode("-",$toDirection);
				$zService = implode("-",$toService);

				$oDataDemande["confirmationBadge_departement"]		= $iDepartement;
				$oDataDemande['confirmationBadge_direction']		= $zDirection;
				$oDataDemande['confirmationBadge_service']			= $zService;
	
				$this->candidat->insertConfirmationBadge($oDataDemande);

				//die();
				redirect('accueil/communique');
				
			}
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
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$oData = array();
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
		$oData['oUser']=$oUser;
		$oData['oCandidat']=$oCandidat;
		$oData['list_mvt'] = $array_data;
		$oData['menu']=68;
		$this->load_my_view_Common('cv/new/list_mvt.tpl',$oData,$iModuleId);
	}

	/** 
	* impression fiche evaluation
	*
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
	/* fin fiche evaluation*/
	
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