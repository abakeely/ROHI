<?php
/**
* @package ROHI
* @subpackage Gcap2
* @author Division Recherche et Développement Informatique
*/

ob_start();

class Gcap2 extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->sessionStartCompte();
		$this->load->model('gcap_gcap2_model','Gcap2');
	}

	/** 
	* Affichage en tableau d'un objet
	*
	* @param objet/tableau $_oObjet objet ou tableau 
	*
	* @return view
	*/
	public static function pre_print($_oObjet) {

		echo "<pre>" ; 
		print_r($_oObjet);
		echo "</pre>";
	}
	
	/** 
	* Importation gcap
	*
	* @param string $_zHashModule Hashage du module 
	*
	* @return view
	*/
	public function importer($_zHashModule = FALSE)
	{
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		$user = $this->get_current_user();
		$oData = array();
		
		if($iRet == 1)
		{
			$iModuleId = $this->module->get_by_module_zHashModule($_zHashModule);
			$oData['oUser'] = $oUser;
			$oData['oCandidat'] = $oCandidat;
			$oData['menu'] = 126;
			$iModuleId = 13;	
			$this->load_my_view_Common('gcap2_importer.tpl',$oData,-1);
		}
		else 
		{
			$this->mon_cv();
		}
	}

	/** 
	* get Gcap
	*
	* @param string $_zHashModule Hashage du module 
	*
	* @return view
	*/
	public function get_gcap($_zHashModule = FALSE)
	{
		global $oSmarty ; 
		$oUser = array();
		$oCandidat = array();
		$zBasePath =  base_url();

		$this->checkConnexion();
		$iRet = $this->check($oUser, $oCandidat);
		$iCompteActif = $this->getSessionCompte();
		
		if($iRet == 1){	
			
			$iNombreTotal = 0;
			$oRequest = $_REQUEST;
			$toListeGcap = $this->Gcap2->get_Gcap_pagination($iNombreTotal);
			$oDataAssign = array();
			foreach ($toListeGcap as $oListe){
				
				$oDataTemp=array(); 
				$oDataTemp[] = $oListe->matricule;
				$oDataTemp[] = $oListe->cin;
				$oDataTemp[] = $oListe->sigle_departement;
				$oDataTemp[] = $oListe->sigle_direction;
				$oDataTemp[] = $oListe->nom." ".$oListe->prenom;
				$oDataTemp[] = $oListe->typeGcap_libelle;
				$oDataTemp[] = $oListe->type_libelle;
				$oDataTemp[] = $this->date_en_to_fr($oListe->gcap_dateDebut,'-','/');
				$oDataTemp[] = $this->date_en_to_fr($oListe->gcap_dateFin,'-','/');
				$oDataTemp[] = $oListe->gcap_motif;
				$oDataTemp[] = $oListe->gcap_lieuJouissance;
				
				$zAction = '<span></span>' ; 

				$oDataTemp[] = $zAction;

				$zAction = '' ; 
				//$zAction = '<a onclick="emprunter('.$oListe->Id.')" href="#"><button>Emprunter</button></a>' ; 
				$oDataTemp[] = $zAction;

				$oDataAssign[] = $oDataTemp;
			}
			
			$taJson = array(
							"draw"            => intval( $oRequest['draw'] ),
							"recordsTotal"    => intval( $iNombreTotal ),
							"recordsFiltered" => intval( $iNombreTotal ),
							"data"            => $oDataAssign
						);
			echo json_encode($taJson);
		
		} else {
			redirect("cv/mon_cv");
		}
	}

	/** 
	* Importation gcap
	*
	* @return view
	*/
	public function importation()
	{
		
		$oUser = array();
		$oCandidat = array();
		$iRet = $this->check($oUser, $oCandidat);
		$iFlag = $this->postGetValue ("iFlag",1) ;
		if($iRet == 1)
		{	
			if (isset($_FILES['file_excel']) && trim($_FILES['file_excel']['name']) != "") 
			{
				
				$_iLigneDepart = $this->postGetValue ("PremiereLigne",6) ;
				
				$oFile = $_FILES['file_excel'];
				$zFileName = $oFile['name'];
				$zTmpName = $oFile["tmp_name"];
				$sNomFichier = $_FILES['file_excel']['name'];
				@move_uploaded_file($zTmpName, APPLICATION_PATH . '/Classes/GCAP/'.utf8_decode(html_entity_decode($sNomFichier)));
				
				require(APPLICATION_PATH ."/Classes/PHPExcel.php");

				error_reporting(E_ALL);
				ini_set('display_errors', TRUE);
				ini_set('display_startup_errors', TRUE);
				date_default_timezone_set('Europe/London');

				define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />'); 
				$sException = "";
				$oPhpExcel = new PHPExcel();
				
				$zFileInput = APPLICATION_PATH . '/Classes/GCAP/'.utf8_decode(html_entity_decode($sNomFichier));
				$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
				$oReader = PHPExcel_IOFactory::createReader($iTypeFile);
				$oReader->setReadDataOnly(true);
				$oPhpExcel = $oReader->load($zFileInput);

				$oSheet = $oPhpExcel->getSheet(0); 
				$iLongeurExcel = $oSheet->getHighestRow(); 
				$iLongeurColonne = $oSheet->getHighestColumn();
		
				$iIncrement = 1;
				for ($iBoucle = $_iLigneDepart; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
					
					$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
													NULL,
													TRUE,
													FALSE);
					if ($iBoucle > 1)
					{
						$toBoucleData1 = $toBoucleData[0];
						$oInsert = array();

						$iMatricule = $toBoucleData1[1];
						if(strlen(trim($iMatricule))>6)
						{
							$oAgent = $this->Gcap2->getCandidatCinMatricule(trim($iMatricule),'','','');
						} 
						else
						{
							$oAgent = $this->Gcap2->getCandidatCinMatricule('',trim($iMatricule),'','');
						}
						$iIdUtilisateur=0;
						if(!empty($oAgent))
						{
							$iIdUtilisateur = $oAgent[0]->iUserId;
						}
						else
						{
							$sException = $sException.$iMatricule." ".$toBoucleData1[2]."\n";
						}
						$oGcap2 = $this->Gcap2->get_Gcap_UserId($iIdUtilisateur,"".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[7],'YYYY-MM-DD'),"".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[8],'YYYY-MM-DD'));
						if(empty($oGcap2))
						{
							$oInsert['gcap_userSendId'] = $iIdUtilisateur;
							$oTypeGcap = $this->Gcap2->get_TypeGcap_by_Libelle(str_replace("'", "''", html_entity_decode($toBoucleData1[3])));
							if(empty($oTypeGcap))
							{
								$oInsert['gcap_typeGcapId'] = 3;
							}
							else
							{
								$oInsert['gcap_typeGcapId'] = $oTypeGcap[0]['typeGcap_id'];
							}
							$iTypeConge = 0;
							switch($oInsert['gcap_typeGcapId'])
							{
								case 1:
									$iTypeConge = 1;
									break;
								case 2:
									$iTypeConge = 11;
									break;
								case 3:
									$iTypeConge = 18;
									break;
								case 4:
									$iTypeConge = 21;
									break;
								case 5:
									$iTypeConge = 22;
									break;
							}
								
							if($iTypeConge!==0)
							{
								$oInsert['gcap_typeId'] = $iTypeConge;
							}
							$oInsert['gcap_dateDebut'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[7],'YYYY-MM-DD');
							$oInsert['gcap_dateFin'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[8],'YYYY-MM-DD');
							$oInsert['gcap_motif'] = "".$toBoucleData1[5];
							$oInsert['gcap_lieuJouissance'] = "".$toBoucleData1[6];
							//$oInsert['gcap_statutId'] = $toBoucleData1[7];
							$oInsert['gcap_jourPris'] = $toBoucleData1[9];
							$oInsert['gcap_dateValidation'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[11],'YYYY-MM-DD');
							$oInsert['gcap_valide'] = 1;
							$oInsert['gcap_autoriteSignataire'] = "".$toBoucleData1[12];
							$oInsert['gcap_numeroDecisionConcernee'] = "".$toBoucleData1[13];
							$oInsert['gcap_dateDecisionConcernee'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[14],'YYYY-MM-DD');
							$oInsert['gcap_annee'] = "".$toBoucleData1[15];
							$oInsert['gcap_joursRestantDecision'] = "".$toBoucleData1[16];
							//$oInsert['gcap_vue'] = $toBoucleData1[4];
							//$oInsert['gcap_autorisaionCaracteristique'] = $toBoucleData1[5];
							$oInsert['gcap_MatinSoir'] = 0;
							$oInsert['gcap_demiJournee'] = (strpos($toBoucleData1[9],'1/2 journée')!==false);
							//$oInsert['conv_pers'] = $toBoucleData1[8];
							$oInsert['gcap_pieceJointe'] = "".$toBoucleData1[10];

							if($iFlag == 1){
								echo $iIncrement . "--\n<br>";
								echo "<pre>";
								print_r ($oInsert);
								echo "</pre>";
							} else {
								$oTestEnregistrement = $this->Gcap2->testEnregistrement($oInsert);
								if(empty($oTestEnregistrement))
								{
									$this->Gcap2->insert($oInsert);
								}
								
							}
						}
					}
					$iIncrement++;
				}

				if($iFlag == 1){
					die();
				}

				if($oPhpExcel)
				{
					$oPhpExcel->disconnectWorksheets();
					unset($oPhpExcel);
				}

				redirect("gcap2/importer");
			}
			/*$fichier = fopen('manquant.txt','w');
			fwrite($fichier,$sException);
			fclose($fichier);*/
			//echo "1";
		}
		else 
		{
			$this->mon_cv();
		}
	}
    
	/** 
	* Importation gcap sur fichier excel
	*
	* @param string $_zHashModule Hashage du module 
	*
	* @return view
	*/
    public function importGcapExcel(){
        $iParcours = 0;
        $tsNomFichiers = array(/*"DAAF - OCTOBRE 2018","DCSD BAG - Aout 2018","DCSD BAG - Sept 2018","DGCF - Juillet 2018",
        "DGCF Nosy Be","DGCF Vakinakaratra - Aout 2018","DGD - Aout 2018","DGGFPE DS SVSP - Octobre 2018",
        "DGI SAF PERS DPR OCT18","DIN - Sept 2018","DIN","DIRECTION DE LA SOLDE DGGFPE - Juillet 2018",
        "DIRECTION DES GRANDES ENTREPRISES - Septembre et octobre  2018","DRCF AMM - Juillet 2018","DRCF HM - Aout 2018",
        "DRCF HM - Septembre 2018","DRCF Menabe - Aout 2018","DRI 67 Ha","SAAF DGGFPE - Aout 2018",
        "SAAF DGGFPE - Octobre 2018","SAAF DGGFPE - Septembre 2018","SAF PERS DPR DGI - Aout 2018",
        "SAF PERS DPR DGI - Sept 2018","SAF PERS DPR DGI - Septembre 2018","SCPAE - Octobre 2018",
        "SER DTLE - Aout 2018","SER DTLE - octobre 2018","SER DTLE - Septembre 2018","SERVICE CONTRÔLE DGE - Sept et oct 2018",
		"SPERS  DGGFPE - Octobre 2018","SPERS DGGFPE - Aout 2018","SPERS DGGFPE - Septembre 2018"*/);
		$tiPremiereLigne = array(/*7,7,7,7,7,7,6,6,6,7,7,7,7,7,7,7,7,7,6,7,6,7,7,7,7,6,7,7,7,7,6,6*/);
		$iNombreFichiers = sizeof($tsNomFichiers);

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		$sException = "";
		for($iParcours = 0; $iParcours < $iNombreFichiers; $iParcours++)
		{
			
			$oPhpExcel = new PHPExcel();
			try
			{
				$zFileInput = APPLICATION_PATH . '/Classes/GCAP/'.utf8_decode(html_entity_decode($tsNomFichiers[$iParcours])).'.xlsx';
				$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
				$oReader = PHPExcel_IOFactory::createReader($iTypeFile);
				$oReader->setReadDataOnly(true);
				$oPhpExcel = $oReader->load($zFileInput);
			}
			catch(Exception $exception)
			{
				$zFileInput = APPLICATION_PATH . '/Classes/GCAP/'.utf8_decode(html_entity_decode($tsNomFichiers[$iParcours])).'.xls';
				$iTypeFile = PHPExcel_IOFactory::identify($zFileInput);
				$oReader = PHPExcel_IOFactory::createReader($iTypeFile);
				$oReader->setReadDataOnly(true);
				$oPhpExcel = $oReader->load($zFileInput);
			}
		
			$oSheet = $oPhpExcel->getSheet(0); 
			$iLongeurExcel = $oSheet->getHighestRow(); 
			$iLongeurColonne = $oSheet->getHighestColumn();
	
			for ($iBoucle = $tiPremiereLigne[$iParcours]; $iBoucle <= $iLongeurExcel; $iBoucle++){ 
				
				$toBoucleData = $oSheet->rangeToArray('A' . $iBoucle . ':' . $iLongeurColonne . $iBoucle,
												NULL,
												TRUE,
												FALSE);
				if ($iBoucle > 1)
				{
					$toBoucleData1 = $toBoucleData[0];
					$oInsert = array();

					$iMatricule = $toBoucleData1[1];
					if(strlen(trim($iMatricule))>6)
					{
						$oAgent = $this->Gcap2->getCandidatCinMatricule(trim($iMatricule),'','','');
					} 
					else
					{
						$oAgent = $this->Gcap2->getCandidatCinMatricule('',trim($iMatricule),'','');
					}
					$iIdUtilisateur=0;
					if(!empty($oAgent))
					{
						$iIdUtilisateur = $oAgent[0]->iUserId;
					}
					else
					{
						$sException = $sException.$iMatricule." ".$toBoucleData1[2]."\n";
					}
					$oGcap2 = $this->Gcap2->get_Gcap_UserId($iIdUtilisateur,"".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[7],'YYYY-MM-DD'),"".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[8],'YYYY-MM-DD'));
					if(empty($oGcap2))
					{
						$oInsert['gcap_userSendId'] = $iIdUtilisateur;
						$oTypeGcap = $this->Gcap2->get_TypeGcap_by_Libelle(str_replace("'", "''", html_entity_decode($toBoucleData1[3])));
						if(empty($oTypeGcap))
						{
							$oInsert['gcap_typeGcapId'] = 3;
						}
						else
						{
							$oInsert['gcap_typeGcapId'] = $oTypeGcap[0]['typeGcap_id'];
						}
						$iTypeConge = 0;
						switch($oInsert['gcap_typeGcapId'])
						{
							case 1:
								$iTypeConge = 1;
								break;
							case 2:
								$iTypeConge = 11;
								break;
							case 3:
								$iTypeConge = 18;
								break;
							case 4:
								$iTypeConge = 21;
								break;
							case 5:
								$iTypeConge = 22;
								break;
						}
							
						if($iTypeConge!==0)
						{
							$oInsert['gcap_typeId'] = $iTypeConge;
						}
						$oInsert['gcap_dateDebut'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[7],'YYYY-MM-DD');
						$oInsert['gcap_dateFin'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[8],'YYYY-MM-DD');
						$oInsert['gcap_motif'] = "".$toBoucleData1[5];
						$oInsert['gcap_lieuJouissance'] = "".$toBoucleData1[6];
						//$oInsert['gcap_statutId'] = $toBoucleData1[7];
						//$oInsert['gcap_userValidId'] = $toBoucleData1[8];
						$oInsert['gcap_dateValidation'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[11],'YYYY-MM-DD');
						$oInsert['gcap_valide'] = 1;
						$oInsert['gcap_autoriteSignataire'] = "".$toBoucleData1[12];
						$oInsert['gcap_numeroDecisionConcernee'] = "".$toBoucleData1[13];
						$oInsert['gcap_dateDecisionConcernee'] = "".PHPExcel_Style_NumberFormat::toFormattedString($toBoucleData1[14],'YYYY-MM-DD');
						$oInsert['gcap_annee'] = "".$toBoucleData1[15];
						$oInsert['gcap_joursRestantDecision'] = "".$toBoucleData1[16];
						//$oInsert['gcap_vue'] = $toBoucleData1[4];
						//$oInsert['gcap_autorisaionCaracteristique'] = $toBoucleData1[5];
						$oInsert['gcap_MatinSoir'] = 0;
						$oInsert['gcap_demiJournee'] = (strpos($toBoucleData1[9],'1/2 journée')!==false);
						//$oInsert['conv_pers'] = $toBoucleData1[8];
						$oInsert['gcap_pieceJointe'] = "".$toBoucleData1[10];
	
						//echo "<pre>";
						//print_r ($oInsert);
						//echo "</pre>";
						//die();
						$this->Gcap2->insert($oInsert);
					}
				}
			}

			if($oPhpExcel)
			{
				$oPhpExcel->disconnectWorksheets();
				unset($oPhpExcel);
			}
		}
		/*$fichier = fopen('manquant.txt','w');
		fwrite($fichier,$sException);
		fclose($fichier);*/
		echo "1";
	}
}