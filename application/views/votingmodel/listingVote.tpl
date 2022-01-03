{include_php file=$zCssJs}
        <div class="main-wrapper">
			{include_php file=$zHeader}
			<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/galop/css/jquery.galpop.css">
			<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/galop/css/vote.css">
			<script type="text/javascript" src="{$zBasePath}assets/galop/js/popper.min.js"></script>
			<script src="{$zBasePath}assets/galop/js/bootstrap.min.js"></script>
			<link href="{$zBasePath}assets/galop/css/font-awesome.min.css" rel="stylesheet" />
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Vote département :  {$oData.zDepartement}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Vote des agents</li>
								</ul>
							</div>
						</div>
					</div>
						<div class="col-xs-12">
							<div class="box">
									<div class="card-body">
											<!-- -->
											    <div id="box-alert" class="alert">
												  <strong></strong>
												</div>
												<div id="snippetContent">

													<!-- Modal -->
													{if sizeof($oData.toListeRegional)>0}
													<h3>Veuillez choisir un agent méritant dans le central et un agent méritant dans le régional</h3>
													{/if}
													<div class="tabs section" id="RevueBlock">
														{if sizeof($oData.toListeRegional)>0}
														<ul class="nav nav-tabs " role="tablist">
															<li class="active"><a href="#centerPar_tabshome1" role="tab" data-toggle="tab">Liste à voter dans votre département central </a></li>
															<li class=""><a href="#centerPar_tabshome0" role="tab" data-toggle="tab">Liste à voter dans votre département régional </a></li>
														</ul>
														{/if}
														<!-- Tab panes -->
														{if sizeof($oData.toListeRegional)>0}
														<div class="tab-content" >
														{/if}
															<div class="tab-pane active" id="centerPar_tabshome1">
																<div class="container profile-page">
																	<div class="row">
																			
																			{foreach from=$oData.toListeCentral item=toListe }
																			<div class="col-xl-6 col-lg-7 col-md-12">
																				<div class="card profile-header">
																					<div class="body">
																						<div class="row">
																							<div class="col-lg-4 col-md-4 col-12">
																								<div class="profile-image float-md-right">
																									<img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/{$toListe.id}.{$toListe.type_photo}">
																								</div>
																							</div>
																							<div class="col-lg-8 col-md-8 col-12" style="font-size:12px">
																								<h4 class="m-t-0 m-b-0"><strong>{$toListe.nom}</strong> {$toListe.prenom}</h4>
																								<span class="job_post">{$toListe.poste|ucfirst}</span><br>
																								<span class="job_post">{$toListe.path}</span>
																								<p>{$toListe.site}&nbsp;> {$toListe.child_libelle}</p>
																								<div><button class="btn btn-success btn-round votingAgent" id-nom="{$toListe.nom}&nbsp;{$toListe.prenom}" id-agent="{$toListe.user_id}" loc-agent="central"><i style="font-size:large" class="la la-vote-yea"></i>Voter</button> 
																								
																								<a class="btn btn-primary btn-round btn-simple galpop-single"  href="{$zBasePath}assets/images/vote/{$toListe.laureat_image}"><i class="fa fa-thumbs-up"></i>&nbsp;Voir la fiche</a></div>
																								
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			{/foreach}
																	</div>
																</div>

															</div>
															<!-- tab pane 0 -->
															<div class="tab-pane" id="centerPar_tabshome0">
																<div class="container profile-page">
																	<div class="row">
																			
																			{foreach from=$oData.toListeRegional item=toListe }
																			<div class="col-xl-6 col-lg-7 col-md-12">
																				<div class="card profile-header">
																					<div class="body">
																						<div class="row">
																							<div class="col-lg-4 col-md-4 col-12">
																								<div class="profile-image float-md-right">
																									<img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/{$toListe.id}.{$toListe.type_photo}">
																								</div>
																							</div>
																							<div class="col-lg-8 col-md-8 col-12" style="font-size:13px">
																								<h4 class="m-t-0 m-b-0"><strong>{$toListe.nom}</strong> {$toListe.prenom}</h4>
																								<span class="job_post">{$toListe.poste|ucfirst}</span><br>
																								<span class="job_post">{$toListe.path}</span>
																								<p>{$toListe.site}&nbsp;> {$toListe.child_libelle}</p>
																								<div><button class="btn btn-success btn-round votingAgent" id-nom="{$toListe.nom}&nbsp;{$toListe.prenom}" id-agent="{$toListe.user_id}" loc-agent="régional"><i style="font-size:large" class="la la-vote-yea"></i>Voter</button> 
																								
																								<a class="btn btn-primary btn-round btn-simple galpop-single"  href="{$zBasePath}assets/images/vote/{$toListe.laureat_image}"><i class="fa fa-thumbs-up"></i>&nbsp;Voir la fiche</a></div>
																								
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			{/foreach}
																	</div>
																</div>
															{if sizeof($oData.toListeRegional)>0}
															</div>
															{/if}
														</div>
													</div>
															
													<!-- -->
													
												<script type="text/javascript" src="{$zBasePath}assets/galop/js/jquery-3.3.1.min.js"></script>
												<script type="text/javascript" src="{$zBasePath}assets/galop/js/jquery.galpop.js"></script>
												<script type="text/javascript">
												$(document).ready(function() {

													$('.galpop-single').galpop();

													
													{if sizeof($oData.toListeRegional)>0}
													
													$('.votingAgent').click(function(){
														
														var iErreur=0;
														if($(this).attr("loc-agent")=='central'){
															if($("#agentVotingCent").val()!=''){
																iErreur = 1;
																$("#box-alert").removeClass( "alert alert-danger" ).addClass( "alert alert-danger" );
																$("#box-alert > strong").html("Vous avez déjà choisi un agent au niveau central");

															}
														} 

														if($(this).attr("loc-agent")=='regional'){
															if($("agentVotingReg").val()!=''){
																iErreur = 1;
																$("#box-alert").removeClass( "alert alert-danger" ).addClass( "alert alert-danger" );
																$("#box-alert > strong").html("Vous avez déjà choisi un agent au niveau régional");
															}
														} 

														if(iErreur == 0){
															if(confirm("Êtes-vous sûr de voter " + $(this).attr("id-nom")+ " dans votre département "+ $(this).attr("loc-agent") +" ?")){
																var $form = $("#votingMeriteAgent");
																
																if($(this).attr("loc-agent")=='central'){
																	$("#agentVotingCent").val($(this).attr("id-agent"));
																} else {
																	$("#agentVotingReg").val($(this).attr("id-agent"));
																}

																if($("#agentVotingCent").val()==''){
																	$("#box-alert").removeClass( "alert alert-danger" ).addClass( "alert alert-success" );
																	$("#box-alert > strong").html("Il vous reste de choisir l'agent méritant du central");
																	$("html, body").animate({ scrollTop: 0 }, "slow");
																}

																if($("#agentVotingReg").val()==''){
																	$("#box-alert").removeClass( "alert alert-danger" ).addClass( "alert alert-success" );
																	$("#box-alert > strong").html("Il vous reste de choisir l'agent méritant du régional");
																	$("html, body").animate({ scrollTop: 0 }, "slow");
																}
																
																if($("#agentVotingCent").val()!="" && $("#agentVotingReg").val()!=""){
																	var formdata = (window.FormData) ? new FormData($form[0]) : null;
																	var data = (formdata !== null) ? formdata : $form.serialize();
																	$.ajax({
																		url: $form.attr('action'),
																		type: $form.attr('method'),
																		contentType: false, 
																		processData: false, 
																		data: data,
																		success: function (response) {
																			alert("Votre vote a été prise en compte, nous vous remercions");
																			document.location.href="{$zBasePath}";
																		}
																	});
																}
															}
														}

														
													})
													
													{else}
													

													$('.votingAgent').click(function(){
														
															if(confirm("Êtes-vous sûr de voter " + $(this).attr("id-nom")+ " dans votre département ?")){
																var $form = $("#votingMeriteAgent");
																
																	$("#agentVotingCent").val($(this).attr("id-agent"));
																	var formdata = (window.FormData) ? new FormData($form[0]) : null;
																	var data = (formdata !== null) ? formdata : $form.serialize();
																	$.ajax({
																		url: $form.attr('action'),
																		type: $form.attr('method'),
																		contentType: false, 
																		processData: false, 
																		data: data,
																		success: function (response) {
																			alert("Votre vote a été prise en compte, nous vous remercions");
																			document.location.href="{$zBasePath}";
																		}
																	});

															}
													})
													
													{/if}
													
								
												});

												</script>
												</div>
											</body>

											<!-- -->
									</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
		<form class="voting-form" id="votingMeriteAgent" action="{$zBasePath}votingmerite/save" method="post" enctype="multipart/form-data">
		<input type="hidden" name="agentVotingCent" id="agentVotingCent">
		<input type="hidden" name="agentVotingReg" id="agentVotingReg">
		<input type="hidden" name="zDepartement" id="zDepartement" value="{$oData.zDepartement}">
		</form>
		{include_php file=$zFooter}
</body>
</html>