<?php
class Localite_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.localite', $oData)){
			return $this->db->insert_id();
		}else return false;
	}


	public function getInfoChangeLocalite($_iUserId)
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseGcap =  $db['gcap']['database'] ;


		$zSql= " SELECT localite_paysId,localite_provinceId,localite_regionId,localite_districtId,localite_departementId,localite_directionId,localite_serviceId,localite_divisionId,u.nom,u.prenom,u.im as matricule,p.libele AS zPays,localite_userId, pro.libele AS zProvince,dis.libele AS zDistrict,r.libele AS zRegion,d.libele AS zDirection, 
		s.libele AS zService, md.libele AS zDivision,localite_departementId FROM $zDatabaseGcap.localite 
		INNER JOIN $zDatabaseOrigin.user u ON u.id = localite_userId
		LEFT JOIN $zDatabaseOrigin.pays p ON p.id = localite_paysId
		LEFT JOIN $zDatabaseOrigin.province pro ON pro.id = localite_provinceId
		LEFT JOIN $zDatabaseOrigin.district dis ON dis.id = localite_districtId
		LEFT JOIN $zDatabaseOrigin.region r ON r.id = localite_regionId
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = localite_serviceId
		LEFT JOIN $zDatabaseOrigin.direction d ON d.id = localite_directionId
		LEFT JOIN $zDatabaseOrigin.module md ON md.id = localite_divisionId
		WHERE localite_userId = " . $_iUserId . " AND localite_statut=1 LIMIT 0,1" ; 

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function getInfoChangeLocaliteEvaluateur($_zUserId)
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseGcap =  $db['gcap']['database'] ;


		$zSql= " SELECT ca.id as id, ca.type_photo, localite_paysId,localite_provinceId,localite_regionId,localite_districtId,localite_departementId,localite_directionId,localite_serviceId,localite_divisionId,u.nom,u.prenom,u.im as matricule,p.libele AS zPays,localite_userId, pro.libele AS zProvince,dis.libele AS zDistrict,r.libele AS zRegion,d.libele AS zDirection, 
		s.libele AS zService, md.libele AS zDivision,localite_departementId FROM $zDatabaseGcap.localite 
		INNER JOIN $zDatabaseOrigin.user u ON u.id = localite_userId
		INNER JOIN $zDatabaseOrigin.candidat ca ON u.id = ca.user_id
		LEFT JOIN $zDatabaseOrigin.pays p ON p.id = localite_paysId
		LEFT JOIN $zDatabaseOrigin.province pro ON pro.id = localite_provinceId
		LEFT JOIN $zDatabaseOrigin.district dis ON dis.id = localite_districtId
		LEFT JOIN $zDatabaseOrigin.region r ON r.id = localite_regionId
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = localite_serviceId
		LEFT JOIN $zDatabaseOrigin.direction d ON d.id = localite_directionId
		LEFT JOIN $zDatabaseOrigin.module md ON md.id = localite_divisionId
		WHERE localite_userId IN (" . $_zUserId . ") AND localite_statut=1 GROUP BY localite_userId ORDER BY localite_id DESC  " ; 

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function update_Candidat($oData, $_iUserId){
		
		global $db ; 
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$this->db->update($zDatabaseOrigin.'.candidat', $oData, "user_id = $_iUserId");
		return $_iUserId ; 
	}

	public function update_localite($oData, $_iUserId){
		
		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$this->db->update($zDatabaseGcap.'.localite', $oData, "localite_userId = $_iUserId");
		return $_iUserId ; 
	}
	
	
}
?>