<?php
class DeclarationPatrimoine_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function createDeclarationPatrimoine($toDeclarations){
		//print_r($toDeclarations);
		$sql	=	"   insert into rohi.agent_assujetties_dp (
								user_id,
								matricule,
								nom,
								prenom,
								cin,
								corps,
								fonction_actuel,
								email,
								acte_de_nomination,
								date_de_nomination,
								phone,
								adresse,
								ordsec,
								numero_quitus_bianco,
								date_quitus_bianco
						) values (
								'".$toDeclarations["user_id"]."' ,
								'".$toDeclarations["matricule"]."' ,
								'".$toDeclarations["nom"]."' ,
								'".$toDeclarations["prenoms"]."' ,
								'".$toDeclarations["cin"]."' ,
								'".$toDeclarations["corps"]."' ,
								'".$toDeclarations["fonction_actuel"]."' ,
								'".$toDeclarations["email"]."' ,
								'".$toDeclarations["acte_de_nomination"]."' ,
								'".$toDeclarations["date_de_nomination"]."', 
								'".$toDeclarations["phone"]."',
								'".$toDeclarations["adresse"]."',
								'".$toDeclarations["ordsec"]."',
								'".$toDeclarations["numero_quitus_bianco"]."',
								'".$toDeclarations["date_quitus_bianco"]."'
						) ";
		//echo $toDeclarations["user_id"];die;
		//echo $sql;die;
		$this->db->query($sql);
	}


	public function majDeclarationPatrimoine($toDeclarations){
		$sql	=	"   UPDATE 
							rohi.agent_assujetties_dp 
						SET
							nom						= '".$toDeclarations["nom"]."',
							prenom					= '".$toDeclarations["prenom"]."',
							phone					= '".$toDeclarations["phone"]."',
							email					= '".$toDeclarations["email"]."',
							fonction_actuel			= '".$toDeclarations["fonction_actuel"]."',
							corps					= '".$toDeclarations["corps"]."',
							acte_de_nomination		= '".$toDeclarations["acte_de_nomination"]."',
							date_de_nomination		= '".$toDeclarations["date_de_nomination"]."',  
							adresse					= '".$toDeclarations["adresse"]."',  
							ordsec					= '".$toDeclarations["ordsec"]."',
							numero_quitus_bianco	= '".$toDeclarations["numero_quitus_bianco"]."',
							date_quitus_bianco		= '".$toDeclarations["date_quitus_bianco"]."'
						 WHERE matricule='".$toDeclarations["matricule"]."' ";
		//echo $sql;die;
		$this->db->query($sql);
	}
	public function createInformationEnfants($toDeclarations){
		$sql	=	"   insert into rohi.enfants_agent_assujetties_dp (
								user_id,
								nom_prenoms,
								date_de_naissance,
								lieu_de_naissance,
								activite,
								sexe
						) values (
								'".$toDeclarations["user_id"]."' ,
								'".$toDeclarations["nom_prenoms"]."' ,
								'".$toDeclarations["date_de_naissance"]."' ,
								'".$toDeclarations["lieu_de_naissance"]."' ,
								'".$toDeclarations["activite"]."' ,
								'".$toDeclarations["sexe"]."' 
						) ";
		$this->db->query($sql);
	}


	public function majInformationEnfants($toDeclarations){
		$sql	=	"   UPDATE 
							rohi.enfants_agent_assujetties_dp 
						SET
							nom_prenoms				= '".$toDeclarations["nom_prenoms"]."',
							date_de_naissance		= '".$toDeclarations["date_de_naissance"]."',
							lieu_de_naissance		= '".$toDeclarations["lieu_de_naissance"]."',
							activite				= '".$toDeclarations["activite"]."',
							sexe					= '".$toDeclarations["sexe"]."'
						 WHERE id					= '".$toDeclarations["id"]."' ";
		$this->db->query($sql);
	}

	public function getEnfantsAssujetties($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	" select * FROM rohi.enfants_agent_assujetties_dp where ";
		if( sizeof($parameters) > 0 ){
			$sql	=	$sql . implode(" and ", $parameters) ;	
		}
		$sql= $sql . " limit $ofset , $limit ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function saveInformationConjointe($toDeclarations){
		$deleteSql	=	"   delete from rohi.conjointe_agent_assujetties_dp where user_id ='".$toDeclarations["user_id"]."' ";
		$this->db->query($deleteSql);
		$insertSql	=	"   insert into rohi.conjointe_agent_assujetties_dp (
								user_id,
								nom,
								cin,
								prenom,
								date_naissance,
								lieu_naissance,
								fonction,
								adresse,
								date_delivrance,
								lieu_delivrance
						) values (
								'".$toDeclarations["user_id"]."' ,
								'".$toDeclarations["nom"]."' ,
								'".$toDeclarations["cin"]."' ,
								'".$toDeclarations["prenom"]."' ,
								'".$toDeclarations["date_naissance"]."' ,
								'".$toDeclarations["lieu_naissance"]."' ,
								'".$toDeclarations["fonction"]."' ,
								'".$toDeclarations["adresse"]."', 
								'".$toDeclarations["date_delivrance"]."', 
								'".$toDeclarations["lieu_delivrance"]."'
						) ";
		$this->db->query($insertSql);
	}
	
	public function ajaxCountPersonnalitesAssujetties($parameters){
		$sql= " select count(*) as nb_records from rohi.agent_assujetties_dp where 1=1 ";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$query = $this->db->query($sql); 
		return $query->row_array();
    }

	public function getPersonnalitesAssujetties($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	" select * FROM rohi.agent_assujetties_dp where ";
		if( sizeof($parameters) > 0 ){
			$sql	=	$sql . implode(" and ", $parameters) ;	
		}
		$sql= $sql . " limit $ofset , $limit ";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	public function getFonction($_is_ayant_fait_declaration=0){
		$sql= " SELECT * 
		          FROM sgrh.t_corps 
				 WHERE corps_code IN ('A01B','A01C','A08A','A08B','A06A','A31B','A06D','A15A','A18A','A18B','A23D','A29A','A19B','A70A','A88C','J08A','U08A','U06A','EO2P','E03L','N02U','N02P','N03L','E02M','N01C','E33Y','E02U','N00C','E02K') ";

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function findPersonneAssujetties($user_id=0){
		$sql= " SELECT * 
		          FROM rohi.agent_assujetties_dp 
				 WHERE user_id ='".$user_id."'  ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function findConjointe($user_id=0){
		$sql= " SELECT * 
		          FROM rohi.conjointe_agent_assujetties_dp 
				 WHERE user_id ='".$user_id."'  ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function findEnfant($user_id=0){
		$sql= " SELECT * 
		          FROM rohi.enfants_agent_assujetties_dp 
				 WHERE user_id ='".$user_id."'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function ajaxCountEnfantsAssujetties($parameters){
		$sql= " select count(*) as nb_records from rohi.enfants_agent_assujetties_dp where 1=1 ";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$query = $this->db->query($sql); 
		return $query->row_array();
    }

	public function getStatistiqueDeclarationByDepartement($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	"  select distinct
						'' corps_code,
						(select distinct count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DAI' ) DGAI ,
						(select DISTINCT count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGT' ) DGT,
						(select DISTINCT count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGI' ) DGI,
						(select DISTINCT count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGARMP') DGARMP,
						(select DISTINCT count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGFAG') DGFAG,
						(select DISTINCT count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGD') DGD,
						(select DISTINCT count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGCF' ) DGCF,
						'' total_corps
					from rohi.corps_dp t_corps 
					";
		$sql= $sql . " limit $ofset , $limit ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getStatistiqueDeclarationByCorpsCode($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	"  select corps_code,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DAI' and a.corps=t_corps.corps_code) DGAI ,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGT' and a.corps=t_corps.corps_code) DGT,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGI' and a.corps=t_corps.corps_code) DGI,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGARMP' and a.corps=t_corps.corps_code) DGARMP,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGFAG' and a.corps=t_corps.corps_code) DGFAG,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGD' and a.corps=t_corps.corps_code) DGD,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGCF' and a.corps=t_corps.corps_code) DGCF,
							(select count(user_id) from rohi.agent_assujetties_dp a where a.corps = corps_code and type='0') total_corps
					   from rohi.corps_dp t_corps
					   where type='0'
					";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
		$sql= $sql . " limit $ofset , $limit ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getStatistiqueDeclarationByCorpsHee($parameters, $ofset =0, $limit =100000000 ,$_is_ayant_fait_declaration=0){
		$sql	=	"  select corps_code,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DAI' and a.corps=t_corps.corps_code) DGAI ,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGT' and a.corps=t_corps.corps_code) DGT,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGI' and a.corps=t_corps.corps_code) DGI,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGARMP' and a.corps=t_corps.corps_code) DGARMP,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGFAG' and a.corps=t_corps.corps_code) DGFAG,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGD' and a.corps=t_corps.corps_code) DGD,
							(select count(a.user_id) from rohi.agent_assujetties_dp a inner join rohi.candidat b on a.user_id = b.user_id inner join rohi.departement c on b.departement = c.id where c.sigle_departement='DGCF' and a.corps=t_corps.corps_code) DGCF,
							(select count(user_id) from rohi.agent_assujetties_dp a where a.corps = corps_code and type='1') total_corps
					   from rohi.corps_dp t_corps
					   where type='1'
					";
		/*if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} */
		$sql= $sql . " limit $ofset , $limit ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getNombreDeclarantByCorpsAndDepartement($zCorps , $departement){
		$sql= " SELECT COUNT(a.user_id) AS nb,
					   a.corps
				 FROM rohi.agent_assujetties_dp a
				 INNER JOIN rohi.candidat b ON a.user_id = b.user_id  
				 INNER JOIN rohi.departement c ON  b.departement = c.id
				 WHERE a.corps IN $zCorps
				 AND c.sigle_departement ='".$departement."'
				 GROUP BY a.corps 
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	

}
?>