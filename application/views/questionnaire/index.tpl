{include_php file=$zCssJs}
<script src="{$zBasePath}assets/message/js/mustache.js"></script><!--!-->
<link href="{$zBasePath}assets/common/css/enquete.css" rel="stylesheet">
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/common/js/jquery.canvasjs.min.js"></script>

<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>

	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Questionnaires</a></li>
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
									<!--div class="panel-body">
										<h3>ENQUÊTE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG</h3>
									</div-->
									<div class="onglet">
										
										<div class="panel-body">
											<ul class="tabs">
												<li><a href="#Repondre">Repondre la question</a></li>
												<li><a href="#Telecharger">Télecharger fiche d'enquete</a></li>
												<li><a href="#Statistiques">Statistiques</a></li>
											</ul>
											<div id="Repondre">
												{include file='application/views/questionnaire/questionnaire_dgfag_reponse.tpl'}
											</div>
											<div id="Telecharger">
												{include file='application/views/questionnaire/questionnaire_dgfag_telechargement.tpl'}
											</div>
											<div id="Statistiques" class="clearfix">
												{include file='application/views/questionnaire/questionnaire_dgfag_statistique.tpl'}
											</div>
										</div>
									</div>.               
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
	$("#innerContent" ).tabs({
		collapsible: true
	});
	var lastsel;
	$("#jqGridDownload").jqGrid({
			url: '{/literal}{$zBasePath}{literal}Questionnaire/ajaxGetResultats',
			mtype: "GET",
			datatype: "json",
			height: 250,
			width: 1500,
			multiselect:false,
			colModel: [
				{   label : 'Identifiant',	name: 'user_id', hidden:true, key: true, width: 75,editable: true},
				{   label : 'User id',	name: 'user_id', hidden:true, width: 75,editable: true},
				{   label : 'Matricule',name: 'matricule',width: 75,editable: true ,searchoptions :  { sopt : ["eq"]}  },
				{   label : 'Nom & Prenoms', name: 'nom_prenom',width: 75, editable: true, searchoptions :  { sopt : ["eq"]} },
				{	label:'Cin', 
					name: 'cin', 
					editable: true, 
					width: 75,
					searchoptions :  { sopt : ["eq"]} ,
					editoptions: {
						dataInit: function (elem) { 
							$(elem).mask("999 999 999 999"); 
						} 
					},
					hidden:true,
					//editrules:{edithidden:true}
				},
				{ label: 'Fonction', name: 'fonction_actuel',editable: true, width: 75,hidedlg: true},
				{ 
					 label:'Telephone', 
					 name: 'phone', 
					 editable: true,
					 width: 75,
					 hidden:true,
					 editrules:{edithidden:true},
				},
				{   label : "Telephone",name: 'phone',width: 75,editable: true ,hidden:false},
				{   label : "Adresse",name: 'adresse',width: 75,editable: true ,hidden:false},
				{   label : "Rang",name: 'rang',width: 75,editable: true ,hidden:false},
				{   label : "Action",name: 'action',width: 75,editable: true ,hidden:false},
			],
			viewrecords: true, // show the current page, data rang and total records on the toolbar
			pagination:true,
			pager: "#jqGridPagerDownload",
			editurl: "clientArray",
			rowNum:5,
			beforeSelectRow: function(rowid) {
			},
			onSortCol:  function(index,iCol,sortorder) {
				
			},
			beforeSelectRow: function(rowid) {
				
			},
			gridComplete: function(data, response) {
				var rows = $('#jqGrid').getDataIDs().length;
				$("#total_records").html(rows);
			},
			subGrid: true, // set the subGrid property to true to show expand buttons for each row
			subGridRowExpanded: showChildGrid// javascript function that will take care of showing the child grid

	});
});

function showChildGrid(parentRowID, parentRowKey) {
	$.ajax({
		url: '{/literal}{$zBasePath}{literal}GestionStructure/ajaxGetDetailAgent',
		type: "GET",
		data: {
			parentRowID: parentRowKey,
		},
		success: function (data) {
			//$("#" + parentRowID).append(html);
			var discussion					= JSON.parse(data);
			Mustache.tags					= ["[[", "]]"];
			var template_detail_agent		= $('#template_detail_agent').html();
			Mustache.parse(template_detail_agent);
			var rendered					= Mustache.render(template_detail_agent, {data :discussion});
			$('#'+parentRowID).append(rendered);
		}
	});
}

function showStastistique (element) {

	console.log($("#quizz_referentiel_groupe").val()) ;		
	$("#jqGridStat").jqGrid('setGridParam', { postData: {"quizz_referentiel_groupe":$("#quizz_referentiel_groupe").val(),"quizz_referentiel_value":element.val() }}).trigger('reloadGrid');
	$("#jqGridStat").jqGrid({
		url: '{/literal}{$zBasePath}{literal}Questionnaire/getRepport',
		mtype: "GET",
		datatype: "json",
		height: 100,
		width: 750,
		rowNum:5,
		autowidth :true,
		multiselect:false,
		postData:{
			quizz_referentiel_groupe:$("#quizz_referentiel_groupe").val(),
			quizz_referentiel_value:element.val()
		
		},
		colModel: [
			//{ label: '', name: 'checkbox', width: 75 ,  editable: false },
			{ label: 'N°', name: 'quiz_questions_id', width: 10 , key:true, editable: false},
			{ label: 'Question', name: 'quizz_questions_libelle_fr', width: 350 , editable: false},
			{ label: 'Pas du tout d\'accord', name: '1', width: 20,  editable: false,sorttype:'number' },
			{ label: 'Plutôt d\'accord', name: '2', width: 20,  editable: false },
			{ label: 'Tout à fait d\'accord', name: '3', width: 20 , editable: false}
		],
		viewrecords: true, // show the current page, data rang and total records on the toolbar
		pager: "#jqGridPagerStat",
		beforeSelectRow: function(rowid) {
			var selRowId = $(this).getGridParam('selrow');
			if(selRowId){
				$('#jqGridStat').jqGrid('setColProp',"phone",{editable: true}); 
			}
			 var rowKey = $("#jqGridStat").jqGrid('getGridParam',"selrow");
			 var rowData = $("#jqGridStat").jqGrid("getRowData", rowid);
			 var quizz_questions_libelle_fr	=	rowData.quizz_questions_libelle_fr;
			 showDiagramme(quizz_questions_libelle_fr,rowid);
		},
		footerrow: false,
	});
	 $('#jqGridStat').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
	 $("#jqGridStat").trigger("reloadGrid"); 
}


function showDiagramme(p_quizz_questions_libelle_fr,rowid){
	$.ajax({
		type : "POST",
		url  : "{/literal}{$zBasePath}{literal}Questionnaire/showDiagramme",
		data : {
			question_id:rowid,
		},
		success: function(data){
				var dataPoints = [];
				var toDatas	= JSON.parse(data);
				for	(var iIndex= 0;iIndex<toDatas.length;iIndex++){
					var line = {};
					line.y = toDatas[iIndex].y;
					line.name = toDatas[iIndex].name;
					dataPoints.push(line) ;
				}
				var options = {
				exportEnabled: true,
				animationEnabled: true,
				title:{
					text: p_quizz_questions_libelle_fr
				},
				legend:{
					horizontalAlign: "right",
					verticalAlign: "center"
				},
				data: [{
					type: "pie",
					showInLegend: true,
					toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
					indexLabel: "{name}",
					legendText: "{name} (#percent%)",
					indexLabelPlacement: "inside",
					dataPoints
				}]
			};
			$("#chartContainer").CanvasJSChart(options);
		}
	});
}

function getReferentiel(groupe){
	$.ajax({
		type : "POST",
		url  : "{/literal}{$zBasePath}{literal}Questionnaire/getReferentiel",
		data : {
			groupe:groupe.val(),
		},
		success: function(retours){
			var rendered					= "<option value='0'>--Choisir--</option>";
			var obj = jQuery.parseJSON(retours);
			for ( var iIndex = 0;iIndex<obj.length;iIndex++){
				console.log(obj[iIndex]);
				Mustache.tags					= ["[[", "]]"];
				var template_referentiel		= $('#template_referentiel').html();
				Mustache.parse(template_referentiel);
				rendered						= rendered + Mustache.render(template_referentiel, {data :obj[iIndex]});
			}
			$('#quizz_referentiel_value').html(rendered);
		}
	});
}
</script>
{/literal}