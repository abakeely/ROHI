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
								<h3 class="page-title">Formation : {$oData.oCandidat.0->nom}&nbsp;{$oData.oCandidat.0->prenom}</h3>
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
									<form action="{$zBasePath}pointage/saveFormation/pointage-electronique/" method="POST" name="formulaireCommande" id="formulaireCommande"  enctype="multipart/form-data">
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
												<div class="cell small">
													<div class="field">
														<label>Date</label>
														<input type="text" name="zDate" id="zDate" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.date|date_format2}" value="{$oData.date}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker obligatoire">
														<p class="message " style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell small">
													<div class="field">
														<label>Heure de Sortie</label>
														<select id="heure_sortie" name="heure_sortie" style="width:20%;display:inline">
														{section name=iAnnee start=7 loop=17 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
														<label style="display:inline">&nbsp;:&nbsp;</label>
														<select id="minute_sortie" name="minute_sortie" style="width:20%;display:inline">
														{section name=iAnnee start=0 loop=60 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
														<label style="display:inline">&nbsp;:&nbsp;</label>
														<select id="seconde_sortie" name="seconde_sortie" style="width:20%;display:inline">
														{section name=iAnnee start=0 loop=60 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell">
													<div class="field">
														<label>Motif * :</label>
														<input type="text" name="zMotif" id="zMotif" value="" placeholder="Veuillez entrer le motif" class="obligatoire">
														<p class="message " style="width:500px">Veuillez enter le motif</p>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell">
													<div class="field">
														<input type="button" class="button" onClick="validerEntrerSortie();" style="width:205px;" name="" id="" value="Envoyer">
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>

								{if sizeof($oData.toGetInOut)>0}
									<h2>Historique</h2>
								{/if}
								<div class="clear"></div>

								<div class="">
									<table id="dataTableHistoriqueEntree">
										<thead>
											<tr>
												<th>Pointeur</th>
												<th>Date de sortie</th>
												<th>Heure Sortie</th>
												<th>Date d'entrée</th>
												<th>Heure Entr&eacute;e</th>
												<th>Motif</th>
												<th class="center">Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toFormation)>0}
											{foreach from=$oData.toFormation item=oListe }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListe.nom}</td>
												<td>{$oListe.formation_date|date_format:"%d/%m/%Y"}</td>
												<td>{$oListe.formation_heureSortie}</td>
												<td id="iDateChange_{$oListe.formation_id}">{$oListe.formation_dateEntree|date_format:"%d/%m/%Y"}</td>
												<td id="iLocalChange_{$oListe.formation_id}">{$oListe.formation_heureEntree}</td>
												<td>{$oListe.formation_motif}</td>
												<td class="center">
													{if $oListe.formation_heureEntree == ''}
													<a title="Modification Heure de entr&eacute;e" alt="Modification Heure d'entr&eacute;e" style="cursor:pointer;" title="" id="hour_{$oListe.formation_id}" iFormationId="{$oListe.formation_id}" class="action dialog-link-heure"><i style="color:#12105A" class="la la-clock-o"></i></a>
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
								<div id="dialog" title="Dialog Title"></div>
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
		title: 'Mise à jour date / Heure d\'entrée',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {

					var zMessage = "";
					var iMissionId = $("#iMissionId").val();
					var iUserId = $("#iUserId").val();
					var zDateEntrer = $("#zDateEntrer").val();
					var zHeureEntree = $("#heure_entree").val();
					var zMinuteEntree = $("#minute_entree").val();
					var zSecondeEntree = $("#seconde_entree").val();
					if (zHeureEntree == '00'){
						zMessage += "Veuillez entrer l\'heure d\'entrée" ; 
					} 

					if (zDateEntrer == ''){
						zMessage += "Veuillez entrer la date d\'entrée" ; 
					} 
					
					if (zMessage != ''){
						alert(zMessage) ; 
					}
					else {

						$.ajax({
							url: "{/literal}{$zBasePath}{literal}pointage/saveHourUserFormation/" ,
							type: 'Post',
							data: { iUserId:iUserId, iFormationId:iMissionId,zHeureEntree:zHeureEntree, zMinuteEntree:zMinuteEntree, zSecondeEntree:zSecondeEntree, zDateEntrer:zDateEntrer},
							success: function(data, textStatus, jqXHR) {
								
								var oReturn = jQuery.parseJSON(data);
								
								$("#iLocalChange_"+iMissionId).html(oReturn.zHeureEntree);
								$("#iDateChange_"+iMissionId).html(oReturn.zDateEntrer);
								$("#hour_"+iMissionId).hide();
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
		var iMissionId = $(this).attr("iFormationId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}pointage/getPopUpHeureEntree" ,
			type: 'POST',
			data: { iUserId:iUserId, iMissionId:iMissionId},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog").html(data);	
				$( "#dialog" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});
	
	{/literal}
	{if sizeof($oData.toGetInOut)>0}
	{literal}
	$("#dataTableHistoriqueEntree").dataTable();
	{/literal}
	{/if}
	{literal}
	
})

</script>
{/literal}