{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}
			<link rel="stylesheet" href="{$zBasePath}assets/sau/css/ace2.css" class="ace-main-stylesheet" id="main-ace-style" />
			{if $oData.iCompteActif == 1}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Commander un nouveau Badge</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Flux agents / visiteurs </a></li>
									<li class="breadcrumb-item">Badge</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="card-body">
									<form action="{$zBasePath}pointage/saveBadge/pointage-electronique/" method="POST" name="formulaireCommande" id="formulaireCommande"  enctype="multipart/form-data">
										<fieldset>
											<div class="row clearfix" style="display:inline">
												<div class="cell">
													<div class="field">
														<input type="radio" {if $oData.zImCarte!=''}disabled="disabled"{/if} name="iRadioMotif" value="1">Nouvelle carte ROHI {if $oData.zImCarte!=''} (N° carte actuelle : {$oData.zImCarte}){/if}<br>
														<input type="radio" name="iRadioMotif" value="2">Carte ROHI perdue<br>
														<input type="radio" name="iRadioMotif" value="3">Carte ROHI d&eacute;fectueuse<span  id="rendreBadge" style="display:none;color:green;font-size:13px;font-weight:bold">&nbsp;(Veuillez rendre la carte d&eacute;fectueuse à la porte 15 MFB Antaninarenina)</span><br>
														<input type="radio" name="iRadioMotif" value="4">Transfert interd&eacute;partemental<br>
														<input type="radio" name="iRadioMotif" value="5">Changement statut (Ex: ECD -> EFA)<br>
													</div>
												</div>
											</div>
											<div class="form-group row clearfix" id="isBadgePerdu" style="clear:both;display:none">
												
												<div class="cell1">
													<div class="field1">
														<label class="col-form-label col-md-10">Déclaration de perte</label>
														<input type="file" name="zFileDeclaration" id="zFileDeclaration" value="" placeholder="Placeholder du champ" class="obligatoire">
														<p class="message">Veuillez entrer une pièce justificative</p>
														<a href="#" title="" class="tooltip">
															<span>&nbsp;</span>
														</a>
													</div>
												</div>
											</div>
											<div class="form-group row clearfix" id="isModtif" style="clear:both;display:none">
												<div class="cell">
													<div class="field">
														<label>Motifs</label>
														<textarea id="zMotif" name="zMotif"></textarea>
														<p class="message">Veuillez entrer le motif</p>
													</div>
												</div>
											</div>
											<div class="form-group row clearfix" id="isNotNouvelleCarte" style="clear:both;display:none">
												<div class="cell">
													<div class="field">
														<label>Numéro de la Carte ROHI ACTUELLE</label>
														<input type="text" name="badge_numCarte" id="badge_numCarte" readonly="readonly" value="{$oData.zImCarte}">
													</div>
												</div>
											</div>
											<div class="form-group row clearfix" id="isDatePerduOrDefectueuse" style="clear:both;display:none">
												<div class="cell">
													<div class="field">
														<label id="labelDate">Date perdue</label>
														<input type="text" name="badge_datePerdue" id="badge_datePerdue" value="" readonly="readonly" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" class="withDatePicker obligatoire">
														<p class="message">Veuillez entrer la date</p>
													</div>
												</div>
											</div>

											<div class="row clearfix" style="clear:both">
												<div class="cell">
													<div class="field">
														<input type="button" class="button" onClick="validerCommande();" name="" id="" value="COMMANDER UNE CARTE">
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
					<br/><br/>
			{/if}
			{if $oData.iCompteActif ==COMPTE_ADMIN}
				<div class="col-xs-12">
					<div class="box">
						<div class="card-body">
							<div class="">
								<form action="{$zBasePath}pointage/badge/pointage-electronique/saisie/" method="POST" name="formulaireGet" id="formulaireGet" enctype="multipart/form-data">
									<fieldset>
										<div class="row1 clearfix" >
											<div>
												<div class="field">
													<input type="button" {if $oData.iValid==0}style="background: -webkit-gradient(linear,left top,left bottom,from(#5875b8),to(#3c5c97));color:white;cursor:pointer"{else}style="background: -webkit-gradient(linear,left top,left bottom,from(#5d919c),to(#1d3f46));color:white;cursor:pointer"{/if} class="button" style="width:226px;" onClick="send(1);" name="carteRohi1" id="carteRohi1" value="Carte ROHI en cours">
													<input type="button"  class="button" {if $oData.iValid==0}style="background: -webkit-gradient(linear,left top,left bottom,from(#5d919c),to(#1d3f46));color:white;cursor:pointer"{else}style="background: -webkit-gradient(linear,left top,left bottom,from(#5875b8),to(#3c5c97));color:white;cursor:pointer"{/if} onClick="send(2);" name="carteRohi2" id="carteRohi2" value="Carte ROHI d&eacute;livr&eacute;e">
												</div>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
				<br/><br/>
			{/if}
			{if sizeof($oData.toGetBadge)>0}
				<h5 style="z-index:1!important">Historique de demande de carte ROHI</h5>
			{/if}
			<div class="clear"></div>
			<div class="col-xs-12">
				<div class="box">
					<div class="card-body">
						<div class="table-responsive">
							{if $oData.iCompteActif > 1}
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							{else}
							<table>
							{/if}
								<thead>
									<tr>
										{if $oData.iCompteActif > 1}
										<th>Matricule</th>
										<th style="width:20%">Agent</th>
										{/if}
										<th style="width:15%">Date / Heure</th>
										<th style="width:15%">Type de demande</th>
										{if $oData.iCompteActif==COMPTE_AUTORITE}
										<th>PERTE Carte ROHI </th>
										{/if}
										<th>Fichier</th>
										<th>Motif</th>
										{if $oData.iCompteActif==COMPTE_ADMIN}
										<th>Action</th>
										{/if}
									</tr>
								</thead>
								<tbody>
									{assign var=iIncrement value="0"}
									{if sizeof($oData.toGetBadge)>0}
									{foreach from=$oData.toGetBadge item=oListe }
									<tr {if $iIncrement%2 == 0} class="even" {/if}>
										{if $oData.iCompteActif > 1}
										<td>{$oListe.matricule}</td>
										<td style="width:20%">{$oListe.nom}&nbsp;{$oListe.prenom}</td>
										{/if}
										<td style="width:15%">{$oListe.badge_date|date_format:"%d/%m/%Y %H:%M:%S"}</td>
										<td style="width:15%">{if $oListe.badge_demandeType==1}Nouvelle Carte ROHI{elseif $oListe.badge_demandeType==2}Carte ROHI perdue{elseif $oListe.badge_demandeType==3}Carte ROHI d&eacute;fectueuse{elseif $oListe.badge_demandeType==4}Transfert interdépartemental{else}Changement statut{/if}</td>
										{if $oData.iCompteActif==COMPTE_AUTORITE}
										<td>{$oListe.badge_datePerdue|date_format:"%d/%m/%Y %H:%M:%S"}</td>
										{/if}
										<td>
										{if $oData.iCompteActif > 1 && $oListe.badge_document!=''}
										<a style="cursor:pointer;text-decoration:underline" href="{$zBasePath}assets/upload/Badge/Perdu/{$oListe.badge_document}" target="_blank">Voir</a>
										{else}
										{$oListe.badge_document}
										{/if}
										</td>
										<td>{$oListe.badge_motifs}</td>
										{if $oData.iCompteActif ==COMPTE_ADMIN}
										<td>

										<span id="badgeValidation_{$oListe.badge_id}" style="padding-bottom:20px;">
										{if $oListe.badge_validation==''}
										<input type="button" style="cursor:pointer;" class="btn btn-success" onclick="validerBadge({$oListe.badge_id})" name="validerLeBadge" iBadegId="{$oListe.badge_id}" id="validerLeBadge"  value="  Valider  ">
										{else}
										- Validée le : {$oListe.badge_validation|date_format:"%d/%m/%Y"}  {if $oListe.badge_numDechargeValidation!=''}(Num : {$oListe.badge_numDechargeValidation}){/if}
										{/if}
										</span>
										{if $oListe.badge_demandeType > 1 && $oListe.badge_dateRenduBadge==''}
										<br/><br/>
										{/if}
										<span id="dateRetour_{$oListe.badge_id}">
										{if $oListe.badge_demandeType > 2 && $oListe.badge_dateRenduBadge==''}
										
										<input type="button" style="cursor:pointer;" class="btn btn-info" onclick="rendre({$oListe.badge_id})" name="rendreLeBadge" iBadegId="{$oListe.badge_id}" id="rendreLeBadge"  value="Carte ROHI retournée">
										{/if}
										{if $oListe.badge_demandeType > 1 && $oListe.badge_dateRenduBadge!=''}
										<br/><br/>
										- Carte rendue le : {$oListe.badge_dateRenduBadge|date_format:"%d/%m/%Y"} {if $oListe.badge_numDechargeRetour!=''}(Num : {$oListe.badge_numDechargeRetour}){/if}
										{/if}
										</span>
										</td>
										{/if}
									</tr>
									{assign var=iIncrement value=$iIncrement+1}
									{/foreach}
									{else}
									<tr><td style="text-align:center;" colspan="{if $iCompteActif > 1}8{else}5{/if}">Aucun enregistrement correspondant</td></tr>
									{/if}
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>						
			<br/><br/>
			<div id="calendar"></div>


			<div id="dialog" title="Dialog Title">
			</div>
			<div id="dialogValid" title="Dialog Title">
			</div>

			</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}
<script>
{if $oData.iCompteActif>1}
{literal}
$(document).ready(function() {
    $('#dataTables-example').dataTable({
        /* Disable initial sort */
        "aaSorting": []
    });
}); 
{/literal} 
{/if} 
{if $oData.iCompteActif == COMPTE_ADMIN} 
{literal}

        function rendre(_iBadgeId) {
           
            var iBadegId = _iBadgeId;
            $.ajax({
                url: "{/literal}{$zBasePath}{literal}pointage/getPopUpBadgeRetour",
                type: 'POST',
                data: {
                    iBadegId: iBadegId
                },
                success: function(data, textStatus, jqXHR) {
                    $("#dialog").html(data);
                    $("#dialog").dialog("open");
                    event.preventDefault()
                },
                async: true
            })
        }

        function validerBadge(_iBadgeId) {
           
            var iBadegId = _iBadgeId;
            $.ajax({
                url: "{/literal}{$zBasePath}{literal}pointage/getPopUpBadgeValidation",
                type: 'POST',
                data: {
                    iBadegId: iBadegId
                },
                success: function(data, textStatus, jqXHR) {
                    $("#dialogValid").html(data);
                    $("#dialogValid").dialog("open");
                    event.preventDefault()
                },
                async: true
            })
        }

		function send(_iValue){
			var zAction = $("#formulaireGet").attr("action");

			switch (_iValue) {

				case 1:
					zAction = zAction + "";
					break;

				case 2:
					zAction = zAction + "1";
					break;
			}

			$("#formulaireGet").attr("action", zAction) ; 
			$("#formulaireGet").submit();
		}

        $(document).ready(function() {
		

                $("#dialogValid").dialog({
                    autoOpen: false,
                    width: '30%',
                    title: 'Mise à jour date validation badge',
                    close: 'X',
                    modal: true,
                    buttons: [{
                        text: "Valider",
                        click: function() {
                            var zMessage = "";
                            var iBadegId = $("#iBadegId").val();
                            var zDateEntrer = $("#zDateEntrer").val();
							var zNumDechargeValidation = $("#zNumDechargeValidation").val();
                            if (zDateEntrer == '') {
                                zMessage += "Veuillez entrer la date de validation"
                            }

							if (zNumDechargeValidation == '') {
                                zMessage += "Veuillez entrer le numéro de décharge validation"
                            }
                            if (zMessage != '') {
                                alert(zMessage)
                            } else {
                                $.ajax({
                                    url: "{/literal}{$zBasePath}{literal}pointage/saveBadgeValidation/",
                                    type: 'Post',
                                    data: {
                                        iBadegId: iBadegId,
                                        zDateEntrer: zDateEntrer,
										zNumDechargeValidation: zNumDechargeValidation
                                    },
                                    success: function(data, textStatus, jqXHR) {
                                        var oReturn = jQuery.parseJSON(data);
                                        $("#badgeValidation_" + iBadegId).html("- Validée le : " + oReturn.zDateEntrer);
                                        $("#dialogValid").html();
                                        $("#dialogValid").dialog("close");
                                        event.preventDefault()
                                    },
                                    async: true
                                })
                            }
                        }
                    }, {
                        text: "Annuler",
                        click: function() {
                            $(this).dialog("close")
                        }
                    }]
                });
                $("#dialog").dialog({
                    autoOpen: false,
                    width: '30%',
                    title: 'Mise à jour de la date retour badge',
                    close: 'X',
                    modal: true,
                    buttons: [{
                        text: "Valider",
                        click: function() {
                            var zMessage = "";
                            var iBadegId = $("#iBadegId").val();
                            var zDateEntrer = $("#zDateEntrer").val();
							var zNumDechargeRetour = $("#zNumDechargeRetour").val();
                            if (zDateEntrer == '') {
                                zMessage += "Veuillez entrer la date de retour badge"
                            }

							if (zNumDechargeRetour == '') {
                                zMessage += "Veuillez entrer le numéro de décharge retour badge"
                            }
                            if (zMessage != '') {
                                alert(zMessage)
                            } else {
                                $.ajax({
                                    url: "{/literal}{$zBasePath}{literal}pointage/saveBadgeRetour/",
                                    type: 'Post',
                                    data: {
                                        iBadegId: iBadegId,
                                        zDateEntrer: zDateEntrer,
										zNumDechargeRetour: zNumDechargeRetour
                                    },
                                    success: function(data, textStatus, jqXHR) {
                                        var oReturn = jQuery.parseJSON(data);
                                        $("#dateRetour_" + iBadegId).html("- Carte rendue le : " + oReturn.zDateEntrer);
                                        $("#dialog").html();
                                        $("#dialog").dialog("close");
                                        event.preventDefault()
                                    },
                                    async: true
                                })
                            }
                        }
                    }, {
                        text: "Annuler",
                        click: function() {
                            $(this).dialog("close")
                        }
                    }]
                })
            }) 
{/literal} 
{/if}
</script>