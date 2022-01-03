 <?php
class Visite_page_model extends CI_Model {

	public function __construct(){
		$this->load->database('rohi');
	}
	
	public function insert($oData){
		if($this->db->insert('t_visite', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>