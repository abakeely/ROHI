{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">JOURNAL</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Planning</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<form action="{$zBasePath}gcap/rattache/{$oData.zHashModule}/{$oData.zHashUrl}/" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
									<fieldset>
										<div class="clearfix">
											<div class="cell">
												<div class="field">
													<label>Localite / Porte</label>
													<input type="text" name="zLocalite" id="zLocalite" value="{$oData.oDataSearch.zLocalite}" placeholder="Localite / Porte">
												</div>
											</div>
										</div>
										<div class="row1">
											<div class="cell small">
												<div class="field">
													<label>Matricule</label>
													<input type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
													<p class="message debut" style="width:500px">&nbsp;</p>
												</div>
											</div>
										</div>
										<div class="row1 clearfix">
											<div class="cell small">
												<div class="field">
													<label>CIN</label>
													<input type="text" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
													<p class="message fin" style="width:500px">&nbsp;</p>
												</div>
											</div>
										</div>
										<div class="row1" >
											<div class="cell">
												<div class="field">
													<input type="button" class="button" onClick="sendSearch()" name="" id="" value="rechercher">
												</div>
											</div>
										</div>
									</fieldset>
								</form>
								<div><p>&nbsp;</p></div>
								<table>
									<thead>
										<tr>
											<th>Nom et prénom</th>
											<th>D&eacute;but</th>
											<th>Fin</th>
											<th>D&eacute:but</th>
											<th>Fin</th>
											<th>D&eacute;but</th>
											<th>Fin</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.oListe)>0}
										{foreach from=$oData.oListe item=oListeGcap }
										<tr {if $iIncrement%2 == 0} class="even" {/if}>
											{if $oListeGcap.gcap_typeGcapId == CONGE}
												<td >{$oListeGcap.nom}&nbsp;{$oListeGcap.prenom}</td>
												<td style="background: rgba(255, 255, 0, 0.41)!important;">{$oListeGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}</td>
												<td style="background: rgba(255, 255, 0, 0.41)!important;">{$oListeGcap.gcap_dateFin|date_format:"%d/%m/%Y"}</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											{elseif $oListeGcap.gcap_typeGcapId == PERMISSION}
												<td>{$oListeGcap.nom}&nbsp;{$oListeGcap.prenom}</td>
												<td></td>
												<td></td>
												<td style="background:rgba(0, 0, 253, 0.36)!important">{$oListeGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}</td>
												<td style="background:rgba(0, 0, 253, 0.36)!important">{$oListeGcap.gcap_dateFin|date_format:"%d/%m/%Y"}</td>
												<td></td>
												<td></td>
											{elseif $oListeGcap.gcap_typeGcapId == AUTORISATION_ABSENCE}
												<td>{$oListeGcap.nom}&nbsp;{$oListeGcap.prenom}</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td style="background: rgba(0, 251, 0, 0.54)!important;">{$oListeGcap.gcap_dateDebut|date_format:"%d/%m/%Y"}</td>
												<td style="background: rgba(0, 251, 0, 0.54)!important;">{$oListeGcap.gcap_dateFin|date_format:"%d/%m/%Y"}</td>
											{/if }
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="7">{$oData.zMessageAucun}</td></tr>
										{/if}
									</tbody>
								</table>
								<table id="legende" style="width:25%">
									<tr>
										<td style="background: rgba(255, 255, 0, 0.41)!important;"><span><span></td>
										<td>Cong&eacute;</td>
									</tr>
									<tr>
										<td style="background:rgba(0, 0, 253, 0.36)!important"></td>
										<td>Permission</td>
									</tr>
									<tr>
										<td style="background: rgba(0, 251, 0, 0.54)!important;"></td>
										<td>Autorisation d'abscence</td>
									</tr>
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


{literal}
<style>
#legende td {border: 1px solid #E2E2E2;width:10%}
</style>
{/literal}