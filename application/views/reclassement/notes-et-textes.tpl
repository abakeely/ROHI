{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Notes et Textes</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Notes et Textes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="box">
										<fieldset>
											<table>
												<tr class="notAffiche">
													<td style="color:green;"><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Les notes relatives au reclassement</strong></td>
												</tr>
												<tr class="notAffiche">
													<td style="width:40%;">- Note n°660-2014/MFB/SG/DRHA/SGRH <span><a target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/assets/accueil/upload/nouvelle_procedure_reclassement.pdf"><img style="vertical-align:middle;" width="150" src="{$zBasePath}assets/reclassement/images/boutonTel.png"></a></span></td>
												</tr>
												<tr class="notAffiche">
													<td style="width:40%;">- Note n°121-2016/MFB/SG/DRHA <span><a target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/assets/accueil/upload/Faux-et-usage-de-faux-diplome.pdf"><img style="vertical-align:middle;" width="150" src="{$zBasePath}assets/reclassement/images/boutonTel.png"></a></span></td>
												</tr>
												<tr class="notAffiche">
													<td style="width:40%;">- Note n°16-2017/MFB/SG/DRHA <span><a target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/assets/accueil/upload/note_service2.pdf"><img style="vertical-align:middle;" width="150" src="{$zBasePath}assets/reclassement/images/boutonTel.png"></a></span></td>
												</tr>
												<tr class="notAffiche">
													<td style="width:40%;">- Note n°173-2017/MFB/SG/DRHA/SGRH <span><a target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/assets/accueil/upload/note_explicative_173.pdf" target="_blank"><img style="vertical-align:middle;" width="150" src="{$zBasePath}assets/reclassement/images/boutonTel.png"></a></span></td>
												</tr>
												
												
											</table>
										</fieldset>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>	
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<style>
td.left {width:20%}
</style>
{/literal}