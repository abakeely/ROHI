{include_php file=$zHeader }
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
		
	</div>
	<div id="innerContent">
		<h2>Rang</h2>
		<p><i>Veuillez entrez la date de d&eacute;but et la date fin</i></p>
		<form action="{$zBasePath}pointage/liste/pointage-electronique/rang" target="_self" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
			<fieldset>
				<div class="row1">
					<div class="cell small">
						<div class="field">
							<label>Date d&eacute;but *</label>
							<input type="text" name="date_debut" id="date_debut" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" value="{$oData.zDateDebut}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="form-control datedropper-range-fiche obligatoire">
							<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
						</div>
					</div>
				</div>
				<div class="row1 {if $iSessionCompte != COMPTE_ADMIN}clearfix{/if}">
					<div class="cell small">
						<div class="field">
							<label>Date fin *</label>
							<input type="text" name="date_fin" id="date_fin" value="{$oData.zDateFin}" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="form-control datedropper-range-fiche obligatoire">
							<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
						</div>
					</div>
				</div>
				{if $iSessionCompte == COMPTE_ADMIN}
				<div class="row1 clearfix">
					<div class="cell small">
						<div class="field"> 
							<label>Departement</label>
							<select style="height:37px;" id="iDepartementId" name="iDepartementId" class="obligatoire" onChange="getOrganisation('{$zBasePath}',1,this.value);">
								<option value="">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
								{foreach from=$oData.oDepartement item=oDepartement }
								<option {if $oDepartement.id == $oData.oDataSearch.iDepartementId} selected="selected" {/if} value="{$oDepartement.id}">&nbsp;{$oDepartement.libele}</option>
								{/foreach}
							</select>
							<p class="message fin" style="width:500px">Veuillez s&eacute;l&eacute;ctionner un d&eacute;partement</p>
						</div>
					</div>
				</div>
				{/if}
				<div class="row1 clearfix" style="padding: 20px 0 20px;">
					<div class="cell">
						<div class="field">
							<input type="button" class="button" onClick="validerRang(1);" name="" id="" value="Voir rang">
							<input type="button" class="button" onClick="validerRang(2);" name="" id="" value="Rapport en PDF">
							<input type="button" class="button" onClick="validerRang(3);" name="" id="" value="Rapport en Excel">
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		{if sizeof($oData.toGetAllTransaction)>0 && $oData.zDateDebut != "" && $oData.zDateFin != ""}
		<p>Liste des agents du {$oData.zDateDebut} &agrave; {$oData.zDateFin}</p>
		{/if}
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr>
					<th>RANG</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Pr&eacute;nom</th>
					<th>D&eacute;partement</th>
					<th>Direction</th>
					<th>Service</th>
					<th>Nb Jour</th>
					<th style="width:10%">Nb Heures</th>
					<th style="width:10%">Heures supplementaires</th>
					
				</tr>
			</thead>
			<tbody>
				{assign var=iIncrement value="0"}
				{if sizeof($oData.oListe)>0}
				{foreach from=$oData.oListe item=oListeRattache }
				<tr {if $iIncrement%2 == 0} class="even" {/if}>
					<td>{$oListeRattache->rang}</td>
					<td>{$oListeRattache->data.matricule}</td>
					<td>{$oListeRattache->data.nom|upper}</td>
					<td>{$oListeRattache->data.prenom}</td>
					<td>{$oListeRattache->data.sigle_departement}</td>
					<td>{$oListeRattache->data.sigle_direction}</td>
					<td>{$oListeRattache->data.sigle_service}</td>
					<td>{$oListeRattache->iDiffDate}</td>
					<td>{$oListeRattache->value}</td>
					<td> {$oListeRattache->Tot} </td>
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
				{else}
				<tr><td style="text-align:center;" colspan="9">Aucun enregistrement correspondant</td></tr>
				{/if}
			</tbody>
		</table>
		{$oData.zPagination}
	</div>
</section>
<script>

{if sizeof($oData.oListe)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
</script>
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="iElementId" id="iValueId" value=""> 
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/pointage-electronique/rang">
<input type="hidden" name="zUrlPdf" id="zUrlPdf" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/pdf">
<input type="hidden" name="zUrlExcel" id="zUrlExcel" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/excel">
</form>
{include_php file=$zFooter}