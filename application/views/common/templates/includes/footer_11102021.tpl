<!-- jQuery -->
<script src="{$zBasePath}assets/light/assets/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="{$zBasePath}assets/light/assets/js/popper.min.js"></script>
<script src="{$zBasePath}assets/light/assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="{$zBasePath}assets/light/assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<script src="{$zBasePath}assets/light/assets/js/select2.min.js"></script>

<!-- Datatable JS -->
<script src="{$zBasePath}assets/light/assets/js/jquery.dataTables.min.js"></script>
<script src="{$zBasePath}assets/light/assets/js/dataTables.bootstrap4.min.js"></script>

<!-- Datetimepicker JS -->
<script src="{$zBasePath}assets/light/assets/js/moment.min.js"></script>
<script src="{$zBasePath}assets/light/assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Custom JS -->
<script src="{$zBasePath}assets/light/assets/js/app.js"></script>
<div id="dialog88" title="Dialog Title"></div>
{literal} 
<style>
@media only screen and (max-width: 775px){
	.stickymenu {
		display:none!important;
	}
}

{/literal}{if $bPhoto==0}{literal}
.ui-widget-overlay.custom-overlay
{
    background-color: grey!important;
    background-image: none!important;
    opacity: 1!important;
}

.myPosition {
    position: absolute;
    top: 100px!important; /* use a length or percentage */
}


.ui-dialog-titlebar-close{
	/*display:none;*/
}
{/literal}{/if} {literal}
</style>
<script>

$(document).ready (function ()
{
	
	$("#dialog88").dialog({
		autoOpen: false,
		width: '60%',
		title: 'Fiche de poste',
		close: 'X',
		show: 'blind',
		modal: true,
		buttons: [{
			text: "Fermer",
			click: function() {
				$(this).dialog("close");
				$( '.bouton16' ).blur(); 
			}
		}]
	}); 

	$( ".dialog-link-fdp1" ).click(function( event ) {
		$('.bouton16').blur(); 
		var iSearchFicheDePoste = $(this).attr("iSearchFicheDePoste");

		if(iSearchFicheDePoste != ''){
			var iUserId = $(this).attr("iAgentId");
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}accueil/getInfoUser/" + iUserId ,
				type: 'get',
				data: { 
				},
				success: function(data, textStatus, jqXHR) {
					
					$("#dialog88").html(data);	
					$( "#dialog88" ).dialog( "open" );
					$('html, body').animate({
						scrollTop: 0
					}, 750);
					$('.bouton16').blur(); 
					event.preventDefault();
				},
				async: false
			});
		}
	});
	
	/*$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">Actuellement, tous les agents du MEF (ECD, ELD, EFA,Fonctionnaire) peuvent consulter leur fiche de paie sur ROHI</font></font></font></marquee>');*/
	//$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">Chers collègues, afin de bénéficier de tous les services auprès du CMS, merci de déposer vos dossiers à la porte 41 du Ministère de l\'Economie et des Finances Antaninarenina</font></font></font></marquee>');
	/*$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">Contribution à la promotion de l\'éthique dans l\'Administration Publique: cas du Ministère de l\'Economie et des Finances présentée par Monsieur RAVELONANOSY Hoely Nambinina (Expert en Administration Publique) le Mercredi 18 Novembre 2020 à 10h à la Porte 303-Immeuble des Finances Antaninarenina</font></font></font></marquee>');*/

})

{/literal}{if $iAfficheMFBMM==1}{literal}
$(document).ready (function ()
{
	/*$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">MFB-NC Miara Misôma 2e édition se tiendra le 19,20 et 21 Septembre 2018... Pour plus d\'informations veuillez consulter la page facebook "ASCAL MFB".</font></font></font></marquee>');*/

	function getExtension(chemin) {
	var regex = /[^.]*$/i;
	var resultats = chemin.match(regex);
	return resultats[0]
}
$(document).ready (function ()
{
	{/literal}{if $bPhoto==-100}{literal}
		$("#dialog88").dialog({
		autoOpen: true,
		width: '60%',
		closeOnEscape: true,
		dialogClass: "noclose",
		dialogClass: 'myPosition',
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
					zMessage += "- Veuillez insérer votre photo d'identité\n"
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
					zMessage += "- Veuillez remplir le numéro de telephone\n";
				}
				if (iTestValid == 1) {
					$("#photoMAJ").submit()
				} else {
					alert(zMessage)
				}
			}
		}]
	});
	$(".dialog-link-manuel-localite89").click(function(event) {
		$("#dialog88").html();
		$('#dialog88').dialog('option', 'title', 'Afin de beneficier à l\'accès ROHI,Merci de mettre à jour votre photo et coordonnées');
		$('#buttonId').button('option', 'label', 'Valider');
		var iUserTarget = {/literal}{$oCand[0]->user_id}{literal};
		var iUserId = {/literal}{$oCand[0]->user_id}{literal};
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}avis/getTemplatePhoto/" + iUserId,
			type: 'post',
			data: {
				iUserTarget: iUserTarget,
				iRedirect: 1
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog88").html(data);
				$("#dialog88").dialog("open");
				event.preventDefault()
			},
			async: true
		})
	});
	$(".dialog-link-manuel-localite89").click(); 
	{/literal}{/if} {literal}
})
})
{/literal}{/if}{literal}
</script>

{/literal}
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/li-scroller.css">
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/jquery.li-scroller.1.0.js"></script>
<footer id="mainFooter">
	<div id="mainFooterTop">
		 <div class="cubespinner">                 
			<div class="face1"><img src="{$zBasePath}assets/img/logo.png" alt="" width="60" height="60" style="vertical-align:middle"></div>                 
			<div class="face2"><img src="{$zBasePath}assets/gcap/images/drha.png" width="60" height="60" alt="" style="vertical-align:top"></div>                 
			<div class="face3"><img src="{$zBasePath}assets/img/logo.png" alt="" width="60" height="60" style="vertical-align:middle"></div>                 
			<div class="face4"><img src="{$zBasePath}assets/gcap/images/drha.png" width="60" height="60" alt="" style="vertical-align:top"></div>                 
			<div class="face5"><img src="{$zBasePath}assets/img/logo.png" alt="" width="60" height="60" style="vertical-align:middle"></div>                 
			<div class="face6"><img src="{$zBasePath}assets/gcap/images/drha.png" width="60" height="60" alt="" style="vertical-align:top"></div>             
		</div>
	</div>
	<div class="dialog-link-manuel-localite89"></div>
	<div id="mainFooterBottom">
		<p>Ministère de l'Economie et des Finances</p>
	</div>
</footer>
{if $iModuleActif == 2}
{if $iSessionCompte == COMPTE_AGENT}
{if !empty($iNotification) && !empty($iNotificationAffiche) && $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">NOTIFICATION</p>
	<p class="notif">Vous avez {$iNotification} valid&eacute;{if $iNotification>1}s{/if} : </p>
	{if $iNotificationDecision > 0}<p class="notif">- {$iNotificationDecision} d&eacute;cision{if $iNotificationDecision>1}s{/if}</p>{/if}
	{if $iNotificationConge > 0}<p class="notif">- {$iNotificationConge} Cong&eacute;{if $iNotificationConge>1}s{/if}</p>{/if}
	{if $iNotificationAbscence > 0}<p class="notif">- {$iNotificationAbscence} Autorisation{if $iNotificationAbscence>1}s{/if} d'abscence</p>{/if}
	{if $iNotificationPermission> 0}<p class="notif">- {$iNotificationPermission} Permission{if $iNotificationPermission>1}s{/if}</p>{/if}
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
{else}
{if !empty($iNotification) && !empty($iNotificationAffiche) && $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">
	<span>
		NOTIFICATION
	</span>
	</p>
	<p class="notif">Vous avez {$iNotification} demande{if $iNotification>1}s{/if} &agrave; valider : </p>
	{if $iNotificationDecision > 0}<p class="notif">- {$iNotificationDecision} d&eacute;cision{if $iNotificationDecision>1}s{/if}</p>{/if}
	{if $iNotificationConge > 0}<p class="notif">- {$iNotificationConge} Cong&eacute;{if $iNotificationConge>1}s{/if}</p>{/if}
	{if $iNotificationAbscence > 0}<p class="notif">- {$iNotificationAbscence} Autorisation{if $iNotificationAbscence>1}s{/if} d'abscence</p>{/if}
	{if $iNotificationPermission> 0}<p class="notif">- {$iNotificationPermission} Permission{if $iNotificationPermission>1}s{/if}</p>{/if}
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
{/if}
{/if}

{if !empty($iNotificationCarte) && $iNotificationCarte > 0}
<div class="notification">
	<p class="titre">
		<span>
			NOTIFICATION NOUVELLE CARTE ROHI
		</span>
	</p>
	<p class="notif">Votre carte ROHI est disponible.</p>
	<p class="notif">Veuillez vous adresser au responsable</p>
	<p class="notif">Porte 15 MFB Antaninarenina. Merci!</p>
	<p class="notif">&nbsp;</p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
{*
{if sizeof($toReclassement) > 0}
<div class="notification" >
	<p class="titre">
	<span>
	Reclassement (Circuit et Suivi)
	</span>
	</p>
	<p class="notif">{$toReclassement.0.suivi_libelle}</p>
	<p class="notif">Date : {$toReclassement.0.suivi_libelle|date_format:"%d/%m/%Y"}</p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
*}
{$zSticky}
{literal}
<script>
var colour = "random", // or "#000000"
    sparkles = 50,
    x = 400,
    ox = 400,
    y = 300,
    oy = 300,
    swide = 800,
    shigh = 600,
    sleft = 0,
    sdown = 0,
    tiny = [],
    star = [],
    starv = [],
    starx = [],
    stary = [],
    tinyx = [],
    tinyy = [],
    tinyv = [];

function sparkle() {
    var c;
    if (Math.abs(x - ox) > 1 || Math.abs(y - oy) > 1) {
        ox = x;
        oy = y;
        for (c = 0; c < sparkles; c++) if (!starv[c]) {
            star[c].style.left = (starx[c] = x) + "px";
            star[c].style.top = (stary[c] = y + 1) + "px";
            star[c].style.clip = "rect(0px, 5px, 5px, 0px)";
            star[c].childNodes[0].style.backgroundColor = star[c].childNodes[1].style.backgroundColor = (colour == "random") ? newColour() : colour;
            star[c].style.visibility = "visible";
            starv[c] = 50;
            break;
        }
    }
    for (c = 0; c < sparkles; c++) {
        if (starv[c]) update_star(c);
        if (tinyv[c]) update_tiny(c);
    }
    setTimeout(sparkle, 40);
}

function update_star(i) {
    if (--starv[i] == 25) star[i].style.clip = "rect(1px, 4px, 4px, 1px)";
    if (starv[i]) {
        stary[i] += 1 + Math.random() * 3;
        starx[i] += (i % 5 - 2) / 5;
        if (stary[i] < shigh + sdown) {
            star[i].style.top = stary[i] + "px";
            star[i].style.left = starx[i] + "px";
        } else {
            star[i].style.visibility = "hidden";
            starv[i] = 0;
            return;
        }
    } else {
        tinyv[i] = 50;
        tiny[i].style.top = (tinyy[i] = stary[i]) + "px";
        tiny[i].style.left = (tinyx[i] = starx[i]) + "px";
        tiny[i].style.width = "2px";
        tiny[i].style.height = "2px";
        tiny[i].style.backgroundColor = star[i].childNodes[0].style.backgroundColor;
        star[i].style.visibility = "hidden";
        tiny[i].style.visibility = "visible";
    }
}

function update_tiny(i) {
    if (--tinyv[i] == 25) {
        tiny[i].style.width = "1px";
        tiny[i].style.height = "1px";
    }
    if (tinyv[i]) {
        tinyy[i] += 1 + Math.random() * 3;
        tinyx[i] += (i % 5 - 2) / 5;
        if (tinyy[i] < shigh + sdown) {
            tiny[i].style.top = tinyy[i] + "px";
            tiny[i].style.left = tinyx[i] + "px";
        } else {
            tiny[i].style.visibility = "hidden";
            tinyv[i] = 0;
            return;
        }
    } else tiny[i].style.visibility = "hidden";
}

function mouse(e) {
    if (e) {
        y = e.pageY;
        x = e.pageX;
    } else {
        set_scroll();
        y = event.y + sdown;
        x = event.x + sleft;
    }
}

function set_scroll() {
    if (typeof (self.pageYOffset) == 'number') {
        sdown = self.pageYOffset;
        sleft = self.pageXOffset;
    } else if (document.body && (document.body.scrollTop || document.body.scrollLeft)) {
        sdown = document.body.scrollTop;
        sleft = document.body.scrollLeft;
    } else if (document.documentElement && (document.documentElement.scrollTop || document.documentElement.scrollLeft)) {
        sleft = document.documentElement.scrollLeft;
        sdown = document.documentElement.scrollTop;
    } else {
        sdown = 0;
        sleft = 0;
    }
}

function set_width() {
    var sw_min = 999999;
    var sh_min = 999999;
    if (document.documentElement && document.documentElement.clientWidth) {
        if (document.documentElement.clientWidth > 0) sw_min = document.documentElement.clientWidth;
        if (document.documentElement.clientHeight > 0) sh_min = document.documentElement.clientHeight;
    }
    if (typeof (self.innerWidth) == 'number' && self.innerWidth) {
        if (self.innerWidth > 0 && self.innerWidth < sw_min) sw_min = self.innerWidth;
        if (self.innerHeight > 0 && self.innerHeight < sh_min) sh_min = self.innerHeight;
    }
    if (document.body.clientWidth) {
        if (document.body.clientWidth > 0 && document.body.clientWidth < sw_min) sw_min = document.body.clientWidth;
        if (document.body.clientHeight > 0 && document.body.clientHeight < sh_min) sh_min = document.body.clientHeight;
    }
    if (sw_min == 999999 || sh_min == 999999) {
        sw_min = 800;
        sh_min = 600;
    }
    swide = sw_min;
    shigh = sh_min;
}

function createDiv(height, width) {
    var div = document.createElement("div");
    div.style.position = "absolute";
    div.style.height = height + "px";
    div.style.width = width + "px";
    div.style.overflow = "hidden";
    return div;
}

function newColour() {
    var c = [];
    c[0] = 255;
    c[1] = Math.floor(Math.random() * 256);
    c[2] = Math.floor(Math.random() * (256 - c[1] / 2));
    c.sort(function () {
        return (0.5 - Math.random());
    });
    return ("rgb(" + c[0] + ", " + c[1] + ", " + c[2] + ")");
}

$(document).mousemove(mouse);
$(window).resize(set_width);
$(window).scroll(set_scroll);
$(document).ready(function () {
    if (document.getElementById) {
        var i, rats, rlef, rdow;
        for (i = 0; i < sparkles; i++) {
            rats = createDiv(3, 3);
            rats.style.visibility = "hidden";
            rats.style.zIndex = "999";
            $("body").append(tiny[i] = rats);
            starv[i] = 0;
            tinyv[i] = 0;
            rats = createDiv(5, 5);
            rats.style.backgroundColor = "transparent";
            rats.style.visibility = "hidden";
            rats.style.zIndex = "999";
            rlef = createDiv(1, 5);
            rdow = createDiv(5, 1);
            $(rats).append(rlef);
            $(rats).append(rdow);
            rlef.style.top = "2px";
            rlef.style.left = "0px";
            rdow.style.top = "0px";
            rdow.style.left = "2px";
            $("body").append(star[i] = rats);
        }
        set_width();
        sparkle();
    }
});
</script>
{/literal}

<!--NOUVEAU MENU -->