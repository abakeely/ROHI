{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/voting/css/style.css" type="text/css" rel="stylesheet">
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="ContentBloc">
			<!--h2>Saisie du contenu du projet d'acte</h2-->
			<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">Vote</a> </div>
			<div class="clear"></div>
			<div id="innerContentVoting">
				<div id="voting">
					<div class="panel-body">
						<p>Module en cours!</p>
					</div>
				</div>
			</div>             
		</div>
	</section>

	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
</div>
{include_php file=$zFooter}
{literal}
<script>
$(document).ready(function() {
		
});
</script>
{/literal}
</body>
</html>