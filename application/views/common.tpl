{include file=$zCssJs}
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
    {include_php file=$zHeader}
    <section id="content">
        {include_php file=$zLeft}
        <div id="innerContent">
            <div id="ContentBloc" class="dialog-link-manuel-localite11____">
                <input type="hidden" name="iUserId" id="iUserId" value="{$oData.iUserId}">
                <h2>
                    Evaluations
                </h2>
                <div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a style="text-decoration:none;" href="{$zBasePath}">Accueil</a> <span>&gt;</span> Evaluations</div>

                <div class="SSttlPage">
                    {block name='commonContent'}{/block}
                </div>
            </div>
            <div id="calendar____"></div>
            <div class="dialog-link-manuel-localite22"></div>
    </section>

    <section id="rightContent" class="clearfix">
        {include file=$zRight}
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
            /*visibility: hidden!important;*/
        }

        .ui-dialog {
            top: 15% !important;
        }

        #liste-Comm {
            line-height:18px!important;
        }

        .ui-dialog-titlebar-close {
            display:none!important;
        }

        .ui-widget-overlay.custom-overlay
        {
            background-color: grey!important;
            background-image: none!important;
            opacity: 1!important;
        }

        /*.ui-widget-header {
            background: #50aaec !important
        }

        .saveButtonClass {
            background: #50aaec !important
        }*/

        .descCommunique {
            line-height:18px!important;
        }

        .myPosition {
            position: absolute;
            top: 100px!important; /* use a length or percentage */
        }

        form .row {
            padding: 0 0 10px!important;
        }

    </style>
<script>
    function showVideo(_zVideo) {
        $("#dialog7").html('<video id="largeVideo" width="100%" webkit-playsinline="true" autoplay="no" loop="yes" data-weborama-videoplayer="true" preload="metadata" controls="true" style="position: center; left: 0px; top: 0px; z-index: 200;"><source type="video/mp4" src="{/literal}{$zBasePath}{literal}assets/' + _zVideo + '"></video>');
        $("#dialog7").dialog("open")
    }
    function getExtension(chemin) {
        var regex = /[^.]*$/i;
        var resultats = chemin.match(regex);
        return resultats[0]
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
            console.log(idActive);
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
        {/literal}{if $oData.iPopUpId==0 && sizeof($oData.oCandidat)>0}
        {literal}
        $("#dialog3").dialog({
            autoOpen: !1,
            width: '70%',
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

                    var iRattachement = $('select[name="iRattachement[]"]').map(function(){
                        return this.value;
                    }).get();

                    var zPhoto = $('#photo').val();
                    var testPhoto = $('#testPhoto').val();

                    if (zPhoto == '' && testPhoto == '') {
                        var iTestValid = 0;
                        zMessage += "- Veuillez sélectionner votre photo\n"
                    } else {
                        if (zPhoto != '' ) {
                            var ext = getExtension(zPhoto).toLowerCase();
                            if (ext == "png" || ext == "gif" || ext == "jpg" || ext == "jpeg") {} else {
                                var iTestValid = 0;
                                zMessage += "Veuillez entrer le fichier ayant des extensions .jpeg/.jpg/.png/.gif.";
                                $('#userLeftPhoto').val("")
                            }
                        }
                    }

                    if (iTestValid == 1) {
                        $("#buttonId").attr("disabled", true);
                        $("#photoMAJ").submit();
                        $(this).dialog("close");

                    } else {
                        alert(zMessage)
                    }
                }
            }]
        });
        $(".dialog-link-manuel-localite11").click(function(event) {
            $("#dialog3").html();
            $('#dialog3').dialog('option', 'title', 'MISE A JOUR PHOTO DE PROFIL ET LOCALITE DE SERVICE POUR LE NOUVEAU BADGE');
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
        //$(".dialog-link-manuel-localite11").click();
        {/literal}{/if} {literal}

    })
</script>
{/literal}
{block name='js'}
    <script>
        window.ua = {$account};
    </script>
    <script src="{base_url('/application/modules/evaluations/assets/js/dist/bundle.js')}?_={$utils::encrypt($smarty.now)}"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/jquery-1.12.4.min.js"></script>
    <script>
        var $ = jQuery = jQuery.noConflict();
    </script>
    <!--script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-1.11.3.min.js"></script-->
    <script type="text/javascript" src="{$zBasePath}assets/common/js/pageloader.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/getorgchart.js"></script>

    <script type="text/javascript" src="{$zBasePath}assets/common/js/aria-tooltip.js?{$zClearCache}"></script>

    <script src="{$zBasePath}assets/common/js/jquery.ferro.ferroMenu-1.2.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js?{$zClearCache}"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/app/main_save.js?{$zClearCache}"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/app/select2.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{$zBasePath}assets/common/js/dataTables.bootstrap.js"></script>
    <script src="{$zBasePath}assets/common/js/bootstrap.min.js"></script>
    <script src="{$zBasePath}assets/common/js/jquery.alerts.js"></script>
    <script type="text/javascript">
        {literal}
        $(document).ready(function() {
            $.pageLoader();
            var zBasePathTheme = "{/literal}{$zBasePath}{literal}assets/common/" ;
            $("li .active").parents('li').addClass('active1');
            var zBasePath = "{/literal}{$zBasePath}{literal}";
        });
        {/literal}
    </script>
    <script src="{$zBasePath}assets/common/js/site.js?{$zClearCache}" type="text/javascript"></script>

    {*$dbg->render()*}

{/block}
</body>
</html>