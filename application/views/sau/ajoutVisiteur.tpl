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
								<h3 class="page-title">Visiteurs > AJOUT VISITEURS</h3>
								{* <ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Visualisations</li>
								</ul> *}
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<form action="{$zBasePath}sau/save/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" id="formulaireVisiteur" name="formulaireVisiteur" enctype="multipart/form-data">
									<fieldset>
										<input type="hidden" name="idSelect" id="idSelect" value="">
										<div class="card punch-status">
											<div class="row clearfix">
												<div class="cell">
													<label>Recherche visiteur si existant en Base</label>
													<div class="field" id="searchCandidat" style="display:block">
														<input placeholder="Veuillez entrer le nom du visiteur" type="text" id="zCandidatInfo" name="zCandidatInfo">
													</div>
												</div>
											</div>
										</div>
										<div><p>&nbsp;</p></div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field" >
													<label><b>Nom *:</label>
													<input type="text" name="visiteur_nom" id="visiteur_nom" value="" class="obligatoire">
													<p class="message">Veuillez remplir le nom du visiteur</p>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field">
													<label>Pr&eacutenom *: </label>
													<input type="text" name="visiteur_prenom" id="visiteur_prenom" value="" class="obligatoire">
													<p class="message">Veuillez remplir le prénom du visiteur</p>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field">
													<label>CIN *:</label>
													<input type="text" name="visiteur_cin" id="visiteur_cin" value="" class="obligatoire">
													<p class="message">Veuillez remplir le CIN du visiteur</p>
												</div>
											</div>
										</div>
										<div class="row1">
											<div class="cell">
												<div class="field">
													<label>Porte :</label>
													<select id="porte_id" name="porte_id">
														<option value="0">Veuillez s&eacute;l&eacute;ctionner</option>
														{foreach from=$oData.toPorte item=toPorte}
														<option value="{$toPorte.porte_id}">{$toPorte.porte_nom}</option>
														{/foreach}
													</select>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field">
													<label>&nbsp;</label>
													<button>Ajout Porte</button>
												</div>
											</div>
										</div>
										<div class="row1">
											<div class="cell">
												<div class="field">
													<label>Badge *:</label>
													<select id="badge_id" name="badge_id" class="obligatoire">
														<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
														{foreach from=$oData.toBadge item=toBadge}
														<option value="{$toBadge.badge_id}">{$toBadge.badge_nom}</option>
														{/foreach}
													</select>
													<p class="message">Veuillez s&eacute;l&eacute;ctionner le num&eacute;ro de badge</p>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field">
													<label>&nbsp;</label>
													<button>Ajout Badge</button>
												</div>
											</div>
										</div>
										<div class="row clearfix"> 
											<div class="cell">
												<div class="field">
													<input type="button" class="button" onClick="validerSau();" name="" id="" value="Envoyer">
												</div>
											</div>
										</div>
										<div class="row clearfix"> 
											<div class="cell">
												<div class="field">
													<p style="color:red"><i>(Les champs suivis d'une (*) sont obligatoires)</i></p>
												</div>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Page Content -->
					
		</div>
		<!-- /Page Wrapper -->
		<div id="dialog" title="Dialog Title">
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<style>
</style>
{/literal}
<script>

{if sizeof($oData.oListe)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
</script>

{literal}
		<script>

		$(function() {

			$("#visiteur_nom").removeAttr("disabled") ; 
			$("#visiteur_prenom").removeAttr("disabled") ; 
			$("#visiteur_cin").removeAttr("disabled") ;

			$("#visiteur_nom").val('');
			$("#visiteur_prenom").val('');
			$("#visiteur_cin").val('');

			var dataArrayInfo = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidatInfo").select2
			({
				initSelection: function (element, callback)
				{
				},
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "{/literal}{$zBasePath}{literal}sau/getVisiteur/",
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


			$("#zCandidatInfo").on('change', function (e) {
				var iCandidatInfo = $("#zCandidatInfo").val() ; 
				$("#idSelect").val(iCandidatInfo) ; 

				if (iCandidatInfo == '') {
					$("#visiteur_nom").removeAttr("disabled") ; 
					$("#visiteur_prenom").removeAttr("disabled") ; 
					$("#visiteur_cin").removeAttr("disabled") ;

					$("#visiteur_nom").addClass("obligatoire") ; 
					$("#visiteur_prenom").addClass("obligatoire") ;  
					$("#visiteur_cin").addClass("obligatoire") ; 

					$("#visiteur_nom").val('');
					$("#visiteur_prenom").val('');
					$("#visiteur_cin").val('');
				} else {
					var idSelect = $("#idSelect").val();
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/getInfoVisiteur",
						method: "POST",
						data: { idSelect:idSelect},
						success: function(data, textStatus, jqXHR) {
							var oReturn = jQuery.parseJSON(data);
							if (oReturn.visiteur_id > 0) {

								$("#visiteur_nom").val(oReturn.visiteur_nom);
								$("#visiteur_prenom").val(oReturn.visiteur_prenom);
								$("#visiteur_cin").val(oReturn.visiteur_cin);
								$("#visiteur_nom").attr("disabled", "disabled") ; 
								$("#visiteur_prenom").attr("disabled", "disabled") ; 
								$("#visiteur_cin").attr("disabled", "disabled") ; 

								$("#visiteur_nom").removeClass("obligatoire") ; 
								$("#visiteur_prenom").removeClass("obligatoire") ;  
								$("#visiteur_cin").removeClass("obligatoire") ; 
							}
						},
						async: false
					});
				}

			});
		});

		</script>
		{/literal}