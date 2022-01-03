{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
        <div id="ContentBloc">
			
			<h2>Mouvement</h2>
			<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Agent MFB à valider</a> <span></div>
			<div class="contenuePage">	
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
					   <tr >
						<th style="width:10px">Ordre</th>
						<th>Agent</th>
						<th>Respers</th>
						<th>Ancien D&eacute;pt/Dir/Sce</th>
						<th>Nouveau D&eacute;pt/Dir/Sce</th>
						<th>Situation</th>
						<th>Date</th>
					  </tr>
					</thead>
					<tbody>
					{assign var=ordre value="0"}
					{foreach from=$oData.list_mvt item=oMvt} 
					{assign var=ordre value=$ordre+1}
					 <tr>
						
						<td style="width:10px">{$ordre}</td>
						<td>{$oMvt.candidat_nom}</td>
						<td>{$oMvt.resp_nom}</td>
						<td>{$oMvt.old_dep_str}</td>
						<td>{$oMvt.new_dep_str}</td>
						<td>{$oMvt.type}</td>
						<td>{$oMvt.date}</td>
								 
					 </tr>
					 {/foreach} 
					</tbody>
				</table>	
				
			</div>
		
		</div>
		<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
		<div id="calendar"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
	{literal}
		<script>
			 $(document).ready(function() {
				$('#dataTables-example').dataTable();
			});
		</script>
	{/literal}
    {include_php file=$zFooter}
</div>
</body>
</html>