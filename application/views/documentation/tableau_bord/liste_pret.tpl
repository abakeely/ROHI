{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Listes prêts livres : ADMIN</h3>
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
									<a href="{$zBasePath}tableau_bord/couv_service/sad/couv-service" class="btn">Retour</a>
								</div>
								<div align="center">
									<a href="{$zBasePath}documentation/liste_pret/sad/liste-pret" class="btn">LISTE DES EMPRUNTS</a>
									<a href="{$zBasePath}documentation/service/sad/service-propose" class="btn">LISTE D'ATTENTE</a>
								</div><br>
								<div class="row">	
									<div style="font-size:90%; float:right;text-align:right; padding:0 0 2px 5px;">
										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
											<div align="center">L&eacute;gende</div>
										</h3>
										<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png"  border="0" height="30" width="30">Valider
										<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png"  border="0" height="42" width="42">En pr&ecirc;t
										<img src="{$zBasePath}assets/img/img_sad/boule/email.png"  border="0" height="35" width="35">Pret  par Email
										<img src="{$zBasePath}assets/img/img_sad/boule/retour.png"  border="0" height="30" width="30">Rendu
									</div>
								</div>
								<br><br>
								<table class="table table-striped table-bordered table-hover" id="table_liste_pretadmin">
									<thead>
										<tr>
											<th>Ordre</th>
											<th>Date de pr&ecirc;t</th>
											<th>Demandeur</th>
											<th>Th&ecirc;mes</th>
											<th>C&ocirc;te</th>
											<th>Titre</th>
											<th>Auteur</th>
											<th>Edition</th>
											<th>Langue</th>
											<th>Langue</th>
											<th>Date validation</th>
											<th>Date retour</th>
											<th>Date r&eacute;ception SAD</th>
											<th>Etat</th>
											<th>cv</th>
										</tr>
									</thead>
									<tbody>
											{assign var=ordreIncrement value="0"}
											{foreach from=$oData.list_pret item=pret}	
											<tr>
												<td>{$ordre}</td>
												<td>{$pret->date_reservation}</td>
												<td>{$pret->candidat?$pret->candidat->matricule.'-'.$pret->candidat->nom.' '.$pret->candidat->prenom:''}</td>
												<td>{$pret->livre->theme_livre.libele}</td>
												<td id="cote_{$pret->id}">{$pret->livre->cote_livre}</td>
												<td id="title_{$pret->id}">{$pret->livre->titre_livre}</td>
									
												<td >{$pret->livre->auteur_livre.libele}</td>
												<td>{$pret->livre->edition_livre}</td>
												<td>{$pret->livre->lieu_livre.libele}</td>
												<td>{$pret->livre->langue_livre.libele}</td>
												<td>{$pret->date_validation}</td>
												<td>{$pret->date_retour}</td>
												<td>{$pret->date_retour2}</td>
												
												<td>			
													{if $pret->statut==0}
														<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible" class="to_click" border="0" height="30" onclick="changeStatut({$pret->id},1)">
														<img src="{$zBasePath}assets/img/img_sad/boule/en_pret.png" alt=" En pr&ecirc;t"  class="to_click" border="0" height="38" width="38" onclick="changeStatut({$pret->id},2)">
														<img src="{$zBasePath}assets/img/img_sad/boule/email.png" title="Livre envoie par email" class="to_click"  border="0" height="30" onclick="changeStatut({$pret->id},4)">
														<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" alt="Rendu"  border="0" height="28" width="28">
														
													{/if}
													{if $pret->statut==1}
														<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"  border="0" height="28" width="28">
														<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" class="to_click" alt="Rendu"  border="0"  height="28" onclick="changeStatut({$pret->id},3)">
													{/if}
													{if $pret->statut==2}
														<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png" title="En pr&ecirc;t"  class="to_click" border="0" height="30" onclick="changeStatut({$pret->id},1)">
													{/if}
													{if $pret->statut==3}
														<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" title="Rendu"  border="0" height="28">
													{/if}
													{if $pret->statut==4}
														<img src="{$zBasePath}assets/img/img_sad/boule/email.png" title="Livre envoie par email" border="0" height="28">
													{/if}
												</td>
												<td><a href="{$zBasePath}cv/fpdf_cv/{$pret->candidat->id}"><img src="{$zBasePath}assets/img/img_sad/cv.png" border="0" height="53" width="60"></a></td>
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
  setTimeout(function() { location.reload() },150000);
 function changeStatut(id,statut){
	 var title = $('#title_'+id).text();
	  var cote = $('#cote_'+id).text();
	  var msg = "";
	  if(statut==1){
		  msg = "Voullez-vous comfirmer l'emprunt de l'ouvrage: "+cote+" : "+title +" ?";
		  }
	  else if(statut==3){
		  msg = "Retour: "+cote+" : "+title +" ?";
	  }
	  else if(statut==4){
		  msg = "Envoie par email: "+cote+" : "+title +" ?";
	  }
	   else{
		  msg = "L'ouvrage : "+cote+" : "+title +" est en pret ?";
		  }
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
  $('#table_liste_pretadmin').dataTable();
	});
</script>	
{/literal}

