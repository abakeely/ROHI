{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Les congés</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Les congés</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Matricule</th>
												<th>Nom</th>
												<th>P&eacute;Nom</th>
												<th>Genre</th>
												<th>Date d&eacute;but</th>
												<th>Date fin</th>
												
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.oListe)>0}
											{foreach from=$oData.oListe item=oListeGcap }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeGcap.matricule}</td>
												<td>{$oListeGcap.nom}</td>
												<td>{$oListeGcap.prenom}</td>
												<td>{$oListeGcap.type_libelle}</td>
												<td>{$oListeGcap.gcap_dateDebut|date_format|utf8}</td>
												<td>{$oListeGcap.gcap_dateFin|date_format|utf8}</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="7">Aucune d&eacute;cision finalis&eacute;e</td></tr>
											{/if}
										</tbody>
									</table>
								{* {$oData.zPagination} *}
								</div>

								<div id="calendar"></div>

								<script>
									{if sizeof($oData.oListe)>0}
									{literal}
									$(document).ready(function() {
											$('#dataTables-example').dataTable();
										});
									{/literal}
									{/if}
								</script>
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
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