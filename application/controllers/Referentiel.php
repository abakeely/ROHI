<?php 
/**
* @package ROHI
* @subpackage Referentiel
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referentiel extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('departement_model','departement');
		$this->load->model('direction_model','direction');
		$this->load->model('service_model','service');
		$this->load->model('district_model','district');
		$this->load->model('division_model','division');

		$this->sessionStartCompte();
	}

	public function departement(){	
		$departement			= $this->postGetValue ("departement","") ;
		echo json_encode($this->departement->findAllDepartement($departement));
	}

	/*public function direction(){	
		$dep			= $this->postGetValue ("dep","") ;
		echo json_encode($this->direction->get_by_departement($dep,$dir));
	}

	public function service(){
		$dir			= $this->postGetValue ("dir","") ;
		echo json_encode($this->service->get_by_direction($dep,$dir,$serv));
	}
       
	public function division(){
		$dir			= $this->postGetValue ("dir","") ;
		echo json_encode($this->division->get_division_by_service_id($dep,$dir,$serv));
	}*/

	public function getSubCategory(){	
		$p_categoryTable				=	$this->postGetValue ('p_categoryTable') ;
		$p_categoryField				=	$this->postGetValue ('p_categoryField') ;
		$p_categoryValue				=	$this->postGetValue ('p_categoryValue') ;

		$tzConditions					=	array();
			array_push($tzConditions," ".$p_categoryField." LIKE '%".$p_categoryValue."%' ");
		$toResults						=	$this->GenericCruds->findBy("sgrh",$p_categoryTable,$tzConditions);
		echo json_encode($toResults);
	}

	public function ajaxDataTable(){	
		$oRequest			=	$_REQUEST;
		$iNombreTotal		=	0;
		$tzConditions		=	array();
		$_referentiel		=	$this->postGetValue ('type_refentiel') ;
		$zColum				=	$this->postGetValue ('zColum') ;
		$tzCriteria			=	$this->postGetValue ('search') ;
		$zCriteria			=	$tzCriteria["value"];

		$tzColumns			=	explode(",",$zColum);

		foreach($tzColumns as $zColumns){
			array_push($tzConditions," ".$zColumns." LIKE '%".$zCriteria."%' ");
		}
		$toListe				=	$this->GenericCruds->get_referentiel($_referentiel,$tzConditions,$iNombreTotal);
		$oDataAssign			=	array();
		foreach ($toListe as $oListe){
			$oDataTemp			=	array(); 
			foreach($tzColumns as $zColumns){
				$oDataTemp[]	=	 $oListe[$zColumns];
			}
			$oDataAssign[]		= $oDataTemp;
		}
		$toJson = array(
						"draw"            => intval( $oRequest['draw'] ),
						"recordsTotal"    => intval( $iNombreTotal ),
						"recordsFiltered" => intval( $iNombreTotal ),
						"data"            => $oDataAssign
					);
		echo json_encode($toJson);
	}
        
}
