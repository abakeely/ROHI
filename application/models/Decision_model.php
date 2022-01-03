<?php
class Decision_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($decisionData){
		if($this->db->insert('decision', $decisionData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_decision_by_demande_id($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('decision');
			return $query->result_array();
		}
	
		$query = $this->db->get_where('decision', array('demande_id' => $id));
		return $query->row_array();
	}
	
	public function get_decision($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('decision');
			return $query->result_array();
		}

		$query = $this->db->get_where('decision', array('id' => $id));
		return $query->row_array();
	}
        
    public function get_by_user_id($user_id){
			$sql= "select * from decision where user_id = $user_id ORDER BY id";
			$query = $this->db->query($sql);
			return $query->result_array();
    }
    
    public function get_decision_encours($user_id){
    	$sql= "select * from decision where user_id = $user_id and num_decision = null ORDER BY id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function get_decision_valide($user_id){
    	$sql= "select d.* from decision d ,demande_decision dd where  d.demande_id = dd.id and d.user_id = $user_id and d.num_decision != '' ORDER BY d.id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function get_decision_valide_annuel_and_cumule($user_id){
    	$sql= "select d.* from decision d ,demande_decision dd where (dd.type=2 or dd.type = 3) and  d.demande_id = dd.id and d.user_id = $user_id and d.num_decision != '' ORDER BY d.id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function update_decision($data_decision,$id_demande){
    	$this->db->update("decision", $data_decision, "id = $id_demande");
    }
    
    public function get_nombre_jour_total($user_id){
    	$ret = 0;
    	$list_decision_valide = $this->get_decision_valide($user_id);
    	foreach($list_decision_valide as $decision){
    		$ret = $ret + $decision['nbr_jour'];
    	}
    	return $ret;
    }
    
    public function verify_jour_dispo($id_decision,$nbr_jour){
    	$decision = $this->get_decision($id_decision);
    	if($decision){
    		return $decision['nbr_jour_rest'] >= $nbr_jour;
    	}
    	return false;
    }
    
    public function decremente_nbr_jour($id_decision,$nbr_jour){
    	if($this->verify_jour_dispo($id_decision,$nbr_jour)){
    		$decision = $this->get_decision($id_decision);
    		$data_decision = array();
    		$data_decision['nbr_jour_rest'] = $decision['nbr_jour_rest'] - $nbr_jour;
    		$this->db->update("decision", $data_decision, "id = $id_decision");
    		return true;
    	}
    	return false;
    }
    
    public function get_decision_valide_by_type($type,$user_id){
    	$sql= "select d.* from demande_decision dd,decision d where  dd.id = d.demande_id and dd.user_id = $user_id and dd.etat = 2 and dd.type=$type and  d.nbr_jour_rest>0  ORDER BY dd.annee";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
}
?>