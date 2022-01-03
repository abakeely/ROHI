<script src="{$zBasePath}assets/easyweb/js/primitives.min.js"></script>
<link href="{$zBasePath}assets/easyweb/css/primitives.css" rel="stylesheet">

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<script src="{$zBasePath}assets/easyweb/js/jstree.min.js"></script>

<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jstree.css" rel="stylesheet">

<link href="{$zBasePath}assets/easyweb/css/jquery.multiselect.css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>
<input type="hidden" id="iTrimestreActif" value="{$oData.iTrimestreActif}"/>
<div  id="div_list_agent">
	<table id="jqGrid"></table>
	<div id="jqGridPager"></div>
</div>

<div id="template_detail_agent" style="display:none">
	<table>
		 <tbody>
			<tr>
				<td rowspan="5"  class="colum_photo" valign="top"><img style="width:90px;border-radius:50px;" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.id]].[[data.type_photo]]"></td>
			   <td><b>Nom: <a class="lien_cv" target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/cv2/mon_cv?id=[[data.id]]">[[data.nom]]</a></b></td>
			   <td>Pr&eacute;noms: [[data.prenom]]</td>
			   <td>Phone: [[data.phone]]</td>
			   
			   <td>Montant 563 [[data.date_interval_0]]&nbsp;&nbsp;:&nbsp;&nbsp;  <b style="font-weight:bold;">[[data.montant_55563_0]] Ar</b></td>
			   <td><b style="font-weight:bold;">&nbsp;</td>
			   
			</tr>
			<tr>
			   <td>Soa: [[data.soa]]</td>
			   <td>Poste:   [[data.poste]]</td>
			   <td>Date prise de service:[[data.date_prise_service]]</td>
			   <td>Montant 563 [[data.date_interval_1]]&nbsp;&nbsp;:&nbsp;&nbsp;  <b style="font-weight:bold;">[[data.montant_55563_1]] Ar</b></td>
			   <td><b style="font-weight:bold;">&nbsp;</td>
			</tr>
			<tr>
			   <td>Categorie:[[data.categorie]]</td>
			   <td>Coprs: [[data.corps]]--Cadre: [[data.cadre]]</td>
			   <td>Grade: [[data.grade]] (Indice: [[data.indice]])</td>
			   <td>Montant 563 [[data.date_interval_2]]&nbsp;&nbsp;:&nbsp;&nbsp;  <b style="font-weight:bold;">[[data.montant_55563_2]] Ar</b></td>
			   <td>&nbsp;</td>
			</tr>
		
			<tr>
			   <td>Age :[[data.age]]</td>
			   <td>Cin: [[data.cin]]</td>
			   <td>Structure de rattachement: [[data.path]]</td>
			   <td>&nbsp;</td>
			   <td>&nbsp;</td>
			</tr>
			<tr>
			   <td>Sanction: [[data.sanction_libelle]]</td>
			   <td>Date de naissance :[[data.date_naiss]]</td>
			   <td>Statut :[[data.statut]]</td>
			   <td>&nbsp;</td>
			   <td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
</div>

{literal}
<style>
	.lien_cv {
		color:blue !important;
	}
	.lien_cv:hover {
		color:blue !important;
	}
	.soptclass {
		color:blue !important;
	}
	.clearsearchclass {
		color:blue !important;
	}
	.ui-icon-closethick {
		color:blue !important;
	}
	.btn{
		height: 27px !important;
	}
	.bold-column{
		font-weight: bold !important;
		color:red;
	}
	#jqgh_jqGrid_note01{
		font-weight: bold !important;
	}
	.ui-th-column-header,.ui-th-ltr{
		font-size: 10px !important;
		text-transform: capitalize;
	}
	.colum_photo{
		width: 8% !important;
	}
	th.active{
		font-size: 12px !important;
		background-color:#123356!important;
	}
</style>

<script type='text/javascript'>
    $(document).ready(function () {
		var iTrimestreActif = $("#iTrimestreActif").val();
		//alert(iTrimestreActif);
		var iStructure		= $("#iTrimestreActif").val();
		loadAgent(iStructure,iTrimestreActif);
    });
 
	function loadAgent(structure,trimestre){
			
		$("#jqGrid").jqGrid("clearGridData", true);
		var dataurl		=	"{/literal}{$zBasePath}{literal}Criteres/ajaxGetAgent";
		//alert(dataurl);
		var lastsel;
		$("#jqGrid").jqGrid({
			url: dataurl,
			mtype: "GET",
			datatype: "json",
			postData: { structure:structure},
			colModel: [
				{ label:'Matricule', name: 'matricule', width: 50,searchoptions :  { sopt : ["eq"]} , editable: false },
				{ label:'Exercice', name: 'exercice', width: 50,searchoptions :  { sopt : ["eq"]} , editable: false },
				{ label:'User id', name: 'user_id',key: true,  hidden:true, width: 70 },
				{	label : "Groupe",
					name: 'groupe',
					width: 75,
					editable: true,
					hidden:false, 
					edittype: 'select',
					formatter:'select', 
					editoptions: { 
						value: "GROUPE1:Gpr 1;GROUPE2:Gpr 2" ,
						dataInit: function (elem) { 
							
						}
					}, 
					align: 'center'
				},
				{ 
					label:'Nom & Prenoms',
					name: 'nom', 
					width: 180,
					searchoptions :  { sopt : ["eq"]} , 
					editable: false 
				},

				{ 
					label:'<label title="Valeur g&eacute;n&eacute;rale">Val.Gle</label>', 
					name: 'critere011', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center',
					formatter:genericFormatter,
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 1){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Capacit&eacute; professionnelle">Cap.Pro</label>', 
					name: 'critere021', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center',
					formatter:genericFormatter,
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 1){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Efficacit&eacute;">Eff</label>', 
					name: 'critere031', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center',
					formatter:genericFormatter,
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 1){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Maniere de servir">Man.Serv</label>', 
					name: 'critere041', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center',
					formatter:genericFormatter,
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 1){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'Note', 
					name: 'note01', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: false, 
					align: 'center',
					classes: "bold-column",
					editoptions: { 
						dataInit: function (elem) { 
							$(elem).attr("readonly","true");
						}
					}
				},

				{	
					label:'<label title="Valeur g&eacute;n&eacute;rale">Val.Gle</label>', 
					name: 'critere012', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 2){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Capacit&eacute; professionnelle">Cap.Pro</label>', 
					name: 'critere022', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 2){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Efficacit&eacute;">Eff</label>', 
					name: 'critere032', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 2){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Maniere de servir">Man.Serv</label>', 
					name: 'critere042', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 2){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{
					label:'Note', 
					name: 'note02', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: false, 
					align: 'center', 
					classes: "bold-column",
					editoptions: { 
						dataInit: function (elem) { 
							$(elem).attr("readonly","true");
						}
					}
				},
				{
					label:'<label title="Valeur g&eacute;n&eacute;rale">Val.Gle</label>', 
					name: 'critere013', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 3){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Capacit&eacute; professionnelle">Cap.Pro</label>', 
					name: 'critere023', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 3){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Efficacit&eacute;">Eff</label>', 
					name: 'critere033', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 3){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Maniere de servir">Man.Serv</label>', 
					name: 'critere043',
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} ,
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 3){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'Note', 
					name: 'note03', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: false, 
					align: 'center', 
					classes: "bold-column",
					editoptions: { 
						dataInit: function (elem) { 
							$(elem).attr("readonly","true");
						}
					}
				},
				{ 
					label:'<label title="Valeur g&eacute;n&eacute;rale">Val.Gle</label>', 
					name: 'critere014', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 4){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Capacit&eacute; professionnelle">Cap.Pro</label>', 
					name: 'critere024', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 4){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{
					label:'<label title="Efficacit&eacute;">Eff</label>', 
					name: 'critere034', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, 
					align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 4){
								$(elem).removeAttr("readonly");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'<label title="Maniere de servir">Man.Serv</label>', 
					name: 'critere044', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: true, align: 'center', 
					editoptions: { 
						dataInit: function (elem) { 
							if(trimestre == 4){
								$(elem).attr("readonly","false");
							}else{
								$(elem).attr("readonly","true");
							}
							
						}
					}
				},
				{ 
					label:'Note', 
					name: 'note04', 
					width: 50 ,
					searchoptions :  { sopt : ["eq"]} , 
					editable: false, 
					align: 'center', 
					classes: "bold-column",
					editoptions: { 
						dataInit: function (elem) { 
							$(elem).attr("readonly","true");
						}
					}
				}
			],
			viewrecords: true,
			width: 1525,
			height: 250,
			rowNum: 5,
			scroll: false,
			subGrid: true, // set the subGrid property to true to show expand buttons for each row
            subGridRowExpanded: showChildGrid, // javascript function that will take care of showing the child grid
			pager: "#jqGridPager",
			editurl :"{/literal}{$zBasePath}{literal}Criteres/majEvaluation",
			onSelectRow: function(id){
				if(id && id!==lastsel){
					var rowKey = $("#jqGrid").jqGrid('getGridParam',"selrow");
					$("#agent_selectionner").val(rowKey) ;
					$('#jqGrid').jqGrid('restoreRow',lastsel);
					$('#jqGrid').jqGrid('editRow',id,{keys:  true});
					alert(id);
					lastsel=id;
				}
			},
			grouping: true,
			groupingView: {
				groupField: ["exercice"],
				groupColumnShow: [true],
				groupText: ["<b>{0}</b>"],
				groupOrder: ["asc"],
				groupSummary: [true],
				groupCollapse: false
			},
			loadonce: false,
			cellurl: "{/literal}{$zBasePath}{literal}Criteres/majEvaluation",
            cellEdit: true,
			cellsubmit: 'remote', 
            sortable: true,
            ignoreCase: true,
			gridComplete: function(data, response) {
				if(trimestre == 1){
					$(".head_group_1").parent().addClass("active");
				}else{
					$(".head_group_1").parent().removeClass("active");
				}
				if(trimestre == 2){
					$(".head_group_2").parent().addClass("active");
				}else{
					$(".head_group_2").parent().removeClass("active");
				}
				if(trimestre == 3){
					$(".head_group_3").parent().addClass("active");
				}else{
					$(".head_group_3").parent().removeClass("active");
				}
				if(trimestre == 4){
					$(".head_group_4").parent().addClass("active");
				}else{
					$(".head_group_4").parent().removeClass("active");
				}
			},
			beforeEditCell(rowid, cellname, value, iRow, iCol){
				var value = $('#jqGrid').jqGrid('getCell', rowid, 'groupe');
				if( value === "GROUPE1" ){
					$("#jqgh_jqGrid_critere011").html("Val.Gle");
					$("#jqgh_jqGrid_critere021").html("Cap.Pro");
					$("#jqgh_jqGrid_critere031").html("Eff");
					$("#jqgh_jqGrid_critere041").html("Man.Serv");
				}
				if( value === "GROUPE2" ){
					$("#jqgh_jqGrid_critere011").html("Cap Prof");
					$("#jqgh_jqGrid_critere021").html("Assi");
					$("#jqgh_jqGrid_critere031").html("Sens Dis");
					$("#jqgh_jqGrid_critere041").html("Soin Exec");
				}
			},
			afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
				$("#jqGrid").jqGrid().setGridParam({url :dataurl,postData:{ child_id:structure.id} } ).trigger("reloadGrid");
				if( cellname === "groupe" ){
					if( value === "GROUPE1" ){
						$("#jqgh_jqGrid_critere011").html("Val.Gle");
						$("#jqgh_jqGrid_critere021").html("Cap.Pro");
						$("#jqgh_jqGrid_critere031").html("Eff");
						$("#jqgh_jqGrid_critere041").html("Man.Serv");
					}
					if( value === "GROUPE2" ){
						$("#jqgh_jqGrid_critere011").html("Cap Prof");
						$("#jqgh_jqGrid_critere021").html("Assi");
						$("#jqgh_jqGrid_critere031").html("Sens Dis");
						$("#jqgh_jqGrid_critere041").html("Soin Exec");
					}
				}
				//$("#jqGrid").jqGrid("setGridParam", { datatype: "json" } ).trigger("reloadGrid", [{ current: true }]);
			},
		});

		// activate the toolbar searching
        //$('#jqGrid').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
		$("#jqGrid").jqGrid('navGrid',"#jqGridPager", {edit: false, add: false, del: false,search:true,position:"left",transaction:"left"},{bSubmit: "Enregistrer",bCancel: "Annuler"},{bSubmit: "Enregistrer",bCancel: "Annuler"});

		$('#jqGrid').jqGrid('setGroupHeaders', {
			  useColSpanStyle: false, 
			  groupHeaders:[
				{startColumnName: 'critere011', numberOfColumns: 5, titleText: '<p class="head_group_1">1-Premier Trimestre<p>&nbsp;</p>'},
				{startColumnName: 'critere012', numberOfColumns: 5, titleText: '<p class="head_group_2">2-Deuxieme Trimestre<p>&nbsp;</p>'},
				{startColumnName: 'critere013', numberOfColumns: 5, titleText: '<p class="head_group_3">3-Troisieme Trimestre<p>&nbsp;</p>'},
				{startColumnName: 'critere014', numberOfColumns: 5, titleText: '<p class="head_group_4">4-Quatrieme Trimestre<p>&nbsp;</p>'},
			  ]
		});
	}

	function genericFormatter(cellvalue, options, rowObject) {
		if(cellvalue<0 || cellvalue >5){
			alert("valeur interdite");
			return 0;
		}else{
			return cellvalue;
		}
		$("#jqGrid").jqGrid().setGridParam({url :dataurl,postData:{ child_id:""} } ).trigger("reloadGrid");
	} 
	
	// the event handler on expanding parent row receives two parameters
    // the ID of the grid tow  and the primary key of the row
	function showChildGrid(parentRowID, parentRowKey) {
		$.ajax({
			url: '{/literal}{$zBasePath}{literal}Criteres/ajaxGetDetailAgent',
			type: "GET",
			data: {
				parentRowID: parentRowKey,
			},
			success: function (data) {
				//$("#" + parentRowID).append(html);
				var discussion					= JSON.parse(data);;
				Mustache.tags					= ["[[", "]]"];
				var template_detail_agent		= $('#template_detail_agent').html();
				Mustache.parse(template_detail_agent);
				var rendered					= Mustache.render(template_detail_agent, {data :discussion});
				$('#'+parentRowID).append(rendered);
			}
		});
	}

	function mesTransactions() {
		alert("mesTransactions.");
	}
	function mesArchives() {
		alert("mesArchives");
	}

  </script>
{/literal}