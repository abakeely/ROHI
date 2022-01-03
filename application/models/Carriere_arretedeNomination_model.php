<?php
class Carriere_arretedeNomination_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_arretedeNomination($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "arretedeNomination";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by arretedeNomination_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	public function get_arretedeNominationParElaborationProjet($_iId){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "arretedeNomination";
		
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_ElaborationProjetId' => $_iId));
		return $oQuery->row_array();
	}

	public function insert($engagementECDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "arretedeNomination";
		if($this->db->insert($zBase.".".$zTable, $engagementECDData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($engagementECDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "arretedeNomination";
		$this->db->update($zBase.".".$zTable, $engagementECDData, $zTable."_id = '".$engagementECDData['arretedeNomination_id']."'");
	}

	public function delete($engagementECDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "arretedeNomination";
		$this->db->delete($zBase.".".$zTable, $engagementECDData, $zTable."_id = '".$engagementECDData['arretedeNomination_id']."'");
	}

	public function setImprimerPdf ($_oData, $_this) {
		$oCandidat		= $_oData["oCandidat"];
		$oElaborationProjet = $_oData['oProject']['oElaborationProjet'];
		$oArrete		= $_oData['oProject']['oArrete'];
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
			$iDecalage = 10;
			$iDecalageHorizontal = 0;
			$sCheminVersModel = base_url().'assets/carriere/arreteDeNomination/';

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
			$oPdf->Image($sCheminVersModel.'modele-arrete-de-nomination-1.jpg',8,0,210,297);
			$iDecalageHorizontal = 8;

			$iIdCorps = $oElaborationProjet['elaborationProjet_CorpsId'];
			$oCorps = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toCorps);$iParcours++)
			{
				if($toCorps[$iParcours]['id']==$iIdCorps)
				{
					$oCorps = $toCorps[$iParcours];
				}
			}

			$oPdf->SetXY($iDecalageHorizontal+139,23.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(100,$iInterline,"",0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+139,25.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(24,$iInterline-4,$oCorps['libele']."(1)",0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+131,120.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(24,$iInterline,$oArrete['arretedeNomination_numeroDecret'],0,0,'L',1);

			$tsDateDecret = explode("/",$oArrete['arretedeNomination_dateDecret']);
			$iJourDecret = $tsDateDecret[0];
			$iMoisDecret = $toMonth[(int)$tsDateDecret[1]];
			$iAnDecret = $tsDateDecret[2];
			$oPdf->SetXY($iDecalageHorizontal+160,121.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(25,$iInterline-2,utf8_decode($iJourDecret." ".$iMoisDecret." ".$iAnDecret) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+27.7,120.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(21,$iInterline,$oArrete['arretedeNomination_numeroDecretAdditif'],0,0,'L',1);

			$tsDateDecretAdditif = explode("/",$oArrete['arretedeNomination_dateDecretAdditif']);
			$iJourDecretAdditif = $tsDateDecretAdditif[0];
			$iMoisDecretAdditif = $toMonth[(int)$tsDateDecretAdditif[1]];
			$iAnDecretAdditif = $tsDateDecretAdditif[2];
			$oPdf->SetXY($iDecalageHorizontal+54,121.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(30,$iInterline-2,utf8_decode($iJourDecretAdditif." ".$iMoisDecretAdditif." ".$iAnDecretAdditif) ,0,0,'L',1);

			
			$oPdf->SetXY($iDecalageHorizontal+84,125.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline-2,$oCorps['libele']."(4);",0,0,'L',1);

			//================================================================================================
			$oPdf->SetXY($iDecalageHorizontal+25,136.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(26,$iInterline,$oArrete['arretedeNomination_numeroArrete'],0,0,'L',1);

			$tsDateArrete = explode("/",$oArrete['arretedeNomination_dateArrete']);
			$iJourArrete = $tsDateArrete[0];
			$iMoisArrete = $toMonth[(int)$tsDateArrete[1]];
			$iAnArrete = $tsDateArrete[2];
			$oPdf->SetXY($iDecalageHorizontal+55,137.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(28,$iInterline-2,utf8_decode($iJourArrete." ".$iMoisArrete." ".$iAnArrete) ,0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+102,140.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(70,$iInterline,utf8_decode($oArrete['arretedeNomination_ecole']),0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+24,144.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(31,$iInterline,$oArrete['arretedeNomination_nombrePostesDisponibles'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+69,144.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(0,$iInterline,$oCorps['libele']."(8);",0,0,'L',1);


			$oPdf->SetXY($iDecalageHorizontal+155,148.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(14,$iInterline,$oArrete['arretedeNomination_nombrePostesRequis'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+0,152.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(59,$iInterline,$oCorps['libele'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+64,152.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(69,$iInterline,utf8_decode($oArrete['arretedeNomination_ecole'])."(9)",0,0,'L',1);

			$tsDateAdmis = explode("/",$oArrete['arretedeNomination_dateListeAdmis']);
			$iJourAdmis = $tsDateAdmis[0];
			$iMoisAdmis = $toMonth[(int)$tsDateAdmis[1]];
			$iAnAdmis = $tsDateAdmis[2];
			$oPdf->SetXY($iDecalageHorizontal+145,152.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(29.5,$iInterline,utf8_decode($iJourAdmis." ".$iMoisAdmis." ".$iAnAdmis),0,0,'L',1);

			//================================================================================================
			$oPdf->SetXY($iDecalageHorizontal+5,160.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(68.5,$iInterline,utf8_decode($oArrete['arretedeNomination_ecole']),0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+115,160.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(39.5,$iInterline,$oArrete['arretedeNomination_promotion'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,164.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(54,$iInterline,$oArrete['arretedeNomination_section'],0,0,'L',1);

			$tsDateDefinitive = explode("/",$oArrete['arretedeNomination_dateListeDefinitive']);
			$iJourDefinitive = $tsDateDefinitive[0];
			$iMoisDefinitive = $toMonth[(int)$tsDateDefinitive[1]];
			$iAnDefinitive = $tsDateDefinitive[2];
			$oPdf->SetXY($iDecalageHorizontal+76,165.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(34,$iInterline-2,"",0,0,'L',1);
			$oPdf->SetXY($iDecalageHorizontal+76,164.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline,utf8_decode($iJourDefinitive." ".$iMoisDefinitive." ".$iAnDefinitive),0,0,'L',1);

			//================================================================================================
			$oPdf->SetXY($iDecalageHorizontal+5,185+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(80.5,$iInterline,utf8_decode($oArrete['arretedeNomination_ecole']),0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+130,185+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(40,$iInterline,$oArrete['arretedeNomination_diplome'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,189+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(52.5,$iInterline,$oArrete['arretedeNomination_section'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+133,189+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(20,$iInterline,$oArrete['arretedeNomination_bonificationdAnciennete'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+12,193+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(21,$iInterline,$oArrete['arretedeNomination_numeroArreteBonification'],0,0,'L',1);

			$tsDateBonification = explode("/",$oArrete['arretedeNomination_dateArreteBonification']);
			$iJourBonification = $tsDateBonification[0];
			$iMoisBonification = $toMonth[(int)$tsDateBonification[1]];
			$iAnBonification = $tsDateBonification[2];
			$oPdf->SetXY($iDecalageHorizontal+77,193+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(24.5,$iInterline,utf8_decode($iJourBonification." ".$iMoisBonification." ".$iAnBonification),0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,197+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(66,$iInterline,$oCorps['libele'],0,0,'L',1);

			//================================================================================================
			$oPdf->SetXY($iDecalageHorizontal+53,213+$iDecalage); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(74,$iInterline,$oCandidatRecherche['candidat_nom']." ".$oCandidatRecherche['candidat_prenom'],0,0,'L',1);

			$iIdIndice = $oElaborationProjet['elaborationProjet_IndiceId'];
			$oIndice = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toIndice);$iParcours++)
			{
				if($toIndice[$iParcours]['id']==$iIdIndice)
				{
					$oIndice = $toIndice[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+98,217+$iDecalage); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(19.5,$iInterline,$oIndice['libele'],0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,225+$iDecalage); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(171.5,$iInterline,"",0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,229+$iDecalage); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(171.5,$iInterline,"",0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,232.5+$iDecalage); 
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(171.5,$iInterline,"",0,0,'L',1);

			$iIdMinistere = $oElaborationProjet['elaborationProjet_MinistereId'];
			$oMinistere = FALSE;
			for($iParcours = 0;$iParcours < sizeof($toMinistere);$iParcours++)
			{
				if($toMinistere[$iParcours]['ministere_id']==$iIdMinistere)
				{
					$oMinistere = $toMinistere[$iParcours];
				}
			}
			$oPdf->SetXY($iDecalageHorizontal+88,238.5+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(171.5,$iInterline-2,utf8_decode($oMinistere['ministere_libelle'])."(23)",0,0,'L',1);

			$oPdf->SetXY($iDecalageHorizontal+2,246+$iDecalage); 
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(35.5,$iInterline-1,$oElaborationProjet['elaborationProjet_imputationBudgetaire'],0,0,'L',1);

			//=========================================================================================
			$oPdf->Ln();

			if ($oPdf->GetY()> 290){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}
}
?>