<?php
/**
* @package ROHI
* @subpackage Statistique
* @author Division Recherche et Développement Informatique
*/

ob_start();
class Statistique extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
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
		
	}
    private function trait_ser($_oDir,$iIdDep){
		global $oTree;
		$oSer = array();
		$oDiv = array();
		foreach($_oDir as $resDir){
			$oSer[$resDir['id']] = $this->service->get_by_direction($resDir['id']);
		}
		
		foreach($oSer as $resSer){
			foreach($resSer as $res){
				if($this->division->get_division_by_service_id($res['id']))
				$oDiv[$res['id']] = $this->division->get_division_by_service_id($res['id']);
			}
		}
		$oTree[$iIdDep]['oSer'] = $oSer;
		$oTree[$iIdDep]['oDiv'] = $oDiv;
		
	}
	private function trait_tree_dir($_oTree,$iIdDep){
		global $oTree;
		$oTreeDir = array();
		foreach($_oTree as $resTree){
			$oTreeDir[$resTree['direction']] = $resTree['nbDir'];
			$this->trait_tree_ser($resTree,$iIdDep);
			$this->trait_tree_div($resTree,$iIdDep);
		}
		$oTree[$iIdDep]['oTreeDir'] = $oTreeDir;
	}
	private function trait_tree_ser($_oTree,$iIdDep){
		global $oTree;
		$res = array();
		$oSer = explode(',',$_oTree['oSer']);
		if(!empty($oSer)){
			foreach($oSer as $resTree){
				
				if(!$res[$resTree]) $res[$resTree] = 1;
				else $res[$resTree] = $res[$resTree] +1;
			}
		}
		if($oTree[$iIdDep]['oTreeSer']) $oTree[$iIdDep]['oTreeSer'] = $oTree[$iIdDep]['oTreeSer']+$res;
		else $oTree[$iIdDep]['oTreeSer'] = $res;
	}
	private function trait_tree_div($_oTree,$iIdDep){
		global $oTree;
		$res = array();
		$oDiv = explode(',',$_oTree['oDiv']);
		if(!empty($oDiv)){
			foreach($oDiv as $resTree){
				$iCompar = (int)$resTree;
				if($iCompar!=999999 && $iCompar > 0){
					if(!$res[$resTree]) $res[$resTree] = 1;
					else $res[$resTree] = $res[$resTree] +1;
				}
			}
		}
		if($oTree[$iIdDep]['oTreeDiv']) $oTree[$iIdDep]['oTreeDiv'] = $oTree[$iIdDep]['oTreeDiv']+$res;
		else $oTree[$iIdDep]['oTreeDiv'] = $res;
	}
	private function trait_tree_sex($oTree){
		$res = array();
		$oTreeDir = array();
		foreach($oTree as $resTree){
			$oTreeDir[$resTree['direction']]['id'] = $resTree['direction'];
			$oTreeDir[$resTree['direction']]['nbr'] = $resTree['nbDir'];
		}
	}

	public function statistic_tree(){
		global $oSmarty;
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iModuleId = 1;
		global $oTree;
		$oTree = array();
		$oDep = $this->departement->get_departement();
		foreach($oDep as $resDep){
			$oTreeDep = $this->candidat->get_stat_tree($resDep['id']);
			$oTree[$resDep['id']]['zLibele'] = $resDep['libele'];
			$oTree[$resDep['id']]['oDir'] = $this->direction->get_by_departement($resDep['id']);
			$oTree[$resDep['id']]['iNbr'] = $oTreeDep[0]['nbDep'];
			if($oTreeDep){
				$this->trait_tree_dir($oTreeDep,$resDep['id']);
			}
			$this->trait_ser($oTree[$resDep['id']]['oDir'],$resDep['id']);
			
		}
		
		/*$iCond = 0;
		
		foreach($oTreeDep as $resTree){
			$zLibeleDep = $this->departement->get_departement($resTree['departement']);
			$oTree[$iCond]['zLibele'] = $departement = $zLibeleDep['libele'];
			$oTree[$iCond]['iNbr'] = $resTree['nb'];
			$oDirTree = $this->candidat->get_stat_tree('direction',$resTree['departement'],'departement');
			$oDir= array();
			$iCondDir = 0;
			foreach($oDirTree as $resDir){
				$zLibeleDir = $this->direction->get_direction($resDir['direction']);
				$oDir[$iCondDir]['zLibele'] = $zLibeleDir['libele'];
				$oDir[$iCondDir]['iNbr'] = $resDir['nb'];
				$oSer = array();
				$iCondSer = 0;
				$oSerTree = $this->candidat->get_stat_tree('service',$resDir['direction'],'direction');
				foreach($oSerTree as $resSer){
					$zLibeleSer = $this->service->get_service($resSer['service']);
					$oSer[$iCondSer]['zLibele'] = $zLibeleSer['libele'];
					$oSer[$iCondSer]['iNbr'] = $resSer['nb'];
					$oDiv = array();
					$iCondDiv = 0;
					$oDivTree = $this->candidat->get_stat_tree('division',$resSer['service'],'service');

					foreach($oDivTree as $resDiv){
						$zLibeleDiv = $this->division->get_division($resDiv['division']);
						if(!empty($zLibeleDiv)){
							$oDiv[$iCondDiv]['zLibele'] = $zLibeleSer['libele'];
						}else $oDiv[$iCondDiv]['zLibele'] = $zLibeleDiv['libele'];
						
						$oDiv[$iCondDiv]['iNbr'] = $resDiv['nb'];
						$oSexe = array();
						$iCondSexe = 0;
						$oSexeTree = $this->candidat->get_stat_tree('sexe',$resDiv['division'],'division');
						foreach($oSexeTree as $resSexe){
							if($resSexe['sexe'] == 1){
								$oSexe[$iCondSexe]['zLibele'] = "Homme";
								$oSexe[$iCondSexe]['iNbr'] = $resSexe['nb'];
							}else{
								$oSexe[$iCondSexe]['zLibele'] = "Femme";
								$oSexe[$iCondSexe]['iNbr'] = $resSexe['nb'];
							}
							$iCondeSexe++;
						}
						$oDiv[$iCondDiv]['oSexe'] = $oSexe;
						$iCondDiv++;
					}
					$oSer[$iCondSer]['oDivision'] = $oDiv;
					$iCondSer++;
				}
				$oDir[$iCondDir]['oService'] = $oSer; 
				$iCondDir++;
			}
			$oTree[$iCond]['oDirection'] = $oDir;
			$iCond++;
		}*/
		echo'<pre>';
		print_r($oTree);
		echo'</pre>';
	}
    public function statistic_main($_zType="par-departement"){
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
		/*$oDep = $this->departement->get_departement();
		foreach($oDep as $resDep){
			$oTreeDep = $this->candidat->get_stat_tree($resDep['id']);
			$oTree[$resDep['id']]['zLibele'] = $resDep['libele'];
			$oTree[$resDep['id']]['oDir'] = $this->direction->get_by_departement($resDep['id']);
			$oTree[$resDep['id']]['iNbr'] = $oTreeDep[0]['nbDep'];
			if($oTreeDep){
				$this->trait_tree_dir($oTreeDep,$resDep['id']);
			}
			$this->trait_ser($oTree[$resDep['id']]['oDir'],$resDep['id']);
		}
		*/

		if ($iCompteActif == COMPTE_ADMIN)
		{

			$tzDataColor = array("#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc","#d2d6de","#FFA07A","#3CB371","#9ACD32","#00BFFF","#778899");

			$oStatAbsisse = array();
			$oStatOrdonnee = array();
			$toJson = array();
			$iIncrement = 0;

			switch($_zType){
					case "par-departement" :
						$resultat_base = $this->candidat->get_stat_group_by_structure("departement",$service);
						$resultat_final = array();
						
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								/*$departement = $this->departement->get_departement($grouper);
								if($departement!=null){
									$res['grouper'] = isset($departement['legende'])?$departement['legende']:$departement['libele'];
									$res['libele'] = $departement['libele'];
									$res['sigle'] = $departement['sigle_departement'];
									array_push($oStatOrdonnee,$res["nb"]);
									array_push($oStatAbsisse,'"'.$res["sigle"].'"');
								}*/
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
						$oData['valueSelected'] = 1;

						break;
					
					case "par-direction" :{
						$resultat_base = $this->candidat->get_stat_group_by_structure("direction",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								/*$direction = $this->direction->get_direction($grouper);
								if($direction!=null){
									$res['grouper'] = isset($direction['legende'])?$direction['legende']:$direction['libele'];
									$res['libele'] = $direction['libele'];
									$res['sigle'] = $direction['sigle_direction'];

									if($iIncrement < 7){
										array_push($oStatOrdonnee,$res["nb"]);
										array_push($oStatAbsisse,'"'.$res["sigle"].'"');
									}
								}*/
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
						$resultat_base = $this->candidat->get_stat_group_by_structure("service",$service);
						$resultat_final = array();
						foreach($resultat_base as $res){
							$grouper = $res['grouper'] ;
							if($grouper==null)
								$res['grouper'] = "VIDE";
							else{
								/*$service = $this->service->get_service($grouper);
								if($service!=null){
									$res['grouper'] = isset($service['legende'])?$service['legende']:$service['libele'];
									$res['libele'] = $service['libele'];
									$res['sigle']  = $service['sigle_service'];

									if($iIncrement < 7){
										array_push($oStatOrdonnee,$res["nb"]);
										array_push($oStatAbsisse,'"'.$res["sigle"].'"');
									}
								}*/
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
						$resultat_base = $this->candidat->get_stat_group_by("region_id",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("sexe",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("cadre",$service);
						$resultat_final = array();

						/*echo "<pre>";
						print_r($resultat_base);
						echo "</pre>";*/
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
						$resultat_base = $this->candidat->get_stat_group_by("statut",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("district_id",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("sit_mat",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("province_id",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("corps",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("grade",$service);
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
						$resultat_base = $this->candidat->get_stat_group_by("indice",$service);
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
				}

				$oData['menu'] = 67;
				$oData['is_stat'] = '';
				$oData['oCandidat'] = $oCandidat;
				$oData['oUser'] = $oUser;
				$oData['oType'] = explode("-",$_zType);
				
				//$this->load->view('statistique/main',$oData);
				//$oSmarty->assign('oTreeStat',$oTree);
				$oSmarty->assign('zBasePath', base_url()); 
				$oSmarty->assign('zType', $_zType);
				$oSmarty->assign('oData', $oData);
				$zStatistique = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "statistique/portion.tpl" );
				$oData['zStatistique'] = $zStatistique;
				$this->load_my_view_Common('statistique/main.tpl',$oData,$iModuleId);
		} else {
			die("Vous n'avvez pas accès à cette page");
		}

		
	}
	
	public function getMF(){
		global $oSmarty;
		$iType = $this->postGetValue ("type",0) ;
		$iId = $this->postGetValue ("id",0) ;
		$oSexe = array();
		if($iType){
			switch($iType){
				case 1: {
					$oSexe = $this->candidat->get_stat_sexe($iId,'service');
					break;
				}
				case 2 : {
					$oSexe = $this->candidat->get_stat_sexe($iId,'division');
					break;
				}
			}
		}
		$oSmarty->assign('oSexe',$oSexe);
		$oRes = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "statistique/sexe.tpl" );
		echo $oRes;
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
	
	
	
}