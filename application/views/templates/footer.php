</div>
<div id="calendar"></div>
</div>
</section>
<style>
#agendaPopUp td {
	width:40%!important;
	padding-top:20px;
	font-size:0.8em;
	border-bottom:none!important;
	border:1!important;
	color:white!important;
}

#agendaPopUp tr {
	height:50px!important;
	font-size:1.2em;
}
</style>
<footer id="mainFooter">
	<div id="mainFooterTop">
		<p class="logo"><img class="dialog-link" src="<?php echo base_url();?>assets/gcap/images/def1.jpg" alt=""></p>
	</div>
	<div id="mainFooterBottom">
		<p>&copy; 2015 - Minist&egrave;re de l'économie et des finances</p>    
	</div>
</footer>

<script>
	$(document).ready (function ()
	{
		$('.notification').find('.button').find('a').click(
				function () {
					$('.notification').removeClass('visible');
					return false;
				}
			);
		 $('.notification').addClass('visible');
    });
</script>
<?php if (isset($iNotification) && $iNotification == 1) { ?>
<div class="notification" >
	<p class="titre" >
	<span style="texte-decoration: blink;color:#FF0000; ">NOTIFICATION EVALUATION</span><br/><br/></p>
	<p class="notif">Vous n'êtes pas encore dans la liste des </p>
	<p class="notif">agents évalués. Veuillez contacter votre </p>
	<p class="notif">supérieur hiérarchique. Merci!</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
<?php } ?> 
<?php if (isset($iNotification) && $iNotification == 2) { ?>
<div class="notification">
	<p class="titre" style="texte-decoration: blink;">
	<span style="texte-decoration: blink;color:#FF0000; ">NOTIFICATION EVALUATEUR</span><br/><br/></p>
	<p class="notif">Vous n'avez pas encore évalué vos agents</p>
	<p class="notif"> au cours du trimestre passé! Merci de</p>
	<p class="notif"> procéder à cette évaluation.</p>
	<p class="notif">Pour plus d'informations contacter le </p>
	<p class="notif"> <a href="mailto:cellcomm.drha@gmail.com">cellcomm.drha@gmail.com</a></p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
<?php } ?> 
<?php if (isset($iNotification) && $iNotification == 3) { ?>
<div class="notification">
	<p class="titre">
	<span style="color:#FF0000; ">NOTIFICATION NOUVELLE CARTE ROHI<br/><br/><br/></span></p>
	<p class="notif">Votre carte ROHI est disponible.</p>
	<p class="notif">Veuillez vous adresser au responsable</p>
	<p class="notif">Porte 15 MFB Antaninarenina. Merci!</p>
	<p class="notif">&nbsp;</p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
<?php } ?> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/li-scroller.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/gcap/js/app/jquery.li-scroller.1.0.js"></script>
<!-- ui-dialog -->
	
<script>
$(document).ready (function ()
{
	$("ul#ticker01").show();
	$("ul#ticker01").liScroll();
	/*$("ul#ticker02").liScroll({travelocity: 0.15});*/
})
</script>