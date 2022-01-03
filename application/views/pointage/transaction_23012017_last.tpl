{include_php file=$zHeader }
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
		
	</div>
	<div id="innerContent">
		<h2>Transactions</h2>
		<p><i>&nbsp;<i></p>
		<form action="{$zBasePath}pointage/liste/pointage-electronique/transaction" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
			<fieldset>
				<div class="row1">
					<div class="cell small">
						<div class="field">
							<label>Date d&eacute;but *</label>
							<input type="text" name="date_debut" id="date_debut" value="{$oData.zDateDebut}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="withDatePicker obligatoire">
							<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
						</div>
					</div>
				</div>
				<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
					<div class="cell small">
						<div class="field">
							<label>Date fin *</label>
							<input type="text" name="date_fin" id="date_fin" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="withDatePicker obligatoire">
							<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
						</div>
					</div>
				</div>
				{if $oData.iCompteActif != COMPTE_AGENT}
				<div class="row1 clearfix">
					<div class="cell small">
						<div class="field">
							<label>IM </label>
							<input type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="Veuillez entrer le num&eacute;ro de matricule">
						</div>
					</div>
				</div>
				{/if}
				<div class="row " style="padding: 25px 0 20px;">
					<div class="cell">
						<div class="field">
							<input type="button" class="button" onClick="valider();" name="" id="" value="Voir transaction">
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		{if $oData.zMessage == ''}
		{if sizeof($oData.toGetAllTransaction)>0 && $oData.zDateDebut != "" && $oData.zDateFin != ""}
			{if $oData.iCompteActif != COMPTE_AGENT && $oData.iMatricule != '' && sizeof($oData.oUserMatricule)>0}
				<p>Liste des transactions de {$oData.oUserMatricule[0]->nom}&nbsp;{$oData.oUserMatricule[0]->prenom} du {$oData.zDateDebut} au {$oData.zDateFin}</p>
			{else}
				<p>Liste de transactions du {$oData.zDateDebut} au {$oData.zDateFin}</p>
			{/if}
		{else}
			<p>Liste des transactions de {$oData.oUserMatricule[0]->nom}&nbsp;{$oData.oUserMatricule[0]->prenom} du {$oData.zDateDebut} au {$oData.zDateFin}</p>
		{/if}
		{else}
		{/if}
		
		<div class="clear"></div>
		<table>
			<thead>
				<tr>
					<th>Jour</th>
					<th>Date</th>
					<th>Heure</th>
					<th>Terminal</th>
				</tr>
			</thead>
			<tbody>
				{assign var=iIncrement value="0"}
				{if sizeof($oData.toGetAllTransaction)>0}
				{foreach from=$oData.toGetAllTransaction item=oListeTransaction }
				<tr {if $iIncrement%2 == 0} class="even" {/if}>
					<td>{$oListeTransaction.DateTime|date_format:"%A"|ucfirst}</td>
					<td>{$oListeTransaction.DateTime|date_format:"%d/%m/%Y"}</td>
					<td>{$oListeTransaction.DateTime|date_format:"%H:%M:%S"}</td>
					<td>{$oListeTransaction.Desc|utf8}</td>
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
				{else}
				{if $oData.zMessage == ''}
				<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
				{else}
				<tr><td style="text-align:center;color:red" colspan="7"><strong>{$oData.zMessage}</strong></td></tr>
				{/if}
				{/if}
			</tbody>
		</table>
		{$oData.zPagination}
	</div>
</section>

<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/pointage-electronique/transaction">

{include_php file=$zFooter}