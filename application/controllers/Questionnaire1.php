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

class Questionnaire1 extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Questionnaire_model','QuestionnaireService');
		$this->load->model('Candidat_model','CandidatService');
		$this->load->library('Phpword');
		$this->load->library('parser');
		$this->sessionStartCompte();
	}

	
	public function questionnaireDgfag($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$rangQuestion			    	=	$this->QuestionnaireService->getRangQuestion($oUser["id"]);
			if( $rangQuestion["rang_question"] == "28" ){
				$oData['enquete_effectue']	= "1" ;
			}else{
				$oData['enquete_effectue']	= "0" ;
			}
			$toQuestions					=	$this->QuestionnaireService->do_get_questions();
			$oData['toQuestions']			=	$toQuestions ; 
			$iCompteActif = $this->getSessionCompte() ;
			$this->load_my_view_Common('questionnaire/index1.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("Questionnaire1/index");
		}
    }
	
	public function saveQuestion(){
		$iRet						= $this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$parameters = $_POST ;
			//print_r($_POST);die;
			foreach ( $parameters as $key =>$value ){
				if( is_integer($key) ){
					echo $key . " = " .$value ."</br>" ;
					$this->QuestionnaireService->deleteQuestion($oUser["id"],$key,$value);
					$this->QuestionnaireService->saveQuestion($oUser["id"],$key,$value,$answer_comments);
				}else{
					$porte				=	$this->postGetValue ("porte");
					$lieu_de_service	=	$this->postGetValue ("lieu_de_service");
					$fonction			=	$this->postGetValue ("fonction");
					$structureId		=	$this->postGetValue ("structure_id");
					$lieu_service		=	$this->postGetValue ("lieu_de_service");
					$this->QuestionnaireService->updateQuestion($oUser["id"],$porte,$fonction,$structureId,$lieu_service);
				}
			}
			redirect("Questionnaire1/questionnaireDgfag");
		}
	}
	
	public function ajaxGetPreviousQuestion(){
		$iRet						= $this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$previous_question_id	=	$this->postGetValue ("previous_question_id","") ; 
			$question_id			=	$this->postGetValue ("question_id","") ; 
			$answer_id				=	$this->postGetValue ("answer_id","") ; 
			$answer_comments		=	$this->postGetValue ("answer_comments","") ; 
			//get choose
			//get next question
			$toQuestions			=	$this->QuestionnaireService->getPreviousQuestion($previous_question_id,$answer_id,$oUser["id"]);
			echo json_encode($toQuestions);
		}
	}
	
	public function ajaxGetNextQuestion(){
		$iRet						= $this->check($oUser, $oCandidat);
		if($iRet == 1){	
			$next_question_id		=	$this->postGetValue ("next_question_id","") ; 
			$question_id			=	$this->postGetValue ("question_id","") ; 
			$answer_id				=	$this->postGetValue ("answer_id","") ; 
			$answer_comments		=	$this->postGetValue ("answer_comments","") ; 
			//save choose
			$this->QuestionnaireService->deleteQuestion($oUser["id"],$question_id,$answer_id);
			$this->QuestionnaireService->saveQuestion($oUser["id"],$question_id,$answer_id,$answer_comments);
			//get next question
			$toQuestions			=	$this->QuestionnaireService->getNextQuestion($next_question_id,$answer_id,$oUser["id"]);
			echo json_encode($toQuestions);
		}
	}
	
	public function ajaxGetResultats($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$list_agent					=	$oCandidat[0]->structureId.",";
			$list_agent					=	$list_agent	. $this->QuestionnaireService->getListStructureChild($oCandidat[0]->structureId)["list"];
			if( count($filters) > 0 ) {
				foreach( $filters as $filter ){
					$paramater				=	$filter->field ." LIKE '%" . $filter->data."%'" ;
					array_push( $parameters, $paramater ) ;
				}
			}
			$rowCount					=	$this->QuestionnaireService->ajaxCountResultats($parameters,$list_agent);
			$toListe					=	$this->QuestionnaireService->getResultats($parameters,$page,$rows,$list_agent);
			$toDataAssign				=	array();
			foreach ($toListe as $oListe){
				///print_r($toListe);die;
				$oDataTemp							=	 array(); 
				$oDataTemp['user_id']				=	 $oListe['user_id'];
				$oDataTemp['matricule']				=	 $oListe['matricule'];
				$oDataTemp['fonction_actuel']		=	 $oListe['fonction_actuel'];
				$oDataTemp['nom_prenom']			=	 $oListe['nom'] .'  '.$oListe['prenom'];
				$oDataTemp['email']					=	 $oListe['email'];
				$oDataTemp['phone']					=	 $oListe['phone'];
				$oDataTemp['corps']					=	 $oListe['corps'];
				$oDataTemp['cin']					=	 $oListe['cin'];
				$oDataTemp['search_field']			=	 $oListe['search_field'];
				$oDataTemp['adresse']				=	 $oListe['address'];
				$oDataTemp['action']				=	 "<a href='/ROHI/Questionnaire/ajaxTelechargerFiche/".$oListe['user_id']."'>Telecharger</a>";
				$oDataTemp['rang']					=	 $oListe['rang'] ." sur " . " 34";
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
	
	public function ajaxTelechargerFiche($_user_id){
		//print_r($_user_id);die;
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
			$filename = 'fiche_enquete.docx';

		
			
			/*$header = $section->addHeader();
			$header->addText('This is my fabulous header!');*/
			 
			/*$footer = $section->addFooter();
			$footer->addText('Footer text goes here.');*/
			 
			$section = $phpWord->addSection();
			$textrun = $section->addTextRun();
			$phpWord->addFontStyle('r2Style', array('underline'=>'single','bold'=>true,'italic'=>false, 'size'=>12));
			$phpWord->addParagraphStyle('p2Style', array('align' =>  'right'));
			$textrun->addText('ENQUETE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG ', 'r2Style', 'p2Style');
		
			$textrun = $section->addTextRun();
			$textrun->addText('IDENTIFICATION DU REPONDEUR',['bold'=>true]);
			
			$textrun = $section->addTextRun();
			$textrun->addText('FAMANTARANA NY MPAMALY', ['bold'=>true,'italic' => true]);
			
			$textrun->addTextBreak(2);
			$candidat		=	$this->CandidatService->get_by_user_id($_user_id);
			$zFonction		=	$this->QuestionnaireService->getFonction($_user_id)["fonction"];
			$zLieuDeTravail	=	$this->QuestionnaireService->getLieuDeTravail($_user_id)["lieu_de_travail"];
			$zDirection		=	$this->QuestionnaireService->getDirection($_user_id)["direction"];
			$zService		=	$this->QuestionnaireService->getService($_user_id)["service"];
			$zRegion		=	$this->QuestionnaireService->getRegion($_user_id)["region"];
			$zDistrict		=	$this->QuestionnaireService->getDistrict($_user_id)["district"];
			if(!$zRegion){
				$zRegion	=	"Analamanga";
			}
			if(!$zDistrict){
				$zDistrict	=	"Antananarivo Renivohitra";
			}
			$textrun = $section->addTextRun();
			$textrun->addText('I.1 Nom et Prénoms :'.$candidat["0"]->nom ."   ".$candidat["0"]->prenoms, ['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.2 Rattachement :'.$candidat["0"]->path, ['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.3 Direction :'.$zDirection, ['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.4 Service :'.$zService, ['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.5 Région :' .$zRegion,['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.6 District :'.$zDistrict,['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.7 Lieu de travail :'.$zLieuDeTravail, ['bold'=>true]);
			$textrun->addTextBreak();
			$textrun->addText('I.8 Fonction :'.$zFonction, ['bold'=>true]);
			$textrun->addTextBreak(2);
			
			$textrun->addText('Etes-vous en accord ou en désaccord avec les affirmations suivantes :');
			$textrun->addTextBreak();
			$textrun->addText('Ahoana ny hevitrao mahakasika ireto manaraka ireto',['italic' => true]);
			$textrun->addTextBreak(2);
			$textrun->addText('1 : Pas du tout d’accord');
			$textrun->addText('                ');
			$textrun->addText('2 : Plutôt d’accord');
			$textrun->addText('                ');
			$textrun->addText('3 : Tout à fait d’accord');
			$textrun->addTextBreak();
			$textrun->addText('      Mandà',['italic' => true]);
			$textrun->addText('                                 ');
			$textrun->addText('      Azo ekena',['italic' => true]);
			$textrun->addText('                ');
			$textrun->addText('                Manaiky tanteraka',['italic' => true]);
			
			//premier tableau
			$textrun->addTextBreak(2);
			$textrun->addText('I-ORGANISATION DE TRAVAIL', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('     FANDAMINANA NY ASA',['italic' => true]);
			$tableStyle =array('borderColor' => '006699','borderSize'  => 6,'cellMargin'  => 50);
			$firstRowStyle =array('bgColor' => 'CCCCCC');
			$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
			$table = $section->addTable('myTable');
			
			$statistiques		=	$this->QuestionnaireService->getStatistique("GP_02",$_user_id);
			for ($row = 1; $row <= 1; $row++) { 
				$table->addRow();
				$table->addCell(30000)->addText();
				$table->addCell(800)->addText("1");
				$table->addCell(800)->addText("2");
				$table->addCell(800)->addText("3");
			}
			foreach ($statistiques as $key=>$statistique){
				$table->addRow();
				$table->addCell(30000)->addText(($key+1).".   ".$statistique["quizz_questions_libelle_fr"] ."\n".$statistique["quizz_questions_libelle_mg"]);
				if($statistique["reponse"] == "1"){
					$table->addCell(800)->addText("X");
				}else{
					$table->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				if($statistique["reponse"] == "2"){
					$table->addCell(800)->addText("X");
				}else{
					$table->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				
				if($statistique["reponse"] == "3"){
					$table->addCell(800)->addText("X");
				}else{
					$table->addCell(800)->addText("X",['color' => 'ffffff']);
				}
			}
			
			//deuxieme tableau
			$textrun = $section->addTextRun();
			$textrun->addTextBreak(7);
			$textrun->addText('II-AMBIANCE DE TRAVAIL', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('     FIARAHA-MONINA AO AM-PIASANA',['italic' => true]);
			$tableStyle =array('borderColor' => '006699','borderSize'  => 6,'cellMargin'  => 50);
			$firstRowStyle =array('bgColor' => 'CCCCCC');
			$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
			$table1 = $section->addTable('myTable');
			
			$statistiques		=	$this->QuestionnaireService->getStatistique("GP_03",$_user_id);
			for ($row = 1; $row <= 1; $row++) { 
				$table1->addRow();
				$table1->addCell(30000)->addText();
				$table1->addCell(800)->addText("1");
				$table1->addCell(800)->addText("2");
				$table1->addCell(800)->addText("3");
			}
			foreach ($statistiques as $key=>$statistique){
				$table1->addRow();
				$table1->addCell(30000)->addText(($key+1).".   ".$statistique["quizz_questions_libelle_fr"] ."\n".$statistique["quizz_questions_libelle_mg"]);
				if($statistique["reponse"] == "1"){
					$table1->addCell(800)->addText("X");
				}else{
					$table1->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				if($statistique["reponse"] == "2"){
					$table1->addCell(800)->addText("X");
				}else{
					$table1->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				
				if($statistique["reponse"] == "3"){
					$table1->addCell(800)->addText("X");
				}else{
					$table1->addCell(800)->addText("X",['color' => 'ffffff']);
				}
			}
			
			//troisième tableau
			$textrun = $section->addTextRun();
			$textrun->addTextBreak(2);
			$textrun->addText('III-SANTE AU TRAVAIL', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('     FAHASALAMANA EO AMIN’NY TOERAM-PIASANA',['italic' => true]);
			$tableStyle =array('borderColor' => '006699','borderSize'  => 6,'cellMargin'  => 50);
			$firstRowStyle =array('bgColor' => 'CCCCCC');
			$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
			$table2 = $section->addTable('myTable');
			
			$statistiques		=	$this->QuestionnaireService->getStatistique("GP_04",$_user_id);
			for ($row = 1; $row <= 1; $row++) { 
				$table2->addRow();
				$table2->addCell(30000)->addText();
				$table2->addCell(800)->addText("1");
				$table2->addCell(800)->addText("2");
				$table2->addCell(800)->addText("3");
			}
			foreach ($statistiques as $key=>$statistique){
				$table2->addRow();
				$table2->addCell(30000)->addText(($key+1).".   ".$statistique["quizz_questions_libelle_fr"] ."\n".$statistique["quizz_questions_libelle_mg"]);
				if($statistique["reponse"] == "1"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				if($statistique["reponse"] == "2"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				
				if($statistique["reponse"] == "3"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
			}
			
			//quatrième tableau
			$textrun = $section->addTextRun();
			$textrun->addTextBreak(2);
			$textrun->addText('IV-MATERIELS ET EQUIPEMENTS DE TRAVAIL', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('     FAMPITAOVANA ENTI-MIASA',['italic' => true]);
			$tableStyle =array('borderColor' => '006699','borderSize'  => 6,'cellMargin'  => 50);
			$firstRowStyle =array('bgColor' => 'CCCCCC');
			$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
			$table2 = $section->addTable('myTable');
			
			$statistiques		=	$this->QuestionnaireService->getStatistique("GP_05",$_user_id);
			for ($row = 1; $row <= 1; $row++) { 
				$table2->addRow();
				$table2->addCell(30000)->addText();
				$table2->addCell(800)->addText("1");
				$table2->addCell(800)->addText("2");
				$table2->addCell(800)->addText("3");
			}
			foreach ($statistiques as $key=>$statistique){
				$table2->addRow();
				$table2->addCell(30000)->addText(($key+1).".   ".$statistique["quizz_questions_libelle_fr"] ."\n".$statistique["quizz_questions_libelle_mg"]);
				if($statistique["reponse"] == "1"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				if($statistique["reponse"] == "2"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				
				if($statistique["reponse"] == "3"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
			}
			
			//sixième tableau
			$textrun = $section->addTextRun();
			$textrun->addTextBreak(2);
			$textrun->addText('V-COMMUNICATION INTERNE', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('     FIFANDRAISANA ANATINY',['italic' => true]);
			$tableStyle =array('borderColor' => '006699','borderSize'  => 6,'cellMargin'  => 50);
			$firstRowStyle =array('bgColor' => 'CCCCCC');
			$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
			$table2 = $section->addTable('myTable');
			
			$statistiques		=	$this->QuestionnaireService->getStatistique("GP_06",$_user_id);
			for ($row = 1; $row <= 1; $row++) { 
				$table2->addRow();
				$table2->addCell(30000)->addText();
				$table2->addCell(800)->addText("1");
				$table2->addCell(800)->addText("2");
				$table2->addCell(800)->addText("3");
			}
			foreach ($statistiques as $key=>$statistique){
				$table2->addRow();
				$table2->addCell(30000)->addText(($key+1).".   ".$statistique["quizz_questions_libelle_fr"] ."\n".$statistique["quizz_questions_libelle_mg"]);
				if($statistique["reponse"] == "1"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				if($statistique["reponse"] == "2"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				
				if($statistique["reponse"] == "3"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
			}
			
			//septième tableau
			$textrun = $section->addTextRun();
			$textrun->addTextBreak(2);
			$textrun->addText('VI-D’AUTRES QUESTIONS', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('     Fanontaniana Fanampiny',['italic' => true]);
			$tableStyle =array('borderColor' => '006699','borderSize'  => 6,'cellMargin'  => 50);
			$firstRowStyle =array('bgColor' => 'CCCCCC');
			$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
			$table2 = $section->addTable('myTable');
			
			$statistiques		=	$this->QuestionnaireService->getStatistique("GP_07",$_user_id);
			for ($row = 1; $row <= 1; $row++) { 
				$table2->addRow();
				$table2->addCell(30000)->addText();
				$table2->addCell(800)->addText("1");
				$table2->addCell(800)->addText("2");
				$table2->addCell(800)->addText("3");
			}
			foreach ($statistiques as $key=>$statistique){
				$table2->addRow();
				$table2->addCell(30000)->addText(($key+1).".   ".$statistique["quizz_questions_libelle_fr"] ."\n".$statistique["quizz_questions_libelle_mg"]);
				if($statistique["reponse"] == "1"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				if($statistique["reponse"] == "2"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
				
				if($statistique["reponse"] == "3"){
					$table2->addCell(800)->addText("X");
				}else{
					$table2->addCell(800)->addText("X",['color' => 'ffffff']);
				}
			}
			$textrun = $section->addTextRun();
			$textrun->addTextBreak(2);
			$textrun->addText('IL Y A-T-IL, PARMI LES ASPECTS CITES PRECEDEMMENT, CEUX QUI NECESSITENT DES AMELIORATIONS PRIORITAIRES AU SEIN DE LA DGFAG', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('AMIN\'IREO ZAVATRA VOALAZA ETSY AMBONY, MOA VE MISY ILANA FANATSARANA?', ['size' => 11, 'bold' => true,'italic' => true]);
			
			
			$textrun = $section->addTextRun();
			//Premier commentaires
			$zPremierCommentaire		=	$this->QuestionnaireService->getPremierCommentaire($_user_id)["commentaire"];
			$textrun->addText($zPremierCommentaire, ['size' => 11]);
						$textrun->addTextBreak(12);

			$textrun = $section->addTextRun();
			
			$textrun->addText('IL Y A-T-IL D\'AUTRES ASPECTS NON CITES MAIS NECESSITANT DES CHANGEMENTS AU SEIN DE LA DGFAG', ['size' => 13, 'bold' => true]);
			$textrun->addTextBreak();
			$textrun->addText('MISY ZAVATRA TSY VOALAZA VE NEFA METY ILANA FANOVANA NA FANATSARANA ETO ANIVON\'NY DGFAG', ['size' => 11, 'bold' => true,'italic' => true]);
			
			/*$lineStyle =array('weight' => 1, 'width' => 1024, 'height' => 0, 'color' => CCCCCC);
			$section->addLine($lineStyle);*/			
			$textrun->addTextBreak(4);
			
			//Deuxieme commentaires
			$zDeuxiemeCommentaire		=	$this->QuestionnaireService->getDeuxiemeCommentaire($_user_id)["commentaire"];
			$textrun->addText($zDeuxiemeCommentaire, ['size' => 11]);
			$textrun = $section->addTextRun();
			$textrun->addTextBreak();
			$textrun->addText('Nous vous remercions de votre collaboration', ['valign' => 'center']);
			$textrun->addTextBreak();
			$textrun->addText('Misaotra indrindra amin’ny fiaraha-miasa', ['valign' => 'center','italic'=>true]);
			
			
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

			exit;
		}
    }
	
	public function getRepport(){
		$iRet						= $this->check($oUser, $oCandidat);
		if  ($iRet == 1) {	
			$quizz_referentiel_groupe		=	$this->postGetValue ("quizz_referentiel_groupe","") ; 
			$quizz_referentiel_value		=	$this->postGetValue ("quizz_referentiel_value","") ; 
			if ( $quizz_referentiel_groupe == "DEPT" ) {
				$list_structure					=	$quizz_referentiel_value.	",". $this->QuestionnaireService->getListStructureChild($quizz_referentiel_value)["list"];
				$clauseAnd			=	" AND quiz_resultats_user_id IN (SELECT user_id FROM rohi.candidat WHERE structureId IN($list_structure) ) " ;
			}
			if ( $quizz_referentiel_groupe == "DIR" ) {
				$list_structure					=	$quizz_referentiel_value. ",". $this->QuestionnaireService->getListStructureChild($quizz_referentiel_value)["list"];
				$clauseAnd			=	" AND quiz_resultats_user_id IN (SELECT user_id FROM rohi.candidat WHERE structureId IN($list_structure) ) " ;
			}
			if ( $quizz_referentiel_groupe == "SCE" ) {
				$list_structure					=	$quizz_referentiel_value. ","	. $this->QuestionnaireService->getListStructureChild($quizz_referentiel_value)["list"];
				$clauseAnd			=	" AND quiz_resultats_user_id IN ( SELECT user_id FROM rohi.candidat WHERE structureId IN($list_structure) ) " ;
			}
			
			if ( $quizz_referentiel_groupe == "FONC" ) {
				$clauseAnd			=	"AND  quiz_resultats_user_id IN ( SELECT DISTINCT quiz_resultats_user_id FROM quiz_resultats WHERE quiz_resultats_answers_id IN($quizz_referentiel_value) ) " ;
			}
			
			if ( $quizz_referentiel_groupe == "AGE" ) {
				if ( $quizz_referentiel_value == "18" ) {
					$clauseAnd			=	" AND quiz_resultats_user_id IN (SELECT user_id FROM rohi.candidat WHERE floor((curdate()-date_naiss)/10000) >=18 AND floor((curdate()-date_naiss)/10000) <30 ) " ;
				}
				if ( $quizz_referentiel_value == "30" ) {
					$clauseAnd			=	" AND quiz_resultats_user_id IN (SELECT user_id FROM rohi.candidat WHERE floor((curdate()-date_naiss)/10000) >=30 AND floor((curdate()-date_naiss)/10000) <40 ) " ;
				}
				if ( $quizz_referentiel_value == "40" ) {
					$clauseAnd			=	" AND quiz_resultats_user_id IN (SELECT user_id FROM rohi.candidat WHERE floor((curdate()-date_naiss)/10000) >=40 AND floor((curdate()-date_naiss)/10000) <50 ) " ;
				}
				if ( $quizz_referentiel_value == "50" ) {
					$clauseAnd			=	" AND quiz_resultats_user_id IN (SELECT user_id FROM rohi.candidat WHERE floor((curdate()-date_naiss)/10000) >=50 AND floor((curdate()-date_naiss)/10000) <61 ) " ;
				}
			}
			$toRepports				=	$this->QuestionnaireService->getRepport($clauseAnd);
			
			$toReturns				=	array();
			$tiListQuestions		=	array();
			$iIndex					=	0;
			foreach($toRepports as $oRepport){
				if( in_array($oRepport["quiz_questions_id"],$tiListQuestions ) ){
					$return[$oRepport["quiz_questions_id"]][$oRepport["quiz_answers_value"]]=	$oRepport["nb"];
					array_push($toReturns[$iIndex],$return);
					$iIndex					=	$iIndex + 1;
				}else{
					$return[$oRepport["quiz_questions_id"]] 								=	array();
					$return[$oRepport["quiz_questions_id"]]["quizz_questions_libelle_fr"]	=	$oRepport["quizz_questions_libelle_fr"];
					$return[$oRepport["quiz_questions_id"]]["quiz_questions_id"]			=	$oRepport["quiz_questions_id"];
					$return[$oRepport["quiz_questions_id"]][$oRepport["quiz_answers_value"]]=	$oRepport["nb"];
					$toReturns[$iIndex]														=	array();
					array_push($toReturns[$iIndex],$return);
					array_push($tiListQuestions,$oRepport["quiz_questions_id"]);
				}
			}
			$toReturns				=	$toReturns[sizeof($toReturns)-1][0];
			
			$results				=	array();
			foreach($toReturns as $oReturn){
				$ligne				=	array();
				$ligne["quiz_questions_id"]				=	$oReturn["quiz_questions_id"];
				$ligne["quizz_questions_libelle_fr"]	=	$oReturn["quizz_questions_libelle_fr"];
				$ligne["1"]			=	$oReturn["1"];
				$ligne["2"]			=	$oReturn["2"];
				$ligne["3"]			=	$oReturn["3"];
				array_push($results,$ligne);
			}
			$iNombreTotal			=	 sizeof($results);
			$toJson = array(
				"page"				=> $this->postGetValue ("page","1"),
				"total"				=> intval( ceil($iNombreTotal/5) ),
				"records"			=> intval( ceil($iNombreTotal/5) ),
				"rows"              => $results,
				"nb_records"		=> $iNombreTotal
			);
			echo json_encode($toJson);
		}
	}
	
	public function showDiagramme(){
		$toDatas				=	array() ;
		$question_id			=	$this->postGetValue ("question_id","");
		$toStatistiques			=	$this->QuestionnaireService->showDiagramme($question_id);
		$results				=	array();
		foreach ($toStatistiques as $oStatistique){
			$line				=	array();
			$line["y"]			=	$oStatistique["nb"]*100;
			$line["name"]		=	$oStatistique["quiz_answers_libelle_fr"];
			array_push($results,$line) ;
		}
		echo json_encode($results) ;
	}
	
	public function getReferentiel(){
		$toDatas				=	array() ;
		$groupe					=	$this->postGetValue ("groupe","");
		$referentiels			=	$this->QuestionnaireService->getReferentiel($groupe);
		echo json_encode($referentiels) ;
	}

	
}