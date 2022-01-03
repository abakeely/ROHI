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
								<h3 class="page-title">Inventaire permanent en date du : {$oData.zDate|date_format:"%d/%m/%Y"}</h3>
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
											<form action="{$zBasePath}gestock/imprimer/stock/home" target="_self" method="POST" name="formulaireImprimer" id="formulaireImprimer"  enctype="multipart/form-data">
												<input type="hidden" name="iSetImprimer" id="iSetImprimer" value="0">
												<fieldset>
													<div class="row1">
														<div class="cell small">
															<div class="field">
																<label>Situation en Date du </label>
																<input type="text" name="zDate" id="zDate" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDate|date_format2}" placeholder="Date" readonly="readonly" value="{$oData.zDate|date_format:"%d/%m/%Y"}" class="withDatePicker obligatoire">
															</div>
														</div>
													</div>
													<div class="row1 clearfix"> 
														<div class="cell" style="width:60%;text-align:left;">
															<div class="field">
																<label>&nbsp;</label>
																<input type="button" class="button" onClick="getListeInventaire();" name="" id="" value="Afficher">
																<a href="#" style="text-decoration:none" class="btn button imprimer-out"><i class="la la-print"></i>&nbsp;&nbsp;Exporter</a>
																<a href="#" style="text-decoration:none" class="btn button imprimer-simple"><i class="la la-print"></i>&nbsp;&nbsp;Imprimer</a>
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
								<div class="col-xs-12">
									<table id="table-liste-inventaire" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th>N°</th>
												<th>Article</th>
												<th>Unité</th>
												<th>Stock actuel</th>
												<th>Quantité commandée</th>
												<th>Contrôle</th>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><input type="text" id="zArticle" class="searchCommande" placeholder="Recherche article" /></td>
												<td><input type="text" id="zUnite" class="searchCommande" placeholder="Recherche unité" /></td>
												<td><input type="text" id="iStockActuel" class="searchCommande" placeholder="Recherche stock actuel" /></td>
												<td><input type="text" id="iQteCommande" class="searchCommande" placeholder="Recherche quantité" /></td>
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
								<div id="dialog" title="Dialog Title"></div>
								<div id="dialog1" title="Dialog Title"></div>
								<div id="dialog2" title="Dialog Title"></div>
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

	var ddfd11 = $('#table-liste-inventaire').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/accueil/stock/inventaire", // json datasource
			data: function ( d ) {
				d.zDate = $("#zDate").val(),
				d.iNumero = $("#iNumero").val(),
				d.zArticle = $("#zArticle").val(),
				d.zUnite = $("#zUnite").val(),
				d.iStockActuel = $("#iStockActuel").val(),
				d.iQteCommande = $("#iQteCommande").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 

	function getListeInventaire(){
		ddfd11.ajax.reload();
	}

	$(".imprimer-out").click(function(event) {
		
		$("#iSetImprimer").val("1");
		$("#formulaireImprimer").removeAttr("target");
		$("#formulaireImprimer").attr("target","_self");
		$("#formulaireImprimer").submit();
	});

	$(".imprimer-simple").click(function(event) {
		$("#iSetImprimer").val("0");
		$("#formulaireImprimer").removeAttr("target");
		$("#formulaireImprimer").attr("target","_blank");
		$("#formulaireImprimer").submit();
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
    width: 100%!important;
}
</style>
{/literal}