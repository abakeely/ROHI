{include_php file=$zCssJs}
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">

<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Gestion des absences</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Suivi des actes</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">

										<div id="saisieActe">
										<div class="panel-body">
											<h3>Ajouter les informations n&eacute;cessaire avant de t&eacute;l&eacute;charger le formulaire</h3>
										</div>
										<div class="col-xs-6">
											<div class="row">
												<div class="form col-md-8">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Nom du conjoint(*) </b></label>
													</div>
													<input id="nom_conjointe" type="text" class="form-control obligatoire" placeholder="Nom du conjoint"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nom du conjoint"  id="nom_conjointe" value="{$oData['oConjointe'].nom}">
												</div>
												<div class="form col-md-4">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Pr&eacute;noms du conjoint(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Pr&eacute;noms du conjoint"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Pr&eacute;noms du conjoint"  id="prenom_conjointe" value="{$oData['oConjointe'].prenom}">
												</div>
											</div>
											<div class="row">
												<div class="form col-md-12">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Fonction(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Fonction"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Fonction"  id="fonction_conjointe" value="{$oData['oConjointe'].fonction}">
												</div>
											</div>
											<div class="row">
												<div class="form col-md-12">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Adresse(*) </b></label>
													</div>
													<textarea class="form-control" id="adresse_conjointe" name="zLocalite" style="width:100%;height:110px;" value="{$oData['oConjointe'].adresse}"></textarea>
												</div>
											</div>
											<div class="row">
												<div class="form col-md-6">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Date  de naissance(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire datepicker" placeholder="Date  de naissance"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Date  de naissance"  id="date_naissance_conjointe" value="{$oData['oConjointe'].date_naissance}">
												</div>
												<div class="form col-md-6">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Lieu de naissance</b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Lieu de naissance"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Lieu de naissance"  id="lieu_naissance_conjointe" value="{$oData['oConjointe'].lieu_naissance}">
												</div>
											</div>
											<div class="row">
												<div class="form col-md-4">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>CIN(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="CIN"  name="" data-placement="top" data-toggle="tooltip" data-original-title="CIN"  id="cin_conjointe" value="{$oData['oConjointe'].cin}">
												</div>
												<div class="form col-md-4">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Date delivrance</b></label>
													</div>
													<input type="text" class="form-control obligatoire datepicker" placeholder="Date delivrance"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nom du conjoint"  id="date_delivrance_conjointe" value="{$oData['oConjointe'].date_delivrance}">
												</div>
												<div class="form col-md-4">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Lieu delivrance</b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Lieu delivrance"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Lieu delivrance"  id="lieu_delivrance_conjointe" value="{$oData['oConjointe'].lieu_delivrance}">
												</div>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="row">
												<div class="form col-md-4">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Nombre d'enfants(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Nombre d'enfants"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nombre d'enfants"  id="" value="">
												</div>
											</div>
											<div class="row">
											<table id="jqGrid"></table>
											<div id="jqGridPager"></div>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-4">
												<a class="form-control btn-primary bouton" onclick="telechargerFormulaireDeclaration()" type="submit"/>Telecharger</a>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-4">
												<a class="form-control btn-primary bouton" onclick="saveInformationConjointe()" type="submit"/>Valider</a>
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
<div id="message_telechargement">Votre formulaire a &eacute;t&eacute; t&eacute;l&eacute;charg&eacute; avec succ&egrave;s! vous pouvez exp&eacute;dier votre fiche au BIANCO sise &agrave; la villa "PISCINE" Ambohibao. Vous pouvez &eacute;galement la r&eacute;tourner aupr&egrave;s de la DRH qui se chargera son exp&eacute;dition aupr&egrave;s du BIANCO apr&egrave;s la consolidation</div>
</div>
{literal}
<script>
$(document).ready(function() {
	$( ".datepicker" ).datepicker({
		dateFormat: "dd/mm/yy",
		showOtherMonths: true,
		selectOtherMonths: false
	});
	setMask();
	var lastsel;
	$("#jqGrid").jqGrid({
		url: '{/literal}{$zBasePath}{literal}DeclarationPatrimoine/ajaxGetEnfantsAssujetties',
		mtype: "GET",
		datatype: "json",
		height: 150,
		width: 750,
		colModel: [
			{ label: 'Identifian', name: 'id', width: 75, key:true,hidden:true },
			{ label: 'Nom et prenoms', name: 'nom_prenoms', width: 175,  editable: true },
			{ label: 'Sexe', name: 'sexe', width: 90 , editable: true,edittype: 'select',editoptions: { value: "Homme:Homme;Femme:Femme" }},
			{	  label: 'Date de naissance',
				  name: 'date_de_naissance', 
				  width: 100, 
				  editable: true ,
				  editoptions: {
						dataInit: function (elem) { 
							$( elem).datepicker({
								dateFormat: "dd/mm/yy",
								showOtherMonths: true,
								selectOtherMonths: false
							});
						} 
				  },
			},
			{ label: 'Lieu de naissance', name: 'lieu_de_naissance', width: 80 , editable: true},
			{ label: 'Activit&eacute;', name: 'activite', width: 80, editable: true }
		],
		viewrecords: true, // show the current page, data rang and total records on the toolbar
		pager: "#jqGridPager",
		editurl :"{/literal}{$zBasePath}{literal}DeclarationPatrimoine/saveInformationEnfants",
		onSelectRow: function(id){
			if(id && id!==lastsel){
				jQuery('#jqGrid').jqGrid('restoreRow',lastsel);
				jQuery('#jqGrid').jqGrid('editRow',id,true);
				lastsel=id;
			}
		}
	}).navGrid('#jqGridPager', {edit: true, add: true, del: false,search:false },{bSubmit: "Enregistrer",bCancel: "Annuler"},{bSubmit: "Enregistrer",bCancel: "Annuler"});
});


function setMask(){
	$("#cin_conjointe").mask('999 999 999 999');  
}
function saveInformationConjointe(){
	 var nom				= $("#nom_conjointe").val() ;
	 var prenom				= $("#prenom_conjointe").val() ;
	 var fonction			= $("#fonction_conjointe").val() ;
	 var adresse			= $("#adresse_conjointe").val() ;
	 var date_naissance		= $("#date_naissance_conjointe").val() ;
	 var cin				= $("#cin_conjointe").val() ;
	 var date_delivrance	= $("#date_delivrance_conjointe").val() ;
	 var lieu_delivrance	= $("#lieu_delivrance_conjointe").val() ;
	 var lieu_naissance		= $("#lieu_naissance_conjointe").val() ;
	 $.ajax({
		type : "POST",
		url  : "{/literal}{$zBasePath}{literal}DeclarationPatrimoine/saveInformationConjointe",
		data : {
			nom				:nom,
			prenom			:prenom,
			fonction		:fonction,
			adresse			:adresse,
			date_naissance :date_naissance,
			cin				:cin,
			date_delivrance :date_delivrance,
			lieu_delivrance :lieu_delivrance,
			lieu_naissance  :lieu_naissance
		},
		success: function(data){
			jAlert("Votre d&eacute;claration de patrimoine a &eacute;t&eacute; bien enregistr&eacute;e au BIANCO. Nous vous remercions de votre participation &agrave; la lutte contre la corruption. Veuillez, vous adresser a la porte 250 bis pour r&eacute;cup&eacute;rer votre quitus num&eacute;ro: automatique selon les num&eacute;ros attribu&eacute;s par le BIANCO","Message") ;
		}

	});
}

function telechargerFormulaireDeclaration(){
	var form	=	"<form id='form_downlod_formulaire' action='{/literal}{$zBasePath}{literal}DeclarationPatrimoine/ajaxTelechargerFormulaire' >" ;
		form	=	form + "<input type='text' >" ;
		form	=	form + "</form>" ;
		$("body").append(form) ;
		$("#form_downlod_formulaire").submit() ;
}

</script>
{/literal}
{include_php file=$zFooter}
		