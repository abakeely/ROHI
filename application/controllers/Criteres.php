<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/
ini_set('display_errors', 0);
error_reporting(E_ALL); 
ob_start();

class Criteres extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('User_model','UserService');
		$this->load->model('Criteres_model','Critere');
		$this->load->model('Solde_model','Solde');
		
		$this->sessionStartCompte();
	}
	

	public function index($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		$iModuleId						= 1;
		if($iRet == 1){	
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ;
			$iCompteActif				= $this->getSessionCompte();
			$iTrimestreActif			= $this->Critere->getPeriode()["trimestre"];
			
    		$oData['iSessionCompte']	= $iSessionCompte;
    		$oData['iTrimestreActif']	= $iTrimestreActif;
			$this->load_my_view_Common('eval/index.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function ajaxGetAgent($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$params							=	array();
		
		$oUser							=	array();
		$oCandidat						=	array();
		$this->checkConnexion();
		$iRet							= $this->check($oUser, $oCandidat);
		$iSessionCompte					= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		if($iRet == 1){	
			$page						=	($this->postGetValue ("page","0")-1)*5;
			$rows						=	$this->postGetValue ("rows","1");			
			$filter						=	$this->postGetValue ("filters","");
			$filter						=	json_decode($filter);
			$filters					=	$filter->rules;
			$parameters					=	array() ;
			//array_push( $parameters, " sanction IN('00','34','40') " ) ;
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}
			$zExerciceSuivant			=	$this->Critere->getPeriode()["exercice"];
			$rowCount					=	$this->Critere->ajaxCountAgent($oUser["id"],$zExerciceSuivant,$parameters);
			$toListe					=	$this->Critere->ajaxGetAgent($oUser["id"],$zExerciceSuivant,$parameters,$page,$rows);
			$toDataAssign				=	array();
			foreach ($toListe as $oListe){
				$oDataTemp							=	 array(); 
				$oDataTemp['id']					=	 $oListe['id'];
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['nom']					=	 $oListe['nom'] . '  '.$oListe['prenom'];
				$oDataTemp['matricule']				=	 $oListe['matricule'];
				$oDataTemp['groupe']				=	 $oListe['groupe'];
				$oDataTemp['exercice']				=	 date("Y");

				$oDataTemp['critere011']			=	 $oListe['critere011'];
				$oDataTemp['critere021']			=	 $oListe['critere021'];
				$oDataTemp['critere031']			=	 $oListe['critere031'];
				$oDataTemp['critere041']			=	 $oListe['critere041'];
				$oDataTemp['note01']				=	 ($oListe['critere011'] +$oListe['critere021']+$oListe['critere031']+$oListe['critere041']) ;

				$oDataTemp['critere012']			=	 $oListe['critere012'];
				$oDataTemp['critere022']			=	 $oListe['critere022'];
				$oDataTemp['critere032']			=	 $oListe['critere032'];
				$oDataTemp['critere042']			=	 $oListe['critere042'];
				$oDataTemp['note02']				=	 ($oListe['critere012'] +$oListe['critere022']+$oListe['critere032']+$oListe['critere042']) ;

				$oDataTemp['critere013']			=	 $oListe['critere013'];
				$oDataTemp['critere023']			=	 $oListe['critere023'];
				$oDataTemp['critere033']			=	 $oListe['critere033'];
				$oDataTemp['critere043']			=	 $oListe['critere043'];
				$oDataTemp['note03']				=	 ($oListe['critere013'] +$oListe['critere023']+$oListe['critere033']+$oListe['critere043']) ;

				$oDataTemp['critere014']			=	 $oListe['critere014'];
				$oDataTemp['critere024']			=	 $oListe['critere024'];
				$oDataTemp['critere034']			=	 $oListe['critere034'];
				$oDataTemp['critere044']			=	 $oListe['critere044'];
				$oDataTemp['note04']				=	 ($oListe['critere014'] +$oListe['critere024']+$oListe['critere034']+$oListe['critere044']) ;
				
				$toDataAssign[]						=	 $oDataTemp;
			}
			$iNombreTotal							=	 $rowCount["nb_records"];
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( ceil($iNombreTotal/5) ),
							"records"			=> intval( ceil($iNombreTotal/5) ),
							"rows"              => $toDataAssign
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function ajaxGetDetailAgent(){
		$user_id					=	$this->postGetValue ("parentRowID","") ; 
		$trimestre					=	$this->Critere->getPeriode()["trimestre"];
		$exercice					=	date('Y'); 
		$tzMois						=	array(
												"01"=>"Janvier",
												"02"=>"Fevrier",
												"03"=>"Mars",
												"04"=>"Avril",
												"05"=>"Mai",
												"06"=>"Juin",
												"07"=>"Juillet",
												"08"=>"Aout",
												"09"=>"Septembre",
												"10"=>"Octobre",
												"11"=>"Novembre",
												"12"=>"Decembre",
										) ;
		$toAgent					=	$this->Critere->ajaxGetDetailAgent($user_id);
		$solde_de_base				=	$this->Solde->f_500("0".$toAgent["categorie"],$toAgent["indice"],"");

		$toAgent["solde_de_base"]			=	$solde_de_base;
		$note								=	$this->Critere->getNote($user_id,$trimestre,$exercice);
		if( $note >= 17 && $note <= 20 ){
			$zMoisSuivant					=	$this->Critere->getPeriode()["mois_suivant"];
			$zExerciceSuivant				=	$this->Critere->getPeriode()["exercice"];
			$tzMoisSuivants					=	explode(",",$zMoisSuivant);
			//print_r($tzMoisSuivants);die;
			foreach($tzMoisSuivants as $key=>$oMoisSuivant){

				$zDateDebut						=	$this->date_en_to_fr($toAgent["date_prise_service"],'-','/');
				$zDateFin						=	"30/".$oMoisSuivant."/".$zExerciceSuivant;

				$montant_563					=	$this->Solde->f_563("21",$zDateDebut, $zDateFin,$solde_de_base);
				$toAgent["montant_563_".$key]	=	0.80* $montant_563;
				$toAgent["montant_563_".$key]	=	$toAgent["montant_563_".$key] + 0.20*$montant_563;
				$toAgent["montant_563_".$key]	=	number_format($toAgent["montant_563_".$key], 2, ',', ' ');
				$toAgent["date_interval_".$key]	=	$tzMois	[$oMoisSuivant] ."  ".$zExerciceSuivant ;
			}
		}
		if( $note >= 13 && $note < 17 ){
			$zMoisSuivant					=	$this->Critere->getPeriode()["mois_suivant"];
			$zExerciceSuivant				=	$this->Critere->getPeriode()["exercice"];
			$tzMoisSuivants					=	explode(",",$zMoisSuivant);
			foreach($tzMoisSuivants as $key=>$oMoisSuivant){

				$zDateDebut						=	$this->date_en_to_fr($toAgent["date_prise_service"],'-','/');
				$zDateFin						=	"30/".$oMoisSuivant."/".$zExerciceSuivant;

				$montant_563					=	$this->Solde->f_563("21",$zDateDebut, $zDateFin,$solde_de_base);
				$toAgent["montant_563_".$key]		=	0.80* $montant_563;
				$toAgent["montant_563_".$key]		=	$toAgent["montant_563_".$key] + 0.10*$montant_563;
				$toAgent["montant_563_".$key]		=	number_format($toAgent["montant_563_".$key], 2, ',', ' ');
				$toAgent["date_interval_".$key]		=	$tzMois	[$oMoisSuivant] ."  ".$zExerciceSuivant ;
			}
		}
		if( $note >= 8 && $note < 13 ){
			$zMoisSuivant					=	$this->Critere->getPeriode()["mois_suivant"];
			$zExerciceSuivant				=	$this->Critere->getPeriode()["exercice"];
			$tzMoisSuivants					=	explode(",",$zMoisSuivant);
			foreach($tzMoisSuivants as $key=>$oMoisSuivant){

				$zDateDebut					=	$this->date_en_to_fr($toAgent["date_prise_service"],'-','/');
				$zDateFin					=	"30/".$oMoisSuivant."/".$zExerciceSuivant;

				$montant_563					=	$this->Solde->f_563("21",$zDateDebut, $zDateFin,$solde_de_base);
				$toAgent["montant_563_".$key]	=	0.80* $montant_563;
				$toAgent["montant_563_".$key]	=	$toAgent["montant_563_".$key] + 0.05*$montant_563;
				$toAgent["montant_563_".$key]	=	number_format($toAgent["montant_563_".$key], 2, ',', ' ');
				$toAgent["date_interval_".$key]	=	$tzMois	[$oMoisSuivant] ."  ".$zExerciceSuivant ;
			}
		}
		if( $note >= 0 && $note < 8 ){
			$zMoisSuivant					=	$this->Critere->getPeriode()["mois_suivant"];
			$zExerciceSuivant				=	$this->Critere->getPeriode()["exercice"];
			$tzMoisSuivants					=	explode(",",$zMoisSuivant);
			foreach($tzMoisSuivants as $key=>$oMoisSuivant){

				$zDateDebut						=	$this->date_en_to_fr($toAgent["date_prise_service"],'-','/');
				$zDateFin						=	"30/".$oMoisSuivant."/".$zExerciceSuivant;

				$montant_563					=	$this->Solde->f_563("21",$zDateDebut, $zDateFin,$solde_de_base);
				$toAgent["montant_563_".$key]	=	0.80* $montant_563;
				$toAgent["montant_563_".$key]	=	$toAgent["montant_563_".$key] + 0.00*$montant_563;
				$toAgent["montant_563_".$key]	=	number_format($toAgent["montant_563_".$key], 2, ',', ' ');
				$toAgent["date_interval_".$key]	=	$tzMois	[$oMoisSuivant] ."  ".$zExerciceSuivant ;
			}
		}


		echo json_encode($toAgent);
    }

	public function majEvaluation($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
		if($iRet == 1){	
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ; 
			
			$oData['iUserId']						= $oUser['id'] ;
			$oData['iSessionCompte']				= $iSessionCompte ; 
			$operation								= $this->postGetValue ("oper","") ; 
			$toInfoAgents							= array() ;
			$tzFields								= array() ;
			
			$toInfoAgents['trimestre']				= "01" ; 
			$toInfoAgents['id']						= $this->postGetValue ("id","") ; 
			$id										= $this->postGetValue ("id","") ; 
			$toInfoAgents['user_id']				= $this->postGetValue ("user_id","") ; 
			$user_id								= $this->postGetValue ("id","") ; 
			$trimestre								= $this->Critere->getPeriode()["trimestre"];
			
			//première trimestre
			if($trimestre == 1 ){
			
				if( $this->postGetValue ("critere011","") ){
					$sql	=	 " UPDATE rohi.t_evaluation SET premier_critere ='".$this->postGetValue ("critere011","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}elseif( $this->postGetValue ("critere011","") =="0"){
					$sql	=	 " UPDATE rohi.t_evaluation SET premier_critere ='0' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
					//echo $sql;die;
				if( $this->postGetValue ("critere021","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET deuxieme_critere ='".$this->postGetValue ("critere021","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}elseif( $this->postGetValue ("critere021","") =="0"){
					$sql	=	 " UPDATE rohi.t_evaluation SET deuxieme_critere ='0' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				
				if( $this->postGetValue ("critere031","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET troisieme_critere ='".$this->postGetValue ("critere031","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}elseif( $this->postGetValue ("critere031","") =="0"){
					$sql	=	 " UPDATE rohi.t_evaluation SET troisieme_critere ='0' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if( $this->postGetValue ("critere041","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET quatrieme_trimestre ='".$this->postGetValue ("critere041","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}elseif( $this->postGetValue ("critere041","") =="0"){
					$sql	=	 " UPDATE rohi.t_evaluation SET quatrieme_trimestre ='0' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("groupe","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET groupe ='".$this->postGetValue ("groupe","")."' where 
					user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				
			}
			
			//deuxieme trimestre
			if($trimestre == 2 ){

				if($this->postGetValue ("critere012","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET premier_critere ='".$this->postGetValue ("critere012","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}

				if($this->postGetValue ("critere022","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET deuxieme_critere ='".$this->postGetValue ("critere022","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				} 

				if($this->postGetValue ("critere032","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET troisieme_critere ='".$this->postGetValue ("critere032","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}

				if($this->postGetValue ("critere042","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET quatrieme_trimestre ='".$this->postGetValue ("critere042","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}

				if($this->postGetValue ("groupe","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET groupe ='".$this->postGetValue ("groupe","")."' where 
					user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
			}
			
			//troisième trimestre
			if($trimestre == 3 ){
				if($this->postGetValue ("critere013","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET premier_critere ='".$this->postGetValue ("critere013","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("critere023","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET deuxieme_critere ='".$this->postGetValue ("critere023","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				} 
				if($this->postGetValue ("critere033","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET troisieme_critere ='".$this->postGetValue ("critere033","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("critere043","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET quatrieme_trimestre ='".$this->postGetValue ("critere043","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("groupe","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET groupe ='".$this->postGetValue ("groupe","")."' where 
					user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
			}

			//quatrième trimestre
			if($trimestre == 4 ){
				if($this->postGetValue ("critere014","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET premier_critere ='".$this->postGetValue ("critere014","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("critere024","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET deuxieme_critere ='".$this->postGetValue ("critere024","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				} 
				if($this->postGetValue ("critere034","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET troisieme_critere ='".$this->postGetValue ("critere034","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("critere044","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET quatrieme_trimestre ='".$this->postGetValue ("critere044","")."' where user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
				if($this->postGetValue ("groupe","")){
					$sql	=	 " UPDATE rohi.t_evaluation SET groupe ='".$this->postGetValue ("groupe","")."' where 
					user_id='".$user_id."' and trimestre ='".$trimestre."' " ;
				}
			}
			//echo "____".$sql;die;
			//echo $sql;die;
			if($sql){
				$this->Critere->majEvaluation($sql);
			}
		
		} else {
			redirect("cv/mon_cv");
		}
    }

}