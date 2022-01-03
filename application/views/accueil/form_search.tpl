{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">RECHERCHE AGENT</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Recherche agent</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
										<!---->
										<div class="SSttlPage">
											<div id="searchAcc">
													<div class="card punch-status">
													<div class="card-body">
													<h5 class="card-title">FORMULAIRE RECHERCHE</h5>
												   <form action="{$zBasePath}accueil/verification" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block;">
														
															<div class="row1">
																<div class="cell">
																	<div class="field">
																		<label>Fichier Excel</label>
																		<input type="file" name="fichierExcel" style="width:300px!important" id="fichierExcel"  required />
																	</div>
																</div>
															</div>
															<div class="cell">
																<div class="field">
																	<button>Analyser</button>
																</div>
															</div>
														
													</form>
													</div>
												</div>
												
											</div>
										</div>
										<!---->
									</div>

									<table id="dataTables-example">
									<thead>
										<tr>
											<th>Num&eacute;ro</th>
											<th>Matricule ou CIN</th>
											<th>Nom</th>
											<th>P&eacute;Nom</th>
											<th>Discipline</th>
											<th>Entit&eacute;</th>
											<th>Photo</th>
										</tr>
									</thead>
									<tbody>
										{assign var=iIncrement value="0"}
										{if sizeof($oData.toArrayAffiche)>0}
										{foreach from=$oData.toArrayAffiche item=oListe }
										<tr {if $oListe.color!=""}style="background-color:{$oListe.color}"{/if} {if $iIncrement%2 == 0} class="even" {/if}>
											<td>{$oListe.numero}</td>
											<td>{$oListe.matricule}</td>
											<td>
											{$oListe.nom|upper}
											{if $oListe.parentheseNom!=''}
											<br><br><span style="color:green"><strong>( {$oListe.parentheseNom} )</strong></span>
											{/if}
											</td>
											<td>{$oListe.prenom}
											{if $oListe.parenthesePrenom!=''}
											<br><br><span style="color:green"><strong>( {$oListe.parenthesePrenom} )</strong></span>
											{/if}
											</td>
											<td>{$oListe.discipline}</td>
											<td>{$oListe.entite}</td>
											<td><img src="{$oListe.photo}" width="100"></td>
										</tr>
										{assign var=iIncrement value=$iIncrement+1}
										{/foreach}
										{else}
										<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
										{/if}
									</tbody>
								</table>
							
							</div>
					</div>
				</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<script type="text/javascript">
{if sizeof($oData.toArrayAffiche)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
</script>
{include_php file=$zFooter}
		