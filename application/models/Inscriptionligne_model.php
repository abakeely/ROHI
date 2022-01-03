<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Inscriptionligne_model extends MY_Model {

	public $table='inscriptionligne';
	public $join =array();	

	public function __construct()
	{
		parent::__construct();
	}

	public function getListAdmin(){
	
		$sql="SELECT
				inscriptionligne.inscriptionligne_id as ordre,
				user.nom as nom,
				user.prenom as prenom,
				'' as i_m,
				'' as region,
				departement.departement_libelle as d_general,
				direction.direction_libelle as `direction`,
				service.service_libelle as `service`,
				poste.poste_libelle as `poste`,
				formation.formation_intitule as `type_formation`,
				institut.institut_libelle as `institut`,
				intitule.intitule_libelle as `intitule_formation`

				from inscriptionligne

				left join user on user.id=inscriptionligne.inscriptionligne_userId
				left join valeur on inscriptionligne.inscriptionligne_id=valeur.valeur_inscriptionligneId
				left join poste on poste.poste_id=(select valeur.valeur_contenu from valeur where valeur.valeur_champsId=POSTE and valeur.valeur_inscriptionligneId=inscriptionligne.inscriptionligne_id)
				left join service on service.service_id=poste.poste_serviceId
				left join direction on direction.direction_id=service.service_directionId
				left join departement on departement.departement_id=direction.direction_departementId
				left join institut on institut.institut_id=(select valeur.valeur_contenu from valeur where valeur.valeur_champsId=INSTITUT and valeur.valeur_inscriptionligneId=inscriptionligne.inscriptionligne_id)
				left join intitule on intitule.intitule_id=(select valeur.valeur_contenu from valeur where valeur.valeur_champsId=INTITULE and valeur.valeur_inscriptionligneId=inscriptionligne.inscriptionligne_id)
				left join formation on formation.formation_id=(select valeur.valeur_contenu from valeur where valeur.valeur_champsId=FORMATION and valeur.valeur_inscriptionligneId=inscriptionligne.inscriptionligne_id)

				group by inscriptionligne.inscriptionligne_id";

			return $this->db->query($sql)->result_array();
	}
}