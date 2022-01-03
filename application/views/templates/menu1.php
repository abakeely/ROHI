
<!-- Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- menu 3D -->
<link href="<?php echo base_url() ?>/assets/style/menu3DstyleCl.css" rel="stylesheet" type="text/css" media="all" />

<!----font-Awesome----->
<script src="<?php echo base_url() ?>/assets/portfolio/js/menu.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/fliplightbox.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/portfolio/css/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.fancybox-1.2.1.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.mixitup.min.js"></script>

<!-- start light_box --><!----font-Awesome----->
<!-- start plugins -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/portfolio/css/jquery.fancybox.css" media="screen" />


<!-- ajouter au panier 1-->
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/style/addtochartclient.css"/>
<!-- ajouter au panier 2-->
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/style/addtochart2.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/addtochart2.js"></script>

<!--panier-->
<link href="<?php echo base_url() ?>/assets/style/cart.css" rel='stylesheet' type='text/css' />


<style>
<?php for($i = 1; $i <= 30; $i ++){
        echo '.menu li:hover .submenu li:nth-child('.$i.') {;
        -webkit-transition-delay:', (($i-1)*50) ,'ms;
                -moz-transition-delay: ', ($i-1)*50 ,'ms;
                -ms-transition-delay: ', ($i-1)*50 ,'ms;
                -o-transition-delay: ', ($i-1)*50 ,'ms;
                transition-delay: ', ($i-1)*50 ,'ms;
            };
            .submenu li:nth-child('.$i.') {;
                -webkit-transition-delay: ' ,($limax-$i)*50 ,'ms;
                -moz-transition-delay: ' ,($limax-$i)*50 ,'ms;
                -ms-transition-delay: ' ,($limax-$i)*50 ,'ms;
                -o-transition-delay: ' ,($limax-$i)*50 ,'ms;
                transition-delay: ' ,($limax-$i)*50 ,'ms;
            }';
    } ?>
</style>

<div id="zonemenu">
 <ul class="menu">
	<li class="menu_accueil"> <a href="<?php echo base_url();?>menu/change_menu/0" >Accueil</a></li>
	
	<li class="menu_cv"><a href="<?php echo base_url();?>cv/mon_cv">Mon CV</a></li>
	
	<!-- MENU FORMATION -->
	 <li class="menu_formation"><a>RAPPORTS</a>
	 		<ul class="submenu">
				 <li><a href="<?php echo base_url();?>formation/rapport_locale"><span>Synthetiques</span></a></li>
	             <li><a href="<?php echo base_url();?>formation/rapport_externe"><span>Suivi et evaluation</span></a></li>
	 	   </ul>
	 </li>
	
	<li class="menu_formation"><a>OFFRES</a>
	 		<ul class="submenu">
				 <li><a href="<?php echo base_url();?>formation/offre_interieur"><span>Locales</span></a></li>
            	 <li><a href="<?php echo base_url();?>formation/offre_exterieur"><span>Exterieurs</span></a></li>
	 	   </ul>
	 </li>
	 
	<li class="menu_formation"><a>DEMANDES</a>
	 		<ul class="submenu">
	 			<li><a href="<?php echo base_url();?>formation/demande_formation"><span>formations</span></a></li>
	 			<?php if($role=='chef' || $role=='admin') {?>
	 			 <li><a href="<?php echo base_url();?>formation/list_demande_formation"><span>Liste des Inscrits</span></a></li>
	 			<?php } ?>
	 	   </ul>
	 </li>
	<!-- LE MENU RECENSEMENT EST DESTINE AUX ADMIN ET CHEFS -->
	<?php  if($role=='admin' || $role=='chef'){?> 
	<li class="menu_cv"><a href="#" >RECENSEMENT</a>
	    <ul class="submenu">
			<li><a  href="<?php echo base_url();?>cv/list_cv">Agent du MFB</a</li>
			<li><a  href="<?php echo base_url();?>cv/list_invalide">Agent du MFB &agrave; Valider</a></li>
			<?php if($role=='admin') {?>
			<li><a  href="<?php echo base_url();?>user/list_user_connected">Agent connect&eacute;</a></li>
			<li><a  href="<?php echo base_url();?>user/list_user_no_cv">Compte sans CV</a></li>
			<?php }?>
		</ul>
	 </li>
	  <?php }?>
	  <?php  if($role=='admin' || $role=='chef'){?>
		 <li class="menu_cv"><a href="#" >Statistique</a>
		 	<ul class="submenu">
	  		<li><a  href="<?php echo base_url();?>statistique/statistic_main">Statistique</a></li>
	  		</ul>
	</li>
	 <?php }?>
	 <!-- MENU GCAP -->
	
	
	 <!-- MENU Sondage -->
	 <li class="menu_sondage"><a href="<?php echo base_url();?>enquete/new_enquete">Sondage</a>
     </li>
     <?php if($role=='chef' || $role=='admin') {?>
	 <li class="menu_sondage"><a href="#" >Statistique</a>
		  <ul class="submenu">
	   		<li><a href="enquete/new_enquete"">Par departement</a></li>
			<li><a href="enquete/new_enquete">Par region</a></li>
			<li><a href="enquete/new_enquete">Par Cat&eacute;gorie</a></li>
		  </ul>
     </li>
      <?php } ?>
  </ul>
</div>
