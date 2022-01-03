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


	public function structures(){
		
		$sql = "select * from t_structure order by child_id asc" ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function getStructures($parent_id){
		
		$sql = "SELECT      p1.*,
							(SELECT COUNT(*) FROM rohi.candidat WHERE structureid =p1.child_id) nb,
							(SELECT DISTINCT id FROM rohi.candidat WHERE user_id = p1.premier_responsable_id LIMIT 1) candidat_id,
							(SELECT DISTINCT type_photo FROM rohi.candidat WHERE user_id = p1.premier_responsable_id LIMIT 1) type_photo
				FROM        t_structure p1
				LEFT JOIN   t_structure p2 ON p2.child_id = p1.parent_id 
				LEFT JOIN   t_structure p3 ON p3.child_id = p2.parent_id 
				LEFT JOIN   t_structure p4 ON p4.child_id = p3.parent_id  
				LEFT JOIN   t_structure p5 ON p5.child_id = p4.parent_id  
				LEFT JOIN   t_structure p6 ON p6.child_id = p5.parent_id
				WHERE       $parent_id IN (p1.child_id,p1.parent_id, p2.parent_id, p3.parent_id,  p4.parent_id, p5.parent_id,  p6.parent_id) 
				ORDER BY 1,2,3,4,5,6" ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getChildByParent($district_id, $parent_id, $tree_type){

		$sql= " SELECT      p1.*,
							(SELECT COUNT(*) FROM rohi.candidat WHERE structureid =p1.child_id) nb,
							(SELECT DISTINCT id FROM rohi.candidat WHERE user_id = p1.premier_responsable_id LIMIT 1) candidat_id
				FROM        t_structure p1
				LEFT JOIN   t_structure p2 ON p2.child_id = p1.parent_id 
				LEFT JOIN   t_structure p3 ON p3.child_id = p2.parent_id 
				LEFT JOIN   t_structure p4 ON p4.child_id = p3.parent_id  
				LEFT JOIN   t_structure p5 ON p5.child_id = p4.parent_id  
				LEFT JOIN   t_structure p6 ON p6.child_id = p5.parent_id
				WHERE       $parent_id IN (p1.parent_id, p2.parent_id, p3.parent_id,  p4.parent_id, p5.parent_id,  p6.parent_id) 
				";
		
		$query		=	$this->db->query($sql);
		$results	=	$query->result_array(); 

		$returns	=	array() ;

		foreach($results as $result ){
			$has_child		=	$this->isHasAchild($result["child_id"],$district_id) ;
			if ( intval($has_child) > 0 && $result["parent_id"] == $parent_id) {
				array_push($returns,$result) ;
			}else{
				$is_in_district		=	$this->is_in_district($parent_id,$district_id) ;
				if ( intval($is_in_district) > 0 && $result["district_id"]  == $district_id && $result["parent_id"] == $parent_id ){
					array_push($returns,$result) ;
				}
			}
		}
		return $returns;
    }

	public function getListPays($parent_id,$tree_type){
		$sql= " select distinct pays_id, pays_libelle from t_pays  ";
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function getAllDepartement($parent_id,$tree_type){
		$sql= " select distinct pays_id, pays_libelle from t_pays  ";
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function getStructureByDistrictid($district_id){
		$sql= " select distinct * from t_structure where district_id='".$district_id."'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
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
			$sql			=  "UPDATE rohi.candidat SET structureId = '".$child_id."'  WHERE user_id = '".$user_id."'" ; 	
		}else{
			$sql			=  "UPDATE rohi.candidat SET structureId = '".$child_id."'  WHERE user_id ='".$user_id."' " ; 		
		}
		
		$this->db->query($sql);
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
		
		if ( isset($oStructure['autorite_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
			             SET autorite_id ='".$oStructure['autorite_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
		}	

		if ( isset($oStructure['evaluateur_id']) ){
			$sql	=	"UPDATE  rohi.t_structure 
			             SET evaluateur_id ='".$oStructure['evaluateur_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
			$this->db->query($sql);
		}

		if ( isset($oStructure['premier_responsable_id']) ){
			$sql	=	"UPDATE  rohi.t_structure
			             SET premier_responsable_id ='".$oStructure['premier_responsable_id']."' 
						 WHERE child_id ='".$oStructure['child_id']."'  " ;
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


	public function ajaxGetDetailAgent($user_id){
		$sql= " SELECT * ,
					CASE
						WHEN sanction = 0  THEN 'En activite'
						WHEN sanction = 34 THEN 'Contrat expire'
						WHEN sanction = 40 THEN 'Personnel exterieur'
					END AS sanction_libelle
				FROM rohi.candidat
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
		//echo $sql;die;
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

		$sql= " SELECT      count(*) as total_child
				FROM        t_structure p1
				LEFT JOIN   t_structure p2 ON p2.child_id = p1.parent_id 
				LEFT JOIN   t_structure p3 ON p3.child_id = p2.parent_id 
				LEFT JOIN   t_structure p4 ON p4.child_id = p3.parent_id  
				LEFT JOIN   t_structure p5 ON p5.child_id = p4.parent_id  
				LEFT JOIN   t_structure p6 ON p6.child_id = p5.parent_id
				WHERE       $chil_id IN (p1.parent_id, p2.parent_id, p3.parent_id,  p4.parent_id, p5.parent_id,  p6.parent_id) 
				";
		$sql= $sql . " AND  p1.district_id='".$district_id."'";
				
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
			if ($element['parent_id'] == $parentId) {	
				$children = $this->buildTree($elements, $element['child_id']);
				if (sizeof($children) >0) {
					$element['children'] = $children;
				}
				$element["candidat_id"]	=	$this->getCandidatByUserId($element["premier_responsable_id"])["id"] ;
				$element["nb_agent"]	=	$this->ajaxCountAgent($element["child_id"])["nb_records"] ;
				$branch[] = $element;
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


}
?>
