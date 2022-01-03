<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 29/07/14
 * Time: 15:43
 */



class fonctionsSelectGlobales extends CI_Model{


    public function run($script)
    {
        $result = $this->db->query($script)->result();
        return $result;
    }
	public function getElement($table, $colonne, $reference, $valeurReference)
    {
        $result = $this->db->select($colonne)
            ->from($table)
            ->where($reference, $valeurReference)
            ->limit(1, 0)
            ->get()
            ->result();
        return $result;
    }
    public function getElement2($table, $colonne, $references)
    {
        $result = $this->db->select($colonne)
            ->from($table)
            ->where($references)
            ->limit(1, 0)
            ->get()
            ->result();
        return $result;
    }

    //Une quantité
    public function getGlobalQuantity($table)
    {
        return (int) $this->db
            ->count_all_results($table);
    }
	
	public function getQuantity($table, $references)
    {
        return (int) $this->db
            ->where($references)
            ->count_all_results($table);
    }

    public function getQuantity2($table, $reference, $valeurReference)
    {
        $result = $this->db
            ->where($reference, $valeurReference)
            ->count_all_results($table);
        return $result;
    }

	//Une somme
    public function getSum($table, $colonne)
    {
        return $this->db
            ->select_sum($colonne)
            ->from($table)
            ->get()
            ->result();
    }
    //Un nombre maximum
    public function getMax($table, $colonne)
    {
        return $this->db
            ->select_max($colonne)
            ->from($table)
            ->get()
            ->result();
    }
	public function getMaxWhere($table, $colonne, $reference, $valeurReference)
    {
        return $this->db
            ->select_max($colonne)
            ->from($table)
			->where($reference, $valeurReference)
            ->get()
            ->result();
    }
	public function getMaxWhereOrderBy($table, $colonne, $reference, $valeurReference, $order, $typeorder)
    {
        return $this->db
            ->select_max($colonne)
            ->from($table)
			->where($reference, $valeurReference)
			->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	public function getMaxWhereArray($table, $colonne, $indication)
    {
        return $this->db
            ->select_max($colonne)
            ->from($table)
			->where($indication)
            ->get()
            ->result();
    }
	public function getMaxWhereArrayOrderBy($table, $colonne, $indication, $order, $typeorder)
    {
        return $this->db
            ->select_max($colonne)
            ->from($table)
			->where($indication)
			->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	//Un nombre minimum
    public function getMin($table, $colonne)
    {
        return $this->db
            ->select_min($colonne)
            ->from($table)
            ->get()
            ->result();
    }
	public function getMinWhere($table, $colonne, $reference, $valeurReference)
    {
        return $this->db
            ->select_min($colonne)
            ->from($table)
			->where($reference, $valeurReference)
            ->get()
            ->result();
    }
	public function getMinWhereOrderBy($table, $colonne, $reference, $valeurReference, $order, $typeorder)
    {
        return $this->db
            ->select_min($colonne)
            ->from($table)
			->where($reference, $valeurReference)
			->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	public function getMinWhereArray($table, $colonne, $indication)
    {
        return $this->db
            ->select_min($colonne)
            ->from($table)
			->where($indication)
            ->get()
            ->result();
    }
	public function getMinWhereArrayOrderBy($table, $colonne, $indication, $order, $typeorder)
    {
        return $this->db
            ->select_min($colonne)
            ->from($table)
			->where($indication)
			->order_by($order, $typeorder)
            ->get()
            ->result();
    }

    //Une Liste simple
    public function getSimpleList($table, $colonnes)
    {
        
		global $db;

		$zDatabaseOrigin =  $db['default']['database'] ;
		return $this->db->select($colonnes)
            ->from($zDatabaseOrigin . '.' . $table)
            ->get()
            ->result();

    }

	 //Une Liste simple
    public function getSimpleListJoinPhoto(&$_iNbrTotal = 0,$table, $colonnes,$_iLimit=0,$zUserId="")
    {
        
		global $db;

		$zDatabaseOrigin =  $db['default']['database'] ;

		$toAgentReturn = array();

		$oRequest = $_REQUEST;

		/*
		$toAgent = $this->db->select("candidat.id,candidat.type_photo,matricule, candidat.nom, prenom, cin,CONCAT('- ',departement.sigle_departement,'',CASE WHEN departement.libele<>direction.libele THEN CONCAT('/',direction.sigle_direction) ELSE '' END,'', ,CASE WHEN direction.libele<>service.libele THEN CONCAT('/',service.sigle_service) ELSE '' END,CONCAT('<br><br>- ',candidat.lacalite_service),CASE WHEN candidat.porte != '' THEN CONCAT('<br><br>- Porte : ',candidat.porte) ELSE '' END) as localite",false)
		->from($zDatabaseOrigin . '.' . $table)
		->join($zDatabaseOrigin . '.departement', 'departement.id = candidat.departement','left')
		->join($zDatabaseOrigin . '.direction', 'direction.id = candidat.direction','left')
		->join($zDatabaseOrigin . '.service', 'service.id = candidat.service','left')
		->get()
		->result();*/

		$zSql = "SELECT SQL_CALC_FOUND_ROWS *,candidat.id,candidat.type_photo,matricule, candidat.nom, prenom, cin,phone,email,
		IFNULL((SELECT libele FROM $zDatabaseOrigin.sanction sa WHERE candidat.sanction = sa.id LIMIT 0,1),'Pas de sanction') as sanction,CONCAT('- ',d.sigle_departement,'',CASE WHEN d.libele<>di.libele THEN CONCAT('/',di.sigle_direction) ELSE '' END,'',CASE WHEN di.libele<>s.libele THEN CONCAT('/',s.sigle_service) ELSE '' END,CONCAT('<br><br>- ',candidat.lacalite_service),CASE WHEN candidat.porte != '' THEN CONCAT('<br><br>- Porte : ',candidat.porte) ELSE '' END) as localite
		
		
		FROM $zDatabaseOrigin.candidat 
		INNER JOIN $zDatabaseOrigin.candidat_photo ON candidat.user_id = candidat_photo.photo_userId
		LEFT JOIN $zDatabaseOrigin.departement d ON d.id = departement
		LEFT JOIN $zDatabaseOrigin.direction di ON di.id = direction
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = service
		LEFT JOIN $zDatabaseOrigin.module m ON m.id = division
		WHERE 1 ";

		if ($zUserId != ""){
			$zSql .= " AND candidat.user_id IN (".$zUserId.")";
		}

		$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( candidat.matricule LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR candidat.nom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR candidat.prenom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR candidat.phone LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR candidat.email LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR candidat.cin LIKE '%".$oRequest['search']['value']."%' )";
		}


		if ($oRequest['iMatricule'] != ""){
			$zSql .= " AND candidat.matricule like '%".$oRequest['iMatricule']."%' ";
		}

		
		if ($oRequest['iCin'] != ""){
			$zSql .= " AND candidat.cin like '%".$oRequest['iCin']."%' ";
		}

		if ($oRequest['zNom'] != ""){
			$zSql .= " AND candidat.nom like '%".$oRequest['zNom']."%' ";
		}

		if ($oRequest['zPrenom'] != ""){
			$zSql .= " AND candidat.prenom like '%".$oRequest['zPrenom']."%' ";
		}

		if ($oRequest['zContact'] != ""){
			$zSql .= " AND (candidat.phone like '%".$oRequest['zContact']."%' OR candidat.email like '%".$oRequest['zContact']."%') ";
		}

		if ($oRequest['zLocalite'] != "" || !empty($oRequest['search']['value']) || ($oRequest['zSanction'] != '')){
			$zSql .= " HAVING 1 ";
		}
		
		if ($oRequest['zLocalite'] != ""){
			$zSql .= " AND localite like '%".$oRequest['zLocalite']."%' ";
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND localite LIKE '%".$oRequest['search']['value']."%' ";    
		}

		if ($oRequest['zSanction'] != ""){
			$zSql .= " AND sanction like '%".$oRequest['zSanction']."%' ";
		}
	
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			}
		} else {
			$zSql.=" ORDER BY candidat.id ASC ";

			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		} 

		//echo $zSql ; 
		
		$zQuery = $this->db->query($zSql);

		$toAgent = $zQuery->result();

		foreach ($toAgent as $oAgent){
			if ($oAgent->type_photo != ''){

				$zImage = base_url().'assets/upload/default.jpg'; 
				$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $oAgent->id . "." . $oAgent->type_photo ; 
				$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $oAgent->id . "." . strtoupper($oAgent->type_photo) ; 

				if (file_exists($zImagePath)){
					$zImage = base_url()."assets/upload/" . $oAgent->id . "." . $oAgent->type_photo ; 
				}

				if (file_exists($zImagePath1)){
					$zImage = base_url()."assets/upload/" . $oAgent->id . "." . strtoupper($oAgent->type_photo) ; 
				}

				$oAgent->photo = "<img src='".$zImage."' width='100' />"  ;
			} else {
				$zImageDefault = base_url().'assets/upload/default.jpg'; 
				$oAgent->photo = "<img src='".$zImageDefault."' width='100' />"  ;
			}


			array_push ($toAgentReturn, $oAgent);
		}

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $this->db->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $toAgent; 

    }

	 //Une Liste simple
    public function getSimpleListJoin(&$_iNbrTotal = 0,$table, $colonnes,$_iLimit=0,$zUserId="")
    {
        
		global $db;

		$zDatabaseOrigin =  $db['default']['database'] ;

		$toAgentReturn = array();

		$oRequest = $_REQUEST;

		$zSql = "SELECT SQL_CALC_FOUND_ROWS *,candidat.id,
							  candidat.type_photo,
							  matricule, 
							  candidat.nom, 
							  prenom, 
							  cin,
						    ( SELECT group_concat(diplome_name)  from candidat_diplome where candidat_id =candidat.id ) as diplome,
							IFNULL((SELECT libele FROM rohi.sanction sa WHERE candidat.sanction = sa.id LIMIT 0,1),'Pas de sanction') AS sanction,
							path AS localite,
							SUBSTR(IFNULL(soa,''),INSTR(soa,'-')+1,2)   ministere_payeur,
							SUBSTR(IFNULL(uadm,''),INSTR(soa,'-')+1,2)  ministere_employeur,
							soa,
							uadm
				 FROM rohi.candidat 
				 LEFT JOIN rohi.fichedeposte ON fichePoste_id = fichePosteId 
				 LEFT JOIN rohi.module m ON m.id = division 
				 LEFT JOIN rohi.fichedeposte fd ON fd.fichePoste_id = fichePosteId 
				 WHERE 1 ";

		if ($zUserId != ""){
			$zSql .= " AND candidat.user_id IN (".$zUserId.")";
		}
		//nocmentena satria affichena saholo na sanctione na tsia
		//$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;


		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( candidat.matricule LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR candidat.nom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR candidat.prenom LIKE '%".$oRequest['search']['value']."%' ";
			
			$zSql.=" OR candidat.cin LIKE '%".$oRequest['search']['value']."%' )";
		}


		if ($oRequest['iMatricule'] != ""){
			$zSql .= " AND candidat.matricule like '%".$oRequest['iMatricule']."%'  ";
		}

	
		if ($oRequest['iCin'] != ""){
			$zSql .= " AND candidat.cin like '%".$oRequest['iCin']."%' ";
		}

		if ($oRequest['zNom'] != ""){
			$zSql .= " AND candidat.nom like '%".$oRequest['zNom']."%' ";
		}

		if ($oRequest['zPrenom'] != ""){
			$zSql .= " AND candidat.prenom like '%".$oRequest['zPrenom']."%' ";
		}

		if ($oRequest['zContact'] != ""){
			$zSql .= " AND (candidat.phone like '%".$oRequest['zContact']."%' OR candidat.email like '%".$oRequest['zContact']."%') ";
		}

		if ($oRequest['zLocalite'] != "" || !empty($oRequest['search']['value']) || ($oRequest['zSanction'] != '')){
			$zSql .= " HAVING 1 ";
		}
		
		if ($oRequest['zLocalite'] != ""){
			$zSql .= " AND localite like '%".$oRequest['zLocalite']."%' ";
		}

		if ($oRequest['zFicheDePoste'] != ""){
			$zSql.=" AND ( fd.fichePoste_intitule LIKE '%".$oRequest['zFicheDePoste']."%' ";    
			$zSql.=" OR fd.fichePoste_mission LIKE '%".$oRequest['zFicheDePoste']."%' ";
			$zSql.=" OR fd.fichePoste_activitePrinc LIKE '%".$oRequest['zFicheDePoste']."%' ";
			$zSql.=" OR fd.fichePoste_activiteEncad LIKE '%".$oRequest['zFicheDePoste']."%' )";
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND localite LIKE '%".$oRequest['search']['value']."%' ";    
		}

		/*if ($oRequest['zSanction'] != ""){
			$zSql .= " AND sanction like '%".$oRequest['zSanction']."%' ";
		}*/
		
		if ($oRequest['zDiplome'] != ""){
			$zSql .= " AND ( SELECT group_concat(diplome_name) from candidat_diplome where candidat_id =candidat.id )  like '%".$oRequest['zDiplome']."%' ";
		}

	
		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if ($_iLimit==0){
				if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
					$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
				}
			}
		} else {
			$zSql.=" ORDER BY candidat.id ASC ";

			if ($_iLimit==0){
				$zSql.=" LIMIT 0,10   ";
			}
		} 
		
		
		$zQuery = $this->db->query($zSql);

		$toAgent = $zQuery->result();

		foreach ($toAgent as $oAgent){
			if ($oAgent->type_photo != ''){

				$zImage = base_url().'assets/upload/default.jpg'; 
				
				$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $oAgent->id . "." . $oAgent->type_photo ; 
				$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $oAgent->id . "." . strtoupper($oAgent->type_photo) ; 

				if (file_exists($zImagePath)){
					$zImage = base_url()."assets/upload/" . $oAgent->id . "." . $oAgent->type_photo . "?".date("YmdHis") ; 
				}

				if (file_exists($zImagePath1)){
					$zImage = base_url()."assets/upload/" . $oAgent->id . "." . strtoupper($oAgent->type_photo) . "?".date("YmdHis") ; 
				}

				$oAgent->photo = "<img src='".$zImage."' width='100' />"  ;
			} else {
				$zImageDefault = base_url().'assets/upload/default.jpg'; 
				$oAgent->photo = "<img src='".$zImageDefault."' width='100' />"  ;
			}


			array_push ($toAgentReturn, $oAgent);
		}

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $this->db->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}
		return $toAgent; 

    }
	public function getSimpleListLimit($table, $colonnes, $start, $limit)
    {
        return $this->db->select($colonnes)
            ->from($table)
			->limit($limit, $start)
            ->get()
            ->result();

    }

    public function getSimpleListOrderBy($table, $colonnes, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->order_by($order, $typeorder)
            /*->limit(3,0)*/
            ->get()
            ->result();
    }

    //Une Liste simple + Group By
    public function getSimpleListGroup($table, $colonnes, $grouppement)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->group_by($grouppement)
            ->get()
            ->result();
    }

    //Une Liste simple + Group By + Order by
    public function getSimpleListGroupOrderBy($table, $colonnes, $grouppement, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->group_by($grouppement)
            ->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	public function getSimpleListGroupOrderByLimit($table, $colonnes, $grouppement, $order, $typeorder, $start, $limit)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->group_by($grouppement)
            ->order_by($order, $typeorder)
			->limit($limit, $start)
            ->get()
            ->result();
    }

    //Une Liste simple + where
    public function getSimpleListWhere($table, $colonnes, $indication, $valeurindication)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication, $valeurindication)
            ->get()
            ->result();
    }
	public function getSimpleListWhereOr($table, $colonnes, $indication, $valeurindication, $indication2, $valeurindication2)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication, $valeurindication)
			->or_where($indication2, $valeurindication2)
            ->get()
            ->result();
    }

    public function getSimpleListWhereOrderBy($table, $colonnes, $indication, $valeurindication, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication, $valeurindication)
            ->order_by($order, $typeorder)
            ->get()
            ->result();
    }

    public function getSimpleListWhereArray($table, $colonnes, $indication)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication)
            ->get()
            ->result();
    }

    public function getSimpleListWhereArrayOrderBy($table, $colonnes, $indication, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication)
            ->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	//Pour la pagination avec php de codeigniter
	public function getSimpleListOrderByLimit($table, $colonnes, $order, $typeorder, $start, $limit)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->order_by($order, $typeorder)
			->limit($limit, $start)
            ->get()
            ->result();
    }
	public function getSimpleListWhereOrderByLimit($table, $colonnes, $indication, $valeurindication, $order, $typeorder, $start, $limit)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication, $valeurindication)
            ->order_by($order, $typeorder)
			->limit($limit, $start)
            ->get()
            ->result();
    }
	
	public function getSimpleListWhereArrayOrderByLimit($table, $colonnes, $indication, $order, $typeorder, $start, $limit)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication)
            ->order_by($order, $typeorder)
			->limit($limit, $start)
            ->get()
            ->result();
    }
	
	//Where or where
	public function getSimpleListWhereArrayOrArrayOrderBy($table, $colonnes, $indication1, $indication2, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication1)
			->or_where($indication2)
            ->order_by($order, $typeorder)
            ->get()
            ->result();
    }
    //Une Liste simple + Group By + where
    public function getSimpleListGroupWhere($table, $colonnes, $indication, $valeurindication, $grouppement)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication, $valeurindication)
            ->group_by($grouppement)
            ->get()
            ->result();
    }

    //Une Liste simple + Group By + where + order
    public function getSimpleListGroupWhereOrderBy($table, $colonnes, $indication, $valeurindication, $grouppement, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication, $valeurindication)
            ->group_by($grouppement)
            ->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	public function getSimpleListGroupWhereArrayOrderBy($table, $colonnes, $indication, $grouppement, $order, $typeorder)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication)
            ->group_by($grouppement)
            ->order_by($order, $typeorder)
            ->get()
            ->result();
    }
	public function getSimpleListGroupWhereArrayOrderByLimit($table, $colonnes, $indication, $grouppement, $order, $typeorder, $start, $limit)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->where($indication)
            ->group_by($grouppement)
            ->order_by($order, $typeorder)
			->limit($limit, $start)
            ->get()
            ->result();
    }

    //Une Liste avec like
    public function getSearchList($table, $colonnes, $tolike, $like)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->like($tolike, $like)
            ->get()
            ->result();
    }

    //Une liste avec like + group by
    public function getSearchListGrouped($table, $colonnes, $like, $grouppement)
    {
        return $this->db->select($colonnes)
            ->from($table)
            ->like($like)
            ->group_by($grouppement)
            ->get()
            ->result();
    }
    public function query($query){
        return $this->db->query($query);
    }
	
	public function getSimpleListWithManyOr($table, $columns, $array_where_or, $order, $typeorder){
		$query = 'SELECT '.$columns.' FROM '.$table.' WHERE ';
		$i = 0;
		foreach($array_where_or as $column => $value){
			$query .= $column." LIKE '%".$value."%' ";
			if($i < count($array_where_or) - 1) $query .= 'OR ';
			$i++;
		}
		$query .= 'ORDER BY '.$order.' '.$typeorder;
		echo $query;
		return $this->db->query($query)->result();
	}
	public function getSimpleListWithManyOr4($table, $columns, $columnwhere, $array_where_or, $order, $typeorder){
		$query = 'SELECT '.$columns.' FROM '.$table.' WHERE ';
		$i = 0;
		foreach($array_where_or as $value){
			$query .= $columnwhere." = '".$value."' ";
			if($i < count($array_where_or) - 1) $query .= 'OR ';
			$i++;
		}
		$query .= 'ORDER BY '.$order.' '.$typeorder;
		return $this->db->query($query)->result();
	}
	
	public function getSimpleListWithManyOr2($table, $columns, $array_where_or, $indication, $valeurindication, $order, $typeorder){
		$query = 'SELECT '.$columns.' FROM '.$table.' WHERE (';
		$i = 0;
		foreach($array_where_or as $column => $value){
			$query .= $column." LIKE '%".$value."%' ";
			if($i < count($array_where_or) - 1) $query .= 'OR ';
			$i++;
		}
		$query .=') AND '.$indication." = '".$valeurindication."'" ;
		$query .= 'ORDER BY '.$order.' '.$typeorder;
		return $this->db->query($query)->result();
	}
	public function getSimpleListWithManyOr3($table, $columns, $array_or, $indication, $valeurindication, $order, $typeorder){
		$query = 'SELECT '.$columns.' FROM '.$table.' WHERE (';
		for($i = 0; $i < count($array_or); $i++){
			$query .= $array_or[$i];
			if($i < count($array_or) - 1) $query .= 'OR ';
		}
		$query .=') AND '.$indication." = '".$valeurindication."'" ;
		$query .= 'ORDER BY '.$order.' '.$typeorder;
		return $this->db->query($query)->result();
	}
	public function getSimpleListWithManyOr2Group($table, $columns, $array_where_or, $indication, $valeurindication, $group, $order, $typeorder){
		$query = 'SELECT '.$columns.' FROM '.$table.' WHERE (';
		$i = 0;
		foreach($array_where_or as $column => $value){
			$query .= $column." LIKE '%".$value."%' ";
			if($i < count($array_where_or) - 1) $query .= 'OR ';
			$i++;
		}
		$query .=') AND '.$indication." = '".$valeurindication."'" ;
		$query .= 'GROUP BY '.$group.' ';
		$query .= 'ORDER BY '.$order.' '.$typeorder;
		return $this->db->query($query)->result();
	}
}