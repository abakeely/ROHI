{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Offres de formation{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">Formation</a> <span>&gt;</span> <a href="{$zBasePath}"></a>Offres</div>
		
		<div class="contenuePage">




		<!--*Debut Contenue*-->
		<div class="col-xs-12">

<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/css/mask.css">
   <!-- <link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/css/bootstrap.min.css"> -->


<div class="col-md-12">
	<center>
	<br><br><br><br>
		<div class="row" >

				{if $oData}
						{foreach from=$oData.menuformation  item=oMenu}
						<div class="col-md-4">
					          <div class="fall-item fall-effect">
					                    	<img width="500px" src="{$zBasePathBo}{$oMenu.menuformation_photo}" class="rounded float-left" />
					                    <div class="mask">
					                        <br><br><br>	
					                        <a href="{$zBasePath}{$oMenu.menuformation_zhashurl}" class="field"><button style="margin: 60px 0px; font-size: 15px; font-weight: bold;">{$oMenu.menuformation_lib}</button></a>
					                    </div>
					            </div><br><br><br>
						</div>
						{/foreach}	
				{/if}
		</div>

</div>
	<br>
	</center>
</div>


<script type="text/javascript" src="{$zBasePath}assets/common/css/formation/js/modernizr.js"></script>

    <!--*Fin Contenue*-->
    </div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
{include_php file=$zFooter}
</div>

</body>


</html>