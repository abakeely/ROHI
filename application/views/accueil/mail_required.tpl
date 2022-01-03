{include_php file=$zCssJs}
{include_php file=$zHeader}
	<div id="container">
		<div id="breadcrumb">&nbsp;</div>
		
			<section id="content">
			{include_php file=$zLeft}	
			<div id="innerContent">
				<div id="ContentBloc">
					<h2>Mise à jour des informations sur ROHI</h2>
					<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a style="text-decoration:none;" href="{$zBasePath}">Accueil</a> <span>&gt;</span></div>
				</div>
				<p>Veuillez consulter votre adresse email pour confirmer votre login et mot de passe</p>
				<div><p>&nbsp;</p></div>

			</div>
			<div id="calendar"></div>
			</section>

			<section id="rightContent" class="clearfix">
				{include_php file=$zRight}
			</section>
				{include_php file=$zFooter}
	</div>
