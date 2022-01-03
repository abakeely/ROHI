{include_php file=$zCssJs}
<!-- Main Wrapper -->
	<div class="main-wrapper">
		{include_php file=$zHeader}

				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Planning de Restitution</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
								<li class="breadcrumb-item">Planning de Restitution</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
						<div class="card-body">	
							{assign var=id value=""}
							{assign var=date_restitution value=""}
							{assign var=heure_restitution value=""}
							{assign var=lieu_restitution1 value=""}
							{assign var=nom_prenom_restitution value=""}

							{assign var=fonction_restitution value=""}
							{assign var=intitule_restitution value=""}
							{assign var=lieu_restitution2 value=""}
							{assign var=periode_restitution value=""}
							{assign var=lien_restitution value=""}
							{assign var=lien value=""}
								
							<br>
							<div align="right">
								<a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution" class="btn">Retour</a>
							</div>
							<br><br>
							<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
								<div align="center">PLANNING DE RESTITUTION</div>
							</h3>

							<div style="width: 100%; height: 350px; overflow-y: scroll;">	
								<div class="row">
									<form class="form-horizontal" role="form" name="documentation" id="documentation" action="{$zBasePath}documentation/pret_livre/sad/pret-livre" method="POST"></form>
								</div>
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th style="display:none">N°</th>
											<th >Date restitution</th>
											<th>Heure</th>
											<th>Lieu de la restitution</th>
											<th>Nom et pr&eacute;noms</th>
											<th>Fonction</th>
											<th>Intitul&eacute; de la formation</th>
											<th>Lieu de la formation</th>
											<th>P&eacute;riode</th>
											<th>PDF</th>
											<th>SLIDE</th>
										</tr>
									</thead>
									<tbody>	
										{assign var=iIncrement value="1"}
										{foreach from=$oData.liste item=planning}
											<tr>
												{$ echo $planning->id}
												<td>{$planning->date_restitution}</td>
												<td>{$planning->heure_restitution}</td>
												<td>{$planning->lieu_restitution1}</td>
												<td>{$planning->nom_prenom_restitution}</td>
												
												<td>{$planning->fonction_restitution}</td>
												<td>{$planning->intitule_restitution}</td>
												<td>{$planning->lieu_restitution2}</td>
												<td>{$planning->periode_restitution}</td>
												
												<td> <a href="{zBasePath}assets/pdf_sad/restitution/{$planning->lien_restitution}" target="_blank"><img src="{$zBasePath}assets/img/img_sad/pdf.png" title="version pdf" border="0" height="60" width="50"></a></td>
												<td> <a href="{zBasePath}assets/pdf_sad/slide/{$planning->lien}" target="_blank"><img src="{$zBasePath}assets/img/img_sad/powerpoint.png" title="Slide"border="0" height="58" width="50"></a></td>
											</tr>
										{assign var=iIncrement value=$iIncrement+1}	
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
<script>
	(function($) {
	$(function() {
		$("#scroller").simplyScroll({direction:'backwards'});
	});
	})(jQuery);


    $(document).ready(function() {
       $('#table_planning').dataTable({
	   "ordering" : false
	   });	
	});	
</script>
{/literal}