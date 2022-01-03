<?php

class Questionnaire_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	/***OLD****/
	public function getPreviousQuestion($_question_id,$_answer_id,$_user_id){
		$sql= " SELECT *,
					(SELECT quiz_resultats_answers_id FROM quiz_resultats WHERE quiz_resultats_questions_id =a.quiz_questions_id AND quiz_resultats_user_id ='".$_user_id."') answer_choose,
					(SELECT quiz_resultats_commentaire FROM quiz_resultats WHERE quiz_resultats_questions_id =a.quiz_questions_id AND quiz_resultats_user_id ='".$_user_id."') quiz_resultats_commentaire
				FROM quiz_questions a 
				LEFT JOIN quiz_answers b ON a.quiz_questions_id = b.quizz_questions_id 
				WHERE a.quizz_questions_numero ='".$_question_id."' 
				 ";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	public function getNextQuestion($_question_id,$_answer_id,$_user_id){
		$sql= " SELECT *,
					(SELECT quiz_resultats_answers_id FROM quiz_resultats WHERE quiz_resultats_questions_id =a.quiz_questions_id AND quiz_resultats_user_id ='".$_user_id."') answer_choose,
					(SELECT quiz_resultats_commentaire FROM quiz_resultats WHERE quiz_resultats_questions_id =a.quiz_questions_id AND quiz_resultats_user_id ='".$_user_id."') quiz_resultats_commentaire
				FROM quiz_questions a 
				LEFT JOIN quiz_answers b ON a.quiz_questions_id = b.quizz_questions_id 
				WHERE a.quizz_questions_numero ='".$_question_id."' 
				 ";
		if ($_answer_id){
			$sql= $sql . " AND reponse_de_la_question_precedent LIKE '%,".$_answer_id.",%'";
		}
		//echo $sql;die;
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	public function deleteQuestion($_user_id , $_question_id, $_answer_id){
		$sql= " delete from rohi.quiz_resultats where quiz_resultats_user_id ='".$_user_id."' and quiz_resultats_questions_id >= ".$_question_id ;
		$query = $this->db->query($sql);
	}
	
	public function saveQuestion($_user_id , $_question_id, $_answer_id,$quiz_resultats_commentaire){
		$sql= " insert into rohi.quiz_resultats  (quiz_resultats_user_id,quiz_resultats_questions_id,quiz_resultats_answers_id,quiz_resultats_date_creation,quiz_resultats_commentaire) values ('".$_user_id."','".$_question_id."','".$_answer_id."',NOW(),'".$quiz_resultats_commentaire."') ";
		$query = $this->db->query($sql);
	}
	
	public function updateQuestion($_user_id ,$porte,$fonction,$structureId,$lieu_service,$first_comments,$second_comments){
		$sql= "  UPDATE rohi.quiz_resultats 
					SET quiz_resultats_porte 		='".$porte."', 
						quiz_resultats_fonction 	='".$fonction."', 
						quiz_resultats_structureId 	='".$structureId."',
						quiz_resultats_lieu_service ='".$lieu_service."',
						first_comments				='".$first_comments."',
						second_comments 			='".$second_comments."'
				 WHERE quiz_resultats_user_id 		='".$_user_id."' ";
		$query = $this->db->query($sql);
	}
	
	public function updateCommentaire($_user_id ,$question_id,$commentaire){
		$sql= "  UPDATE rohi.quiz_resultats 
						SET quiz_resultats_commentaire 	= '".$commentaire."'
				 WHERE quiz_resultats_user_id 			= '".$_user_id."'
				 AND quiz_resultats_questions_id        = '".$question_id."'
				 ";
		$query = $this->db->query($sql);
	}
	
	public function ajaxCountResultats($parameters,$child_id){
		$sql	=	" SELECT COUNT(DISTINCT user_id) as nb_records
				 FROM rohi.candidat a 
				 INNER JOIN rohi.quiz_resultats b
				 ON a.user_id = b.quiz_resultats_user_id
				where a.structureId in (SELECT  t_structure_new.child_id
				FROM    (SELECT * FROM t_structure
						 ORDER BY parent_id, child_id) t_structure_new,
						(SELECT @pv := '".$child_id."') initialisation
				WHERE   FIND_IN_SET(parent_id, @pv)
				AND		sanction IN('00','34','40')
				AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0) ";
		if( count($parameters) > 0 ){
			$sql	=	 $sql . " AND " .implode(" AND ",$parameters) ;
		} 
	
		$query = $this->db->query($sql); 
		return $query->row_array();
    }

	public function getResultats($parameters, $ofset =0, $limit =100000000 ,$_list_agent=""){
		
		$sql	=	" SELECT DISTINCT a.*
						 FROM rohi.candidat a 
						 INNER JOIN rohi.quiz_resultats b
						 ON a.user_id = b.quiz_resultats_user_id
						where a.structureId in ($_list_agent) ";
		if( sizeof($parameters) > 0 ){
			$sql	=	$sql . implode(" and ", $parameters) ;	
		}
		//print_r($sql);die;
		$sql= $sql . " limit $ofset , $limit ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getStatistique($_groupe,$_user_id){
		$sql	=	" SELECT a.* ,
							(SELECT quiz_answers_value FROM quiz_resultats a INNER JOIN quiz_answers b ON a.quiz_resultats_answers_id =    b.quiz_answers_id WHERE quiz_resultats_questions_id = a.quiz_questions_id AND quiz_resultats_user_id ='".$_user_id."') reponse
						FROM quiz_questions	a
						WHERE a.quizz_questions_group ='".$_groupe."' 
						";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getStructure($_user_id){
		$sql= " SELECT * 
				FROM rohi.t_structure a
				INNER JOIN rohi.t_sites b
				ON a.site_id = b.site_id
				INNER JOIN rohi.t_regions c
				ON a.region_id = c.region_id
				INNER JOIN rohi.t_districts d
				ON a.district_id = d.district_id
				WHERE a.child_id =(SELECT DISTINCT quiz_resultats_structureId
				FROM quiz_resultats
				WHERE quiz_resultats_user_id = '".$_user_id."')
				 ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function getFonction($_user_id){
		$sql= " SELECT DISTINCT b.*
				 FROM rohi.quiz_resultats a
				 INNER JOIN rohi.quiz_referentiels b
				 ON a.quiz_resultats_fonction = b.quiz_referentiel_id
				 WHERE quiz_resultats_user_id ='".$_user_id."'
				 ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	
	public function getRangQuestion($_user_id){
		$sql= " SELECT IFNULL( MAX(quiz_resultats_questions_id),'0') rang_question
				 FROM quiz_resultats 
				 WHERE quiz_resultats_user_id = '".$_user_id."' ";
		$query = $this->db->query($sql); 
		return $query->row_array();
    }
	
	public function getRepport($clauseAnd){
		$sql= "  SELECT  b.quizz_questions_libelle_fr,
						b.quiz_questions_id,
						c.quiz_answers_libelle_fr,
						c.quiz_answers_id,
						c.quiz_answers_value,
						COUNT(a.quiz_resultats_user_id) AS nb
					 FROM quiz_resultats a
					 INNER JOIN quiz_questions b ON a.quiz_resultats_questions_id = b.quiz_questions_id
					 INNER JOIN quiz_answers c ON a.quiz_resultats_answers_id = c.quiz_answers_id
					 WHERE b.quizz_questions_group IN ('GP_02','GP_03','GP_04','GP_05','GP_06','GP_07')
					 $clauseAnd
					 GROUP BY b.quizz_questions_libelle_fr,b.quiz_questions_id,c.quiz_answers_libelle_fr,c.quiz_answers_id,c.quiz_answers_value
					 ORDER BY b.quiz_questions_id ";
		$query = $this->db->query($sql); 
		return $query->result_array();
    }
	
	public function showDiagramme($question_id){
		$sql= " SELECT  b.quizz_questions_libelle_fr,
					b.quiz_questions_id,
					c.quiz_answers_libelle_fr,
					c.quiz_answers_id,
					c.quiz_answers_value,
					COUNT(a.quiz_resultats_user_id) AS nb
				 FROM quiz_resultats a
				 INNER JOIN quiz_questions b ON a.quiz_resultats_questions_id = b.quiz_questions_id
				 INNER JOIN quiz_answers c ON a.quiz_resultats_answers_id = c.quiz_answers_id
				 WHERE b.quizz_questions_group IN ('GP_02','GP_03','GP_04','GP_05','GP_06','GP_07')
				 AND quiz_questions_id ='".$question_id."'
				 GROUP BY 	b.quizz_questions_libelle_fr,
							b.quiz_questions_id,
							c.quiz_answers_libelle_fr,
							c.quiz_answers_id,
							c.quiz_answers_value
				 ORDER BY b.quiz_questions_id 
		";

		$query = $this->db->query($sql); 
		return $query->result_array();
    }
	
	public function getListStructureChild($child_id){
		$sql= " SELECT  GROUP_CONCAT(t_structure_new.child_id) list
				FROM 
				(SELECT * FROM t_structure ORDER BY parent_id, child_id) t_structure_new, 
				(SELECT @pv := '".$child_id."') initialisation 
				WHERE FIND_IN_SET(parent_id, @pv) 
				AND LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
				ORDER BY t_structure_new.child_id ASC ";
		//echo $sql;die;
		$query = $this->db->query($sql); 
		return $query->row_array();
    }
	
	public function getReferentiel($groupe){
		$sql= " SELECT * FROM quiz_referentiels WHERE quizz_referentiel_groupe  ='".$groupe."' ";
		$query = $this->db->query($sql); 
		return $query->result_array();
    }
	
	/*****NEW*****/
	public function do_get_questions($groupe){
		$sql= " SELECT * FROM quiz_questions";
		$query = $this->db->query($sql); 
		return $query->result_array();
    }
	
	public function do_get_sites($child_id){
		$sql= " SELECT distinct b.*
				 FROM t_structure a 
				 INNER JOIN t_sites b
				 ON a.site_id = b.site_id
				 WHERE a.child_id = '".$child_id."'";
		$query = $this->db->query($sql); 
		return $query->result_array();
    }
	
	public function getComments($user_id){
		$sql= " SELECT DISTINCT first_comments,
				   second_comments
				FROM quiz_resultats
				WHERE quiz_resultats_user_id ='".$user_id."' ";
		$query = $this->db->query($sql); 
		return $query->row_array();
    }
}
?>