<?php
class Candidat_parcours_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_parcours_candidat($id = false){
            if ($id === FALSE)
            {
                    $query = $this->db->get('candidat_parcours');
                    return $query->result_array();
            }
			$this->db->from($this->candidat_parcours);
			$this->db->order_by("date_debut","desc");
            $query = $this->db->get_where('candidat_parcours', array('candidat_id' => $id));
            return $query->result_array();
	}
        
   public function insert($parcoursData){
		if($this->db->insert('candidat_parcours', $parcoursData)){
				return $this->db->insert_id();
		}else return false;
   }
        
   public function delete_all_parcours_candidat($id){
            $this->db->query('delete from candidat_parcours where candidat_id = '.$id);
   }
   

   public function getFonction($p_user_id, $p_date){
		$zSql	= " SELECT  b.par_poste
					FROM candidat a
					INNER JOIN candidat_parcours b
					ON a.id = b.candidat_id
					WHERE a.user_id ='".$p_user_id."'
					AND YEAR('".$p_date."') = date_debut 
					LIMIT 1";
		$oQuery			= $this->db->query($zSql);
		$oRowResult		= $oQuery->row_array();
		$oQuery->free_result(); 
		return $oRowResult['par_poste'];
	}

}
?>