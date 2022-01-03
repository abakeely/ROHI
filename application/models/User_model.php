<?php
class User_model extends MY_Model {

	private $user_table = 'user';
	
	public $table='user';
	public $join =array();
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_user($id = FALSE){
            
			global $db;
			$zDatabaseOrigin =  $db['default']['database'] ; 

			if ($id === FALSE)
            {
                    $query = $this->db->get('user');
                    return $query->result_array();
            }
            $query = $this->db->get_where($zDatabaseOrigin.'.user', array('id' => $id));
            return $query->row_array();
	}

	public function get_userByIm($_iMatricule){
            
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$query = $this->db->get_where($zDatabaseOrigin.'.user', array('im' => $_iMatricule));
		return $query->row_array();
	}
        
    public function existe_login_mdp($login,$mdp){
            $query = $this->db->get_where('user', array('login' => $login,'mdp'=>md5($mdp)));
            return sizeof($query->row_array())>0;
	}
	
	public function existe_login($login){
		$query = $this->db->get_where('user', array('login' => $login));
		return sizeof($query->row_array())>0;
	}

	public function get_user_by_login($login = FALSE){
		if ($login === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}
		$query = $this->db->get_where('user', array('login' => $login));
		return $query->row_array();
	}

	public function get_user_by_login_passWd($login = FALSE, $zPassword){
		if ($login === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('login', $login);
		$zPass = $this->db->escape($zPassword);
		$this->db->where('password', "AES_ENCRYPT({$zPass},'".encrypt."')", FALSE);
		$this->db->where('active','1');
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->row_array();
	}
	
	
	public function checkAgent($zLogin, $zPassword){
		
		$sql= "select * from user where login = '".$zLogin."' and password =AES_ENCRYPT('".$zPassword."','".encrypt."') ";
		$query = $this->db->query($sql);
		$row = $query->row_array();

		return $row;
	}
	
	public function checkAgentCms($zLogin, $zPassword){
		
		$sql= "select * from user_cms where login = '".$zLogin."' and password ='".$zPassword."' ";
		$query = $this->db->query($sql);
		$row = $query->row_array();

		return $row;
	}
	
	
	public function get_user_by_cin($cin = FALSE){
		if ($cin === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}
		$query = $this->db->get_where('user', array('cin' => $cin));
		return $query->row_array();
	}

	public function get_user_by_cin_trim($cin = FALSE){
		$sql= " SELECT * FROM rohi.user where replace(cin,' ','') ='".$cin."' ";

		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function get_encrypt($_zPassword){
		$sql= "SELECT AES_ENCRYPT('".$_zPassword."','drha') as password" ;
		$query = $this->db->query($sql);
		$oReturn = $query->row_array();
		return $oReturn["password"];
	}
	  
    public function get_user_by_matricule($mat = FALSE){
		if ($mat === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}
		if(empty($mat))
			return false;
		$query = $this->db->get_where('user', array('im' => $mat));
		return $query->row_array();
	}
        
        public function set_exist_cv($user_id = FALSE){
                $data = array();
                $data['exist_cv']  = true;
		$this->db->update($this->user_table, $data, "id = $user_id");
	}
       
        public function createUser($user){
		if($this->db->insert($this->user_table, $user)){
			return $this->db->insert_id();
		}else return false;
	}
        
        public function existe($login = FALSE){
			$user = $this->get_user_by_login($login);
           return sizeof($user)>0;
	}
        
        public function existe_mat($mat = FALSE){
            $user = $this->get_user_by_matricule($mat);
           return sizeof($user)>0;
	}
        
        public function existe_by_im($im = FALSE){
	   if ($login === FALSE)
            {
                    $query = $this->db->get('user');
                    return $query->result_array();
            }
            $query = $this->db->get_where('user', array('login' => $login));
            $user = $query->row_array();
             return sizeof($user)>0;
	}
        
        public function valide($id){
            $data = array();
            $data['validate']  = true;
            $this->db->update($this->user_table, $data, "id = $id");
        }
		
	public function get_user_no_cv(){
		$sql= "select * from user where id not  in (SELECT user_id FROM candidat)";
		//var_dump($sql);
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}

	public function insertSparky($_this){
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseSparky =  "sad" ;

		$oData = array();
		$iId = $_this->get_user_data('id');

		if(isset($iId) && ($iId!='9961')){

			$zString = strtolower($_SERVER['REQUEST_URI']);

			if((stristr($zString, 'ajax') === FALSE) && (stristr($zString, 'getTemplatePhoto1') === FALSE) && (stristr($zString, 'deconnexion') === FALSE) && (stristr($zString, 'ChangeTypeSet') === FALSE) && (stristr($zString, 'getDecision') === FALSE) && (stristr($zString, 'json') === FALSE) && (stristr($zString, 'cv/index') === FALSE) && (stristr($zString, 'setSessionCompte') === FALSE)) {
				$oData['sparky_userId'] = $iId;
				$oData['sparky_date'] = date('Y-m-d H:i:s');
				//$oData['sparky_page'] = $_this->router->uri->uri_string;
				$oData['sparky_page'] = str_replace("/ROHI/","",$_SERVER['REQUEST_URI']);
				$oData['sparky_ip'] = $this->getIP();

				if($DB1->insert($zDatabaseSparky.'.sparky', $oData)){
					return $DB1->insert_id();
				}else{
					return false;
				}
			} 
		}
	}

	function getIP() 
	{
			$zAdresseIp = '';
			if ($_SERVER['HTTP_CLIENT_IP'])
				$zAdresseIp = $_SERVER['HTTP_CLIENT_IP'];
			else if($_SERVER['HTTP_X_FORWARDED_FOR'])
				$zAdresseIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if($_SERVER['HTTP_X_FORWARDED'])
				$zAdresseIp = $_SERVER['HTTP_X_FORWARDED'];
			else if($_SERVER['HTTP_FORWARDED_FOR'])
				$zAdresseIp = $_SERVER['HTTP_FORWARDED_FOR'];
			else if($_SERVER['HTTP_FORWARDED'])
				$zAdresseIp = $_SERVER['HTTP_FORWARDED'];
			else if($_SERVER['REMOTE_ADDR'])
				$zAdresseIp = $_SERVER['REMOTE_ADDR'];
			else
				$zAdresseIp = 'UNKNOWN';
		 
			return $zAdresseIp;
	}
	
	public function get_list_respers(){
		$sql= "select * from user where role = 'chef' ";
		//var_dump($sql);
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	
	public function update_user($id_user,$data){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$this->db->update($zDatabaseOrigin . "." . $this->user_table, $data, "id = $id_user");
	}

	public function update_password($id_user,$data){


		$zPass = $this->db->escape($data['password']);
		$sql= "UPDATE user SET PASSWORD = AES_ENCRYPT({$zPass},'".encrypt."') WHERE id = ".$id_user;
		$this->db->query($sql);
	}
	
	public function update_respers_to_user($id_user){
		$data = array();
		$data['role'] = 'user';
		$data['dep'] = null;
		$data['dir'] = null;
		$data['serv'] = null;
		$this->db->update($this->user_table, $data, "id = $id_user");
	}
	/*eto iany*/
	public function get_responsable_projet(){
		$sql= "SELECT c.id,c.prenom FROM candidat c join direction d on d.id = c.direction where d.sigle_direction = 'DRHA'";
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result();
		return $row;
	}
	
	public function modifierMotDePasse($iUserId, $zPassword){
		$sql= "update rohi.user set password =AES_ENCRYPT('".$zPassword."','".encrypt."') where id='".$iUserId."' ";
		$this->db->query($sql);
	}
	
	public function active_user($iUserId,$zLogin,$zPassword){
	
		
		if( $zLogin != "" ){
			$sql= "update rohi.user set login ='".$zLogin."' where id='".$iUserId."' ";
			$this->db->query($sql);
		}
		
		if( $zPassword != "" ){
			$sql= "update rohi.user set password =AES_ENCRYPT('".$zPassword."','".encrypt."') where id='".$iUserId."' ";
			$this->db->query($sql);
		}
		$sql= "update rohi.user set active ='1' where id='".$iUserId."' ";
		$this->db->query($sql);
		
		$sql= "update rohi.user set maj_effectue ='OUI' where id='".$iUserId."' ";
		$this->db->query($sql);
	}
	
	public function is_active_user($iUserId){
		$sql= " SELECT * FROM rohi.user where id='".$iUserId."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function is_login_exist($zLogin){
		$sql= " SELECT * FROM rohi.user where login='".$zLogin."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}
?>