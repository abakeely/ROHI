{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-6">
								<h3 class="page-title">Immatriculation</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Insertion matricule</li>
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
								<form class="form-horizontal bv-form Cv-form" role="form" name="cv" id="cv_form" action="{$zBasePath}access/save_im" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Matricule(*) </b></label>
											</div>
											<input type="text"  class="form-control" placeholder="matricule" name="im" id="im" value="{$oData.libele}">
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Cin(*) </b></label>
											</div>
											<input type="text"  class="form-control" placeholder="cin" name="cin" id="cin" value="{$oData.cin}">
										</div>
										<div class="form col-md-4">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Nom(*) </b></label>
											</div>
											<input type="text"  class="form-control" placeholder="Nom " name="nom" id="nom" value="{$oData.nom}">
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Pr&eacute;noms</b></label>
											</div>
											<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="prenom" value="{$oData.prenom}">
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Date de Naissance</b></label>
											</div>
											<div class="form form-group input-group">
												<input type="text" id="date_naiss" class="form-control"  placeholder="Date de Naissance" name="date_naiss" value="{$oData.date_naissance}" >
												<span class="input-group-addon">  
													<span class="la la-calendar form-control-feedback"></span>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Statut(*) </b></label>
											</div>
											<select class="form-control" placeholder="Status" name="statut" data-placement="top"  data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire" id="statut">
												{foreach from=$oData.list_statut item=oStatus}
													<option  value={$oStatus.id} {if $oStatus.id==$oData.statut}selected="selected"{/if}>{$oStatus.libele}</option>
												{/foreach}
											</select>
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Corps(*) </b></label>
											</div>
											<select id="corps" class="form-control" placeholder="Corps" name="corps" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
												{foreach from=$oData.list_corps item=oCorp}
													<option  value={$oCorp.id} {if $oCorp.id==$oData.corps_id}selected="selected"{/if}>{$oCorp.libele}</option>
												{/foreach}
												<option  value="0">AUTRES</option> 
											</select>
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Grade(*) </b></label>
											</div>
											<select class="form-control" placeholder="Grade" name="grade"  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
												{foreach from=$oData.list_grade item=oGrade}
													<option  value={$oGrade.id} {if $oGrade.id==$oData.grade_id}selected="selected"{/if}>{$oGrade.libele}</option>
												{/foreach}
												<option  value="0">AUTRES</option> 
												
											</select>
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Indice</b></label>
											</div>
											<select class="form-control" placeholder="Indice" name="indice"  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
												{foreach from=$oData.list_indice item=oIndice}
													<option  value={$oIndice.id} {if $oIndice.id==$oData.indice_id}selected="selected"{/if}>{$oIndice.libele}</option>
												{/foreach}
												<option  value="0">AUTRES</option> 
											</select>
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Date prise de service</b></label>
											</div>
											<div class="form form-group input-group">
												<input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="{$oData.date_service}"/>
												<span class="input-group-addon">  
													<span class="la la-calendar form-control-feedback"></span>
												</span>
											</div>
										</div>
										<div class="form col-md-2">
											<div class="libele_form">
												<label class="control-label label_rohi " data-original-title="" title=""><b>Nombre d&acute;enfants</b></label>
											</div>
											<div class="form form-group">
												<input type="text" id="nbr_enfant" style="width:45px;" maxlength="2" class="form-control" name="nbr_enfant" data-toggle="tooltip" data-original-title= " Soraty ny isan’ny ankizy"value="{$oData.nb_enfant}">
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 SubmitCv text-right">
										<input type="submit" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value="Enregistrer">
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
					$("#date_prise_service").mask("99/99/9999");
					$("#date_naiss").mask("99/99/9999");
					$("#date_prise_service").datepicker({
						 language: "fr",
						 autoclose: true,
						 todayHighlight: true,
						 format: "dd/mm/yyyy"
					});
					$("#date_naiss").datepicker({
						 language: "fr",
						 autoclose: true,
						 todayHighlight: true,
						 format: "dd/mm/yyyy"
					});
					 $("#cin").mask("999 999 999 999"); 
					 $("#im").mask("999999");
				 }); 
			</script>
		{/literal}
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
	
    {include_php file=$zFooter}