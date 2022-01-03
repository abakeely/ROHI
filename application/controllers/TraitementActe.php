<?php
/**
* @package ROHI
* @subpackage Documentation
* @author Division Recherche et Développement Informatique
*/

ob_start();
/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);*/


class TraitementActe extends MY_Controller {

	
	/**  
	* Classe qui concerne la documentation
	* @package  ROHI  
	* @subpackage documentation */ 

	public function __construct(){
		parent::__construct();
		
		$this->load->model('TraitementActe_model','TraitementActeService');
		$this->load->model('Referentiel_model','ReferentielService');
		$this->load->model('Sequence_model','SequenceService');
		
		$this->sessionStartCompte();
	}
	
	
	public function creationFormulaire($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$this->load_my_view_Common('traitementActe/creation_formulaire.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	public function preparationProjet($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$this->load_my_view_Common('traitementActe/preparation_projet.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function saisieContenu($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$oData['iUserId']				= $oUser['id'] ;
			$oData['iSessionCompte']		= $iSessionCompte ; 
			$list_departement				= $this->departement->get_departement();
			$oData['list_departement']		= $list_departement;
			$list_pieces_jointes			= $this->Referentiel->findAllPiecesJointes();
			$oData['list_pieces_jointes']	= $list_pieces_jointes;
			$list_corps						= $this->Referentiel->findAllCorps();
			$oData['list_corps']			= $list_corps;
			$oData['ticket_code']			= $_GET["ticket_code"];
			$this->load_my_view_Common('traitementActe/saisie_contenu.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function attributionVisaFinance($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$list_departement			= $this->departement->get_departement();
			$oData['list_departement']  = $list_departement;
			$list_pieces_jointes			= $this->Referentiel->findAllPiecesJointes();
			$oData['list_pieces_jointes']	= $list_pieces_jointes;
			$this->load_my_view_Common('traitementActe/attribution_visa_finance.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function attributionVisaCf($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$list_departement = $this->departement->get_departement();
			$oData['list_departement']  = $list_departement;
			$list_pieces_jointes			= $this->Referentiel->findAllPiecesJointes();
			$oData['list_pieces_jointes']	= $list_pieces_jointes;
			$this->load_my_view_Common('traitementActe/attribution_visa_cf.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }


	public function mandatement($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$list_pieces_jointes			= $this->Referentiel->findAllPiecesJointes();
			$oData['list_pieces_jointes']	= $list_pieces_jointes;
			$this->load_my_view_Common('traitementActe/mandatement.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }

	public function imprimerActeFormate($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		echo "Impression acte formate";
		
    }

	public function getFields1($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$mouvement_code	=	$this->postGetValue ("mouvement_code","") ; 
		$toFields		=	$this->TraitementActeService->getFieldsByMouvementCode($mouvement_code);
		$zField			=	$toFields["mouvement_champ"];
		echo $zField;
    }

	public function saveProjetActe($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser						=  array();
		$oCandidat					=  array();
		$iRet						=  $this->check($oUser, $oCandidat);
		$iCompteActif				=  $this->getSessionCompte();
		if($iRet == 1){	
			$zDatabase							=  "sgrh";
			$zTable								=  "t_ticket";
			$oData								=  array();
			$oData["ticket_code"]				= "TICKET_" . date("Ymd").$this->SequenceService->seqTicketNextVal()["sequence_ticket"];
			$oData["ticket_poste_agent_numero"]	= $this->postGetValue ("ticket_poste_agent_numero","") ; 
			$oData["ticket_libelle"]			= $this->postGetValue ("ticket_libelle","") ; 
			$oData["ticket_processus_code"]		= $this->postGetValue ("ticket_processus_code","") ; 
			$oData["ticket_commentaire"]		= $this->postGetValue ("ticket_commentaire","") ; 
			$oData["ticket_designation"]		= $this->postGetValue ("ticket_designation","") ; 
			$oData["ticket_sigle"]				= $this->postGetValue ("ticket_sigle","") ; 
			$oData["date_acte"]					= $this->postGetValue ("date_acte","") ; 
			$oData["ticket_type_code"]			= " TRAITEMENT DES ACTES FORMATES " ; 
			$oData["ticket_date_creation"]		= date("Y-m-d H:m:s")  ; 
			$oData["ticket_owner"]				= $oUser["im"] ; 
			$oData["ticket_activite_code"]		= " ME " ; 
			$oData["ticket_tache_code"]			= $this->postGetValue ("ticket_niveau","") ; 
			$oData["ticket_entite_code"]		= " 00210110" ; 
			$oData["ticket_niveau"]				= $this->postGetValue ("ticket_niveau","") ; 
			$this->GenericCruds->insert($zDatabase,$zTable,$oData);

			$ticket_code						=	$oData["ticket_code"]  ; 
			$ticket_niveau						=	$this->postGetValue ("ticket_niveau","") ; 
			$this->validerActe($ticket_code,$ticket_niveau,$oUser);

			echo $oData["ticket_code"];
		}
    }


	public function getNiveauSuivantTicket(){
		$ticket_niveau		=	$this->postGetValue ("ticket_niveau","") ; 
		$oTicket			=	$this->TraitementActeService->getNiveauSuivantTicket($ticket_niveau);
		echo json_encode($oTicket);
    }

	public function getInfoTicket(){
		$ticket_code		=	$this->postGetValue ("ticket_code","") ; 
		$oTicket			=	$this->TraitementActeService->getInfoTicket($ticket_code);
		echo json_encode($oTicket);
    }

	public function getInfoAgent(){
		$poste_agent_numero	=	$this->postGetValue ("poste_agent_numero","") ; 
		$oAgent				=	$this->TraitementActeService->getInfoAgent($poste_agent_numero);
		echo json_encode($oAgent);
    }

	public function getMouvementAgent(){
		$ticket_code			=	$this->postGetValue ("ticket_code","") ; 
		$toMouvementAgents		=	$this->TraitementActeService->getMouvementAgent($ticket_code);
		echo json_encode($toMouvementAgents);
    }
	
	public function majDerniereSituation($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		$oUser												=  array();
		$oCandidat											=  array();
		$iRet												=  $this->check($oUser, $oCandidat);
		$iCompteActif										=  $this->getSessionCompte();
		if($iRet == 1){	
			$zDatabase										=  "sgrh";
			$zTable											=  "t_ticket";

			//prendre la derniere informations de l'agent dans t_agent_situation
			$poste_agent_numero								=	$this->postGetValue ('poste_agent_numero') ;
			$agent_matricule								=   substr($poste_agent_numero,1, 7); 
			$ticket_code									=	$this->postGetValue('ticket_code') ;

			//supprimer l'enregistrement existant pour le ticket et pour l'agent
			$tzConditionDelete								=	array();
			array_push($tzConditionDelete," poste_agent_numero ='".$poste_agent_numero."' ");
			array_push($tzConditionDelete," ticket_code ='".$ticket_code."' ");
			
			$this->GenericCruds->delete("sgrh","t_mouvement_agent",$tzConditionDelete);
			//recuperer l'enregistrement
			$tzConditionDerniereSituations					=	array();
			array_push($tzConditionDerniereSituations," poste_agent_numero ='".$poste_agent_numero."' ");
			$oDernierSituation								=	$this->TraitementActeService->getInfoAgent($poste_agent_numero);
			
			//set l'ancien info par la derniere info dans t_mouvement_agent
			$oMouvementAgent								=	array();
			$oMouvementAgent["ticket_code"]					=	$this->postGetValue('ticket_code') ;
			$oMouvementAgent["mouvement_code"]				=	$this->postGetValue('mouvement_code') ;
			$oMouvementAgent["niveau_mouvement"]			=	$this->postGetValue('niveau_mouvement') ;
			$oMouvementAgent["date_mouvement"]				=	date("d/m/Y") ;
			$oMouvementAgent["date_effet"]					=	$this->postGetValue('nouveau_date_effet') ;
			$oMouvementAgent["statut"]						=	$this->postGetValue('statut') ;
			$oMouvementAgent["poste_agent_numero"]			=	$poste_agent_numero	 ;
			$oMouvementAgent["agent_matricule"]				=	$oDernierSituation["matricule"] ;
			$oMouvementAgent["agent_nom"]					=	$oDernierSituation["nom"] ;
			$oMouvementAgent["agent_prenoms"]				=	$oDernierSituation["prenom"] ;
			$oMouvementAgent["agent_cin"]					=	$oDernierSituation["cin"] ;
			$oMouvementAgent["date_naiss"]					=	$oDernierSituation["date_naiss"] ;
			$oMouvementAgent["sexe"]						=	$oDernierSituation["sexe"] ;
			$oMouvementAgent["sit_mat"]						=	$oDernierSituation["sit_mat"] ;
			$oMouvementAgent["date_entree_administration"]	=	$oDernierSituation["date_prise_service"] ;
			$oMouvementAgent["ancien_cadre"]				=	$oDernierSituation["cadre"] ;
			$oMouvementAgent["ancien_corps_code"]			=	$oDernierSituation["corps"] ;
			$oMouvementAgent["ancien_grade_code"]			=	$oDernierSituation["grade"] ;
			$oMouvementAgent["ancien_indice"]				=	$oDernierSituation["indice"] ;
			$oMouvementAgent["ancien_soa_code"]				=	$oDernierSituation["soa"] ;
			$oMouvementAgent["ancien_uadm_code"]			=	$oDernierSituation["uadm"] ;
			$oMouvementAgent["ancien_section_code"]			=	$oDernierSituation["section"] ;
			$oMouvementAgent["ancien_date_debut_contrat"]	=	$oDernierSituation["date_debut_contrat"] ;
			$oMouvementAgent["ancien_date_fin_contrat"]		=	$oDernierSituation["date_fin_contrat"] ;
			$oMouvementAgent["ancien_localite_service"]		=	$oDernierSituation["localite_service"] ;
			$oMouvementAgent["ancien_fiv_code"]				=	$oDernierSituation["region_code"] ;
			$oMouvementAgent["ancien_region_code"]			=	$oDernierSituation["region_code"] ;
			$oMouvementAgent["ancien_sanction_code"]		=	$oDernierSituation["sanction"] ;
			$oMouvementAgent["ancien_hee_code"]				=	$oDernierSituation["hee_code"]	 ;
			$oMouvementAgent["ancien_categorie_code"]		=	$oDernierSituation["categorie"]	 ;
			$oMouvementAgent["ancien_fonction_actuel"]		=	$oDernierSituation["fonction_actuel"]	 ;
			$oMouvementAgent["ancien_date_effet"]			=	$this->postGetValue('nouveau_date_effet') ;
			$oMouvementAgent["ancien_mode_paiement"]		=	$oDernierSituation["mode_paiement"] ;
			$oMouvementAgent["ancien_numero_compte"]		=	$oDernierSituation["numero_compte"] ;
			$oMouvementAgent["ancien_code_budget"]			=	$oDernierSituation["code_budget"] ;


			//recuperer les nouveaux info et set le nouveau info dans t_mouvement_agent
			$oMouvementAgent["nouveau_cadre"]				=	$this->postGetValue('nouveau_cadre') ;
			$oMouvementAgent["nouveau_corps_code"]			=	$this->postGetValue('nouveau_corps_code') ;
			$oMouvementAgent["nouveau_categorie_code"]		=	$this->postGetValue('nouveau_categorie_code') ;
			$oMouvementAgent["nouveau_grade_code"]			=	$this->postGetValue('nouveau_grade_code') ;
			$oMouvementAgent["nouveau_indice"]				=	$this->postGetValue('nouveau_indice') ;
			$oMouvementAgent["nouveau_soa_code"]			=	$this->postGetValue('nouveau_soa_code') ;
			$oMouvementAgent["nouveau_uadm_code"]			=	$this->postGetValue('nouveau_uadm_code') ;
			$oMouvementAgent["nouveau_section_code"]		=	$this->postGetValue('nouveau_section_code') ;
			$oMouvementAgent["nouveau_date_debut_contrat"]	=	$this->postGetValue('nouveau_date_debut_contrat') ;
			$oMouvementAgent["nouveau_date_fin_contrat"]	=	$this->postGetValue('nouveau_date_fin_contrat') ;
			$oMouvementAgent["nouveau_localite_service"]	=	$this->postGetValue('nouveau_localite_service') ;
			$oMouvementAgent["nouveau_fiv_code"]			=	$this->postGetValue('nouveau_fiv_code') ;
			$oMouvementAgent["nouveau_region_code"]			=	$this->postGetValue('nouveau_region_code') ;
			$oMouvementAgent["nouveau_sanction_code"]		=	$this->postGetValue('nouveau_sanction_code') ;
			$oMouvementAgent["nouveau_hee_code"]			=	$this->postGetValue('nouveau_hee_code') ;
			$oMouvementAgent["nouveau_categorie_code"]		=	$this->postGetValue('nouveau_categorie_code') ;
			$oMouvementAgent["nouveau_mode_paiement"]		=	$this->postGetValue('nouveau_mode_paiement') ;
			$oMouvementAgent["nouveau_numero_compte"]		=	$this->postGetValue('nouveau_numero_compte') ;
			$oMouvementAgent["nouveau_fonction_actuel"]		=	$this->postGetValue('nouveau_fonction_actuel') ;
			$oMouvementAgent["nouveau_date_effet"]			=	$this->postGetValue('nouveau_date_effet') ;
			$oMouvementAgent["nouveau_code_budget"]			=	$this->postGetValue('nouveau_code_budget') ;
			
			$numero_visa_fin								= isset($_POST['numero_visa_fin'])?$_POST['numero_visa_fin']:"";
			$numero_visa_cf									= isset($_POST['numero_visa_cf'])?$_POST['numero_visa_cf']:"";
			if( $numero_visa_fin!="" ){
				$oMouvementAgent["numero_visa_fin"]				= $this->postGetValue ("numero_visa_fin","") ; 
				$oMouvementAgent["date_visa_fin"]				= $this->postGetValue ("date_visa_fin","") ; 
				$oMouvementAgent["signataire_visa_fin"]			= $this->postGetValue ("signataire_visa_fin","") ; 
			}
			if($numero_visa_cf!="" ){
				$oMouvementAgent["numero_visa_cf"]				= $this->postGetValue ("numero_visa_cf","") ; 
				$oMouvementAgent["date_visa_cf"]				= $this->postGetValue ("date_visa_cf","") ; 
				$oMouvementAgent["signataire_visa_cf"]			= $this->postGetValue ("signataire_visa_cf","") ; 
				
			}
			
			$nouveau_rubriques									=	$this->postGetValue ("nouveau_rubriques","");
			$tzRubriques										=	explode(":",$nouveau_rubriques);
			for($iIndex = 0; $iIndex <sizeof($tzRubriques);$iIndex++){
				$zRub 	=	$tzRubriques[$iIndex] ;
				$tzRub	=	explode(",",$zRub);
				$oRub								=	array();
				$oRub["ticket_code"]				=	$this->postGetValue('ticket_code') ;
				$oRub["rubrique_code"]				=	$tzRub[0];
				$oRub["rubrique_montant"]			=	$tzRub[1];
				$oRub["rubrique_date_debut"]		=	$tzRub[2];
				$oRub["rubrique_date_fin"]			=	$tzRub[3];
				$this->GenericCruds->insert("sgrh","t_produit_iquidation",$oRub);
			}
			//inserer le mouvement dans t_mouvement_agent
		
			$this->GenericCruds->insert("sgrh","t_mouvement_agent",$oMouvementAgent);

			//maj t_agent_situation
			
			//maj traitement ticket
			
			$ticket_code						=	$this->postGetValue('ticket_code')  ; 
			$ticket_niveau						=	$this->postGetValue ("ticket_niveau","") ; 
			$this->validerActe($ticket_code,$ticket_niveau,$oUser);
		
			redirect("traitementActe/saisieContenu");
		}
    }

	public function getFields($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$mouvement_code	=	$this->postGetValue ("mouvement_code","") ; 
		$toFields		=	$this->TraitementActeService->getFieldsByMouvementCode($mouvement_code);
		$zField			=	$toFields["mouvement_champ"];
		echo $zField;
    }

	public function ajaxGetAllTicket($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$params				=	array();
		$numero_acte		= $this->postGetValue ("numero_acte","") ?$this->postGetValue ("numero_acte",""):""; 
		$agent_matricule	= $this->postGetValue ("agent_matricule","")?$this->postGetValue ("agent_matricule",""):""; 
		$type_acte			= $this->postGetValue ("type_acte","")?$this->postGetValue ("type_acte",""):""; 
		$date_debut			= $this->postGetValue ("date_debut","")?$this->postGetValue ("date_debut",""):""; 
		$date_fin			= $this->postGetValue ("date_fin","")?$this->postGetValue ("date_fin",""):""; 
		
		if($numero_acte){
			array_push($params," AND ticket_id > 0 ") ;
		}
		if($numero_acte){
			array_push($params," ticket_code ='".$numero_acte."' ") ;
		}
		/*if($agent_matricule){
			array_push($params," ticket_poste_agent_numero ='".$agent_matricule."' ") ;
		}
		if($type_acte){
			array_push($params," ticket_processus_code ='".$type_acte."' ") ;
		}
		if($date_debut){
			array_push($params," ticket_date_creation < '".$date_debut."' ") ;
		}
		if($date_fin){
			array_push($params," ticket_date_creation > '".$date_fin."' ") ;
		}*/
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
			$iNombreTotal		=	0;
			
			$toListe			=	$this->TraitementActeService->getAllTicket($params);
			
			$oDataAssign		=	array();
			foreach ($toListe as $oListe){
				//print_r($toListe);die;
				$oDataTemp		=	array(); 
				$oDataTemp[]	=	 $oListe['ticket_id'];
				$oDataTemp[]	=	 $oListe['ticket_designation'];
				$oDataTemp[]	=	 $oListe['ticket_code'];
				$oDataTemp[]	=	 $oListe['ticket_libelle'];
				$oDataTemp[]	=	 $oListe['ticket_date_creation'];
				$oDataTemp[]	=	 $oListe['ticket_processus_code'];
				$oDataTemp[]	=	 $oListe['ticket_poste_agent_numero'];
				$oDataTemp[]	=	 $oListe['ticket_sigle'];

		
				$zAction = '<a title="Imprimer" alt="Imprimer" href="'.$zBasePath.'printActeFormate/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['ticket_code'].'" title="" target="_blank" class="action"><i style="color:#12105A" class="la la-print"></i></a>' ; 

				$zAction .= '<a href="'.$zBasePath.'editActeFormate/'.$oListe['ticket_code'].'" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-eye"></i></a>' ;
				$oDataTemp[] = $zAction;
				$oDataAssign[] = $oDataTemp;
				$iNombreTotal		=	$iNombreTotal + 1;
			}
			$toJson = array(
							"draw"            => intval( $_REQUEST['draw'] ),
							"recordsTotal"    => intval( $iNombreTotal/5 ),
							"recordsFiltered" => intval( $iNombreTotal /5),
							"data"            => $oDataAssign
						    );
		
			echo json_encode($toJson);
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	public function getMissionAll($_zHashModule = FALSE, $_zHashUrl = FALSE){
		$poste_agent_numero	=	$this->postGetValue ("poste_agent_numero","") ; 
		$toRubriques		=	$this->TraitementActeService->getMissionAll($poste_agent_numero);
		echo jscon_encode($toRubriques);
    }

	public function editActeFormate($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
		global $oSmarty ; 
		$oUser				= array();
		$oCandidat			= array();
		$this->checkConnexion();
		$iRet				= $this->check($oUser, $oCandidat);
		$iSessionCompte		= $this->getSessionCompte();
		$iModuleId			= 1;
		$oData							= array();
		$oData['oUser']					= $oUser;
		$oData['oCandidat']				= $oCandidat;
		$oData['zHashUrl']				= $_zHashUrl ; 
		$oData['zHashModule']			= $_zHashModule ;
	
		if($iRet == 1){	
			$oData['iUserId']			= $oUser['id'] ;
			$oData['iSessionCompte']	= $iSessionCompte ; 
			$ticket_code				= $_zHashModule ;
			$list_departement = $this->departement->get_departement();
			$oData['list_departement']  = $list_departement;
			$oData["ticket_code"]		= $ticket_code;
			$this->load_my_view_Common('traitementActe/edit_contenu.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	

	public function validerActe($ticket_code,$ticket_niveau,$oUser){
		
		$oTraitementTicket									= array();
		$oTraitementTicket["ticket_code"]					= $ticket_code  ; 
		$oTraitementTicket["ticket_date_debut"]				= date("Y-m-d H:m:s")  ; 
		$oTraitementTicket["ticket_date_fin"]				= date("Y-m-d H:m:s")  ; 
		$oTraitementTicket["ticket_date_validation"]		= date("Y-m-d H:m:s")  ; 
		$oTraitementTicket["ticket_niveau"]					= $ticket_niveau ; 
		$oTraitementTicket["ticket_utilisateur"]			= $oUser["im"] ;  
		$this->GenericCruds->insert("sgrh","t_traitement_ticket",$oTraitementTicket);
	}

	public function getVisa(){
		$ticket_code	=	$this->postGetValue ("ticket_code","") ; 
		$toVisas		=	$this->TraitementActeService->getVisa($ticket_code);

		echo json_encode($toVisas);
    }

	public function getContent(){
		
    }
	
	public function printActeFormate($_zTicketNumero = FALSE, $_zHashUrl = FALSE){
		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");
		$oTicket			=	$this->TraitementActeService->getInfoTicket($_zTicketNumero);
		$oDetailTicket		=	$this->TraitementActeService->getMouvementAgent($_zTicketNumero);
		$toRubriques		=	$this->TraitementActeService->getMissionAll($oTicket["ticket_poste_agent_numero"]);
		$zFond = PATH_ROOT_DIR .'/assets/img/fpdf/ACTE-FORMATE-ROHI-DEFINITIF-VF.jpg';

		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->SetXY(2,2);
		$pdf->Image($zFond,5,5,200);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,250);

		//ligne 01
		$pdf->SetXY(9,12);
		$pdf->Cell(10, 8, utf8_decode($oTicket["ticket_designation"]), 0);
		
		//set Numero decision
		$pdf->SetXY(35,12);
		$pdf->Cell(40, 8, $oTicket["ticket_sigle"], 0);
		
		//set portant
		$pdf->SetXY(120,12);
		$pdf->Cell(40, 8, $oTicket["mouvement_libelle"], 0);
		
		$pdf->SetXY(9,18);
		$pdf->Cell(40, 8, substr($oTicket["ticket_libelle"],0,10), 0);
		
		//set date decision
		$zDateActe			=	$oTicket["date_acte"];
		$iLengthDateActe	=	strlen($zDateActe);
		$tzDateActe			=	str_split($zDateActe);
		$iIncrement			=	0 ;
		for ($i = 1; $i <= $iLengthDateActe; $i++) {
			$pdf->SetXY(38+5.6*$iIncrement,17);
			$pdf->SetFont('Arial', '', 10);
			if ($tzDateActe[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzDateActe[$i-1]), 0);
				$iIncrement	=	$iIncrement + 1 ;
			}

		}

		//set mouvement code
		$zMouvement			=	$oTicket["ticket_processus_code"];
		$iLengthMouvement	=	strlen($zMouvement);
		$tzMouvement		=	str_split($zMouvement);
		$iIncrement			=	0 ;
		for ($i = 1; $i <= $iLengthMouvement; $i++) {
			$pdf->SetXY(195+5.6*$iIncrement,17);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzMouvement[$i-1]), 0);
			$iIncrement	=	$iIncrement + 1 ;

		}

		//set cin
		$zCin				=	str_replace(" ","",$oDetailTicket["agent_cin"]);
		$iLengthCin			=	strlen($zCin);
		$tzCin				=	str_split($zCin);
		$iIncrement			=	0 ;
		for ($i = 1; $i <= $iLengthCin; $i++) {
			$pdf->SetXY(70+5.6*$iIncrement,45);
			//$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCin[$i-1]), 0);
			$iIncrement			=	$iIncrement + 1 ;
		}

		//set matricule
		//$pdf->SetXY(25,51);	
		$zMatricule			=	$oDetailTicket["poste_agent_numero"];
		$iLengthMatricule	=	strlen($zMatricule);
		$tzMatricule		=	str_split($zMatricule);
		$iIncrement			=	0 ;
		for ($i = 1; $i <= $iLengthMatricule; $i++) {
			$pdf->SetXY(23+5.6*$iIncrement,50);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzMatricule[$i-1]), 0);
			$iIncrement			=	$iIncrement + 1 ;
			
		}
		//set nom
		$zNomPrenoms		=	$oDetailTicket["agent_nom"];
		$iLengthNom			=	strlen($zNomPrenoms);
		$tzNom				=	str_split($zNomPrenoms);
		$iIncrement			=	0 ;
		for ($i = 1; $i <= $iLengthNom; $i++) {
			if ( $iIncrement < 8 ){
				$pdf->SetXY(71+5.6*$iIncrement,51);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzNom[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}else{
				$pdf->SetXY(69+5.6*$iIncrement,51);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzNom[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
			
		}
		//set prenoms
		$zPrenoms				=	strtoupper($oDetailTicket["agent_prenoms"]);
		$iLengthPrenoms			=	strlen($zPrenoms);
		$tzPrenoms				=	str_split($zPrenoms);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthPrenoms; $i++) {
			if ( $iIncrement < 6 ){
				$pdf->SetXY(23+5.6*$iIncrement,56);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzPrenoms[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}else{
				$pdf->SetXY(20+5.6*$iIncrement,56);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzPrenoms[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
			
		}
		//set date de naissance
		$zDateNaissance			=	$oDetailTicket["date_naiss"];
		$zDateNaissance			=	$this->date_en_to_fr($zDateNaissance,'-','/'); 
		$iLengthDateNaissance	=	strlen($zDateNaissance);
		$tzDateNaissance		=	str_split($zDateNaissance);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthDateNaissance; $i++) {
			$pdf->SetXY(33+5.6*$iIncrement,61);
			$pdf->SetFont('Arial', '', 10);
			if ($tzDateNaissance[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzDateNaissance[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		//situation matrimoniale
		if ( $oDetailTicket["sit_mat"] == "1" ){
			$zSituationMatrimoniale		=	"C";
		}else{
			$zSituationMatrimoniale		=	"M";
		}
		$iLengthSituationMatrimoniale	=	strlen($zSituationMatrimoniale);
		$tzSituationMatrimoniale		=	str_split($zSituationMatrimoniale);
		$iIncrement						=	0 ;
		for ($i = 1; $i <= $iLengthSituationMatrimoniale; $i++) {
			$pdf->SetXY(114+5.6*$iIncrement,62);
			$pdf->SetFont('Arial', '', 10);
			if ($tzSituationMatrimoniale[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzSituationMatrimoniale[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//Sexe
		if ( $oDetailTicket["sexe"] == "1" ){
			$zSexe						=	"M";
		}else{
			$zSexe						=	"F";
		}
		$iLengthSexe					=	strlen($zSexe);
		$tzSexe							=	str_split($zSexe);
		$iIncrement						=	0 ;
		for ($i = 1; $i <= $iLengthSexe; $i++) {
			$pdf->SetXY(130+5.6*$iIncrement,62);
			$pdf->SetFont('Arial', '', 10);
			if ($tzSexe[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzSexe[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		//ancien position
		
		//set code budget
		$zCodeBudget			=	substr($oDetailTicket["ancien_soa_code"],0,2);
		$iLengthCodeBudget		=	strlen($zCodeBudget);
		$tzCodeBudget			=	str_split($zCodeBudget);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthCodeBudget; $i++) {
			$pdf->SetXY(24+5.6*$iIncrement,81);
			$pdf->SetFont('Arial', '', 10);
			if ($tzCodeBudget[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzCodeBudget[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//set code imputation budgetaire
		$zCodeImputation			=	"00" .$oDetailTicket["ancien_section_code"];//mbola tsy mety
		$iLengthCodeImputation		=	strlen($zCodeImputation);
		$tzCodeImputation			=	str_split($zCodeImputation);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCodeImputation; $i++) {
			$pdf->SetXY(71+5.6*$iIncrement,81);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeImputation[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set corps code
		$zCorps						=	$oDetailTicket["ancien_corps_code"];
		$iLengthCorps				=	strlen($zCorps);
		$tzCorps					=	str_split($zCorps);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCorps; $i++) {
			$pdf->SetXY(130+5.6*$iIncrement,81);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCorps[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set grade code
		$zGrade						=	$oDetailTicket["ancien_grade_code"];
		$iLengthGrade				=	strlen($zGrade);
		$tzGrade					=	str_split($zGrade);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthGrade; $i++) {
			$pdf->SetXY(183+5.6*$iIncrement,81);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzGrade[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set code fonction
		$zCodeFonction				=	$oDetailTicket["ancien_hee_code"];//mbola tsy mety
		$iLengthCodeFonction		=	strlen($zCodeFonction);
		$tzCodeFonction				=	str_split($zCodeFonction);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCodeFonction; $i++) {
			$pdf->SetXY(28+5.6*$iIncrement,87);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeFonction[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set indice
		$zIndice					=	$oDetailTicket["ancien_indice"];
		if(strlen($zIndice) == 3){
			$zIndice				=	"0".$zIndice;
		}
		$iLengthIndice				=	strlen($zIndice);
		$tzCodeIndice				=	str_split($zIndice);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthIndice; $i++) {
			$pdf->SetXY(66+5.6*$iIncrement,87);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeIndice[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set code localite de service
		$zCodeLocalite				=	$oDetailTicket["ancien_localite_service"];//mbola tsy mety
		$iLengthCodeLocalite		=	strlen($zCodeLocalite);
		$tzCodeLocalite				=	str_split($zCodeLocalite);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCodeLocalite; $i++) {
			$pdf->SetXY(114+5.6*$iIncrement,87);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeLocalite[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set mode de paiement
		$zModePaiement				=	$oDetailTicket["ancien_mode_paiement"];//mbola tsy mety
		$iLengthModePaiement		=	strlen($zModePaiement);
		$tzModePaiement				=	str_split($zModePaiement);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthModePaiement; $i++) {
			$pdf->SetXY(184+5.6*$iIncrement,87);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzModePaiement[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set numero de compte
		$zNumeroCompte				=	str_replace(" ","",$oDetailTicket["ancien_numero_compte"]) ;//mbola tsy mety
		$iLengthNumeroCompte		=	strlen($zNumeroCompte);
		$tzNumeroCompte				=	str_split($zNumeroCompte);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthNumeroCompte; $i++) {
			if($iIncrement <8){
				$pdf->SetXY(76+5.6*$iIncrement,93);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte[$i-1]), 0);
			}
			if(8 <= $iIncrement && $iIncrement < 14){
				$pdf->SetXY(75+5.6*$iIncrement,93);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte[$i-1]), 0);
			}
			if(14 <= $iIncrement && $iIncrement < 21){
				$pdf->SetXY(73+5.6*$iIncrement,93);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte[$i-1]), 0);
			}
			if(21 <= $iIncrement && $iIncrement < 26){
				$pdf->SetXY(77+5.6*$iIncrement,93);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte[$i-1]), 0);
			}
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set date d effet
		/*print_r($toRubriques);die;*/
		$zDateEffet				=	$toRubriques[0]["DATE_DEBUT"];
		$iLengthDateEffet		=	strlen($zDateEffet);
		$tzDateEffet			=	str_split($zDateEffet);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthDateEffet; $i++) {
			$pdf->SetXY(23+5.6*$iIncrement,98);
			$pdf->SetFont('Arial', '', 10);
			if ($tzDateEffet[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzDateEffet[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//nouvelle position
		
		//set code budget
		/*$zCodeBudget1			=	substr($oDetailTicket["nouveau_soa_code"],0,2);*/
		
		$zCodeBudget1			=	$oDetailTicket["nouveau_code_budget"];
		$iLengthCodeBudget1		=	strlen($zCodeBudget1);
		$tzCodeBudget1			=	str_split($zCodeBudget1);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthCodeBudget1; $i++) {
			$pdf->SetXY(24+5.6*$iIncrement,137);
			$pdf->SetFont('Arial', '', 10);
			if ($tzCodeBudget1[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzCodeBudget1[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//set code imputation budgetaire
		$zCodeImputation1			=	"00" . $oDetailTicket["nouveau_section_code"];
		$iLengthCodeImputation1		=	strlen($zCodeImputation1);
		$tzCodeImputation1			=	str_split($zCodeImputation1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCodeImputation1; $i++) {
			$pdf->SetXY(66+5.6*$iIncrement,137);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeImputation1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set corps code
		$zCorps1					=	$oDetailTicket["nouveau_corps_code"];
		$iLengthCorps1				=	strlen($zCorps1);
		$tzCorps1					=	str_split($zCorps1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCorps1; $i++) {
			$pdf->SetXY(125+5.6*$iIncrement,137);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCorps1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set grade code
		$zGrade1					=	$oDetailTicket["nouveau_grade_code"];
		$iLengthGrade1				=	strlen($zGrade1);
		$tzGrade1					=	str_split($zGrade1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthGrade1; $i++) {
			$pdf->SetXY(183+5.6*$iIncrement,137);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzGrade1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set code fonction
		$zCodeFonction1				=	$oDetailTicket["nouveau_hee_code"];
		$iLengthCodeFonction1		=	strlen($zCodeFonction1);
		$tzCodeFonction1			=	str_split($zCodeFonction1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCodeFonction1; $i++) {
			$pdf->SetXY(28+5.6*$iIncrement,143);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeFonction1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set indice
		$zIndice1					=	$oDetailTicket["nouveau_indice"];
		if(strlen($zIndice1) == 3){
			$zIndice1				=	"0".$zIndice1;
		}
		$iLengthIndice1				=	strlen($zIndice1);
		$tzCodeIndice1				=	str_split($zIndice1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthIndice1; $i++) {
			$pdf->SetXY(60+5.6*$iIncrement,143);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeIndice1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set code localite de service
		$zCodeLocalite1				=	$oDetailTicket["nouveau_localite_service"];
		$iLengthCodeLocalite1		=	strlen($zCodeLocalite1);
		$tzCodeLocalite1			=	str_split($zCodeLocalite1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthCodeLocalite1; $i++) {
			$pdf->SetXY(119+5.6*$iIncrement,142);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzCodeLocalite1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set mode de paiement
		$zModePaiement1				=	$oDetailTicket["nouveau_mode_paiement"];
		$iLengthModePaiement1		=	strlen($zModePaiement1);
		$tzModePaiement1			=	str_split($zModePaiement1);
		$iIncrement					=	0 ;
		for ($i = 1; $i <= $iLengthModePaiement1; $i++) {
			$pdf->SetXY(184+5.6*$iIncrement,143);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzModePaiement1[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//set numero de compte
		//print_r($oDetailTicket["nouveau_numero_compte"]);die;
		if ( $zModePaiement1 == "2" ){
			$zNumeroCompte1				=	str_replace(" ","",$oDetailTicket["nouveau_numero_compte"]) ;//mbola tsy mety
			$iLengthNumeroCompte1		=	strlen($zNumeroCompte1);
			$tzNumeroCompte1			=	str_split($zNumeroCompte1);
			$iIncrement					=	0 ;
			for ($i = 1; $i <= $iLengthNumeroCompte1; $i++) {
				if($iIncrement <8){
					$pdf->SetXY(76+5.6*$iIncrement,148);
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte1[$i-1]), 0);
				}
				if(8 <= $iIncrement && $iIncrement < 14){
					$pdf->SetXY(75+5.6*$iIncrement,148);
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte1[$i-1]), 0);
				}
				if(14 <= $iIncrement && $iIncrement < 21){
					$pdf->SetXY(73+5.6*$iIncrement,148);
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte1[$i-1]), 0);
				}
				if(21 <= $iIncrement && $iIncrement < 26){
					$pdf->SetXY(77+5.6*$iIncrement,148);
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(20, 8, utf8_decode($tzNumeroCompte1[$i-1]), 0);
				}
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//set date d effet
		$zDateEffet1			=	$oDetailTicket["nouveau_date_effet"];
		$zDateEffet1			=	$this->date_en_to_fr($zDateEffet1,'-','/'); 
		//print_r($zDateEffet1);die;
		$iLengthDateEffet1		=	strlen($zDateEffet1);
		$tzDateEffet1			=	str_split($zDateEffet1);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthDateEffet1; $i++) {
			$pdf->SetXY(23+5.6*$iIncrement,154);
			$pdf->SetFont('Arial', '', 10);
			if ($tzDateEffet1[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzDateEffet1[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//PRODUIT LIQUIDATION
		$toProduitLiquidation		=	$this->TraitementActeService->getProduitLiquidation($_zTicketNumero);
		$iLigne						=	0 ;
		for( $iIndex = 0; $iIndex < sizeof($toProduitLiquidation) ; $iIndex ++){
			//rubrique
			$zRubriqueCode			=	$toProduitLiquidation[$iIndex]["rubrique_code"];
			$iLengthRubriqueCode	=	strlen($zRubriqueCode);
			$tzRubriqueCode			=	str_split($zRubriqueCode);
			$iIncrement				=	0 ;
			for ($i = 1; $i <= $iLengthRubriqueCode; $i++) {
				$pdf->SetXY(23+5.6*$iIncrement,195+$iLigne);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzRubriqueCode[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
			//montant
			$zMontant				=	$toProduitLiquidation[$iIndex]["rubrique_montant"];
			$iLengthMontant			=	strlen($zMontant);
			$tzMontant				=	str_split($zMontant);
			$iIncrement				=	0 ;
			for ($i = 1; $i <= $iLengthMontant; $i++) {
				$pdf->SetXY(71+5.6*$iIncrement,195+$iLigne);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(20, 8, utf8_decode($tzMontant[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
			//date debut
			$zRubriqueDateDebut			=	$toProduitLiquidation[$iIndex]["rubrique_date_debut"];
			$iLengthRubriqueDateDebut	=	strlen($zRubriqueDateDebut);
			$tzRubriqueDateDebut		=	str_split($zRubriqueDateDebut);
			$iIncrement					=	0 ;
			for ($i = 1; $i <= $iLengthRubriqueDateDebut; $i++) {
				$pdf->SetXY(119+5.6*$iIncrement,195+$iLigne);
				$pdf->SetFont('Arial', '', 10);
				if ($zRubriqueDateDebut[$i-1] != '/') {
					$pdf->Cell(20, 8, utf8_decode($tzRubriqueDateDebut[$i-1]), 0);
					$iIncrement		=	$iIncrement + 1 ;
				}
			}
			
			//date fin
			$zRubriqueDateFin			=	$toProduitLiquidation[$iIndex]["rubrique_date_fin"];
			$iLengthRubriqueDateFin		=	strlen($zRubriqueDateFin);
			$tzRubriqueDateFin			=	str_split($zRubriqueDateFin);
			$iIncrement					=	0 ;
			for ($i = 1; $i <= $iLengthRubriqueDateFin; $i++) {
				$pdf->SetXY(162+5.6*$iIncrement,195+$iLigne);
				$pdf->SetFont('Arial', '', 10);
				if ($zRubriqueDateFin[$i-1] != '/') {
					$pdf->Cell(20, 8, utf8_decode($tzRubriqueDateFin[$i-1]), 0);
					$iIncrement		=	$iIncrement + 1 ;
				}
			}
			$iLigne						=	$iLigne + 5 ;
		}
		//NUMERO VISAS FINANCE
		$zVisaFin				=	$oDetailTicket["numero_visa_fin"];
		$iLengthVisaFin			=	strlen($zVisaFin);
		$tzVisaFin				=	str_split($zVisaFin);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthVisaFin; $i++) {
			$pdf->SetXY(23+5.6*$iIncrement,240);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzVisaFin[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//DATE VISAS FINANCE
		$zDateVisaFin			=	$oDetailTicket["date_visa_fin"];
		$iLengthDateVisaFin		=	strlen($zDateVisaFin);
		$tzDateVisaFin			=	str_split($zDateVisaFin);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthDateVisaFin; $i++) {
			$pdf->SetXY(23+5.6*$iIncrement,245);
			$pdf->SetFont('Arial', '', 10);
			if ($zDateVisaFin[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzDateVisaFin[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		
		//NUMERO VISAS CDE
		$zVisaFin				=	$oDetailTicket["numero_visa_cf"];
		$iLengthVisaFin			=	strlen($zVisaFin);
		$tzVisaFin				=	str_split($zVisaFin);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthVisaFin; $i++) {
			$pdf->SetXY(87+5.6*$iIncrement,240);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(20, 8, utf8_decode($tzVisaFin[$i-1]), 0);
			$iIncrement		=	$iIncrement + 1 ;
		}
		
		//DATE VISAS CDE
		$zDateVisaFin			=	$oDetailTicket["date_visa_cf"];
		$iLengthDateVisaFin		=	strlen($zDateVisaFin);
		$tzDateVisaFin			=	str_split($zDateVisaFin);
		$iIncrement				=	0 ;
		for ($i = 1; $i <= $iLengthDateVisaFin; $i++) {
			$pdf->SetXY(87+5.6*$iIncrement,245);
			$pdf->SetFont('Arial', '', 10);
			if ($zDateVisaFin[$i-1] != '/') {
				$pdf->Cell(20, 8, utf8_decode($tzDateVisaFin[$i-1]), 0);
				$iIncrement		=	$iIncrement + 1 ;
			}
		}
		//$_zTicketNumero
		
		//$pdf->SetXY(25,275);
		$pdf->SetY(314);
		$pdf->SetX(20);
		$pdf->SetFont('Arial', '', 4);
		$pdf->Cell(129,-50, $_zTicketNumero, 0);
		
		$pdf->Output();
	}


	public function printActeFormate_old($_zHashModule = FALSE, $_zHashUrl = FALSE){
		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");
	
		$oPdf = new FPDF();
		$oPdf->AddPage();

		$oPdf->SetAutoPageBreak(270);

		//Fields Name position
		$Y_Fields_Name_position = 20;
		//Table position, under Fie*lds Name
		$Y_Table_Position = 26;
		

		$oPdf->SetFillColor(255,255,255);
		$oPdf->AddFont('trebuc','','trebuc.php');
		$oPdf->SetFont('trebuc','',7);

		$oPdf->SetX(45);
		$oPdf->Cell(125,3,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
		$oPdf->Ln();

		$oPdf->SetX(45);
		$oPdf->SetFont('Helvetica','I');
		$oPdf->Cell(125,5,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
		$oPdf->SetFont('trebuc','');
		$oPdf->Ln();
		
		//LIGNE 01
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(30,5,'',"B",0,'C',0);

		$oPdf->SetX(40);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(5,5,'N°',0,0,'C',0);

		$oPdf->SetX(55);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(50,5,'',"B",0,'C',0);

		$oPdf->SetX(105);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,'Portant',0,0,'C',0);
		
		$oPdf->SetX(125);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(78,5,'',"B",0,'C',0);
		$oPdf->Ln();

		//LIGNE 02
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(30,5,'',0,0,'C',0);

		$oPdf->SetX(41);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(5,5,'Date',0,0,'C',0);

		$oPdf->SetX(48);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(54);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);
		
		$oPdf->SetX(60);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(66);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(72);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(78);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(84);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(90);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(96);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(5,5,'(2)',0,0,'C',0);

		$oPdf->SetX(101);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(78,5,'',"B",0,'C',0);
		
		$oPdf->SetX(181);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,'Code MVT',0,0,'C',0);
		
		$oPdf->SetX(192);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->SetX(198);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);
		$oPdf->Ln();$oPdf->Ln();
		//LIGNE 03

		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,'REFERENCES TEXTES',1,0,'C',0);
		$oPdf->Ln();

		$oPdf->SetX(10);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(190,5,'Numéro',0,0,'C',0);

		$oPdf->SetX(155);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(50,5,'Date',0,0,'C',0);
		$oPdf->Ln();
		//LIGNE 04
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(12,5,'Designation',0,0,'C',0);

		$oPdf->SetX(20);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(55,5,'',"B",0,'C',0);
		
		$position		= 68;
		for($i = 1;$i<13;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$position	= $position+10;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$oPdf->Ln();
		//LIGNE 05
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,'',0,0,'C',0);

		$oPdf->SetX(20);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(55,5,'',"B",0,'C',0);
		
		$position		= 68;
		for($i = 1;$i<13;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}
		$position	= $position+10;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}
		$oPdf->Ln();
		$oPdf->Ln();
		//LIGNE 06
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"IDENTIFICATION DE L'AGENT",1,0,'C',0);
		$oPdf->Ln();
		//LIGNE 07
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(50,5,"",0,0,'C',0);

		$oPdf->SetX(65);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(5,5,"CIN",0,0,'C',0);

		$position		= 68;
		for($i = 1;$i<13;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$oPdf->Ln();

		$oPdf->SetX(7);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,"N° Matricule",0,0,'C',0);

		$position		= 14;
		for($i = 1;$i<8;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$position   = $position + 7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,"Nom",0,0,'C',0);
		
		$position   = $position + 5;
		for($i = 1;$i<23;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$oPdf->Ln();

		//LIGNE 08
		$oPdf->SetX(4);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,"Prénom",0,0,'C',0);

		$position		= 14;
		for($i = 1;$i<32;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$oPdf->Ln();
		//LIGNE 09
		$position		= 7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(15,5,"Date de naissance",0,0,'C',0);
		
		$position	= $position+13;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$position	= $position+20;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,"Situation Matrimoniale",0,0,'C',0);
		
		$position	= $position+22;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);
		
		$position	= $position+15;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,"Sexe",0,0,'C',0);

		$position	= $position+9;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'','LRB',0,'C',0);

		$position	= $position+15;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(10,5,"N° Matricule conjointe",0,0,'C',0);

		$position	= $position+15;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}


		$oPdf->Ln();

		//LIGNE 10
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"INFORMATIONS","T",0,'C',0);
		$oPdf->Ln();
		//LIGNE 11
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(80,5,"Nombre d'enfants(-20 ans)",0,0,'C',0);
		
		$position	= 63;
		for($i = 1;$i<3;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$position	= $position+6;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(80,5,"Code logement",0,0,'C',0);

		$position	= $position+52;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'','LRB',0,'C',0);

		$position	= $position+4;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(40,5,"Code ameublement",0,0,'C',0);

		$position	= $position+37;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'','LRB',0,'C',0);
		$oPdf->Ln();

		//LIGNE 12
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,0,"","T",0,'C',0);
		$oPdf->Ln();

		//LIGNE 13
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(19,5,"Ancienne position",0,0,'C',0);

		$position	= $position + 60;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"SITUATION DE L'AGENT",0,0,'C',0);
		$oPdf->Ln();

		//LIGNE 14
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code budget",0,0,'C',0);
		
		$position	= $position + 8;
		for($i = 1;$i<3;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +25;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code imputation budgétaire",0,0,'C',0);

		$position	= $position + 17;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code corps",0,0,'C',0);

		$position	= $position +11;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +9;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code grade",0,0,'C',0);

		$position	= $position +9;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		
		$oPdf->Ln();
		//LIGNE 15
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(14,5,"Code fonction",0,0,'C',0);
		
		$position	= $position + 14;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}

		$position	= $position +7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Indice",0,0,'C',0);

		$position	= $position + 5;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}

		$position	= $position +14;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code localité de service",0,0,'C',0);

		$position	= $position +16;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}

		$position	= $position +20;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(40,5,"Mode paiement",0,0,'C',0);

		$position	= $position +34;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->Ln();
		//LIGNE 16
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(30,5,"Code Banque/Code Billeteur",0,0,'C',0);
		
		$position	= $position + 28;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(7,5,'',0,0,'C',0);
		}

		$position	= $position +7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"N° compte bancaire ou CP",0,0,'C',0);

		$position	= $position +15;
		for($i = 1;$i<21;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}

		$oPdf->Ln();

		//LIGNE 17
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(12,5,"Date d'effet",0,0,'C',0);

		$position	= $position +14;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		
		$position	= $position +15;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(12,5,"Ancienté conservé",0,0,'C',0);

		$position	= $position +15;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}

		$position	= $position +13;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Bonification",0,0,'C',0);

		$position	= $position +5;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'',1,0,'C',0);
		}
		$oPdf->Ln();

		//LIGNE 18
	
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"AVANCEMENTS-SUCCESSIFS OU RÉGULARISATION (DIFFERENTIEL)","T",0,'C',0);
		$oPdf->Ln();

		$position	= 10;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Code Corps",0,0,'C',0);

		$position	= $position + 30;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Code Grade",0,0,'C',0);

		$position	= $position + 25;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Indice",0,0,'C',0);

		$position	= $position + 30;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Date d'effet solde",0,0,'C',0);

		$position	= $position + 40;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Ancienté conservé",0,0,'C',0);

		$position	= $position + 45;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Date fin/ Date ancienté conservé",0,0,'C',0);
		$oPdf->Ln();

		//LIGNE 19

		for($iIndex=0;$iIndex<4;$iIndex++){
			$position	= -1;
			for($i = 1;$i<21;$i++){
				$position	= $position+6;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(6,5,'','LRB',0,'C',0);
			}

			$position	= $position+2;
			for($i = 1;$i<7;$i++){
				$position	= $position+6;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(6,5,'','LRB',0,'C',0);
			}

			$position	= $position+3;
			for($i = 1;$i<9;$i++){
				$position	= $position+5;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(5,5,'','LRB',0,'C',0);
			}
			$oPdf->Ln();
		}
		
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,0,"","T",0,'C',0);
		$oPdf->Ln();
		//LIGNE 20
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(19,5,"Nouvelle position",0,0,'C',0);

		$position	= $position + 60;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"",0,0,'C',0);
		$oPdf->Ln();

		//LIGNE 21
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code budget",0,0,'C',0);
		
		$position	= $position + 8;
		for($i = 1;$i<3;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +25;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code imputation budgétaire",0,0,'C',0);

		$position	= $position + 17;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code corps",0,0,'C',0);

		$position	= $position +11;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +9;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code grade",0,0,'C',0);

		$position	= $position +9;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		
		$oPdf->Ln();
		//LIGNE 22
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(14,5,"Code fonction",0,0,'C',0);
		
		$position	= $position + 14;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Indice",0,0,'C',0);

		$position	= $position + 5;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +14;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(13,5,"Code localite de service",0,0,'C',0);

		$position	= $position +16;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +20;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(40,5,"Mode paiement",0,0,'C',0);

		$position	= $position +34;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(6,5,'',1,0,'C',0);

		$oPdf->Ln();
		//LIGNE 23
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(30,5,"Code Banque/Code Billeteur",0,0,'C',0);
		
		$position	= $position + 28;
		for($i = 1;$i<5;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(7,5,'',0,0,'C',0);
		}

		$position	= $position +7;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"N° compte bancaire ou CCP",0,0,'C',0);

		$position	= $position +15;
		for($i = 1;$i<21;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$oPdf->Ln();

		//LIGNE 24
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(12,5,"Date d'effet",0,0,'C',0);

		$position	= $position +14;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		
		$position	= $position +15;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(12,5,"Ancienté conservé",0,0,'C',0);

		$position	= $position +15;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +13;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Bonification",0,0,'C',0);

		$position	= $position +5;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		$oPdf->Ln();

		//LIGNE 25
	
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"AVANTAGES FAMILIAUX","T",0,'C',0);
		$oPdf->Ln();

		$position	= 10;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"N° Acte",0,0,'C',0);

		$position	= $position + 18;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Code",0,0,'C',0);

		$position	= $position + 25;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Nom et Prénoms",0,0,'C',0);

		$position	= $position + 30;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"",0,0,'C',0);

		$position	= $position + 40;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"",0,0,'C',0);

		$position	= $position + 45;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"",0,0,'C',0);
		$oPdf->Ln();

		//LIGNE 26

		for($iIndex=0;$iIndex<4;$iIndex++){
			$position	= -1;
			for($i = 1;$i<34;$i++){
				$position	= $position+6;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(6,5,'','LRB',0,'C',0);
			}

			$oPdf->Ln();
		}
		
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"","T",0,'C',0);
		$oPdf->Ln();

		//LIGNE 27
	
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"RUBRIQUES COMPLEMENTAIRES","T",0,'C',0);
		$oPdf->Ln();

		$position	= 10;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Code Rubrique",0,0,'C',0);

		$position	= $position + 30;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(8,5,"Nombre/Jour/Année",0,0,'C',0);

		$position	= $position + 45;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"Montant",0,0,'C',0);

		$position	= $position + 45;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"Date d'ébut",0,0,'C',0);

		$position	= $position + 45;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"Date fin",0,0,'C',0);
		$oPdf->Ln();

		//LIGNE 28

		for($iIndex=0;$iIndex<4;$iIndex++){
			$position	= -1;
			for($i = 1;$i<10;$i++){
				$position	= $position+6;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(6,5,'','LRB',0,'C',0);
			}

			$position	= $position+12;
			for($i = 1;$i<7;$i++){
				$position	= $position+6;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(6,5,'','LRB',0,'C',0);
			}

			$position	= $position+10;
			for($i = 1;$i<9;$i++){
				$position	= $position+5;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(5,5,'','LRB',0,'C',0);
			}

			$position	= $position+10;
			for($i = 1;$i<9;$i++){
				$position	= $position+5;
				$oPdf->SetX($position);
				$oPdf->SetFillColor(232,232,232);
				$oPdf->Cell(5,5,'','LRB',0,'C',0);
			}
			$oPdf->Ln();
		}
		
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,0,"","T",0,'C',0);
		$oPdf->Ln();
		
		//LIGNE 29
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(50,5,"Date prise en charge",0,0,'C',0);

		$position	= $position +36;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position +32;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(50,5,"N° Comptable",0,0,'C',0);
		
		$position	= $position+40;
		for($i = 1;$i<4;$i++){
			$position	= $position+5;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(5,5,'','LRB',0,'C',0);
		}

		$oPdf->Ln();

		//LIGNE 30
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"","T",0,'C',0);

		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(150,5,"VISAS",0,0,'C',0);
		
		$position	= $position + 138;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(150,5,"",'L',0,'C',0);

		$position	= $position + 10;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(45,5,"SIGNATURE",0,0,'C',0);
		$oPdf->Ln();
		//LIGNE 31
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(199,5,"","T",0,'C',0);

		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(80,5,"FIN",0,0,'C',0);

		$position	= $position + 74;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(90,5,"",'L',0,'C',0);

		$position	= $position +20;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"CDE",0,0,'C',0);

		$position	= $position +44;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(95,5,"",'L',0,'C',0);
		
		$oPdf->Ln();

		//LIGNE 32

		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(138,5,"","T",0,'C',0);

		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"N°",0,0,'C',0);

		$position	= $position +10;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		
		$position	= $position + 28;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(90,5,"",'L',0,'C',0);

		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"N°",0,0,'C',0);

		$position	= $position +10;
		for($i = 1;$i<7;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$position	= $position + 18;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(90,5,"",'L',0,'C',0);
		$oPdf->Ln();

		//LIGNE 33

	
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"Date",0,0,'C',0);

		$position	= $position +10;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}
		
		$position	= $position + 16;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(90,5,"",'L',0,'C',0);

		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(20,5,"Date",0,0,'C',0);

		$position	= $position +10;
		for($i = 1;$i<9;$i++){
			$position	= $position+6;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(6,5,'','LRB',0,'C',0);
		}

		$oPdf->Ln();

		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(36,5,"Cachet et signature",0,0,'C',0);

		$position	= $position + 74;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(5,5,"",'L',0,'C',0);

		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(36,5,"Cachet et signature",0,0,'C',0);

		$position	= $position + 64;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->Cell(5,5,"",'L',0,'C',0);
		
		$oPdf->Ln();

		for($iIndex = 1;$iIndex<5;$iIndex++){
			$position	=  79;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(5,5,"",'L',0,'C',0);

			$position	= $position + 64;
			$oPdf->SetX($position);
			$oPdf->SetFillColor(232,232,232);
			$oPdf->Cell(5,5,"",'L',0,'C',0);
			$oPdf->Ln();
		}
	
		//LIGNE 34
		$position	= 5;
		$oPdf->SetX($position);
		$oPdf->SetFillColor(232,232,232);
		$oPdf->SetFont('Arial','B',8);
		$oPdf->Cell(49,5,"N° : 1254853726541447755552225555",0,0,'C',0);
		
		
		$oPdf->Output();
    }

	public function suivi($_zHashModule = FALSE, $_zHashUrl = FALSE){
		
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
			$params						=	array() ;
			$toListe					=	$this->TraitementActeService->getAllTicket($params);
			$torecords					=	array();
			foreach ($toListe as $oListe){
				//print_r($toListe);die;
				$oDataTemp		=	$oListe;
				$zAction = '<a title="Imprimer" alt="Imprimer" href="'.$zBasePath.'printActeFormate/'.$oData['zHashModule'].'/'.$zHashUrl.'/'.$oListe['ticket_code'].'" title="" target="_blank" class="action"><i style="color:#12105A" class="la la-print"></i></a>' ; 

				$zAction .= '<a href="'.$zBasePath.'editActeFormate/'.$oListe['ticket_code'].'" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-eye"></i></a>' ;
				$oDataTemp["action"] = $zAction;
				array_push($torecords,$oDataTemp);
			}
			$oData['iUserId']			= 	$oUser['id'] ;
			$oData['iSessionCompte']	= 	$iSessionCompte ; 
			$oData['toListe']			= 	$torecords ; 
			$this->load_my_view_Common('traitementActe/suivi.tpl',$oData, $iModuleId);	
		
		} else {
			redirect("cv/mon_cv");
		}
    }
	
	public function getPosteAgentNumero(){
		$matricule		=	$this->postGetValue ("matricule","") ; 
		$toPosteAgents	=	$this->TraitementActeService->getPosteAgentNumero($matricule);
		echo json_encode($toPosteAgents);
    }


}