{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste connexion net</h3>
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
								<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
									<div align="center">LISTE DES AGENTS CONNECTES SUR CYBERNET</div>
								</h3>
								<form class="form-horizontal" role="form" name="documentation" id="documentation" action="{$zBasePath}documentaion/catalogue" method="POST">
									<table class="table table-striped table-bordered table-hover" id="table_liste_connexion">
										<thead>
											<tr >
											<th>Ordre</th>
											<th>Type usager</th>
											<th>Nom & prenom</th>
											<th>titre recherche</th>
											<th>responsable</th>
											<th>date lecture</th>
											<th>etablissement</th>
											</tr>
										</thead>
										<tbody>
										
											{assign var=ordreIncrement value="0"}
											{foreach from=$oData.list_consultation item=consul}
											<tr>
												<td>{$ordre}</td>
												<td>
													{if $consul->statut==1}{assign var=libele value="Agent"}{/if}
													{if $consul->statut==2}{assign var=libele value="Etudiant"}{/if}
													{if $consul->statut==3}{assign var=libele value="Autre usager"}{/if}
													{$libele};
												</td>
												<td>{$consul->nom_prenom}</td>
												<td>{$consul->titre_recherche}</td>
												<td>{$consul->responsable}</td>
												<td>{$consul->date_lecture}</td>
												<td>{$consul->etablissement}</td>
											</tr>
											{assign var=ordreIncrement value=$ordreIncrement+1}
											{/foreach}
										</tbody>
									</table>	
								</form>	
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
<script>
 function changeStatut(id,statut){
	 var title = $('#title_'+id).text();
	  var cote = $('#cote_'+id).text();
	  var msg = "";
	  if(statut==1)
		  msg = "Votre demande a ete pris en compte, vous pouvez recperer le document aupres de la sad : "+cote+" : "+title +" disponible ?";
	   else
		  msg = "Voulez-vous rendre le livre : "+cote+" : "+title +" en pret ?";
	  bootbox.confirm(msg,
				function(result) { 
						if (result === false) {
											//Do nothing
						} else {
							document.location.href = "{$zBasePath}documentation/action_pret/"+statut+"/"+id;	
						}
				}
		);
 }
 
 $(document).ready(function() {
  $('#table_liste_connexion').dataTable();
	});
</script>
{/literal}
