<div class="panel-body">
	<h3>Formations</h3>
	<div class="libele_form">
		<input type="hidden" value="{$oCandidatCv->diplome_list|@count}" id="size_diplome" data-original-title="" title="">
		<label class="control-label" data-original-title="" title=""><b>Diplômes Obtenus (Commencer par le plus récent) </b><b><font color="red"> * </font></b></label>
	</div>
	<div class="responsive-table-line">
		<div class="buttonForm" style="float:right!important;">
		<button style="width:200px;" type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy diplaoma" id="ajoutDiplome"> Ajouter un Diplôme</button>
		</div>
		<table class="table table-bordered  table-body-center" id="tableDiplome">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->diplome_list item=oDiplome}
				<tr id="diplome_row_{$iIncrement}">
						<td data-title="Diplomes" style="width:40%!important;text-transform: lowercase;">
							<input class="form-control " placeholder="Diplomes " type="text" name="diplome_name[]" value="{$oDiplome.diplome_name}" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" >
							<i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i>
							<i class="form-control-feedback" data-bv-icon-for="diplome_name[]" style="display: none; top: 0px;"></i>
						</td>
						<td data-title="Filière" style="width:20%!important">
						<input class="form-control" placeholder="Filière" type="text" name="diplome_discipline[]" value="{$oDiplome.diplome_disc}" data-toggle="tooltip" data-original-title="Soraty ny sampam-pianarana" ><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i><i class="form-control-feedback" data-bv-icon-for="diplome_discipline[]" style="display: none; top: 0px;"></i>
						</td>
						<td data-title="Date" style="width:10%!important">
							<input class="form-control input_date" maxlength="4" id="diplome_date_{$iIncrement}" onchange="testDate({$iIncrement})" placeholder="Année d`obtention" type="text" name="diplome_date[]" value="{$oDiplome.diplome_date}" data-toggle="tooltip" data-original-title="Soraty ny taona nahazoanao ilay mari-pahaizana" >
							<i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i>
							<i class="form-control-feedback" data-bv-icon-for="diplome_date[]" style="display: none; top: 0px;"></i>
						</td>
						<td data-title="Etablissement" style="width:20%!important">
							<input class="form-control " placeholder="Etablissement " type="text" name="diplome_etablissement[]" value="{$oDiplome.diplome_etab}" data-toggle="tooltip" data-original-title="Soraty ny toeram-pianarana nahazoanao ilay mari-pahaizana" >
							<i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i>
							<i class="form-control-feedback" data-bv-icon-for="diplome_etablissement[]" style="display: none; top: 0px;"></i>
						</td>
						<td data-title="Pays" style="width:10%!important">
							<input class="form-control" placeholder="Pays" type="text" name="diplome_pays[]" value="{$oDiplome.diplome_pays}" data-toggle="tooltip" data-original-title="Soraty ny anaran'ilay firenena nahazoanao ilay mari-pahaizana" >
							<i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i>
							<i class="form-control-feedback" data-bv-icon-for="diplome_pays[]" style="display: none; top: 0px;"></i>
						</td>
						<td data-title="Action" style="width:5%!important;border:none!important;">
						<a class="form-control" type="button" onclick="deleteDiplome({$iIncrement})"  style="border:none!important;">
							<img src="{$zBasePath}assets/img/projets/delete-icon-image.png" alt="" width="20px" height="20px" align="center"/>
						</a>
						</td>
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
	
<div class="panel-body">
	<h3>Stages</h3>
	<div class="libele_form" >
		<input type="hidden" value="{$oCandidatCv->stage_list|@count}" id="size_stage"/>   
		<label class="control-label" data-original-title="" title="">
			<b>Stages et formations professionnelles de courte durée (Commencer par le plus r&eacute;cent) </b>
		</label>
	</div>
	<div class="responsive-table-line">
		<div class="buttonForm" style="float:right!important;">
			<button style="width:200px;" type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy stage" id="ajoutStage"> Ajouter Stage</button>
		</div>
		<table class="table table-bordered  table-body-center" id="tableStage">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->stage_list item=oStage}
				<tr id="stage_row_{$iIncrement}">
						<td style="width:40%!important">
							<input style="border: 1px solid #626D71 !important;" class="form-control" placeholder="Thème de stage" type="text" name="stage_name[]" data-toggle="tooltip" data-original-title= "Soraty ny ..">{$oStage.stage_name}</input>
						</td>
						<td style="width:20%!important">
							<input class="form-control" placeholder="Etablissement d'accueil" type="text" name="stage_etablissement[]" value="{$oStage.stage_etablissement}" data-toggle="tooltip" data-original-title= "Soraty ny..."/>
						</td>
						<td style="width:10%!important">
							<input class="form-control" placeholder="Annee" type="text" name="stage_annee[]" value="{$oStage.stage_annee}" data-toggle="tooltip" data-original-title= "Soraty ny ..."/>
						</td>
						<td style="width:20%!important">
							<input class="form-control" placeholder="Pays" type="text" name="stage_pays[]" value="{$oStage.stage_pays}" data-toggle="tooltip" data-original-title= "Soraty ny ..."/>
						</td>
						<td style="width:5%!important">
							<a  onclick="deleteStage({$iIncrement})">
								<img src="{$zBasePath}assets/img/projets/delete-icon-image.png" alt="" width="20px" height="20px" align="center"/>
							</a>
						</td>   
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
	
<div class="panel-body">
	<h3>Parcours</h3>
	<div class="libele_form">
		<input type="hidden" value="{$oCandidatCv->parcours_list|@count}" id="size_parcours"/>   
		<label class="control-label" data-original-title="" title=""><b>Parcours (Commencer par votre poste actuel)</b><b><font color="red"> * </font></b></label>
	</div>
	<div class="form-group responsive-table-line">
		<div class="buttonForm" style="float:right!important;">
			<button style="width:200px;" type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy stage" id="ajoutParcours"> Ajouter Parcours</button>
		</div>
		<table class="table table-bordered  table-body-center" id="tableParcours">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->parcours_list item=oParcours}
				<tr id="stage_row_{$iIncrement}">
						<td style="width:10%!important">
							<input class="form-control input_date"maxLength="4" style="border: 1px solid #626D71 !important;" id="date_debut_{$iIncrement}" onChange="testDate({$iIncrement})" placeholder="Ann&eacute;e / D&eacute;but" type="text" name="date_debut[]" value="{$oParcours.date_debut}" data-toggle="tooltip" data-original-title= "Soraty ny taona nanombohanao niasa tao amin'ny sampan-draharaha"/>
						</td>
						<td style="width:10%!important">
							<input class="form-control input_date" maxLength="4" style="border: 1px solid #626D71 !important;"  id="date_fin_{$iIncrement}" onChange="testDate({$iIncrement})" placeholder="Ann&eacute;e / Fin" type="text" name="date_fin[]" value="{$oParcours.date_fin}" data-toggle="tooltip" data-original-title= "Soraty ny taona farany niasanao tao amin'ny sampandraharaha"/>
						</td>
						<td style="width:40%!important">
							<input class="form-control" placeholder="Poste" type="text" name="par_poste[]" style="border: 1px solid #626D71 !important;" data-toggle="tooltip" data-original-title= "Soraty ny asa na andraikitra nosahaninao" value="{$oParcours.par_poste}">
						</td>
						<td style="width:20%!important">
							<input class="form-control" placeholder="Departement" style="border: 1px solid #626D71 !important;" type="text" name="par_departement[]" value="{$oParcours.par_departement}" data-toggle="tooltip" data-original-title= "Soraty ny Departemanta na sampan-draharaha  misy anao"/>
						</td>
						<td style="width:5%!important">
							<a onclick="deleteParcours({$iIncrement})">
								<img src="{$zBasePath}assets/img/projets/delete-icon-image.png" alt="" width="20px" height="20px" align="center"/>
							</a>
						</td>   
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
	<div class="libele_form" style="background:none;">
		<label class="control-label" data-original-title="" title=""><b>Autres </b></label>
	</div>
	<div class="form">
		<textarea name="autre_domaine" id="autre_domaine" class="form-control" rows="3" data-toggle="tooltip" data-original-title="Soraty  raha manana traikela lanampiny ianao">{$oCandidatCv->autre_domaine}</textarea>
	</div>
</div>




<div class="aide"> <u>Exemple </u>:
	permis de conduire ,
	formation premier secours
</div>
{literal}
<style>
	#tableStage .btn_close,#tableParcours .btn_close{
			width : 35px;
	}
</style>
{/literal}
