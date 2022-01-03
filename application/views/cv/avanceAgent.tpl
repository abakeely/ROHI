{if sizeof($toAvancement)>0}
<br>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-3 libele_form" style="background:none; ">
			<label class="control-label ">Avancements successives</label>
	</div>
	<div class="col-md-6">
	<form action="">
		<fieldset>
			<table id="dataTables-example">
				<thead>
					<tr>
						<th style="text-align:center;">Code Corps</th>
						<th style="text-align:center;">Code Grade</th>
						<th style="text-align:center;">Date Effet</th>
					</tr>
				</thead>
				{assign var=iIncrement value="0"}
				{foreach from=$toAvancement item=oAvancement }
				<tr {if $iIncrement%2 == 0} class="even" {/if}>
					<td style="text-align:center;">{$oAvancement->corpsCode}</td>
					<td style="text-align:center;">{$oAvancement->gradeCode}</td>
					<td style="text-align:center;">{$oAvancement->avanceDate|date_format:"%d/%m/%Y"}</td>
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</table>
		</fieldset>
	</form>
	</div>
</div>

<script>

{literal}
$(document).ready(function() {
        /*$('#dataTables-example').dataTable();*/
	});
{/literal}
</script>
<style>
{literal}
td,th {
	padding:12px;
}
#dataTables-example_filter {
	display:none;
}

#dataTables-example_length {
	display:none;
}

#dataTables-example_info {
	display:none;
}
.col-sm-6 {
    width: 100%; 
    font-size: 14px;
    color: #333;
	text-align:center;
}
{/literal}
</style>
{/if}
				