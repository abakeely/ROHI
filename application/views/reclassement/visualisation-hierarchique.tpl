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
								<!--h3 class="page-title">Visualisations</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Visualisations</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
										<table id="table-liste-reclassement" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
										<thead>
											<tr>
												<th>Matricule</th>
												<th>Nom et prénom</th>
												<th>Departement</th>
												<th>Direction</th>
												<th>Service</th>
												<th>Reclassement</th>
												<th class="center" width="100">Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
									{$oData.zPagination}
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
		<div id="dialog" title="Dialog Title"></div>
		<div id="dialog1" title="Dialog Title"></div>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<script>
{/literal}{if sizeof($oData.toInfoReclassement)>0} {literal}
    $('#table-liste-reclassement').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}reclassement/gestion/gestion-reclassement/visualisation-data", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
    }); 
{/literal}{/if}{literal}
$(document).ready(function() {
	$("#dialog").dialog({
		autoOpen: false,
		width: '70%',
		title: 'Fiche reclassement d\'un agent',
		close: 'X',
		modal: true,
		buttons: [{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});

	$("#dialog1").dialog({
		autoOpen: false,
		width: '70%',
		title: 'Pièces jointes reçues',
		close: 'X',
		modal: false,
		buttons: [{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});

	$("#table-liste-reclassement").on("click", ".dialog-link", function(){
		var iReclassementId = $(this).attr("iReclassementId");
		var iUserId = $(this).attr("iUserId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}reclassement/getInfoReclassement/" + iReclassementId,
			type: 'get',
			data: {
				iUserId: iUserId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog").html(data);
				$("#dialog").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	$("#table-liste-reclassement").on("click", ".dialog-join", function(){
		var iReclassementId = $(this).attr("iReclassementId");
		var iUserId = $(this).attr("iUserId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}reclassement/getInfoPieceJointe/" + iReclassementId,
			type: 'get',
			data: {
				iUserId: iUserId
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog1").html(data);
				$("#dialog1").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

})
</script>
<style>
#cssmenu li {font-size:1.2em;}
</style>
{/literal}