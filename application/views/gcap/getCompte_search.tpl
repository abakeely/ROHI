{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Gestion compte</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Recherche compte</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="SSttlPage">
									<div id="searchAcc">
										<div class="card punch-status">
											<h2>Assignation de compte pour un Agent</h2>
										<form action="{$zBasePath}gcap/saveCompteAssign" style="display:block;" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" >
											<input type="hidden" name="idSelect" id="idSelect" value="{$oData.oCandidatAffiche.0->user_id}">
											<input type="hidden" name="textSelect" id="textSelect" value="{$oData.oCandidatAffiche.0->nom} {$oData.oCandidatAffiche.0->prenom}">
												<fieldset>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>&nbsp;</label>
																<select style="width:150px!important" class="form-control" name="type" onchange="changeMask()" id="type">
																	<option value="im">MATRICULE</option>
																	<option value="cin">CIN</option>
																</select>

																<p class="message debut" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Matricule ou CIN</label>
																<input style="width:150px!important" class="form-control" placeholder="matricule ou CIN" name="im" id="num" value="{$oData.oCandidatAffiche.0->matricule}" />
															</div>
														</div>
													</div>
													<div class="row1" id="searchCandidat">
														<div class="cell">
															<div class="field">
																	<label>&nbsp;</label>
																	<input style="width:300px!important" placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidat" name="zCandidat">
															</div>
														</div>
													</div>
													<br>
													<div class="row clearfix">
														<div class="cell">
															<div class="field">
																{foreach from=$oData.toCompte item=oListeCompte}
																{if $oListeCompte.compte_id > 1 && $oListeCompte.compte_id != 8}
																<p><input type="checkbox" style="height: 18px!important;width: 18px!important;vertical-align: middle;padding-top: 0px;margin-top: -3px!important;" 
																{foreach from=$oData.toCompteUser item=oCompteUser}
																	{if $oCompteUser.compte_id == $oListeCompte.compte_id} checked="checked" {/if}
																{/foreach}
																
																name="iCompte_{$oListeCompte.compte_id}" value="{$oListeCompte.compte_id}" id="iCompte_{$oListeCompte.compte_id}">&nbsp;&nbsp;{$oListeCompte.compte_libelle}</p>
																{/if}
																{/foreach}
															</div>
														</div>
													</div>
													<br><br><br>
													<div class="row clearfix">
														<div class="cell">
															<div class="field">
																<button style="width:150px;">Valider</button>
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
										
									</div>
								</div>
								<div class="clear"></div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/deleteCompte" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer le compte de cet utilisateur ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/compte">
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
.matricule {
    padding: 10px 0;
}

</style>
<script type="text/javascript">

$(document).ready (function ()
{
			
			var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidat").select2
			({
				initSelection: function (element, callback)
				{
					
					$(dataArrayAgent).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
				},
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				formatNoMatches: function () { return "Aucun résultat trouvé"; },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " caractères"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return "Chargement des résultats ..."; },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
					dataType: 'jsonp',
					data: function (term)
					{
						return {q: term, iFiltre:0};
					},
					results: function (data)
					{
						return {results: data};
					}
				},
				dropdownCssClass: "bigdrop"
			}) ;

	$("#zCandidat").select2('val',$("#idSelect").val());	
})

</script>
{/literal}