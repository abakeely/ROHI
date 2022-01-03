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
												<form action="{$zBasePath}gcap/delegationPouvoir/" method="POST" name="formulaireDelegation" id="formulaireDelegation" enctype="multipart/form-data">

												<fieldset>
													<div class="row1">
														<div class="cell small">
															<div class="field">
																<label>Matricule de l'evaluateur</label>
																<input type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
																<p class="message debut" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1" style="padding: 26px 0 20px;">
														<div class="cell">
															<div class="field">
																<input type="button" class="button" onClick="sendSearch()" name="" id="" value="Enregistrer">
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
												<th class="center" width="100">Action</th>
												<th>Matricule</th>
												<th>Nom</th>
												<th>Prenoms</th>
												<th>Localite de service</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toListAgentsAEvaluer)>0}
											{foreach from=$oData.toListAgentsAEvaluer item=oAgentsAEvaluer }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>
													<input type="checkbox" name="list_agent_a_evaluer[]" value="{$oAgentsAEvaluer.user_id}"> 
												</td>
												<td>{$oAgentsAEvaluer.matricule}</td>
												<td>{$oAgentsAEvaluer.nom}</td>
												<td>{$oAgentsAEvaluer.prenom}</td>
												<td>{$oAgentsAEvaluer.lacalite_service}</td>
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


$(document).ready (function (){
	
})

</script>
{/literal}