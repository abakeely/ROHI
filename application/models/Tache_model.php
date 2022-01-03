<?php

Class Tache_model extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}
    /**
     * Retourne toutes les taches tout projet confondu
     */
    function all()
    {
        return $this->db
            ->select('*')
            ->from('gantt_tasks')
            ->get()
            ->result();
    }
	
	

    /**
     * @param $sText (nom de la tâche)
     * Retourne une tache en fonction de son nom
     */
    function get($sText)
    {
        return $this->db
            ->select('*')
            ->from('gantt_tasks')
            ->where('text',$sText)
            ->limit(1)
            ->get()
            ->result();

    }

    /**
     * Créé une tache
     * @param $pnum
     * @param $unum
     * @param $tnom
     * @param $tdescr
     * @param $tetat
     * @return bool
     */
    /*function 
	+++
	
	
	
*/
	
	function create($iId,$iPnum,$iUnum,$sText,$sTdescr,$start_date,$iDuration,$progress,$iParent,$end_date,$tetat){
		
        $oData = array(
				'gantt_id' => $iId,
				
                'pnum' => $iPnum,
                'user_id' => $iUnum,
                'text' => $sText,
                'tdescr' => $sTdescr,
				'start_date' => $start_date,
				'duration' => $iDuration,
				'progress' => $progress,
				'parent' => $iParent,
				
				'end_date' => $end_date,
                'tetat' => $tetat,
				
				
				
				
        );
        $this->db->insert('gantt_tasks',$oData);

        return true;
    }

    /**
     * Supprime une tache en fonction de son numéro
     * @param $tnum
     */
    function remove($iId){
        $this->db
            ->where('id',$iId)
            ->delete('gantt_tasks');
    }

    /**
     * retourne le numéro d'une tache en fonction de son nom
     * @param $tnom
     * @return mixed
     */
    function getNum($sText){
        $query = $this->db
            ->select('id')
            ->from('gantt_tasks')
            ->where('text',$sText)
            ->get();

        $result = $query->result();
        return $result;
    }

  

    /**
     * affecte un utilisateur à la tache
     * @param $tnum , numéro de la tache
     * @param $unum , numéro de l'utilisateur
     */
    function setUser($iId,$iUnum){
        $this->db->update('gantt_tasks',['user_id'=>$iUnum],['id'=>$iId]);
        return;
    }

   


    /**
     * Vérifie si l'utilisateur est le propriétaire de la tache
     * Retourne un booléen
     * @param $tnum , numéro de la tache
     * @param $unum , numéro de l'utilisateur
     * @return bool , réponse de la requete
     */
    function verifyOwner($iId,$iUnum){
        if ($this->db
            ->select('id')
            ->from('gantt_tasks')
            ->where('user_id',$iUnum)
            ->where('id',$iId)
            ->get()
            ->result())
            return true;
        else
            return false;
    }
	
	function setTacheTo_A_FAIRE($iId){
        $this->db->update('gantt_tasks',['tetat'=>'À faire'],['id'=>$iId]);
        return;
    }
	
	public function getAllRecords($iGanttId){
		$query=$this->db->get_where('gantt_tasks',array('gantt_id'=>$iGanttId));
		if($query->num_rows()>0){
			$record = $query->row();
			return $record;
		}
		
		
	}
	
	public function updateRecords($iGanttId,$oData){
		return $this->db->where('gantt_id',$iGanttId)->update('gantt_tasks',$oData);
		
	}

}
?>