{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script type="text/javascript" src="CKEditor/ckeditor/ckeditor.js"></script>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Communiqu�</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Communiqu�</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">	
								<form action="{$zBasePath}accueil/saveCommunique" method="POST" name="formulaireGet" id="formulaireGet" enctype="multipart/form-data">
									<fieldset>
										<div class="row clearfix"> 
										{$oData.zData}
										</div>
										
										<div class="row clearfix"> 
											<div class="cell">
												<div class="field">
													<input type="submit" class="submit" name="" id="" value="Enregistrer">
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

{include_php file=$zFooter}
		