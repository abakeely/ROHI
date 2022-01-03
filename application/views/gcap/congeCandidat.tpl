{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Gestion cong&eacute; pass&eacute; d'un agent</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Congé</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<!--<form action="{$zBasePath}gcap/congeCandidatPasse" method="POST" name="formulaireEdit" id="formulaireEdit"  enctype="multipart/form-data">
									<fieldset>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<input placeholder="Veuillez entrer le nom du candidat" type="text" id="zCandidat" name="zCandidat" value="{$oData.zCandidat}">
													<p id="candidateMsg" class="message">Veuillez choisir un candidat</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<input type="button" class="button" onClick="valider(3);" name="" id="" value="Valider">
												</div>
											</div>
										</div>
									</fieldset>
								</form>-->
								<div class="card punch-status">
									<form action="{$zBasePath}gcap/congeCandidatPasse" method="POST" name="formulaireTransaction" id="formulaireTransaction" enctype="multipart/form-data">
										<fieldset>
											<div class="row1">
												<div class="cell small">
													<div class="field">
														<label>Matricule</label>
														<input class="form-control" type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
														<p class="message debut" style="width:500px">&nbsp;</p>
													</div>
												</div>
											</div>
											<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
												<div class="cell small">
													<div class="field">
														<label>CIN</label>
														<input class="form-control" type="text" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
														<p class="message fin" style="width:500px">&nbsp;</p>
													</div>
												</div>
											</div>
											<div class="row1" style="padding: 20px 0 20px;">
												<div class="cell">
													<div class="field">
														<input class="form-control" type="button" class="button" onClick="sendFormSearch()" name="" id="" value="rechercher">
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
								
								<div class="clear"></div>
								<div class="table-responsive">
								<table class="datatable table-bordered table-striped mb-0 ">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Pr&eacute;Nom</th>
											<th>Matricule</th>
											<th>cong&eacute;</th>
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
											<!--<td><input type="text" onChange="getConge({$oListeCompte->id});" value="{$oListeCompte->conge_value}" name="conge_value_{$oListeCompte->id}" id="conge_value_{$oListeCompte->id}"></td>-->
											<td>
											<a href="{$zBasePath}gcap/editConge/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeCompte.user_id}" title="" class="action"><i style="color:#12105A" class="la la-edit"></i></a>

											<a target="_blank" href="{$zBasePath}gcap/printCongeAgent/{$oData.zHashModule}/print-decision/{$oListeCompte.user_id}" title="" class="action"><i style="color:#12105A" class="la la-print"></i></a>
											
											</td>
											
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
										{/if}
									</tbody>
								</table>
							
								<div id="calendar"></div>

								<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/congeCandidatPasse">
								<input type="hidden" name="zMessage" id="zMessage" value="Cong&eacute; enregistr&eacute; avec succ&egrave;s">
								<input type="hidden" name="zMessageErreur" id="zMessageErreur" value="la valeur entr&eacute;e n'est pas num&eacute;rique">
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
	function getConge(iUserId)
	{
		var iValue = $("#conge_value_"+iUserId).val();

		iValue = parseInt (iValue);

		if (iValue > 0)
		{
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}gcap/saveConge/" + iUserId + "/" + iValue,
				type: 'get',
				success: function(data, textStatus, jqXHR) {

					alert($("#zMessage").val());
				},
				async: false
			});
		}
		else
		{
			alert($("#zMessageErreur").val());
		}

	}
</script>
{/literal}