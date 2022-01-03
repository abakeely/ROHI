<?php

Class Utilisateur_model extends CI_Model
{
    /**
     * Retourne tout les utilisateurs présents dans la table utilisateur
     */
     function getAll()
    {
        $this->db->select('*');
        //$this->db->from('user');
		$this->db->from('candidat');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * retourne tout les responsables de la table utilisateur
     */
    function getResponsable(){
        $this->db->select('*');
		$this->db->from('candidat');
        $query = $this->db->get();
        return $query->result();

    }

    /**
     * @param $unum , le numéro de l'utilisateur
     * Retourne toute les taches d'un utilisateur
     */
    function getAllTachesByUserNumero($iUnum){
        $this->db->select('*');
        $this->db->from('gantt_tasks');
        //$this->db->where('user_id', $unum);
		$this->db->where('user_id', $iUnum);
        $query = $this->db->get();

        return $query->result();

    }

    /**
     * @param $uprenom , le prénom de l'utilisateur
     *  Retourne les informations d'un utilisateur
     */
    function getUserByName($sUprenom){
        $this->db->select('*');
		  $this->db->from('candidat');
        $this->db->where('prenom', $sUprenom);
        $query = $this->db->get();

        return $query->result();
    }

    

   

}
?>