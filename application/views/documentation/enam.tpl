{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Memoire de fin d'Etude : ENAM</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation">Archives et Documentations</a></li>
									<li class="breadcrumb-item">ENAM</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{assign var=id value=""}
								{assign var=cote_enam value=""}
								{assign var=titre_enam value=""}
								{assign var=auteur_enam value=""}
								{assign var=edition_enam value=""}
								{assign var=lieu_enam value=""}
								
								{assign var=langue_enam value=""}
								{assign var=format_enam value=""}
								{assign var=nombre_page_enam value=""}
								{assign var=nombre_explaire_enam value=""}
									
								<script type="text/javascript" language="javascript" src="{$zBasePath}assets/common/css/sad/js/jquery.dataTables.js"></script>
								<script type="text/javascript" language="javascript" src="{$zBasePath}assets/common/css/sad/js/dataTables.pageResize.min.js"></script>		

								<br>
								<div align="right">
									<a href="{$zBasePath}documentation/memoire/sad/memeoire-etude" class="btn">Retour</a>
								</div><br>	

								<div class="text-center" >
									<ul class="tabs">
										<li class="tab-link current" imodeid="1" data-tab="tab-1" id="liTab-1">
											<a href="{$zBasePath}documentation/pret_livre/sad/formation/16">&nbsp;INSTITUT ET UNIVERSITE</a>
										</li>
										<li class="tab-link" imodeid="2" data-tab="tab-2" id="liTab-2">
											<a href="{$zBasePath}documentation/enam/sad/memoire-enam">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ENAM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
										</li>
									</ul>
								</div>


								<table class="table table-striped table-bordered table-hover" id="table_enam">
									<thead>
										<tr>
											<th>C&ocirc;te</th>
											<th>Titre</th>
											<th>Auteur</th>
											<th>Edition</th>
											<th>Lieu</th>
											<th>Langue</th>
											<th>Format</th>
											<th>Nb page</th>
											<th>Explaire</th>
										</tr>
									</thead>	
											
									<tbody>	
									{foreach from=$oData.liste item=enam} 	
										<tr>
											<td>{$enam->cote_enam}</td>
											<td>{$enam->titre_enam}</td>
											<td>{$enam->auteur_enam}</td>
											<td>{$enam->edition_enam}</td>
											<td>{$enam->lieu_enam}</td>
											<td>{$enam->langue_enam}</td>
											<td>{$enam->format_enam}</td>
											<td>{$enam->nombre_page_enam}</td>
											<td>{$enam->nombre_explaire_enam}</td>
										</tr>
									{/foreach}
									</tbody>
								</table>
										
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


	{literal}
	<script>
		
		$(document).ready(function() {
			$('#table_enam').dataTable({
			});	
		});
		
	</script>
	{/literal}

{include_php file=$zFooter}