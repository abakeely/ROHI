<?php
/**
 * Created by PhpStorm.
 * User: Haingo
 * Date: 19/10/2015
 * Time: 21:53
 */
?>
<!-- Bootstrap -->
<link href="<?php echo base_url() ?>/assets/portfolio/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url() ?>/assets/portfolio/css/bootstrap.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url() ?>/assets/portfolio/css/blue.css" rel="stylesheet" type="text/css" media="all" />
<!-- menu 3D -->
<link href="<?php echo base_url() ?>/assets/style/menu3DstyleCl.css" rel="stylesheet" type="text/css" media="all" />
<!----font-Awesome----->
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/portfolio/fonts/css/font-awesome.min.css">
<!----font-Awesome----->
<!-- start plugins -->
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/portfolio/js/menu.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/fliplightbox.min.js"></script>
<script type="text/javascript">
    $('body').flipLightBox()
</script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.mixitup.min.js"></script>

<!-- start light_box -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/portfolio/css/jquery.fancybox.css" media="screen" />
<!--
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
-->
<script type="text/javascript" src="<?php echo base_url() ?>/assets/portfolio/js/jquery.fancybox-1.2.1.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("div.fancyDemo a").fancybox();
    });
</script>
<!-- ajouter au panier 1-->
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/style/addtochartclient.css"/>
<!-- ajouter au panier 2-->
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/style/addtochart2.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/scripts/addtochart2.js"></script>
<!--download pdf -->
<script>
    $(".download-pdf").click(
        function(e) {
            e.preventDefault();

            //open download link in new page
            window.open( $(this).attr("href") );

            //redirect current page to success page
            window.location="#";
            window.focus();
        }
    );
</script>
<!--panier-->
<link href="<?php echo base_url() ?>/assets/style/cart.css" rel='stylesheet' type='text/css' />


<div id="zonemenu">
<ul class="menu">
    <li><a href="#s2">Cat&eacutegories</a>
        <ul class="submenu">
            <li><a href="<?php echo base_url().'index.php/sad/booklist' ?>">Liste des livres</a></li>
            <li><a href="<?php echo base_url().'index.php/sad/newbooks' ?>">Nouveaux livres</a></li>
        </ul>
    </li>
    <li><a href="<?php echo base_url().'index.php/sad/catalogue' ?>">Catalogue</a>
        <ul class="submenu">
            <li><a href="<?php echo base_url().'index.php/sad/booklist' ?>">Liste des livres</a></li>
            <li><a href="<?php echo base_url().'index.php/sad/newbooks' ?>">Nouveaux livres</a></li>
        </ul>
    </li>
    <li><a href="#">Besoins en livre</a></li>
    <!-- notifications -->
</ul>
</div>
