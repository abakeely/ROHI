{include_php file=$zCssJs}
<script src="{$zBasePath}assets/message/js/mustache.js"></script><!--!-->
<link href="{$zBasePath}assets/common/css/enquete.css" rel="stylesheet">
<script src="{$zBasePath}assets/common/js/jquery.canvasjs.min.js"></script>

<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>

{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">Questionnaires</a></div>
		<div class="clear"></div>
		<div id="innerContent">
			<!--div class="panel-body">
				<h3>ENQUÊTE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG</h3>
			</div-->
			<div class="onglet">
				<form id="myForm" action="{$zBasePath}Questionnaire/saveQuestion" method="POST" role="form" data-toggle="validator">
					<input type="hidden" id="parent_id">
					<input type="hidden" name="structure_id" id="structure_id">
					<div class="panel-body">
						<ul class="tabs">
							<li><a href="#Repondre">Repondre la question</a></li>
							<li><a href="#Telecharger">Télecharger fiche d'enquete</a></li>
							<li><a href="#Statistiques">Statistiques</a></li>
						</ul>
						<div><p class="title-page">Enquête sur les conditions de travail au sein de la DGFAG</p></div>
						<div id="Telecharger" class="wizard-question col-md-12">
							{include file='application/views/questionnaire/questionnaire_dgfag_telechargement.tpl'}
						</div>
						<div id="Statistiques" class="wizard-question col-md-12">
							{include file='application/views/questionnaire/questionnaire_dgfag_statistique.tpl'}
						</div>
						
						<div class="panel-body" id="Repondre">
							<div class="panel-body" id="step_one" style="display:none;">
								<div class="row">
									{if $oData.enquete_effectue == "0"}
									<div id="quiz" class="wizard-question col-md-12">
										<div  class="info_item">
											<p>Nous vous remercions de bien vouloir consacrer quelques instants pour répondre à ce sondage organisé par la DGFAG. Vos réponses sont précieuses car elles permettront de dresser la situation actuelle des conditions de travail des agents de la DGFAG sur l’étendue du territoire national. Les résultats serviront de base pour mieux cibler les projets d’amélioration à mettre en place.</p>
										</div>
										<ul id="list_answers" class="info_item">
											<li><p>Isaorana ianao mba hanokana fotoana hamaliana ity fanadihadiana nokarakarain'ny DGFAG ity. Sarobidy ny valin-teninao satria hamela anay hanadihady ny fepetra ahafahan'ny mpiasa miasa eto anivon'ny DGFAG manerana ny faritany nasionaly. Ny vokatra azo dia mba hahazoana mikendry kokoa ireo tetik'asa fanatsarana hotanterahina.</p></li>
										</ul>
									</div>
									{else}
										<div id="quiz" class="wizard-question col-md-12">
											<div class="info_item">
												<p>Merci d'avoir consacré du temps pour répondre à ce questionnaire! MANKASITRAKA INDRINDRA TOMPOKO!</p>
											</div>
										</div>
									{/if }
								</div>
								{if $oData.enquete_effectue == "0"}
								<div class="row ">
									<div class=" wizard-question col-md-12">
										<div class="form col-md-3" style="display:none;">
											<select id="firstChild" onchange="getChild($(this),1)" class="form-control" placeholder="Ministere" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="choix_ministere">
												<option   value="15">DGFAG</option>
											</select>
										</div>
										<div class="row line" id="div_rap"></div>
										
										<div class="row line">
											<div class="form col-md-3">
												<input type="text" class="form-control" placeholder = "Insérer votre numéro de Porte (Facultatif) " name="porte" id="porte" value="" />
											</div>
											<div class="form col-md-3">
												<select name="lieu_de_service" class="form-control" placeholder="Sélectionner votre lieu de service"  data-toggle="tooltip"  id="lieu_de_service">
													<option selected="selected"  value="0">Sélectionner votre lieu de service</option>
													
												</select>
											</div>
											<div class="form col-md-3">
												<select name="fonction" class="form-control" placeholder="Sélectionner votre fonction"  data-toggle="tooltip"  id="fonction">
													<option  selected="selected" value="0">Sélectionner votre fonction</option>
													<option   value="128" style="background-color: #e85d09;color: #fff;">Directeur/PRMP</option>
													<option   value="129" style="background-color: #e85d09;color: #fff;">Chef de service/Coordonnateur/Chef de cellule</option>
													<option   value="130" style="background-color: #e85d09;color: #fff;">Chef de division</option>
													<option   value="131" style="background-color: #e85d09;color: #fff;">Chef de bureau</option>
													<option   value="132" style="background-color: #e85d09;color: #fff;">Chargés d'etudes</option>
													<option   value="133" style="background-color: #e85d09;color: #fff;">Comptable</option>
													<option   value="134" style="background-color: #e85d09;color: #fff;">Secrétaire</option>
													<option   value="135" style="background-color: #e85d09;color: #fff;">Opérateur de saisie</option>
													<option   value="136" style="background-color: #e85d09;color: #fff;">Chauffeur/Archiviste</option>
													<option   value="137" style="background-color: #e85d09;color: #fff;">Coursier/Fille de salle</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row" id="list_btn">
									<a class="btn_forward" onclick="suivant()">Accéder au questionnaire</a>
								</div>
								{/if}
							</div>.

							<div class="panel-body" id="step_twoo" style="display:none;">
								<div class=" wizard-question col-md-12" id="step_two">
									<div id="info_question" class="info_item">
										<p>Etes-vous en accord ou en désacord avec les affirmations suivantes</p>
										<p>Ahoana ny hevitrao mikasika ireto manaraka ireto</p>
									</div>
									<div id="list_questions" class="">
										{foreach from=$oData.toQuestions item=oQuestion }
											<div class="row col-md-12">
												<h1 class="quizz_title">{$oQuestion.quizz_questions_titre}</h1>
												<div class="form col-md-6 question_item">
													<label class="label_question_fr">N° {$oQuestion.quiz_questions_id}: &nbsp;&nbsp;{$oQuestion.quizz_questions_libelle_fr}</label></br>
													<label class="label_question_mg">{$oQuestion.quizz_questions_libelle_mg}</label>
												</div>
												<div class="form col-md-2 question_item"> 
													<label class="label_choose">Pas du tout d'accord </br><span style="font-style:italic;">Laviko</span></br><input type="radio"  value="1" name="{$oQuestion.quiz_questions_id}" onclick="showComments({$oQuestion.quiz_questions_id})" required><label>
												</div>
												<div class="form col-md-2 question_item">
													<label class="label_choose">Plutôt d'accord</br><span style="font-style:italic;">Azo ekena</span></br><input type="radio"  value="2" name="{$oQuestion.quiz_questions_id}" onclick="showComments({$oQuestion.quiz_questions_id})"><label>
												</div>
												<div class="form col-md-2 question_item">
													<label class="label_choose">Tout à fait d'accord</br> <span style="font-style:italic;">Manaiky tanteraka</span></br><input type="radio"  value="3" name="{$oQuestion.quiz_questions_id}" onclick="showComments({$oQuestion.quiz_questions_id})"><label>
												</div>
											</div>
											<div class="form info_item comments col-md-12 textarea-question" style="display:none;" id="comments_{$oQuestion.quiz_questions_id}">
													<p>Pourquoi ?</p></br><p class="label_question_mg">Hazavao ny hevitrao</p>
													<textarea class="in-lg" cols="7" rows="15" name="answer_comments_{$oQuestion.quiz_questions_id}" ></textarea>
											</div>
										{/foreach}
										<div class="row col-md-12 info_item">
											<div class="form col-md-12 question_item">
												<label>IL Y A-T-IL, PARMI LES ASPECTS CITES PRECEDEMMENT, CEUX QUI NECESSITENT DES AMELIORATIONS PRIORITAIRES AU SEIN DE LA DGFAG</label>
											</div>
											<div class="form col-md-12 last-question" >
													<p>Pourquoi?</p> <p class="label_question_mg"></br>Hazavao ny hevitrao?</p>
												<textarea cols="5" rows="5" name="first_comments" ></textarea>
											</div>
										</div>
										
										<div class="row col-md-12 info_item">
											<div class="form col-md-12 question_item">
												<label>IL Y A-T-IL D'AUTRES ASPECTS NON CITES MAIS NECESSITANT DES CHANGEMENTS AU SEIN DE LA DGFAG</label>
											</div>
											<div class="form col-md-12 last-question" >
													<p>Pourquoi?</p></br><p class="label_question_mg">Hazavao ny hevitrao</p>
												<textarea cols="5" rows="5" name="second_comments" ></textarea>
											</div>
										</div>
										<div class="row col-md-12 remerciements">
											<p>Nous vous remercions de votre collaboration</p>
											<p style="font-style: italic;">Misaotra indrindra amin'ny fiaraha-miasa</p>
										</div>
									</div>
								</div>
								<div class="row" id="list_btn">
									<input type="submit" class="btn_forward" style="margin: -10px 32px 0 0!important;" value="Soumettre les réponses">
								</div>
							</div>.
						</div>.
					</div>
				</form>
			</div>.               
		</div>
</section>
<div style="display:none;" id="template_structure" >
	<div class="form col-md-3" id="structure_niveau_[[source.niveau]]">
		<div class="libele_form">
			<label class="control-label label_questionnaire " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
		</div>
		[[#source]]
		<select id="structure_de_rattachement" class="form-control structure"   onChange="getChild($(this),[[source.niveau]]);"   name="">
			<option  value="0">Sélectionner votre structure de rattachement</option> 
			[[#list]]
			  <option value="[[child_id]]" style="background-color: #e85d09;color: #fff;">[[child_libelle]]</option>
			[[/list]]
		</select>
		[[/source]]
	</div>
</div>
<div style="display:none;" id="template_site" >
	<option  value="0">Sélectionner votre lieu de travail</option> 
	[[#source]]
		[[#list]]
			<option style="background-color: #e85d09;color: #fff;" value="[[site_id]]">[[site_libelle]]</option>
		[[/list]]
	[[/source]]
</div>
<div id="block_rattachement" style="display:none">
	
</div>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>

</form>
{include_php file=$zFooter}
</div>
{literal}

<script>
$(document).ready(function(){
	$("#innerContent" ).tabs({
		collapsible: true
	});
	$("#firstChild").change();
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
	$("#step_one").show();
});
function getChild(curent_element,niveau){
	var val_curent_element = curent_element.val() ;
	$("#parent_id").val(val_curent_element);
	$("#structure_id").val(val_curent_element);
	//get list child
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}GestionStructure/getChild/",
		type: 'post',
		data: {
			parent_id	: val_curent_element,
			tree_type	: "1",//CHILD DIRECT: 1 ,  CHILD HIERACHIQUE: 2 
			district_id:$("#district_id").val()
		},
		success: function(data, textStatus, jqXHR) {  
			for( var iIndex = niveau+1;iIndex<20;iIndex++){
				$('#structure_niveau_'+iIndex).remove();
			}
			data = data.replace("not allowed ", "");
			var donnees					=	JSON.parse(data);
			if(donnees.length > 0){
				var structure				= {};
				structure.libelle			= "Structure de rattachement";
				structure.list				= donnees;
				structure.niveau			= niveau+1;
				Mustache.tags				= ["[[", "]]"];
				var template_structure		= $('#template_structure').html();
				
				Mustache.parse(template_structure);
				var rendered				= Mustache.render(template_structure, {source :structure});
				$('#div_rap').append(rendered);
				
			}
		}
	});
	//get list site
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}Questionnaire/do_get_sites/",
		type: 'post',
		data: {
			child_id	: val_curent_element,
		},
		success: function(data, textStatus, jqXHR) {  
			var donnees						=	JSON.parse(data);
			if(donnees.length > 0){
				var structure				= {};
				structure.list				= donnees;
				Mustache.tags				= ["[[", "]]"];
				var template_site			= $('#template_site').html();
				Mustache.parse(template_site);
				var rendered				= Mustache.render(template_site, {source :structure});
				$('#lieu_de_service').html(rendered);
				
			}
		}
	});
}

function suivant(){
	var isFormValide 	= 0 ;
	var fonction 		= $("#fonction").val() ;
	//var porte 			= $("#porte").val() ;
	var lieu_de_service = $("#lieu_de_service").val() ;
	var structure_de_rattachement = $("#structure_de_rattachement").val() ;
	
	if(structure_de_rattachement==0){
		 $("#structure_de_rattachement").addClass("obligatoire") ;
		  return false;
	}else{
		$("#structure_de_rattachement").removeClass("obligatoire") ;
	}
	/*if(!porte){
		 $("#porte").addClass("obligatoire") ;
		  return false;
	}else{
		$("#porte").removeClass("obligatoire") ;
	}*/
	
	if(lieu_de_service==0){
		 $("#lieu_de_service").addClass("obligatoire") ;
		  return false;
	}else{
		$("#lieu_de_service").removeClass("obligatoire") ;
	}
	
	if(fonction == 0){
		 $("#fonction").addClass("obligatoire") ;
		 return false;
	}else{
		$("#fonction").removeClass("obligatoire") ;
	}

	$("#step_one").hide();
	$("#step_twoo").show();
}

function showComments(p_question_id){
	$("#comments_"+p_question_id).show();
	//$("#step_twoo").show();
}

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
		cmTemplate: {
			search:false,
		},
		search:false,
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
</body>
</html>