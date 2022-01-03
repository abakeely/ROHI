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
	<div class="libele_form">
		<label class="control-label " data-original-title="" title=""><b> Statut </b></label>
	</div>
	<div class="form">
		{if $iStatus && $iStatus != '0'}
		<input type="hidden" name="statut" value="{$iStatus}">
		{/if}
		<select class="form-control" placeholder="Status" name="statut" data-placement="top" {if $iStatus && $iStatus != '0'}disabled="disabled"{/if} data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire" id="statut">
			{foreach from=$oData.list_statut item=oStatus}
				<option  value={$oStatus.id} {if $oStatus.id==$iStatus}selected="selected"{/if}>{$oStatus.libele}</option>
			{/foreach}
			
		</select>
	</div>
	<div class="libele_form">
		<label class="control-label " data-original-title="" title=""><b> Corps</b> </label>
	</div>
	<div class="form">
		<select id="corps" class="form-control" placeholder="Corps" name="corps" {if $iCorp && $iCorp!='0'}disabled="disabled"{/if}data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
			
			{foreach from=$oData.list_corps item=oCorp}
				<option  value={$oCorp.id} {if $oCorp.id==$iCorp}selected="selected"{/if}>{$oCorp.libele}</option>
			{/foreach}
			<option  value="0">AUTRES</option> 
		</select>
	</div>
	<div class="form">
		{if isset($zAutreCorp)}
			<input type="text" name="autre_corps" class="form-control" id="autre_corps" value="{$zAutreCorp}" data-original-title="" title=""/>
		{else}
			<input type="text" name="autre_corps" class="form-control" id="autre_corps" style="display: none" data-original-title="" title=""/>
		{/if}
	</div>
	<div class="libele_form">
		<label class="control-label " data-original-title="" title=""><b> Grade</b> </label>
	</div>
	<div class="form form-group">
		<select class="form-control" placeholder="Grade" name="grade" {if $iGrade!='0'}disabled="disabled"{/if} data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
			{foreach from=$oData.list_grade item=oGrade}
				<option  value={$oGrade.id} {if $oGrade.id==$iGrade}selected="selected"{/if}>{$oGrade.libele}</option>
			{/foreach}
			<option  value="0">AUTRES</option> 
			
		</select>
	</div>
	<div class="form form-group">
		<input type="text" name="autre_grade" class="form-control" id="autre_grade" style="display: none" data-original-title="" title="">
	</div>
	<div class="libele_form">
		<label class="control-label " data-original-title="" title=""><b> Indice </b></label>
	</div>
	<div class="form form-group">
		<select class="form-control" placeholder="Indice" name="indice" {if $iIndice!='0'}disabled="disabled"{/if} data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
			{foreach from=$oData.list_indice item=oIndice}
				<option  value={$oIndice.id} {if $oIndice.id==$iIndice}selected="selected"{/if}>{$oIndice.libele}</option>
			{/foreach}
			<option  value="0">AUTRES</option> 
			
		</select>
	</div>
	<div class="form">
		{if isset($zAutreIndice)}
			<input type="text" name="autre_indice" class="form-control" id="autre_indice" value="{$zAutreIndice}" data-original-title="" title=""/>
		{else}
			<input type="text" name="autre_indice" class="form-control" id="autre_indice" style="display: none" data-original-title="" title=""/>
		{/if}
	</div>
	<div class="labelForm libele_form">
		<label class="control-label" data-original-title="" title=""><b>Date de prise de service</b><b><font color="red"> * </font></b></label>
	</div>
	<div class="form-group input-group form"  id="date_prise_service_div">
		<input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="{$oCandidatCv->date_prise_service}" data-bv-field="date_prise_service">
		<span class="input-group-addon">  <span class="la la-calendar form-control-feedback"></span></span>
		<small class="help-block" data-bv-validator="notEmpty" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">Veuillez enter votre date du prise de service</small><small class="help-block" data-bv-validator="callback" data-bv-for="date_prise_service" data-bv-result="NOT_VALIDATED" style="display: none;">La Date de service doit être inférieur à la date de naissance</small>
	</div>
	<div class="labelForm libele_form">
		<label class="control-label" data-original-title="" title=""><b>Fonction Actuelle</b><b><font color="red"> * </font></b></label>
	</div>
	<div class="form-group input-group col-md-6" >
		<input type="text" class="form-control" placeholder="Fonction actuelle" style="border: 1px solid #626D71 !important;" name="poste" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  id="poste" value="{$oCandidatCv->poste}">
	</div>
	<div class="labelForm libele_form">
		<label class="control-label" data-original-title="" title=""><b>Domaines de Compétences</b><b><font color="red"> * </font></b></label>
	</div>
	<div class="form form-group" >
		<textarea name="domaine" id="domaine" class="form-control" rows=5  data-toggle="tooltip" data-original-title= "Soraty ireo karazana traikefa hafa voafehinao">{$oCandidatCv->domaine}</textarea>
	</div>
	<div class="labelForm libele_form">
		<label class="control-label" data-original-title="" title=""><b>Activit&eacute;</b><b><font color="red"> * </font></b></label>
	</div>
	<div class="form form-group">
		<table class="tableau" id="table_activite">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->activite_list item=oActivite}
				<tr id="row_activite_{$iIncrement}">
					{if $iIncrement!=1}<br>{/if}
						<td style="padding:2px;width:90%"><input type="text" class="form-control" placeholder="Activit&eacute;" style="border: 1px solid #626D71 !important;" name="activite[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny asa amandrarahanao"  value="{$oActivite.libele}"></td>
					{if $iIncrement!=0}
					<td><button class="form-control btn_close" type="button" onclick="deleteActivite({$iIncrement})"><i class="la la-close"></i></button>   
					{/if}</td>
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
	<div class="buttonForm">
		<button type="button" class="form-control" id="ajoutActivite" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy ny asa efa nosahaninao hatramin’izay" >Ajouter une activit&eacute;</button>
	</div>
	<div class="aide"> <u>Exemples</u>:
		Etudier les dossiers entrants,....

	</div>
	
		
	
	<div class="labelForm libele_form">
			<label class="control-label" data-original-title="" title=""><h2><b>Localité de service</b><b><font color="red"> * </font></b></h2></label>
		</div>
		<br><br>
		<div class="form" style="font-size : 14px !important; font-weight : bolder;">
			<input type="checkbox" id="radioMAD" name="radioMAD" onchange="onCheckBox(this)" {if $oData.miseDispo}checked{/if}/> Mis(e) à Disposition  (Coché si mis(e) à disposition....) <br><br>
			<div id="controlMfb" {if not $oData.miseDispo}class="hidden"{/if}><span style="margin-right:20px"><input id="mfbRadio" type="radio"  value="1" name="radioMFB" onclick="clickMFB()" {if $oData.miseDispo && $oData.iTypeMiseDispo==0}checked {elseif not $oData.miseDispo}checked{/if} /> MEF </span>
			<span><input id="nonMfbRadio" type="radio"  value="0" name="radioMFB" onclick="clickNonMFB()" {if $oData.miseDispo && $oData.iTypeMiseDispo==1}checked{/if} /> Autres </span></div>
		</div><br>
		
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

			<div class="row" id="div_localite_rapprochement">
				<div class="form col-md-3">
					<div class="libele_form">
						<label class="control-label label_rohi " data-original-title="" title=""><b> Pays(*) </b></label>
					</div>
					<select onchange="getLocalite($(this),'PROVINCE',1)" class="form-control" placeholder="pays" name="pays" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="pays">
						<option  value="0">-------</option> 
						{foreach from=$oData.list_pays item=oPays}
						<option  value="{$oPays.id}">{$oPays.libele}</option>
						{/foreach}
					</select>
				</div>
			</div>

			<div id="economieID">
				<!---------------------------------------------------------------->
				<div class="row" id="div_localite_organigramme"></div>
				<div class="row" id="div_org"></div>
				<div class="row " id="div_rap"></div>
				<input type="hidden" id="div_localite_curent">
				<input type="hidden" id="div_structure_curent">
				<input type="hidden" id="curent_page">
				<input type="hidden"   name="structure_id" id="structure_id">
				<div style="display:none;" id="template_structure" >
					<div class="form col-md-3" id="structure_niveau_[[source.niveau]]">
						<div class="libele_form">
							<label class="control-label label_rohi " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
						</div>
						[[#source]]
						<select class="form-control"   onChange="getChild($(this),[[source.niveau]]);"   name="[[source.name]]">
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
						<select class="form-control" onChange="getLocalite($(this),'[[source.niveau_suivant]]',[[source.niveau]]);" id="[[source.name]]_id" name="[[source.name]]">
							<option  value="0">-------</option> 
							[[#list]]
							  <option value="[[localite_id]]">[[localite_libelle]]</option>
							[[/list]]
						</select>
						[[/source]]
					</div>
				</div>
				<!---------------------------------------------------------------->
			
				{if $oCandidatCv->soa_list}
					<div class="labelForm libele_form">
						<label class="control-label " data-original-title="" title=""><b>SOA </b></label>
					</div>
					<div class="form">
						{foreach from=$oCandidatCv->soa_list item=soa}
							<div class="row">{$soa.libele}</div>
						{/foreach}
					</div>
					<div class="form">
						{if $autre_service}
							<input type="text" name="autre_service" class="form-control" id="autre_service" value="{$autre_service}"/>
						{else}
							<input type="text" name="autre_service" class="form-control" id="autre_service" style="display: none"/>
						{/if}
					</div>
				{/if}

			<br>
			</div>
			
			<div class="labelForm libele_form">
				<label class="control-label " data-original-title="" title=""><b>Localit&eacute; de service </b><b><font color="red"> * </font></b></label>
			</div>
			<div class="form form-group">
				<input type="text" value="{$oCandidatCv->path}" class="form-control" placeholder="Localit&eacute; de service" name="path" data-placement="top" data-toggle="tooltip" data-original-title=""  id="path" >
			</div>
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
					structure.libelle			= "Structure Fils";
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
				$("#structure_id").val(donnees.child_id);
			}
		});
	}
		
</script>
{/literal}