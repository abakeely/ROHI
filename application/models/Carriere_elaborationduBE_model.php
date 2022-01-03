<?php
class Carriere_elaborationduBE_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
		deFinE ("MENU_VERIFICATION_DES_PIECES",14);
		deFinE ("MENU_ELABORATION_DU_PROJET",15);
		deFinE ("MENU_ELAORATION_DES_BE",16);
		deFinE ("PAR_REMPLACEMENT_NUMERIQUE","remplacement-numerique");
		deFinE ("PAR_DOTATION_POSTE_BUDGETAIRE","dotation-poste-budgetaire");
	}
	
	public function get_elaborationduBE($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationduBE";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by elaborationduBE_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	
    public function findElaborationduBEbyElaborationProjet($_iId)
	{
        global $db;
		$zBase = $db['carriere']['database'] ;
        $zTable = "elaborationduBE";
        /*$oQuery = $this->db->select("b.*")
                    ->from($zBase.".".$zTable." as b")
                    ->where(array("b.elaborationduBE_ElaborationProjetId like" => "% ".$_iId." %"))
					->get();*/
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_ElaborationProjetId' => $_iId));
        return $oQuery->row_array();
    }

	public function insert($elaborationduBEData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationduBE";
		if($this->db->insert($zBase.".".$zTable, $elaborationduBEData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($elaborationduBEData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationduBE";
		$this->db->update($zBase.".".$zTable, $elaborationduBEData, $zTable."_id = '".$elaborationduBEData['elaborationduBE_id']."'");
	}

	public function delete($elaborationduBEData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "elaborationduBE";
		$this->db->delete($zBase.".".$zTable, $elaborationduBEData, $zTable."_id = '".$elaborationduBEData['elaborationduBE_id']."'");
	}

	public function setImprimerPdf ($_oData, $_this) {
		$iTypeCarriereId = $_oData['iTypeCarriereId'];
		$oCandidat		= $_oData["oCandidat"];
		$oBE = $_oData['oBE']['oBE'];
		$oCandidatRecherche = $_oData['oBE']['oCandidatRecherche'];
		$oProjet = $_oData['oBE']['toProjet'][0];
		$toCorps = $_oData['oBE']['toCorps'];
		$toGrade = $_oData['oBE']['toGrade'];
		$toIndice = $_oData['oBE']['toIndice'];
		$toMinistere = $_oData['oBE']['toMinistere'];
		$toDepartement = $_oData['oBE']['toDepartement'];
		$toDirection = $_oData['oBE']['toDirection'];
		$tsCandidats = $_oData['oBE']['tsCandidatsProjet'];
		$toService = $_oData['oBE']['toService'];
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
			$iDecalage = 20;
			$iDecalageHorizontal=0;
			$sCheminVersModel = base_url().'assets/carriere/be/';

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
			
			$sEntete = "";
			$iIdMinistere = $oBE['elaborationduBE_MinistereId'];
			$oMinistere = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toMinistere);$iParcours++)
			{
				if($toMinistere[$iParcours]['ministere_id']==$iIdMinistere)
				{
					$oMinistere = $toMinistere[$iParcours];
				}
			}
			$sEntete = $sEntete.$oMinistere['ministere_libelle']."\n\n";

			$iIdDepartement = $oBE['elaborationduBE_DepartementId'];
			$oDepartement = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toDepartement);$iParcours++)
			{
				if($toDepartement[$iParcours]['id']==$iIdDepartement)
				{
					$oDepartement = $toDepartement[$iParcours];
				}
			}
			$sEntete = $sEntete.$oDepartement['libele']."\n\n";

			$iIdDirection = $oBE['elaborationduBE_DirectionId'];
			$oDirection = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toDirection);$iParcours++)
			{
				if($toDirection[$iParcours]['id']==$iIdDirection)
				{
					$oDirection = $toDirection[$iParcours];
				}
			}
			$sEntete = $sEntete.$oDirection['libele']."\n\n";

			$iIdService = $oBE['elaborationduBE_ServiceId'];
			$oService = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toService);$iParcours++)
			{
				if($toService[$iParcours]['id']==$iIdService)
				{
					$oService = $toService[$iParcours];
				}
			}
			$sEntete = $sEntete.$oService['libele']."\n\n";

			switch ($iTypeCarriereId) 
			{
				
				case CONTRAT_DE_TRAVAIL :
					$oPdf->Image($sCheminVersModel.'modele-be-1.jpg',-5,0,210,297);
					$iDecalageHorizontal=-5;

					$oPdf->SetXY($iDecalageHorizontal+13,19+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(80,$iInterline*6,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+13,19+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->MultiCell(80,$iInterline-1,utf8_decode($sEntete),0,'C');

					$oPdf->SetXY($iDecalageHorizontal+43,68+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(40,$iInterline,utf8_decode($oBE['elaborationduBE_sigle']),0,0,'L',1);
		
					$oPdf->SetXY($iDecalageHorizontal+110,29+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+110,30+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(90,$iInterline,utf8_decode($oBE['elaborationduBE_expediteur']." (1)"),0,'C');
		
					$oPdf->SetXY($iDecalageHorizontal+110,62+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+110,62+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(90,$iInterline,utf8_decode($oBE['elaborationduBE_destinataire']." (2)"),0,'C');

					for($iParcours = 0;$iParcours < sizeof($tsCandidats);$iParcours++)
					{
						$oPdf->SetXY($iDecalageHorizontal+10,127+$iDecalage+($iParcours*5)); 
						$oPdf->SetFont('Arial','');
						$oPdf->Cell(114,$iInterline,$tsCandidats[$iParcours],0,0,'L',1);
					}

					$oPdf->SetXY($iDecalageHorizontal+129,127+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(20,$iInterline,$oBE['elaborationduBE_nombreaEnvoyer'],0,0,'C',1);
					break;

				case ENGAGEMENT_ELD :
					$oPdf->Image($sCheminVersModel.'modele-be-2.jpg',-2,0,210,297);
					$iDecalageHorizontal = -2;

					$oPdf->SetXY($iDecalageHorizontal+13,19+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(80,$iInterline*6,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+13,19+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->MultiCell(80,$iInterline-1,utf8_decode($sEntete),0,'C');

					$oPdf->SetXY($iDecalageHorizontal+40,66+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(42,$iInterline,utf8_decode($oBE['elaborationduBE_sigle']),0,0,'L',1);
		
					$oPdf->SetXY($iDecalageHorizontal+106,28+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+106,28+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(90,$iInterline,utf8_decode($oBE['elaborationduBE_expediteur']." (1)"),0,'C');
		
					$oPdf->SetXY($iDecalageHorizontal+106,60+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+106,60+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(90,$iInterline,utf8_decode($oBE['elaborationduBE_destinataire']." (2)"),0,'C');

					for($iParcours = 0;$iParcours < sizeof($tsCandidats);$iParcours++)
					{
						$oPdf->SetXY($iDecalageHorizontal+10,123+$iDecalage+($iParcours*5)); 
						$oPdf->SetFont('Arial','');
						$oPdf->Cell(110,$iInterline,$tsCandidats[$iParcours],0,0,'L',1);
					}

					$oPdf->SetXY($iDecalageHorizontal+124,123+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(20,$iInterline,$oBE['elaborationduBE_nombreaEnvoyer'],0,0,'C',1);
					break;

				case ENGAGEMENT_ECD :
					$oPdf->Image($sCheminVersModel.'modele-be-3.jpg',-2,0,210,297);
					$iDecalageHorizontal = -2;

					$oPdf->SetXY($iDecalageHorizontal+13,18+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(80,$iInterline*6,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+13,18+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->MultiCell(80,$iInterline-1,utf8_decode($sEntete),0,'C');

					$oPdf->SetXY($iDecalageHorizontal+40,65+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(42,$iInterline,utf8_decode($oBE['elaborationduBE_sigle']),0,0,'L',1);
		
					$oPdf->SetXY($iDecalageHorizontal+108,27+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+108,27+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(90,$iInterline,utf8_decode($oBE['elaborationduBE_expediteur']." (1)"),0,'C');
		
					/*$oPdf->SetXY($iDecalageHorizontal+108,60+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+108,60+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(90,$iInterline,utf8_decode($oBE['elaborationduBE_destinataire']." (2)"),0,'C');*/

					for($iParcours = 0;$iParcours < sizeof($tsCandidats);$iParcours++)
					{
						$oPdf->SetXY($iDecalageHorizontal+10,126+$iDecalage+($iParcours*5)); 
						$oPdf->SetFont('Arial','');
						$oPdf->Cell(110,$iInterline,$tsCandidats[$iParcours],0,0,'L',1);
					}

					$oPdf->SetXY($iDecalageHorizontal+124,126+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(20,$iInterline,$oBE['elaborationduBE_nombreaEnvoyer'],0,0,'C',1);
					break;

				case ARRETE_DE_NOMINATION :

					$oPdf->Image($sCheminVersModel.'modele-be-4.jpg',3,0,210,297);
					$iDecalageHorizontal=3;

					$oPdf->SetXY($iDecalageHorizontal+6,20+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(90,$iInterline*6,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+6,20+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->MultiCell(90,$iInterline-1.3,utf8_decode($sEntete),0,'C');

					$oPdf->SetXY($iDecalageHorizontal+38,69+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(40,$iInterline,utf8_decode($oBE['elaborationduBE_sigle']),0,0,'L',1);
		
					$oPdf->SetXY($iDecalageHorizontal+106,30+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(90,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+106,30+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(78,$iInterline,utf8_decode($oBE['elaborationduBE_expediteur']." (1)"),0,'C');
		
					$oPdf->SetXY($iDecalageHorizontal+106,63+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(78,$iInterline*2,"",0,0,'L',1);
					$oPdf->SetXY($iDecalageHorizontal+106,63+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->MultiCell(78,$iInterline,utf8_decode($oBE['elaborationduBE_destinataire']." (2)"),0,'C');

					for($iParcours = 0;$iParcours < sizeof($tsCandidats);$iParcours++)
					{
						$oPdf->SetXY($iDecalageHorizontal+9.5,128+$iDecalage+($iParcours*5)); 
						$oPdf->SetFont('Arial','');
						$oPdf->Cell(106,$iInterline,$tsCandidats[$iParcours],0,0,'L',1);
					}

					$oPdf->SetXY($iDecalageHorizontal+118,128+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->Cell(20,$iInterline,$oBE['elaborationduBE_nombreaEnvoyer'],0,0,'C',1);

					$oPdf->SetXY($iDecalageHorizontal+145,118+$iDecalage); 
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(42,$iInterline-0.5,"TEST",0,0,'C',1);

					$sIdCorps = $oProjet['elaborationProjet_CorpsId'];
					$oCorps = FALSE;
					for($iParcours = 0;$iParcours < sizeof($toCorps);$iParcours++)
					{
						if($toCorps[$iParcours]['id']==$sIdCorps)
						{
							$oCorps = $toCorps[$iParcours];
						}
					}
					$oPdf->SetXY($iDecalageHorizontal+9.5,120+$iDecalage); 
					$oPdf->SetFont('Arial','');
					$oPdf->SetFontSize(7);
					$oPdf->Cell(48,$iInterline-0.5,$oCorps['libele'],0,0,'L',1);

					break;

			}

			//=========================================================================================
			$oPdf->Ln();

			if ($oPdf->GetY()> 290){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}
}
?>