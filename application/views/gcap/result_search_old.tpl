{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/common/js/home.js?V2"></script>
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
        <div id="ContentBloc">
			<div id="ContentBloc">
			<h2>Localité de service</h2>
			<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> Localité de services111</div>
				<!---->
				<div class="SSttlPage">
                    <div id="searchAcc">
                        <div class="card punch-status">
							<h2>Modification localité de service (Département / direction / service)</h2>
							<form action="{$zBasePath}gcap/search_matricule" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data" style="display:block;">
							<input type="hidden" name="idSelect2" id="idSelect2" value="{if isset($oData.oDetache[0].institution_id)}{$oData.oDetache[0].institution_id}{/if}">
							<input type="hidden" name="textSelect2" id="textSelect2" value="{if isset($oData.oDetache[0].institution_libelle)}{$oData.oDetache[0].institution_libelle}{/if}">
							<fieldset>
							<div class="row1">
								<div >
									<div class="field">
										<label>&nbsp;</label>
										<select style="width:150px!important" class="form-control" name="type" onchange="changeMask()" id="type">
											<option value="im">MATRICULE</option>
											<option value="cin">CIN</option>
										</select>

										<p class="message debut" style="width:500px">&nbsp;</p>
									</div>
								</div>
							</div>
							<div class="row1">
								<div >
									<div class="field">
										<label>Matricule ou CIN</label>
										<input style="width:150px!important" class="form-control" placeholder="matricule ou CIN" name="im" id="num" value="{$oData.candidat->matricule}"/>
									</div>
								</div>
							</div>
							<div class="row1" id="searchCandidat">
								<div >
									<div class="field">
											<label>&nbsp;</label>
											<input style="width:300px!important" placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
									</div>
								</div>
							</div>
							<div >
								<div class="field">
									<button onclick="setListeEvaluation()" class="form-control">Afficher</button>
								</div>
							</div>
							</fieldset>
							</form>
						</div>
                        
                    </div>
                </div>
				<!---->

				<!-- contenu page -->
				<div class="contenuePage">
						<table>
							<tr>
								<td><h3>{$oData.candidat->nom} {$oData.candidat->prenom}</h3></td>
							</tr>
							<tr>
								<td>
									
									<form action="{$zBasePath}gcap/valide_respers" method="POST" name="formulaire" id="formulaire" enctype="multipart/form-data">
									<input type="hidden" value="{$oData.user_edit.id}" name="user_id"/>
									<input type="hidden" name="iLocalite" id="iLocalite" value="">
									<input type="hidden" name="zLocaliteNiveau" id="zLocaliteNiveau" value="">
									<fieldset>
											<div class="col-md-6">
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Pays</label>
															<select class="form-control" placeholder="pays" name="pays" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="pays">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_pays item=oPays}
																<option {if $oData.pays_edit == $oPays.id} selected="selected" {/if}  value="{$oPays.id}">{$oPays.libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Province</label>
															<select class="form-control" placeholder="province" name="province" data-toggle="tooltip" data-original-title= "Safidio ny faritany anao" id="province">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_province item=oProvince}
																<option {if $oData.province_edit == $oProvince.id} selected="selected" {/if}  value="{$oProvince.id}">{$oProvince.libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Région</label>
															<select class="form-control" placeholder="region" name="region" data-toggle="tooltip" data-original-title= "Safidio faritra misy anao" id="region">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_region item=oRegion}
																<option {if $oData.reg_edit == $oRegion.id} selected="selected" {/if}  value="{$oRegion.id}">{$oRegion.libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>District</label>
															<select class="form-control" placeholder="district" name="district" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="district">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_district item=oDistrict}
																<option {if $oData.district_edit == $oDistrict->id} selected="selected" {/if}  value="{$oDistrict->id}">{$oDistrict->libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Département</label>
															<select class="form-control" placeholder="departement" onChange="getLocaliteAffiche('{$zBasePath}',1,this.value);" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="iDepartementId">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_departement item=oDepartement}
																<option {if $oData.departement_edit == $oDepartement.id} selected="selected" {/if}  value="{$oDepartement.id}">{$oDepartement.libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div id="iLocalite_1" class="clearfix">
													{if $oData.zSelectDepartement!=""}
													{$oData.zSelectDepartement}
													{else}
													<div>
														<div class="field">
															<label>Direction</label>
															<select class="form-control" placeholder="Direction" name="direction" onChange="getLocaliteAffiche('{$zBasePath}',2,this.value);" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="iDirectionId">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_direction item=oDirection}
																<option {if $oData.direction_edit == $oDirection.id} selected="selected" {/if}  value="{$oDirection.id}">{$oDirection.libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
													{$oData.zSelectDirection}
													{/if}
													{$oData.zSelectDirectionSwitch}
												</div>
												<div id="iLocalite_2" class="clearfix">
													<div>
														<div class="field">
															<label>Service</label>
															<select class="form-control katsaka" placeholder="Service" name="service" onChange="getLocaliteAffiche('{$zBasePath}',3,this.value);" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="iServiceId">
																<option  value="0">-------</option> 
																{foreach from=$oData.list_service item=oService}
																<option {if $oData.service_edit == $oService.id} selected="selected" {/if}  value="{$oService.id}">{$oService.libele}</option>
																{/foreach}
															</select>

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
													{$oData.zSelectService}
												</div>
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
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Telephone</label>
															<input type="text" id="phone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="phone" data-toggle="tooltip" data-original-title="" value="{$oData.phone}">

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Email</label>
															<input type="text" id="email" class="form-control" placeholder="Email" name="email" data-toggle="tooltip" data-original-title="" value="{$oData.email}">

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>CIN</label>
															<input type="text" id="cin" class="form-control" placeholder="CIN" name="cin" data-toggle="tooltip" data-original-title="" value="{$oData.cin}">

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<label>Localité de service</label>
															<input type="text" id="lacalite_service" class="form-control" placeholder="localité de service" name="lacalite_service" data-toggle="tooltip" data-original-title="" value="{$oData.lacalite_service}">

															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="clearfix">
													<div >
														<div class="field">
															<br/><br/>
															<input type="submit" style="cursor:pointer" class="button" value="Valider">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
													<div style="position: absolute;float: right;right: 16px;width:90%">
														<div class="widget-box widget-color-dark" style="margin:0px">
															<div class="widget-header" style="margin:0px">
																<h5 class="widget-title bigger lighter">Mise à disposition</h5>
															</div>
															<div class="widget-body">
																<div class="checkbox clearfix">
																	<label>
																		<input id="iMiseDisposition" name="iMiseDisposition" type="checkbox" value="1" {if $oData.detache==1} checked="checked" {/if} class="ace">
																		<span class="lbl" style="font-size:13px"> Oui</span>
																	</label>
																</div>
																<div class="widget-main">
																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Institution :</label>
																	</div>
																	<div class="control-group">
																		<div class="bootstrap-colorpicker" id="searchCandidat2" style="display:block"> 
																			<input placeholder="Veuillez entrer l'institution" type="text" id="iInstitutionId" name="iInstitutionId">
																		</div>
																	</div>
																	<br>
																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Département :</label>
																	</div>
																	<div class="control-group">
																		<div class="bootstrap-colorpicker" style="display:block"> 
																			<input placeholder="Veuillez entrer le département"  style="width:100%" value="{if isset($oData.oDetache[0].detache_departement)}{$oData.oDetache[0].detache_departement}{/if}" type="text" id="iDepartementMADId" name="iDepartementMADId">
																		</div>
																	</div>
																	<br>

																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Direction :</label>
																	</div>
																	<div class="control-group">
																		<div class="bootstrap-colorpicker"  style="display:block"> 
																			<input placeholder="Veuillez entrer la direction" style="width:100%" value="{if isset($oData.oDetache[0].detache_direction)}{$oData.oDetache[0].detache_direction}{/if}" type="text" id="iDirectionMADId" name="iDirectionMADId">
																		</div>
																	</div>
																	<br>
																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Service :</label>
																	</div>
																	<div class="control-group">
																		<div class="bootstrap-colorpicker" style="display:block"> 
																			<input placeholder="Veuillez entrer le service" style="width:100%" value="{if isset($oData.oDetache[0].detache_service)}{$oData.oDetache[0].detache_service}{/if}" type="text" id="iServiceMADId" name="iServiceMADId">
																		</div>
																	</div>

																	<br>
																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Localité de service:</label>
																	</div>
																	<br>
																	<div class="control-group">
																		<div class="bootstrap-colorpicker"> 
																			<textarea id="zLocalite" name="zLocalite" style="width:100%">{if isset($oData.oDetache[0].detache_service)}{$oData.oDetache[0].detache_localite}{/if}</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
											</div>
											
									</fieldset>
									</form>
								</td>
							</tr>
					</table>
				</div>
				<!-- bon -->
			</div>
		</div>
		<div id="calendar"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
{literal}
<style>
label {text-align:left!important;}

</style>
<script type="text/javascript">
   		$("#num").mask("999999"); 
		$("#phone").mask("999 99 999 99"); 
		$("#cin").mask("999 999 999 999");
   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#num").mask("999 999 999 999");
   			else
   				$("#num").mask("999999");   
   	   	}

		$(document).ready (function ()
		{
		
			var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidatSearch").select2
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

			$("#zCandidatSearch").select2('val',$("#idSelect").val());

			
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
    {include_php file=$zFooter}
</div>
</body>
</html>