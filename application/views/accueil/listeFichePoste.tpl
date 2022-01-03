{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Liste des fiches de poste</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">les fiches de poste</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
								<table id="dataTables-example">
									<thead>
										<tr>
											<th style="display:none">N°</th>
											<th>Intitulé de poste</th>
											<th>Missions</th>
											<th class="center" width="100">Action</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="1"}
										{if sizeof($oData.toListe)>0}
										{foreach from=$oData.toListe item=oListe }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											<td style="display:none">{$iIncrement}</td>
											<td>{$oListe.fichePoste_intitule}</td>
											<td>{$oListe.fichePoste_mission}</td>
											<td class="center">
												<a href="{$zBasePath}accueil/editFiche/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListe.fichePoste_id}" title="" class="action"><i style="color:#12105A;font-size:23px;" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
												<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListe.fichePoste_id}" class="action suppr"><i style="color: #F10610;font-size:23px;" class="la la-close"></i></a>
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
					</div>
				</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<form name="formDelete" id="formDelete" action="{$zBasePath}accueil/deleteFicheDePosteR" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">
<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}accueil/listeCommunique">
</form>
<script>

{if sizeof($oData.toListe)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
</script>
{include_php file=$zFooter}
		