 
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/home/demo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/home/style10.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/home/style.css" />
    
    
	<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/home/jquery.dlmenu.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/home/megamenu.js"></script>
	<!-- menu moving -->
	<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/home/mobilemenu.js"></script>
    
    <style>
	<!--
		.header_home{
			margin-top: 26px;
		}
		.titre_home{
			font-size: 30px;
		}
	-->
	</style>
	<div class="col-md-12">
	 <!-- fil d'actus -->
    <div id="actus" class="actus">
		<div id="actus-content" class="actus-content">
            <!-- slider -->
            <div id="slider-content" class="slider-content">
                <!-- titre slider -->
                <div id="slider-title" class="slider-title" style="height: 60px;padding-top: 0;">Actualit&eacute;s</div>
                <!-- contenu slider -->
                <?php $this->load->view('templates/slider') ?>
            </div>
        </div>
    </div>

     <!-- bouton rond en bas -->
    <div class="container-accueil">
        <div class="content">
            <ul class="ca-menu">
            
             <li>
                    <a href="<?php echo base_url() ?>menu/change_menu/1">
                        <span class="ca-icon"><i class="la la-cog icon_action valid"></i></span>
                        <div class="ca-content">
                            <h2 class="ca-main">CV</h2>
                            <h3 class="ca-sub">Mon CV</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>menu/change_menu/2">
                        <span class="ca-icon"><i class="la la-cog icon_action valid"></i></span>
                        <div class="ca-content">
                            <h2 class="ca-main">FORMATION</h2>
                            <h3 class="ca-sub">SFAO</h3>
                        </div>
                    </a>
                </li>
                <!-- MENU GCAP=3 ET BIBLIOTHEQUE=4 -->
               <!--  <a href="<//?php echo base_url() ?>menu/change_menu/3">
                <a href="<//?php echo base_url() ?>menu/change_menu/4"> -->
                
                <li>
                    <a href="<?php echo base_url() ?>menu/change_menu/5">
                        <span class="ca-icon"><i class="la la-cog icon_action valid"></i></span>
                        <div class="ca-content">
                            <h2 class="ca-main">SONDAGE</h2>
                            <h3 class="ca-sub">Sondage</h3>
                        </div>
                    </a>
                </li>      
            </ul>
        </div>
    </div>
	</div>
