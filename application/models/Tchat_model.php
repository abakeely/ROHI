<?php
class Tchat_model extends CI_Model {
        
	public function getNbNouveauMessage($iUserId){
		$sql= " SELECT count(*) as nb_message FROM gcap.chat WHERE message_destinataireId='".$iUserId."' AND message_statut='NEW' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function majView($iUserId){
		$sql= " update gcap.chat set message_statut ='VIEW' where message_destinataireId ='".$iUserId."' ";
		$this->db->query($sql);
	}
}
?>