<?php 
/**
* @package ROHI
* @subpackage Tableau de bord
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Tableau_bord extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->active_connect_to_sad();
		$this->load->model('pret_livre_model','pret_livre');
		$this->load->model('livre_model','livre');
		$this->load->model('pret_livre_model','pret_livre');
		$this->load->model('responsable_biblio_model','resp_biblio');
		$this->load->model('consultation_sur_place_model','consultation');
		$this->load->model('connexion_internet_model','connexion_net');
		$this->load->model('sad_bilan_2017_model','sad_bilan_2017');
	
		$this->load->model('sad_connected_model','user_sad_connected');
		$this->load->model('theme_livre_model','theme_livre');
		$this->load->model('auteur_livre_model','auteur_livre');
		$this->load->model('lieu_livre_model','lieu_livre');
		$this->load->model('langue_livre_model','langue_livre');
		$this->load->model('livre_model','livre');
		
		$this->sessionStartCompte();
	}
	
	 
	public function tableau($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		//$this->checkConnexion();
		$oUser = array();
		$oCandidat = array();

		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
				if ($iCompteActif == COMPTE_SAD)
				{
					$oData['oUser'] = $oUser;
					$oData['oCandidat'] = $oCandidat;
					$oData['zHashUrl'] = $_zHashUrl ; 
					$oData['zHashModule'] = $_zHashModule ;
					$oData['menu'] = 166;
					$iModuleId = 13;

					if($iRet == 1){	

						$oData['iUserId']		= $user['id'] ;
						$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
						$oData['zTitle'] = "Tableau de Bord" ; 
						
						$this->load_my_view_Common('documentation/tableau_bord/tableau.tpl',$oData, $iModuleId);	

					} else {
						die();
					}

				} else {
					redirect("cv2/mon_cv");
				}
					}	
	}

	public function consultation_surplace($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		//$this->checkConnexion();
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 167;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/consultation_surplace.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function conexion_cybernet($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 170;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/conexion_cybernet.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function couv_connect_sad($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 170;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/couv_connect_sad.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function couv_bilan($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 170;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/couv_bilan.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function couv_service($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 179;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Service Proposé" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/couv_service.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	/* ....................................*/
		

	public function consult_place($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 168;
			$iModuleId = 13;
			
			$oData['list_province'] = $this->province->get_province();
			$oData['list_departement'] = $this->departement->get_departement();
			$oData['list_respo'] = $this->resp_biblio->get_all_responsable();
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/form_consult_place.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function ajout_lecture($_zHashModule = FALSE, $_zHashUrl = FALSE,$_iCategorieId=0) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 168;
			$iModuleId = 13;
			
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
					
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/list_lecture_sur_place.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function list_lecture_sur_place($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$list_consultation = $this->consultation->get_all_consultation_affiche();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 169;
			$iModuleId = 13;
			
			$oData['list_consultation'] = $list_consultation;
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/list_consultation.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function connexion_internet($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 171;
			$iModuleId = 13;
			
			$oData['list_province'] = $this->province->get_province();
			$oData['list_departement'] = $this->departement->get_departement();
			$oData['list_respo'] = $this->resp_biblio->get_all_responsable();
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/form_connexion.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function ajout_connexion_internet($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 171;
			$iModuleId = 13;
			
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
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$this->connexion_net->insert($data_lecture);
				$this->load_my_view_Common('documentation/tableau_bord/list_connexion_net.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}	
	
	public function list_connexion_net($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$list_consultation = $this->connexion_net->get_all_connexion_internet_affiche();
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 172;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Tableau de Bord" ; 
				
				$oData['list_consultation'] = $list_consultation;
				$this->load_my_view_Common('documentation/tableau_bord/list_connexion_net.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
		
	public function list_user_sad($dateStart=false,$dataEnd=false,$_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		
		//$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
				if($dateStart==false){
					$list = $this->sad_connected->get_all_user_sad_now();
				}
				else{
					$list = $this->sad_connected->get_all_user_sad_intervalle(date($dateStart),date($dataEnd));
				}
				
			$oData = array();
			$oData['list_user'] = $list;
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 174;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Bilan" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/user_sad.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function bilan($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 172;
			$iModuleId = 13;
			
			$data_stat_pret = array();
			$data_stat_consul_place = array();
			$data_stat_consul_net = array();
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Bilan" ; 
				
				$data['data_stat_pret'] = $data_stat_pret;
				$data['data_stat_consul_net'] = $data_stat_consul_net;
				$data['data_stat_consul_place'] = $data_stat_consul_place;
				
				$data['tot_pret'] = $this->somme($data_stat_pret);
				$data['tot_net'] = $this->somme($data_stat_consul_net);
				$data['tot_place'] = $this->somme($data_stat_consul_place);
				$this->load_my_view_Common('documentation/tableau_bord/bilan.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	
	public function show_bilan($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			
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
		
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 172;
			$iModuleId = 13;
			
			$data['data_stat_pret'] = $data_stat_pret;
			$data['data_stat_consul_net'] = $data_stat_consul_net;
			$data['data_stat_consul_place'] = $data_stat_consul_place;
			
			$data['tot_pret'] = $this->somme($data_stat_pret);
			$data['tot_net'] = $this->somme($data_stat_consul_net);
			$data['tot_place'] = $this->somme($data_stat_consul_place);
			$data['show_bilan'] = true;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Bilan" ; 
				
				$this->load_my_view_Common('documentation/tableau_bord/bilan.tpl',$oData, $iModuleId);	
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function somme($list,$_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 172;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "Bilan" ; 
				
				$ret = 0;
					foreach($list as $row){
						$ret += $row['nb'];
					}
					return $ret;
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function liste_pret($_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			
			$user = $this->get_current_user();
			$list_pret_livre = $this->pret_livre->get_all_pret_livre();
			$list_pret_livre = $this->complete_pret_list($list_pret_livre);
		
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 180;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "LISTES PRETS LIVRES" ; 
				
			$data['list_pret'] = $list_pret_livre;
			$this->load_my_view_Common('documentation/tableau_bord/liste_pret.tpl',$oData, $iModuleId);
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	
	public function complete_pret_list($list,$_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
			
			$ret = array();
				foreach($list as $pret){
					$livre = $this->livre->get_livre($pret->livre_id);
					$livre = $this->complete_livre($livre);
					$pret->livre = $livre;
					$pret->candidat = current($this->candidat->get_by_user_id($pret->user_id));;
					array_push($ret, $pret);
				}
		
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 180;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "LISTES PRETS LIVRES" ; 
				
			return $ret;
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
	
	public function complete_livre($livre,$_zHashModule = FALSE, $_zHashUrl = FALSE) {
		global $oSmarty ;
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
		
			if ($iCompteActif == COMPTE_SAD)
			{
				if($livre->theme_livre_id)
				$livre->theme_livre = $this->theme_livre->get_theme_livre($livre->theme_livre_id);
			
				if($livre->auteur_livre_id)
					$livre->auteur_livre = $this->auteur_livre->get_auteur_livre($livre->auteur_livre_id);
				
				if($livre->lieu_livre_id)
					$livre->lieu_livre = $this->lieu_livre->get_lieu_livre($livre->lieu_livre_id);
				
				if($livre->langue_livre_id)
				$livre->langue_livre = $this->langue_livre->get_langue_livre($livre->langue_livre_id);
			
			$oData = array();
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['menu'] = 180;
			$iModuleId = 13;
			
			if($iRet == 1){	

				$oData['iUserId']		= $user['id'] ;
				$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
				$oData['zTitle'] = "LISTES PRETS LIVRES" ; 
				
			return $livre;
			
			} else {
				die();
			}
		
		} else {
			redirect("cv2/mon_cv");
		}
					}	
	}
		
	private function complete_list_langue($list_langue,$_zHashModule = FALSE, $_zHashUrl = FALSE){
		$ret = array();
		foreach($list_langue as $langue){
			$lang = $this->langue_livre->get_langue_livre($langue->langue_livre_id);
			array_push($ret, $lang);
		}
		return $ret;
	}
	
	private function complete_list_lieu($list_lieu){
		$ret = array();
		foreach($list_lieu as $lieu){
			$lang = $this->lieu_livre->get_lieu_livre($lieu->lieu_livre_id);
			array_push($ret, $lang);
		}
		return $ret;
	}
	
	private function complete_auteur($list_auteur,$_zHashModule = FALSE, $_zHashUrl = FALSE){
		$ret = array();
		foreach($list_auteur as $auteur){
			$au = $this->auteur_livre->get_auteur_livre($auteur->auteur_livre_id);
			array_push($ret, $au);
		}
		return $ret;
	}
		
	private function checkMyPretList($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$user = $this->get_current_user();
		$list_pret_livre = $this->pret_livre->get_pret_valide_by_user_id($user['id']);
		$this->notification->clearNotificationNow($user['id']);
		foreach($list_pret_livre as $pret){
			$livre = $this->livre->get_livre($pret->livre_id);
			$diff = $this->dateDiff(date('Y-m-d H:i:s'),$pret->date_retour);
			if($diff<=2){
				 if($diff>0){
					$msg = "Il vous reste $diff jours pour rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"reste quelques jours");
				}
				else if($diff>=0 && $diff<1){
					$msg = "Il est temps de rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"Rendre livre");
				}
				else{
					$msg = "Vous etes en retard pour rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"retard de retour");
				}
			}
		}
	}
	
	private function dateDiff($date1, $date2,$_zHashModule = FALSE, $_zHashUrl = FALSE){
		$s = strtotime($date2)-strtotime($date1);
		$d = intval($s/86400)+1;
	 
		return $d;
	}
	
	public function verifier_livre($cote){
		$data = array();
		
		$livre = $this->livre->get_livre_by_cote($cote);
		
		if($livre){
			$livre =  $this->complete_livre($livre);
			$data['livre'] = $livre;
			$data['statut'] = "ok";
		}
		else{
			$data['statut'] = "ko";
		}
		echo json_encode($data);
	}
	
	
	/* elo tableau_bord/bilan */


/*	public function form_bilan_2018($_zHashModule = FALSE, $_zHashUrl = FALSE){
		global $oSmarty ;
		$oUser = array();
		$oCandidat = array();
		
			$this->checkConnexion();
			$iRet = $this->check($oUser, $oCandidat);
			$iCompteActif = $this->getSessionCompte();
			$iCompteActif = $this->getSessionCompte();
			
			
			$data['sListeAgentBcpLivre']= $this->sad_bilan_2018_model->get_liste_agent_empreinte_bcp_livre();
			$data['sListeDepartement']= $this->sad_bilan_2018_model->get_liste_departement();
			$data['sListeDirection']= $this->sad_bilan_2018_model->get_liste_direction();
			$data['sListeService']= $this->sad_bilan_2018_model->get_liste_service();
			$data['sListeAgentUnLivre']= $this->sad_bilan_2018_model->get_liste_agent_empreinte_une_livre();
			$data['sListeLivreEmpreinte'] = $this->sad_bilan_2018_model->get_liste_plus_empreinte();
			
			
			
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;
		$oData['menu'] = 104;
		$iModuleId = 13;
		
		if($iRet == 1){	
			
			$oData['iUserId']		    = $user['id'] ;
			$oData['zCategorieLibelle'] = $zCategorieLibelle ; 
			$oData['zTitle'] = "Bilan 2018" ; 
			$this->load_my_view_Common('documentation/form_bilan_2018.tpl',$oData, $iModuleId);
		
		} else {
				redirect("cv/mon_cv");
		}
		
		}
	
	} */
	
}	

	