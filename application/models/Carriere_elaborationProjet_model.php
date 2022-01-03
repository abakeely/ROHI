<?php
class Carriere_elaborationProjet_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_elaborationProjet($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		if ($_iId === FALSE)
		{
			$zSql= "select * from ".$zBase.".".$zTable." order by elaborationProjet_id";
                        $oQuery = $this->db->query($zSql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	public function searchElaborationProjet($_toRecherche = FALSE,$_iDebut = FALSE,&$_iNbrTotal = 0,$_iLimite = FALSE)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$zSql= "SELECT SQL_CALC_FOUND_ROWS e.*, c.*"." FROM ".$zBase.".".$zTable." as e LEFT JOIN ".$zBase.".candidat as c ON e.ELABORATIONPROJET_CANDIDATID = c.candidat_id";
		
		if($_toRecherche != FALSE)
		{
			$iVerification = 1;
			$iTaille = sizeof($_toRecherche);
			$zSql=$zSql." WHERE";
			foreach($_toRecherche as $key => $value)
			{
				if(! ctype_digit(strval($value)))
				{
					$zSql=$zSql." ".$key." like '%".$value."%'";
				}
				else
				{
					$zSql=$zSql." ".$key." = '".$value."'";
				}
				
				if($iVerification<$iTaille)
				{
					$zSql=$zSql." AND";
				}
				$iVerification++;
			}		
		}
		if($_iDebut!==FALSE && $_iLimite!==FALSE)
		{
			$zSql=$zSql." ORDER BY e.elaborationProjet_id ASC LIMIT ".($_iDebut-1)*$_iLimite.",".$_iLimite;
		}
		$oQuery = $this->db->query($zSql);
		//print_r($this->db->last_query());
		$oRow = $oQuery->result_array();
		$oQuery->free_result(); // The $oQuery result object will no longer be available

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $oRow;	
	}

	public function get_elaborationProjetPagination($_iDebut = FALSE,&$_iNbrTotal = 0,$_iLimite = FALSE)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$zSql= "SELECT SQL_CALC_FOUND_ROWS e.* "." FROM ".$zBase.".".$zTable." as e";
		
		if($_iDebut!==FALSE && $_iLimite!==FALSE)
		{
			$zSql=$zSql." ORDER BY e.elaborationProjet_id ASC LIMIT ".($_iDebut-1)*$_iLimite.",".$_iLimite;
		}
		$oQuery = $this->db->query($zSql);
		//print_r($this->db->last_query());
		$oRow = $oQuery->result_array();
		$oQuery->free_result(); // The $oQuery result object will no longer be available

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $oRow;	
	}

	public function getElaborationProjetByMatricule($_iMatricule)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$zSql= "SELECT e.*, c.* FROM ".$zBase.".".$zTable." as e LEFT JOIN ".$zBase.".candidat as c ON e.ELABORATIONPROJET_CANDIDATID = c.candidat_id";
		$zSql = $zSql." WHERE c.candidat_matricule = ".$_iMatricule;
		$oQuery = $this->db->query($zSql);
		
		return $oQuery->row_array();
	}

	public function getElaborationProjetByMatriculeAndDate($_iMatricule,$_sDate)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$zSql= "SELECT e.*, c.* FROM ".$zBase.".".$zTable." as e LEFT JOIN ".$zBase.".candidat as c ON e.ELABORATIONPROJET_CANDIDATID = c.candidat_id";
		$zSql = $zSql." WHERE c.candidat_matricule = ".$_iMatricule." AND e.elaborationProjet_date = '$_sDate'";
		$oQuery = $this->db->query($zSql);
		
		return $oQuery->row_array();
	}

	public function getElaborationProjetByUserId($_iId)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$zSql= "SELECT e.*, c.* FROM ".$zBase.".".$zTable." as e LEFT JOIN ".$zBase.".candidat as c ON e.ELABORATIONPROJET_CANDIDATID = c.candidat_id";
		$zSql = $zSql." WHERE c.user_id = ".$_iId;
		$oQuery = $this->db->query($zSql);
		
		return $oQuery->row_array();
	}

	public function getElaborationProjetByIdProjet($_iId)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$zSql= "SELECT e.*, c.* FROM ".$zBase.".".$zTable." as e LEFT JOIN ".$zBase.".candidat as c ON e.ELABORATIONPROJET_CANDIDATID = c.candidat_id";
		$zSql = $zSql." WHERE e.".$zTable."_id = ".$_iId;
		$oQuery = $this->db->query($zSql);
		
		return $oQuery->row_array();
	}

	public function insert($elaborationProjetData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		if($this->db->insert($zBase.".".$zTable, $elaborationProjetData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($elaborationProjetData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$this->db->update($zBase.".".$zTable, $elaborationProjetData, $zTable."_id = '".$elaborationProjetData['elaborationProjet_id']."'");
	}

	public function delete($elaborationProjetData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationProjet";
		$this->db->delete($zBase.".".$zTable, $elaborationProjetData, $zTable."_id = '".$elaborationProjetData['elaborationProjet_id']."'");
	}
}
?>