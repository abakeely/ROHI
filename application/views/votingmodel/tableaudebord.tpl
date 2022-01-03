{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
			<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/galop/css/jquery.galpop.css">
			<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/galop/css/vote.css">
			<script type="text/javascript" src="{$zBasePath}assets/galop/js/popper.min.js"></script>
			<script src="{$zBasePath}assets/galop/js/bootstrap.min.js"></script>
			<link href="{$zBasePath}assets/galop/css/font-awesome.min.css" rel="stylesheet" />
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Fiche > Titre de paiement</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">vote</a></li>
								<li class="breadcrumb-item">Fiche > Tableau de Bord</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
							<input type="hidden" name="iUserId" id="iUserId" value="{$oData.iUserId}">
									<div class="SSttlPage">
													<div id="searchAcc">
														<div class="card punch-status">
															<h2>Tableau de bord</h2>
															<form action="#" method="POST" name="formulaireTransaction" id="formulaireTransaction" style="display:block!important" enctype="multipart/form-data">
																<fieldset>
																	
																	<div class="row1">
																		<div class="cell">
																			<div class="field">
																				<label>Département</label>
																				<select name="zDepartement" id="zDepartement" style="width:100px;">
																					<option value="">&nbsp;Tous</option>
																					{foreach from=$oData.toDepartement item=oDepartement}
																						<option {if $oData.zDepartement==$oDepartement.structure_dept} selected="selected"{/if} value="{$oDepartement.structure_dept}">&nbsp;{$oDepartement.structure_dept}</option>
																					{/foreach}
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="row1">
																		<div class="cell">
																			<div class="field">
																				<label>Localité</label>
																				<select name="zLocalite" id="zLocalite">
																					<option {if $oData.zLocalite=='CENTRAL'} selected="selected"{/if} value="CENTRAL">&nbsp;CENTRAL</option>
																					<option {if $oData.zLocalite=='REGIONAL'} selected="selected"{/if}  value="REGIONAL">&nbsp;REGIONAL</option>
																				</select>
																			</div>
																		</div>
																	</div>

																	<div class="row1">
																		<div class="cell">
																			<div class="field">
																				<label>Matricule</label>
																				<input type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}">
																			</div>
																		</div>
																	</div>
																	
																	<div class="row1">
																		<div class="cell">
																			<div class="field">
																				 <label>&nbsp;</label>
																				 <input class="form-control" type="submit" class="button"  name="" id="" value="Afficher">
																			</div>
																		</div>
																	</div>
																	
																</fieldset>
															</form>
														</div>
													   </div>
												</div>
											
												<div class="contenuePage">
														<ul class="tabs">
															<li class="tab-link current" imodeid="1" data-tab="tab-1" id="liTab-1">
																Listing
															</li>
															<li class="tab-link" imodeid="2" data-tab="tab-2" id="liTab-2">
																Récapitulation
															</li>
														</ul>
														<div id="tab-1" class="tab-content current">
															<fieldset>
															 <table class="table table-striped table-bordered table-hover" id="dataTables-example-99">
																<tr class="notAffiche">
																	<td>
																		
																		<table>
																			<tr>
																				<td style="width:70%!important;vertical-align:top">
																						<div id="snippetContent">
																						<div class="container profile-page">
																						<div class="row">
																						{foreach from=$oData.toLaureat item=toListe }
																							<div class="col-xl-6 col-lg-7 col-md-12">
																								<div class="card profile-header">
																									<div class="body">
																										<div class="row">
																											<div class="col-lg-4 col-md-4 col-12">
																												<div class="profile-image" >
																													<img style="width:100px;height:100px;" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/{$toListe.id}.{$toListe.type_photo}">
																												</div>
																											</div>
																											<div class="col-lg-8 col-md-8 col-12 tab-link1">
																												<span class="nombre">{$toListe.iNbrVote}</span>
																												<h4 style="font-size: 12px;" class="m-t-0 m-b-0"><strong>{$toListe.nom}</strong> {$toListe.prenom}</h4>
																												<span class="job_post">{$toListe.path}</span>
																												<p class="job_post">{$oData.zDepartement}&nbsp;{$oData.zLocalite}</p>
																												<p class="job_post">{$toListe.matricule}</p>
																												<a class="btn btn-primary btn-round btn-simple galpop-single"  href="{$zBasePath}assets/images/vote/{$toListe.laureat_image}"><i class="fa fa-thumbs-up"></i>&nbsp;Voir la fiche</a>
																											</div>
																											
																										</div>
																									</div>
																								</div>
																							</div>
																						{/foreach}
																						</div>
																						</div>
																						</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																	<td style="width:30%!important;vertical-align:top;">
																		<table>
																			<tr>
																				{assign var=iNombreTotalVote value=$oData.togetStatAll->iVoteCentral+$oData.togetStatAll->iVoteRegional}
																				{assign var=iCountTotal value=$oData.togetStatAll->iCentral+$oData.togetStatAll->iRegional}
																				<td style="width:65%!important">Nombre total des votes :<br> <span class="jog">{$iNombreTotalVote} /  {$iCountTotal}</span></td>
																				<td>Pourcentage : <span class="jog">{if $iNombreTotalVote!=0}{($oData.togetStatAll->iNombreTotal/$iCountTotal*100)|string_format:"%.2f"}{else}0{/if}&nbsp;%</span></td>
																			</tr>
																			<tr>
																				<td style="width:50%!important">
																				<span>Nombre total des votants :<br> <span class="jog">{$oData.togetStatAll->iVoteCentral} / {$oData.togetStatAll->iCentral}</span></span><br>
																				<span>Nombre total de vote regional :<br> <span class="jog">{$oData.togetStatAll->iVoteRegional} / {$oData.togetStatAll->iRegional}</span></span>
																				</td>
																				<td>
																				<span>Pourcentage : <span class="jog">{($oData.togetStatAll->iVoteCentral/$oData.togetStatAll->iCentral*100)|string_format:"%.2f"}&nbsp;%</span></span><br>
																				<span>Pourcentage : <span class="jog">{($oData.togetStatAll->iVoteRegional/$oData.togetStatAll->iRegional*100)|string_format:"%.2f"}&nbsp;%</span></span>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>

															</table>
														</fieldset>
														</div>
														<div id="tab-2" class="tab-content">
																{foreach from=$oData.toRecapitulation item=oData}
																<table id="recapitulationAll" style="border:1px solid #ea7312">
																	<tr style="background-color:white!important">
																		<td colspan="2">{$oData->departement}</td>
																	</tr>
																	<tr>
																		<td style="border-bottom:none;">
																			<table>
																				<tr>
																					{assign var=iNombreTotalVote value=$oData->togetStatDept->iVoteCentral+$oData->togetStatDept->iVoteRegional}
																					{assign var=iCountTotal value=$oData->togetStatDept->iCentral+$oData->togetStatDept->iRegional}
																					<td style="border-bottom:none;">Nombre total des votes: <span class="jog">{$iNombreTotalVote} /  {if $oData->togetStatDept->iVoteRegional!=0}{$iCountTotal*2}{else}{$iCountTotal}{/if}</span></td>
																					<td style="border-bottom:none;">Pourcentage : <span class="jog">{if $oData->togetStatDept->iVoteRegional!=0}{($oData->togetStatDept->iVoteCentral/$iCountTotal*100)|string_format:"%.2f"}{else}{($iNombreTotalVote/$iCountTotal*100)|string_format:"%.2f"}{/if}&nbsp;%</span></td>
																				</tr>
																				<tr>
																					<td style="border-bottom:none;">
																					<span>Nombre total des votants central : <span class="jog"> {$oData->togetStatDept->iVoteCentral} / {$iCountTotal}</span></span><br>
																					<span>Nombre total des votants régional :<span class="jog"> {$oData->togetStatDept->iVoteRegional} / {if $oData->togetStatDept->iVoteRegional!=0}{$iCountTotal}{else}0{/if}</span></span>
																					</td>
																					<td style="border-bottom:none;">
																					<span>Pourcentage : <span class="jog">{($oData->togetStatDept->iVoteCentral/$iCountTotal*100)|string_format:"%.2f"}&nbsp;%</span></span><br>
																					<span>Pourcentage : <span class="jog">{if $oData->togetStatDept->iVoteRegional!=0}{($oData->togetStatDept->iVoteRegional/$iCountTotal*100)|string_format:"%.2f"}{else}0{/if}&nbsp;%</span></span>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
																{/foreach}
														</div>
																
															<script type="text/javascript" src="{$zBasePath}assets/galop/js/jquery.galpop.js"></script>
															<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
															<script type="text/javascript">
															{literal}
															$(document).ready(function() {

																$('.galpop-single').galpop();
															});
															
															</script>
															{/literal}
												
									</div>
							</div>
					</div>
				</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<script>
	$("#iMatricule").mask("999999"); 
</script>
<style>
.jog {
	color:#ea7312;
	font-size:16px;
}
.job_post {
	font-size:12px;
}

table.recapitulationAll tr td {
    font-size: 12px;
    vertical-align: middle;
    padding: 8px;
    border-bottom: none;
}

tbody > tr:nth-of-type(odd) {
    background-color:none!important; 
}

.tab-link1 .nombre {
    display: inline-block;
    width: 20%;
	padding:7px;
    background: #ea7312;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -o-border-radius: 100%;
    border-radius: 100%;
    color: white;
    text-align: center;
    top: -2px;
    line-height: 18px;
    margin: 0 0 20px 5px;
}
</style>
{include_php file=$zFooter}
		