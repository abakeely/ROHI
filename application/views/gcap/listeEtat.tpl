{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">{$oData.zLibelle}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Liste état</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<table>
									<thead>
										<tr>
											<th>Type de cong&eacute;</th>
											<th>Date d&eacute;but</th>
											<th>Date fin</th>
											<th>Motif</th>
											<th>Valideur</th>
											<th>Valider</th>
											<th class="center" width="100">Imprimer</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.oListe)>0}
										{foreach from=$oData.oListe item=oListeGcap }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											<td>{$oListeGcap.type_libelle}</td>
											<td>{$oListeGcap.gcap_dateDebut|date_format}</td>
											<td>{$oListeGcap.gcap_dateDebut|date_format}</td>
											<td>{$oListeGcap.gcap_motif}</td>
											<td>{$oListeGcap.nom}&nbsp;{$oListeGcap.prenom}</td>
											<td>
												{if $oListeGcap.gcap_valide == 1 and $oListeGcap.gcap_userValidId != "" and $oListeGcap.gcap_dateValidation != ""}
													<span class="action"><i style="color:#53D00F;" class="la la-check"></i></span>&nbsp;({$oListeGcap.gcap_dateValidation|date_format})
												{elseif $oListeGcap.gcap_valide == 0 and $oListeGcap.gcap_userValidId != "" and $oListeGcap.gcap_dateValidation != ""}
												Refus&eacute;&nbsp;({$oListeGcap.gcap_dateValidation|date_format})
												{else}
													&nbsp;
												{/if}
											</td>
											<td class="center">
												<a title="Imprimer" alt="Imprimer" href="{$zBasePath}gcap/imprimer/{$oData.zHashModule}/{$oData.zHashUrl}/{$oListeGcap.gcap_id}" title="" target="_blank" class="action"><i style="color:#12105A" class="la la-print"></i></a>
											</td>
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="7">{$oData.zMessageAucun}</td></tr>
										{/if}
									</tbody>
								</table>
								{$oData.zPagination}
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/etat/{$oData.zHashModule}/{$oData.zHashUrl}">
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