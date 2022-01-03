<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/common/css/aria-tooltip.css">
<script type="text/javascript" src="{$zBasePath}assets/common/js/aria-tooltipEdit.js"></script>
<div class="clearfix">
	<div class="cell">
		<div class="field">
		{if $iTypeGcapId == PERMISSION || $iTypeGcapId == REPOS_MEDICAL_LUCIA || $iTypeGcapId == MISSION || $iTypeGcapId == FORMATION|| $zHashUrl == '25' || $zHashUrl == '26'}
			<input type="hidden" id="type_id" name="type_id" value="{if $iTypeGcapId == PERMISSION}21{elseif $iTypeGcapId == REPOS_MEDICAL_LUCIA}22{elseif $iTypeGcapId ==6}23{elseif $zHashUrl =='25'}25{elseif $zHashUrl =='26'}26{else}24{/if}">
		{else}
		<!--modif lucia-->
			{if $iTypeGcapId != REPOS_MEDICAL_LUCIA}
				{if sizeof($oType)>0}
					<label>Type {$zLibelle} *</label>
					<select id="type_id" name="type_id" class="form-control obligatoire" onChange="getEventCorrespondant('{$zBasePath}',this.value,{$iTypeGcapId});setToolType('{$zBasePath}', this.value);showNbJourRestant(this.value);manageFields(this.value);">
						<option value="">S&eacute;l&eacute;ctionner le type {$zLibelle}</option>

						{foreach from=$oType item=toType}
							{if $toType.type_id=='25' && $oCandidat->sexe=='1'}
							<option value="{$toType.type_id}">{$toType.type_libelle}</option>
							{/if}
							{if $toType.type_id=='26' && $oCandidat->sexe=='0'}
							<option value="{$toType.type_id}">{$toType.type_libelle}</option>
							{/if}
							{if $toType.type_id<25}
							<option value="{$toType.type_id}">{$toType.type_libelle}</option>
							{/if}
						{/foreach}
					</select>
				{/if}
			{/if}
				
			<i id="allToltip" aria-describedby="tt3" id="demo3" spellcheck="false"  class="la la-info-circle has-tooltip"></i>
			<span class="tooltip getType" id="tt3" role="tooltip" aria-hidden="true">
			</span>
			<p class="message">Veuillez s&eacute;l&eacute;ctionner le type {$zLibelle}</p>
			<span id="nbJourRestant" style="color:red;font-size:15px;display: block;"></span>
		{/if}
		</div>
	</div>
</div>
<div class="clearfix" id="decisionCorrespondant">
</div>
{if ($iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $iTypeGcapId == REPOS_MEDICAL_LUCIA) || ($iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $zHashUrl == '25')|| ($iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $zHashUrl == '26')}
<div class=" clearfix">
	<div class="cell">
		<label>Nom de l'agent </label>
		<div class="field">
			<input placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" style="width:500px;font-size: 13px;" name="iUserAgentId">
			<p id="zCandidatSearchMessage" class="message">Veuillez entrer le nom de l'agent</p>
		</div>
	</div>
</div>
{/if}
{if $iTypeGcapId == AUTORISATION_ABSENCE}
<br>
<div class="clearfix">
	<div class="cell">
		<div class="field" id="motifField">
			<label>Motif * </label>
			<select name="motif" id="motif" class="obligatoire" onChange="changeMotif1(this.value)">
			{$zSelect}
			</select>
			<p class="message" style="width:500px">Veuillez remplir le motif </p>
		</div>
	</div>
</div>
<div class="clearfix" id="iPieceJointeId">
	<div class="cell">
		<div class="field" >
			<label>Pi&egrave;ce jointe * </label>
			<input type="file" name="zFile" id="zFile" class="obligatoire" >
			<p class="message">Veuillez remplir le fichier joint </p>
		</div>
	</div>
</div>


<div class=" clearfix" id="conv_pers" style="display:none">
	<div class="cell">
		<div class="field" id="motifField">
			<label>Motifs de convenance personnelle * </label>
			<textarea type="text" name="conv_pers" id="champsConvPers" class="form-control obligatoire">{$oGcap.conv_pers}</textarea>
			<p class="message" style="width:500px;">Veuillez remplir le  motif de convenance personnelle </p>
		</div>
	</div>
</div>
		
<div class=" clearfix" id="caracteristiqueAutorisation" style="display:none;">
	<div class="cell">
		<div class="field">
			<label>Caract&eacute;ristique</label>
			<input type="text" name="caracteristique" id="caracteristique" value="" placeholder="Caracteristique">
		</div>
	</div>
</div>
{else}
<div class=" clearfix">
	<div class="cell">
		<div class="field">
			<label>Motif *</label>
			<textarea name="motif" id="motif" class="form-control obligatoire"></textarea>
			<p class="message" style="width:500px">Veuillez remplir le motif </p>
		</div>
	</div>
</div>
{/if}
<br>
{literal}
<style>
.select2-results__option { 
  font-size: 30px!important;
}

.select2-selection__rendered
{
    font-size:1.2em!important;
}

.select2-selection__rendered {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px!important;
}

.myFont {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px!important;
}

.select2-results__options{
        font-size:14px !important;
 }
</style>
<script>

$(document).ready (function ()
{
	$("#iTypeGcapId").val({/literal}{$iTypeGcapId}{literal});
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
		dropdownCssClass: "myFont",
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
function showNbJourRestant(p_selected){
	$('#nbJourRestant').html("");
	if ( p_selected == "18"){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gcap/getNbAutorisationRestant/",
			type: 'get',
			success: function(data, textStatus, jqXHR) {
				 if(data){
					$('#nbJourRestant').append(data);
				 }
			},
			async: false
		 });
	}
	
}
function manageFields(p_selected){
	$("#motif").val("") ;
	if ( p_selected == 25 ){
		$("#motif").val(" Conge de paternite") ;
		$("#motif").attr("readonly","true") ;
	}else if(p_selected == 26){
		$("#motif").val(" Conge de maternite") ;
		$("#motif").attr("readonly","true") ;
	}
}
{/literal}
</script>