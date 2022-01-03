<?php
class Session_model extends CI_Model {

	private $user_table = 'ci_sessions';
	
	public function __construct(){
		$this->load->database();
	}
	    
    public function session_connected(){
		$sql= "select * from $this->user_table where not user_data = ''";
		//$sql= "select * from session_histo where not user_data = ''";

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
		
	}
}

?>