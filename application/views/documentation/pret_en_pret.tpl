{include_php file=$zCssJs}
<!-- Main Wrapper -->
	<div class="main-wrapper">
		{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Liste prêts livres : AGENT</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}documentation/service/sad/service-propose">Servises Proposés</a></li>
								<li class="breadcrumb-item">Listes des Prêts</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
						<div class="card-body">
							{assign var=id value=""}
							{assign var=livre_id value=""}
							{assign var=user_id value=""}
							{assign var=statut value=""}
							{assign var=date_reservation value=""}
							{assign var=date_modification value=""}
							{assign var=date_validation value=""}
							{assign var=date_retour value=""}
							{assign var=date_retour2 value="0"}
							{assign var=date_email value="0"} 
							
							<div class="text-center" >
								<div align="right">
									<a href="{$zBasePath}documentation/service/sad/service-propose" class="btn">Retour</a>
								</div><br>
								<div align="center">
									<a href="{$zBasePath}documentation/pret_en_pret/sad/pret-pret" class="btn">LISTE DES EMPRUNTS</a>
									<!--<a href="{$zBasePath}documentation/pret_en_attente/sad/pret-attente" class="btn">LISTE D'ATTENTE</a> -->
								</div><br>
							</div>


							<div class="row">	
								<div style="font-size:90%; float:center;text-align:center; padding:0 0 2px 5px;">
									<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">L&eacute;gende</div>
									</h3>
									<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png"  border="0" height="30" width="30">Valider
									<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png"  border="0" height="42" width="42">En pr&ecirc;t
									<img src="{$zBasePath}assets/img/img_sad/boule/email.png"  border="0" height="35" width="35">Pret  par Email
									<img src="{$zBasePath}assets/img/img_sad/boule/retour.png"  border="0" height="30" width="30">Rendu
								</div>
							</div>

							<div style="width: 100%; height: 350px; overflow-y: scroll;">
								<table class="table table-striped table-bordered table-hover" id="table_liste_pretagent">
									<thead>
										<tr>
											<th>Ordre</th>
											<th>Date de pr&ecirc;t</th>
											{if $user['role'] == "biblio"}
											<th>Demandeur</th>
											{/if}
											<th>Th&ecirc;mes</th>
											<th>C&ocirc;te</th>
											<th>Titre</th>
											<th>Auteur</th>
											<th>Edition</th>
											{if $user['role'] == "biblio"}
											<th>Lieu</th>
											{/if}
											<th>Langue</th>
											<th>Date validation</th>
											<th>Date retour</th>
											{if $user['role'] == "biblio"}
											<th>Date r&eacute;ception SAD</th>
											{/if}
											<th>Etat</th>
											{if $user['role'] == "biblio"}
											<th>cv</th>
										{/if}
										</tr>
									</thead>
									<tbody>
											{assign var=ordreIncrement value="0"}
											{foreach from=$oData.list_pret item=pret_en_pret}	
											<tr>
												<td>{$ordre}</td>
												<td>{$pret_en_pret->date_reservation}</td>
												{if $user['role'] == "biblio"}
												<td>{$pret_en_pret->candidat?$pret_en_pret->candidat->matricule.'-'.$pret_en_pret->candidat->nom.' '.$pret_en_pret->candidat->prenom:''}</td>
												{/if}
												<td>{$pret_en_pret->livre->theme_livre.libele}</td>
												<td id="cote_{$pret_en_pret->id}">{$pret_en_pret->livre->cote_livre}</td>
												<td id="title_{$pret_en_pret->id}">{$pret_en_pret->livre->titre_livre}</td>
									
												<td >{$pret_en_pret->livre->auteur_livre.libele}</td>
												<td>{$pret_en_pret->livre->edition_livre}</td>
												{if $user['role'] != "biblio"}
												<td>{$pret_en_pret->livre->lieu_livre['libele']}</td>
												{/if}
												<td>{$pret_en_pret->livre->langue_livre.libele}</td>
												<td>{$pret_en_pret->date_validation}</td>
												<td>{$pret_en_pret->date_retour}</td>
												{if $user['role'] == "biblio"}
												<td>{$pret_en_pret->date_retour2}</td>
												{/if}
												<td>
												
												{if $pret_en_pret->statut == 0}
												{if $user['role'] == "biblio"}
													<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible" class="to_click" border="0" height="30" onclick="changeStatut({$pret_en_pret->id},1)">
													<img src="{$zBasePath}assets/img/img_sad/boule/en_pret_en_pret.png" alt=" En pr&ecirc;t"  class="to_click" border="0" height="38" width="38" onclick="changeStatut({$pret_en_pret->id},2)">
													<img src="{$zBasePath}assets/img/img_sad/boule/email.png" title="Livre envoie par email" class="to_click"  border="0" height="30" onclick="changeStatut({$pret_en_pret->id},4)">
													<img src="{$zBasePath}assets/img/img_sad/boule/retour2.png" alt="Rendu"  border="0" height="28" width="28">
													
													{else}
														<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"  border="0" height="28" width="28">
														<img src="{$zBasePath}assets/img/img_sad/boule/en_pret_en_pret.png" alt="En pr&ecirc;t"  border="0" height="40" width="40">
														<img src="{$zBasePath}assets/img/img_sad/boule/retour2.png" alt="Rendu"  border="0" height="28" width="28">
														
													{/if}
												{/if}
												
												{if $pret_en_pret->statut == 1}
												{if $user['role'] == "biblio"}
													<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"  border="0" height="28" width="28">
													<img src="{$zBasePath}assets/img/img_sad/boule/retour2.png" class="to_click" alt="Rendu"  border="0"  height="28" onclick="changeStatut({$pret_en_pret->id},3)">
													{else}
														<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"  border="0" height="30">
														<img src="{$zBasePath}assets/img/img_sad/boule/retour2.png" alt="Rendu"  border="0" height="38" width="38">
													{/if}
													
												{/if}
												
												{if $pret_en_pret->statut == 2}
												<img src="{$zBasePath}assets/img/img_sad/boule/en_pret_en_pret.png" title="En pr&ecirc;t"  class="to_click" border="0" height="30" onclick="changeStatut({$pret_en_pret->id},1)">
												{/if}
												{if $pret_en_pret->statut == 3}
													<img src="{$zBasePath}assets/img/img_sad/boule/retour2.png" title="Rendu"  border="0" height="28">
												{/if}
												{if $pret_en_pret->statut == 4}
													<img src="{$zBasePath}assets/img/img_sad/boule/email.png" title="Livre envoie par email" border="0" height="28">
												{/if}
											</td>
											{if $user['role'] == "biblio"}
											<td><a href="{$zBasePath}cv/fpdf_cv/{$pret_en_pret->candidat->id}"><img src="{$zBasePath}assets/img/img_sad/boule/cv.png" border="0" height="53" width="60"></a></td><?php }?>
											{/if}
										</tr>
										{assign var=ordreIncrement value=$ordreIncrement+1}
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
<script>

	(function($) {
	$(function() {
		$("#scroller").simplyScroll({direction:'backwards'});
	});
	})(jQuery);

    $(document).ready(function() {
        $('#table_loi').dataTable();
	});	
  </script>	
{/literal}