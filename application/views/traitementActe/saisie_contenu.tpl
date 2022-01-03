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
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Saise de contenu</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
		
								<div class="clear"></div>
								<div id="innerContent menu-button-inner">
									<ul class="tabs">
										<li><a href="#saisieActe">Saisie de contenu</a></li>
										<li><a href="#PiecesJointes">Pieces jointes</a></li>
										<li><a href="#Referentiels">Referentiels</a></li>
									</ul>
									<div id="saisieActe">
										{include file='application/views/traitementActe/block_saisie_contenu.tpl'}
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
	<style type="text/css">
		.form-control{font-weight: bold;font-size:13px!important;font-family: arial;}
	</style>
{/literal}
{literal}
<script>

$(document).ready(function(){
		setMask();
		//$("#ticket_code").blur();
		$("#innerContent" ).tabs({
			  collapsible: true
		});
		$( ".datepicker" ).datepicker({
			dateFormat: "dd/mm/yy",
			showOtherMonths: true,
			selectOtherMonths: false,
		});
		//$("#ticket_code").blur(function(){
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
		//});
		$('.panel_body h3').on("click", function () {
			$(this).toggleClass('open');
			$(this).parent().next().slideToggle({duration: 400, easing: "easeInOutQuart"}).toggleClass('open');
		});
});


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
					$("#"+tz_mouvement_champ[iIndex].trim()).removeAttr("readonly");
					$("#"+tz_mouvement_champ[iIndex].trim()).addClass("obligatoire");
					console.log("#"+tz_mouvement_champ[iIndex].trim());
				}
				setMask();
			}
		});
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
				$("#agent_matricule").val(resultat.matricule);
				$("#agent_nom").val(resultat.nom);
				$("#agent_prenoms").val(resultat.prenom);
				$("#agent_cin").val(resultat.cin);
				$("#agent_date_nais").val(resultat.date_naiss);
				$("#agent_adresse").val(resultat.address);
				$("#agent_situation_matrimoniale").val(resultat.agent_situation_matrimoniale);
				$("#agent_numero_tel").val(resultat.phone);
				$("#agent_sexe").val(resultat.sexe);
				$("#enfant_mineur").val(resultat.enfant_mineur);
				$("#enfant_majeur").val(resultat.enfant_majeur);
				$("#code_logement").val(resultat.code_logement);
				$("#code_ameublement").val(resultat.code_ameublement);
				$("#sanction_code").val(resultat.sanction);
				$("#ancien_section_code").val(resultat.section);
				$("#code_budget").val(resultat.code_budget);
				$("#ancien_soa_code").val(resultat.soa);
				$("#ancien_uadm_code").val(resultat.uadm);
				$("#fonction_actuel").val(resultat.fonction_actuel);
				$("#localite_service").val(resultat.localite_service);
				$("#ancien_cadre").val(resultat.cadre);
				$("#corps_code").val(resultat.corps);
				$("#categorie_code").val(resultat.categorie);
				$("#grade_code").val(resultat.grade);
				$("#indice").val(resultat.indice);
				$("#mode_paiement").val(resultat.mode_paiement);
				$("#numero_compte").val(resultat.numero_compte);
				$("#hee_code").val(resultat.hee_code);
				$("#date_entree_admin").val(resultat.date_entree_admin);
				

				$("#nouveau_enfant_mineur").val(resultat.enfant_mineur);
				$("#nouveau_enfant_majeur").val(resultat.enfant_majeur);
				$("#nouveau_code_logement").val(resultat.code_logement);
				$("#nouveau_code_ameublement").val(resultat.code_ameublement);
				$("#nouveau_sanction_code").val(resultat.sanction);
				$("#nouveau_section_code").val(resultat.section);
				$("#nouveau_soa_code").val(resultat.soa);
				$("#nouveau_uadm_code").val(resultat.uadm);
				$("#nouveau_localite_service").val(resultat.localite_service);
				$("#nouveau_fonction_actuel").val(resultat.fonction_actuel);
				$("#nouveau_cadre").val(resultat.cadre);
				$("#nouveau_corps_code").val(resultat.corps);
				$("#nouveau_code_budget").val(resultat.code_budget);
				$("#nouveau_grade_code").val(resultat.grade);
				$("#nouveau_categorie_code").val(resultat.categorie);
				$("#nouveau_indice").val(resultat.indice);
				$("#nouveau_mode_paiement").val(resultat.mode_paiement);
				$("#nouveau_numero_compte").val(resultat.numero_compte);
				$("#nouveau_hee_code").val(resultat.hee_code);
				$("#nouveau_date_debut_contrat").val(resultat.date_debut_contrat);
				$("#nouveau_date_fin_contrat").val(resultat.date_fin_contrat);
				$("#nouveau_date_sanction").val(resultat.date_sanction);
				$("#nouveau_fonction_actuel").val(resultat.nouveau_fonction_actuel);
				$("#nouveau_date_effet").val(resultat.nouveau_date_effet);
			}
		});
	}

	function saveActe(){
		var iValide = validateFields();
		var iValide =  1;
		if( iValide == 1 ){
			
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
						nouveau_cadre		: $("#nouveau_cadre").val(),
						nouveau_corps_code	: $("#nouveau_corps_code").val(),
						nouveau_grade_code	: $("#nouveau_grade_code").val(),
						nouveau_indice		: $("#nouveau_indice").val(),
						nouveau_soa_code	: $("#nouveau_soa_code").val(),
						nouveau_uadm_code	: $("#nouveau_uadm_code").val(),
						nouveau_section_code: $("#nouveau_section_code").val(),
						nouveau_date_debut_contrat	: $("#nouveau_date_debut_contrat").val(),
						nouveau_date_fin_contrat	: $("#nouveau_date_fin_contrat").val(),
						nouveau_code_budget			: $("#nouveau_code_budget").val(),
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
						iRattachement				: "",
						numero_visa_fin				: $("#numero_visa_fin").val(),
						date_visa_fin				: $("#date_visa_fin").val(),
						signataire_visa_fin			: $("#signataire_visa_fin").val(),
						numero_visa_cf				: $("#numero_visa_cf").val(),
						date_visa_cf				: $("#date_visa_cf").val(),
						signataire_visa_cf			: $("#signataire_visa_cf").val(),
						nouveau_rubriques			: $("#nouveau_rubriques").val()
					},
					success: function(data, textStatus, jqXHR) {  
						cleanFields();
						alert(" Enregistrement reussie ", 'Message de confirmation');
						/*attribuerVisa();*/
					}
			});
		}
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
		/*$("#nouveau_soa_code").mask("99-99-9-999-99999");  
		$("#nouveau_sanction_code").mask("99");  
		$("#nouveau_categorie_code").mask("99");  
		$("#nouveau_indice").mask("9999");  
		$("#nouveau_mode_paiement").mask("9");  
		$("#nouveau_numero_compte").mask("99999 999999 999 99");  
		$("#nouveau_enfant_mineur").mask("99");  
		$("#nouveau_enfant_majeur").mask("99");  
		$("#nouveau_sanction_code").mask("99");  
		$("#nouveau_date_debut_contrat").mask("99/99/9999");  
		$("#nouveau_date_fin_contrat").mask("99/99/9999");  */
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
	
	function addRub(){
		var rubrique_code		= $("#rubrique_code").val();
		var montant_rubrique 	= $("#montant_rubrique").val();
		var date_debut_rubrique = $("#date_debut_rubrique").val();
		var date_fin_rubrique	= $("#date_fin_rubrique").val();
		
		var ligne				= "<tr>";
		    ligne				= ligne + "<td>"+rubrique_code+"</td>";
		    ligne				= ligne + "<td>"+montant_rubrique+"</td>";
		    ligne				= ligne + "<td>"+date_debut_rubrique+"</td>";
		    ligne				= ligne + "<td>"+date_fin_rubrique+"</td>";
		    ligne				= ligne + "</tr>";
		$("#table_rubriques").append(ligne);

		var nouveau_rubriques	= rubrique_code +","+montant_rubrique+","+date_debut_rubrique+","+date_fin_rubrique;
		var ancien_rubriques	= $("#nouveau_rubriques").val();
		$("#nouveau_rubriques").val(nouveau_rubriques + ":" + ancien_rubriques);
		
	} 

</script>
{/literal}