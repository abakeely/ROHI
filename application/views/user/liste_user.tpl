{include_php file=$zCssJs}
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
										<th style="width:10px"><font size="4"><font face="Times New Roman">Ordre</font></font></th>
										<th ><font size="4"><font face="Times New Roman">Nom et Pr&eacute;noms</font></font></th>
										<th><font size="4"><font face="Times New Roman">IM</font></font></th>
										<th><font size="4"><font face="Times New Roman">Login</font></font></th>
										<th><font size="4"><font face="Times New Roman">Password</font></font></th>
										<th><font size="4"><font face="Times New Roman">CIN</font></font></th>
										<th><font size="4"><font face="Times New Roman">Sexe</font></font></th> 
									</tr>
									</thead>
									<tbody>
									{assign var=ordre value="0"}
									{foreach from=$oData.list_user item=toUser} 
									{assign var=ordre value=$ordre+1}
									{if $toUser.sexe == 1}
										{assign var=sexe value="Masculin"}
									{else}
										{assign var=sexe value="Feminin"}
									{/if}
									<tr>
										
										<td style="width:10px">{$ordre}</td>
										<td>{$toUser.nom} {$toUser.prenom}</td>
										<td>{$toUser.im}</td>
										<td>{$toUser.login}</td>
										<td>{$toUser.password}</td>
										<td>{$toUser.cin}</td>
										<td>{$sexe}</td>
												
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