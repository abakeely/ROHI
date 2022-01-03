{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Cong&eacute;s et Autres de {$oData.oCandidat.0->nom}&nbsp;{$oData.oCandidat.0->prenom}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Cong&eacute;s et Autre</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<form action="{$zBasePath}pointage/saveCongeAutre/pointage-electronique/" method="POST" name="formulaireCommande" id="formulaireCommande"  enctype="multipart/form-data">
										<fieldset>
											<div class="row clearfix">
												<div class="cell small">
													<div class="field">
														<label>Matricule&nbsp;</label>
														<input type="text" name="matricule" id="matricule" readonly="readonly" value="{$oData.oCandidat.0->matricule}" >
														<input type="hidden" name="user_id" id="user_id" readonly="readonly" value="{$oData.oCandidat.0->user_id}" >
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell small">
													<div class="field">
														<label>Date d&eacute;but *</label>
														<input type="text" name="date_debut" id="date_debut" autocomplete="off" value="{$oData.zDateDebut}" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" class="withDatePicker obligatoire">
														<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date de d&eacute;but</p>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell small">
													<div class="field">
														<label>Date fin *</label>
														<input type="text" name="date_fin" id="date_fin" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="withDatePicker obligatoire">
														<p class="message fin" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date fin</p>
													</div>
												</div>
											</div>
											<div class="row clearfix" id="isModtif">
												<div class="cell">
													<div class="field">
														<label>Motifs</label>
														<textarea id="zMotif" name="zMotif" class="obligatoire"></textarea>
														<p class="message">Veuillez entr&eacute;er le motif</p>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="cell">
													<div class="field">
														<input type="button" class="button" onClick="validerCA();" style="width:205px;" name="" id="" value="Envoyer votre demande">
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
								{if sizeof($oData.toGetCongeAutre)>0}
									<h2>Historique</h2>
								{/if}
								<div class="clear"></div>
								<div class="">
									<table>
										<thead>
											<tr>
												<th>Date d&eacute;but</th>
												<th>Date fin</th>
												<th>Motif</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toGetCongeAutre)>0}
											{foreach from=$oData.toGetCongeAutre item=oListe }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oListe.autreConge_dateDebut|date_format:"%d/%m/%Y"}</td>
												<td>{$oListe.autreConge_dateFin|date_format:"%d/%m/%Y"}</td>
												<td>{$oListe.autreConge_motif}</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											<tr><td style="text-align:center;" colspan="3">Aucun enregistrement correspondant</td></tr>
											{/if}
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