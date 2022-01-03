{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb">&nbsp;
	<!--<marquee SCROLLAMOUNT="4">
		<font size="4">
		<font face="Lato">
			<font color="white">Election du Président de l'ASCAL : RAMAHARIVO Baritiana Mampionona élu Président de l'ASCAL à 80% des voix, Vice-Président : RAVELOMANANTSOA Andriatiana Andonirina, SG : RAVELOHARIMALALA Dinaniaina, Trésorière : RAVELOARISON Elitiana Hortense</font>				
		</font>
		</font>
	</marquee>-->
	</div>
	
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc" class="dialog-link-manuel-localite11">
				<input type="hidden" name="iUserId" id="iUserId" value="{$oData.iUserId}">
                <h2>
                    Communiqué
                </h2>
				<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a style="text-decoration:none;" href="{$zBasePath}">Accueil</a> <span>&gt;</span> Communiqué</div>
				{* <div id="contenantVideo" style="display:none">
					<video id="largeVideo" width="100%" webkit-playsinline="true" autoplay="no" loop="yes" muted="true" data-weborama-videoplayer="true" preload="metadata" autobuffer="false" style="position: center; left: 0px; top: 0px; z-index: 200;" title="Double clic pour plein écran">
						<source type="video/mp4" src="{$zBasePath}assets/mfb.mp4">
					</video>
				</div> *}
                <div class="SSttlPage">
                    <div class="sort-Listing">
                        <ul class="nav ace-nav">
                            <li class="malefaka1 dropdown pull-left">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="http://rohi.dev/accueil/communique#" aria-expanded="false">
                                    Catégorie
                                    <i class="ace-icon la la-caret-down"></i>
                                </a>
								<input type="hidden" name="setDialog7" id="setDialog7" value="0">
                                <ul class="dropdown-menu">
									{foreach from=$oData.toCategorieRc item=toCategorieRc }
                                    <li>
                                        <a categorieid="{$toCategorieRc.categorieRc_id}" href="{$zBasePath}accueil/communique/{$toCategorieRc.categorieRc_id}" class="SelectCompte" style="cursor:pointer" aria-expanded="true">{$toCategorieRc.categorieRc_libelle}</a>
                                    </li>
                                   {/foreach}
									<li>
										<a categorieId="0" href="{$zBasePath}accueil/communique" class="SelectCompte" style="cursor:pointer" aria-expanded="true">Tous</a>
									</li>
                                </ul>
                            </li>
                            <li class="pull-right">
                                <span class="list-style-buttons">
                                    <a href="#" id="gridview" class="switcher active"><i class="la la-th-large" ></i></a>
                                    <a href="#" id="listview" class="switcher"><i class="la la-th-list" ></i></a>
                                </span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="contenuePage">

					{assign var=iTest value="0"}
					{foreach from=$oData.toListe item=toListe }
						{if $toListe.revueCommunique_urgent==1}
						{assign var=iTest value="1"}
						{/if}
					{/foreach}  
					{if $iTest==1}
                    <div class="slider">
                        <ul id="slideCom">
                            {assign var=iIncrement value="0"}
							{if sizeof($oData.toListe)>0}
							{foreach from=$oData.toListe item=toListe }
							{if $toListe.revueCommunique_urgent ==1}
							<li >
                                <a style="cursor:pointer;text-decoration:none" target="_blank"  href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
                                    {if $toListe.revueCommunique_image!=''}
									<img width="290" height="86" src="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_image}" alt="caption">
									{else}
									<span class="slidePict">
                                               <img src="{$zBasePath}assets/common/img/icons/{$toListe.categorieRc_photoBg}" alt=""/> {$toListe.categorieRc_libelle}
                                    </span>
									{/if}
                                    <div class="captionSlide">
                                        <div class="contentMfb" >
                                                <span class="title">
                                                    {$toListe.revueCommunique_titre}
                                                </span>
                                            <span ><br>Catégorie : {$toListe.categorieRc_libelle}</span>
                                            <span class="date">Publié le {$toListe.revueCommunique_date|date_format|utf8}</span>
                                            <p class="descCommunique">{$toListe.revueCommunique_descCourt}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            {assign var=iIncrement value=$iIncrement+1}
							{/if} 
							{/foreach}
							{/if}   
                        </ul>
                    </div>
					{/if}
                    <div id="liste-Comm">
                        <ul id="products" class="grid">
                            {assign var=iIncrement value="0"}
							{if sizeof($oData.toListe)>0}
							{foreach from=$oData.toListe item=toListe }
							{if $toListe.revueCommunique_urgent!=1}
									<li class="clearfix">
										<div class="margecomm">
											{if $toListe.photo!=''}
											<div class="photo photoLab"  style="background: url('{$toListe.photo}') no-repeat;background-position: center;">
												<a style="background:none!important;cursor:pointer;text-decoration:none" target="_blank" href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
												</a>
											</div>
											{else}
											 <div class="photo" style="background: url('img/no-photo.jpg') top center no-repeat;">
											<a style="cursor:pointer;text-decoration:none" target="_blank"  href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
												<img src="{$zBasePath}assets/common/img/icons/{$toListe.categorieRc_photoBg}" alt=""/> {$toListe.categorieRc_libelle}
											</a>
										</div>
											{/if}
											<div class="contentMfb">
														<span class="title">
															
															<a title="{$toListe.revueCommunique_titre}" alt="{$toListe.revueCommunique_titre}" style="cursor:pointer;text-decoration:none" {if $toListe.revueCommunique_type==1} target="_blank" href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}" {else} href="#" onclick="showVideo('{$toListe.revueCommunique_url}')" {/if}>{$toListe.revueCommunique_titre|truncate:90}</a>
														</span>
												<span class="slide" style="padding-top:5px">Catégorie : {$toListe.categorieRc_libelle}</span>
												<span class="date">Publié le {$toListe.revueCommunique_date|date_format|utf8}</span>
												<p class="descCommunique" title="{$toListe.revueCommunique_descCourt}" alt="{$toListe.revueCommunique_descCourt}">{$toListe.revueCommunique_descCourt}</p>
											</div>
										</div>
									</li>
							{assign var=iIncrement value=$iIncrement+1}
							{/if}
							{/foreach}
							{else}
							<p style="font-size:1.2em;">Aucun enregistrement correspondant</p>
							{/if}        

                        </ul>
                    </div>
                </div>
            </div>
		<div id="calendar"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
    {include_php file=$zFooter}
</div>
<div id="dialog3" title="Dialog Title">
</div>
<div id="dialog6" title="Dialog Title">
</div>
<div id="dialog7" title="Information"></div>
<div id="dialog8" title="Dialog Title"></div>
{literal}
<style>
.ui-dialog-titlebar-close {
    /*visibility: hidden;*/
}

#liste-Comm {
	line-height:18px!important;
}

.descCommunique {
	line-height:18px!important;
}

.myPosition {
    position: absolute;
    top: 100px!important; /* use a length or percentage */
}


</style>
<script>
function showVideo(_zVideo) {
	$("#dialog7").html('<video id="largeVideo" width="100%" webkit-playsinline="true" autoplay="no" loop="yes" data-weborama-videoplayer="true" preload="metadata" controls="true" style="position: center; left: 0px; top: 0px; z-index: 200;"><source type="video/mp4" src="{/literal}{$zBasePath}{literal}assets/' + _zVideo + '"></video>');
	$("#dialog7").dialog("open")
}
$(document).ready(function() {
        $("#dialog7").dialog({
            width: '35%',
            modal: !0,
            autoOpen: !1,
            dialogClass: 'myPosition',
            close: function() {
                document.getElementById("largeVideo").pause()
            }
        })
    }) 
	{/literal}{if sizeof($oData.toChangeLocalite)>0}{literal}

        function sendLocalite(_iType) {
            var iUserId = $("#iUserLocaliteId").val();
            $.ajax({
                url: "{/literal}{$zBasePath}{literal}critere/saveLocaliteService/",
                type: 'Post',
                data: {
                    iUserId: iUserId,
                    iType: _iType
                },
                success: function(data, textStatus, jqXHR) {
                    var iSize = $("#iSize").val();
                    if (iSize > 1) {
                        $("#dialog6").html();
                        $("#dialog6").dialog("close");
                        $(".popUpLocalite").click()
                    } else {
                        $("#dialog6").html();
                        $("#dialog6").dialog("close")
                    }
                    event.preventDefault()
                },
                async: !1
            })
        } {/literal}{/if} {literal}
        $(document).ready(function() {
                    $('.malefaka').click(function() {
                        var idActive = $(this).attr('idActive');
                        $('.malefaka a').removeClass("active");
                        $(this).find('a').addClass("active");
                        $(".all").hide();
                        $("." + idActive).show()
                    })
                    $("#dialog7").dialog({
                        width: '35%',
                        modal: !0,
                        autoOpen: !1,
                        dialogClass: 'myPosition'
                    }); 
					{/literal}{if $oData.iAfficheMFBNC==1}{literal} {/literal}{/if} {literal} {/literal}
					{if sizeof($oData.toChangeLocalite)>0}{literal}
                            $("#dialog6").dialog({
                                autoOpen: !1,
                                width: '75%',
                                closeOnEscape: !1,
                                modal: !0,
                                show: {
                                    effect: "slide",
                                    duration: 1000
                                },
                                hide: {
                                    effect: "drop",
                                    duration: 1000
                                }
                            });
                            $("#dialog6").dialog("option", "buttons", {});
                            $(".popUpLocalite").click(function(event) {
                                $("#dialog6").html();
                                var zTitle = $(this).attr("title");
                                $('#dialog6').dialog('option', 'title', "Confirmation changement localité de service d'un agent");
                                $.ajax({
                                    url: "{/literal}{$zBasePath}{literal}critere/getChangeLocaliteResPers/",
                                    type: 'post',
                                    data: {},
                                    success: function(data, textStatus, jqXHR) {
                                        $("#dialog6").html(data);
                                        $("#dialog6").dialog("open");
                                        event.preventDefault()
                                    },
                                    async: !1
                                })
                            });
                            $(".popUpLocalite").click();
							{/literal}{/if} {literal}
							{/literal}{if $oData.iPopUpId==0}
							{literal}
                                $("#dialog3").dialog({
                                    autoOpen: !1,
                                    width: '75%',
                                    closeOnEscape: !1,
                                    modal: !0,
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
                                            var iTestValid = 1;
                                            var zMessage = "";
                                            var iUserId = $("#iUserId").val();
                                            var zPhone = $("#zPhone").val();
                                            var zEmail = $("#zEmail").val();
                                            var iModeForChange = $('#iModeForChange').val();
                                            var iProvinceId = $('#iOrganisation_1').val();
                                            var iRegionId = $('#iOrganisation_2').val();
                                            var iDistrictId = $('#iOrganisation_3').val();
                                            var iDepartementId = $('#iOrganisation_4').val();
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
                                            if (zPhone == '' || zPhone == 0) {
                                                var iTestValid = 0;
                                                zMessage += "- Veuillez remplir le téléphone\n"
                                            }
                                            if (iTestValid == 1) {
                                                $.ajax({
                                                    url: "{/literal}{$zBasePath}{literal}accueil/saveLocaliteServiceEvaluateur/",
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
                                                        iModeForChange: iModeForChange,
                                                        zPhone: zPhone,
                                                        zEmail: zEmail
                                                    },
                                                    success: function(data, textStatus, jqXHR) {
                                                        $("#dialog3").dialog("close");
                                                        window.location.reload()
                                                    },
                                                    async: !1
                                                })
                                            } else {
                                                alert(zMessage)
                                            }
                                        }
                                    }]
                                });
                                $(".dialog-link-manuel-localite").click(function(event) {
                                    $("#dialog3").html();
                                    var zTitle = $(this).attr("title");
                                    $('#dialog3').dialog('option', 'title', 'Confirmation localité de service');
                                    $('#buttonId').button('option', 'label', 'Valider');
                                    var iUserTarget = $("#iUserId").val();
                                    var iUserId = $("#iUserId").val();
                                    $.ajax({
                                        url: "{/literal}{$zBasePath}{literal}accueil/getInfoChangeManuel/" + iUserId,
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
                                $(".dialog-link-manuel-localite").click();
								{/literal}{/if} {literal} 

           }) 
</script>
{/literal}
</body>
</html>