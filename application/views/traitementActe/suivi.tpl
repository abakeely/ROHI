{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
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
									<li class="breadcrumb-item">Suivi des actes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<input type="hidden" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
								<input type="hidden" name="iCin" autocomplete="off" id="iCin" value="{$oData.iMatricule}" placeholder="">
							
								<div class="contenuePage" style="overflow: hidden;">
									<div id="saisieActe">
										<div class="panel-body">
											<h3>Suivi des projets d'acte</h3>
										</div>
										<div class="row">
										</div>
									</div>
									<!--*Debut Contenue*-->
									<div class="col-xs-12">
										<table id="table-liste-extrants">
											<thead>
												<tr>
													<th>Identifiant</th>
													<th>Designation</th>
													<th>Ticket Code</th>
													<th>Ticket Libelle</th>
													<th>Date creation</th>
													<th>Mouvement Code</th>
													<th>Matricule</th>
													<th>Sigle</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>	
												{assign var=iIncrement value="0"}
												{foreach from=$oData.toListe item=oListe }
												<tr {if $iIncrement%2 == 0} class="even" {/if}>
													<td>{$oListe.ticket_id}</td>
													<td>{$oListe.ticket_designation}</td>
													<td>{$oListe.ticket_code}</td>
													<td>{$oListe.ticket_libelle}</td>
													<td>{$oListe.ticket_date_creation}</td>
													<td>{$oListe.ticket_processus_code}</td>
													<td>{$oListe.ticket_poste_agent_numero}</td>
													<td>{$oListe.ticket_sigle}</td>
													<td>{$oListe.action}</td>
												</tr>
												{assign var=iIncrement value=$iIncrement+1}
												{/foreach}
											</tbody>
										</table>
									</div>              
								</div>
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
	
	<script>
		/*var dataPlan = {$oData.jsonData};*/
	</script>

{literal}

<script>

function sendSearch(){
	$("#formulaireSearch").submit();
}
$('#table-liste-extrants').DataTable( {
	"order": [[ 0, "desc" ]],
	"pageLength": 5
}); 

function rechercherTicket(){
	extrants.ajax.reload();
}

</script>
{/literal}