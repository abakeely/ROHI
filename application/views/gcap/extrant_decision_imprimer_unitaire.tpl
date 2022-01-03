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
								<div class="row">
									<div class="col-sm-12">
										<div class="card mt-2">
											<div class="card-body">
												<table>
													<thead>
														<tr>
															<th>Type de cong&eacute;</th>
															<th>Ann&eacute;e de d&eacute;cision</th>
															<th>Nom</th>
															<th>Pr&eacute;noms</th>
															<th>Statut</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														
														{assign var=iBoucle value=$oData.annee}
															{assign var=iAnnePrise value=$oData.iAnnePriseDecision}
															{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}
																{if $smarty.section.iAnnee.index <= $oData.annee}
																		<tr>
																			<td>Décision de congé annuel</td>
																			<td>{$smarty.section.iAnnee.index}</td>
																			<td>{$oData.oUser.nom}</td>
																			<td>{$oData.oUser.prenom}</td>
																			<td>
																				{if $smarty.section.iAnnee.index|in_array:$oData.toAnneeSigner}
																				<span class="action"><i style="color:#53D00F;" class="la la-check"></i></span>Validé par l'autorité
																				{/if}
																			</td>
																			<td>
																			{if $smarty.section.iAnnee.index|in_array:$oData.toAnneeSigner}
																			{else}
																				<a title="Imprimer" alt="Imprimer" href="{$zBasePath}gcap/imprimerDecision/{$oData.zHashModule}/{$oData.zHashUrl}/{$smarty.section.iAnnee.index}/{$oData.oUser.id}" target="_blank" class="action"><i  style="color:#12105A" class="la la-print"></i></a>
																			{/if}
																			</td>
																		</tr>
																{/if}
															{/section}
													</tbody>
												</table>
											</div>
										</div>
									</div>
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