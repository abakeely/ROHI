
{foreach from=$oEvalueStat item=oEvalue}
<tr>
	<td>{$oEvaluateur[$id]}</td>
	<td>{$oEvalue.iUserId}</td>
	{if $oEvalue.oNote}
		<td>{$oEvalue.oNote[4].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[1].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[2].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[3].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[5].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[6].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[7].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[8].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[9].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[10].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[11].fMoyenneNote}</td>
		<td>{$oEvalue.oNote[12].fMoyenneNote}</td>
	{else}
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	{/if}
</tr>
{/foreach}
	