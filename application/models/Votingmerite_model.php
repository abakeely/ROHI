<?php
class Votingmerite_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function insert($oData){
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		if($this->db->insert($zDatabaseCommon.'.votemerite', $oData)){

			$iVoteMeriteId = $this->db->insert_id();
			return $iVoteMeriteId ;

		}else return false;
	}

	public function findParent($iChildId,$iParentId){
		
		$sql = "SELECT *
				 FROM(
				SELECT  @r AS _id,
						 (
						 SELECT  @r := parent_id
						 FROM    t_structure
						 WHERE   child_id = _id
						 ) AS parent_id,
						 (
						 SELECT  @sigle := sigle
						 FROM    t_structure
						 WHERE   child_id = _id
						 ) AS parent_sigle,
						 (
						 SELECT  @rang := rang
						 FROM    t_structure
						 WHERE   child_id = _id
						 ) AS parent_rang,
						 @l := @l + 1 AS lvl
				 FROM    (
						 SELECT  @r := '".$iChildId."',
								 @l := 0,
								 @cl := 0
						 ) vars,
						 rohi.t_structure h
				WHERE    @r <> 0
				) AS table_parent
				WHERE parent_rang='".$iParentId."'
				LIMIT 1" ;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	private function getPointDate(){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT * FROM ".$zDatabaseCommon.".pointdate WHERE (CAST(CURDATE() AS DATE) BETWEEN CAST(pointDate_debut AS DATE) AND CAST(pointDate_fin AS DATE))";

		//echo $zSql; die();

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->row();
		$zQuery->free_result(); 


		$_SESSION["PointDate"] = array();
		if(sizeof($toRow)> 0){
			$_SESSION["PointDate"] = $toRow;
		}

		return $toRow;
	}

	public function getDepartementVoting(){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT * FROM ".$zDatabaseCommon.".structurevoting GROUP BY structure_dept ORDER BY structure_dept DESC";

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function laureat($_iMatricule, $_iDepartementId='', $_zLocalite="CENTRAL"){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;

		$zSqlDept = "";
		if($_iDepartementId != ''){
			$zSqlDept= " AND voteMerite_localite = '".$_iDepartementId."'" ;
		}
		
		switch ($_zLocalite){
			case 'CENTRAL':
				$zSqlIn= " SELECT voteMerite_agentCerntralUserId FROM ".$zDatabaseCommon.".votemerite WHERE 1  $zSqlDept";
				$zSqlCount= " SELECT COUNT(voteMerite_agentCerntralUserId) FROM ".$zDatabaseCommon.".votemerite WHERE 1 $zSqlDept AND voteMerite_agentCerntralUserId = iUserId";

				
				break;
			
			case 'REGIONAL':
				$zSqlIn= " SELECT voteMerite_agentRegionalUserId FROM ".$zDatabaseCommon.".votemerite WHERE 1 $zSqlDept";
				$zSqlCount= " SELECT COUNT(voteMerite_agentRegionalUserId) FROM ".$zDatabaseCommon.".votemerite WHERE 1 $zSqlDept AND voteMerite_agentRegionalUserId = iUserId";
				break;
		}


		$zDatabaseCommon =  $db['common']['database'] ;
		$zDatabaseRohi =  $db['rohi']['database'] ;
		$zSql= " SELECT *, user_id as iUserId, ($zSqlCount) as iNbrVote  FROM ".$zDatabaseRohi.".candidat c
		INNER JOIN $zDatabaseCommon.laureat ON laureat_matricule = c.matricule
		INNER JOIN ".$zDatabaseRohi.".t_structure t ON t.child_id = c.structureId 
		WHERE user_id IN ($zSqlIn) ";
		
		if($_iMatricule!=''){
			$zSql .= " AND c.matricule = " . $_iMatricule;
		}
		
		$zSql .= " ORDER BY iNbrVote DESC";

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;
	}



	public function getRangStructure($_iChildId){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT rang FROM rohi.t_structure WHERE child_id =".$_iChildId." LIMIT 0,1";

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->row();
		$zQuery->free_result(); 

		return $toRow->rang;
	}

	public function getStatAllGlobal_last($_iDepartementId, $zLocalite){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;

		$zSqlDept = "";
		$zSqlDept1 = "";
		$zSqlDept2 = "";
		$zSqlDept3 = "";

		$zSqlCodeSanction = " AND sanction IN('0','00','34','40') ";

		/*if($_iDepartementId != ''){
			$zSqlDept .= " AND voteMerite_localite = '".$_iDepartementId."'" ;
			$zSqlDept1 .= " AND structure_dept = '".$_iDepartementId."'" ;
			$zSqlDept2 .= " AND structure_voting LIKE '%".$_iDepartementId." CENTRAL'" ;
			$zSqlDept3 .= " AND structure_voting LIKE '%".$_iDepartementId." REGIONAL'" ;
		} else {

			$zSqlDept2 .= " AND structure_voting LIKE '%CENTRAL'" ;
			$zSqlDept3 .= " AND structure_voting LIKE '%REGIONAL'" ;
		}*/

		$zSqlDept2 .= " AND structure_voting LIKE '%CENTRAL'" ;
		$zSqlDept3 .= " AND structure_voting LIKE '%REGIONAL'" ;
			


		$zSql= " SELECT COUNT(voteMerite_id) as iNbrTotal,
		(SELECT COUNT(c.id) AS DGT FROM rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id
		INNER JOIN common.structurevoting s ON s.structure_path = t.path
		WHERE 1 $zSqlDept1 $zSqlCodeSanction) as iCountTotal,
		(SELECT COUNT(c.id) AS DGT FROM  rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id INNER JOIN common.structurevoting s ON s.structure_path = t.path WHERE 1 $zSqlDept1 $zSqlDept2 $zSqlCodeSanction) as iCentral,

		(SELECT COUNT(c.id) AS DGT FROM  rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id INNER JOIN common.structurevoting s ON s.structure_path = t.path WHERE 1 $zSqlDept1 $zSqlDept3 $zSqlCodeSanction) as iRegional,

		(1) as iVoteCentral
		FROM $zDatabaseCommon.votemerite WHERE 1 ";

		if($_iDepartementId != ''){
			$zSql .= $zSqlDept ;
		}

		$zSql .= " LIMIT 0,1 ";

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->row();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function getStatAllGlobal(){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;

		$zSqlDept = "";
		$zSqlDept1 = "";
		$zSqlCodeSanction = " AND sanction IN('0','00','34','40') ";

		$zSqlDept2 .= " AND structure_voting LIKE '%CENTRAL'" ;
		$zSqlDept3 .= " AND structure_voting LIKE '%REGIONAL'" ;
		
			


		/*$zSql= " SELECT COUNT(voteMerite_id) as iNombreTotal,
		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE 1 $zSqlCodeSanction) as iCountTotal,

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE 1 $zSqlCodeSanction) as iCentral,

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE structureId NOT IN (SELECT structure_id FROM $zDatabaseCommon.structurevoting WHERE structure_voting IN ('MEF CENTRAL','SG CENTRAL','ARMP CENTRAL','CSC CENTRAL') ) AND sanction IN('0','00','34','40')) as iRegional,



		(SELECT (COUNT(voteMerite_agentCerntralUserId)+COUNT(voteMerite_agentRegionalUserId))
		FROM $zDatabaseCommon.votemerite) as iVoteCentral,


		(SELECT (COUNT(voteMerite_agentCerntralUserId)+COUNT(voteMerite_agentRegionalUserId)) 
		FROM $zDatabaseCommon.votemerite WHERE voteMerite_agentRegionalUserId >0) as iVoteRegional*/


		$zSql= " SELECT COUNT(voteMerite_id) as iNombreTotal,
		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE 1 $zSqlCodeSanction) as iCountTotal,

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE 1 $zSqlCodeSanction) as iCentral,

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE structureId NOT IN (SELECT structure_id FROM $zDatabaseCommon.structurevoting WHERE structure_voting IN ('MEF CENTRAL','SG CENTRAL','ARMP CENTRAL','CSC CENTRAL') ) AND sanction IN('0','00','34','40')) as iRegional,

		(SELECT COUNT(voteMerite_agentCerntralUserId) FROM $zDatabaseCommon.votemerite) as iVoteCentral,
		(SELECT COUNT(voteMerite_agentRegionalUserId) FROM $zDatabaseCommon.votemerite WHERE voteMerite_agentRegionalUserId >0) as iVoteRegional



		FROM $zDatabaseCommon.votemerite WHERE 1 ";

		if($_iDepartementId != ''){
			$zSql .= $zSqlDept ;
		}

		$zSql .= " LIMIT 0,1 ";

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->row();
		$zQuery->free_result(); 

		return $toRow;
	}



	public function getStatAll($_iDepartementId, $zLocalite){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;

		$zSqlDept = "";
		$zSqlDept1 = "";
		$zSqlDept2 = "";
		$zSqlDept3 = "";
		$zSqlCodeSanction = " AND sanction IN('0','00','34','40') ";

		if($_iDepartementId != ''){
			$zSqlDept .= " AND voteMerite_localite = '".$_iDepartementId."'" ;
			$zSqlDept1 .= " AND structure_dept = '".$_iDepartementId."'" ;
			$zSqlDept2 .= " AND structure_voting LIKE '%".$_iDepartementId." CENTRAL'" ;
			$zSqlDept3 .= " AND structure_voting LIKE '%".$_iDepartementId." REGIONAL'" ;
		} else {

			$zSqlDept2 .= " AND structure_voting LIKE '%CENTRAL'" ;
			$zSqlDept3 .= " AND structure_voting LIKE '%REGIONAL'" ;
		}
			
		/*$zSql= " SELECT COUNT(voteMerite_id) as iNombreTotal,
		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE 1  AND structureId IN (SELECT structure_id FROM common.structurevoting WHERE structure_dept = '".$_iDepartementId."' ) AND sanction IN('0','00','34','40')) as iCountTotal,

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE structureId IN ( SELECT structure_id FROM common.structurevoting 
		WHERE 1  $zSqlDept2 ) AND sanction IN('0','00','34','40')) as iCentral,

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE structureId IN ( SELECT structure_id FROM common.structurevoting 
		WHERE 1  $zSqlDept3 ) AND sanction IN('0','00','34','40') ) as iRegional,

		(SELECT (COUNT(voteMerite_agentCerntralUserId)+COUNT(voteMerite_agentRegionalUserId))
		FROM $zDatabaseCommon.votemerite) as iVoteCentral,
		(SELECT (COUNT(voteMerite_agentCerntralUserId)+COUNT(voteMerite_agentRegionalUserId)) AS iCompteRegional
		FROM $zDatabaseCommon.votemerite WHERE voteMerite_agentRegionalUserId >0) as iVoteRegional
		FROM $zDatabaseCommon.votemerite WHERE 1 ";*/

		
		/*$zSql= " SELECT COUNT(voteMerite_id) as iNombreTotal,
		(SELECT COUNT(c.id) AS DGT FROM rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id
		INNER JOIN common.structurevoting s ON s.structure_path = t.path
		WHERE 1 $zSqlDept1 $zSqlCodeSanction) as iCountTotal,

		(SELECT COUNT(c.id) AS DGT FROM  rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id INNER JOIN common.structurevoting s ON s.structure_path = t.path WHERE 1 $zSqlDept1 $zSqlDept2 $zSqlCodeSanction) as iCentral,

		(SELECT COUNT(c.id) AS DGT FROM  rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id INNER JOIN common.structurevoting s ON s.structure_path = t.path WHERE 1 $zSqlDept1 $zSqlDept3 $zSqlCodeSanction) as iRegional,

		COUNT(voteMerite_agentCerntralUserId) as iVoteCentral,
		(SELECT COUNT(voteMerite_agentRegionalUserId) FROM $zDatabaseCommon.votemerite WHERE 1 AND voteMerite_agentRegionalUserId >0 $zSqlDept LIMIT 0,1) as iVoteRegional
		FROM $zDatabaseCommon.votemerite WHERE 1 ";*/

		$zSql= " SELECT 

		(SELECT COUNT(c.id) FROM rohi.candidat c WHERE structureId IN (SELECT structure_id FROM common.structurevoting WHERE 1 $zSqlDept2) $zSqlCodeSanction) as iCentral,

		(SELECT COUNT(c.id) AS DGT FROM  rohi.candidat c INNER JOIN rohi.t_structure t ON c.structureId = t.child_id INNER JOIN common.structurevoting s ON s.structure_path = t.path WHERE 1 $zSqlDept1 $zSqlDept3 $zSqlCodeSanction) as iRegional,

		(SELECT COUNT(voteMerite_agentCerntralUserId) FROM $zDatabaseCommon.votemerite WHERE 1 $zSqlDept LIMIT 0,1) as iVoteCentral,
		(SELECT COUNT(voteMerite_agentRegionalUserId) FROM $zDatabaseCommon.votemerite WHERE 1 AND voteMerite_agentRegionalUserId >0 $zSqlDept LIMIT 0,1) as iVoteRegional
		FROM $zDatabaseCommon.votemerite WHERE 1 ";



		if($_iDepartementId != ''){
			$zSql .= $zSqlDept ;
		}

		$zSql .= " LIMIT 0,1 ";

		//echo $zSql;


		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->row();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function getAgentVoting($_iChildId, $_iRattache){
		
		global $db;

		$zDatabaseCommon =  $db['common']['database'] ;
		//$toCandidatUser = array();
		if($_iRattache==0){
			$zSql= " SELECT  t_structure_new.child_id
					 FROM    (SELECT * FROM t_structure
							 ORDER BY parent_id, child_id) t_structure_new,
							(SELECT @pv := ".$_iChildId.") initialisation
					 WHERE   FIND_IN_SET(parent_id, @pv)
					 AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0

					 UNION
					 SELECT child_id FROM rohi.t_structure WHERE child_id =".$_iChildId." ";

			$zQuery = $this->db->query($zSql);

			$toList = $zQuery->result_array();

			
			$zQuery->free_result(); 

			$tzLists	=	array() ;
			array_push($tzLists,"'".$_iChildId."'") ;
			foreach($toList as $oList){
				array_push($tzLists,"'".$oList["child_id"]."'") ;
			}
			$zList		=	implode(",",$tzLists);

			$zSql= "select *
					from rohi.candidat a
					inner join rohi.t_structure b
					on a.structureId = b.child_id
					where structureId in ($zList) 
					AND		sanction IN('0','00','34','40')
					   ";
			$zQuery						= $this->db->query($zSql);
			$toCandidatUser				= $zQuery->result_array();
			$zQuery->free_result(); 

			/*print_r ($toCandidatUser);*/
			


		} else {
			
			$zSql= "select *
					from rohi.candidat a
					
					where structureId  IN (".$_iChildId.") 
					AND		sanction IN('0','00','34','40')";
			$zQuery						= $this->db->query($zSql);
			$toCandidatUser				= $zQuery->result_array();
			$zQuery->free_result();

		}

		//die("tojo");

		return $toCandidatUser;
	}

	

	public function getListeLaureat($zDepartementLocalite){
		
		global $db;
		
		
		$zDatabaseCommon =  $db['common']['database'] ;
		$zDatabaseRohi =  $db['rohi']['database'] ;
		$zSql= " SELECT * FROM ".$zDatabaseCommon.".laureat l 
		INNER JOIN ".$zDatabaseRohi.".candidat c ON l.laureat_matricule = c.matricule 
		INNER JOIN ".$zDatabaseRohi.".t_structure t ON t.child_id = c.structureId 
		WHERE laureat_voting =  '". $zDepartementLocalite."' AND sanction IN('0','00','34','40')";

		//echo $zSql;

		$zQuery = $this->db->query($zSql);

		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

			
		return $toRow;
	}

	public function getTestCandidatCentral($_this, $_iUserId, $_iReturn=0){
		
		global $db;

		$oCandidat = $_this->candidat->get_by_user_id($_iUserId);
		
		$zDatabaseCommon =  $db['common']['database'] ;
		//$zSql= " SELECT structure_voting FROM ".$zDatabaseCommon.".structurevoting WHERE structure_path like '".$oCandidat[0]->path."'";
		$zSql= " SELECT structure_voting FROM ".$zDatabaseCommon.".structurevoting WHERE structure_id ='".$oCandidat[0]->structureId."' ";

		$zQuery = $this->db->query($zSql);

		$oRow = $zQuery->row();
		$zQuery->free_result(); 

		$iTestCentral = 0;

		if(is_object($oRow)> 0){
			
			$oTest = explode(" ",$oRow->structure_voting);
			if($oTest[1] == 'CENTRAL'){
				$iTestCentral = 1;
			}
		}

		if($_iReturn==0){
			return $iTestCentral;
		} else {
			return $oTest[0];
		}

		
	}


	public function getCandidatVoting($_this, $_iUserId){
		
		global $db;
		
		$toRow = $this->getPointDate();
		$iTestCentral = $this->getTestCandidatCentral($_this, $_iUserId);

		$iVote = 1;

		if(sizeof($toRow)>0){
			$zDatabaseCommon =  $db['common']['database'] ;
			$zSql= " SELECT * FROM ".$zDatabaseCommon.".votemerite WHERE voteMerite_userId = " . $_iUserId;

			$zQuery = $this->db->query($zSql);

			$toRow = $zQuery->result_array();
			$zQuery->free_result(); 

			if(sizeof($toRow)> 0){
				$iVote = 1;
			} else {
				$iVote = 0;
			}
		}
		
		return $iVote;
	}


	public function getDepartementCandidatVoting(){
		
		global $db;
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT t_structure.path as path FROM rohi.candidat INNER JOIN rohi.t_structure ON child_id = structureId WHERE candidat.user_id = " . $_SESSION["userdata"]["id"];

		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result(); 

		$zPath = $oRowResult['path'];

		$toPath = explode("/", $zPath);

		$zWordSeek = ""; 

		if(isset($toPath[2]) && $toPath[2]!=""){
			
			$zWordSeek = $toPath[2];

			if($toPath[1]=="SG"){
				$zWordSeek = $toPath[1];
			} 

		} else {
			if(isset($toPath[1]) && $toPath[1]!=""){ 
				$zWordSeek = $toPath[1];
			} else {
				$zWordSeek = $toPath[0];
			}
		}
		
		return $zWordSeek;
	}

	public function getDepartementId(){
		
		global $db;

		$zWordSeek = $this->getDepartementCandidatVoting();
		$zDatabaseCommon =  $db['common']['database'] ;
		$zSql= " SELECT child_id, child_libelle,path FROM t_structure WHERE niveau = 'DEPT' AND t_structure.path LIKE '%" . $zWordSeek . "%'" ;

		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result();

		$iDepartementId = $oRowResult['child_id'];
		
		return $iDepartementId;
	}

	public function get_all_list_candidat($_oUser,$_oCandidat,$_iUserId, $_iCompteActif,$zTerm= "aa",$_iFiltre=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zWordSeek = $this->getDepartementCandidatVoting();
		
		$zSql= "SELECT candidat.* from $zDatabaseOrigin.candidat 
		INNER JOIN $zDatabaseOrigin.t_structure ON t_structure.child_id = candidat.structureId
		WHERE (nom LIKE '%$zTerm%' OR prenom LIKE '%$zTerm%' OR cin LIKE '%$zTerm%'  OR matricule LIKE '%$zTerm%')";
		
		$zSql .= " AND t_structure.path LIKE '%" . $zWordSeek . "%'" ; 
			

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}


	public function getIDepartementId(){
		
		$zSql= "SELECT * FROM common.departementvoting WHERE structureId = " . $_iId;
		
		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result(); 
		
		return $oRowResult['id'];

	}

	public function getMesCandidats($electeur_user_id){
		$zSql= " " ;
		$query = $this->db->query($zSql);
		return $query->result_array();
	}

	public function voterCandidat($candidat_user_id,$electeur_user_id,$date_vote){
		$zSql= " ";

		$this->db->query($zSql);
	}

	public function checkIfDejaVote($candidat_user_id,$electeur_user_id){
		$zSql= " ";
		$query = $this->db->query($zSql);
		$results	=	$query->result_array();
		
	}
}
?>