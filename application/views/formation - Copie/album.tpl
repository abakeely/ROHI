{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Formation</a> <span>&gt;</span> <a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a><span>&gt;</span>Album</div>
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Album{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

<br><br>

<div id="wowslider-container1">
	<div class="ws_images">
		<ul>
		{if $oData}
			{foreach from = $oData.oList_image item = oImg}
			<li><img src="{$zBasePath}assets/img/img_sfao/{$oImg}" alt="" title="" /></li>	
			{/foreach}
		{/if}
		</ul>
	</div>
	<div class="ws_script" style="position:absolute;left:-99%"></div>
	<div class="ws_shadow"></div>
	</div>	
	
 
{literal}  
<script type="text/javascript" src="{$zBasePath}assets/sad/sfao/wowslider.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/sad/sfao/script.js"></script>
{/literal}

</div>

    <!--*Fin Contenue*-->
    </div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">

<input type="hidden" name="idSelect" id="idSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->user_id}{/if}">
<input type="hidden" name="textSelect" id="textSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->nom}&nbsp;{$oData.oCandidatSearch->prenom}{/if}">

<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
</form>
{include_php file=$zFooter}
</div>

</body>
</html>