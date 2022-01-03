{assign var=autre_service value=''}
{assign var=zAutreDivision value=''}
{if $oCandidatCv->service=='0' || $oCandidatCv->service=='999999'}
	{assign var=autre_service value=$oCandidatCv->autre_service}
{/if}
{if $oCandidatCv->division=='0' || $oCandidatCv->division=='999999'}
	{assign var=zAutreDivision value=$oCandidatCv->autre_division}
{/if}
<script src="{$zBasePath}assets/message/js/mustache.js"></script>

<div class="panel-body">
	<h3>Informations administratives</h3>
	<div class="row">
		<div class="form col-md-2">
			<div class="libele_form">
				<label class="control-label label_rohi " data-original-title="" title=""><b> Statut </b></label>
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
				<label class="control-label label_rohi " data-original-title="" title=""><b> Corps </b></label>
			</div>
			<select id="corps" class="form-control" placeholder="Corps" name="corps" {if $iCorp && $iCorp!='0'}disabled="disabled"{/if}data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
			{foreach from=$oData.list_corps item=oCorp}
				<option  value={$oCorp.id} {if $oCorp.id==$iCorp}selected="selected"{/if}>{$oCorp.libele}</option>
			{/foreach}
			</select>
		</div>
		<div class="form col-md-3">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Grade</b> </label>
			</div>
			<select class="form-control" placeholder="Grade" name="grade" {if $iGrade!='0'}disabled="disabled"{/if} data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
			{foreach from=$oData.list_grade item=oGrade}
				<option  value={$oGrade.id} {if $oGrade.id==$iGrade}selected="selected"{/if}>{$oGrade.libele}</option>
			{/foreach}
			<option  value="0">AUTRES</option> 
			</select>
		</div>
		<div class="form col-md-3">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Indice</b> </label>
			</div>
			<select class="form-control" placeholder="Indice" name="indice" {if $iIndice!='0'}disabled="disabled"{/if} data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
			{foreach from=$oData.list_indice item=oIndice}
				<option  value={$oIndice.id} {if $oIndice.id==$iIndice}selected="selected"{/if}>{$oIndice.libele}</option>
			{/foreach}
			</select>
		</div>
	</div>
	
	<div class="row">
		<div class="form col-md-3">
			<div class="libele_form">
				<label class="control-label " data-original-title="" title=""><b> Date de prise de service</b> </label>
			</div>
			<div class="form-group input-group form"  id="date_prise_service_div">
				<!--input type="text" id="date_prise_service11" data-dd-opt-default-date="{$oCandidatCv->date_prise_service|date_format2}" class="form-control withDatePicker" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="{$oCandidatCv->date_prise_service}" data-bv-field="date_prise_service"-->
				
				<input type="text" id="date_prise_service" class="form-control " placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="{$oCandidatCv->date_prise_service}" data-bv-field="date_prise_service">
				
				<span class="input-group-addon">  <span class="la la-calendar form-control-feedback"></span></span>
				<small class="help-block" data-bv-validator="notEmpty" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez enter votre date du prise de service</small><small class="help-block" data-bv-validator="callback" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">La Date de service doit être inférieur à la date de naissance</small>
			</div>
		</div>
		<div class="form col-md-3">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Fonction Actuelle</b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" class="form-control" placeholder="Fonction actuelle" style="border: 1px solid #626D71 !important;" name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa <::bgb,gb,bjbbbg!!"  id="poste" value="{$oCandidatCv->poste}">
		</div>
		<div class="form col-md-6">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Domaines de Compétences</b><b><font color="red"> * </font></b></label>
			</div>
			<textarea name="domaine" id="domaine" class="form-control" rows=5  data-toggle="tooltip" data-original-title= "Soraty ireo karazana traikefa hafa voafehinao">{$oCandidatCv->domaine}</textarea>
		</div>
	</div>
	<div class="row">
		<div style="display:none;" id="template_structure" >
			<div class="form col-md-3" id="structure_niveau_[[source.niveau]]">
				<div class="libele_form">
					<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
				</div>
				[[#source]]
				<select class="form-control structure"   onChange="getChild($(this),[[source.niveau]]);"   name="">
					<option  value="0">-------</option> 
					[[#list]]
					  <option value="[[child_id]]">[[child_libelle]]</option>
					[[/list]]
				</select>
				[[/source]]
			</div>
		</div>

		<div style="display:none;" id="template_localite" >
			<div class="form col-md-3" id="localite_niveau_[[source.niveau]]">
				<div class="libele_form">
					<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
				</div>
				[[#source]]
				<select required class="form-control" onChange="getLocalite($(this),'[[source.niveau_suivant]]',[[source.niveau]]);" id="[[source.name]]_id" name="[[source.name]]">
					<option  value="0">-------</option> 
					[[#list]]
					  <option value="[[localite_id]]">[[localite_libelle]]</option>
					[[/list]]
				</select>
				[[/source]]
			</div>
		</div>
		<div class="form col-md-3">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Departement / Direction / Service / Division / Bureau</b><b><font color="red"> * </font></b></label>
			</div>
			<div class="form form-group">
				<div class="input-group">
				<div class="input-group-addon" onclick="modifierStructureRattachement()">Modifier</div>
				<input  readonly="true" type="text" value="{$oCandidatCv->path}" class="form-control" placeholder="Localit&eacute; de service" name="path" data-placement="top" data-toggle="tooltip" data-original-title=""  id="path" >
			
				</div>
			</div>
		</div>
		<div class="form col-md-3">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>SOA</b><b><font color="red"> * </font></b></label>
			</div>
			<input readonly="true" type="text" value="{$oCandidatCv->soa}" class="form-control" placeholder="Localit&eacute; de service" name="soa" data-placement="top" data-toggle="tooltip" data-original-title=""  id="soa" >
		</div>
		<div class="form col-md-3">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Porte</b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" value="{$oCandidatCv->porte}" class="form-control" placeholder="Porte" name="porte" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny varavarana ny toeram-piasanao"  id="porte" >
		</div>
		<div class="form col-md-3">
			<div class="labelForm libele_form">
				<label class="control-label" data-original-title="" title=""><b>Lieu de travail</b><b><font color="red"> * </font></b></label>
			</div>
			<input type="text" value=" {$zLocaliteDeService}" class="form-control" placeholder="Lieu de travail" name="lacalite_service" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny toeram-piasanao"  id="lacalite_service" >
		</div>
	</div>
	<div class="row">
		<div class="form col-md-12">
			<div class="row" id="div_localite_rapprochement" style="display:none;">
				<div class="form col-md-3">
					<div class="libele_form">
						<label class="control-label label_rohi " data-original-title="" title=""><b> Ministere(*) </b></label>
					</div>
					<select onchange="getChild($(this),1)" class="form-control" placeholder="Ministere" name="Ministere" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="choix_ministere">
						<option  value="0">-------</option> 
						<option  selected="selected" value="1">MEF</option>
					</select>
				</div>
			</div>
			<div id="block_rattachement" style="display:none">
				<div class="row" id="div_localite_organigramme"></div>
				<div class="row" id="div_org"></div>
				<div class="row " id="div_rap"></div>
				<input type="hidden" id="div_localite_curent">
				<input type="hidden" id="div_structure_curent">
				<input type="hidden" id="curent_page">
				<input type="hidden" name="structure_id" id="structure_id">
			</div>
		</div>

	</div>
	<h3>Autres Rattachement</h3>
	<div class="row">
		{if $structureMad != ""}
			<div class="col-md-12">
				<div class="labelForm libele_form">
					
					<label class="control-label"><b><i style="font-size:20px;" class="la la-check" aria-hidden="true"></i>Vous êtes mis à la disposition au <strong style="font-size:15px;">{$structureMad}</strong></p></label>
				</div>
			</div>
		{/if}
		<div id="miseDispo" class="col-md-10">
			<div class="labelForm libele_form">
					<label class="control-label"><b>Indiquer votre mise à la disposition: </b><b><font color="red"> * </font></b></label>
			</div>
			<input type="checkbox" id="radioMAD" name="radioMAD" />  (Coché ici si vous voulez changer votre structure de Mise à la disposition) <br><br>
		</div>
		<div id="miseDispo" class="col-md-6 ">
			<!--div id="autreInstitution" {if isset($oData.miseDispo) && $oData.iTypeMiseDispo==1}class="hidden" {else}class="hidden"{/if}!-->
			<div>
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
	$(document).ready(function(){
		//$("#choix_ministere").change();
	});
	
	function modifierStructureRattachement(){
		$("#choix_ministere").change();
		$("#block_rattachement").show();
	}
	
	var dataArrayAgent1 = [{id:$("#idSelect2").val(),text:$("#textSelect2").val()}];
			
	$("#iInstitutionId").select2({
		initSelection: function (element, callback){
			$(dataArrayAgent1).each(function(){
				if (this.id == element.val()){
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
	
	

     function getLocalite(curent_element,type_localite,niveau){
		var val_curent_element = curent_element.val() ;
		//var div_localite	   = $("val_curent_element").val();
		var div_localite	   = "div_localite_organigramme";
		var div_structure	   = $("#div_structure_curent").val();
		var structure_name	   = "";
		if(niveau == 1){
			var libelle			= "Province";
			var niveau_suivant	= "REGION";
			structure_name	    = "province";
		}
		if(niveau == 2){
			var libelle			= "Regions";
			var niveau_suivant  = "DISTRICT";
			structure_name	    = "regions";
		}
		if(niveau == 3){
			var libelle			= "District";
			var niveau_suivant = "";
			structure_name	    = "district";
		}
		if(niveau == 4){
			getDepartementByDistrictid(val_curent_element);
		}


		if (niveau<4){
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}GestionStructure/getLocalite/",
				type: 'post',
				data: {
					parent_id	: val_curent_element,
					type_localite	: type_localite
				},
				success: function(data, textStatus, jqXHR) {  
					for( var iIndex = niveau+1;iIndex<20;iIndex++){
						$('#localite_niveau_'+iIndex).remove();
					}
					data = data.replace("not allowed ", "");
					var donnees					=	JSON.parse(data);
						
					if(donnees.length > 0){
						var structure				= {};
						structure.libelle			= libelle;
						structure.list				= donnees;
						structure.name				= structure_name;
						structure.niveau			= niveau+1;
						structure.niveau_suivant	= niveau_suivant;
						Mustache.tags				= ["[[", "]]"];
						var template_child			= $('#template_localite').html();
						Mustache.parse(template_child);
						var rendered				= Mustache.render(template_child, {source :structure});
						$('#'+div_localite).append(rendered);
					}
					
				}
			});
		}
	}


	function getDepartementByDistrictid(district_id){
		var niveau = 0;
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}GestionStructure/getDepartementByDistrictid/",
			type: 'post',
			data: {
				district_id	: district_id,
				tree_type	: "DEPT"
			},
			success: function(data, textStatus, jqXHR) {  
				for( var iIndex = niveau+1;iIndex<20;iIndex++){
					$('#structure_niveau_'+iIndex).remove();
				}
				data = data.replace("not allowed ", "");
				var donnees					=	JSON.parse(data);
		
				if(donnees.length > 0){
					var structure				= {};
					structure.libelle			= "Departement";
					structure.list				= donnees;
					structure.niveau			= niveau+1;
					Mustache.tags				= ["[[", "]]"];
					var template_structure			= $('#template_structure').html();
					Mustache.parse(template_structure);
					var rendered				= Mustache.render(template_structure, {source :structure});
					if ( $("#curent_page").val() == "organigramme" ){
						$('#div_org').append(rendered);
					}else{
						$('#div_rap').append(rendered);
					}
					
				}
			}
		});
	}

	function getChild(curent_element,niveau){
		var val_curent_element = curent_element.val() ;
		getDetailStructure(val_curent_element);
		$("#parent_id").val(val_curent_element);

		$.ajax({
			url: "{/literal}{$zBasePath}{literal}GestionStructure/getChild/",
			type: 'post',
			data: {
				parent_id	: val_curent_element,
				tree_type	: "1",//CHILD DIRECT: 1 ,  CHILD HIERACHIQUE: 2 
				district_id:$("#district_id").val()
			},
			success: function(data, textStatus, jqXHR) {  
				for( var iIndex = niveau+1;iIndex<20;iIndex++){
					$('#structure_niveau_'+iIndex).remove();
				}
				data = data.replace("not allowed ", "");
				var donnees					=	JSON.parse(data);
				if(donnees.length > 0){
					var structure				= {};
					structure.libelle			= "Sélectionner jusqu'à la structure de rattachement";
					structure.list				= donnees;
					structure.niveau			= niveau+1;
					Mustache.tags				= ["[[", "]]"];
					var template_structure		= $('#template_structure').html();
					
					Mustache.parse(template_structure);
					var rendered				= Mustache.render(template_structure, {source :structure});
					if ( $("#curent_page").val() == "organigramme" ){
						$('#div_org').append(rendered);
					}else{
						$('#div_rap').append(rendered);
					}
					
				}
			}
		});
	}


	function getDetailStructure(curent_element){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}GestionStructure/getDetailStructure/",
			type: 'post',
			data: {
				child_id	: curent_element,
			},
			success: function(data, textStatus, jqXHR) {  
				data = data.replace("not allowed ", "");
				var donnees					= JSON.parse(data);
				//$("#soa_code").val(donnees.soa_code);
				$("#path").val(donnees.path);
				if(donnees.path){
					$('#cv_form').bootstrapValidator('enableFieldValidators', 'path', true);
				}else{
					$('#cv_form').bootstrapValidator('enableFieldValidators', 'path', false);
				}
				$("#structure_id").val(donnees.child_id);
			}
		});
	}
		
</script>
{/literal}