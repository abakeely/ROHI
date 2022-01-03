{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Agent MFB à valider</a> <span></div>
	
    <section id="content">
        {include_php file=$zLeft}	
        <div id="ContentBloc">
			
			<h2>Liste de tous les agents</h2>
			<div class="contenuePage">	
				
				<form action="{$zBasePath}statistique/statistic_main" method="POST" style="height: 53px; padding: 9px;">
					<div class="col-md-4">
						<select name="selection" class="form-control">
							<option value="1">PAR DEPARTEMENT</option>
							<option value="2">PAR DIRECTION</option>
							<option value="3">PAR SERVICE</option>
							
							<option value="6">PAR STATUT</option>
							<option value="10">PAR CORPS</option>
							<option value="11">PAR GRADE</option>
							<option value="12">PAR INDICE</option>
							
							<option value="5">PAR SEXE</option>
							<option value="8">PAR SITUATION MATRIMONIAL</option>
							
							<option value="7">PAR DISTRICT</option>
							<option value="4">PAR REGION</option>
							<option value="9">PAR PROVINCE</option>	
						</select>
					</div>
					<div class="col-md-3">
							<button type="submit" class="form-control"> VOIR STATISTIQUE </button>
					</div>
					<div class="col-md-4"></div>
				</form>
				
				{if $oData.titreX}
				<!-- TABLEAU DE RESULTAT -->
					<br>
					<div class="row">
						<div class="row separateur"> <div class="col-md-12 titre_stat">Statistique des Agents selon leur {$oData.titreX}</div></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<table border="3" style="width:100%">
								<tr>
									<th class="cellStat centerStat"style="width:10px"><font size="4"><font face="Times New Roman">Ordre</font></font></th>
									<th class="cellStat centerStat" style="width:1000px"><font size="4"><font face="Times New Roman">Libele</font></font></th>
									<th class="cellStat centerStat" style="width:100px"><font size="4"><font face="Times New Roman">Nombre</font></font></th>
									<th class="cellStat centerStat" style="width:100px"><font size="4"><font face="Times New Roman">Pourcentage</font></font></th>
								</tr>
							
								{assign var=size value=$oData.data|@count}
								{assign var=cp value=0}
								{foreach from=$oData.data item=stat}
								{assign var=cp value=$cp+1}
									<tr>
										<td class="cellStat centerStat" style="width:10px"><font size="4"><font face="Times New Roman">{$cp}</font></font> </td>
										<td class="cellStat" style="width:1000px"><font size="4"><font face="Times New Roman">{if $stat.libele}{$stat.libele}{/if}</font></font></td>
										<td class="cellStat centerStat"style="width:100px"><font size="4"><font face="Times New Roman">{$stat.nb}</font></font </td>
										<td class="cellStat centerStat" style="width:100px"><font size="4"><font face="Times New Roman">{math equation="(x/y)*100" x=$stat.nb y=$oData.total assign=res} {$res|round:2}%</font></font></td>
									</tr>
								{/foreach}
								<tr>
									<td class="cellStat centerStat" colspan="2"><font size="4"><font face="Times New Roman">TOTAL</font></font></td>
									<td class="cellStat centerStat" ><font size="4"><font face="Times New Roman">{$oData.total}</font></font></td>
									<td class="cellStat centerStat"><font size="4"><font face="Times New Roman">100 %</font></font></td>
									<!-- <td class="cellStat centerStat"><?php echo ($stat['nb']*100); ?> %</td> -->
								</tr>
								
							</table>
						</div>
					</div>
					<br>
					<!-- GRAPHE -->
					<div class="row">
						<div class="col-md-12" id="graphe" style="width:1080px; height:1500px; position: relative; left: 0px; top: 0px;"></div>
					</div>
				{/if}
			</div>
		
		</div>
		<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
		<div id="calendar"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
	{if $oData.titreX}
	{literal}
		<script type="text/javascript">
			$(document).ready(function () {

				
				var sampleData = [
					{/literal}
					{assign var=size value=$oData.data|@count}
					{assign var=cp1 value="0"}
					{foreach from=$oData.data item=stat}
					{assign var=cp1 value=$cp1++}
					{literal}
					{ departement: '{/literal}{$cp}{literal}', nombre :{/literal}{$stat.nb}{literal} } 
					{/literal}
					{if $cp1!=$size},{/if} 
					{/foreach}
					{literal}
				]
				
				
				var settings = {
						title: "{/literal}{$oData.titreX}{literal}",
						description: "Statistique par {/literal}{$oData.titreX}{literal}",
						padding: { left: 5, top: 5, right: 5, bottom: 5 },
						titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
						source: sampleData,
						categoryAxis:
							{
								dataField: 'departement',
								showGridLines: false
							},
						colorScheme: 'scheme04',
						showToolTips: false,
						enableAnimations: true,
						seriesGroups:
							[
								{
									type: 'column',
									valueAxis:
									{
										minValue: 0,
										maxValue: {/literal}{$oData.max}{literal},
										unitInterval: {/literal}{math equation="x/y" x=$oData.max y=10 assign=res} {$res|round:2}{literal},
										description: 'Nombre'
									},

									series: [
											{ dataField: 'nombre', displayText: 'nombre' }
										]
								}
							]
					};
				// setup the chart
				//$('#graphe').jqxChart(settings);
			});
		</script>
	{/literal}
	{/if}
    {include_php file=$zFooter}
</div>
</body>
</html>