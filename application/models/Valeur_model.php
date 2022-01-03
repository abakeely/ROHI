<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valeur_model extends MY_Model {



	public $table='valeur';
	public $join =array();	
	//public $iInstitut=16;

	public function __construct()
	{
		parent::__construct();
	}
	public function getValeur($inscriptionligneId,$valeur_champsId){
		$data_id=$this->valeur_model->read(array("valeur_inscriptionligneId"=>$inscriptionligneId,'valeur_champsId'=>$valeur_champsId));
		$data_id=current($data_id);
		$valeur_contenu=$data_id['valeur_contenu'];
		$resultat=$valeur_contenu;
		if($valeur_champsId==Champs_model::FONCTION_D_APPARTENANCE){ //fonction
			$data_fonction=$this->fonction_model->read(array("fonction_id"=>$valeur_contenu));
			$data_fonction=current($data_fonction);
			$resultat=$data_fonction["fonction_libelle"];
		}
		return $resultat;
	}
}