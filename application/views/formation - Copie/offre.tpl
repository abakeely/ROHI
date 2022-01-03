{include_php file=$zCssJs}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">Formation</a> <span>&gt;</span> <a href="{$zBasePath}"></a>Offres</div>
	{include_php file=$zHeader}
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Offres{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

<div class="col-md-12">
	<center>
	<br><br>
		<div class="row" >
				{if $oData}
						{foreach from=$oData.themeformation  item=oTheme}
							<div class="col-md-3" style="background:none;">
								<div class="zoom">
									<a href="{$zBasePath}{$oTheme.themeformation_zhashurl}">
										<img src="{$zBasePathRacine}/backoffice/assets/img/img_sfao/theme/{$oTheme.themeformation_photo}"  border="0" height="150" width="200">
									</a>
									<br>
									<br>	
								</div>
								<div class="field">				
									<a href="{$zBasePath}{$oTheme.themeformation_zhashurl}"><button>{$oTheme.themeformation_lib}</button></a>				
								</div>
								<br><br>
							</div>
							
					{/foreach}	
				{/if}
		</div>
	<br>
	</center>
</div>

{literal}


{/literal}
    <!--*Fin Contenue*-->
    </div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
{include_php file=$zFooter}
</div>

</body>


</html>