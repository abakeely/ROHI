<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/

ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
class GestionStructure extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('User_model','UserService');
		$this->load->model('GestionStructure_model','GestionStructure');
		$this->load->model('Transaction_pointage_model','TransactionService');

		$this->load->model('situation_mat_model','situation_mat');
		$this->load->model('niveau_model','niveau');
		//$this->load->model('domaine_model','domaine');	
		$this->load->model('type_contrat_model','contrat');		
		$this->load->model('corps_model','corps');
		$this->load->model('grade_model','grade');
		$this->load->model('indice_model','indice');
		$this->load->model('departement_model','departement');
		$this->load->model('direction_model','direction');
		$this->load->model('service_model','service');
		$this->load->model('matricule_model','matricule');
		
		$this->load->model('region_model','region');
		$this->load->model('province_model','province');
		$this->load->model('district_model','district');
		$this->load->model('pays_model','pays');
		$this->load->model('division_model','division');
		
		$this->load->model('statut_model','statut');
		
		$this->load->model('candidat_diplome_model','candidat_diplome');
		$this->load->model('candidat_parcours_model','candidat_parcours');
		
		$this->load->model('user_historique_model','user_historique');
		$this->load->model('candidat_historique_model','candidat_historique');
		$this->load->model('Criteres_model','Critere');
		$this->load->model('Solde_model','Solde');
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
		$iModuleId						= 1;
		//print_r($oCandidat );die;
				//	print_r($oData);die;

		if($iRet == 1){	
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ;
			$oData['list_pays']			= $this->GestionStructure->getListPays();
			$iCompteActif 				= $this->getSessionCompte();
			if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
				$structure_respers			= $this->GestionStructure->getStructureRespers($oCandidat[0]->user_id)["structure_res_pers"];
			//	
				$departements				= $this->GestionStructure->getStructures($structure_respers);
			}else if( $iCompteActif == COMPTE_ADMIN ) {
				$departements				= $this->GestionStructure->getStructures(1);
			}
    		$oData['list_departement']	= $departements;
    		$oData['iSessionCompte']	= $iSessionCompte;
    		$oSmarty->assign('oData', $oData); 
    		$oSmarty->assign('zBasePath', base_url()); 
			$zTemplate					= $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/organigramme.tpl" );
			$oData['zTemplate']			= $zTemplate;
			$this->load_my_view_Common('gestionStructure/index.tpl',$oData, $iModuleId);	

		} else {
			redirect("cv/mon_cv");
		}
    }

	public function statistiques($_zType="par-departement"){
		
		$this->checkConnexion();
		global $oSmarty;


		$iCompteActif = $this->getSessionCompte();
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$user = get_current_user();
		$oData = array();
		global $oTree;
		$oTree = array();
		

		//if ($iCompteActif == COMPTE_ADMIN || $user["im"] == "278203" ){
		if (1==1){
			$tzDataColor = array("#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc","#d2d6de","#FFA07A","#3CB371","#9ACD32","#00BFFF","#778899");

			$oStatAbsisse = array();
			$oStatOrdonnee = array();
			$toJson = array();
			$iIncrement = 0;
			//print_r($_zType);die;
			switch($_zType){
					case "par-departement" :
						$resultat_base = $this->GestionStructure->get_stat_group_by_structure("departement",$service);
						$resultat_final = array();
					
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$res['grouper'] = $res['structure_libelle'];
								$res['libele'] = $res['structure_libelle'];
								$res['sigle'] = $res['structure_sigle'];
								array_push($oStatOrdonnee,$res["nb"]);
								array_push($oStatAbsisse,'"'.$res["sigle"].'"');
							}
							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['sigle'];

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}

						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['titreX'] = "departement";
						$oData['toJson'] = json_encode($toJson);
							//print_r($resultat_final);die;

						$oData['valueSelected'] = 1;
						break;
					
					case "par-direction" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by_structure("direction",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{

								$res['grouper'] = $res['structure_libelle'];
								$res['libele'] = $res['structure_libelle'];
								$res['sigle'] = $res['structure_sigle'];
								array_push($oStatOrdonnee,$res["nb"]);
								array_push($oStatAbsisse,'"'.$res["sigle"].'"');
							}
							
							if($iIncrement < 15){
								
								$oJson = new StdClass();
								$oJson->value = $res["nb"];
								$oJson->color = $tzDataColor[$iIncrement];
								$oJson->highlight = $tzDataColor[$iIncrement];
								$oJson->label = $res['sigle'];

								array_push($toJson, $oJson);
							}
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['titreX'] = "departement";
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "direction";
						$oData['valueSelected'] = 2;					
						break;
					}
					case "par-service" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by_structure("service",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								
								$res['grouper'] = $res['structure_libelle'];
								$res['libele'] = $res['structure_libelle'];
								$res['sigle'] = $res['structure_sigle'];
								array_push($oStatOrdonnee,$res["nb"]);
								array_push($oStatAbsisse,'"'.$res["sigle"].'"');
							}
							
							if($iIncrement < 20){
								$oJson = new StdClass();
								$oJson->value = $res["nb"];
								$oJson->color = $tzDataColor[$iIncrement];
								$oJson->highlight = $tzDataColor[$iIncrement];
								$oJson->label = $res['sigle'];

								array_push($toJson, $oJson);
							}
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "service";
						$oData['valueSelected'] = 3;										
						break;
					}
					case "par-region" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("region_id",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$region = $this->region->get_region($grouper);
								if($region!=null){
									$res['grouper'] = isset($region['legende'])?$region['legende']:$region['libele'];;
									$res['libele'] = $region['libele'];
									array_push($oStatOrdonnee,$res["nb"]);
									array_push($oStatAbsisse,'"'.$res["libele"].'"');
								}
							}

							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['libele'];

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "region";
						$oData['valueSelected'] = 4;
						break;
					}
					case "par-sexe" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("sexe",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								if($grouper == 1){
									$res['grouper'] = "homme";
									$res['libele'] = "homme";;
								}
								else{
									$res['grouper'] = "femme";
									$res['libele'] = "femme";
								}
							}

							array_push($oStatOrdonnee,$res["nb"]);
							array_push($oStatAbsisse,'"'.$res["libele"].'"');

							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['libele'];

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['titreX'] = "sexe";
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);									
						$oData['valueSelected'] = 5;
						break;
					}

					case "par-cadre" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("cadre",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							$res['libele'] = $res['grouper'] ;

							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['grouper'];

							array_push($oStatOrdonnee,$res["nb"]);
							array_push($oStatAbsisse,'"'.$res["grouper"].'"');

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "statut";
						$oData['valueSelected'] = 6;
						break;
					}


					case "par-statut" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("statut",$service);
						
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$statut = $this->statut->get_statut($grouper);
								if($statut!=null){
									$res['grouper'] = isset($statut['legende'])?$statut['legende']:$statut['libele'];
									$res['libele'] = $statut['libele'];

									array_push($oStatOrdonnee,$res["nb"]);
									array_push($oStatAbsisse,'"'.$res["libele"].'"');
									
								}
							}

							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['libele'];

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "statut";
						$oData['valueSelected'] = 6;
						break;
					}
					case "par-district" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("district_id",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$district = $this->district->get_district($grouper);
								if($district!=null){
									$res['grouper'] = isset($district['legende'])?$district['legende']:$district['libele'];
									$res['libele'] = $district['libele'];

									if($iIncrement < 15){
										array_push($oStatOrdonnee,$res["nb"]);
										array_push($oStatAbsisse,'"'.$res["libele"].'"');
									}
								}
							}

							if($iIncrement < 15){
								$oJson = new StdClass();
								$oJson->value = $res["nb"];
								$oJson->color = $tzDataColor[$iIncrement];
								$oJson->highlight = $tzDataColor[$iIncrement];
								$oJson->label = $res['libele'];

								array_push($toJson, $oJson);
							}
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "district";
						$oData['valueSelected'] = 7;
						break;
					}
					case "par-situation" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("sit_mat",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$sit_mat = $this->situation_mat->get_situation($grouper);
								if($sit_mat!=null){
									$res['grouper'] = isset($sit_mat['legende'])?$sit_mat['legende']:$sit_mat['libele'];
									$res['libele'] = $sit_mat['libele'];
									array_push($oStatOrdonnee,$res["nb"]);
									array_push($oStatAbsisse,'"'.$res["libele"].'"');
								}
							}

							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['libele'];

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "district";
						$oData['valueSelected'] = 8;
						break;
					}
					case "par-province" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("province_id",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$sit_mat = $this->province->get_province($grouper);
								if($sit_mat!=null){
									$res['grouper'] = isset($sit_mat['legende'])?$sit_mat['legende']:$sit_mat['libele'];
									$res['libele'] = $sit_mat['libele'];
									array_push($oStatOrdonnee,$res["nb"]);
									array_push($oStatAbsisse,'"'.$res["libele"].'"');
								}
							}

							$oJson = new StdClass();
							$oJson->value = $res["nb"];
							$oJson->color = $tzDataColor[$iIncrement];
							$oJson->highlight = $tzDataColor[$iIncrement];
							$oJson->label = $res['libele'];

							array_push($toJson, $oJson);
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "province";
						$oData['valueSelected'] = 9;
						break;
					}
					
					case "par-corps" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("corps",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$sit_mat = $this->corps->get_corps($grouper);
								if($sit_mat!=null){
									$res['grouper'] = isset($sit_mat['legende'])?$sit_mat['legende']:$sit_mat['libele'];
									$res['libele'] = $sit_mat['libele'];

									if($iIncrement < 15){
										array_push($oStatOrdonnee,$res["nb"]);
										array_push($oStatAbsisse,'"'.$sit_mat["id"].'"');
									}
								}
							}

							if($iIncrement < 15){
								$oJson = new StdClass();
								$oJson->value = $res["nb"];
								$oJson->color = $tzDataColor[$iIncrement];
								$oJson->highlight = $tzDataColor[$iIncrement];
								$oJson->label = $res['libele'];

								array_push($toJson, $oJson);
							}
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "corps";
						$oData['valueSelected'] = 10;
						break;
					}
					case "par-grade" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("grade",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$sit_mat = $this->grade->get_grade($grouper);
								if($sit_mat!=null){
									$res['grouper'] = isset($sit_mat['legende'])?$sit_mat['legende']:$sit_mat['libele'];
									$res['libele'] = $sit_mat['libele'];
									if($iIncrement < 15){
										array_push($oStatOrdonnee,$res["nb"]);
										array_push($oStatAbsisse,'"'.$res["libele"].'"');
									}
								}
							}

							if($iIncrement < 15){
								$oJson = new StdClass();
								$oJson->value = $res["nb"];
								$oJson->color = $tzDataColor[$iIncrement];
								$oJson->highlight = $tzDataColor[$iIncrement];
								$oJson->label = $res['libele'];

								array_push($toJson, $oJson);
							}
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "grade";
						$oData['valueSelected'] = 11;
						break;
					}
					
					case "par-indice" :{
						$resultat_base = $this->GestionStructure->get_stat_group_by("indice",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								$sit_mat = $this->indice->get_indice($grouper);
								if($sit_mat!=null){
									$res['grouper'] = isset($sit_mat['legende'])?$sit_mat['legende']:$sit_mat['libele'];
									$res['libele'] = $sit_mat['libele'];

									if($iIncrement < 15){
										array_push($oStatOrdonnee,$res["nb"]);
										array_push($oStatAbsisse,'"'.$res["libele"].'"');
									}
								}
							}

							if($iIncrement < 15){
								$oJson = new StdClass();
								$oJson->value = $res["nb"];
								$oJson->color = $tzDataColor[$iIncrement];
								$oJson->highlight = $tzDataColor[$iIncrement];
								$oJson->label = $res['libele'];

								array_push($toJson, $oJson);
							}
							array_push($resultat_final, $res);
							$iIncrement++;
						}
						$oData['max'] = $this->get_max_value($resultat_final);
						$oData['total'] = $this->get_get_total($resultat_final);
						$oData['data'] = $resultat_final;
						$oData['absisse'] = implode(",", $oStatAbsisse);
						$oData['ordonnee'] = implode(",", $oStatOrdonnee);
						$oData['toJson'] = json_encode($toJson);
						$oData['titreX'] = "indice";
						$oData['valueSelected'] = 12;
						break;
					}
					
					case "par-repartition" :{
						$resultat_final = array();
						$resultat_base  = $this->GestionStructure->repartition();
						$total			= 0;
						foreach($resultat_base as $res){
							$return = array();
							$res['ministere_payeur']				=	$this->GestionStructure->getNouveauMinistere($res['ministere_payeur']) ;
							$res['ministere_employeur']				=	$this->GestionStructure->getNouveauMinistere($res['ministere_employeur']) ;
							
							$return['ministere_payeur_code']		=	$res['ministere_payeur'] ;
							$return['ministere_employeur_code']		=	$res['ministere_employeur'] ;
							
							$return['ministere_payeur']				=	$this->GestionStructure->getMinistereLibelle($res['ministere_payeur']) ;
							$return['ministere_employeur']			=	$this->GestionStructure->getMinistereLibelle($res['ministere_employeur']) ;
							$return['effectif']						=	$res['effectif'] ;
							array_push($resultat_final, $return);
							$total									=	$total+$res['effectif'] ;
						}
						$oData['max'] 			= $this->get_max_value($resultat_final);
						$oData['total'] 		= $total;
						$oData['data'] 			= $resultat_final;
						$oData['valueSelected'] = 12;
						break;
					}
				}

				$oData['menu'] = 67;
				$oData['is_stat'] = '';
				$oData['oCandidat'] = $oCandidat;
				$oData['oUser'] = $oUser;
				$oData['oType'] = explode("-",$_zType);
				
				$oSmarty->assign('zBasePath', base_url()); 
				$oSmarty->assign('zType', $_zType);
				$oSmarty->assign('oData', $oData);
				if($_zType!="par-repartition"){
					$zTemplate = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/portion.tpl" );
				}else{
					$zTemplate = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/repartition.tpl" );
				}
				$oData['zTemplate'] = $zTemplate;
				$this->load_my_view_Common('gestionStructure/index.tpl',$oData,$iModuleId);
		} else {
			die("Vous n'avvez pas accès à cette page");
		}

    }
	public function rapprochement($_zType="par-departement"){
		
		$this->checkConnexion();
		global $oSmarty;


		$iCompteActif = $this->getSessionCompte();
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$user = get_current_user();
		$oData = array();
		global $oTree;
		$oTree = array();
		

		if ($iCompteActif == COMPTE_ADMIN){
				$oData['menu'] = 67;
				$oData['is_stat'] = '';
				$oData['oCandidat'] = $oCandidat;
				$oData['oUser'] = $oUser;
				$oData['oType'] = explode("-",$_zType);
				$oData['iUserId']			= $oUser['id'] ;
				$oData['list_pays']			= $this->GestionStructure->getListPays();
				$iCompteActif = $this->getSessionCompte();
				if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
					$departements				= $this->GestionStructure->getStructures($oCandidat[0]->structureId);

				}else if( $iCompteActif == COMPTE_ADMIN ) {
					$departements				= $this->GestionStructure->getStructures(204);
				}
				$oData['list_departement']	= $departements;
				$oData['iSessionCompte']	= $iSessionCompte;
				$oSmarty->assign('zBasePath', base_url()); 
				$oSmarty->assign('zType', $_zType);
				$oSmarty->assign('oData', $oData);
				$zTemplate = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/rapprochement.tpl" );
				$oData['zTemplate'] = $zTemplate;
				$this->load_my_view_Common('gestionStructure/index.tpl',$oData,$iModuleId);
		} else {
			die("Vous n'avvez pas accès à cette page");
		}

    }
	
	public function rapprochementEnMasse($_zType="par-departement"){
		
		$this->checkConnexion();
		global $oSmarty;


		$iCompteActif = $this->getSessionCompte();
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$user = get_current_user();
		$oData = array();
		global $oTree;
		$oTree = array();
		

		if ($iCompteActif == COMPTE_ADMIN){
				$oData['menu'] = 67;
				$oData['is_stat'] = '';
				$oData['oCandidat'] = $oCandidat;
				$oData['oUser'] = $oUser;
				$oData['oType'] = explode("-",$_zType);
				$oData['iUserId']			= $oUser['id'] ;
				$oData['list_pays']			= $this->GestionStructure->getListPays();
				$iCompteActif = $this->getSessionCompte();
				if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
					$departements				= $this->GestionStructure->getStructures($oCandidat[0]->structureId);

				}else if( $iCompteActif == COMPTE_ADMIN ) {
					$departements				= $this->GestionStructure->getStructures(204);
				}
				$oData['list_departement']	= $departements;
				$oData['iSessionCompte']	= $iSessionCompte;
				$oSmarty->assign('zBasePath', base_url()); 
				$oSmarty->assign('zType', $_zType);
				$oSmarty->assign('oData', $oData);
				$zTemplate = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/rapprochementEnMasse.tpl" );
				$oData['zTemplate'] = $zTemplate;
				$this->load_my_view_Common('gestionStructure/index.tpl',$oData,$iModuleId);
		} else {
			die("Vous n'avvez pas accès à cette page");
		}

    }
	public function evaluation($_zType="par-departement"){
		
		$this->checkConnexion();
		global $oSmarty;


		$iCompteActif = $this->getSessionCompte();
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$user = get_current_user();
		$oData = array();
		global $oTree;
		$oTree = array();
		

		if ($iCompteActif == COMPTE_ADMIN){
				$oData['menu'] = 67;
				$oData['is_stat'] = '';
				$oData['oCandidat'] = $oCandidat;
				$oData['oUser'] = $oUser;
				$oData['oType'] = explode("-",$_zType);
				$oData['iUserId']			= $oUser['id'] ;
				$oData['list_pays']			= $this->GestionStructure->getListPays();
				$iCompteActif = $this->getSessionCompte();
				$iTrimestreActif			= $this->Critere->getPeriode()["trimestre"];
			
    			$oData['iTrimestreActif']	= $iTrimestreActif;
				if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
					$departements				= $this->GestionStructure->getStructures($oCandidat[0]->structureId);

				}else if( $iCompteActif == COMPTE_ADMIN ) {
					$departements				= $this->GestionStructure->getStructures(204);
				}
				$oData['list_departement']	= $departements;
				$oData['iSessionCompte']	= $iSessionCompte;
				$oSmarty->assign('zBasePath', base_url()); 
				$oSmarty->assign('zType', $_zType);
				$oSmarty->assign('oData', $oData);
				$zTemplate = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/evaluation.tpl" );
				$oData['zTemplate'] = $zTemplate;
				$this->load_my_view_Common('gestionStructure/index.tpl',$oData,$iModuleId);
		} else {
			die("Vous n'avvez pas accès à cette page");
		}

    }

	public function createStructure($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser			= array();
		$oCandidat		= array();
		$iRet			= $this->check($oUser, $oCandidat);
		$iModuleId		= 1;
		if($iRet == 1){	
			$oStructure							=	array() ;
			
			$oStructure["child_id"]				=	"" ; 
			$oStructure["child_libelle"]		=	$this->postGetValue ("add_child_libelle","") ; 
			$oStructure["parent_id"]			=	$this->postGetValue ("parent_id","") ; 
			$oParent							=	$this->GestionStructure->getDetailStructure($oStructure["parent_id"]);
			$oStructure["parent_libelle"]		=	$oParent["child_libelle"] ;
			$oStructure["rang"]					=	$this->postGetValue ("add_rang","") ; 
			$oStructure["sigle"]				=	$this->postGetValue ("add_sigle","") ; 
			$oStructure["path"]					=	$oParent["path"] ."/".$this->postGetValue ("add_sigle","") ;  
			$oStructure["soa_code"]				=	$this->postGetValue ("add_soa_code","") ; 
			$oStructure["pays_id"]				=	$oParent["pays_id"] ;
			$oStructure["region_id"]			=	$oParent["region_id"] ;
			$oStructure["site_id"]				=	$oParent["site_id"] ;
			$oStructure["district_id"]			=	$oParent["district_id"] ;
			$oStructure["district_id"]			=	$oParent["district_id"] ;
			$oStructure["region_id"]			=	$oParent["region_id"] ;
			$this->GestionStructure->createStructure($oStructure);
			//redirect("GestionStructure/index");
		}
    }

	public function rapprochementUnitaire($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser			= array();
		$oCandidat		= array();
		$iRet			= $this->check($oUser, $oCandidat);
		$iModuleId		= 1;
		$type_operation	= $this->postGetValue ("rapprochement_unitaire_type_operation","") ; 
		if($iRet == 1 ){	
			$oStructure								=	array() ;
			$oStructure["child_id"]					=	$this->postGetValue ("child_rapprochement_unitaire","") ; 
			$oStructure["soa_code"]					=	$this->postGetValue ("rapprochement_unitaire_soa_code","") ; 
			$edit_statut_agent						=	$this->postGetValue ("rapprochement_unitaire_statut_agent","") ;
			if( $edit_statut_agent == "FONCTIONNAIRE" ){
				$matricule							=	$this->postGetValue ("rapprochement_unitaire_matricule","") ; 
				$oAgent								=	$this->user->get_userByIm($matricule);
			}else{
				$matricule							=	$this->postGetValue ("rapprochement_unitaire_cin","") ; 
				$oAgent								=	$this->user->get_user_by_cin($matricule);
			}	
			$edit_type_agent						=	$this->postGetValue ("rapprochement_unitaire_type_agent","") ;

			//echo $matricule;die;
			if( $edit_type_agent == "AUTORITE" ){
				$oStructure["autorite_id"]				=	$oAgent["id"]; 
				$this->GestionStructure->rapprochementUnitaire($oStructure);
			}
			if( $edit_type_agent == "RESPERS" ){
				$oStructure["respers_id"]				=	$oAgent["id"]; 
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
			if( $edit_type_agent == "EVALUATEUR" ){
				$oStructure["evaluateur_id"]			=	$oAgent["id"]; 
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
			if( $edit_type_agent == "PREMIER_RESPONSABLE" ){
				$oStructure["premier_responsable_id"]	=	$oAgent["id"]; 
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
			if( $edit_type_agent == "AGENT-AUTORITE" ){
				$oStructure["user_id"]		=	$oAgent["id"]; 
				$oStructure["autorite_id"]	=	$oAgent["id"];
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
					$this->GestionStructure->majStructureIdInCandidat($oStructure["child_id"],$edit_statut_agent,$oAgent["id"]);

				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
			if( $edit_type_agent == "AGENT-RESPERS" ){
				$oStructure["user_id"]		=	$oAgent["id"]; 
				$oStructure["respers_id"]	=	$oAgent["id"];
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
					$this->GestionStructure->majStructureIdInCandidat($oStructure["child_id"],$edit_statut_agent,$oAgent["id"]);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
				
			}
			if( $edit_type_agent == "AGENT-EVALUATEUR" ){
				$oStructure["user_id"]		=	$oAgent["id"]; 
				$oStructure["evaluateur_id"]=	$oAgent["id"];
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
					$this->GestionStructure->majStructureIdInCandidat($oStructure["child_id"],$edit_statut_agent,$oAgent["id"]);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
			if( $edit_type_agent == "AGENT-PREMIER_RESPONSABLE" ){
				$oStructure["user_id"]					=	$oAgent["id"]; 
				$oStructure["premier_responsable_id"]	=	$oAgent["id"];
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
					$this->GestionStructure->majStructureIdInCandidat($oStructure["child_id"],$edit_statut_agent,$oAgent["id"]);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
			if( $edit_type_agent == "AGENT" ){
				$oStructure["user_id"]					=	$oAgent["id"]; 
				if($type_operation =="AJOUTER"){
					$this->GestionStructure->rapprochementUnitaire($oStructure);
					$this->GestionStructure->majStructureIdInCandidat($oStructure["child_id"],$edit_statut_agent,$oAgent["id"]);
				}else{
					$this->GestionStructure->detachementUnitaire($oStructure);
				}
			}
		
			redirect("GestionStructure/index");
		}
    }

	public function updateStructure($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser			= array();
		$oCandidat		= array();
		$iRet			= $this->check($oUser, $oCandidat);
		$iModuleId		= 1;
		if($iRet == 1){	
			$oStructure							=	array() ;
			$oStructure["child_id"]				=	$this->postGetValue ("child_id_edit_structure","") ; 
			$oStructure["child_libelle"]		=	$this->postGetValue ("edit_child_libelle","") ; 
			$oStructure["rang"]					=	$this->postGetValue ("edit_rang","") ; 
			$oStructure["sigle"]				=	$this->postGetValue ("edit_sigle","") ; 
			$oStructure["path"]					=	$this->postGetValue ("edit_path","") ; 
			$oStructure["soa_code"]				=	$this->postGetValue ("edit_soa_code","") ; 
			$this->GestionStructure->updateStructure($oStructure);
			redirect("GestionStructure/index");
		}
    }
	
	public function outilRH($_zType="par-departement"){
		
		$this->checkConnexion();
		global $oSmarty;


		$iCompteActif = $this->getSessionCompte();
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		$user = get_current_user();
		$oData = array();
		global $oTree;
		$oTree = array();
		

		if ($iCompteActif == COMPTE_ADMIN){
				$oData['menu'] = 67;
				$oData['is_stat'] = '';
				$oData['oCandidat'] = $oCandidat;
				$oData['oUser'] = $oUser;
				$oData['oType'] = explode("-",$_zType);
				$oData['iUserId']			= $oUser['id'] ;
				$oData['list_pays']			= $this->GestionStructure->getListPays();
				$iCompteActif = $this->getSessionCompte();
				if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
					$departements				= $this->GestionStructure->getStructures($oCandidat[0]->structureId);

				}else if( $iCompteActif == COMPTE_ADMIN ) {
					$departements				= $this->GestionStructure->getStructures(204);
				}
				$oData['list_departement']	= $departements;
				$oData['iSessionCompte']	= $iSessionCompte;
				$oSmarty->assign('zBasePath', base_url()); 
				$oSmarty->assign('zType', $_zType);
				$oSmarty->assign('oData', $oData);
				$zTemplate = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "gestionStructure/outil_rh.tpl" );
				$oData['zTemplate'] = $zTemplate;
				$this->load_my_view_Common('gestionStructure/index.tpl',$oData,$iModuleId);
		} else {
			die("Vous n'avvez pas accès à cette page");
		}

    }

	public function saveRapprochement($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser			= array();
		$oCandidat		= array();
		$iRet			= $this->check($oUser, $oCandidat);
		$iModuleId		= 1;
			if($iRet == 1){	
				$oData = array();
				if (isset($_FILES['fichierExcel']) && trim($_FILES['fichierExcel']['name']) != "") {
					require(APPLICATION_PATH ."/Classes/PHPExcel.php");
					error_reporting(0);
					ini_set('display_errors', TRUE);
					ini_set('display_startup_errors', TRUE);
					date_default_timezone_set('Europe/London');
					define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
					$oPhpExcel		= new PHPExcel();
																	
					$zFichier		= $_FILES['fichierExcel']['tmp_name'];
					$toExtension	= explode(".",$_FILES['fichierExcel']['name']);
					if($toExtension[1]!="xlsx" && $toExtension[1]!="xls"){
						die("Veuiller entrer un fichier Excel");
					} else {
						$structure_id				=	$this->postGetValue ("structure_id","") ; 
						$zFileName = utf8_decode($_FILES["fichierExcel"]["name"]);
						$zFileName = str_replace(" ","_",$zFileName);
						$zFileName = strtr($zFileName, 
						'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
						@move_uploaded_file($zFichier, APPLICATION_PATH . $zFileName);
						$zFileInput				= APPLICATION_PATH .$zFileName;
						$iTypeFile				= PHPExcel_IOFactory::identify($zFileInput);
						$oReader				= PHPExcel_IOFactory::createReader($iTypeFile);
						$oPhpExcel				= $oReader->load($zFileInput);
						$oSheet					= $oPhpExcel->getSheet(0); 
						$iLongeurExcel			= $oSheet->getHighestRow(); 
						$iLongeurColonne		= $oSheet->getHighestColumn();

						for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
							$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,NULL,TRUE,FALSE);
							if ($iBoucle > 1) {
								$oLigne = $toBoucleData[0];
								if ($oLigne[0]!="" && $oLigne[1]!=""){
									if( $oLigne[0] == "FONCTIONNAIRE" ){
										$matricule							=	$oLigne[1] ; 
										$oAgent								=	$this->user->get_userByIm($matricule);
									}else{
										$matricule							=	$oLigne[1] ; 
										$oAgent								=	$this->user->get_user_by_cin_trim($matricule);
									}	

									$this->GestionStructure->majStructureIdInCandidat($structure_id,$oLigne[0],$oAgent["id"]);
								}
							}
						}
					}
					$oData['noError'] = true;
					redirect("GestionStructure/index");
				}
				
		}
    }
	
	public function saveRapprochementEnMasse($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser			= array();
		$oCandidat		= array();
		$iRet			= $this->check($oUser, $oCandidat);
		$iModuleId		= 1;
			if($iRet == 1){	
				$oData = array();
				if (isset($_FILES['fichierExcel']) && trim($_FILES['fichierExcel']['name']) != "") {
					require(APPLICATION_PATH ."/Classes/PHPExcel.php");
					error_reporting(0);
					ini_set('display_errors', TRUE);
					ini_set('display_startup_errors', TRUE);
					date_default_timezone_set('Europe/London');
					define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
					$oPhpExcel		= new PHPExcel();
																	
					$zFichier		= $_FILES['fichierExcel']['tmp_name'];
					$toExtension	= explode(".",$_FILES['fichierExcel']['name']);
					if($toExtension[1]!="xlsx" && $toExtension[1]!="xls"){
						die("Veuiller entrer un fichier Excel");
					} else {
						$structure_id				=	$this->postGetValue ("structure_id","") ; 
						$zFileName = utf8_decode($_FILES["fichierExcel"]["name"]);
						$zFileName = str_replace(" ","_",$zFileName);
						$zFileName = strtr($zFileName, 
						'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
						@move_uploaded_file($zFichier, APPLICATION_PATH . $zFileName);
						$zFileInput				= APPLICATION_PATH .$zFileName;
						$iTypeFile				= PHPExcel_IOFactory::identify($zFileInput);
						$oReader				= PHPExcel_IOFactory::createReader($iTypeFile);
						$oPhpExcel				= $oReader->load($zFileInput);
						$oSheet					= $oPhpExcel->getSheet(0); 
						$iLongeurExcel			= $oSheet->getHighestRow(); 
						$iLongeurColonne		= $oSheet->getHighestColumn();

						for ($iBoucle = 1; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
							$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,NULL,TRUE,FALSE);
							if ($iBoucle > 1) {
								$oLigne = $toBoucleData[0];
								//print_r($oLigne);die;
								if ($oLigne[0]!="" && $oLigne[1]!="" ){
									$this->GestionStructure->majStructureEnMasse($oLigne[0],$oLigne[1]);
								}
							}
						}
					}
					$oData['noError'] = true;
					redirect("GestionStructure/index");
				}
				
		}
    }


	public function renderMyStructure(){
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		
		
		if($iRet == 1){	
			$iCompteActif	=   $this->getSessionCompte();
			$child_id		=	$oCandidat[0]->structureId;
			$iCompteActif 				= $this->getSessionCompte();
			if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
				$structure_respers			= $this->GestionStructure->getStructureRespers($oUser["id"])["structure_res_pers"];
				//$iMyStructure	=	$this->GestionStructure->getMyStructure($structure_respers);
				//print_r($oMyStructure);die;
				$toStructures	=	$this->GestionStructure->renderMyStructure($structure_respers);
			}else if( $iCompteActif == COMPTE_ADMIN ) {
				$toStructures	=	$this->GestionStructure->renderMyStructure(1);
			}
			
			echo json_encode($toStructures);
		}
    }

	public function getStructures(){
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		//$toStructures		=	$this->GestionStructure->structures("1");
		$child_id			=	$this->postGetValue ("child_id","") ; 
		if($iRet == 1){	
			$iCompteActif	= $this->getSessionCompte();
			/*if( $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL ){
				$toStructures				=	$this->GestionStructure->getStructures($oCandidat[0]->structureId);
			}else if( $iCompteActif == COMPTE_ADMIN ) {
				$toStructures				=	$this->GestionStructure->getStructures("1");
			}*/
			$toStructures				=	$this->GestionStructure->getStructures($child_id);
			echo json_encode($toStructures);
		}
    }

	public function getAllDepartement(){
		$toChilds				=	$this->GestionStructure->getAllDepartement();
		echo json_encode($toChilds);
    }

	public function getParentByDistrictid(){
		$district_id			=	$this->postGetValue ("district_id","") ; 
		$tree_type				=	$this->postGetValue ("tree_type","") ;
		$toChilds				=	$this->GestionStructure->getParentByDistrictid($district_id,$tree_type);
		echo json_encode($toChilds);
    }
	
	public function getDepartementByDistrictid(){
		$district_id			=	$this->postGetValue ("district_id","") ; 
		$tree_type				=	$this->postGetValue ("tree_type","") ;
		$toChilds				=	$this->GestionStructure->getDepartementByDistrictid($district_id);
		echo json_encode($toChilds);
    }


	public function getChildByParent(){
		$parent_id				=	$this->postGetValue ("parent_id","") ; 
		$tree_type				=	$this->postGetValue ("tree_type","") ; 
		$district_id			=	$this->postGetValue ("district_id","") ; 
		$toChilds				=	$this->GestionStructure->getChildByParent($district_id,$parent_id,$tree_type);
		echo json_encode($toChilds);
    }
	
	public function getChild(){
		$parent_id				=	$this->postGetValue ("parent_id","") ; 
		$tree_type				=	$this->postGetValue ("tree_type","") ; 
		$district_id			=	$this->postGetValue ("district_id","") ; 
		$toChilds				=	$this->GestionStructure->getChild($district_id,$parent_id,$tree_type);
		echo json_encode($toChilds);
    }


	public function getLocalite(){
		$parent_id				=	$this->postGetValue ("parent_id","") ; 
		$type_localite			=	$this->postGetValue ("type_localite","") ; 
		$toChilds				=	$this->GestionStructure->getLocalite($parent_id,$type_localite);
		echo json_encode($toChilds);
    }

	public function getDetailStructure(){
		$child_id				=	$this->postGetValue ("child_id","") ; 
		$toChilds				=	$this->GestionStructure->getDetailStructure($child_id);
		echo json_encode($toChilds);
    }
	public function getDetailStructure1(){
		$child_id				=	$this->postGetValue ("child_id","") ; 
		$toChilds				=	$this->GestionStructure->getDetailStructure1($child_id);
		echo json_encode($toChilds);
    }

	public function getParent(){
		$child_id				=	$this->postGetValue ("child_id","") ; 
		$tree_type				=	$this->postGetValue ("tree_type","") ; 
		$toParents				=	$this->GestionStructure->getParent($child_id,$tree_type);
		echo json_encode($toParents);
    }
	

	public function ajaxGetAgent($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$params							=	array();
		
		$oUser							=	array();
		$oCandidat						=	array();
		$this->checkConnexion();
		$iRet							= $this->check($oUser, $oCandidat);
		$iSessionCompte					= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		if($iRet == 1){	
			$page						=	($this->postGetValue ("page","0")-1)*5;
			$rows						=	$this->postGetValue ("rows","1");
			$child_id					=	$this->postGetValue ("child_id","1");
			
			$filter						=	$this->postGetValue ("filters","");
			$filter						=	json_decode($filter);
			$filters					=	$filter->rules;
			$parameters					=	array() ;
			array_push( $parameters, " sanction IN('00','34','40') " ) ;
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}

			$rowCount					=	$this->GestionStructure->ajaxCountAgent($parameters,$child_id);
			$toListe					=	$this->GestionStructure->ajaxGetAgent($parameters,$page,$rows,$child_id);
			$toDataAssign				=	array();
			foreach ($toListe as $oListe){
				$oDataTemp							=	 array(); 
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['matricule']				=	 $oListe['matricule'];
				$oDataTemp['poste']					=	 $oListe['poste'];
				$oDataTemp['nom']					=	 $oListe['nom'];
				$oDataTemp['prenom']				=	 $oListe['prenom'];
				$oDataTemp['phone']					=	 $oListe['phone'];
				$oDataTemp['type_photo']			=	 $oListe['type_photo'];
				$toDataAssign[]						=	 $oDataTemp;
			}
			$iNombreTotal							=	 $rowCount["nb_records"];
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( ceil($iNombreTotal/5) ),
							"records"			=> intval( ceil($iNombreTotal/5) ),
							"rows"              => $toDataAssign
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function ajaxGetAgent1($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$params							=	array();
		
		$oUser							=	array();
		$oCandidat						=	array();
		$this->checkConnexion();
		$iRet							= $this->check($oUser, $oCandidat);
		$iSessionCompte					= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		if($iRet == 1){	
			$page						=	($this->postGetValue ("page","0")-1)*5;
			$rows						=	$this->postGetValue ("rows","1");
			$child_id					=	$this->postGetValue ("child_id","1");
			
			$filter						=	$this->postGetValue ("filters","");
			$filter						=	json_decode($filter);
			$filters					=	$filter->rules;
			$parameters					=	array() ;
			array_push( $parameters, " sanction IN('00','34','40') " ) ;
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}

			$rowCount					=	$this->GestionStructure->ajaxCountAgent1($parameters,$child_id);
			$toListe					=	$this->GestionStructure->ajaxGetAgent1($parameters,$page,$rows,$child_id);
			$toDataAssign				=	array();
			foreach ($toListe as $oListe){
				$oDataTemp							=	 array(); 
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['matricule']				=	 $oListe['matricule'];
				$oDataTemp['poste']					=	 $oListe['poste'];
				$oDataTemp['nom']					=	 $oListe['nom'];
				$oDataTemp['prenom']				=	 $oListe['prenom'];
				$oDataTemp['phone']					=	 $oListe['phone'];
				$oDataTemp['type_photo']			=	 $oListe['type_photo'];
				$oDataTemp['path']					=	 $oListe['path'];
				$toDataAssign[]						=	 $oDataTemp;
			}
			$iNombreTotal							=	 $rowCount["nb_records"];
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( ceil($iNombreTotal/5) ),
							"records"			=> intval( ceil($iNombreTotal/5) ),
							"rows"              => $toDataAssign
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	
	public function ajaxGetDetailAgent(){
		$user_id				=	$this->postGetValue ("parentRowID","") ; 
		$toParents				=	$this->GestionStructure->ajaxGetDetailAgent($user_id);
		echo json_encode($toParents);
    }

	public function majSituationAgent($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			$oData['iUserId']						= $oUser['id'] ;
			$oData['iSessionCompte']				= $iSessionCompte ; 
			$operation								= $this->postGetValue ("oper","") ; 
			$toInfoAgents							= array() ;
			$toInfoAgents['nom']					= $this->postGetValue ("nom","") ; 
			$toInfoAgents['prenom']					= $this->postGetValue ("prenom","") ; 
			$toInfoAgents['matricule']				= $this->postGetValue ("matricule","") ; 
			$toInfoAgents['poste']					= $this->postGetValue ("poste","") ; 
			$toInfoAgents['phone']					= $this->postGetValue ("phone","") ; 
			$toInfoAgents['user_id']				= $this->postGetValue ("user_id","") ; 
			$this->GestionStructure->majSituationAgent($toInfoAgents);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function manageDecisionConges($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			$oData['iUserId']						= $oUser['id'] ;
			$oData['iSessionCompte']				= $iSessionCompte ; 
			$operation								= $this->postGetValue ("oper","") ; 
			$toDecisions							= array() ;
			$toDecisions['decision_id']				= $this->postGetValue ("id","") ; 
			$toDecisions['decision_annee']			= $this->postGetValue ("decision_annee","") ; 
			$toDecisions['decision_numero']			= $this->postGetValue ("decision_numero","") ; 
			$toDecisions['decision_userId']			= $this->postGetValue ("decision_userId","") ; 
			if( $operation =="edit" ){
				$this->GestionStructure->manageDecisionConges($toDecisions,$operation);
			}
			if( $operation =="del" ){
				$this->GestionStructure->manageDecisionConges($toDecisions,$operation);
			}
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	public function manageDetailDeMesDecisions($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			$oData['iUserId']						= $oUser['id'] ;
			$oData['iSessionCompte']				= $iSessionCompte ; 
			$operation								= $this->postGetValue ("oper","") ; 
			$toDetailDecisions						= array() ;
			$toDetailDecisions['gcap_id']				= $this->postGetValue ("id","") ; 
			$toDetailDecisions['gcap_lieuJouissance']	= $this->postGetValue ("gcap_lieuJouissance","") ; 
			if( $operation =="edit" ){
				$this->GestionStructure->manageDetailDeMesDecisions($toDetailDecisions,$operation);
			}
			if( $operation =="del" ){
				$this->GestionStructure->manageDetailDeMesDecisions($toDetailDecisions,$operation);
			}
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function statistiqueByStructure($_zHashModule = FALSE, $_zHashUrl = FALSE){
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
		$iModuleId						= 1;
		if($iRet == 1){	
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ;
			$iCompteActif = $this->getSessionCompte();
			$toDatas					=	$this->GestionStructure->statistiqueByStructure();
			//print_r($toDatas);die;
    		$oData['list']	= $toDatas;
			$this->load_my_view_Common('gestionStructure/tableau.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function ajaxGetStructure($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$params							=	array();
		
		$oUser							=	array();
		$oCandidat						=	array();
		$this->checkConnexion();
		$iRet							= $this->check($oUser, $oCandidat);
		$iSessionCompte					= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		if($iRet == 1){	
			$page						=	($this->postGetValue ("page","0")-1)*5;
			$rows						=	$this->postGetValue ("rows","1");

			$filter						=	$this->postGetValue ("filters","");
			$filter						=	json_decode($filter);
			$filters					=	$filter->rules;
			$parameters					=	array() ;
			array_push($parameters," 1 = 1");
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}

			$toListe					=	$this->GestionStructure->ajaxGridGetStructure($parameters,$page,$rows,0);
			$toDataAssign				=	array();
			$iNombreTotal				=	0;
			foreach ($toListe as $oListe){
				//print_r($toListe);die;
				$oDataTemp							=	 array(); 
				$oDataTemp['child_id']				=	 $oListe['child_id'];
				$oDataTemp['child_libelle']			=	 $oListe['child_libelle'];
				$oDataTemp['sigle']					=	 $oListe['sigle'];
				$oDataTemp['rang']					=	 $oListe['rang'];
				$toDataAssign[]						=	 $oDataTemp;
				$iNombreTotal						=	 $iNombreTotal + 1; 
			}
			
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( $iNombreTotal ),
							"records"			=> intval( $iNombreTotal ),
							"rows"              => $toDataAssign
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function tropBe($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$this->TransactionService->tropBe();
    }

	public function mesDecisions(){
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$user_id						=	$this->postGetValue ("user_id","");
			$sql							=	" SELECT * 
			                                        FROM gcap.decision a 
													INNER JOIN rohi.candidat b 
													ON a.decision_userId = b.user_id 
													WHERE 1=1 " ;
			$tzConditions					=	array();
			array_push($tzConditions," decision_userId = '".$user_id."' ");
			$toResults						=	$this->GenericCruds->executeQuery($sql,$tzConditions);
			//print_r($toResults);die;
			echo json_encode($toResults);
		}
    }

	public function detailDeMesDecisions(){
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$sql					=	" SELECT * FROM gcap.gcap a  INNER JOIN gcap.fraction b ON a.gcap_id = b.fraction_congeId WHERE 1=1 " ;
			$tzConditions			=	array();
			$p_decision_id			=	$this->postGetValue ('decision_id') ;
			array_push($tzConditions," fraction_decisionId = '".$p_decision_id."' ");
			$toResults				=	$this->GenericCruds->executeQuery($sql,$tzConditions);
			echo json_encode($toResults);
		}
    }
	function get_max_value($oData){
		$max = 0;
		foreach($oData as $row){
			if($max<$row['nb'])
				$max = $row['nb'];
		}
		return $max;
	}
	
	function get_get_total($oData){
		$ret = 0;
		foreach($oData as $row){
			$ret += $row['nb'];
		}
		return $ret;
	}
	
	public function setExcelRapports ($_ministere_payeur=null,$_ministere_employeur=null) {
		require(APPLICATION_PATH ."/Classes/PHPExcel.php");
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		$objPHPExcel = new PHPExcel();
		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("RADO ABRAHAM DRHA")
									 ->setLastModifiedBy("RADO ABRAHAM DRHA")
									 ->setTitle("RAPPORT EXCEL")
									 ->setSubject("RAPPORT EXCEL")
									 ->setDescription("RAPPORT EXCEL")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("RAPPORT EXCEL");

		$default_style = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
			 
		);

		$tHead1 = array(						
						'Matricule'				=> 	'matricule',
						'Nom'					=> 	'nom', 
						'Prenoms'				=> 	'prenom',
						'Cin'					=> 	'cin',
						'Tel'					=> 	'phone',
						'Adresse'				=> 	'address',
						'Email'					=> 	'email', 
						'Localite'				=> 	'path'
					  );

		$toArrayCritere = array();
		$iRow = 2 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iCol, $iRow, utf8_encode($zValue));
			$iCol++;
		}

		for($col = 'A'; $col !== 'Z'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				  'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
				  )
			  )
		);


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$oSheet = $objPHPExcel->setActiveSheetIndex(0);
		$oSheet->setTitle("RAPPORT");

		setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

		$iRowDynamic 	=   3 ; 
		$toResults		=	$this->GestionStructure->getDetailRepartition($_ministere_payeur,$_ministere_employeur);
		foreach ($toResults as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['matricule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['cin']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe['phone']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['address']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['email']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe['path']);
			$iRowDynamic++;

		}

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=rapport_evaluation_".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}
	
	public function imprimerAgentDansStructure ($_child_id=null) {
		require(APPLICATION_PATH ."/Classes/PHPExcel.php");
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		$objPHPExcel = new PHPExcel();
		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("RADO ABRAHAM DRHA")
									 ->setLastModifiedBy("RADO ABRAHAM DRHA")
									 ->setTitle("RAPPORT EXCEL")
									 ->setSubject("RAPPORT EXCEL")
									 ->setDescription("RAPPORT EXCEL")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("RAPPORT EXCEL");

		$default_style = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
			 
		);

		$tHead1 = array(						
						'Matricule'				=> 	'matricule',
						'Nom'					=> 	'nom', 
						'Prenoms'				=> 	'prenom',
						'Cin'					=> 	'cin',
						'Tel'					=> 	'phone',
						'Adresse'				=> 	'address',
						'Email'					=> 	'email', 
						'Localite'				=> 	'path'
					  );

		$toArrayCritere = array();
		$iRow = 2 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iCol, $iRow, utf8_encode($zValue));
			$iCol++;
		}

		for($col = 'A'; $col !== 'Z'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				  'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
				  )
			  )
		);


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$oSheet = $objPHPExcel->setActiveSheetIndex(0);
		$oSheet->setTitle("LISTE DES AGENTS");

		setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

		$iRowDynamic 	=   3 ; 
		$toResults		=	$this->GestionStructure->ajaxGetAgent2($_child_id);
		foreach ($toResults as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['matricule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['cin']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe['phone']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['address']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['email']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe['path']);
			$iRowDynamic++;

		}

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=liste_des_agents".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}
	
	public function ajaxGetAgentPartantRetraite($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$params							=	array();
		
		$oUser							=	array();
		$oCandidat						=	array();
		$this->checkConnexion();
		$iRet							= $this->check($oUser, $oCandidat);
		$iSessionCompte					= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		if($iRet == 1){	

			$page						=	($this->postGetValue ("page","0")-1)*5;
			$rows						=	$this->postGetValue ("rows","1");

			$filter						=	$this->postGetValue ("filters","");
			$filter						=	json_decode($filter);
			$filters					=	$filter->rules;
			$parameters					=	array() ;
			array_push($parameters," floor((curdate()-date_naiss)/10000) >57 ");
			array_push($parameters," sanction in('00','34','40') ");
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}
			$rowCount					=	$this->GestionStructure->ajaxCountAgentPartantRetraite($parameters);
			$toListe					=	$this->GestionStructure->getAgentPartantRetraite($parameters,$page,$rows,0);
			$toDataAssign				=	array();
			foreach ($toListe as $oListe){
				///print_r($toListe);die;
				$oDataTemp							=	 array(); 
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['matricule']				=	 $oListe['matricule'];
				$oDataTemp['fonction_actuel']		=	 $oListe['fonction_actuel'];
				$oDataTemp['nom_prenom']			=	 $oListe['nom'] .'  '.$oListe['prenom'];
				$oDataTemp['path']					=	 $oListe['path'];
				$oDataTemp['date_naiss']			=	 $oListe['date_naiss'];
				$oDataTemp['corps']					=	 $oListe['corps'];
				$oDataTemp['cin']					=	 $oListe['cin'];
				$oDataTemp['age']					=	 $oListe['age'];
				$toDataAssign[]						=	 $oDataTemp;
			}
			$iNombreTotal							=	 $rowCount["nb_records"];
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( ceil($iNombreTotal/5) ),
							"records"			=> intval( ceil($iNombreTotal/5) ),
							"rows"              => $toDataAssign,
							"nb_records"		=> $iNombreTotal
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

}