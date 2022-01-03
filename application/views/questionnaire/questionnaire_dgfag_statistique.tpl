	<div class="col-xs-6  wizard-question wizard-stat ">
		<div class="row">
			<div class="form col-md-5 ">
				<div class="libele_form">
					<label class="control-label label_questionnaire " data-original-title="" title=""><b>Filtre Par(*) </b></label>
				</div>
				<select id="quizz_referentiel_groupe" class="form-control" placeholder="Nom du conjoint"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nom du conjoint" onchange="getReferentiel($(this))">
					<option value="0">--Choisir--</option>
					<option value="DEPT">Departement</option>
					<option value="DIR">Direction</option>
					<option value="SCE">Service</option>
					<option value="FONC">Fonction</option>
					<option value="AGE">Trance d'âge</option>
				</select>
			</div>
			<div class="form col-md-6">
				<div class="libele_form">
					<label class="control-label label_questionnaire " data-original-title="" title=""><b>Type(*) </b></label>
				</div>
				<select id="quizz_referentiel_value" class="form-control" placeholder="Nom du conjoint"  name="" data-placement="top" data-toggle="tooltip" data-original-title="Nom du conjoint" onchange="showStastistique($(this))">
					<option value="0">--Choisir--</option>
				</select>
			</div>
		</div>
		<div class="row">
			<table id="jqGridStat"></table>
			<div id="jqGridPagerStat"></div>
		</div>
	</div>
	<div class="col-xs-5">
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	</div>

<input type="hidden" id="column_selected" value="DGAI">
<div id="template_referentiel" style="display:none;" >
	<option value="[[data.quizz_referentiel_value]]">[[data.quizz_referentiel_libelle_fr]]</option>
</div>
{literal}
<style>
	#source_donnee{
		font-size: 14px;
		margin: 20px;
	}
</style>
<script>

$(document).ready(function() {
});


</script>
{/literal}
</body>
</html>