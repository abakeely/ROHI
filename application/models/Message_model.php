<?php
class Message_model extends CI_Model {
    
    public function __construct(){
		$this->load->database('gcap');
	}
    
    public function insert($oData){
		$DB1=$this->load->database('gcap',TRUE);
		if($DB1->insert('message', $oData)){
			return $DB1->insert_id();
		}else return false;
	}
    
    public function get_last_message($_iDestinataireId){
		$DB1=$this->load->database('gcap',TRUE);
		$zSql="SELECT *
				 FROM gcap.chat a
				 INNER JOIN rohi.candidat b
				 ON a.message_expediteurId = b.user_id
				 WHERE message_destinataireId ='".$_iDestinataireId."'
				 ORDER BY message_id DESC
				 LIMIT 1 ";
		$zQuery = $DB1->query($zSql);
		$result = $zQuery->row_array();
		return $result;
	}
}

?>