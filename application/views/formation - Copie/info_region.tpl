{include_php file=$zCssJs}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">Formation</a><span>&gt;</span> Infos regions</div>
	{include_php file=$zHeader}
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Infos regions {if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">
{literal}		
 <style>
	.th_livre{
		background: #1D5C8F
		style="width:2px"!important
	}
</style>
 {/literal}

 
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	<br><br><br>
	<h1 style="color:#008080; font-size: 2em; font-weight: bold; font-family: Arial;">
        <div align="center"><font color="Teal">Le Journal mensuel de la formation</font></div></h1>
	<br><br>
	<table class="table table-striped table-bordered table-hover" id="table_inforegion">
	   <thead>
		<tr >
			<th class="th_livre" ><font size="2"><font face="Times New Roman">MOIS</font></font></th>
			<th class="th_livre" ><font size="2"><font face="Times New Roman">REGIONS CONCERNEES</font></font></th>
			<th class="th_livre" ><font size="2"><font face="Times New Roman">DOMAINE</font></font></th>
			<th class="th_livre" ><font size="2"><font face="Times New Roman">RESUME DES ACTIVITES MENSUELLES</font></font></th>
			<!--<th class="th_livre" style="width:10px"><font size="3"><font face="Times New Roman">Video</font></font></th>-->
		</tr>
	   </thead>	

	   {if $oData}
	   		{foreach from=$oData.inforegion item=oliste}
				<tr>
					<td><h1 style="font-size:15px; font-weight: bold; font-family: Arial;">{$oliste->moisannee}</h1></td>
					<td><h1 style="font-size:1.2em; font-family: Arial;">{$oliste->region}</h1></td>
					<td><h1 style="font-size:1.2em; font-weight: bold; font-family: Arial;">{$oliste->domaine}</h1></td>
					<td><h1 style="font-size:1.2em; font-family: Arial;">{$oliste->information}</h1></td>
					<!--<td> <a href="<//?php echo base_url();?>assets/pdf_sfao/inforegion/<//?php echo $inforegion->video_image_pdf;?>" target="_blank">
					<img src="<?php echo base_url();?>assets/img/img_sfao/video_image.png" border="0" height="108" width="60"></a></td>-->
				</tr>
			{/foreach}

		{/if}
   </table>		
  </div>

  {literal}
  <script>

	(function($) {
	
    $(document).ready(function() {
       $('#table_inforegion').dataTable({
	   "ordering" : false
	   });	
	});	
  </script>		
{/literal}

</table> 
</center>


		 </div>

    <!--*Fin Contenue*-->
    </div>
	</div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<input type="hidden" name="idSelect" id="idSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->user_id}{/if}">
<input type="hidden" name="textSelect" id="textSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->nom}&nbsp;{$oData.oCandidatSearch->prenom}{/if}">

<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
</form>
{include_php file=$zFooter}
</div>

</body>


</html>