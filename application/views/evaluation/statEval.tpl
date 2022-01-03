<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
</head>
<body>


<table>
	<thead>
		<tr>
			<th>Region</th>
			<th>4T-2016-2017</th>
			<th>1T-2017</th>
			<th>2T-2017</th>
			<th>3T-2017</th>
			<th>1T-2018</th>
			<th>2T-2018</th>
			<th>3T-2018</th>
			<th>4T-2018</th>
			<th>1T-2019</th>
		</tr>
	</thead>
	<tbody id="tableBody">
		{foreach from=$toRegion item=oRegion}
		{assign var="zStr" value="iTotalRegion"|cat:$oRegion.id}
		{assign var="zStrP" value="iPourcentRegion"|cat:$oRegion.id}
		<tr>
			<td>{$oRegion.libele}</td>
			<td>{$oPeriode[4].$zStr} ({$oPeriode[4].$zStrP}%)</td>
			<td>{$oPeriode[1].$zStr} ({$oPeriode[1].$zStrP}%)</td>
			<td>{$oPeriode[2].$zStr} ({$oPeriode[2].$zStrP}%)</td>
			<td>{$oPeriode[3].$zStr} ({$oPeriode[3].$zStrP}%)</td>
			<td>{$oPeriode[5].$zStr} ({$oPeriode[5].$zStrP}%)</td>
			<td>{$oPeriode[6].$zStr} ({$oPeriode[6].$zStrP}%)</td>
			<td>{$oPeriode[7].$zStr} ({$oPeriode[7].$zStrP}%)</td>
			<td>{$oPeriode[8].$zStr} ({$oPeriode[8].$zStrP}%)</td>
			<td>{$oPeriode[9].$zStr} ({$oPeriode[9].$zStrP}%)</td>
		</tr>
		{/foreach}
		<tr>
			<td>Total</td>
			<td>{$oPeriode[4].iTotal}</td>
			<td>{$oPeriode[1].iTotal}</td>
			<td>{$oPeriode[2].iTotal}</td>
			<td>{$oPeriode[3].iTotal}</td>
			<td>{$oPeriode[5].iTotal}</td>
			<td>{$oPeriode[6].iTotal}</td>
			<td>{$oPeriode[7].iTotal}</td>
			<td>{$oPeriode[8].iTotal}</td>
			<td>{$oPeriode[9].iTotal}</td>
		</tr>
	</tbody>
</table>
{literal}
<style>
	table {
		border-collapse: collapse;
	}

	table, th, td {
		border: 1px solid black;
	}
</style>

{/literal}
</body>
</html>