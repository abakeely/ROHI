{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Mouvement</h3>
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
											<th style="width:10px">Ordre</th>
											<th>Agent</th>
											<th>Respers</th>
											<th>Ancien D&eacute;pt/Dir/Sce</th>
											<th>Nouveau D&eacute;pt/Dir/Sce</th>
											<th>Situation</th>
											<th>Date</th>
										  </tr>
										</thead>
										<tbody>
										{assign var=ordre value="0"}
										{foreach from=$oData.list_mvt item=oMvt} 
										{assign var=ordre value=$ordre+1}
										 <tr>
											
											<td style="width:10px">{$ordre}</td>
											<td>{$oMvt.candidat_nom}</td>
											<td>{$oMvt.resp_nom}</td>
											<td>{$oMvt.old_dep_str}</td>
											<td>{$oMvt.new_dep_str}</td>
											<td>{$oMvt.type}</td>
											<td>{$oMvt.date}</td>
													 
										 </tr>
										 {/foreach} 
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
{literal}
	<script>
		 $(document).ready(function() {
			$('#dataTables-example').dataTable();
		});
	</script>
{/literal}
{include_php file=$zFooter}
		