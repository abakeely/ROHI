{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/bootstrapValidator.min.js"></script>
<script src="{$zBasePath}assets/js/formValidation.min.js"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
			
			<input type="hidden" id="base_url" value="{$zBasePath}">
			<input type="hidden" id="iInscriptionligneId" value="{$oData.iInscriptionligneId}">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Formulaire de pré-inscription</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Formation</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/offre/sfao/divers-offres">Offres</a></li>
									<li class="breadcrumb-item">Inscription en ligne</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div align="right">
									<a href="{$zBasePath}formation/offre/sfao/divers-offres" class="btn">Retour menu</a>
								</div>
								<!--*Debut Contenue*-->
								<div class="">
									<form class="form-horizontal" role="form" name="formation" id="demande_inscription" action="{$zBasePath}formation/ajout_demande_formation" method="POST">
										
										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">COMPETENCES</div></h3>	
										
										<div>
											<br>
											<div class="col-md-12"></div>

											{if $oData.ajoutManuel}
												<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label">Agent à ajouter</label>
													</div>
													<div class="col-md-8">
														<input placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
													</div>
												</div>
												<br>
											{/if}
											<input type="hidden" name="isAjoutManuel"  value="{if $oData.ajoutManuel}1{else}0{/if}"/>
											
											{if $oData.isEditing}
												<input type="hidden" name="iInscriptionId"  value="{$oData.oInscription.inscriptionligne_id}"/>
												<input type="hidden" name="iUserId"  value="{$oData.oInscription.inscriptionligne_userId}"/>
											{/if}
											{*			
													<!--	<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
															<label class="control-label ">Fonction d'appartenance</label>
													</div>
													<div class="col-md-8">
														<select class="form-control"  name="fonction_app" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="fonction_part">
															<option  value="0">S&eacute;lectionner</option>
																<?php
																foreach($oFonction as $d){
																	$selected = "" ;
																	if($d['fonction_id'] == $fonction_app) $selected = 'selected="selected"';
																?>
																	<option  value=<?php echo $d['fonction_id'];?>  <?php echo $selected?>><?php echo $d['fonction_libelle'];?></option>
																<?php }?>
														</select>
													</div>
													</div><br>

													<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Famille professionnelle</label>
													</div>
														<div class="col-md-8">
														<select class="form-control" placeholder="theme de formation" name="famille_pro" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="famille_prof">
															<option  value="0">S&eacute;lectionner</option>
																<?php foreach($list_comp2 as $d){
																	$selected = "" ;
																	if($d->id == $famille_pro) $selected = 'selected="selected"';
																?>
																	<option  value=<?php echo $d->id;?>  <?php echo $selected?>><?php echo $d->libele;?></option>
																<?php }?>
														</select>
													</div>
													</div><br>

													<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Sous famille professionnelle</label>
													</div>
													<div class="col-md-8">
														<select class="form-control" placeholder="theme de formation" name="sous_famille_pro" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="sous_famille_prof">
															<option  value="0">S&eacute;lectionner</option>
																<?php foreach($list_comp3 as $d){
																	$selected = "" ;
																	if($d->id == $sous_famille_pro) $selected = 'selected="selected"';
																?>
																	<option  value=<?php echo $d->id;?>  <?php echo $selected?>><?php echo $d->libele;?></option>
																<?php }?>
														</select>
													</div>
													</div><br>

													<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Emploi reference</label>
													</div>
													<div class="col-md-8">
														<select class="form-control" placeholder="theme de formation" name="emplois_ref" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="emp_ref">
															<option  value="0">S&eacute;lectionner</option>
																<?php foreach($list_comp4 as $d){
																	$selected = "" ;
																	if($d->id == $emplois_ref) $selected = 'selected="selected"';
																?>
																	<option  value=<?php echo $d->id;?>  <?php echo $selected?>><?php echo $d->libele;?></option>
																<?php }?>
														</select>
													</div>
													</div><br> !-->
												*}

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
													<label class="control-label">Poste actuel</label>
												</div>
												<div class="col-md-8">
													<input type="text" id="adresse_professionelle" class="form-control" placeholder="Poste actuel" name="adresse_professionel" value="{if $oData.isEditing} {$oData.oInscription.inscriptionligne_poste} {/if}">
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
													<label class="control-label">Ancienneté au poste</label>
												</div>
												<div class="col-md-8">
													<input type="text" id="anciennete_poste" class="form-control" placeholder="Ancienneté au poste" name="anciennete_poste" value="{if $oData.isEditing} {$oData.oInscription.inscriptionligne_anciennete} {/if}">
												</div>
											</div>
											<br>

											{*	
													<!--	<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label">Attribution(s) de l'Agent</label>
													</div>
													<div class="col-md-8" id="div_attrib" style="padding-left: 0 !important">
														<input type="hidden" value="<?php echo sizeof($list_attribution)?>" id="size_attribution"/>
														<?php $i=0; if($list_attribution){ // MODIF du 04/07/2016
															foreach($list_attribution as $elem){
															$i++;?>
															<div class="row diplome_row" id="attribution_row_<?php echo $i;?>">

																<?php if($i!=1){ ?>
																		<div class="col-md-10"><input class="form-control" placeholder="Attribution de l'Agent" type="text" name="attribution[]" value="<?php echo $elem['libele'];?>" disabled="disabled" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteDiplome('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>
																<?php } else{?>
																	<div class="col-md-10"><input class="form-control" placeholder="Attribution de l'Agent" type="text" name="attribution[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutAttrib"> <i class="la la-plus-circle"></i></button>
																	</div>
																<?php } ?>
															</div>
													<?php }
															}else{
														?>
																<div class="row diplome_row" id="attribution_row">
																<div class="col-md-10"><input class="form-control" placeholder="Attribution de l'Agent" type="text" name="attribution[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutAttrib"> <i class="la la-plus-circle"></i></button>
																	</div>
																</div>
													<?php }
													?>
													</div>
													</div><br> 

													<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label">Tache quotidienne</label>
													</div>
													<div class="col-md-8" id="div_tache" style="padding-left : 0 !important">
														<input type="hidden" value="<?php echo sizeof($list_tache)?>" id="size_attribution"/>
														<?php $i=0; if($list_tache) {
																foreach($list_tache as $elem){$i++;?>
															<div class="row diplome_row" id="tache_row_<?php echo $i;?>">

																<?php if($i!=1){ ?>
																		<div class="col-md-10"><input class="form-control" placeholder="Tache quotidienne" type="text" name="tache_journaliere[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteTache('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>
																	<?php } else{?>
																		<div class="col-md-10"><input class="form-control" placeholder="Tache quotidienne" type="text" name="tache_journaliere[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																		<div class="col-md-2">
																			<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asanao andavanandro" id="inscriAjoutTache"> <i class="la la-plus-circle"></i></button>
																		</div>
																	<?php } ?>
															</div>
														<?php }
															}else{
														?>
																<div class="row diplome_row" id="attribution_row">
																<div class="col-md-10"><input class="form-control" placeholder="Tache quotidienne" type="text" name="tache_journaliere[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutTache"> <i class="la la-plus-circle"></i></button>
																	</div>
																</div>
													<?php }
													?>

													</div>
													</div><br> -->
												*}

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
													<label class="control-label">Savoir requis pour le poste (Connaissances th&eacute;oriques)</label>
												</div>
												<div class="col-md-8" id="requi_row">
													<input type="hidden" value="{$oData.oInscription.oTheorique|@count}" id="size_requi"/>
													{if $oData.oInscription.oTheorique}
													{assign var=i value=0}
														{foreach from=$oData.oInscription.oTheorique  item=elem}
														{assign var=i value=$i+1}
															<div class="row diplome_row" id="requi_row_{$i}">
																{if $i!=1}
																		<div class="col-md-10"><input class="form-control" placeholder="Connaissances theoriques requis" type="text" name="savoir_requi[]" value="{$elem.theorique_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																		<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="deleteDiv({$i},'requi_row')"><i class="la la-minus-circle"></i></button></div>
																{else}
																	<div class="col-md-10"><input class="form-control" placeholder="Connaissances theoriques requis" type="text" name="savoir_requi[]" value="{$elem.theorique_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutRequi"> <i class="la la-plus-circle"></i></button>
																	</div>
																{/if}
															</div>
														{/foreach}
													{else}
														<div class="row diplome_row" id="requi_row_">
															<div class="col-md-10"><input class="form-control" placeholder="Connaissances theoriques requis" type="text" name="savoir_requi[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
															<div class="col-md-2">
																	<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutRequi"> <i class="la la-plus-circle"></i></button>
															</div>
														</div>
													{/if}
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
													<label class="control-label">Savoir Faire requis pour le poste (Compétences pratiques, aptitude)</label>
												</div>
												<div class="col-md-8" id="faire_row">
													<input type="hidden" value="{$oData.oInscription.oTechnique|@count}" id="size_faire"/>
													{if $oData.oInscription.oTechnique}
													{assign var=i value=0}
														{foreach from=$oData.oInscription.oTechnique  item=elem}
														{assign var=i value=$i+1}
															<div class="row diplome_row" id="faire_row_{$i}">
																{if $i!=1}
																	<div class="col-md-10"><input class="form-control" placeholder="Compétences pratiques requis" type="text" name="savoir_faire[]" value="{$elem.technique_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="deleteDiv({$i},'faire_row')"><i class="la la-minus-circle"></i></button></div>
																{else}
																	<div class="col-md-10"><input class="form-control" placeholder="Compétences pratiques requis" type="text" name="savoir_faire[]" value="{$elem.technique_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutFaire"> <i class="la la-plus-circle"></i></button>
																	</div>
																{/if}
															</div>
														{/foreach}
													{else}
															<div class="row diplome_row" id="faire_row_">
																<div class="col-md-10"><input class="form-control" placeholder="Compétences pratiques requis" type="text" name="savoir_faire[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																<div class="col-md-2">
																	<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutFaire"> <i class="la la-plus-circle"></i></button>
																</div>
															</div>
													{/if}
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
													<label class="control-label">Savoir &ecirc;tre requis pour le poste (Qualités comportementales)</label>
												</div>
												<div class="col-md-8" id="etre_row">
													<input type="hidden" value="{$oData.oInscription.oComportementale|@count}" id="size_faire"/>
													{if $oData.oInscription.oComportementale}
													{assign var=i value=0}
														{foreach from=$oData.oInscription.oComportementale  item=elem}
														{assign var=i value=$i+1}
															<div class="row diplome_row" id="etre_row_{$i}">
																{if $i!=1}
																	<div class="col-md-10"><input class="form-control" placeholder="Qualités comportementales requis" type="text" name="savoir_etre[]" value="{$elem.comportementale_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="deleteDiv({$i},'etre_row')"><i class="la la-minus-circle"></i></button></div>
																{else}
																	<div class="col-md-10"><input class="form-control" placeholder="Qualités comportementales requis" type="text" name="savoir_etre[]" value="{$elem.comportementale_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutEtre"> <i class="la la-plus-circle"></i></button>
																	</div>
																{/if}
															</div>
														{/foreach}
													{else}
															<div class="row diplome_row" id="attribution_row">
															<div class="col-md-10"><input class="form-control" placeholder="Qualités comportementales requis" type="text" name="savoir_etre[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																<div class="col-md-2">
																	<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy fahaizana manao" id="inscriAjoutEtre"> <i class="la la-plus-circle"></i></button>
																</div>
														</div>
													{/if}
												</div>
											</div><br>

											{*	
													<!--	<?php if(!$ajoutManuel){ ?>
													
													<div class="row div_formation">
														<input type="hidden" value="<?php echo sizeof($diplome_list)?>" id="size_diplome"/>
														<div class="col-md-3 libele_form" style="background:none;">
															<label class="control-label">Dipl&ocirc;mes Obtenus</label>
														</div>
														<div class="col-md-8" >
														<table class="tableau" id="tableDiplome">
															<tbody>
																<?php $i=0; foreach($oDiplome as $diplome){$i++;?>
																<tr class="" id="diplome_row_<?php echo $i;?>">
																	<td class=""><input class="form-control" placeholder="Diplomes" type="text" disabled="disabled" name="diplome_name[]" value="<?php echo $diplome['diplome_name'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></td>
																	<td class=""><input class="form-control" placeholder="Fili&egrave;re" type="text" disabled="disabled" name="diplome_discipline[]" value="<?php echo $diplome['diplome_disc'];?>" data-toggle="tooltip" data-original-title= "Soraty ny sampam-pianarana"/></td>
																	<td class=""><input class="form-control input_date"  maxLength="4"  id="diplome_date_<?php echo $i;?>" disabled="disabled" onChange="testDate('<?php echo $i;?>')" placeholder="Ann&eacute;e d&grave;obtention" type="text" name="diplome_date[]" value="<?php echo $diplome['diplome_date'];?>" data-toggle="tooltip" data-original-title= "Soraty ny taona nahazoanao ilay mari-pahaizana"/></td>
																	<td class=""><input class="form-control" placeholder="Etablissement " type="text" name="diplome_etablissement[]" disabled="disabled" value="<?php echo $diplome['diplome_etab'];?>" data-toggle="tooltip" data-original-title= "Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana"/></td>
																	<td class=""><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" disabled="disabled" value="<?php echo $diplome['diplome_pays'];?>" data-toggle="tooltip" data-original-title= "Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana"/></td>
																</tr>
																<?php }?>
																</tbody>
														</table>
													</div>
													</div><br>
													<?php }?>
													Stage de formation de courte durée       
													<div class="row div_formation">

														<input type="hidden" value="<?php echo sizeof($stage_list)?>" id="size_stage"/>
														<div class="col-md-3 libele_form" style="background:none;">
															<label class="control-label">Stage et formation de courte durée</label>
														</div><br><br>
														<div class="col-md-12">
															<table class="tableau col-md-12" >
																<tbody class="col-md-12" id="tableStage">
																	<?php $i=0; foreach($stage_list as $stage){$i++;?>
																	<tr class="col-md-12" id="stage_row_<?php echo $i;?>">

																			<td><input class="form-control" placeholder="Theme de formation" type="text" name="stage_name[]" value="" /></td>
																			<td><input class="form-control" placeholder="Etablissement de formation" type="text" name="stage_etablissement[]" value="" /></td>
																			<td><input class="form-control" placeholder="Ann&eacute;e de formation" type="text" name="stage_annee[]" value="" /></td>
																			<td><input class="form-control" placeholder="Pays de formation" type="text" name="stage_pays[]" value="" /></td>


																		<?php if($i!=1){ ?>
																		<td style="width: 6.77%"><button class="btn_close" type="button" onclick="<?php echo 'deleteStage('.$i.')';?>"><i class="la la-minus-circle"></i></button></td>
																		<?php } ?>
																		<td style="width : 6.77%"><button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy fiofanana" id="inscriAjoutStage"><i class="la la-plus-circle"></i></button></td>

																	</tr><br>
																	<?php }?>
																</tbody>
															</table>
														</div>
													</div> -->
												*}

										</div>

										<!----------------- bloc Toogle ---------------->
										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
											<div align="center">DEMANDE DE FORMATION</div>
										</h3>
										<!----------------- bloc Toogle			Eto les lah zao Garina a ---------------->
										<div>
											<br>
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Type de formation </label>
												</div>
												<div class="col-md-8">
													<select class="form-control" name="theme_formation"  id="theme_formation">
														<option  value="0">S&eacute;lectionner</option>
														{foreach from=$oData.oThemeFormation item=oThemeF}
															<option  value={$oThemeF.theme_id} {if $oThemeF.theme_id==$oData.oInscription.inscriptionligne_themeId}selected{/if} >{$oThemeF.theme_intitule}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Type de l'offre </label>
												</div>
												<div class="col-md-8">
													<select class="form-control" placeholder="Type de formation" name="type_formation"  id="type_formation">
														<option  value="0">S&eacute;lectionner</option>
														{foreach from=$oData.oTypeFormation item=oTypeF}
															<option  value={$oTypeF.formation_id} {if $oTypeF.formation_id==$oData.oAboutFormation.formation_id}selected{/if}>{$oTypeF.formation_intitule}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "> Institut de formation </label>
												</div>
												<div class="col-md-8">
													<select class="form-control" placeholder="Institut de formation" name="institut_formation"  id="institut_formation">
														<option  value="0">S&eacute;lectionner</option>
														{foreach from=$oData.oInstitutFormation item=oInstitutF}
															<option  value={$oInstitutF.institut_id} {if $oInstitutF.institut_id==$oData.oAboutFormation.institut_id}selected{/if}>{$oInstitutF.institut_libelle}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "> Intitule de formation </label>
												</div>
												<div class="col-md-8">
													<select class="form-control" placeholder="Intitule de formation" name="intitule_formation"  id="intitule_formation">
														<option  value="0">S&eacute;lectionner</option>
														{foreach from=$oData.oIntituleFormation item=oIntituleF}
															<option  value={$oIntituleF.intitule_id} {if $oIntituleF.intitule_id==$oData.oInscription.inscriptionligne_intituleId}selected{/if}>{$oIntituleF.intitule_libelle}</option>
														{/foreach}
													</select>
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "> Lieu de formation </label>
												</div>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Lieu où la formation passera" name="lieu_formation" id="lieu_formation"
													value="{if $oData.oInscription.inscriptionligne_lieuFormation} {$oData.oInscription.inscriptionligne_lieuFormation} {/if}"/>

												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "> Date de formation </label>
												</div>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Date de la formation" name="date_formation"  id="date_formation" 
													value="{if $oData.oInscription.inscriptionligne_dateFormation} {$oData.oInscription.inscriptionligne_dateFormation} {/if}" />
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "> Organisation de financement </label>
												</div>
												<div style="text-align : center" class="col-md-8">
													<span style="display : none;" id="texte_non">
													Avant de vous inscrire en ligne à une formation payante, assurez-vous d'avoir obtenu un Avis de Non Objection (ANO)
														venant d'un organisme de financement ou un Avis favorable sur la prise en charge de votre formation par votre département de rattachement.
													</span>
													<p style="text-align : center; display : block; padding : 0 !important;">Êtes-vous sûr(e) d'être pris(e) en charge?</p>
													<p class="partenaire_radio"><input {if $oData.oInscription.inscriptionligne_partenaire == 1}checked {/if} type="radio" class="form_control partenaire_radio" name="partenaire_radio" value="1"> Oui</p>
													<p class="partenaire_radio"><input {if $oData.oInscription.inscriptionligne_partenaire == 2}checked {/if} type="radio" class="form_control partenaire_radio" name="partenaire_radio" value="2"> Non</p>
													<select class="form-control" name="partenaire"  id="partenaire">
													<option  value="0">S&eacute;lectionner</option>
													{foreach from=$oData.oOrganisme item=oOrga}
														<option  value={$oOrga.organisme_id} {if $oOrga.organisme_id==$oData.oInscription.inscriptionligne_organismeId}selected{/if}>{$oOrga.organisme_intitule}</option>
													{/foreach}
													</select>

												</div>
											</div>
											<br>

											<div class="row" {if $oData.oInscription.inscriptionligne_organismeId < 9 }style="display : none;"{/if} id="partenaire_autre">
												<div class="col-md-3 libele_form" style="background:none;">
												</div>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Autres Organisme" name="partenaire_autre" value="{if $oData.oInscription.inscriptionligne_organismeId==9 }{$oData.oInscription.inscriptionligne_autrepartenaire} {/if}"  />
												</div>
											</div>
											<br>
										</div>

										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">ATTENTES INDIVIDUELLES</div></h3>
										<!----------------- bloc Toogle ---------------->
										<div>
											<br>
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
													<label class="control-label">Vos tâches quotidiennes</label>
												</div>
												<div class="col-md-8" id="div_tache">
													<input type="hidden" value="{$oData.oTache|@count}" id="size_attribution"/>
													{if $oData.oTache}
													{assign var=i value=0}
														{foreach from=$oData.oTache item=oTache}
														{assign var=i value=$i+1}
															<div class="row diplome_row" id="tache_row_{$i}">

																{if $i!=1}
																	<div class="col-md-10"><input class="form-control" placeholder="Tache quotidienne" type="text" name="tache_journaliere[]" value="{$oTache.tache_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="deleteTache({$i})"><i class="la la-minus-circle"></i></button></div>
																{else}
																	<div class="col-md-10"><input class="form-control" placeholder="Tache quotidienne" type="text" name="tache_journaliere[]" value="{$oTache.tache_value}" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
																	<div class="col-md-2">
																		<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asanao andavanandro" id="inscriAjoutTache"> <i class="la la-plus-circle"></i></button>
																	</div>
																{/if}
															</div>
														{/foreach}
													{else}
														<div class="row diplome_row" id="tache_row">
															<div class="col-md-10"><input class="form-control" placeholder="Tache quotidienne" type="text" name="tache_journaliere[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
															<div class="col-md-2">
																<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="inscriAjoutTache"> <i class="la la-plus-circle"></i></button>
															</div>
														</div>
													{/if}

												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Vos interlocuteurs (internes et externes) </label>
												</div>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Vos interlocuteurs" name="interloc" id="interloc" value="{if $oData.oAttente[0].oattente_interloc} {$oData.oAttente[0].oattente_interloc} {/if}" />
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "></label>
												</div>
												<div style="text-align : center" class="col-md-8">
													<p style="text-align : center; display : block; padding : 0 !important;">Avez-vous déjà suivi une formation sur ce thème ou un thème voisin? Si oui, remplissez les champs correspondants</p>
													<p class="formation_radio"><input {if $oData.oAttente[0].oattente_formation == 1}checked{/if} type="radio" class="form_control formation_annexe" name="formation_annexe" value="1"> Oui</p>
													<p class="formation_radio"><input {if $oData.oAttente[0].oattente_formation == 2}checked{/if} type="radio" class="form_control formation_annexe" name="formation_annexe" value="2"> Non</p>
												</div>
											</div>
											<br>

											<div {if $oData.oAttente[0].oattente_formation == 2}style="display : none;"{/if} id="formation_correspondante">
												<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Le thème de cette formation</label>
													</div>
													<div class="col-md-8">
														<input type="text" value="{if $oData.oAttente[0].oattente_themeFormation} {$oData.oAttente[0].oattente_themeFormation} {/if}" class="form-control" placeholder="Le thème de la formation" name="formation_theme" id="formation_theme" />
													</div>
												</div><br>
												<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">La date de cette formation</label>
													</div>
													<div class="col-md-8">
														<input type="text" value="{if $oData.oAttente[0].oattente_dateFormation} {$oData.oAttente[0].oattente_dateFormation} {/if}" class="form-control" placeholder="La date de la formation" name="formation_date" id="formation_date" />
													</div>
												</div><br>
												<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Le lieu de cette formation</label>
													</div>
													<div class="col-md-8">
														<input type="text" value="{if $oData.oAttente[0].oattente_lieuFormation} {$oData.oAttente[0].oattente_lieuFormation} {/if}" class="form-control" placeholder="Le lieu de la formation" name="formation_lieu" id="formation_lieu" />
													</div>
												</div><br>
												<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">L'institut de cette formation</label>
													</div>
													<div class="col-md-8">
														<input type="text" value="{if $oData.oAttente[0].oattente_institutFormation} {$oData.oAttente[0].oattente_institutFormation} {/if}" class="form-control" placeholder="L'institut de la formation" name="formation_institut" id="formation_institut" />
													</div>
												</div><br>
												<div class="row">
													<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">L'organisme de financement durant cette formation</label>
													</div>
													<div class="col-md-8">
														<input type="text" value="{if $oData.oAttente[0].oattente_organisme} {$oData.oAttente[0].oattente_organisme} {/if}" class="form-control" placeholder="L'organisme de financement durant la formation" name="formation_organisme" id="formation_organisme" />
													</div>
												</div><br>
											</div>
											
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label "></label>
												</div>
												<div style="text-align : center" class="col-md-8">
													<p style="text-align : center; display : block; padding : 0 !important;">Avez-vous demandé personnellement de suivre la formation qu'on vous propose actuellement ?</p>
													<p class="formation_radio"><input {if $oData.oAttente[0].oattente_demandeperso == 1}checked{/if} type="radio" class="form_control demande_personnelle" name="demande_personnelle" value="1"> Oui</p>
													<p class="formation_radio"><input {if $oData.oAttente[0].oattente_demandeperso == 2}checked{/if} type="radio" class="form_control demande_personnelle" name="demande_personnelle" value="2"> Non</p>
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Quelles sont vos difficultés ou les lacunes de compétences que vous souhaiteriez combler par cette formation ?</label>
												</div>
												<div class="col-md-8">
													<br>
													<input value="{if $oData.oAttente[0].oattente_lacune} {$oData.oAttente[0].oattente_lacune} {/if}" type="text" class="form-control" placeholder="Lacunes de compétences à combler" name="lacune_competence" id="lacune_competence" />
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Vos attentes par rapport à cette formation </label>
												</div>
												<div class="col-md-8">
													<select class="form-control" name="attente"  id="attente">
														<option  value="0">S&eacute;lectionner</option>
														{foreach from=$oData.oAttenteFormation item=oAttenteF}
														<option  value={$oAttenteF.attente_id} {if $oAttenteF.attente_id == $oData.oAttente[0].oattente_attenteId}selected{/if}>{$oAttenteF.attente_intitule}</option>
														{/foreach}
													</select><br>
													<input {if $oData.oAttente[0].oattente_attenteId < 8}style="display : none;"{/if} value="{if $oData.oAttente[0].oattente_attenteId==8} {$oData.oAttente[0].oattente_autreattente} {/if}"
														type="text" class="form-control" placeholder="Autres" name="attente_autre" id="attente_autre" />
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Vos motivations personnelles pour suivre cette formation </label>
												</div>
												<div class="col-md-8">
													<input value="{if $oData.oAttente[0].oattente_motivation} {$oData.oAttente[0].oattente_motivation} {/if}" type="text" class="form-control" placeholder="Motivation Personnelle" name="motivation_pers" id="motivation_pers" />
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-md-3 libele_form" style="background:none;">
														<label class="control-label ">Vos objectifs opérationnels à atteindre à l'issue de la formation </label>
												</div>
												<div class="col-md-8">
													<input value="{if $oData.oAttente[0].oattente_objectif} {$oData.oAttente[0].oattente_objectif} {/if}" type="text" class="form-control" placeholder="Objectifs opérationnels" name="objectif_operationnel" id="objectif_operationnel" />
												</div>
											</div>
											<br>

											<div class="row">
												<div style="text-align : center;" class="col-md-11" style="background:none;">
													Avez-vous des cas concrets (dossiers) pour lesquels vous souhaiteriez des réponses durant la formation?<br>
													Si oui, veuillez les préciser dans la case suivante
												</div>
											</div>
											<br>

											<div class="col-md-2"></div>
											<div class="row">
												<div class="col-md-9">
													<input value="{if $oData.oAttente[0].oattente_cas} {$oData.oAttente[0].oattente_cas} {/if}" type="text" class="form-control" placeholder="Cas concrets" name="cas_concret" id="cas_concret" />
												</div>
											</div>
											<br>
											
										</div>

										<div class="row">
											<input style="width : 25%; margin : 22px auto; display : block; border-radius : 10px; cursor : pointer" type='submit' class="btn btn-primary form-control" value="{if $oData.isEditing} Modifier {else}S'inscrire{/if}"/>
										</div>
										<div id ="resultat_popup"></div>
									</form>
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

<script src="{$zBasePath}assets/gcap/js/app/select2.js"></script>
{literal}		
<style>
	.partenaire_radio{
		display : inline-block;
		margin : 5px;
		padding : 0 !important;
	}
	.formation_radio{
		display : inline-block;
		margin : 5px;
		padding : 0 !important;
	}
</style>


  <script>
    $(document).ready(function() {
		$('#attente').on('change',function(){
			var valeur = $(this).val();
			valeur = parseInt(valeur);
			if(valeur == 8){
				$("#attente_autre").show();
			}else $("#attente_autre").hide();
		});
		$('#partenaire').on('change',function(){
			var valeur = $(this).val();
			valeur = parseInt(valeur);
			if(valeur == 9){
				$("#partenaire_autre").show();
			}else $("#partenaire_autre").hide();
		});
		$('.partenaire_radio').on('change',function(){
			var valeur = $(this).val();
			valeur = parseInt(valeur);
			if(valeur == 2){
				var text= $("#texte_non").html();
				bootbox.alert(text);
			}
		});
		$('.formation_annexe').on('change',function(){
			var valeur = $(this).val();
			valeur = parseInt(valeur);
			if(valeur == 1){
				$("#formation_correspondante").show();
			}else $("#formation_correspondante").hide();
		});
		$('#demande_inscription').bootstrapValidator({
			onError: function(e) {},
			onSuccess: function(e) {},
			fields : {
				adresse_professionel: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre Poste'
						}
					}
				},
				anciennete_poste:{
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre ancienneté au poste'
						}
					}
				},
				'attribution[]' : {
					validators : {
						notEmpty : {
							message : 'L&acute;activité doit être remplie'
						}
					}
				},
				'tache_journaliere[]': {
					validators : {
						notEmpty : {
							message : 'La tache quotidienne est obligatoire'
						}
					}
				},
				formation_theme: {
					validators : {
						notEmpty : {
							message : 'Le theme de la formation doit être rempli'
						}
					}
				},
				formation_lieu: {
					validators : {
						notEmpty : {
							message : "Le lieu de la formation doit être rempli"
						}
					}
				},
				formation_date: {
					validators : {
						notEmpty : {
							message : "L'annee de la formation doit être remplie"
						}
					}
				},
				formation_institut: {
					validators : {
						notEmpty : {
							message : "L'institut de la formation doit être rempli"
						}
					}
				},
				formation_organisme: {
					validators : {
						notEmpty : {
							message : "L'organisme de financement durant la formation doit être rempli"
						}
					}
				},
				'savoir_requi[]': {
					validators : {
						notEmpty : {
							message : 'Le savoir (connaissances th&eacute;oriques) requis pour la formation  est obligatoire'
						}
					}
				},

				'savoir_faire[]' : {
					validators : {
						notEmpty : {
							message : 'Le savoir faire (technique) requis pour la formation   est obligatoire'
						}
					}
				},
				'savoir_etre[]' : {
					validators : {
						notEmpty : {
							message : 'Le savoir etre (qualit&eacute;s) requis pour la fonction  est obligatoire'
						}
					}
				},
				interloc : {
					validators : {
						notEmpty: {
							message: "Veuillez remplir le champ pour vos interlocuteurs"
						}
					}
				},
				formation_annexe : {
					validators : {
						notEmpty: {
							message: "Veuillez repondre à la question posée par oui ou non"
						}
					}
				},
				theme_formation : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: "Veuillez S&eacute;lectionner votre theme de formation"
						}
					}
				},
				type_formation : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: "Veuillez S&eacute;lectionner votre type de formation"
						}
					}
				},
				institut_formation : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: "Veuillez S&eacute;lectionner votre institut de formation"
						}
					}
				},
				intitule_formation : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: "Veuillez S&eacute;lectionner votre intitulé de formation"
						}
					}
				},
				partenaire : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message : 'Le partenaire est obligatoire'
						}
					}
				},
				partenaire_radio : {
					validators : {
						notEmpty : {
							message : "Vous devez repondre à la question sur l'organisme de financement"
						}
					}
				},
				partenaire_autre : {
					validators : {
						notEmpty : {
							message : "Vous devez remplir le champ si vous avez selectionné autre organisme"
						}
					}
				},
				demande_personnelle : {
					validators : {
						notEmpty : {
							message : "Vous devez repondre à la quesion posée"
						}
					}
				},
				lacune_competence : {
					validators : {
						notEmpty : {
							message : "Vous devez remplir le champ"
						}
					}
				},
				attente : {
					validators : {
						greaterThan: {
							value: 0,
							inclusive: false,
							message: "Veuillez S&eacute;lectionner votre attente par rapport à la formation"
						}
					}
				},
				attente_autre : {
					validators : {
						notEmpty : {
							message : "Vous devez remplir le champ si vous avez selectionné autre attente"
						}
					}
				},
				motivation_pers : {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre motivation personnelle'
						}
					}
				},
				objectif_operationnel : {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre objectif operationnel'
						}
					}
				},
				lieu_formation : {
					validators : {
						notEmpty : {
							message : 'Veuillez entrer le lieu de la formation'
						}
					}
				},
				date_formation : {
					validators : {
						notEmpty : {
							message : 'Veuillez entrer la date de la formation'
						}
					}
				}
			}
		});
    });

	$('#theme_formation').on('change',function(){
		var valeur = $('#theme_formation').val();
        if(valeur!='0'){
       		$.ajax({
                url: base_url() + "json/module_formation/"+valeur,
                type: 'get',
                success: function(data, textStatus, jqXHR) {
                      var obj = jQuery.parseJSON(data);
                      $('#module_formation').html('');
                      var select_option ='';
                      select_option += '<option value="0">Selectionner</option>';
                      obj.forEach(function(module) {
                          select_option += '<option value="'+module['id']+'">'+module['libele']+'</option>';
                      });
                      $('#module_formation').html(select_option);
                },
                async: false
       		 });
        }
	});

	$('#module_formation').on('change',function(){
		var valeur = $('#module_formation').val();
        if(valeur!='0'){
       		$.ajax({
                url: base_url() + "json/contenu_formation/"+valeur,
                type: 'get',
                success: function(data, textStatus, jqXHR) {
                      var obj = jQuery.parseJSON(data);
                      $('#contenu_formation').html('');
                      var select_option ='';
                      select_option += '<option value="0">Selectionner</option>';
                      obj.forEach(function(module) {
                          select_option += '<option value="'+module['id']+'">'+module['libele']+'</option>';
                      });
                      $('#contenu_formation').html(select_option);
                },
                async: false
       		 });
        }
	});

	$('#fonction_part').on('change',function(){
		updateList('fonction_part','famille_prof',1);
		$("#famille_prof").val(0);
		$("#sous_famille_prof").val(0);
		$("#emp_ref").val(0);
	});

	$('#famille_prof').on('change',function(){
		updateList('famille_prof','sous_famille_prof',2);
		$("#sous_famille_prof").val(0);
		$("#emp_ref").val(0);
	});

	$('#sous_famille_prof').on('change',function(){
		updateList('sous_famille_prof','emp_ref',3);
		$("#emp_ref").val(0);
	});

	$('#type_formation').on('change',function(){
		updateList('type_formation','institut_formation',4);
		$("#institut_formation").val(0);
		$("#intitule_formation").val(0);
	});

	$('#institut_formation').on('change',function(){
		updateList('institut_formation','intitule_formation',5);
		$("#intitule_formation").val(0);
	});
/*
	$('#intitule_formation').on('change',function(){
		updateList('intitule_formation','lieu_formation',6);
	});

	$('#lieu_formation').on('change',function(){
		updateList('lieu_formation','date_formation',7);
	}); */
	var urlSearch = base_url() + "gcap/candidat/";

	var dataArrayVille = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	$("#zCandidatSearch").select2
	({
		initSelection: function (element, callback)
		{

			$(dataArrayVille).each(function()
			{
				if (this.id == element.val())
				{
					callback(this);
					return
				}
			})
		},
		allowClear: true,
		placeholder:"Sélectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },
		ajax: {
			url: urlSearch,
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#zCandidatSearch").select2('val',$("#idSelect").val());
	function deleteTache(index){
		$('#tache_row_'+index).remove();
	}
	function deleteDiv(index,div){
		$('#'+div+'_'+index).remove();
	}
	function updateList(elemChanged,elemUpdate,type){
		var valeur = $('#'+elemChanged).val();
		var __param;
		switch(type){
			case 1 :
				__param = "famillepro";
				break;
			case 2 :
				__param = "sousfamillepro";
				break;
			case 3 :
				__param = "emploi";
				break;
			case 4 :
				__param = "institut";
				break;
			case 5 :
				__param = "intitule";
				break;
		}
		var urlGET = base_url() + "formation/getData/";

        if(valeur!='0'){
       		$.ajax({
                url: urlGET,
                type: 'post',
								data : {
									valeur : valeur,
									type : type
								},
                success: function(data, textStatus, jqXHR) {
											var _id=__param + '_id';
											var _libele = __param + '_libelle';
                      var obj = jQuery.parseJSON(data);
                      $('#'+elemUpdate).html('');
                      var select_option ='';
                      select_option += '<option value="0">Selectionner</option>';
                      obj.forEach(function(module) {
                          select_option += '<option value="'+module[_id]+'">'+module[_libele]+'</option>';
                      });
                      $('#'+elemUpdate).html(select_option);
                },
                async: false
       		 });
        }
	}


	function base_url(){
        return "{/literal}{$zBasePath}{literal}";
     }
</script>
{/literal}

<script src="{$zBasePath}assets/inscription/js/inscription.js"></script>
