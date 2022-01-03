{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
<section id="content">
        {include_php file=$zLeft}	
        <link rel="stylesheet" href="{$zBasePath}assets/css/raterater.css"/>
        <link rel="stylesheet" href="{$zBasePath}assets/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" href="{$zBasePath}assets/css/datepicker3.css"/>
        <script src="{$zBasePath}assets/js/raterater.jquery.js"></script>
		<script src="{$zBasePath}assets/js/bootstrap-datetimepicker.js"></script>
		<script src="{$zBasePath}assets/js/bootstrap-datepicker.js"></script>
		<script src="{$zBasePath}assets/js/bootstrapValidator.min.js"></script>
		<script src="{$zBasePath}assets/js/formValidation.min.js"></script>
		<script src="{$zBasePath}assets/js/jquery.maskedinput.js"></script>
		<script src="{$zBasePath}assets/js/date.js"></script>
		
        <div id="innerContent">
            <div id="ContentBloc">
                <h2>Mon CV</h2>
				<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span>Mon CV</div>
                <div class="contenuePage">

                    <!--*Debut Contenue*-->
					<input type="hidden" id="url_base" value="{$zBasePath}" data-original-title=""  title=""> 
					<input type="hidden" id="url_base" value="{$zBasePath}" data-original-title=""  title=""> 
					<input type="hidden" id="isPhoto" name="isPhoto" value="{$isPhoto}" data-original-title=""  title=""> 
                    <form class="form-horizontal bv-form Cv-form" role="form" name="cv" id="cv_form" action="{$zUrlPost}" method="POST" enctype="multipart/form-data" >
                        {if $oData.edit_cv}<input type="hidden" name="candidat_id" id="candidat_id" value="{$oData.iCandidatEditId}">{/if}
						{if $iCorp && $iCorp!='0'}<input type="hidden" name="corps" id="corps" value="{$iCorp}" data-original-title="" title="">{/if}
                        {if $iGrade!='0'}<input type="hidden" name="grade" id="grade" value="{$iGrade}" data-original-title="" title="">{/if}
                        {if $iIndice!='0'}<input type="hidden" name="indice" id="indice" value="{$iIndice}" data-original-title="" title="">{/if}
						{if $oCandidatCv->departement != "" && $oCandidatCv->departement > 0}
							<input type="hidden" name="pays1" id="pays1" value="{$oCandidatCv->pays_id}" data-original-title=""  title=""> 
							<input type="hidden" name="province1" id="province1" value="{$oCandidatCv->province_id}" data-original-title="" title="">
							<input type="hidden" name="region1" id="region1" value="{$oCandidatCv->region_id}" data-original-title="" title="">
							<input type="hidden" name="district1" id="district1" value="{$oCandidatCv->district_id}" data-original-title="" title="">
							<input type="hidden" name="departement1" id="departement1" value="{$oCandidatCv->departement}" data-original-title="" title="">
							<input type="hidden" name="direction1" id="direction1" value="{$oCandidatCv->direction}" data-original-title="" title="">
							<input type="hidden" name="service1" id="service1" value="{$oCandidatCv->service}" data-original-title="" title="">
							<input type="hidden" name="division1" id="division1" value="{$oCandidatCv->division}" data-original-title="" title="">
						{/if}
						<input type="hidden" id="date_compare" name="date_compare" value="" data-original-title="" title="">
                        <div class="col-md-12">

                            <!----------------- bloc Details ---------------->
                            <div class="headblock">
                                <div class="left User-photo">
									<img id="userLeftPhoto" src="{$zImage}?{$zClearCache}">
                                </div>

                                <div class="User-details">
                                    <div class="row" style="width:100%">
                                        <div class="cell">
                                            <div class="field">
                                                <label><b>Nom :</b> 
                                                
													{if $oCandidatCv->nom!=''}
													{$oCandidatCv->nom}
													{else}
													{$oUser.nom}
													{/if}
												
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="field">
                                            <label>Prénom(s) : 
                                            
												{if $oCandidatCv->nom!=''}
												{$oCandidatCv->prenom}     
												{else}
												{$oUser.prenom}
												{/if}
											
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="cell">
                                            <div class="field">
                                                <label>Matricule : 
                                                {if $oCandidatCv->nom!=''}
													{$oCandidatCv->matricule}     
                                                {elseif $oUser.im}
													{$oUser.im}
												{else}
													ECD
                                                {/if}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="fileChange">
                                    <label for="photo">Modifier
                                        <input type="file" class="file_upload" name="photo" data-toggle="tooltip" data-original-title="Safidio sy ampidiro ny sarinao" onchange="imageChange(this);" id="photo"  data-bv-field="photo">
                                    </label>
                                </div>
                            </div>
                            <!----------------- Fin bloc Details ---------------->
                        </div>
                        <div class="col-xs-12 col-sm-6 pull-right">
                            <!----------------- bloc Toogle ---------------->
                            <div class="panel panel-default">
                                <div class="panel-title">
                                    <a  href="#EtatCivil" data-toggle="collapse" class="">Etat Civil</a>
                                </div>
                                <div id="EtatCivil" class="panel-collapse">
                                    <div class="panel-body">
                                        <div class="labelForm libele_form">
                                            <label class="control-label" data-original-title="" title="">
											<b>Date de Naissance</b>
											</label>
                                        </div>
                                        <div class=" form form-group input-group">
                                            <input type="text" id="date_naiss" class="form-control" placeholder="Date de Naissance" name="date_naiss" value="{if $oCandidatCv->nom!=''}{$oCandidatCv->date_naiss}{else}{$oUser.date_naiss}{/if}" data-original-title="" title="" data-bv-field="date_naiss">
                                            <span class="input-group-addon">  
												<span class="la la-calendar form-control-feedback"></span>
											</span>
                                        </div>
                                        <div class="libele_form">
                                            <label class="control-label" data-original-title="" title="">
												<b>Situation Matrimoniale</b>
											</label>
                                        </div>
                                        <div  class="form form-group">
                                            <select class="form-control" placeholder="Situation Matrimoniale" name="sit_mat" data-toggle="tooltip" data-original-title="Hamarino ny momba anao : Manambady, na Misaraka, na Mpitovo, na Maty Vady" id="sit_mat" onchange="changeDest()" data-bv-field="sit_mat">
                                                {foreach from=$oData.list_sit_mat item=oSitMat}
													<option  value={$oSitMat.id} {if $oSitMat.id==$oCandidatCv->sit_mat}selected="selected"{/if}>{$oSitMat.libele}</option>
												{/foreach}
                                            </select>
                                        </div>
                                        <div class="labelForm libele_form">
                                            <label class="control-label" data-original-title="" title="">
												<b>Nombre d´enfants</b>
											</label>
                                        </div>
                                        <div  class="form form-group">
                                            <input type="text" id="nbr_enfant" style="width:10% !important; padding-right:0 !important;" maxlength="2" class="form-control" name="nbr_enfant" data-toggle="tooltip" data-original-title=" Soraty ny isan’ny ankizy" value="{if $oCandidatCv->nom!=''}{$oCandidatCv->nbr_enfant}{else}{$oCandidat[0]->nbr_enfant}{/if}" data-bv-field="nbr_enfant">
												
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-title">
                                    <a  href="#CoordonneesUser"  data-toggle="collapse"  class="collapsed">Coordonnées</a>
                                </div>
                                <div id="CoordonneesUser" class="panel-collapse collapse"">
                                <div class="panel-body">
                                    <div class="libele_form">
                                        <label class="control-label" data-original-title="" title="">
											<b>Adresse Actuelle </b><b><font color="red"> * </font></b> 
										</label>
                                    </div>
                                    <div class="form form-group">
                                        <input type="text" id="addresse" class="form-control" placeholder="Adresse" name="addresse" data-toggle="tooltip" data-original-title="Soraty ny toeram-ponenao ankehitriny" value="{$oCandidatCv->address}" data-bv-field="addresse">
										
                                    </div>

                                    <div class="libele_form">
                                        <label class="control-label" data-original-title="" title="">
											<b>Téléphone </b><b><font color="red"> * </font></b>
                                        </label>
                                    </div>
                                    <div class="form form-group">
                                        <input type="text" id="phone" class="form-control" placeholder="Téléphone" name="phone" data-toggle="tooltip" data-original-title="Ampidiro ny laharan&#39;ny finday anao (iray ihany)" value="{$oCandidatCv->phone}" data-bv-field="phone">
										
                                    </div>

                                    <div class="libele_form">
                                        <label class="control-label" data-original-title="" title="">
											<b>Adresse Eléctronique</b> 
										</label>
                                    </div>
                                    <div class="form">
                                        <input type="text" id="email" class="form-control" placeholder="E-mail" name="email" data-toggle="tooltip" data-original-title="Ampidiro ny mailaka" value="{$oCandidatCv->email}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----------------- Fin bloc Toogle ---------------->
                </div>
                <div class="col-xs-12 col-sm-6 pull-left">
                    <div class="panel panel-default">

                        <!--                                            ONGLETS-->
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#InformationsAdministratives">Informations Administratives</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#Carrieres">Carri&egrave;res</a>
                            </div>
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#Formations">Formations</a>
                            </div>

                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#Loisirs">Loisirs et Activit&eacute;s annexes</a>
                            </div>
							<!-------------------->

								<div class="panel-title">
                                    <a  href="#FicheDePoste" data-toggle="collapse" data-parent="#FicheDePoste" class="collapsed">Fiche de poste</a>
                                </div>
                                <div id="FicheDePoste" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div  class="form form-group">
										   <input type="hidden" name="idSelect" id="idSelect" value="{if sizeof($toFicheDePoste)>0}{$toFicheDePoste.fichePoste_id}{/if}">
										   <input type="hidden" name="textSelect" id="textSelect" value="{if sizeof($toFicheDePoste)>0}{$toFicheDePoste.fichePoste_intitule}{/if}">
                                           {if ($oData.iSessionCompte == COMPTE_AUTORITE) ||  $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL ||  $oData.iSessionCompte == COMPTE_ADMIN || $oData.iSessionCompte == COMPTE_EVALUATEUR}
											<input placeholder="Veuillez sélectionner une fiche de poste" type="text" id="iSearchFicheDePoste" style="width:450px;font-size: 13px!important;" name="iSearchFicheDePoste">
											<div class="pull-right" style="padding-right: 5px;">
												<button class="btn btn-info dialog-link-fdp" type="button" title="Ma fiche de poste" alt="Ma Fiche de poste" iAgentId="{$oCandidatCv->id}">
													<i class="ace-icon la la-check bigger-110"></i>
													Valider fiche de poste
												</button>
											</div>
											{else}
												{if $oCandidatCv->fichePosteId >0}
												<input placeholder="Veuillez sélectionner une fiche de poste" readonly="readonly" type="text" id="iSearchFicheDePoste" style="width:450px;font-size: 13px!important;" name="iSearchFicheDePoste">
												<div class="pull-right" style="padding-right: 5px;">
													<button class="btn btn-info dialog-link" type="button" title="Approuver" alt="Approuver" iagentid="{$oCandidatCv->user_id}">
														<i class="ace-icon la la-search bigger-110"></i>
														Voir fiche de poste
													</button>
												</div>
												{/if}
											{/if}
                                        </div>
										
                                    </div>
                                </div>
							<!-------------------->
                        </div>

                        <!--                                            ONGLETS-->

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 SubmitCv text-center">
                    <div class="panel panel-default">
                        <div id="InformationsAdministratives" class="panel-collapse collapse">
                            {$zInfoAdmin}

                        </div>
                        <div id="Carrieres" class="panel-collapse collapse">
                           {$zCarriere}

                        </div>

                        <div id="Formations" class="panel-collapse collapse">
                            {$zFormation}
                        </div>
						
                        <div id="Loisirs" class="panel-collapse collapse">
                           {$zLoisir}

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 SubmitCv text-center">
                    <font><b><font color="red" size="5rem"> * </font></b>  Les champs marqués d'une étoile sont obligatoires.</font>
                </div>
                <div class="col-xs-12 col-sm-12 SubmitCv text-center">

                    <input type="submit" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value="Enregistrer">
				{if $iExistCv}
                    <a href="#" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny mari-pankasitrahanao" onclick="certificat({if $oData.edit_cv}{$oCandidatCv->id}{/if})"> <font style="font-size: 1em;"> Imprimer attestation</font></a>
				
                    <a href="{$zBasePath}cv/fpdf_cv/{if $oData.edit_cv}{$oCandidatCv->id}{/if}" class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio dia afaka manonta ny CV'nao ianao" target="_blank"> <font style="font-size: 1em;"> Imprimer CV </font></a>
				{/if}
                </div>
                </form>
			<br><br>
			<div id="certificat"></div>

                <!--*Fin Contenue*-->
            </div>
        </div>
</div>
<div id="dialog11" title="Fiche de poste"></div>

<link rel="stylesheet" href="{$zBasePath}assets/css/fullcalendar.min.css"/>
<script src="{$zBasePath}assets/js/home.js?20062019"></script>
<div id="calendar"></div>
</section>

	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
	{include_php file=$zFooter}
{if isset($oData.msg)}
	{literal}
		<script>bootbox.alert('{/literal}{$oData.msg}{literal}')</script>
	{/literal}
{/if}
{literal}
	<style>
		#s2id_iSearchFicheDePoste {
			 left: 35px!important; 
			 font-size:13px!important;
		}
		.select2-input {
			font-size:13px!important;
		}

		.select2-no-results {
			font-size:13px!important;
		}

		.select2-results .select2-result-label {
			padding: 3px 7px 4px;
			margin: 0;
			cursor: pointer;
			font-size: 13px!important;
		}

		.help-block {
			font-size:12px!important;
			font-weight:bold;
			color: #ff0d08!important
		}
		#Formations table tbody tr td.importantTd{
			width : 15px !important;
		}

		.btn_close {
			width: 35px;
			color: red!important;
			background: #fba1a1!important
		}

		.btn_close i {
			font-size: 20px!important;
		}

		.has-error .checkbox, .has-error .checkbox-inline, .has-error .control-label, .has-error .help-block, .has-error .radio, .has-error .radio-inline, .has-error.checkbox label, .has-error.checkbox-inline label, .has-error.radio label, .has-error.radio-inline label {
			color: #ff0d08!important;
			font-size: 12px!important;
			font-weight: bold !important;
		}

		.glyphicon {
			display:none!important;
		}
	</style>
	<script>
		/*$("#div_cv").hide();
		$('.mise_a_dispo').hide();
		
		
		function showDivCV(){
			$("#div_cv").show();
			$(".ministere").hide();
		}
		function hideDivCV(){
			$("#div_cv").show();
			$(".ministere").hide();
		}
		*/

		 $("#dialog11").dialog({
			autoOpen: false,
			width: '60%',
			title: 'Fiche de poste',
			close: 'X',
			modal: true,
			buttons: [{
				text: "Fermer",
				click: function() {
					$(this).dialog("close");
				}
			}]
		}); 

		$( ".dialog-link" ).click(function( event ) {
			$("#userANoteId").val("");
			$("#noteOfUserId").val("");
			$("#dialog11").html();
			var iUserId = $(this).attr("iAgentId");
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}accueil/getInfoUser/" + iUserId ,
				type: 'get',
				data: { 
				},
				success: function(data, textStatus, jqXHR) {
					
					$("#dialog11").html(data);	
					$( "#dialog11" ).dialog( "open" );
					
					event.preventDefault();
				},
				async: false
			});

		});

		$( ".dialog-link-fdp" ).click(function( event ) {
			
			var iUserId = $(this).attr("iAgentId");
			var iSearchFicheDePoste = $("#iSearchFicheDePoste").val();

			if(iSearchFicheDePoste != ''){
				$.ajax({
					url: "{/literal}{$zBasePath}{literal}accueil/saveCandidatFicheDePoste/" ,
					type: 'post',
					data: { 
						iUserId : iUserId,
						iSearchFicheDePoste : iSearchFicheDePoste,
					},
					success: function(data, textStatus, jqXHR) {
						
						alert("Enregistrement effectué");
						event.preventDefault();
					},
					async: false
				});
			}
		});

		$(document).ready (function ()
		{
		
			var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#iSearchFicheDePoste").select2
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
					url: "{/literal}{$zBasePath}{literal}Accueil/setFicheDePosteSearch/",
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
			$("#iSearchFicheDePoste").select2('val',$("#idSelect").val());
		});

		function clickMFB(){
			$("#autreInstitution").addClass("hidden");
			$("#mfbInstitution").removeClass("hidden");
			$("#departOrigTitle").addClass("hidden");
		}
		
		function clickNonMFB(){
			$("#autreInstitution").removeClass("hidden");
			$("#mfbInstitution").addClass("hidden");
			$("#departOrigTitle").removeClass("hidden");
		}
		
		function certificat(_id){
			if (_id != undefined) {
				zUrl = "cv/certificat/" + _id ; 
			} else {
				zUrl = "cv/certificat" ; 
			}
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}" + zUrl ,
				type: 'get',
				success: function(data, textStatus, jqXHR) {
					$('#certificat').html('');
					$('#certificat').html(data);
					$('#certificat').show();
					$('#certificat_cv').show();
					$('#modalDetail').modal();
					
				},
				async: false
			 });
		}
	</script>
{/literal}
</div>
</body>
</html>