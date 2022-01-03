{include_php file=$zCssJs}
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<script src="{$zBasePath}assets/message/js/mustache.js"></script>
<link href="{$zBasePath}assets/common/css/enquete.css" rel="stylesheet">
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
						<div class="col-xs-12">
							<div class="box">
								<div class="clear"></div>
								<div id="innerContent">
									<div id="saisieActe">
										<div class="panel-body">
											<h3>ENQUÊTE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG</h3>
										</div>
										<div class="col-xs-6">
											<table id="jqGrid"></table>
											<div id="jqGridPager"></div>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-4">
												<a class="form-control btn-primary bouton" onclick="telechargerFormulaireDeclaration()" type="submit"/>Telecharger</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="message_telechargement">
				Votre formulaire a &eacute;t&eacute; t&eacute;l&eacute;charg&eacute; avec succ&egrave;s! vous pouvez exp&eacute;dier votre fiche au BIANCO sise &agrave; la villa "PISCINE" Ambohibao. Vous pouvez &eacute;galement la r&eacute;tourner aupr&egrave;s de la DRH qui se chargera son exp&eacute;dition aupr&egrave;s du BIANCO apr&egrave;s la consolidation
			</div>	
        </div>
		<!-- /Page Wrapper -->
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
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<script>
$(document).ready(function() {
	var lastsel;
	$("#jqGrid").jqGrid({
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
			pager: "#jqGridPager",
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

</script>
{/literal}