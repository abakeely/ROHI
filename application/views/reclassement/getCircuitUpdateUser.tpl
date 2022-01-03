<script src="{$zBasePath}assets/reclassement/js/custom-file-input.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main_save.js"></script>

<table id="getVIsualisation">
	<tr>
	<td>
			<form id="getCircuitUpdateUser" method="POST" action="{$zBasePath}reclassement/save/gestion-reclassement/suivis-et-circuits" enctype="multipart/form-data">
			<input type="hidden" name="iReclassementId" id="iReclassementId" value="{$iReclassementId}">
			<fieldset>
				<table>
					<tr class="notAffiche">
						<td colspan="3" style="color:green;"><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Information sur le reclassement demandé </strong></td>
					</tr>
					<tr class="notAffiche">
						<td colspan="3"><strong>Nom et prénom : </strong>{$oInfoReclassement.0.nom}&nbsp;{$oInfoReclassement.0.prenom}</td>
					</tr>
					<tr class="notAffiche">
						<td colspan="3"><strong>Matricule : </strong>{$oInfoReclassement.0.matricule}</td>
					</tr>
					<tr class="notAffiche">
						<td colspan="3" style="color:green;"><i style="color:green;font-size:20px;" class="la la-hand-o-right" aria-hidden="true">&nbsp;</i><strong>Pièces jointes </strong></td>
					</tr>
					{foreach from=$oCircuitDossier1 item=oCircuitDossier }
					<tr class="notAffiche">
						<td style="width:50%"><input type="checkBox" class="suiviClass" iSuiviId="{$oCircuitDossier->suivi_id}" {if $oCircuitDossier->circuitReclassement_suiviId!=''}checked="checked"{/if} name="suiviCircuit_{$oCircuitDossier->suivi_id}" id="suiviCircuit_{$oCircuitDossier->suivi_id}" value="1">&nbsp;<span id="contentLibelle_{$oCircuitDossier->suivi_id}">{$oCircuitDossier->suivi_libelle}</span>&nbsp;
						</td>
						<td>
							<span class="span_{$oCircuitDossier->suivi_id}" {if $oCircuitDossier->circuitReclassement_suiviId!=''}style="display:block"{else}style="display:none"{/if}>Date : <input type="text" style="width:150px" name="dateSuivi_{$oCircuitDossier->suivi_id}" id="dateSuivi_{$oCircuitDossier->suivi_id}" value="{$oCircuitDossier->circuitReclassement_date|date_format:"%d/%m/%Y"}" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oCircuitDossier->circuitReclassement_date|date_format2}" class="withDatePicker obligatoire"></span>
						</td>
						<td style="width:30%">
							<span class="span_{$oCircuitDossier->suivi_id}" {if $oCircuitDossier->circuitReclassement_suiviId!=''}style="display:block"{else}style="display:none"{/if}>Réf : 
							<textarea name="referenceSuivi_{$oCircuitDossier->suivi_id}" style="width:250px;vertical-align:middle;" id="referenceSuivi_{$oCircuitDossier->suivi_id}">{$oCircuitDossier->circuitReclassement_reference|utf8}</textarea>
							
							</span>
						</td>
					</tr>
					{/foreach}
					
				</table>
			</fieldset>
			</form>
		
	</td>
	</tr>
</table>
{literal}
<style>
#getVIsualisation td {font-size:1em;}
input[type=checkbox]{height:18px;width:18px;vertical-align:middle}

</style>
<script>
$(document).ready (function ()
{
	$('.suiviClass').click(function(){
		
		var iValue = $(this).is(':checked');  
		var iSuiviId = $(this).attr('iSuiviId'); 

		switch (iValue) {
			case true:
				$(".span_"+iSuiviId).show();
				break;

			case false:
				$(".span_"+iSuiviId).hide();
				break;
		}

		
	});  
});
</script>
{/literal}
		