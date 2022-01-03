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
								<h3 class="page-title">Expression des besoins</h3>
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
								<div class="">
									<table id="table-liste-expression" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th>N°</th>
												<!--<th>Agent</th>-->
												<th>Fourniture</th>
												<th>Quantité besoins</th>
												<th>Type fourniture</th>
												<th>Aperçu</th>
											</tr>
										</thead>
										
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialog" title="Dialog Title"></div>
								<div id="dialog1" title="Dialog Title"></div>
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
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});

	var zListeCommande = $('#table-liste-expression').DataTable( {
		"processing": true,
		"serverSide": true,
		"columnDefs": [
			{ className: "dt-center", "targets": [ 4 ] }
		 ],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/expression", // json datasource
			data: function ( d ) {
				d.zDate = $("#zDate").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 

	$("#table-liste-expression").on("click", ".dialog-link", function(){
	    var iFournitureId = $(this).attr("iFournitureId");
		$('#dialogCommande').dialog('option', 'title', "Formulaire visualisation commande");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/expression",
			type: 'POST',
			data: {
				iFournitureId:iFournitureId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogCommande").html(data);
				$("#dialogCommande").dialog("open");
				event.preventDefault()
			},
			async: false
		})
			
	});
});
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

</style>
{/literal}