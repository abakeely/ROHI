{include_php file=$zHeader }
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
		
	</div>
	<div id="innerContent">
		<h2>Cong&eacute; Ant&eacute;rieure de : {$oData.oUserConge.nom}&nbsp;{$oData.oUserConge.prenom}</h2>
		<div class="card punch-status">
		<form action="{$zBasePath}gcap/saveCongeLast/{$oData.oUserConge.user_id}" method="POST" name="formulaire" id="formulaire" enctype="multipart/form-data">
			<input type="hidden" name="lastCongeId" id="lastCongeId" value="0">
			<input type="hidden" name="iUserId" id="iUserId" value="{$oData.oUserConge.user_id}">
			<input type="hidden" name="iAnneEnCours" id="iAnneEnCours" value="{$oData.annee}">
			<input type="hidden" name="iAnnePriseService" id="iAnnePriseService" value="{$oData.iAnnePriseDecision}">
			<input type="hidden" name="date_prise_service" id="date_prise_service" value="{$oData.oUserConge.date_prise_service}">
			<input type="hidden" name="zMessageCumulee" id="zMessageCumulee" value="D&eacute;cision de cong&eacute; annuel pas encore disponible (< 60 jours)">
			<fieldset>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<h2>AJOUT / EDIT</h2>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>Type {$oData.zLibelle} *</label>
							<select id="type_id" name="type_id" onChange="setDateFin();setToolType('{$zBasePath}', this.value);setCongeAnnuelCumule('{$zBasePath}', this.value,{$oData.oUserConge.user_id})" class="obligatoire">
								<option value="">s&eacute;l&eacute;ctionner le type D&eacute;cision</option>
								{foreach from=$oData.oType item=oType }
								{if $oType.type_id == DECISISON_CONGE_ANNUEL || $oType.type_id == DECISISON_CONGE_ANNUEL_CUMULE}
								<option value="{$oType.type_id}">{$oType.type_libelle}</option>
								{/if}
								{/foreach}
							</select>
							<a href="#" title="" class="tooltip">
								<i id="allToltip" class="la la-info-circle" {if $oData.oDecision.decision_typeId == ""}style="display:none"{else}style="display:inline-block"{/if}></i>
								<span id="getType">
									
								</span>
							</a>
							<p class="message">Veuillez s&eacute;l&eacute;ctionner le type {$oData.zLibelle}</p>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>Num&eacute;ro de d&eacute;cision</label>
							<input type="text" name="numero" id="numero" value="" class="obligatoire" placeholder="Num&eacute;ro de d&eacute;cision">
							<p class="message" style="width:500px">Veuillez remplir le num&eacute;ro de d&eacute;cision </p>
						</div>
					</div>
				</div>
				<div class="row clearfix">
				<div class="cell">
						<div class="field"> 
							<label>Ann&eacute;e *</label>
							<select onChange="GetCalendar(this.value)" id="annee" name="annee" class="obligatoire">
								<option value="">s&eacute;l&eacute;ctionner l'ann&eacute;e</option>
								{assign var=iBoucle value=$oData.annee}
								{assign var=iAnnePrise value=$oData.anneePriseService}
								{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}

								{if $smarty.section.iAnnee.index != $oData.annee   }
									{if sizeof($oData.oDataExtrant)>0} 
										{assign var=iAffiche value="1"}
										{foreach from=$oData.oDataExtrant item=oDataExtrant }

											{if $oDataExtrant.decision_annee == $smarty.section.iAnnee.index} 
											{assign var=iAffiche value="0"}
											{/if}
										{/foreach}

										{if $iAffiche==1}
										<option {if $oData.oDecision.decision_annee == $smarty.section.iAnnee.index} selected="selected" {/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
										{/if}
									{else}
										<option {if $oData.oDecision.decision_annee == $smarty.section.iAnnee.index} selected="selected" {/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
									{/if}
								{/if}
								{/section}
							</select>
							<a href="#" title="" class="tooltip">
								<i id="allToltip" class="la la-info-circle"></i>
								<span id="getType">
									Ann&eacute;e de d&eacute;cision
								</span>
							</a>
							<p class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner l'ann&eacute;e</p>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell small">
						<div class="field">
							<label>Date de d&eacute;cision *</label>
							<input type="text" name="date_decision" id="date_decision" class="withDatePicker obligatoire">
							<p class="message">Veuillez s&eacute;l&eacute;ctionner la date de d&eacute;cision</p>
						</div>
						
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>Nombre de jour (automatique)</label>
							<input type="text" name="nbrJour" id="nbrJour" readonly="readonly" value="" class="obligatoire" placeholder="Nombre de jour">
							<p class="message" style="width:500px">Veuillez remplir le nombre de jour</p>
						</div>
					</div>
				</div>
				<div class="row clearfix">
				<div class="cell small">
					<div class="field">
						<label>Date d&eacute;but *</label>
						<input type="text" name="date_debut" id="date_debut" class="datedropper-range-fiche obligatoire">
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="cell small">
					<div class="field">
						<label>Date fin *</label>
						<input type="text" name="date_fin" id="date_fin" onChange="setDateFin();" class="datedropper-range-fiche obligatoire">
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="cell">
					<div class="field">
						<label>Nombre de jour pris</label>
						<input type="text" name="nbrJourPris" id="nbrJourPris" value="" class="obligatoire" placeholder="Nombre de jour pris">
						<p class="message" style="width:500px">Veuillez remplir le nombre de jour pris</p>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="cell">
					<label>Nom autorit&eacute; *</label>
					<div class="field">
						<input placeholder="Veuillez entrer le nom de l'autorit&eacute;" type="text" id="zCandidatSearch" name="zCandidat">
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="cell">
					<div class="field">
						<input type="button" class="button" onClick="submitFormulaire();" name="button-add" id="button-add" value="Ajouter">
					</div>
				</div>
			</div>
			</fieldset>
		</form>
		
		</div>
		<div><p>&nbsp;</p></div>
		<div class="clear"></div>
		<table>
			<thead>
				<tr>
					<th>Type</th>
					<th>Num&eacute;ro de d&eacute;cision</th>
					<th>Nombre de jour</th>
					<th>Nombre de jour Pris</th>
					<th>Ann&eacute;e de d&eacute;cision</th>
					{*<th class="center" width="100">Action</th>*}
				</tr>
			</thead>
			<tbody>
				{assign var=iIncrement value="0"}
				{if sizeof($oData.oDataLastConge)>0}
				{foreach from=$oData.oDataLastConge item=oListeLastConge }
				<tr {if $iIncrement%2 == 0} class="even" {/if}>
					<td>{$oListeLastConge->type_libelle}</td>
					<td>{$oListeLastConge->decision_numero}</td>
					<td>{$oListeLastConge->decision_nbrJour}</td>
					<td>{$oListeLastConge->fraction_nbrJour}</td>
					<td>{$oListeLastConge->decision_annee}</td>
					{*<td class="center">
						<a href="#" onClick="javascript:getLastCongeUserById({$oListeLastConge->lastConge_id})" title="" class="action"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
						<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oListeLastConge->lastConge_id}" class="action suppr"><i style="color: #F10610;" class="la la-close"></i></a>
					</td>*}
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
</section>
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/deleteLastConge/{$oData.oUserConge.user_id}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="iElementId" id="iValueId" value="">
</form>
{literal}
<script>

$(document).ready (function ()
{
	var dataArrayVille = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	
	$("#zCandidatSearch").select2
	({
		initSelection: function (element, callback)
		{
			
			$(dataArrayVille).each(function()
			{
				if (this.id == element.val())
				{
					callback(this);
					return
				}
			})
		},
		allowClear: true,
		placeholder:"S&eacute;lectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez s&eacute;lectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#zCandidatSearch").select2('val',$("#idSelect").val());
	
})

function getLastCongeUserById(_Id) {

	$.ajax({
		url: "{/literal}{$zBasePath}{literal}gcap/getLastCongeById/" + _Id,
		type: 'get',
		success: function(data, textStatus, jqXHR) {
			data = JSON.parse(data);	
			//data.lastConge_id;
			$("#lastCongeId").val(data.lastConge_id);
			$("#numDecision").val(data.lastConge_numDecision);
			$("#nbrJour").val(data.lastConge_nombre);
			$("#nbrJourPris").val(data.lastConge_pris);
			$("#AnneeDecision").val(data.lastConge_annee);
			$("#button-add").val('Modifier');
			document.location.href ="#formulaire";
			
		},
		async: false
	});
}
function cancel() {

	$("#lastCongeId").val(0);
	$("#numDecision").val('');
	$("#nbrJour").val('');
	$("#nbrJourPris").val('');
	$("#AnneeDecision").val('');
	$("#button-add").val('');

}

function submitFormulaire() {

	var iRet = 1 ; 
	$(document).ready (function ()
	{
		$(".obligatoire").each (function ()
		{
			$(this).parent().removeClass("error");
			if($(this).val()=="")
			{
				$(this).parent().addClass("error");
				 iRet = 0 ;
			}
		}) ;
	}) ;

	if (iRet == 1)
	{	
		$("#formulaire").submit();
	}
	
}
</script>
{/literal}
{include_php file=$zFooter}