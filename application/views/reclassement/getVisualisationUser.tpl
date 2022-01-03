<table id="getVIsualisation">
	<tr>
	<td>
		<form action="">
			<fieldset>
				<table>
					<tr class="notAffiche">
						<td style="color:green;"><i style="color:green;font-size:20px;" class="la la-info-circle" aria-hidden="true"></i>&nbsp;<strong>Information sur le reclassement demandé </strong></td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Institut : </strong>{$oInfoReclassement.0.institut_libelle}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Diplôme : </strong>{$oInfoReclassement.0.diplome_libelle}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Domaine : </strong>{$oInfoReclassement.0.reclassement_domaine}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Nom et prénom : </strong>{$oInfoReclassement.0.nom}&nbsp;{$oInfoReclassement.0.prenom}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Matricule : </strong>{$oInfoReclassement.0.matricule}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Type de dossier : </strong>{$oInfoReclassement.0.typeReclassement_libelle}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Département : </strong>{$oInfoReclassement.0.departement}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Direction : </strong>{$oInfoReclassement.0.direction}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Service : </strong>{$oInfoReclassement.0.service}</td>
					</tr>
					<tr class="notAffiche">
						<td><strong>Agent Traiteur de dossier : </strong>{$oInfoReclassement.0.responsable}</td>
					</tr>
					{if $oInfoReclassement.0.reclassement_userAutoriteId || $oInfoReclassement.0.reclassement_autoriteSaisi!=''}
					<tr class="notAffiche">
						<td><strong>Validé par : </strong>{if $oInfoReclassement.0.autorite!=''}{$oInfoReclassement.0.autorite}{else}{$oInfoReclassement.0.reclassement_autoriteSaisi}{/if}</td>
					</tr>
					{/if}
					<tr class="notAffiche">
						<td style="border:none;">&nbsp;</td>	
					</tr>
					
				</table>
			</fieldset>
		</form>
	</td>
	<td>
		<table>
			{if sizeof($oCircuitReclassement)>0}
			<tr>
				<td style="color:green;"><i style="color:green;font-size:15px;" class="la la-hand-o-right" aria-hidden="true">&nbsp;</i><strong>Etat de circuit de dossier</strong></td>
			</tr>

			{foreach from=$oCircuitReclassement item=oCircuitReclassement }
			<tr class="notAffiche">
				<td><i style="color:orange;font-size:15px;" class="la la-folder" aria-hidden="true"></i>&nbsp;{$oCircuitReclassement->suivi_libelle}&nbsp;du&nbsp;{$oCircuitReclassement->circuitReclassement_date|date_format:"%d/%m/%Y"}</td>
			</tr>
			{/foreach}
			{/if}
			<tr class="notAffiche">
				<td style="border:none;">&nbsp;</td>	
			</tr>
			{if sizeof($oPiecesJointesManquante)>0}
			<tr class="notAffiche">
				<td style="color:green;"><i style="color:green;font-size:15px;" class="la la-hand-o-right" aria-hidden="true">&nbsp;</i><strong>Pièces manquantes </strong></td>
			</tr>
			{foreach from=$oPiecesJointesManquante item=oPiecesJointesManquante }
			<tr class="notAffiche">
				<td><i style="color:blue;font-size:20px;" class="la la-paperclip" aria-hidden="true"></i>&nbsp;{$oPiecesJointesManquante->pieceJointe_libelle}</td>
			</tr>
			{/foreach}
			{/if}
		</table>
	</td>
	</tr>
</table>
{literal}
<style>
#getVIsualisation td {font-size:1em;}
</style>
{/literal}
