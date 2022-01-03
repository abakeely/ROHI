{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Badge Perdu {$oData.oCandidat1.0->nom}&nbsp;{$oData.oCandidat1.0->prenom}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Fiche Décision</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<form action="{$zBasePath}pointage/saveMission/pointage-electronique/" method="POST" name="formulaireCommande" id="formulaireCommande"  enctype="multipart/form-data">
										<fieldset>
											<div class="row clearfix">
												<div class="cell small">
													<div class="field">
														<label>Matricule&nbsp;</label>
														<input type="text" name="matricule" id="matricule" readonly="readonly" value="{$oData.oCandidat1.0->matricule}" >
														<input type="hidden" name="user_id" id="user_id" readonly="readonly" value="{$oData.oCandidat1.0->user_id}" >
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell">
													<div class="field">
														<label>Motif * :</label>
														<input type="text" name="zMotif" id="zMotif" value="Badge perdu" readonly="readonly">
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>

								{if sizeof($oData.toBadgePerdue)>0}
									<h2>Historique</h2>
								{/if}
								<div class="clear"></div>
								<div class="">
									<table id="dataTableHistoriqueEntree">
										<thead>
											<tr>
												<th>Date de la perte de badge</th>
												<th>Date insertion sur ROHI</th>
												<th>Date obtention badge</th>
												<th class="center">Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toBadgePerdue)>0}
											{foreach from=$oData.toBadgePerdue item=oListe }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListe.badge_datePerdue|date_format:"%d/%m/%Y"}</td>
												<td>{$oListe.badge_date|date_format:"%d/%m/%Y"}</td>
												<td id="iObtentionDate_{$oListe.badge_id}">{$oListe.badge_dateObtention|date_format:"%d/%m/%Y"}</td>
												<td class="center">
													{if $oListe.badge_dateObtention == ''}
													<a title="Modification date obtention badge" alt="Modification date obtention badge" style="cursor:pointer;" title="" id="dateObtention_{$oListe.badge_id}" iBadgeId="{$oListe.badge_id}" class="action dialog-link-heure"><i style="color:#12105A" class="la la-clock-o"></i></a>
													{/if}
												</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="5">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
								</div>

								<div id="calendar"></div>
								<div id="dialog" title="Dialog Title">
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
<style>
div.separateur {
    height: 26px!important;
}
</style>

<script type="text/javascript">
$(document).ready (function ()
{
	$( "#dialog" ).dialog({
		autoOpen: false,
		width: '30%',
		title: 'Mise à jour obtention badge',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {

					var zMessage = "";
					var iBadgeId = $("#iBadgeId").val();
					var iUserId = $("#iUserId").val();
					var zDateEntrer = $("#zDateEntrer").val();

					if (zDateEntrer == ''){
						zMessage += "Veuillez entrer la date d\'obtention" ; 
					} 
					
					if (zMessage != ''){
						alert(zMessage) ; 
					}
					else {

						$.ajax({
							url: "{/literal}{$zBasePath}{literal}pointage/saveObtentionBadge/" ,
							type: 'Post',
							data: { iUserId:iUserId, iBadgeId:iBadgeId,zDateEntrer:zDateEntrer},
							success: function(data, textStatus, jqXHR) {
								
								var oReturn = jQuery.parseJSON(data);
								
								$("#iObtentionDate_"+iBadgeId).html(oReturn.zDateEntrer);
								$("#dateObtention_"+iBadgeId).hide();
								$( "#dialog" ).html();
								$( "#dialog" ).dialog( "close" );
								event.preventDefault();
							},
							async: false
						});
					}
				}
			},
			{
				text: "Annuler",
				click: function() {
					$( this ).dialog( "close" );
				}
			}
		]
	});
	
	$( ".dialog-link-heure" ).click(function( event ) {
		$("#dialog").html();
		var iUserId = $("#user_id").val();
		var iBadgeId = $(this).attr("iBadgeId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}pointage/getPopUpBadge" ,
			type: 'POST',
			data: { iUserId:iUserId, iBadgeId:iBadgeId},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog").html(data);	
				$( "#dialog" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});
	
	{/literal}
	{if sizeof($oData.toBadgePerdue)>0}
	{literal}
	$("#dataTableHistoriqueEntree").dataTable();
	{/literal}
	{/if}
	{literal}
	
})

</script>
{/literal}