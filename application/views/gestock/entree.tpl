{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Entrée en stock</h3>
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
											<form action="#" target="_self" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
												<fieldset>
													<div class="row1 clearfix">
														<div class="cell1" style="text-align:left;">
															<div class="field">
																<label>&nbsp;</label>
																<a href="{$zBasePath}gestock/imprimer/stock/entree-output" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Exporter</a>
																<a href="{$zBasePath}gestock/imprimer/stock/entree" target="_blank" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Imprimer</a>
																<input type="button" class="button" onClick="getListeStock();" name="" id="" value="Afficher">
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
								<div class="col-xs-12">
									<table id="table-liste-stock" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th>N°</th>
												<th>Type</th>
												<th>Article</th>
												<th>Unité</th>
												<th>Quantité actuelle</th>
												<th>Quantité Consommée</th>
												<th>Action</th>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><input type="text" id="zType" class="searchCommande" placeholder="Recherche type" /></td>
												<td><input type="text" id="zArticle" class="searchCommande" placeholder="Recherche article" /></td>
												<td><input type="text" id="iUnite" class="searchCommande" placeholder="Recherche unité" /></td>
												<td><input type="text" id="iQuantiteActuel" class="searchCommande" placeholder="Recherche quantité" /></td>
												<td><input type="text" id="iQuantiteConsomme" class="searchCommande" placeholder="Recherche quantité consommée" /></td>
												<td>&nbsp;</td>
											</tr>
										</thead>
										
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogEntreeStock" title="Dialog Title"></div>
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

	$("#dialogEntreeStock").dialog({
		autoOpen: false,
		width: '60%',
		modal:true,
		title: 'Formulaire entrée en stock',
		close: 'X',
		open: function () {
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length;
			};
		},
		modal: true,
		buttons: [{
					id: "buttonId",
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
									$("#dialogEntreeStock").dialog("close");
									zListeStock.ajax.reload();
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
	
	var zListeStock = $('#table-liste-stock').DataTable( {
		"processing": true,
		"serverSide": true,
		"searching": false,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/entree", // json datasource
			data: function ( d ) {
				d.zType = $("#zType").val(),
				d.zArticle = $("#zArticle").val(),
				d.iUnite = $("#iUnite").val(),
				d.iQuantiteActuel = $("#iQuantiteActuel").val(),
				d.iQuantiteConsomme = $("#iQuantiteConsomme").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 

	function getListeStock(){
		zListeStock.ajax.reload();
	}

	$("#table-liste-stock").on("click", ".dialog-link", function(){
		$('#dialogEntreeStock').dialog('option', 'title', 'Formulaire entrée en stock');
        $('#buttonId').button('option', 'label', 'Modifier');
	    var iFournitureId = $(this).attr("iFournitureId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/entree",
			type: 'get',
			data: {
				iFournitureId:iFournitureId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogEntreeStock").html(data);
				$("#dialogEntreeStock").dialog("open");
				event.preventDefault()
			},
			async: false
		})
			
	});


</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}

th, td {
    width: 0px!important;
}

.searchCommande {
    width: 90%!important;
}
</style>
{/literal}