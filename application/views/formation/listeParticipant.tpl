{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Participant formation</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Formation</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a></li>
									<li class="breadcrumb-item">Liste des participants à la formation</li>
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
								
								<div class="">
									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/css/bootstrap.min.css">
									<br>
									<div class="">
										<center>
										</center>
										<h3 align="center" style=" border-bottom: none; important! font-size: 0.1em; font-weight: bold; font-family: Lato;" >
											LISTE DES PARTICIPANTS A LA FORMATION
										</h3>
										<table class="table table-striped table-bordered table-hover" id="table_planning" >
											<thead>
												<tr>						
													<th class="th_livre"><font size="3"><font face="Times New Roman">DEPARTEMENT</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">DIRECTION</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">SERVICE</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">AGENT</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">IM</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">POSTE</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">REGION</font></font></th>
													<th class="th_livre"><font size="3"><font face="Times New Roman">NOTE EVALUATION</font></font></th>
												</tr>

											</thead>
											<tbody>	
												{foreach from=$oData.oListeParticipant  item=oListeParticipant}
													<tr>
														<td><font size="2"><font face="Times New Roman">{$oListeParticipant.formation_departement}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oListeParticipant.formation_region}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oListeParticipant.formation_service}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oListeParticipant.nom}&nbsp;{$oListeParticipant.prenom}</font></font></td>
														<td><font size="2"><font face="Times New Roman"></font>{$oListeParticipant.matricule}</font></td>
														<td><font size="2"><font face="Times New Roman">{$oListeParticipant.formation_poste}</font></font></td>
														<td><font size="2"><font face="Times New Roman">{$oListeParticipant.formation_regionNom}</font></font></td>
														<td style="text-align:center"><font size="2"><font face="Times New Roman"><a href="#" class="dialog-view-note" iDebut="{$oListeParticipant.formation_debut}" iFin="{$oListeParticipant.formation_fin}" iUserId='{$oListeParticipant.formation_userId}' title="Voir les notes" alt="Voir les notes"><i style="font-size:22px;" class="la la-file-text"></i></a></font></font></td>
													</tr>
												{/foreach}
											</tbody>								 
										</table>
									</div>

									<div class="row"><br></div>
									<div class="row"><br></div>
											
								</div>
								<br><br><br><br>
								<div id="dialogCV" title="Dialog Title"></div> 
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
select.input-sm {
    height: 30px;
    line-height: 20px;
}

a:Hover {
	text-decoration:none!important;
	color:inherit!important;
}
</style>
<script>

    $(document).ready(function() {

		$("#dialogCV").dialog({
			autoOpen: false,
			width: '80%',
			title: 'Notes évaluations',
			close: 'X',
			dialogClass: 'myPosition',
			open: function(event, ui) {
				$(event.target).parent().css('position', 'fixed');
				$(event.target).parent().css('top', '100px');
				$(event.target).parent().css('left', '10%');
			},
			modal: true,
			resizable: false,
			buttons: [{
						text: "Fermer",
						click: function() {
							$(this).dialog("close")
						}
					}]
		});

		$("#table_planning").on("click", ".dialog-view-note", function(){
			$('#dialogCV').dialog('option', 'title', "Notes évaluations");
			iUserId = $(this).attr("iUserId"); 
			iDebut = $(this).attr("iDebut");
			iFin = $(this).attr("iFin");
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}critere/liste/agent-evaluation/notes",
				type: 'post',
				data: {
					iUserId:iUserId,
					iDebut:iDebut,
					iFin:iFin
				},
				success: function(data, textStatus, jqXHR) {
					$("#dialogCV").html(data);
					$("#dialogCV").dialog("open");
					event.preventDefault()
				},
				async: false
			})
		});

        $('#table_planning').dataTable({
	     "ordering" : false
	    });	
	});	


</script>	
{/literal}