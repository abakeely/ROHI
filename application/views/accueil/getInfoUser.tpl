<div id="evaluation-table">
<div id="information-table">

	<form enctype="multipart/form-data">
	<input type="hidden" name="iEvaluableValue" id="iEvaluableValue" value="1">
	<input type="hidden" name="iClassificationValue" id="iClassificationValue" value="0">
		<fieldset>
			<div class="headblock">

				<div class="left User-photo">
					<img src="{$zPathWithPhoto}" width="200">
				</div>
				<div class="User-details">
					<div class="row clearfix" style="width:100%">
						<div class="cell">
							<div class="field">
								<label><b>Nom :</b> {$oCandidat.0->nom}</label>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:100%">
							<div class="field">
								<label>Prénom : {$oCandidat.0->prenom}</label>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell">
							<div class="field">
								<label>Matricule : {$oCandidat.0->matricule}</label>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div >
				<table id="fichedeposteFiche" style="width:100%">
					  <tr class="ui-widget-header ui-dialog-titlebar">
							<td style="padding: 10px!important;color:white">A- INTITULE DU POSTE</td>
					  </tr>
					  <tr>
							<td style="padding: 10px!important;">{$toFicheDePoste.fichePoste_intitule|nl2br}</td>
					  </tr>
					  <tr>
							<td style="border:none!important;padding: 10px!important;"></td>
					  </tr>
					  <tr class="ui-widget-header ui-dialog-titlebar">
							<td style="padding: 10px!important;color:white">B- Mission</td>
					  </tr>
					  <tr style="height:50px">
							<td style="padding: 10px!important;vertical-align:top">{$toFicheDePoste.fichePoste_mission|nl2br}</td>
					  </tr>


					  <tr>
							<td style="border:none!important;padding: 10px!important;"></td>
					  </tr>
					  <tr class="ui-widget-header ui-dialog-titlebar">
							<td style="padding: 10px!important;color:white">C- Activités principales </td>
					  </tr>
					  <tr style="height:50px">
							<td style="padding: 10px!important;">{$toFicheDePoste.fichePoste_activitePrinc|nl2br}</td>
					  </tr>

					  <tr>
							<td style="border:none!important;padding: 10px!important;"></td>
					  </tr>
					  <tr class="ui-widget-header ui-dialog-titlebar">
							<td style="padding: 10px!important;color:white">Activités d’encadrement </td>
					  </tr>
					  <tr style="height:50px">
							<td style="padding: 10px!important;vertical-align:top">{$toFicheDePoste.fichePoste_activiteEncad|nl2br}</td>
					  </tr>

					  <tr >
							<td style="border:none!important;padding: 10px!important;"></td>
					  </tr>
					  <tr class="ui-widget-header ui-dialog-titlebar">
							<td style="padding: 10px!important;color:white;text-align:center">Exigence de poste </td>
					  </tr>
					  <tr>
							<td style="padding: 0px!important;">
								<table>
									<tr>
										<td style="padding: 10px!important;font-weight:bold"><b>Niveau et domaine de formation académique et professionnelle, diplôme</b></td>
										<td style="padding: 10px!important;font-weight:bold"><b>Expérience professionnelle dans le domaine et/ou dans un poste semblable</b></td>
									</tr>

									<tr style="height:100px">
										<td style="padding: 10px!important;vertical-align:top">{$toFicheDePoste.fichePoste_exigenceNiveau|nl2br}</td>
										<td style="padding: 10px!important;vertical-align:top">{$toFicheDePoste.fichePoste_exigenceDiplome|nl2br}</td>
									</tr>
								</table>
							</td>
					  </tr>
				</table>
			</div>
		</fieldset>
	</form>

</div>
</div>
{literal}
<style>
tbody > tr:nth-of-type(odd) {
    background-color: white !important;
}

#fichedeposteFiche td {
    padding: 18px!important;
	font-size:13px!important;
    border: 1px solid #dddddd!important;
}

#fichedeposteFiche li {
	list-style-type: circle;
    padding: 10px;
    margin-left: 20px;
}
	

</style>
{/literal}
