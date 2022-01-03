{include_php file=$zCssJs}
<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js?20180927093958"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									{$oData.zLibelle} 
									{if $oData.iSessionCompte == COMPTE_AUTORITE}
										&agrave; valider
									{/if}
									{if $oData.iSessionCompte == COMPTE_HIERARCHIQUE || $oData.iSessionCompte == COMPTE_ADMIN}
										&agrave; finaliser
									{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">{$oData.zLibelle}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{if $oData.iSessionCompte == COMPTE_AGENT}
									<div class="SSttlPage">
										<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
										</form>
										{if $oData.iTypeGcapId != PERMISSION}
										<div class="cell">
											<div class="field text-center">
												<form action="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
												<button>Ajouter</button>
												</form>
											</div>
										</div>
										{/if}
									</div>
									<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireTransaction" id="formulaireTransaction" enctype="multipart/form-data">
									</form>
								{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $oData.iSessionCompte == COMPTE_EVALUATEUR || $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									<div class="SSttlPage">
										<div class="cell">
											<div class="field text-center">
												<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
														<fieldset>
														<div class="row1">
															<div class="cell small">
																<div class="field">
																	<label>Matricule</label>
																	<input type="text" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
																	<p class="message debut" style="width:500px">&nbsp;</p>
																</div>
															</div>
														</div>
														<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
															<div class="cell small">
																<div class="field">
																	<label>CIN</label>
																	<input type="text" name="iCin" id="iCin" autocomplete="off" value="{$oData.iCin}" placeholder="" >
																	<p class="message fin" style="width:500px">&nbsp;</p>
																</div>
															</div>
														</div>
														<div class="row1" >
															<div class="cell">
																<div class="field">
																	<input type="button" class="button" onClick="sendSearch()" name="" id="" value="rechercher">
																	{if $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $oData.iTypeGcapId == 5}
																	<input type="button" style="width:300px;cursor:pointer;" class="button" onClick="document.location.href='{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}'" name="reposMedicalAgent" id="reposMedicalAgent" value="Ajouter un repos médical">
																	{/if}
																</div>
															</div>
														</div>
													</fieldset>
												</form>
									
											</div>
										</div>
									</div>
								{/if}
								<div class="clear"></div>
								<div class="">
									<table>
										<thead>
											<tr>
												<th>Type</th>
												<th>Date d&eacute;but</th>
												<th>Date fin</th>
												<th>Nbr de Jour</th>
												<th>Statut</th>
												{if $oData.iSessionCompte != COMPTE_AGENT}
												<th>Nom et pr&eacute;nom du demandeur</th>
												{/if}
												<th class="center" width="100">Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.oListe)>0}
											{foreach from=$oData.oListe item=oListeGcap }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												{if $oData.iTypeGcapId == CONGE}
													{if $oData.iTypeGcapId != $oListeGcap.gcap_typeGcapId}
														<td>Congé annuel</td>
													{else}
														<td>{$oListeGcap.type_libelle}</td>
													{/if}
												{else}
													<td>{$oListeGcap.type_libelle}</td>
												{/if}
												<td>{$oListeGcap.gcap_dateDebut|date_format|utf8}</td>
												<td>{$oListeGcap.gcap_dateFin|date_format|utf8}</td>
												<td>
												{if $oData.iTypeGcapId == CONGE}
													
													{assign var=iMax value="3"}
													{if $oListeGcap.gcap_typeGcapId == AUTORISATION_ABSENCE AND $oListeGcap.gcap_typeId == AUTORISATION_ABSCENCE_SPECIAL }
														{assign var=iMax value="7"}
													{/if}

													{if $oListeGcap.gcap_typeGcapId == AUTORISATION_ABSENCE AND $oListeGcap.gcap_typeId == AUTORISATION_SPECIAL_ABSCENCE }
														{assign var=iMax value="20"}
													{/if}

													
													{if $oListeGcap.gcap_typeGcapId == AUTORISATION_ABSENCE AND $oListeGcap.iNombreConge > $iMax}
														{assign var=iConge value=$oListeGcap.iNombreConge-$iMax}
														<span style="color:green">- Congé de : {$iConge} jour{if $iConge>1}s{/if}</span><br><br>
														<span style="color:blue">- Autorisation d'absence : {$iMax} jours</span> 
													{else}
														{$oListeGcap.iNombreConge|replace:'.':','}
													{/if}
												{elseif ($oData.iTypeGcapId == AUTORISATION_ABSENCE)}
													
													{assign var=iMax value="3"}
													{if $oListeGcap.gcap_typeGcapId == AUTORISATION_ABSENCE AND $oListeGcap.gcap_typeId == AUTORISATION_ABSCENCE_SPECIAL }
														{assign var=iMax value="7"}
													{/if}

													{if $oListeGcap.gcap_typeGcapId == AUTORISATION_ABSENCE AND $oListeGcap.gcap_typeId == AUTORISATION_SPECIAL_ABSCENCE }
														{assign var=iMax value="20"}
													{/if}
													
													{if $oListeGcap.iNombreConge > $iMax}
														{assign var=iConge value=$oListeGcap.iNombreConge-$iMax}
														<span style="color:blue">- Autorisation d'absence : {$iMax} jours</span> <br><br>
														<span style="color:green">- Congé de : {$iConge} jour{if $iConge>1}s{/if}</span>
													{else}
														{$oListeGcap.iNombreConge|replace:'.':','}
													{/if}
												{else}
													{$oListeGcap.iNombreConge|replace:'.':','}
												{/if}
												</td>
												<td>{if $oListeGcap.gcap_valide==''}
												{$oListeGcap.statut_libelle}
												{else}
													{if $oListeGcap.gcap_valide==1}
													<span style="color:green"><strong>Valid&eacute;</strong></span>
													{else}
													<span style="color:#bc2d2d"><strong>Refus&eacute;</strong></span>
													{/if}
												{/if}
												</td>
												{if $oData.iSessionCompte != COMPTE_AGENT}
												<td>{$oListeGcap.nom}&nbsp;{$oListeGcap.prenom}</td>
												{/if}
												<td class="center">
												{if $oListeGcap.gcap_valide!=2}
												<a title="Imprimer" alt="Imprimer" href="{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{if $oListeGcap.gcap_typeGcapId ==2}conge{elseif $oListeGcap.gcap_typeGcapId==3}autorisation-abscence{else}permission{/if}/{$oListeGcap.gcap_id}" title="" target="_blank" class="action"><i style="color:#12105A" class="la la-print"></i></a>
												{/if}
												{if $oData.iSessionCompte == COMPTE_AGENT}
													{if $oListeGcap.gcap_statutId == STATUT_CREATION}
													<a href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeGcap.gcap_id}" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-eye"></i></a>
													{else}
													<a title="Voir" alt="Voir" href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeGcap.gcap_id}" title="" class="action"><i style="color:#0089DC" class="la la-eye"></i></a>
													{/if}
												{elseif $oData.iSessionCompte > 1}
													{if $oListeGcap.gcap_statutId == STATUT_CREATION}
													<a href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeGcap.gcap_id}" title="En attente de validation" alt="En attente de validation" class="action"><i class="la la-bookmark"></i></a>
													{else}
													<a href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeGcap.gcap_id}" title="Voir fiche" alt="Voir fiche" class="action"><i class="la la-eye"></i></a>
													{/if}
													{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
													<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeGcap.gcap_id}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
													{/if}
												{/if}
												</td>
												
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
									{$oData.zPagination}
								</div>

								<div id="calendar"></div>
							
								<div id="dialogGcap" title="Demande d'absence"></div>
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
									<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">

									<input type="hidden" name="idSelect" id="idSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->user_id}{/if}">
									<input type="hidden" name="textSelect" id="textSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->nom}&nbsp;{$oData.oCandidatSearch->prenom}{/if}">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
								</form>
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