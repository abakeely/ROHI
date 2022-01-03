<script src="{$zBasePath}assets/easyweb/js/jquery_1.12.1.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">

<div id="innerContent">
	<div class="panel-body">
		<h3>Outil RH</h3>
	</div>
	<div class="row" id="div_localite_rapprochement">
			<div class="form col-md-3">
				<div class="libele_form">
					<label class="control-label label_rohi " data-original-title="" title=""><b>Liste des :</b></label>
				</div>
				<select onchange="getChild($(this),1)" class="form-control" placeholder="pays" name="pays" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="pays">
					<option  value="0">-------</option> 
						<option  value="RETRAITE">Agents retraités</option>
						<option  value="AVANCEMENT_DE_CLASSE">Agents ayant une avancement de classe</option>
						<option  value="AVANCEMENT_DE_ECHELLON">Agents ayant une avancement d'echellon</option>
						<option  value="DISTINCTION">Agents promouvable distinction</option>
				</select>
			</div>
	</div>
	<div class="row" id="div_resultats">
		<div class="col-xs-12" style="margin:10px 0 0 0;">
			<table id="jqGrid"></table>
			<div id="jqGridPager"></div>
		</div>
	</div>	
</div>
{literal}
	<style type="text/css">
		.ui-search-input{
			width: 200px !important;
		}
		.ui-jqgrid-sortable{
			color: #fff;
		}
	</style>
{/literal}

{literal}

<script>
$(document).ready(function(){
	$("#jqGrid").jqGrid({
		url: '{/literal}{$zBasePath}{literal}GestionStructure/ajaxGetAgentPartantRetraite',
		mtype: "GET",
		datatype: "json",
		colModel: [
			{ label: 'Identifiant', name: 'user_id', key: true, width: 75 },
			{ label: 'Matricule', name: 'matricule', width: 100,searchoptions :  { sopt : ["eq"]} },
			{ label: 'Fonction', name: 'fonction_actuel', width: 150 },
			{ label:'Nom & Prenoms', name: 'nom_prenom', width: 100 },
			{ label:'Structure', name: 'path', width: 100 },
			{ label:'Date de naissance', name: 'date_naiss', width: 100 },
			{ label:'Age', name: 'age', width: 50 },
			{ label:'Cin', name: 'cin', width: 100 },
			{ label:'Corps', name: 'corps', width: 100 }
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


</script>
{/literal}