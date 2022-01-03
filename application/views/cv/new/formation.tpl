<div class="panel-body">
	<h3>Formations</h3>

	<!--                                        Contents-->

	<div class="libele_form">
		<input type="hidden" value="{$oCandidatCv->diplome_list|@count}" id="size_diplome" data-original-title="" title="">
		<label class="control-label" data-original-title="" title=""><b>Diplômes Obtenus (Commencer par le plus récent) </b><b><font color="red"> * </font></b></label>
	</div>
	<div class="form-group">
		<table class="tableau" id="tableDiplome">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->diplome_list item=oDiplome}
				<tr id="diplome_row_{$iIncrement}">
						<td>
						<textarea style="border: 1px solid #626D71 !important;" class="form-control" placeholder="Diplomes" type="text" name="diplome_name[]" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany">{$oDiplome.diplome_name}</textarea>
						<i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i></td>
						<td><input class="form-control" placeholder="Filière" type="text" name="diplome_discipline[]" value="{$oDiplome.diplome_disc}" data-toggle="tooltip" data-original-title="Soraty ny sampam-pianarana" ><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i></td>
						<td><input class="form-control myYearFormation input_date" data-dd-opt-format="Y" data-dd-opt-preset="onlyYear" placeholder="yyyy" readonly="true" maxlength="4" id="diplome_date_{$iIncrement}"  onchange="testDate({$iIncrement})" placeholder="Année d`obtention" type="text" name="diplome_date[]" value="{$oDiplome.diplome_date}" data-dd-opt-default-date="{$oDiplome.diplome_date}" data-toggle="tooltip" data-original-title="Soraty ny taona nahazoanao ilay mari-pahaizana" ><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i></td>
						<td><input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="{$oDiplome.diplome_etab}" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" ><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i></td>
						<td><input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="{$oDiplome.diplome_pays}" data-toggle="tooltip" data-original-title="Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana" ><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i></td>
				
					<td><button class="form-control btn_close" type="button" onclick="deleteDiplome({$iIncrement})"><i class="la la-close"></i></button></td>   
					
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>

	<div class="buttonForm">
		<button type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy diplaoma" id="ajoutDiplome"> Ajouter un Diplôme</button>
	</div>
	
	<div class="libele_form">
		<input type="hidden" value="{$oCandidatCv->stage_list|@count}" id="size_stage"/>   
		<label class="control-label" data-original-title="" title=""><b>Stages et formations professionnelles 
							de courte durée (Commencer par le plus r&eacute;cent) </b></label>
	</div> 
	<div class="form-group">
		<table class="tableau" id="tableStage">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->stage_list item=oStage}
				<tr id="stage_row_{$iIncrement}">
						<td><textarea style="border: 1px solid #626D71 !important;" class="form-control" placeholder="Thème de stage" type="text" name="stage_name[]" data-toggle="tooltip" data-original-title= "Soraty ny ..">{$oStage.stage_name}</textarea></td>
						<td><input class="form-control" placeholder="Etablissement d'accueil" type="text" name="stage_etablissement[]" value="{$oStage.stage_etablissement}" data-toggle="tooltip" data-original-title= "Soraty ny..."/></td>
						<td><input class="form-control myYearFormation" placeholder="Annee" type="text" name="stage_annee[]" data-dd-opt-format="Y" data-dd-opt-preset="onlyYear" placeholder="yyyy" readonly="true"  data-dd-opt-default-date="{if $oStage.stage_annee!=""}{$oStage.stage_annee}{else}{$smarty.session.zDateToDayDefault}{/if}"  value="{$oStage.stage_annee}" data-toggle="tooltip" data-original-title= "Soraty ny ..."/></td>
						<td><input class="form-control" placeholder="Pays" type="text" name="stage_pays[]" value="{$oStage.stage_pays}" data-toggle="tooltip" data-original-title= "Soraty ny ..."/></td>
					<td><button class="form-control btn_close" type="button" onclick="deleteStage({$iIncrement})"><i class="la la-close"></i></button></td>   
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
	<div class="buttonForm">
		<button type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy stage" id="ajoutStage"> Ajouter Stage</button>
	</div>
	
	<div class="libele_form">
		<input type="hidden" value="{$oCandidatCv->parcours_list|@count}" id="size_parcours"/>   
		<label class="control-label" data-original-title="" title=""><b>Parcours (Commencer par votre poste actuel)</b><b><font color="red"> * </font></b></label>
	</div> 
	<div class="form-group">
		<table class="tableau" id="tableParcours">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->parcours_list item=oParcours}
				<tr id="parcours_row_{$iIncrement}">
					<td><input class="form-control myYearFormation input_date"maxLength="4" data-dd-opt-format="Y" data-dd-opt-preset="onlyYear" placeholder="yyyy" readonly="true"  data-dd-opt-default-date="{$oParcours.date_debut}"  style="border: 1px solid #626D71 !important;" id="date_debut_{$iIncrement}" onChange="testDate({$iIncrement})" placeholder="Ann&eacute;e / D&eacute;but" type="text" name="date_debut[]" value="{$oParcours.date_debut}" data-toggle="tooltip" data-original-title= "Soraty ny taona nanombohanao niasa tao amin'ny sampan-draharaha"/></td>
					<td><input class="form-control input_date" maxLength="4" style="border: 1px solid #626D71 !important;"  id="date_fin_{$iIncrement}" onChange="testDate({$iIncrement})" placeholder="Ann&eacute;e / Fin" type="text" name="date_fin[]" value="{$oParcours.date_fin}" data-toggle="tooltip" data-original-title= "Soraty ny taona farany niasanao tao amin'ny sampandraharaha"/></td>
					<td>
					<textarea class="form-control" placeholder="Poste" type="text" name="par_poste[]" style="border: 1px solid #626D71 !important;" data-toggle="tooltip" data-original-title= "Soraty ny asa na andraikitra nosahaninao">{$oParcours.par_poste}</textarea>
					<td><input class="form-control" placeholder="Departement" style="border: 1px solid #626D71 !important;" type="text" name="par_departement[]" value="{$oParcours.par_departement}" data-toggle="tooltip" data-original-title= "Soraty ny Departemanta na sampan-draharaha  misy anao"/></td>
					<td><button class="form-control btn_close" type="button" onclick="deleteParcours({$iIncrement})"><i class="la la-close"></i></button></td>   
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
	<div class="buttonForm">
		<button type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy stage" id="ajoutParcours"> Ajouter Parcours</button>
	</div>
	<div class="libele_form" style="background:none;">
		<label class="control-label" data-original-title="" title=""><b>Autres </b>
		</label>
	</div>
	<div class="form">
		<textarea name="autre_domaine" id="autre_domaine" class="form-control" rows="5" data-toggle="tooltip" data-original-title="Soraty  raha manana traikela lanampiny ianao">{$oCandidatCv->autre_domaine}</textarea>
	</div>
	<div class="aide"> <u>Exemple </u>:
		permis de conduire ,
		formation premier secours
	</div>
	<!--                                        Contents-->
	{literal}
	<style>
		#tableStage .btn_close,#tableParcours .btn_close{
			width : 35px;
		}
	</style>
	{/literal}

</div>
{literal}
<script>

new dateDropper({
  selector: '.myYearFormation',
  format: '2021',
  defaultDate: true,
  expandable: false,
  onChange: function (res) {
	getListeRecap();
  }
});
</script>

{/literal}