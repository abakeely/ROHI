<table class="table">
	{foreach from=$oData.list item=record}
				<tr>
					<td>{$record.agent_nom}</td>
					<td>{$record.agent_prenoms}</td>
					<td>{$record.corps_code}</td>
					<td>{$record.soa}</td>
				</tr>
	{/foreach}
<table>
