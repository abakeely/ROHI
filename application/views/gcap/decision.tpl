{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									Liste des D&eacute;cisions {if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									&agrave; finaliser
									{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
									&agrave; imprimer
									{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">D&eacute;cision</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{if $oData.iSessionCompte == COMPTE_AGENT}
									<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
									</form>
								{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									<div class="SSttlPage">
										<div class="cell">
											<div class="field text-center">
												<form action="{$zBasePath}gcap/rattache/{$oData.zHashModule}/{$oData.zHashUrl}/" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
													<fieldset>
														<div class="row1">
															<div class="cell small">
																<div class="field">
																	<label>Matricule</label>
																	<input type="text" class="form-control" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
																	<p class="message debut" style="width:500px">&nbsp;</p>
																</div>
															</div>
														</div>
														<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
															<div class="cell small">
																<div class="field">
																	<label>CIN</label>
																	<input type="text" class="form-control" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
																	<p class="message fin" style="width:500px">&nbsp;</p>
																</div>
															</div>
														</div>
														<div class="row1" style="padding: 26px 0 20px;">
															<div class="cell">
																<div class="field">
																	<input type="button" class="button" onClick="sendSearch()" name="" id="" value="rechercher">
																	<button style="width:250px">Liste des agents rattach&eacute;s</button>
																</div>
															</div>
														</div>
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								{/if}
								<div class="">
									<table>
										<thead>
											<tr>
												<th>Type de cong&eacute;</th>
												<th>Ann&eacute;e</th>
												<th>Statut</th>
												{if $oData.iSessionCompte != COMPTE_AGENT}
												<th>Nom et pr&eacute;nom du demandeur</th>
												{/if}
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.oListe)>0}
											{foreach from=$oData.oListe item=oListeDecision }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeDecision.type_libelle}</td>
												<td>{$oListeDecision.decision_annee}</td>
												<td>{$oListeDecision.statut_libelle}</td>
												{if $oData.iSessionCompte != COMPTE_AGENT}
												<td>{$oListeDecision.nom}&nbsp;{$oListeDecision.prenom}</td>
												{/if}
												<td>
												<a title="Imprimer" alt="Imprimer" href="{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" target="_blank" class="action"><i  style="color:#12105A" class="la la-print"></i></a>
												{if $oData.iSessionCompte == COMPTE_AGENT}
													{if $oListeDecision.decision_statutId == STATUT_CREATION}
													<a href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
													<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeDecision.decision_id}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
													{else}
													<a title="Voir" alt="Voir" href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" class="action"><i style="color:#0089DC" class="la la-eye"></i></a>
													{/if}
												{elseif $oData.iSessionCompte > 1}	
													{if $oListeDecision.decision_statutId == STATUT_CREATION}
													<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeDecision.decision_id}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
													<a href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" title="" class="action"><i class="la la-bookmark"></i></a>
													{else}
													<a href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" title="" class="action"><i class="la la-eye"></i></a>
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