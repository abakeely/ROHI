{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/common/js/home.js?V2"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Saisie du contenu du projet d'acte</h3> *}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item">Localité de services</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<div id="innerContent">
									<div id="saisieActe">
										<div class="panel-body">
											<h3>Modification localité de service (Département / direction / service)</h3>
										</div>
										<form action="{$zBasePath}gcap/search_matricule" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data" style="display:block;">
										<input type="hidden" name="idSelect2" id="idSelect2" value="{if isset($oData.oDetache[0].institution_id)}{$oData.oDetache[0].institution_id}{/if}">
										<input type="hidden" name="textSelect2" id="textSelect2" value="{if isset($oData.oDetache[0].institution_libelle)}{$oData.oDetache[0].institution_libelle}{/if}">
										<input type="hidden" name="departement_edit" id="departement_edit" value="{if isset($oData.departement_edit)}{$oData.departement_edit}{/if}">
										<input type="hidden" name="direction_edit" id="direction_edit" value="{if isset($oData.direction_edit)}{$oData.direction_edit}{/if}">

										<input type="hidden" name="service_edit" id="service_edit" value="{if isset($oData.service_edit)}{$oData.service_edit}{/if}">
										<div class="row col-md-7">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Choix(*) </b></label>
												</div>
												<select class="form-control" name="type" onchange="changeMask()" id="type">
													<option value="im">MATRICULE</option>
													<option value="cin">CIN</option>
												</select>
												<p class="message debut" >&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Matricule ou CIN </b></label>
												</div>
												<input class="form-control" placeholder="matricule ou CIN" name="im" id="num" value="{$oData.candidat->matricule}"/>
											</div>
											<!--div class="form col-md-2">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Nom de l'agent </b></label>
												</div>
												<input placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
											</div-->
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b>&nbsp; </b></label>
												</div>
												<button onclick="setListeEvaluation()" class="form-control btn-primary" >Afficher</button>
											</div>
										</div>
										</form>
									</div>

									<div id="resultat">
										
										<form action="{$zBasePath}gcap/valide_respers" method="POST" name="formulaire" id="formulaire" enctype="multipart/form-data">
										<input type="hidden" value="{$oData.user_edit.id}" name="user_id"/>
										<input type="hidden" name="iLocalite" id="iLocalite" value="">
										<input type="hidden" name="zLocaliteNiveau" id="zLocaliteNiveau" value="">
										<div  class="col-md-7">
										<div class="panel-body">
											<h3>{$oData.candidat->nom} {$oData.candidat->prenom}</h3>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Nom </b></label>
												</div>
												<input type="text" id="nom" class="form-control" placeholder="Nom" name="nom" data-toggle="tooltip" data-original-title="" value="{$oData.nom}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Pr&nbsp;noms </b></label>
												</div>
												<input type="text" id="prenom" class="form-control" placeholder="Prenom" name="prenom" data-toggle="tooltip" data-original-title="" value="{$oData.prenom}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Cin </b></label>
												</div>
												<input type="text" id="cin" class="form-control" placeholder="Cin" name="cin" data-toggle="tooltip" data-original-title="" value="{$oData.cin}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Corps </b></label>
												</div>
												<!--input type="text" id="corps" class="form-control" placeholder="Corps" name="corps" data-toggle="tooltip" data-original-title="" value="{$oData.corps}" style="width:100%!important;"-->
												<select class="form-control" placeholder="corps" name="corps" data-toggle="tooltip" data-original-title= "Safidio ny corps" id="corps">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_corps item=oCorps}
													<option {if $oData.corps == $oCorps.corps_code} selected="selected" {/if}  value="{$oCorps.corps_code}">{$oCorps.corps_code}--{$oCorps.corps_libelle}</option>
													{/foreach}
												</select>
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Grade </b></label>
												</div>
												<input type="text" id="grade" class="form-control" placeholder="Grade" name="grade" data-toggle="tooltip" data-original-title="" value="{$oData.grade}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Indice </b></label>
												</div>
												<input type="text" id="indice" class="form-control" placeholder="Indice" name="indice" data-toggle="tooltip" data-original-title="" value="{$oData.indice}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Date prise de service </b></label>
												</div>
												<input type="text" id="date_prise_service" class="form-control datepicker" placeholder="Date prise de service" name="date_prise_service" data-toggle="tooltip" data-original-title="" value="{$oData.date_prise_service}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Sanction code </b></label>
												</div>
												<!--input type="text" id="sanction" class="form-control" placeholder="Sanction code" name="sanction" data-toggle="tooltip" data-original-title="" value="{$oData.sanction}" style="width:100%!important;"-->

												<select class="form-control" placeholder="sanction" name="sanction" data-toggle="tooltip" data-original-title= "Safidio ny sanction" id="sanction">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_sanction item=oSanction}
													<option {if $oData.sanction == $oSanction.id} selected="selected" {/if}  value="{$oSanction.id}">{$oSanction.id}--{$oSanction.libele}</option>
													{/foreach}
												</select>
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Date sanction </b></label>
												</div>
												<input type="text" id="dateSanction" class="form-control datepicker" placeholder="Date sanction" name="dateSanction" data-toggle="tooltip" data-original-title="" value="{$oData.dateSanction}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Telephone </b></label>
												</div>
												<input type="text" id="phone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="phone" data-toggle="tooltip" data-original-title="" value="{$oData.phone}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Email </b></label>
												</div>
												<input type="text" id="email" class="form-control" placeholder="Email" name="email" data-toggle="tooltip" data-original-title="" value="{$oData.email}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Localité de service </b></label>
												</div>
												<input type="text" id="lacalite_service" class="form-control" placeholder="localité de service" name="lacalite_service" data-toggle="tooltip" data-original-title="" value="{$oData.lacalite_service}" style="width:100%!important;">
												<p class="message debut" style="width:500px">&nbsp;</p>
											</div>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Pays </b></label>
												</div>
												<select class="form-control" placeholder="pays" name="pays" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="pays">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_pays item=oPays}
													<option {if $oData.pays_edit == $oPays.id} selected="selected" {/if}  value="{$oPays.id}">{$oPays.libele}</option>
													{/foreach}
												</select>
												<p class="message debut" >&nbsp;</p>
											</div>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Province </b></label>
												</div>
												<select class="form-control" placeholder="province" name="province" data-toggle="tooltip" data-original-title= "Safidio ny faritany anao" id="province">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_province item=oProvince}
													<option {if $oData.province_edit == $oProvince.id} selected="selected" {/if}  value="{$oProvince.id}">{$oProvince.libele}</option>
													{/foreach}
												</select>
												<p class="message debut" >&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Région </b></label>
												</div>
												<select class="form-control" placeholder="region" name="region" data-toggle="tooltip" data-original-title= "Safidio faritra misy anao" id="region">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_region item=oRegion}
													<option {if $oData.reg_edit == $oRegion.id} selected="selected" {/if}  value="{$oRegion.id}">{$oRegion.libele}</option>
													{/foreach}
												</select>
												<p class="message debut" >&nbsp;</p>
											</div>
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> District </b></label>
												</div>
												<select class="form-control" placeholder="district" name="district" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="district">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_district item=oDistrict}
													<option {if $oData.district_edit == $oDistrict->id} selected="selected" {/if}  value="{$oDistrict->id}">{$oDistrict->libele}</option>
													{/foreach}
												</select>
												<p class="message debut" >&nbsp;</p>
											</div>
										</div>
										<div class="row">
											<div class="form col-md-4">
												<div class="libele_form">
													<label class="control-label label_rohi " data-original-title="" title=""><b> Departement </b></label>
												</div>
												<select class="form-control" placeholder="Departement"  onChange="getLocaliteCv('{$zBasePath}',1,this.value);" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement">
													<option  value="0">-------</option> 
													{foreach from=$oData.list_departement item=oDepartement}
														{if $oDepartement.id != 1}
														<option  value={$oDepartement.id} {if $oDepartement.id==$oData.departement_edit}selected="selected"{/if}>{$oDepartement.libele}</option>
														{/if}
													{/foreach}
												</select>
												<p class="message debut" >&nbsp;</p>
											</div>
											<div class="form col-md-4" id="iLocalite_1">{$oData.zSelectDirection}</div>
											<div class="form col-md-4" id="iLocalite_2">{$oData.zSelectService}</div>
										</div>
										<div class="row">
											<div class="form col-md-4" id="iLocalite_3">{$oData.zSelectSouService}</div>
											<div class="form col-md-4" id="iLocalite_4">{$oData.zSelectDivision}</div>
										</div>
										
										</div>
										<div  class="col-md-5">
											<div class="panel-body">
												<h3>Mise à disposition</h3>
											</div>
											<div class="row">
												<div class="form col-md-2">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>&nbsp;</b></label>
													</div>
													<input id="iMiseDisposition" name="iMiseDisposition" type="checkbox" value="1" {if $oData.detache==1} checked="checked" {/if} class="ace">
													<span class="lbl" style="font-size:13px"> Oui</span>
												</div>
												<div class="form col-md-4">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Institution </b></label>
													</div>
													<input placeholder="Veuillez entrer l'institution" type="text" id="iInstitutionId" name="iInstitutionId">
													<p class="message debut" style="width:500px">&nbsp;</p>
												</div>
												<div class="form col-md-6">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Département </b></label>
													</div>
													<input placeholder="Veuillez entrer le département"  style="width:100%" value="{if isset($oData.oDetache[0].detache_departement)}{$oData.oDetache[0].detache_departement}{/if}" type="text" id="iDepartementMADId" name="iDepartementMADId">
													<p class="message debut" style="width:500px">&nbsp;</p>
												</div>
											</div>
											<div class="row">
												<div class="form col-md-6">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Direction </b></label>
													</div>
													<input placeholder="Veuillez entrer la direction" style="width:100%" value="{if isset($oData.oDetache[0].detache_direction)}{$oData.oDetache[0].detache_direction}{/if}" type="text" id="iDirectionMADId" name="iDirectionMADId">
													<p class="message debut" style="width:500px">&nbsp;</p>
												</div>
												<div class="form col-md-6">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Service </b></label>
													</div>
													<input placeholder="Veuillez entrer le service" style="width:100%" value="{if isset($oData.oDetache[0].detache_service)}{$oData.oDetache[0].detache_service}{/if}" type="text" id="iServiceMADId" name="iServiceMADId">
													<p class="message debut" style="width:500px">&nbsp;</p>
												</div>
											</div>
											<div class="row">
												<div class="form col-md-12">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b> Localité de service </b></label>
													</div>
													<textarea id="zLocalite" name="zLocalite" style="width:100%;height:130px;">{if isset($oData.oDetache[0].detache_service)}{$oData.oDetache[0].detache_localite}{/if}</textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<input type="submit" style="cursor:pointer;" class="button" value="Valider">
											</div>
										</div>
										</form>
									</div>
								</div> 
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
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

	$(document).ready (function (){

		$(".datepicker").datepicker({
			 language: "fr",
			 autoclose: true,
			 todayHighlight: true,
			 format: "dd/mm/yyyy"
		});

		var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
		$("#zCandidatSearch").select2({
			initSelection: function (element, callback){
				$(dataArrayAgent).each(function(){
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
			formatNoMatches: function () { return $("#AucunResultat").val(); },
			formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
			formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
			formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
			formatSearching: function () { return "Recherche..."; },			
			ajax: { 
				url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
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
		$("#zCandidatSearch").select2('val',$("#idSelect").val());
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

		var departement_edit	= $("#departement_edit").val();
		var direction_edit		= $("#direction_edit").val();
		var service_edit		= $("#service_edit").val();
		//change departement
		$("#departement").change();
		
		//change niveau 02
		$("#structure_2 option").each (function (){
			//si niveau 02 est une direction
			if( $(this).val() == "DIR_"+direction_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
			//si niveau 02 est une service
			if( $(this).val() == "SER_"+service_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
		}) ;

		//change niveau 03
		$("#structure_3 option").each (function (){
			//si niveau 03 est une direction
			if( $(this).val() == "DIR_"+direction_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
			//si niveau 03 est une service
			if( $(this).val() == "SER_"+service_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
		}) ;

		//change niveau 04
		$("#structure_4 option").each (function (){
			//si niveau 04 est une direction
			if( $(this).val() == "DIR_"+direction_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
			//si niveau 04 est une service
			if( $(this).val() == "SER_"+service_edit ){
				$(this).attr("selected","selected");
				$(this).change();
			}
		}) ;
		
	});
</script>
{/literal}