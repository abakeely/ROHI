<!DOCTYPE> 
<style>
<!--
<?php 
	$menu_accueil = "none";
	$menu_cv = "none";
	$menu_formation = "none";
	$menu_recensement = "none";
	$menu_gcap = "none";
	$menu_sondage = "none";
	$menu_deconnection = "none";
	
	$espace_apres_menu = "none";
	
	if($menu && $menu!=0){
		$menu_accueil = "block";
		$menu_deconnection = "block";
		switch($menu){
			case 1 : {
				$menu_cv = "block";
				$espace_apres_menu = "block";
				break;
			}
			case 2 : {
				$menu_formation = "block";
				$espace_apres_menu = "block";
				break;
			}
			case 3 : {
				$menu_recensement = "block";
				$espace_apres_menu = "block";
				break;
			}
			case 4 : {
				$menu_gcap = "block";
				$espace_apres_menu = "block";
				break;
			}
			case 5 : {
				$menu_sondage = "block";
				$espace_apres_menu = "block";
				break;
			}
		}
	}
		
?>
.espace_apres_menu{
	display:<?php echo $espace_apres_menu;?>!important;
}

.menu_accueil{
	display:<?php echo $menu_accueil;?>!important;
}
.menu_cv{
	display:<?php echo $menu_cv;?>!important;
}
.menu_formation{
	display:<?php echo $menu_formation;?>!important;
}
.menu_recensement{
	display:<?php echo $menu_recensement;?>!important;
}
.menu_gcap{
	display:<?php echo $menu_gcap;?>!important;
}
.menu_sondage{
	display:<?php echo $menu_sondage;?>!important;
}
-->
</style>
<?php
	$version = '?V2';
    $id1 = "";
    $id2 = "";
    $id3 = "";
    $id4 = "";
    $id5 = "";
    $role = "user";
    $exist_cv = false; 
    
    if(isset($user['exist_cv']))
		if($user['exist_cv']==true){
			$exist_cv = true; 
		} 
	
	if($user['role'])
		$role = $user['role'];
	
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
    
    $matricule = "";
    if(strlen($user['im'])==6){
    	$matricule = $user['im'][0].$user['im'][1].$user['im'][2].' '.$user['im'][3].$user['im'][4].$user['im'][5];
    	$matricule = " IM ".$matricule;
    }
    else{
    	$matricule = ' '.$user['im'];
    }
    
    $role_aff = $user['role'];
    if($role_aff == "user"){
    	$role_aff = "Agent";
    }
    else if($role_aff == "chef"){
    	$role_aff = "Resp.pers";
    }
?>
<html> 
	<head> 
		<meta charset="utf-8"> <title>ROHI</title> 
		
		<style>
			<?php //if ($role=='admin' || $role=='chef'){?>
			#wrap{
				width:100% !important;
			}
			<?php //}?>
		</style>
	</head> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min-3.0.0.css<?php echo $version;?>">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css<?php echo $version;?>">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/BrightSide.css<?php echo $version;?>">

	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css<?php echo $version;?>" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css<?php echo $version;?>" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css<?php echo $version;?>" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/datepicker3.css<?php echo $version;?>" rel="stylesheet">
	
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css<?php echo $version;?>" rel="stylesheet">
	<!-- MEGA MENU -->
	<link href="<?php echo base_url();?>assets/css/megamenu.css<?php echo $version;?>" rel="stylesheet">
	
	<?php if(!isset($is_stat)) {?>
		<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.js<?php echo $version;?>"></script>
	<?php }?>
	<?php if(isset($is_stat)) {?>
		<script  src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
	<?php }?>
	
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js<?php echo $version;?>"></script>
	
	<script src="<?php echo base_url();?>assets/js/bootstrap-dialog.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/dataTables.bootstrap.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/formValidation.min.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.js<?php echo $version;?>"></script>
	
	<script src="<?php echo base_url();?>assets/js/bootbox.min.js<?php echo $version;?>"></script>
	
	<script src="<?php echo base_url();?>assets/js/home.js<?php echo $version;?>"></script>
	<script src="<?php echo base_url();?>assets/js/date.js<?php echo $version;?>"></script>

	
	<?php if(isset($is_stat)) {?>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jqwidgets/jqx.base.css" type="text/css" />
		<script  src="<?php echo base_url();?>assets/js/jqwidgets/jqxcore.js"></script>
		<script  src="<?php echo base_url();?>assets/js/jqwidgets/jqxchart.js"></script>
		<script   src="<?php echo base_url();?>assets/js/jqwidgets/jqxdata.js"></script>
	<?php }?>
	
	<!-- MEGA MENU -->
	<script src="<?php echo base_url();?>assets/js/megamenu.js"></script>
	
	<body> 
	  
        <input type="hidden" value="<?php echo base_url();?>" id="url_base"/>
		<div id="wrap">
			  <div id="header" class="navbar navbar-fixed-top">
                              <div class="navbar-inner">
                                <div class="container-fluid">
                                	<div class="row header_home"> 
                                		<div class="col-md-6 grand_titre titre_home" style="padding-bottom: 18px;">
		                                    <h2>RessOurces Humaines Informatis&eacute;es</h2> 
                                		</div> 
                                		<div class="col-md-6" style="text-align:right;" id="head_name">
                                			<h2> 
                                				<span class="black" style="font-size: 12px;font-weight: bold;">Bienvenue <?php echo $user['nom'].' '.$user['prenom'];?> <font style="font-weight: unset; font-size: 12px;" color='green' >(<?php echo $role_aff;?>)</font></span>
                                				<span style="font-size: 12px!important;">|  <a href="<?php echo base_url();?>user/deconnexion" style="color: green;font-size: 12px!important;">D&eacute;connexion</a></span>
                                			</h2> 
                                		</div> 
                                    </div>              
                                     <?php 
	                                    $data_menu = array();
	                                    $data_menu['role'] = $role;
	                                    $data_menu['id1'] = $id1;
	                                    $data_menu['id2'] = $id2;
	                                    $data_menu['id3'] = $id3;
	                                    $data_menu['id4'] = $id4;
	                                    $data_menu['id5'] = $id5;
                                    	$this->load->view('templates/menu0',$data_menu);
                                    ?>
                                </div>
                            </div>
			  </div>
			<div id="content-wrap" class="row"> 
			<div class="espace_apres_menu">
				<br><br><br><br><br><br>
			</div>
				
<script>
$(document).ready(function() {
	$(".megamenu").megamenu();
	$("#decon").click (function(){
		document.location.href = "<?php echo base_url();?>user/deconnexion";
	})

	<?php if (isset($msg)) {?>
	    bootbox.alert("<?php echo $msg;?>");
	<?php }?>
})
function changeIM(){
	var im = $("#im_suppleant").val();
	if(im!='______' && im!=''){
		$.ajax({
            url: "<?php echo base_url();?>" + "json/nom_supleant/" + im,
            type: "GET",
            success: function(data){
            	var objetJSON = $.parseJSON(data);
            	if(objetJSON.statut){
            		$('#label_name').html(objetJSON.msg);
            	}
            }
        });	
	}
	else
		$('#label_name').html("");
		
}
</script>