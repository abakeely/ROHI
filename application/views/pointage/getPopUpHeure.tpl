<input type="hidden" id="iInOutId" name="iInOutId" value="{$iInOutId}">
<input type="hidden" id="iUserSave" name="iUserSave" value="{$iUserId}">
<table>
	<h2>{$oCandidat.0->nom}&nbsp;{$oCandidat.0->prenom}</h2>
	<tr>
		<td style="width:30%">
			<label>Heure de sortie</label>
		</td>
		<td>
			<select id="heure_sortie" name="heure_sortie" style="width:20%;display:inline">
			{section name=iAnnee start=0 loop=24 step=1}
			<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
			{/section}
			</select>
			<label style="display:inline">&nbsp;:&nbsp;</label>
			<select id="minute_sortie" name="minute_sortie" style="width:20%;display:inline">
			{section name=iAnnee start=0 loop=60 step=1}
			<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
			{/section}
			</select>
			<label style="display:inline">&nbsp;:&nbsp;</label>
			<select id="seconde_sortie" name="seconde_sortie" style="width:20%;display:inline">
			{section name=iAnnee start=0 loop=60 step=1}
			<option value="{$smarty.section.iAnnee.index|string_format:"%02d"}">{$smarty.section.iAnnee.index|string_format:"%02d"}&nbsp;&nbsp;</option>
			{/section}
			</select>
		<td>
	</tr>
</table>
