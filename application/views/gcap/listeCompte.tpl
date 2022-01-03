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
									<li class="breadcrumb-item">Liste compte</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<form action="{$zBasePath}gcap/saveCompte" method="POST" name="formulaireEdit" id="formulaireEdit"  enctype="multipart/form-data">
									<fieldset>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<input placeholder="Veuillez entrer le nom du candidat" type="text" id="zCandidat" name="zCandidat">
													<p id="candidateMsg" class="message">Veuillez choisir un candidat</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<select name="iCompteId" id="iCompteId" onChange="setDelegue(this.value);" class="obligatoire" style="width:200px;">
													<option  value="">  S&eacute;l&eacute;ctionner un Compte</option>
													<option  value="2">Compte Responsable personnel</option>
													<option  value="3">Compte Autorit&eacute;</option>
													<option  value="4">Compte Administrateur</option>
													</select>
													<p class="message">Veuillez s&eacute;l&eacute;ctionner une fonction</p>
												</div>
											</div>
										</div>
										<div class="clearfix" id="delegue" style="display:none;">
											<div class="cell">
												<div class="field">
													<select name="delegue" id="delegue" style="width:200px;">
													<option  value="">  D&eacute;l&eacute;gu&eacute; &agrave; mon nom</option>
													<option  value="0">Non</option>
													<option  value="1">Oui</option>
													</select>
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
								</form>
								<div class="clear"></div>
								<table>
									<thead>
										<tr>
											<th>Nom</th>
											<th>P&eacute;Nom</th>
											<th>Matricule</th>
											<th>compte assign&eacute;</th>
											<th class="center" width="100">Action</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.oListe)>0}
										{foreach from=$oData.oListe item=oListeCompte }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											<td>{$oListeCompte->nom|upper}</td>
											<td>{$oListeCompte->prenom}</td>
											<td>{$oListeCompte->matricule}</td>
											<td>
											{if $oListeCompte->userCompte_compteId == COMPTE_RESPONSABLE_PERSONNEL}
											Compte Responsable Personnel
											{elseif $oListeCompte->userCompte_compteId == COMPTE_AUTORITE}
											Compte Autorit&eacute;
											{else}
											Compte Administrateur
											{/if}
											</td>
											<td class="center">
											<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeCompte->userCompte_userId}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
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
<script>

$(document).ready (function ()
{
	$("#zCandidat").select2
	({
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
})

</script>
{/literal}