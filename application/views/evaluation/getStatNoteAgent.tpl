<!DOCTYPE html>
<?php
header('Access-Control-Allow-Origin : *');
?>
<html>
<head>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
</head>
<body>

<button type="button" style="postion : sticky ; float : right; width : 150px ; height : 50px;" id="button">STOP</button>

<table>
	<thead>
		<tr>
			<th>Evaluateur</th> 
			<th>Agent</th>
			<th>4T-2016-2017</th>
			<th>1T-2017</th>
			<th>2T-2017</th>
			<th>3T-2017</th>
			<th>1T-2018</th>
			<th>2T-2018</th>
			<th>3T-2018</th>
			<th>4T-2018</th>
			<th>1T-2019</th>
			<th>2T-2019</th>
			<th>3T-2019</th>
			<th>4T-2019</th>
			<th>1T-2020</th>
		</tr>
	</thead>
	<tbody id="tableBody">
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
			<td>{$oEvalue.oNote[13].fMoyenneNote}</td>
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
			<td></td>
			{/if}
		</tr>
		{/foreach}
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
<script>
	$(document).ready(function (){
	var id = {/literal}{$id}{literal};
	var sizeTable = {/literal}{$oEvaluateur|@count}{literal};
		var intervalID = setInterval(function () {

			id++;
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}evaluation/getPortionStat/"+id,
				type: 'get',
				success: function(data, textStatus, jqXHR) {
					
					//$("#dialog").html(data);	
					$("#tableBody").append( data );
					
				},
				async: false
			});

		   if (id >= sizeTable) {
			   window.clearInterval(intervalID);
			   alert('Termine');
		   }
		}, 2000);
			
		$("#button").click(function(){
			window.clearInterval(intervalID);
			alert('STOPPED');
		})	
		
	});
</script>
{/literal}
</body>
</html>