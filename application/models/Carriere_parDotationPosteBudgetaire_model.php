<?php
class Carriere_parDotationPosteBudgetaire_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_parDotationPosteBudgetaire($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "parDotationPosteBudgetaire";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by parDotationPosteBudgetaire_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	public function get_parDotationPosteBudgetaireParContratdeTravail($_iId){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "parDotationPosteBudgetaire";
		
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_ContratdeTravailId' => $_iId));
		return $oQuery->row_array();
    }
    
    public function get_parDotationPosteBudgetaireParELD($_iId){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "parDotationPosteBudgetaire";
		
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_DecisiondEngagementELDId' => $_iId));
		return $oQuery->row_array();
	}

	public function insert($parDotationPosteBudgetaireData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "parDotationPosteBudgetaire";
		if($this->db->insert($zBase.".".$zTable, $parDotationPosteBudgetaireData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($parDotationPosteBudgetaireData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "parDotationPosteBudgetaire";
		$this->db->update($zBase.".".$zTable, $parDotationPosteBudgetaireData, $zTable."_id = '".$parDotationPosteBudgetaireData['parDotationPosteBudgetaire_id']."'");
	}

	public function delete($parDotationPosteBudgetaireData)
	{
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "parDotationPosteBudgetaire";
		$this->db->delete($zBase.".".$zTable, $parDotationPosteBudgetaireData, $zTable."_id = '".$parDotationPosteBudgetaireData['parDotationPosteBudgetaire_id']."'");
	}

	public function setImprimerContratPdf ($_oData, $_this) {
		$oCandidat		= $_oData["oCandidat"];
		$oElaborationProjet = $_oData['oProject']['oElaborationProjet'];
		$oContrat		= $_oData['oProject']['oContratdeTravail'];
		$oCandidatRecherche = $_oData['oProject']['oCandidatRecherche'];
		$oPar = $_oData['oProject']['oParDotationPosteBudgetaire'];
		$toCorps = $_oData['oProject']['toCorps'];
		$toGrade = $_oData['oProject']['toGrade'];
		$toIndice = $_oData['oProject']['toIndice'];
		$oDecision		= $_oData["oDecision"];
		$oSignataire	= $_oData["oSignataire"];
		$zLogo		= "";

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P","A4");
			$oPdf->setMargins(1,1,1);
			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 45;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',9);
			//$oPdf->SetY($Y_Fields_Name_position);
			
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$iDebutParagraphe = 0;
			$iDebutLigne = 5 ;
			$iIncrement = 15 ; 
			$iLeft = 95 ; 
			$iRight = 95 ; 

			$iRight1 = 100 ; 
			$iRight2 = 60 ; 
			$iInterline = 5;
			$iTable = 98;
			$iParcours = 0;
			$iDecalageHorizontal = 0;
			$sCheminVersModel = base_url().'assets/carriere/contratParDotationBudgetaire/';

			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'Février',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Août',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'Décembre'
			);

			$tsGroupe = array(
				1 =>'I er',
				2 =>'II eme',
				3 =>'III eme',
				4 =>'IV eme',
				5 =>'V eme'
			);

			//=======================================================================
			$oPdf->Image($sCheminVersModel.'modele-contrat-de-travail-1.jpg',0,0,210,297);

			$oPdf->SetXY(51,43.5); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(16,$iInterline-1.5,$oContrat['contratdeTravail_numeroLettre'],0,0,'L',1);

			$tsDateLettre = explode("/",$oContrat['contratdeTravail_dateLettre']);
			$iJourLettre = $tsDateLettre[0];
			$iMoisLettre = $toMonth[(int)$tsDateLettre[1]];
			$iAnLettre = $tsDateLettre[2];
			$oPdf->SetXY(72,43.5); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline-1.5,utf8_decode($iJourLettre." ".$iMoisLettre." ".$iAnLettre),0,0,'L',1);

			$oPdf->SetXY(20,52); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(0,$iInterline,$oContrat['contratdeTravail_chapitre']." (2)" ,0,0,'L',1);

			$oPdf->SetXY(134,89); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(40,$iInterline,$oElaborationProjet['elaborationProjet_sigle'] ,0,0,'L',1);

			/*$oPdf->SetXY(40,91); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline,"Mr Soussigne" ,0,0,'L',1);

			$oPdf->SetXY(10,98); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,"VIIV" ,0,0,'L',1);

			$oPdf->SetXY(120,98); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline-2,"LOL ROLFL" ,0,0,'L',1);*/

			$oPdf->SetXY(6,112); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(164.5,$iInterline-2,$oElaborationProjet['elaborationProjet_denomination']." ".$oCandidatRecherche['candidat_nom']." ".$oCandidatRecherche['candidat_prenom'].", IM.".$oCandidatRecherche['candidat_matricule']." (4)" ,0,0,'L',1);

			$oPdf->SetXY(5,118); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(73,$iInterline-1,$oCandidatRecherche['candidat_address']." (5)" ,0,0,'L',1);

			$sIdCorps = $oElaborationProjet['elaborationProjet_CorpsId'];
			$oCorps = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toCorps);$iParcours++)
			{
				if($toCorps[$iParcours]['id']==$sIdCorps)
				{
					$oCorps = $toCorps[$iParcours];
				}
			}
			$oPdf->SetXY(68,174); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(95,$iInterline,$oCorps['libele']." (6)" ,0,0,'L',1);

			$oPdf->SetXY(7,179); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline,$oElaborationProjet['elaborationProjet_fonction']." (7)" ,0,0,'L',1);

			$oPdf->SetXY(91,239); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(9.5,$iInterline,$oElaborationProjet['elaborationProjet_dureeService'] ,0,0,'C',1);

			$tsDatePriseService = explode("/",$oElaborationProjet['elaborationProjet_datePriseService']);
			$iJourPriseService = $tsDatePriseService[0];
			$iMoisPriseService = $toMonth[(int)$tsDatePriseService[1]];
			$iAnPriseService = $tsDatePriseService[2];
			$oPdf->SetXY(82,244); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline+1,utf8_decode($iJourPriseService." ".$iMoisPriseService." ".$iAnPriseService) ,0,0,'L',1);

			/*$oPdf->SetXY(3,272); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("(4) \t Autorité qualifiée pour procéder à l'engagement") ,0,0,'L',1);

			$oPdf->SetXY(3,276); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("(5) \t 24 mois au maximum") ,0,0,'L',1);

			$oPdf->SetXY(3,280); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("(6) \t La date de prise de service ne peut être antérieure à la date de signature du contrat, sauf application de l'article 15 du décret n°64-213 ") ,0,0,'L',1);
			$oPdf->SetXY(3,284); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("du 27 mai 1964 \n") ,0,0,'L',1);
			$oPdf->SetXY(3,288); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("Indiquer la date de prise de service lorsque c'est possible") ,0,0,'L',1);*/
			
			
			//=======================================================================
			$oPdf->AddPage("P","A4");
			$oPdf->Image($sCheminVersModel.'modele-contrat-de-travail-2.jpg',0,0,210,297);
			

			/*$oPdf->SetXY(80,53); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline-2,"Money" ,0,0,'L',1);*/

			$sIdCorps = $oElaborationProjet['elaborationProjet_CorpsId'];
			$oCorps = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toCorps);$iParcours++)
			{
				if($toCorps[$iParcours]['id']==$sIdCorps)
				{
					$oCorps = $toCorps[$iParcours];
				}
			}
			$sIdGrade = $oElaborationProjet['elaborationProjet_GradeId'];
			$oGrade = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toGrade);$iParcours++)
			{
				if($toGrade[$iParcours]['id']==$sIdGrade)
				{
					$oGrade = $toGrade[$iParcours];
				}
			}
			$sIdIndice = $oElaborationProjet['elaborationProjet_IndiceId'];
			$oIndice = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toIndice);$iParcours++)
			{
				if($toIndice[$iParcours]['id']==$sIdIndice)
				{
					$oIndice = $toIndice[$iParcours];
				}
			}
			$oPdf->SetXY(20,21); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(84,$iInterline,$oCorps['libele']." ".$oGrade['libele']."(8) indice,".$oIndice['libele']."(9)" ,0,0,'L',1);

			/*$oPdf->SetXY(116,23); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline-2, ,0,0,'L',1);

			
			$oPdf->SetXY(3,272); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("(2) \t Indication des corps, grade ou classe et échelon du fonctionnaire ou l'échelle et échelon de l'auxiliaire appelé à tenir l'emploi ou qualification") ,0,0,'L',1);
			$oPdf->SetXY(3,276); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode(" du titulaire de l'emploi.") ,0,0,'L',1);*/
			//=======================================================================
			$oPdf->AddPage("P","A4");
			$oPdf->Image($sCheminVersModel.'modele-contrat-de-travail-3.jpg',0,0,210,297);
			

			$oPdf->SetXY(20,102); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline,$tsGroupe[$oContrat['contratdeTravail_groupe']] ,0,0,'L',1);

			/*$oPdf->SetXY(3,272); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("(2) \t Indiquer le groupe : 1er, 2°, 3°, 4° ou 5°") ,0,0,'L',1);*/
			//=======================================================================
			$oPdf->AddPage("P","A4");
			$oPdf->Image($sCheminVersModel.'modele-contrat-de-travail-4.jpg',0,0,210,297);
			
			/*for($iParcours = 0;$iParcours < 5; $iParcours++)
			{
				$iTable = $iTable + $iInterline;

				$oPdf->SetXY(4,$iTable); 
				$oPdf->SetFont('Arial','');
				$oPdf->Cell(20,$iInterline-2,"Fonction" ,0,0,'L',1);

				$oPdf->SetXY(66,$iTable); 
				$oPdf->SetFont('Arial','');
				$oPdf->Cell(20,$iInterline-2,"Budget" ,0,0,'L',1);

				$oPdf->SetXY(111,$iTable); 
				$oPdf->SetFont('Arial','');
				$oPdf->Cell(20,$iInterline-2,"Sante" ,0,0,'L',1);

				$oPdf->SetXY(151,$iTable); 
				$oPdf->SetFont('Arial','');
				$oPdf->Cell(20,$iInterline-2,"Financier" ,0,0,'L',1);
			}*/

			$oPdf->SetXY(107,222); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline-2,$oElaborationProjet['elaborationProjet_lieuExerciceEmploi'] ,0,0,'L',1);

			$tsDateProjet = explode("/",$oElaborationProjet['elaborationProjet_date']);
			$iJourProjet = $tsDateProjet[0];
			$iMoisProjet = $toMonth[(int)$tsDateProjet[1]];
			$iAnProjet = $tsDateProjet[2];
			$oPdf->SetXY(153,222); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline-2,utf8_decode($iJourProjet ." ".$iMoisProjet." ".$iAnProjet) ,0,0,'L',1);

			/*$oPdf->SetXY(3,272); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(10,$iInterline-2,utf8_decode("(2) \t La signature doit être précédée de la mention manuscrite : \"Lu et accepté\" ") ,0,0,'L',1);*/
			//=========================================================================================
			$oPdf->Ln();

			if ($oPdf->GetY()> 290){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}

	public function setImprimerELDPdf ($_oData, $_this) {
		$oCandidat		= $_oData["oCandidat"];
		$oElaborationProjet = $_oData['oProject']['oElaborationProjet'];
		$oELD		= $_oData['oProject']['oEngagementELD'];
		$oCandidatRecherche = $_oData['oProject']['oCandidatRecherche'];
		$oPar = $_oData['oProject']['oParDotationPosteBudgetaire'];
		$toCorps = $_oData['oProject']['toCorps'];
		$toGrade = $_oData['oProject']['toGrade'];
		$toIndice = $_oData['oProject']['toIndice'];
		$toMinistere = $_oData['oProject']['toMinistere'];
		$toDepartement = $_oData['oProject']['toDepartement'];
		$toDirection = $_oData['oProject']['toDirection'];
		$toService = $_oData['oProject']['toService'];
		$oDecision		= $_oData["oDecision"];
		$oSignataire	= $_oData["oSignataire"];
		$zLogo		= "";

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P","A4");
			$oPdf->setMargins(1,1,1);
			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 45;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',9);
			//$oPdf->SetY($Y_Fields_Name_position);
			
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$iDebutParagraphe = 0;
			$iDebutLigne = 5 ;
			$iIncrement = 15 ; 
			$iLeft = 95 ; 
			$iRight = 95 ; 

			$iRight1 = 100 ; 
			$iRight2 = 60 ; 
			$iInterline = 5;
			$iTable = 98;
			$iParcours = 0;
			$iDecalageHorizontal = 0;
			$sCheminVersModel = base_url().'assets/carriere/eldParDotationBudgetaire/';

			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'Février',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Août',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'Décembre'
			);

			$tsGroupe = array(
				1 =>'I er',
				2 =>'II eme',
				3 =>'III eme',
				4 =>'IV eme',
				5 =>'V eme'
			);

			//=======================================================================
			$oPdf->Image($sCheminVersModel.'modele-eld-2.jpg',8,0,210,297);
			$iDecalageHorizontal = 8;

			$iIdMinistere = $oElaborationProjet['elaborationProjet_MinistereId'];
			$oMinistere = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toMinistere);$iParcours++)
			{
				if($toMinistere[$iParcours]['ministere_id']==$iIdMinistere)
				{
					$oMinistere = $toMinistere[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+7,30); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(60,$iInterline*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+7,30); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(60,$iInterline,utf8_decode($oMinistere['ministere_libelle']),0,'C');

			$iIdDepartement = $oElaborationProjet['elaborationProjet_DepartementId'];
			$oDepartement = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toDepartement);$iParcours++)
			{
				if($toDepartement[$iParcours]['id']==$iIdDepartement)
				{
					$oDepartement = $toDepartement[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+2,43);  
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(70,($iInterline-2)*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+2,43); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(70,$iInterline-2,utf8_decode($oDepartement['libele']),0,'C');

			$iIdDirection = $oElaborationProjet['elaborationProjet_DirectionId'];
			$oDirection = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toDirection);$iParcours++)
			{
				if($toDirection[$iParcours]['id']==$iIdDirection)
				{
					$oDirection = $toDirection[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+6,52); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(60,$iInterline*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+6,52); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(60,$iInterline,utf8_decode($oDirection['libele']),0,'C');

			$iIdService = $oElaborationProjet['elaborationProjet_ServiceId'];
			$oService = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toService);$iParcours++)
			{
				if($toService[$iParcours]['id']==$iIdService)
				{
					$oService = $toService[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+7,64); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(60,$iInterline*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+7,64); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(60,$iInterline,utf8_decode($oService['libele']),0,'C');

			$oPdf->SetXY($iDecalageHorizontal+120,39); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline,$oElaborationProjet['elaborationProjet_sigle'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+159,78); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(90,$iInterline,$oElaborationProjet['elaborationProjet_denomination'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+3,83); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(90,$iInterline,$oCandidatRecherche['candidat_nom']." ".$oCandidatRecherche['candidat_prenom'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+3,88); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(28,$iInterline,$oElaborationProjet['elaborationProjet_fonction'],0,0,'L',1);

			$tsDateNaissance = explode("/",$oCandidatRecherche['candidat_datedeNaissance']);
			$iJourNaissance = $tsDateNaissance[0];
			$iMoisNaissance = $toMonth[(int)$tsDateNaissance[1]];
			$iAnNaissance = $tsDateNaissance[2];
			$oPdf->SetXY($iDecalageHorizontal+109,106); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(34,$iInterline,utf8_decode($iJourNaissance." ".$iMoisNaissance." ".$iAnNaissance) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+146,106); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(31,$iInterline,$oCandidatRecherche['candidat_lieudeNaissance'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+109,119); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(40,$iInterline,utf8_decode($oELD['decisiondEngagementELD_attestationdeQualification']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+109,123); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(37,$iInterline,$oElaborationProjet['elaborationProjet_lieuExerciceEmploi'] ,0,0,'L',1);

			

			$tsDatePriseService = explode("/",$oElaborationProjet['elaborationProjet_datePriseService']);
			$iJourPriseService = $tsDatePriseService[0];
			$iMoisPriseService = $toMonth[(int)$tsDatePriseService[1]];
			$iAnPriseService = $tsDatePriseService[2];
			$oPdf->SetXY($iDecalageHorizontal+109,131); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(83,$iInterline*2,"" ,0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+109,131); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(10,$iInterline,utf8_decode($iJourPriseService." ".$iMoisPriseService." ".$iAnPriseService) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+109,140); 
			$oPdf->SetFont('Arial','B');
			if($oElaborationProjet['elaborationProjet_dureeService']!="")
			{
				if($oElaborationProjet['elaborationProjet_dureeService']>0)
				{
					$oPdf->Cell(25,$iInterline,$oElaborationProjet['elaborationProjet_dureeService'] ,0,0,'L',1);
				}
				else
				{
					$oPdf->Cell(25,$iInterline,utf8_decode("Indéterminée") ,0,0,'L',1);
				}
			}
			else
			{
				$oPdf->Cell(25,$iInterline,utf8_decode("Indéterminée") ,0,0,'L',1);
			}
			

			$oPdf->SetXY($iDecalageHorizontal+109,149); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(40,$iInterline,$oELD['decisiondEngagementELD_remunerationdeBase'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+125,170.7); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(31,$iInterline,$oElaborationProjet['elaborationProjet_imputationBudgetaire'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+109,179); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(25,$iInterline,utf8_decode($oCandidatRecherche['candidat_situationdeFamille']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+109,188); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(25,$iInterline,utf8_decode($oPar['parDotationPosteBudgetaire_numeroLettre']) ,0,0,'L',1);

			$tsDateLettre = explode("/",$oPar['parDotationPosteBudgetaire_dateLettre']);
			$iJourLettre = $tsDateLettre[0];
			$iMoisLettre = $toMonth[(int)$tsDateLettre[1]];
			$iAnLettre = $tsDateLettre[2];
			$oPdf->SetXY($iDecalageHorizontal+148,188); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(35,$iInterline,utf8_decode($iJourLettre." ".$iMoisLettre." ".$iAnLettre) ,0,0,'L',1);
			
			$oPdf->SetXY($iDecalageHorizontal+24,252.5); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(64.5,$iInterline,$oCandidatRecherche['candidat_nom']." ".$oCandidatRecherche['candidat_prenom'],0,0,'L',1);
			//=========================================================================================
			$oPdf->Ln();

			if ($oPdf->GetY()> 290){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}
}
?>