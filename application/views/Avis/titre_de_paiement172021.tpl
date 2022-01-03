{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Fiche > Titre de paiement</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">titre de paiement</a> <span>&gt;</span> Fiche </li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							
							<div class="card-body">
								<div class="SSttlPage">
											<div class="card punch-status">
												<form action="{$zBasePath}titre/fiche/titre-de-paiement" method="POST" name="formulaireTransaction" id="formulaireTransaction" style="display:block!important" enctype="multipart/form-data">
												<div class="card-body">
													<h5 class="card-title">Sélection mois / année à afficher {$oData.oUser.im}</h5>
													
													{if $oData.oUser.im == '332026'}
													<div class="row1">
														<div class="cell">
																<div class="field">
																	<label>Matricule ou CIN</label>
																	<input value="{$oData.iMatricule}" data-search="" class="form-control" type="text" id="search_agent" aria-label="" aria-describedby="button-action-search">
																</div>
														</div>
													</div>
													{/if}
													<input type="hidden" name="soa_code" value=""/>
														{if $oData.oUser.im != 'ECD'}
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>Soa Code</label>
																	<select class="form-control" name="soa" id="soa">
																	{foreach from=$oData.toListMajoration item=oMajoration }
																		<option  value="{$oMajoration.soa}" {if $oMajoration.majoration == $oData.soa}selected="selected"{/if}>Majoration : {$oMajoration.majoration}   ,Soa : {$oMajoration.soa}</option>
																	{/foreach}
																	</select>
																</div>
															</div>
														</div>
														{/if}

														
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>Mois</label>
																	<!--input name="iMois" id="iMois" type="text" class="form-control myYaer" data-dd-opt-format="mm" data-dd-opt-preset="onlyMonth" placeholder="mm" readonly="true" autocomplete="off" value="{$oData.iMois}" data-dd-opt-default-date="{$oData.iMois}"-->
																	<select class="form-control" name="iMois">
																		<option value="">Mois</option>
																		<option {if $oData.iMois =="01"}selected="selected"{/if}value="01">Janvier</option>
																		<option {if $oData.iMois =="02"}selected="selected"{/if} value="02">Février</option>
																		<option {if $oData.iMois =="03"}selected="selected"{/if} value="03">Mars</option>
																		<option {if $oData.iMois =="04"}selected="selected"{/if} value="04">Avril</option>
																		<option {if $oData.iMois =="05"}selected="selected"{/if} value="05">Mai</option>
																		<option {if $oData.iMois =="06"}selected="selected"{/if} value="06">Juin</option>
																		<option {if $oData.iMois =="07"}selected="selected"{/if} value="07">Juillet</option>
																		<option {if $oData.iMois =="08"}selected="selected"{/if} value="08">Août</option>
																		<option {if $oData.iMois =="09"}selected="selected"{/if} value="09">Septembre</option>
																		<option {if $oData.iMois =="10"}selected="selected"{/if} value="10">Octobre</option>
																		<option {if $oData.iMois =="11"}selected="selected"{/if} value="11">Novembre</option>
																		<option {if $oData.iMois =="12"}selected="selected"{/if} value="12">Décembre</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>Ann&eacute;e</label>
																	<input type="text" id="iAnnee" name="iAnnee" placeholder="s&eacute;l&eacute;ctionner l'année" class="form-control myYaer" data-dd-opt-format="Y" data-dd-opt-preset="onlyYear" placeholder="yyyy" readonly="true" value="{$oData.iAnneeActif}" autocomplete="off" data-dd-opt-default-date="{$oData.iAnneeActif}">
																	
																</div>
															</div>
														</div>
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>&nbsp;</label>
																	<input type="button" class="btn btn-primary" onClick="fichePaiement();" name="" id="" value="Rechercher">
																</div>
															</div>
														</div>
														<div class="row1">
															<div class="cell">
																<div class="field">
																	<label>&nbsp;</label>
																	<input type="button" class="btn btn-primary" onClick="ImpressionPaiement();" name="" id="" value="Imprimer">
																</div>
															</div>
														</div>
														</form>
												</div>
											</div>
											<!--Recherche-->
											{assign var=iIncrement11 value="0"}
											<div class="contenuePage">
													<ul class="tabs">
														<li class="tab-link current" imodeid="1" data-tab="tab-1" id="liTab-1">
															&nbsp;&nbsp;&nbsp;&nbsp;Salaire&nbsp;&nbsp;&nbsp;&nbsp;
														</li>
														<li class="tab-link" imodeid="2" data-tab="tab-2" id="liTab-2">
															Liste des rubriques correspondant
														</li>
													</ul>
													<div id="tab-1" class="tab-content current">
													<fieldset>
														 <table class="table table-striped table-bordered table-hover" id="dataTables-example-99">
															<tr class="notAffiche">
																<td>Solde Mois de :</td>
																<td><span>{if ($oData.oCandidatAffiche->MOIS)}{$oData.oCandidatAffiche->MOIS}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Exercice :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->EXERCICE}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>de Mr(Mme) :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->AGENT_NOM}&nbsp;{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Matricule :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->AGENT_MATRICULE}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Section :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{$oData.oCandidatAffiche->SECTION_CODE}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Localit&eacute; :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->SERVICE_LOCALITE} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Mode de paiement :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->MODE_PAIEMENT} {/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Etablissement financi&egrave;re :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{if isset($oData.oCandidatAffiche->ETS_FINANCIER_CODE)}{$oData.oCandidatAffiche->ETS_FINANCIER_CODE}{/if}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Num&eacute;ro de compte :</td>
																<td><span>{if ($oData.oCandidatAffiche)}{if isset($oData.oCandidatAffiche->AGENT_NUMERO_COMPTE)}{$oData.oCandidatAffiche->AGENT_NUMERO_COMPTE}{/if}{/if}</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Total gain :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.toCandidatAffiche[0]->TOTAL_GAIN|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Total retenu :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.toCandidatAffiche[0]->TOTAL_RETENU|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr>
																<td>Net &agrave; Payer :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->NET_A_PAYER|number_format:2:",":" "}{else}0,00{/if} Ar</span></td>
															</tr>
															<tr class="notAffiche">
																<td>Rang dans le Bordereau :</td>
																<td><span>{if ($oData.oCandidatAffiche)} {$oData.oCandidatAffiche->RANG} {/if}</span></td>
															</tr>
														</table>
													</fieldset>
												</form>
											</div>
											<div id="tab-2" class="tab-content">
												<table style="margin:0!important">
													<tr class="notAffiche">
														<td><strong>Corps  :</strong> {if ($oData.toCandidatAffiche[0])}{$oData.toCandidatAffiche[0]->CORPS_CODE}{/if}</td>
														<td><strong>Grade  :</strong> {if ($oData.toCandidatAffiche[0])}{$oData.toCandidatAffiche[0]->GRADE_CODE}{/if}</td>
														<td><strong>Indice :</strong> {if ($oData.toCandidatAffiche[0])}{$oData.toCandidatAffiche[0]->INDICE}{/if}</td>
													<tr>
												</table>
												<table class="table table-striped table-bordered table-hover dataTableCible" id="dataTables-example-{$iIncrement11}">
													<fieldset>
													<thead>
														<tr >
															<th style="text-align:center;">Rubrique code</th>
															<th style="text-align:center;">Rubrique libellé</th>
															<th style="text-align:center;">Montant</th>
															<th style="text-align:center;">Date d&eacute;but</th>
															<th style="text-align:center;">Date fin</th>
															
														</tr>
													</thead>
													<tbody>
														{assign var=iIncrement value="0"}
														{if ($oData.toCandidatAffiche[0])}
															{foreach from=$oData.toCandidatAffiche item=oCandidatAffiche }
															<tr {if $iIncrement%2 == 0} class="even" {/if}>
																<td style="text-align:center;"><strong>{$oCandidatAffiche->CODE_RUBRIQUE}</strong></td>
																<td style="text-align:left;">{$oCandidatAffiche->CODE_RUBRIQUE}</td>
																<td style="text-align:right;">{$oCandidatAffiche->MONTANT|number_format:2:",":" "} Ar </td>
																<td style="text-align:right;">{if isset($oCandidatAffiche->DATE_DEBUT)}{$oCandidatAffiche->DATE_DEBUT}{/if}</td>
																<td style="text-align:right;">{if isset($oCandidatAffiche->DATE_FIN)}{$oCandidatAffiche->DATE_FIN}{/if}</td>
															</tr>
															{assign var=iIncrement value=$iIncrement+1}
															{/foreach}
														{/if}
													</tbody>
													</fieldset>
												</table>
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
<input type="hidden" name="zUrlFiche" id="zUrlFiche" value="{$zBasePath}avis/fiche/titre-de-paiement">
<input type="hidden" name="zUrlImpression" id="zUrlImpression" value="{$zBasePath}avis/imprimer/titre-de-paiement">
{literal}
<style>
form .small {
    width: 15%!important;
}

@media only screen and (max-width: 1300px){
	.cellinfo {
		width: 100%!important;
		float: none!important;
		padding:10px!important;
	}
}

</style>
<script>
    $(document).ready(function() {
		$('.dataTableCible').dataTable({
            bFilter: !1,
            bInfo: !1,
            searching: !1
        })

	new dateDropper({
		  selector: '.myYaer',
		  format: '2021',
		  defaultDate: true,
		  expandable: false,
		  onChange: function (res) {
			
		  }
		});
    });

function changeTitrePaiement(_iPostNumero) {
    $(".allTitrePaiement").hide();
	$(".allTabulation").hide();
    var zCible = $("#" + _iPostNumero).attr("cible");
    $("#" + _iPostNumero).show();
	$("#tabulation1-" + _iPostNumero).show();
    $("#" + zCible).click()
}

function getExtension(chemin) {
    var regex = /[^.]*$/i;
    var resultats = chemin.match(regex);
    return resultats[0]
}
var titlePopUpDialog = $('#titlePopUpDialog').html(); 
	{/literal}{if $oData.iCheckId==-40}{literal}
    $("#dialog3").dialog({
        autoOpen: !1,
        width: '75%',
        closeOnEscape: !1,
        dialogClass: "noclose",
        modal: !0,
        open: function() {
            $.ui.dialog.prototype._allowInteraction = function(e) {
                return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length
            }
        },
        show: {
            effect: "slide",
            duration: 1000
        },
        hide: {
            effect: "drop",
            duration: 1000
        },
        buttons: [{
            text: 'Valider',
            "class": 'saveButtonClass',
            click: function() {
                var iMiseADispo = 0;
                var iTestValid = 1;
                var zMessage = "";
                var iUserId = $("#iUserId").val();
                var zPhone = $("#zPhone").val();
                var zLocalite = $('#zLocalite').val();
                var zPorte = $('#zPorte').val();
                var iProvinceId = $('#iOrganisation_1').val();
                var iRegionId = $('#iOrganisation_2').val();
                var iDistrictId = $('#iOrganisation_3').val();
                var iDepartementId = $('#iOrganisation_4').val();
                var iDirectionId = $('#iOrganisation_5').val();
                var iServiceId = $('#iOrganisation_6').val();
                var iDivisionId = $('#iOrganisation_7').val();
                var iFonctionId = $('#iFonctionId').val();
                var iSousFonctionId = $('#selectSousFonction').val();
                var iInstitutionId = $('#iInstitutionId').val();
                var zDepartement = $('#iDepartementMADId').val();
                var zDirection = $('#iDirectionMADId').val();
                var zService = $('#iServiceMADId').val();
                var zLocaliteMad = $('#zLocaliteMad').val();
                if ($('#iMiseDisposition').is(':checked')) iMiseADispo = 1;
                if (iProvinceId == '' || iProvinceId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner une province\n"
                }
                if (iRegionId == '' || iRegionId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner une région\n"
                }
                if (iDistrictId == '' || iDistrictId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner un district\n"
                }
                if (iDepartementId == '' || iDepartementId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner un département\n"
                }
                if (iDirectionId == '' || iDirectionId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner une direction\n"
                }
                if (iServiceId == '' || iServiceId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner un service\n"
                }
                if (zLocalite == '' || zLocalite == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez remplir la localité de service\n"
                }
                if (zPorte == '' || zPorte == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez remplir la porte\n"
                }
                if (iFonctionId == '' || iFonctionId == 0) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner votre fonction\n"
                }
                if (iMiseADispo == 1 && (iInstitutionId == '' || iInstitutionId == 0)) {
                    var iTestValid = 0;
                    zMessage += "- Veuillez sélectionner votre institution si vous êtes mis(e) à dispodition\n"
                }
                if (iTestValid == 1) {
                    $.ajax({
                        url: "{/literal}{$zBasePath}{literal}avis/saveLocaliteAvis",
                        method: "POST",
                        data: {
                            iUserId: iUserId,
                            iProvinceId: iProvinceId,
                            iRegionId: iRegionId,
                            iDistrictId: iDistrictId,
                            iDepartementId: iDepartementId,
                            iDirectionId: iDirectionId,
                            iServiceId: iServiceId,
                            iDivisionId: iDivisionId,
                            zPhone: zPhone,
                            zLocalite: zLocalite,
                            zPorte: zPorte,
                            iFonctionId: iFonctionId,
                            iSousFonctionId: iSousFonctionId,
                            iMiseADispo: iMiseADispo,
                            iInstitutionId: iInstitutionId,
                            zDepartement: zDepartement,
                            zDirection: zDirection,
                            zService: zService,
                            zLocaliteMad: zLocaliteMad
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#dialog3").dialog("close");
                            window.location.reload()
                        },
                        async: !1
                    })
                } else {
                    $('#iInstitutionSearchMessage').parent().removeClass("error");
                    if (iMiseADispo == 1 && (iInstitutionId == '' || iInstitutionId == 0)) {
                        $('#iInstitutionSearchMessage').parent().addClass("error")
                    }
                    $(".obligatoire").each(function() {
                        $(this).parent().removeClass("error");
                        if ($(this).val() == "" || $(this).val() == 0) {
                            $(this).parent().addClass("error")
                        }
                    });
                    alert(zMessage)
                }
            }
        }]
    });
    $(".dialog-link-manuel-localite11").click(function(event) {
        $("#dialog3").html();
        $('#dialog3').dialog('option', 'title', 'Confirmation localité de service');
        $('#buttonId').button('option', 'label', 'Valider');
        var iUserTarget = $("#iUserId").val();
        var iUserId = $("#iUserId").val();
        $.ajax({
            url: "{/literal}{$zBasePath}{literal}avis/getInfoChangeManuel/" + iUserId,
            type: 'post',
            data: {
                iUserTarget: iUserTarget
            },
            success: function(data, textStatus, jqXHR) {
                $("#dialog3").html(data);
                $("#dialog3").dialog("open");
                event.preventDefault()
            },
            async: !1
        })
    });
    $(".dialog-link-manuel-localite11").click(); 
	{/literal}{/if} {literal} {/literal}{if $oData.bPhoto==10}{literal}
        $("#dialog3").dialog({
            autoOpen: !1,
            width: '40%',
            closeOnEscape: !1,
            dialogClass: "noclose",
            modal: !0,
            open: function() {
                $('.ui-widget-overlay').addClass('custom-overlay');
                $.ui.dialog.prototype._allowInteraction = function(e) {
                    return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length
                }
            },
            show: {
                effect: "slide",
                duration: 1000
            },
            hide: {
                effect: "drop",
                duration: 1000
            },
            buttons: [{
                text: 'Valider',
                "class": 'saveButtonClass',
                click: function() {
                    var iMiseADispo = 0;
                    var iTestValid = 1;
                    var zMessage = "";
                    var zPhoto = $('#photo').val();
                    var zPhone = $('#zPhone').val();
                    if (zPhoto == '') {
                        var iTestValid = 0;
                        zMessage += "- Veuillez sélectionner votre photo\n"
                    } else {
                        var ext = getExtension(zPhoto).toLowerCase();
                        if (ext == "png" || ext == "gif" || ext == "jpg" || ext == "jpeg") {} else {
                            var iTestValid = 0;
                            zMessage += "Veuillez entrer le fichier ayant des extensions .jpeg/.jpg/.png/.gif.";
                            $('#photo').val("")
                        }
                    }
                    if (zPhone == '') {
                        var iTestValid = 0;
                        zMessage += "- Veuillez remplir le telephone\n"
                    }
                    if (iTestValid == 1) {
                        $("#photoMAJ").submit()
                    } else {
                        alert(zMessage)
                    }
                }
            }]
        });
        $(".dialog-link-manuel-localite11").click(function(event) {
            $("#dialog3").html();
            $('#dialog3').dialog('option', 'title', 'Mise à jour photo et Telephone dans ROHI');
            $('#buttonId').button('option', 'label', 'Valider');
            var iUserTarget = $("#iUserId").val();
            var iUserId = $("#iUserId").val();
            $.ajax({
                url: "{/literal}{$zBasePath}{literal}avis/getTemplatePhoto/" + iUserId,
                type: 'post',
                data: {
                    iUserTarget: iUserTarget
                },
                success: function(data, textStatus, jqXHR) {
                    $("#dialog3").html(data);
                    $("#dialog3").dialog("open");
                    event.preventDefault()
                },
                async: !1
            })
        });
        $(".dialog-link-manuel-localite11").click(); 
		{/literal}{/if} {literal}

        </script>
{/literal}
<style>
{literal}
.ui-widget-overlay.custom-overlay
{
    background-color: grey!important;
    background-image: none!important;
    opacity: 1!important;
}
.noclose .ui-dialog-titlebar-close
{
    display:none;
}
.even{
	background-color: #f9f9f9!important;
}

table tr.even td {
    background-color: #f9f9f9!important;
}

.dataTables_filter {
	display:none!important;
}

#dataTables-example-0_length {
	display:none!important;
}

.dataTables_info {
	display:none!important;
}
.dataTables_paginate {
	float:right;
	padding-right:100px;
}

.dataTables_filter, .dataTables_info { display: none; }
{/literal}
</style>
{include_php file=$zFooter}
		