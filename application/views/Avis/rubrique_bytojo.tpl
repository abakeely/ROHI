{include_php file=$zHeader }
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}	
	</div>
	<div id="innerContent">
		<div id="ContentBloc">
		<h3>Aide rubrique</h3>
            <table>
                <tr>
				<td style="width:22%">
					<form action="">
						<fieldset>
							<table>
								{section name=i loop=$oData.toRubrique}
								{if $smarty.section.i.iteration <= 40}
								<tr>
									<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
									<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
								<tr>
								{/if}
								{/section}
							</table>
						</fieldset>
					</form>
				</td>
				<td style="width:22%">
					<form action="">
						<fieldset>
							<table>
								{section name=i loop=$oData.toRubrique}
								{if $smarty.section.i.iteration > 40 and  $smarty.section.i.iteration < 80}
								<tr>
									<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
									<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
								<tr>
								{/if}
								{/section}
							</table>
						</fieldset>
					</form>
				</td>
				<td style="width:25%">
					<form action="">
						<fieldset>
							<table>
								
								{section name=i loop=$oData.toRubrique}
								{if $smarty.section.i.iteration > 80 and  $smarty.section.i.iteration < 120}
								<tr>
									<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
									<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
								<tr>
								{/if}
								{/section}
							</table>
						</fieldset>
					</form>
				</td>
				<td style="width:25%">
					<form action="">
						<fieldset>
							<table>
								
								{section name=i loop=$oData.toRubrique}
								{if $smarty.section.i.iteration > 120}
								<tr>
									<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
									<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
								<tr>
								{/if}
								{/section}
							</table>
						</fieldset>
					</form>
				</td>
				</tr>
            </table>
	</div>
	<div id="calendar"></div>
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
td {
padding:5px;
}
{/literal}
</style>
{include_php file=$zFooter}