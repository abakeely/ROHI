<?php
class GestionAbscence_model extends CI_Model {

	public function __construct(){

		global $db;
		$this->load->database('pointage', TRUE);
	}

	public function executeQuery($_zSql){

		$oConnection	= $this->load->database('pointage', TRUE);
		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
		$oResult		= odbc_do ($oConnection->conn_id,$_zSql);

		return $oResult ; 
	}

	public function executeQueryZKGcap($_zSql){

		$oConnection	= $this->load->database('zKGcap', TRUE);
		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
		$oResult		= odbc_do ($oConnection->conn_id,$_zSql);
	}

	public function executeFetchGcapQuery($_zSql){

		$oConnection	= $this->load->database('zKGcap', TRUE);
		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
		$oResult		= odbc_do ($oConnection->conn_id,$_zSql);

		return $oResult ; 
	}



	public function lstInOut (){
		
		$zQuerySqlServer = "   SELECT *   FROM [ZKGcap].[dbo].[inout] WHERE 1=1 ";
		$oResult = $this->executeQuery($zQuerySqlServer);
		$toReturn = array();
		while($oArrayResult = odbc_fetch_array($oResult)){
			
			$oArray = array();
			$oArray['inOut_id']				= odbc_result($oResult,1); 
			$oArray['inOut_userId']			= odbc_result($oResult,2); 
			$oArray['inOut_userSendId']		= odbc_result($oResult,3); 
			array_push($toReturn, $oArray);
		}
		return $toReturn ; 
	}
	
}
?>
