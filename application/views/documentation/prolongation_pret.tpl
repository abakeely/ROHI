{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Prolongation prêt : AGENT</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/service/sad/service-propose">Servises Proposés</a></li>
									<li class="breadcrumb-item">Prolongation Prêt</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{assign var=id value=""}
								{assign var=type_texte value=""}
								{assign var=sigle value=""}
								{assign var=date value=""}
								{assign var=intitule value=""}
								{assign var=lien value=""}
									
								<br>
								<div align="right">
									<a href="{$zBasePath}documentation/service/sad/service-propose" class="btn">Retour</a>
								</div>
								<br>

								<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
									<div align="center">LISTES EMPRUNTS EN COURS</div>
								</h3>
								
								
								<div style="font-size:90%; float:center;text-align:center; padding:0 0 2px 5px;">
									<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">L&eacute;gende</div>
									</h3>
									<img src="{$zBasePath}assets/img/img_sad/boule/accepter.jpg" alt="Accepter" title="Accepter" border="0" height="30" width="30"><b> Accept&eacute;</b>
									<img src="{$zBasePath}assets/img/img_sad/boule/refuser.jpg" alt="R&eacute;fus&eacute;" title="R&eacute;fus&eacute;" border="0" height="30" width="30"><b> R&eacute;fus&eacute;</b>
								</div>
								<br><br>
								<table class="table table-striped table-bordered table-hover" id="table_liste_prolongation">
									<thead>
										<tr>
										<th>Ordre</th>
										<th>Date de pr&ecirc;t</th>
										<th>Th&ecirc;mes</th>
										<th>C&ocirc;te</th>
										<th>Titre</th>
										<th>Auteur</th>
										<th>Edition</th>
										<th>Lieu</th>
										<th>Langue</th>
										<th>Date retour document</th>
										<th>Action</th>
										<th>Etat</th>
										</tr>
									</thead>	
									<tbody>
										{assign var=ordreIncrement value="0"}
										{foreach from=$oData.list_pret item=pret}
										<tr>
											<td>{$pret->id}</td>
											<td>{$pret->date_validation}</td>
											<td>{$pret->livre->theme_livre.libele}</td>
											<td>{$pret->livre->cote_livre}</td>
											<td>{$pret->livre->titre_livre}</td>
											<td>{$pret->livre->auteur_livre.libele}</td>
											<td>{$pret->livre->edition_livre}</td>
											<td>{$pret->livre->lieu_livre.libele}</td>
											<td>{$pret->livre->langue_livre.libele}</td>
											<td>{$pret->date_retour}</td>
											
											<td>
											<form action="pret_livre/id" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
												<fieldset>
													<div>
														&nbsp;&nbsp;<button>Prolonger</button>							
													</div>
												</fieldset>
											</form>
											</td>
									
											<td>			
												{if $pret->statut==0}
													<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png" alt="Valider"  border="0" height="38">
													<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Refuser"  border="0" height="28" width="28">
												{/if}
												{if $pret->statut==1}
													<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Valider"  border="0" height="28" width="28">
												{/if}
												{if $pret->statut==2}
													<img src="{$zBasePath}assets/img/img_sad/boule/en_pret.png" alt="Refuser"  border="0" height="30">
												{/if}
											</td>
										</tr>
										{assign var=ordreIncrement value=$ordreIncrement+1}
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

{include_php file=$zFooter}

{literal}
<script>

 $(document).ready(function() {
  $('#table_liste_prolongation').dataTable();
	});
	
</script>
{/literal}