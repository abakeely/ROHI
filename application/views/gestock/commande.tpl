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
								<h3 class="page-title">Liste des commandes</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des stocks</a></li>
									<li class="breadcrumb-item">{$oData.zLibelle}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="SSttlPage">
									<div class="cell">
										<div class="field text-center">
											{if $oData.iSessionCompte == COMPTE_AGENT}
												<form action="#"  method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
													<fieldset>
														<div class="row1">
															<div class="cell" style="text-align:left;">
																<div class="field">
																	<label>&nbsp;</label>
																	<input type="button" class="button dialog-add-commande" value="Ajouter commande">
																</div>
															</div>
														</div>
													</fieldset>
												</form>
											{else}
											
											{/if}
										</div>
									</div>
								</div>
								<div class="col-xs-12">
									<table id="table-liste-commande" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											{if $oData.iCompteActif == COMPTE_AUTORITE || $oData.iCompteActif == COMPTE_GESTIONNAIRE_STOCK || $oData.iCompteActif == COMPTE_ADMIN}
											<tr>
												<th>Agent</th>
												<th>Service</th>
												<th>Réf Commande</th>
												<th>Date de la commande</th>
												<th>Article</th>
												<th>Unité</th>
												<th>Quantité commandée</th>
												<th style="text-align:center;">Action</th>
											</tr>	
											<tr>
												<td><input type="text" id="iAgent" class="searchCommande" placeholder="Recherche agent" /></td>
												<td><input type="text" id="zService" class="searchCommande" placeholder="Recherche service" /></td>
												<td><input type="text" id="zRef" class="searchCommande" placeholder="Recherche réf comm" /></td>
												<td><input type="text" id="zDate" class="searchCommande" placeholder="Recherche date" /></td>
												<td><input type="text" id="zArticle" class="searchCommande" placeholder="Recherche Artcile" /></td>
												<td><input type="text" id="zUnite" class="searchCommande" placeholder="Recherche unité" /></td>
												<td><input type="text" id="zQuantite" class="searchCommande" placeholder="Recherche quantité" /></td>
												<td>&nbsp;</td>
											</tr>
											{else}
											<tr>
												<th>N°</th>
												<th>Réf commande</th>
												<th>Date commande</th>
												<th>Les informations sur la commande</th>
												<th>Action</th>
											</tr>
											{/if}
										</thead>
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogCommande" title="Dialog Title"></div>
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
$(document).ready(function() {
	$("#dialogCommande").dialog({
		autoOpen: false,
		width: '40%',
		modal:true,
		title: 'Formulaire ajout commande',
		close: 'X',
		open: function () {
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length;
			};
		},
		modal: true,
		buttons: [{
					text: "Commander",
					click: function() {

						iRet = 1 ;
						$(".obligatoire").each (function ()
						{
							$(this).parent().removeClass("error");
							if($(this).val()=="" && $(this).attr("name") != undefined)
							{
								$(this).parent().addClass("error");
								 iRet = 0 ;
							}
						}) ;
						
						if (iRet == 1){

							if (confirm("Êtes-vous sûr de valider cette Commande?")){
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

										if (response.value == 1){
											$("#dialogCommande").dialog("close");
											zListeCommande.ajax.reload();
										} else {
											alert("Rupture de stock pour "+response.message+" mais votre demande est enregistrée");
											$("#dialogCommande").dialog("close");
											zListeCommande.ajax.reload();
										} 
									}
								});
							}
						}
					}
				},{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});

	var zListeCommande = $('#table-liste-commande').DataTable( {
		"processing": true,
		"serverSide": true,
		"searching": false,
		"footer": true,
		"columnDefs": [
			{ className: "dt-center", "targets": [ {/literal}{if $oData.iCompteActif == COMPTE_AGENT}{literal}4{/literal}{else}{literal}7{/literal}{/if}{literal} ] }
		 ],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/{/literal}{if $oData.iCompteActif == COMPTE_AGENT}{literal}commandeAgent{/literal}{else}{literal}commande{/literal}{/if}{literal}", // json datasource
			data: function ( d ) {
				d.iAgent = $("#iAgent").val(),
				d.zService = $("#zService").val(),
				d.zRef = $("#zRef").val(),
				d.zDate = $("#zDate").val(),
				d.zUnite = $("#zUnite").val(),
				d.zQuantite = $("#zQuantite").val(),
				d.zArticle = $("#zArticle").val(),
				d.zResponsable = $("#zResponsable").val(),
				d.zResponsableCopie = $("#zResponsableCopie").val(),
				d.zObservation = $("#zObservation").val(),
				d.zDateDepart = $("#zDateDepart").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 

	$("#table-liste-commande").on("click", ".searchCommande", function(){
	    $( this ).on( 'keyup change', function () {
			zListeCommande.ajax.reload();
        } );	
	});

	

	$(".dialog-add-commande").click(function(event) {
		$('#dialogCommande').dialog('option', 'title', "Formulaire ajout commande");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/new-commande",
			type: 'get',
			data: {
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogCommande").html(data);
				$("#dialogCommande").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	$("#table-liste-commande").on("click", ".dialog-link", function(){
	    var iCommandeId = $(this).attr("iCommandeId");
		$('#dialogCommande').dialog('option', 'title', "Formulaire visualisation commande");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/new-commande",
			type: 'get',
			data: {
				iCommandeId:iCommandeId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogCommande").html(data);
				$("#dialogCommande").dialog("open");
				event.preventDefault()
			},
			async: false
		})
			
	});

	$("#table-liste-commande").on("click", ".dialog-link-validation", function(){
	    var iFournitureCommandeId = $(this).attr("iFournitureCommandeId");
		var iAction = $(this).attr("action");
		
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/save/stock/statut",
			type: 'post',
			data: {
				iFournitureCommandeId:iFournitureCommandeId,
				iAction:iAction
			},
			success: function(data, textStatus, jqXHR) {
				zListeCommande.ajax.reload();
			},
			async: false
		})
			
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
th.dt-center, td.dt-center { text-align: center; }

th, td {
    width: 0px!important;
}

.searchCommande {
    width: 90%!important;
}

</style>
{/literal}