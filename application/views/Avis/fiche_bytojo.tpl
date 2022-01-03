{include_php file=$zHeader }
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}	
	</div>
	<div id="innerContent">
		<div id="ContentBloc">
		<!--h3>Fiche > Titre de paiement</h3-->
		<form action="{$zBasePath}avis/fiche/titre-de-paiement" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
			<fieldset>
				<div class="row1">
					<div class="cell small">
						<div class="field">
							<label>Mois</label>
							<select name="iMois" id="iMois">
								{assign var=iIncrement value="1"}
								{foreach from=$oData.toMonth item=zMonth}
								{if $oData.iAnneeActif == '2016'}
									
									<option {if $oData.iMois == $iIncrement}selected="selected"{/if} value="{$iIncrement}">{$zMonth}</option>
									
								{else}
									<option {if $oData.iMois == $iIncrement}selected="selected"{/if} value="{$iIncrement}">{$zMonth}</option>
								{/if}
								{assign var=iIncrement value=$iIncrement+1}
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
					<div class="cell small">
						<div class="field">
							<label>Ann&eacute;e</label>
							<select name="iAnnee" id="iAnnee">
								{assign var=iBoucle value=$oData.zAnneeBoucle}
								{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}
									<option {if $oData.iAnneeActif == $smarty.section.iAnnee.index}selected="selected"{/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
								{/section}
							</select>
						</div>
					</div>
				</div>
				<div class="row1">
					<div class="cell">
						<div class="field">
							<input type="button" class="button" onClick="fichePaiement();" name="" id="" value="Rechercher">
							{if $oData.iObject == 1}
							<input type="button" class="button" onClick="ImpressionPaiement();" name="" id="" value="Imprimer">
							{/if}
						</div>
					</div>
				</div>
				{if $oData.iObject == 0}
					<div class="clearfix"></div>
					<div class="row1 ">
						<div class="cell small">
							<div class="field">
								<label>Poste agent num&eacute;ro </label>
								<select name="iPostAgentNumero" id="iPostAgentNumero" onChange="changeTitrePaiement(this.value)">
									{assign var=iBoucle value=$oData.zAnneeAffiche}
									{foreach from=$oData.oCandidatAffiche item=oCandidatAffiche}
										<option value="{$oCandidatAffiche->posteAgentNumero}">{$oCandidatAffiche->posteAgentNumero}</option>
									{/foreach}
								</select>
							</div>
						</div>
					</div>
					<div class="row ">
						<div class="cell">
							<div class="field">
								<label>&nbsp;</label>
								<input type="button" class="button" onClick="ImpressionPaiement();" name="" id="" value="Imprimer">
							</div>
						</div>
					</div>
				{else}
					<input type="hidden" id="iPostAgentNumero" name="iPostAgentNumero" value="">
			    {/if}
			</fieldset>
		</form>
			{assign var=iIncrement11 value="0"}
            {if $oData.iObject == 1}
			<table>
                <tr>
				<td style="width:50%">
					<form action="">
						<fieldset>
							<table>
								<tr class="notAffiche">
									<td>Solde Mois de :</td>
									<td><span> {$oData.oCandidatAffiche->mois}</span></td>
								</tr>
								<tr class="notAffiche">
									<td>Exercice :</td>
									<td><span>{$oData.oCandidatAffiche->exercice}</span></td>
								</tr>
								<tr class="notAffiche">
									<td>de Mr(Mme) :</td>
									<td><span>{$oData.oCandidatAffiche->agentNom}</span></td>
								</tr>
								<tr class="notAffiche">
									<td>Matricule :</td>
									<td><span>{$oData.oCandidatAffiche->agentMatricule}</span></td>
								</tr>
								<tr class="notAffiche">
									<td>Section :</td>
									<td><span>{$oData.oCandidatAffiche->sectionCode}</span></td>
								</tr>
								<tr class="notAffiche">
									<td>Localit&eacute; :</td>
									<td><span> {$oData.oCandidatAffiche->serviceLocalite} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Mode de paiement :</td>
									<td><span> {$oData.oCandidatAffiche->modePaiement} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Etablissement financi&egrave;re :</td>
									<td><span> {$oData.oCandidatAffiche->etsFinancierNom} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Num&eacute;ro de compte :</td>
									<td><span> {$oData.oCandidatAffiche->agentNumeroCompte} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Total gain :</td>
									<td><span> {$oData.toCandidatAffiche[0]->totalGain|number_format:2:",":" "} Ar </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Total retenu :</td>
									<td><span> {$oData.toCandidatAffiche[0]->totalRetenu|number_format:2:",":" "} Ar </span></td>
								</tr>
								<tr>
									<td>Net &agrave; Payer :</td>
									<td><span> {$oData.oCandidatAffiche->netAPayer|number_format:2:",":" "} Ar </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Rang dans le Bordereau :</td>
									<td><span> {$oData.oCandidatAffiche->rang} </span></td>
								</tr>
								{if ($oData.oCandidatAffiche->toSetSlOv)}
								<tr class="notAffiche">
									<td>Num&eacute;ro Mandat :</td>
									<td><span> {$oData.oCandidatAffiche->toSetSlOv->numeroMandat} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Mode de Paiement :</td>
									<td><span> {$oData.oCandidatAffiche->toSetSlOv->modePaie} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Num&eacute;ro Titre :</td>
									<td><span> {$oData.oCandidatAffiche->toSetSlOv->numeroTitre} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Date de r&egrave;glement :</td>
									<td><span> {$oData.oCandidatAffiche->toSetSlOv->dateReglement} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Num&eacute;ro OV :</td>
									<td><span> {$oData.oCandidatAffiche->toSetSlOv->numeroOv} </span></td>
								</tr>
								{else}
								{if $oData.oCandidatAffiche->agentNumeroCompte != ''}
								<tr>
									<td>Date de r&egrave;glement :</td>
									<td><span> En cours.... </span></td>
								</tr>
								{/if}
								{/if}
							</table>
						</fieldset>
					</form>
				</td>
				<td style="width:50%">
					<table style="margin:0!important">
						<tr class="notAffiche">
							<td>Corps  : {$oData.toCandidatAffiche[0]->corpsCode}</td>
							<td>Grade  : {$oData.toCandidatAffiche[0]->gradeCode}</td>
							<td>Indice : {$oData.toCandidatAffiche[0]->indice}</td>
						<tr>
					</table>
					<div class="separateur" style="height:28px;"><div class="col-md-12">&nbsp;&nbsp;Liste Rubrique</div></div>
					<table class="table table-striped table-bordered table-hover" id="dataTables-example-{$iIncrement11}">
						<thead>
							<tr >
								<th style="text-align:center;">Rubrique</th>
								<th style="text-align:center;">Montant</th>
								<th style="text-align:center;">Date d&eacute;but</th>
								<th style="text-align:center;">Date fin</th>
								
							</tr>
						</thead>
						<tbody>
							{assign var=iIncrement value="0"}
							{foreach from=$oData.toCandidatAffiche item=oCandidatAffiche }
							<tr {if $iIncrement%2 == 0} class="even" {/if}>
								<td style="text-align:center;">{$oCandidatAffiche->codeRubrique}</td>
								<td style="text-align:right;">{$oCandidatAffiche->montant|number_format:2:",":" "} Ar </td>
								<td style="text-align:right;">{$oCandidatAffiche->dateDebut|date_format:"%d/%m/%Y"}</td>
								<td style="text-align:right;">{$oCandidatAffiche->dateFin|date_format:"%d/%m/%Y"}</td>
							</tr>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
						</tbody>
					</table>
				</td>
				</tr>
            </table>
			{else}
			{foreach from=$oData.oCandidatAffiche item=oCandidatAffiche}
			<div id="{$oCandidatAffiche->posteAgentNumero}" class="allTitrePaiement" {if $iIncrement11 == 0} style="display:block" {else} style="display:none" {/if}>
			<table>
                <tr>
				<td style="width:50%">
					<form action="">
						<fieldset>
							<table>
								<tr class="notAffiche">
									<td>Solde Mois de :</td>
									<td><span> {$oCandidatAffiche->mois} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Exercice :</td>
									<td><span> {$oCandidatAffiche->exercice} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>de Mr(Mme) :</td>
									<td><span> {$oCandidatAffiche->agentNom}&nbsp;{$oData.oCandidatAffiche->agentPrenoms}</span></td>
								</tr>
								<tr class="notAffiche">
									<td>Matricule :</td>
									<td><span> {$oCandidatAffiche->agentMatricule} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Section :</td>
									<td><span> {$oCandidatAffiche->sectionCode} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Localit&eacute; :</td>
									<td><span> {$oCandidatAffiche->serviceLocalite} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Mode de paiement :</td>
									<td><span> {$oCandidatAffiche->modePaiement} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Etablissement financi&egrave;re :</td>
									<td><span> {$oCandidatAffiche->etsFinancierNom} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Num&eacute;ro de compte :</td>
									<td><span> {$oCandidatAffiche->agentNumeroCompte} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Total gain :</td>
									<td><span> {$oCandidatAffiche->toCode[0]->totalGain|number_format:2:",":" "} Ar </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Total retenu :</td>
									<td><span> {$oCandidatAffiche->toCode[0]->totalRetenu|number_format:2:",":" "} Ar </span></td>
								</tr>
								<tr>
									<td>Net &agrave; Payer :</td>
									<td><span> {$oCandidatAffiche->netAPayer|number_format:2:",":" "} Ar </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Rang dans le Bordereau :</td>
									<td><span> {$oCandidatAffiche->rang} </span></td>
								</tr>
								{if ($oCandidatAffiche->toSetSlOv)}
								<tr class="notAffiche">
									<td>Num&eacute;ro Mandat :</td>
									<td><span> {$oCandidatAffiche->toSetSlOv->numeroMandat} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Mode de Paiement :</td>
									<td><span> {$oCandidatAffiche->toSetSlOv->modePaie} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Num&eacute;ro Titre :</td>
									<td><span> {$oCandidatAffiche->toSetSlOv->numeroTitre} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Date de r&egrave;glement :</td>
									<td><span> {$oCandidatAffiche->toSetSlOv->dateReglement} </span></td>
								</tr>
								<tr class="notAffiche">
									<td>Num&eacute;ro OV :</td>
									<td><span> {$oCandidatAffiche->toSetSlOv->numeroOv} </span></td>
								</tr>
								{else}
								{if $oData.oCandidatAffiche->agentNumeroCompte != ''}
								<tr class="notAffiche">
									<td>Date de r&egrave;glement :</td>
									<td><span> En cours de paiement.... </span></td>
								</tr>
								{/if}
								{/if}
							</table>
						</fieldset>
					</form>
				</td>
				<td style="width:50%">
					<table style="margin:0!important">
						<tr>
							<td>Corps  : {$oCandidatAffiche->toCode[0]->corpsCode}</td>
							<td>Grade  : {$oCandidatAffiche->toCode[0]->gradeCode}</td>
							<td>Indice : {$oCandidatAffiche->toCode[0]->indice}</td>
						<tr>
					</table>
					<div class="separateur"><div class="col-md-12">&nbsp;&nbsp;Liste Rubrique</div></div>
					<table class="table table-striped table-bordered table-hover" class="dataTableAll" id="dataTables-example-{$iIncrement11}">
						<thead>
							<tr>
								<th style="text-align:center;">Rubrique</th>
								<th style="text-align:center;">Montant</th>
								<th style="text-align:center;">Date d&eacute;but</th>
								<th style="text-align:center;">Date fin</th>
								
							</tr>
						</thead>
						<tbody>
							{assign var=iIncrement value="0"}
							{foreach from=$oCandidatAffiche->toCode item=oCandidatAffiche }
							<tr {if $iIncrement%2 == 0} class="even" {/if}>
								<td style="text-align:center;">{$oCandidatAffiche->codeRubrique}</td>
								<td style="text-align:right;">{$oCandidatAffiche->montant|number_format:2:",":" "} Ar </td>
								<td style="text-align:right;">{$oCandidatAffiche->dateDebut|date_format:"%d/%m/%Y"}</td>
								<td style="text-align:right;">{$oCandidatAffiche->dateFin|date_format:"%d/%m/%Y"}</td>
							</tr>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
						</tbody>
					</table>
				</td>
				</tr>
            </table>
			</div>
			{assign var=iIncrement11 value=$iIncrement11+1}
			{/foreach}
			{/if}
	</div>
	<div id="calendar"></div>
	</div>
</section>
<input type="hidden" name="zUrlFiche" id="zUrlFiche" value="{$zBasePath}avis/fiche/titre-de-paiement">
<input type="hidden" name="zUrlImpression" id="zUrlImpression" value="{$zBasePath}avis/imprimer/titre-de-paiement">
{literal}
<script>
$(document).ready(function() {
	$('#dataTables-example-0').dataTable({bFilter: false, bInfo: false,searching: false});
});


function changeTitrePaiement(_iPostNumero){
	$(".allTitrePaiement").hide();
	$("#"+_iPostNumero).show();
}
</script>
{/literal}
<style>
{literal}

table {
    font-size: 1.1em;
    width: 100%;
    margin: 0 0 30px;
}

.col-sm-6 {
    width: 100%; 
    font-size: 12px;
    color: #333;
	text-align:center;
}
.dataTables_filter {
	display:none!important;
}

#dataTables-example-0_length {
	display:none!important;
}

.dataTables_info {
	display:none!important;
}
div.separateur {

	background-image: radial-gradient(#97B2A5,#327870)!important;
	/*width:100%;*/
	height:22px!important;
}

.dataTables_paginate {
	float:right;
	padding-right:100px;
}

.dataTables_filter, .dataTables_info { display: none; }

div.separateur .col-md-12 {

	color: white;
	font-size: 0.8em;
	font-weight: bold;
	
}
.separateur {
    height: 4rem;
    background: #91c149;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    padding-top: 0.7rem;
    margin-right: 0!important;
}
table {
	font-size:12px!important;
}

@media (max-width: 600px) {
	.notAffiche{ display:none;}
	.dataTables_paginate {
		padding-right:0px;
	}
}
{/literal}
</style>
{include_php file=$zFooter}