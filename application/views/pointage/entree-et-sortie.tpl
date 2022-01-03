{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Entr&eacute;e et Sortie de : {$oData.oCandidat.0->nom}&nbsp;{$oData.oCandidat.0->prenom}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Entrée / Sortie</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<form action="{$zBasePath}pointage/saveInOut/pointage-electronique/" method="POST" name="formulaireCommande" id="formulaireCommande"  enctype="multipart/form-data">
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
														<label>Heure d'entr&eacute;e</label>
														<select id="heure_entree" name="heure_entree" style="width:20%;display:inline">
														{section name=iAnnee start=0 loop=24 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
														<label style="display:inline">&nbsp;:&nbsp;</label>
														<select id="minute_entree" name="minute_entree" style="width:20%;display:inline">
														{section name=iAnnee start=0 loop=60 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
														<label style="display:inline">&nbsp;:&nbsp;</label>
														<select id="seconde_entree" name="seconde_entree" style="width:20%;display:inline">
														{section name=iAnnee start=0 loop=60 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
													</div>
												</div>
											</div>
											{*<div class="row clearfix">
												<div class="cell small">
													<div class="field">
														<label>Heure de sortie</label>
														<select id="heure_sortie" name="heure_sortie" style="width:12%;display:inline">
														{section name=iAnnee start=0 loop=24 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
														<label style="display:inline">&nbsp;:&nbsp;</label>
														<select id="minute_sortie" name="minute_sortie" style="width:12%;display:inline">
														{section name=iAnnee start=0 loop=60 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
														<label style="display:inline">&nbsp;:&nbsp;</label>
														<select id="seconde_sortie" name="seconde_sortie" style="width:12%;display:inline">
														{section name=iAnnee start=0 loop=60 step=1}
														<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
														{/section}
														</select>
													</div>
												</div>
											</div>
											*}
											<div class="row clearfix">
												<div class="cell">
													<div class="field">
														<input type="button" class="button" onClick="validerEntrerSortie();" style="width:205px;" name="" id="" value="Envoyer votre demande">
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
								<div class="col-xs-12">
									<table id="dataTableHistoriqueEntree">
										<thead>
											<tr>
												<th>Pointeur</th>
												<th>Agent pointé</th>
												<th>Date</th>
												<th>Heure d&eacute;but</th>
												<th>Heure fin</th>
												<th class="center">Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toGetInOut)>0}
											{foreach from=$oData.toGetInOut item=oListe }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListe.nom}</td>
												<td>{$oListe.agent}</td>
												<td>{$oListe.inOut_date|date_format:"%d/%m/%Y"}</td>
												<td>{$oListe.inOut_HeureDebut}</td>
												<td id="iLocalChange_{$oListe.inOut_id}">{$oListe.inOut_HeureFin}</td>
												<td class="center">
													{if $oListe.inOut_HeureFin == ''}
													<a title="Modification Heure de sortie" alt="Modification Heure de sortie" style="cursor:pointer;" title="" id="hour_{$oListe.inOut_id}" iInOutId="{$oListe.inOut_id}" class="action dialog-link-heure"><i style="color:#12105A" class="la la-clock-o"></i></a>
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
		title: 'Mise à jour Heure de sortie',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {

					var iInOutId = $("#iInOutId").val();
					var iUserId = $("#iUserId").val();
					var zHeureSortie = $("#heure_sortie").val();
					var zMinuteSortie = $("#minute_sortie").val();
					var zSecondeSortie = $("#seconde_sortie").val();
					if (zHeureSortie == '00'){
						alert('Veuillez entrer l\'heure de sortie');
					} else {

						$.ajax({
							url: "{/literal}{$zBasePath}{literal}pointage/saveHourUser/" ,
							type: 'Post',
							data: { iUserId:iUserId, iInOutId:iInOutId,zHeureSortie:zHeureSortie, zMinuteSortie:zMinuteSortie, zSecondeSortie:zSecondeSortie},
							success: function(data, textStatus, jqXHR) {
								
								$("#iLocalChange_"+iInOutId).html(data);
								$("#hour_"+iInOutId).hide();
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
		var iInOutId = $(this).attr("iInOutId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}pointage/getPopUpHeure" ,
			type: 'POST',
			data: { iUserId:iUserId, iInOutId:iInOutId},
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