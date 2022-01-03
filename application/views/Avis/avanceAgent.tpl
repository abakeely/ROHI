{include_php file=$zHeader }
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
	</div>
	<div id="innerContent">
		<h3>Avancement</h3>
		
            <table>
                <tr>
				<td style="width:40%">
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
								{foreach from=$oData.toAvancement item=oAvancement }
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
				</td>
				<td style="width:50%">&nbsp;</td>
				</tr>
            </table>
	</div>
</section>
<input type="hidden" name="zUrlFiche" id="zUrlFiche" value="{$zBasePath}avis/fiche/titre-de-paiement">
<input type="hidden" name="zUrlImpression" id="zUrlImpression" value="{$zBasePath}avis/imprimer/titre-de-paiement">
<script>

{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
</script>
<style>
{literal}

.col-sm-6 {
    width: 100%; 
    font-size: 14px;
    color: #333;
	text-align:center;
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
div.separateur {

	background-image: radial-gradient(#97B2A5,#327870)!important;
	width:100%;
	height:22px;
}

#dataTables-example_paginate {
	float:right;
	/*padding-right:150px;*/
}

div.separateur .col-md-12 {

	color: white;
	font-size: 0.8em;
	font-weight: bold;
	
}
.separateur {
    height: 4rem;
    background: #91c149;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    padding-top: 0.7rem;
    margin-right: 0!important;
}
table {
	font-size:12px!important;
}
{/literal}
</style>
{include_php file=$zFooter}