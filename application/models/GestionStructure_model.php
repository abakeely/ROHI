<?php
class GestionStructure_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->model('Candidat_model','CandidatService');
	}
	
	public function getDetailStructure($_child_id){
		$sql= " select * from t_structure where child_id = '".$_child_id."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getDetailStructure1($_child_id){
		$sql= " SELECT 
					(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,autorite_id) > 0 GROUP BY b.child_id) autorite,
					(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,evaluateur_id) > 0 GROUP BY b.child_id) evaluateur,
					(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,respers_id) > 0 GROUP BY b.child_id) responsablepers
				FROM rohi.t_structure b
				where child_id ='".$_child_id."'";

		$query = $this->db->query($sql);
		return $query->row_array();
	}


	public function structures(){
		
		$sql = "select * from t_structure order by child_id asc" ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function renderMyStructure($child_id){
		//$child_id		=	"3";
		$structure 	=	$this->getDetailStructure($child_id);

		$sql ="SELECT t_structure_new.* 
		         FROM (SELECT * FROM t_structure  ORDER BY parent_id, child_id) t_structure_new, 
				(SELECT @pv := '".$structure["child_id"]."') initialisation 
				 WHERE FIND_IN_SET(parent_id, @pv) AND LENGTH(@pv := CONCAT(@pv, ',', child_id))>0  
			  UNION
			  SELECT * FROM t_structure WHERE child_id ='".$structure["child_id"]."'  
			   " ;
		//$sql 		=	"SELECT * FROM rohi.t_structure WHERE child_id IN ('204','987','3','18')  " ;
		$query		=	$this->db->query($sql);
		$returns	=	array() ;
		$results	=	$query->result_array(); 

		$returns	=	$this->buildTree($results,$structure["parent_id"]); 

		return $returns;
	}
	
	public function getStructures($parent_id){
		//$parent_id		=	"3";
		$sql ="SELECT  *,
					(SELECT COUNT(*) FROM rohi.candidat WHERE structureId =t_structure_new.child_id and sanction IN('00','34','40') ) nb,
					(SELECT DISTINCT id FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) candidat_id,
					(SELECT DISTINCT concat('IM:' , matricule,'- ',nom,' ',prenom) FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) candidat_nom,
					(SELECT DISTINCT type_photo FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) type_photo
				FROM    t_structure t_structure_new
				where child_id ='".$parent_id."'
				union
				SELECT  t_structure_new.*,
					(SELECT COUNT(*) FROM rohi.candidat WHERE structureId =t_structure_new.child_id and sanction IN('00','34','40')) nb,
					(SELECT DISTINCT id FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) candidat_id,
					(SELECT DISTINCT concat('IM:' , matricule,'- ',nom,' ',prenom) FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) candidat_nom,
					(SELECT DISTINCT type_photo FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) type_photo
				FROM    (SELECT * FROM t_structure
						 ORDER BY parent_id, child_id) t_structure_new,
						(SELECT @pv := '".$parent_id."') initialisation
				WHERE   FIND_IN_SET(parent_id, @pv)
				AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
				" ;
		//echo $sql;die;
		$query		=	$this->db->query($sql);
		$returns	=	array() ;
		$results	=	$query->result_array(); 
		//print_r($results);die;
		foreach($results as $result ){
				
			$return					=	array();
			$total					=	$this->ajaxCountAgentTree(array(),$result["child_id"]) ;
			$return					=	$result;
			$return["nb"]			=	$return["nb"] ."-" . ($return["nb"] + $total["nb"]);
			$return["content"]		=	$return["child_libelle"] ."  ";
			$return["content"]		=	$return["content"] ."              " .$return["candidat_nom"];
			array_push($returns,$return) ;
		}
		return $returns;
		//return $query->result_array();
	}

	public function getChildByParent($district_id, $parent_id, $tree_type){

			$sql ="
					SELECT *
					FROM(
							SELECT  *,
								(SELECT COUNT(*) FROM rohi.candidat WHERE structureId =t_structure_new.child_id and sanction IN('00','34','40') ) nb,
								(SELECT DISTINCT id FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) candidat_id,
								(SELECT DISTINCT type_photo FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) type_photo
							FROM    t_structure t_structure_new
							where child_id ='".$parent_id."'
							union
							SELECT  t_structure_new.*,
								(SELECT COUNT(*) FROM rohi.candidat WHERE structureId =t_structure_new.child_id and sanction IN('00','34','40')) nb,
								(SELECT DISTINCT id FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) candidat_id,
								(SELECT DISTINCT type_photo FROM rohi.candidat WHERE user_id = t_structure_new.premier_responsable_id LIMIT 1) type_photo
							FROM    (SELECT * FROM t_structure
									 ORDER BY parent_id, child_id) t_structure_new,
									(SELECT @pv := '".$parent_id."') initialisation
							WHERE   FIND_IN_SET(parent_id, @pv)
							AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
					) AS t
					WHERE t.parent_id='".$parent_id."'
					
				" ;

		$query			=	$this->db->query($sql);
		$returns		=	array() ;
		$results		=	$query->result_array(); 
		$departements	=	array();
		$directions		=	array();
		$services		=	array();
		$divisions		=	array();
		$bureaux		=	array();
		//print_r($sql);die;
		foreach($results as $result ){
			$return					=	array();
			$total					=	$this->ajaxCountAgentTree(array(),$result["child_id"]) ;
			$return					=	$result;
			$return["nb"]			=	$return["nb"] ."-" . ($return["nb"] + $total["nb"]);
			$datas					=	array();
			if($result["child_id"]!=$parent_id){
				if($result["niveau"] == "DEPT" ){
					array_push($departements,$return) ;
				}elseif($result["niveau"] == "DIR"){
					array_push($directions,$return) ;
				}elseif($result["niveau"] == "SCE" && $result["district_id"] == $district_id ){
					array_push($services,$return) ;
				}elseif($result["niveau"] == "DIV" && $result["district_id"] == $district_id){
					array_push($divisions,$return) ;
				}elseif($result["niveau"] == "BUR" && $result["district_id"] == $district_id){
					array_push($bureaux,$return) ;
				}
			}
		}
		$datas			=	array() ;
		$datas			=	array_merge($departements,$directions,$services,$divisions,$bureaux) ;
		return $datas;
    }
	
	public function getChild($district_id, $parent_id, $tree_type){

		$sql ="SELECT * FROM t_structure WHERE parent_id='".$parent_id."' " ;
		$query			=	$this->db->query($sql);
		$results		=	$query->result_array(); 
		
		return $results;
    }

	public function getListPays(){
		$sql= " select distinct pays_id, pays_libelle from t_pays  ";
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function getAllDepartement($parent_id,$tree_type){
		$sql= " select distinct pays_id, pays_libelle from rohi.t_pays  ";
		$query = $this->db->query($sql);
		return $query->result_array();
    }


	public function getStructureByDistrictid($district_id){
		$sql= " select distinct * from t_structure where district_id='".$district_id."'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function getDepartementByDistrictid($district_id){
		$sql		= 	" select distinct * from t_structure where niveau ='DEPT' and parent_id ='1'  ";
		$query 		= 	$this->db->query($sql);
		$toReturns 	=	$query->result_array();
		$toResults	=	array() ;
		for($iIndex = 0;$iIndex <=sizeof($toReturns);$iIndex ++){
			
			$nb_child	=	$this->isHasAchild($toReturns[$iIndex]["child_id"],$district_id);
			if( $nb_child > 0 ){
				array_push($toResults,$toReturns[$iIndex]) ;
			}
		}
		return $toResults;
		
    }

	public function getLocalite($parent_id,$type_localite){
		if($type_localite == "PROVINCE"){
			$sql= " select distinct province_id as localite_id, province_libelle as localite_libelle from t_provinces where pays_id = '".$parent_id."'  ";
			$query = $this->db->query($sql);
		}
		if($type_localite == "REGION"){
			$sql= " select distinct region_id as localite_id, region_libelle as localite_libelle from t_regions where province_id = '".$parent_id."'  ";
			$query = $this->db->query($sql);
		}
		if($type_localite == "DISTRICT"){
			$sql= " select distinct district_id as localite_id, district_libelle as localite_libelle from t_districts where region_id = '".$parent_id."'  ";
			$query = $this->db->query($sql);
		}
		return $query->result_array();
    }

	public function majStructureIdInCandidat($child_id,$type,$user_id){
		if( $type == "FONCTIONNAIRE" ){
			if( $child_id !=""){
				$sql			=  "UPDATE rohi.candidat SET structureId = '".$child_id."'  WHERE user_id = '".$user_id."'" ; 	
			}else{
				$sql			=  "UPDATE rohi.candidat SET structureId = ''  WHERE user_id ='".$user_id."' " ; 	
			}
		}else{
			
			if( $child_id !=""){
				$sql			=  "UPDATE rohi.candidat SET structureId = '".$child_id."'  WHERE user_id ='".$user_id."' " ; 	
			}else{
				$sql			=  "UPDATE rohi.candidat SET structureId = ''  WHERE user_id ='".$user_id."' " ; 	
			}	
		}
		$this->db->query($sql);
    }
	
	public function majStructureEnMasse($user_id,$child_id){
		if( $child_id !=""){
			$sql			=  "UPDATE rohi.candidat SET structureId = '".$child_id."'  WHERE user_id = '".$user_id."'" ; 	
			$this->db->query($sql);
		}
    }

	public function getParent($child_id,$tree_type){
		$sql= "		SELECT  p1.child_id AS child_id,
							p1.child_libelle AS libelle,
							p1.rang AS rang,
							p2.child_id AS parent_id_niveau_01,
							p2.child_libelle AS parent_libelle_niveau_01,
							p2.rang AS parent_rang_niveau_01,
							p3.child_id AS parent_id_niveau_02,
							p3.child_libelle AS parent_libelle_niveau_02,
							p3.rang AS parent_rang_niveau_02,
							p4.child_id AS parent_id_niveau_03,
							p4.child_libelle AS parent_libelle_niveau_03,
							p4.rang AS parent_rang_niveau_03
					FROM        t_structure p1
					LEFT JOIN   (SELECT child_id,child_libelle,parent_id,rang FROM t_structure WHERE rang IN('SCE','DIR','DEPT','SG','CAB','MIN')) p2 ON p1.parent_id = p2.child_id 
					LEFT JOIN   (SELECT child_id,child_libelle,parent_id,rang FROM t_structure WHERE rang IN('SCE','DIR','DEPT','SG','CAB','MIN')) p3 ON p2.parent_id = p3.child_id
					LEFT JOIN   (SELECT child_id,child_libelle,parent_id,rang FROM t_structure WHERE rang IN('SCE','DIR','DEPT','SG','CAB','MIN')) p4 ON p3.parent_id = p4.child_id 
					WHERE p1.child_id='".$child_id."'
				  ";

		$query	=	$this->db->query($sql);
		$result	=	$query->row_array();

		$parent	=	new stdClass() ;
		switch ($tree_type) {
			case $result["parent_rang_niveau_01"]:
				$parent->child_id		=	$result["parent_id_niveau_01"];
				$parent->child_libelle	=	$result["parent_libelle_niveau_01"];
				break;
			case $result["parent_rang_niveau_02"]:
				$parent->child_id		=	$result["parent_id_niveau_02"];
				$parent->child_libelle	=	$result["parent_libelle_niveau_02"];
				break;
			case $result["parent_rang_niveau_03"]:
				$parent->child_id		=	$result["parent_id_niveau_03"];
				$parent->child_libelle	=	$result["parent_libelle_niveau_03"];
				break;
		}
		return $parent;
    }

	public function findAllParent($child_id){
		
		$sql = "SELECT  @r AS _id,
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
						 SELECT  @r := $child_id,
								 @l := 0,
								 @cl := 0
						 ) vars,
						 t_structure h
				WHERE    @r <> 0" ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function findParent($child_id,$parent_rang){
		
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
						 SELECT  @r := 1125,
								 @l := 0,
								 @cl := 0
						 ) vars,
						 t_structure h
				WHERE    @r <> 0
				) AS table_parent
				WHERE parent_rang='".$parent_rang."'
				LIMIT 1" ;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getParentByDistrictid($district_id,$tree_type){

		$toStructures	=	$this->getStructureByDistrictid($district_id) ;

		$toParents		=	array() ;
		$tiKeys			=	array();
		for($iIndex = 0;$iIndex <=sizeof($toStructures);$iIndex ++){
			$oParent	=	$this->getParent($toStructures[$iIndex]["child_id"],$tree_type) ;
			$key		=	$oParent->child_id ;
			if(!in_array($key,$tiKeys) ){
				array_push($toParents,$oParent) ;
				array_push($tiKeys,$key) ;
			}
		}
		return $toParents;
    }
	

	public function createStructure($oStructure){

		$sql= " INSERT INTO rohi.t_structure (
						child_libelle,
						parent_id,
						parent_libelle,
						rang,
						sigle,
						path,
						soa_code,
						district_id,
						region_id,
						province_id,
						pays_id
				) 
				VALUES
				(
						".$this->db->escape($oStructure['child_libelle']).",
						'".$oStructure['parent_id']."',
						".$this->db->escape($oStructure['parent_libelle']).",
						'".$oStructure['rang']."',
						'".$oStructure['sigle']."',
						'".$oStructure['path']."',
						'".$oStructure['soa_code']."',
						'".$oStructure['district_id']."',
						'".$oStructure['region_id']."',
						'".$oStructure['province_id']."',
						'".$oStructure['pays_id']."'
				 ) ;
			  ";
		//echo $sql;die;
		$this->db->query($sql);
    }
	
	public function updateStructure($oStructure){
		
		$sql	=	"UPDATE  rohi.t_structure
					 SET	child_libelle	=".$this->db->escape($oStructure['child_libelle'])." ,
							rang			='".$oStructure['rang']."' ,
							sigle			='".$oStructure['sigle']."' ,
							path			='".$oStructure['path']."' ,
							soa_code		='".$oStructure['soa_code']."' 
					 WHERE child_id		='".$oStructure['child_id']."'  " ;
		$this->db->query($sql);

    }


	public function rapprochementUnitaire($oStructure){
		
		//Autorités
		if ( isset($oStructure['autorite_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
			             SET autorite_id ='".$oStructure['autorite_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['autorite_id']."' AND userCompte_compteId ='3' ";
			$this->db->query($sql);
			
			$sql=	" INSERT INTO gcap.usercompte(userCompte_userId,userCompte_compteId,userCompte_dateDebut,userCompte_actif) values ('".$oStructure['autorite_id']."',3, NOW(),'0') ";
			$this->db->query($sql);
		}	
		//Evaluateur
		if ( isset($oStructure['evaluateur_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
						 SET evaluateur_id =CONCAT(IFNULL(evaluateur_id,premier_responsable_id),',','".$oStructure['evaluateur_id']."')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['evaluateur_id']."' AND userCompte_compteId ='5' ";
			$this->db->query($sql);
			
			$sql=	" INSERT INTO gcap.usercompte(userCompte_userId,userCompte_compteId,userCompte_dateDebut,userCompte_actif) values ('".$oStructure['evaluateur_id']."',5, NOW(),'0') ";
			$this->db->query($sql);
		}
		//Responsable pers
		if ( isset($oStructure['respers_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
			             SET respers_id =CONCAT(IFNULL(respers_id,premier_responsable_id),',','".$oStructure['respers_id']."')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['respers_id']."' AND userCompte_compteId ='2' ";
			$this->db->query($sql);
			
			$sql=	" INSERT INTO gcap.usercompte(userCompte_userId,userCompte_compteId,userCompte_dateDebut,userCompte_actif) values ('".$oStructure['respers_id']."',2, NOW(),'0') ";
			$this->db->query($sql);
		}
		//Premier Responsable
		if ( isset($oStructure['premier_responsable_id']) ){
			$sql	=	"UPDATE  rohi.t_structure
			             SET premier_responsable_id ='".$oStructure['premier_responsable_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
		}
		//Agent et Autorites
		if ( isset($oStructure['user_id']) && isset($oStructure['autorite_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
			             SET autorite_id ='".$oStructure['autorite_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['autorite_id']."' AND userCompte_compteId ='3' ";
			$this->db->query($sql);
			
			$sql=	" INSERT INTO gcap.usercompte(userCompte_userId,userCompte_compteId,userCompte_dateDebut,userCompte_actif) values ('".$oStructure['autorite_id']."',3, NOW(),'0') ";
			$this->db->query($sql);
		}
		//Agent et Respers
		if ( isset($oStructure['user_id']) && isset($oStructure['respers_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
			             SET respers_id =CONCAT(IFNULL(respers_id,premier_responsable_id),',','".$oStructure['respers_id']."')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['respers_id']."' AND userCompte_compteId ='2' ";
			$this->db->query($sql);
			
			$sql=	" INSERT INTO gcap.usercompte(userCompte_userId,userCompte_compteId,userCompte_dateDebut,userCompte_actif) values ('".$oStructure['respers_id']."',2, NOW(),'0') ";
			$this->db->query($sql);
		}
		//Agent et Evaluateur
		if ( isset($oStructure['user_id']) && isset($oStructure['evaluateur_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
						 SET evaluateur_id =CONCAT(IFNULL(evaluateur_id,premier_responsable_id),',','".$oStructure['evaluateur_id']."')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['evaluateur_id']."' AND userCompte_compteId ='5' ";
			$this->db->query($sql);
			
			$sql=	" INSERT INTO gcap.usercompte(userCompte_userId,userCompte_compteId,userCompte_dateDebut,userCompte_actif) values ('".$oStructure['evaluateur_id']."',5, NOW(),'0') ";
			$this->db->query($sql);
		}
		//Agent et premier responsable
		if ( isset($oStructure['user_id']) && isset($oStructure['premier_responsable_id']) ){
			$sql	=	"UPDATE  rohi.t_structure
			             SET premier_responsable_id ='".$oStructure['premier_responsable_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
		}
    }
	
	public function detachementUnitaire($oStructure){
		
		//Autorités
		if ( isset($oStructure['autorite_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
						 SET autorite_id =REPLACE(autorite_id,'".$oStructure['autorite_id']."','0')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['autorite_id']."' AND userCompte_compteId ='3' ";
			$this->db->query($sql);
		}	
		//Evaluateur
		if ( isset($oStructure['evaluateur_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
						 SET evaluateur_id =REPLACE(evaluateur_id,'".$oStructure['evaluateur_id']."','0')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['evaluateur_id']."' AND userCompte_compteId ='5' ";
			$this->db->query($sql);
			
		}
		//Responsable pers
		if ( isset($oStructure['respers_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
						 SET respers_id =REPLACE(respers_id,'".$oStructure['respers_id']."','0')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
			
			$sql=	" DELETE FROM gcap.usercompte WHERE userCompte_userId='".$oStructure['respers_id']."' AND userCompte_compteId ='2' ";
			$this->db->query($sql);
			
		}
		//Premier Responsable
		if ( isset($oStructure['premier_responsable_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
						 SET premier_responsable_id =REPLACE(premier_responsable_id,'".$oStructure['premier_responsable_id']."','0')
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
		}
		
		//Agent
		if ( isset($oStructure['user_id']) ){
			$sql	=	"UPDATE  rohi.candidat 
						 SET structureId ='',
						     path =''
						 WHERE user_id ='".$oStructure['user_id']."'" ;
			$this->db->query($sql);
		}
		
    }

	public function ajaxCountAgent($parameters,$child_id){
		$sql= " select count(*) as nb_records from candidat where structureId='".$child_id."' ";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$query = $this->db->query($sql); 
		return $query->row_array();
    }

	public function ajaxCountAgent1($parameters,$child_id){
		$sqllist	=	"SELECT  t_structure_new.child_id
						FROM    (SELECT * FROM t_structure
								 ORDER BY parent_id, child_id) t_structure_new,
								(SELECT @pv := '".$child_id."') initialisation
						WHERE   FIND_IN_SET(parent_id, @pv)
						AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0";
		$query		=   $this->db->query($sqllist);
		$toList		=   $query->result_array();
		$tzLists	=	array() ;
		array_push($tzLists,"'".$child_id."'") ;
		foreach($toList as $oList){
			array_push($tzLists,"'".$oList["child_id"]."'") ;
		}
		$zList		=	implode(",",$tzLists);
		$sql= " select count(id) as nb_records
				from rohi.candidat
				where structureId in ($zList) ";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$query = $this->db->query($sql); 
		return $query->row_array();
    }


	public function ajaxGetAgent($parameters,$ofset =0, $limit =100000000,$child_id){
		$sql= " SELECT * 
		          FROM rohi.candidat a  
				  LEFT JOIN rohi.t_structure b 
				  ON a.user_id = b.premier_responsable_id 
				  WHERE structureId='".$child_id."' 
				   ";
		if( count($parameters) > 0 ){
			$sql	=	$sql . " AND " . implode(" AND ",$parameters) ;
		} 
		$sql	=	$sql . " LIMIT $ofset , $limit ";

		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function ajaxGetAgent1($parameters,$ofset =0, $limit =100000000,$child_id){
		$sqllist	=	"SELECT  t_structure_new.child_id
						FROM    (SELECT * FROM t_structure
								 ORDER BY parent_id, child_id) t_structure_new,
								(SELECT @pv := '".$child_id."') initialisation
						WHERE   FIND_IN_SET(parent_id, @pv)
						AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0";
		$query		=   $this->db->query($sqllist);
		$toList		=   $query->result_array();
		$tzLists	=	array() ;
		array_push($tzLists,"'".$child_id."'") ;
		foreach($toList as $oList){
			array_push($tzLists,"'".$oList["child_id"]."'") ;
		}
		$zList		=	implode(",",$tzLists);
		$sql= " select *
				from rohi.candidat a
				inner join rohi.t_structure b
				on a.structureId = b.child_id
				where structureId in ($zList) 
				AND		sanction IN('00','34','40')
				   ";
		if( count($parameters) > 0 ){
			$sql	=	$sql . " AND " . implode(" AND ",$parameters) ;
		} 
		$sql	=	$sql . " LIMIT $ofset , $limit ";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();
    }
	
	public function ajaxGetAgent2($child_id){
		$sql= " SELECT * 
		          FROM rohi.candidat a  
				  WHERE structureId='".$child_id."' 
				  AND sanction IN ('00','34','40')
				   ";

		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function ajaxCountAgentTree($parameters,$child_id){
		$sql= " select count(id) as nb
				from rohi.candidat
				where structureId in (SELECT  t_structure_new.child_id
				FROM    (SELECT * FROM t_structure
						 ORDER BY parent_id, child_id) t_structure_new,
						(SELECT @pv := '".$child_id."') initialisation
				WHERE   FIND_IN_SET(parent_id, @pv)
				AND		sanction IN('00','34','40')
				AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0) ";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$query = $this->db->query($sql); 
		return $query->row_array();
    }


	public function ajaxGetDetailAgent($user_id){
		$sql= " SELECT * ,
				CASE
					WHEN sanction = 0  THEN 'En activite'
					WHEN sanction = 34 THEN 'Contrat expire'
					WHEN sanction = 40 THEN 'Personnel exterieur'
				END AS sanction_libelle,
				floor((curdate()-date_naiss)/10000) as age,
				(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,autorite_id) > 0 GROUP BY b.child_id) autorite,
				(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,evaluateur_id) > 0 GROUP BY b.child_id) evaluateur,
				(SELECT GROUP_CONCAT( CONCAT (matricule,'-',nom,'  ',prenom) SEPARATOR ';' ) FROM rohi.candidat WHERE  FIND_IN_SET (user_id,respers_id) > 0 GROUP BY b.child_id) responsablepers
				FROM rohi.candidat a
				INNER JOIN rohi.t_structure b
				ON a.structureId = b.child_id
				WHERE user_id='".$user_id."' ";
		$query = $this->db->query($sql);
	//	echo $sql;die;
		return $query->row_array();
    }

	
	public function majSituationAgent($toInfoAgents){
		$sql	=	"   UPDATE 
							rohi.candidat 
						SET
							nom						= ".$this->db->escape($toInfoAgents["nom"]).",
							prenom					= ".$this->db->escape($toInfoAgents["prenom"]).",
							poste					= ".$this->db->escape($toInfoAgents["poste"]).",
							phone					= '".$toInfoAgents["phone"]."'
						 WHERE user_id='".$toInfoAgents["user_id"]."' ";

		$this->db->query($sql);
	}

	public function manageDecisionConges($toDecisions,$operation){
		if($operation =="edit"){
			$sql	=	"   UPDATE 
							gcap.decision 
						SET
							decision_annee		= ".$this->db->escape($toDecisions["decision_annee"]).",
							decision_numero		= ".$this->db->escape($toDecisions["decision_numero"])."
						WHERE decision_userId	='".$toDecisions["decision_userId"]."'
						  AND decision_id		='".$toDecisions["decision_id"]."'";
		}
		if($operation =="del"){
			$sql	=	"   DELETE 
							  FROM gcap.decision 
						     WHERE decision_id	='".$toDecisions["decision_id"]."'";
		}

		$this->db->query($sql);
	}

	public function manageDetailDeMesDecisions($toDetailDecisions,$operation){
		if($operation =="edit"){
			$sql	=	"	UPDATE 
								gcap.gcap 
						    SET
								gcap_lieuJouissance	= ".$this->db->escape($toDetailDecisions["gcap_lieuJouissance"])."
						    WHERE gcap_id			='".$toDetailDecisions["gcap_id"]."'
						  ";
		}
		if($operation =="del"){
			$sql	=	"   DELETE 
							  FROM gcap.gcap 
						     WHERE decision_id	='".$toDetailDecisions["decision_id"]."'";
		}

		$this->db->query($sql);
	}

	public function getAllChildrenByParentId($parent_id){
		
		$sql= " SELECT       p1.*
				FROM        t_structure p1
				LEFT JOIN   t_structure p2 ON p2.child_id = p1.parent_id 
				LEFT JOIN   t_structure p3 ON p3.child_id = p2.parent_id 
				LEFT JOIN   t_structure p4 ON p4.child_id = p3.parent_id  
				LEFT JOIN   t_structure p5 ON p5.child_id = p4.parent_id  
				LEFT JOIN   t_structure p6 ON p6.child_id = p5.parent_id
				WHERE       $parent_id IN (p1.child_id,p1.parent_id, p2.parent_id, p3.parent_id,  p4.parent_id, p5.parent_id,  p6.parent_id) ";

		$query = $this->db->query($sql);

		return $query->result_array();
    }


	public function isHasAchild($chil_id,$district_id){

		$sql= " SELECT  COUNT(*) AS total_child
				FROM    (SELECT * FROM t_structure
						 ORDER BY parent_id, child_id) t_structure_new,
						(SELECT @pv := '".$chil_id."') initialisation
				WHERE   FIND_IN_SET(parent_id, @pv)
				AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
				AND district_id='".$district_id."'

				";		
		$query				=	$this->db->query($sql);
		$result				=	$query->row_array() ;
		return $result ["total_child"];
    }
	
	public function isHasParent($chil_id,$district_id){

		$sql= " SELECT  COUNT(*) AS total_child
				FROM    t_structure
				WHERE   chil_id 

				";		
		$query				=	$this->db->query($sql);
		$result				=	$query->row_array() ;
		return $result ["total_child"];
    }

	public function is_in_district($parent_id,$district_id){
		$sql= " SELECT COUNT(*) as total_child FROM t_structure WHERE parent_id='".$parent_id."' AND district_id='".$district_id."' ";

		$query				=	$this->db->query($sql);
		$result				=	$query->row_array() ;
		return $result ["total_child"];
    }


	public function buildTree( array $elements, $parentId = 0) {

		$branch = array();
		foreach ($elements as $element) {
		//	echo "ddd";
			if ($element['parent_id'] == $parentId) {	
				$return				=	array() ;
				$return["id"]		=	$element["child_id"] ;
				$return["text"]		=	$element["child_libelle"] ;
				$children			=	$this->buildTree($elements, $element['child_id']);
				if (sizeof($children) >0) {
					$return['children'] = $children;
				}
				$branch[] = $return;
			}
		}
		if( sizeof($branch) > 0 ){
			return $branch;
		}
		
	}

	public function getCandidatByUserId($user_id){
		global $db;
		if($user_id!=""){
			$sql		= "select * from rohi.candidat where user_id = ".$user_id;
			$query		= $this->db->query($sql);
			$row		= $query->row_array();
			$query->free_result(); // The $query result object will no longer be available
			return $row;
		}
		
	}

	public function getCandidatByMatricule($matricule){
		global $db;
		if($matricule!=""){
			$sql		= "select * from rohi.candidat where matricule = ".$matricule;
			$query		= $this->db->query($sql);
			$row		= $query->row_array();
			$query->free_result(); // The $query result object will no longer be available
			return $row;
		}
		
	}
	public function statistiqueByStructure(){
		global $db;

		$returns			= array();
		$iAnnee	=	"2020" ;
		//for ($iAnnee = 2015;$iAnnee<2020;$iAnnee++){
			for( $iMois = 1 ;$iMois < 2 ; $iMois ++ ){
				if($iMois < 10 ){
					$iMois			= "0".$iMois;
				}
				$sql				= "  SELECT distinct agent_matricule, 
											agent_nom, agent_prenoms, corps_code, soa,mois,exercice
											FROM archives.mission_all_".$iMois."_".$iAnnee;
				$sql				= $sql . " where corps_code in ('E02P','E03Z','E02K') and (soa like '00-25%' or soa like '00-25%') ";
				$query				= $this->db->query($sql);
				$results			= $query->result_array();
				echo "<table>";
				foreach ( $results as $result ){
					echo "<tr>";
					$return			=	$result;
					array_push($returns,$return) ;
					echo "<td>".$return["agent_matricule"]."</td><td>".$return["agent_nom"]."</td><td>".$return["agent_prenoms"]."</td><td>".$return["corps_code"]."</td><td>".$return["soa"]."</td><td>".$return["mois"]."</td><td>".$return["exercice"]."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		//}
		die;
		$query->free_result();
		return $returns;
		
		
	}

	public function ajaxGridGetStructure($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	" select * FROM rohi.t_structure where ";
		if( sizeof($parameters) > 0 ){
			$sql	=	$sql . implode(" and ", $parameters) ;	
		}
		$sql= $sql . " limit $ofset , $limit ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_stat_group_by($grouper,$sevice){
		//$where = '';
		//if($sevice)
			//$where = " where service = $sevice";
		$where = " where (sanction = 0 or sanction = 34 or sanction ='40') AND matricule NOT LIKE '%STG%'";
		//$where .= " WHERE (sanction='0' or sanction='' or sanction='00' or sanction='34' or sanction IS NULL)  " ;
		//$where .= " AND  ( $grouper IS NOT NULL OR $grouper<>'') " ;
		//$where .= " WHERE 1=1  " ;
		if( $grouper == "region_id" || $grouper == "district_id" || $grouper == "province_id" ){
			$sql= "SELECT b.$grouper AS grouper,  COUNT(a.user_id) AS nb  FROM candidat a INNER JOIN t_structure b ON a.structureId = b.child_id $where  GROUP BY b.$grouper   ORDER BY nb DESC";
		}else{
			$sql= "SELECT a.$grouper AS grouper,  COUNT(a.user_id) AS nb  FROM candidat a INNER JOIN t_structure b ON a.structureId = b.child_id $where GROUP BY a.$grouper   ORDER BY nb DESC";
		}
		//echo $sql;die;
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}

	public function get_stat_group_by_structure($grouper,$sevice){
		
		$where .= " WHERE (sanction='00' or sanction='34' or sanction ='40' )  " ;
		//$where .= " AND  ( $grouper IS NOT NULL OR $grouper<>'') " ;
		
		$sql=" SELECT $grouper grouper,
		           COUNT(user_id) AS nb,
				   departement as structure_libelle,
				   departement as structure_sigle
			FROM(
			SELECT a.user_id,
				  F_GET_PARENT(a.structureId,'DEPT') AS departement
			FROM rohi.candidat a
			WHERE (a.sanction ='00' OR a.sanction ='34' or sanction ='40')
			AND matricule NOT LIKE '%STG%'
			) AS t_new 
			GROUP BY departement";


		/*$sql=" SELECT  if(a.$grouper=0, a.departement,a.$grouper)AS grouper,
					   if(b.libele is null, 
					     (select libele from departement where id =a.departement),
						 b.libele
						 ) as structure_libelle,
					   b.sigle_".$grouper." as structure_sigle,
					   COUNT(*) AS nb 
				 FROM candidat a
				 LEFT JOIN rohi.$grouper b
				 ON a.$grouper = b.id
				 
				 AND matricule!='STG'
				 GROUP BY a.$grouper
				 ORDER BY nb DESC";*/
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	
	public function getSigle($child_id){
		global $db;
		$sql		= "SELECT child_libelle FROM(
							SELECT @r AS id,
								 ( SELECT  @child_libelle := child_libelle FROM    t_structure WHERE   child_id = id ) AS child_libelle,
								 ( SELECT  @r := parent_id FROM    t_structure WHERE   child_id = id) AS parent_id,
								 @l := @l + 1 AS lvl
							FROM    ( SELECT  @r := '".$child_id."',@l := 0,@cl := 0 ) vars, t_structure h WHERE    @r <> 0 
							ORDER BY id ASC 
						) AS t
						ORDER BY lvl DESC  ";
		$query		= 	$this->db->query($sql);
		$rows		= 	$query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		$sigle		=	"" ;
		foreach($rows as $row){
			$sigle	=	$sigle . $row["child_libelle"].",";
		}
		return $sigle;
		
		
	}
	
	public function repartition(){
		$sql	=	"  select   substr(ifnull(soa,''),instr(soa,'-')+1,2)   ministere_payeur,
								substr(ifnull(uadm,''),instr(uadm,'-')+1,2)  ministere_employeur,
								COUNT(matricule) effectif
							 from rohi.candidat
							 where sanction in('00','34','40')
							 group by SUBSTR(IFNULL(soa,''),INSTR(soa,'-')+1,2),SUBSTR(IFNULL(uadm,''),INSTR(uadm,'-')+1,2) 
							  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getDetailRepartition($_ministere_payeur,$_ministere_employeur){
		$sql	=	"   select * from rohi.candidat where 1=1 "; 
		if($_ministere_payeur){
			$sql	= $sql.	"   and substr(ifnull(soa,''),instr(soa,'-')+1,2) ='".$_ministere_payeur."' "; 
		}else{
			$sql	= $sql.	"   and soa =''"; 
		}
		
		
		if($_ministere_employeur){
			$sql	= $sql.	"   and substr(ifnull(uadm,''),instr(uadm,'-')+1,2) ='".$_ministere_employeur."' "; 
		}else{
			$sql	= $sql.	"   and uadm is null"; 
		}
			$sql	= $sql.	"   and sanction in ('00','34','40') "; 
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getMinistereLibelle($_ministere_code){
		$sql	=	"  select * from t_ministere where min_code ='".$_ministere_code."' ";
		$query 	= 	$this->db->query($sql);
		$result	=	$query->row_array() ;
		return $result ["min_lib"];
	}
	
	public function getUadmLibelle($_uadm){
		$sql	=	"  select * from rohi.t_uadm where uadm_child like '%".trim($_uadm)."%'";
		$query 	= 	$this->db->query($sql);
		$result	=	$query->row_array() ;
		return $result ["titre"];
	}
	
	public function getNouveauMinistere($_ancien_ministere){
		$sql	=	"  select * from rohi.t_ministere where min_code = '".trim($_ancien_ministere)."'";
		$query 	= 	$this->db->query($sql);
		$result	=	$query->row_array() ;
		return $result ["nouveau_ministere"];
	}
	
	public function getMyStructure($_user_id){
		$sql	=	"  SELECT MIN(child_id) AS child_id FROM t_structure WHERE respers_id LIKE '%".$_user_id."%' ";
		//print_r($sql);die;
		$query 	= 	$this->db->query($sql);
		$result	=	$query->row_array() ; 
		return $result ["child_id"];
	}
	public function ajaxCountAgentPartantRetraite($parameters){
		$sql= " SELECT count(*) as nb_records
				FROM rohi.candidat a
				INNER JOIN rohi.t_structure b
				ON a.structureId = b.child_id
				where 1=1";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		}
		$query = $this->db->query($sql); 
		return $query->row_array();
    }

	public function getAgentPartantRetraite($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	" SELECT * ,
						floor((curdate()-date_naiss)/10000) as age
						FROM rohi.candidat a
						INNER JOIN rohi.t_structure b
						ON a.structureId = b.child_id
						where 
					";
		if( sizeof($parameters) > 0 ){
			$sql	=	$sql . implode(" and ", $parameters) ;	
		}
		$sql= $sql . " ORDER BY  date_naiss ASC";
		$sql= $sql . " limit $ofset , $limit ";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	public function getLibelle($child_id){
		global $db;
		if($child_id){
			$sql		=  "SELECT child_libelle FROM t_structure WHERE   child_id = $child_id ";
			$query		= 	$this->db->query($sql);
			$rows		= 	$query->result_array();
			$query->free_result(); // The $query result object will no longer be available
			$libelle	=	"" ;
			foreach($rows as $row){
				$query	=	$query . $row["child_libelle"].",";
			}
			return $query;
		}
		
		
	}
	
	public function getStructureRespers($_user_id){
		$sql= " select MIN(child_id) structure_res_pers from t_structure where respers_id LIKE '".$_user_id.",%' OR respers_id LIKE '%,".$_user_id.",%' OR respers_id LIKE '%,".$_user_id."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	


}
?>
