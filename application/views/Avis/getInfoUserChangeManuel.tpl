<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
<input type="hidden" name="iUserTarget" id="iUserTarget" value="{$iUserTarget}">
<p>&nbsp;</p>
<div id="">
		<input type="hidden" name="idSelect2" id="idSelect2" value="">
		<input type="hidden" name="textSelect2" id="textSelect2" value="">
		<h3 id="titlePopUpDialog">
			Afin de mettre à jour la base de données du personnel du MFB, un formulaire apparaitra à la première  consultation  du titre de paiement dans ROHI à partir de ce 1er  juin 2018.
			Comptant sur votre collaboration et votre compréhension.<br>
			La DRHA
		</h3><br>
		<form enctype="multipart/form-data">
			<fieldset style="padding-left : 3% !important">
				<div class="row1" style="width:100%">
					<div class="cell">
						<div class="field">
							<label><b>Nom :</b> {$oCandidat.0->nom}</label>
							<label>Matricule : {$oCandidat.0->matricule}</label>
						</div>
					</div>
				</div>
				<div class="row1">
					<div class="cell small">
						<div class="field">
							<label>Pr&eacutenom(s) : {$oCandidat.0->prenom}</label>
						</div>
					</div>
				</div>
				<div class="row1 clearfix">
					<div class="cell">
						<div class="field">
							
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell" style="width:50%">
						<div class="field"> 
							<label>Province</label>
							<select class="obligatoire" id="iOrganisation_1" name="iProvinceId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
								<option value="0">s&eacute;l&eacute;ctionner une province</option>
								{foreach from=$toProvince item=oProvince }
								<option {if $oProvince.id == $oCandidat.0->province_id} selected="selected" {/if} value="{$oProvince.id}">{$oProvince.libele}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell" style="width:50%">
						<div class="field"> 
							<label>Région</label>
							<select class="obligatoire" id="iOrganisation_2" name="iRegionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
								<option value="0">s&eacute;l&eacute;ctionner une région</option>
								{foreach from=$toRegion item=oRegion }
								<option {if $oRegion.id == $oCandidat.0->region_id} selected="selected" {/if} value="{$oRegion.id}">{$oRegion.libele}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell" style="width:50%">
						<div class="field"> 
							<label>District</label>
							<select class="obligatoire" id="iOrganisation_3" name="iDistrictId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
								<option value="0">s&eacute;l&eacute;ctionner un district</option>
								{foreach from=$toDistrict item=oDistrict }
								<option {if $oDistrict.id == $oCandidat.0->district_id} selected="selected" {/if} value="{$oDistrict.id}">{$oDistrict.libele}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell" style="width:50%">
						<div class="field"> 
							<label>Departement</label>
							<select class="obligatoire" id="iOrganisation_4" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',4,this.value);">
								<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
								{foreach from=$oDepartement item=oDepartement }
								<option {if $oDepartement.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement.id}">{$oDepartement.libele}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>Direction</label>
							<select  class="obligatoire" id="iOrganisation_5" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',5,this.value);">
								<option value="0">s&eacute;l&eacute;ctionner une direction</option>
								{foreach from=$oDirection item=oDirection }
								<option {if $oDirection.id == $oCandidat.0->direction} selected="selected" {/if} value="{$oDirection.id}">{$oDirection.libele}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>Service</label>
							<select class="obligatoire" id="iOrganisation_6" name="iServiceId" onChange="getOrganisation('{$zBasePath}',6,this.value);">
								<option value="0">s&eacute;l&eacute;ctionner un service</option>
								{foreach from=$oService item=oService }
								<option {if $oService.id == $oCandidat.0->service} selected="selected" {/if} value="{$oService.id}">{$oService.libele}</option>
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
								{foreach from=$oDivision item=oDivision }
								<option {if $oDivision.id == $oCandidat.0->division} selected="selected" {/if} value="{$oDivision.id}">{$oDivision.libele}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>Localit&eacute; de Service (site)</label>
							<input class="form-control obligatoire" type="text" id="zLocalite" class="form-control" placeholder="Localit&eacute; de Service" name="zLocalite" data-toggle="tooltip" data-original-title="" value="">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>Porte</label>
							<input class="form-control obligatoire" type="text" id="zPorte" class="form-control" placeholder="Porte" name="zPorte" data-toggle="tooltip" data-original-title="" value="">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>T&eacute;l&eacute;phone</label>
							<input type="text" id="zPhone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="zPhone" data-toggle="tooltip" data-original-title="" value="{$oCandidat.0->phone}">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell"  style="width:50%">
						<div class="field"> 
							<label>Fonction</label>
							<select class="obligatoire" id="iFonctionId" name="iFonctionId">
								<option value="0">s&eacute;l&eacute;ctionner votre fonction</option>
								{foreach from=$oFonction item=oFonction }
								<option value="{$oFonction.fonction_id}">{$oFonction.fonction_name}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div id="sous-fonction" class="cell hidden"  style="width:50%">
						<div class="field"> 
							<label>Sous-fonction</label>
							<select id="selectSousFonction" name="iSousFonctionId">
							</select>
						</div>
					</div>
				</div>
				<div id="mise_a_dispo_avis">
					<div class="widget-box widget-color-dark" style="margin:0px">
						<div class="widget-header" style="margin:0px">
							<h5 class="widget-title bigger lighter">Mise à disposition(à l'exterieur du MFB)</h5>
						</div>
						<div class="widget-body">
							<div class="checkbox clearfix">
								<label>
									<input class="form-control" id="iMiseDisposition" name="iMiseDisposition" type="checkbox" value="1" {if $iDetache==1} checked="checked"{/if} class="">
									<span class="lbl" style="font-size:13px"> Oui</span>
								</label>
							</div>
							<div class="widget-main">
								<div class="clearfix">
									<label for="colorpicker1" style="font-size:13px">Institution :</label>
								</div>
								<div class="control-group">
									<div class="bootstrap-colorpicker" id="searchCandidat2" style="display:block"> 
										<input class="form-control" placeholder="Veuillez entrer l'institution" type="text" id="iInstitutionId" name="iInstitutionId">
										<p id="iInstitutionSearchMessage" class="message" style="width:90%">Veuillez s&eacute;l&eacute;ctionner l'institution</p>
									</div>
								</div>

								<br>
								<div class="clearfix">
									<label for="colorpicker1" style="font-size:13px">Département :</label>
								</div>
								<div class="control-group">
									<div class="bootstrap-colorpicker" style="display:block"> 
										<input class="form-control" placeholder="Veuillez entrer le département"  style="width:100%" value="{$oDetache[0].detache_departement}" type="text" id="iDepartementMADId" name="iDepartementMADId">
									</div>
								</div>
								<br>

								<div class="clearfix">
									<label for="colorpicker1" style="font-size:13px">Direction :</label>
								</div>
								<div class="control-group">
									<div class="bootstrap-colorpicker"  style="display:block"> 
										<input class="form-control" placeholder="Veuillez entrer la direction" style="width:100%" value="{$oDetache[0].detache_direction}" type="text" id="iDirectionMADId" name="iDirectionMADId">
									</div>
								</div>
								<br>
								<div class="clearfix">
									<label for="colorpicker1" style="font-size:13px">Service :</label>
								</div>
								<div class="control-group">
									<div class="bootstrap-colorpicker" style="display:block"> 
										<input class="form-control" placeholder="Veuillez entrer le service" style="width:100%" value="{$oDetache[0].detache_service}" type="text" id="iServiceMADId" name="iServiceMADId">
									</div>
								</div>

								<br>
								<div class="clearfix">
									<label for="colorpicker1" style="font-size:13px">Localité de service:</label>
								</div>
								<br>
								<div class="control-group">
									<div class="bootstrap-colorpicker"> 
										<textarea id="zLocaliteMad" name="zLocaliteMad" style="width:100%">{$oDetache[0].detache_localite}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</fieldset>
		</form>
		
</div>
{literal}
<style>

.select2-drop-active {z-index:1000000000!important}

#titlePopUpDialog{
	text-align : center;
	font-weight : bold;
}

#mise_a_dispo_avis{
	position: absolute;
	float: right;
	right: 16px;
	width:35%;
	top:15%;
}

@media (max-width: 467px) {
	#mise_a_dispo_avis{
		position: relative;
		float: none;
		right: 0;
		width:100%;
	}
}

</style>
<script type="text/javascript">
function getSousFonction(_zBasePath,_iValue){
	$(document).ready (function (){
		if(_iValue == 6){
			$.ajax({
				url: _zBasePath + "avis/getSousFonction/" ,
				type: 'POST',
				data: { iFonctionId:_iValue},
				success: function(data, textStatus, jqXHR) {
					$('#selectSousFonction').html('');
					$('#selectSousFonction').html('<option value="0">S&eacute;l&eacute;ctionner votre sous-fonction</option>');
					$('#selectSousFonction').append(data);
					$('#sous-fonction').removeClass('hidden');
				},
				async: false
			});
		}else{
			if(!$('#sous-fonction').hasClass('hidden'))
				$('#sous-fonction').addClass('hidden');
			
			$('#selectSousFonction').html('');
			$('#selectSousFonction').html('<option value="0">S&eacute;l&eacute;ctionner votre sous-fonction</option>');
		}
	});
}

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
$(document).ready (function ()
{
	$("#zPhone").mask("999 99 999 99");
	/*$("#motifSuppression").hide();
	$('#iNoteEvaluable').click(function(){
		
		var iValue = $('#iNoteEvaluable').is(':checked'); 
		switch (iValue) {
			case true:
				$("#iDesevaluer").val(1);
				$("#motifSuppression").show();
				break;

			case false:
				$("#iDesevaluer").val(0);
				$("#motifSuppression").hide();
				break;
		}	
	});*/	
	$(window).resize(function() {
		if (window.matchMedia('(max-width: 467px)').matches) {
			console.log('if match');
			var _selector = $('#mise_a_dispo_avis').find('.widget-main');
			if($('#iMiseDisposition').is(':checked')){
				if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
			}else{
				if(!_selector.hasClass('hidden')) _selector.addClass('hidden');
			}
			$('#iMiseDisposition').click(function(){
				if($('#iMiseDisposition').is(':checked')){
					if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
				}else{
					if(!_selector.hasClass('hidden')) _selector.addClass('hidden');
				}
			});
		} else {
			var _selector = $('#mise_a_dispo_avis').find('.widget-main');
			$('#iMiseDisposition').click(function(){
				if($('#iMiseDisposition').is(':checked')){
					if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
				}else{
					if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
				}
			});
			if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
		}
	});
	if (window.matchMedia('(max-width: 467px)').matches) {
	console.log('if match');
		var _selector = $('#mise_a_dispo_avis').find('.widget-main');
		if($('#iMiseDisposition').is(':checked')){
			if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
		}else{
			if(!_selector.hasClass('hidden')) _selector.addClass('hidden');
		}
		$('#iMiseDisposition').click(function(){
			if($('#iMiseDisposition').is(':checked')){
				if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
			}else{
				if(!_selector.hasClass('hidden')) _selector.addClass('hidden');
			}
		});
    } else {
		console.log('else match');
        var _selector = $('#mise_a_dispo_avis').find('.widget-main');
		if(_selector.hasClass('hidden')) _selector.removeClass('hidden');
    }
			var dataArrayAgent1 = [{id:$("#idSelect2").val(),text:$("#textSelect2").val()}];
			
			$("#iInstitutionId").select2
			({
				initSelection: function (element, callback)
				{
					$(dataArrayAgent1).each(function()
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
				width: "100%",
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "{/literal}{$zBasePath}{literal}gcap/getInstitution/",
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

			$("#iInstitutionId").select2('val',$("#idSelect2").val());
});
</script>
{/literal}