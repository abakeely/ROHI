{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste des en tête restitution</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Restitution en tête</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">	
								<div class="card punch-status">
									<div class="cell">
										<div class="field text-center">
										<form action="{$zBasePath}documentation/edit_teteRestitution" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
											<button onClick="{$zBasePath}documentation/edit_teteRestitution">Ajouter</button>
										</form>
										</div>
									</div>
								</div>
								<div class="clear"></div>

								<div class="col-xs-12">
									<table id="dataTables-example">
										<thead>
											<tr>
												<th style="display:none">N°</th>
												<th>Date</th>
												<th>Heure</th>
												<th>Lieu</th>
												<th>Thème</th>
												<th>Beneficiaire</th>
												<th class="center" width="100">Action</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="1"}
											{if sizeof($oData.toListe)>0}
											{foreach from=$oData.toListe item=oListeC }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td style="display:none">{$iIncrement}</td>
												<td>{$oListeC.date_restitution}</td>
												<td>{$oListeC.heure_restitution}</td>
												<td>{$oListeC.lieu_restitution1}</td>
												<td>{$oListeC.intitule_restitution</td>
												<td>{$oListeC.nom_prenom_restitution</td>
												<td class="center">
													<a href="{$zBasePath}documentation/edit/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeC.teteRestitution_id}" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
													<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeC.teteRestitution_id}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
												</td>
												
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
									{$oData.zPagination}
								</div>
								<div id="calendar"></div>
								<form name="formDelete" id="formDelete" action="{$zBasePath}documentation/deleteTeteRestitution" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
									<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}documentation/listeTeteRestitution">
								</form>
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

<script>
{if sizeof($oData.toListe)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
</script>