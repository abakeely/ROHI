<?php
/**
* @package ROHI
* @subpackage gestionabscence
* @author Division Recherche et Développement Informatique
*/

ob_start();

class GestionAbscence extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		$this->load->model('GestionAbscence_model','GestionAbscence_model');
	}
	
	public function loadData(){
		$this->load->model('GestionAbscence_model','GestionAbscence_model');
		$result	=	$this->GestionAbscence_model->getInOutByMatricule();
		echo json_encode($result);
    }
	
}