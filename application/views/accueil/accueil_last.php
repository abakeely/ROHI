<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/turbotabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/jquery.notify.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/animate.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/accueil.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sau/css/fullcalendar.min.css" />

<script src="<?php echo base_url();?>assets/gcap/js/app/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>assets/gcap/js/app/turbotabs.min.js"></script>
<script src="<?php echo base_url();?>assets/gcap/js/app/preview.min.js"></script>
<script src="<?php echo base_url();?>assets/gcap/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/pointage/js/vendor/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/pointage/js/vendor/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.js<?php echo $version;?>"></script>
<script src="<?php echo base_url();?>assets/js/formValidation.min.js<?php echo $version;?>"></script>
<script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js<?php echo $version;?>"></script>
<script src="<?php echo base_url();?>assets/js/popUpFormation.js<?php echo $version;?>"></script>
<script src="<?php echo base_url();?>assets/gcap/js/jquery.notify.min.js"></script>
<div class="" style="width:72%;display:inline-block;vertical-align:top">
	<div id="communiquerPresse">
		<a href="#" id="demo-warning">Warning notification</a>
		<ul class="tabs" >
			<li class="tab-link current" iModeId="1" data-tab="tab-1">Communiqué</li>
			<li class="tab-link" iModeId="2" data-tab="tab-2">Revue de presse</li>
		</ul>

		<div id="tab-1" class="tab-content current">
			<?php echo $zData ; ?>
		</div>
		<div id="tab-2" class="tab-content">
			<?php echo $zDataRevue ; ?>
		</div>
	</div>
	<div id="calendar"></div>
</div>
		
<div id="contentNotification" style="display:none">
<div id="ajax" style="max-width:700px;">
	<h2>Lorem ipsum dolor sit amet3</h2>
	
	<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum ante et sapien dignissim in viverra magna feugiat. Donec tempus ipsum nec neque dignissim quis eleifend eros gravida. Praesent nisi massa, sodales quis tincidunt ac, semper quis risus. In suscipit nisl sed leo aliquet consequat. Integer vitae augue in risus porttitor pellentesque eu eget odio. Fusce ut sagittis quam. Morbi aliquam interdum blandit. Integer pharetra tempor velit, aliquam dictum justo tempus sed. Morbi congue fringilla justo a feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis metus et nisl consectetur pharetra. Nam bibendum turpis eu metus luctus eu volutpat sem molestie. Nam sollicitudin porttitor lorem, ac ultricies est venenatis eu. Ut dignissim elit et orci feugiat ac placerat purus euismod. Ut mi lorem, cursus et sagittis elementum, luctus ac massa.
	</br></br>
	<a href="http://rohi.mef.gov.mg:8088/ROHI/documentation/sad" target="_blank"> SAD </a></br></br>
	<a href="http://rohi.mef.gov.mg:8088/ROHI/formation/accueil_sfao" target="_blank"> SFAO</a>
	</p>
</div>
</div>
<script>
$(document).ready (function ()
{
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');
		var iModeId = $(this).attr('iModeId');
		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');
		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

	$('#communiquerPresse').show();
	$('#calendar').hide();
	$('.showCommuniquer').hide();

	$('.showCommuniquer').on('click', function(){
		$('#communiquerPresse').show();
		$('#calendar').hide();
		$('.showCommuniquer').hide();
		$('.showCalendar').show();

	}); 

	$('.showCalendar').on('click', function(){
		$('#communiquerPresse').hide();
		$('#calendar').show();
		$('.showCommuniquer').show();
		$('.showCalendar').hide();
	}); 


	var zContent = $("#ajax").html() ; 
	var zCalendrier = $("#calendar").html();
	$('#demo-warning').on('click', function(){
		notify({
			type: "warning", //alert | success | error | warning | info
			title: " <img src='<?php echo base_url();?>assets/gcap/images/enveloppes_3.png' width='50' /> Notification",
			theme: "dark-theme",
			overlay: true,
			size: "full", //normal | full | small
			 position: {
				x: "center", //right | left | center
				y: "center" //top | bottom | center
			},
			icon: '',
			message: zContent
		});
	});

	$('.AddEvent').on('click', function(){
		notify({
			type: "warning", //alert | success | error | warning | info
			title: " <img src='<?php echo base_url();?>assets/gcap/images/enveloppes_3.png' width='50' /> Notification",
			theme: "dark-theme",
			overlay: true,
			size: "full", //normal | full | small
			 position: {
				x: "center", //right | left | center
				y: "center" //top | bottom | center
			},
			icon: '',
			message: zContent
		});
	}); 

})
</script>
