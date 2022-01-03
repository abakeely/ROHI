{include_php file=$zCssJs}
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/common/js/jquery.canvasjs.min.js"></script>

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">

	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Suivi des actes</li>
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
									<div id="saisieActe">
										<div class="panel-body">
											<h3>Ajouter les informations n&eacute;cessaire avant de t&eacute;l&eacute;charger le formulaire</h3>
										</div>
										<div class="col-xs-6">
											<div class="row">
												<div class="form col-md-8">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Type(*) </b></label>
													</div>
													<select class="form-control obligatoire" placeholder="Nom du conjoint"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nom du conjoint" onchange="showStastistique($(this))">
														<option value="0">--Choisir--</option>
														<option value="departement">Direction du budget</option>
														<option value="code_corps">Direction de la gestion des effectifs des agents de l'Etat</option>
														<option value="code_hee">Direction de la Solde et des pensions</option>
														<option value="code_hee">Direction du patrimoine de l'Etat</option>
														<option value="code_hee">Personne responsable des Marchés Publics</option>
														<option value="code_hee">Services rattachés</option>
														<option value="code_hee">Rattachement Direct à la DGFAG</option>
													</select>
												</div>
											</div>
											<div class="row">
												<table id="jqGrid"></table>
												<div id="jqGridPager"></div>
											</div>
										</div>
										<div class="col-xs-6">
											<div id="chartContainer" style="height: 370px; width: 100%;"></div>

										</div>
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
		<input type="hidden" id="column_selected" value="DGAI">
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<style>
	#source_donnee{
		font-size: 14px;
		margin: 20px;
	}
</style>
<script>
		var t_list_selected_corps =[];

$(document).ready(function() {
	//showStastistique ("");
	//showDiagramme("DGAI","");
	var t_list_corps ;
});

	function showStastistique (element) {
		//alert(element.val()) ;		
	    $("#jqGrid").jqGrid('setGridParam', { postData: {"type_affichage":element.val() }}).trigger('reloadGrid');
		$("#jqGrid").jqGrid({
			url: '{/literal}{$zBasePath}{literal}Questionnaire/getRepport',
			mtype: "GET",
			datatype: "json",
			height: 150,
			width: 750,
			rowNum:5,
			multiselect:false,
			postData:{type_affichage:element.val()},
			colModel: [
				//{ label: '', name: 'checkbox', width: 75 ,  editable: false },
				{ label: 'Question', name: 'quiz_questions_id', width: 150 , key:true, editable: false},
				{ label: 'Question', name: 'quizz_questions_libelle_fr', width: 150 , editable: false},
				{ label: 'Pas du tout d\'accord', name: '1', width: 20,  editable: false,sorttype:'number' },
				{ label: 'Plutôt d\'accord', name: '2', width: 20,  editable: false },
				{ label: 'Tout à fait d\'accord', name: '3', width: 20 , editable: false}
			],
			viewrecords: true, // show the current page, data rang and total records on the toolbar
			pager: "#jqGridPager",
			beforeSelectRow: function(rowid) {
				var selRowId = $(this).getGridParam('selrow');
				if(selRowId){
					$('#jqGrid').jqGrid('setColProp',"phone",{editable: true}); 
				}
				 var rowKey = $("#jqGrid").jqGrid('getGridParam',"selrow");
				 console.log(rowKey);
				 showDiagramme(rowid);
			},
			footerrow: false,
			userDataOnFooter: true

		});
		 $('#jqGrid').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
		 $("#jqGrid").trigger("reloadGrid"); 
	}


	function showDiagramme(rowid){
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
						text: "Question"
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

</script>
{/literal}