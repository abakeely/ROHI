<?php
class Demande_decision_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($demande){
		if($this->db->insert('demande_decision', $demande)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function traitement_demande_decision($demande_id){
		$data = array();
		$data['etat'] = 1; 
		$this->db->update("demande_decision", $data, "id = $demande_id");
		//$this->db->query('delete from demande_decision where id = '.$demande_id);
	}
	
	public function finalise_demande_decision($demande_id){
		$data = array();
		$data['etat'] = 2;
		$this->db->update("demande_decision", $data, "id = $demande_id");
		//$this->db->query('delete from demande_decision where id = '.$demande_id);
	}
	
	public function delete_demande_decision($demande_id){
			$this->db->query('delete from demande_decision where id = '.$demande_id);
	}
	
	public function get_demande_decision($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('demande_decision');
			return $query->result_array();
		}

		$query = $this->db->get_where('demande_decision', array('id' => $id));
		return $query->row_array();
	}
        
    public function get_by_user_id($user_id){
			$sql= "select * from demande_decision where user_id = $user_id ORDER BY id";
			$query = $this->db->query($sql);
			return $query->result_array();
    }
    
    public function get_by_user_id_and_annee($user_id,$annee){
    	$sql= "select * from demande_decision where user_id = $user_id and annee = $annee ORDER BY id";
    	$query = $this->db->query($sql);
    	return $query->row_array();
    }
    
    public function get_decision_encours($user_id){
    	$sql= "select * from demande_decision where user_id = $user_id and etat = 0 ORDER BY id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function get_decision_valide($user_id){
    	$sql= "select * from demande_decision where user_id = $user_id and etat = 2 ORDER BY id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function is_exist_year($user_id,$annee){
    	$sql= "select * from demande_decision where user_id = $user_id and annee = ".$annee;
    	//var_dump($sql);
    	$query = $this->db->query($sql);
    	return sizeof($query->result_array())>0;
    }
	
	 public function get_nombre_jour_total($user_id){
		 $ret = 0;
		 $list_demande = $this->get_decision_valide($user_id);
		 foreach ($list_demande as $demande){
			 $ret += $demande['nbr_jour'];
		 }
	 }
    
    
    
}
?>