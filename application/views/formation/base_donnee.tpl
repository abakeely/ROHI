{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Base de données des agents formés</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}">Formation</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a></li>
									<li class="breadcrumb-item">Base de données des agents formés</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/select/css/bootstrap-select.min.css">
								<script type="text/javascript" language="javascript" src="{$zBasePath}assets/common/css/formation/select/js/bootstrap-select.min.js"></script>
										
								<!--*Debut Contenue*-->
								<div class="">
									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/css/bootstrap.min.css">
									<br>
									<div class="col-md-12">
										<center>
											<label for="lieu"></label>
											<input type="hidden" id="saveUrl" name="saveUrl" value="">
											{literal}
											<script type="text/javascript">
											
												function changerLocalite(lieu)
												{
													if(lieu != '')
													{	
												
														var tmpUrl =window.document.location.href;
														racine = tmpUrl.split('?');
														document.getElementById('saveUrl').value = racine[0];
														window.document.location = document.getElementById('saveUrl').value+'?lieu='+document.getElementById('lieu').value; 
														}
												}
											
												function changerAnnee(annee)
												{
																	
													if(annee != '')
													{	
														var tmpUrl =window.document.location.href;
														racine = tmpUrl.split('?');
																
														document.getElementById('saveUrl').value = racine[0];
													
														window.document.location =document.getElementById('saveUrl').value+'?lieu='+document.getElementById('lieu').value+'&annee='+document.getElementById('annee').value;
														
														}
													
												}
												
											</script>
											{/literal}
											<select class="selectpicker" data-style="btn field" onchange="changerLocalite(this.value)" id="lieu" name="lieu">
												<option value="">--- Choisissez la localité de Formation---</option>
												<option value="1" {if (isset($oData.local) && ($oData.local == '1'))}  selected {/if} >MADAGASCAR</option>
												<option value="0" {if (isset($oData.local) && ($oData.local == '0'))}  selected {/if}>ETRANGER</option>
											</select>
													
											<label for="lieu"></label>
											
											<select class="selectpicker" data-style="field" onchange="changerAnnee(this.value)" id="annee" name="annee">
												<option value="">--- Choisissez une année ---</option>
												{foreach from=$oData.agentformeAnnee  item=oAgentformeAnnee}
													<option value="{$oAgentformeAnnee.agentforme_date}" {if (isset($oData.annee) && ($oData.annee == $oAgentformeAnnee.agentforme_date))}  selected {/if}>{$oAgentformeAnnee.agentforme_date}</option>
												{/foreach}
											</select>
										</center>
										
										<h3 align="center" style=" border-bottom: none; important! font-size: 0.1em; font-weight: bold; font-family: Lato;" >
											LISTE DES AGENTS FORMES {if (isset($oData.local) && isset($oData.annee) && ($oData.local != '') && ($oData.annee != '') )} à {if $oData.local == '1'}MADAGASCAR{/if} {if $oData.local == '0'}L' ETRANGER{/if} en {$oData.annee} {/if} du MEF
										</h3>

										<table class="table table-striped table-bordered table-hover" id="table_planning" >
											<thead>
												<tr>						
													<th class="th_livre"><font size="3"><font face="Times New Roman">TYPE DE FORMATION</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">INTITUL&Eacute;</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">LIEU DE FORMATION</font></font></th>
													<!-- <th class="th_livre"><font size="3"><font face="Times New Roman"></font>INSTITUT PARTENAIRE</font></th> -->
													<!--th class="th_livre"><font size="3"><font face="Times New Roman">AGENT</font></font></th-->
													<!--th class="th_livre"><font size="3"><font face="Times New Roman">IM</font></font></th-->
													<th class="th_livre"><font size="3"><font face="Times New Roman">DEPARTEMENT</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">REGION</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">EFFECTIF</font></font></th>
													
												</tr>
											</thead>
											<tbody>	
												{foreach from=$oData.agentforme  item=oAgentformeMada}
													<tr>
														<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_type}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_intitule}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_lieu}</font></font></td>
														<!-- <td><font size="2"><font face="Times New Roman">---</font></font></td> -->
														<!--td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_nom}&nbsp; &nbsp;{$oAgentformeMada.agentforme_prenom}</font></font></td-->
														<!--td><font size="2"><font face="Times New Roman"></font>{$oAgentformeMada.agentforme_matricule}</font></td--->
														<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_departement}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_region}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oAgentformeMada.agentforme_effectif}</font></font></td>
														
													</tr>
												{/foreach}
											</tbody>								 
										</table>	
									</div>

									<div class="row"><br></div>
									<div class="row"><br></div>
											
								</div>
								<br><br><br><br>
								
								{literal}  
								<script>

									$(document).ready(function() {
									$('#table_planning').dataTable({
									"ordering" : false
									});	
									});	
								</script>	
								{/literal}

								<div id="calendar"></div>
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