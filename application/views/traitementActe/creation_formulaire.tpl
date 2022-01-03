{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Agents > Situation irrégulière</h3> *}
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
			
								<div id="innerContent">
									<ul class="tabs">
										<li><a href="#saisieActe">Saisie de contenu</a></li>
										<li><a href="#Referentiels">Referentiels</a></li>
									</ul>
									<div id="saisieActe">
										<div id="saisieActe">
											<div class="panel-body">
												<h3>Information de l'acte</h3>
											</div>
											<div class="row">
												<input type="hidden" value="INITIATLISATION_DU_PROJET_ACTE" id="ticket_niveau"/>
												<div class="form col-md-2">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Numero du projet(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Numero de l'acte"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_sigle" value="">
												</div>
												<div class="form col-md-3">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Designation de l'acte(*) </b></label>
													</div>
													<select id="ticket_designation" name="ticket_designation" class="form-control obligatoire" placeholder="Mouvement" data-placement="top" data-toggle="tooltip">
														<option  value="--select--">Selectionner</option>
														<option  value="Decret">Decret</option>
														<option  value="Arrete">Arrete</option>
														<option  value="Decison">Decison</option>
													</select>
												</div>
												<div class="form col-md-7">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Portant(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Portant"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_libelle" value="">
												</div>
											</div>
											<div class="row">
												<div class="form col-md-2">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Poste Agent Numero(*) </b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Poste Agent Numero"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="ticket_poste_agent_numero" value="">
												</div>
												<div class="form col-md-3">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Groupe Projet(*) </b></label>
													</div>
													<select class="form-control obligatoire" placeholder="Groupe des actes" data-placement="top" data-toggle="tooltip" onchange="setSubCategory('t_projet','projet_groupe_id',this.value,'ticket_processus_code')">
														<option  value="-1">Selectionner</option>
													</select>
													
												</div>
												<div class="form col-md-3">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Mouvement(*) </b></label>
													</div>
													<select id="ticket_processus_code" class="form-control obligatoire" placeholder="Mouvement" data-placement="top" data-toggle="tooltip" >
														<option  value="-1">Selectionner</option>
													</select>
													
												</div>
											</div>
											
										</div>
									</div>				
									<div class="panel-body">
										<div class="row">
											<div class="col-md-4">
												<a class="form-control btn-primary bouton" onclick="saveProjetActe()" type="submit"/>ENREGISTRER</a>
											</div>
										</div>
									</div>

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
