{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Liste Fiche de poste</h2>

		<div class="SSttlPage">

		<div class="cell">
			<div class="field text-center">
				<form action="{$zBasePath}accueil/outils/fiche-de-poste/fiche" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
				<button>Ajouter</button>
				</form>
			</div>
		</div>
		</div>
		<div class="clear"></div>
			<div class="contenuePage">

			<!--*Debut Contenue*-->
			<div class="col-xs-12">
			<table id="dataTables">
				<thead>
					<tr>
						<th>Nom et prénom</th>
						<th>Intitulé</th>
						<th class="center" width="100">Action</th>
					</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($oData.toFicheDePoste)>0}
					{foreach from=$oData.toFicheDePoste item=oFicheDePoste }
					<tr {if $iIncrement%2 == 0} class="even" {/if}>
						<td>{$oFicheDePoste.nom}&nbsp;{$oFicheDePoste.prenom}</td>
						<td>{$oFicheDePoste.fichePoste_intitule}</td>
						<td class="center">
							<a href="{$zBasePath}accueil/outils/fiche-de-poste/fiche/{$oFicheDePoste.fichePoste_id}" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
							<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oFicheDePoste.fichePoste_id}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
						</td>
					</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{else}
					<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
					{/if}
				</tbody>
			</table>
			{$oData.zPagination}
			</div>
		</div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
</div>
<form name="formDelete" id="formDelete" action="{$zBasePath}accueil/deleteFicheDePoste" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">
<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}accueil/listeCommunique">
</form>
<script>
{if sizeof($oData.toFicheDePoste)>0}
{literal}
$(document).ready(function() {
    $('#dataTables').dataTable({
        "aaSorting": []
    });

	$(".suppr").click (function ()
	{
		var iElement = $(this).attr("dataSuppr");
		if (confirm ($("#zMessage").val()))
		{
			$("#iValueId").val(iElement) ; 
			$("#formDelete").submit();
			
		}
	})
}); 


{/literal} 
{/if}
</script>
{include_php file=$zFooter}