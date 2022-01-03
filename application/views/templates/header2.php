<!DOCTYPE html> 
<?php
	$version = '?V2';
    $id1 = "";
    $id2 = "";
    $id3 = "";
    $id4 = "";
    $id5 = "";
    $is_admin = false;
    if(isset($_SESSION))
        $user = $_SESSION['user'];
    
    $exist_cv = false; 
    if($user['exist_cv']==true){
        $exist_cv = true; 
    } 
    if($user['role'] == 'admin')
        $is_admin = true;
                   
    if(isset($menu))
        switch ($menu){
            case 1 : 
                   $id1 = 'id="current"';
                   break; 
            case 2 : 
                   $id2 = 'id="current"';
                   break; 
            case 3 : 
                   $id3 = 'id="current"';
                   break; 
            case 4 : 
                   $id4 = 'id="current"';
                   break;
            case 5 : 
                   $id5 = 'id="current"';
                   break;
        }
?>
<html>
<head>
	<title>ROHI</title>
	<link href="<?php echo base_url();?>assets/css2/style.css" rel="stylesheet" type="text/css" media="all" />
	<!--fonts-->
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		
	<!--//fonts-->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min-3.0.0.css<?php echo $version;?>">
		<link href="css2/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Revenant Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->
	<!-- js -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/enquete/jquery.min.js"></script>
	<!-- js -->
	<!-- start-smooth-scrolling -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/enquete/move-top.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/enquete/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
	<!-- start-smooth-scrolling -->

</head>
<body>
<!-- header -->
<div class="header">
<div class="col-lg-12">
<div class="col-lg-2" align="center">
<br/><br/><br/>
<img src="<?php echo base_url();?>assets/images2/logo_MFB.png" width="100px" height="100px" alt=""/><br/><br/>
</div>
<div class="col-lg-8" align="center">
	<div class="container">
		<!--<h1><a href="index.html">RO<span>HI</span></a></h1>
		
		<h1><img src="<?php echo base_url();?>assets/img/rohi.png" width="200px" height="100px" alt=""/></h1>-->
		
		
	</div>
	</div>
	<div class="col-lg-2" align="center">
	<br/><br/><br/>
<img src="<?php echo base_url();?>assets/images2/logo_DRHA.png" width="100px" height="100px" alt=""/><br/><br/>
</div>
</div>
<!-- //logo -->
<!-- navigation -->
<div class="navigation">
	<div class="container">
		<span class="menu">MENU</span>
			<ul class="nav1">
			<b>
<br/>
				 <li><a href="<?php echo base_url();?>">ACCUEIL </a></li>
				<li><a class="scroll" href="#testimonial">SGRH <img src="images2/25.png" alt=""/></a></li>
				<li><a class="scroll" href="#news">SAD <img src="images2/25.png" alt=""/></a></li>
				<li><a class="scroll" href="#portfolio">SAU <img src="images2/25.png" alt=""/></a></li> 
				<li><a href="contact.html">SFAO <img src="images2/25.png" alt=""/></a></li></b>
				<li <?php echo $id1;?>>
								<a><button class="btn btn-primary" data-original-title="D&eacute;connexion" data-toggle="tooltip" data-placement="bottom"  style="font-size: 1.1em; font-weight: bold;arial: cursive" id="decon">D&eacute;connexion</button></a>
								</li>
			</ul>
				<!-- script for menu -->
					<script> 
						$( "span.menu" ).click(function() {
						$( "ul.nav1" ).slideToggle( 300, function() {
						 // Animation complete.
						});
						});
					</script>
				<!-- //script for menu -->
	</div>
</div>
</div>
<script>
$(document).ready(function() {
	$("#decon").click (function(){
		document.location.href = "<?php echo base_url();?>user/deconnexion";
	})
})
</script>
	<script type="text/javascript">
		$(document).ready(function() {
			
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
