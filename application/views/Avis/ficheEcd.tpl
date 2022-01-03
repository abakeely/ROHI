{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Fiche > Titre de paiement</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">titre de paiement</a> <span>&gt;</span> Fiche </li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">

									<div class="SSttlPage">
												<div id="searchAcc">
													<div class="card punch-status">
														<h2>Sélection mois / année à afficher</h2>
														<form action="{$zBasePath}titre/fiche/titre-de-paiement" method="POST" name="formulaireTransaction" id="formulaireTransaction" style="display:block!important" enctype="multipart/form-data">
															<fieldset>
																<div class="row1">
																	<div class="cell">
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
																<div class="row1">
																	<div class="cell">
																		<div class="field">
																			<label>Ann&eacute;e</label>
																			<select name="iAnnee" id="iAnnee" style="width:100px!important;">
																				{assign var=iBoucle value=$oData.zAnneeBoucle}
																				{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}
																					<option {if $oData.iAnneeActif == $smarty.section.iAnnee.index}selected="selected"{/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
																				{/section}
																			</select>
																		</div>
																	</div>
																</div>
																{if $oData.iObject == 0}
																<div class="row1">
																	<div class="cell">
																		<div class="field">
																			<label>Poste agent num&eacute;ro </label>
																			<select name="iPostAgentNumero" id="iPostAgentNumero" style="width:150px!important;" onChange="changeTitrePaiement(this.value)">
																				{assign var=iBoucle value=$oData.zAnneeAffiche}
																				{foreach from=$oData.oCandidatAffiche item=oCandidatAffiche}
																					<option value="{$oCandidatAffiche->posteAgentNumero}">{$oCandidatAffiche->posteAgentNumero}</option>
																				{/foreach}
																			</select>
																		</div>
																	</div>
																</div>
																{/if}
																<div class="row1">
																	<div class="cell">
																		<div class="field" style="text-align:center">
																			 <input type="button" class="form-control button" onClick="fichePaiement();" name="" id="" value="Rechercher">
																		</div>
																	</div>
																</div>
																<div class="row1">
																	<div class="cell">
																		<div class="field" style="text-align:center">
																			 <input type="button" class="form-control button" onClick="ImpressionPaiement();" name="" id="" value="Imprimer">
																		</div>
																	</div>
																</div>
															</fieldset>
														</form>
													</div>
												   </div>
											</div>
											<!--Recherche-->
										{assign var=iIncrement11 value="0"}
										{if $oData.iObject == 1}
											<div class="contenuePage">
													<ul class="tabs">
														<li class="tab-link current" imodeid="1" data-tab="tab-1" id="liTab-1">
															&nbsp;&nbsp;&nbsp;&nbsp;Salaire&nbsp;&nbsp;&nbsp;&nbsp;
														</li>
														<li class="tab-link" imodeid="2" data-tab="tab-2" id="liTab-2">
															Liste des rubriques correspondant
														</li>
													</ul>
													<div id="tab-1" class="tab-content current">
													<fieldset>
														 <table class="table table-striped table-bordered table-hover" id="dataTables-example-99">
															<tr class="notAffiche">
																<td>Solde Mois de :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->mois}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Exercice :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->exercice}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>de Mr(Mme) :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->agentNom}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Matricule :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->agentMatricule}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Section :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->sectionCode}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Localit&eacute; :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->serviceLocalite} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Mode de paiement :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->modePaiement} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Etablissement financi&egrave;re :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{if isset($oData.oCandidatAffiche->etsFinancierNom)}{$oData.oCandidatAffiche->etsFinancierNom}{/if}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro de compte :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{if isset($oData.oCandidatAffiche->etsFinancierNom)}{$oData.oCandidatAffiche->agentNumeroCompte}{/if}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Total gain :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.toCandidatAffiche[0]->totalGain|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Total retenu :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.toCandidatAffiche[0]->totalRetenu|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr>
																<td>Net &agrave; Payer :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->netAPayer|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Rang dans le Bordereau :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->rang} {/if}</span></td>
															</tr>
															{* {if ($oData.oCandidatAffiche->toSetSlOv)}
															<tr class="notAffiche">
																<td>Num&eacute;ro Mandat :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->toSetSlOv->numeroMandat} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Mode de Paiement :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->toSetSlOv->modePaie} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro Titre :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->toSetSlOv->numeroTitre} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Date de r&egrave;glement :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->toSetSlOv->dateReglement} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro OV :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->toSetSlOv->numeroOv} {/if}</span></td>
															</tr>
															{else}
															{if $oData.oCandidatAffiche->agentNumeroCompte != ''}
															<!--<tr>
																<td>Date de r&egrave;glement :</td>
																<td><span>{if ($oData.oCandidatAffiche)} En cours.... {/if}</span></td>
															</tr>-->
															{/if}
															{/if} *}
														</table>
													</fieldset>
												</form>
											</div>
											<div id="tab-2" class="tab-content">
												<table style="margin:0!important">
													<tr class="notAffiche">
														<td><strong>Corps  :</strong> {if ($oData.toCandidatAffiche[0])}{$oData.toCandidatAffiche[0]->corpsCode}{/if}</td>
														<td><strong>Grade  :</strong> {if ($oData.toCandidatAffiche[0])}{$oData.toCandidatAffiche[0]->gradeCode}{/if}</td>
														<td><strong>Indice :</strong> {if ($oData.toCandidatAffiche[0])}{$oData.toCandidatAffiche[0]->indice}{/if}</td>
													<tr>
												</table>
												<table class="table table-striped table-bordered table-hover" id="dataTables-example-{$iIncrement11}">
													<fieldset>
													<thead>
														<tr >
															<th style="text-align:center;">Rubrique code</th>
															<th style="text-align:center;">Rubrique libellé</th>
															<th style="text-align:center;">Montant</th>
															<th style="text-align:center;">Date d&eacute;but</th>
															<th style="text-align:center;">Date fin</th>
															
														</tr>
													</thead>
													<tbody>
														{assign var=iIncrement value="0"}
														{if ($oData.toCandidatAffiche[0])}
															{foreach from=$oData.toCandidatAffiche item=oCandidatAffiche }
															<tr {if $iIncrement%2 == 0} class="even" {/if}>
																<td style="text-align:center;"><strong>{$oCandidatAffiche->codeRubrique}</strong></td>
																<td style="text-align:left;">{$oCandidatAffiche->rubriqueLibelle}</td>
																<td style="text-align:right;">{$oCandidatAffiche->montant|number_format:2:",":" "} Ar </td>
																<td style="text-align:right;">{if isset($oCandidatAffiche->dateDebut)}{$oCandidatAffiche->dateDebut|date_format:"%d/%m/%Y"}{/if}</td>
																<td style="text-align:right;">{if isset($oCandidatAffiche->dateFin)}{$oCandidatAffiche->dateFin|date_format:"%d/%m/%Y"}{/if}</td>
															</tr>
															{assign var=iIncrement value=$iIncrement+1}
															{/foreach}
														{/if}
													</tbody>
													</fieldset>
												</table>
											</div>
										{else}
										<div class="contenuePage">
												{foreach from=$oData.oCandidatAffiche item=oCandidatAffiche}
													<div id="{$oCandidatAffiche->posteAgentNumero}" cible="liTab-1{$iIncrement11}" class="allTitrePaiement" {if $iIncrement11 == 0} style="display:block" {else} style="display:none" {/if}>
														<ul class="tabs">
														<li class="tab-link current" imodeid="1" data-tab="tab-1" id="liTab-1">
															&nbsp;&nbsp;&nbsp;&nbsp;Salaire&nbsp;&nbsp;&nbsp;&nbsp;
														</li>
														<li class="tab-link" imodeid="2" data-tab="tab-2" id="liTab-2">
															Liste des rubriques correspondant
														</li>
													</ul>
													<div id="tab-1" class="tab-content current">
													<fieldset>
														 <table class="table table-striped table-bordered table-hover" id="dataTables-example-99">
															<tr class="notAffiche">
																<td>Solde Mois de :</td>
																<td><span>{if ($oCandidatAffiche)}{$oCandidatAffiche->mois}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Exercice :</td>
																<td><span>{if ($oCandidatAffiche)}{$oCandidatAffiche->exercice}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>de Mr(Mme) :</td>
																<td><span>{if ($oCandidatAffiche)}{$oCandidatAffiche->agentNom}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Matricule :</td>
																<td><span>{if ($oCandidatAffiche)}{$oCandidatAffiche->agentMatricule}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Section :</td>
																<td><span>{if ($oCandidatAffiche)}{$oCandidatAffiche->sectionCode}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Localit&eacute; :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->serviceLocalite} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Mode de paiement :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->modePaiement} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Etablissement financi&egrave;re :</td>
																<td><span>{if ($oCandidatAffiche)}{if isset($oCandidatAffiche->etsFinancierNom)}{$oCandidatAffiche->etsFinancierNom}{/if}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro de compte :</td>
																<td><span>{if ($oCandidatAffiche)}{if isset($oCandidatAffiche->etsFinancierNom)}{$oCandidatAffiche->agentNumeroCompte}{/if}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Total gain :</td>
																<td><span>{if ($oCandidatAffiche)} {$oData.toCandidatAffiche[0]->totalGain|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Total retenu :</td>
																<td><span>{if ($oCandidatAffiche)} {$oData.toCandidatAffiche[0]->totalRetenu|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr>
																<td>Net &agrave; Payer :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->netAPayer|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Rang dans le Bordereau :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->rang} {/if}</span></td>
															</tr>
															{* {if ($oCandidatAffiche->toSetSlOv)}
															<tr class="notAffiche">
																<td>Num&eacute;ro Mandat :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->toSetSlOv->numeroMandat} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Mode de Paiement :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->toSetSlOv->modePaie} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro Titre :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->toSetSlOv->numeroTitre} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Date de r&egrave;glement :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->toSetSlOv->dateReglement} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro OV :</td>
																<td><span>{if ($oCandidatAffiche)} {$oCandidatAffiche->toSetSlOv->numeroOv} {/if}</span></td>
															</tr>
															{else}
															{if $oCandidatAffiche->agentNumeroCompte != ''}
															<!--<tr>
																<td>Date de r&egrave;glement :</td>
																<td><span>{if ($oCandidatAffiche)} En cours.... {/if}</span></td>
															</tr>-->
															{/if}
															{/if} *}
														</table>
													</fieldset>
												</form>
											</div>
											<div id="tab-2" class="tab-content">
												<table style="margin:0!important">
													<tr class="notAffiche">
														<td><strong>Corps  :</strong> {if ($toCandidatAffiche[0])}{$toCandidatAffiche[0]->corpsCode}{/if}</td>
														<td><strong>Grade  :</strong> {if ($toCandidatAffiche[0])}{$toCandidatAffiche[0]->gradeCode}{/if}</td>
														<td><strong>Indice :</strong> {if ($toCandidatAffiche[0])}{$toCandidatAffiche[0]->indice}{/if}</td>
													<tr>
												</table>
												<table class="table table-striped table-bordered table-hover" id="dataTables-example-{$iIncrement11}">
													<fieldset>
													<thead>
														<tr >
															<th style="text-align:center;">Rubrique code</th>
															<th style="text-align:center;">Rubrique libellé</th>
															<th style="text-align:center;">Montant</th>
															<th style="text-align:center;">Date d&eacute;but</th>
															<th style="text-align:center;">Date fin</th>
															
														</tr>
													</thead>
													<tbody>
														{assign var=iIncrement value="0"}
														{if ($oData.toCandidatAffiche[0])}
															{foreach from=$oData.toCandidatAffiche item=oCandidatAffiche }
															<tr {if $iIncrement%2 == 0} class="even" {/if}>
																<td style="text-align:center;"><strong>{$oCandidatAffiche->codeRubrique}</strong></td>
																<td style="text-align:left;">{$oCandidatAffiche->rubriqueLibelle}</td>
																<td style="text-align:right;">{$oCandidatAffiche->montant|number_format:2:",":" "} Ar </td>
																<td style="text-align:right;">{if isset($oCandidatAffiche->dateDebut)}{$oCandidatAffiche->dateDebut|date_format:"%d/%m/%Y"}{/if}</td>
																<td style="text-align:right;">{if isset($oCandidatAffiche->dateFin)}{$oCandidatAffiche->dateFin|date_format:"%d/%m/%Y"}{/if}</td>
															</tr>
															{assign var=iIncrement value=$iIncrement+1}
															{/foreach}
														{/if}
													</tbody>
													</fieldset>
												</table>
											</div>

												</div>
										
										{assign var=iIncrement11 value=$iIncrement11+1}
										{/foreach}
										</div>
										{/if}
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
<input type="hidden" name="zUrlFiche" id="zUrlFiche" value="{$zBasePath}titre/fiche/titre-de-paiement">
<input type="hidden" name="zUrlImpression" id="zUrlImpression" value="{$zBasePath}titre/imprimer/titre-de-paiement">
{literal}
<style>
form .small {
    width: 15%!important;
}

@media only screen and (max-width: 1300px){
	.cellinfo {
		width: 100%!important;
		float: none!important;
		padding:10px!important;
	}
}

</style>
<script>
$(document).ready(function(){$('#dataTables-example-0').dataTable({bFilter:!1,bInfo:!1,searching:!1})});function changeTitrePaiement(_iPostNumero){$(".allTitrePaiement").hide();var zCible=$("#"+_iPostNumero).attr("cible");$("#"+_iPostNumero).show();$("#"+zCible).click()}
function getExtension(chemin)
{var regex=/[^.]*$/i;var resultats=chemin.match(regex);return resultats[0]}
var titlePopUpDialog=$('#titlePopUpDialog').html();{/literal}{if $oData.iCheckId==0}{literal}
$("#dialog3").dialog({autoOpen:!1,width:'75%',closeOnEscape:!1,dialogClass:"noclose",modal:!0,open:function(){$.ui.dialog.prototype._allowInteraction=function(e){return!!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length}},show:{effect:"slide",duration:1000},hide:{effect:"drop",duration:1000},buttons:[{text:'Valider',"class":'saveButtonClass',click:function(){var iMiseADispo=0;var iTestValid=1;var zMessage="";var iUserId=$("#iUserId").val();var zPhone=$("#zPhone").val();var zLocalite=$('#zLocalite').val();var zPorte=$('#zPorte').val();var iProvinceId=$('#iOrganisation_1').val();var iRegionId=$('#iOrganisation_2').val();var iDistrictId=$('#iOrganisation_3').val();var iDepartementId=$('#iOrganisation_4').val();var iDirectionId=$('#iOrganisation_5').val();var iServiceId=$('#iOrganisation_6').val();var iDivisionId=$('#iOrganisation_7').val();var iFonctionId=$('#iFonctionId').val();var iSousFonctionId=$('#selectSousFonction').val();var iInstitutionId=$('#iInstitutionId').val();var zDepartement=$('#iDepartementMADId').val();var zDirection=$('#iDirectionMADId').val();var zService=$('#iServiceMADId').val();var zLocaliteMad=$('#zLocaliteMad').val();if($('#iMiseDisposition').is(':checked'))iMiseADispo=1;if(iProvinceId==''||iProvinceId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner une province\n"}
if(iRegionId==''||iRegionId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner une région\n"}
if(iDistrictId==''||iDistrictId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner un district\n"}
if(iDepartementId==''||iDepartementId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner un département\n"}
if(iDirectionId==''||iDirectionId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner une direction\n"}
if(iServiceId==''||iServiceId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner un service\n"}
if(zLocalite==''||zLocalite==0){var iTestValid=0;zMessage+="- Veuillez remplir la localité de service\n"}
if(zPorte==''||zPorte==0){var iTestValid=0;zMessage+="- Veuillez remplir la porte\n"}
if(iFonctionId==''||iFonctionId==0){var iTestValid=0;zMessage+="- Veuillez sélectionner votre fonction\n"}
if(iMiseADispo==1&&(iInstitutionId==''||iInstitutionId==0)){var iTestValid=0;zMessage+="- Veuillez sélectionner votre institution si vous êtes mis(e) à dispodition\n"}
if(iTestValid==1){$.ajax({url:"{/literal}{$zBasePath}{literal}avis/saveLocaliteAvis",method:"POST",data:{iUserId:iUserId,iProvinceId:iProvinceId,iRegionId:iRegionId,iDistrictId:iDistrictId,iDepartementId:iDepartementId,iDirectionId:iDirectionId,iServiceId:iServiceId,iDivisionId:iDivisionId,zPhone:zPhone,zLocalite:zLocalite,zPorte:zPorte,iFonctionId:iFonctionId,iSousFonctionId:iSousFonctionId,iMiseADispo:iMiseADispo,iInstitutionId:iInstitutionId,zDepartement:zDepartement,zDirection:zDirection,zService:zService,zLocaliteMad:zLocaliteMad},success:function(data,textStatus,jqXHR){$("#dialog3").dialog("close");window.location.reload()},async:!1})}else{$('#iInstitutionSearchMessage').parent().removeClass("error");if(iMiseADispo==1&&(iInstitutionId==''||iInstitutionId==0)){$('#iInstitutionSearchMessage').parent().addClass("error")}
$(".obligatoire").each(function()
{$(this).parent().removeClass("error");if($(this).val()==""||$(this).val()==0)
{$(this).parent().addClass("error")}});alert(zMessage)}}}]});$(".dialog-link-manuel-localite11").click(function(event){$("#dialog3").html();$('#dialog3').dialog('option','title','Confirmation localité de service');$('#buttonId').button('option','label','Valider');var iUserTarget=$("#iUserId").val();var iUserId=$("#iUserId").val();$.ajax({url:"{/literal}{$zBasePath}{literal}avis/getInfoChangeManuel/"+iUserId,type:'post',data:{iUserTarget:iUserTarget},success:function(data,textStatus,jqXHR){$("#dialog3").html(data);$("#dialog3").dialog("open");event.preventDefault()},async:!1})});$(".dialog-link-manuel-localite11").click();{/literal}{/if}{literal}
{/literal}{if $oData.bPhoto==0}{literal}
$("#dialog3").dialog({autoOpen:!1,width:'40%',closeOnEscape:!1,dialogClass:"noclose",modal:!0,open:function(){$('.ui-widget-overlay').addClass('custom-overlay');$.ui.dialog.prototype._allowInteraction=function(e){return!!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length}},show:{effect:"slide",duration:1000},hide:{effect:"drop",duration:1000},buttons:[{text:'Valider',"class":'saveButtonClass',click:function(){var iMiseADispo=0;var iTestValid=1;var zMessage="";var zPhoto=$('#photo').val();var zPhone=$('#zPhone').val();if(zPhoto==''){var iTestValid=0;zMessage+="- Veuillez sélectionner votre photo\n"}else{var ext=getExtension(zPhoto).toLowerCase();if(ext=="png"||ext=="gif"||ext=="jpg"||ext=="jpeg"){}else{var iTestValid=0;zMessage+="Veuillez entrer le fichier ayant des extensions .jpeg/.jpg/.png/.gif.";$('#photo').val("")}}
if(zPhone==''){var iTestValid=0;zMessage+="- Veuillez remplir le telephone\n"}
if(iTestValid==1){$("#photoMAJ").submit()}else{alert(zMessage)}}}]});$(".dialog-link-manuel-localite11").click(function(event){$("#dialog3").html();$('#dialog3').dialog('option','title','Mise à jour photo et Telephone dans ROHI');$('#buttonId').button('option','label','Valider');var iUserTarget=$("#iUserId").val();var iUserId=$("#iUserId").val();$.ajax({url:"{/literal}{$zBasePath}{literal}avis/getTemplatePhoto/"+iUserId,type:'post',data:{iUserTarget:iUserTarget},success:function(data,textStatus,jqXHR){$("#dialog3").html(data);$("#dialog3").dialog("open");event.preventDefault()},async:!1})});$(".dialog-link-manuel-localite11").click();{/literal}{/if}{literal}

</script>
{/literal}
<style>
{literal}
.ui-widget-overlay.custom-overlay
{
    background-color: grey!important;
    background-image: none!important;
    opacity: 1!important;
}
.noclose .ui-dialog-titlebar-close
{
    display:none;
}
.even{
	background-color: #f9f9f9!important;
}

table tr.even td {
    background-color: #f9f9f9!important;
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
.dataTables_paginate {
	float:right;
	padding-right:100px;
}

.dataTables_filter, .dataTables_info { display: none; }
{/literal}
</style>
{include_php file=$zFooter}
		