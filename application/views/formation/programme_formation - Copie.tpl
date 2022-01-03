{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"></div>
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Liste du programme de formation {if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Formation</a> <span>&gt;</span> <a href="{$zBasePath}formation/programme/sfao/programme-formation">Reporting</a><span>&gt;</span> Programme de formation</div>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/page.css">
<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/portBox.css">
<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/jquerysctipttop.css">

<script type="text/javascript" src="{$zBasePath}assets/common/css/formation/pop/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/css/formation/pop/js/portBox.slimscroll.min.js"></script>	



<div class="col-xs-12">

<br>
<center>
<table class="table table-striped table-bordered table-hover">
<br>
<tr>
{assign var=i value=0}
{if count ($oData.associer) > 0}
{foreach from=$oData.associer  item=oAssocier}
{assign var=i value=$i+1}
	<td class="zoom2" align="center">
		 <a href="#" data-display="liste{$i}">
		 	<img src="{$zBasePathBo}{$oAssocier.associer_photo}" width="250px" height="220px">
		 	<a href="#" data-display="liste{$i}" class="field" style="color: white !important; "><button style="margin: 60px 0px; font-size: 12px; font-weight: bold; margin: 15px 5px !important">{$oAssocier.associer_sigle}</button></a>
		 </a>

<div id="liste{$i}" class="portBox">
	<div class="project">
	<div class="project-pics"> </div>
	<div class="project-info">
		
		<div class="row col-md-8">
            <table align="center" class="table table-bordered table-hover dataTable no-footer">
              <thead>
                <tr role="row">
                  <th class="th_livre" style="text-align:center">Déscription</th>
                  <th class="th_livre" style="text-align:center">Fichier</th>

                </tr>
              </thead>
              <tbody>
				{foreach from=$oData.contenuformation  item=oContenu}	
				
    				{if $oContenu.contenuformation_associerId == $oAssocier.associer_id}
    				<tr>
                      	<td style="width:54% !important;"">{$oContenu.contenuformation_titre}</td>
                      	<td class="zoom1" align="center">
							<a title="Télécharger" href="{$zBasePathBo}{$oContenu.contenuformation_fichier_pdf}">
								<img  src="{$zBasePath}assets/img/img_sfao/down.png" width="80px"  target="_blank" title="Télécharger le fichier" width="70px">
							</a>
						</td>
					</tr>
					{/if}
				{/foreach}
              </tbody>
            </table>
	    </div>
	
	<!-- Project Info Close --> 
	</div>
<!-- Project Close --> 
</div>

	</div>
            <div class="panel-footer" style="display:none"></div>
                      
    </td> 
{if $i%2==0}</tr>{/if}	
{/foreach}
{else}
<br><br><br><br><br><br><br><br><br>
<h3>AUCUNE &nbsp;&nbsp;&nbsp;&nbsp;INFORMATION &nbsp;&nbsp;&nbsp;&nbsp; DISPONIBLE</h3>
{/if}
</table> 
</center>

</div>
</div>

{literale}

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

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