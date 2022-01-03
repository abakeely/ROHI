<?php
class Candidat_model extends CI_Model {
	private $candidat_table = 'candidat';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function insert($candidatData){
		if($this->db->insert($this->candidat_table, $candidatData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertCandidatPhoto($candidatData){
		if($this->db->insert('candidat_photo', $candidatData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertBatiment($oBatiment){
		if($this->db->insert('batiment_badge', $oBatiment)){
			return $this->db->insert_id();
		}else return false;
	}

	public function structureMef($oStructure){
		if($this->db->insert('mef.mef_srtructure', $oStructure)){
			return $this->db->insert_id();
		}else return false;
	}

	public function structureOther($_zTable,$oStructure){
		if($this->db->insert('mef.'.$_zTable, $oStructure)){
			return $this->db->insert_id();
		}else return false;
	}

	public function searchPays($_iPaysId){
		$sql= "select * from mef.mef_pays WHERE pays_id = " . $_iPaysId;
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function searchAllDepartement(){
		/*$sql= "SELECT * FROM mef.`mef_srtructure` WHERE structure_rang IN ('MIN','SG','CAB','DEPT') ORDER BY structure_parent ASC,structure_rang DESC";*/
		//maj abraham
		$sql = " select * from rohi.departement";
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function searchAllDirection(){
		/*$sql= "SELECT *, (SELECT id FROM mef.`mef_departement` WHERE structureId = structure_parent) AS departement_id, 
		(SELECT libele FROM mef.`mef_departement` WHERE structureId = structure_parent) AS libele FROM mef.`mef_srtructure` WHERE structure_rang IN ('DIR')";*/
		//modification abraham
		$sql= " select * from rohi.direction";
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function searchAllService(){
		/*$sql= "SELECT *, (SELECT id FROM mef.`mef_direction` WHERE structureId = structure_parent) AS direction_id, 
		(SELECT libele FROM mef.`mef_direction` WHERE structureId = structure_parent) AS libele FROM mef.`mef_srtructure` WHERE structure_rang IN ('SCE')";*/

		//maj Abraham
		$sql = " select * from rohi.service";
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function getIdMef($_zTable, $_iId){
		$zSql= "SELECT * FROM mef.$_zTable WHERE structureId = " . $_iId;
		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result(); // The $query result object will no longer be available
		return $oRowResult['id'];
	}


	public function updateCandidatStructure($_iUserId, $_iStructureId){
		$zSqlFarany = "update candidat SET structureId = ".$_iStructureId." WHERE user_id = " . $_iUserId;
		$this->db->query($zSqlFarany);
	}

	public function TraitementService(){
		$sql= "SELECT id,structureParentId  FROM mef.`mef_service` WHERE direction_id IS NULL";
		
		$query = $this->db->query($sql);
		$toRow = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

		foreach ($toRow as $oRow){
			
			$zSql= "SELECT * FROM mef.`mef_srtructure` WHERE structure_id = " . $oRow['structureParentId'];
			$oQuery = $this->db->query($zSql);
			$oRowResult = $oQuery->row_array();

			

			switch ($oRowResult['structure_rang']){

				case 'MIN':
				case 'SG':
				case 'DEPT':
					
					
					$iId = $this->getIdMef('mef_departement',$oRow['structureParentId']);
					
					$zSqlFarany = "update mef.`mef_service` SET departement_id = ".$iId." ,isParent = '".$oRowResult['structure_rang']."' WHERE id = " . $oRow['id'];
					$this->db->query($zSqlFarany);
					break;


				case 'DIR':

					$iId = $this->getIdMef('mef_direction',$oRow['structureParentId']);

					$zSqlFarany = "update mef.`mef_service` SET direction_id = ".$iId." ,isParent = '".$oRowResult['structure_rang']."' WHERE id = " . $oRow['id'];
					$this->db->query($zSqlFarany);
					break;

				case 'SCE':

					$iId = $this->getIdMef('mef_service',$oRow['structureParentId']);

					$zSqlFarany = "update mef.`mef_service` SET service_id = ".$iId." ,isParent = '".$oRowResult['structure_rang']."' WHERE id = " . $oRow['id'];
					$this->db->query($zSqlFarany);
					break;
			}
			//echo $zSqlFarany . "\n<br>" ; 
		}
		//return $row;
	}


	public function majLocalite(){
		$sql= "SELECT user_id,nom,prenom,structure_libelle,structure_paysId,structure_provinceId,structure_regionId,structure_districtId FROM rohi.candidat 
		INNER JOIN mef.`mef_srtructure` ON structure_id = structureId";
		
		$query = $this->db->query($sql);
		$toRow = $query->result_array();
		$query->free_result();

		foreach ($toRow as $oRow){
			
			$zSqlFarany = "update rohi.candidat SET 
			pays_id = ".$oRow['structure_paysId']." ,
			province_id = ".$oRow['structure_provinceId']." ,
			region_id = ".$oRow['structure_regionId']." ,
			district_id = ".$oRow['structure_districtId']." 
			WHERE user_id = " . $oRow['user_id'];
			$this->db->query($zSqlFarany);

			//echo $zSqlFarany . "\n<br>" ; 
		}
		//return $row;
	}

	public function viderDepDirSer(){
			
		$zSql = "update rohi.candidat SET 
		departement = '' ,
		direction = '' ,
		service = '' ,
		division = ''";
		$this->db->query($zSql);
	}

	public function getIdMefArray($_zTable, $_iId){
		$zSql= "SELECT * FROM mef.$_zTable WHERE structureId = " . $_iId;
		$oQuery = $this->db->query($zSql);
		$oRowResult = $oQuery->row_array();
		$oQuery->free_result(); // The $query result object will no longer be available
		return $oRowResult;
	}

	public function majLocaliteDepDirSer(){
		$sql= "SELECT user_id,nom,prenom,structure_id,structure_parent,structure_libelle,structure_paysId,structure_rang,structure_provinceId,structure_regionId,structure_districtId FROM rohi.candidat INNER JOIN mef.`mef_srtructure` ON structure_id = structureId";
		
		$query = $this->db->query($sql);
		$toRow = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

			foreach ($toRow as $oRow){
				
				switch ($oRow['structure_rang']){

					case 'MIN':
					case 'SG':
					case 'DEPT':
						
						$iDepartementId = $this->getIdMef('mef_departement',$oRow['structure_id']);

						$zSqlUpdate = "update rohi.candidat SET 
						departement = '".$iDepartementId."' ,
						direction = '' ,
						service = '' 
						WHERE user_id = " . $oRow['user_id'];

						echo $zSqlUpdate . "<br>\n"; 

						$this->db->query($zSqlUpdate);
						break;


					case 'DIR':

						$oLocalite = $this->getIdMefArray('mef_direction',$oRow['structure_id']);
						$oLocaliteParent = $this->getIdMefArray('mef_departement',$oRow['structure_parent']);

						$iDepartementId = 0;

						if(sizeof($oLocaliteParent)==0){
							$oLocaliteParent = $this->getIdMefArray('mef_direction',$oRow['structure_parent']);
						}

						

						$iDirectionId = $oLocalite['id'] ; 

						if(sizeof($oLocaliteParent)>0){
							$iDepartementId = $oLocaliteParent['id'] ; 
						}

						$zSqlUpdate = "update rohi.candidat SET 
						departement = '".$iDepartementId."' ,
						direction = '".$iDirectionId."' ,
						service = '' 
						WHERE user_id = " . $oRow['user_id'];

						echo $zSqlUpdate . "<br>\n"; 

						$this->db->query($zSqlUpdate);
						break;

					case 'SCE':

						$oLocalite = $this->getIdMefArray('mef_service',$oRow['structure_id']);
						$iServiceId = $oLocalite['id'];

						/*echo "<pre>";
						print_r ($oLocalite);
						echo "</pre>";*/
						
						
						$oLocaliteDirection = $this->getIdMefArray('mef_direction',$oRow['structure_parent']);

						$iDirectionId = 0;
						$iDepartementId = 0;
						if(sizeof($oLocaliteDirection)>0){
								$iDirectionId = $oLocaliteDirection['id'] ; 
								$oLocaliteDepartement = $this->getIdMefArray('mef_departement',$oLocaliteDirection['structureParentId']);

								if(sizeof($oLocaliteDepartement)>0){
										$iDepartementId = $oLocaliteDepartement['id'] ; 
								} else {
									/* double direction */
									$oLocaliteDirectionParent = $this->getIdMefArray('mef_direction',$oLocaliteDirection['structureParentId']);

									$iDirectionId .= "-" . $oLocaliteDirectionParent['id'];

									$oLocaliteDepartement = $this->getIdMefArray('mef_departement',$oLocaliteDirectionParent['structureParentId']);

									if(sizeof($oLocaliteDepartement)>0){
											$iDepartementId = $oLocaliteDepartement['id'] ; 
									}

								}
						} else {
							$oLocaliteDepartement = $this->getIdMefArray('mef_departement',$oRow['structure_parent']);
							if(sizeof($oLocaliteDepartement)>0){
									$iDepartementId = $oLocaliteDepartement['id'] ; 
							} else {
								/* le parent est une service */
								//echo "ato";

								$oLocaliteServiceParent = $this->getIdMefArray('mef_service',$oRow['structure_parent']);
								$iServiceId .= "-" . $oLocaliteServiceParent['id'];

								/*******/
										$oLocaliteDirection = $this->getIdMefArray('mef_direction',$oLocaliteServiceParent['structureParentId']);

										$iDirectionId = 0;
										$iDepartementId = 0;
										if(sizeof($oLocaliteDirection)>0){
												$iDirectionId = $oLocaliteDirection['id'] ; 
												$oLocaliteDepartement = $this->getIdMefArray('mef_departement',$oLocaliteDirection['structureParentId']);

												if(sizeof($oLocaliteDepartement)>0){
														$iDepartementId = $oLocaliteDepartement['id'] ; 
												} else {
													/* double direction */
													$oLocaliteDirectionParent = $this->getIdMefArray('mef_direction',$oLocaliteDirection['structureParentId']);

													$iDirectionId .= "-" . $oLocaliteDirectionParent['id'];

													$oLocaliteDepartement = $this->getIdMefArray('mef_departement',$oLocaliteDirectionParent['structureParentId']);

													if(sizeof($oLocaliteDepartement)>0){
															$iDepartementId = $oLocaliteDepartement['id'] ; 
													}

												}
										}
								/*******/
							}
						}

						$zSqlUpdate = "update rohi.candidat SET 
						departement = '".$iDepartementId."' ,
						direction = '".$iDirectionId."' ,
						service = '".$iServiceId."'
						WHERE user_id = " . $oRow['user_id'];

						echo $zSqlUpdate . "<br>\n"; 

						$this->db->query($zSqlUpdate);
						break;

				}

				//echo $zSqlFarany . "\n<br>" ; 
			}

			die();
	}


	public function majUserDepartement(){
		$sql= "SELECT * from candidat c INNER JOIN user u ON c.user_id = u.id WHERE dep!=''";
		
		$query = $this->db->query($sql);
		$toRow = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

		foreach ($toRow as $oRow){
			if($oRow['departement']!="" || $oRow['departement'] !=0){
				$zSqlUpdate = "update rohi.user SET dep = '".$oRow['departement']."' WHERE id = " . $oRow['user_id'];
				$this->db->query($zSqlUpdate);
			}
		}

			
	}

	public function majUserDirection(){
		$sql= "SELECT * from candidat c INNER JOIN user u ON c.user_id = u.id WHERE dir!=''";
		
		$query = $this->db->query($sql);
		$toRow = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

		foreach ($toRow as $oRow){
			if($oRow['direction']!="" || $oRow['direction'] !=0){
				$zSqlUpdate = "update rohi.user SET dir = '".$oRow['direction']."' WHERE id = " . $oRow['user_id'];
				$this->db->query($zSqlUpdate);
			}
		}

			
	}

	public function majUserService(){
		$sql= "SELECT * from candidat c INNER JOIN user u ON c.user_id = u.id WHERE serv!=''";
		
		$query = $this->db->query($sql);
		$toRow = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

		foreach ($toRow as $oRow){
			if($oRow['service']!="" || $oRow['service'] !=0){
				$zSqlUpdate = "update rohi.user SET serv = '".$oRow['service']."' WHERE id = " . $oRow['user_id'];
				$this->db->query($zSqlUpdate);
			}
		}

			
	}


	public function searchProvince($_iProvinceId){
		$sql= "select * from mef.mef_province WHERE province_id = " . $_iProvinceId;
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function searchRegion($_iRegionId){
		$sql= "select * from mef.mef_region WHERE region_id = " . $_iRegionId;
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function searchDistrict($_iDistrictId){
		$sql= "select * from mef.mef_district WHERE district_id = " . $_iDistrictId;
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function insertDemandeBadgeAgent($oAgent){
		if($this->db->insert('agent_demande', $oAgent)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertConfirmationBadge($oBadge){
		if($this->db->insert('confirmationbadge', $oBadge)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_all_list(){
		$sql= "select * from candidat";
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
    
	public function get_all_list_valide($service_id=false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = true ";
		if($service_id){
			$sql .= " and service = $service_id" ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function candidat_matricule(){
		$sql= "select matricule,user_id from candidat where matricule > 0 AND isAvancement = 0";
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	
	


	public function candidat_matricule2(){
		$sql= "select matricule,user_id from candidat where matricule > 0 AND isDateService = 0";
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function update_datePriseService($id_user,$toAvancement){

		$oData = array();
		$oData['isDateService'] = 2 ; 
		if (sizeof($toAvancement)>0) {
			$toAvancementAffiche = array();
			if (is_array($toAvancement)) {
				$toAvancementAffiche =  $toAvancement ; 
			} 

			if (is_object($toAvancement)) {
				array_push($toAvancementAffiche, $toAvancement) ; 
			}

			$oAssign = $toAvancementAffiche[0] ;
			$datetime = new Datetime($oAssign->avanceDate);
			$zDate = $datetime->format('Y-m-d');
			$oData['date_prise_service'] = $zDate ;  
			$oData['isDateService'] = 1 ; 

			echo $id_user ; 
			echo "<pre>";
			print_r ($oData);
			echo "<pre>";

			//die();
			//$oData['date_prise_service'] = $oAssignDeb->avanceDate ;
			
		}

		$this->db->update($this->candidat_table, $oData, "user_id = $id_user");
	}
	
/*..............................Fin Date Prise de Service..........................................*/

	public function candidat_matricule_isSanction(){
		$sql= "select matricule,user_id from candidat where matricule > 0 AND isSanction = 0";
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
    public function __get_all_list_valide_same_service($service_id=false,$region_id = false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = true ";
		if($region_id)
			$sql .= ' and region_id = '.$region_id;
		if($service_id){
			$sql .= " and service = $service_id" ;
			$sql .= " and user.role != 'chef' " ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_all_list_valide_same_service($service_id=false,$region_id = false){
		//$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = true ";
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id ";
		if($region_id)
			$sql .= ' and region_id = '.$region_id;
		if($service_id){
			$sql .= " and service = $service_id" ;
			$sql .= " and user.role != 'chef' " ;
		}

		$sql .= " order by matricule ASC " ;

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_all_list_invalide_same_service($service_id=false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = false ";
		if($service_id){
			$sql .= " and service = $service_id" ;
			$sql .= " and user.role != 'chef' " ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_all_list_valide_same_direction($direction_id=false,$region_id = false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = true ";
		if($region_id)
			$sql .= ' and region_id = '.$region_id;
		if($direction_id){
			$sql .= " and direction = $direction_id" ;
			$sql .= " and user.role != 'chef' " ;
		}
		
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_batimentLibelle($_iBatimentId){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$sql= "select * from $zDatabaseOrigin.batiment where batiment_id = " . $_iBatimentId;
		
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	
	public function get_all_list_invalide_same_direction($direction_id=false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = false ";
		if($direction_id){
			$sql .= " and direction = $direction_id" ;
			$sql .= " and user.role != 'chef' " ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_all_list_valide_same_departement($dep_id=false,$region_id = false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = true ";
		if($region_id)
			$sql .= ' and region_id = '.$region_id;
		if($dep_id){
			$sql .= " and departement = $dep_id" ;
			$sql .= " and user.role != 'chef' " ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_all_list_invalide_same_departement($dep_id=false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = false ";
		if($direction_id){
			$sql .= " and departement = $dep_id" ;
			$sql .= " and user.role != 'chef' " ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
        
    public function get_all_list_invalide($service_id=false){
		$sql= "select candidat.* from candidat,user where candidat.user_id = user.id and user.validate = false";
		if($service_id){
			$sql .= " and service = $service_id" ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_by_id($id){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$sql= "select * from ".$zDatabaseOrigin.".candidat where id = ".$id;
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_all_candidat(&$iSearch,$_oDataSearch=array(),&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "c.id"){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT SQL_CALC_FOUND_ROWS *,c.nom as zNom, d.sigle_direction as zDirection,c.id as iCandidatId, s.sigle_service as zService,dp.sigle_departement as zDepartement, m.libele as zDivision,REPLACE(cin,' ','') as cin,( SELECT GROUP_CONCAT( CONCAT (par_poste,' (',date_debut,' ',date_fin,') ') SEPARATOR '<br/><br/>-&nbsp;') FROM candidat_parcours WHERE candidat_id = iCandidatId) AS parcours, ( SELECT GROUP_CONCAT( diplome_name SEPARATOR '<br/><br/>-&nbsp;') FROM candidat_diplome WHERE candidat_id = iCandidatId) AS diplome
				FROM $zDatabaseOrigin.candidat c
				INNER JOIN $zDatabaseOrigin.departement dp ON dp.id = c.departement
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
				LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division	
				WHERE 1 ";

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
			$iSearch = 1;
		}

		if(isset($_oDataSearch["iDivisionId"]) && ($_oDataSearch["iDivisionId"] != 0)) {

			$zSql .= " AND c.division =  " . $_oDataSearch["iDivisionId"];
			$iSearch = 1;

		}elseif(isset($_oDataSearch["iServiceId"]) && ($_oDataSearch["iServiceId"] != 0)){

			$zSql .= " AND c.service =  " . $_oDataSearch["iServiceId"];
			$iSearch = 1;


		}elseif(isset($_oDataSearch["iDirectionId"]) && ($_oDataSearch["iDirectionId"] != 0)){

			$zSql .= " AND c.direction =  " . $_oDataSearch["iDirectionId"];
			$iSearch = 1;


		}elseif(isset($_oDataSearch["iDepartementId"]) && ($_oDataSearch["iDepartementId"] != 0)){

			$zSql .= " AND c.departement =  " . $_oDataSearch["iDepartementId"];
			$iSearch = 1;
		}

		if(isset($_oDataSearch["zLocalite"]) && ($_oDataSearch["zLocalite"] != '')) {

			$zSql .= " AND (c.porte like  '%" . $_oDataSearch["zLocalite"] . "%' OR c.lacalite_service like '%" . $_oDataSearch["zLocalite"] . "%')";
			$iSearch = 1;

		}

		if(isset($_oDataSearch["zParcoursDiplome"]) && ($_oDataSearch["zParcoursDiplome"] != '')) {

			$_oDataSearch["zParcoursDiplome"] = str_replace ("'","\'", $_oDataSearch["zParcoursDiplome"]) ; 
			$zSql .= " HAVING (parcours like  '%" . $_oDataSearch["zParcoursDiplome"] . "%' OR diplome like '%" . $_oDataSearch["zParcoursDiplome"] . "%')";
			$iSearch = 1;

		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
			$iSearch = 1;
		}

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;

		//echo $zSql ;

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $oRow;
	}
	
	public function get_by_user_id($user_id){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$sql= "select * from ".$zDatabaseOrigin.".candidat c INNER JOIN t_structure t ON c.structureId = t.child_id where user_id = ".$user_id;
			//	echo $sql;die;

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
        
	public function ___get_by_user_id($user_id){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$sql= "select * from ".$zDatabaseOrigin.".candidat where user_id = ".$user_id;
			//	echo $sql;die;

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function update($candidatData,$candidat_id){
		$DB1 = $this->load->database('default', TRUE);
		$DB1->update($this->candidat_table, $candidatData, "id = $candidat_id");
	}
	
	public function get_last_candidat_by_user_id($user_id){
		$sql= "select * from candidat where user_id = ".$user_id. " order by id desc" ;
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
        
	public function existe_by_matricule($im = FALSE){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		if ($login === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin.'.candidat');
			return $query->result_array();
		}
		$query = $this->db->get_where($zDatabaseOrigin.'.candidat', array('matricule' => $im));
				
		return $query->row_array();
	}
        
	public function sizeof_departement($departementId){
		$query = $this->db->get_where('candidat', array('departement' => $departementId));
		return sizeof($query->result());
	}
        
	public function sizeof_region($regionId){
		$query = $this->db->get_where('candidat', array('region' => $regionId));
		return sizeof($query->result());
	}
        
	public function is_candidat_en_attente($id){
		 $candidat = current($this->get_by_id($id));
		 return $candidat->attente;
	}
	
	
	// STATISTIQUE
	
	public function get_candidat_by_multicritere($param,$value){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$sql= "select * from ".$zDatabaseOrigin.".candidat where ";
		$where = " 1=1 ";
		$cpt = 0;
		foreach($param as $par){
			$where .= " AND  $par = $value[$cpt] ";
			$cpt++;	
		}
		$sql .= $where;
		//var_dump($sql);
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	
	public function get_stat_group_by($grouper,$sevice){
		//$where = '';
		//if($sevice)
			//$where = " where service = $sevice";
		//$where = ' where (sanction = 0 or sanction = 34)';
		//$where .= " WHERE (sanction='0' or sanction='' or sanction='00' or sanction='34' or sanction IS NULL)  " ;
		//$where .= " AND  ( $grouper IS NOT NULL OR $grouper<>'') " ;
		$where .= " WHERE 1=1  " ;
		

		$sql= "select $grouper as grouper,
		              count(*) as nb 
				from candidat 
			   $where 
			   group by $grouper 
			   order by nb desc";
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	public function get_stat_group_by_structure($grouper,$sevice){
		
		$where .= " WHERE (sanction='0' or sanction='' or sanction='00' or sanction='34' or sanction IS NULL)  " ;
		//$where .= " AND  ( $grouper IS NOT NULL OR $grouper<>'') " ;
		

		$sql=" SELECT  if(a.$grouper=0, a.departement,a.$grouper)AS grouper,
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
				 ORDER BY nb DESC";
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	
	
	
	
	public function get_candidat_by_direction($direction_id=false){
		$sql= "select candidat.* from candidat ";
		if($direction_id){
			$sql .= " where  direction = $direction_id" ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_candidat_by_departement($dept_id=false){
		$sql= "select candidat.* from candidat ";
		if($dept_id){
			$sql .= " where  departement = $dept_id" ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function get_candidat_by_id($id=false){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$sql= "select candidat.* from ".$zDatabaseOrigin.".candidat ";
		if($id){
			$sql .= " where  id = $id" ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	
	public function __get_candidat_by_matricule($im = FALSE, $_iUserId = ''){
		$sql= "select candidat.* from candidat WHERE 1 ";
		if($im){
			$sql .= " AND  matricule = '$im' " ;
		}

		if($_iUserId != ''){
			$sql .= " AND  user_id = '$_iUserId'" ;
		}

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function __get_candidat_by_cin($_iCin = FALSE, $_iUserId = ''){
		$sql= "select candidat.*,REPLACE(cin,' ','') as cinParse from candidat WHERE 1=1 ";
		if($_iCin){
			$sql .= " AND 1 HAVING  cin = '$_iCin' " ;
		}

		if($_iUserId != ''){
			$sql .= " AND  user_id = '$_iUserId'" ;
		}

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_candidat_by_matricule($im = FALSE, $_iUserId = '', $iAll=0, $oCandidat=array(),$_zUserId=''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		
		$sql= "select candidat.* from $zDatabaseOrigin.candidat WHERE 1 ";
		if($im){
			$sql .= " AND  matricule = '$im' " ;
		}

		if($_iUserId != ''){
			$sql .= " AND  user_id = '$_iUserId'" ;
		}

		if ($iAll == 1) {
	
			//$sql .= " AND direction = " . $oCandidat[0]->direction; 
			if (isset($oCandidat[0]->direction) && ($oCandidat[0]->direction != '')){
				$sql .= " AND direction = " . $oCandidat[0]->direction; 
			}
		}

		if ($iAll == 2) {
			if ($_zUserId != ''){
				$sql .= " AND user_id IN (" . $_zUserId . ")"; 
			}
		}

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_candidat_by_cin($_iCin = FALSE, $_iUserId = '', $iAll=0, $oCandidat=array()){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select candidat.*,REPLACE(cin,' ','') as cinParse from $zDatabaseOrigin.candidat WHERE 1=1 ";
		if($_iCin){
			$sql .= " AND 1 HAVING  cin = '$_iCin' " ;
		}

		if($_iUserId != ''){
			$sql .= " AND  user_id = '$_iUserId'" ;
		}

		if ($iAll == 1) {
	
			$sql .= " AND direction = " . $oCandidat[0]->direction; 
		}


		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}


	public function update_corpsGradeIndice($id_user,$toAvancement){

		if (sizeof($toAvancement)>0) {
			$toAvancementAffiche = array();
			if (is_array($toAvancement)) {
				$toAvancementAffiche =  $toAvancement ; 
			} 

			if (is_object($toAvancement)) {
				array_push($toAvancementAffiche, $toAvancement) ; 
			}

			$oAssign = $toAvancementAffiche[sizeof($toAvancement)-1] ; 
			$oAssignDeb = $toAvancementAffiche[0] ; 

			$oData = array();

			if (is_object($oAssign) && isset($oAssign->corpsCode) && isset($oAssign->gradeCode)){
				$oData['corps'] = $oAssign->corpsCode ; 
				$oData['grade'] = $oAssign->gradeCode ; 

				$this->db->update($this->candidat_table, $oData, "user_id = $id_user");
			}
			
		}

		
	}


	public function update_corpsGradeIndice2($id_user,$toAvancement, $_Indice){

		$oData = array();
		$oData['isAvancement'] = 2 ; 
		if (sizeof($toAvancement)>0) {
			$toAvancementAffiche = array();
			if (is_array($toAvancement)) {
				$toAvancementAffiche =  $toAvancement ; 
			} 

			if (is_object($toAvancement)) {
				array_push($toAvancementAffiche, $toAvancement) ; 
			}

			$oAssign = $toAvancementAffiche[sizeof($toAvancement)-1] ; 
			$oAssignDeb = $toAvancementAffiche[0] ; 

			$oData = array();
			$oData['corps'] = $oAssign->corpsCode ; 
			$oData['grade'] = $oAssign->gradeCode ; 
			$oData['indice'] = $_Indice ; 
			$oData['isAvancement'] = 1 ; 

			echo $id_user ; 
			echo "<pre>";
			print_r ($oData);
			echo "<pre>";

			//die();
			//$oData['date_prise_service'] = $oAssignDeb->avanceDate ;
			
		}

		$this->db->update($this->candidat_table, $oData, "user_id = $id_user");
	}

	public function update_Sanction($id_user,$toSanction){

		$oData = array();
		$oData['sanction'] = '00' ; 
		$oData['isSanction'] = 2 ; 
		if (sizeof($toSanction)>0) {
			$toSanctionAffiche = array();
			if (is_array($toSanction)) {
				$toSanctionAffiche =  $toSanction ; 
			} 

			if (is_object($toSanction)) {
				array_push($toSanctionAffiche, $toSanction) ; 
			}

			$oAssign = $toSanctionAffiche[sizeof($toSanction)-1] ; 
			$oAssignDeb = $toSanctionAffiche[0] ; 

			$oData = array();
			$oData['sanction'] = $oAssign->sanctionCode ; 

			if(isset($oAssign->dateDebutSanction)){
				$oData['dateSanction'] = $oAssign->dateDebutSanction ; 
			}
			$oData['isSanction'] = 1 ; 

			echo $id_user ; 
			echo "<pre>";
			print_r ($oData);
			echo "<pre>";

			//die();
			//$oData['date_prise_service'] = $oAssignDeb->avanceDate ;
			
		}

		$this->db->update($this->candidat_table, $oData, "user_id = $id_user");
	}

	public function update_Indice($id_user,$toAvancement){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		if (sizeof($toAvancement)>0) {
			$toAvancementAffiche = array();
			if (is_array($toAvancement)) {
				$toAvancementAffiche =  $toAvancement ; 
			} 

			if (is_object($toAvancement)) {
				array_push($toAvancementAffiche, $toAvancement) ; 
			}

			$oAssign = $toAvancementAffiche[0] ; 
			$oAssignDeb = $toAvancementAffiche[0] ; 

			$iIndice = 0 ;
			foreach ($toAvancementAffiche as $oAvancementAffiche) {

				if ($oAvancementAffiche->indice >= $iIndice) {
					$iIndice = $oAvancementAffiche->indice ;
				}
			}

			if ($iIndice != 0) {

				$oData = array();
				$oData['indice'] = $iIndice ; 
				//$oData['date_prise_service'] = $oAssignDeb->avanceDate ;

				$this->db->update($zDatabaseOrigin.".".$this->candidat_table, $oData, "user_id = $id_user");
			}
		}
	}

	public function get_stat_tree($_iId =false){
		if($_iId){
			
			$sql= "select ( select count(*) from candidat where departement = ".$_iId.") as nbDep,count(*) as nbDir,direction,GROUP_CONCAT(service) as oSer,GROUP_CONCAT(division) as oDiv from candidat where departement = ".$_iId." group by direction";
			$query = $this->db->query($sql);
			$row = $query->result_array();
			if(!empty($row))return $row;
				
		}
		
	}

	public function makaSary(){
		$sql= "select * from candidat WHERE matricule IN (389671,
		342376,
		341362,
		374199,
		294938,
		353108,
		375214,
		328418,
		376907,
		256399,
		384853,
		318071,
		372850,
		391751,
		353911,
		371781,
		374600,
		303149,
		334551,
		391632,
		315528,
		318065,
		321130,
		277482,
		312045,
		271992,
		353896,
		354268,
		344652,
		344431,
		331122,
		344703)";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function getAvancement($_iAgentMatricule){
		$sql= "select * from rohi.t_avance_agent WHERE agent_matricule = " . $_iAgentMatricule;
		
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
	public function getLocaliteService($structureId){
		$sql= "SELECT b.site_libelle
				 FROM rohi.t_structure a
				 INNER JOIN rohi.t_sites b
				 ON a.site_id = b.site_id
				 WHERE a.child_id='".$structureId."'" ;
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
}
?>