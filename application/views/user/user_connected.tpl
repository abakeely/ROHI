{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Listes des Agents conn&eacute;ct&eacute;s</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Agent MFB à valider</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
									<tr >
										<th style="width:10px"><font size="2"><font face="Times New Roman">Ordre</font></font></th>
										<th style="width:15px"><font size="2"><font face="Times New Roman">IM</font></font></th>
										<th><font size="2"><font face="Times New Roman">Nom</font></font></th>
										<th><font size="2"><font face="Times New Roman">Pr&eacute;noms</font></font></th>
										<th><font size="2"><font face="Times New Roman">D&eacute;partement</font></font></th>
										<th><font size="2"><font face="Times New Roman">Direction</font></font></th>
										<th><font size="2"><font face="Times New Roman">Service</font></font></th>
										<th><font size="2"><font face="Times New Roman">Localite de service</font></font></th>
										<th><font size="2"><font face="Times New Roman">IP</font></font></th>
									</tr>
									</thead>
									<tbody>
									{assign var=ordre value="0"}
									{foreach from=$oData.list_user item=oConnected} 
									{assign var=ordre value=$ordre+1}
									<tr>
										
										<td style="width:10px">{$ordre}</td>
										<td>{$oConnected.im}</td>
										<td>{$oConnected.nom}</td>
										<td>{$oConnected.prenom}</td>
										<td>{$oConnected.dep}</td>
										<td>{$oConnected.dir}</td>
										<td>{$oConnected.ser}</td>
										<td>{$oConnected.local_serv}</td>
										<td>{$oConnected.ip}</td>
												
									</tr>
									{/foreach} 
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
			<div id="calendar"></div>	
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}	
				

	{literal}
		<script>
			 $(document).ready(function() {
				$('#dataTables-example').dataTable();
			});
		</script>
	{/literal}