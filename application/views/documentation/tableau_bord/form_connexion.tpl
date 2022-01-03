{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Ajout Connexion Cybernet</h3>
								<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}">Archives et Documentations</a></li>
								<li class="breadcrumb-item">Tableau de Bord</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div align="right">
									<a href="{$zBasePath}tableau_bord/conexion_cybernet/sad/connexion-cybernet" class="btn">PRECEDENT</a>
								</div>
								<div id="content-wrap" >	

									<form class="form-horizontal" role="form" name="lect_ajout" action="{$zBasePath}tableau_bord/ajout_connexion_internet" method="POST">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="col-sm-6 control-label">Statut</label>
												<div class="col-sm-4">
													<select class="form-control" placeholder="Status" name="statut">
														<option  value="1">Agent</option>
														<option  value="2">Etudiant</option>
														<option  value="3">Autre usager</option>
													</select>
												</div>			
											</div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Matricule</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" placeholder="Matricule" name="matricule">
												</div>			
											</div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Nom et Prénoms</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" placeholder="Nom et Prénoms" name="nom_prenom" required="required">
												</div>			
											</div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Institution</label>
												<div class="col-sm-4">
													<input type="text" id="etablissement" class="form-control" placeholder="Institution" name="etablissement">
													<br/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Adresse</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" placeholder="Adresse" name="adresse" required="required">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Province</label>
												<div class="col-sm-4">
													<select class="form-control" placeholder="province" name="province" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="province">
															{foreach from=$oData.list_province item=province}    
															<option  value={$province.id}>{$province.libele}</option>
															{/foreach}
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-6 control-label">R&eacute;gion</label>
												<div class="col-sm-4">
													<select class="form-control" placeholder="region" name="region" id="region">
													</select>
												</div>
											</div>					
											<div class="form-group">
												<label class="col-sm-6 control-label">District</label>
												<div class="col-sm-4">
													<select class="form-control" name="district"  id="district">
													</select>
												</div>
											</div>
											<br><br>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label class="col-sm-2 control-label">D&eacute;partement</label>
												<div class="col-sm-4">
													<select class="form-control" placeholder="Departement" name="departement" data-toggle="tooltip" id="departement">
														<option  value="0">-------</option> 
														{foreach from=$oData.list_departement item=d}
															<option  value="{$d.id}">{$d.libele]}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Direction</label>
												<div class="col-sm-4">
													<select  class="form-control" placeholder="Direction" name="direction" data-toggle="tooltip" id="direction">
														<option  value="0">-------</option> 
														{foreach from=$oData.list_direction item=d}
															<option  value="{$d.id}">{$d.libele}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Service</label>
												<div class="col-sm-4">
													<select class="form-control" placeholder="Service" name="service" data-toggle="tooltip" id="service">
														<option  value="0">-------</option> 
														{foreach from=$oData.list_service item=d}
															<option  value="{$d.id}">{$d.libele}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Titre rechercher</label>
												<div class="col-sm-10">
													<textarea type="text" class="form-control" placeholder="cote" name="titre"  required="required"></textarea>
												</div>
											</div>			
											<div class="form-group">
												<label class="col-sm-2 control-label">Date Lecture</label>
												<div class="col-sm-4">
													<input type="text" id="input_date" class="form-control" placeholder=" Date Lecture" name="" readonly="true" value="{date("d/m/Y")}">
													<span class="la la-calendar txt-danger form-control-feedback"></span>
												</div>
											</div>				
											<div class="form-group">
												<label class="col-sm-2 control-label">Heure d'entrée</label> 
												<div class="col-sm-4">
													<input type="text" id="input_heure" class="form-control" placeholder="Heuredentree" name="dateheur" readonly="true" value="{date("H:i")}"> 
													<span class="la la-calendar txt-danger form-control-feedback"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Responsables </label>
												<div class="col-sm-4">
													<select class="form-control" name="responsablesortie" id="responsablesortie">
														{foreach from=$oData.list_respo item=respo}
															<option  value="{$respo->id}">{"[".$respo->sigle."] ".$respo->nom}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-6"></div>
												<div class="col-sm-6">
													<button class="form-control btn-primary" type="submit"/>ENREGISTRER</button>
												</div>
											</div><br>
										</div>
									</form>
								</div>

								{$oData.zPagination}
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

{/literal}
{literal}
<script>
	function verifier_livre(){
		var cote = $("#cote").val();
		$.ajax({
               url: "{$zBasePath}('documentation/verifier_livre/')/"+cote,
               type: 'get',
               success: function(data, textStatus, jqXHR) {
                   var obj = jQuery.parseJSON(data);
				   if(obj.statut == "ko"){
					   bootbox.alert("Ce cote n'existe pas !");
				    }
					else{
						var libele = obj.livre.titre_livre + " - " +obj.livre.theme_livre.libele+ " - " +obj.livre.auteur_livre.libele;
						$("#titre").val(libele);
					}
  					 
               },
               async: false
            });
	}
</script>
{/literal}