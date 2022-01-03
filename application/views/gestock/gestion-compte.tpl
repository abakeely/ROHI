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
								<h3 class="page-title">Gestion de compte</h3>
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
									<table id="table-liste-compte" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th>N°</th>
												<th>Nom</th>
												<th>Prénom</th>
												<th>Matricule</th>
												<th>Service</th>
												<th>Resp Magasin</th>
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

	var zListeCompte = $('#table-liste-compte').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/compte",
			data: function ( d ) {
				
			},
			type: "post",  
			error: function(){  
			}
		}
    }); 


	$("#table-liste-compte").on("click", ".checkBoxCompte", function(){
	    var iUserId = $(this).attr("iId");
		var iValue  = $('#iCompte_'+iUserId).is(':checked');  
		var zMsg = "";
		switch (iValue) {
			case true:
				iValueAttr = 1;
				zMsg = 'Êtes-vous sûr de vouloir ajouter cet agent pour être responsable magasin';
				break;

			case false:
				iValueAttr = 0;
				zMsg = 'Êtes-vous sûr de vouloir retirer cet agent';
				break;
		}
		
		if (confirm(zMsg)){
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}gestock/save/stock/compte",
				type: 'post',
				data: {
					iUserId:iUserId,
					iValueAttr:iValueAttr
				},
				success: function(data, textStatus, jqXHR) {
					zListeCompte.ajax.reload();
				},
				async: false
			})
		}
			
	});

	
</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
</style>
{/literal}