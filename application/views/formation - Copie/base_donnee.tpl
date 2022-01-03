{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Formation</a> <span>&gt;</span> <a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a><span>&gt;</span>Base de données des agents formés</div>
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Base de données des agents formés{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

{literal}		
<style>
	.style_prevu_kit
{
    display:inline-block;
    border-radius: 20px;
	border:0;
    width:100%;
    height:200px;
    position: relative;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1); 
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1); 
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1);
    transition: all 200ms ease-in;
    transform: scale(1);   

}

</style>
{/literal}

<br>

<br>
  <div class="col-md-12">
    <div class="row">		
 		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#FF4500;" title="Agent formé en local">
 				<h5 style="text-align: center; color:black;"><br><br><br><br><br><strong>&agrave;</strong><br><br><br><strong>MADAGASCAR</strong></h5>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#40E0D0;">
				<a href="{$zBasePath}formation/base_donnee_table/2017" title="Agents en-cours de formation à Madagascar">
					<h1 style="text-align: center;"><br><br>2017</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#DA70D6;">
				<a href="{$zBasePath}formation/base_donnee_table/2016" title="Agents formés à Madagascar en 2016">
					<h1 style="text-align: center;"><br><br>2016</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#FF9933;">
				<a href="{$zBasePath}formation/base_donnee_table/2015" title="Agents formés à Madagascar en 2015">
				<h1 style="text-align: center;"><br><br>2015</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#F9F943;">
				<a href="{$zBasePath}formation/base_donnee_table/2014" title="Agents formés à Madagascar en 2014">
					<h1 style="text-align: center;"><br><br>2014</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#00D02F;">
				<a href="{$zBasePath}formation/base_donnee_table/2013" title="Agents formés à Madagascar en 2013">
					<h1 style="text-align: center;"><br><br>2013</h1>
				</a>
			</div>
		</div>        		
	</div>
	<div class="row"><br></div>
	<div class="row"><br></div>
	<div class="row">
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#FC6C9F;">				
				<h5 style="text-align: center; color:black;"><br><br><br><br><br><strong>&agrave;</strong><br><br><br><strong>L'&Eacute;TRANGER</strong></h5>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#93a6a8;">
				<a href="{$zBasePath}formation/agentformeetranger_table/2017" title="Agents en-cours de formation à l'étranger">
					<h1 style="text-align: center; color:white;"><br><br>2017</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#FF6347;">
				<a href="{$zBasePath}formation/agentformeetranger_table/2016" title="Agents formés à l'étranger en 2016">
					<h1 style="text-align: center; color:white;"><br><br>2016</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#9FC32D;">
				<a href="{$zBasePath}formation/agentformeetranger_table/2015" title="Agents formés à l'étranger en 2015">
					<h1 style="text-align: center; color:white;"><br><br>2015</h1>
				</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#660033;">
				<a href="{$zBasePath}formation/agentformeetranger_table/2014" title="Agents formés à l'étranger en 2014">
					<h1 style="text-align: center; color:white;"><br><br>2014</h1>
				</a>
			</div>
		</div>	
		<div class="col-md-2">
			<div class="style_prevu_kit" style="background-color:#9966FF;">
				<a href="{$zBasePath}formation/agentformeetranger_table/2013" title="Agents formés à l'étranger en 2013">
					<h1 style="text-align: center; color:white;"><br><br>2013</h1>
				</a>
			</div>
		</div>
	</div>
   </div>  
 </div>
 <br><br><br><br>
 
{literal}  

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