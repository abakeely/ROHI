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
	<div class="row">
		<div class="form col-md-4">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Statut </b></label>
			</div>
			{if $iStatus && $iStatus != '0'}
				<input type="hidden" name="statut" value="{$iStatus}">
			{/if}
			<select class="form-control" placeholder="Status" name="statut" data-placement="top" {if $iStatus && $iStatus != '0'}disabled="disabled"{/if} data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire" id="statut">
				{foreach from=$oData.list_statut item=oStatus}
					<option  value={$oStatus.id} {if $oStatus.id==$iStatus}selected="selected"{/if}>{$oStatus.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Corps</b> </label>
			</div>
			<select id="corps" class="form-control" placeholder="Corps" name="corps" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
				
				{foreach from=$oData.list_corps item=oCorp}
					<option  value={$oCorp.id} {if $oCorp.id==$iCorp}selected="selected"{/if}>{$oCorp.libele}</option>
				{/foreach}
	
			</select>
		</div>
		<div class="form form-group col-md-4">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Grade</b> </label>
			</div>
			<select class="form-control" placeholder="Grade" name="grade"  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
				{foreach from=$oData.list_grade item=oGrade}
					<option  value={$oGrade.id} {if $oGrade.id==$iGrade}selected="selected"{/if}>{$oGrade.libele}</option>
				{/foreach}
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form col-md-4">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Indice </b></label>
			</div>
			<select class="form-control" placeholder="Indice" name="indice"  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
				{foreach from=$oData.list_indice item=oIndice}
					<option  value={$oIndice.id} {if $oIndice.id==$iIndice}selected="selected"{/if}>{$oIndice.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Fonction Actuelle</b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" class="form-control" placeholder="Fonction actuelle"  name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  id="poste" value="{$oCandidatCv->poste}">
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Date de prise de service</b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="{$oCandidatCv->date_prise_service}" data-bv-field="date_prise_service">
		</div>
	</div>
	<div class="row">
		<div class="form col-md-12">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Domaines de Compétences</b><b><font color="red"> * </font></b></label>
			</div>
			<textarea style="width:97%" name="domaine" id="domaine" class="form-control" rows=3 cols=100 data-toggle="tooltip" data-original-title= "Soraty ireo karazana traikefa hafa voafehinao">{$oCandidatCv->domaine}</textarea>
		</div>
	</div>
</div>
<div class="panel-body">
	<h3>Localité de service</h3>
	<div class="row">
		<div class="form col-md-4">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> D&eacute;partement  </b></label>
			</div>
			<select class="form-control" placeholder="Departement"  onChange="getLocaliteCv('{$zBasePath}',1,this.value);" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement"{if $zRole=='chef'}{/if}>
				<option  value="0">-------</option> 
				{foreach from=$oData.list_departement item=oDepartement}
					{if $oDepartement.id != 1}
					<option  value={$oDepartement.id} {if $oDepartement.id==$oCandidatCv->departement}selected="selected"{/if}>{$oDepartement.libele}</option>
					{/if}
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4" id="iLocalite_1">
			{$oData.zSelectDirection}
		</div>
		<div class="form col-md-4" id="iLocalite_2">
			{$oData.zSelectService}
		</div>
	</div>
	<div class="row">
		<div class="form col-md-4" id="iLocalite_3">
			{$oData.zSelectSouService}
		</div>
		<div class="form col-md-4" id="iLocalite_4">
			{$oData.zSelectDivision}
		</div>
		<div class="form col-md-4" id="iLocalite_5">
			{$oData.zSelectBureau}
		</div>
	</div>
	<div class="row">
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b>Porte </b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" value="{$oCandidatCv->porte}" class="form-control" placeholder="Porte" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porte" >
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b>Porte </b><b><font color="red"> * </font></b></la<label class="control-label " data-original-title="" title=""><b>Lieu de travail </b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" value="{$oCandidatCv->lacalite_service}" class="form-control" placeholder="Lieu de travail" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_service" >
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form ">
				<label class="control-label " data-original-title="" title=""><b> Mis(e) à Disposition  (sélectionner si mis(e) à disposition....)   </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Pays" onchange="misALaDisposition()" name="isMad" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay institution" id="isMad">
					<option  value="0">Selectionner</option>
					<option {if !$oData.miseDispo}selected{/if} value="0">Non</option>
					<option {if $oData.miseDispo}selected{/if} value="1">Oui</option>
			</select>
		</div>
	</div>
	<div class="row" id="bloc_institution" class="panel-body {if not $oData.miseDispo}hidden{/if}">
		<div class="form col-md-4">
			<div class="labelForm libele_form ">
				<label class="control-label " data-original-title="" title=""><b> Institution  </b><b><font color="red"> * </font></b></label>
			</div>
			<select id="institutionMad" name="institutionMad" onchange="selectInstitution()" class="form-control"  data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay institution" >
				<option {if $oData.miseDispo && $oData.iTypeMiseDispo==0}selected{/if} value="0">Autres</option>
				<option {if $oData.miseDispo && $oData.iTypeMiseDispo==1}selected{/if} value="1">MEF</option>
			</select>
		</div>
	</div>
</div>

<div id="miseDispoMef" class="panel-body {if not $oData.miseDispo}hidden{/if}">
	<h3>DEPARTEMENT D'ORIGINE</h3>
	<div class="row">
		<div class="form col-md-4">
			<div class="labelForm libele_form ">
				<label class="control-label " data-original-title="" title=""><b> Pays </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Pays" onchange="changePays('MAD')" name="paysMAD" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana"id="paysMAD">
				{foreach from=$oData.list_pays item=oPays}
					<option  value={$oPays.id} {if $oPays.id==$oData.oDetacheMfb[0].pays_id}selected="selected"{/if}>{$oPays.libele}</option>
				{/foreach}
			</select>
		</div>
	</div>

	<div class="row" > 
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b> Province </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Province" onchange="changeProvince('MAD')" style="border: 1px solid #626D71 !important;" name="provinceMAD" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="provinceMAD">
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.list_province item=oProvince}
					<option  value={$oProvince.id} {if $oProvince.id==$oData.oDetacheMfb[0].province_id}selected="selected"{/if}>{$oProvince.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b> Region </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Region" onchange="changeRegion('MAD')" name="regionMAD"  data-toggle="tooltip" data-original-title="Safidio ny Faritra misy anao" id="regionMAD">
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.list_region item=oRegion}
					<option  value={$oRegion.id} {if $oRegion.id==$oData.oDetacheMfb[0].region_id}selected="selected"{/if}>{$oRegion.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b> District </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="District" onchange="changeDistrict('MAD')" name="districtMAD" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny Distrika misy anao" id="districtMAD">
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.list_district item=oDistrict}
					<option  value={$oDistrict->id} {if $oDistrict->id==$oData.oDetacheMfb[0].district_id}selected="selected"{/if}>{$oDistrict->libele}</option>
				{/foreach}
			</select>
		</div>
	</div>

	<div class="row" >
		
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" ><b>Département : </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Departement" onchange="changeDepartement('MAD')" name="departementMAD" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departementMAD"{if $zRole=='chef'}{/if}>
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.list_departement item=oDepartement}
					<option  value={$oDepartement.id} {if $oDepartement.id==$oData.oDetacheMfb[0].departement_id}selected="selected"{/if}>{$oDepartement.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" ><b>Direction : </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Direction" onchange="changeDirection('MAD')" name="directionMAD" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao" id="directionMAD"{if $zRole=='chef'}{/if}>
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.oDirectionForDetache item=oDirection}
					<option  value={$oDirection.id} {if $oDirection.id==$oData.oDetacheMfb[0].direction_id}selected="selected"{/if}>{$oDirection.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Service : </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Service" onchange="changeService('MAD')" name="serviceMAD" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="serviceMAD"{if $zRole=='chef'}{/if}>
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.oServiceForDetache item=oService}
					<option  value={$oService.id} {if $oService.id==$oData.oDetacheMfb[0].service_id}selected="selected"{/if}>{$oService.libele}</option>
				{/foreach}
			</select>
		</div>
	</div>

	<div class="row" >
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Division : </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Division" onchange="changeDivision('MAD')" style="border: 1px solid #626D71 !important;" name="divisionMAD" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="divisionMAD">
				<option  value="999999">Selectionner</option> 
				{foreach from=$oData.oDivisionForDetache item=oDivision}
					<option  value={$oDivision.id} {if $oDivision.id==$oData.oDetacheMfb[0].division_id}selected="selected"{/if}>{$oDivision.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Bureau : </b><b><font color="red"> * </font></b></label>
			</div>
			<select class="form-control" placeholder="Service" onchange="changeService('MAD')" name="serviceMAD" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="serviceMAD"{if $zRole=='chef'}{/if}>
				<option  value="0">Selectionner</option> 
				{foreach from=$oData.oServiceForDetache item=oService}
					<option  value={$oService.id} {if $oService.id==$oData.oDetacheMfb[0].service_id}selected="selected"{/if}>{$oService.libele}</option>
				{/foreach}
			</select>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Porte : </b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" value="{$oData.oDetacheMfb[0].porte}" class="form-control" placeholder="Porte" name="porteMAD" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porteMAD" >
		</div>
	</div>
	<div class="row" >
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Lieu de travail : </b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" value="{$oData.oDetacheMfb[0].lieu_travail}" class="form-control" placeholder="Lieu de travail" name="lacalite_serviceMAD" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_serviceMAD" >
		</div>
	</div>
</div>

<div id="miseDispoAutres" class="panel-body {if not $oData.miseDispo}hidden{/if}">
	<h3>DEPARTEMENT D'ORIGINE</h3>
	<div class="row">
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label class="control-label"><b>Institution : </b><b><font color="red"> * </font></b></label>
			</div>	
			<div class="control-group" id="searchCandidat2">
				<div class="bootstrap-colorpicker" style="display:block" > 
					<input placeholder="Veuillez entrer l'institution" type="text" id="iInstitutionId" name="iInstitutionId">
				</div>
			</div>
		</div>
	</div>
	</br></br></br>
	<div class="row" > 
		<div class="form col-md-4" style="">
			<div class="labelForm libele_form">
				<label for="colorpicker1" ><b>Département : </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="control-group">
				<div class="bootstrap-colorpicker" style="display:block;margin:0 0 0 -22px"> 
					<input placeholder="Veuillez entrer le département" value="{if isset($oData.oDetache[0].detache_departement)}{$oData.oDetache[0].detache_departement}{/if}" type="text" id="iDepartementMADId" name="iDepartementMADId">
				</div>
			</div>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" ><b>Direction : </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="control-group">
				<div class="bootstrap-colorpicker"  style="display:block;margin:0 0 0 -22px"> 
					<input placeholder="Veuillez entrer la direction"  value="{if isset($oData.oDetache[0].detache_direction)}{$oData.oDetache[0].detache_direction}{/if}" type="text" id="iDirectionMADId" name="iDirectionMADId">
				</div>
			</div>
		</div>
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Service : </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="control-group">
				<div class="bootstrap-colorpicker" style="display:block;margin:0 0 0 -22px"> 
					<input placeholder="Veuillez entrer le service"  value="{if isset($oData.oDetache[0].detache_service)}{$oData.oDetache[0].detache_service}{/if}" type="text" id="iServiceMADId" name="iServiceMADId">
				</div>
			</div>
		</div>
	</div>
	<div class="row" > 
		<div class="form col-md-4">
			<div class="labelForm libele_form">
				<label for="colorpicker1" style="font-size:13px"><b>Localité de Service : </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="control-group">
				<div class="bootstrap-colorpicker" style="display:block;margin:0 0 0 -22px"> 
					<textarea id="zLocalite" name="zLocalite" >{if isset($oData.oDetache[0].detache_localite)}{$oData.oDetache[0].detache_localite}{/if}</textarea>
				</div>
			</div>
		</div>
	</div>
</div>

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
	$(document).ready(function(){
		selectInstitution();
	});
	function selectInstitution(){
		var isMisAlaDisposition = $("#isMad").val();
		if(isMisAlaDisposition=="1"){
			var institutionMad = $("#institutionMad").val();
			//0: autres
			//1:mef
			if( institutionMad == "1" ){
				$("#miseDispoMef").removeClass("hidden");
				$("#miseDispoAutres").addClass("hidden");
			}else{
				$("#miseDispoMef").addClass("hidden");
				$("#miseDispoAutres").removeClass("hidden");
			}
		}else{
			$("#miseDispoMef").addClass("hidden");
			$("#miseDispoAutres").addClass("hidden");
		}
	}
	function misALaDisposition(elem){
		var isMisAlaDisposition = $("#isMad").val();

		if(isMisAlaDisposition=="1"){
			var institutionMad = $("#institutionMad").val();
			if( institutionMad == "1" ){
				$("#miseDispoMef").removeClass("hidden");
				$("#miseDispoAutres").addClass("hidden");
			}else{
				$("#miseDispoMef").addClass("hidden");
				$("#miseDispoAutres").removeClass("hidden");
			}
		}else{
			$("#miseDispoMef").addClass("hidden");
			$("#miseDispoAutres").addClass("hidden");
		}
	}
	var dataArrayAgent1 = [{id:$("#idSelect2").val(),
							text:$("#textSelect2").val()}
	];	
	$("#iInstitutionId").select2({
		initSelection: function (element, callback){
			$(dataArrayAgent1).each(function(){
				if (this.id == element.val()){
					callback(this);
					return
				}
			})
		},
		allowClear			: true,
		placeholder			: "Sélectionnez",
		minimumInputLength	: 3,
		multiple			: false,
		width				: "100%",
		formatNoMatches: function () { 
			return $("#AucunResultat").val(); 
		},
		formatInputTooShort: function (input, min) { 
			return "Veuillez saisir plus de " + (min - input.length) + " lettres"; 
		},
		formatSelectionTooBig: function (limit) { 
			return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); 
		},
		formatLoadMore: function (pageNumber) { 
			return $("#chargement").val(); 
		},
		formatSearching: function () { 
			return "Recherche..."; 
		},			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/getInstitution/",
			dataType: 'jsonp',
			data: function (term){
				return {q: term, iFiltre:1};
			},
			results: function (data){
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;
	$("#iInstitutionId").select2('val',$("#idSelect2").val());
</script>
{/literal}