<?php
class Sad_connected_model extends CI_Model {
	private $table = 'user_sad_connected';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function active_user($id_user){
		$data = array();
		$data['date_last_connection'] = date('Y-m-d\TH:i:s');
		if(!$this->exist_user($id_user)){
			$data['user_id'] = $id_user;
			if($this->db->insert($this->table, $data)){
				return $this->db->insert_id();
			}else return false;
		}
		else{
			$this->db->where('user_id', $id_user);
			$this->db->update($this->table, $data);
		}
	}
	
	public function exist_user($id_user){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('user_id', $id_user );
		$query = $this->db->get();
		return $query->num_rows() > 0 ;
	}
	
	public function remove_user($user_id){
		 //$this->db->where('user_id', $user_id);
		 //$this->db->delete($this->table);
	}
	
	/*public function get_all_user_sad_now(){
		$date = date('Y-m-d');
		$sql = "select user.nom, user.prenom,user.im,sad.date_last_connection,d.libele as departement,r.libele as region,c.lacalite_service";
		$sql .= " from user_sad_connected as sad";
		$sql .= " join user on user.id=sad.user_id";
		$sql .= " join candidat c on c.user_id = sad.user_id";
		$sql .= " join departement d on c.departement = d.id";
		$sql .= " join region r on r.id = c.region_id";
		$sql .= " where date(sad.date_last_connection) = '$date' AND c.service <> 3 ";
		$sql .= " and sad.is_connected";
		$sql .= " order by sad.date_last_connection desc ";	
		
		$query =  $this->db->query($sql);
		
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}*/
	
	public function get_all_user_sad_now(){
		$date = date('Y-m-d');
		$sql = "select user.nom, user.prenom,user.im,sad.date_last_connection,d.libele as departement,r.libele as region,c.lacalite_service, c.id as candidat_id";
		$sql .= " from user_sad_connected as sad";
		$sql .= " join user on user.id=sad.user_id";
		$sql .= " join candidat c on c.user_id = sad.user_id";
		$sql .= " join departement d on c.departement = d.id";
		$sql .= " join region r on r.id = c.region_id";
		$sql .= " where date(sad.date_last_connection) = '$date'  AND c.service <> 3";
		$sql .= " and sad.is_connected";
		$sql .= " order by sad.date_last_connection desc ";	
		
		$query =  $this->db->query($sql);
		
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	/*public function get_all_user_sad_intervalle($date_en_start,$date_en_fin){
		$sql = "select user.nom, user.prenom,user.im,sad.date_last_connection,d.libele as departement,r.libele as region,c.lacalite_service";
		$sql .= " from user_sad_connected as sad";
		$sql .= " join user on user.id=sad.user_id";
		$sql .= " join candidat c on c.user_id = sad.user_id";
		$sql .= " join departement d on c.departement = d.id";
		$sql .= " join region r on r.id = c.region_id";
		$sql .= " where date(sad.date_last_connection) >= '$date_en_start'";
		$sql .= " and date(sad.date_last_connection) <= '$date_en_fin' AND c.service <> 3";
		$sql .= " order by sad.date_last_connection desc ";	
		
		$query =  $this->db->query($sql); 
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}*/
	
	public function get_all_user_sad_intervalle($date_en_start,$date_en_fin){
		$sql = "select user.nom, user.prenom,user.im,sad.date_last_connection,d.libele as departement,r.libele as region,c.lacalite_service,c.id as candidat_id";
		$sql .= " from user_sad_connected as sad";
		$sql .= " join user on user.id=sad.user_id";
		$sql .= " join candidat c on c.user_id = sad.user_id";
		$sql .= " join departement d on c.departement = d.id";
		$sql .= " join region r on r.id = c.region_id";
		$sql .= " where date(sad.date_last_connection) >= '$date_en_start'";
		$sql .= " and date(sad.date_last_connection) <= '$date_en_fin' AND c.service <> 3";
		$sql .= " order by sad.date_last_connection desc ";	
		
		$query =  $this->db->query($sql); 
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	public function get_all_user_connected(){
		/*$this->db->select('user.*');
		$this->db->from($this->table.' as sad'); 
		$this->db->join('user', 'user.id=sad.user_id', 'left');
		$this->db->order_by('sad.date_last_connection','desc');         
		$query = $this->db->get(); 
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}*/
		
		$zSql= "SELECT c.nom, c.prenom,d.sigle_departement AS departement,r.libele AS region,c.lacalite_service,DATE_FORMAT(date_last_connection, '%d/%m/%Y %h:%m:%s') as date_last_connection ,user.im  FROM (`user_sad_connected` AS sad) 
				INNER JOIN `user` ON `user`.`id`=`sad`.`user_id` 
				INNER JOIN candidat c ON c.user_id = user.id
				INNER JOIN departement d ON d.id = c.departement
				INNER JOIN region r ON r.id = c.region_id
				WHERE c.service <> 3
				ORDER BY `sad`.`date_last_connection` desc";

		$zQuery = $this->db->query($zSql);

		return $zQuery->result_array();
	}
	
	public function get_nb_user_connected_by($date_en_start,$date_en_fin,$by){
		$sql = '';
		if($by==0){
			$sql .= "select CONCAT(user.nom, ' ',user.prenom) as label,count(*) as nb";
			$sql .= " from user_sad_connected as sad";
			$sql .= " join user on user.id=sad.user_id";
			$sql .= " where date(sad.date_last_connection) >= '$date_en_start'";
			$sql .= " and date(sad.date_last_connection) <= '$date_en_fin'";
			$sql .= " group by sad.user_id order by nb desc";	
		}
		else if($by==1){
			$sql .= "select CONCAT(d.libele,'(',d.sigle_departement,')') as label,count(*) as nb";
			$sql .= " from user_sad_connected as sad";
			$sql .= " join user on user.id=sad.user_id";
			$sql .= " join candidat c on c.user_id = sad.user_id";
			$sql .= " join departement d on c.departement = d.id";
			$sql .= " where date(sad.date_last_connection) >= '$date_en_start'";
			$sql .= " and date(sad.date_last_connection) <= '$date_en_fin'";
			$sql .= " group by d.id order by nb desc";	
		}
		else if($by==2){
			$sql .= "select r.libele as label,count(*) as nb";
			$sql .= " from user_sad_connected as sad";
			$sql .= " join user on user.id=sad.user_id";
			$sql .= " join candidat c on c.user_id = sad.user_id";
			$sql .= " join region r on r.id = c.region_id";
			$sql .= " where date(sad.date_last_connection) >= '$date_en_start'";
			$sql .= " and date(sad.date_last_connection) <= '$date_en_fin'";
			$sql .= " group by r.id order by nb desc";	
		}
		else if($by==3){
			$sql .= "select d.libele as label,count(*) as nb";
			$sql .= " from user_sad_connected as sad";
			$sql .= " join user on user.id=sad.user_id";
			$sql .= " join candidat c on c.user_id = sad.user_id";
			$sql .= " join direction d on d.id = c.direction";
			$sql .= " where date(sad.date_last_connection) >= '$date_en_start'";
			$sql .= " and date(sad.date_last_connection) <= '$date_en_fin'";
			$sql .= " group by d.id order by nb desc";	
		}
		$query =  $this->db->query($sql); 
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
}
?>