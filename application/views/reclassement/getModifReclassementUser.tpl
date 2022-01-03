<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>

		<form action="{$zBasePath}reclassement/save/gestion-reclassement/reclassement" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
		<input type="hidden" name="iReclasssementId" id="iReclasssementId" value="{$oInfoReclassement.0.reclassement_id}">
		<input type="hidden" name="iUserId" id="iUserSelectId" value="{$oInfoReclassement.0.reclassement_userId}">
		<input type="hidden" name="zUserSelectId" id="zUserSelectId" value="{$oInfoReclassement.0.nom} {$oInfoReclassement.0.prenom}">

		<input type="hidden" name="iUserAutoriteId" id="iUserAutoriteId" value="{$oInfoReclassement.0.reclassement_userAutoriteId}">
		<input type="hidden" name="zUserSelectAutoriteId" id="zUserSelectAutoriteId" value="{$oInfoReclassement.0.autorite}">

		<input type="hidden" name="iInstitutSelectId" id="iInstitutSelectId" value="{$oInfoReclassement.0.institut_id}">
		<input type="hidden" name="zInstitutSelectId" id="zInstitutSelectId" value="{$oInfoReclassement.0.institut_libelle}">

		<input type="hidden" name="iDiplomeSelectId" id="iDiplomeSelectId" value="{$oInfoReclassement.0.diplome_id}">
		<input type="hidden" name="zDiplomeSelectId" id="zDiplomeSelectId" value="{$oInfoReclassement.0.diplome_libelle}">
			<fieldset>
				<table>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Institut : </label>
								<input placeholder="Veuillez rechercher un institut" type="text" id="iInstituId" name="iInstituId">
								<p id="iInstitutSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner l'institut</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Diplôme :</label>
								<input placeholder="Veuillez rechercher un diplôme" type="text" id="iDiplomeId" name="iDiplomeId">
								<p id="iDiplomeSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner le diplôme</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Nom et prénom : </label>
								<input placeholder="Veuillez rechercher un agent" type="text" id="iUserSearchId" name="iUserSearchId">
								<p id="iUserSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner l'agent</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Domaine :</label>
								<input style="width:40%" type="text" id="zDomaine" name="zDomaine" value="{$oInfoReclassement.0.reclassement_domaine}">
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Catégorie actuel :</label>
								<select name="iCategOrig" id="iCategOrig" class="obligatoire">
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==''}selected="selected"{/if} value="">Sélectionner un catégorie d'origine</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==1}selected="selected"{/if} value="1">Catégorie I</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==2}selected="selected"{/if} value="2">Catégorie II</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==3}selected="selected"{/if} value="3">Catégorie III</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==4}selected="selected"{/if} value="4">Catégorie IV</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==5}selected="selected"{/if} value="5">Catégorie V</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==6}selected="selected"{/if} value="6">Catégorie VI</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==7}selected="selected"{/if} value="7">Catégorie VII</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==8}selected="selected"{/if} value="8">Catégorie VIII</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==9}selected="selected"{/if} value="9">Catégorie IX</option>
									<option {if $oInfoReclassement.0.reclassement_categorieOrigine==10}selected="selected"{/if} value="10">Catégorie X</option>
								</select>
								<p class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner le catégorie d'origine</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Catégorie d'accueil :</label>
								<select name="iCategAccueil" id="iCategAccueil" class="obligatoire">
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==''}selected="selected"{/if} value="">Sélectionner un catégorie d'accueil</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==1}selected="selected"{/if} value="1">Catégorie I</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==2}selected="selected"{/if} value="2">Catégorie II</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==3}selected="selected"{/if} value="3">Catégorie III</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==4}selected="selected"{/if} value="4">Catégorie IV</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==5}selected="selected"{/if} value="5">Catégorie V</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==6}selected="selected"{/if} value="6">Catégorie VI</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==7}selected="selected"{/if} value="7">Catégorie VII</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==8}selected="selected"{/if} value="8">Catégorie VIII</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==9}selected="selected"{/if} value="9">Catégorie IX</option>
									<option {if $oInfoReclassement.0.reclassement_categorieAccueil==10}selected="selected"{/if} value="10">Catégorie X</option>
								</select>
								<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner catégorie d'accueil</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell small">
							<div class="field">
								<label>Date d'arrivée *</label>
								<input type="text" name="zDateEnvoi" id="zDateEnvoi" value="{if $oInfoReclassement.0.reclassement_dateArrivee}{$oInfoReclassement.0.reclassement_dateArrivee|date_format:"%d/%m/%Y"}{/if}" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{if $oInfoReclassement.0.reclassement_dateArrivee}{$oInfoReclassement.0.reclassement_dateArrivee|date_format2}{/if}" class="withDatePicker obligatoire">
								<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date d'arrivée</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:40%">
							<div class="field"> 
									LFI : <input type="radio" class="iClassificationClass" id="iTypeDossierId" name="iTypeDossierId" {if $oInfoReclassement.0.reclassement_typeReclassementId==1} checked="checked" {/if} value="1">
									LFR : <input type="radio" class="iClassificationClass" {if $oInfoReclassement.0.reclassement_typeReclassementId==2} checked="checked" {/if} id="iTypeDossierId" name="iTypeDossierId" value="2">
									<select name="iAnneeReclassement" id="iAnneeReclassement" style="width:30%" class="obligatoire">
										<option value=""></option>
										{assign var=iBoucle value=$iAnnee+1}
										{section name=iAnnee start=2015 loop=$iBoucle+1 step=1}
											<option {if $smarty.section.iAnnee.index == $oInfoReclassement.0.reclassement_session} selected="selected" {/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
										{/section}
									</select>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:40%">
							<div class="field"> 
								<label>Traiteur de dossier:</label>
								<select name="iResponsableId" id="iResponsableId" class="obligatoire">
									<option value="">Sélectionner un traiteur</option>
									<option {if $oInfoReclassement.0.reclassement_responsableUserId == '11470'}selected="selected"{/if} value="11470">RAZAFINONY Luc Nirina</option>
									<option {if $oInfoReclassement.0.reclassement_responsableUserId == '183'}selected="selected"{/if} value="183">RABENANDRIANINA Harifidy</option>
								</select>
								<p class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner le traiteur de dossier</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell">
							<label>Nom autorit&eacute; valideur</label>
							<div class="field">
								<p class="check"><input type="checkbox" id="iManuel" {if $oInfoReclassement.0.reclassement_autoriteSaisi!=''}checked="checked"{/if}  name="iManuel" value="1"><label>Saisi manuel<br/></label></p>
							</div>
							<div class="field" id="searchCandidat" {if $oInfoReclassement.0.reclassement_autoriteSaisi!=''}style="display:none"{else}style="display:block"{/if} >
								<input placeholder="Veuillez entrer le nom de l'autorit&eacute;" type="text" id="zCandidatSearch" name="zCandidat">
							</div>
							<div class="field" id="searchAutorite" {if $oInfoReclassement.0.reclassement_autoriteSaisi!=''}style="display:block"{else}style="display:none"{/if}>
								<input type="text" name="zAutoriteManuel" id="zAutoriteManuel" value="{$oInfoReclassement.0.reclassement_autoriteSaisi}">
							</div>
						</div>
					</div>
					<div class="row clearfix">
							<div class="cell" style="width:65%">
								<div class="field"> 
									<label>Province</label>
									<select id="iOrganisation_1" name="iProvinceId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
										<option value="0">s&eacute;l&eacute;ctionner une province</option>
										{foreach from=$toProvince item=oProvince }
										<option {if $oProvince.id == $oCandidat.0->province_id} selected="selected" {/if} value="{$oProvince.id}">{$oProvince.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="cell" style="width:65%">
								<div class="field"> 
									<label>Région</label>
									<select id="iOrganisation_2" name="iRegionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
										<option value="0">s&eacute;l&eacute;ctionner une région</option>
										{foreach from=$toRegion item=oRegion }
										<option {if $oRegion.id == $oCandidat.0->region_id} selected="selected" {/if} value="{$oRegion.id}">{$oRegion.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="cell" style="width:65%">
								<div class="field"> 
									<label>District</label>
									<select id="iOrganisation_3" name="iDistrictId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
										<option value="0">s&eacute;l&eacute;ctionner un district</option>
										{foreach from=$toDistrict item=oDistrict }
										<option {if $oDistrict.id == $oCandidat.0->district_id} selected="selected" {/if} value="{$oDistrict.id}">{$oDistrict.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="cell" style="width:65%">
								<div class="field"> 
									<label>Departement</label>
									<select id="iOrganisation_4" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',4,this.value);">
										<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
										{foreach from=$oDepartement item=oDepartement1 }
										<option {if $oDepartement1.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement1.id}">{$oDepartement1.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="cell"  style="width:50%">
								<div class="field"> 
									<label>Direction</label>
									<select id="iOrganisation_5" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',5,this.value);">
										<option value="0">s&eacute;l&eacute;ctionner une direction</option>
										{foreach from=$oDirection item=oDirection1 }
										<option {if $oDirection1.id == $oCandidat.0->direction} selected="selected" {/if} value="{$oDirection1.id}">{$oDirection1.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="cell"  style="width:50%">
								<div class="field"> 
									<label>Service</label>
									<select id="iOrganisation_6" name="iServiceId" onChange="getOrganisation('{$zBasePath}',6,this.value);">
										<option value="0">s&eacute;l&eacute;ctionner un service</option>
										{foreach from=$oService item=oService1 }
										<option {if $oService1.id == $oCandidat.0->service} selected="selected" {/if} value="{$oService1.id}">{$oService1.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="cell"  style="width:50%">
								<div class="field"> 
									<label>Division</label>
									<select id="iOrganisation_7" name="iDivisionId" >
										<option value="0">s&eacute;l&eacute;ctionner une division</option>
										{foreach from=$oDivision item=oDivision1 }
										<option {if $oDivision1.id == $oCandidat.0->division} selected="selected" {/if} value="{$oDivision1.id}">{$oDivision1.libele}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
				</table>
			</fieldset>
		</form>
{literal}
<style>
td.left {width:20%}
</style>
<script type="text/javascript">

	function getOrganisation(_zBasePath, _iType, _iValue)
	{
		$(document).ready (function ()
		{
			
			for(iBoucle=_iType+1;iBoucle<=7;iBoucle++){
				$('#iOrganisation_' + iBoucle).val('0');
				$('#iOrganisation_' + iBoucle).attr("disabled","disabled");
			}

			var iDistrictId = $('#iOrganisation_3').val();
			$.ajax({
				url: _zBasePath + "critere/organisation/" + _iType +'/' +_iValue ,
				type: 'POST',
				data: { iDistrictId:iDistrictId},
				success: function(data, textStatus, jqXHR) {
					iType = _iType+1;
					$('#iOrganisation_' + iType).removeAttr("disabled");
					$('#iOrganisation_' + iType).html(data);
					
				},
				async: false
			});
		});
	}

	function getSelect2 (_iCIbleId, _zType='institut',_zData) {

		$("#" + _iCIbleId).select2
		({
			initSelection: function (element, callback)
			{
				$(_zData).each(function()
				{
					if (this.id == element.val())
					{
						callback(this);
						return
					}
				})
			},
			allowClear: true,
			placeholder:"Sélectionnez",
			minimumInputLength: 1,
			multiple:false,
			width: '50%!important',
			formatNoMatches: function () { return $("#AucunResultat").val(); },
			formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
			formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
			formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
			formatSearching: function () { return "Recherche..."; },			
			ajax: { 
				url: "{/literal}{$zBasePath}{literal}reclassement/getTableSearch/",
				dataType: 'jsonp',
				data: function (term)
				{
					return {q: term, iFiltre:1,zType:_zType};
				},
				results: function (data)
				{
					return {results: data};
				}
			},
			dropdownCssClass: "bigdrop"
		}) ;

	}


	$(document).ready (function ()
	{
		
				var dataArrayAutorite = [{id:$("#iUserAutoriteId").val(),text:$("#zUserSelectAutoriteId").val()}];
	
				$("#zCandidatSearch").select2
				({
					initSelection: function (element, callback)
					{

					$(dataArrayAutorite).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
					},
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

				$("#zCandidatSearch").select2('val',$("#iUserAutoriteId").val());

				$('#iManuel').click(function(){
		
					var iValue = $('#iManuel').is(':checked');  

					switch (iValue) {
						case true:
							$("#searchCandidat").hide();
							$("#searchAutorite").show();
							$("#zAutoriteManuel").addClass("obligatoire");
							break;

						case false:
							$("#searchCandidat").show();
							$("#searchAutorite").hide();
							$("#zAutoriteManuel").removeClass("obligatoire");
							$("#zAutoriteManuel").val("");
							break;
					}

					
				});
				
				
				$('.iClassificationClass').click(function(){
		
					var iTypeDossierId = $(this).val();  
					switch (iTypeDossierId){
						case '1':
							$("#iAnneeReclassement").val({/literal}{$iAnnee}{literal})
							break;
						
						case '2':
							$("#iAnneeReclassement").val({/literal}{$iBoucle}{literal})
							break;
					}
				});

				var dataArrayInstitut = [{id:$("#iInstitutSelectId").val(),text:$("#zInstitutSelectId").val()}];
				var dataArrayDiplome = [{id:$("#iDiplomeSelectId").val(),text:$("#zDiplomeSelectId").val()}];

				getSelect2('iInstituId','institut',dataArrayInstitut);
				getSelect2('iDiplomeId','diplome',dataArrayDiplome);

				$("#iInstituId").select2('val',$("#iInstitutSelectId").val());
				$("#iDiplomeId").select2('val',$("#iDiplomeSelectId").val());

				var dataArrayAgent = [{id:$("#iUserSelectId").val(),text:$("#zUserSelectId").val()}];
				$("#iUserSearchId").select2
				({
					initSelection: function (element, callback)
					{

					$(dataArrayAgent).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
					},
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

					$("#iUserSearchId").select2('val',$("#iUserSelectId").val());
	})
</script>
{/literal}