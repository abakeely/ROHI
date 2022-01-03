<?php
class Connected_model extends CI_Model {
    
    public function __construct(){
		$this->load->database('gcap');
	}
    
    public function insert($oData){
		//$DB1 = $this->load->database('gcap', TRUE);
	global $db;
	$zDatabaseGcap =  $db['gcap']['database'] ; 
    $iConnected_UserId=$oData['connected_userId'];
    $zSql= "select * from $zDatabaseGcap.connected where connected_userId = $iConnected_UserId ";
	$zQuery = $this->db->query($zSql);
	$result = $zQuery->result_array();
    //var_dump($result);die();
    
        if(empty($result)){
            if($this->db->insert($zDatabaseGcap.'.connected', $oData)){
                return $this->db->insert_id();
            }else return false;
        } else $this->update($oData,$iConnected_UserId);
	}
    
    public function update($oData,$_iConnectedId){
        global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;

		$this->db->update($zDatabaseGcap.'.connected', $oData, "connected_userId = $_iConnectedId");
		return $_iConnectedId ;
    }
    
    public function delete($_zTime){
        global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;

		$zSql="delete LOW_PRIORITY from $zDatabaseGcap.connected where connected_time < $_zTime";
        $zQuery = $this->db->query($zSql);
    }
    
    public function get_user_connected(){
		$DB1=$this->load->database('gcap',TRUE);

        $zSql = "select * from connected";
        $zQuery = $DB1->query($zSql);
		$result = $zQuery->result_array();
		
		
		if(!empty($result)){
			$DB1=$this->load->database('gcap',TRUE);
			global $db;
			$zDatabaseOrigin =  $db['default']['database'] ; 
			$iCond=0;
			foreach($result as $value){
				$zSql2="select id,nom,prenom,type_photo from $zDatabaseOrigin.candidat where user_id='".$value['connected_userId']."'";
				$query=$DB1->query($zSql2);
				$oResult=$query->row_array();
				$oConnected[$iCond]['connected_userId']=$value['connected_userId'];
				$oConnected[$iCond]['oUserNomPrenom']=$oResult;
				$iCond++;
			}
			return $oConnected;
		}
        
    }
	
	public function get_search_result($_zSearchKey){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zSql = "select user_id,nom,prenom from $zDatabaseOrigin.candidat where (nom like '%$_zSearchKey%' or prenom like '%$_zSearchKey%')";
        $zQuery = $this->db->query($zSql);
		$result = $zQuery->result_array();
		
		
		if(!empty($result)){
			
			$DB1=$this->load->database('gcap',TRUE);
			
			$iCond=0;
			foreach($result as $value){
				$zSql2 = "select * from connected where connected_userId='".$value['user_id']."'";
				$query = $DB1->query($zSql2);
				$oResult=$query->row_array();
				if(!empty($oResult)){
					$oResultSearch[$iCond]['oUserNomPrenom']=$value;
					$iCond++;
				}
			}
			if(!empty($oResultSearch)){
				return $oResultSearch;
			}
		}
	
	}
	
	public function get_same_service ($_iServiceId) {
		global $db;
		$DB1 = $this->load->database('gcap',TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql = "select id,nom,prenom,user_id,type_photo from $zDatabaseOrigin.candidat where service = '".$_iServiceId."'";
		$str = "select cand.id,cand.nom,cand.prenom,cand.user_id,cand.type_photo,IFNULL(con.connected_userId,0) as state from $zDatabaseOrigin.candidat as cand LEFT JOIN $zDatabaseGcap.connected as con ON con.connected_userId = cand.user_id AND cand.service = '".$_iServiceId."'";
		$query=$this->db->query($zSql);
		$oResult=$query->result_array();
		return $oResult;
	}
	
	public function checkState ($_iUserId) {
		$DB1 = $this->load->database('gcap',TRUE);
		$zSql = "select * from connected where connected_userId = $_iUserId";
		$query=$DB1->query($zSql);
		$oResult=$query->result_array();
		if(!empty($oResult)){
			return 1;
		}else {
			return 0;
		}
	}
    
}

?>