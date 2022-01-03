<?php
/**
* @package ROHI
* @subpackage Enquete
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Enquete extends MY_Controller {

	
	/**  
	* Classe qui concerne l'enquete
	* @package  ROHI  
	* @subpackage ACCES */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('reponse_model','reponse');
	}
	
	/** 
	* Nouveau enquete
	* 
	* @return view
	*/
	public function new_enquete(){
		$this->checkConnexion();
		
		$user = $this->get_current_user();
		$data['user'] = $user['id'];
		$this->load->view('enquete/raketa', $data);
		$this->load->view('enquete/enquete', $data);
	}

	/** 
	* Titre
	* 
	* @return view
	*/
	public function titre(){
		$this->checkConnexion();
		
		$user = $this->get_current_user();
		$data['user'] = $user['id'];
		$this->load->view('cv/raketa', $data);
		$this->load->view('cv/titre', $data);
	}
	
	/** 
	* Sauvegarde enquete
	* 
	* @return view
	*/
	public function save_titre(){
		$this->checkConnexion();
		$user_id = $_SESSION['user']['id'];
		$res = $_POST['question_id'];
		$reponse = $_POST['reponse_id'];
		$date_now = date("Y-m-d");
		$sql = 'insert into `reponse`(`reponse_Date`, `repondeur_Id`, `question_Id`, `choix_Id`) VALUES (\''.$date_now.'\','.$user_id.',\''.$res.'\','.$reponse.')';
		$req = mysql_query($sql, $cnx) or die(mysql_error());
		echo 'question '.$res.' reponse = '.$reponse.' date='.$user_id ;
	}
		
	/** 
	* lancement du questionnaire
	* 
	* @return view
	*/
	public function start_questionnnaire(){
		$this->checkConnexion();
		$user = $this->get_current_user();
		$data['user'] = $user['id'];
		$data['selected_post'] = $_POST['data'];
		
		$test = $this->load->view('cv/enquete', $data, true);			
		echo $test;
	}
	
	/** 
	* Sauvegarde questionnaire
	* 
	* @return view
	*/
	public function save_questionnaire(){
		$this->checkConnexion();
		
		$user = $this->get_current_user();
		$user_id = $user['id'];
		$res = $_POST['question_id'];
		$reponse = $_POST['reponse_id'];
		
		/*$cnx = mysql_connect("127.0.0.1","root","");
		$db = mysql_select_db("rohi");*/
		$date_now = date("Y-m-d");
		
		$sql = 'insert into `reponse`(`reponse_Date`, `repondeur_Id`, `question_Id`, `choix_Id`) VALUES (\''.$date_now.'\','.$user_id.',\''.$res.'\','.$reponse.');';
		
		// stockage des requetes dans la session géré par codeIgniter
		$requete = $this->get_user_data('req_questionnaire');
		$requete[] = $sql;
		$this->session->set_userdata('req_questionnaire', $requete);
		
		//$_SESSION['req_questionnaire'] = $_SESSION['req_questionnaire'].$sql;
		//$req = mysql_query($sql, $cnx) or die(mysql_error());
		//echo 'question '.$res.' reponse = '.$reponse.' date='.$user_id ;
		//var_dump($this->get_user_data('req_questionnaire'));
	}
	
	/** 
	* renregsitrement
	* 
	* @return view
	*/
	public function enregistrer(){
		$this->checkConnexion();
		$values = $this->get_user_data('req_questionnaire');		 
		$cnx = mysql_connect("127.0.0.1","root","");
		$db = mysql_select_db("rohi");
		//$req = mysql_query($values, $cnx) or die(mysql_error());
		//echo $values[0];
		
		$user = $this->get_current_user();
		
		$user_id= $user['id'];
		
		$res = $_POST['data'];
		$categ = $_POST['categorie'];
		
		// recuperation list question id
		$date_now = date("Y-m-d");
		$sql = 'select distinct questionnaire.question_Id from questionnaire join cat_questionnaire on questionnaire.cat_Id=cat_questionnaire.cat_Id where cat_questionnaire.cat_Type <= '.$categ;
		$req = mysql_query($sql) or die(mysql_error());
		$nbr_res = 0;
		
		while ($data = mysql_fetch_array($req)) {
			$nbr_res++;
		}
		mysql_free_result($req);
		
		// list reponse déjà effectué
		$sql = 'select distinct reponse_Id from reponse where repondeur_Id='.$user_id;
		$req = mysql_query($sql) or die(mysql_error());
		$nbr_data = 0;

		while ($data = mysql_fetch_array($req)) {
			$nbr_data++;
		}
		
		mysql_free_result($req);
		
		// insertion du reponse
		for ($x = $nbr_data; $x <= count($values)-1; $x++) {
			$req = mysql_query($values[$x], $cnx) or die(mysql_error());
		}
		
		$req = mysql_query($sql) or die(mysql_error());
		$nbr_data = 0;
		while ($data = mysql_fetch_array($req)) {
			$nbr_data++;
		}
		
		mysql_free_result($req);
		//echo $nbr_res.' '.$nbr_data;
		if($nbr_res == $nbr_data){
			if(str_word_count($res, 0) != 0) {
				$res = addslashes($res);
				$sql = 'insert into enquete_proposition(`repondeur_Id`, `proposition`) values (\''.$user_id.'\',\''.$res.'\')';
				$req = mysql_query($sql, $cnx) or die(mysql_error());
				//mysql_free_result($req);                    
			}
			echo "ENREGISTREMENT EFFECTUE AVEC SUCCES. \n
				Nous vous remercions de votre collaboration \n
				Misaotra indrindra amin'ny fiaraha-miasa";
		}else{
			echo "\n ENREGISTREMENT ECHOUE, \n
			VEULLEZ REPONDRE A TOUTES LES QUESTIONS";
			//echo "Enregistrement Effectues avec succes. \n
				//Nous vous remercions de votre collaboration";
		} 
	}
}