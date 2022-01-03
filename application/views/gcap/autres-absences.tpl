{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">AUTRES ABSENCES</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Autres absences</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<form action="{$zBasePath}gcap/save2/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
									
									<fieldset>
										<div class="clearfix">
											<div class="cell">
												<label>Nom de l'agent </label>
												<div class="field">
													<input placeholder="Veuillez entrer le nom de l'agent" type="text" class="form-control" id="zCandidatSearch" name="iUserAgentId" class="obligatoire">
													<p id="zCandidatSearchMessage" class="message">Veuillez entrer le nom de l'agent</p>
												</div>
											</div>
										</div>
										<div class="clearfix" id="typeGcapRow">
											<div class="cell">
												<div class="field">
													<label>Motifs *:</label>
														<select id="type_id" name="type_id" class="obligatoire">
															<option value="">S&eacute;l&eacute;ctionner le Motif</option>
															<option value="1">Cong&eacute;</option>
															<option value="2">Permission</option>
															<option value="3">Autorisation d'absence</option>
															<option value="4">Repos médical</option>
															<option value="4">Mission</option>
														</select>
													<p class="message">Veuillez s&eacute;l&eacute;ctionner le motif</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell small">
												<div class="field">
													<label>Date d&eacute;but *</label>
													<input type="text" name="date_debut" id="date_debut" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oGcap.gcap_dateDebut}{$oData.oGcap.gcap_dateDebut|date_format2}{/if}" value="{if $oData.oGcap.gcap_dateDebut}{$oData.oGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" {if $oData.oGcap.gcap_statutId >= 1} disabled="disabled"{/if} class="form-control datedropper-range-fiche obligatoire">
													<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell small">
												<div class="field">
													<label>Date fin *</label>
													<input type="text" name="date_fin" id="date_fin" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oData.oGcap.gcap_dateFin}{$oData.oGcap.gcap_dateFin|date_format2}{/if}" value="{if $oData.oGcap.gcap_dateFin}{$oData.oGcap.gcap_dateFin|date_format:"%d/%m/%Y"}{/if}" placeholder="s&eacute;l&eacute;ctionner la date fin" {if $oData.oGcap.gcap_statutId >= 1} disabled="disabled"{/if} class="form-control datedropper-range-fiche obligatoire">
													<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<input type="button" class="button" onClick="valider();" name="" id="Envoyer" value="Envoyer">
												</div>
											</div>
										</div>
									</fieldset>
								</form>
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


$(document).ready (function ()
{
	var dataArrayVille = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	
	$("#zCandidatSearch").select2
	({
		initSelection: function (element, callback)
		{
			
			$(dataArrayVille).each(function()
			{
				if (this.id == element.val())
				{
					callback(this);
					return
				}
			})
		},
		allowClear: true,
		placeholder:"S&eacute;lectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez s&eacute;lectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidatRattache/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#zCandidatSearch").select2('val',$("#idSelect").val());
	
})

</script>
{/literal}