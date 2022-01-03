<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main_save.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/select2.min.js"></script>
<input type="hidden" id="iBadgeId" name="iBadgeId" value="{$iBadgeId}">
<input type="hidden" id="iUserSave" name="iUserSave" value="{$iUserId}">
<table>
	<tr>
		<td style="width:40%">
			<label>Date d'obtention badge</label>
		</td>
		<td>
			<input type="text" name="zDateEntrer" id="zDateEntrer" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" value="" placeholder="s&eacute;l&eacute;ctionner la date d'entrer" class="withDatePicker obligatoire">
		<td>
	</tr>
</table>
