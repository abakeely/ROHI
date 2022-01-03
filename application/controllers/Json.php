<?php 
/**
* @package ROHI
* @subpackage Json
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends MY_Controller {

		public function __construct()
		{
			parent::__construct();

			$this->load->model('departement_model','departement');
			$this->load->model('direction_model','direction');
			$this->load->model('service_model','service');
			$this->load->model('district_model','district');
			$this->load->model('division_model','division');

			$this->load->model('module_formation_model','module_formation');
			$this->load->model('GenericCruds_model','GenericCruds_model');

			// $this->load->model('motif_absence_model','motif_absence');
			// $this->load->model('type_autorisation_absence_model','type_autorisation_absence');
		}


	/** 
	* localité de service en AJAX
	*
	* @param integer $_iType type localité de servcice
	* @param integer $_iValue Identifiant de la table localité de service
	*
	* @return AJAX
	*/
	public function organisation($_iType, $_iValue) {

		global $oSmarty ; 

		$oUser = array();
		$toListe = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		$zLibelleType = "";
		$toService = array();
		$toDirection = array();
		$toSousService = array();
		$zSelectService = "";
		$zSelectDirection = "";

		$iTypeOrig = $_iType;

		if($iRet == 1){	
			switch($_iType){
				case 0:
					$zNomTable="departement" ; 
					$zName="departement" ; 
					$iIdName="departement" ;
					$iType = 0;
					break;

				case 1:
					$zNomTable="direction" ; 
					$zName="direction" ; 
					$iIdName="iDirectionId" ; 
					$iType = 1;
					$toService = $this->Gcap->get_Organisation($_iValue,"service", $_iType);
					
					break;

				case 2:
					$zNomTable="service" ; 
					$zName="service" ;
					$iIdName="iServiceId" ; 
					$iType = 2;
					$toDirection = $this->Gcap->get_Organisation($_iValue,"direction", 2);
					break;

				case 23:
					$zNomTable="service" ; 
					$zName="service" ;
					$iIdName="iServiceId" ; 
					$iType = 2;
					$_iType = 2;
					break;

				case 3:
					$zNomTable="module" ;
					$zName="division" ; 
					$iIdName="iDivisionId" ; 
					$iType = 3;
					$toSousService = $this->Gcap->get_Organisation($_iValue,"service", 3);

					/*echo "<pre>";
					print_r($toSousService);
					echo "</pre>";*/
					break;
			}

			$toListe = $this->Gcap->get_Organisation($_iValue,$zNomTable, $iType);
		}

		
		if (sizeof($toDirection)>0){
			$oSmartyDirection = $oSmarty;
			$oSmartyDirection->assign("toListe",$toListe);
			$oSmartyDirection->assign("toDirection",$toDirection);
			$oSmartyDirection->assign("zBasePath",base_url());
			$zSelectDirection = $oSmartyDirection->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_direction.tpl" );
		}

		if (sizeof($toSousService)>0){
			$oSmartySousService = $oSmarty;
			$oSmartySousService->assign("toSousService",$toSousService);
			$oSmartySousService->assign("zBasePath",base_url());
			$zSelectService = $oSmartySousService->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_service.tpl" );
		}

		$oSmarty->assign("toListe",$toListe);
		$oSmarty->assign("toService",$toService);
		$oSmarty->assign("toDirection",$toDirection);
		$oSmarty->assign("iType",$_iType);
		$oSmarty->assign("zName",$zName);
		$oSmarty->assign("iIdName",$iIdName);
		$oSmarty->assign("zBasePath",base_url());
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/portion_option2.tpl" );
	
		$toReturn = array();
		$toReturn['zHtmlNormal'] = $zSelect;
		$toReturn['iType'] = $_iType;
		$toReturn['iTypeOrig'] = $iTypeOrig;
		$toReturn['zHtmlDirection'] = $zSelectDirection;
		$toReturn['zHtmlService'] = $zSelectService;


		echo json_encode($toReturn); 
	}

	public function direction($dep,$district_id=false)
	{	
			if($district_id){
				echo json_encode($this->direction->get_direction_by_district_id($dep,$district_id));
			}else{
				echo json_encode($this->direction->get_by_departement($dep));
			}
	}

	public function service($dir,$district_id=false)
	{
			if($district_id){
				echo json_encode($this->service->get_service_by_district_id($dir,$district_id));
			}else{
				echo json_encode($this->service->get_by_direction($dir));
			}
	}
        
	
	public function province($pays_id=false){
			if($pays_id)
				echo json_encode($this->province->get_province_by_pays_id($pays_id));
	}
		
	public function region($province_id=false){
			if($province_id)
				echo json_encode($this->region->get_region_by_province_id($province_id));
	}
		
    public function district($region){
            echo json_encode($this->district->get_district_by_region_id($region));
    }
        
	public function division($service){
		echo json_encode($this->division->get_division_by_service_id($service));
	}
        
	public function soa($service){
		echo json_encode($this->service->get_soa_by_service_id($service));
	}
        
	public function region_province($district){
		echo json_encode($this->district->get_province_region_by_district($district));
	}
        
	public function get_motif_absence($type=false){
		$data = array();
		$list_motif = $this->motif_absence->get_by_type($type);
		$type *= 1;
		$type++;
		$type = $this->type_autorisation_absence->get_type_autorisation_absence($type);
		$data['list_motif'] = $list_motif;
		$data['type'] = $type;
		echo json_encode($data);
	}
        
	public function nom_supleant($im){
		//$im = $_GET['im'];
		//var_dump(trim($im,'/'));
		$user = $this->user->get_user_by_matricule($im);
		$data = array();
		if(empty($user)){
			$data['statut'] = 'ko';
			$data['msg'] = 'IM incorrect';
		}
		else{
			$data['statut'] = 'ok';
			$data['msg'] = ($user['sexe']==1?'Mr ':'Mme ').$user['nom'].' '.$user['prenom'];
		}
		echo json_encode($data);
	}
        
	public function departement_by_district($district_id=false){
		echo json_encode($this->departement->get_depart_by_district_id($district_id));
	}
        
	public function module_formation($id_theme){
		echo json_encode($this->module_formation->get_module_formation_by_theme($id_theme));
	}
        
	public function contenu_formation($id_module){
		echo json_encode($this->contenu_formation->get_contenu_by_module_id($id_module));
	}
	public function addDays(){
		$p_date_debut   =	$this->date_fr_to_en($_POST['p_date_debut'],"/","-") ;
		$p_days			=	$this->postGetValue ("p_days",0) ;
		$p_date_fin		=	$this->GenericCruds_model->addDays($p_date_debut,$p_days);
		echo $this->date_en_to_fr($p_date_fin["date_fin"],'-','/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */