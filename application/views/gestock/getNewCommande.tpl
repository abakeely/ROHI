<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>

<form action="{$zBasePath}gestock/save/stock/new-commande" method="POST" name="formulaireEdit" id="formulaireEdit" style="overflow:hidden" enctype="multipart/form-data">
<input type="hidden" name="iRow" id="iRow" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
<input type="hidden" name="iCommandeId" id="iCommandeId" value="{$oData.iCommandeId}">
<input type="hidden" name="iIncrement" id="iIncrement" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
<table>
	<thead>
		<tr>
			<th>Article</th>
			<th>Quantité</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="addedRows">
		{if sizeof($oData.toGetListeCommande)==0}<span style="color:blue;font-size:16px;" >Ajouter une nouvelle ligne de commande: <a href="#" onclick="addMoreRows(this.form);" ><i style="color:#0089DC;font-size:22px" class="la la-plus-square"></i></a></span><br/><br/>{/if}
		{if sizeof($oData.toGetListeCommande)>0}
		{assign var=iIncrement value="1"}
		{foreach from=$oData.toGetListeCommande item=oListe }
			<tr id="rowCount{$iIncrement}" class="even">
				<input type="hidden" name="iModif_{$iIncrement}" id="iModif_{$iIncrement}" value="{$oListe.CommandeArticle_id}">
				<input type="hidden" name="iArticleSelected_{$iIncrement}" id="iArticleSelected_{$iIncrement}" value="{$oListe.fourniture_id}">
				<input type="hidden" name="zArticleSelected_{$iIncrement}" id="zArticleSelected_{$iIncrement}" value="{$oListe.fourniture_article}">
				<td><input style="width:250px" type="text" id="iArticleId_{$iIncrement}" name="iArticleId_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;
				<br><p class="message" style="width:200px">Veuillez séléctionner l'article</p>
				</td>
				<td><input style="width:100px" type="text" readonly="readonly" value="{$oListe.fournitureCommande_quantite}" class="obligatoire" id="iQuantite_{$iIncrement}" name="iQuantite_{$iIncrement}">&nbsp;&nbsp;
				<br><p class="message" style="width:100px">Veuillez remplir la quantité</p>
				<td style="text-align:center"><input style="width:100px" type="text" readonly="readonly" value="{$oListe.statut_libelle}" class="obligatoire">&nbsp;&nbsp;</td>
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
<script type="text/javascript">
function getArticle(_iRowCount){
	$(document).ready (function ()
	{
		$("#iArticleId_" + _iRowCount).select2
		({
			allowClear: true,
			placeholder:"Sélectionnez",
			minimumInputLength: 3,
			multiple:false,
			formatNoMatches: function () { return $("#AucunResultat").val(); },
			formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
			formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
			formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
			formatSearching: function () { return "Recherche..."; },			
			ajax: { 
			url: "{/literal}{$zBasePath}{literal}gestock/getFourniture/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term};
			},
			results: function (data)
			{
				return {results: data};
			}
			}
		})
	})
}
var iRowCount = $("#iIncrement").val();
getArticle(1);

function is_int(value){
  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
      return true;
  } else {
      return false;
  }
}
function addMoreRows(frm) {
	$(document).ready (function ()
	{
		iRowCount++;
		$('#iRow').val(iRowCount);
		var recRow = '<tr id="rowCount'+iRowCount+'" class="even"><td><input style="width:250px" type="text" value="" id="iArticleId_'+iRowCount+'" name="iArticleId_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;<br><p class="message" style="width:200px">Veuillez séléctionner l\'article</p></td><td><input style="width:100px" type="text" value="" id="iQuantite_'+iRowCount+'" name="iQuantite_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;<br><p class="message" style="width:100px">Veuillez remplir la quantité</p></td><td style="text-align:center"><a href="#" onclick="removeRow('+iRowCount+');" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></td></tr>';
		getArticle(iRowCount);
		$('#addedRows').append(recRow);
		$.getScript( "{/literal}{$zBasePath}{literal}assets/common/js/app/main.js");	
	})
}

function removeRow(removeNum) {
$('#rowCount'+removeNum).remove();
}

function getSelectArticle(_iRowCount){
	$(document).ready (function ()
	{
		zData = [{id:$("#iArticleSelected_"+_iRowCount).val(),text:$("#zArticleSelected_"+_iRowCount).val()}];

		$("#iArticleId_" + _iRowCount).select2
		({
			
			initSelection: function (element, callback)
			{
				$(zData).each(function()
				{
					if (this.id == element.val())
					{
						callback(this);
						return
					}
				})
			},
			allowClear: true,
			disabled: true,
			placeholder:"Sélectionnez",
			minimumInputLength: 3,
			multiple:false,
			formatNoMatches: function () { return $("#AucunResultat").val(); },
			formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
			formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
			formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
			formatSearching: function () { return "Recherche..."; },			
			ajax: { 
			url: "{/literal}{$zBasePath}{literal}gestock/getFourniture/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term};
			},
			results: function (data)
			{
				return {results: data};
			}
			}
		})

		$("#iArticleId_" + _iRowCount).select2('val',$("#iArticleSelected_"+_iRowCount).val());
		$("#iArticleId_" + _iRowCount).select2('disable', true);

	})
} 

$(document).ready (function (){

	$(".validerCommande").click(function(event) {
		
		iRet = 1 ;
		$(".obligatoire").each (function ()
		{
			$(this).parent().removeClass("error");
			if($(this).val()=="" && $(this).attr("Name") != undefined)
			{
				$(this).parent().addClass("error");
				 iRet = 0 ;
			}
		}) ;
		
		if (iRet == 1){
			if (confirm("Êtes-vous sûr de valider ce Commande?")){
				$("#formulaireEdit").submit();
			}
		}
	});
})

$('.ui-dialog-buttonpane button:contains("Commander")').button().show();

	{/literal}
		{if sizeof($oData.toGetListeCommande)>0}
		{assign var=iIncrement value="1"}
		$('.ui-dialog-buttonpane button:contains("Commander")').button().hide();
		{foreach from=$oData.toGetListeCommande item=oListe }
				{literal}getSelectArticle({/literal}{$iIncrement}{literal}){/literal}
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
		{/if}
	{literal}
</script>
