<?php
class GenericCruds_model extends CI_Model {
        
	public function __construct(){
		$this->load->database();
	}


	public function insert($zDatabase,$zTable,$oData){
		if( isset($zDatabase) &&  $zDatabase!=""){
			$oDatabase = $this->load->database($zDatabase, TRUE);
		}else{
			$oDatabase = $this->load->database("", TRUE);
		}
		if($oDatabase->insert($zTable, $oData)){
			return $oDatabase->insert_id();
		}else return false;

	}

	public function update($zDatabase,$zTable,$oData,$zCondition){
		$oDatabase = $this->load->database($zDatabase, TRUE);

		$oDatabase->update($zTable, $oData, $zCondition);
	}

	public function delete($zDatabase,$zTable,$tzConditions){
		$oDatabase = $this->load->database($zDatabase, TRUE);
		if ( sizeof($tzConditions) > 0 ){
				$zCondition	=	implode (" AND " ,$tzConditions) ;
		}
		$oDatabase->delete($zTable,$zCondition);
	}

	public function findByOne($zDatabase,$zTable,$tzConditions){
		$sql= 'SELECT * FROM ' .$zDatabase .'.' .$zTable .' WHERE 1=1 ';
		if ( sizeof($tzConditions) ){
			$sql= $sql . " AND " .implode (" AND " ,$tzConditions) ;
		}
		
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function findBy($zDatabase,$zTable,$tzConditions){
		$sql= 'SELECT * FROM ' .$zDatabase .'.' .$zTable .' WHERE 1=1';
		if ( sizeof($tzConditions) ){
			$sql= $sql . " AND " .implode (" AND " ,$tzConditions) ;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function executeQuery($zSql,$tzConditions){
		$sql		=	$zSql ;
		if ( sizeof($tzConditions) ){
			$sql	=	$sql . " AND " .implode (" AND " ,$tzConditions) ;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function addDays($zDate,$iDays){
		$sql= " SELECT DATE_ADD('$zDate', INTERVAL $iDays DAY) AS date_fin ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function get_referentiel($_referentiel,$_tzConditions,&$_iNbrTotal = 0){

		$oDbConnection		= $this->load->database('sgrh', TRUE);
		global				$db;
		$oRequest			= $_REQUEST;
		
		
		$zSql= "SELECT  SQL_CALC_FOUND_ROWS *
						FROM sgrh.".$_referentiel." a
					WHERE 1=1 ";
					
		
		if ( sizeof($_tzConditions) > 0 ){
			$zSql= $zSql . " AND " . implode (" OR " ,$_tzConditions) ;
		}
		if (isset($oRequest['start'])){
			$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
		} else {
			$zSql.=" LIMIT 0,5   ";
		}
		$zQuery				= $oDbConnection->query($zSql);
		$oRow				= $zQuery->result_array();
		$zQuery->free_result(); 
		//print_r($zSql);die;

		// nombre des résultats trouvés
        $zQueryDataCount	= "SELECT FOUND_ROWS() AS iNumRows" ;
        $toDataCount		= $oDbConnection->query($zQueryDataCount) ;
        $toRow				= $toDataCount->result_array();
		//print_r($zSql);die;
		if(sizeof($toRow)>0){
			$_iNbrTotal		= $toRow[0]['iNumRows'] ;
		}
			
		return $oRow;

	}
}
?>