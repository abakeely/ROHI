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
								<!--h3 class="page-title">Transactions</h3-->
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
											<form action="{$zBasePath}pointage/liste/pointage-electronique/transaction" method="POST" name="formulaireTransaction" id="formulaireTransaction" style="display:block!important" enctype="multipart/form-data">
												
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date d&eacute;but *</label>
																<input type="text" name="date_debut" autocomplete="off"  data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" id="date_debut" value="{$oData.zDateDebut}" onChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="form-control datedropper-range-fiche obligatoire">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date fin *</label>
																<input type="text" name="date_fin" autocomplete="off"  id="date_fin" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="form-control datedropper-range-fiche obligatoire">
															</div>
														</div>
													</div>
													{if $oData.iCompteActif == COMPTE_EVALUATEUR || $oData.iCompteActif == COMPTE_AUTORITE || $oData.iCompteActif == COMPTE_ADMIN}
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>&nbsp;</label>
																<select style="width:150px!important" class="form-control" name="type" onchange="changeMask()" id="type">
																	<option value="im">MATRICULE</option>
																	<option {if $oData.iLongMatriculeOrCin>6} selected="selected" {/if} value="cin">CIN</option>
																</select>

																<p class="message debut" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Matricule ou CIN</label>
																<input type="text"  name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="matricule ou CIN">
															</div>
														</div>
													</div>
													{/if}
													<div class="row1" style="padding-top: 45px;">
														<div class="cell">
															<div class="field" style="text-align:center">
																<input type="button" class="button" onClick="validerPointage();" name="" id="" value="Voir transaction">
															</div>
														</div>
													</div>
												
											</form>
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
									<table>
										<thead>
											<tr>
												<th>Jour</th>  
												<th>Date</th>
												<th>Heure</th>
												<th>Terminal</th>
												<th>Statut</th> 
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toGetAllTransaction)>0}
											{foreach from=$oData.toGetAllTransaction item=oListeTransaction }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListeTransaction.time|date_format:"%A"|ucfirst}</td>
												<td>{$oListeTransaction.time|date_format:"%d/%m/%Y"}</td>
												<td>{$oListeTransaction.time|date_format:"%H:%M:%S"}</td>
												<td>{$oListeTransaction.event_point_name}</td>
												<td>{$oListeTransaction.statut}</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											{if $oData.zMessage == ''}
											<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
											{else}
											<tr><td style="text-align:center;color:red" colspan="7"><strong>{$oData.zMessage}</strong></td></tr>
											{/if}
											{/if}
										</tbody>
									</table>
									{$oData.zPagination}
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