{include_php file=$zCssJs}
{literal}
<style>
div.separateur {
    height: 26px!important;
}
</style>
{/literal}
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

				
						<!-- Page Header -->
						<div class="page-header">
							<div class="row align-items-center">
								<div class="col-12">
									<!--h3 class="page-title">Vos notes d'évaluation mensuelles</h3-->
									<ul class="breadcrumb">
										<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
										<li class="breadcrumb-item">Historique notes évaluations</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /Page Header -->
						<div class="row">
							<div class="box">
								<div class="">
											<div class="card-body">
											{$oData.zReturn}
											{$oData.zReturn2}
											
											</div>
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
		