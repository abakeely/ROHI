{include_php file=$zCssJs}
	<!-- Main Wrapper -->
	<input type="hidden" id="base_url" value="{$zBasePath}">
	<input type="hidden" id="iInscriptionligneId" value="{$oData.iInscriptionligneId}">
	<script src="{$zBasePath}assets/js/bootstrapValidator.min.js"></script>
	<script src="{$zBasePath}assets/js/formValidation.min.js"></script>
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Candidatures Reçues</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Formation</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/offre/sfao/divers-offres">Offres</a></li>
									<li class="breadcrumb-item">Candidatures Reçues</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<div style="text-align : center;">
										{php} 
											if ($_SESSION["session_compte"] == COMPTE_AUTORITE){  
										{/php}
										<a class="aButton" href="{$zBasePath}formation/insc/sfao/inscription-ligne/2">
											<button style="max-width:350px;" class="btn btn-close">Ajouter nouvelle candidature reçue</button>
											<div class="bubblePosition hoverBubble">
											<p>Ce boutton permet à tous les titulaires de compte Autorité de mettre à jour automatiquement les candidatures de agents reçues et validées à leur niveau</p>
											</div>
										</a>
										{php} 
											}
										{/php} 
									</div><br>
									<div style="text-align : center">
										<span id="color_left" class="code_color">Validé : <span></span> </span>
										<span id="color_right" class="code_color">Refusé : <span></span></span>
									</div>
									<div id="_div" class="col-md-12">
										<br>
										<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
											<tr >
													<th>Type de formation</th>
													<th>Intitule de formation</th>
													<th>Lieu</th>
											<th>Date de formation</th>
											<th>Nom et Pr&eacute;noms</th>
													<th>IM</th>
											<th>Poste</th>
													<th>DEP/DIR</th>
											<th>Service</th>
													<th>Region</th>
											<th>Action</th>
											</tr>
											</thead>

											{foreach from=$oData.oCandidature item=oCandidature}
											<tr class="{if $oCandidature.inscriptionligne_valide == 1}inscription_validate {elseif $oCandidature.inscriptionligne_valide == 2}inscription_refused{/if}">

												<td>{$oCandidature.theme_intitule.theme_intitule}</td>
												<td>{$oCandidature.intituleFormation.intitule_libelle}</td>
												<td>{$oCandidature.inscriptionligne_lieuFormation}</td>
												<td>{$oCandidature.inscriptionligne_dateFormation}</td>
												<td class="nomPrenom">{$oCandidature.oCandidat.nom} {$oCandidature.oCandidat.prenom}</td>
												<td>{$oCandidature.oCandidat.matricule}</td>
												<td>{$oCandidature.inscriptionligne_poste}</td>
												<td>{$oCandidature.oCandidat.zDepartement}/{$oCandidature.oCandidat.zDirection}</td>
												<td>{$oCandidature.oCandidat.zService}</td>
												<td>{$oCandidature.oCandidat.zRegion}</td>

												<!-- AFFICHE VALIDER L'AGENT -->
												{if $oCandidature.inscriptionligne_valide==0}
												<td style="text-align : center;">
													<input class="iInscriptionId" type="hidden" value={$oCandidature.inscriptionligne_id}/>
													{if $oData.oUser.serv && ($oData.oUser.serv == $oCandidature.oCandidat.service)}
														{if $oData.oUser.reg != '0'&& ($oData.oUser.reg == $oCandidature.oCandidat.region_id)}
														<a title="Valider" class="validate" href="#"><img style="width : 25px !important" src="{$zBasePath}assets/inscription/img/true.png"></a>
														<a title="Refuser" class="refused" href="#"><img style="width : 25px !important" src="{$zBasePath}assets/inscription/img/false.png"></a>
														{/if}
													{elseif $oData.oUser.dir && ($oData.oUser.dir == $oCandidature.oCandidat.direction)}
														{if $oData.oUser.reg != '0' && $oData.oUser.reg == $oCandidature.oCandidat.region_id}
														<a title="Valider" class="validate" href="#"><img style="width : 25px !important" src="{$zBasePath}assets/inscription/img/true.png"></a>
														<a title="Refuser" class="refused" href="#"><img style="width : 25px !important" src="{$zBasePath}assets/inscription/img/false.png"></a>
														{/if}
													{elseif $oData.oUser.dep && ($oData.oUser.dep == $oCandidature.oCandidat.departement)}
														{if $oData.oUser.reg != '0' && ($oData.oUser.reg == $oCandidature.oCandidat.region_id)}
														<a title="Valider" class="validate" href="#"><img style="width : 25px !important" src="{$zBasePath}assets/inscription/img/true.png"></a>
														<a title="Refuser" class="refused" href="#"><img style="width : 25px !important" src="{$zBasePath}assets/inscription/img/false.png"></a>
														{/if}
													{else}
														{if ($oCandidature.oCandidat.id == $oData.oCurrentCandidat->id) || $oData.isResponsable}
														<a href="#" title="Afficher" class="showInfo">
															<i class="la la-eye"></i>
														</a>
														<form action="{$zBasePath}formation/edit_inscription/sfao/inscription-ligne" method="POST">
															<input name="valeur" type="hidden" value={$oCandidature.inscriptionligne_id} />
															<a href="#" onclick="this.parentNode.submit()" title="Editer" class="editInscription">
																<i class="la la-edit"></i>
															</a>
														</form>
														{/if}
													{/if}
												</td>
												{else}
												<td style="text-align : center">
													<input class="iInscriptionId" type="hidden" value={$oCandidature.inscriptionligne_id} />
													{if ($oCandidature.oCandidat.id == $oCurrentCandidat->id) || $oData.isResponsable}
													<a href="#" title="Afficher" class="showInfo">
														<i class="la la-eye"></i>
													</a>
													<form action="{$zBasePath}formation/edit_inscription/sfao/inscription-ligne" method="POST">
														<input name="valeur" type="hidden" value={$oCandidature.inscriptionligne_id} />
														<a href="#" onclick="this.parentNode.submit()" title="Editer" class="editInscription">
															<i class="la la-edit"></i>
														</a>
													</form>
													{/if}
												</td>
												{/if}
											</tr>
											{/foreach}
										</table>
									</div>

									<div class="modal fade" style="z-index:10000" id="modalInscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

									</div>	
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
  .aButton{
    position : relative;
    text-decoration: none;
  }
  .hoverBubble {
    z-index: 3;
    background: #ABBAC3;
    color: #ffffff;
    cursor: pointer;
    opacity: 0;
    padding: 5px;
    position: absolute;
    text-align: left;
    visibility: hidden;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    -webkit-transition: all 0.25s;
    -moz-transition: all 0.25s;
    -ms-transition: all 0.25s;
    -o-transition: all 0.25s;
    transition: all 0.25s;
  }

  .bubblePosition {
    left: -17%;
    width: 500px;
    top: 240%;
    height: 80px;
  }

  .hoverBubble:before,
  .bubblePosition:before {
    border: 8px solid transparent;
    top: -15px;
    color: #ABBAC3;
    content: '\25b2';
    height: 0px;
    left: 0;
    margin: 0 auto;
    position: absolute;
    right: 0;
    width: 0px;
  }
  .hoverBubble p {
    font-family: Courier, monospace;
    text-align: center;
    font-size: 1.6em;
  }

  /* bubble hover */
  .aButton:hover .hoverBubble {
    opacity: 1;
    visibility: visible;
    -webkit-transition: all 0.25s;
    -moz-transition: all 0.25s;
    -ms-transition: all 0.25s;
    -o-transition: all 0.25s;
    transition: all 0.25s;
  }
  .code_color{
    display: inline-block;
    position : relative;
    width : 50%;
    font-family: 'Indie Flower', cursive;
  }
  #color_left{
    float : left;
  }
  #color_right span,#color_left span{
    position: absolute;
    margin-left:  5%;
    width : 20px;
    height : 20px;
    border-radius : 50%;
  }
  #color_left span{
    background-color: #2edcb4d4;
  }
  #color_right span{
    background-color: #d22828d4;
  }
  .inscription_validate td{
        background-color: #2edcb4d4 !important;
  }

  .inscription_refused td{
        background-color: #d22828d4 !important;
  }
  #_div table{
    table-layout: auto;
  }
</style>
<script>
  $(document).ready(function() {
        $('#dataTables-example').dataTable();
        $('.showInfo').click(function(e){
			e.preventDefault();
			var iInscriptionId = $(this).closest('td').find(".iInscriptionId").val();
			var urlGET = "{/literal}{$zBasePath}{literal}formation/getInfoInscription/"
			$.ajax({
                url: urlGET,
                type: 'post',
				data : {
					valeur : iInscriptionId
				},
                success: function(data, textStatus, jqXHR) {
					$("#modalInscription").html(data);
                    $("#modalInscription").modal('toggle');
                },
                async: false
       		 });

        });
		
        $('.validate').click(function(e){
			e.preventDefault();
			var iInscriptionId = $(this).closest('td').find(".iInscriptionId").val();
			var nom_prenom = $(this).closest('tr').find(".nomPrenom").html();
			bootbox.confirm("Voulez-vous valider la demande d'inscription de : "+nom_prenom,
      			function(result) {
      				if (result) {
						var urlGET = "{/literal}{$zBasePath}{literal}formation/valide_inscription/"
						$.ajax({
							url: urlGET,
							type: 'post',
							data : {
								iInscriptionId : iInscriptionId,
								value : 1
							},
							success: function(data, textStatus, jqXHR) {
								if(data){
									bootbox.alert("Opération effectuée");
									location.reload();
								}
								else bootbox.alert("Opération echouée");
							},
							async: false
						});
      				}
      			}
      		);
        });
        $('.refused').click(function(e){
			e.preventDefault();
			var iInscriptionId = $(this).closest('td').find(".iInscriptionId").val();
			var nom_prenom = $(this).closest('tr').find(".nomPrenom").html();
			bootbox.confirm("Voulez-vous refuser la demande d'inscription de : "+nom_prenom,
      			function(result) {
      				if (result) {
						var urlGET = "{/literal}{$zBasePath}{literal}formation/valide_inscription/"
						$.ajax({
							url: urlGET,
							type: 'post',
							data : {
								iInscriptionId : iInscriptionId,
								value : 2
							},
							success: function(data, textStatus, jqXHR) {
								if(data){
									bootbox.alert("Opération effectuée");
									location.reload();
								}
								else bootbox.alert("Opération echouée");
							},
							async: false
						});
      				}
      			}
      		);
        });
	});
</script>
{/literal}
