<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
ob_start();

class DeclarationPatrimoine extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('DeclarationPatrimoine_model','DeclarationPatrimoineService');
		$this->load->model('Referentiel_model','ReferentielService');
		$this->load->model('GestionStructure_model','GestionStructureService');
		$this->load->library('Phpword');
		$this->load->library('parser');
		$this->sessionStartCompte();
	}
	
	
	
	public function declarerPatrimoine($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			//groupe acte
			$toCorps					=	$this->DeclarationPatrimoineService->getFonction();
			$toDepartement				=	$this->ReferentielService->findAllDepartement();
			
			$oData['toCorps']			=	$toCorps ; 
			$oData['toDepartement']		=	$toDepartement ; 
			$this->load_my_view_Common('declarationPatrimoine/declarerPatrimoine.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }


	public function saveDeclarationPatrimoine($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$oData['iUserId']						= $oUser['id'] ;
			$oData['iSessionCompte']				= $iSessionCompte ; 
			$operation								= $this->postGetValue ("oper","") ; 
			$toDeclarations							= array() ;
			$oAssujetties							= $this->GestionStructureService->getCandidatByMatricule( $this->postGetValue ("matricule","") );
			$toDeclarations['user_id']				= $oAssujetties["user_id"] ;
			$toDeclarations['matricule']			=  $this->postGetValue ("matricule","") ;
			if( $this->postGetValue ("nom_prenom","")!="" ){
				$toDeclarations['nom']					= $this->postGetValue ("nom_prenom","") ; 
			}else{
				$toDeclarations['nom']					= $oAssujetties["nom"] ; 
			}

			if( $this->postGetValue ("cin","")!="" ){
				$toDeclarations['cin']					= $this->postGetValue ("cin","") ; 
			}else{
				$toDeclarations['cin']					= $oAssujetties["cin"] ; 
			}

			$toDeclarations['corps']				= $this->postGetValue ("corps",$oAssujetties["corps"]) ; 
			$toDeclarations['fonction_actuel']		= $this->postGetValue ("fonction_actuel",$oAssujetties["fonction_actuel"]) ; 
			$toDeclarations['acte_de_nomination']	= $this->postGetValue ("acte_de_nomination","") ; 
			$toDeclarations['date_de_nomination']	= $this->postGetValue ("date_de_nomination","") ; 
			$toDeclarations['email']				= $this->postGetValue ("email","") ; 
			$toDeclarations['phone']				= $this->postGetValue ("phone","") ; 
			$toDeclarations['adresse']				= $this->postGetValue ("adresse","") ; 
			$toDeclarations['ordsec']				= $this->postGetValue ("ordsec","") ; 
			$toDeclarations['numero_quitus_bianco']	= $this->postGetValue ("numero_quitus_bianco","") ; 
			$toDeclarations['date_quitus_bianco']	= $this->postGetValue ("date_quitus_bianco","") ; 
			if( $operation == "add" ){
				$this->DeclarationPatrimoineService->createDeclarationPatrimoine($toDeclarations);
			}else{
				$this->DeclarationPatrimoineService->majDeclarationPatrimoine($toDeclarations);
			}
			
		} else {
			redirect("cv/mon_cv");
		}
    }


	public function statistique($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			//groupe acte
			$toDepartement				= $this->ReferentielService->findAllDepartement();
			$oData['toDepartement']		= $toDepartement ; 
			$this->load_my_view_Common('declarationPatrimoine/statistique.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function etat($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			//groupe acte
			//$toMouvements				= $this->ReferentielService->findAllMouvement();
			$tzConditions				=	array();
			$toGroupeActes				=	$this->GenericCruds->findBy("sgrh","t_projet_groupe",$tzConditions);
			$oData['toGroupeActes']		=	$toGroupeActes ; 
			$this->load_my_view_Common('declarationPatrimoine/etat.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function telechargerFormulaire($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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

			//groupe acte
			$oConjointe					=   $this->DeclarationPatrimoineService->findConjointe($oUser["id"]);
			//print_r($oConjointe);die;
			$tzConditions				=	array();
			$oData['oConjointe']		=	$oConjointe ; 
			$this->load_my_view_Common('declarationPatrimoine/telechargerFormulaire.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function ajaxTelechargerFormulaire($_zHashModule = FALSE, $_zHashUrl = FALSE){

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
			//  create new file and remove Compatibility mode from word title

			$phpWord = new \PhpOffice\PhpWord\PhpWord();

			$phpWord->getCompatibility()->setOoxmlVersion(14);
			$phpWord->getCompatibility()->setOoxmlVersion(15);

			$targetFile = "./global/uploads/";
			$filename = 'declaration_de_patrimoine.docx';

			// add style settings for the title and paragraph
			$content		=   $this->parser->parse('declarationPatrimoine/test.tpl',array(), TRUE);
		
			//information de l'agent
			$content		=	str_replace("##NOM##",$oCandidat[0]->nom,$content) ;
			$content		=	str_replace("##PRENOM##",$oCandidat[0]->prenom,$content) ;
			$content		=	str_replace("##ADRESSE##",$oCandidat[0]->address,$content) ;
			$content		=	str_replace("##DATE_ET_LIEU_NAISSANCE##",$oCandidat[0]->date_naiss,$content) ;
			$content		=	str_replace("##CIN##",$oCandidat[0]->cin,$content) ;
			
			//information de la conjointe
			$conjointe		=	$this->DeclarationPatrimoineService->findConjointe($oUser["id"]);
			$content		=	str_replace("##NOM_CONJOINTE##",$conjointe['nom'],$content) ;
			$content		=	str_replace("##PRENOM_CONJOINTE##",$conjointe['prenom'],$content) ;
			$content		=	str_replace("##FONCTION_CONJOINTE##",$conjointe['fonction'],$content) ;
			$content		=	str_replace("##CIN_CONJOINTE##",$conjointe['cin'],$content) ;
			$content		=	str_replace("##ADRESSE_CONJOINTE##",$conjointe['adresse'],$content) ;
			$content		=	str_replace("##DATE_LIEU_NAISSANCE_CONJOINTE##",$conjointe['lieu_naissance'] .'   ' .$conjointe['lieu_naissance'],$content) ;
			$content		=	str_replace("##DATE_LIEU_DELIVRANCE_CONJOINTE##",$conjointe['date_delivrance'].'  '.$conjointe['lieu_delivrance'],$content) ;
			
			//informations enfants
			$enfants		=	$this->DeclarationPatrimoineService->findEnfant($oUser["id"]);
			
			$zHtml			=	"";
			$zHtml			=	$zHtml  ."<table   border='10'>";
			$zHtml			=	$zHtml  . "<tbody  border='10'>";

			$zHtml			=	$zHtml  . "<tr  border='10'>";
			$zHtml			=	$zHtml  . "<td ><strong>Nom et pr&eacute;noms de l'enfant Anarana sy fanampiny</strong></td>";
			$zHtml			=	$zHtml  . "<td><strong>Date de naissance Vaninandro Nahaterahana</strong></td>";
			$zHtml			=	$zHtml  . "<td><strong>Lieu de naissance Toerana nahaterahana</strong></td>";
			$zHtml			=	$zHtml  . "<td><strong>Sexe Lahy  Vavy</strong></td>";
			$zHtml			=	$zHtml  . "<td><strong>Activit&eacute; Asa atao</strong></td>";
			$zHtml			=	$zHtml  . "</tr>";

			foreach($enfants as $enfant){
				//print_r($enfant);die;
				$zHtml			=	$zHtml  . "<tr>";
				$zHtml			=	$zHtml  . "<td>".$enfant["nom_prenoms"]."</td>";
				$zHtml			=	$zHtml  . "<td>".$enfant["date_de_naissance"]."</td>";
				$zHtml			=	$zHtml  . "<td>".$enfant["lieu_de_naissance"]."</td>";
				$zHtml			=	$zHtml  . "<td>".$enfant["lieu_de_naissance"]."</td>";
				$zHtml			=	$zHtml  . "<td>".$enfant["activite"]."</td>";
				$zHtml			=	$zHtml  . "</tr>";
			}
			$zHtml			=	$zHtml  . "</tbody>";
			$zHtml			=	$zHtml  . "</table>";

			$content		=	str_replace("##ENFANTS##",$zHtml,$content) ;

			$section = $phpWord->addSection();
			\PhpOffice\PhpWord\Shared\Html::addHtml($section, $content);
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
			ob_clean();
			$objWriter->save($filename);
			header('Content-Description: File Transfer');
			header('Content-Type: application/vnd.ms-word');
			header('Content-Disposition: attachment; filename='.$filename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Pragma: public');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Cache-Control: private",false); // required for certain browsers
			
			header('Content-Length: ' . filesize($filename));
			flush();
			readfile($filename);
			unlink($filename); // deletes the temporary file

			$this->notificationMail();
			exit;
		}
    }

	public function ajaxGetPersonnalitesAssujetties($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			array_push($parameters," 1 = 1");
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}
			$rowCount					=	$this->DeclarationPatrimoineService->ajaxCountPersonnalitesAssujetties($parameters);
			$toListe					=	$this->DeclarationPatrimoineService->getPersonnalitesAssujetties($parameters,$page,$rows,0);
			$toDataAssign				=	array();
			foreach ($toListe as $oListe){
				///print_r($toListe);die;
				$oDataTemp							=	 array(); 
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['matricule']				=	 $oListe['matricule'];
				$oDataTemp['date_prise_service']	=	 $oListe['date_prise_service'];
				$oDataTemp['fonction_actuel']		=	 $oListe['fonction_actuel'];
				$oDataTemp['nom_prenom']			=	 $oListe['nom'] .'  '.$oListe['prenom'];
				$oDataTemp['acte_de_nomination']	=	 $oListe['acte_de_nomination'];
				$oDataTemp['date_de_nomination']	=	 $oListe['date_de_nomination'];
				$oDataTemp['email']					=	 $oListe['email'];
				$oDataTemp['phone']					=	 $oListe['phone'];
				$oDataTemp['corps']					=	 $oListe['corps'];
				$oDataTemp['cin']					=	 $oListe['cin'];
				$oDataTemp['search_field']			=	 $oListe['search_field'];
				$oDataTemp['adresse']				=	 $oListe['adresse'];
				$oDataTemp['ordsec']				=	 $oListe['ordsec'];
				$oDataTemp['numero_quitus_bianco']	=	 $oListe['numero_quitus_bianco'];
				$oDataTemp['date_quitus_bianco']	=	 $oListe['date_quitus_bianco'];
				$toDataAssign[]						=	 $oDataTemp;
			}
			$iNombreTotal							=	 $rowCount["nb_records"];
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( ceil($iNombreTotal/5) ),
							"records"			=> intval( ceil($iNombreTotal/5) ),
							"rows"              => $toDataAssign,
							"nb_records"		=> $iNombreTotal
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function ajaxGetEnfantsAssujetties($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			array_push($parameters," user_id = '".$oUser["id"]."' ");
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}
			$rowCount					=	$this->DeclarationPatrimoineService->ajaxCountEnfantsAssujetties($parameters);
			$toListe					=	$this->DeclarationPatrimoineService->getEnfantsAssujetties($parameters,$page,$rows,0);
			$toDataAssign				=	array();
		
			foreach ($toListe as $oListe){
				//print_r($toListe);die;
				$oDataTemp							=	 array(); 
				$oDataTemp['id']					=	 $oListe['id'];
				$oDataTemp['nom_prenoms']			=	 $oListe['nom_prenoms'];
				$oDataTemp['date_de_naissance']		=	 $oListe['date_de_naissance'];
				$oDataTemp['lieu_de_naissance']		=	 $oListe['lieu_de_naissance'] ;
				$oDataTemp['activite']				=	 $oListe['activite'];
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['sexe']					=	 $oListe['sexe'];
				$toDataAssign[]						=	 $oDataTemp;
			}
			$iNombreTotal							=	$rowCount["nb_records"];
			$toJson = array(
							"page"				=> $this->postGetValue ("page","1"),
							"total"				=> intval( ceil($iNombreTotal/5) ),
							"records"			=> intval( ceil($iNombreTotal/5) ),
							"rows"              => $toDataAssign,
							"nb_records"		=> $iNombreTotal
						    );
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	public function printEtatDeclaration($user_id){
		//print_r($user_id);die;
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

			$declaration				= $this->DeclarationPatrimoineService->findPersonneAssujetties($user_id);
			require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$zFond = PATH_ROOT_DIR .'/assets/img/fpdf/ETAT_DECLARATION.png';

			$oPdf=new FPDF();
			$oPdf->AddPage();
			$oPdf->SetXY(2,2);
			$oPdf->Image($zFond,5,5,200);
			$oPdf->SetFont('Arial', '', 10);

			$iIncrement					=	42;
			$iLeft						=	100;
			$iRight						=	10;
			$iIncrementiInterline		=	10;
			
			//set matricule
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+75,$iInterline,$declaration["matricule"],0,0,0,0);

			//set situation agent
			$iIncrement += 14; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+85,$iInterline,'  Fonctionnaire',0,0,0,0);

			//set acte de nomination
			$iIncrement += 20; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+100,$iInterline,$declaration["acte_de_nomination"],0,0,0,0);

			//set date de nomination
			$iIncrement += 20; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+81,$iInterline,$declaration["date_de_nomination"],0,0,0,0);

			//set nouvelle affectation
			$iIncrement += -1; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+160,$iInterline,$declaration["corps"],0,0,0,0);


			//set numero quitus
			$iIncrement += 15; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+95,$iInterline,$declaration["numero_quitus_bianco"],0,0,0,0);

			//set date quitus
			$iIncrement += 15; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+80,$iInterline,$declaration["date_quitus_bianco"],0,0,0,0);
			

			//set ord sec
			$iIncrement += 0; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iRight+140,$iInterline,$declaration["ordsec"],0,0,0,0);


			$oPdf->Output();
		}
	}

	public function sendMailDeclaration(){
		global $oSmarty ; 
		$oUser							= array();
		$oCandidat						= array();
		$iRet							= $this->check($oUser, $oCandidat);

		if($iRet == 1){	
			$toListe					=	$this->DeclarationPatrimoineService->getPersonnalitesAssujetties(1);
			foreach ($toListe as $oListe){
				$oSmarty->assign('zBasePath', base_url());
				$zSujet						=	"ROHI : Declaration de patrimoine ";
				$zBody						=	$oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/notification_declaration.tpl" );
				$oDestination['nom']		=	$oDestination['nom'];
				$oDestination['prenom']		=	$oDestination['prenom'];
				//$oDestination['email']		=	$oDestination['email'];
				$oDestination['email']		=	"abakeely@gmail.com";
				$this->sendMail($oDestination,$zSujet,$zBody);
			}

		} else {
			$this->mon_cv();
		}
	}

	public function sendMailTelechargement(){
		global $oSmarty ; 
		$oUser							= array();
		$oCandidat						= array();
		$oSmarty->assign('zBasePath', base_url());
		$zSujet						=	"ROHI : Telechargement declaration de patrimoine ";
		$zBody						=	$oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/message_telechargement_dp.tpl" );
		$oDestination['nom']		=	"RANDRIANOMENJANAHARY";
		$oDestination['prenom']		=	"RADO ABRAHAM";
		//$oDestination['email']		=	$oDestination['email'];
		$oDestination['email']		=	"abakeely@gmail.com";
		$this->sendMail($oDestination,$zSujet,$zBody);
		
	}

	public function saveInformationConjointe($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$toConjointes							= array() ;
			$toConjointes['nom']					= $this->postGetValue ("nom","") ; 
			$toConjointes['prenom']					= $this->postGetValue ("prenom","") ; 
			$toConjointes['fonction']				= $this->postGetValue ("fonction","") ; 
			$toConjointes['adresse']				= $this->postGetValue ("adresse","") ; 
			$toConjointes['date_naissance']			= $this->postGetValue ("date_naissance","") ; 
			$toConjointes['lieu_naissance']			= $this->postGetValue ("lieu_naissance","") ; 
			$toConjointes['cin']					= $this->postGetValue ("cin","") ; 
			$toConjointes['date_delivrance']		= $this->postGetValue ("date_delivrance","") ; 
			$toConjointes['lieu_delivrance']		= $this->postGetValue ("lieu_delivrance","") ; 
			$toConjointes['user_id']				= $oUser['id'] ; ; 
			$this->DeclarationPatrimoineService->saveInformationConjointe($toConjointes);
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function saveInformationEnfants($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$toEnfants								= array() ;
			$toEnfants['nom_prenoms']				= $this->postGetValue ("nom_prenoms","") ; 
			$toEnfants['date_de_naissance']			= $this->postGetValue ("date_de_naissance","") ; 
			$toEnfants['lieu_de_naissance']			= $this->postGetValue ("lieu_de_naissance","") ; 
			$toEnfants['activite']					= $this->postGetValue ("activite","") ; 
			$toEnfants['sexe']						= $this->postGetValue ("sexe","") ; 
			$toEnfants['user_id']					= $oUser['id'] ;
			$toEnfants['id']						= $this->postGetValue ("id","") ; 
			if( $operation == "add" ){
				$this->DeclarationPatrimoineService->createInformationEnfants($toEnfants);
			}else{
				$this->DeclarationPatrimoineService->majInformationEnfants($toEnfants);
			}
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	
	public function ajaxGetStatistiqueDeclaration($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$type_affichage				=	$this->postGetValue ("type_affichage","");
			$filter						=	$this->postGetValue ("filters","");

			$page						=	($this->postGetValue ("page","0")-1)*5;
			$rows						=	$this->postGetValue ("rows","1");


			$filter						=	json_decode($filter);
			$filters					=	$filter->rules;
			$parameters					=	array() ;
			//array_push($parameters," user_id = '".$oUser["id"]."' ");
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}

			if ( $type_affichage == "departement" ){
			$toListe					=	$this->DeclarationPatrimoineService->getStatistiqueDeclarationByDepartement($parameters,$page,$rows,0);
			}
			if ( $type_affichage == "code_corps" ){
			$toListe					=	$this->DeclarationPatrimoineService->getStatistiqueDeclarationByCorpsCode($parameters,$page,$rows,0);
			}
			if ( $type_affichage == "code_hee" ){
			$toListe					=	$this->DeclarationPatrimoineService->getStatistiqueDeclarationByCorpsHee($parameters,$page,$rows,0);
			}
			//echo json_encode($toListe);
			$toDataAssign				=	array();
			$iNombreTotal				=	0; 
			foreach ($toListe as $oListe){
				//print_r($toListe);die;
				$oDataTemp							=	 array(); 
				//$oDataTemp['checkbox']				=	'<input type="checkbox" name="checkbox" >';
				$oDataTemp['corps_code']			=	 $oListe['corps_code'];
				$oDataTemp['DGAI']					=	 $oListe['DGAI'];
				$oDataTemp['DGT']					=	 $oListe['DGT'];
				$oDataTemp['DGARMP']				=	 $oListe['DGARMP'];
				$oDataTemp['DGFAG']					=	 $oListe['DGFAG'];
				$oDataTemp['DGD']					=	 $oListe['DGD'];
				$oDataTemp['DGCF']					=	 $oListe['DGCF'];
				$oDataTemp['total_corps']			=	 $oListe['total_corps'];
				$toDataAssign[]						=	 $oDataTemp;
				$iNombreTotal						=	$iNombreTotal + 1; 
			}
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

	public function getNouvelleAffectation(){

		echo "E02P:E02P";
	}

	public function showDiagramme(){
		$toDatas				=	array() ;
		$list_corps				=	$this->postGetValue ("list_corps","");
		$departement			=	$this->postGetValue ("departement","");
		$zCorps					=	"(" . $list_corps .")" ;
		$toStatistiques				=	$this->DeclarationPatrimoineService->getNombreDeclarantByCorpsAndDepartement($zCorps,$departement);
		foreach ($toStatistiques as $oStatistique){
			$line				=	array();
			$line["y"]			=	$oStatistique["nb"];
			$line["name"]		=	$oStatistique["corps"];
			array_push($toDatas,$line) ;
		}
		echo json_encode($toDatas) ;
	}


	public function notificationMail(){
		global $oSmarty ; 
		$iRet							= $this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$zSujet							=  " Message de confirmation";
			$zBody							=   $oSmarty->fetch( ADMIN_TEMPLATE_PATH . "common/mail/telechargement_declaration.tpl" );
			$toDestinations					=	array() ;
			$toDestinations["nom"]			=	$oCandidat["nom"] ;
			$toDestinations["prenom"]		=	$oCandidat["prenom"];
			$toDestinations["email"]		=	$oCandidat["email"] ;
			$this->sendMail($toDestinations,$zSujet,$zBody);
		}
	}

}