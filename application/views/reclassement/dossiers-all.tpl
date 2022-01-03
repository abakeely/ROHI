{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{if $oData.iActif==1}
								<h3 class="page-title"> Les reclassements de l'année en cours </h3>
								{elseif $oData.iActif==2}
								<h3 class="page-title"> Les fichiers joints  </h3>
								{else}
								<h3 class="page-title"> Suivits et circuits de dossiers  </h3>
								{/if}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Les dossiers</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="col-xs-12">
							<div class="box">
			
								<div class="col-xs-12">
										{if $oData.iSave==1}
										<table>
											<tr>
												<td style="text-align:center;color:red;font-size:14px;">Enregistrement effectué</td>
											</tr>
										</table>
										{/if}
										<table id="table-liste-reclassement" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th>Matricule</th>
												<th>Nom et prénom</th>
												<th class="hidde">Departement</th>
												<th class="hidde">Direction</th>
												<th class="hidde">Service</th>
												<th>Reclassement</th>
												<th class="center" width="100">Action</th>
											</tr>
										</thead>
										{*
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toInfoReclassement)>0}
											{foreach from=$oData.toInfoReclassement item=oInfoReclassement }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oInfoReclassement.matricule}</td>
												<td>{$oInfoReclassement.nom}&nbsp;{$oInfoReclassement.prenom}</td>
												<td class="hidde">{$oInfoReclassement.sigle_departement}</td>
												<td class="hidde">{$oInfoReclassement.sigle_direction}</td>
												<td class="hidde">{$oInfoReclassement.sigle_service}</td>
												<td class="showw">{$oInfoReclassement.sigle_direction}</td>
												<td>
												- Date Envoi : {$oInfoReclassement.reclassement_dateEnvoi|date_format:"%d/%m/%Y"}<br/><br/>
												- Catégorie d'origine : {$oInfoReclassement.reclassement_categorieOrigine}<br/><br/>
												- Catégorie d'accueil : {$oInfoReclassement.reclassement_categorieAccueil}<br/><br/>
												- Domaine : {$oInfoReclassement.reclassement_domaine}<br/><br/>
												</td>
												<td class="center">
												{if $oData.iActif==1}
												<a title="Consulter" alt="Consulter" href="#" title="" iUserId="{$oInfoReclassement.user_id}" iReclassementId="{$oInfoReclassement.reclassement_id}" class="action dialog-link"><i style="font-size:22px;color:#12105A" class="la la-edit"></i></a>
												<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oInfoReclassement.reclassement_id}" class="action suppr"><i style="font-size:22px;color: #F10610;" class="la la-close"></i></a>
												{/if}
												{if $oData.iActif==2}
												<a title="fichier-joint" alt="fichier-joint" href="#" title="" iUserId="{$oInfoReclassement.user_id}" iReclassementId="{$oInfoReclassement.reclassement_id}" class="action dialog-join"><i style="font-size:22px;color:#12105A" class="la la-paperclip"></i></a>
												{/if}
												{if $oData.iActif==3}
												<a title="Suivi et Circuit" alt="Suivi et Circuit" href="#" title="" iUserId="{$oInfoReclassement.user_id}" iReclassementId="{$oInfoReclassement.reclassement_id}" class="action suivi-circuit"><i style="font-size:22px;color:#12105A" class="la la-exchange"></i></a>
												</td>
												{/if}
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
										*}
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>	
        </div>
		<!-- /Page Wrapper -->
		<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
			<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
			<input type="hidden" name="iElementId" id="iValueId" value="">
		</form>
		<div id="dialog000" title="Dialog Title"></div>
		<div id="dialog1111" title="Dialog Title"></div>
		<div id="dialog2222" title="Dialog Title"></div>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}
			

{literal}
<script>
$(document).ready(function() {
	//$('#table-liste-reclassement').DataTable();
	$("#dialog000").dialog({
		autoOpen: false,
		width: '70%',
		modal:true,
		title: 'Modification reclassement d\'un agent',
		close: 'X',
		open: function () {
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length;
			};
		},
		modal: true,
		buttons: [{
					text: "Valider",
					click: function() {

						iRet = 1 ;
						$(".obligatoire").each (function ()
						{
							$(this).parent().removeClass("error");
							if($(this).val()=="")
							{
								$(this).parent().addClass("error");
								 iRet = 0 ;
							}
						}) ;

						$("#iUserSearchMessage").parent().removeClass("error");
						if($("#iUserSearchId").select2 ('val') == '')
						{	
							iRet = 0 ;
							$("#iUserSearchMessage").parent().addClass("error");
						}
						else
						{ 
							$("#iUserSearchMessage").parent().removeClass("error");
						}

						$("#iInstitutSearchMessage").parent().removeClass("error");
						if($("#iInstituId").select2 ('val') == '')
						{	
							iRet = 0 ;
							$("#iInstitutSearchMessage").parent().addClass("error");
						}
						else
						{ 
							$("#iInstitutSearchMessage").parent().removeClass("error");
						}

						$("#iDiplomeSearchMessage").parent().removeClass("error");
						if($("#iDiplomeId").select2 ('val') == '')
						{	
							iRet = 0 ;
							$("#iDiplomeSearchMessage").parent().addClass("error");
						}
						else
						{ 
							$("#iDiplomeSearchMessage").parent().removeClass("error");
						}
						
						if (iRet == 1){
							var $form = $("#formulaireEdit");
							var formdata = (window.FormData) ? new FormData($form[0]) : null;
							var data = (formdata !== null) ? formdata : $form.serialize();
							$.ajax({
								url: $form.attr('action'),
								type: $form.attr('method'),
								contentType: false, // obligatoire pour de l'upload
								processData: false, // obligatoire pour de l'upload
								dataType: 'json', // selon le retour attendu
								data: data,
								success: function (response) {
									$("#dialog2222").dialog("close");
									document.location.href = "{/literal}{$zBasePath}{literal}reclassement/gestion/gestion-reclassement/dossiers?iSave=1";
								}
							});
						}
					}
				},{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});

	$("#dialog1111").dialog({
		autoOpen: false,
		width: '70%',
		title: 'Pièces jointes reçues',
		close: 'X',
		modal: true,
		buttons: [{
					text: "Valider",
					click: function() {
						var $form = $("#pieceJointeSubmit");
						var formdata = (window.FormData) ? new FormData($form[0]) : null;
						var data = (formdata !== null) ? formdata : $form.serialize();
						$.ajax({
							url: $form.attr('action'),
							type: $form.attr('method'),
							contentType: false, // obligatoire pour de l'upload
							processData: false, // obligatoire pour de l'upload
							dataType: 'json', // selon le retour attendu
							data: data,
							success: function (response) {
								$("#dialog1111").dialog("close");
							}
						});
					}
				},{
					text: "Fermer",
					click: function() {
						$("#dialog1111").dialog("close");
					}
				}]
	});


	$("#dialog2222").dialog({
		autoOpen: false,
		width: '70%',
		title: 'Circuit et Suivi dossier',
		close: 'X',
		modal: true,
		buttons: [{
					text: "Valider",
					click: function() {
						
						var zMessage='';
						$('.suiviClass').each(function() {
							if ($(this).is(':checked')==true){
								var iSuiviId = $(this).attr('iSuiviId'); 
								var zDate = $("#dateSuivi_"+iSuiviId).val();
								if (zDate == ''){
									zMessage += '- Veuillez entrer la date du ' +  $("#contentLibelle_"+iSuiviId).html() + "\n";
								}
							}
						})

						if (zMessage!=''){
							alert(zMessage); 
						} else {
							var $form = $("#getCircuitUpdateUser");
							var formdata = (window.FormData) ? new FormData($form[0]) : null;
							var data = (formdata !== null) ? formdata : $form.serialize();
							$.ajax({
								url: $form.attr('action'),
								type: $form.attr('method'),
								contentType: false, // obligatoire pour de l'upload
								processData: false, // obligatoire pour de l'upload
								dataType: 'json', // selon le retour attendu
								data: data,
								success: function (response) {
									$("#dialog2222").dialog("close");
								}
							});
						}
					}
				},{
					text: "Fermer",
					click: function() {
						$("#dialog2222").dialog("close");
					}
				}]
	});

	$("#table-liste-reclassement").on("click", ".dialog-link", function(){
	   var iReclassementId = $(this).attr("iReclassementId");
		var iUserId = $(this).attr("iUserId")==''?-1:$(this).attr("iUserId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}reclassement/getModificationReclassement/" + iReclassementId,
			type: 'get',
			data: {
				iUserId: iUserId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog000").html(data);
				$("#dialog000").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});


	$("#table-liste-reclassement").on("click", ".suppr", function(){
	    var iElement = $(this).attr("dataSuppr");
		if (confirm ($("#zMessage").val()))
		{
			$("#iValueId").val(iElement) ; 
			$("#formDelete").submit();
			
		}
	});

	
	$("#table-liste-reclassement").on("click", ".dialog-join", function(){
		var iReclassementId = $(this).attr("iReclassementId");
		var iUserId = $(this).attr("iUserId")==''?-1:$(this).attr("iUserId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}reclassement/getMajPieceJointe/" + iReclassementId + "?sdsdsdsdsds",
			type: 'get',
			data: {
				iUserId: iUserId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog1111").html(data);
				$("#dialog1111").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	$("#table-liste-reclassement").on("click", ".suivi-circuit", function(){
		var iReclassementId = $(this).attr("iReclassementId");
		var iUserId = $(this).attr("iUserId")==''?-1:$(this).attr("iUserId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}reclassement/getMajSuiviDossier/" + iReclassementId,
			type: 'get',
			data: {
				iUserId: iUserId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog2222").html(data);
				$("#dialog2222").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	$('#table-liste-reclassement').DataTable( {
		"columnDefs": [
			{ className: "hidde", "targets": [ 2,3,4 ] },
		],
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}reclassement/gestion/gestion-reclassement/dossiers-data?iActif={/literal}{$oData.iActif}{literal}", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 

})
</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}

.showw {
	display: none;
}

@media screen and (max-width: 768px) {
	.form-inline .form-control {
		display: inline-block;
		width: auto;
		vertical-align: middle;
	}

	.col-sm-6{
		float:left;
		width:50%!important;
		display:inline;
	}

	.dataTables_filter label, .dataTables_length label {
		display: inline;
	}

}

@media screen and (max-width: 771px) {
	.hidde {
		display: none;
	}

	.showw {
		display: block;
	}
}

</style>
{/literal}