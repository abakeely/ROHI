{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Candidature Recu</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}">Formation</a> </li>
									<li class="breadcrumb-item">Candidatures Reçues</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">

								{assign var=id value=""}
								{assign var=type_offre value=""}
								{assign var=intitule value=""}
								{assign var=lieu_institut value=""}
								{assign var=date_formation value=""}
								
								{assign var=nom_prenom value=""}
								{assign var=matricule value=""}
								{assign var=poste value=""}
								{assign var=dep_dir value=""}
								{assign var=service value=""}
								
								{assign var=region value=""}
								{assign var=action value=""}
								
								<!--br>
								<div align="right">
									<a href="{$zBasePath}formation/offre/sfao/divers-offres" class="btn">Retour menu</a>
								</div>
								<br-->
								<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
									<div align="center">CANDIDATURES RECUES BOURSES</div>
								</h3>
								<div>	
									<div class="row">
										<form class="form-horizontal" role="form" name="documentation" id="documentation" action="{$zBasePath}documentaion/pret_livre/sad/pret-livre" method="POST"></form>
									</div>
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th style="display:none;"></th>
												<th>Type de formation</th>
												<th>Intitulé de formation</th>
												<th>Lieu</th>
												<th>Date de formation</th>
												<!--th>Nom et pr&eacute;noms</th-->
												<!--th>Matricule</th-->
												<!--th>Poste</th-->
												<th>DEP/DIR</th>
												<th>Service</th>
												<th>Region</th>
												<!--th>Action</th-->
											</tr>
										</thead>
										<tbody>	
											{assign var=iIncrement value="0"}
											{foreach from=$oData.liste item=candidat_recu_formation}
												<tr>
													<td style="display:none;">{$iIncrement}</td>
													<td>{$candidat_recu_formation->type_offre}</td>
													<td>{$candidat_recu_formation->intitule}</td>
													<td>{$candidat_recu_formation->lieu_institut}</td>
													<td>{$candidat_recu_formation->date_formation}</td>
													
													<!--td>{$candidat_recu_formation->nom_prenom}</td-->
													<!--td>{$candidat_recu_formation->matricule}</td--->
													<!--td>{$candidat_recu_formation->poste}</td--->
													<td>{$candidat_recu_formation->dep_dir}</td>
													
													<td>{$candidat_recu_formation->service}</td>
													<td>{$candidat_recu_formation->region}</td>
													<!--td>{$candidat_recu_formation->action}</td-->			
												</tr>	
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
										</tbody>
									</table>
								</div>
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
<style>
.dt-center {width:30%!important}
</style>
<script>
	$(document).ready(function() {
        $('#dataTables-example').dataTable({
		   "columnDefs": [
				{ className: "dt-center", "targets": [ 2 ] },
			 ],
		   
		});
		//"ordering" : false
	});
</script>
{/literal}
