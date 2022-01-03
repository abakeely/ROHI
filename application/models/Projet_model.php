<?php

class Projet_model extends CI_Model
{
    /**
     * Créé un projet

     * @param $pnom , le nom du projet
     * @param $pdescr , la description du projet
     * @return bool , retourne vrai si le projet est crée, false sinon
     *
     */
	 
	 public function __construct(){
		$this->load->database();
		$this->load->model('utilisateur_model','utilisateur');
	}
	
	function get_all_tache_by_projet_id($projet_id){

            $tachesAffectees = $this->db
				->select('*')
				->from('gantt_tasks')
                ->where('pnum',$projet_id)
                ->get()
                ->result();
				
            return $tachesAffectees;

    }
    function create($sPnom,$sPdescr){
        $oData = array(
            'pnom' => $sPnom,
            'pdescr' => $sPdescr,
        );
        $this->db->insert('projet',$oData);
		return $this->db->insert_id();
    }
	//modification projet
	public function get_projet(){
   $DB1=$this->load->database('default',TRUE);
		$sql= "SELECT * FROM projet ";
		 
		 $query = $this->db->query($sql); 
         $dep= $query->result();
		  
         return $dep;
     
	}
	
	
	
	public function getAllTache($iId ){
		$query=$this->db->get_where('gantt_tasks',array('id'=>$iId ));
		if($query->num_rows()>0){
			$record = $query->row();
			return $record;
		}
		
		
	}
	public function updateTache($iId,$data){
		return $this->db->where('id',$iId)->update('gantt_tasks',$data);
		
		
	}
	
	
	
	public function deleteProjet($iPnum){
		return $this->db->delete('projet',array('pnum'=>$iPnum));
		
	}
	
	
//modification projet
    /**
     * Retourne tout les projets de la base projet
     */
    function all()
    {
        return $this->db->select('*')
            ->from('projet')
            ->get()
            ->result();
    }
	
	
	 /**
     * Retourne un projet via le nom du projet
     * @param $pnom , le nom du projet
     */
    function get_by_id($idProjet)
    {
        return $this->db->select('*')
            ->from('projet')
            ->where('pnum',$idProjet)
            ->limit(1)
            ->get()

            ->result()[0];
    }
	

    /**
     * Retourne un projet via le nom du projet
     * @param $pnom , le nom du projet
     */
    function get($sPnom)
    {
        return $this->db->select('*')
            ->from('projet')
            ->where('pnom',$sPnom)
            ->limit(1)
            ->get()

            ->result()[0];
    }
    /**
     * @param $pnum , le numéro du projet
     * Retourne un projet via le numéro du projet
     *
     */
    function getByNum($iPnum)
    {
        return $this->db
            ->select('*')
            ->from('projet')
            ->where('pnum',$iPnum)
            ->limit(1)
            ->get()
            ->result()[0];
    }


    /**
     * Retourne le numéro du projet via son nom
     * @param $pnom , le nom du projet
     */
    function getNum($sPnom){
        return $this->db
            ->select('pnum')
            ->from('projet')
            ->where('pnom',$sPnom)
            ->limit(1)
            ->get()
            ->result()[0];
    }



    /**
     * Créé une affectation d'un utilisateur à un projet
     * l'utilisateur est alors affecté au projet.
     * @param $unum , le numéro de l'utilisateur
     * @param $pnum , le numéro du projet
     * @return bool
     */
    function createAffectation($iUnum, $iPnum)
    {
        $oData = array(
            'id' => $iUnum,
            'pnum' => $iPnum,
        );
        $this->db->where($oData);
        $q = $this->db->get('affectation');

        if ($q->num_rows() == 0) {
            $this->db->insert('affectation', $oData);
            return true;
        }
        return true;
    }

        /**
         * Efface une affection d'un utilisateur à un projet
         * @param $unum , le numéro de l'utilisateur
         * @param $pnum , le numéro du projet
         * @return bool
         */
        function delAffectation($iUnum, $iPnum){
            $this->db
                ->select('*')
                ->from('affectation')
                ->where('pnum',$iPnum)
                ->where('id',$iUnum)
                ->delete('affectation');

            return true;
        }
		
		

        /**
         * Retourne toute les taches d'un projet via le numéro du projet
         * @param $pnum , le numéro du projet
         * @return array , tableau des taches d'un projet
         */
		 
		
        function getAllTachesByProjectNumero($iPnum){

            $tachesAffectees = $this->db
			
			
                ->select('*')
		
                ->from('gantt_tasks')
				->join('candidat',' candidat.id= gantt_tasks.user_id')
                ->where('pnum',$iPnum)
                ->get()
                ->result();
				
				

            $tachesNonAffectees = $this->db
                // ->select('*')
                ->from('gantt_tasks')
                ->where('pnum',$iPnum)
                ->where('user_id',0)
                ->get()
                ->result();

            return array_merge($tachesAffectees,$tachesNonAffectees);

        }

        /**
         * Retourne tout les utilisateurs d'un projet via son numéro
         * @param $pnum , le numéro du projet
         * @return array
         */
        function getAllUsersByProjectNumero($iPnum){
            $result = $this->db
                ->select('id')->from('affectation')->where('pnum',$iPnum)
                ->get()->result();
            $oDatas = array();

            foreach($result as $user){
                $this->db
                   // ->select('*')->from('user')->where('id',$user->id);
				   ->select('*')->from('candidat')->where('id',$user->id);
                $query = $this->db->get();
                $result = $query->result();
                $oDatas[] = $result[0];
            }

            return $oDatas;
        }

		

        /**
         * Retourne tout les utilisateurs non affectés
         * @param $pnum , le numéro du projet
         * @return array
         */
        function getAllUsersNonAffectes($iPnum){
            $this->load->model('utilisateur_model','utilisateur');
            $sAll = $this->utilisateur->getAll();
            $sMembers = $this->getAllUsersByProjectNumero($iPnum);

            $oNonAffectes = array();
            foreach($sAll as $user){
                if (!in_array($user, $sMembers))
                    $oNonAffectes[] = $user;
            }
            return $oNonAffectes;
        }
		
		

        /**
         * Définit le nom du projet via son numéro
         * @param $pnum , le numéro du projet
         * @param $pnom
         */
        function setName($iPnum,$sPnom){

            $query = 'UPDATE projet
                  SET pnom = "'.$sPnom.'"
                  WHERE pnum = '.$iPnum;
            $result = $this->db->query($query);
            return $result;
        }

        /**
         * Définit la description du projet via son numéro
         * @param $pnum , le numéro du projet
         * @param $pdescr , la description du projet
         */
        function setDescr($iPnum,$sPdescr){
            $query = 'UPDATE projet
                  SET pdescr = "'.$sPdescr.'"
                  WHERE pnum = '.$iPnum;
            $result = $this->db->query($query);
            return $result;
        }
		
		public function deleteTache($iGanttId){
		return $this->db->delete('gantt_tasks',array('gantt_id'=>$iGanttId));
		
	}
		
		
	
		
    }
?>