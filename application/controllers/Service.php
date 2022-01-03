<?php
/**
* @package ROHI
* @subpackage Service
* @author Division Recherche et Développement Informatique
*/

header('Access-Control-Allow-Origin:*');
class Service extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function agent(){

		header('Content-type: application/json;charset=utf-8'); //Setting the page Content-type
		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;
		$toListe = array();

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		$zHashCode = "";

		if (isset ($_GET['zHashCode']))
        {
            $zHashCode = $_GET['zHashCode'] ;
        }

		if ($zHashCode == "ABCDEFghojklm123456789"){
			
			$iCompte = strlen($zTerm);
			$iIntZterm = (int)($zTerm);
			if($iCompte==12 && $iIntZterm!=0){
				$zMatricule = "" ; 
				$zCin = $zTerm;
			} else {
				$zMatricule = $zTerm ; 
				$zCin = "";
			}
			$toListe = $this->Gcap->get_all_list_MatriculeNom($zMatricule, $zCin);
		}
		
		$iActif = 0;

		$toRes = array();
		$zToReturn = "";
        foreach ($toListe as $oListe)
        {
            $toTemp         = array () ;
            $toTemp["agent_matricule"]   = $oListe->matricule;
            $toTemp["agent_nom"] = $oListe->nomAgent ;
			$toTemp["agent_prenom"] = $oListe->prenom ;
			$toTemp["agent_matricule"] = $oListe->matricule ;
			$toTemp["agent_poste"] = $oListe->poste ;
			$toTemp["agent_departement"] = $oListe->zDepartement ;
			$toTemp["agent_direction"] = $oListe->zDirection ;
			$toTemp["agent_service"] = $oListe->zService ;
			$toTemp["agent_lieu"] = $oListe->lacalite_service ;
			$toTemp["agent_cin"] = $oListe->cin ;
			$toTemp["agent_dateNaissance"] = $oListe->date_naiss ;
			$toTemp["agent_sexe"] = ($oListe->sexe==1)?"Masculin":utf8_encode("Féminin") ;

			if ($oListe->type_photo != ''){
				$toTemp["agent_photo"] = "http://rohi.mef.gov.mg:8088/ROHI/assets/upload/" . $oListe->id . "." . $oListe->type_photo  ;
			} else {
				$toTemp["agent_photo"] = "" ;
			}

            $toRes []       = $toTemp ;
        }

        $zToReturn = json_encode ($toRes) ;
		echo $zToReturn ; 
		
	}
	
	public function checkAgent(){

		//header('Content-type: application/json;charset=utf-8'); //Setting the page Content-type
		$toReturns 	=	array();
		$zLogin = "" ;
		$zPassword = "" ;
        $tRetour = array () ;
		$toListe = array();

        $iFiltre = 0;
		if (isset ($_GET['login'])){
            $zLogin = htmlentities ($_GET['login']) ;
        }
        else{
            $zLogin = "" ;
        }
		if (isset ($_GET['password'])){
            $zPassword = htmlentities ($_GET['password']) ;
        }
        else{
            $zPassword = "" ;
        }
		$zHashCode = "";
		if (isset ($_GET['zHashCode'])){
            $zHashCode = $_GET['zHashCode'] ;
        }
		if ($zHashCode == "ABCDEFghojklm123456789"){
				
			$toListe = $this->user->checkAgentCms($zLogin, $zPassword);

		}
		if( sizeof($toListe) > 0 ){
			$toReturns["matricule"] 	=	$toListe["im"];
			$toReturns["cin"] 			=	$toListe["cin"];
			$toReturns["valide"] 		=	1;
		}else{
			$toReturns["matricule"] 	=	"";
			$toReturns["cin"] 			=	"";
			$toReturns["valide"] 		=	0;
		}
		
        $zToReturn = json_encode ($toReturns) ;
		echo $zToReturn ;  
		
	}
	
	public function rohiget_gcap_dgep(){
		
		$toReturns 	=	array();
		$matricule 	= "" ;
		$date_debut = "" ;
		$date_fin 	= "" ;
        $tRetour 	= array () ;
		$toListe 	= array();
		
        $iFiltre = 0;
		
		$zHashCode = "";
		if (isset ($_GET['hash'])){
            $zHashCode = $_GET['hash'] ;
        }
		
		/****
		1-Demander le url par email
		2-la demande est composée de matricule ayant un compte RESPERS, la date (un jour), un intervalle d'heure qui ne doit pas dépasser 4h(exemple à 08h30 donc on peut exploiter le WS entre 08h30 et 12h30)
		au delà on fera une autre demande 
		3-Une seule demande par jour
		4-les agents retournés sont les agents dans la couverture du respers
		*/
		if ( $this->decrypter($zHashCode) == "DGEP_WEB_SERVICE_2021-10-07 08:05:02_DGEP_WEB_SERVICE_2021-10-07 10:05:02"){
			if (isset ($_GET['matricule'])){
				$matricule = htmlentities ($_GET['matricule']) ;
			}else{
				$matricule = "" ;
			}
			
			if (isset ($_GET['date_debut'])){
				$date_debut = htmlentities ($_GET['date_debut']) ;
			}else{
				$date_debut = "" ;
			}
			
			if (isset ($_GET['date_fin'])){
				$date_fin = htmlentities ($_GET['date_fin']) ;
			}else{
				$date_fin = "" ;
			}
			
			$toListe = $this->Gcap->get_gcap_dgep($matricule,$date_debut,$date_fin);
		
			
			$zToReturn = json_encode ($toListe) ;
			echo $zToReturn ;
		}else{
			echo "";
		}

		
	}
	
	public function get_gcap_dgfag(){
		
		$toReturns 	=	array();
		$matricule 	= 	"" ;
		$date_debut = 	"" ;
		$date_fin 	= 	"" ;
        $tRetour 	= 	array () ;
		$toListe 	= 	array();
		
        $iFiltre 	= 	0;
		
		$zHashCode 	= 	"";
		if (isset ($_GET['hash'])){
            $zHashCode = $_GET['hash'] ;
        }

		if (isset ($_GET['matricule'])){
			$matricule = htmlentities ($_GET['matricule']) ;
		}else{
			$matricule = "" ;
		}
		$toListe 	= $this->Gcap->get_gcap_dgfag($matricule);
	
		$zToReturn 	= json_encode ($toListe) ;
		
		echo $zToReturn ;
	}
	
	public function decrypter($_zCorrumpt){
		$_zKey="123";
		
		$_zKey = md5($_zKey);
		$zLetter = -1;
		$zNews = '';
		$_zCorrumpt = base64_decode($_zCorrumpt);
		$strlen = strlen($_zCorrumpt);
		for ( $i = 0; $i < $strlen; $i++ ){
			$zLetter++;
			if ( $zLetter > 31 ){
				$zLetter = 0;
			}
			$iOrdre = ord($_zCorrumpt{$i}) - ord($_zKey{$zLetter});
			if ( $iOrdre < 1 ){
				$iOrdre += 256;
			}
			$zNews .= chr($iOrdre);
		}
		return $zNews;

		return $_zCorrumpt;
	}
	
	public function crypter($_zChaineACrypter){
			
		$_zKey="123";

		$_zKey = md5($_zKey);
		$zLetter = -1;
		$zNews = '';
		$strlen = strlen($_zChaineACrypter);
		
		for($i = 0; $i < $strlen; $i++ ){
			$zLetter++;
			if ( $zLetter > 31 ){
				$zLetter = 0;
			}

			$iOrdre = ord($_zChaineACrypter{$i}) + ord($_zKey{$zLetter});
			if ( $iOrdre > 255 ){
				$iOrdre -= 256;
			}
			$zNews .= chr($iOrdre);
		}
		return base64_encode($zNews);
	}
}