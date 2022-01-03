{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste des agents rattach&eacute;s</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Agents rattachés</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{if $oData.iSessionCompte != COMPTE_AGENT}
									<div class="card punch-status">
										<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
												<fieldset>
												<div class="row1">
													<div class="cell small">
														<div class="field">
															<label>Matricule</label>
															<input type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
													<div class="cell small">
														<div class="field">
															<label>CIN</label>
															<input type="text" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
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
									<div><p>&nbsp;</p></div>
									<form action="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}/" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
										<fieldset>
											<div class="clearfix">
												<div class="cell">
													<div class="field">
														<button style="width:250px">Liste des d&eacute;cisions</button>
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								{else}
									<input type="button" class="button" onClick="document.location.href='{$zBasePath}gcap/rattache/{$oData.zHashModule}/{$oData.zHashUrl}/';"  value="Liste des agents rattach&eacute;s">
								{/if}
								<table>
									<thead>
										<tr>
											<th>Nom</th>
											<th>P&eacute;Nom</th>
											<th>Matricule</th>
											<th>Direction</th>
											<th>Service</th>
											<th>Division</th>
											<th style="text-align:center;">d&eacute;cision &agrave; valider</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.oListe)>0}
										{foreach from=$oData.oListe item=oListeCompte }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											<td>{$oListeCompte.nom|upper}</td>
											<td>{$oListeCompte.prenom}</td>
											<td>{$oListeCompte.matricule}</td>
											<td>{$oListeCompte.zDirection}</td>
											<td>{$oListeCompte.zService}</td>
											<td>{$oListeCompte.zDivision}</td>
											<td class="center">{$oListeCompte.nbDecision}</td>
											
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
										{/if}
									</tbody>
								</table>
								{$oData.zPagination}

								<div id="calendar"></div>
							
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/rattache/{$oData.zHashModule}/{$oData.zHashUrl}">
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