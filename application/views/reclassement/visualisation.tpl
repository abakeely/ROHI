{include_php file=$zCssJs}

<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Visualisations</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Visualisations</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<table>
										<tr>
										<td>
											<form class="Cv-form" style="font-size: 16px!important;" action="">
												<fieldset>
													<table>
														<div class="panel panel-default">
														{assign var=iIncrement value="0"}
														{foreach from=$oData.oInfoReclassement item=oInfoReclassement }
															{assign var=iTitle value=$iIncrement+1}
															{if $oData.iSize>1}
															<div class="panel-title">
																<a  href="#EtatCivil{$iTitle}" data-toggle="collapse" {if $iIncrement>0} class="collapsed" {/if}>Reclassement {$iTitle}</a>
															</div>
															{/if}
															<div id="EtatCivil{$iTitle}" class="panel-collapse {if $iIncrement>0}collapse{/if}">
																<div class="panel-body">
																	<div class="libele_form">
																		<span style="color:green;"><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Information sur le reclassement demandé </strong><br><br></span>
																	</div>
																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span class="notAffiche">&nbsp;<strong>Institut : </strong> {$oInfoReclassement.institut_libelle}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Diplôme : </strong> {$oInfoReclassement.diplome_libelle}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Domaine : </strong> {$oInfoReclassement.reclassement_domaine}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Nom et prénom : </strong> {$oInfoReclassement.nom}&nbsp;{$oData.oInfoReclassement.prenom}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Matricule : </strong> {$oInfoReclassement.matricule}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Type de dossier : </strong> {$oInfoReclassement.typeReclassement_libelle}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Département : </strong> {$oInfoReclassement.departement}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Direction : </strong> {$oInfoReclassement.direction}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Service : </strong> {$oInfoReclassement.service}</span>
																		</label>
																	</div>

																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Dossier préparé par : </strong> {$oInfoReclassement.responsable}</span>
																		</label>
																	</div>
																	{if $oInfoReclassement.reclassement_userAutoriteId || $oInfoReclassement.reclassement_autoriteSaisi!=''}
																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<strong>Validé par : </strong> {if $oInfoReclassement.autorite!=''}{$oInfoReclassement.autorite}{else}{$oInfoReclassement.reclassement_autoriteSaisi}{/if}</span>
																		</label>
																	</div>
																	{/if}
																	<div class="libele_form">
																		<span style="color:green;"><br><br><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Etat de circuit de dossier</strong><br><br></span>
																	</div>
																	{foreach from=$oData.oInfoReclassement.$iIncrement.oCircuitReclassement item=oCircuitReclassement }
																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<i style="color:orange;font-size:20px;" class="la la-folder" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;{$oCircuitReclassement->suivi_libelle}&nbsp;du&nbsp;{$oCircuitReclassement->circuitReclassement_date|date_format:"%d/%m/%Y"}</span>
																		</label>
																	</div>
																	{/foreach}

																	<div class="libele_form">
																		<span style="color:green;"><br><br><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Pièces manquantes</strong><br><br></span>
																	</div>
																	{foreach from=$oData.oInfoReclassement.$iIncrement.oPiecesJointesManquante item=oPiecesJointesManquante }
																	<div class="libele_form">
																		<label class="control-label" data-original-title="" title="">
																			<span>&nbsp;<i style="color:blue;font-size:20px;" class="la la-paperclip" aria-hidden="true"></i>&nbsp;{$oPiecesJointesManquante->pieceJointe_libelle}</span>
																		</label>
																	</div>
																	{/foreach}

																</div>
															</div>
														{assign var=iIncrement value=$iIncrement+1}
														{/foreach}
														</div>
													</table>
												</fieldset>
											</form>
										</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>		
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<script>

</script>
{/literal}