{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Insertion des Données dans Matricule</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Insertion ECD</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<link rel="stylesheet" href="{$zBasePath}assets/css/bootstrap-datetimepicker.min.css"/>
								<link rel="stylesheet" href="{$zBasePath}assets/css/datepicker3.css"/>
								<script src="{$zBasePath}assets/js/jquery.maskedinput.js"></script>
								<script src="{$zBasePath}assets/js/date.js"></script>
								<form class="form-horizontal bv-form Cv-form" role="form" name="cv" id="cv_form" action="{$zBasePath}access/save_ecd" method="POST" enctype="multipart/form-data">
									<br><br>
									<div class="form form-group">
										<input type="text"  class="form-control" placeholder="Nom " name="nom" id="nom" value="{$oData.nom}">
									</div>
									<div class="form form-group">
										<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="prenom" value="{$oData.prenom}">
									</div>
									<div class="libele_form">
										<label class="control-label " data-original-title="" title=""><b> Genre </b></label>
									</div>
									<div class="form">
										<select class="form-control" placeholder="Corps" name="sexe" data-original-title="Misafidy na lahy na vavy" id="sexe">
											<option  value="">Veuillez S&eacute;lectionner votre genre</option>
											<option  value="1" {if $oData.sexe==1}selected="selected"{/if}>Masculin</option>
											<option  value="0" {if $oData.sexe_edit==1}selected="selected"{/if}>Feminin</option>
										</select>
									</div>
									<div class="libele_form">
										<label class="control-label " data-original-title="" title=""><b> CIN </b></label>
									</div>
									<div class="form form-group">
										<input type="text"  class="form-control" placeholder="cin" data-original-title="Raha tsy mivoaka ny laharana karapanondro-nao dia mila mameno ianao" name="cin" id="cin" value="{$oData.cin}">
									</div>
									<div class="form form-group">
									<input type="text" id="login" class="form-control" placeholder="Pseudo" name="login" data-original-title="Ampidiro ny «pseudo» nosafidinao" value="{$oData.login}">
									</div>
									<div class="form form-group">
										<input type="password" id="password" class="form-control" placeholder="Mot de passe" name="password" data-original-title="Ampidiro ny teny miafina na «mot de passe» nosafidinao" value="">
									</div>
									<div class="form form-group">
										<input type="password" id="confirm_password" class="form-control" placeholder="Confirmez votre mot de passe" name="confirm_password" data-original-title="Avereno soratana ny teny miafina na « mot de passe »" value="">
									</div>
									<div class="col-xs-12 col-sm-12 SubmitCv text-center">
										<input type='submit'  class="btn btn-primary form-control" data-original-title="Rehefa feno ny « champs » rehetra dia tsindrio ito teboka ito. Tandremo : mila tadidinao tsara ny « pseudo » sy « mot de passe »-nao.»" style="font-size: 1.3em; font-weight: bold;arial: cursive" value='Creer compte' style="background:green"/>	
									</div>
								</form>
								<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
								<div id="calendar"></div>
							</div>
						</div>
					</div>
		</div>
		</div>
		<!-- /Page Content -->
		{if $oData.msg_error}
			{literal}
				<script>alert('{/literal}{$oData.msg_error}{literal}');</script>
			{/literal}
		{/if}
		{if $oData.msg_success}
			{literal}
				<script>alert('{/literal}{$oData.msg_success}{literal}');</script>
			{/literal}
		{/if}
		{literal}
			<script>
				$(document).ready(function() {
					$("#cin").mask("999 999 999 999"); 
				});
			</script>
		{/literal}
	</div>
	<!-- /Page Wrapper -->
	
	</div>
	<!-- /Main Wrapper -->
		
	{include_php file=$zFooter}