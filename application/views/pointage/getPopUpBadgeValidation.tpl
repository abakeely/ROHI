<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main_save.js"></script>
<input type="hidden" id="iBadegId" name="iBadegId" value="{$iBadegId}">
<table>
	<h2>Validation carte</h2>
	<tr>
		<td style="width:30%">
			<label>Numéro décharge validation</label>
		</td>
		<td>
			<input type="text" name="zNumDechargeValidation" id="zNumDechargeValidation" value="" placeholder="Numéro décharge" class="obligatoire">
		<td>
	</tr>
	<tr>
		<tr>
		<td style="width:30%">
			<label>Date validation carte</label>
		</td>
		<td>
			<input type="text" name="zDateEntrer" id="zDateEntrer" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" value="" placeholder="s&eacute;l&eacute;ctionner la date d'entrer" class="withDatePicker obligatoire">
		<td>
	</tr>
	</tr>
</table>
