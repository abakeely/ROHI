{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">{if $oData.iId>0}Modification{else}Ajout{/if}  fiche de poste</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Fiche de poste</li>
								<li class="breadcrumb-item">{if $oData.iId>0}<span>&gt;</span><a href="#">{$oData.toFicheDePoste.fichePoste_intitule}</a>{/if}</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">

									<form action="{$zBasePath}accueil/saveFicheDePoste/{$oData.zHashModule}/{$oData.zHashUrl}/{$oData.iId}" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
									<input type="hidden" name="iId" id="iId" value="{$oData.iId}">
									<input type="hidden" name="iSessionCompte" id="iSessionCompte" value="{$oData.iSessionCompte}">
									<fieldset>
									
									<div class="clearfix">
										<div class="cell">
											<label>Intitulé de poste *:</label>
											<div class="field">
												<input placeholder="Veuillez entrer le titre" type="text" id="fichePoste_intitule" name="fichePoste_intitule" value="{$oData.toFicheDePoste.fichePoste_intitule}" class="form-control obligatoire">
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
										<div class="cell">
											<label>Mission *:</label>
											<div class="field">
												{$oData.zMission}
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
										<div class="cell">
											<label>Activités principales *:</label>
											<div class="field">
												{$oData.zAcvtivitePrincipale}
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
										<div class="cell">
											<label>Activités d’encadrement *:</label>
											<div class="field">
												{$oData.zActiviteEncadrement}
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
										<div class="cell">
											<label>Niveau et domaine de formation académique et professionnelle, diplôme *:</label>
											<div class="field">
												{$oData.zExigenceNiveau}
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>

									<div class="clearfix">
										<div class="cell">
											<label>Expérience professionnelle dans le domaine et/ou dans un poste semblable *:</label>
											<div class="field">
												{$oData.zExigenceDiplome}
												<p class="message">Veuillez entrer le titre</p>
											</div>
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="clear"></div>
									<div class="clearfix">
										<div class="cell">
											<div class="field">
												<br><br/>
												<input type="button" class="button" onClick="validerSansDate();" name="" id="valider" value="valider">
												<input type="button" class="button" onClick="document.location.href='{$zBasePath}accueil/listeFicheDePoste/module/liste'" name="" id="Retour11" value="Retour">
											</div>
										</div>
									</div>
								  </fieldset>
								</form>
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
		