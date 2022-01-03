<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Champs_model extends MY_Model 
{

	const FONCTION_D_APPARTENANCE		=1;
	const FAMILLE_PROFESSIONNELLE 		=2;
	const SOUS_FAMILLE_PROFESSIONNELLE	=3;
	const EMPLOI						=4;
	const POSTE 						=5;
	const ACTIVITES 					=6;
	const TACHES 						=7;
	const POSTE_DE_TRAVAIL 				=8;
	const FORMATION_DIPLOMANTE 			=9;
	const FORMATION_COURTE_DUREE 		=10;
	const SAVOIR 						=11;
	const SAVOIR_FAIRE 					=12;
	const SAVOIR_ETRE 					=13;
	const BESOINS 						=14;
	const TYPE_FORMATION 				=15;
	const INSTITUT 						=16;
	const INTITULE 						=17;
	const LIEU 							=18;
	const DATE_FORMATION 				=19;
	
	public $table='champs';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}
	public function get_list_champ($_iRubrique_id)
	{
		return $this->read(array("champs_rubriqueId"=>$_iRubrique_id,"champs_actif"=>"oui"));
	}

	public function is_champ_required($_iChamps_id){
		return $this->count(array("champs_id"=>$_iChamps_id,"champs_obligatoire"=>"oui"));
	}
}