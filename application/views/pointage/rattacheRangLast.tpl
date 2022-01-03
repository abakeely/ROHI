{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Transactions</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Transaction</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
										<div class="card punch-status">
										<h5>RECHERCHE</h5>
										<form action="{$zBasePath}pointage/liste/pointage-electronique/rang" method="POST" style="display:block" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
											<fieldset>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date d&eacute;but *</label>
																<input type="text" name="date_debut" autocomplete="off" style="width:189px!important" id="date_debut" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" class="form-control datedropper-range-fiche obligatoire" value="{$oData.zDateDebut}" onChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date fin *</label>
																<input type="text" name="date_fin" autocomplete="off" style="width:189px!important" id="date_fin" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="form-control datedropper-range-fiche obligatoire">
															</div>
														</div>
													</div>
													{if $oData.iCompteActif == COMPTE_ADMIN}
													<div class="row1 clearfix">
														<div class="cell small">
															<div class="field"> 
																<label>Departement</label>
																<select style="height:37px;" id="iDepartementId" name="iDepartementId" class="obligatoire" onChange="getOrganisation('{$zBasePath}',1,this.value);">
																	<option value="">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
																	{foreach from=$oData.oDepartement item=oDepartement }
																	<option {if $oDepartement.id == $oData.oDataSearch.iDepartementId} selected="selected" {/if} value="{$oDepartement.id}">&nbsp;{$oDepartement.libele}</option>
																	{/foreach}
																</select>
															</div>
														</div>
													</div>
													<br>
													{/if}
													<div class="row1">
														<div class="cell">
															<div class="field">
																<input type="button" class="button" onClick="validerRang(1);" name="" id="" value="Voir rang">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<input type="button" class="button" onClick="validerRang(2);" name="" id="" value="Rapport en PDF">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<input type="button" class="button" onClick="validerRang(3);" name="" id="" value="Rapport en Excel">
															</div>
														</div>
													</div>
												</fieldset>
										</form>
									</div>
								</div>
								<br/><br/>
								{if $oData.iMatricule != ''}
									{if $oData.zMessage == ''}
									{if sizeof($oData.toGetAllTransaction)>0 && $oData.zDateDebut != "" && $oData.zDateFin != ""}
										{if $oData.iCompteActif != COMPTE_AGENT && $oData.iMatricule != '' && sizeof($oData.oUserMatricule)>0}
											<h5>Liste des transactions de {$oData.oUserMatricule[0]->nom}&nbsp;{$oData.oUserMatricule[0]->prenom} du {$oData.zDateDebut} au {$oData.zDateFin}</h5>
										{else}
											<h5>Liste de transactions du {$oData.zDateDebut} au {$oData.zDateFin}</h5>
										{/if}
									{else}
										<h5>Liste des transactions de {$oData.oUserMatricule[0]->nom}&nbsp;{$oData.oUserMatricule[0]->prenom} du {$oData.zDateDebut} au {$oData.zDateFin}</h5>
									{/if}
									{else}
									{/if}
								{/if}
		
								<div class="">
									<table class="table table-striped table-bordered table-hover" id="dataTables1-example">
										<thead>
											<tr>
												<th>RANG</th>
												<th>Matricule</th>
												<th>Nom</th>
												<th>Pr&eacute;nom</th>
												<th>Nombre de Jour</th>
												<th>HEURES REGLEMENTAIRES</th>
												<th>HEURES SUPPLEMENTAIRE</th>
												<th style="width:10%">Nb heures totales travaill&eacute;es</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toGetAllRang)>0}
											{foreach from=$oData.toGetAllRang item=oListeRattache }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeRattache->rang}</td>
												<td>{$oListeRattache->data["matricule"]}</td>
												<td>{$oListeRattache->data["nom"]|upper}</td>
												<td>{$oListeRattache->data["prenom"]}</td>
												<td>{$oListeRattache->iDiffDate}</td>
												<td>{$oListeRattache->value}</td>
												<td>{$oListeRattache->Tot}</td>
												<td>{$oListeRattache->iTotTravailler}</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="11">Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>		
        </div>
		<!-- /Page Wrapper -->
		<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}pointage/liste/pointage-electronique/transaction">
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}



{literal}
<style>
.separateur.separateur1, h3 {
    border-bottom: none!important;
}
</style>
<script type="text/javascript">
		{/literal}
		{if $oData.iLongMatriculeOrCin>6}
		{literal}
   		$("#iMatricule").mask("999 999 999 999");
		{/literal}
		{else}
		{literal}
		$("#iMatricule").mask("999999"); 
		{/literal}
		{/if}
		{literal}

   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#iMatricule").mask("999 999 999 999");
   			else
   				$("#iMatricule").mask("999999");   
   	   	}
</script>
{/literal}