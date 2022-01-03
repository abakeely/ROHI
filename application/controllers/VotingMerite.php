<?php
/**
* @package ROHI
* @subpackage VotingMerite
* @author Division Recherche et Développement Informatique
*/

ob_start();

class VotingMerite extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Votingmerite_model','VotingMerite');
		$this->load->model('GestionStructure_model','GestionStructure');
		
		$this->sessionStartCompte();
	}

	/** 
	* Listing des agents à voter de même direction
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iCurrPage pagination
	* @return view
	*/
	public function liste(){
		$oUser					= array();
		$oCandidat				= array();
		$iRet					= $this->check($oUser, $oCandidat);
		$iCompteActif			= $this->getSessionCompte();

		$oData = array();
		$oData['oUser']			= $oUser;
		$oData['oCandidat']		= $oCandidat;
		$oData['menu']			= 39;
		$iModuleId				= -4;
		
		if($iRet == 1){	

			
			$iVote = $this->VotingMerite->getCandidatVoting($this,$oUser['id']);

			if($iVote==1){
				redirect('accueil/communique');
			} else {

				/*$iStructureId = $oCandidat[0]->structureId;
				$iDir = $iStructureId;
				$toParentDir = $this->VotingMerite->findParent($iStructureId, 'dir');
				if($toParentDir['parent_id']!=''){
					$iDir = $toParentDir['parent_id'];
				}*/

				$zDepartement = $this->VotingMerite->getTestCandidatCentral($this,$oUser['id'],1);


				$toListeCentral		= $this->VotingMerite->getListeLaureat($zDepartement . " CENTRAL");
				$toListeRegional	= $this->VotingMerite->getListeLaureat($zDepartement . " REGIONAL");


				if(sizeof($toListe)<=1){
					//redirect('accueil/communique');
					//die();
				}
			}

			$oData['toListeCentral']		= $toListeCentral;
			$oData['toListeRegional']		= $toListeRegional;
			$oData['zDepartement']		= $zDepartement;
			$this->load_my_view_Common('votingmodel/listingVote.tpl',$oData, $iModuleId);
		} else {
			die();
		}
		
	}


	/** 
	* tableau de bord
	*
	* @param string $_zHashModule Hashage du module 
	* @param int $_zHashUrl Hashage de la page  
	* @param int $_iCurrPage pagination
	* @return view
	*/
	public function tableaudebord(){
		$oUser					= array();
		$oCandidat				= array();
		$iRet					= $this->check($oUser, $oCandidat);
		$iCompteActif			= $this->getSessionCompte();

		$oData = array();
		$oData['oUser']			= $oUser;
		$oData['oCandidat']		= $oCandidat;
		$oData['menu']			= 39;
		$iModuleId				= -4;
		
		if($iRet == 1){	

			$toUserAutorise = array (	'332026',
										'389671',
										'295622',
										'250362',
										'437456',
										'321327',
										'295786',
										'286622',
										'280987',
										'344531',
										'308713',
										'338037',
										'354932',
										'305953',
										'299099',
										'353307',
										'317296',
										'437338',
										'355037'
			);

			
			if (in_array($oUser['im'], $toUserAutorise)) {
			
				$zDepartement = $this->postGetValue ("zDepartement",'') ;
				$zDepartement = $this->postGetValue ("zDepartement",'') ;
				$iMatricule = $this->postGetValue ("iMatricule",'') ;
				$zLocalite = $this->postGetValue ("zLocalite",'CENTRAL') ;

				$toDepartement = $this->VotingMerite->getDepartementVoting();

				//print_r ($toDepartement);
				$toLaureat = $this->VotingMerite->laureat($iMatricule, $zDepartement, $zLocalite);
				$togetStatAll = $this->VotingMerite->getStatAllGlobal($zDepartement, $zLocalite);

				$toRecapitulation = array();
				foreach ($toDepartement as $oDepartement){
					
					$zDepartementSearch = $oDepartement["structure_dept"];
					$togetStatDept = $this->VotingMerite->getStatAll($zDepartementSearch, $zLocalite);
					
					$oResult = new stdClass();
					$oResult->departement = $oDepartement["structure_dept"];
					$oResult->togetStatDept = $togetStatDept;
					
					array_push($toRecapitulation, $oResult);
				}

				//$toRecapitulation = $this->VotingMerite->getRecapitulation();

				//print_r ($toRecapitulation);


				$oData['toDepartement']		= $toDepartement;
				$oData['iMatricule']		= $iMatricule;
				$oData['toLaureat']			= $toLaureat;
				$oData['zDepartement']		= $zDepartement;
				$oData['zLocalite']			= $zLocalite;
				$oData['togetStatAll']		= $togetStatAll;
				$oData['toRecapitulation']	= $toRecapitulation;
				$this->load_my_view_Common('votingmodel/tableaudebord.tpl',$oData, $iModuleId);
			}
		} else {
			die();
		}
		
	}
	
	
	/** 
	* Mise à jour photo des agents
	* affichage avant d'ouvrir le salaire des agents
	*
	* @param integer $_iUserId Identifiant de l'agent
	* @return ajax/html
	*/
	public function getTemplateVoting() {
		global $oSmarty ; 	

		$iRet	=  $this->check($oUser, $oCandidat);

		//$this->VotingMerite->getDepartementId();
		$oSmarty->assign('zBasePath', base_url());

		$toSessionVoting = array();
		if(isset($_SESSION["PointDate"]) && sizeof($_SESSION["PointDate"])>0){
			$toSessionVoting = $_SESSION["PointDate"];

			/*echo "<pre>";
			print_r ($oCandidat);
			echo "</pre>";
			die();*/
			$toAVoter = array();
			$zTitle = "SERVICE";
			switch ($toSessionVoting->pointDate_niveau){

				case 'SCE':
							
							$zRang = $oCandidat[0]->rang;
							$zTitle = "SERVICE";
							switch($zRang){

								case 'DIV': 
								case 'BUR':
									// recherche les personnes de même service
									$zRangRangParent = $this->VotingMerite->getRangStructure($oCandidat[0]->parent_id);

									switch($zRangRangParent){
										
										case 'SCE':
											$toAVoter = $this->VotingMerite->getAgentVoting($oCandidat[0]->parent_id,0);
											$_SESSION["iChild"] = $oCandidat[0]->parent_id;
											break;

										case 'DIR';
											$tzLists = $oCandidat[0]->child_id.",".$oCandidat[0]->parent_id;
											$toAVoter = $this->VotingMerite->getAgentVoting($tzLists,1);
											$_SESSION["iChild"] = $oCandidat[0]->child_id;
											break;
									}
									
												
									break;

								case 'SCE';
									// recherche les personnes de même service
									$toAVoter = $this->VotingMerite->getAgentVoting($oCandidat[0]->child_id,0);
									$_SESSION["iChild"] = $oCandidat[0]->child_id;
									break;

								case 'DIR';
									/* recherche les personnes rattaché au direction
									* si rattaché alors affiché la direction
									* si directeur alors affiché tous
									*
									*/

									$iRattache = 0;
									$iRattache = ($oCandidat[0]->premier_responsable_id==$oUser['id'])?0:1;
									$toAVoter = $this->VotingMerite->getAgentVoting($oCandidat[0]->child_id,$iRattache);
									$_SESSION["iChild"] = $oCandidat[0]->child_id;
									break;

								case 'DEPT';
									/* recherche les personnes rattaché au direction
									* si rattaché alors affiché la direction
									* si directeur alors affiché tous
									*
									*/
									$iRattache = ($oCandidat[0]->premier_responsable_id==$oUser['id'])?0:1;
									$toAVoter = $this->VotingMerite->getAgentVoting($oCandidat[0]->child_id,$iRattache);
									$_SESSION["iChild"] = $oCandidat[0]->child_id;
									break;
							}
						break;

				
				case 'DIR':
						$zTitle = "DIRECTION";
						break;
			}
		}
		
		$oSmarty->assign("toAVoter",$toAVoter);
		$oSmarty->assign("zTitle",$zTitle);
		$zSelect = $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "votingmodel/getTemplateVoting.tpl" );

		$toReturn = array();
		$toReturn['title']		= $zTitle;
		$toReturn['zSelect']	= $zSelect ;

		echo json_encode($toReturn);
		
	}

	/** 
	*
	* recherche candidat à partir d'un function json
	*
	* @return Json
	*/
	public function candidat(){

		global $oSmarty ;
		
		$zTerm = "" ;
        $tRetour = array () ;

        $iFiltre = 0;
		if (isset ($_GET['q']))
        {
            $zTerm = htmlentities ($_GET['q']) ;
        }
        else
        {
            $zTerm = "" ;
        }

		if (isset ($_GET['iFiltre']))
        {
            $iFiltre = $_GET['iFiltre'] ;
        }

		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();


		$toListe = $this->VotingMerite->get_all_list_candidat($oUser,$oCandidat,$oUser['id'], $iCompteActif,$zTerm, $iFiltre);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->user_id;
            $toTemp["text"] = $oListe->matricule ." " .$oListe->nom ." " . $oListe->prenom ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}


	/** 
	* Sauvegarde 
	*
	* @return view
	*/
	function save(){
			
			
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
    	
		if($iRet == 1){	

				$iDepartementId = $this->VotingMerite->getDepartementId();
				$toSessionVoting = $_SESSION["PointDate"];
				
				$oData = array();
				$iAgentVotingCentId = $this->postGetValue ("agentVotingCent",0) ;
				$iAgentVotingRegId = $this->postGetValue ("agentVotingReg",0) ;
				$zDepartement = $this->postGetValue ("zDepartement",0) ;

				$oData["voteMerite_userId"]					= $oUser["id"] ; 
				$oData["voteMerite_agentCerntralUserId"]	= $iAgentVotingCentId ; 
				$oData["voteMerite_agentRegionalUserId"]	= $iAgentVotingRegId ; 
				$oData["voteMerite_rang"]					= 1;  
				$oData["voteMerite_pointDateId"]			= $toSessionVoting->pointDate_id; 
				$oData["voteMerite_date"]					= date("Y-m-d H:i:s"); ; 
				$oData["voteMerite_localite"]				= $zDepartement ; 

				$this->VotingMerite->insert($oData);
				unset($_SESSION["iChild"]);
    	
		} else {
			$this->mon_cv();
		}

			
	}

}