<table>
<thead>
	<tr>
		<th>Nom et prénom</th>
		<th>Num&eacute;ro de d&eacute;cision</th>
		<th>Nombre de jour</th>
		<th>Ann&eacute;e de d&eacute;cision</th>
		<th>Afficher/cacher</th>
	</tr>
</thead>
<tbody>
	{assign var=iIncrement value="0"}
	{assign var=iAnneeTemp value="-1000"}
	{assign var=iAnneeTempA value="-1000"}
	{if sizeof($toDataLastConge)>0}
	{foreach from=$toDataLastConge item=oListeLastConge }
	
	{if $iAnneeTemp!=$oListeLastConge->decision_annee}
	{assign var=iAnneeTemp value="{$oListeLastConge->decision_annee}"}
	<tr {if $iIncrement%2 == 0} class="even" {/if}>
		<td>{$oListeLastConge->nom}&nbsp;{$oListeLastConge->prenom}</td>
		<td>{$oListeLastConge->decision_numero}</td>
		<td>{$oListeLastConge->decision_nbrJour}</td>
		<td>{$oListeLastConge->decision_annee}</td>
		<td>
			 <a href="#" onClick="javascript:showDecision({$iIncrement})" title="" class="btn"><i id="faClasse{$iIncrement}" style="color:#12105A" title="Afficher/cacher" alt="Afficher/cacher" class="sendra la la-plus"></i></a>
		</td>
	</tr>
	
	<tr class="exependableAll expand{$iIncrement}">
		<td>&nbsp;</td>
		<td colspan="3" border="1">
			<table class="sousDecision">
				<tr>
					<th>Année de décision</th>
					<th>Date de saisie</th>
					<th>Identifiant Gcap</th>
					<th>Nombre de jour pris</th>
					<th>Action</th>
				</tr>
				{foreach from=$toDataLastConge item=oListeLastConge1}
				{if $iAnneeTemp==$oListeLastConge1->decision_annee}
				<tr>
					<td>{$oListeLastConge1->decision_annee}</td>
					<td>{$oListeLastConge1->fraction_date|date_format:"%d/%m/%Y"}</td>
					<td>{$oListeLastConge1->fraction_congeId}</td>
					<td>
					{if $oListeLastConge1->fraction_congeId==''}
					<input type="text" name="decision_{$oListeLastConge1->fraction_id}" id="decision_{$oListeLastConge1->fraction_id}" value="{$oListeLastConge1->fraction_nbrJour}">
					{else}
					{$oListeLastConge1->fraction_nbrJour}
					{/if}
					</td>
					<td>
						{if $oListeLastConge1->fraction_congeId==''}
						<a class="Edit1" dataSuppr="{$oListeLastConge1->fraction_id}" dataDec="{$oListeLastConge1->fraction_decisionId}" href="#" title=""><i style="width: 20px;font-size: 19px;" id="faClasse{$iIncrement}" style="color:#12105A" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
						<a  href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeLastConge1->fraction_id}" dataDec="{$oListeLastConge1->fraction_decisionId}" class="action supprii"><i style="width: 20px;font-size: 19px;color: #F10610;" class="la la-close"></i></a>
						{/if}
					</td>
				</tr>
				{/if}
				{/foreach}
			</table>
		</td>
		<td>&nbsp;</td>
	</tr>
	
	{/if}
	<tbody>
	{assign var=iIncrement value=$iIncrement+1}
	{/foreach}
	{else}
	<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
	{/if}
</tbody>
</table>
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/deleteDecision/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cette decision ?">
<input type="hidden" name="zMessage1" id="zMessage1" value="&Ecirc;tes vous s&ucirc;r de vouloir modifier le nombre de jour de cette decision ?">
<input type="hidden" name="azert" id="azert" value="&Ecirc;tes-vous s&ucirc;r de confirmer ">
<input type="hidden" name="azerty" id="azerty" value="cong&eacute;?">
<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/extrants/{$oData.zHashModule}/{$oData.zHashUrl}">
</form>
<script>
$(document).ready(function(){
	$(".exependableAll").hide();
	$(".supprii").click (function ()
	{
		var iFraction = $(this).attr("dataSuppr");
		var iDecision = $(this).attr("dataDec");
		if (confirm ($("#zMessage").val()))
		{
			$.ajax({
				url: "{$zBasePath}gcap/commConge/gestion-absence/deleteDecision",
				type: 'Post',
				data: {
					iFraction: iFraction,
					iDecision: iDecision
				},
				success: function(data, textStatus, jqXHR) {
					alert("Suppression effectuée");
					getAjaxLG();
				},
				async: !1
			})	
		}
	})

	$(".Edit1").click (function ()
	{
		var iFraction = $(this).attr("dataSuppr");
		var iDecision = $(this).attr("dataDec");
		var iValue = $("#decision_"+iFraction).val();
		if (confirm ($("#zMessage1").val()))
		{
			$.ajax({
				url: "{$zBasePath}gcap/commConge/gestion-absence/editDecision",
				type: 'Post',
				data: {
					iFraction: iFraction,
					iValue: iValue,
					iDecision: iDecision
				},
				success: function(data, textStatus, jqXHR) {
					alert("Modification effectuée");
					getAjaxLG();
				},
				async: !1
			})	
		}
	})
});

function showDecision(_iCible){
	$(document).ready(function(){
		$(".exependableAll").hide();
		$(".sendra").removeClass("fa-minus");
		$(".sendra").addClass("fa-plus");
		$(".expand" +  _iCible).toggle();
		var isVisible = $(".expand" +  _iCible).is( ":visible" )

		if(isVisible == true){
			$("#faClasse" + _iCible).removeClass("fa-plus");
			$("#faClasse" + _iCible).addClass("fa-minus");
		} else {
			$("#faClasse" + _iCible).removeClass("fa-minus");
			$("#faClasse" + _iCible).addClass("fa-plus");
		}
	 });
}
</script>
<style>

.sousDecision tr th:first-child {
    border-top-left-radius: 0px !important;
}

.sousDecision tr th:last-child {
    border-top-right-radius: 0px !important;
}

.sousDecision tr td {
    border: 1px solid #dddddd!important;
}    


.sousDecision tr th {
	 background: linear-gradient(#d61a59, #8e2525);
}

.expand1 { display: none;
}

.expand2 { display: none;
}
</style>