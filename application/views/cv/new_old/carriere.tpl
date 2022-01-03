 <div class="panel-body">
	<!----------------- bloc Toogle ---------------->
	<h3>Carrieres</h3>

	
	<div class="libele_form">
		<label class="control-label " data-original-title="" title="">Avancement</label>
	</div>
	<div class="form">

		<fieldset>
			<table id="dataTables-example">
				<thead>
				<tr>
					<th style="text-align:center;">Code Corps</th>
					<th style="text-align:center;">Code Grade</th>
					<th style="text-align:center;">Date Effet</th>
				</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($toAvancement)>0}
					{foreach from=$toAvancement item=oAvancement }
						<tr {if $iIncrement%2 == 0} class="even" {/if}>
							<td style="text-align:center;">{if isset($oAvancement->corps_code)}{$oAvancement->corps_code}{/if}</td>
							<td style="text-align:center;">{if isset($oAvancement->grade_code)}{$oAvancement->grade_code}{/if}</td>
							<td style="text-align:center;">{if isset($oAvancement->avance_date)}{$oAvancement->avance_date|date_format:"%d/%m/%Y"}{/if}</td>
						</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{/if}
				</tbody>
			</table>
		</fieldset>
	</div>

	<div class=" message"></div>
	<!----------------- Fin bloc Toogle ---------------->
</div>