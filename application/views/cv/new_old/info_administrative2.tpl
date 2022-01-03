{assign var=autre_service value=''}
{assign var=zAutreDivision value=''}
{if $oCandidatCv->service=='0' || $oCandidatCv->service=='999999'}
	{assign var=autre_service value=$oCandidatCv->autre_service}
{/if}
{if $oCandidatCv->division=='0' || $oCandidatCv->division=='999999'}
	{assign var=zAutreDivision value=$oCandidatCv->autre_division}
{/if}
<div class="panel-body">
	<h3>Informations administratives</h3>
	
	<div class="labelForm libele_form">
			<label class="control-label" data-original-title="" title=""><h2><b>Localité de service</b><b><font color="red"> * </font></b></h2></label>
		</div>

		<div id="departOrigine" {if $oData.miseDispo}class="col-md-6"{/if}>
			<br><br><span id="departOrigTitle" style="font-size : 12px; font-weight : bolder;" class="{if not $oData.miseDispo || ($oData.miseDispo && $oData.iTypeMiseDispo == 1)}hidden{/if}"><u>DEPARTEMENT D'ORIGINE</u></span><br>
			
			<div id="cacher-na" style="display:none">
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Pays </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Pays" onchange="changePays()" name="pays" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana"id="pays">
						{foreach from=$oData.list_pays item=oPays}
							<option  value={$oPays.id} {if $oPays.id==$oCandidatCv->pays_id}selected="selected"{/if}>{$oPays.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Province </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Province" onchange="changeProvince()" style="border: 1px solid #626D71 !important;" name="province" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="province">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_province item=oProvince}
							<option  value={$oProvince.id} {if $iExistCv && $oProvince.id==$oCandidatCv->province.id}selected="selected"{/if}>{$oProvince.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Region </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Region"  onchange="changeRegion()" name="region"  data-toggle="tooltip" data-original-title="Safidio ny Faritra misy anao" id="region">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_region item=oRegion}
							<option  value={$oRegion.id} {if $iExistCv && $oRegion.id==$oCandidatCv->region_id}selected="selected"{/if}>{$oRegion.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> District </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="District" onchange="changeDistrict()" name="district" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny Distrika misy anao" id="district">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_district item=oDistrict}
							<option  value={$oDistrict->id} {if $oDistrict->id==$oCandidatCv->district_id}selected="selected"{/if}>{$oDistrict->libele}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b> D&eacute;partement </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="form form-group">
				<select class="form-control" placeholder="Departement" onChange="getLocaliteCv('{$zBasePath}',1,this.value);"  name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement"{if $zRole=='chef'}{/if}>
					<option  value="0">-------</option> 
					{foreach from=$oData.list_departement item=oDepartement}
						<option  value={$oDepartement.id} {if $oDepartement.id==$oCandidatCv->departement}selected="selected"{/if}>{$oDepartement.libele}</option>
					{/foreach}
				</select>
			</div>

			<!---------------------------------------------------------------->

			<div id="iLocalite_1" class="clearfix">
				{$oData.zSelectDirection}
			</div>
			<br>
			<div id="iLocalite_2" class="clearfix">
				{$oData.zSelectService}
			</div>
			<br>
			<div id="iLocalite_3" class="clearfix">
				{$oData.zSelectSouService}
			</div>
			<br>
			<div id="iLocalite_4" class="clearfix">
				{$oData.zSelectDivision}
			</div>
			<br>
			<!--
			<div id="iLocalite_3" class="clearfix">
				<div>
					<div class="field">
						<label>Division</label>
						<select class="form-control" placeholder="Division" name="division" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="iDivisionId">
							<option  value="0">-------</option> 
							{foreach from=$oData.list_division item=oDivision}
							<option {if $oData.division_edit == $oDivision.id} selected="selected" {/if}  value="{$oDivision.id}">{$oDivision.libele}</option>
							{/foreach}
						</select>
						<p class="message debut" style="width:500px">&nbsp;</p>
					</div>
				</div>
			</div>
			-->
			<!---------------------------------------------------------------->
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b>Porte </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="form form-group">
				<input type="text" value="{$oCandidatCv->porte}" class="form-control" placeholder="Porte" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porte" >
			</div>
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b>Lieu de travail </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="form form-group">
				<input type="text" value="{$oCandidatCv->lacalite_service}" class="form-control" placeholder="Lieu de travail" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_service" >
			</div>
		</div>
		<div id="miseDispo" class="col-md-6 {if empty($oData.miseDispo)}hidden{/if}">
			<div class="form">
				
			</div>
			
			<div id="autreInstitution" {if isset($oData.miseDispo) && $oData.iTypeMiseDispo==1}class="hidden" {else}class="hidden"{/if}>
				<br><br><br>
				<div class="labelForm libele_form">
					<label class="control-label"><b>Institution : </b><b><font color="red"> * </font></b></label>
				</div>	
				<div class="control-group" id="searchCandidat2">
					<div class="bootstrap-colorpicker" style="display:block" > 
						<input placeholder="Veuillez entrer l'institution" type="text" id="iInstitutionId" name="iInstitutionId">
					</div>
				</div>
				
				<br><br><br><br><br>
				<div class="labelForm libele_form">
					<label for="colorpicker1" ><b>Département : </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="control-group">
					<div class="bootstrap-colorpicker" style="display:block"> 
						<input placeholder="Veuillez entrer le département"  style="width:100%" value="{if isset($oData.oDetache[0].detache_departement)}{$oData.oDetache[0].detache_departement}{/if}" type="text" id="iDepartementMADId" name="iDepartementMADId">
					</div>
				</div>
				<br>

				<div class="labelForm libele_form">
					<label for="colorpicker1" ><b>Direction : </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="control-group">
					<div class="bootstrap-colorpicker"  style="display:block"> 
						<input placeholder="Veuillez entrer la direction" style="width:100%" value="{if isset($oData.oDetache[0].detache_direction)}{$oData.oDetache[0].detache_direction}{/if}" type="text" id="iDirectionMADId" name="iDirectionMADId">
					</div>
				</div>
				<br>
				<div class="labelForm libele_form">
					<label for="colorpicker1" style="font-size:13px"><b>Service : </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="control-group">
					<div class="bootstrap-colorpicker" style="display:block"> 
						<input placeholder="Veuillez entrer le service" style="width:100%" value="{if isset($oData.oDetache[0].detache_service)}{$oData.oDetache[0].detache_service}{/if}" type="text" id="iServiceMADId" name="iServiceMADId">
					</div>
				</div>

				<br>
				<div class="labelForm libele_form">
					<label for="colorpicker1" style="font-size:13px"><b>Localité de Service : </b><b><font color="red"> * </font></b></label>
				</div>
				<br>
				<div class="control-group">
					<div class="bootstrap-colorpicker"> 
						<textarea id="zLocalite" name="zLocalite" style="width:100%">{if isset($oData.oDetache[0].detache_localite)}{$oData.oDetache[0].detache_localite}{/if}</textarea>
					</div>
				</div>
			</div>
			<div id="mfbInstitution" {if $oData.miseDispo}class="hidden" style="display:none"{/if}>
				<br><br><span id="madOrigTitle" style="font-size : 12px; font-weight : bolder;"><u>DEPARTEMENT D'ORIGINE</u></span><br>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Pays </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Pays" onchange="changePays('MAD')" name="paysMAD" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana"id="paysMAD">
						{foreach from=$oData.list_pays item=oPays}
							<option  value={$oPays.id} {if $oPays.id==$oData.oDetacheMfb[0].pays_id}selected="selected"{/if}>{$oPays.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Province </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Province" onchange="changeProvince('MAD')" style="border: 1px solid #626D71 !important;" name="provinceMAD" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="provinceMAD">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_province item=oProvince}
							<option  value={$oProvince.id} {if $oProvince.id==$oData.oDetacheMfb[0].province_id}selected="selected"{/if}>{$oProvince.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Region </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Region" onchange="changeRegion('MAD')" name="regionMAD"  data-toggle="tooltip" data-original-title="Safidio ny Faritra misy anao" id="regionMAD">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_region item=oRegion}
							<option  value={$oRegion.id} {if $oRegion.id==$oData.oDetacheMfb[0].region_id}selected="selected"{/if}>{$oRegion.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> District </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="District" onchange="changeDistrict('MAD')" name="districtMAD" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny Distrika misy anao" id="districtMAD">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_district item=oDistrict}
							<option  value={$oDistrict->id} {if $oDistrict->id==$oData.oDetacheMfb[0].district_id}selected="selected"{/if}>{$oDistrict->libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> D&eacute;partement </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Departement" onchange="changeDepartement('MAD')" name="departementMAD" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departementMAD"{if $zRole=='chef'}{/if}>
						<option  value="0">-------</option> 
						{foreach from=$oData.list_departement item=oDepartement}
							<option  value={$oDepartement.id} {if $oDepartement.id==$oData.oDetacheMfb[0].departement_id}selected="selected"{/if}>{$oDepartement.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b> Direction </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Direction" onchange="changeDirection('MAD')" name="directionMAD" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao" id="directionMAD"{if $zRole=='chef'}{/if}>
						<option  value="0">-------</option> 
						{foreach from=$oData.oDirectionForDetache item=oDirection}
							<option  value={$oDirection.id} {if $oDirection.id==$oData.oDetacheMfb[0].direction_id}selected="selected"{/if}>{$oDirection.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b>Service </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<select class="form-control" placeholder="Service" onchange="changeService('MAD')" name="serviceMAD" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="serviceMAD"{if $zRole=='chef'}{/if}>
						<option  value="0">-------</option> 
						{foreach from=$oData.oServiceForDetache item=oService}
							<option  value={$oService.id} {if $oService.id==$oData.oDetacheMfb[0].service_id}selected="selected"{/if}>{$oService.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b>Division </b></label>
				</div>
				<div class="form">
					<select class="form-control" placeholder="Division" onchange="changeDivision('MAD')" style="border: 1px solid #626D71 !important;" name="divisionMAD" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="divisionMAD">
						<option  value="999999">-------</option> 
						{foreach from=$oData.oDivisionForDetache item=oDivision}
							<option  value={$oDivision.id} {if $oDivision.id==$oData.oDetacheMfb[0].division_id}selected="selected"{/if}>{$oDivision.libele}</option>
						{/foreach}
					</select>
				</div>
				<div class="form">
					{if $zAutreDivision}
						<input type="text" name="autre_divisionMAD" class="form-control" id="autre_divisionMAD" value="{$zAutreDivision}"/>
					{else}
						<input type="text" name="autre_divisionMAD" class="form-control" id="autre_divisionMAD" style="display: none"/>
					{/if}
				</div>	
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b>Porte </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<input type="text" value="{$oData.oDetacheMfb[0].porte}" class="form-control" placeholder="Porte" name="porteMAD" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porteMAD" >
				</div>
				<div class="labelForm libele_form">
					<label class="control-label " data-original-title="" title=""><b>Lieu de travail </b><b><font color="red"> * </font></b></label>
				</div>
				<div class="form form-group">
					<input type="text" value="{$oData.oDetacheMfb[0].lieu_travail}" class="form-control" placeholder="Lieu de travail" name="lacalite_serviceMAD" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_serviceMAD" >
				</div>
			</div>
		</div>
</div>
<!--                                                    INFO ADMIN-->
{literal}
<style>
.select2-container {
    position: absolute;
    text-align: left;
    left: 10px;
    display: inline-block;
    zoom: 1;
    vertical-align: top;
}
</style>
<script>
	function onCheckBox(elem){
		if(elem.checked){
			$("#departOrigine").addClass("col-md-6");
			$("#miseDispo").removeClass("hidden");
			$("#controlMfb").removeClass("hidden");
		}else{
			$("#controlMfb").addClass("hidden");
			$("#miseDispo").addClass("hidden");
			$("#departOrigine").removeClass("col-md-6");
		}
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
	
	
		
</script>
{/literal}