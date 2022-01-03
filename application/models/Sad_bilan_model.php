<?php
class sad_bilan_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	/*public function get_bilan($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "SELECT pl.id, pl.user_id, pl.livre_id, pl.date_retour, us.login, lv.titre_livre FROM pret_livre AS pl
					JOIN USER AS us ON pl.user_id = us.id
					JOIN livre AS lv ON pl.livre_id = lv.id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('bilan', array('id' => $id));
		return current($query->result());
	}
	
	public function get_list_agent($data){
		$where = $this->get_where($data);
		$sql = "SELECT us.login, us.nom, us.prenom, COUNT(us.id) AS nombre
			FROM pret_livre AS pl
			JOIN USER AS us ON pl.user_id = us.id 
			GROUP BY us.id
			ORDER BY COUNT(us.id) DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_livres_emprunter($data){
		$where = $this->get_where($data);
		$sql = "SELECT lv.titre_livre, lv.cote_livre, COUNT(lv.id)
			FROM pret_livre AS pl
			JOIN livre AS lv ON pl.livre_id = lv.id
			GROUP BY lv.id
			ORDER BY COUNT(lv.id) DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_agent_emprunte_livre($data){
		$where = $this->get_where($data);
		$sql = "SELECT us.login, us.nom, us.prenom
				FROM pret_livre AS pl
				JOIN USER AS us ON pl.user_id = us.id 
				JOIN livre AS lv ON pl.livre_id = lv.id
				WHERE lv.id = 3202";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	public function get_list_livre_emprunter_agent($data){
		$where = $this->get_where($data);
		$sql = "SELECT lv.titre_livre, lv.cote_livre
			FROM pret_livre AS pl
			JOIN livre AS lv ON pl.livre_id = lv.id
			JOIN USER AS us ON pl.user_id = us.id
			WHERE us.id = 3246";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}*/
	
	
	public function get_liste_departement(){
        $zQuery = ' SELECT dept.sigle_departement AS dept, COUNT(cd.id) AS nombre FROM pret_livre AS pl JOIN USER AS us ON pl.user_id = us.id JOIN candidat AS cd ON cd.user_id = us.id JOIN service AS sv ON cd.service = sv.id JOIN direction AS drt ON sv.direction_id = drt.id JOIN departement AS dept ON drt.departement_id = dept.id  WHERE YEAR(date_reservation)=2017 GROUP BY dept.id ORDER BY COUNT(cd.id) DESC LIMIT 0, 10';
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }
	public function get_liste_direction(){
        $zQuery = ' SELECT drt.sigle_direction AS direction, COUNT(cd.id) AS nombre FROM pret_livre AS pl
			JOIN USER AS us ON pl.user_id = us.id 
			JOIN candidat AS cd ON cd.user_id = us.id
			JOIN service AS sv ON cd.service = sv.id
			JOIN direction AS drt ON sv.direction_id = drt.id
			JOIN departement AS dept ON drt.departement_id = dept.id
			WHERE YEAR(date_reservation)=2017
			GROUP BY drt.id
			ORDER BY COUNT(cd.id) DESC LIMIT 0, 10';
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }
	public function get_liste_service(){
        $zQuery = ' SELECT sv.sigle_service AS service, COUNT(cd.id) AS nombre FROM pret_livre AS pl
				JOIN USER AS us ON pl.user_id = us.id 
				JOIN candidat AS cd ON cd.user_id = us.id
				JOIN service AS sv ON cd.service = sv.id
				JOIN direction AS drt ON sv.direction_id = drt.id
				JOIN departement AS dept ON drt.departement_id = dept.id
				 WHERE YEAR(date_reservation)=2017
				GROUP BY sv.id
				ORDER BY COUNT(cd.id) DESC LIMIT 0, 10';
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }
	public function get_liste_plus_empreinte(){
        $zQuery = ' SELECT lv.titre_livre, lv.cote_livre, COUNT(lv.id) AS nombre FROM pret_livre AS pl JOIN livre AS lv ON pl.livre_id = lv.id   WHERE YEAR(date_reservation)=2017 GROUP BY lv.id  ORDER BY COUNT(lv.id) DESC Limit 0, 10';
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }	
	public function get_liste_agent_empreinte_bcp_livre(){
        $zQuery = ' SELECT cd.nom, cd.prenom,sv.sigle_service AS service,drt.sigle_direction AS direction,dept.sigle_departement AS dept, COUNT(cd.id) AS nombre FROM pret_livre AS pl JOIN USER AS us ON pl.user_id = us.id JOIN candidat AS cd ON cd.user_id = us.id JOIN service AS sv ON cd.service = sv.id JOIN direction AS drt ON sv.direction_id = drt.id JOIN departement AS dept ON drt.departement_id = dept.id  WHERE YEAR(date_reservation)=2017 GROUP BY cd.id ORDER BY COUNT(cd.id) DESC Limit 0, 10';
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }
	public function get_liste_agent_empreinte_une_livre(){
        $zQuery = ' SELECT cd.nom, cd.prenom, lv.titre_livre, lv.cote_livre
				FROM pret_livre AS pl
				JOIN USER AS cd ON pl.user_id = cd.id 
				JOIN livre AS lv ON pl.livre_id = lv.id
				WHERE lv.id = pl.livre_id ORDER BY pl.id DESC Limit 0, 10' ;
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }
	public function get_liste_planning(){
        $zQuery = 'SELECT pla.nom_prenom_restitution FROM planning AS pla  WHERE YEAR(date_restitution)=2017 ORDER BY pla.id DESC Limit 0, 2';
        $zRes = $this->db->query( $zQuery );
        return $zRes->result();
    }
}
?>