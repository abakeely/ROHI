{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									{if $oData.oGcap.gcap_statutId > 1}
										visualisation&nbsp;{$oData.zLibelle}
									{else}
										{$oData.zTitre} 
										{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
											&agrave; finaliser
										{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
											&agrave; imprimer
										{/if}
									{/if}
									{if $oData.iSessionCompte>1}
										{if $oData.oCandidatAgent.0->nom!=""}( Agent : {$oData.oCandidatAgent.0->nom}&nbsp;{$oData.oCandidatAgent.0->prenom})
										{/if}
									{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Fiche Congé</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{if $oData.iError == 1}
									<p style="color:red">Aucune d&eacute;cision n'a &eacute;t&eacute; cr&eacute;&eacute;e concernant ce typy de cong&eacute;<br /></p>
								{/if}
								{if $oData.iError == 2}
									<p style="color:red">Le nombre de jour demand&eacute; est sup&eacute;rieur au nombre de jour disponible. (Week end compris)<br /></p>
								{/if}
								{if $oData.iError == 3}
									<p style="color:red">Le nombre de jour demand&eacute; est sup&eacute;rieur au nombre de jour autoris&eacute;e<br /></p>
								{/if}
								{if $oData.iError == 4}
									<p style="color:red">Vous ne disposez plus d'autorisation d'absence pour cette ann&eacute;e (> 15 jours)<br /></p>
								{/if}
								{if $oData.iError == 5}
									<p style="color:red">Vous ne disposez plus de permission pour cette ann&eacute;e (> 20 jours)<br /></p>
								{/if}
								{if $oData.iError == 6}
									<p style="color:red">Vous avez déjà fait une demande d'absence dans cet interval<br /></p>
								{/if}
								{if $oData.iError == 7}
									<p style="color:red">Vous êtes intérim de quelqu'un dans cet interval<br /></p>
								{/if}
								{if $oData.iError == 8}
									<p style="color:red">Vous ne pouvez pas faire une demande plus de 15 jours <br /></p>
								{/if}

								<form action="{$zBasePath}gcap/save/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
									<input type="hidden" name="iTypeGcapId" id="iTypeGcapId" value="{$oData.iTypeGcapId}">
									<input type="hidden" name="zDateToDay" id="zDateToDay" value="{$oData.zDateToDay}">
									<input type="hidden" name="iId" id="iId" value="{$oData.iId}">
									<input type="hidden" name="iSessionCompte" id="iSessionCompte" value="{$oData.iSessionCompte}">
									<input type="hidden" name="zMessageDate" id="zMessageDate" value="Les dates entr&eacute;es sont d&eacute;j&agrave; prise en compte dans une autre demande. Veuillez v&eacute;rifier">
									<fieldset>

										<div class="clearfix" id="typeGcap">
											<div class="cell">
												<div class="field">
													{if $oData.iTypeGcapId == PERMISSION || $oData.iTypeGcapId == REPOS_MEDICAL_LUCIA || $oData.iTypeGcapId == MISSION || $oData.iTypeGcapId == FORMATION}
														{* <label>&nbsp;</label>
														<select id="type_id" name="type_id" class="obligatoire">
															{foreach from=$oData.oType item=oType }
															<option {if $oData.oGcap.gcap_typeId == $oType.type_id} selected="selected" {/if}  value="{$oType.type_id}">{$oType.type_libelle}</option>
															{/foreach}
														</select>
														*}
														{foreach from=$oData.oType item=oType }
														<input type="hidden" id="type_id" name="type_id" value="{$oType.type_id}">
														{/foreach}
													{else}
														<!--modif lucia-->
														{if $oData.iTypeGcapId != REPOS_MEDICAL_LUCIA}
															<label>Type {$oData.zLibelle} *</label>
															{if $oData.iId > 0}
															<input type="hidden" name="type_id" id="" value="{$oData.oGcap.gcap_typeId}">
															{/if}
															<select id="type_id" name="type_id" {if $oData.iId > 0}disabled="disabled"{/if}  class="obligatoire" onChange="getEventCorrespondant('{$zBasePath}',this.value,{$oData.iTypeGcapId});setToolType('{$zBasePath}', this.value);">
																<option value="">S&eacute;l&eacute;ctionner le type {$oData.zLibelle}</option>
																{foreach from=$oData.oType item=oType}
																<option {if $oData.oGcap.gcap_typeId == $oType.type_id} selected="selected" {/if}  value="{$oType.type_id}">{$oType.type_libelle}</option>
																{/foreach}
															</select>
														{/if}
															
														{*<label>Type {$oData.zLibelle} *</label>
														{if $oData.iId > 0}
														<input type="hidden" name="type_id" id="" value="{$oData.oGcap.gcap_typeId}">
														{/if} 
														<select id="type_id" name="type_id" {if $oData.iId > 0}disabled="disabled"{/if}  class="obligatoire" onChange="getEventCorrespondant('{$zBasePath}',this.value,{$oData.iTypeGcapId});setToolType('{$zBasePath}', this.value);">
															<option value="">S&eacute;l&eacute;ctionner le type {$oData.zLibelle}</option>
															{foreach from=$oData.oType item=oType}
															<option {if $oData.oGcap.gcap_typeId == $oType.type_id} selected="selected" {/if}  value="{$oType.type_id}">{$oType.type_libelle}</option>
															{/foreach}
														</select>*}
														<!--fin modif lucia-->
														<i id="allToltip" aria-describedby="tt3" id="demo3" spellcheck="false"  class="la la-info-circle has-tooltip" {if $oData.oGcap.gcap_typeId == ""}style="display:none"{else}style="display:inline-block"{/if}></i>
														<span class="tooltip getType" id="tt3" role="tooltip" aria-hidden="true">
														</span>
														<p class="message">Veuillez s&eacute;l&eacute;ctionner le type {$oData.zLibelle}</p>
													{/if}
												</div>
											</div>
										</div>
										{if $oData.iTypeGcapId == CONGE}
											{if $oData.iId > 0}
												<div class=" clearfix" id="decisionCorrespondant" style="display:block;">
													<div class="cell">
														<div class="field">
															{if sizeof($oData.toDataListeFraction)>0}
															<span style="color:blue;width:90%;padding-top:10px;" class="label">Num&eacute;ro(s) de " {$oData.zLibelleType} " d&eacute;bit&eacute;(s) :</span>
															<table style="width:90%">
																<thead>
																	<tr>
																		<th>D&eacute;but</th>
																		<th>Fin</th>
																		<th>NOMBRE DE JOUR DEBIT&Eacute;s</th>
																		<th>D&eacute;cision Num&eacute;ro</th>
																	</tr>
																</thead>
																<tbody>
																	{assign var=iIncrement value="0"}
																	{foreach from=$oData.toDataListeFraction item=oListe }
																	<tr {if $iIncrement%2 == 0} class="even" {/if}>
																		<td>{$oListe.decision_dateDebut|date_format:"%d/%m/%Y"}</td>
																		<td>{$oListe.decision_dateFin|date_format:"%d/%m/%Y"}</td>
																		<td style="text-align:center;"><span style="color:red;"><b>{$oListe.fraction_nbrJour|replace:'.':','}</b><span></td>
																		<td>{if $oListe.decision_numero != 0}{$oListe.decision_numero}{/if}</td>
																	</tr>
																	{assign var=iIncrement value=$iIncrement+1}
																	{/foreach}
																</tbody>
															</table>
															{else}
																<p style="color:red" class="label"><b>Il n'y a pas de " {$zLibelleType} " &agrave; d&eacute;biter</b></p>
															{/if}
														</div>
													</div>
												</div>
											{else}
												<div class=" clearfix" id="decisionCorrespondant" style="display:none;">
												</div>
											{/if}
										{/if}
										{if $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $oData.iTypeGcapId == REPOS_MEDICAL_LUCIA && $oData.iId == ''}
											<div class=" clearfix">
												<div class="cell">
													<label>Nom de l'agent </label>
													<div class="field">
														<input placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" style="width:500px;" name="iUserAgentId">
														<p id="zCandidatSearchMessage" class="message">Veuillez entrer le nom de l'agent</p>
													</div>
												</div>
											</div>
										{/if}
										<div class=" clearfix">
											<div class="cell small">
												<div class="field">
													<label>Date d&eacute;but *</label>
													<input type="text" name="date_debut" id="date_debut" autocomplete="off" value="{if $oData.oGcap.gcap_dateDebut}{$oData.oGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" {if $oData.oGcap.gcap_statutId >= 1} disabled="disabled"{/if} data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oGcap.gcap_dateDebut}{$oData.oGcap.gcap_dateDebut|date_format2}{/if}" class="datedropper-range-fiche obligatoire">
													<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
												</div>
											</div>
											<div class="cell small">
												<div class="field">
													<label>Date fin *</label>
													<input type="text" name="date_fin" id="date_fin" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oGcap.gcap_dateFin}{$oData.oGcap.gcap_dateFin|date_format2}{/if}" value="{if $oData.oGcap.gcap_dateFin}{$oData.oGcap.gcap_dateFin|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date fin" {if $oData.oGcap.gcap_statutId >= 1} disabled="disabled"{/if} class="datedropper-range-fiche obligatoire">
													<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
												</div>
											</div>
											<div class="cell small" style="display:inline">
												<div class="field">
													<label>&nbsp;</label>
													<p class="check"><input type="checkbox" {if $oData.oGcap.gcap_demiJournee}checked="checked" {/if} id="iDemiJournee"  name="iDemiJournee" value="1"><label>0,5 Jour </label>
													<select id="matinSoir" name="matinSoir" class="obligatoire" style="width: 100px;">
														<option {if $oData.oGcap.gcap_MatinSoir==1} selected="selected" {/if} value="1">Matin</p>
														<option {if $oData.oGcap.gcap_MatinSoir==2} selected="selected" {/if} value="2">Apr&eacute;s-midi</p>
													</select>
													</p>
													
												</div>
											</div>
										</div>
										<br>
										{if $oData.iTypeGcapId == AUTORISATION_ABSENCE}
											<div class="clearfix" id="iPieceJointeId">
												<div class="cell">
													<div class="field" >
														<label>Pi&egrave;ce jointe * </label>
														<input type="file" name="zFile" id="zFile" class="obligatoire" >
														<p class="message">Veuillez remplir le fichier joint </p>
													</div>
												</div>
											</div>
											<br>
											<div class="clearfix">
												<div class="cell">
													<div class="field" id="motifField">
														<label>Motif * </label>
														<select name="motif" id="motif" class="obligatoire" onChange="changeMotif1(this.value)">
														{$oData.zSelect}
														</select>
														<p class="message" {if $oData.oGcap.gcap_statutId > 1} disabled="disabled"{/if} style="width:500px">Veuillez remplir le motif </p>
													</div>
												</div>
											</div>
											
											<!--MODIF LUCIA-->
											<div class=" clearfix" id="conv_pers" {if $oData.oGcap.gcap_motif == AUTORISATION_ABSENCE && $oData.oGcap.gcap_typeId == AUTORISATION_ABSCENCE_ORDINAIRE} style="display:block" {else} style="display:none"{/if}>
												<div class="cell">
													<div class="field" id="motifField">
														<label>Motifs de convenance personnelle * </label>
														<textarea type="text" name="conv_pers" id="champsConvPers" class="obligatoire">{$oData.oGcap.conv_pers}</textarea>
														<p class="message" {if $oData.oGcap.gcap_statutId > 1} disabled="disabled"{/if} style="width:500px">Veuillez remplir le  motif de convenance personnelle </p>
													</div>
												</div>
											</div>
											{*<div class=" clearfix">
												<div class="cell">
													<div class="field" id="motifField">
														<label>Motif * </label>
														<select name="motif" id="motif" class="obligatoire">
														{$oData.zSelect}
														</select>
														<p class="message" {if $oData.oGcap.gcap_statutId > 1} disabled="disabled"{/if} style="width:500px">Veuillez s&eacute;l&eacute;ctionner le motif </p>
													</div>
												</div>
											</div>*}
											
											<!--FIN MODIF LUCIA-->
													
											<div class=" clearfix" id="caracteristiqueAutorisation" {if $oData.oGcap.gcap_typeId == AUTORISATION_SPECIAL_ABSCENCE} style="display:block;" {else} style="display:none;" {/if}>
												<div class="cell">
													<div class="field">
														<label>Caract&eacute;ristique</label>
														<input type="text" name="caracteristique" id="caracteristique" {if $oData.oGcap.gcap_statutId >= 1} disabled="disabled"{/if} value="{if $oData.oGcap.gcap_autorisaionCaracteristique}{$oData.oGcap.gcap_autorisaionCaracteristique}{/if}" placeholder="Caracteristique">
													</div>
												</div>
											</div>
										{else}
											<div class=" clearfix">
												<div class="cell">
													<div class="field">
														<label>Motif *</label>
														<textarea name="motif" id="motif" {if $oData.oGcap.gcap_statutId >= 1} disabled="disabled"{/if} class="obligatoire">{if $oData.oGcap.gcap_motif}{$oData.oGcap.gcap_motif}{/if}</textarea>
														<p class="message" style="width:500px">Veuillez remplir le motif </p>
													</div>
												</div>
											</div>
										{/if}
										<div class=" clearfix">
											<div class="cell">
												<div class="field">
													<label>Lieu de jouissance</label>
													<select name="lieu_jouissance" id="lieu_jouissance">
														{foreach from=$oData.oListeRegion item=oListeRegion}
														<option {if $oData.oGcap.gcap_lieuJouissance == $oListeRegion.libele} selected="selected" {/if}  value="{$oListeRegion.libele}">{$oListeRegion.libele}</option>
														{/foreach}
													</select>
												</div>
											</div>
										</div>
										{if ($oData.iSessionCompte == COMPTE_AUTORITE) ||  $oData.iSessionCompte == COMPTE_ADMIN || $oData.iSessionCompte == COMPTE_EVALUATEUR}
											<!-- MODIF LUCIA 15/09/2016-->
											{if ($oData.oGcap.conv_pers)}
												<div class=" clearfix" id="conv_pers">
													<div class="cell">
														<div class="field" id="motifField">
															<label>Convenance * </label>
															<textarea type="text" name="conv_pers" readonly>{$oData.oGcap.conv_pers}</textarea>
														</div>
													</div>
												</div>
											{/if}
											<!-- FIN MODIF LUCIA 15/09/2016-->
											
											{*<div class=" clearfix">
												<div class="cell">
													<div class="field">
														<label>d&eacute;cision *</label>
														<select id="decision" name="decision" class="obligatoire">
															<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
															<option {if $oData.oGcap.gcap_valide == 1} selected="selected" {/if} value="1">Valider</option>
															<option {if $oData.oGcap.gcap_valide == 2} selected="selected" {/if} value="0">Refuser</option>
														</select>
														<p class="message">Veuillez s&eacute;l&eacute;ctionner votre d&eacute;cision</p>
													</div>
												</div>
											</div>*}
											<input type="hidden" id="decision" name="decision" value="{$oData.oGcap.gcap_valide}">
										{/if}
										<div class=" clearfix">
											<div class="col-sm-12 text-center">
												<br/>
												{if $oData.iSessionCompte == COMPTE_AGENT && $oData.oGcap.gcap_statutId >=  1}
													<!--<input type="button" class="button" onClick="javascript:history.go(-1);" name="" id="Envoyer" value="Retour">-->
												{elseif $oData.iSessionCompte == COMPTE_AGENT && $oData.iId == ""}
													<input type="button" class="button" onClick="valider('{$zBasePath}',1);" name="" id="Envoyer" value="Envoyer">
												{/if}

												{if $oData.iSessionCompte != COMPTE_AGENT}
													{if $oData.iSessionCompte == COMPTE_AUTORITE && $oData.oGcap.gcap_statutId < 3}
													<input type="button" class="button" onClick="validerGcap(1,1);" name="" id="Envoyer" value="Valider">
													<input type="button" class="button" onClick="validerGcap(1,0);" name="" id="Envoyer" value="Refuser">
													<input type="button" class="button" onClick="document.location.href='{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.oGcap.gcap_id}';document.location.target='_blank'" name="" id="" value="Imprimer">
													{/if}
													{if $oData.iSessionCompte == COMPTE_EVALUATEUR && $oData.oGcap.gcap_statutId < 3}
													<input type="button" class="button" onClick="validerGcap(1,1);" name="" id="Envoyer" value="Valider">
													<input type="button" class="button" onClick="validerGcap(1,0);" name="" id="Envoyer" value="Refuser">
													<input type="button" class="button" onClick="document.location.href='{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.oGcap.gcap_id}';document.location.target='_blank'" name="" id="" value="Imprimer">
													{/if}
													{if $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
														{if $oData.iTypeGcapId == REPOS_MEDICAL_LUCIA && $oData.iId == ''}
														<input type="button" class="button" onClick="valider('{$zBasePath}',6);" name="" id="Envoyer" value="Envoyer">
														{else}
														<input type="button" class="button" onClick="document.location.href='{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.oGcap.gcap_id}';document.location.target='_blank'" name="" id="" value="Imprimer">
														{/if}
													{/if}
												{/if}
												<input type="button" class="button" onClick="document.location.href='{$zBasePath}gcap/extrants/gestion-absence/demande'" name="" id="Retour11" value="Retour">
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
			url: "{/literal}{$zBasePath}{literal}gcap/candidatRattache/",
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