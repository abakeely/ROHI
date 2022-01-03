{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">{$oData.zLibelle}</h3>
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
								{if $oData.iSessionCompte != COMPTE_AGENT}
									<div class="SSttlPage">
										<div class="cell">
											<div class="field text-center">
											<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
												<fieldset>
												<div class="row1">
													<div class="cell small">
														<div class="field">
															<label>Matricule</label>
															<input type="text" name="iMatricule" id="iMatricule" autocomplete="off" value="{$oData.iMatricule}" placeholder="">
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
												<th>Ann&eacute;e</th>
												{*<th>Caract&eacute;ristique</th>*}
												<th>Statut</th>
												{if $oData.iSessionCompte != COMPTE_AGENT}
												<th>Nom et pr&eacute;nom demandeur</th>
												{/if}
												<th>Valider</th>
												<th class="center" >Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.oListe)>0}
											{foreach from=$oData.oListe item=oListeDecision }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeDecision.type_libelle}</td>
												<td>{$oListeDecision.decision_annee}</td>
												{*<td>{$oListeDecision.decision_caracteristique}</td>*}
												<td>{$oListeDecision.statut_libelle}</td>
												{if $oData.iSessionCompte != COMPTE_AGENT}
												<td>{$oListeDecision.nom}&nbsp;{$oListeDecision.prenom}
												<br/>-&nbsp;{$oListeDecision.zDirection}
												{if $oListeDecision.zService != '' && $oListeDecision.zService != $oListeDecision.zDirection}<br/>-&nbsp;{$oListeDecision.zService}{/if}
												{if $oListeDecision.zDivision != '' && $oListeDecision.zDivision != $oListeDecision.zService}<br/>-&nbsp;{$oListeDecision.zDivision}{/if}
												</td>
												{/if}
												<td>
													
														{if $oListeDecision.decision_valide == 1 and $oListeDecision.decision_userValidId != "" and $oListeDecision.decision_dateValidation != ""}
															<span class="action"><i style="color:#53D00F;" class="la la-check"></i></span>Validation&nbsp;({$oListeDecision.decision_dateValidation|date_format|utf8})
														{elseif $oListeDecision.decision_valide == 2 and $oListeDecision.decision_userValidId != "" and $oListeDecision.decision_dateValidation != ""}
														Refus&eacute;&nbsp;({$oListeDecision.decision_dateValidation|date_format|utf8})
														{else}
															&nbsp;
														{/if}
														<br/>
														{if $oListeDecision.decision_finalisation == 1 and $oListeDecision.decision_userAutoriteId != ""}
															<span class="action"><i class="la la-check"></i></span>Finalisation&nbsp;({$oListeDecision.decision_dateFinalisation|date_format|utf8})
															&nbsp;
														{/if}
													
												</td>
												<td class="center">
													{if $oListeDecision.decision_valide == 0 || $oData.iSessionCompte == COMPTE_AGENT}
													<a title="Modifier" alt="Modifier" href="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" title="" class="action"><i style="color:#12105A" class="fa {if $oData.iSessionCompte != COMPTE_AGENT}fa-edit{else}fa-eye{/if}"></i></a>
													{/if}
													<a title="Imprimer" alt="Imprimer" {if $oListeDecision.decision_valide == 1 and $oListeDecision.decision_userValidId != "" and $oListeDecision.decision_dateValidation != ""}href="{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeDecision.decision_id}" target="_target"{else}href="#leftContent"{/if}   class="action"><i  {if $oListeDecision.decision_valide == 1 and $oListeDecision.decision_userValidId != "" and $oListeDecision.decision_dateValidation != ""}style="color:#12105A"{else}style="color:#D0D0D0"{/if} class="la la-print"></i></a>
													

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
									<input type="hidden" name="iElementId" id="iElementId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/extrants/{$oData.zHashModule}/{$oData.zHashUrl}">
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