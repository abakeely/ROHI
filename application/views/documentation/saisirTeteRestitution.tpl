{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Ajout en tête Restitution</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Restitution en tête</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
		
								<div align="right">
									<a href="{$zBasePath}documentation/teteRestitution" class="btn">Retour</a>
								</div>
								<div class="col-xs-12">
									<form action="{$zBasePath}documentation/saveTeteRestitution/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
										<input type="hidden" name="iTypeId" id="iTypeId" value="{$oData.iTypeId}">
										<input type="hidden" name="iId" id="iId" value="{$oData.iId}">
										<input type="hidden" name="iSessionCompte" id="iSessionCompte" value="{$oData.iSessionCompte}">
										<fieldset>
											<div class="clearfix">
												<div class="cell small">
													<div class="field">
														<label>Date *:</label>
														<input type="text" name="zDate" id="zDate" placeholder="s&eacute;l&eacute;ctionner la date"  data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.toTeteRestitutiton.date_restitution|date_format2}"     value="{$oData.toTeteRestitutiton.date_restitution|date_format:"%d/%m/%Y"}" class="form-control withDatePicker obligatoire">
														<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
													</div>
												</div>
											</div>
										
											<div class="clearfix">
												<div class="cell">
													<div class="field">
														<label>Heure*: </label>
														<input type="text" name="zDate" id="heure_restitution" placeholder="s&eacute;l&eacute;ctionner l'heure" value="{$oData.toTeteRestitutiton.heure_restitution}" class="form-control">
														<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
													</div>
												</div>
											</div>

											<div class="clearfix">
												<div class="cell">
													<label>Lieu *:</label>
													<div class="field">
														<input placeholder="Veuillez entrer le titre" type="text" id="lieu_restitution1" name="lieu_restitution1" value="{$oData.toTeteRestitutiton.lieu_restitution1}" class="form-control  obligatoire">
														<p class="message">Veuillez entrer le lieu</p>
													</div>
												</div>
											</div>
											<div class="clearfix">
												<div class="cell">
													<label>Thème : </label>
													<div class="field">
														<input placeholder="Veuillez entrer le theme" type="text" id="intitule_restitution" name="intitule_restitution" value="{$oData.toTeteRestitutiton.intitule_restitution}" class="form-control  obligatoire">
														<p class="message">Veuillez entrer le theme</p>
													</div>
												</div>
											</div>
											
											<div class="clearfix">
												<div class="cell">
													<label>Beneficiaire * : </label>
													<div class="field">
														<input placeholder="Veuillez entrer le Beneficiaire" type="text" id="nom_prenom_restitution" name="nom_prenom_restitution" value="{$oData.toTeteRestitutiton.nom_prenom_restitution}" class="form-control obligatoire">
														<p class="message">Veuillez entrer le Beneficiaire</p>
													</div>
												</div>
											</div>
											
											<!-- <div class="clearfix">
												<div class="cell">
													<label>Catégorie *: </label>
													<div class="field">
														<select id="iCategorieRcId" name="iCategorieRcId" class="obligatoire">
															<option value="">Sélectionner une catégorie</option>
															{foreach from=$oData.toCategorieRc item=oCategorieRc }
																<option {if $oData.toRevueCommunique.revueCommunique_categorieRcId == $oCategorieRc.categorieRc_id} selected="selected" {/if} value="{$oCategorieRc.categorieRc_id}">{$oCategorieRc.categorieRc_libelle}</option>
															{/foreach}
														</select>
														<p class="message">Veuillez sélectionner une catégorie</p>
													</div>
												</div>
											</div> -->
											
											<div class="clear"></div>
											<div class="clear"></div>
											<div class="clearfix">
												<div class="cell">
													<div class="field">
														<br><br/>
														<input type="button" class="button" onClick="validerSansDate();" name="" id="valider" value="valider">
													</div>
												</div>
											</div>
										</fieldset>
									</form>
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
<script type="text/javascript">
  $(document).ready(function() {
		showPreview();
  });

  function showPreview(){
		$('#formulaireEdit').find('input.jfilestyle').on('change', function (e) {
			var files = $(this)[0].files; 

			if (files.length > 0) {
				$(this).siblings('p.zImgVignette').children().removeAttr('src');
				$('.zImgVignette').show();
				var file = files[0],
				$image_preview = $(this).siblings('p.zImgVignette');
				$image_preview.show();
				$(this).siblings('p.zImgVignette').children().show();
				$(this).siblings('p.zImgVignette').children().attr('src', window.URL.createObjectURL(file));
			}
		});
	}

 </script>
{/literal}