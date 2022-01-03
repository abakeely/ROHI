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
								<h3 class="page-title">RAPPORTS</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Rapport</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<form action="{$zBasePath}pointage/rapports/pointage-electronique/recherche/{$oData.iCurrPage}" target="_self" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
										<fieldset>
											<div class="row1">
												<div class="cell small">
													<div class="field">
														<label>Date d&eacute;but *</label>
														<input type="text" name="date_debut" id="date_debut"  autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" value="{$oData.zDateDebut}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="form-control datedropper-range-fiche obligatoire">
														<a href="#" title="" class="tooltip">
														<i id="allToltip" class="la la-info-circle"></i>
															<span id="getType">
																Date début du rapport
															</span>
														</a>
														<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
													</div>
												</div>
											</div>
											<div class="row1 clearfix">
												<div class="cell small">
													<div class="field">
														<label>Date fin *</label>
														<input type="text" name="date_fin" id="date_fin" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}"  value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="form-control datedropper-range-fiche obligatoire">
														<a href="#" title="" class="tooltip">
														<i id="allToltip" class="la la-info-circle"></i>
															<span id="getType">
																Date fin du rapport
															</span>
														</a>
														<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
														
													</div>
												</div>
											</div>
											<br/>
											
											<div class="row clearfix">
												<div class="cell small" style="width:70%">
													<div class="field">
														<p class="check"><label>Filtrage heure de travail à afficher : </label><input type="checkbox" id="iSeuil" {if $oData.iSeuil == 1} checked="checked" {/if}  name="iSeuil" value="1"></p>
														<div id="noteManuel" {if $oData.iSeuil == 1}style="display:block;"{else}style="display:none;"{/if}>
															<span>Liste des agents ayant effectu&eacute; moins de&nbsp;&nbsp;</span>
															<select id="heure_seuil" name="heure_seuil" style="width:12%;display:inline">
															{section name=iAnnee start=0 loop=24 step=1}
															<option {if $oData.heure_seuil == $smarty.section.iAnnee.index|string_format:"%02d"} selected="selected" {/if} value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
															{/section}
															</select>
															<label style="display:inline">&nbsp;h&nbsp;</label>
															<select id="minute_seuil" name="minute_seuil" style="width:12%;display:inline">
															{section name=iAnnee start=0 loop=60 step=1}
															<option {if $oData.minute_seuil == $smarty.section.iAnnee.index|string_format:"%02d"} selected="selected" {/if} value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
															{/section}
															</select>
															<label style="display:inline">&nbsp;mn&nbsp;</label>
															<select id="seconde_seuil" name="seconde_seuil" style="width:12%;display:inline">
															{section name=iAnnee start=0 loop=60 step=1}
															<option {if $oData.seconde_seuil == $smarty.section.iAnnee.index|string_format:"%02d"} selected="selected" {/if} value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
															{/section}
															</select>
															<span>S,&nbsp;&nbsp;&nbsp;plus de : &nbsp;&nbsp; </span>
															<input type="text" name="iNbrRetard" id="iNbrRetard" style="width:35px;" value="{$oData.iNbrRetard}">
															<span>&nbsp;fois dans l'intervalle donn&eacute;e</span>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="cell">
													<div class="field">
														<input type="button" class="button" onClick="validerRang(1);" name="" id="" value="Rapport">
														{if $oData.iCompteActif == 2 || $oData.iCompteActif ==3}
														<input type="button" class="button" onClick="validerRang(2);" name="" id="" value="Rapport en PDF">
														{/if}
														{if $oData.iCompteActif == 4}
														<input type="button" class="button" onClick="validerRang(3);" name="" id="" value="Rapport en Excel">
														{/if}
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
		
								<br/><br/>
								<p><i>Veuillez entrez la date de d&eacute;but et la date fin</i></p>
								{if $oData.zDateDebut != "" && $oData.zDateFin != ""}
									<p>Rapports du {$oData.zDateDebut} &agrave; {$oData.zDateFin}</p>
								{/if}
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>Matricule</th>
											<th>Nom</th>
											<th>Pr&eacute;nom</th>
											<th>D&eacute;partement</th>
											<th>Direction</th>
											<th>Service</th>
											<th>Fonction</th>
											<th>Jour</th>
											<th>Date</th>
											<th style="width:10%">Heure d'entr&eacute;e</th>
											<th style="width:10%">Heure de sortie</th>
											<th style="width:10%">Nb heures totales travaill&eacute;es</th>
											<th style="width:10%">Observation</th>
											
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.oListe)>0}
										{foreach from=$oData.oListe item=oListeRattache }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											<td>{$oListeRattache->data.matricule}</td>
											<td>{$oListeRattache->data.nom|upper}</td>
											<td>{$oListeRattache->data.prenom}</td>
											<td>{$oListeRattache->data.sigle_departement}</td>
											<td>{$oListeRattache->data.sigle_direction}</td>
											<td>{$oListeRattache->data.sigle_service}</td>
											<td>{$oListeRattache->data.poste}</td>
											<td>{$oListeRattache->zDateEntee|date_format:"%A"}</td>
											<td>{$oListeRattache->zDateEntee|date_format:"%d/%m/%Y"}</td>
											<td>{if $oListeRattache->zDateEntee|date_format:"%H:%M:%S" != '00:00:00'}{$oListeRattache->zDateEntee|date_format:"%H:%M:%S"}{/if}</td>
											<td>{if $oListeRattache->zDateEntee != $oListeRattache->zDateSortie}{if $oListeRattache->zDateSortie|date_format:"%H:%M:%S" != '00:00:00'}{$oListeRattache->zDateSortie|date_format:"%H:%M:%S"}{/if}{/if}</td>
											<td>{$oListeRattache->zDiffAffichage}</td>
											<td><span style="color:red;font-size:12px;">{$oListeRattache->zObservation}</span></td>
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="13">Aucun enregistrement correspondant</td></tr>
										{/if}
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Page Content -->
			<div id="calendar"></div>	
			<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
				<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
				<input type="hidden" name="iElementId" id="iValueId" value=""> 
				<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/pointage-electronique/rang">
				<input type="hidden" name="zUrlPdf" id="zUrlPdf" value="{$zBasePath}pointage/rapports/pointage-electronique/pdf/{$oData.iCurrPage}">
				<input type="hidden" name="zUrlExcel" id="zUrlExcel" value="{$zBasePath}pointage/rapports/pointage-electronique/excel/{$oData.iCurrPage}">
			</form>	
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


<script>

{if sizeof($oData.oListe)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
{literal}
$(document).ready (function ()
{
	$('#iSeuil').click(function(){
		
		var iValue = $('#iSeuil').is(':checked');  
		switch (iValue) {
			case true:
				$("#noteManuel").show();
				break;

			case false:
				$("#noteManuel").hide();
				break;
		}		
	});
});
{/literal}

</script>
{literal}
<style>
span {
	font-size: 1.2em;
}
</style>
{/literal}