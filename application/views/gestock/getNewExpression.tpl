<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>

<form action="{$zBasePath}gestock/save/stock/new-commande" method="POST" name="formulaireEdit" id="formulaireEdit" style="overflow:hidden" enctype="multipart/form-data">
<input type="hidden" name="iRow" id="iRow" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
<input type="hidden" name="iCommandeId" id="iCommandeId" value="{$oData.iCommandeId}">
<input type="hidden" name="iIncrement" id="iIncrement" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
<table>
	<thead>
		<tr>
			<th>Date</th>
			<th>Quantité</th>
			<th>Service</th>
		</tr>
	</thead>
	<tbody id="addedRows">
		{if sizeof($oData.toGetListeCommande)>0}
		{assign var=iIncrement value="1"}
		{foreach from=$oData.toGetListeCommande item=oListe }
			<tr id="rowCount{$iIncrement}" class="even">
				<input type="hidden" name="iModif_{$iIncrement}" id="iModif_{$iIncrement}" value="{$oListe.CommandeArticle_id}">
				<input type="hidden" name="iArticleSelected_{$iIncrement}" id="iArticleSelected_{$iIncrement}" value="{$oListe.fourniture_id}">
				<input type="hidden" name="zArticleSelected_{$iIncrement}" id="zArticleSelected_{$iIncrement}" value="{$oListe.fourniture_article}">
				<td><input style="width:250px" type="text" id="iArticleId_{$iIncrement}" name="iArticleId_{$iIncrement}" readonly="readonly" value="{$oListe.commande_date|date_format:"%d/%m/%Y"}">&nbsp;&nbsp;
				</td>
				<td><input style="width:100px" type="text" readonly="readonly" value="{$oListe.fournitureCommande_quantite}" class="obligatoire" id="iQuantite_{$iIncrement}" name="iQuantite_{$iIncrement}">&nbsp;&nbsp;
				<br><p class="message" style="width:100px">Veuillez remplir la quantité</p>
				<td style="text-align:center"><input style="width:100px" type="text" readonly="readonly" value="{$oListe.sigle_service}" class="obligatoire">&nbsp;&nbsp;</td>
				</td>
			</tr>
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
		{else}
			<tr id="rowCount1" class="even">
				<td><input style="width:250px" type="text" value="" id="iArticleId_1" name="iArticleId_1" class="obligatoire">&nbsp;&nbsp;
				<br><p class="message" style="width:200px">Veuillez séléctionner l'article</p>
				</td>
				<td><input style="width:100px" type="text" value="" id="iQuantite_1" name="iQuantite_1" class="obligatoire">&nbsp;&nbsp;
				<br><p class="message" style="width:100px">Veuillez remplir la quantité</p>
				</td>
				<td style="text-align:center">&nbsp;</td>
			</tr>
		{/if}
	</tbody>
</table>
</form>
				
{literal}
<style>
td.left {width:20%}
</style>