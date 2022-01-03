{include_php file=$zCssJs}
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/common/js/jquery.canvasjs.min.js"></script>

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
														<label class="control-label label_rohi " data-original-title="" title=""><b>Type(*) </b></label>
													</div>
													<select class="form-control obligatoire" placeholder="Nom du conjoint"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nom du conjoint" onchange="showStastistique($(this))">
														<option value="0">--Choisir--</option>
														<option value="departement">Tableau recapitulatif de la declaration de patrimoine dans chaque departement</option>
														<option value="code_corps">Tableau recapitulatif de la declaration de patrimoine dans chaque code corps</option>
														<option value="code_hee">Tableau recapitulatif de la declaration de patrimoine dans chaque code HEE </option>
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
											<p id="commentaire_01" style="display:none;">Taux de participation insuffisant. Le d&eacutepartement/code corps/code HEE (en question) effectue une d&eacuteclaration de patrimoine insuffisante au niveau de ses effectifs. Un effort suppl&eacutementaire est n&eacutecessaire pour atteindre la moyenne souhait&eacutee qui est de 50%. Veuillez inciter les personnes concern&eacutees &agrave; effectuer leur d&eacuteclaration.</p>
											<p id="commentaire_02" style="display:none;">Taux de participation faible. Un effort suppl&eacutementaire est encore n&eacutecessaire pour ce d&eacutepartement/code corps/code HEE pour atteindre le taux moyen &agrave; 50%. Veuillez inciter les personnes concern&eacutees &agrave; effectuer leur d&eacuteclaration</p>
											<p id="commentaire_03" style="display:none;">Taux de participation &eacutelev&eacute. Le d&eacutepartement/code corps/code HEE a effectu&eacute le plus de d&eacuteclaration par rapport aux autres. Un taux de participation de (nombre correspondant au plus grand taux enregistr&eacute) a &eacutet&eacute enregistr&eacute au niveau du d&eacutepartement/code corps/code HEE, contrairement au d&eacutepartement/code corps/code HEE qui a effectu&eacute le taux le plus bas</p>
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
	showDiagramme("DGAI","");
	var t_list_corps ;
});

	function showStastistique (element) {
		//alert(element.val()) ;		
	    $("#jqGrid").jqGrid('setGridParam', { postData: {"type_affichage":element.val() }}).trigger('reloadGrid');
		$("#jqGrid").jqGrid({
			url: '{/literal}{$zBasePath}{literal}DeclarationPatrimoine/ajaxGetStatistiqueDeclaration',
			mtype: "GET",
			datatype: "json",
			height: 150,
			width: 750,
			rowNum:5,
			multiselect:true,
			postData:{type_affichage:element.val()},
			colModel: [
				//{ label: '', name: 'checkbox', width: 75 ,  editable: false },
				{ label: 'Corps', name: 'corps_code', width: 150 , key:true, editable: true ,searchoptions :  { sopt : ["eq"]}},
				{ label: 'DGAI', name: 'DGAI', width: 50,  editable: false,sorttype:'number',summaryType:'sum' },
				{ label: 'DGT', name: 'DGT', width: 50,  editable: false,summaryType:'sum' },
				{ label: 'DGARMP', name: 'DGARMP', width: 50 , editable: false,summaryType:'sum'},
				{ label: 'DGFAG', name: 'DGFAG', width: 50, editable: false,summaryType:'sum' },
				{ label: 'DGD', name: 'DGD', width: 50 , editable: false,summaryType:'sum'},
				{ label: 'DGCF', name: 'DGCF', width: 50, editable: false,summaryType:'sum' },
				{ label: 'Total corps', name: 'total_corps', width: 50, editable: false,summaryType:'sum' }
			],
			viewrecords: true, // show the current page, data rang and total records on the toolbar
			pager: "#jqGridPager",
			beforeSelectRow: function(rowid) {
					console.log(rowid);
				var selRowId = $(this).getGridParam('selrow');
				if(selRowId){
					$('#jqGrid').jqGrid('setColProp',"phone",{editable: true}); 
				}
				 var selectedRowIds = $('#jqGrid').jqGrid("getGridParam", 'selarrrow');
				 showDiagramme($("#column_selected").val(),rowid);
			},
			onSortCol:  function(index,iCol,sortorder) {
				if ( index !="corps_code"){
					var selectedRowIds = $('#jqGrid').jqGrid("getGridParam", 'selarrrow');
					showDiagramme(index,selectedRowIds);
					$("#column_selected").val(index) ;
				}
				
			},
			grouping: true,
			groupingView : { 
				groupField : ['DGAI'],
   				groupColumnShow : [true],
				groupText : ['<b>{0}</b>'],
				groupCollapse : false,
				groupOrder: ['asc'],
				groupSummary : [true],
				groupDataSorted : true
		    },
			footerrow: true,
			userDataOnFooter: true

		});
		 $('#jqGrid').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
		 $("#jqGrid").trigger("reloadGrid"); 
	}


	function showDiagramme(choose,rowid){
			//	console.log(pSelectedRowIds);
		if( t_list_selected_corps.includes(rowid) ){
			for( var i = 0; i < t_list_selected_corps.length; i++){ 
			   if ( t_list_selected_corps[i] === rowid) {
				 t_list_selected_corps.splice(i, 1); 
				 i--;
			   }
			}
		}else{
			t_list_selected_corps.push(rowid);
		}
		var zListCorps	=	"''";
		for (var iIndex = 0; iIndex < t_list_selected_corps.length;iIndex++ ){
			zListCorps	=	zListCorps + ","+ "'"+t_list_selected_corps[iIndex]+"'";
		}
		zListCorps	=	zListCorps + "";
		console.log(zListCorps);
		$.ajax({
			type : "POST",
			url  : "{/literal}{$zBasePath}{literal}DeclarationPatrimoine/showDiagramme",
			data : {
				departement:choose,
				list_corps:zListCorps
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
						text: choose
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
				$("#commentaire_01").show();	
			}
		});
	}

	function getCorps(corps_code){
		alert(corps_code) ;
	}
</script>
{/literal}
{include_php file=$zFooter}
		