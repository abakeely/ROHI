{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Listes besoins spécifiques : AGENT</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/service/sad/service-propose">Servises Proposés</a></li>
									<li class="breadcrumb-item">Listes des besoins</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="text-center" >
									<div align="right">
										<a href="{$zBasePath}documentation/service/sad/service-propose" class="btn">Retour</a>
									</div><br>
									
									<div align="center">
										<a href="{$zBasePath}documentation/liste_besoin/sad/besoins-specifiques" class="btn">LISTE DES BESOINS</a>
										<a href="{$zBasePath}documentation/besoin_livre/sad/ajout-besoins-specifiques" class="btn">AJOUT BESOINS</a>
									</div><br>
								</div>
								<div style="font-size:90%; float:center;text-align:center; padding:0 0 2px 5px;">
									<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">L&eacute;gende</div>
									</h3>
									<img src="{$zBasePath}assets/img/img_sad/boule/accepter.jpg"  border="0" height="30" width="30"> Accepter
									<img src="{$zBasePath}assets/img/img_sad/boule/refuser.jpg"  border="0" height="30" width="30">R&eacute;fuser&nbsp;&nbsp;  
								</div>
								<table class="table table-striped table-bordered table-hover" id="table_liste_besoin">
									<thead>
										<tr>
											<th>Date de demande</th>				
											<th>Description</th>
											<th>Th&ecirc;mes</th>
											<th>Titres</th>
											<th>Auteurs</th>
											<th>Edition</th>
											<th>Lieu</th>
											<th>Langue</th>
											<th>Action</th>
											
											{if $oData.iSessionCompte == COMPTE_SAD}
											<th>cv</th>
											{/if}
											
										</tr>
									</thead>
									<tbody>				
											{assign var=ordreIncrement value="0"}
											{foreach from=$oData.liste_besoin item=besoin}	
											<tr>
												<td>{$besoin->date_demande_besoin}</td>
												<td>{$besoin->description_besoin}</td>
												<td>{$besoin->theme_besoin}</td>
												<td>{$besoin->titre_besoin}</td>
												<td>{$besoin->auteur_besoin}</td>
												<td>{$besoin->edition_besoin}</td>
												<td>{$besoin->lieu_besoin}</td>
												<td>{$besoin->langue_besoin}</td>
												
												<td>			
													{if $besoin->statut==0}
														{if $oData.iSessionCompte == COMPTE_SAD}
														<img src="{$zBasePath}assets/img/img_sad/boule/accepter.jpg"   border="0" height="30" onclick="changeStatut('{$besoin->id}',1)">
														<img src="{$zBasePath}assets/img/img_sad/boule/refuser.jpg"   border="0" height="30" width="30" onclick="changeStatut('{$besoin->id}',2)">
														
														{else}
															<img src="{$zBasePath}assets/img/img_sad/boule/refuser.jpg"  border="0" height="30">
															<img src="{$zBasePath}assets/img/img_sad/boule/accepter.jpg"  border="0" height="30" width="30">
														{/if}
													{/if}
													
													{if $besoin->statut==1}
														<img src="{$zBasePath}assets/img/img_sad/boule/accepter.jpg"   border="0" height="30" width="30">
													{/if}
													{if $besoin->statut==2}
														<img src="{$zBasePath}assets/img/img_sad/boule/refuser.jpg" a  border="0" height="30">
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
 function changeStatut(id,statut){
	 var title = $('#title_'+id).text();
	  var cote = $('#cote_'+id).text();
	  var msg = "";
	  if(statut==1)
		  msg = "Demande accepter";
	   else
		  msg = "Demande r&eacute;fuser";
	  bootbox.confirm(msg,
				function(result) { 
						if (result === false) {
											//Do nothing
						} else {
							document.location.href = "{$zBasePath}documentation/action_besoin/"+statut+"/"+id;	
						}
				}
		);
 }
 
 $(document).ready(function() {
  $('#table_liste_besoin').dataTable();
	});
</script>	
{/literal}