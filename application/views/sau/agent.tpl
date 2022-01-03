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
								<h3 class="page-title">Agents > Situation irrégulière</h3>
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
								<form enctype="multipart/form-data">
									<fieldset>
										<input type="hidden" name="idSelect" id="idSelect" value="">
										<div class="card punch-status">
											<div class="row clearfix">
												<div class="cell">
													<label>Recherche agent en Base</label>
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
													<label><b>Nom :</label>
													<input type="text" name="visiteur_nom" id="visiteur_nom" value="" class="obligatoire">
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field">
													<label>Pr&eacutenom : </label>
													<input type="text" name="visiteur_prenom" id="visiteur_prenom" value="" class="obligatoire">
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="cell">
												<div class="field">
													<label>CIN :</label>
													<input type="text" name="visiteur_cin" id="visiteur_cin" value="" class="obligatoire">
												</div>
											</div>
										</div>
										<div class="row1">
											<div class="cell">
												<div class="field">
													<label>Porte :</label>
													<select id="type_id" name="type_id" class="obligatoire">
														<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
														{foreach from=$oData.toPorte item=toPorte }
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
													<label>Badge :</label>
													<select id="type_id" name="type_id" class="obligatoire">
														<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
														{foreach from=$oData.toBadge item=toBadge }
														<option value="{$toBadge.badge_id}">{$toBadge.badge_nom}</option>
														{/foreach}
													</select>
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
													<p class="label">&nbsp;</p>
													<p class="check"><input type="radio" name="iRadioMotif" value="2"><label>Badge perdu</label></p>
													<p class="check"><input type="radio" name="iRadioMotif" value="3"><label>Badge d&eacute;fectueux</label></p>
													<p class="check"><input type="radio" name="iRadioMotif" value="4"><label>Transfert interd&eacute;partemental</label></p>
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
		<div id="dialog" title="Dialog Title"></div>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

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
					url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
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

					$("#visiteur_nom").val('');
					$("#visiteur_prenom").val('');
					$("#visiteur_cin").val('');
				} else {
					var idSelect = $("#idSelect").val();
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/getInfoCandidat",
						method: "POST",
						data: { idSelect:idSelect},
						success: function(data, textStatus, jqXHR) {
							var oReturn = jQuery.parseJSON(data);
							if (oReturn.id > 0) {

								$("#visiteur_nom").val(oReturn.nom);
								$("#visiteur_prenom").val(oReturn.prenom);
								$("#visiteur_cin").val(oReturn.cin);
								$("#visiteur_nom").attr("disabled", "disabled") ; 
								$("#visiteur_prenom").attr("disabled", "disabled") ; 
								$("#visiteur_cin").attr("disabled", "disabled") ; 
							}
						},
						async: false
					});
				}

			});
		});

		</script>
		{/literal}