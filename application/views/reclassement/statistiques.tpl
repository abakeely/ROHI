{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Statistiques</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Les statistiques</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="col-xs-12">
							<div class="card-body">	
								<div class="SSttlPage">
									<div class="cell">
										<div class="field">
											<div class="clearfix">
												<form>
													<fieldset>
													<div class="cell">
														<div class="field"> 
																<label style="display:inline;">Année d'archive : </label>
																<select name="iAnneeReclassement" id="iAnneeReclassement" style="width:30%" class="obligatoire" onchange="getListeReclassement(this.value)">
																	{assign var=iBoucle value=$oData.iAnnee+1}
																	{section name=iAnnee start=2015 loop=$iBoucle+1 step=1}
																		<option  value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
																	{/section}
																</select>
														</div>
													</div>
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12">
										
										<div class="row">
											<div class="col-sm-12">
												<div id="chartDepartement" style="height: 300px; width: 100%;"></div>
											</div>
										</div>
										<div style="clear:both"><br/><br/></div>
										<div class="row">
											<div class="col-sm-12">
												<div id="chartDirection" style="height: 300px; width: 100%;"></div>
											</div>
										</div>
										<div style="clear:both"><br/><br/></div>
										<div class="row">
											<div class="col-sm-12">
												<div id="chartService" style="height: 300px; width: 100%;"></div>
											</div><!-- /.col -->
										</div>
										{* 
										<table id="statListe">
											<tr>
												<td style="width:50%">
													<h3>Nombre Reclassement par Année</h3>
													<table >
														<thead>
															<tr>
																<th>Année</th>
																<th>Nombre</th>
															</tr>
														</thead>
														<tbody>
														{assign var=iIncrement value="0"}
														{foreach from=$oData.toStatParAnnee item=toStatParAnnee }
															<tr {if $iIncrement%2 == 0} class="even" {/if}>
																<td>{$toStatParAnnee.reclassement_session}</td>
																<td>{$toStatParAnnee.iNombre}</td>
															</tr>
														{assign var=iIncrement value=$iIncrement+1}
														{/foreach}
														</tbody>
													</table>
												</td>
												<td style="width:50%">
													<div class="row">
														<div class="col-sm-12">
															<div id="chartDepartement" style="height: 300px; width: 100%;">
														</div>
													</div>
												</td>
											</tr>

											<tr>
												<td style="width:50%">
													<h3>Nombre Reclassement par direction de l'année {$oData.iAnnee}</h3>
													<table >
														<thead>
															<tr>
																<th>Direction</th>
																<th>Nombre</th>
															</tr>
														</thead>
														<tbody>
														{assign var=iIncrement value="0"}
														{foreach from=$oData.toStatParDirectionAnnee item=toStatParDirectionAnnee }
															<tr {if $iIncrement%2 == 0} class="even" {/if}>
																<td>{$toStatParDirectionAnnee.libele}</td>
																<td>{$toStatParDirectionAnnee.iNombre}</td>
															</tr>
														{assign var=iIncrement value=$iIncrement+1}
														{/foreach}
														</tbody>
													</table>
												</td>
												<td style="width:50%">
													<h3>Nombre Reclassement par service par année {$oData.iAnnee}</h3>
													<table >
														<thead>
															<tr>
																<th>Service</th>
																<th>Nombre</th>
															</tr>
														</thead>
														<tbody>
														{assign var=iIncrement value="0"}
														{foreach from=$oData.toStatParServiceAnnee item=toStatParServiceAnnee }
															<tr {if $iIncrement%2 == 0} class="even" {/if}>
																<td>{$toStatParServiceAnnee.libele}</td>
																<td>{$toStatParServiceAnnee.iNombre}</td>
															</tr>
														{assign var=iIncrement value=$iIncrement+1}
														{/foreach}
														</tbody>
													</table>
												</td>
											</tr>
										</table>
										*}
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
		<script src="{$zBasePath}assets/sau/js/canvasjs.min.js"></script>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<style>
#statListe {font-size:0.9em;}
</style>

<script type="text/javascript">
		
		window.onload = function () {
			var chartDepartement = new CanvasJS.Chart("chartDepartement",
				{
				  title:{
					text: "Reclassement par département pour l'année {/literal}{$oData.iAnnee}{literal}"
				  },
				  data: [{
					type: "column",
					dataPoints: [
						{/literal}
						{if sizeof($oData.toStatParDepartementAnnee)>0}
						{foreach from=$oData.toStatParDepartementAnnee item=oListe }
						{literal}
						{ y: {/literal}{$oListe.iNombre}{literal}, label: "{/literal}{$oListe.sigle_departement}{literal}" },
						{/literal}
						{/foreach}
						{/if}
						{literal}
						
					]
				}]
			});

			var chartDirection = new CanvasJS.Chart("chartDirection",
				{
				  title:{
					text: "Reclassement par direction pour l'année {/literal}{$oData.iAnnee}{literal}"
				  },
				  data: [{
					type: "column",
					dataPoints: [
						{/literal}
						{if sizeof($oData.toStatParDirectionAnnee)>0}
						{foreach from=$oData.toStatParDirectionAnnee item=oListe }
						{literal}
						{ y: {/literal}{$oListe.iNombre}{literal}, label: "{/literal}{$oListe.sigle_direction}{literal}" },
						{/literal}
						{/foreach}
						{/if}
						{literal}
						
					]
				}]
			});

			var chartService = new CanvasJS.Chart("chartService",
				{
				  title:{
					text: "Reclassement par service pour l'année {/literal}{$oData.iAnnee}{literal}"
				  },
				  data: [{
					type: "column",
					dataPoints: [
						{/literal}
						{if sizeof($oData.toStatParServiceAnnee)>0}
						{foreach from=$oData.toStatParServiceAnnee item=oListe }
						{literal}
						{ y: {/literal}{$oListe.iNombre}{literal}, label: "{/literal}{$oListe.sigle_service}{literal}" },
						{/literal}
						{/foreach}
						{/if}
						{literal}
						
					]
				}]
			});

			chartDepartement.render();
			chartDirection.render();
			chartService.render();
		}
</script>
{/literal}