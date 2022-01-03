{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Ajout reclassement</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Dossier</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="col-xs-12">
							<div class="box">
								<div class="SSttlPage">

									<div class="cell">
										<div class="field text-center">
											<form action="{$zBasePath}gcap/edit/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
											<input type="button" class="button" id="iAddInstitut" name="iAddInstitut" style="color:white;cursor:pointer;margin-top:-3px!important" class="button ajoutInstitut" value="ajouter un institut">
											<input type="button" class="button" id="iAddDiplome" name="iAddDiplome" style="color:white;cursor:pointer;margin-top:-3px!important" class="button ajoutDiplome" value="ajouter un diplôme">
											</form>
										</div>
									</div>
								</div>
								<div class="col-xs-12">
									{if $oData.iSave==1}
										Enregistrement effectué
									{/if}
										<form action="{$zBasePath}reclassement/save/gestion-reclassement/reclassement" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
											<fieldset>
											<input type="hidden" name="switchInstitutDiplome" id="switchInstitutDiplome" value="1">
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Institut : </label>
																<input placeholder="Veuillez rechercher un institut" type="text" id="iInstituId" name="iInstituId">
																<p id="iInstitutSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner l'institut</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Diplôme :</label>
																<input placeholder="Veuillez rechercher un diplôme" type="text" id="iDiplomeId" name="iDiplomeId">
																<p id="iDiplomeSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner le diplôme</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Nom et prénom : </label>
																<input placeholder="Veuillez rechercher un agent" type="text" id="iUserId" name="iUserId">
																<p id="iUserSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner l'agent</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Domaine :</label>
																<input style="width:40%" type="text" id="zDomaine" name="zDomaine">
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Catégorie actuel :</label>
																<select name="iCategOrig" id="iCategOrig" class="obligatoire">
																	<option value="">Sélectionner un catégorie d'origine</option>
																	<option value="1">Catégorie I</option>
																	<option value="2">Catégorie II</option>
																	<option value="3">Catégorie III</option>
																	<option value="4">Catégorie IV</option>
																	<option value="5">Catégorie V</option>
																	<option value="6">Catégorie VI</option>
																	<option value="7">Catégorie VII</option>
																	<option value="8">Catégorie VIII</option>
																	<option value="9">Catégorie IX</option>
																	<option value="10">Catégorie X</option>
																</select>
																<p class="message" style="width:200px">Veuillez s&eacute;l&eacute;ctionner le catégorie d'origine</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Catégorie d'accueil :</label>
																<select name="iCategAccueil" id="iCategAccueil" class="obligatoire">
																	<option value="">Sélectionner un catégorie d'accueil</option>
																	<option value="1">Catégorie I</option>
																	<option value="2">Catégorie II</option>
																	<option value="3">Catégorie III</option>
																	<option value="4">Catégorie IV</option>
																	<option value="5">Catégorie V</option>
																	<option value="6">Catégorie VI</option>
																	<option value="7">Catégorie VII</option>
																	<option value="8">Catégorie VIII</option>
																	<option value="9">Catégorie IX</option>
																	<option value="10">Catégorie X</option>
																</select>
																<p class="message debut" style="width:200px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner catégorie d'accueil</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell small">
															<div class="field">
																<label>Date d'arrivée *</label>
																<input type="text" readonly="readonly" name="zDateEnvoi" id="zDateEnvoi" value="" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" class="withDatePicker obligatoire">
																<p class="message debut" style="width:500px">Veuillez cliquer ci-dessus pour s&eacute;l&eacute;ctionner la date d'arrivée</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																	LFI : <input type="radio" class="iClassificationClass" id="iTypeDossierId" name="iTypeDossierId" checked="checked"  value="1">
																	LFR : <input type="radio" class="iClassificationClass" id="iTypeDossierId" name="iTypeDossierId" value="2">
																	<select name="iAnneeReclassement" id="iAnneeReclassement" style="width:30%" class="obligatoire">
																		<option value=""></option>
																		{assign var=iBoucle value=$oData.iAnnee+10}
																		{section name=iAnnee start=2015 loop=$iBoucle+1 step=1}
																			<option {if $smarty.section.iAnnee.index == 2017} selected="selected" {/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
																		{/section}
																	</select>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Traiteur de dossier:</label>
																<select name="iResponsableId" id="iResponsableId" class="obligatoire">
																	<option value="">Sélectionner un traiteur</option>
																	<option value="11470"> RAZAFINONY Luc Nirina </option>
																	<option value="183">RABENANDRIANINA Harifidy</option>
																</select>
																<p class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner le traiteur de dossier</p>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<label>Nom autorit&eacute; valideur</label>
															<div class="field">
																<p class="check"><input type="checkbox" id="iManuel"  name="iManuel" value="1"><label>Saisi manuel</label></p>
															</div>
															<br/>
															<div class="field" id="searchCandidat" style="display:block">
																<input placeholder="Veuillez entrer le nom de l'autorit&eacute;" type="text" id="zCandidatSearch" name="zCandidat">
															</div>
															<div class="field" id="searchAutorite" style="display:none;">
																<input type="text" name="zAutoriteManuel" id="zAutoriteManuel" value="">
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Departement</label>
																<select id="iDepartementId" name="iDepartementId" onChange="getLocaliteCv('{$zBasePath}',1,this.value,1);">
																	<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
																	{foreach from=$oData.oDepartement item=oDepartement1 }
																	<option {if $oDepartement1.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement1.id}">{$oDepartement1.libele}</option>
																	{/foreach}
																</select>
															</div>
														</div>
													</div>
													<!---------------------------------------------------------------->

														<div id="iLocalite_1" class="clearfix">
															{$oData.zSelectDirection}
														</div>
														<div id="iLocalite_2" class="clearfix">
															{$oData.zSelectService}
														</div>
														<div id="iLocalite_3" class="clearfix">
															{$oData.zSelectSouService}
														</div>
														<div id="iLocalite_4" class="clearfix">
															{$oData.zSelectDivision}
														</div>
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

													<!--
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Direction</label>
																<select id="iOrganisation_1" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
																	<option value="0">s&eacute;l&eacute;ctionner une direction</option>
																	{foreach from=$oDirection item=oDirection1 }
																	<option {if $oDirection1.id == $oCandidat.0->direction} selected="selected" {/if} value="{$oDirection1.id}">{$oDirection1.libele}</option>
																	{/foreach}
																</select>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Service</label>
																<select id="iOrganisation_2" name="iServiceId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
																	<option value="0">s&eacute;l&eacute;ctionner un service</option>
																	{foreach from=$oService item=oService1 }
																	<option {if $oService1.id == $oCandidat.0->service} selected="selected" {/if} value="{$oService1.id}">{$oService1.libele}</option>
																	{/foreach}
																</select>
															</div>
														</div>
													</div>
													<br/>
													<div class="clearfix">
														<div class="cell">
															<div class="field"> 
																<label>Division</label>
																<select id="iOrganisation_3" name="iDivisionId" >
																	<option value="0">s&eacute;l&eacute;ctionner une division</option>
																	{foreach from=$oDivision item=oDivision1 }
																	<option {if $oDivision1.id == $oCandidat.0->division} selected="selected" {/if} value="{$oDivision1.id}">{$oDivision1.libele}</option>
																	{/foreach}
																</select>
															</div>
														</div>
													</div>
													<br/>
													-->
													<br/>
													<br/>
													<div class="clearfix">
													<div class="cell">
														<div class="field">
														<input type="button" class="button" onClick="validerReclassement();" name="" id="Envoyer" value="Envoyer">
													</div>
													</div>
											
											</fieldset>
										</form>
									
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>		
        </div>
		<!-- /Page Wrapper -->		
		<div id="dialog" title="Dialog Title"></div>															
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<style>

@media screen and (max-width: 768px) {
	.cell {
		width:100%!important;
	}
}
</style>
<script type="text/javascript">

	function getSelect2 (_iCIbleId, _zType='institut',_zPercent="50") {

		$("#" + _iCIbleId).select2
		({
			initSelection: function (element, callback)
			{
			},
			allowClear: true,
			placeholder:"Sélectionnez",
			minimumInputLength: 1,
			multiple:false,
			width: _zPercent+'%!important',
			width:"100%!important",
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
		
				$('.iClassificationClass').click(function(){
		
					var iTypeDossierId = $(this).val();  
					switch (iTypeDossierId){
						case '1':
							$("#iAnneeReclassement").val({/literal}{$oData.iAnnee}{literal})
							break;
						
						case '2':
							$("#iAnneeReclassement").val({/literal}{$iBoucle}{literal})
							break;
					}
				});
				
				$( "#iAddInstitut" ).on('click', function(event) {
					
					$("#dialog").html();
					$("#switchInstitutDiplome").val("1");
					$('#dialog').dialog('option', 'title', 'Ajout institut');
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}reclassement/getInstitut" ,
						type: 'POST',
						data: { },
						success: function(data, textStatus, jqXHR) {
							
							$("#dialog").html(data);	
							$( "#dialog" ).dialog( "open" );
							
							event.preventDefault();
						},
						async: false
					});
				});

				$( "#iAddDiplome" ).click(function( event ) {
					
					$("#dialog").html();
					$("#switchInstitutDiplome").val("2");
					$('#dialog').dialog('option', 'title', 'Ajout diplôme');
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}reclassement/getDiplome" ,
						type: 'POST',
						data: { },
						success: function(data, textStatus, jqXHR) {
							
							$("#dialog").html(data);	
							$( "#dialog" ).dialog( "open" );
							
							event.preventDefault();
						},
						async: false
					});
				});

				$( "#dialog" ).dialog({
					autoOpen: false,
					width: '75%',
					title: '',
					close: 'X',
					modal: true,
					buttons: [
						{
							text: "Valider",
							click: function() {
								var iswitchInstitutDiplome = $("#switchInstitutDiplome").val();
								var iTestValid = 1 ; 
								var zMessage = "";

								switch (iswitchInstitutDiplome) {

									case "1" :
										
										var zInstitut	= $('#institut_libelle').val();
										var zSigle		= $('#institut_sigleLong').val();
										var zCoordonnee	= $('#institut_coordonnee').val();
										

										if (zInstitut == '' || zInstitut ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez remplir l'abreviation\n" ; 
										}

										if (zSigle == '' || zSigle ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez remplir le libellé\n" ; 
										}

										
										if (iTestValid == 1) {

													$.ajax({
														url: "{/literal}{$zBasePath}{literal}reclassement/save/gestion-reclassement/saveInstitut" ,
														method: "POST",
														data: { zInstitut:zInstitut, zSigle:zSigle, zCoordonnee:zCoordonnee},
														success: function(data, textStatus, jqXHR) {
															$( "#dialog" ).dialog( "close" );
														},
														async: false
													});

										} else {
											alert(zMessage);
										}
										break;

									case "2" :
										var zLibelle		= $('#diplome_libelle').val();

										if (zLibelle == '' || zLibelle ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez remplir le nom du diplôme" ; 
										}

										if (iTestValid == 1) {

												$.ajax({
													url: "{/literal}{$zBasePath}{literal}reclassement/save/gestion-reclassement/saveDiplome/" ,
													method: "POST",
													data: { zLibelle:zLibelle},
													success: function(data, textStatus, jqXHR) {
														$( "#dialog" ).dialog( "close" );
													},
													async: false
												});

										} else {
											alert(zMessage);
										}
										break;
								}

							}
						},
						{
							text: "Annuler",
							click: function() {
								$( this ).dialog( "close" );
							}
						}
					]
				});
				
				getSelect2('iInstituId','institut');
				getSelect2('iDiplomeId','diplome');
				getSelect2('zCandidatSearch','diplome',"100");

				$("#iUserId").select2
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
					placeholder:"Sélectionnez",
					minimumInputLength: 3,
					multiple:false,
					width:"100%!important",
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
					width:"100%!important",
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
	})
</script>
<style>
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
input[type=radio] {
    height:18px;
	width:18px; 
	vertical-align: middle;
}
</style>
{/literal}