{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									{if $oData.oDecision.decision_statutId > 1} 
									visualisation de d&eacute;cision
									{else}
									{$oData.zTitre} {if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									&agrave; finaliser
									{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
									&agrave; imprimer
									{/if}{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Fiche Décision</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<form action="{$zBasePath}gcap/save/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
									<input type="hidden" name="iTypeGcapId" id="iTypeGcapId" value="{$oData.iTypeGcapId}">
									<input type="hidden" name="iId" id="iId" value="{$oData.iId}">
									<input type="hidden" name="caracteristique" id="caracteristique" value="">
									<input type="hidden" name="date_prise_service" id="date_prise_service" value="{if $oData.oUserConge[0]->date_prise_service!=""}{$oData.oUserConge[0]->date_prise_service}{else}{$oData.oCandidat[0]->date_prise_service}{/if}">
									<input type="hidden" name="iAnneEnCours" id="iAnneEnCours" value="{$oData.annee}">
									<input type="hidden" name="iAnnePriseService" id="iAnnePriseService" value="{$oData.iAnnePriseDecision}">
									<input type="hidden" name="iTestDateSiganture" id="iTestDateSiganture" value="{if ($oData.iSessionCompte == COMPTE_AUTORITE && $oData.oDecision.decision_typeId != DECISISON_CONGE_ANNUEL) ||  $oData.iSessionCompte == COMPTE_ADMIN}1{else}0{/if}">
									<input type="hidden" name="zMessageCumulee" id="zMessageCumulee" value="D&eacute;cision de cong&eacute; annuel pas encore disponible (< 60 jours)">
									{if $oData.iSessionCompte != COMPTE_AGENT}
										<input type="hidden" name="type_id" id="type_id" value="{$oData.oDecision.decision_typeId}">
										<input type="hidden" name="annee" id="annee" value="{$oData.oDecision.decision_annee}">
										<input type="hidden" name="caracteristique" id="caracteristique" value="{$oData.oDecision.decision_caracteristique}">
										<input type="hidden" name="dateCreation" id="dateCreation" value="{$oData.oDecision.decision_date}">
									{/if}
									<fieldset>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<label>Type {$oData.zLibelle} *</label>
													<select id="type_id" name="type_id" {if $oData.oDecision.decision_statutId > 1} disabled="disabled" {/if} {if $oData.iSessionCompte != COMPTE_AGENT && $oData.oDecision.decision_typeId !=''} disabled="disabled" {/if} onChange="setDateFin();setToolType('{$zBasePath}', this.value);setCongeAnnuelCumule('{$zBasePath}', this.value,{$oData.oCandidat[0]->user_id})" class="obligatoire">
														<option value="">s&eacute;l&eacute;ctionner le type {$oData.zLibelle}</option>
														{foreach from=$oData.oType item=oType }
														<option {if $oData.oDecision.decision_typeId == $oType.type_id} selected="selected" {/if} value="{$oType.type_id}">{$oType.type_libelle}</option>
														{/foreach}
													</select>
													<a href="#" title="" class="tooltip">
														<i id="allToltip" class="la la-info-circle" {if $oData.oDecision.decision_typeId == ""}style="display:none"{else}style="display:inline-block"{/if}></i>
														<span id="getType">
															
														</span>
													</a>
													<p class="message">Veuillez s&eacute;l&eacute;ctionner le type {$oData.zLibelle}</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell">
												<div class="field"> 
													<label>Ann&eacute;e *</label>
													<select onChange="GetCalendar(this.value)" id="annee" {if $oData.oDecision.decision_statutId > 1} disabled="disabled" {/if} name="annee" {if $oData.iSessionCompte != COMPTE_AGENT && $oData.oDecision.decision_annee !=''} disabled="disabled" {/if} class="obligatoire">
														{if $oData.oDecision.decision_statutId > 1} 
														<option selected="selected" value="{$oData.oDecision.decision_annee}">{$oData.oDecision.decision_annee}</option>
														{else}
															{if $oData.iSessionCompte == COMPTE_AGENT}
																<option value="">s&eacute;l&eacute;ctionner l'ann&eacute;e</option>
																{assign var=iBoucle value=$oData.annee}
																{assign var=iAnnePrise value=$oData.anneePriseService}
																{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}

																{if $smarty.section.iAnnee.index != $oData.annee   }
																	{if sizeof($oData.oDataExtrant)>0} 
																		{assign var=iAffiche value="1"}
																		{foreach from=$oData.oDataExtrant item=oDataExtrant }

																			{if $oDataExtrant.decision_annee == $smarty.section.iAnnee.index} 
																			{assign var=iAffiche value="0"}
																			{/if}
																		{/foreach}

																		{if $iAffiche==1}
																		<option {if $oData.oDecision.decision_annee == $smarty.section.iAnnee.index} selected="selected" {/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
																		{/if}
																	{else}
																		<option {if $oData.oDecision.decision_annee == $smarty.section.iAnnee.index} selected="selected" {/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
																	{/if}
																{/if}
																{/section}
															{else}
																<option selected="selected" value="{$oData.oDecision.decision_annee}">{$oData.oDecision.decision_annee}</option>
															{/if}
														{/if}
													</select>
													<a href="#" title="" class="tooltip">
														<i id="allToltip" class="la la-info-circle"></i>
														<span id="getType">
															Ann&eacute;e de d&eacute;cision
														</span>
													</a>
													<p class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner l'ann&eacute;e</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell">
												<div class="field" class="obligatoire">
													<label>Nombre de jour (automatique)</label>
													<input class="form-control" type="text" name="nbrJour" id="nbrJour" {if $oData.oDecision.decision_statutId > 1} disabled="disabled" {/if} class="obligatoire" readonly="readonly" value="{if $oData.oDecision.decision_nbrJour}{$oData.oDecision.decision_nbrJour|number_format:2:",":"."}{/if}" placeholder="Nombre de jour">
													<p class="message nbsJourdec" style="width:500px"></p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell small">
												<div class="field">
													<label>Date d&eacute;but *</label>
													<input class="form-control" type="text" name="date_debut" id="date_debut" autocomplete="off" {if $oData.oDecision.decision_statutId > 1} disabled="disabled" {/if} onChange="setDateFin();" value="{if $oData.oDecision.decision_dateDebut}{$oData.oDecision.decision_dateDebut|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but"  data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oDecision.decision_dateDebut}{$oData.oDecision.decision_dateDebut|date_format2}{/if}" class="datedropper-range-fiche obligatoire">
													<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
												</div>
											</div>
											<div class="cell small">
												<div class="field">
													<label>Date fin *</label>
													<input class="form-control" type="text" name="date_fin" id="date_fin" autocomplete="off" onChange="setDateFin();" {if $oData.oDecision.decision_statutId > 1} disabled="disabled" {/if} value="{if $oData.oDecision.decision_dateFin}{$oData.oDecision.decision_dateFin|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date fin" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oDecision.decision_dateFin}{$oData.oDecision.decision_dateFin|date_format2}{/if}" class="datedropper-range-fiche obligatoire">
													<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
												</div>
											</div>
										</div>
										{if $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $oData.iSessionCompte == COMPTE_AUTORITE}	
											<div class="clearfix">
												<div class="cell">
													<div class="field" class="obligatoire">
														<label>Num&eacute;ro *</label>
														<input class="form-control" type="text" name="numero" id="numero" {if $oData.oDecision.decision_statutId > 1} disabled="disabled" {/if} class="obligatoire" {if $oData.iSessionCompte == COMPTE_AUTORITE && $oData.oDecision.decision_numero > 0} disabled="disabled" {/if} value="{if $oData.oDecision.decision_numero}{$oData.oDecision.decision_numero}{/if}" placeholder="Num&eacute;ro">
														<p class="message" style="width:500px">Veuillez remplir Num&eacute;ro</p>
													</div>
												</div>
											</div>
											{if $oData.oDecision.decision_userValidId > 0 && sizeof($oData.oUserValid) > 0}
												<div class="clearfix">
													<div class="cell">
														<div class="field" class="obligatoire">
															<label>Nom Autorité</label>
															<input class="form-control" type="text" name="userValid" id="userValid"  disabled="disabled" value="{$oData.oUserValid.nom}&nbsp;{$oData.oUserValid.prenom}">
														</div>
													</div>
												</div>
											{/if}
										{/if}
										{if ($oData.iSessionCompte == COMPTE_AUTORITE) ||  ($oData.iSessionCompte == COMPTE_ADMIN)}
											<div class="clearfix">
												<div class="cell">
													<label>Nom autorit&eacute; *</label>
													<div class="field">
														<input class="form-control" placeholder="Veuillez entrer le nom de l'autorit&eacute;" type="text" id="zCandidatSearch" name="zCandidat">
													</div>
												</div>
											</div>
											{if $oData.oDecision.decision_typeId != DECISISON_CONGE_ANNUEL}
												<div class="clearfix">
													<div class="cell">
														<div class="field">
															<label>d&eacute;cision</label>
															<select id="decision" name="decision"  class="obligatoire" {if $oData.iSessionCompte == COMPTE_AUTORITE && $oData.oDecision.decision_valide != ''} disabled="disabled" {/if}>
																<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
																<option {if $oData.oDecision.decision_valide == 1} selected="selected" {/if} value="1">Valider</option>
																<option {if $oData.oDecision.decision_valide == 2} selected="selected" {/if} value="2">Refuser</option>
															</select>
															<p class="message">Veuillez s&eacute;l&eacute;ctionner votre d&eacute;cision</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div class="cell small">
														<div class="field">
															<label>Date de signature *</label>
															<input type="text" {if $oData.iSessionCompte == COMPTE_AUTORITE && $oData.oDecision.decision_dateValidation != ''} disabled="disabled" {/if} name="date_signature" id="date_signature" value="{if $oData.oDecision.decision_dateValidation}{$oData.oDecision.decision_dateValidation|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date de signature" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oDecision.decision_dateValidation}{$oData.oDecision.decision_dateValidation|date_format}{/if}" class="withDatePicker obligatoire">
															<p class="message signature" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de signature</p>
														</div>
													</div>
												</div>
											{/if}
										{/if}
										<div class="clearfix"> 
											<div class="col-sm-12 text-center">
												<br/>
												{if $oData.iSessionCompte == COMPTE_AGENT && $oData.oDecision.decision_statutId <= 1}
													<input type="button" class="button" onClick="valider('{$zBasePath}',4);" name="" id="" value="Envoyer">
												{elseif $oData.iSessionCompte == COMPTE_AGENT && $oData.oDecision.decision_statutId >  1}
													<input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="" value="Retour">
												{/if}

												{if $oData.iSessionCompte != COMPTE_AGENT}
													{if ($oData.oDecision.decision_numero == 0) && ($oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $oData.iId > 0) }
													<input type="button" class="button" onClick="valider('{$zBasePath}',1);" name="" id="" value="Envoyer">
													{/if}
													{if ($oData.oDecision.decision_numero != 0) && ($oData.iSessionCompte == COMPTE_AUTORITE && $oData.iId > 0) }
													<input type="button" class="button" onClick="valider('{$zBasePath}',1);" name="" id="" value="Valider">
													{/if}
													{if ($oData.oDecision.decision_numero != 0) || ($oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $oData.iId > 0) }
													<input type="button" class="button" onClick="document.location.href='{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.oDecision.decision_id}';document.location.target='_blank'" name="" id="" value="Imprimer">
													{/if}
												{/if}
												<br/>
											</div>
										</div>
									</fieldset>
								</form>
								<div id="calendar"></div>
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

{if $oData.oDecision.decision_typeId != ""}
<script language="javascript">
var zBasePath = '{$zBasePath}';
iTypeId = {$oData.oDecision.decision_typeId};
setToolType(zBasePath, iTypeId);
</script>
{/if}
{literal}
<script>


$(document).ready (function ()
{
	var dataArrayVille = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	
	$("#zCandidatSearch").select2
	({
		initSelection: function (element, callback)
		{
			
			$(dataArrayVille).each(function()
			{
				if (this.id == element.val())
				{
					callback(this);
					return
				}
			})
		},
		allowClear: true,
		placeholder:"S&eacute;lectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez s&eacute;lectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#zCandidatSearch").select2('val',$("#idSelect").val());
	
})

</script>
{/literal}