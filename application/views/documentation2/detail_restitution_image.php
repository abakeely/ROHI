<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sad/restitution/style.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/sad/restitution/jquery.js"></script>
<body style="background-color:#d7d7d7;margin:auto">
<div class="row" >
<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
<div align="right">
	<a href="<?php echo base_url();?>documentation/restitution/2017" class="btn btn-success">RETOUR</a>
</div>
	
<div id="wowslider-container1">
	<div class="ws_images">
		<ul>
			<?php $i=0;foreach($list_image as $img){?>
			<li><img src="<?php echo base_url('assets/img/restitution/image/'.$img);?>" alt="" title="" id="wows1_<?php echo $i;?>"/></li>	
			<?php $i++;}?>			
		</ul>
	</div>
	
	<div class="ws_script" style="position:absolute;left:-99%"></div>
	<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="<?php echo base_url();?>assets/sad/restitution/wowslider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/sad/restitution/script.js"></script>
	<!-- End WOWSlider.com BODY section -->