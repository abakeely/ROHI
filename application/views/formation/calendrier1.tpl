{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Calendrier de formation</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}">Formation</a> </li>
									<li class="breadcrumb-item">Calendrier de formation</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<h3 align="center" style=" border-bottom: none; important! font-size: 0.1em; font-weight: bold; font-family: Lato;" >
										Offres disponibles avec prise en charge totale
									</h3>
									<p>&nbsp;</p>
									<table class="table table-striped table-bordered table-hover" id="table_planning" >
										<thead>
											<tr>						
												<th class="th_livre"><font size="3"><font face="Times New Roman">Date de formation</font></font></th>
												<th class="th_livre"><font size="3"><font face="Times New Roman">Public cible</font></font></th>
												<th class="th_livre"><font size="3"><font face="Times New Roman">A propos de la formation</font></font></th>
											</tr>
										</thead>
										<tbody>	
											{foreach from=$oData.calendrier  item=oCalendrier}
												<tr>
													<td><font size="2"><font face="Times New Roman">{$oCalendrier.calendrier_date}</font></font></td>
													<td><font size="2"><font face="Times New Roman">{$oCalendrier.calendrier_cible|nl2br}</font></font></td>
													<td><font size="2"><font face="Times New Roman">{$oCalendrier.calendrier_aPropos}</font></font></td>
												</tr>
											{/foreach}
										</tbody>								 
									</table>	
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
 
 
{literal}  
<style>
.dt-center {width:15%!important}
.dt-center1 {width:25%!important}
</style>
<script>

    $(document).ready(function() {
       $('#table_planning').dataTable({
	   "ordering" : false,
	   "paging":   true,
	   "columnDefs": [
			{ className: "dt-center", "targets": [ 0 ] },
			{ className: "dt-center1", "targets": [ 1 ] }
		 ],
	   
	   });	
	});	
</script>	
{/literal}
