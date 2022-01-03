{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">{if $oData.iId>0}Modification{else}Ajout{/if}  {if $oData.iTypeId == 1}communiqué{else}revue de presse{/if}</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"> Fiche {if $oData.iTypeId == 1}communiqué{else}revue de presse{/if}</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
									<form action="{$zBasePath}accueil/save/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
									<input type="hidden" name="iTypeId" id="iTypeId" value="{$oData.iTypeId}">
									<input type="hidden" name="iId" id="iId" value="{$oData.iId}">
									<input type="hidden" name="iSessionCompte" id="iSessionCompte" value="{$oData.iSessionCompte}">
									<fieldset>
									<div class="clearfix">
										<div class="cell">
											<label>Urgent :</label>
											<div class="field">
												<input {if $oData.toRevueCommunique.revueCommunique_urgent==1}checked="checked"{/if} name="revueCommunique_urgent" style="width:20px!important;height:30px!important;" type="checkbox" class="form-control ace checkActive" value="1" /><span class="lbl"></span>
											</div>
										</div>
									</div>
									<div class="clearfix">
										<div class="cell">
											<label>Titre *:</label>
											<div class="field">
												<input placeholder="Veuillez entrer le titre" type="text" id="revueCommunique_titre" name="revueCommunique_titre" value="{$oData.toRevueCommunique.revueCommunique_titre}" class="form-control obligatoire">
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>
									<div class="clearfix">
										<div class="cell small">
											<div class="field">
												<label>Date *:</label>
												<input type="text" name="zDate" id="zDate" placeholder="s&eacute;l&eacute;ctionner la date" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.toRevueCommunique.revueCommunique_date|date_format2}" value="{$oData.toRevueCommunique.revueCommunique_date|date_format:"%d/%m/%Y"}" class="form-control withDatePicker obligatoire">
												<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date</p>
											</div>
										</div>
									</div>
									<div class="clearfix">
										<div class="cell">
											<label>Description courte *: </label>
											<div class="field">
												<input placeholder="Veuillez entrer le titre" type="text" id="zDescriptionCourte" value="{$oData.toRevueCommunique.revueCommunique_descCourt}" name="zDescriptionCourte"  class="form-control obligatoire">
												<p class="message">Veuillez entrer la description courte</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
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
									</div>
									{if $oData.iTypeId == 1}
									<div class="clearfix">
										<div class="cell">
											<label>Image : </label>
											<div class="field">
												<input type="file" id="zImage" name="zImage" class="form-control jfilestyle" data-placeholder="Image" data-buttonText="<span class='glyphicon glyphicon-picture'></span>">
												<p class="zImgVignette" {if $oData.toRevueCommunique.revueCommunique_image != ''} style="display:block;" {else} style="display:none;" {/if}>
													<img class="ImgVgt" width="200" src="{$zBasePath}/assets/accueil/upload/resize/{$oData.toRevueCommunique.revueCommunique_image}">
												</p>
											</div>
										</div>
									</div>
									{/if}
									<div class="clearfix">
										<div class="cell">
											<label>Fichier * : </label>
											<div class="field">
												<input type="radio" value="1" class="form-control choice" name="IchoiceRadio" {if $oData.toRevueCommunique.revueCommunique_type == 1} checked="checked" {/if}> Oui
												<input type="radio" value="0" class="form-control choice"{if $oData.toRevueCommunique.revueCommunique_type == 0} checked="checked"{/if} name="IchoiceRadio" > Non
											</div>
										</div>
									</div>
									<div id="iFichier"  {if $oData.toRevueCommunique.revueCommunique_type == 1} style="display:block;" {else} style="display:none;"{/if} class="clearfix">
										<div class="cell">
											<label>Fichier * : </label>
											<div class="field">
												<input type="file" id="zFile" name="zFile" class="form-control jfilestyle1" class="obligatoire">{$oData.toRevueCommunique.revueCommunique_fichier}
												<p class="message">Veuillez Sélectionner un fichier/p>
											</div>
										</div>
									</div>
									<div id="iVideo" {if $oData.toRevueCommunique.revueCommunique_type == 0} style="display:block;" {else} style="display:none;"{/if} class="clearfix">
										<div class="cell">
											<label>Nom de la vidéo * : </label>
											<div class="field">
												<input type="text" id="zUrlVideo" name="zUrlVideo" class="form-control" value="{$oData.toRevueCommunique.revueCommunique_url}" style="width:40%">
											</div>
										</div>
									</div>
									{if $oData.iTypeId == 2}
									<div class="clearfix">
										<div class="cell">
											<label>Organe *: </label>
											<div class="field">
												<select id="iOrganeId" name="iOrganeId" class="obligatoire">
													<option value="">Sélectionner un organe de presse</option>
													{foreach from=$oData.toOrganePresse item=oOrganePresse }
														<option {if $oData.toRevueCommunique.revueCommunique_organeId == $oOrganePresse.organePresse_id} selected="selected" {/if} value="{$oOrganePresse.organePresse_id}">{$oOrganePresse.organePresse_libelle}</option>
													{/foreach}
												</select>
												<p class="message">Veuillez Sélectionner un organe de presse</p>
											</div>
										</div>
									</div>
									<div class="clearfix">
										<div class="cell">
											<label>Page parution *:</label>
											<div class="field">
												<input placeholder="Veuillez entrer le titre" type="text" id="zPageParution" name="zPageParution" value="{$oData.toRevueCommunique.revueCommunique_pageParution}"  class="form-control obligatoire">
												<p class="message">Veuillez entrer la page de parution</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
										<div class="cell">
											<label>Journaliste *: </label>
											<div class="field">
												<input type="text" id="zJournaliste" name="zJournaliste" value="{$oData.toRevueCommunique.revueCommunique_journaliste}" class="form-control obligatoire">
												<p class="message">Veuillez entrer le nom du journaliste</p>
											</div>
										</div>
									</div>
									<div class="clearfix">
										<div class="cell">
											<label>Tendance : </label>
											<div class="field">
												<select id="iTendanceId" name="iTendanceId" class="obligatoire" style="width:250px;">
													<option value="">Sélectionner une tendance</option>
													<option {if $oData.toRevueCommunique.revueCommunique_tendance == 1} selected="selected" {/if} value="1">Bonne</option>
													<option {if $oData.toRevueCommunique.revueCommunique_tendance == 2} selected="selected" {/if} value="2">Mauvaise</option>
													<option {if $oData.toRevueCommunique.revueCommunique_tendance == 3} selected="selected" {/if} value="2">Moyen</option>
												</select>
												<p class="message">Veuillez entrer la tendance</p>
											</div>
										</div>
									</div>
									{/if}
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
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
{literal}
<script type="text/javascript">
  $(document).ready(function() {
		showPreview();
  });

  $('.choice').click(function(){
		
		var iValue = $(this).val();  

		switch (iValue) {
			case '1':
				$("#iFichier").show();
				$("#iVideo").hide();
				break;

			case '0':
				$("#iFichier").hide();
				$("#iVideo").show();
				break;
		}

		
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
{include_php file=$zFooter}
		