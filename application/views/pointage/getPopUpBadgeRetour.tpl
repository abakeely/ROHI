<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main_save.js"></script>
<input type="hidden" id="iBadegId" name="iBadegId" value="{$iBadegId}">
<table>
	<h2>Retour Badge</h2>
	<tr>
		<td style="width:30%">
			<label>Numéro décharge retour Carte</label>
		</td>
		<td>
			<input type="text" name="zNumDechargeRetour" id="zNumDechargeRetour" value="" placeholder="Numéro décharge" class="obligatoire">
		<td>
	</tr>
	<tr>
		<td style="width:30%">
			<label>Date retour badge</label>
		</td>
		<td>
			<input type="text" name="zDateEntrer" id="zDateEntrer" value="" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" placeholder="s&eacute;l&eacute;ctionner la date d'entrer" class="withDatePicker obligatoire">
		<td>
	</tr>
</table>
