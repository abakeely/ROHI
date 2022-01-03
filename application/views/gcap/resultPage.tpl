{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
				{if $oData.iAfficheEdit == 1}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">{$oData.zLibelle}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Décision</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<form action="{$zBasePath}gcap/rattache/{$oData.zHashModule}/{$oData.zHashUrl}/" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
									<fieldset>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<label>Localite / Porte</label>
													<input type="text" name="zLocalite" id="zLocalite" value="{$oData.oDataSearch.zLocalite}" placeholder="Localite / Porte">
												</div>
											</div>
										</div>
										<div class="row1">
											<div class="cell">
												<div class="field">
													<label>Matricule</label>
													<input type="text" name="iMatricule" id="iMatricule" value="{$oData.oDataSearch.iMatricule}" placeholder="">
													<p class="message debut" style="width:500px">&nbsp;</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<label>CIN</label>
													<input type="text" name="iCin" id="iCin" value="{$oData.oDataSearch.iCin}" placeholder="" >
													<p class="message fin" style="width:500px">&nbsp;</p>
												</div>
											</div>
										</div>
										<div class="row1">
												<div class="cell" >
													<div class="field"> 
														<label>Departement</label>
														<select id="iDepartementId" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
															<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
															{foreach from=$oData.oDepartement item=oDepartement }
															<option {if $oDepartement.id == $oData.oDataSearch.iDepartementId} selected="selected" {/if} value="{$oDepartement.id}">{$oDepartement.libele}</option>
															{/foreach}
														</select>
													</div>
												</div>
											</div>
											<div class="clearfix">
												<div class="cell">
													<div class="field"> 
														<label>Direction</label>
														<select id="iOrganisation_1" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
															<option value="0">s&eacute;l&eacute;ctionner une direction</option>
															{foreach from=$oData.oDirection item=oDirection }
															<option {if $oDirection.id == $oData.oDataSearch.iDirectionId} selected="selected" {/if} value="{$oDirection.id}">{$oDirection.libele}</option>
															{/foreach}
														</select>
													</div>
												</div>
											</div>
											<div class="row1">
												<div class="cell"  >
													<div class="field"> 
														<label>Service</label>
														<select id="iOrganisation_2" name="iServiceId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
															<option value="0">s&eacute;l&eacute;ctionner un service</option>
															{foreach from=$oData.oService item=oService }
															<option {if $oService.id == $oData.oDataSearch.iServiceId} selected="selected" {/if} value="{$oService.id}">{$oService.libele}</option>
															{/foreach}
														</select>
													</div>
												</div>
											</div>
											<div class="clearfix">
												<div class="cell">
													<div class="field">
														<label>Parcours / Diplôme</label>
														<input type="text" name="zParcoursDiplome" id="zParcoursDiplome" value="{$oData.oDataSearch.zParcoursDiplome}" placeholder="Parcours / Diplôme">
													</div>
												</div>
											</div>
											<div class="clearfix" >
												<div class="cell">
													<div class="field">
														<input type="button" class="button" onClick="sendSearch()" name="" id="" value="rechercher">
													</div>
												</div>
											</div>
									</fieldset>
								</form>
								<div><p>&nbsp;</p></div>
								
								<table>
									<thead>
										<tr>
											<th>IM</th>
											<th>Nom</th>
											<th>Pr&eacute;nom</th>
											<th style="width:100px;">T&eacute;l&eacute;phone</th>
											<th>E-mail</th>
											<th>Poste</th>
											<th>Parcours</th>
											<th>Diplôme</th>
											<th>Localité</th>
										</tr>
									</thead>
									<tbody>
										{if $oData.iSearch == 1}
											{assign var=iIncrement value="0"}
											{if sizeof($oData.oListe)>0}
											{foreach from=$oData.oListe item=oListeCandidat }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeCandidat.matricule}</td>
												<td>{$oListeCandidat.zNom}</td>
												<td>{$oListeCandidat.prenom}</td>
												<td>{$oListeCandidat.phone}</td>
												<td>{$oListeCandidat.email}</td>
												<td>{$oListeCandidat.poste}</td>
												<td>{if $oListeCandidat.parcours != ''}-&nbsp;{$oListeCandidat.parcours}{/if}</td>
												<td>{if $oListeCandidat.diplome != ''}-&nbsp;{$oListeCandidat.diplome}{/if}</td>
												<td>
												{$oListeCandidat.zDepartement}<br/><br/>
												{if $oListeCandidat.zDirection != "" && $oListeCandidat.zDirection != $oListeCandidat.zDepartement}{$oListeCandidat.zDirection}{/if}<br/><br/>
												{if $oListeCandidat.zService != "" && $oListeCandidat.zService != $oListeCandidat.zDirection && $oListeCandidat.zService != $oListeCandidat.zDepartement}{$oListeCandidat.zService}{/if}<br/><br/>
												</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="9">{$oData.zMessageAucun}</td></tr>
											{/if}
										{else}
											<tr><td style="text-align:center;" colspan="9">Veuillez faire une recherche</td></tr>
										{/if}
									</tbody>
								</table>
								{if $oData.iSearch == 1}
								{$oData.zPagination}
								{/if}
				{else}
					<h2>Vous n'avez pas accès à cette page</h2>
				{/if}
	
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}common/searchResult">
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
<style>
form#formulaireSearch select {
     padding: 10px; 
}
</style>
{/literal}