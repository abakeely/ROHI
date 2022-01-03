{include_php file=$zCssJs}
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">Liste des Agents rattachés avec Fiche de poste, CV et Notes</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Magagement des RH</a></li>
				<li class="breadcrumb-item">CV et notes des agents rattachés</li>
			</ul>
		</div>
	</div>
</div>
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
        <div id="innerContent">
			<div id="ContentBloc">
				</div>
				<div><p>&nbsp;</p></div>
			<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-body">

									  <div class="table-responsive">
				<table id="table-liste-cv">
					<thead>
						<tr>
							<th>Id</th>
							<th>Photo</th>
							<th>Matricule</th>
							<th>CIN</th>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Localité</th>
							<th>Sanction</th>
							<th>Fiche de poste</th>
							<th style="text-align:center;">Voir CV / Notes</th>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="text" id="iMatricule" class="iMatricule searchCv" placeholder="Matricule" /></td>
							<td><input type="text" id="iCin" class="searchCv" placeholder="CIN" /></td>
							<td><input type="text" id="zNom" class="searchCv" placeholder="Nom" /></td>
							<td><input type="text" id="zPrenom" class="searchCv" placeholder="Prénom" /></td>
							<td><input type="text" id="zLocalite" class="searchCv" placeholder="Localité" /></td>
							<td><input type="text" id="zSanction" class="searchCv" placeholder="Sanction" /></td>
							<td><input type="text" id="zFicheDePoste" class="searchCv" placeholder="Fiche de poste" /></td>
							<td style="text-align:center;"><input type="button" value="Rechercher" class="btn button" id="rechercheCv"></td>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				</div>
				</div>
				</div>
			<div id="calendar"></div>
		</div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
    {include_php file=$zFooter}
</div>
<div id="dialogCV" title="Dialog Title"></div>
<div id="dialogDFP" title="Fiche de poste"></div>
{literal}
<script>
$(document).ready(function() {

	$("#table-liste-cv").on("click", ".dialog-link-fdp", function(){
		var iUserId = $(this).attr("iAgentId");
		var IIdentifiant = $(this).attr("iIdent");
		var iSearchFicheDePoste = $("#iSearchFicheDePoste_" + iUserId).val();

		if(iSearchFicheDePoste != ''){
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}accueil/saveCandidatFicheDePoste/" ,
				type: 'post',
				data: { 
					iUserId : iUserId,
					iSearchFicheDePoste : iSearchFicheDePoste,
				},
				success: function(data, textStatus, jqXHR) {
					
					alert("Enregistrement effectué");
					event.preventDefault();
					$("#manatsofoka_" + iUserId).html('<a href="#" class="dialog-view-fdp" title="Voir fiche de poste" alt="Voir fiche de poste" iAgentId="'+IIdentifiant+'"><i style="font-size:22px;" class="ace-icon la la-search bigger-110"></i></a>&nbsp;&nbsp;&nbsp;')
				},
				async: false
			});
		}
	});

	$("#dialogDFP").dialog({
			autoOpen: false,
			width: '60%',
			title: 'Fiche de poste',
			close: 'X',
			dialogClass: 'myPosition11',
			open: function(event, ui) {
				$(event.target).parent().css('position', 'absolute');
				$(event.target).parent().css('top', '100px');
			},
			resizable: false,
			modal: true,
			buttons: [{
				text: "Fermer",
				click: function() {
					$(this).dialog("close");
				}
			}]
		}); 

	$("#dialogCV").dialog({
		autoOpen: false,
		width: '80%',
		title: 'Notes évaluations',
		close: 'X',
		dialogClass: 'myPosition',
		open: function(event, ui) {
			$(event.target).parent().css('position', 'fixed');
			$(event.target).parent().css('top', '100px');
			$(event.target).parent().css('left', '10%');
		},
		modal: true,
		resizable: false,
		buttons: [{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});
	
	$("#rechercheCv").on("click",function(){
			zListeCv.ajax.reload();	
	});
	
	var zListeCv = $('#table-liste-cv').DataTable( {
		"processing": true,
		"serverSide": true,
		"searching": false,
		"footer": true,
		"columnDefs": [
			{ className: "dt-center", "targets": [8] }
		 ],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}critere/liste/agent-evaluation/ajax", // json datasource
			data: function ( d ) {
				d.iMatricule = $("#iMatricule").val(),
				d.iCin = $("#iCin").val(),
				d.zNom = $("#zNom").val(),
				d.zPrenom = $("#zPrenom").val(),
				d.zSanction = $("#zSanction").val(),
				d.zLocalite = $("#zLocalite").val(),
				d.zFicheDePoste = $("#zFicheDePoste").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		},
		drawCallback: function() {
			
			
			$(".dfpSelect2").select2
			({
				initSelection: function (element, callback)
				{
					$(".dfpSelect2").each(function () {
						
						var iId = $(this).attr("identifiant");
						var zValeur = $(this).attr("valeur");

						if (eval(iId)>0){
						
							var dataArrayAgent = [{id:iId,text:zValeur}];
							$(dataArrayAgent).each(function()
							{
								if (this.id == element.val())
								{
									callback(this);
									return
								}
							})
						}
					})
					
				},
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "{/literal}{$zBasePath}{literal}Accueil/setFicheDePosteSearch/",
					dataType: 'jsonp',
					data: function (term)
					{
						return {q: term, iFiltre:1};
					},
					results: function (data)
					{
						return {results: data};
					}
				},
				dropdownCssClass: "bigdrop"
			}) ;

			$(".dfpSelect2").each(function () {
				var iId = $(this).attr("identifiant");
				var iAgentId = $(this).attr("iAgentId");
				if (eval(iId)>0){
					$("#iSearchFicheDePoste_" + iAgentId).select2('val',iId);
				}
				
			})
			
		},
		language : {
		  sLoadingRecords : '<span style="width:100%;"><img src="{/literal}{$zBasePath}{literal}assets/accueil/images/ajaxload.gif"></span>',
		  processing: "<img src='{/literal}{$zBasePath}{literal}assets/accueil/images/w_load.gif'>"
		},  
    }); 

	$("#table-liste-cv").on("click", ".dialog-view-fdp", function(){
		$("#dialogDFP").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}accueil/getInfoUser/" + iUserId ,
			type: 'get',
			data: { 
			},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialogDFP").html(data);	
				$( "#dialogDFP" ).dialog( "open" );
				$('html, body').animate({
					scrollTop: 0
				}, 750);
				event.preventDefault();
			},
			async: false
		});

	});

	$("#table-liste-cv").on("click", ".dialog-view-note", function(){
		$('#dialogCV').dialog('option', 'title', "Notes évaluations");
		iUserId = $(this).attr("iUserId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/liste/agent-evaluation/notes",
			type: 'get',
			data: {
				iUserId:iUserId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogCV").html(data);
				$("#dialogCV").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	//$("#iCin").mask("999 999 999 999"); 
})
</script>
<style>
.select2-input {
	font-size:13px!important;
}

.select2-no-results {
	font-size:13px!important;
}

.select2-results .select2-result-label {
	padding: 3px 7px 4px;
	margin: 0;
	cursor: pointer;
	font-size: 13px!important;
}

#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
th.dt-center, td.dt-center { text-align: center; }
td { vertical-align:middle!important}

.searchCv {
	width:100%!important;
	height: 30px;
}

.dataTables_wrapper {
    overflow: auto!important;
}

.myPosition {
    position: absolute!important;
    right: 200px; /* use a length or percentage */
}

.button {
    border: 1px solid #00a4ff;
    font-family: 'Lato', Arial, Helvetica, sans-serif;
    color: #4c4b4b;
	padding:10px;
	font-size:14px;
}
#table-liste-cv td{
	width:10%!important;
}
#table-liste-cv td img{
	width: 50px;
	height: 50px;
	border-radius: 50px;
	min-width: 50px;
}
</style>
{/literal}