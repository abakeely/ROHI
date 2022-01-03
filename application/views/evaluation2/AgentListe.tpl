{include_php file=$zCssJs}
<script type="text/javascript" src="{$zBasePath}assets/evaluation2/js/raterater.jquery.js?v2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.iUserId}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
<input type="hidden" name="iUserAddNew" id="iUserAddNew" value="">
<input type="hidden" name="iModeAddUser" id="iModeAddUser" value="">
<input type="hidden" name="iModeForChange" id="iModeForChange" value="">

<input type="hidden" value="" id="departementSelected"/>
<input type="hidden" value="" id="directionSelected"/>
<input type="hidden" value="" id="serviceSelected"/>
<input type="hidden" value="" id="divisionSelected"/>
<input type="hidden" value="" id="bureauSelected"/>

</form>
<div class="main-wrapper">
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">Liste des Agents &agrave; Evaluer</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">RH</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Evaluation</a></li>
				<li class="breadcrumb-item">Liste des agents à évaluer</li>
			</ul>
		</div>
	</div>
</div>

        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
                <div class="card punch-status">
                        <div class="card-body">
                            <div class="card punch-status">
						<form action="{$zBasePath}titre/fiche/titre-de-paiement" method="POST" name="formulaireTransaction" id="formulaireTransaction" style="display:block!important" enctype="multipart/form-data">
						<div class="card-body">
							<h5 class="card-title">Sélection période / année à afficher</h5>

								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>Période</label>
												<select name="iPeriode" id="iPeriode" style="width:329px!important" onChange="setAnneeEvaluation(this)">
														{foreach from=$oData.toPeriode item=oPeriode}
															{if $oPeriode->periode_id==sizeof($oData.toPeriode)} {assign var=iLastPeriode value=$oPeriode->periode_id} {/if}
															<option iAnnee="{$oPeriode->periode_annee}" {if $oPeriode->periode_id==sizeof($oData.toPeriode)} selected="selected" {/if} value="{$oPeriode->periode_id}">&nbsp;{$oPeriode->periode_libelle} {$oPeriode->periode_annee} (&nbsp;{$oPeriode->periode_mois}&nbsp;)&nbsp;&nbsp;</option>
														{/foreach}
												</select>
												<p class="message debut" style="width:500px">&nbsp;</p>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											 <label>Année</label>
												{assign var=iAnneeMoinsUn value=$oData.zAnneeAffiche-1}
												<select name="iAnnee" id="iAnnee" style="width:329px!important" onChange="setMoisEvaluation(this)">
													<option iPeriode="4"  value="2016">&nbsp;2016 / 2017</option>
													<option iPeriode="3" value="2017">&nbsp;2017</option>
													<option iPeriode="5"  value="2018">&nbsp;2018</option>
													<option iPeriode="6" value="2019">&nbsp;2019</option>
													<option iPeriode="7" value="2020">&nbsp;2020</option>
													<option iPeriode="8" value="2021">&nbsp;2021</option>
													<option iPeriode="9" selected="selected"  value="2022">&nbsp;2022</option>
												</select>
											
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<input type="button" style="cursor:pointer" class="button"  onclick="setListeEvaluation()" id="" value="Afficher">
										</div>
									</div>
								</div>
								</form>

						</div>
                </div>
			</div>
                <!--Recherche-->
			<div class="card-body">
                            <!--div class="card punch-status">
						 <form action="{$zBasePath}critere/liste/agent-evaluation/a-evaluer" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block">
						<div class="card-body">
							<h5 class="card-title">Recherche agent</h5>

								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>Matricule</label>
											<input type="text" class="form-control" style="width:329px!important" name="iMatricule1" id="iMatricule1" value=""
												   placeholder="">

											<p class="message debut" style="width:500px">&nbsp;</p>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>CIN</label>
											<input type="text" class="form-control" style="width:329px!important" name="iCin1" id="iCin1" value=""
												   placeholder="">
											<p class="message fin" style="width:500px">&nbsp;</p>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<input type="button" style="cursor:pointer" class="button"
                                                   onclick="sendSearch1(1)" value="rechercher">
										</div>
									</div>
								</div>
								</form>

						</div>
                </div--->

		<div class="contenuePage">
		<ul class="tabs" id="menuListUsers">
			<li class="tab-link" iModeId="1" data-tab="tab-1" id="liTab-1">Agents non évalués pour la période sélectionnée<span class="span_1" {if $oData.iSpan1==0}style="display:none"{/if}>{$oData.iSpan1}</span></li>
			<li class="tab-link" iModeId="2" data-tab="tab-2" id="liTab-2">Agents évalués pour la période sélectionnée<span class="span_2" {if $oData.iSpan2==0}style="display:none"{/if}>{$oData.iSpan2}</span></li>
			<li class="tab-link current" iModeId="3" data-tab="tab-3" id="liTab-3">Agents sans évaluateur</li>
		</ul>

		<div id="tab-1" class="tab-content">
				<div id="table-liste-evaluer-1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table id="table-liste-evaluer-1" class="dataTable no-footer"
                                   aria-describedby="table-liste-evaluer-1_info">
					<thead>
						<tr role="row">
							<th>Nom</th>
							<th>Pr&eacute;nom</th>
							<th>Matricule</th>
							<th class="center" width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						{assign var=iIncrement value="0"}
						{if sizeof($oData.oListe)>0}
						{foreach from=$oData.oListe item=oListeAgent }
						<tr {if $iIncrement%2 == 0} class="even" {/if}>
							<td>{$oListeAgent.nom}</td>
							<td>{$oListeAgent.prenom}</td>
							<td>{$oListeAgent.matricule}</td> 
							<td class="center">
								{if $oListeAgent.iLocaliteChange > 0}
								<span id="iLocalChangeAgentId_{$oListeAgent.user_id}">
								<a href="#" title="Changement localit&eacute; de service" iAgentId="{$oListeAgent.user_id}"  class="evaluer dialog-link-localite"><i style="color:#4d8d00;font-size:15px;" title="Modifier" alt="Modifier" class="la la-check-square-o"></i></a>&nbsp;&nbsp;</span>
								{/if}
								<a href="#" title="Note Evaluation" iAgentId="{$oListeAgent.user_id}" class="evaluer dialog-link"><i style="color:#12105A;font-size:15px;" title="Modifier" alt="Modifier" class="la la-newspaper-o"></i></a>&nbsp;&nbsp;
								<a href="#" title="Changement manuel localité service" iAgentId="{$oListeAgent.user_id}" class="evaluer dialog-link-manuel-localite"><i style="color:#12105A;font-size:15px;" title="changement localité service" alt="chagement localité service" class="la la-credit-card"></i></a>
							</td>
						</tr>
						{assign var=iIncrement value=$iIncrement+1}
						{/foreach}
						{else}
						<tr><td style="text-align:center;" colspan="4">Aucun enregistrement correspondant</td></tr>
						{/if}
					</tbody>
				</table>
				</div>
		</div>
		<div id="tab-2" class="tab-content ">
			<table id="table-liste-evaluer-2">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Pr&eacute;nom</th>
							<th>Matricule</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr><td style="text-align:center;" colspan="4">Aucun enregistrement correspondant</td></tr>
					</tbody>
				</table>

		</div>

		<div id="tab-3" class="tab-content current">
			<h5>Liste des agents sans évaluateur</h5>
			<h5>Si vous êtes son évaluateur, veuillez approuver. merci!</h5>
			<div id="dataTables-dialogEvaluation_wrapper" class="dataTables_wrapper form-inline" role="grid">
			<table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="dataTables-dialogEvaluation" aria-describedby="dataTables-dialogEvaluation_info">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Pr&eacute;nom</th>
						<th>Matricule</th>
						<th>Localité de service</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($oData.toListeApprouver)>0}
					{foreach from=$oData.toListeApprouver item=oListeApprouver }
					<tr {if $iIncrement%2 == 0} class="even" {/if}>
						<td>{$oListeApprouver->nom}</td>
						<td>{$oListeApprouver->prenom}</td>
						<td>{$oListeApprouver->matricule}</td>
						<td>{$oListeApprouver->path}</td>
						<td>
							<a class="btn btn-sm btn-primary dialog-link-manuel-localite mt-2" iagentid="{$oListeApprouver->user_id}">Appouver</a>
							&nbsp;&nbsp;&nbsp;
							<a class="btn btn-sm btn-primary dialog-link-manuel-localite mt-2" datasuppr="{$oListeApprouver->user_id}" iagentid="{$oListeApprouver->user_id}">Désapprouver</a>
							&nbsp;&nbsp;&nbsp;
							<!--button class="btn btn-info dialog-link-manuel-localite" type="button"
									style="border: 5px solid #6fb3e0;width:108px;" title="Approuver"
									alt="Approuver" iagentid="{$oListeApprouver->user_id}">
								<i class="ace-icon la la-check bigger-110"></i>
								Appouver
							</button>
							<button class="btn btn-danger dialog-link-manuel-localite" type="button"
									style="border: 5px solid #d15b47;width:130px;" title="Desapprouver"
									alt="Desapprouver" datasuppr="{$oListeApprouver->user_id}" iagentid="{$oListeApprouver->user_id}">
								<i class="ace-icon la la-close bigger-110"></i>
								Désapprouver
							</button-->
						</td>
					</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{else}
					<tr><td style="text-align:center;border:none" colspan="7"></td></tr>
					{/if}
				</tbody>
			</table>
		</div>
		</div>
		</div>
		<p>&nbsp;</p>
		<!--<div class="card punch-status">
		<p style="color:red"> Les boutons actions : </p>
		<p><i style="color:#4d8d00;font-size:15px;" title="Modifier" alt="Modifier" class="la la-check-square-o"></i> : Validation changement localité de service (s'il y a une demande de l'agent)</p>
		<p><i style="color:#12105A;font-size:15px;" title="Modifier" alt="Modifier" class="la la-newspaper-o"></i> : Evaluation Agent</p>
		<p><i style="color:#12105A;font-size:15px;" title="Modifier" alt="Modifier" class="la la-credit-card"></i> : Changement manuel de la localité de service d'un agent / Supprimer un agent de la liste des évalués</p>
		</div>-->
		<p>&nbsp;</p>
	</div>
	<!--CONTENUE-->
	</div>

</div>
</form>
<form name="formDelete" id="formDelete" action="" method="POST">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}evaluation/liste/agent-evaluation/global">
</form>
<!-- ui-dialog -->
<div id="dialog" title="Dialog Title">
</div>
<div id="dialog2" title="Dialog Title">
</div>
<div id="dialog3" title="Dialog Title">
</div>
<div id="dialogEvaluation" title="Dialog Title" style="text-align:center">
	<span id="spanDialog" style="font-size:1.2em;"></span>
</div>
<div id="dialog5" title="Dialog Title" style="text-align:center">
	<span id="spanDialog2" style="font-size:1.2em;"></span>
</div>
<div id="dialog6" title="Dialog Title">
</div>
{literal}
<script>
   function __setAnneeEvaluation(_iMois) {
        switch (_iMois) {
            case '1':
                $("#iAnnee").val('{/literal}{$oData.zAnneeAffiche}{literal}');
                break;
            case '2':
                $("#iAnnee").val('{/literal}{$oData.zAnneeAffiche}{literal}');
                break;
            case '3':
                $("#iAnnee").val('{/literal}{$oData.zAnneeAffiche}{literal}');
                break;
            case '4':
                $("#iAnnee").val('{/literal}{$iAnneeMoinsUn}{literal}');
                break
        }
    }

	function setAnneeEvaluation(_this) {
		var zAnnee = $('option:selected', _this).attr('iAnnee');
        $("#iAnnee").val(zAnnee);
    }

    function __setMoisEvaluation(_iAnnee) {
        switch (_iAnnee) {
            case '{/literal}{$iAnneeMoinsUn}{literal}':
                $("#iPeriode").val('4');
                break;
            case '{/literal}{$oData.zAnneeAffiche}{literal}':
                $("#iPeriode").val('1');
                break
        }
    }

	function setMoisEvaluation(_this) {
        var iPeriode = $('option:selected', _this).attr('iPeriode');
        $("#iPeriode").val(iPeriode);
    }

    function sendSearch1(_iSwitch) {
        var iCin = $("#iCin" + _iSwitch).val();
        var iMatricule = $("#iMatricule" + _iSwitch).val();
        var iTest = 0;
        if (iCin == '' && iMatricule == '') {
            iTest = 1
        }
        if (iTest == 0) {
            $("#iCin").val("");
            $("#iMatricule").val("");
            $("#iUserAddNew").val("");
            if (iTest == 0) {
                $.ajax({
                    url: "{/literal}{$zBasePath}{literal}evaluation/sendSearch/",
                    method: "POST",
                    data: {
                        iCin: iCin,
                        iMatricule: iMatricule
                    },
                    success: function(data, textStatus, jqXHR) {
                        var oReturn = jQuery.parseJSON(data);
                        if (oReturn.user_id == 0) {
                            $("#spanDialog").html('<br/><br/><br/>L\'agent ' + oReturn.zName + ' est déjà évalué par <br/><br/>' + oReturn.message + '.\<br><br>Êtes vous sûr de vouloir ajouter l\'agent dans votre liste?<br/><br/><br/>');
                            $("#iUserAddNew").val(oReturn.iUserId);
                            $('#iModeForChange').val(2);
                            $("#iModeAddUser").val(2)
                            var iUserTarget = oReturn.iUserId;
                            var iModeForChange = $('#iModeForChange').val();
                            $("#dialogEvaluation").html('');
                            var iUserId = oReturn.iUserId;
                            $.ajax({
                                url: "{/literal}{$zBasePath}{literal}critere/getInfoChangeManuel/" + iUserId,
                                type: 'post',
                                data: {
                                    iModeForChange: iModeForChange,
                                    iUserTarget: iUserTarget,
                                    zName: oReturn.zName,
                                    zMessage: oReturn.message
                                },
                                success: function(data, textStatus, jqXHR) {
                                    //$("#dialogEvaluation").html(data);
									//$('#buttonAddId').button('option', 'label', 'Ajouter quand même');
									$('#buttonAddId').html('Ajouter quand même');
                                    $("#dialogEvaluation").dialog("open");
                                    event.preventDefault()
                                },
                                async: false
                            })
                        } else if (oReturn.user_id == -3) {
                            $("#spanDialog2").html('<br/><br/><br/>Vous ne pouvez pas evaluer vous-même<br/><br/><br/>');
                            $("#dialog5").dialog("open");
                            $("#iUserAddNew").val('');
                            $("#iModeAddUser").val(0)
                        } else if (oReturn.user_id == -2) {
                            $("#spanDialog2").html('<br/><br/><br/>l\'agent ' + oReturn.zName + ' est déjà disponible dans votre liste<br/><br/><br/>');
                            $("#dialog5").dialog("open");
                            $("#iUserAddNew").val(0);
                            $("#iModeAddUser").val(0)
                        } else {
                            $.ajax({
                                url: "{/literal}{$zBasePath}{literal}evaluation/sendSearchAdmin/",
                                method: "POST",
                                data: {
                                    iCin: iCin,
                                    iMatricule: iMatricule
                                },
                                success: function(data, textStatus, jqXHR) {
                                    var oReturn = jQuery.parseJSON(data);
                                    if (oReturn.user_id > 0) {
                                        $("#dialogEvaluation").html('');
                                        $("#spanDialog").html('<br/><br/><br/>Êtes vous sûr de vouloir ajouter l\'agent ' + oReturn.zName + ' dans votre liste?<br/><br/><br/>');
                                        $("#dialogEvaluation").dialog("open");
                                        $("#iUserAddNew").val(oReturn.user_id);
                                        $("#iModeAddUser").val(1)
                                        $("#iUserAddNew").val(oReturn.iUserId);
                                        $('#iModeForChange').val(2);
                                        var iUserTarget = oReturn.iUserId;
                                        var iModeForChange = $('#iModeForChange').val();
                                        var iUserId = oReturn.iUserId;
                                        $.ajax({
                                            url: "{/literal}{$zBasePath}{literal}critere/getInfoChangeManuel/" + iUserId,
                                            type: 'post',
                                            data: {
                                                iModeForChange: iModeForChange,
                                                iUserTarget: iUserTarget,
                                                zName: oReturn.zName,
                                            },
                                            success: function(data, textStatus, jqXHR) {
                                                $("#dialogEvaluation").html(data);
                                                $("#dialogEvaluation").dialog("open");
												//$('#buttonAddId').button('option', 'label', 'Ajouter');
												$('#buttonAddId').html('Ajouter');
                                                event.preventDefault()
                                            },
                                            async: false
                                        })
                                    } else {
                                        alert("L'agent n'est pas encore dans ROHI. Veuillez contacter la cellule communication de la DRHA")
                                    }
                                }
                            })
                        }
                    }
                })
            }
        } else {
            if (iCin == '' || iMatricule == '') {
                alert("Veuillez remplir le CIN ou le Matricule")
            }
        }
    }

    function setListeEvaluation() {
        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');
        $("#liTab-1").addClass('current');
        $("#tab-1").addClass('current');
        getTable(1) 
    }

    function getTable(_iMode) {
        $(document).ready(function() {
            var iPeriode = $("#iPeriode").val();
            var iAnnee = $("#iAnnee").val();
            $.ajax({
                url: "{/literal}{$zBasePath}{literal}critere/getListeANoterOuDejaNoter",
                method: "POST",
                data: {
                    iModeId: _iMode,
                    iPeriode: iPeriode,
                    iAnnee: iAnnee
                },
                success: function(data, textStatus, jqXHR) {
                    var oReturn = jQuery.parseJSON(data);
                    $("#tab-" + _iMode).html(oReturn.zHtmlReturn);
                    if (oReturn.iSpan1 > 0) {
                        $(".span_1").html(oReturn.iSpan1);
                        $(".span_1").show();
                    } else {
                        $(".span_1").hide();
                    }
                    if (oReturn.iSpan2 > 0) {
                        $(".span_2").html(oReturn.iSpan2);
                        $(".span_2").show();
                    } else {
						
                        $(".span_2").hide();
                    }
                },
                async: false
            })
        })
    }

	function sendLocalite(_iType){
		var iUserId = $("#iUserLocaliteId").val();
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/saveLocaliteService/",
			type: 'Post',
			data: {
				iUserId: iUserId,
				iType:_iType
			},
			success: function(data, textStatus, jqXHR) {
				var iSize = $("#iSize").val();
				if(iSize>1){
					$("#dialog6").html();
					$("#dialog6").dialog("close");
					$(".popUpLocalite").click();
				} else {
					$("#dialog6").html();
                    $("#dialog6").dialog("close");
				}
				
				event.preventDefault()
			},
			async: false
		})
	}


    $(document).ready(function() {
                $('ul.tabs li').click(function() {
                    var tab_id = $(this).attr('data-tab');
                    var iModeId = $(this).attr('iModeId');
                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');
                    $(this).addClass('current');
                    $("#" + tab_id).addClass('current');
                    if (iModeId < 3) {
                        getTable(iModeId)
                    }
                })
                $("#dialog5").dialog({
                    autoOpen: false,
                    width: '40%',
                    title: 'Evaluation',
                    close: 'X',
                    modal: false,
                    overlay: true,
                    buttons: [{
                        text: "OK",
                        click: function() {
                            $("#dialog5").dialog("close")
                        }
                    }, {
                        text: "Annuler",
                        click: function() {
                            $(this).dialog("close")
                        }
                    }]
                });
                $("#dialogEvaluation").dialog({
                    autoOpen: false,
                    width: '75%',
                    title: 'Ajout agent dans l\'evaluation',
                    close: 'X',
                    modal: true,
                    overlay: true,
                    buttons: [{
						id: "buttonAddId",
                        text: "Ajouter",
                        click: function() {
                            var iTestValid = 1;
                            var zMessage = "";
                            var iUserId = $("#iUserId").val();
                            var iModeForChange = $('#iModeForChange').val();
                            var iProvinceId = $('#iOrganisation_1').val();
                            var iRegionId = $('#iOrganisation_2').val();
                            var iDistrictId = $('#iOrganisation_3').val();
                            var iDepartementId = $('#iOrganisation_4').val();

							var iRattachement = $('select[name="iRattachement[]"]').map(function(){ 
								return this.value; 
							}).get();
							
                            var iDirectionId = $('#iOrganisation_5').val();
                            var iServiceId = $('#iOrganisation_6').val();
                            var iDivisionId = $('#iOrganisation_7').val();

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

							var iRattachement = $('select[name="iRattachement[]"]').map(function(){ 
								return this.value; 
							}).get();
							if( iRattachement.length ==2 ){
								 var iDirectionId	= iRattachement[0].substring(4,20);
								 var iServiceId		= iRattachement[1].substring(4,20);
							}

                            if (iTestValid == 1) {
                                var iModeAddUser = $("#iModeAddUser").val();
                                if (iModeAddUser > 0) {
                                    var iModeAddUser = $("#iModeAddUser").val();
                                    var zUrl = '';
                                    switch (iModeAddUser) {
                                        case '1':
                                            zUrl = "{/literal}{$zBasePath}{literal}critere/saveUpdateUser/";
                                            break;
                                        case '2':
                                            zUrl = "{/literal}{$zBasePath}{literal}critere/saveUpdateUserAndDropLastListeEvaluateur/";
                                            break
                                    }
                                    zListe = $("#iUserAddNew").val();
                                    $.ajax({
                                        url: zUrl,
                                        method: "POST",
                                        data: {
                                            zListe: zListe,
                                            iUserId: iUserId,
                                            iProvinceId: iProvinceId,
                                            iRegionId: iRegionId,
                                            iDistrictId: iDistrictId,
                                            iDepartementId: iDepartementId,
                                            iDirectionId: iDirectionId,
                                            iServiceId: iServiceId,
                                            iDivisionId: iDivisionId,
                                            iModeForChange: iModeForChange
                                        },
                                        success: function(data, textStatus, jqXHR) {
                                            $("#dialogEvaluation").dialog("close");
                                            getTable(1);
											$("#iUserAddNew").val('');
											$("#iModeAddUser").val('');
                                        },
                                        async: false
                                    })
                                } else {
                                    $("#dialogEvaluation").dialog("close")
                                }
                            } else {
                                alert(zMessage)
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
                    width: '75%',
                    title: 'Fiche note évaluation',
                    close: 'X',
                    modal: true,
                    buttons: [{
                        text: "Valider",
                        click: function() {
                            var iValueEvaluable = $("#iEvaluableValue").val();
                            if (iValueEvaluable == 1) {
                                var iClassificationValue = $("#iClassificationValue").val();
                                if (iClassificationValue == 0) {
                                    alert("Veuillez choisir une catégorie");
                                } else {
                                    var iTestNote = 1;
                                    var zAllNote = "";
                                    var zMessageError = "";
                                    iValue = $('#iManuel').is(':checked');
                                    iMoyenneUserInfoPointage = $("#iMoyenneUserInfoPointage").val();
                                    var iTotalNote = 0;
                                    var iIncrement = 0;
                                    $('.lesNotes').each(function() {
                                        if (zAllNote == '') {
                                            zAllNote += $(this).attr("zCritereId") + "-" + $(this).val()
                                        } else {
                                            zAllNote += ';' + $(this).attr("zCritereId") + "-" + $(this).val()
                                        }
                                        if ($(this).val() == '' && $(this).attr("zCritereId") != 7) {
                                            iTestNote = 0;
                                            zMessageError += "- Veuillez sélectionner la note : " + $(this).attr("zLibelle") + "\n"
                                        }
                                        if (($(this).attr("zCritereId") == 7)) {
                                            if (iMoyenneUserInfoPointage == '' && $(this).val() == '' && iValue == false) {
                                                iTestNote = 0;
                                                zMessageError += "- Veuillez sélectionner la note : " + $(this).attr("zLibelle") + "\n"
                                            } else if ($(this).val() == '' && iValue == true) {
                                                iTestNote = 0;
                                                zMessageError += "- Veuillez sélectionner la note : " + $(this).attr("zLibelle") + "\n"
                                            } else {
                                                if (iValue == false && iMoyenneUserInfoPointage != 0) {
                                                    iTotalNote = iTotalNote + eval(iMoyenneUserInfoPointage)
                                                }
                                                if (iValue == true && $(this).val() != '') {
                                                    iTotalNote = iTotalNote + eval($(this).val())
                                                }
                                                if (iValue == false && $(this).val() != '') {
                                                    iTotalNote = iTotalNote + eval($(this).val())
                                                }
                                            }
                                        } else {
                                            iTotalNote = iTotalNote + eval($(this).val())
                                        }
                                        iIncrement = iIncrement + 1
                                    })
                                    if (iTestNote == 1) {
                                        if ($("#zCandidatSearch").val() != '') {
                                            iTotalNoteAffiche = (iTotalNote / iIncrement) * 4;
                                            iTotalNoteAffiche1 = iTotalNoteAffiche.toFixed(2);
                                            toSplit = iTotalNoteAffiche1.split(".");
                                            if (toSplit[1] != '00') {
                                                zAffiche = iTotalNoteAffiche1
                                            } else {
                                                zAffiche = toSplit[0]
                                            }
                                            if (confirm("Êtes vous sûr de vouloir valider ce note " + zAffiche + "/20 ?")) {
                                                var noteEvaluation_userSendNoteId = $("#noteEvaluation_userSendNoteId").val();
                                                var userANoteId = $("#userANoteId").val();
                                                iValue = $('#iManuel').is(':checked');
                                                fFloatNotePonctualiteOfUser = '';
                                                if (iValue == false) {
                                                    fFloatNotePonctualiteOfUser = 1
                                                }
                                                var iMois = $("#iMoisPost").val();
                                                var iAnnee = $("#iAnneePost").val();
                                                $.ajax({
                                                    url: "{/literal}{$zBasePath}{literal}critere/notationUser/",
                                                    method: "POST",
                                                    data: {
                                                        zAllNote: zAllNote,
														iNotePonctualiteAssign : $("#iNotePonctualiteAssign").val(),
                                                        userANoteId: userANoteId,
                                                        noteEvaluation_userSendNoteId: noteEvaluation_userSendNoteId,
                                                        iMois: iMois,
                                                        iAnnee: iAnnee,
                                                        fFloatNotePonctualiteOfUser: fFloatNotePonctualiteOfUser,
                                                        iClassificationValue: iClassificationValue
                                                    },
                                                    success: function(data, textStatus, jqXHR) {
                                                        if (data == 1) {
                                                            alert("La note est enregistrée avec succès !");
                                                            getTable(1)
                                                        } else {
                                                            alert("Une note est déjà attibuée sur le couple Période/Année !")
                                                        }
                                                        $("#dialog").dialog("close")
                                                    },
                                                    async: false
                                                })
                                            }
                                        } else {
                                            alert("Veuillez sélectionner l'Evaluateur!")
                                        }
                                    } else {
                                        alert(zMessageError)
                                    }
                                }
                            } else {
                                if ($("#zCandidatSearch").val() != '') {
                                    if (confirm("Êtes vous sûr de confirmer que cet agent n'est pas evaluable pour le trimestre de l'année ?")) {
                                        var noteEvaluation_userSendNoteId = $("#noteEvaluation_userSendNoteId").val();
                                        var userANoteId = $("#userANoteId").val();
                                        var iMois = $("#iMois").val();
                                        var iAnnee = $("#iAnnee").val();
                                        zAllNote = "";
                                        $.ajax({
                                            url: "{/literal}{$zBasePath}{literal}critere/notationUser/",
                                            method: "POST",
                                            data: {
                                                zAllNote: zAllNote,
                                                userANoteId: userANoteId,
                                                noteEvaluation_userSendNoteId: noteEvaluation_userSendNoteId,
                                                iMois: iMois,
                                                iAnnee: iAnnee,
                                                iValueEvaluable: iValueEvaluable
                                            },
                                            success: function(data, textStatus, jqXHR) {
                                                if (data == 1) {
                                                    alert("Enregistrement effectué !")
                                                } else {
                                                    alert("Une note est déjà attibuée sur le couple Mois/Année !")
                                                }
                                                getTable(1);
                                                $("#dialog").dialog("close")
                                            },
                                            async: false
                                        })
                                    }
                                } else {
                                    alert("Veuillez sélectionner l'Evaluateur!")
                                }
                            }
                        }
                    }, {
                        text: "Annuler",
                        click: function() {
                            $(this).dialog("close");
                        }
                    }]
                });
                $("#dialog2").dialog({
                    autoOpen: false,
                    width: '50%',
                    title: 'Validation changement localité de service',
                    close: 'X',
                    modal: false,
                    buttons: [{
                        text: "Valider",
                        click: function() {
                            var iUserId = $("#iUserId").val();
                            $.ajax({
                                url: "{/literal}{$zBasePath}{literal}critere/saveLocaliteService/",
                                type: 'Post',
                                data: {
                                    iUserId: iUserId
                                },
                                success: function(data, textStatus, jqXHR) {
                                    $("#iLocalChangeAgentId_" + iUserId).hide();
                                    $("#dialog2").html();
                                    $("#dialog2").dialog("close");
                                    event.preventDefault()
                                },
                                async: false
                            })
                        }
                    }, {
                        text: "Annuler",
                        click: function() {
                            $(this).dialog("close")
                        }
                    }]
                });
                $("#dialog3").dialog({
                    autoOpen: false,
                    width: '75%',
                    close: 'X',
                    modal: true,
                    buttons: [{
                        id: "buttonId",
                        click: function() {
                            var iTestValid = 1;
                            var zMessage = "";
                            var iUserId = $("#iUserId").val();
                            var iModeForChange = $('#iModeForChange').val();
                            var iProvinceId = $('#iOrganisation_1').val();
                            var iRegionId = $('#iOrganisation_2').val();
                            var iDistrictId = $('#iOrganisation_3').val();
                            var iDepartementId = $('#iOrganisation_4').val();
                            var iDirectionId = $('#iOrganisation_5').val();
                            var iServiceId = $('#iOrganisation_6').val();

							 var iRattachement = $('select[name="iRattachement[]"]').map(function(){ 
								return this.value; 
							}).get();

							var users = $('input:text.users').serialize();

                            var iDivisionId = $('#iOrganisation_7').val();
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
                            if (iTestValid == 1) {
                                $.ajax({
                                    url: "{/literal}{$zBasePath}{literal}critere/saveLocaliteServiceEvaluateur/",
                                    method: "POST",
                                    data: {
                                        iUserId: iUserId,
                                        iProvinceId: iProvinceId,
                                        iRegionId: iRegionId,
                                        iDistrictId: iDistrictId,
                                        iDepartementId: iDepartementId,
                                        iDirectionId: iDirectionId,
										iDirectionId: iDirectionId,
                                        iServiceId: iServiceId,
										iRattachement:iRattachement,
                                        iDivisionId: iDivisionId,
                                        iModeForChange: iModeForChange
                                    },
                                    success: function(data, textStatus, jqXHR) {
                                        $("#dialog3").dialog("close");
                                        window.location.reload()
                                    },
                                    async: false
                                })
                            } else {
                                alert(zMessage)
                            }
                        }
                    }, {
                        text: "Annuler",
                        click: function() {
                            $(this).dialog("close")
                        }
                    }]
                });
                $(".dialog-link").click(function(event) {
                    $("#userANoteId").val("");
                    $("#noteOfUserId").val("");
                    $("#dialog").html();
                    var iUserId = $(this).attr("iAgentId");
                    $.ajax({
                        url: "{/literal}{$zBasePath}{literal}critere/getInfoUser/" + iUserId,
                        type: 'get',
                        data: {
                            iEvaluateur: 1
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#dialog").html(data);
                            $("#dialog").dialog("open");
                            event.preventDefault()
                        },
                        async: false
                    })
                });
                $(".dialog-link-localite").click(function(event) {
                    $("#dialog2").html();
                    var iUserId = $(this).attr("iAgentId");
                    $.ajax({
                        url: "{/literal}{$zBasePath}{literal}critere/getInfoUserChangeLocalite/" + iUserId,
                        type: 'get',
                        data: {
                            iEvaluateur: 1
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#dialog2").html(data);
                            $("#dialog2").dialog("open");
                            event.preventDefault()
                        },
                        async: false
                    })
                });

				{/literal}{if sizeof($oData.toChangeLocalite)>0}{literal}
				$( "#dialog6" ).dialog({
					autoOpen: false,
					width: '75%',
					closeOnEscape: false,
					modal: true,
					show: {
						effect: "slide",
						duration: 1000
				    },
				    hide: {
					  effect: "drop",
					  duration: 1000
				    }
					
				});

				

				$( "#dialog6" ).dialog("option", "buttons", {});

				$(".popUpLocalite").click(function(event) {
					$("#dialog6").html();
					var zTitle = $(this).attr("title");
					$('#dialog6').dialog('option', 'title', "Confirmation changement localité de service d'un agent");
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}critere/getChangeLocaliteEvaluateur/",
						type: 'post',
						data: {
							
						},
						success: function(data, textStatus, jqXHR) {
							$("#dialog6").html(data);
							$("#dialog6").dialog("open");
							event.preventDefault()
						},
						async: false
					})
				});
				
				$(".popUpLocalite").click();
				{/literal}{/if}{literal}

                $(".dialog-link-manuel-localite").click(function() {
                    $("#dialog3").html();
                    var zTitle = $(this).attr("title");
					$("#iUserId").val(iUserTarget);
                    switch (zTitle) {
                        case "Supprimer":
                            $('#dialog3').dialog('option', 'title', 'Suppression d\'un agent dans la liste des évalués');
                            //$('#buttonId').button('option', 'label', 'Supprimer');
							$('#buttonId').html('Supprimer');
                            $('#iModeForChange').val(1);
                            var iUserTarget = $(this).attr("iAgentId");
							$("#iUserId").val(iUserTarget);
                            var iModeForChange = $('#iModeForChange').val();
                            break;
                        case "Approuver":
                            $('#dialog3').dialog('option', 'title', 'Approuvé l\'agent dans la liste des évalués');
                            //$('#buttonId').button('option', 'label', 'Approuver');
							$('#buttonId').html('Approuver');
                            $('#iModeForChange').val(2);
                            var iUserTarget = $(this).attr("iAgentId");
							$("#iUserId").val(iUserTarget);
                            var iModeForChange = $('#iModeForChange').val();
                            break;
                        case "Desapprouver":
                            $('#dialog3').dialog('option', 'title', 'Désapprouvé l\'agent dans la liste des évalués');
                            //$('#buttonId').button('option', 'label', 'Désapprouvé');
							$('#buttonId').html('Désapprouvé');
                            $('#iModeForChange').val(3);
                            var iUserTarget = $(this).attr("iAgentId");
							$("#iUserId").val(iUserTarget);
                            var iModeForChange = $('#iModeForChange').val();
                            break
                    }
                    var iUserId = $(this).attr("iAgentId");
                    $.ajax({
                        url: "{/literal}{$zBasePath}{literal}critere/getInfoChangeManuel/" + iUserId,
                        type: 'post',
                        data: {
                            iModeForChange: iModeForChange,
                            iUserTarget: iUserTarget
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#dialog3").html(data);
                            $("#dialog3").dialog("open");
                            event.preventDefault()
                        },
                        async: false
                    })
                });
                $(".dialog-link, #icons li").hover(function() {
                    $(this).addClass("ui-state-hover")
                }, function() {
                    $(this).removeClass("ui-state-hover")
                }); 
				{/literal}{if sizeof($oData.toListeApprouver)>0&&$oData.iCurrPage==1}{literal}
                    $("#dataTables-dialogEvaluation").dataTable(); 
				{/literal}{/if} 
				{literal} 
				{/literal}{if sizeof($oData.oListe)>0}{literal}
                        $("#table-liste-evaluer-1").dataTable(); 
				{/literal}{/if} {literal}
                    })
</script>

{/literal}
{include_php file=$zFooter}
</div>

</body>
</html>