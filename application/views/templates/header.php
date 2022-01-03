<!DOCTYPE html>
<style>
.flotte {
float:left;
}
 table {
 border-collapse:collapse;
 width:90%;
 }
th, td {
 border:1px solid #E6E6FA;
 width:20%;
 }
td {
 text-align:center;
 }
caption {
 font-weight:bold
 }
 
 /* Style des lignes de séparation */
.table-separateur {
  font-size : 12px;
  font-family : Verdana, arial, helvetica, sans-serif;
  color : #333333;
  background-color : #F5F5F5;
}

.menu_lucia_active{
    border:1px solid bleu;
	background-color :#95A595; 
	heigth: 28px;
	color:white !important
}
.menu_lucia_nonactive{
   border:1px solid bleu;	
   background-color :#40826D;
   heigth: 28px ;
   color:white !important

}

.menu_lucia_nonactive:hover{
   color:white !important
}
 </style>
<html>
<?php

	$oSession = session_id();

	if(empty($oSession)){ 
		session_start();
	}

	if (isset($_SESSION["session_compte"])){
		$iSessionCompte = $_SESSION["session_compte"] ; 
	} else {
		$iSessionCompte = COMPTE_AGENT ; 
	}
	
	$zActivation = $this->uri->segment(2);

	$iAfficheEvaluateur = 0;

	if (sizeof($toComptes)>0){
		$iAfficheEvaluateur = 1 ; 
	}

	$iMenuActif = 0;
	if ($zActivation == "index") {
		$iMenuActif = 0;
	}

	if ($zActivation == "mon_cv") {
		$iMenuActif = 1;
	}

	if ($zActivation == "vosNotes") {
		$iMenuActif = -13;
	}

	if ($zActivation == "list_cv_per_dep" || $zActivation == "list_invalide") {
		$iMenuActif = 2;
	}

	if ($zActivation == "statistic_main" || $zActivation == "mouvement") {
		$iMenuActif = 3;
	}

	if ($zActivation == "list_user_connected" || $zActivation == "list_user_no_cv") {
		$iMenuActif = 4;
	}

	if ($zActivation == "respers" || $zActivation == "list_respers") {
		$iMenuActif = 5;
	}

	if ($zActivation == "list_cv") {
		$iMenuActif = 6;
	}

	if ($zActivation == "mouvement" || $zActivation == "histo_info_admin" ) {
		$iMenuActif = 7;
	}
	
	if ($zActivation == "demande_formation" || $zActivation == "demande_formation" ) {
		$iMenuActif = 8;
	}
	
	if ($zActivation == "offre_interieur" || $zActivation == "offre_interieur" ) {
		$iMenuActif = 9;
	}
	if ($zActivation == "rapport_locale" || $zActivation == "rapport_locale" ) {
		$iMenuActif = 10;
	}
	if ($zActivation == "info_utile" || $zActivation == "info_utile" ) {
		$iMenuActif = 11;
	}
	/*  Debut Documentation*/
	
	if ($zActivation == "reglement" || $zActivation == "guide" || $zActivation == "plan_d_acces" || $zActivation == "personnel") {
		$iMenuActif = 12;
	}
	
	if ($zActivation == "sad" || $zActivation == "sad") {
		$iMenuActif = 13;
	}
	
	if ($zActivation == "nouveaute" || $zActivation == "nouveaute" ) {
		$iMenuActif = 14;
	}
	
	if ($zActivation == "texte_reglementaire" || $zActivation == "autre_numerise" ) {
		$iMenuActif = 15;
	}
	
	if ($zActivation == "flash_info" || $zActivation == "planning" ) {
		$iMenuActif = 16;
	}
	
	if ($zActivation == "catalogue_livre" || $zActivation == "pret_livre" ) {
		$iMenuActif = 18;
	}
	if ($zActivation == "liste_pret" || $zActivation == "prolongation_pret"|| $zActivation == "liste_besoin" ) {
		$iMenuActif = 19;
	}
	if ($zActivation == "consult_place" || $zActivation == "list_lecture_sur_place"|| $zActivation == "connexion_internet"
	|| $zActivation == "list_connexion_net" || $zActivation == "bilan" ) {
		$iMenuActif = 20;
	}
	/*  Fin Documentation*/
	$version = '?V2';
    $id1 = "";
    $id2 = "";
    $id3 = "";
    $id4 = "";
    $id5 = "";
	$id6 = "";
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
    	$role_aff = "Compte Agent";
    }
    else if($role_aff == "chef"){
    	$role_aff = "Compte Responsable Personnel";
    } else {
		$role_aff = "Compte Administrateur";
	}
?>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI - RessOurces Humaines Informatis&eacute;es</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/vendor/jquery-ui.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/vendor/font-awesome.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/app_main.css?20170120">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/BrightSide.css<?php echo $version;?>">

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css<?php echo $version;?>201701">
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css<?php echo $version;?>" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css<?php echo $version;?>" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css<?php echo $version;?>" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/datepicker3.css<?php echo $version;?>" rel="stylesheet">

	<?php if(!isset($is_stat)) {?>
		<!--<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.js<?php echo $version;?>"></script>-->
		<script type="text/javascript" src="<?php echo base_url();?>assets/gcap/js/vendor/jquery-1.11.3.min.js"></script>
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
	<style>
		a { text-decoration:none!important;}
	</style>

</head>
<body>
    <header id="mainHeader">
		<!--<div class="fall_snow"></div>-->
        <div id="mainHeaderTop">
            <div class="logo">
                <div><span><img src="<?php echo base_url();?>assets/gcap/images/def3.jpg" alt=""></span></div>
            </div>
            <div class="info" style="text-align:justify">
				<h1>RessOurces Humaines Informatis&eacute;es</h1>
                <hr>
                <p>&nbsp;</p>
				<input type="hidden" value="<?php echo base_url();?>" id="url_base"/>
				<!--<a href="<?php echo base_url();?>common/plandusite" class="btnTousHeaderJaunes"><img style="width:12px;" src="<?php echo base_url();?>assets/gcap/images/trie.png">&nbsp;&nbsp;&nbsp;PLAN DU SITE</a>
				<a href="<?php echo base_url();?>common/contact" class="btnTousHeader"><img style="width:20px;" src="<?php echo base_url();?>/assets/gcap/images/main.png">&nbsp;&nbsp;CONTACTEZ-NOUS</a>-->
            </div>
			<div class="logo">
                <div><span><img src="<?php echo base_url();?>assets/gcap/images/def2.jpg" alt=""></span></div>
            </div>
        </div>
        <div id="mainHeaderBottom">
            <p><a href="#" title=""><?php echo $user['nom'].' '.$user['prenom'];?><span><img src="<?php echo base_url();?>assets/gcap/images/user.jpg" alt=""></span></a></p>
			<form name="setCompte" id="setCompte" action="<?php echo base_url();?>gcap/setSessionCompte" method="POST">
				<input type="hidden" name="zUrlRedirect" id="zUrlRedirect" value="{$zUrl}">
				<fieldset>
						<div class="field">
							<select name="iCompteId" id="iCompteId" style="width:200px;font-size:12px!important;" onChange="document.setCompte.submit();">
								<option <?php if ($iSessionCompte == 1){  echo 'selected="selected"' ;  } ?> value="1"><?php /*echo $role_aff;*/?>Compte Agent</option>
								<?php foreach ($toComptes as $oComptes){

									$zSelect = '';
									if ($iSessionCompte == $oComptes['compte_id']){
										$zSelect = 'selected="selected"' ; 
									}
									echo '<option '.$zSelect.' value="'. $oComptes['compte_id'] .'">'.$oComptes['compte_libelle'].'</option>' ; 
								} ?>
							</select>
						</div>
				</fieldset>
				</form>
        </div>
        <div id="mainHeaderMenu">
            <nav>
                <ul style="<?php echo (isset($menu_lucia))?" padding-top:1px;":"";?>">
				   <?php if(!isset($iModuleActif) || $iModuleActif!=7){ ?>
				    <!--
					<?php if(!isset($iModuleActif) || ($iModuleActif != -1 && $iModuleActif != -2)){ ?> 
					<li <?php if($iMenuActif==0){ echo 'class="active"'; }?> ><a class="color2" href="<?php echo base_url();?>cv/index"><i class="la la-file-o"></i>&nbsp;Communiqu&eacute;</a></li>
					<li <?php if($iMenuActif==0)  ?>  <?php if(isset($iModuleActif) && ($iModuleActif == -13)){ echo 'class="active"'; }?> ><a class="color2" href="<?php echo base_url();?>cv/vosNotes" ><i class="la la-file-o"></i>&nbsp;Vos notes d'&eacute;valuation</a></li>-->
					<?php } ?>

					<!--Modification lucia -->
					
					<?php } if(isset($iModuleActif) && $iModuleActif== -1){?>
					<li <?php if($iMenuActif==9){ echo 'class="active"'; }?> >
					     <a <?php if(isset($menu_lucia)&&$menu_lucia==101){ echo 'class="menu_lucia_active"';  }else { echo 'class="menu_lucia_nonactive"';}
					     ?> href="<?php echo base_url();?>formation/couverture_offre" title="">
						 </i>OFFRES</a>
                    </li>
					
					
					<li <?php if($iMenuActif==10){ echo 'class="active"'; }?> >
					        <a <?php if(isset($menu_lucia)&&$menu_lucia==102){ echo 'class="menu_lucia_active"';  }else { echo 'class="menu_lucia_nonactive"';}
					        ?> href="#" title=""></i>REPORTING</a>
						<ul   style="width:300px;">
							<li><a class="color2" href="<?php echo base_url();?>formation/rapport_formation"></i>RAPPORTS DE FORMATION</a></li>
							<li><a class="color2" href="<?php echo base_url();?>formation/autre_rapport"></i>AUTRES RAPPORTS</a></li>
						</ul>
                    </li>	
				
					<li <?php if($iMenuActif==11){ echo 'class="active"'; }?> >
					        <a <?php if(isset($menu_lucia)&&$menu_lucia==103){ echo 'class="menu_lucia_active"';  }else { echo 'class="menu_lucia_nonactive"';}
					        ?> href="#" title=""></i>LIENS UTILES</a>
                        <ul   style="width:300px;">
							<li><a class="color2" href="<?php echo base_url();?>formation/texte_reference"></i>TEXTE DE REFERENCES</a></li>
							<li><a class="color2" href="<?php echo base_url();?>formation/document_pointfocaux"></i>DOCUMENTS POINTS FOCAUX</a></li>
							<li><a class="color2" href="<?php echo base_url();?>formation/info_comm"></i>INFO COMM</a></li>
						</ul>	
                    </li>
					
					<li <?php if($iMenuActif==110){ echo 'class="active"'; }?> >
					        <a <?php if(isset($menu_lucia)&&$menu_lucia==106){ echo 'class="menu_lucia_active"';  }else { echo 'class="menu_lucia_nonactive"';}
					        ?> href="#" title=""></i>ARCHIVES</a>
                        <ul   style="width:300px;">
							<li><a class="color2" href="<?php echo base_url();?>formation/photoformation/1"></i>PHOTO</a></li>
							<li><a class="color2" href="<?php echo base_url();?>formation/photoformation/2"></i>TROMBINOSCOPE</a></li>
							<li><a class="color2" href="<?php echo base_url();?>formation/agentforme"></i>FICHIER UNIQUE DE FORMATION - " M F B "</a></li>
							<li><a class="color2" href="<?php echo base_url();?>formation/programme_formation"></i>PROGRAMME DE FORMATION</a></li>
						</ul>	
                    </li>
					
					<li <?php if($iMenuActif==111){ echo 'class="active"'; }?> >
					<a <?php if(isset($menu_lucia)&&$menu_lucia==107){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
					href="<?php echo base_url();?>formation/info_region">
					 
					</i>INFOS REGIONS</a></li>
					
					<!--<li <?php if($iMenuActif==11){ echo 'class="active"';}?> > 
					<?php if($display_list_formation){?>
					<a <?php if( isset($menu_lucia)&&$menu_lucia==32){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?> 
					href="<?php echo base_url();?>formation/list_demande_formation">
					</i>&nbsp;Listes Agents</a>
					<?php }?>
					</li>-->
					<!--Fin modification lucia-->
					
					<?php } if(isset($iModuleActif) && $iModuleActif== -2){?>
					<li <?php if($iMenuActif==12){ echo 'class="active"'; }?> >
					<a <?php if(isset($menu_lucia)&&$menu_lucia==1){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
					href="<?php echo base_url();?>documentation/couv_infos">
					</i>&nbsp;INFOS PRATIQUES</a></li>
                    
					<li <?php if($iMenuActif==18){ echo 'class="active"'; }?> >
					<a <?php if(isset($menu_lucia)&&$menu_lucia==2){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
					href="<?php echo base_url();?>documentation/couverture">
					</i>&nbsp;CATALOGUES</a></li>
					
					<li <?php if($iMenuActif==14){ echo 'class="active"'; }?> >
					<a <?php if(isset($menu_lucia)&&$menu_lucia==3){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?> 
					href="<?php echo base_url();?>nouveaute/nouveaute_liste">
					<img src="<?php echo base_url();?>assets/img/OBJ09310.gif"  border="0" height="34" width="64">
					</i>&nbsp;NOUVEAUTES</a></li>
					
					<li <?php if($iMenuActif==19){ echo 'class="active"'; }?>>
                        <a <?php if(isset($menu_lucia)&&$menu_lucia==5){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
						href="<?php echo base_url();?>documentation/couverture_pret">
						</i>&nbsp;&nbsp;SERVICES PROPOS&Eacute;S</a></li>
						
					 <?php if($role=="biblio"){?>
					<li <?php if($iMenuActif==20){ echo 'class="active"'; }?>>
                        <a <?php if(isset($menu_lucia)&&$menu_lucia==10){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
						href="<?php echo base_url();?>documentation/tableau_bord" title=""></i>TABLEAU DE BORD</a>
           				
                    </li>
					<?php }?>					
					<li <?php if($iMenuActif==16){ echo 'class="active"'; }?>>
                        <a <?php if(isset($menu_lucia)&&$menu_lucia==6){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
						href="<?php echo base_url();?>documentation/planning_restitution" title="">
						<img src="<?php echo base_url();?>assets/img/news_bonne.gif"  border="0" height="30" width="60">
						</i>&nbsp;RESTITUTION</a>	
                    </li>
					
					<li <?php if($iMenuActif==16){ echo 'class="active"'; }?>>
                        <a <?php if(isset($menu_lucia)&&$menu_lucia==6){ echo 'class="menu_lucia_active"';} else { echo 'class="menu_lucia_nonactive"';} ?>
						href="<?php echo base_url();?>documentation/fichepayement" title="">
						</i>&nbsp;TES FICHE</a>	
                    </li>
					<!-- Fin Docuementations -->
					
					<!--Debut projet AINA Gestion de projete et planning-->
					
			        <?php } if(isset($iModuleActif) && $iModuleActif== -51){?>
					
					<li <?php if($iMenuActif==33){ echo 'class="active"'; }?> >
						<a class="color2" href="<?php echo base_url();?>gestionprojet/liste_projet"><i class="la la-file-o">
						</i>&nbsp;Projet</a>
					</li>
					<li <?php if($iMenuActif==34){ echo 'class="active"'; }?> >
						<a class="color2" href="<?php echo base_url();?>gestionprojet/view_gantt"><i class="la la-file-o">
						</i>&nbsp;Diagramme</a>
					</li>
					<li <?php if($iMenuActif==32){ echo 'class="active"'; }?> >
						<a class="color2" href="<?php echo base_url();?>gestionprojet/view_calendrier"><i class="la la-file-o">
						</i>&nbsp;Calendrier</a>
					</li>
					<li <?php if($iMenuActif==34){ echo 'class="active"'; }?> >
						<a class="color2" href="<?php echo base_url();?>gestionprojet/view_imprimer"><i class="la la-file-o">
						</i>&nbsp;Imprimer PDF</a>
					</li>
					<!--Fin projet AINA Gestion de projete et planning-->
			 
			      <?php } else{?>
					<?php  if($iSessionCompte==COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte==COMPTE_AUTORITE){?>
                    <li <?php if($iMenuActif==6){ echo 'class="active"'; }?>>
                        <a href="#" title=""><i class="la la-hand-o-right"></i>&nbsp;LISTES PAR DIRECTION</a>
                        <ul>
							<li><a  href="<?php echo base_url();?>cv/list_cv"><i class="la la-user"></i>&nbsp;&nbsp;Agent par Direction</a></li>
						</ul>	
                    </li>
					<li <?php if($iMenuActif==7){ echo 'class="active"'; }?>>
                        <a href="#" title=""><i class="la la-exchange"></i>&nbsp;&nbsp;MOUVEMENT</a>
                        <ul style="width:250px;">
							<li><a  href="<?php echo base_url();?>cv/mouvement"><i class="la la-history"></i>&nbsp;&nbsp;Historique des mouvements</a></li>
							<li><a  href="<?php echo base_url();?>cv/histo_info_admin"><i class="la la-group"></i>&nbsp;&nbsp;Historique des Informations Admin</a></li>
							<li><a  href="<?php echo base_url();?>assets/pdf/FICHE_ROHI.pdf" target="_blank"><i class="la la-file-pdf-o"></i>&nbsp;&nbsp;<u>T&eacute;l&eacute;charger la "Fiche ROHI"</u></a></li>
						</ul>	
                    </li>
					
					<?php }?>
					<?php  if($iSessionCompte==COMPTE_ADMIN){?>
					
							<li <?php if($iMenuActif==2){ echo 'class="active"'; }?>><a href="#"><i class="la la-group"></i>&nbsp;&nbsp;RECENSEMENT</a>
								<!--modif-->
								<ul style="width:250px;"> 
									<li><a href="<?php echo base_url();?>cv/list_cv_per_dep"><i class="la la-user"></i>&nbsp;&nbsp;Agent du MFB</a></li>
									<li><a href="<?php echo base_url();?>cv/list_invalide"><i class="la la-user"></i>&nbsp;&nbsp;Agent du MFB &agrave; Valider</a></li>
									
								</ul>	
							</li>
					
							<li <?php if($iMenuActif==3){ echo 'class="active"'; }?>><a href="#"><i class="la la-search"></i>&nbsp;&nbsp;VISUALISATION</a>
								<ul style="width:250px;">
									<li><a href="<?php echo base_url();?>statistique/statistic_main"><i class="la la-area-chart"></i>&nbsp;&nbsp;Statistique</a></li>
									<li><a href="<?php echo base_url();?>cv/mouvement"><i class="la la-exchange"></i>&nbsp;&nbsp;Mouvement</a></li>
								</ul>
							</li>
							
							<li <?php if($iMenuActif==4){ echo 'class="active"'; }?>><a href="#"><i class="la la-user"></i>&nbsp;&nbsp;USER</a>
								<ul style="width:250px;">
									<li><a href="<?php echo base_url();?>user/list_user_connected"><i class="la la-user"></i>&nbsp;&nbsp;Agent connect&eacute;</a></li>
									<li><a href="<?php echo base_url();?>user/list_user_no_cv"><i class="la la-user"></i>&nbsp;&nbsp;Compte sans CV</a></li>
								</ul>	
							</li>
							<li <?php if($iMenuActif==5){ echo 'class="active"'; }?>><a href="#"><i class="la la-edit"></i>&nbsp;&nbsp;MODIFICATION</a>
								<ul style="width:250px;">
									<li><a href="<?php echo base_url();?>user/respers"><i class="la la-user"></i>&nbsp;&nbsp;Compte Resp. du Personnel</a></li>
									<li><a href="<?php echo base_url();?>user/list_respers"><i class="la la-user"></i>&nbsp;&nbsp;Liste des Resp. du Personnel</a></li>
								</ul>	
							</li>
							<!----Modif du 24/04/2017-------->
							<li <?php if($iMenuActif==5){ echo 'class="active"'; }?>><a href="#"><i class="la la-edit"></i>&nbsp;&nbsp;ACCES</a>
								<ul style="width:250px;">
									<li><a href="<?php echo base_url();?>access/access"><i class="la la-user"></i>&nbsp;&nbsp;DONNEES</a></li>
									<li><a href="<?php echo base_url();?>access/ecd"><i class="la la-user"></i>&nbsp;&nbsp;ECD</a></li>
								</ul>	
							</li>
						<?php }?>
              <?php }?>
                    
                </ul>
				<!--<div style="text-align: right; margin-right: 100px;cursor:pointer!important">
					<ul>
						<li><a  style="cursor:pointer!important" href="<?php echo base_url();?>documentation/list_notification"><img src="<?php echo base_url();?>assets/img/notification.png"  border="0" height="30" width="40">(<?php echo($nbr_notification)?>)</a></li>
					</ul>
				</div>-->
            </nav>
		</div>
    </header>
<script>

$(document).ready(function() {
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
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		<?php include "colonneGauche.page.php" ;?>
	</div>
	<div id="innerContent">