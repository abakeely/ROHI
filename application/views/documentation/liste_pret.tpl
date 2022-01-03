{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Listes prêts livres : AGENT</h3>
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
								<script type="text/javascript" src="{$zBasePath}assets/sad/jquery.simplyscroll.js"></script>
								<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/sad/jquery.simplyscroll.css" >

								<div align="right">
									<a href="{$zBasePath}documentation/service/sad/service-propose" class="btn">Retour</a>
								</div>
								<!--  <div align="center">
										<a href="{$zBasePath}documentation/pret_en_pret/sad/pret-pret" class="btn">LISTE DES EMPRUNTS</a>
										<a href="{$zBasePath}documentation/pret_en_attente/sad/pret-attente" class="btn">LISTE D'ATTENTE</a> -->
								<!-- </div><br>  --> 
								<br><br>
								<ul id="scroller">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/bleu_final_2.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/bleu_final_1.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/orange_final_2.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/orange_final_1.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/rouge_final_2.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/rouge_final_1.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/vert_final_2.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/vert_final_1.jpg" alt="" title="" border="0" height="100" width="200">
									<img src="{$zBasePath}assets/img/img_sad/slide/pret/legend.jpg" alt="" title="" border="0" height="100" width="200">
								</ul>
								<br>	
								<div style="font-size:90%; float:center;text-align:center; padding:0 0 2px 5px;">
									<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">L&eacute;gende</div>
									</h3>
									<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png"  border="0" height="30" width="30">Valider
									<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png"  border="0" height="42" width="42">En pr&ecirc;t
									<img src="{$zBasePath}assets/img/img_sad/boule/email.png"  border="0" height="35" width="35">Pret  par Email
									<img src="{$zBasePath}assets/img/img_sad/boule/retour.png"  border="0" height="30" width="30">Rendu
								</div>
								<br>
								<table class="table table-striped table-bordered table-hover" id="table_liste_pretagent">
									<thead>
										<tr>
											<th style="display:none">Ordre</th>
											<th>Date de pr&ecirc;t</th>
											
											{if $oData.iSessionCompte == COMPTE_SAD}
											<th>Demandeur</th>
											{/if}
											
											<th>Th&ecirc;mes</th>
											<th>C&ocirc;te</th>
											<th>Titre</th>
										
											<th>Auteur</th>
											<th>Edition</th>
											<th>Langue</th>
											
											<th>Date validation</th>
											<th>Date retour</th>
											
											{if $oData.iSessionCompte == COMPTE_SAD}
											<th>Date r&eacute;ception SAD</th>
											{/if}
											
											<th>Etat</th>
											{if $oData.iSessionCompte == COMPTE_SAD}
											<th>cv</th>
											{/if}
										</tr>
									</thead>
									<tbody>
											{assign var=ordreIncrement value="0"}
											{foreach from=$oData.list_pret item=pret}	
											<tr>
												<td style="display:none">{$ordre}</td>
												<td>{$pret->date_reservation}</td>
															
												{if $oData.iSessionCompte == COMPTE_SAD}
												<td>{$pret->candidat->matricule}<br>{$pret->candidat->nom}&nbsp;{$pret->candidat->prenom}</td>
												{/if}
												
												<td>{if isset($pret->livre->theme_livre.libele)}{$pret->livre->theme_livre.libele}{/if}</td>
												<td id="cote_{$pret->id}">{if isset($pret->livre->cote_livre)}{$pret->livre->cote_livre}{/if}</td>
												<td id="title_{$pret->id}">{if isset($pret->livre->cote_livre)}{$pret->livre->titre_livre}{/if}</td>
												<td >{if isset($pret->livre->auteur_livre.libele)}{$pret->livre->auteur_livre.libele}{/if}</td>
												<td>{if isset($pret->livre->edition_livre)}{$pret->livre->edition_livre}{/if}</td>
												
												<td>{if isset($pret->livre->edition_livre)}{$pret->livre->langue_livre.libele}{/if}</td>
												<td>{$pret->date_validation}</td>
												<td>{$pret->date_retour}</td>
												
												{if $oData.iSessionCompte == COMPTE_SAD}
												<td>{$pret->date_retour2}</td>
												{/if}				
												
												<td>			
													{if $pret->statut == 0}
														{if $oData.iSessionCompte == COMPTE_SAD}
														
														<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"  class="to_click" border="0" height="30" style="cursor:pointer" onclick="changeStatut('{$pret->id}',1)">
														<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png" alt="En pr&ecirc;t"  class="to_click" border="0" height="38" width="38" onclick="changeStatut('{$pret->id}',2)">
														<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" alt="Rendu"  border="0" height="28" width="28">
														<img src="{$zBasePath}assets/img/img_sad/boule/email.png" alt="Email"  title="Livre envoie par email" class="to_click"  border="0" height="30" onclick="changeStatut('{$pret->id}',4)">
														
															
															{else}
															
															<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"  border="0" height="28" width="28">
															<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png" alt="En pr&ecirc;t"  border="0" height="40" width="40">
															<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" alt="Rendu"  border="0" height="28" width="28">
															<img src="{$zBasePath}assets/img/img_sad/boule/email.png" alt="Email"   border="0" height="30" width="28">
															
														{/if}
													{/if}
													{if $pret->statut == 1}
													{if $oData.iSessionCompte == COMPTE_SAD}
														<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"   border="0" height="28" width="28">
														<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" class="to_click" alt="Rendu" style="cursor:pointer"  border="0"  height="28" onclick="changeStatut('{$pret->id}',3)">
														{else}
															<img src="{$zBasePath}assets/img/img_sad/boule/disponible.png" alt="Disponible"   border="0" height="30">
															<img src="{$zBasePath}assets/img/img_sad/boule/retour.png" alt="Rendu"  border="0" height="38" width="38">
														{/if}
														
													{/if}
													{if $pret->statut == 2}
														<img src="{$zBasePath}assets/img/img_sad/boule/enpret.png" style="cursor:pointer" alt="En pr&ecirc;t"  border="0" height="38" onclick="changeStatut('{$pret->id}',1)">
													{/if}
													{if $pret->statut == 3}
														<img src="{$zBasePath}assets/img/img_sad/boule/retour.png"  title="Rendu"  border="0" height="28">
													{/if}
													{if $pret->statut == 4}
														<img src="{$zBasePath}assets/img/img_sad/boule/email.png"  title="Livre envoie par email" border="0" height="28">
													{/if}
										</td>
												
											
												{if $oData.iSessionCompte == COMPTE_SAD}
													<td><a target="_blank" href="{$zBasePath}cv/fpdf_cv/{$pret->candidat->id}"><img src="{$zBasePath}assets/img/img_sad/cv.png" border="0" height="53" width="60"></a>
													</td>
												{/if}
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
							document.location.href = "{/literal}{$zBasePath}{literal}documentation/action_pret/sad/action-pret/"+statut+"/"+id;							
						}
				}
		);
 }
 
 $(document).ready(function() {
  $('#table_liste_pretagent').dataTable();
	});
	
(function($) {
	$(function() {
		$("#scroller").simplyScroll({direction:'backwards'});
	});
	})(jQuery);
 
 
 $(document).ready(function() {
  $('#table_liste_pret').dataTable();
	});
</script>	
{/literal}