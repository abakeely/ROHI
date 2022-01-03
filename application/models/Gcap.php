<?php


class Gcap extends Gcap_gcap_model
{


    public function get_Organisation($id = FALSE, $_zNomOrganisation='departement', $_iTypeSearch = 0, $id_search = 0){

        global $db;
        $zDatabaseOrigin =  $db['default']['database'] ;
        if ( is_null($id) or $id == "" )
            return [];
        $zSql= 'select * from '.$zDatabaseOrigin.'.'.$_zNomOrganisation;

        switch ($_iTypeSearch){

            case 0:
                if ($id === FALSE){
                    $query  = $this->db->get($zDatabaseOrigin.'.'.$_zNomOrganisation);
                    return $query->result_array();
                }
                $query		= $this->db->get_where($zDatabaseOrigin.'.'.$_zNomOrganisation, array('id' => $id));
                return $query->row_array();
                break;

            case 1:
                if ( is_null($id_search) or $id_search == "" )
                    return [];
                $zSql .= " where departement_id IN (".$id.") and id=$id_search ORDER BY departement_id,id ";
                $query = $this->db->query($zSql);
                return $query->result_array();
                break;

            case 2:
                if ( is_null($id_search) or $id_search == "" )
                    return [];
                $zSql .= " where direction_id IN (".$id.") and id=$id_search ORDER BY direction_id,id ";
                $query = $this->db->query($zSql);

                return $query->result_array();
                break;

            case 3:
                $zSql .= " where service_id IN (".$id.") ORDER BY service_id,id ";
                $query = $this->db->query($zSql);
                return $query->result_array();
                break;
        }

        
        return $query->row_array();
    }
}