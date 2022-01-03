{include_php file=$zCssJs}
<script src="{$zBasePath}assets/easyweb/js/jquery_1.12.1.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
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

								<div class="col-xs-12" style="margin:10px 0 0 0;">
									<table id="jqGrid"></table>
									<div id="jqGridPager"></div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<a class="form-control btn-primary bouton" target="_blank" onclick="imprimerEtatDeclaration()" type="submit"/>Imprimer etat</a>
									</div>
									<div class="col-md-2">
										<a class="form-control btn-primary bouton" onclick="showStatDeclaration()" type="submit"/>Sortir Statistiques</a>
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
<script>
	var dataPlan = {$oData.jsonData};
</script>
<div class="modal fade" id="formulaireDeclaration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
		<div class="modal-content" style="height:100%">
			<div class="modal-body" id="bodyFormulaireDeclaration" style="text-align: center;">
				<h3> Ajouter les informations necessaires avant d'enregistrer</h3>
				<div class="row">
					<div class="col-md-10">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Nouvelle Affectation</b></label>
						</div>
						<input type="text" class="form-control" placeholder="Nouvelle Affectation"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="col-md-10">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Acte de Nomination</b></label>
						</div>
						<input type="text" class="form-control" placeholder="Acte de Nomination"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="col-md-10">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b>Date de Nomination</b></label>
						</div>
						<input type="text" class="form-control" placeholder="Date de Nomination"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="" value="">
					</div>
					<div class="col-md-10" style="margin:0 auto;">
						<a class="form-control btn-primary bouton" onclick="attribuerVisa()" type="submit"/>Enregistrer</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{include_php file=$zFooter}
{literal}

<script>
$(document).ready(function(){
	$("#jqGrid").jqGrid({
		url: '{/literal}{$zBasePath}{literal}DeclarationPatrimoine/ajaxGetPersonnalitesAssujetties',
		mtype: "GET",
		datatype: "json",
		colModel: [
			{ label: 'Identifiant', name: 'user_id', key: true, width: 75 },
			{ label: 'Matricule', name: 'matricule', width: 150,searchoptions :  { sopt : ["eq"]} },
			{ label: 'Fonction', name: 'fonction_actuel', width: 150 },
			{ label:'Nom & Prenoms', name: 'nom_prenom', width: 150 },
			{ label:'Acte de nomination', name: 'acte_de_nomination', width: 150 },
			{ label:'Date de nomination', name: 'date_de_nomination', width: 150 },
			{ label:'Numero de quitus Bianco', name: 'numero_quitus_bianco', width: 150 },
			{ label:'Date de quitus Bianco', name: 'date_quitus_bianco', width: 150 }
		],
		viewrecords: true,
		width: 1525,
		height: 250,
		rowNum: 20,
		scroll: false,
		pager: "#jqGridPager",
		beforeSelectRow: function(rowid) {
			//var selRowId = $(this).getGridParam('selrow');
			$("#user_id_selected").val("") ;
			$("#user_id_selected").val(rowid) ;
		}
	});
  // activate the toolbar searching
  $('#jqGrid').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
});
function showFormDeclaration(){
	$("#formulaireDeclaration").modal();
}

function imprimerEtatDeclaration(){
	$("#form_downlod_formulaire").remove() ;
	var user_id_selected	=	$("#user_id_selected").val();
	var action	=	"{/literal}{$zBasePath}{literal}DeclarationPatrimoine/printEtatDeclaration/"+user_id_selected;
	var form	=	"<form target='_blank' id='form_downlod_formulaire' action='"+action+"' >" ;
		form	=	form + "<input type='hidden' name='user_id' value='"+user_id_selected+"'>" ;
		form	=	form + "</form>" ;
		$("body").append(form) ;
		$("#form_downlod_formulaire").submit() ;
		$("#user_id_selected").val("");
}

</script>
{/literal}
		