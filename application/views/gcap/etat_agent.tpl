{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste des agents rattach&eacute;s > ETAT</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Etat congé</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<table>
									<thead>
										<tr>
											<th>Nom</th> 
											<th>Pr&eacute;Nom</th>
											<th>Matricule</th>
											<th>Direction</th>
											<th>Service</th>
											<th>Division</th>
											<th style="text-align:center;">Etat de {$oData.zTitre}</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.oListe)>0}
										{foreach from=$oData.oListe item=oListeCompte }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											<td>{$oListeCompte.nom|upper}</td>
											<td>{$oListeCompte.prenom}</td>
											<td>{$oListeCompte.matricule}</td>
											<td>{$oListeCompte.zDirection}</td>
											<td>{$oListeCompte.zService}</td>
											<td>{$oListeCompte.zDivision}</td>
											<td class="center"><a title="Imprimer" alt="Imprimer" href="{$zBasePath}gcap/etat/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeCompte.user_id}" class="action"><i class="la la-print"></i></a></td>
											
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
										{/if}
									</tbody>
								</table>
								{$oData.zPagination}
								<div id="calendar"></div>
							
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/etat_agent/{$oData.zHashModule}/{$oData.zHashUrl}">
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