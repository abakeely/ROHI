<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/main_save.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/pointage/js/app/select2.min.js"></script>
<input type="hidden" id="iMissionId" name="iMissionId" value="{$iMissionId}">
<input type="hidden" id="iUserSave" name="iUserSave" value="{$iUserId}">
<table>
	<h2>{$oCandidat.0->nom}&nbsp;{$oCandidat.0->prenom}</h2>
	<tr>
		<td style="width:30%">
			<label>Date d'entr&eacute;e</label>
		</td>
		<td>
			<input type="text" name="zDateEntrer" id="zDateEntrer" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" value="" placeholder="s&eacute;l&eacute;ctionner la date d'entrer" class="withDatePicker obligatoire">
		<td>
	</tr>
	<tr>
		<td style="width:30%">
			<label>Heure d'entr&eacute;e</label>
		</td>
		<td>
			<select id="heure_entree" name="heure_entree" style="width:20%;display:inline">
			{section name=iAnnee start=8 loop=17 step=1}
			<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
			{/section}
			</select>
			<label style="display:inline">&nbsp;:&nbsp;</label>
			<select id="minute_entree" name="minute_entree" style="width:20%;display:inline">
			{section name=iAnnee start=0 loop=60 step=1}
			<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
			{/section}
			</select>
			<label style="display:inline">&nbsp;:&nbsp;</label>
			<select id="seconde_entree" name="seconde_entree" style="width:20%;display:inline">
			{section name=iAnnee start=0 loop=60 step=1}
			<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
			{/section}
			</select>
		<td>
	</tr>
</table>
