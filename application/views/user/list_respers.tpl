{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste responsable personnel</h3>
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
										<th>Statut</th>
										<th>IM</th>
										<th>Nom et Pr&eacute;noms</th>
										<th>Departement</th>
										<th>Direction</th>
										<th>Service</th>
										<th>R&eacute;gion</th>
										<th>Supprimer</th>
									</tr>
									</thead>
									<tbody>
									{assign var=ordre value="0"}
									{foreach from=$oData.list_candidat item=toCandidat} 
									{assign var=ordre value=$ordre+1}
									<tr>
										<input type="hidden" id="user_id_{$toCandidat->id}" value="{$toCandidat->user_id}"/>
										<input type="hidden" id="nom_{$toCandidat->id}" value="{$toCandidat->nom}"/>
										<input type="hidden" id="prenom_{$toCandidat->id}" value="{$toCandidat->prenom}"/>
										<td style="width:10px">{$ordre}</td>
										<td>{$toCandidat->statut}</td>
										<td>{$toCandidat->matricule}</td>
										<td>{$toCandidat->nom} {$toCandidat->prenom}</td>
										<td>{if $toCandidat->departement!='999999' || $toCandidat->departement!='9999' || $toCandidat->departement!='0'}{$toCandidat->departement}{/if}</td>
										<td>{if $toCandidat->direction!='999999' || $toCandidat->direction!='9999' || $toCandidat->direction!='0'}{$toCandidat->direction}{/if}</td>
										<td>{if $toCandidat->service!='999999' || $toCandidat->service!='9999' || $toCandidat->service!='0'}{$toCandidat->service}{/if}</td>
										<td>{if $toCandidat->region.libele}{$toCandidat->region.libele}{/if}</td>
										<td><a href="#" onclick="deleteRespers({$toCandidat->id})"><i class="la la-remove"></i></a></td>
												
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

	{if $oData.msg}
		{literal}
			<script>bootbox.alert('{/literal}{$oData.msg}{literal}');</script>
		{/literal}
	{/if}
	{literal}
		<script>
			 $(document).ready(function() {
				$('#dataTables-example').dataTable();
			});
			function deleteRespers(id){
				var nom = $("#nom_"+id).val();
				var prenom = $("#prenom_"+id).val();
				var user_id = $("#user_id_"+id).val();
				var html = '';
				html += '<div class="row">';
				html += ' <div class="col-md-1"></div>';
				html += ' <div class="col-md-10" style="font-size:17px">Voulez-vous supprimer : <br> '+nom+ '  '+ prenom  +' <br> de la liste du responsable personnel</div>';
				html += ' <div class="col-md-1"></div>';
				html += '</div>';
				
				bootbox.dialog({
					title: "",
					message: html,
					show: true,
					className: 'box_contrat',
					buttons: {
						success: {
							label: "OK",
							className: "btn-default",
							callback: function () {
								window.location = '{/literal}{$zBasePath}{literal}user/delete_respers/'+user_id; 
								return true;
							}
						},
						danger: {
							label: "Annuler",
							className: "btn-default",
							callback: function() {
								return true;
							}
						}
					}							
				});
			}
		</script>
	{/literal}