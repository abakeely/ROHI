{include_php file=$zCssJs}
<script src="{$zBasePath}assets/easyweb/js/jquery_1.12.1.js"></script>
<script src="{$zBasePath}assets/message/js/jquery.multi-select.js"></script>

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.multiselect.css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<input type="hidden" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
							<input type="hidden" name="iCin" autocomplete="off" id="iCin" value="{$oData.iMatricule}" placeholder="">
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
									<div class="col-md-12"> 
										<table id="jqGrid"></table>
										<div id="jqGridPager"></div>
										<div id="commentaire"><h1>Arret&eacute;e la pr&eacute;sente liste au nombre de: <span id="total_records"></span></h1></div>
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
<input type="hidden" value="" id="user_id_selected"/>
<div id="template_detail_agent" style="display:none">
	<table>
		 <tbody>
			<tr>
			   <td><b>Nom: <a class="lien_cv" target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/cv2/mon_cv?id=[[data.id]]">[[data.nom]]</a></b></td>
			   <td>Pr&eacute;noms: [[data.prenom]]</td>
			   <td>Phone: [[data.phone]]</td>
			   <td rowspan="10" valign="top"><img style="width:90px;border-radius:50px;" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.id]].[[data.type_photo]]"></td>
			</tr>
			<tr>
			   <td>Adresse: [[data.address]]</td>
			   <td>Poste:   [[data.poste]]</td>
			   <td>Domaine: [[data.domaine]]</td>
			</tr>
			<tr>
			   <td>E-mail: <a class="lien_cv"  href="mailto:[[data.email]]">[[data.email]]</a></td>
			   <td>Coprs: [[data.corps]] (Categorie: [[data.categorie]])</td>
			   <td>Grade: [[data.grade]] (Indice: [[data.indice]])</td>
			</tr>
			<tr>

			   <td>Sanction: [[data.sanction_libelle]]</td>
			   <td>Date sanction: [[data.dateSanction]]</td>
			   <td>Date prise de service: [[data.date_prise_service]]</td>
			</tr>
		</tbody>
	</table>
</div>
{include_php file=$zFooter}
{literal}
<style>
	#s2id_search_field{width:200px}
	#commentaire{
		font-size: 14px;
		margin: 20px;
	}
</style>
<script>
var extrants;
$(document).ready(function(){
	//setMask();
	$( ".datepicker" ).datepicker({
		dateFormat: "dd/mm/yy",
		showOtherMonths: true,
		selectOtherMonths: false
	});
	
	$("#jqGrid").jqGrid({
			url: '{/literal}{$zBasePath}{literal}DeclarationPatrimoine/ajaxGetPersonnalitesAssujetties',
			mtype: "GET",
			datatype: "json",
			height: 250,
			width: 1500,
			multiselect:false,
			colModel: [
				{	label: 'Matricule ou Nom & Prenoms ou CIN', 
					name: 'search_field', 
					editable: true, 
					width: 1 ,
					formoptions: { elmsuffix: ' *'},
					editoptions: {
						dataInit: function (elem) { 
							//$(elem).mask("999999"); 
							$(elem).select2({
								allowClear: true,
								placeholder:"Selectionnez",
								minimumInputLength: 3,
								multiple:false,
								formatSearching: function () { return "Recherche..."; },			
								ajax: { 
									url: "{/literal}{$zBasePath}{literal}gcap/candidatAbraham/",
									dataType: 'jsonp',
									data: function (term){
										return {q: term, iFiltre:1};
									},
									results: function (data){
										return {results: data};
									}
								},
								dropdownCssClass: "bigdrop"
							});
							$(elem).on('change', function() {
								console.log($(this).val());
								var data =	$(this).val() ;
								var tdata=	data.split(";");
								$("#matricule").val(tdata[0]);
								$("#nom_prenom").val(tdata[1] + "  "+ tdata[2]);
								$("#cin").val(tdata[3]);
								$("#user_id_selected").val(tdata[4]);
							})
						} 
					}
					//editrules:{required:true}
				},
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
				{ 
					label:'Nouvelle affectation', 
					name: 'corps', 
					editable: true,
					edittype: 'select',
					width: 75,
					editoptions: { value: getNouvelleAffectation() },
					searchoptions :  { sopt : ["eq"]}
				},
				{ label: 'Fonction', name: 'fonction_actuel',editable: true, width: 75,hidedlg: true},
				{ label:'Acte de nomination', name: 'acte_de_nomination', editable: true,width: 75,searchoptions :  { sopt : ["eq"]} },
				{ 
				  label:'Date de nomination', 
				  name: 'date_de_nomination', 
				  editable: true,
				  width: 75,
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
				{ label:'Numero de quitus', name: 'numero_quitus_bianco', hidden:true,editable: true,width: 75,searchoptions :  { sopt : ["eq"]} },
				{	
					label:'Date de quitus', 
					name: 'date_quitus_bianco',
					hidden:true, 
					editable: true,
					width: 75,
					searchoptions :  { sopt : ["eq"]} ,
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
				{ label:'E-mail', 
				  name: 'email', 
				  editable: true,
				  width: 75,
				  hidden:true,
				  editrules:{email:true,edithidden:true}
				 },
				 { 
					 label:'Telephone', 
					 name: 'phone', 
					 editable: true,
					 width: 75,
					 hidden:true,
					 editrules:{edithidden:true},
				},
				{   label : "Adresse",name: 'adresse',width: 75,editable: true ,hidden:false},
				{   label : "OrdSec",name: 'ordsec',width: 75,editable: true,hidden:false, edittype: 'select',formatter:'select', editoptions: { value: "Oui:Oui;Non:Non" }}
			],
			viewrecords: true, // show the current page, data rang and total records on the toolbar
			pagination:true,
			pager: "#jqGridPager",
			editurl: "clientArray",
			rowNum:5,
			beforeSelectRow: function(rowid) {
			},
			onSortCol:  function(index,iCol,sortorder) {
				
			},
			beforeSelectRow: function(rowid) {
				/*var selRowId = $(this).getGridParam('selrow');
				if(selRowId){
					$('#jqGrid').jqGrid('setColProp',"phone",{editable: true}); 
				}*/
			},
			gridComplete: function(data, response) {
				 // var recordCount	=	 $("#jqGrid").getGridParam("reccount");.
					  var rows = $('#jqGrid').getDataIDs().length;
					  $("#total_records").html(rows);
			},
			subGrid: true, // set the subGrid property to true to show expand buttons for each row
			subGridRowExpanded: showChildGrid// javascript function that will take care of showing the child grid

		});
	
	 $("#jqGrid").jqGrid('navGrid',"#jqGridPager",
			{
				edit:true,
				edittitle: "Modification d'un assujetties",
				add:true,
				addtitle: "Ajouter un nouveau assujetties",
				del:false,
				search:false
			} ,
			{ // edit options
				editCaption: "Modification des informations", 
				width: "1000", 
				bSubmit: "Enregistrer",
				bCancel: "Annuler",
				reloadAfterSubmit: true, 
				beforeShowForm: function(frm) { 
					$('#matricule').attr('readonly','readonly');
					$('#nom_prenom').removeAttr('readonly'); 
					$('#cin').removeAttr('readonly');
					$('#tr_search_field',frm).hide(); 
					$('#tr_adresse',frm).show(); 
					$('#tr_ordsec',frm).show(); 
					$('#tr_numero_quitus_bianco',frm).show(); 
					$('#tr_date_quitus_bianco',frm).show(); 
				},
				onclickSubmit: function(rp_ge, postdata)    {
					//var rowid = jQuery("#treegrid").getGridParam('selrow');
					jConfirm("Voulez vous vraiment modifier ces informations?", "Modification", function (callback) {
						if (callback) {
							AddPost(postdata);
						} else {
							return false;
						}
					});
				}
			}, 
			{ // add options
				addCaption: "Ajouter les informations necessaires avant d'enregistrer", 
				bSubmit: "Enregistrer",
				bCancel: "Annuler",
				width: "1000", 
				reloadAfterSubmit: true, 
				beforeShowForm: function(frm) { 
					$('#matricule').attr('readonly','readonly'); 
					$('#nom_prenom').attr('readonly','readonly'); 
					$('#cin').attr('readonly','readonly'); 
					$('#tr_phone',frm).hide(); 
					//$('#tr_email',frm).hide(); 
					$('#tr_fonction_actuel',frm).hide(); 
					$('#tr_adresse',frm).hide(); 
					$('#tr_ordsec',frm).hide(); 
				},
				onclickSubmit: function(rp_ge, postdata)    {
					AddPost(postdata);
				}
			}, 
			{ // search options
				addCaption: "Rechercher", 
				beforeShowForm: function(frm) { 
					
				}
			}
	 );
	// activate the toolbar searching
	//jQuery("#jqGrid").editGridRow( "new", {width:800,addCaption: "Add ReAAAAAAAsscord"} );
	// $("#jqGrid").jqGrid('editGridRow', "new", {addCaption: "Add ReAAAAAAAsscord"} )
     $('#jqGrid').jqGrid('filterToolbar',{restoreFromFilters : true, searchOperators : true});
	 //$("#jqGrid").jqGrid('editGridRow', {width:1500} );
	// $("#jqGrid").jqGrid('editGridRow', "new", {addCaption: "Add ReAAAAAAAsscord",} );
	/*$("#add_jqGrid").click(function () {
		$("#jqGrid").jqGrid('editGridRow', {addCaption: "Add AAAAAAAAAform"});
	});*/
	/*var recordCount	=	 $("#jqGrid").getGridParam("reccount");.
	alert(recordCount) ;*/
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
	
});



function getNouvelleAffectation(){
	
	var nouvelleAffectation = '0:Selectionner;EO2P:EO2P;E03L:E03L;N02U:N02U;N02P:N02P;N03L:N03L;E02M:E02M;N01C:N01C;E33Y:E33Y;E02U:E02U;N00C:N00C;E02K:E02K;A01B:A01B;A01C:A01C;A08A:A08A;A08B:A08B;A06A:A06A;A31B:A31B;A06D:A06D;A15A:A15A;A18A:A18A;A18B:A18B;A23D:A23D;A29A:A29A;A19B:A19B;A70A:A70A;A88C:A88C';

	/*$.ajax({
		type : "POST",
		url  : "{/literal}{$zBasePath}{literal}DeclarationPatrimoine/getNouvelleAffectation",
		data : {
		},
		success: function(data){
			nouvelleAffectation = data;
		}
	});*/
	return nouvelleAffectation ;
}

function AddPost(postData){
	//alert( $("#user_id_selected").val() );
	
	if(!postData.user_id){
		postData.user_id	=	$("#user_id_selected").val();
		postData.oper		=	"add";
	}else{
		postData.oper		=	"edit";
	}
	$.ajax({
		type : "POST",
		url  : "{/literal}{$zBasePath}{literal}DeclarationPatrimoine/saveDeclarationPatrimoine",
		data : postData,
		success: function(data){
			//window.location.href="{/literal}{$zBasePath}{literal}DeclarationPatrimoine/declarerPatrimoine" ;
		}
	});
	//return nouvelleAffectation ;
}

function rechercherPersonnalitesAssujetties(){
	extrants.ajax.reload();
}

function suprimerFilter(curent){
	curent.parents(".row").remove();
}

function setMask(){
	$(".datepicker").mask("99/99/9999");  
	$("#signataire_visa_fin").mask("999999");  
	$("#signataire_visa_cf").mask("999999");  
}

</script>
{/literal}
		