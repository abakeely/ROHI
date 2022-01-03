<?php
/**
* @package ROHI
* @subpackage Carriere
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Carriere extends MY_Controller {

	/**  
	* Classe qui concerne le carrière d'un agent
	* @package  ROHI  
	* @subpackage Carriere */ 
	public function __construct(){
		parent::__construct();
		DEFINE ("PAR_REMPLACEMENT_NUMERIQUE","remplacement-numerique");
		DEFINE ("PAR_DOTATION_POSTE_BUDGETAIRE","dotation-poste-budgetaire");
		$this->sessionStartCompte();
	}

	/** 
	* Affichage objet 
	*
	* @param objet $_oObjet objet à afficher
	* @return 
	*/
	public static function pre_print($_oObjet) {

		echo "<pre>" ; 
		print_r($_oObjet);
		echo "</pre>";
	}

	/** 
	* Recherche candidat à partir d'un matricule posté depuis le formulaire
	*
	* @param int $_iRemp remplie ou pas
	* @return 
	*/
	public function findCandidatbyMatricule($_iRemp = 0)
	{
		$iMatricule = $this->postGetValue ("matricule") ;
		if($_iRemp===0){
			$oCandidatRecherche=$this->candidatCarriere->get_candidat_by_multicritere(array("candidat_matricule"),array($iMatricule));
		}else{
			$oCandidatRecherche=$this->candidat->get_candidat_by_multicritere(array("matricule"),array($iMatricule));
		}

		if($oCandidatRecherche[0]!=null){
			echo json_encode($oCandidatRecherche[0]);
		}else{
			echo "";
		}
	}

	/** 
	* Recherche candidat à partir d'un matricule dans le BE posté depuis le formulaire
	*
	* @return view
	*/
	public function findCandidatbyMatriculeBE()
	{
		$iMatricule = $this->postGetValue ("matricule") ;
		$oCandidatRecherche=$this->candidatCarriere->get_candidat_by_multicritere(array("candidat_matricule"),array($iMatricule));			
		if($oCandidatRecherche[0]!=null)
		{
			echo $oCandidatRecherche[0]['candidat_nom']." ".$oCandidatRecherche[0]['candidat_prenom'];
		}
		else
		{
			echo "";
		}
	}

	/** 
	* recherche candidat
	*
	* @return ajax
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


		$toListe = $this->candidatCarriere->get_all_list_candidat1($zTerm);
		$iActif = 0;

		$toRes = array();

        foreach ($toListe as $oListe)
        {

            $toTemp         = array () ;
            $toTemp["id"]   = $oListe->candidat_id;
            $toTemp["text"] = $oListe->candidat_nom ." " . $oListe->candidat_prenom ;
            $toRes []       = $toTemp ;
        }
		

		$zCallback = $_GET ['callback'] ;
        $zToReturn = $zCallback . "(\n" ;
        $zToReturn .= json_encode ($toRes) ;
        $zToReturn .= ")" ;
		
		echo $zToReturn ; 
		
	}

	/** 
	* dépendance sigle
	*
	* @param string $_sDropDown 
	* @return 
	*/
	public function dependanceSigle($_sDropDown)
	{
		
		$oData = array();
		/*$iMinistere = $this->postGetValue ("ministere") ;
		$iDepartement = $this->postGetValue ("departement") ;
		$iDirection = $this->postGetValue ("direction") ;
		$iService = $this->postGetValue ("service") ;
		
		$oData['toMinistere'] = $this->ministere->get_ministere();
		$oData['toDepartement'] = $this->departement->get_departement();
		$oData['toDirection'] = $this->direction->get_by_departement($iDepartement);
		$oData['toService'] = $this->service->get_by_direction($iDirection);*/
		switch($_sDropDown)
		{
			case "departement":
				$iDepartement = $this->postGetValue ("departement") ;
				$oData['toDirection'] = $this->direction->get_by_departement($iDepartement);
				$iDirection = $oData['toDirection'][0]['id'];
				$oData['toService'] = $this->service->get_by_direction($iDirection);
				break;
			case "direction":
				$iDirection = $this->postGetValue ("direction") ;
				$oData['toService'] = $this->service->get_by_direction($iDirection);
				break;
			default:
				break;
		}

		echo json_encode($oData);
	}

	/** 
	* liste de carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param integer $_iCurrPage page courrante
	* @return view
	*/
	public function liste($_zHashModule = FALSE, $_iCurrPage = 1) {
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1 && $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
		{	
			
			$oData = array();
	    	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['zMessage'] = '';
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iCompteActif = $this->getSessionCompte();

			$iParcours = 0;
			$iParcoursProjet = 0;
			$iNbrPerPage = 10;
			$iNbrTotal = 0;
			$iSearch = 0;
			$iDebut = $_iCurrPage;
			
			//$iNbrPerPage = NB_PER_PAGE;
			$iParcoursTypes=0;

			$recherche = array();
			$zIdentification = $this->postGetValue ("identification",''); 
			$zMatricule = $this->postGetValue ("matricule",'');
			$zCandidat = $this->postGetValue ("zCandidatSearch",'');
			$zType = $this->postGetValue ("type",'');
			$zDate = $this->postGetValue ("date",'');
			$zNom = "";
			$zPrenom = "";

			//recherche matricule ou cin
			$oData['identification'] = $zIdentification;
			if($zMatricule!='')
			{
				$recherche['c.'.$zIdentification] = $zMatricule;
				$oData['champMat'] = $zMatricule;
			}

			if($zCandidat!='')
			{
				$recherche['c.candidat_id'] = $zCandidat;
			}

			if($zType!='')
			{
				$recherche['e.elaborationProjet_type'] = $zType;
				$oData['type'] = $zType;
			}
			if($zDate!='')
			{
				$recherche['e.elaborationProjet_date'] = $this->date_fr_to_en($zDate,'/','-');
				$oData['date'] = $zDate;
			}

			$oData['oRecherche'] = $recherche;

			$toType = array("contrat-de-travail"=>"Contrat de Travail","engagement-eld"=>"Engagement ELD",
			"engagement-ecd"=>"Engagement ECD","arrete-de-nomination"=>"Arr&egrave;t&eacute; de Nomination");
			
			$oData['toType'] = $toType;
			
			

			if(count($recherche)>0)
			{
				$oData['toProjet'] = $this->elaborationProjet->searchElaborationProjet($recherche,$iDebut,$iNbrTotal,$iNbrPerPage);
				$iSearch = 1;
			}
			else
			{
				$oData['toProjet'] = $this->elaborationProjet->searchElaborationProjet(FALSE,$iDebut,$iNbrTotal,$iNbrPerPage);
				$iSearch = 0;
			}

			for($iParcours=0;$iParcours</*$iNbrTotal*/$iNbrPerPage;$iParcours++)
			{
				if(((($iDebut-1)*$iNbrPerPage)+$iParcours)<$iNbrTotal)
				{
					$oData['toProjet'][$iParcours]['zHashUrl'] = $oData['toProjet'][$iParcours]['elaborationProjet_type'];
					$oData['toProjet'][$iParcours]['elaborationProjet_date'] = $this->date_en_to_fr($oData['toProjet'][$iParcours]['elaborationProjet_date'],'-','/');
					$oData['toProjet'][$iParcours]['elaborationProjet_type'] = $toType[$oData['toProjet'][$iParcours]['elaborationProjet_type']];
				}
				else
				{
					break;
				}
			}

			$zPagination = $this->getPagination ($_iCurrPage, $iNbrTotal,$iNbrPerPage) ;
			$oData['zPagination'] = $zPagination ;
			$oData['iCurrPage'] = $_iCurrPage ; 

			$this->load_my_view_Common('gcap/carriere_liste.tpl',$oData, $iModuleId);
		}
		else 
		{
			$this->mon_cv();
		}
	}

	/** 
	* Edition/fiche carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param string $_sTab onglet
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function edit($_zHashModule = FALSE, $_zHashUrl = FALSE, $_sTab = FALSE, $_iId = FALSE)
	{
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1 && $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
		{	
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$oData["iError"]		= $this->postGetValue ("iError",0) ;
			$oData['oVerify'] = $this->setDonneesVerify($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);
			$oData['oProject'] = $this->setDonneesProject($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);
			$oData['oBE'] = $this->setDonneesBE($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);
			$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
			$oTypeCarriere = $this->TypeCarriere-> get_typeCarriere($iTypeCarriereId);
			$oProjet = $oData['oProject']['oCandidatRecherche'];
			if ($oProjet!=null)
			{
				$oData["zTitre"] = ": ".$oTypeCarriere['typeCarriere_libelle']." de ".$oProjet['candidat_nom']." ".$oProjet['candidat_prenom'].", IM ".$oProjet['candidat_matricule'];
			}
			else
			{
				$oData["zTitre"] = "s: creation d'un projet ".$oTypeCarriere['typeCarriere_libelle'];
			}
			$oData["zTitle"] = $oTypeCarriere['typeCarriere_libelle'];
			$oData['sTab'] = $_sTab;
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			
			$this->load_my_view_Common('gcap/carriere_edit.tpl',$oData, $iModuleId);
		}
		else 
		{
			$this->mon_cv();
		}
	}
	
	/** 
	* Vérification des données carrières
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @param objet $oUser objet user
	* @param objet $oCandidat objet agent
	* @return view
	*/
	private function setDonneesVerify($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE,$oUser,$oCandidat)
	{
		$oData = array();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		$oData["iError"]		= $this->postGetValue ("iError",0) ;

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
		$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
		$zSelect = "" ; 

		$oData['iTypeCarriereId'] = $iTypeCarriereId;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;

		switch ($iTypeCarriereId) 
		{
			
			case CONTRAT_DE_TRAVAIL :
			case ENGAGEMENT_ELD :
				if($_iId != FALSE)
				{
					// Check if your variable is an integer
					if( ! ctype_digit(strval($_iId)) )
					{
						$oData['toPieceaVerifier'] = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl);
						$oData['sPar'] = $_iId;
					}
					else
					{
						$toPieceaVerifier = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl,$_iId);
						$iParcours = 0;
						for($iParcours = 0; $iParcours < count($toPieceaVerifier); $iParcours++)
						{
							$tsValidation = explode(";",$toPieceaVerifier[$iParcours]['verificationPieces_projetValidation']);
							$iParcoursDonnees = 0;
							for($iParcoursDonnees = 0; $iParcoursDonnees < count($tsValidation); $iParcoursDonnees++)
							{
								$toPieceaVerifier[$iParcours]['check'] = ($tsValidation[$iParcoursDonnees]==$_iId."-1");
								if($tsValidation[$iParcoursDonnees]==$_iId."-1")
								{
									break;
								}
							}
						}
						
						$oData['toPieceaVerifier'] = $toPieceaVerifier;
						$oData['iId'] = $_iId ;
					}
				}
				else
				{
					$oData['toPieceaVerifier'] = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl);
					$oData['sPar'] = PAR_REMPLACEMENT_NUMERIQUE;
				}
				break;
			case ENGAGEMENT_ECD :
			case ARRETE_DE_NOMINATION :
				if($_iId != FALSE)
				{
					$toPieceaVerifier = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl,$_iId);
					$iParcours = 0;
					for($iParcours = 0; $iParcours < count($toPieceaVerifier); $iParcours++)
					{
						$tsValidation = explode(";",$toPieceaVerifier[$iParcours]['verificationPieces_projetValidation']);
						$iParcoursDonnees = 0;
						for($iParcoursDonnees = 0; $iParcoursDonnees < count($tsValidation); $iParcoursDonnees++)
						{
							$toPieceaVerifier[$iParcours]['check'] = ($tsValidation[$iParcoursDonnees]==$_iId."-1");
							if($tsValidation[$iParcoursDonnees]==$_iId."-1")
							{
								break;
							}
						}
					}
					$oData['toPieceaVerifier'] = $toPieceaVerifier;
					$oData['iId'] = $_iId ;
				}
				else
				{
					$oData['toPieceaVerifier'] = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl);
				}
				break;
		}
		$oData['iNombrePieceaVerifier'] = count($oData['toPieceaVerifier']);
		return $oData;
	}

	/** 
	* Données du projet de carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @param objet $oUser objet user
	* @param objet $oCandidat objet agent
	* @return view
	*/
	private function setDonneesProject($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE,$oUser,$oCandidat)
	{
		$oData = array();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		$oData["iError"] = $this->postGetValue ("iError",0) ;

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
		$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
		
		$zSelect = "" ; 
		$oData['iTypeCarriereId'] = $iTypeCarriereId;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;

		$oData['iId'] = $_iId;
		$oData['oElaborationProjet'] = $this->elaborationProjet->get_elaborationProjet($_iId);
		$oData['oElaborationProjet']['elaborationProjet_datePriseService'] = $this->date_en_to_fr($oData['oElaborationProjet']['elaborationProjet_datePriseService'],'-','/');
		$oData['zPage'] = $oData['oElaborationProjet']['elaborationProjet_type'];
		
		switch ($iTypeCarriereId) 
		{
			
			case CONTRAT_DE_TRAVAIL :
				$oData['oElaborationProjet']['elaborationProjet_type'] = "contrat-de-travail";
				$oData['oElaborationProjet']['elaborationProjet_date'] = $this->date_en_to_fr($oData['oElaborationProjet']['elaborationProjet_date'],'-','/');
				if($oData['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oCandidatRecherche = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($oData['oElaborationProjet']['elaborationProjet_CandidatId']));
					$oData['oCandidatRecherche'] = $oCandidatRecherche[0];
				}
				$oData['oContratdeTravail'] = $this->contratdeTravail->get_contratdeTravailParElaborationProjet($_iId);
				$oData['oContratdeTravail']['contratdeTravail_dateLettre'] = $this->date_en_to_fr($oData['oContratdeTravail']['contratdeTravail_dateLettre'],'-','/');
				$oData['toCorps'] = $this->corps->get_corps();
				$oData['toGrade'] = $this->grade->get_grade();
				$oData['toIndice'] = $this->indice->get_indice();
				$oData['toMinistere'] = $this->ministere->get_ministere();
				$oData['toDepartement'] = $this->departement->get_departement();
				$oData['toDirection'] = $this->direction->get_direction();
				$oData['toService'] = $this->service->get_service();
				
				if($oData['oContratdeTravail']['contratdeTravail_par'] == PAR_REMPLACEMENT_NUMERIQUE)
				{
					$oData['oParRemplacementNumerique'] = $this->parRemplacementNumerique
						->get_parRemplacementNumeriqueParContratdeTravail($oData['oContratdeTravail']['contratdeTravail_id']);
					$oData['oParRemplacementNumerique']['parRemplacementNumerique_datedeFin'] = $this->date_en_to_fr($oData['oParRemplacementNumerique']['parRemplacementNumerique_datedeFin'],'-','/');	
					if($oData['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId']!=null)
					{
						$oCandidatRemplacement = $this->candidat->get_candidat_by_multicritere(array("id"),array($oData['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId']));
						$oData['oCandidatRemplacement'] = $oCandidatRemplacement[0];
					}
				}
				else if($oData['oContratdeTravail']['contratdeTravail_par'] == PAR_DOTATION_POSTE_BUDGETAIRE)
				{
					$oData['oParDotationPosteBudgetaire'] = $this->parDotationPosteBudgetaire
						->get_parDotationPosteBudgetaireParContratdeTravail($oData['oContratdeTravail']['contratdeTravail_id']);
						$oData['oParDotationPosteBudgetaire']['parDotationPosteBudgetaire_dateLettre'] = $this->date_en_to_fr($oData['oParDotationPosteBudgetaire']['parDotationPosteBudgetaire_dateLettre'],'-','/');
					
				}
				
				
				break;

			case ENGAGEMENT_ELD :
				$oData['oElaborationProjet']['elaborationProjet_type'] = "engagement-eld";
				$oData['oElaborationProjet']['elaborationProjet_date'] = $this->date_en_to_fr($oData['oElaborationProjet']['elaborationProjet_date'],'-','/');
				
				if($oData['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oCandidatRecherche = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($oData['oElaborationProjet']['elaborationProjet_CandidatId']));
					$oData['oCandidatRecherche'] = $oCandidatRecherche[0];
					$oData['oCandidatRecherche']['candidat_datedeNaissance'] = $this->date_en_to_fr($oData['oCandidatRecherche']['candidat_datedeNaissance'],'-','/');
				}
				$oData['oEngagementELD'] = $this->eld->get_engagementELDParElaborationProjet($_iId);
				$oData['toCorps'] = $this->corps->get_corps();
				$oData['toGrade'] = $this->grade->get_grade();
				$oData['toIndice'] = $this->indice->get_indice();
				$oData['toMinistere'] = $this->ministere->get_ministere();
				$oData['toDepartement'] = $this->departement->get_departement();
				$oData['toDirection'] = $this->direction->get_direction();
				$oData['toService'] = $this->service->get_service();
				if($oData['oEngagementELD']['decisiondEngagementELD_par'] == PAR_REMPLACEMENT_NUMERIQUE)
				{
					$oData['oParRemplacementNumerique'] = $this->parRemplacementNumerique
						->get_parRemplacementNumeriqueParELD($oData['oEngagementELD']['decisiondEngagementELD_id']);
					$oData['oParRemplacementNumerique']['parRemplacementNumerique_datedeFin'] = $this->date_en_to_fr($oData['oParRemplacementNumerique']['parRemplacementNumerique_datedeFin'],'-','/');
					$oData['oParRemplacementNumerique']['parRemplacementNumerique_dateReferenceActeAdministratif'] = $this->date_en_to_fr($oData['oParRemplacementNumerique']['parRemplacementNumerique_dateReferenceActeAdministratif'],'-','/');	
					if($oData['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId']!=null)
					{
						$oCandidatRemplacement = $this->candidat->get_candidat_by_multicritere(array("id"),array($oData['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId']));
						$oData['oCandidatRemplacement'] = $oCandidatRemplacement[0];
					}
				}
				else if($oData['oEngagementELD']['decisiondEngagementELD_par'] == PAR_DOTATION_POSTE_BUDGETAIRE)
				{
					$oData['oParDotationPosteBudgetaire'] = $this->parDotationPosteBudgetaire
						->get_parDotationPosteBudgetaireParELD($oData['oEngagementELD']['decisiondEngagementELD_id']);
					$oData['oParDotationPosteBudgetaire']['parDotationPosteBudgetaire_dateLettre'] = $this->date_en_to_fr($oData['oParDotationPosteBudgetaire']['parDotationPosteBudgetaire_dateLettre'],'-','/');
					
				}
				break;
			case ENGAGEMENT_ECD :
				$oData['oElaborationProjet']['elaborationProjet_type'] = "engagement-ecd";
				$oData['oElaborationProjet']['elaborationProjet_date'] = $this->date_en_to_fr($oData['oElaborationProjet']['elaborationProjet_date'],'-','/');
				if($oData['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oCandidatRecherche = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($oData['oElaborationProjet']['elaborationProjet_CandidatId']));
					$oData['oCandidatRecherche'] = $oCandidatRecherche[0];
					$oData['oCandidatRecherche']['candidat_datedeNaissance'] = $this->date_en_to_fr($oData['oCandidatRecherche']['candidat_datedeNaissance'],'-','/');
				}
				$oData['oEngagementECD'] = $this->ecd->get_engagementECDParElaborationProjet($_iId);
				$oData['oEngagementECD']['decisiondEngagementECD_debutPeriode'] =$this->date_en_to_fr($oData['oEngagementECD']['decisiondEngagementECD_debutPeriode'],'-','/');
				$oData['oEngagementECD']['decisiondEngagementECD_finPeriode'] =$this->date_en_to_fr($oData['oEngagementECD']['decisiondEngagementECD_finPeriode'],'-','/');
				$oData['toCorps'] = $this->corps->get_corps();
				$oData['toGrade'] = $this->grade->get_grade();
				$oData['toIndice'] = $this->indice->get_indice();
				$oData['toMinistere'] = $this->ministere->get_ministere();
				$oData['toDepartement'] = $this->departement->get_departement();
				$oData['toDirection'] = $this->direction->get_direction();
				$oData['toService'] = $this->service->get_service();
				
				break;
			case ARRETE_DE_NOMINATION :
				$oData['oElaborationProjet']['elaborationProjet_type'] = "arrete-de-nomination";
				$oData['oElaborationProjet']['elaborationProjet_date'] = $this->date_en_to_fr($oData['oElaborationProjet']['elaborationProjet_date'],'-','/');
				if($oData['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oCandidatRecherche = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($oData['oElaborationProjet']['elaborationProjet_CandidatId']));
					$oData['oCandidatRecherche'] = $oCandidatRecherche[0];
				}
				$oData['oArrete'] = $this->arretedeNomination->get_arretedeNominationParElaborationProjet($_iId);
				$oData['oArrete']['arretedeNomination_dateDecret'] =$this->date_en_to_fr($oData['oArrete']['arretedeNomination_dateDecret'],'-','/');
				$oData['oArrete']['arretedeNomination_dateDecretAdditif'] =$this->date_en_to_fr($oData['oArrete']['arretedeNomination_dateDecretAdditif'],'-','/');
				$oData['oArrete']['arretedeNomination_dateArrete'] =$this->date_en_to_fr($oData['oArrete']['arretedeNomination_dateArrete'],'-','/');
				$oData['oArrete']['arretedeNomination_dateListeAdmis'] =$this->date_en_to_fr($oData['oArrete']['arretedeNomination_dateListeAdmis'],'-','/');
				$oData['oArrete']['arretedeNomination_dateListeDefinitive'] =$this->date_en_to_fr($oData['oArrete']['arretedeNomination_dateListeDefinitive'],'-','/');
				$oData['oArrete']['arretedeNomination_dateArreteBonification'] =$this->date_en_to_fr($oData['oArrete']['arretedeNomination_dateArreteBonification'],'-','/');
				$oData['toCorps'] = $this->corps->get_corps();
				$oData['toGrade'] = $this->grade->get_grade();
				$oData['toIndice'] = $this->indice->get_indice();
				$oData['toMinistere'] = $this->ministere->get_ministere();
				$oData['toDepartement'] = $this->departement->get_departement();
				$oData['toDirection'] = $this->direction->get_direction();
				$oData['toService'] = $this->service->get_service();
				break;
		}
		return $oData;
	}
	
	/** 
	* Données BE de carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @param objet $oUser objet user
	* @param objet $oCandidat objet agent
	* @return view
	*/
	private function setDonneesBE($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE,$oUser,$oCandidat)
	{
		$oData = array();
		$oData['oUser'] = $oUser;
		$oData['oCandidat'] = $oCandidat;

		$oData["iError"]		= $this->postGetValue ("iError",0) ;

		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
		$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);

		 
		$oData['iTypeCarriereId'] = $iTypeCarriereId;
		$oData['zHashUrl'] = $_zHashUrl ; 
		$oData['zHashModule'] = $_zHashModule ;

		$oBE=$this->elaborationBE->findElaborationduBEbyElaborationProjet($_iId);
		$oData['oBE'] = $oBE;
		$oData['toMinistere'] = $this->ministere->get_ministere();
		$oData['toDepartement'] = $this->departement->get_departement();
		$oData['toDirection'] = $this->direction->get_direction();
		$oData['toService'] = $this->service->get_service();
		$oData['toCorps'] = $this->corps->get_corps();

		/*$tsIdProjet = explode(";",$oBE['elaborationduBE_ElaborationProjetId']);
		$iParcours = 0;
		$toProjet = array();
		for($iParcours = 0;$iParcours<sizeof($tsIdProjet);$iParcours++)
		{
			if($tsIdProjet[$iParcours]!="")
			{
				$iIdProjet=$tsIdProjet[$iParcours];
				$oProjet = $this->elaborationProjet->getElaborationProjetByIdProjet($iIdProjet);
				$oProjet['elaborationProjet_date'] = $this->date_en_to_fr($oProjet['elaborationProjet_date'],'-','/');
				$toProjet[$iParcours] = $oProjet;
			}
		}*/
		$toProjet = explode(";",$oBE['elaborationduBE_candidats']);
		
		$oData['toProjet'] = array_filter($toProjet);
		return $oData;
	}
	
	/** 
	* Suppression d'un donnée de carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function delete($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1 && $iCompteActif == COMPTE_RESPONSABLE_PERSONNEL)
		{	
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$toPieceaVerifier = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl);
			$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
			if($_iId!=FALSE && ctype_digit(strval($_iId)))
			{
				//retirer le projet de verificationPieces
				$oElaborationProjet =  $this->elaborationProjet->get_elaborationProjet($_iId);
				$iElaborationProjetId = $oElaborationProjet['elaborationProjet_id'];
				$iParcoursCheckBoxes = 0;
				for($iParcoursCheckBoxes=0;$iParcoursCheckBoxes<sizeof($toPieceaVerifier);$iParcoursCheckBoxes++){
					$toValeurs = array();
					
					$toValeurs = $this->verificationPieces->get_verificationPiecesByPieceaVerifier($toPieceaVerifier[$iParcoursCheckBoxes]['pieceaVerifier_id']);
					$tsValidation = explode(";",$toValeurs['verificationPieces_projetValidation']);
					$iParcours = 0;
					for($iParcours = 0;$iParcours < count($tsValidation); $iParcours++)
					{
						if($tsValidation[$iParcours]==$_iId."-0" || $tsValidation[$iParcours]==$_iId."-1")
						{
							$tsValidation[$iParcours]=null;
							break;
						}
					}
					$toValeurs['verificationPieces_projetValidation'] = implode(";",array_filter($tsValidation));
				
					$this->verificationPieces->update($toValeurs);
				}

				//retirer le projet de BE
				$oBE=$this->elaborationBE->findElaborationduBEbyElaborationProjet($_iId);
				$tsIdProjet = explode(";",$oBE['elaborationduBE_candidats']);
				$iParcours = 0;
				for($iParcours = 0;$iParcours<sizeof($tsIdProjet);$iParcours++)
				{
					if($tsIdProjet[$iParcours]==" "+$_iId+" ")
					{
						$tsIdProjet[$iParcours] = null;
						break;
					}
					
				}
				$oBE['elaborationduBE_candidats'] = implode(";",array_filter($tsIdProjet));
				if($oBE['elaborationduBE_candidats']==="")
				{
					$this->elaborationBE->delete($oBE);
				}
				else
				{
					$this->elaborationBE->update($oBE);
				}
				

				//retirer du type de projet
				switch ($iTypeCarriereId) 
				{
					
					case CONTRAT_DE_TRAVAIL :
						
						$oContratdeTravail = $this->contratdeTravail->get_contratdeTravailParElaborationProjet($_iId);
						
						if($oContratdeTravail['contratdeTravail_par'] == PAR_REMPLACEMENT_NUMERIQUE)
						{
							$oParRemplacementNumerique = $this->parRemplacementNumerique
								->get_parRemplacementNumeriqueParContratdeTravail($oContratdeTravail['contratdeTravail_id']);
							$this->parRemplacementNumerique->delete($oParRemplacementNumerique);
						}
						else if($oContratdeTravail['contratdeTravail_par'] == PAR_DOTATION_POSTE_BUDGETAIRE)
						{
							$oParDotationPosteBudgetaire = $this->parDotationPosteBudgetaire
								->get_parDotationPosteBudgetaireParContratdeTravail($oContratdeTravail['contratdeTravail_id']);
							$this->parDotationPosteBudgetaire->delete($oParDotationPosteBudgetaire);
						}
						$this->contratdeTravail->delete($oContratdeTravail);
						
						break;

					case ENGAGEMENT_ELD :
						$oEngagementELD = $this->eld->get_engagementELDParElaborationProjet($_iId);
						if($oEngagementELD['decisiondEngagementELD_par'] == PAR_REMPLACEMENT_NUMERIQUE)
						{
							$oParRemplacementNumerique = $this->parRemplacementNumerique
								->get_parRemplacementNumeriqueParELD($oEngagementELD['decisiondEngagementELD_id']);
							$this->parRemplacementNumerique->delete($oParRemplacementNumerique);
						}
						else if($oEngagementELD['decisiondEngagementELD_par'] == PAR_DOTATION_POSTE_BUDGETAIRE)
						{
							$oParDotationPosteBudgetaire = $this->parDotationPosteBudgetaire
								->get_parDotationPosteBudgetaireParELD($oEngagementELD['decisiondEngagementELD_id']);
							$this->parDotationPosteBudgetaire->delete($oParDotationPosteBudgetaire);
						}
						$this->eld->delete($oEngagementELD);
						break;
					case ENGAGEMENT_ECD :
						
						$oEngagementECD = $this->ecd->get_engagementECDParElaborationProjet($_iId);
						$this->ecd->delete($oEngagementECD);
						break;
					case ARRETE_DE_NOMINATION :
						
						$oArrete = $this->arretedeNomination->get_arretedeNominationParElaborationProjet($_iId);
						$this->arretedeNomination->delete($oArrete);
						break;
				}
				$this->elaborationProjet->delete($oElaborationProjet);
				redirect("carriere/liste/$_zHashModule");
			}
		}
		else 
		{
			$this->mon_cv();
		}
	}

	/** 
	* sauvegarde carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function save($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE)
	{
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1)
		{	

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$toPieceaVerifier = $this->pieceaVerifier->get_pieceaVerifier($_zHashUrl);
			$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
			$oData = array();
			if($_iId!=FALSE && ctype_digit(strval($_iId)))
			{
				$oElaborationProjet =  $this->elaborationProjet->get_elaborationProjet($_iId);
				$iElaborationProjetId = $oElaborationProjet['elaborationProjet_id'];
				if($iElaborationProjetId!=null)
				{
					$iParcoursCheckBoxes = 0;
					for($iParcoursCheckBoxes=0;$iParcoursCheckBoxes<sizeof($toPieceaVerifier);$iParcoursCheckBoxes++){
						$toValeurs = array();
						if($this->postGetValue ("doc".$iParcoursCheckBoxes)!=null)
						{
							$toValeurs = $this->verificationPieces->get_verificationPiecesByPieceaVerifier($this->postGetValue ("doc".$iParcoursCheckBoxes));
							$tsValidation = explode(";",$toValeurs['verificationPieces_projetValidation']);
							$iParcours = 0;
							$iExiste = FALSE;
							for($iParcours = 0;$iParcours < count($tsValidation); $iParcours++)
							{
								if($tsValidation[$iParcours]==$_iId."-0" || $tsValidation[$iParcours]==$_iId."-1")
								{
									$tsValidation[$iParcours]=$_iId."-1";
									$iExiste = TRUE;
									break;
								}
							}
							if($iExiste==FALSE)
							{
								$tsValidation[count($tsValidation)] = $_iId."-1";
							}
							$toValeurs['verificationPieces_projetValidation'] = implode(";",$tsValidation);
						}
						else
						{
							$toValeurs = $this->verificationPieces->get_verificationPiecesByPieceaVerifier($toPieceaVerifier[$iParcoursCheckBoxes]['pieceaVerifier_id']);
							$tsValidation = explode(";",$toValeurs['verificationPieces_projetValidation']);
							$iParcours = 0;
							$iExiste = FALSE;
							for($iParcours = 0;$iParcours < count($tsValidation); $iParcours++)
							{
								if($tsValidation[$iParcours]==$_iId."-0" || $tsValidation[$iParcours]==$_iId."-1")
								{
									$tsValidation[$iParcours]=$_iId."-0";
									$iExiste = TRUE;
									break;
								}
							}
							if($iExiste==FALSE)
							{
								$tsValidation[count($tsValidation)] = $_iId."-0";
							}
							$toValeurs['verificationPieces_projetValidation'] = implode(";",$tsValidation);
							
						}
						$this->verificationPieces->update($toValeurs);
					}

					echo $_iId;
					//$zRedirect = "edit";
					//redirect("carriere/$zRedirect/$_zHashModule/$_zHashUrl/project/$iElaborationProjetId");
				}
				else
				{
					print_r("null");
				}
			}
			else
			{
				$oData['elaborationProjet_type'] = $_zHashUrl;
				$oData['elaborationProjet_date'] = date("Y-m-d");
				$iElaborationProjetId = $this->elaborationProjet->insert($oData);
				if($iElaborationProjetId!=FALSE)
				{
					switch ($iTypeCarriereId) 
					{
						
						case CONTRAT_DE_TRAVAIL :
							$sPar = $this->postGetValue ("sPar"); 
							$oContratdeTravail = array();
							$oContratdeTravail['contratdeTravail_elaborationProjetId'] = $iElaborationProjetId;
							$oContratdeTravail['contratdeTravail_par'] = $this->postGetValue ("sPar") ;
							$iContratdeTravailId = $this->contratdeTravail->insert($oContratdeTravail);
							if($iContratdeTravailId!=FALSE)
							{
								if($sPar==PAR_REMPLACEMENT_NUMERIQUE)
								{
									$oParRemplacementNumerique = array();
									$oParRemplacementNumerique['parRemplacementNumerique_ContratdeTravailID'] = $iContratdeTravailId;
									$this->parRemplacementNumerique->insert($oParRemplacementNumerique);
								}
								else if($sPar==PAR_DOTATION_POSTE_BUDGETAIRE)
								{
									$oParDotationPosteBudgetaire = array();
									$oParDotationPosteBudgetaire['pardotationPosteBudgetaire_ContratdeTravailID'] = $iContratdeTravailId;
									$this->parDotationPosteBudgetaire->insert($oParDotationPosteBudgetaire);
								}
							}
							break;

						case ENGAGEMENT_ELD :
							$sPar = $this->postGetValue ("sPar"); 
							$oEngagementELD = array();
							$oEngagementELD['decisiondEngagementELD_ElaborationProjetId'] = $iElaborationProjetId;
							$oEngagementELD['decisiondEngagementELD_par'] = $this->postGetValue ("sPar") ;
							$iEngagementELDId = $this->eld->insert($oEngagementELD);
							if($iEngagementELDId!=FALSE)
							{
								if($sPar==PAR_REMPLACEMENT_NUMERIQUE)
								{
									$oParRemplacementNumerique = array();
									$oParRemplacementNumerique['parRemplacementNumerique_DecisiondEngagementELDId'] = $iEngagementELDId;
									$this->parRemplacementNumerique->insert($oParRemplacementNumerique);
								}
								else if($sPar==PAR_DOTATION_POSTE_BUDGETAIRE)
								{
									$oParDotationPosteBudgetaire = array();
									$oParDotationPosteBudgetaire['parDotationPosteBudgetaire_DecisiondEngagementELDId'] = $iEngagementELDId;
									$this->parDotationPosteBudgetaire->insert($oParDotationPosteBudgetaire);
								}
							}
							break;
						case ENGAGEMENT_ECD :
							$oEngagementECD = array();
							$oEngagementECD['decisiondEngagementECD_ElaborationProjetId'] = $iElaborationProjetId;
							$iEngagementECDId = $this->ecd->insert($oEngagementECD);
							break;
						case ARRETE_DE_NOMINATION :
							$oArrete = array();
							$oArrete['arretedeNomination_ElaborationProjetId'] = $iElaborationProjetId;
							$iArreteId = $this->arretedeNomination->insert($oArrete);
							break;
					}
					
					$iParcoursCheckBoxes = 0;
					for($iParcoursCheckBoxes=0;$iParcoursCheckBoxes<sizeof($toPieceaVerifier);$iParcoursCheckBoxes++)
					{
						$toValeurs = $this->verificationPieces->get_verificationPiecesByPieceaVerifier($toPieceaVerifier[$iParcoursCheckBoxes]['pieceaVerifier_id']);
						if($toValeurs!=null)
						{
							if($this->postGetValue ("doc".$iParcoursCheckBoxes)!=null)
							{
								$tsValidation = explode(";",$toValeurs['verificationPieces_projetValidation']);
								$tsValidation[count($tsValidation)] = $iElaborationProjetId."-1";
								$toValeurs['verificationPieces_projetValidation'] = implode(";",$tsValidation);
							}
							else
							{
								$tsValidation = explode(";",$toValeurs['verificationPieces_projetValidation']);
								$tsValidation[count($tsValidation)] = $iElaborationProjetId."-0";
								$toValeurs['verificationPieces_projetValidation'] = implode(";",$tsValidation);
							}
							$this->verificationPieces->update($toValeurs);
						}
						else
						{
							if($this->postGetValue ("doc".$iParcoursCheckBoxes)!=null)
							{
								$toValeurs['verificationPieces_PieceaVerifierId'] = $this->postGetValue ("doc".$iParcoursCheckBoxes) ;
								$toValeurs['verificationPieces_projetValidation'] = $iElaborationProjetId."-1";
							}
							else
							{
								$toValeurs['verificationPieces_PieceaVerifierId'] = $toPieceaVerifier[$iParcoursCheckBoxes]['pieceaVerifier_id'];
								$toValeurs['verificationPieces_projetValidation'] = $iElaborationProjetId."-0";
							}
							$this->verificationPieces->insert($toValeurs);
						}
					}
					
					echo $iElaborationProjetId;

					//$zRedirect = "edit";
					//redirect("carriere/$zRedirect/$_zHashModule/$_zHashUrl/project/$iElaborationProjetId");
				}
				else
				{
					print_r("FALSE");
				}
				
			}
		} 
		else 
		{
			$this->mon_cv();
		}
    	
	}

	/** 
	* Sauvegarde projet carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function saveProject($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE)
	{
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
    	
		if($iRet == 1)
		{	
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
			$oData = $this->elaborationProjet->get_elaborationProjet($_iId);
			$iElaborationProjetId = $oData['elaborationProjet_id'];
			if($iElaborationProjetId!=FALSE)
			{
				switch ($iTypeCarriereId) 
				{
					
					case CONTRAT_DE_TRAVAIL :
						$oCandidatRecherche=$this->candidatCarriere->get_candidat_by_multicritere(array("candidat_matricule"),array($this->postGetValue("immatriculation")));
						if($oCandidatRecherche[0]!=null)
						{
							$oCandidatRecherche = $oCandidatRecherche[0];
							$oData['elaborationProjet_CandidatId'] = $oCandidatRecherche['candidat_id'];
							//$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							//$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							$this->candidatCarriere->update($oCandidatRecherche);
							
						}
						else
						{
							$oCandidatRecherche=array();
							$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							//$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							$iIdCandidatRecherche = $this->candidatCarriere->insert($oCandidatRecherche);
							$oData['elaborationProjet_CandidatId'] = $iIdCandidatRecherche;
						}
						$oData['elaborationProjet_date'] = $this->date_fr_to_en($this->postGetValue ("dateProjet"),'/','-');
						($this->postGetValue("sigleHidden")!=""?$oData['elaborationProjet_sigle'] = $this->postGetValue("sigleHidden"):$oData['erreur'] = true);
						($this->postGetValue("lieuExercicedEmploi")!=""?$oData['elaborationProjet_lieuExerciceEmploi'] = $this->postGetValue("lieuExercicedEmploi"):$oData['erreur'] = true);
						$oData['elaborationProjet_CorpsId'] = $this->postGetValue ("corps") ;
						$oData['elaborationProjet_GradeId'] = $this->postGetValue ("grade") ;
						$oData['elaborationProjet_IndiceId'] = $this->postGetValue ("indice") ;
						$oData['elaborationProjet_MinistereId'] = $this->postGetValue ("ministere") ;
						$oData['elaborationProjet_DepartementId'] = $this->postGetValue ("departement") ;
						$oData['elaborationProjet_DirectionId'] = $this->postGetValue ("direction") ;
						$oData['elaborationProjet_ServiceId'] = $this->postGetValue ("service") ;
						($this->postGetValue("fonction")!=""?$oData['elaborationProjet_fonction'] = $this->postGetValue("fonction"):$oData['erreur'] = true);
						if($this->postGetValue ("duree")!="" &&  ctype_digit(strval($this->postGetValue ("duree"))))
						{
							$oData['elaborationProjet_dureeService'] = $this->postGetValue ("duree") ;
						}
						else
						{
							$oData['erreur'] = true ;
						}
						((strtotime($this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-'))>=strtotime($oData['elaborationProjet_date']))?$oData['elaborationProjet_datePriseService'] = $this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-'):$oData['erreur'] = true);
						//$oData['elaborationProjet_datePriseService'] = $this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-');
						$this->elaborationProjet->update($oData);
						
						$oContratdeTravail = $this->contratdeTravail->get_contratdeTravailParElaborationProjet($_iId);
						$iContratdeTravailId = $oContratdeTravail['contratdeTravail_id'];
						$sPar = $oContratdeTravail['contratdeTravail_par'];
						($this->postGetValue("numeroLettre")!=""?$oContratdeTravail['contratdeTravail_numeroLettre'] = $this->postGetValue("numeroLettre"):$oContratdeTravail['erreur'] = true);
						$oContratdeTravail['contratdeTravail_dateLettre'] = $this->date_fr_to_en($this->postGetValue ("dateLettre"),'/','-');
						($this->postGetValue("chapitre")!=""?$oContratdeTravail['contratdeTravail_chapitre'] = $this->postGetValue("chapitre"):$oContratdeTravail['erreur'] = true);
						($this->postGetValue("groupe")!=""?$oContratdeTravail['contratdeTravail_groupe'] = $this->postGetValue("groupe"):$oContratdeTravail['erreur'] = true);
						$this->contratdeTravail->update($oContratdeTravail);
						 
						if($iContratdeTravailId!=FALSE)
						{
							if($sPar==PAR_REMPLACEMENT_NUMERIQUE)
							{
								//print_r("debut");
								$oPar=$this->parRemplacementNumerique
								->get_parRemplacementNumeriqueParContratdeTravail($iContratdeTravailId);
								$oCandidatRemplacement=$this->candidat->get_candidat_by_multicritere(array("matricule"),array($this->postGetValue("immatriculationaRemplacer")));
								if($oCandidatRemplacement[0]!=null)
								{
									//print_r($oCandidatRemplacement[0]);
									$oPar['parRemplacementNumerique_CandidatId']=$oCandidatRemplacement[0]['id'];
								}
								$oPar['parRemplacementNumerique_CorpsId'] = $this->postGetValue("corpsAgentaRemplacer");
								$oPar['parRemplacementNumerique_GradeId'] = $this->postGetValue("gradeAgentaRemplacer");
								($this->postGetValue("statut")!=""?$oPar['parRemplacementNumerique_statutFin'] = $this->postGetValue("statut"):$oPar['erreur'] = true);
								$oPar['parRemplacementNumerique_datedeFin'] =  $this->date_fr_to_en($this->postGetValue ("datedAdmission"),'/','-');
								
								$this->parRemplacementNumerique->update($oPar);
							}
							else if($sPar==PAR_DOTATION_POSTE_BUDGETAIRE)
							{
								$oPar=$this->parDotationPosteBudgetaire
								->get_parDotationPosteBudgetaireParContratdeTravail($iContratdeTravailId);
								($this->postGetValue("numeroLettre")!=""?$oPar['pardotationPosteBudgetaire_numeroLettre'] = $this->postGetValue("numeroLettre"):$oPar['erreur'] = true);
								$oPar['pardotationPosteBudgetaire_dateLettre'] = $this->date_fr_to_en($this->postGetValue ("dateLettre"),'/','-');
								$this->parDotationPosteBudgetaire->update($oPar);
							}
						}
						break;

					case ENGAGEMENT_ELD :

						$oData['elaborationProjet_sigle'] = $this->postGetValue ("sigleHidden") ;
						$oData['elaborationProjet_date'] = $this->date_fr_to_en($this->postGetValue ("dateProjet"),'/','-');
						$oCandidatRecherche=$this->candidatCarriere->get_candidat_by_multicritere(array("candidat_matricule"),array($this->postGetValue("immatriculation")));
						
						if($oCandidatRecherche[0]!=null)
						{
							$oCandidatRecherche = $oCandidatRecherche[0];
							$oData['elaborationProjet_CandidatId'] = $oCandidatRecherche['candidat_id'];
							//$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							//$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_datedeNaissance'] = $this->date_fr_to_en($this->postGetValue ("datedeNaissance"),'/','-') ;
							($this->postGetValue("lieudeNaissance")!=""?$oCandidatRecherche['candidat_lieudeNaissance'] = $this->postGetValue("lieudeNaissance"):$oData['erreur'] = true);
							($this->postGetValue("situationdeFamille")!=""?$oCandidatRecherche['candidat_situationdeFamille'] = $this->postGetValue("situationdeFamille"):$oData['erreur'] = true);
							$this->candidatCarriere->update($oCandidatRecherche);
						}
						else
						{
							$oCandidatRecherche=array();
							$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							//$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_datedeNaissance'] = $this->date_fr_to_en($this->postGetValue ("datedeNaissance"),'/','-') ;
							($this->postGetValue("lieudeNaissance")!=""?$oCandidatRecherche['candidat_lieudeNaissance'] = $this->postGetValue("lieudeNaissance"):$oData['erreur'] = true);
							($this->postGetValue("situationdeFamille")!=""?$oCandidatRecherche['candidat_situationdeFamille'] = $this->postGetValue("situationdeFamille"):$oData['erreur'] = true);
							$iIdCandidatRecherche = $this->candidatCarriere->insert($oCandidatRecherche);
							$oData['elaborationProjet_CandidatId'] = $iIdCandidatRecherche;
						}
						$oData['elaborationProjet_MinistereId'] = $this->postGetValue ("ministere") ;
						$oData['elaborationProjet_DepartementId'] = $this->postGetValue ("departement") ;
						$oData['elaborationProjet_DirectionId'] = $this->postGetValue ("direction") ;
						$oData['elaborationProjet_ServiceId'] = $this->postGetValue ("service") ;
						($this->postGetValue("fonction")!=""?$oData['elaborationProjet_fonction'] = $this->postGetValue("fonction"):$oData['erreur'] = true);
						
						($this->postGetValue("lieuExercicedEmploi")!=""?$oData['elaborationProjet_lieuExerciceEmploi'] = $this->postGetValue("lieuExercicedEmploi"):$oData['erreur'] = true);
						($this->postGetValue("imputationBudgetaire")!=""?$oData['elaborationProjet_imputationBudgetaire'] = $this->postGetValue("imputationBudgetaire"):$oData['erreur'] = true);
						
						if($this->postGetValue ("duree")!="" &&  ctype_digit(strval($this->postGetValue ("duree"))))
						{
							$oData['elaborationProjet_dureeService'] = $this->postGetValue ("duree") ;
						}
						else
						{
							$oData['erreur'] = true ;
						}
						((strtotime($this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-'))>=strtotime($oData['elaborationProjet_date']))?$oData['elaborationProjet_datePriseService'] = $this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-'):$oData['erreur'] = true);
						//$oData['elaborationProjet_datePriseService'] = $this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-');
						
						$this->elaborationProjet->update($oData);

						$oEngagementELD = $this->eld->get_engagementELDParElaborationProjet($_iId);
						$iEngagementELDId = $oEngagementELD['decisiondEngagementELD_id'];
						$sPar = $oEngagementELD['decisiondEngagementELD_par'];
						($this->postGetValue("attestationdeQualification")!=""?$oEngagementELD['decisiondEngagementELD_attestationdeQualification'] = $this->postGetValue("attestationdeQualification"):$oEngagementELD['erreur'] = true);
						($this->postGetValue("remunerationdeBase")!=""?$oEngagementELD['decisiondEngagementELD_remunerationdeBase'] = $this->postGetValue("remunerationdeBase"):$oEngagementELD['erreur'] = true);
						$this->eld->update($oEngagementELD);
						 
						
						if($iEngagementELDId!=FALSE)
						{
							if($sPar==PAR_REMPLACEMENT_NUMERIQUE)
							{
								$oPar=$this->parRemplacementNumerique
								->get_parRemplacementNumeriqueParELD($iEngagementELDId);
								$oCandidatRemplacement=$this->candidat->get_candidat_by_multicritere(array("matricule"),array($this->postGetValue("immatriculationaRemplacer")));
								if($oCandidatRemplacement[0]!=null)
								{
									$oPar['parRemplacementNumerique_CandidatId']=$oCandidatRemplacement[0]['id'];
								}
								$oPar['parRemplacementNumerique_CorpsId'] = $this->postGetValue("corpsAgentaRemplacer");
								//$oPar['parRemplacementNumerique_GradeId'] = $this->postGetValue("gradeAgentaRemplacer");
								($this->postGetValue("referencedelActe")!=""?$oPar['parRemplacementNumerique_referenceActeAdministratif'] = $this->postGetValue("referencedelActe"):$oPar['erreur'] = true);
								($this->postGetValue("statut")!=""?$oPar['parRemplacementNumerique_statutFin'] = $this->postGetValue("statut"):$oPar['erreur'] = true);
								$oPar['parRemplacementNumerique_datedeFin'] =  $this->date_fr_to_en($this->postGetValue ("datedAdmission"),'/','-');
								$oPar['parRemplacementNumerique_dateReferenceActeAdministratif'] =  $this->date_fr_to_en($this->postGetValue ("dateActe"),'/','-');
								
								$this->parRemplacementNumerique->update($oPar);
							}
							else if($sPar==PAR_DOTATION_POSTE_BUDGETAIRE)
							{
								$oPar=$this->parDotationPosteBudgetaire
								->get_parDotationPosteBudgetaireParELD($iEngagementELDId);
								($this->postGetValue("numeroLettre")!=""?$oPar['pardotationPosteBudgetaire_numeroLettre'] = $this->postGetValue("numeroLettre"):$oPar['erreur'] = true);
								$oPar['pardotationPosteBudgetaire_dateLettre'] = $this->date_fr_to_en($this->postGetValue ("dateLettre"),'/','-');
								$this->parDotationPosteBudgetaire->update($oPar);
							}
						}
						break;
					case ENGAGEMENT_ECD :
						$oData['elaborationProjet_sigle'] = $this->postGetValue ("sigleHidden") ;
						$oData['elaborationProjet_date'] = $this->date_fr_to_en($this->postGetValue ("dateProjet"),'/','-');
						$oCandidatRecherche=$this->candidatCarriere->get_candidat_by_multicritere(array("candidat_matricule"),array($this->postGetValue("immatriculation")));
						
						if($oCandidatRecherche[0]!=null)
						{
							$oCandidatRecherche = $oCandidatRecherche[0];
							$oData['elaborationProjet_CandidatId'] = $oCandidatRecherche['candidat_id'];
							//$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_datedeNaissance'] = $this->date_fr_to_en($this->postGetValue ("datedeNaissance"),'/','-') ;
							($this->postGetValue("lieudeNaissance")!=""?$oCandidatRecherche['candidat_lieudeNaissance'] = $this->postGetValue("lieudeNaissance"):$oData['erreur'] = true);
							($this->postGetValue("situationdeFamille")!=""?$oCandidatRecherche['candidat_situationdeFamille'] = $this->postGetValue("situationdeFamille"):$oData['erreur'] = true);
							$this->candidatCarriere->update($oCandidatRecherche);
						}
						else
						{
							$oCandidatRecherche=array();
							$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_datedeNaissance'] = $this->date_fr_to_en($this->postGetValue ("datedeNaissance"),'/','-') ;
							($this->postGetValue("lieudeNaissance")!=""?$oCandidatRecherche['candidat_lieudeNaissance'] = $this->postGetValue("lieudeNaissance"):$oData['erreur'] = true);
							($this->postGetValue("situationdeFamille")!=""?$oCandidatRecherche['candidat_situationdeFamille'] = $this->postGetValue("situationdeFamille"):$oData['erreur'] = true);
							$iIdCandidatRecherche = $this->candidatCarriere->insert($oCandidatRecherche);
							$oData['elaborationProjet_CandidatId'] = $iIdCandidatRecherche;
						}
						$oData['elaborationProjet_MinistereId'] = $this->postGetValue ("ministere") ;
						$oData['elaborationProjet_DepartementId'] = $this->postGetValue ("departement") ;
						$oData['elaborationProjet_DirectionId'] = $this->postGetValue ("direction") ;
						$oData['elaborationProjet_ServiceId'] = $this->postGetValue ("service") ;
						($this->postGetValue("fonction")!=""?$oData['elaborationProjet_fonction'] = $this->postGetValue("fonction"):$oData['erreur'] = true);
						($this->postGetValue("lieuExercicedEmploi")!=""?$oData['elaborationProjet_lieuExerciceEmploi'] = $this->postGetValue("lieuExercicedEmploi"):$oData['erreur'] = true);
						($this->postGetValue("imputationBudgetaire")!=""?$oData['elaborationProjet_imputationBudgetaire'] = $this->postGetValue("imputationBudgetaire"):$oData['erreur'] = true);
						
						$this->elaborationProjet->update($oData);

						$oEngagementECD = $this->ecd->get_engagementECDParElaborationProjet($_iId);
						($this->postGetValue("dureedelEngagement")!=""?$oEngagementECD['decisiondEngagementECD_dureeEngagement'] = $this->postGetValue("dureedelEngagement"):$oEngagementECD['erreur'] = true);
						if(strtotime($this->date_fr_to_en($this->postGetValue ("finPeriode"),'/','-'))>=strtotime($this->date_fr_to_en($this->postGetValue ("datePriseService"),'/','-')))
						{
							$oEngagementECD['decisiondEngagementECD_debutPeriode'] = $this->date_fr_to_en($this->postGetValue ("debutPeriode"),'/','-') ;
							$oEngagementECD['decisiondEngagementECD_finPeriode'] = $this->date_fr_to_en($this->postGetValue ("finPeriode"),'/','-') ;
						}
						else
						{
							$oEngagementECD['erreur'] = true;
						}
						
						($this->postGetValue("categoriedEmploi")!=""?$oEngagementECD['decisiondEngagementECD_categoriedEmploi'] = $this->postGetValue("categoriedEmploi"):$oEngagementECD['erreur'] = true);
						($this->postGetValue("categorie")!=""?$oEngagementECD['decisiondEngagementECD_categorie'] = $this->postGetValue("categorie"):$oEngagementECD['erreur'] = true);
						($this->postGetValue("mission")!=""?$oEngagementECD['decisiondEngagementECD_mission'] = $this->postGetValue("mission"):$oEngagementECD['erreur'] = true);
						($this->postGetValue("objectif")!=""?$oEngagementECD['decisiondEngagementECD_objectifs'] = $this->postGetValue("objectif"):$oEngagementECD['erreur'] = true);
						($this->postGetValue("indicateurdObjectif")!=""?$oEngagementECD['decisiondEngagementECD_indicateursObjectifs'] = $this->postGetValue("indicateurdObjectif"):$oEngagementECD['erreur'] = true);
						($this->postGetValue("activite")!=""?$oEngagementECD['decisiondEngagementECD_activite'] = $this->postGetValue("activite"):$oEngagementECD['erreur'] = true);
						($this->postGetValue("financement")!=""?$oEngagementECD['decisiondEngagementECD_financement'] = $this->postGetValue("financement"):$oEngagementECD['erreur'] = true);
						
						$this->ecd->update($oEngagementECD);
						break;
					case ARRETE_DE_NOMINATION :
						$oData['elaborationProjet_date'] = $this->date_fr_to_en($this->postGetValue ("dateProjet"),'/','-');
						$oCandidatRecherche=$this->candidatCarriere->get_candidat_by_multicritere(array("candidat_matricule"),array($this->postGetValue("immatriculation")));
						
						if($oCandidatRecherche[0]!=null)
						{
							$oCandidatRecherche = $oCandidatRecherche[0];
							$oData['elaborationProjet_CandidatId'] = $oCandidatRecherche['candidat_id'];
							//$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							//($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							($this->postGetValue("situationdeFamille")!=""?$oCandidatRecherche['candidat_situationdeFamille'] = $this->postGetValue("situationdeFamille"):$oData['erreur'] = true);
							$this->candidatCarriere->update($oCandidatRecherche);
						}
						else
						{
							$oCandidatRecherche=array();
							$oCandidatRecherche['candidat_dateCreation'] = date("Y-m-d H:i:s");
							//($this->postGetValue("denomination")!=""?$oCandidatRecherche['candidat_denomination'] = $this->postGetValue("denomination"):$oData['erreur'] = true);
							($this->postGetValue("immatriculation")!=""?$oCandidatRecherche['candidat_matricule'] = $this->postGetValue("immatriculation"):$oData['erreur'] = true);
							$oCandidatRecherche['candidat_cin'] = $this->postGetValue("cin");
							($this->postGetValue("nom")!=""?$oCandidatRecherche['candidat_nom'] = $this->postGetValue("nom"):$oData['erreur'] = true);
							($this->postGetValue("prenom")!=""?$oCandidatRecherche['candidat_prenom'] = $this->postGetValue("prenom"):$oData['erreur'] = true);
							($this->postGetValue("situationdeFamille")!=""?$oCandidatRecherche['candidat_situationdeFamille'] = $this->postGetValue("situationdeFamille"):$oData['erreur'] = true);
							$iIdCandidatRecherche = $this->candidatCarriere->insert($oCandidatRecherche);
							$oData['elaborationProjet_CandidatId'] = $iIdCandidatRecherche;
						}
						$oData['elaborationProjet_CorpsId'] = $this->postGetValue ("corps") ;
						$oData['elaborationProjet_GradeId'] = $this->postGetValue ("grade") ;
						$oData['elaborationProjet_IndiceId'] = $this->postGetValue ("indice") ;
						$oData['elaborationProjet_MinistereId'] = $this->postGetValue ("ministere") ;
						($this->postGetValue("imputationBudgetaire")!=""?$oData['elaborationProjet_imputationBudgetaire'] = $this->postGetValue("imputationBudgetaire"):$oData['erreur'] = true);
						
						$this->elaborationProjet->update($oData);

						$oArrete = $this->arretedeNomination->get_arretedeNominationParElaborationProjet($_iId);
						($this->postGetValue("numeroduDecret")!=""?$oArrete['arretedeNomination_numeroDecret'] = $this->postGetValue("numeroduDecret"):$oArrete['erreur'] = true);
						$oArrete['arretedeNomination_dateDecret'] = $this->date_fr_to_en($this->postGetValue ("dateduDecret"),'/','-') ;
						($this->postGetValue("numeroduDecretAdditif")!=""?$oArrete['arretedeNomination_numeroDecretAdditif'] = $this->postGetValue("numeroduDecretAdditif"):$oArrete['erreur'] = true);
						$oArrete['arretedeNomination_dateDecretAdditif'] = $this->date_fr_to_en($this->postGetValue ("dateduDecretAdditif"),'/','-') ;
						($this->postGetValue("numeroArrete")!=""?$oArrete['arretedeNomination_numeroArrete'] = $this->postGetValue("numeroArrete"):$oArrete['erreur'] = true);
						$oArrete['arretedeNomination_dateArrete'] = $this->date_fr_to_en($this->postGetValue ("dateArrete"),'/','-') ;
						($this->postGetValue("ecoleFormation")!=""?$oArrete['arretedeNomination_ecole'] = $this->postGetValue("ecoleFormation"):$oArrete['erreur'] = true);
						($this->postGetValue("promotion")!=""?$oArrete['arretedeNomination_promotion'] = $this->postGetValue("promotion"):$oArrete['erreur'] = true);
						($this->postGetValue("diplome")!=""?$oArrete['arretedeNomination_diplome'] = $this->postGetValue("diplome"):$oArrete['erreur'] = true);
						($this->postGetValue("section")!=""?$oArrete['arretedeNomination_section'] = $this->postGetValue("section"):$oArrete['erreur'] = true);
						if($this->postGetValue ("postesDisponibles")!="" &&  ctype_digit(strval($this->postGetValue ("postesDisponibles"))))
						{
							$oArrete['arretedeNomination_nombrePostesDisponibles'] = $this->postGetValue ("postesDisponibles") ;
						}
						else
						{
							$oArrete['erreur'] = true ;
						}
						if($this->postGetValue ("postesRequis")!="" &&  ctype_digit(strval($this->postGetValue ("postesRequis"))))
						{
							$oArrete['arretedeNomination_nombrePostesRequis'] = $this->postGetValue ("postesRequis") ;
						}
						else
						{
							$oArrete['erreur'] = true ;
						}
						$oArrete['arretedeNomination_dateListeAdmis'] = $this->date_fr_to_en($this->postGetValue ("dateCandidatsAdmis"),'/','-') ;
						$oArrete['arretedeNomination_dateListeDefinitive'] = $this->date_fr_to_en($this->postGetValue ("dateDefinitive"),'/','-') ;
						($this->postGetValue("bonification")!=""?$oArrete['arretedeNomination_bonificationdAnciennete'] = $this->postGetValue("bonification"):$oArrete['erreur'] = true);
						($this->postGetValue("numeroBonification")!=""?$oArrete['arretedeNomination_numeroArreteBonification'] = $this->postGetValue("numeroBonification"):$oArrete['erreur'] = true);
						$oArrete['arretedeNomination_dateArreteBonification'] = $this->date_fr_to_en($this->postGetValue ("dateBonification"),'/','-') ;
						
						$this->arretedeNomination->update($oArrete);
						break;
				}
				/*$zRedirect = "edit";
				redirect("carriere/$zRedirect/$_zHashModule/$_zHashUrl/be/$iElaborationProjetId");*/
			}
			
		}
		else 
		{
			$this->mon_cv();
		}
    	
	}

	/** 
	* Sauvegarde BE
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function saveBE($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE)
	{
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();
		if($iRet == 1)
		{	
			$oBE = $this->elaborationBE->findElaborationduBEbyElaborationProjet($_iId);
			if($oBE != null)
			{
				//$oBE['elaborationduBE_CandidatId'] = $oCandidat['id'];
				$oBE['elaborationduBE_expediteur'] = $this->postGetValue("expediteur");
				$oBE['elaborationduBE_destinataire'] = $this->postGetValue("destinataire");
				$oBE['elaborationduBE_MinistereId'] = $this->postGetValue("ministereBE");
				$oBE['elaborationduBE_DepartementId'] = $this->postGetValue("departementBE");
				$oBE['elaborationduBE_DirectionId'] = $this->postGetValue("directionBE");
				$oBE['elaborationduBE_ServiceId'] = $this->postGetValue("serviceBE");
				($this->postGetValue("sigleBEHidden")!=""?$oBE['elaborationduBE_sigle'] = $this->postGetValue("sigleBEHidden"):$oBE['erreur'] = true);
				
				$oBE['elaborationduBE_nombreaEnvoyer'] = $this->postGetValue("nombreHidden");
				$nombre = $oBE['elaborationduBE_nombreaEnvoyer'];
				$tsIdProjet = array();
				$iParcours = 0;
				for($iParcours = 0;$iParcours<$nombre;$iParcours++)
				{
					/*if(($this->postGetValue("matriculeBE".$iParcours)!==null) && ($this->postGetValue("dateBE".$iParcours)!==null))
					{
						$oProjet = $this->elaborationProjet->getElaborationProjetByMatriculeAndDate($this->postGetValue("matriculeBE".$iParcours),$this->date_fr_to_en($this->postGetValue("dateBE".$iParcours),'/','-'));
						if($oProjet!==null)
						{
							$tsIdProjet[$iParcours] = " ".$oProjet['elaborationProjet_id']." ";
						}
						else
						{
							$tsIdProjet[$iParcours] = null;
						}
					}*/
					if($this->postGetValue("nomsPrenoms".$iParcours)!==null)
					{
						$oProjet = $this->postGetValue("nomsPrenoms".$iParcours);
						$tsIdProjet[$iParcours] = " ".$oProjet." ";
					}
					
				}
				$oBE['elaborationduBE_candidats'] = implode(";",array_filter($tsIdProjet));
				$oBE['elaborationduBE_nombreaEnvoyer'] = sizeof(explode(";",$oBE['elaborationduBE_candidats']));
				$this->elaborationBE->update($oBE);

			}
			else
			{
				$oBE = array();
				$oBE['elaborationduBE_ElaborationProjetId'] = $_iId;
				$oBE['elaborationduBE_expediteur'] = $this->postGetValue("expediteur");
				$oBE['elaborationduBE_destinataire'] = $this->postGetValue("destinataire");
				$oBE['elaborationduBE_MinistereId'] = $this->postGetValue("ministereBE");
				$oBE['elaborationduBE_DepartementId'] = $this->postGetValue("departementBE");
				$oBE['elaborationduBE_DirectionId'] = $this->postGetValue("directionBE");
				$oBE['elaborationduBE_ServiceId'] = $this->postGetValue("serviceBE");
				$oBE['elaborationduBE_sigle'] = $this->postGetValue("sigleBEHidden");

				$oBE['elaborationduBE_nombreaEnvoyer'] = $this->postGetValue("nombreHidden");
				//print_r("nombre=".($oBE['elaborationduBE_nombreaEnvoyer']));
				$nombre = $oBE['elaborationduBE_nombreaEnvoyer'];
				$tsIdProjet = array();
				$iParcours = 0;
				for($iParcours = 0;$iParcours<$nombre;$iParcours++)
				{
					/*if(($this->postGetValue("matriculeBE".$iParcours)!==null) && ($this->postGetValue("dateBE".$iParcours)!==null))
					{
						$oProjet = $this->elaborationProjet->getElaborationProjetByMatriculeAndDate($this->postGetValue("matriculeBE".$iParcours),$this->date_fr_to_en($this->postGetValue("dateBE".$iParcours),'/','-'));
						if($oProjet!==null)
						{
							print_r("non null");
							$tsIdProjet[$iParcours] = " ".$oProjet['elaborationProjet_id']." ";
						}
						else
						{
							print_r("null");
							$tsIdProjet[$iParcours] = null;
						}
					}*/
					if($this->postGetValue("nomsPrenoms".$iParcours)!==null)
					{
						$oProjet = $this->postGetValue("nomsPrenoms".$iParcours);
						$tsIdProjet[$iParcours] = " ".$oProjet." ";
					}
				}
				$oBE['elaborationduBE_candidats'] = implode(";",array_filter($tsIdProjet));
				//print_r("implode=".($oBE['elaborationduBE_ElaborationProjetId']));
				$oBE['elaborationduBE_nombreaEnvoyer'] = sizeof(explode(";",$oBE['elaborationduBE_candidats']));
				$idBE = $this->elaborationBE->insert($oBE);

			}
		}
		else 
		{
			$this->mon_cv();
		}
	}
	
	/** 
	* impression
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param string $_sTab Onglet
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function imprimer($_zHashModule = FALSE, $_zHashUrl = FALSE, $_sTab = FALSE, $_iId = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		//require_once(APPPATH.'libraries/ion_auth.php');
    	
		if($iRet == 1)
		{	
			$oData['iNumId'] = sprintf("%'.06d\n", $_iId);
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
			 
			$zSelect = "" ; 

			$iCompteActif = $this->getSessionCompte();
 
			$oData['iTypeCarriereId'] = $iTypeCarriereId;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['zHashTab'] = $_sTab;

			$oData['iId'] = $_iId ;
			$oData['toDay'] = date("Y-m-d") ; 
			$oData['zBasePath'] = base_url() ;

			$oData['oProject'] = $this->setDonneesProject($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);
			switch ($iTypeCarriereId) 
			{
				
				
				case CONTRAT_DE_TRAVAIL :
					if($oData['oProject']['oContratdeTravail']['contratdeTravail_par'] == "dotation-poste-budgetaire")
					{
						$this->parDotationPosteBudgetaire->setImprimerContratPdf($oData, $this);
					}
					else if($oData['oProject']['oContratdeTravail']['contratdeTravail_par'] == "remplacement-numerique")
					{
						$this->parRemplacementNumerique->setImprimerContratPdf($oData, $this);
					}
					break;

				case ENGAGEMENT_ELD :
					if($oData['oProject']['oEngagementELD']['decisiondEngagementELD_par'] == "dotation-poste-budgetaire")
					{
						$this->parDotationPosteBudgetaire->setImprimerELDPdf($oData, $this);
					}
					else if($oData['oProject']['oEngagementELD']['decisiondEngagementELD_par'] == "remplacement-numerique")
					{
						$this->parRemplacementNumerique->setImprimerELDPdf($oData, $this);
					}
					
					break;

				case ENGAGEMENT_ECD :
					$this->ecd->setImprimerPdf($oData, $this);
					
					break;

				case ARRETE_DE_NOMINATION :
					$this->arretedeNomination->setImprimerPdf($oData, $this);
					
					break;
			}
    	
		}
		else 
		{
			$this->mon_cv();
		}	
	}
	
	/** 
	* impression BE
	*
	* @param string $_zHashModule Hashage du module 
	* @param string $_zHashUrl URL en cours
	* @param string $_sTab Onglet
	* @param int $_iId Identifiant du carrière
	* @return view
	*/
	public function imprimerBE($_zHashModule = FALSE, $_zHashUrl = FALSE, $_sTab = FALSE, $_iId = FALSE){
		
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		//require_once(APPPATH.'libraries/ion_auth.php');
    	
		if($iRet == 1)
		{	
			$oData['iNumId'] = sprintf("%'.06d\n", $_iId);
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;

			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);
			
			$zLibelle = "" ; 
			$zTitre	= "" ; 
			$zSelect = "" ; 

			$iCompteActif = $this->getSessionCompte();
 
			$oData['iTypeCarriereId'] = $iTypeCarriereId;
			$oData['zHashUrl'] = $_zHashUrl ; 
			$oData['zHashModule'] = $_zHashModule ;
			$oData['zHashTab'] = $_sTab;

			$oData['iId'] = $_iId ;
			$oData['toDay'] = date("Y-m-d") ; 
			$oData['zBasePath'] = base_url() ;

			$oData['oBE'] = $this->setDonneesBE($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);

			$oBE = $oData['oBE']['oBE'];
			$tsIdProjet = explode(";",$oBE['elaborationduBE_candidats']);
			$iParcours = 0;
			$tsCandidatsProjet = array();
			for($iParcours = 0;$iParcours<sizeof($tsIdProjet);$iParcours++)
			{
				if($tsIdProjet[$iParcours]!="")
				{
					/*$iIdProjet=$tsIdProjet[$iParcours];
					$oProjet = $this->elaborationProjet->getElaborationProjetByIdProjet($iIdProjet);
					$tsCandidatsProjet[$iParcours] = $oProjet['candidat_nom']." ".$oProjet['candidat_prenom'];*/
					$tsCandidatsProjet[$iParcours] = $tsIdProjet[$iParcours];
				}
			}
			$oData['oBE']['tsCandidatsProjet'] = $tsCandidatsProjet;
			$this->elaborationBE->setImprimerPdf($oData, $this);
    	
		}
		else 
		{
			$this->mon_cv();
		}	
	}

	/** 
	* test date 
	*
	* @param date $_sDate date à tester
	* @return boolean
	*/
	private function isDate($_sDate)
	{
		return (bool)strtotime($_sDate);
	}

	/** 
	* les projets de carrière 
	*
	* @param string $_zHashModule Hashage du module 
	* @param integer $_iCurrPage identifiant de la page
	* @return view
	*/
	public function projets($_zHashModule = FALSE, $_iCurrPage = 1)
	{

		/*$oUser = array();
		$oCandidat = array();
		$iRet = $this->checkUtilisateur($oUser, $oCandidat);*/

		$iCompteActif = $this->getSessionCompte();

		$oData = array();

		$iParcours=0;
		$iNbrPerPage = 4;
		$iNbrTotal = 0;
		$iDebut = $_iCurrPage;
		$toProjet = $this->elaborationProjet->get_elaborationProjetPagination($iDebut,$iNbrTotal,$iNbrPerPage);
		$toCorps = $this->corps->get_corps();
		$toGrade = $this->grade->get_grade();
		$toIndice = $this->indice->get_indice();
		$toMinistere = $this->ministere->get_ministere();
		$toDepartement = $this->departement->get_departement();
		$toDirection = $this->direction->get_direction();
		$toService = $this->service->get_service();

		for($iParcours=0;$iParcours<sizeof($toProjet);$iParcours++)
		{
			if($toProjet[$iParcours]['elaborationProjet_CandidatId']!=null){
				$toCandidat = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($toProjet[$iParcours]['elaborationProjet_CandidatId']));
				$toProjet[$iParcours]['elaborationProjet_CandidatId'] = $toCandidat[0];
			}
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_MinistereId',$toProjet[$iParcours],$toMinistere);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_DepartementId',$toProjet[$iParcours],$toDepartement);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_DirectionId',$toProjet[$iParcours],$toDirection);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_ServiceId',$toProjet[$iParcours],$toService);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_CorpsId',$toProjet[$iParcours],$toCorps);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_GradeId',$toProjet[$iParcours],$toGrade);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_IndiceId',$toProjet[$iParcours],$toIndice);
			
		}

		$oData['taille']=$iNbrTotal;
		$oData['liste']=$toProjet;
		//$requestContentType = $this->input->server('HTTP_ACCEPT');
		$requestContentType = 'application/json';
		$this->setHttpHeaders($requestContentType, 200);
		$response = $this->encodeJson($oData);
		echo $response;
		/*if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($toProjet);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($toProjet);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($toProjet);
			echo $response;
		}*/
		
	}

	/** 
	* recherche projet
	*
	* @param string $_zHashModule Hashage du module 
	* @param integer $_iCurrPage identifiant de la page
	* @return view
	*/
	public function rechercheProjets($_zHashModule = FALSE, $_iCurrPage = 1)
	{
		$oData = array();

		$iParcours=0;
		$iNbrPerPage = 4;
		$iNbrTotal = 0;
		$iDebut = $_iCurrPage;

		$recherche = array();
		$zIdentification = $this->postGetValue ("identification",''); 
		$zMatricule = $this->postGetValue ("matricule",'');
		$zCandidat = $this->postGetValue ("zCandidatSearch",'');
		$zType = $this->postGetValue ("type",'');
		$zDate = $this->postGetValue ("date",'');

		if($zMatricule!='')
		{
			$recherche['c.'.$zIdentification] = $zMatricule;
		}

		if($zCandidat!='')
		{
			$recherche['c.candidat_id'] = $zCandidat;
		}

		if($zType!='')
		{
			$recherche['e.elaborationProjet_type'] = $zType;
		}
		if($zDate!='')
		{
			$recherche['e.elaborationProjet_date'] = $this->date_fr_to_en($zDate,'/','-');
		}

		$toProjet = array();
		if(count($recherche)>0)
		{
			$toProjet = $this->elaborationProjet->searchElaborationProjet($recherche,$iDebut,$iNbrTotal,$iNbrPerPage);
		}
		else
		{
			$toProjet = $this->elaborationProjet->searchElaborationProjet(FALSE,$iDebut,$iNbrTotal,$iNbrPerPage);
		}
		$toCorps = $this->corps->get_corps();
		$toGrade = $this->grade->get_grade();
		$toIndice = $this->indice->get_indice();
		$toMinistere = $this->ministere->get_ministere();
		$toDepartement = $this->departement->get_departement();
		$toDirection = $this->direction->get_direction();
		$toService = $this->service->get_service();

		for($iParcours=0;$iParcours<sizeof($toProjet);$iParcours++)
		{
			if($toProjet[$iParcours]['elaborationProjet_CandidatId']!=null){
				$toCandidat = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($toProjet[$iParcours]['elaborationProjet_CandidatId']));
				$toProjet[$iParcours]['elaborationProjet_CandidatId'] = $toCandidat[0];
			}
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_MinistereId',$toProjet[$iParcours],$toMinistere);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_DepartementId',$toProjet[$iParcours],$toDepartement);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_DirectionId',$toProjet[$iParcours],$toDirection);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_ServiceId',$toProjet[$iParcours],$toService);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_CorpsId',$toProjet[$iParcours],$toCorps);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_GradeId',$toProjet[$iParcours],$toGrade);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_IndiceId',$toProjet[$iParcours],$toIndice);
			
		}

		$oData['taille']=$iNbrTotal;
		$oData['liste']=$toProjet;
		$requestContentType = 'application/json';
		$this->setHttpHeaders($requestContentType, 200);
		$response = $this->encodeJson($oData);
		echo $response;
	}

	/** 
	* Edition/fiche projet de carrière
	*
	* @param string $_zHashModule Hashage du module 
	* @param integer $_iCurrPage identifiant de la page
	* @param integer $_iId identifiant du projet
	* @return view
	*/
	public function projet($_zHashModule = FALSE, $_zHashUrl = FALSE, $_iId = FALSE)
	{
		/*$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);

		$iCompteActif = $this->getSessionCompte();*/
		$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
		$iTypeCarriereId = $this->TypeCarriere->get_by_TypeCarriere_zHashPageUrl($_zHashUrl);


		$oData = array();

		$toCorps = $this->corps->get_corps();
		$toGrade = $this->grade->get_grade();
		$toIndice = $this->indice->get_indice();
		$toMinistere = $this->ministere->get_ministere();
		$toDepartement = $this->departement->get_departement();
		$toDirection = $this->direction->get_direction();
		$toService = $this->service->get_service();

		$oVerify = $this->setDonneesVerify($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);
		$oProjet = $this->setDonneesProject($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);
		$oBE = $this->setDonneesBE($_zHashModule, $_zHashUrl,$_iId,$oUser,$oCandidat);

		switch ($iTypeCarriereId) 
		{
			case CONTRAT_DE_TRAVAIL :
				if($oProjet['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_CandidatId'] = $oProjet['oCandidatRecherche'];
				}
				
				$oProjet['oContratdeTravail']['contratdeTravail_rempDot'] = $oProjet['oContratdeTravail']['contratdeTravail_par'];
				if($oProjet['oContratdeTravail']['contratdeTravail_par'] == PAR_REMPLACEMENT_NUMERIQUE)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_type'] = "contrat-de-travail-r";
					if($oProjet['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId']!=null)
					{
						$oProjet['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId'] = $oProjet['oCandidatRemplacement'];
					}
					$oProjet['oParRemplacementNumerique'] = $this->parcoursEtRemplacement('parRemplacementNumerique_CorpsId',$oProjet['oParRemplacementNumerique'],$toCorps);
					$oProjet['oParRemplacementNumerique'] = $this->parcoursEtRemplacement('parRemplacementNumerique_GradeId',$oProjet['oParRemplacementNumerique'],$toGrade);
					$oProjet['oParRemplacementNumerique'] = $this->parcoursEtRemplacement('parRemplacementNumerique_IndiceId',$oProjet['oParRemplacementNumerique'],$toIndice);
					$oProjet['oContratdeTravail']['contratdeTravail_par'] = $oProjet['oParRemplacementNumerique'];
				}
				else if($oProjet['oContratdeTravail']['contratdeTravail_par'] == PAR_DOTATION_POSTE_BUDGETAIRE)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_type'] = "contrat-de-travail-d";
					$oProjet['oContratdeTravail']['contratdeTravail_par'] = $oProjet['oParDotationPosteBudgetaire'];
				}
				$oData['oContratdeTravail'] = $oProjet["oContratdeTravail"];
				
				break;

			case ENGAGEMENT_ELD :
				if($oProjet['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_CandidatId'] = $oProjet['oCandidatRecherche'];
				}
				
				$oProjet['oEngagementELD']['decisiondEngagementELD_rempDot'] = $oProjet['oEngagementELD']['decisiondEngagementELD_par'];
				if($oProjet['oEngagementELD']['decisiondEngagementELD_par'] == PAR_REMPLACEMENT_NUMERIQUE)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_type'] = "engagement-eld-r";
					if($oProjet['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId']!=null)
					{
						$oProjet['oParRemplacementNumerique']['parRemplacementNumerique_CandidatId'] = $oProjet['oCandidatRemplacement'];
					}
					$oProjet['oParRemplacementNumerique'] = $this->parcoursEtRemplacement('parRemplacementNumerique_CorpsId',$oProjet['oParRemplacementNumerique'],$toCorps);
					$oProjet['oParRemplacementNumerique'] = $this->parcoursEtRemplacement('parRemplacementNumerique_GradeId',$oProjet['oParRemplacementNumerique'],$toGrade);
					$oProjet['oParRemplacementNumerique'] = $this->parcoursEtRemplacement('parRemplacementNumerique_IndiceId',$oProjet['oParRemplacementNumerique'],$toIndice);
					$oProjet['oEngagementELD']['decisiondEngagementELD_par'] = $oProjet['oParRemplacementNumerique'];
				}
				else if($oProjet['oEngagementELD']['decisiondEngagementELD_par'] == PAR_DOTATION_POSTE_BUDGETAIRE)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_type'] = "engagement-eld-d";
					$oProjet['oEngagementELD']['decisiondEngagementELD_par'] = $oProjet['oParDotationPosteBudgetaire'];
				}
				$oData['oEngagementELD'] = $oProjet['oEngagementELD'];
				break;
			case ENGAGEMENT_ECD :
				if($oProjet['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_CandidatId'] = $oProjet['oCandidatRecherche'];
				}
				$oData['oEngagementECD'] = $oProjet['oEngagementECD'];
				break;
			case ARRETE_DE_NOMINATION :
				if($oData['oElaborationProjet']['elaborationProjet_CandidatId']!=null)
				{
					$oProjet['oElaborationProjet']['elaborationProjet_CandidatId'] = $oProjet['oCandidatRecherche'];
				}
				$oData['oArrete'] = $oProjet['oArrete'];
				break;
		}

		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_MinistereId',$oProjet['oElaborationProjet'],$toMinistere);
		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_DepartementId',$oProjet['oElaborationProjet'],$toDepartement);
		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_DirectionId',$oProjet['oElaborationProjet'],$toDirection);
		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_ServiceId',$oProjet['oElaborationProjet'],$toService);
		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_CorpsId',$oProjet['oElaborationProjet'],$toCorps);
		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_GradeId',$oProjet['oElaborationProjet'],$toGrade);
		$oProjet['oElaborationProjet'] = $this->parcoursEtRemplacement('elaborationProjet_IndiceId',$oProjet['oElaborationProjet'],$toIndice);

		$oBE["oBE"] = $this->parcoursEtRemplacement('elaborationduBE_MinistereId',$oBE["oBE"],$toMinistere);
		$oBE["oBE"] = $this->parcoursEtRemplacement('elaborationduBE_DepartementId',$oBE["oBE"],$toDepartement);
		$oBE["oBE"] = $this->parcoursEtRemplacement('elaborationduBE_DirectionId',$oBE["oBE"],$toDirection);
		$oBE["oBE"] = $this->parcoursEtRemplacement('elaborationduBE_ServiceId',$oBE["oBE"],$toService);
		
		$oData['oVerify'] = $oVerify["toPieceaVerifier"];
		$oData['oProject'] = $oProjet["oElaborationProjet"];
		$oData['oBE'] = $oBE["oBE"];
		$oData['toCorps'] = $toCorps;
		$oData['toGrade'] = $toGrade;
		$oData['toIndice'] = $toIndice;
		$oData['toMinistere'] = $toMinistere;
		$oData['toDepartement'] = $toDepartement;
		$oData['toDirection'] = $toDirection;
		$oData['toService'] = $toService;

		
		
		
		/*for($iParcours=0;$iParcours<sizeof($toProjet);$iParcours++)
		{
			if($toProjet[$iParcours]['elaborationProjet_CandidatId']!=null){
				$toCandidat = $this->candidatCarriere->get_candidat_by_multicritere(array("candidat_id"),array($toProjet[$iParcours]['elaborationProjet_CandidatId']));
				$toProjet[$iParcours]['elaborationProjet_CandidatId'] = $toCandidat[0];
			}
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_MinistereId',$toProjet[$iParcours],$toMinistere);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_DepartementId',$toProjet[$iParcours],$toDepartement);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_DirectionId',$toProjet[$iParcours],$toDirection);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_ServiceId',$toProjet[$iParcours],$toService);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_CorpsId',$toProjet[$iParcours],$toCorps);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_GradeId',$toProjet[$iParcours],$toGrade);
			$toProjet[$iParcours] = $this->parcoursEtRemplacement('elaborationProjet_IndiceId',$toProjet[$iParcours],$toIndice);
			
		}*/

		$requestContentType = 'application/json';
		$this->setHttpHeaders($requestContentType, 200);
		$response = $this->encodeJson($oData);
		echo $response;
		
		
	}

	/** 
	* Agent connecté
	*
	* @param objet $oUser objet user
	* @param objet $oCandidat objet candidat
	* @return boolean
	*/
	public function checkUtilisateur(&$oUser, &$oCandidat){
	
		if(!$this->checkConnect()){
			//redirect('cv/login');
		}
		if($list_role){
			$access = false;
			$role_bo = $this->get_user_data('role');
			foreach($list_role as $role){
				if($role_bo==$role)
					$access = true;
			}
			
			$iCompteActif = $this->getSessionCompte();

			if ($iCompteActif > 1 && $iCompteActif < 5) {
				$access = true;
			}
			if(!$access){
				//redirect('cv/access_denied');
			}
		}
    	$oUser = $this->get_current_user();
    	$oCandidat =$this->candidat->get_by_user_id($oUser['id']);
		$oData = array();
		$iUserId=$oUser['id'];
    	
    	$iRet = 1 ; 
		if (empty($oCandidat)){
			$iRet = 0 ; 
    	}
		
		if(isset($oCandidat)){
			$this->connectedUser($iUserId);
		}

		return $iRet ; 
	}

	/** 
	* parcours et remplacement 
	*
	* @param string $sElement element
	* @param objet $oProjet objet projet
	* @param tableau objet $toElements tableau objet Elements
	* @return view
	*/
	private function parcoursEtRemplacement($sElement,$oProjet,$toElements)
	{
		$iParcoursTableau=0;
		for($iParcoursTableau=0;$iParcoursTableau<sizeof($toElements);$iParcoursTableau++)
		{
			if($oProjet[$sElement]===$toElements[$iParcoursTableau]['id'])
			{
				$oProjet[$sElement] = $toElements[$iParcoursTableau];
				break;
			}
			if($oProjet[$sElement]===$toElements[$iParcoursTableau]['ministere_id'])
			{
				$oProjet[$sElement] = $toElements[$iParcoursTableau];
				break;
			}
		}
		return $oProjet;
	}

	/** 
	* encodage HTML
	*
	* @param string $responseData 
	* @return html
	*/
	private function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	/** 
	* encodage Json
	*
	* @return Json
	*/
	private function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	/** 
	* encodage XML
	*
	* @return xml
	*/
	private function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}

	private $httpVersion = "HTTP/1.1";

	/** 
	* setHttp Header
	*
	* @param string $contentType Content type
	* @param int $statusCode statut code du navigateur
	* @return view
	*/
	private function setHttpHeaders($contentType, $statusCode){
		
		$statusMessage = $this -> getHttpStatusMessage($statusCode);
		
		header($this->httpVersion. " ". $statusCode ." ". $statusMessage);		
		header("Content-Type:". $contentType);
	}
	
	/** 
	* correspondance retour message bug navigateur
	*
	* @param string $statusCode statut code
	* @return view
	*/
	private function getHttpStatusMessage($statusCode){
		$httpStatus = array(
			100 => 'Continue',  
			101 => 'Switching Protocols',  
			200 => 'OK',
			201 => 'Created',  
			202 => 'Accepted',  
			203 => 'Non-Authoritative Information',  
			204 => 'No Content',  
			205 => 'Reset Content',  
			206 => 'Partial Content',  
			300 => 'Multiple Choices',  
			301 => 'Moved Permanently',  
			302 => 'Found',  
			303 => 'See Other',  
			304 => 'Not Modified',  
			305 => 'Use Proxy',  
			306 => '(Unused)',  
			307 => 'Temporary Redirect',  
			400 => 'Bad Request',  
			401 => 'Unauthorized',  
			402 => 'Payment Required',  
			403 => 'Forbidden',  
			404 => 'Not Found',  
			405 => 'Method Not Allowed',  
			406 => 'Not Acceptable',  
			407 => 'Proxy Authentication Required',  
			408 => 'Request Timeout',  
			409 => 'Conflict',  
			410 => 'Gone',  
			411 => 'Length Required',  
			412 => 'Precondition Failed',  
			413 => 'Request Entity Too Large',  
			414 => 'Request-URI Too Long',  
			415 => 'Unsupported Media Type',  
			416 => 'Requested Range Not Satisfiable',  
			417 => 'Expectation Failed',  
			500 => 'Internal Server Error',  
			501 => 'Not Implemented',  
			502 => 'Bad Gateway',  
			503 => 'Service Unavailable',  
			504 => 'Gateway Timeout',  
			505 => 'HTTP Version Not Supported');
		return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $status[500];
	}
	

}