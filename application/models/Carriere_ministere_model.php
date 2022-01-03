<?php
class Carriere_ministere_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_ministere($id = FALSE){
        global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "ministere";
		if ($id === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by ministere_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $id));
		return $oQuery->row_array();
	}
        
}
?>