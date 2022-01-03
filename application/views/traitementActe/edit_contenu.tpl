{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Agents > Situation irrégulière</h3> *}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item">Modification acte</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
		
								<div class="clear"></div>
								<div id="innerContent">
									<ul class="tabs">
										<li><a href="#saisieActe">Saisie de contenu</a></li>
										<li><a href="#PiecesJointes">Pieces jointes</a></li>
										<li><a href="#Referentiels">Referentiels</a></li>
									</ul>
									<div id="saisieActe">
										{include file='application/views/traitementActe/block_edit_contenu.tpl'}
									</div>
									<div id="PiecesJointes">
										{include file='application/views/traitementActe/block_pieces_jointes.tpl'}
									</div>
									<div id="Referentiels">
										{include file='application/views/traitementActe/block_referentiels.tpl'}
									</div>
									
									
								</div>      
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}       

{literal}

<script>

$(document).ready(function(){
		setMask();
		$("#innerContent" ).tabs({
			  collapsible: true
		});
		$( ".datepicker" ).datepicker({
			dateFormat: "dd/mm/yy",
			showOtherMonths: true,
			selectOtherMonths: false,
		});
		$("#ticket_code").blur(function(){
			var ticket_code = $("#ticket_code").val();
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}TraitementActe/getInfoTicket/",
				type: 'post',
				data: {
					ticket_code:ticket_code
				},
				success: function(data, textStatus, jqXHR) {
					var data				=	JSON.parse(data);
					$("#ticket_designation").val(data.ticket_designation);
					$("#ticket_libelle").val(data.ticket_libelle);
					$("#ticket_processus_code").val(data.ticket_processus_code);

					var poste_agent_numero	=	data.ticket_poste_agent_numero;
					getInfoAgent(poste_agent_numero);

					var mouvement_code		=	data.ticket_processus_code;
					getInfoFields(mouvement_code);
				}
			});
		});
});


	function addRattachement(elmt){
		$("#curent_structure_selected").val(elmt.val());
		var	rattachement =				  '<div class="structure_rattachement">';

			rattachement = rattachement + '<div><input type="radio" class="rattachement"  name="rattachement" value="DEPT"><label for="Departement">Departement</label></div>';
			rattachement = rattachement +'<div><input type="radio" class="rattachement" name="rattachement" value="DIR"><label for="Direction">Direction</label></div>';
			rattachement = rattachement +'<div><input type="radio" class="rattachement" name="rattachement" value="SER"><label for="Service">Service</label></div>';
			rattachement = rattachement +'<div><input type="radio" class="rattachement" name="rattachement" value="DIV"><label for="Division">Division</label></div>';
			rattachement = rattachement +'</div>';

			rattachement = rattachement +'<select class="form-control" >';
			rattachement = rattachement +'<option>--Choisir--</option>';
			rattachement = rattachement +'</select>';
			

			$("#block_01").html(rattachement);
	}

	


	function saveActe(){
		
		var iValide = validateFields();
		if( iValide == 1 ){
			var iRattachement = $('select[name="iRattachement[]"]').map(function(){ 
				return this.value; 
			}).get();
			$.ajax({
					url: "{/literal}{$zBasePath}{literal}TraitementActe/majDerniereSituation",
					type: 'post',
					data: {
						poste_agent_numero	: $("#poste_agent_numero").val(),
						ticket_code			: $("#ticket_code").val(),
						ticket_niveau		: $("#ticket_niveau").val(),
						mouvement_code		: $("#ticket_processus_code").val(),
						niveau_mouvement	: "SAISIE",
						nouveau_date_effet	: $("#nouveau_date_effet").val(),
						statut				: "SAISIE",
						nouveau_corps_code	: $("#nouveau_corps_code").val(),
						nouveau_grade_code	: $("#nouveau_grade_code").val(),
						nouveau_indice		: $("#nouveau_indice").val(),
						nouveau_soa_code	: $("#nouveau_soa_code").val(),
						nouveau_uadm_code	: $("#nouveau_uadm_code").val(),
						nouveau_section_code: $("#nouveau_section_code").val(),
						nouveau_date_debut_contrat	: $("#nouveau_date_debut_contrat").val(),
						nouveau_date_fin_contrat	: $("#nouveau_date_fin_contrat").val(),
						nouveau_localite_service	: $("#nouveau_localite_service").val(),
						nouveau_fiv_code			: $("#nouveau_fiv_code").val(),
						nouveau_region_code			: $("#nouveau_region_code").val(),
						nouveau_sanction_code		: $("#nouveau_sanction_code").val(),
						nouveau_hee_code			: $("#nouveau_hee_code").val(),
						nouveau_categorie_code		: $("#nouveau_categorie_code").val(),
						nouveau_mode_paiement		: $("#nouveau_mode_paiement").val(),
						nouveau_numero_compte		: $("#nouveau_numero_compte").val(),
						nouveau_departement			: $("#departement").val(),
						nouveau_direction			: $("#direction").val(),
						nouveau_service				: $("#service").val(),
						iRattachement				: iRattachement,
					},
					success: function(data, textStatus, jqXHR) {  
						cleanFields();
						jAlert(" Enregistrement reussie ", 'Message de confirmation');
					}
			});
		}
	}

	function getInfoAgent(poste_agent_numero){ticket_code
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getInfoAgent/",
			type: 'post',
			data: {
				poste_agent_numero:poste_agent_numero
			},
			success: function(data, textStatus, jqXHR) {
				var resultat = JSON.parse(data);
				$("#poste_agent_numero").val(resultat.poste_agent_numero);
				$("#agent_matricule").val(resultat.agent_matricule);
				$("#agent_nom").val(resultat.agent_nom);
				$("#agent_prenoms").val(resultat.agent_prenoms);
				$("#agent_cin").val(resultat.agent_cin);
				$("#agent_date_nais").val(resultat.agent_date_nais);
				$("#agent_adresse").val(resultat.agent_adresse);
				$("#agent_situation_matrimoniale").val(resultat.agent_situation_matrimoniale);
				$("#agent_numero_tel").val(resultat.agent_numero_tel);
				$("#agent_sexe").val(resultat.agent_sexe);
				$("#enfant_mineur").val(resultat.enfant_mineur);
				$("#enfant_majeur").val(resultat.enfant_majeur);
				$("#code_logement").val(resultat.code_logement);
				$("#code_ameublement").val(resultat.code_ameublement);
				$("#sanction_code").val(resultat.sanction_code);
				$("#section_code").val(resultat.section_code);
				$("#code_budget").val(resultat.code_budget);
				$("#soa_code").val(resultat.soa_code);
				$("#fonction_actuel").val(resultat.fonction_actuel);
				$("#localite_service").val(resultat.localite_service);
				$("#corps_code").val(resultat.corps_code);
				$("#categorie_code").val(resultat.categorie_code);
				$("#grade_code").val(resultat.grade_code);
				$("#categorie_code").val(resultat.categorie_code);
				$("#indice").val(resultat.indice);
				$("#mode_paiement").val(resultat.mode_paiement);
				$("#numero_compte").val(resultat.numero_compte);
				$("#hee_code").val(resultat.hee_code);
				$("#date_entree_admin").val(resultat.date_entree_admin);
				

				$("#nouveau_enfant_mineur").val(resultat.enfant_mineur);
				$("#nouveau_enfant_majeur").val(resultat.enfant_majeur);
				$("#nouveau_code_logement").val(resultat.code_logement);
				$("#nouveau_code_ameublement").val(resultat.code_ameublement);
				$("#nouveau_sanction_code").val(resultat.sanction_code);
				$("#nouveau_section_code").val(resultat.section_code);
				$("#nouveau_soa_code").val(resultat.soa_code);
				$("#nouveau_localite_service").val(resultat.localite_service);
				$("#nouveau_fonction_actuel").val(resultat.fonction_actuel);
				$("#nouveau_corps_code").val(resultat.corps_code);
				$("#nouveau_corps_code").change();
				$("#nouveau_grade_code").val(resultat.grade_code);
				$("#nouveau_categorie_code").val(resultat.categorie_code);
				$("#nouveau_indice").val(resultat.indice);
				$("#nouveau_mode_paiement").val(resultat.mode_paiement);
				$("#nouveau_numero_compte").val(resultat.numero_compte);
				$("#nouveau_hee_code").val(resultat.hee_code);
				$("#nouveau_date_debut_contrat").val(resultat.date_debut_contrat);
				$("#nouveau_date_fin_contrat").val(resultat.date_fin_contrat);
				$("#nouveau_date_sanction").val(resultat.date_sanction);
				$("#nouveau_fonction_actuel").val(resultat.nouveau_fonction_actuel);
				$("#nouveau_date_effet").val(resultat.nouveau_date_effet);
				$("#departement_edit").val(resultat.departement);
				$("#direction_edit").val(resultat.direction);
				$("#service_edit").val(resultat.service);
			
				setRapprochement();
			}
		});
	}

	function getInfoFields(mouvement_code){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getFields/",
			type: 'post',
			data: {
				mouvement_code: mouvement_code
			},
			success: function(data, textStatus, jqXHR) {
				var mouvement_champ     = data;
				var tz_mouvement_champ  = mouvement_champ.split(";");
				for (var iIndex = 0;iIndex<tz_mouvement_champ.length ;iIndex++ ){
					$("#nouveau_"+tz_mouvement_champ[iIndex].trim()).removeAttr("readonly");
					$("#nouveau_"+tz_mouvement_champ[iIndex].trim()).addClass("obligatoire");
				}
				setMask();
			}
		});
	}

	function getMissionAll(poste_agent_numero){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}TraitementActe/getMissionAll/",
			type: 'post',
			data: {
				poste_agent_numero: poste_agent_numero
			},
			success: function(data, textStatus, jqXHR) {
				var resultat = JSON.parse(data);
			}
		});
	}

	function ajouterRubrique(){
		var ligne =         '<div class="row">';
		var ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Code Rubrique(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Code Rubrique"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		    ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Nombre/Jour/Annee(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Nombre/Jour/Annee"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Montant(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Montant"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="col-sm-3">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date debut(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date debut"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="col-sm-3">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date fin(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date fin"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		$("#table_rubriques").append(ligne);
	} 

	function ajouterAvancement(){
		var ligne =         '<div class="row">';
		var ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Code Corps(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Code Corps"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		    ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Code Grade(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Code Grade"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Indice(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Indice"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date d\'effet solde(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date d\'effet solde"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Anciente conserve(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

			ligne = ligne + '<div class="row1">';
			ligne = ligne + '<div class="libele_form">'
			ligne = ligne +	'<label class="control-label label_rohi " data-original-title="" title=""><b>Date fin/ Date anciente conserve(*) </b></label>'
			ligne = ligne +	'</div>'
			ligne = ligne +	'<input type="text" class="form-control" placeholder="Date fin/ Date anciente conserve"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">'
			ligne = ligne +'</div>';

		$("#table_avancements").append(ligne);
	} 
	
	function validateFields(){
		
		var iValide = 1;
		$(".obligatoire").each (function (){
			if($(this).val()=="" || $(this).val()=="--select--"){
				$(this).addClass("required");
				iValide = 0;
			}else{
				$(this).removeClass("required");
			}
		}) ;

		return iValide;
	}

	function setMask(){
		$(".datepicker").mask("99/99/9999");  
		$("#nouveau_soa_code").mask("99-99-9-999-99999");  
		$("#nouveau_sanction_code").mask("99");  
		$("#nouveau_categorie_code").mask("99");  
		$("#nouveau_indice").mask("9999");  
		$("#nouveau_mode_paiement").mask("9");  
		$("#nouveau_numero_compte").mask("99999 999999 999 99");  
		$("#nouveau_enfant_mineur").mask("99");  
		$("#nouveau_enfant_majeur").mask("99");  
		$("#nouveau_sanction_code").mask("99");  
		$("#nouveau_date_debut_contrat").mask("99/99/9999");  
		$("#nouveau_date_fin_contrat").mask("99/99/9999");  
	}

	function setRapprochement(){

		var departement_edit			= $("#departement_edit").val();
		var direction_edit				= $("#direction_edit").val();
		var service_edit				= $("#service_edit").val();
		//change departement
		$("#departement option").each (function (){
			//si niveau 02 est une direction
			if( $(this).val() == departement_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}

		}) ;
		
		//change niveau 02
		$("#structure_2 option").each (function (){
			//si niveau 02 est une direction
			if( $(this).val() == "DIR_"+direction_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
			//si niveau 02 est une service
			if( $(this).val() == "SER_"+service_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
		}) ;

		//change niveau 03
		$("#structure_3 option").each (function (){
			//si niveau 03 est une direction
			if( $(this).val() == "DIR_"+direction_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
			//si niveau 03 est une service
			if( $(this).val() == "SER_"+service_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
		}) ;

		//change niveau 04
		$("#structure_4 option").each (function (){
			//si niveau 04 est une direction
			if( $(this).val() == "DIR_"+direction_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
			//si niveau 04 est une service
			if( $(this).val() == "SER_"+service_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
		}) ;
	}


	function setSubCategory(p_categoryTable,p_categoryField,p_categoryValue,p_subCategory_id){
		$("#"+p_subCategory_id).html("");
		var html = "";
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}Referentiel/getSubCategory/",
			type: 'post',
			data: {
				p_categoryTable: p_categoryTable,
				p_categoryField: p_categoryField,
				p_categoryValue: p_categoryValue
			},
			success: function(data, textStatus, jqXHR) {  
				var resultats = JSON.parse(data);
				for ( var iIndex = 0; iIndex<resultats.length ;iIndex++  ){
					html = html + "<option value='"+resultats[iIndex].grade_code+"'>"+resultats[iIndex].indice +"-" +resultats[iIndex].grade_code+"</option>";
				}
				$("#"+p_subCategory_id).html(html);
				return false;
			}
		}); 
	}

	function cleanFields(){
		$(".form-control").each (function (){
			$(this).val("");
		}) ;
	}


</script>
{/literal}