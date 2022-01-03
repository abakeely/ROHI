{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Agents rattachés</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Agents rattachés</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
										<div class="card punch-status">
											<h5>RECHERCHE</h5>
											{if $oData.iAfficheEvaluateur == 1}
											<form action="{$zBasePath}evaluation/liste/agent-evaluation/agents-rattaches" style="display:block!important" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
											{else}
											<form action="{$zBasePath}pointage/liste/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iCurrPage}" style="display:block!important" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
											{/if}
												<fieldset>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Matricule *</label>
																<input type="text" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
																<p class="message debut" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>CIN</label>
																<input type="text" name="iCin" autocomplete="off" id="iCin" value="" placeholder="" >
																<p class="message fin" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field" style="text-align:center">
																<input type="button" class="button" onClick="rechercher();" name="" id="" value="rechercher">
															</div>
														</div>
													</div>
												</fieldset>
											</form>
								</div>
							
		
								<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-body">

									  <div class="table-responsive">
									<table class="datatable table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Matricule</th>
												<th>Nom</th>
												<th>Pr&eacute;Nom</th>
												<th>Localité de service</th>
												{if $oData.iAfficheEvaluateur == 1}
												<th style="text-align:center">Evaluateur</th>
												<th style="text-align:center">Liste Agents &eacute;valu&eacute;s</th>
												{else}
												<th>Saisie</th>
												{/if}
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.oListe)>0}
											{foreach from=$oData.oListe item=oListeCompte }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeCompte.matricule}</td>
												<td>{$oListeCompte.nom}</td>
												<td>{$oListeCompte.prenom}</td>
												<td>{$oListeApprouver->path}</td>
												{if $oData.iAfficheEvaluateur == 1}
												<td style="text-align:center"><p class="check"><input type="checkbox" onclick="setCompteEvaluateur({$oListeCompte.user_id})" name="evaluateur_{$oListeCompte.user_id}" id="evaluateur_{$oListeCompte.user_id}" value="" {if $oListeCompte.iCompte > 0} checked="checked"{/if} ><label>&nbsp;</label></p></td>
												<td id="listeAgentAEvalue_{$oListeCompte.user_id}" style="text-align:center">{if $oListeCompte.iCompte > 0}<a href="{$zBasePath}evaluation/liste/agents/evalues/1/{$oListeCompte.user_id}" target="_blank"><i style="color:#12105A" class="la la-user"></i></a>{/if}</td>
												
												{else}
												<td>{*<a style="cursor:pointer;text-decoration:#53d00f" href="{$zBasePath}pointage/saisi/{$oData.zHashModule}/conges-et-autres/{$oListeCompte.user_id}" ><i style="color:#12105A" class="la la-eye"></i>&nbsp;Cong&eacute;s et Autres </a>
													<br><br>*}
													{if isset($oListeCompte.badge_date)}
													<a href="{$zBasePath}pointage/saisi/{$oData.zHashModule}/badge-perdu/{$oListeCompte.user_id}"><i style="color:red" class="la la-hand-paper-o"></i>&nbsp;Badge perdu</a>
													<br><br>
													{/if}
													<a href="{$zBasePath}pointage/saisi/{$oData.zHashModule}/entree-et-sortie/{$oListeCompte.user_id}"><i style="color:#12105A" class="la la-eye"></i>&nbsp;Badge oubli&eacute;</a>
													<br><br>
													<a style="cursor:pointer;text-decoration:#53d00f" href="{$zBasePath}pointage/saisi/{$oData.zHashModule}/mission/{$oListeCompte.user_id}" ><i style="color:#12105A" class="la la-eye"></i>&nbsp;Mission heure de bureau</a>
													<br><br>
													<a style="cursor:pointer;text-decoration:#53d00f" href="{$zBasePath}pointage/saisi/{$oData.zHashModule}/formation/{$oListeCompte.user_id}" ><i style="color:#12105A" class="la la-eye"></i>&nbsp;Formation heure de bureau</a>
												</td>
												{/if}
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="10">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
								
								</div>
							</div>
						</div>


					</div>
					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>	
			<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
				<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
				<input type="hidden" name="iElementId" id="iValueId" value="">
				{if $oData.iAfficheEvaluateur == 1}
				<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}evaluation/liste/agent-evaluation/agents-rattaches">
				{else}
				<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
				{/if}
				<input type="hidden" name="zUrlAgentAEvaluer" id="zUrlAgentAEvaluer" value="{$zBasePath}evaluation/liste/agents/evalues/1">
			</form>
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


<script>

{if sizeof($oData.oListe)>0}
{literal}
$(document).ready(function() {
        /*$('#dataTables-example').dataTable();*/
	});
{/literal}
{/if}
{literal}
function setCompteEvaluateur(_iUserId) {
	var iSend = 0;
	if( $("#evaluateur_" + _iUserId).is(':checked') ) {
		var zUrlAgentEvaluer = $("#zUrlAgentAEvaluer").val() + "/" + _iUserId ; 
		$("#listeAgentAEvalue_" + _iUserId).html('<a href="'+zUrlAgentEvaluer+'" target="_blank"><i style="color:#12105A" class="la la-user"></i></a>');
		iSend = 1;
	} else {
		$("#listeAgentAEvalue_" + _iUserId).html('');
		iSend = 0;
	}

	$.ajax({
		url: "{/literal}{$zBasePath}{literal}evaluation/setCompte/",
		method: "POST",
		data: { iSend : iSend, iUserId : _iUserId},
		success: function(data, textStatus, jqXHR) {
		},
		async: false
	});
}
{/literal}
</script>
