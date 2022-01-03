{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Rang</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Pointage électronique </a></li>
									<li class="breadcrumb-item">Rang</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
					<div class="col-sm-12">
					<div class="card mb-0">
								<div class="card-body">
					
									<div id="searchAcc">
										<div class="card punch-status">
											<!--h5>Choisir un intervalle de dates</h5-->
											<form action="{$zBasePath}pointage/liste/pointage-electronique/rang" method="POST" style="display:block" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
												<fieldset>
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>Date d&eacute;but *</label>
																	<input type="text" name="date_debut" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" style="width:189px!important" id="date_debut" autocomplete="off"  value="{$oData.zDateDebut}" class="form-control datedropper-range-fiche obligatoire" sonChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="withDatePicker1 obligatoire">
																</div>
															</div>
														</div>
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>Date fin *</label>
																	<input type="text" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}" name="date_fin" style="width:189px!important" id="date_fin" class="form-control datedropper-range-fiche obligatoire"  autocomplete="off" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="obligatoire">
																</div>
															</div>
														</div>
														{if $oData.iCompteActif != COMPTE_AGENT}
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
																	<input type="text" style="width:189px!important" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="matricule ou CIN">
																</div>
															</div>
														</div>
														{/if}
														<div class="col-sm-2" style="padding-top: 45px;">
															<div class="cell">
																<div class="field" style="text-align:center">
																	<input type="button" class="button" onClick="validerTransaction();" name="" id="" value="Voir votre rang">
																</div>
															</div>
														</div>
													</fieldset>
											</form>
										</div>
									
								
									<div class="card punch-status">
									{if sizeof($oData.toGetAllRang)>0}
										{if $oData.iCompteActif != COMPTE_AGENT && $oData.iMatricule != '' && sizeof($oData.oUserMatricule)>0}
											<h5>le rang de {$oData.oUserMatricule[0]->nom}&nbsp;{$oData.oUserMatricule[0]->prenom} du {$oData.zDateDebut} au {$oData.zDateFin}</h5>
										{else}
											<h5>Votre rang du {$oData.zDateDebut} &agrave; {$oData.zDateFin}</h5>
										{/if}
									{/if}
									<div class="col-sm-12">
									
							

									  <div class="table-responsive">
											<table id="table-liste-extrants" class="table bordered">
										<thead>
											<tr>
												<th>Date d&eacute;but</th>
												<th>Date fin</th>
												<th>Nombre de Jour</th>
												<th>Nombre d'heure</th>
												<th>Moyenne</th>
												<th>Rang</th>
											</tr>
										</thead>
										<tbody>
											{if $oData.rang}
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oData.zDateDebut}</td>
												<td>{$oData.zDateFin}</td>
												<td>{$oData.rang.nb_jour} Jours</td>
												<td>{$oData.rang.total_heure_effectue} Heures</td>
												<td>{($oData.rang.total_heure_effectue/$oData.rang.nb_jour)} Heures/Jour</td>
												<td align="center">{$oData.rang.rang}</td>
											</tr>
											{else}
											<tr><td>Aucun enregistrement correspondant</td></tr>
											{/if}
										</tbody>
									</table>
							
	</div>
					
				
    		
			<!-- /Page Content -->
			<div id="calendar"></div>		
        </div>
		<!-- /Page Wrapper -->

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