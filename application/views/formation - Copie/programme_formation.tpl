{include_php file=$zCssJs}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Formation</a> <span>&gt;</span> <a href="{$zBasePath}formation/programme/sfao/programme-formation">Reporting</a><span>&gt;</span> Programmes de formation</div>
	{include_php file=$zHeader}
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Liste du programme de formation {if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
		&agrave; finaliser
		{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
		&agrave; imprimer
		{/if}</h2>
		
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">

<br>
<center>
<table class="table table-striped table-bordered table-hover">
<br>
<tr>
{assign var=i value=0}
{foreach from=$oData.partenaire  item=oPartenaire}
{assign var=i value=$i+1}
	<td class="zoom">
		<div class = "classClick">
		 <br>
		  <a href="#liste{$i}">
			<img src="{$zBasePathRacine}/backoffice/assets/img/img_sfao/partenaire/{$oPartenaire.partenaire_photo}" >
			<br><br>
		  </a>
	    </div>
	    <div align="center" border="0">
    	<a href="#" class="overlay" id="liste{$i}"></a>
    		
		<div class="liste">
		<a class="close" href="#">&times;</a>
			<div class="row col-xs-12">
            <table align="center" class="table table-bordered table-hover dataTable no-footer">
              <thead>
                <tr role="row">
                  <th class="th_livre" style="text-align:center">Titre</th>
                  <th class="th_livre" style="text-align:center">Télécharger</th>
                </tr>
              </thead>
              <tbody>
				{foreach from=$oData.contenuformation  item=oContenu}
    				{if $oContenu.contenuformation_partenaireId == $oPartenaire.partenaire_id}
    				<tr>
                      <td>{$oContenu.contenuformation_titre}</td>
                      <td>
						<a target="blanck" class="la la-download" style="font-size: 2.5em;" style="font-size: 2.5em;" title="Télécharger" href="{$zBasePath}assets/pdf_sfao/programme/{$oContenu.contenuformation_fichier_pdf}"></a>	</td>
					</tr>
					{/if}
				{/foreach}
              </tbody>
            </table>
	        </div>                       
	    </div>
		</div>
            <div class="panel-footer" style="display:none"></div>
                      
     </td>   

{/foreach}
</table> 
</center>



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