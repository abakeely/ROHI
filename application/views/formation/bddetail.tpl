{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									Base de données des agents formés{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									&agrave; finaliser
									{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
									&agrave; imprimer
									{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Formation</li>
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
								<div class="">
									<div align="center" border="0">
										<a href="#" class="overlay" id="tabl{$i}"></a>
										<div class="tabl">
											<a class="close" href="#">&times;</a>
											<div class="row">
												<table class="table table-striped table-bordered table-hover" id="table_planning" >
													<thead>
															<tr>						
																<th class="th_livre"><font size="3"><font face="Times New Roman">INSTITUT PARTENAIRE</font></font></th>
																<th class="th_livre"><font size="3"><font face="Times New Roman">NOM</font></font></th>
																<th class="th_livre"><font size="3"><font face="Times New Roman">DEPARTEMENT</font></font></th>
																<th class="th_livre"><font size="3"><font face="Times New Roman">INTITUL&Eacute;</font></font></th>
															</tr>
													</thead>	
														
														{foreach from=$oData.agentforme_mada  item=oAgentforme}
															<tr>
															<!--		 <td style="width:20px"><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_id?></font></font></td>
																<td style="width:20px"><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_date?></font></font></td>   -->
																<td><font size="2"><font face="Times New Roman">{$oAgentforme->agentforme_lieu}</font></font></td>
																<td><font size="2"><font face="Times New Roman">{$oAgentforme->agentforme_nomprenom}{$oAgentforme->agentforme_prenom}</font></font></td>
																<td><font size="2"><font face="Times New Roman">{$oAgentforme->agentforme_fonction}</font></font></td>
																<td><font size="2"><font face="Times New Roman">{$oAgentforme->agentforme_intitule}</font></font></td>
															</tr>
														{/foreach}
														
												</table>	
											</div>                       
										</div>     		
									</div>

									{literal}  
									<script>
										$(document).ready(function() {
											$('#table_planning').dataTable({
											"ordering" : false
											});	
										});	
									</script>	
									{/literal}

								</div>
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