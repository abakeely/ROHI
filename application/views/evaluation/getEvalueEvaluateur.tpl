<style>
	{literal}
	table {
		border-collapse: collapse;
	}

	table, th, td {
		border: 1px solid black;
	}
	{/literal}
</style>

<table>
	<thead>
		<tr>
			<th>Evaluateur</th> 
			<th>Evalue</th>
		</tr>
	</thead>
	<tbody>
		{assign var=iIncrement value="0"}
		{foreach from=$oEvaluateur item=zEvaluateur }
			{foreach from = $oEvalue[$iIncrement] item=zEvalue}
			<tr>
				<td>{$zEvaluateur}</td>
				<td>{$zEvalue}</td>
			</tr>
			{/foreach}
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
	</tbody>
</table>