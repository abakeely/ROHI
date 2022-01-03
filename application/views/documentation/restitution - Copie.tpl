{include_php file=$zCssJs}
	{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"> 
  <marquee SCROLLAMOUNT="3">
		<font size="2">
		<font face="Arial">
			<font color=" red " face="Times New Roman"><b>RESTITUTION:</b></font>
				<font color="elo " face="Times New Roman">Mercredi 30 mai 2018   à 10H - Porte 401 - 4ème étage - Immeuble des Finances Antaninarenina</font>
					<font color="black" face="Times New Roman"><font color="white">Thème: </font> &laquo; ICD/FMI: PUBLIC FINANCIAL MANAGEMENT LEGAL FRAMEWORKS  &raquo;</font>
						<font color="white" face="Times New Roman">présenté par</font>
						<font color="black" face="Times New Roman">RASAMIRAVAKA Ioby / TATAGERA Brice Landry	</font>				
		</font>
		</font>
	</marquee> 

	<marquee SCROLLAMOUNT="3">
	<font size="2">
		<font face="Arial">
			<font color=" red " face="Times New Roman"><b>RESTITUTION:</b></font>
				<font color="elo " face="Times New Roman">Mercredi 30 mai 2018   à 11H - Porte 401 - 4ème étage - Immeuble des Finances Antaninarenina</font>
					<font color="black" face="Times New Roman"><font color="white">Thème: </font>&laquo; GESTION PREVISIONNELLE DES EMPLOIS ET DES COMPETENCES &raquo;</font>
						<font color="white" face="Times New Roman">présenté par</font>
						<font color="black" face="Times New Roman"> RAKOTOARIMANANA Hery Andry <font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
						
		</font>	
	</font>
	</marquee> 
	
	
	</div>
	
	<section id="content">
		{include_php file=$zLeft}	
		<div id="innerContent">
			<div id="ContentBloc">
				<h2> Image et Videos</h2>
					<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Archive et Documentation</a> <span>&gt;</span> Images et Vidéos </div>


<div class="contenuePage">


{literal}	
<style>
	.carousel-control.left, .carousel-control.right {
		background-image: none
	}
</style>
{/literal}

<br>
<!--*Debut Contenue*-->
<div align="right">
		<a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution" class="btn">Retour</a>
</div>
<div>
<div id="carousel-documentaion1" class="carousel slide" data-ride="carousel">
<div  class="a-section as-title-block">
	<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;" class="as-title-block-left" role="heading">
		<div align="center">S&eacute;lection des photos de restitution</div></h3>
	</h3>
</div>
	
	<!-- Indicators -->
	<ol class="carousel-indicators">
	{assign var=iIncrement value="0"}
	{foreach from=$oData.liste_groupe item=group}
		<li data-target="#carousel-documentaion1" data-slide-to="{$i}"class="{if $iIncrement==0}active{/if}"></li>
	{assign var=iIncrement value=$iIncrement+1}
	{/foreach}
	  </ol>
	  
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox" style="text-align: center;">
	{assign var=iIncrement value="0"}
	{foreach from=$oData.liste_groupe item=group}
		<div class="item {if $iIncrement==0}active{/if}">
			{foreach from=$oData.group item=row}
			<li class=" " data-sgproduct="{"asin":"B01I5KJHSM"}" aria-setsize="18" aria-posinset="14" aria-hidden="false" role="listitem" style="display: inline-block;">
			  <a href="{$zBasePath}documentation/detail_restitution_image/{$row->restitution_id}">
			  <img class="style_prevu_kit" src="{$zBasePath}assets/img/img_sad/restitution/image/{$row->restitution_icone_image}"  border="0" height="200" width="240">
			  </a>	
			</li>
			{/foreach}
		 </div>
	{assign var=iIncrement value=$iIncrement+1}
	{/foreach}
	</div>

	<!-- Controls -->
	  <a class="left carousel-control" href="#carousel-documentaion1" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-documentaion1" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
</div><br>
	
	
<div class="row">
	<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
	<div align="center">S&eacute;lection des videos de restitution</div></h3>
	
	<!-- Controls -->
	<div id="carousel-documentaion2" class="carousel slide" data-ride="carousel">	
	<ol class="carousel-indicators">
		{assign var=iIncrement value="0"} 
		{foreach from=$oData.liste_groupe item=group}
			<li data-target="#carousel-documentaion1" data-slide-to="{$i}"class="{if $iIncrement==0}active{/if}"></li>
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
	</ol>
	
	 <!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox" style="text-align: center;">
		{assign var=iIncrement value="0"} 
		{foreach from=$oData.liste_groupe item=group}
			<div class="item {if $iIncrement==0}active{/if}">
			{foreach from=$oData.group item=row}
			<li class=" " data-sgproduct="{"asin":"B01I5KJHSM"}" aria-setsize="18" aria-posinset="14" aria-hidden="false" role="listitem" style="display: inline-block;">
				<a href="{$zBasePath}documentation/detail_restitution_video/{$row->restitution_id}">
				<img  class="style_prevu_kit" src="{$zBasePath}assets/img/img_sad/restitution/video/{$row->restitution_icone_video}"  border="0" height="200" width="240">
				</a>
			</li>
			{/foreach}
		 </div>
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}	
	</div>
	
	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-documentaion2" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-documentaion2" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
	</div>
</div>
</div>

<!--*Fin Contenue*-->
<div id="calendar"></div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>

{include_php file=$zFooter}
</div>