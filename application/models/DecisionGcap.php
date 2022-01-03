<?php

use Illuminate\Database\Capsule\Manager as DB;

class DecisionGcap extends Decision_gcap_model
{

    public $in_structure = [];
    public $in_structure_array;


    public function get_all_User_rattache($oUser,$_oCandidat,$_iUserId, $_iCompteActif,&$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "ASC", $_zFieldOrder = "c.id", $dep = null, $search = null){

        global $db;

        $DB1 = $this->load->database('gcap', TRUE);
        $zDatabaseOrigin =  $db['default']['database'] ;

        $iAffiche = 0;
        if ($_iCompteActif == COMPTE_AUTORITE  || $_iCompteActif == COMPTE_RESPONSABLE_PERSONNEL) {
            $iAffiche = 1;
        }

        $zNotIn = "";

        $zUserId = $this->getAllUserSubordonnees ($oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,$iAffiche);


        $zSql= "SELECT SQL_CALC_FOUND_ROWS *,c.nom as nom,REPLACE(cin,' ','') as cin, c.prenom as prenom,c.id as id, d.libele as zDirection, s.libele as zService, m.libele as zDivision,c.user_id AS userId, IFNULL((select userCompte_compteId from usercompte WHERE userCompte_userId = userId AND userCompte_compteId = ".COMPTE_EVALUATEUR." LIMIT 0,1),0) as iCompte,
				(SELECT COUNT(decision_id) FROM decision WHERE decision_userId = userId AND decision_statutId = ".STATUT_CREATION.") As nbDecision
				FROM $zDatabaseOrigin.candidat c
				LEFT JOIN $zDatabaseOrigin.departement de ON de.id = c.departement
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
				LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division
				WHERE  1 and c.poste != '' ";

        if ($zUserId != ""){
            $zSql .= " AND user_id IN ($zUserId) " ;
        }



        if ( !is_null($dep) ){
            $current_structure = $this->current_structure_connected( $_iUserId );

            $this->get_visible_structure($dep);
            $in_structure = implode(',',array_values($this->in_structure));

            $zSql .= " AND c.structureId in ($in_structure)";
        }

        if ( !is_null($search) ){
            $zSql .= " and (c.matricule like '%$search%' or c.cin like '%$search%')";
        }

        if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
            $zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
        }
        if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
            $iCin  = $_POST["iCin"] ;
            $zSql .= " AND cin = '" . $iCin . "'" ;
        }
        if ($zNotIn != ""){
            $zSql .= $zNotIn ;
        }

        $zSql .= " GROUP BY c.id " ;


        $zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
        $zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;
        //echo '<pre>', print_r($zSql), '</pre>', exit;
        //die($zSql);
        $zQuery = $DB1->query($zSql);
        $oRow = $zQuery->result_array();
        $zQuery->free_result();

        // nombre des r�sultats trouv�s
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();

        if(sizeof($toRow)>0){
            $_iNbrTotal = $toRow[0]['iNumRows'] ;
        }

        return $oRow;

    }

    public function get_user_subrodonne_by_dep( $dep_id ){
        global $db;
        $sql_eval = "
            select c.id,c.user_id,ev.evaluation_userEvalue from ".$db['rohi']['database'].".user u 
            inner join ".$db['rohi']['database'].".candidat c on c.user_id=u.id 
            inner join ".$db['gcap']['database'].".evaluation ev on ev.evaluation_userId=u.id
            where c.departement=$dep_id and u.statut=5 and ev.evaluation_userEvalue!=''
        ";
        $rs  = DB::select($sql_eval);
        $ids = [];
        foreach ( $rs as $item ){
            $ids[] = str_replace('-',',', $item->evaluation_userEvalue);
        }
        return implode(',', $ids);
    }

    public function get_visible_structure( $current_structure, $return_data = [], $return  = false ){
        global $db;
        $this->in_structure[$current_structure] = $current_structure;
        $sql  = "
            select ts.child_id, ts.path, ts.rang, ts.sigle from ".$db['rohi']['database'].".t_structure ts
            where ts.parent_id = $current_structure
        ";

        $rs = DB::select($sql);
        if ( !is_null($rs) and is_array($rs) and sizeof($rs) ){
            foreach ( $rs as $item ){
                $this->in_structure[$item->child_id] = $item->child_id;
                $return_data[] = $item;
                $this->in_structure_array[$item->child_id] = [$item->child_id, $item->path];
                $this->get_visible_structure($item->child_id, $return_data, $return);
            }

            if ( $return )
                return $return_data;
        }

    }

    public function get_sub_structure($user_id){
        global $db;
        $sql = "
            select st.* from ".$db['rohi']['database'].".t_structure st 
            inner join ".$db['rohi']['database'].".candidat c on c.structureId=st.parent_id 
            where c.user_id=$user_id 
        ";
        $rs = DB::select($sql);
        return ( is_array( $rs ) and sizeof( $rs ) ) ? $rs : false;
    }

    public function current_structure_connected($user_id, $get_data_path = false){
        global $db;
        $sql = "
            select c.structureId from ".$db['rohi']['database'].".candidat c where c.user_id=$user_id
        ";
        $rs = DB::select($sql)[0];
        if ( !$get_data_path )
            return $rs;
        else {
            $sql  = "
            select ts.child_id, ts.path from ".$db['rohi']['database'].".t_structure ts
                where ts.child_id = $rs->structureId
            ";
            $structure = DB::select($sql)[0];
            return [
                $rs->structureId => [$structure->child_id, $structure->path]
            ];
        }
    }

    public function get_user_authority($user_id, $dep = null, $per_page=10, $page=1, $search = null, $order = null, $order_dir = null){
        global $db;
        $current_structure = $this->current_structure_connected($user_id);

        $this->get_visible_structure($current_structure->structureId);
        $in_structure = implode(',',array_values($this->in_structure));
        $dep   = !is_null($dep) ? "and c.structureId=$dep" : "and c.structureId in ($in_structure)";
        $search = !is_null($search) ? " and (c.matricule like '%$search%' or c.cin like '%$search%')" : "";
        $sql  = "
            select c.* from ".$db['rohi']['database'].".candidat c 
            where c.user_id != $user_id  $dep $search
            order by $order $order_dir 
            limit ".($page-1) * $per_page.",$per_page
        ";
        $d =  DB::select($sql);
        $agents = [];
        foreach( $d as $agent ){
            $agents[] = (array)$agent;
        }
        return $agents;

    }

    public function get_path( $structure_path )
    {
        global $db;
        $structure_path = explode('/', $structure_path);
        unset($structure_path[0]);
        $path  = [];
        //echo '<pre>', print_r($structure_path), '</pre>', exit;
        foreach ( $structure_path as $sigle ){
            $sql = "
                select libele as name from ".$db['rohi']['database'].".departement where sigle_departement='$sigle'
            ";
            $d =  DB::select($sql);
            if ( is_array( $d ) and sizeof( $d ) ){
                $path[] = $d[0]->name;
            } else {
                $sql = "
                    select libele as name from ".$db['rohi']['database'].".service where sigle_service='$sigle'
                ";
                $d =  DB::select($sql);
                if ( is_array( $d ) and sizeof( $d ) ) {
                    $path[] = $d[0]->name;
                } else {
                    $sql = "
                        select libele as name from ".$db['rohi']['database'].".direction where sigle_direction='$sigle'
                    ";
                    $d =  DB::select($sql);
                    if ( is_array( $d ) and sizeof( $d ) ) {
                        $path[] = $d[0]->name;
                    }
                }
            }
        }
        return $path;
    }
}