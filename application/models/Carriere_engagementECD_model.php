<?php
class Carriere_engagementECD_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_engagementECD($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementECD";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by decisiondEngagementECD_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	public function get_engagementECDParElaborationProjet($_iId){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementECD";
		
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_ElaborationProjetId' => $_iId));
		return $oQuery->row_array();
	}

	public function insert($engagementECDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementECD";
		if($this->db->insert($zBase.".".$zTable, $engagementECDData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($engagementECDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementECD";
		$this->db->update($zBase.".".$zTable, $engagementECDData, $zTable."_id = '".$engagementECDData['decisiondEngagementECD_id']."'");
	}

	public function delete($engagementECDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementECD";
		$this->db->delete($zBase.".".$zTable, $engagementECDData, $zTable."_id = '".$engagementECDData['decisiondEngagementECD_id']."'");
	}

	public function setImprimerPdf ($_oData, $_this) {
		$oCandidat		= $_oData["oCandidat"];
		$oElaborationProjet = $_oData['oProject']['oElaborationProjet'];
		$oECD		= $_oData['oProject']['oEngagementECD'];
		$oCandidatRecherche = $_oData['oProject']['oCandidatRecherche'];
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
			$iDecalage = 7;
			$iDecalageHorizontal = 0;
			$sCheminVersModel = base_url().'assets/carriere/ecd/';

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
			$oPdf->Image($sCheminVersModel.'modele-ecd-1.jpg',8,0,210,297);
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
			$oPdf->SetXY($iDecalageHorizontal+6,25); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(60,$iInterline*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+6,25); 
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
			$oPdf->SetXY($iDecalageHorizontal+2,38);  
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(70,($iInterline-2)*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal-5,38); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(85,$iInterline-2,utf8_decode($oDepartement['libele']),0,'C');

			$iIdDirection = $oElaborationProjet['elaborationProjet_DirectionId'];
			$oDirection = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toDirection);$iParcours++)
			{
				if($toDirection[$iParcours]['id']==$iIdDirection)
				{
					$oDirection = $toDirection[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+2,47); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(70,$iInterline*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal-5,47); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(85,$iInterline,utf8_decode($oDirection['libele']),0,'C');

			$iIdService = $oElaborationProjet['elaborationProjet_ServiceId'];
			$oService = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toService);$iParcours++)
			{
				if($toService[$iParcours]['id']==$iIdService)
				{
					$oService = $toService[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+2,60); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(70,$iInterline*2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+2,60); 
			$oPdf->SetFont('Arial','B');
			$oPdf->MultiCell(70,$iInterline,utf8_decode($oService['libele']),0,'C');

			$oPdf->SetXY($iDecalageHorizontal+120,33); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(47,$iInterline+2,$oElaborationProjet['elaborationProjet_sigle'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+160,72.5); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline,utf8_decode($oElaborationProjet['elaborationProjet_denomination']),0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+3,77.5); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(88,$iInterline,utf8_decode($oCandidatRecherche['candidat_nom']." ".$oCandidatRecherche['candidat_prenom']),0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+161,77.5); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(0,$iInterline,utf8_decode($oElaborationProjet['elaborationProjet_fonction'])."(3),",0,0,'L',1);

			$tsDateNaissance = explode("/",$oCandidatRecherche['candidat_datedeNaissance']);
			$iJourNaissance = $tsDateNaissance[0];
			$iMoisNaissance = $toMonth[(int)$tsDateNaissance[1]];
			$iAnNaissance = $tsDateNaissance[2];
			$oPdf->SetXY($iDecalageHorizontal+100,89+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(38,$iInterline-1,utf8_decode($iJourNaissance." ".$iMoisNaissance." ".$iAnNaissance) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+141,89+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(38,$iInterline-1,$oCandidatRecherche['candidat_lieudeNaissance'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,93.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(47,$iInterline-1,$oCandidatRecherche['candidat_cin'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,98+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(40,$iInterline-1,$oECD['decisiondEngagementECD_categoriedEmploi'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,102+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(38,$iInterline-1,$oElaborationProjet['elaborationProjet_lieuExerciceEmploi'] ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,106+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(29,$iInterline-1,$oECD['decisiondEngagementECD_dureeEngagement'] ,0,0,'L',1);

			$tsDatePeriode = explode("/",$oECD['decisiondEngagementECD_debutPeriode']);
			$iJourPeriode = $tsDatePeriode[0];
			$iMoisPeriode = $toMonth[(int)$tsDatePeriode[1]];
			$iAnPeriode = $tsDatePeriode[2];
			$tsDateFinPeriode = explode("/",$oECD['decisiondEngagementECD_finPeriode']);
			$iJourFinPeriode = $tsDateFinPeriode[0];
			$iMoisFinPeriode = $toMonth[(int)$tsDateFinPeriode[1]];
			$iAnFinPeriode = $tsDateFinPeriode[2];
			$oPdf->SetXY($iDecalageHorizontal+100,111+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(36,$iInterline-1,utf8_decode($iJourPeriode." ".$iMoisPeriode." ".$iAnPeriode) ,0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+144.5,111+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(38,$iInterline-1,utf8_decode($iJourFinPeriode." ".$iMoisFinPeriode." ".$iAnFinPeriode) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,115+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(23,$iInterline,utf8_decode($oECD['decisiondEngagementECD_categorie']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,119+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(42,$iInterline,"XXXXCT/XXXXFOP" ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,123+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(23,$iInterline,utf8_decode($oECD['decisiondEngagementECD_mission']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,128+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(23,$iInterline,utf8_decode($oECD['decisiondEngagementECD_objectifs'])  ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,132+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(23,$iInterline,utf8_decode($oECD['decisiondEngagementECD_indicateursObjectifs']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,137+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(26,$iInterline,utf8_decode($oECD['decisiondEngagementECD_activite']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,141+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(62,$iInterline,utf8_decode($oECD['decisiondEngagementECD_financement']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,145+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(57,$iInterline,utf8_decode($oElaborationProjet['elaborationProjet_imputationBudgetaire']) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+100,150+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(32,$iInterline-1,utf8_decode($oCandidatRecherche['candidat_situationdeFamille']) ,0,0,'L',1);
			
			$oPdf->SetXY($iDecalageHorizontal+25,235.5+$iDecalage); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(63,$iInterline,utf8_decode($oCandidatRecherche['candidat_nom']." ".$oCandidatRecherche['candidat_prenom']),0,0,'L',1);
			//=========================================================================================
			$oPdf->Ln();

			if ($oPdf->GetY()> 290){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}
}
?>