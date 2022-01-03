<?php 
/**
* @package ROHI
* @subpackage Documentation2
* @author Division Recherche et Développement Informatique
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Documentation extends MY_Controller {
		

	/** 
	* Recherche livre à partir 
	* des champs poster depuis un formulaire
	*
	*
	* @return view
	*/
	function recherche_livre(){
		$data = array();
		if(isset($_POST['theme_livre_id']) && $_POST['theme_livre_id'] != 0)
			$data['theme_livre_id'] = $_POST['theme_livre_id'];
		
		if(isset($_POST['titre_livre']))
			$data['titre_livre'] = $_POST['titre_livre'];
		
		if(isset($_POST['cote_livre']))
			$data['cote_livre'] = $_POST['cote_livre'];
			
		if(isset($_POST['auteur_livre_id']))
			$data['auteur_livre_id'] = $_POST['auteur_livre_id'];
		
		if(isset($_POST['edition_livre']))
			$data['edition_livre'] = $_POST['edition_livre'];
			
		if(isset($_POST['lieu_livre_id']))
			$data['lieu_livre_id'] = $_POST['lieu_livre_id'];
		
		if(isset($_POST['langue_livre_id']))
			$data['langue_livre_id'] = $_POST['langue_livre_id'];
		
		if(isset($_POST['format_livre']))
			$data['format_livre'] = $_POST['format_livre'];
		
		if(isset($_POST['nombre_page_livre']))
			$data['nombre_page_livre'] = $_POST['nombre_page_livre'];
						
		if(isset($_POST['nombre_explaire_livre']))
			$data['nombre_explaire_livre'] = $_POST['nombre_explaire_livre'];
		
		$result = $this->livre->get_livre_by_critere($data);
		
		
		if(sizeof($result>0)){
			$data_json = array();
			$data_json['list_livre'] = $this->complete_list_livre($result);
			
			$list_edition = $this->livre->get_list_edition_by_critere($data);
			$list_langue = $this->livre->get_list_langue_by_critere($data);
			$list_lieu = $this->livre->get_list_lieu_by_critere($data);
			$list_auteur = $this->livre->get_list_auteur_by_critere($data);
			
			if(sizeof($list_edition>0))
				$data_json['list_edition'] = $list_edition;
			
			if(sizeof($list_langue>0))
				$data_json['list_langue'] = $this->complete_list_langue($list_langue);
			
			if(sizeof($list_lieu>0))
				$data_json['list_lieu'] = $this->complete_list_lieu($list_lieu);
			
			if(sizeof($list_auteur>0))
				$data_json['list_auteur'] = $this->complete_auteur($list_auteur);
			
		}
		
		
		echo json_encode($data_json);
	}

	/** 
	* recherche livre
	*
	* @param int $id identifiant du livre
	*
	* @return view
	*/
	function reserver_livre($id){
		$user = $this->get_current_user();
		
		$pret = array();
		$pret['livre_id'] = $id;
		$pret['user_id'] = $user['id'];
		$pret['statut'] = 0;
		$pret['date_reservation'] = date('Y-m-d\TH:i:s');
		
		$this->pret_livre->insert($pret);
		
		redirect('documentation/liste_pret');
	}
	
	/** 
	* liste notification à afficher dans le module SAD
	*
	*
	* @return view
	*/
	function list_notification(){
		$user = $this->get_current_user();
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$list_notification = $this->notification->get_notification($user['id']);
		$data['list_notification'] = $list_notification;
		
		return $this->load_my_view('documentation/list_notification',$data);
	}
	
	/** 
	* complete list livre
	*
	* @param objet $list_livre liste livre
	*
	* @return view
	*/
	private function complete_list_livre($list_livre){
		$ret = array();
		
		foreach($list_livre as $livre){
			$livre = $this->complete_livre($livre);
			array_push($ret, $livre);
		}
		
		return $ret;
	}

	/** 
	* complete list livre
	*
	* @param objet $livre liste livre
	*
	* @return view
	*/
	private function complete_livre($livre){
		if($livre->theme_livre_id)
			$livre->theme_livre = $this->theme_livre->get_theme_livre($livre->theme_livre_id);
		
		if($livre->auteur_livre_id)
			$livre->auteur_livre = $this->auteur_livre->get_auteur_livre($livre->auteur_livre_id);
		
		if($livre->lieu_livre_id)
			$livre->lieu_livre = $this->lieu_livre->get_lieu_livre($livre->lieu_livre_id);
		
		if($livre->langue_livre_id)
			$livre->langue_livre = $this->langue_livre->get_langue_livre($livre->langue_livre_id);
		
		return $livre;
	}
	
	/** 
	* completer la langue 
	*  
	* @param objet $list_langue liste de la langue
	*
	* @return view
	*/
	private function complete_list_langue($list_langue){
		$ret = array();
		foreach($list_langue as $langue){
			$lang = $this->langue_livre->get_langue_livre($langue->langue_livre_id);
			array_push($ret, $lang);
		}
		return $ret;
	}
	
	/** 
	* completer la liste des lieu
	*
	* @param objet $list_lieu liste des lieu 
	*
	* @return view
	*/
	private function complete_list_lieu($list_lieu){
		$ret = array();
		foreach($list_lieu as $lieu){
			$lang = $this->lieu_livre->get_lieu_livre($lieu->lieu_livre_id);
			array_push($ret, $lang);
		}
		return $ret;
	}
	
	/** 
	* completer l'auteur
	*
	* @param objet $list_auteur liste  
	*
	* @return view
	*/
	private function complete_auteur($list_auteur){
		$ret = array();
		foreach($list_auteur as $auteur){
			$au = $this->auteur_livre->get_auteur_livre($auteur->auteur_livre_id);
			array_push($ret, $au);
		}
		return $ret;
	}
	
	/** 
	* completer pret liste 
	*
	* @param objet $list liste  
	*
	* @return view
	*/
	private function complete_pret_list($list){
		$ret = array();
		foreach($list as $pret){
			$livre = $this->livre->get_livre($pret->livre_id);
			$livre = $this->complete_livre($livre);
			$pret->livre = $livre;
			$pret->candidat = current($this->candidat->get_by_user_id($pret->user_id));;
			array_push($ret, $pret);
		}
		return $ret;
	}
	
	/** 
	* listing prêt livre de l'agent connecté
	*
	* @return view
	*/
	private function checkMyPretList(){
		$user = $this->get_current_user();
		$list_pret_livre = $this->pret_livre->get_pret_valide_by_user_id($user['id']);
		$this->notification->clearNotificationNow($user['id']);
		foreach($list_pret_livre as $pret){
			$livre = $this->livre->get_livre($pret->livre_id);
			$diff = $this->dateDiff(date('Y-m-d H:i:s'),$pret->date_retour);
			if($diff<=2){
				 if($diff>0){
					$msg = "Il vous reste $diff jours pour rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"reste quelques jours");
				}
				else if($diff>=0 && $diff<1){
					$msg = "Il est temps de rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"Rendre livre");
				}
				else{
					$msg = "Vous etes en retard pour rendre le livre $livre->titre_livre de cote $livre->cote_livre";
					$this->notification->notify($user['id'],$msg,"retard de retour");
				}
			}
		}
	}
	
	/** 
	* difference de deux date 
	*
	* @param date $date1 date1
	* @param date $date2 date2
	*
	* @return view
	*/
	private function dateDiff($date1, $date2){
		$s = strtotime($date2)-strtotime($date1);
		$d = intval($s/86400)+1;
	 
		return $d;
	}
	
	/** 
	* Vérification livre
	*
	* @param string $_sCote
	*
	* @return view
	*/
	public function verifier_livre($cote){
		$data = array();
		
		$livre = $this->livre->get_livre_by_cote($cote);
		
		if($livre){
			$livre =  $this->complete_livre($livre);
			$data['livre'] = $livre;
			$data['statut'] = "ok";
		}
		else{
			$data['statut'] = "ko";
		}
		echo json_encode($data);
	}
		
	/** 
	* liste des utilisateurs de SAD
	*
	* @param date $dateStart date debut
	* @param date $dataEnd date fin
	*
	* @return view
	*/
	public function list_user_sad($dateStart=false,$dataEnd=false){
		if($dateStart==false){
			$list = $this->sad_connected->get_all_user_sad_now();
		}
		else{
			$list = $this->sad_connected->get_all_user_sad_intervalle(date($dateStart),date($dataEnd));
		}
		$data = array();
		$data['list_user'] = $list;
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10 ;
		return $this->load_my_view('documentation/user_sad',$data);
	}
	
	/** 
	* consultation sur place
	*
	* @return view
	*/
	public function consultation_surplace(){
		
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10;
		return $this->load_my_view('documentation/consultation_surplace',$data);
	}

	/** 
	* consultation cybertnet
	*
	* @return view
	*/
	public function conexion_cybernet(){
		
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10;
		return $this->load_my_view('documentation/conexion_cybernet',$data);
	}
		
	/** 
	* Agent connecté
	*
	* @return view
	*/
	public function agent_conecter(){
		
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10;
		return $this->load_my_view('documentation/agent_conecter',$data);
	}

	/** 
	* Statistiques
	*
	* @return view
	*/
	public function statistiques(){
		
		$data = array();
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =10;
		return $this->load_my_view('documentation/statistiques',$data);
	}
	
	/** 
	* list connecté par
	*
	* @return view
	*/
	public function list_connected_by(){	
		$data = array();
		$dateStart = $this->input->post("dateDeb");
		$dataEnd = $this->input->post("dateFin");
		$by = $this->input->post("nb_by");
		$data['dateDeb'] = $dateStart;
		$data['dateFin'] = $dataEnd;
		$data['by'] = $by;
		$data['menu'] = 3;
		$data['iModuleActif'] = -2;
		$data['menu_lucia'] =5 ;
		
		if($dateStart!=null && $dataEnd!=null){
			$dateStart = $this->date_fr_to_en($dateStart,'/','-');
			$dataEnd = $this->date_fr_to_en(dataEnd,'/','-');
			$list = $this->sad_connected->get_nb_user_connected_by(date($dateStart),date($dataEnd),$by);
		}
		$data['list_user'] = $list;
		return $this->load_my_view('documentation/list_connected_by',$data);
	}
		

}
