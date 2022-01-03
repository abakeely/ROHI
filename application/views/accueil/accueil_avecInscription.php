<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/turbotabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/jquery.notify.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/animate.min.css">
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
	<style>
	.tab-link span {
		display: inline-block;
		width: 20px;
		/*height: 20px;*/
		background: #f02a2a;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
		-o-border-radius: 20px;
		border-radius: 20px;
		color: white;
		text-align: center;
		position: relative;
		top: -2px;
		line-height: 18px;
		margin: 0 0 0 5px;
		font-size: 0.8em;
	}
	.container{
		margin-bottom:100px;
		line-height: 1.6;
		
		margin: 0 auto;
	}
	ul.tabs{
		margin: 0px;
		padding: 0px!important;
		list-style: none;
	}
	ul.tabs li{
		background: none;
		display: inline-block;
		padding: 10px 15px!important;
		cursor: pointer;
		border-radius: 10px 10px 0 0;
		font-size:1.1em!important;
		background: -webkit-gradient(linear,left top,left bottom,from(rgb(211, 224, 204)),to(#a2a7a0));
		color: #3d423e;
	}

	ul.tabs li.current{
		background: #ededed;
		color:#FFF;
		background: -webkit-gradient(linear,left top,left bottom,from(#5d919c),to(#1d3f46));
	}

	.tab-content{
		display: none;
		padding: 20px;
		padding-bottom: 50px;
		border: 2px solid #109ab8;
		border-radius: 0 30px 10px 10px;
	}

	.tab-content.current{
		display: inherit;
	}
	</style>
		<a href="#" id="demo-warning">Warning notification</a>
		<div class="container" style="width:100%">
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
<?php if ($iAffiche == 1) { ?>
<div id="dialog" title="Dialog Title">
 <div id="content-wrap" class="row"> 
  		<form class="form-horizontal" role="form" name="formation" id="demande_formation" action="<?php echo base_url();?>formation/ajout_demande_formation" method="POST">
	<div class="col-md-12">
      
	  <table width="100%">
		<td style="vertical-align:bottom"><img src="<?php echo base_url();?>assets/gcap/images/def3.jpg" width="85" class="logo"></td>
		<td style="vertical-align:top;width:60%;">
		<p>&nbsp;</p>
		<p class="rm">
		<span class="top"><h1>BULLETIN D'INSCRIPTION</h1></span><br></td>
		</p>
		<td style="text-align:right;vertical-align:middle;"><img width="100" src="<?php echo base_url();?>assets/img/logo.png" class="logo"></td>
	  </table>
      <!-- INFORMATION DU SFAO--> 
	  
	  <h2>OFFRES DE FORMATIONS LOCALES 2017</h2>
      <br/>   
	  <div class="card punch-status">
	  <p id="bl" style="visibility: visible"> Le nombre de places disponible pour cette formation est de 20 personnes.<br>
	  Un quota est fixé par Direction ou Service cible. Avant de remplir ce bulletin d'inscription, assurez-vous d'avoir l'accord de votre supérieur hiérarchique pour representer votre Direction ou Service de rattachement.<br>
	  Merci!<br>
	  (La date limite d'inscription est fix&eacute;e le jeudi 16 F&eacute;vrier 2017)</p>
	  </div>
	  <br/>
       <div class="row separateur"><div class="col-md-12">Renseignements sur l'agent</div></div> 
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">T&eacute;l&eacute;phone</label>
			</div>
			<div class="col-md-2">
				<input type="text" id="phone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="phone" value="<?php echo $phone;?>">
			</div>
			<div class="col-md-6">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Adresse &eacute;lectronique </label>
			</div>
			<div class="col-md-4">
				<input type="text" id="mail" class="form-control" placeholder="e-mail" name="mail" value="<?php echo $mail;?>">
				
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Adresse professionnelle</label>
			</div>
			<div class="col-md-6">
				<input type="text" id="adresse_professionelle" class="form-control" placeholder="Adresse professionelle" name="adresse_professionel" value="<?php echo $adresse_professionel;?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row separateur"><div class="col-md-12">Attributions</div></div> 
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Attributions
                            </label>
                            <br> (Exemple :
                            <br>- Coordonner les activit&eacute;s du service
                            <br>- Repr&eacute;senter le service au r&eacute;unions
				</label>
			</div>
			<div class="col-md-7" id="div_attrib"> 
				<input type="hidden" value="<?php echo sizeof($list_attribution)?>" id="size_attribution"/>   
                <?php $i=0; if($list_attribution){ // MODIF du 04/07/2016
                	foreach($list_attribution as $elem){
                	 $i++;?>
                     <div class="row diplome_row" id="attribution_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="attribution" type="text" name="attribution[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteDiplome('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="attribution" type="text" name="attribution[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }
               ?>
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutAttrib"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>
		<br>
	   <div class="row separateur"><div class="col-md-12">T&acirc;ches quotidiennes au sein du service</div></div> 
		<br>	
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Listes de vos taches journalieres
                            </label>
                           <br> (Exemple :
							<br>-Lire le courrier arriv&eacute;
                            <br>-Consulter les mails et y r&eacute;pondre
				</label>
			</div>
			<div class="col-md-7" id="div_tache">
				<input type="hidden" value="<?php echo sizeof($list_tache)?>" id="size_attribution"/>   
                <?php $i=0; if($list_tache) {
                		foreach($list_tache as $elem){$i++;?>
                     <div class="row diplome_row" id="tache_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="tâche" type="text" name="tache_journaliere[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteTache('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
                <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="tâche" type="text" name="tache_journaliere[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }
               ?>
               
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutTache"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Postes de travail li&eacute;s etroitement avec vous</label>
                            <br> (Exemple :
							<br>-Divisions au sein du service
                            <br>-Cour des comptes
				</label>
			</div>
			<div class="col-md-7" id="div_post">
				<input type="hidden" value="<?php echo sizeof($list_post)?>" id="size_post"/>   
                <?php $i=0; if($list_post){
                	foreach($list_post as $elem){$i++;?>
                     <div class="row diplome_row" id="post_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="poste de travail"text" name="poste_travail[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           	<div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deletePoste('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Poste" type="text" name="poste_travail[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>	
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutPost"> <i class="la la-plus-circle"></i></button>
			</div> 
		</div>
		<br>
		<div class="row separateur"><div class="col-md-12">Livrables</div></div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Ce qui vous produisez periodiquement et rendez compte &agrave; votre sup&eacute;rieur hi&eacute;rarcique </label>
                            <br> (Exemple :
							<br>-Rapport d'activit&eacute;s
							<br>-Etats financiers
				</label>
			</div>
			<div class="col-md-7" id="div_produit">
				<input type="hidden" value="<?php echo sizeof($list_produit)?>" id="size_produit"/>   
                <?php $i=0; if($list_produit){ foreach($list_produit as $elem){$i++;?>
                     <div class="row diplome_row" id="produit_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="Produit Périodique" type="text" name="produit_periodique[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'produit_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
			 <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Produit Périodique" type="text" name="produit_periodique[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>	
            </div>
            <div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutProduit"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>
		<br>
		<div class="row separateur"><div class="col-md-12">Comp&eacute;tences n&eacute;cessaires et requises pour votre poste</div></div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Formations academiques / Universitaires requises pour la fonction </label>
                            <br> (Exemple :
							<br>-Formation en finances publique
                            <br>-Comptabilit&eacute; 
				</label>
			</div>
			<div class="col-md-7" id="formation_acad_row">
				<input type="hidden" value="<?php echo sizeof($list_formation_acad)?>" id="size_form_acad"/>   
                <?php $i=0; if($list_formation_acad){ foreach($list_formation_acad as $elem){$i++;?>
                     <div class="row diplome_row" id="formation_academique_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="Formation Academique" type="text" name="formation_academique[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'formation_academique_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
              <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Formation Academique" type="text" name="formation_academique[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>	
            </div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutFormAcad"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Formations professionnelles pour la fonction </label>
                            <br> (Exemple :
							<br>-Management
                            <br>-Finances publiques 
				</label>
			</div>
			<div class="col-md-7"  id="formation_prof_row">
				<input type="hidden" value="<?php echo sizeof($list_formation_prof)?>" id="size_form_prof"/>   
                <?php $i=0; if($list_formation_prof){ foreach($list_formation_prof as $elem){$i++;?>
                     <div class="row diplome_row" id="formation_academique_prof_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="Formation Professionnelle" type="text" name="formation_professionnelle[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'formation_academique_prof')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Formation Professionnelle" type="text" name="formation_professionnelle[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutFormProf"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Savoir (connaissances th&eacute;oriques) requis pour la formation </label>
                            <br> (Exemple :
							<br>-Niveau sup&eacute;rieur en comptabilit&eacute;
                            <br>-Niveau sup&eacute;rieur en finances publique
				</label>
			</div>
			<div class="col-md-7" id="requi_row">
				<input type="hidden" value="<?php echo sizeof($list_requi)?>" id="size_requi"/>   
                <?php $i=0; if($list_requi){foreach($list_requi as $elem){$i++;?>
                     <div class="row diplome_row" id="requi_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="Connaissances Th&eacute;oriques" type="text" name="savoir_requi[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'requi_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Connaissances Th&eacute;oriques" type="text" name="savoir_requi[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutRequi"> <i class="la la-plus-circle"></i></button>
			</div>   
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Savoir Faire (technique) requis pour la formation </label>
                            <br> (Exemple :
                            <br>-Savoir approfondi dans la technique budgetaire
                            <br>-Avoir beaucoup d'experience dans l'execution budgetaire
				</label>
			</div>
			<div class="col-md-7" id="faire_row">
				<input type="hidden" value="<?php echo sizeof($list_faire)?>" id="size_faire"/>   
                <?php $i=0; if($list_faire){ foreach($list_faire as $elem){$i++;?>
                     <div class="row diplome_row" id="faire_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="Savoir Faire" type="text" name="savoir_faire[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php  echo "deleteDiv(".$i.",'faire_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Savoir Faire" type="text" name="savoir_faire[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutFaire"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Savoir être (qualit&eacute;s) requis pour la fonction  </label>
                            <br> (Exemple :
							<br>-Bon manager
                            <br>-Avoir de bonne relation avec les autre entit&eacute;s
				</label>
			</div>
			<div class="col-md-7" id="etre_row">
				<input type="hidden" value="<?php echo sizeof($list_etre)?>" id="size_faire"/>   
                <?php $i=0; if($list_etre){ foreach($list_etre as $elem){$i++;?>
                     <div class="row diplome_row" id="etre_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="Savoir Être" type="text" name="savoir_etre[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'etre_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="Savoir Être" type="text" name="savoir_etre[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                      </div>
               <?php }?>
			</div>
			<div class="col-md-1">
				<button style="background: none repeat scroll 0px 0px olivedrab;color: white;" type="button" class="form-control" data-toggle="tooltip" data-original-title= "Tsindrio ra hanampy diplaoma" id="ajoutEtre"> <i class="la la-plus-circle"></i></button>
			</div>
		</div>
		<br>
		<div class="row separateur"><div class="col-md-12">Demande de Formation</div></div>
		<br>
		 <div class="row">
	             <div class="col-md-1"></div>
	             <div class="col-md-3 libele_form">
	                    <label class="control-label "> Module de formation </label>
	             </div>
	                <div class="col-md-8">
	                  <select class="form-control" placeholder="theme de formation" name="theme_formation" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="theme_formation">
					  <?php foreach($list_theme_formation as $d){ 
	                      $selected = ($d['id'] == $theme_formation['id'])  ? ' selected' : '';
	                  ?>
	                      <option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
	                      <?php }?>
	                   </select>
	                 </div>
	             <div class="col-md-5"></div>
		</div>
		<br>
		<!--<div class="row">
	             <div class="col-md-1"></div>
	             <div class="col-md-3 libele_form">
	                    <label class="control-label "> Module de formation </label>
	             </div>
	                <div class="col-md-3">
	                  <select class="form-control" placeholder="theme de formation" name="module_formation" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="module_formation">
	                      <option  value="0">S&eacute;lectionner</option>
					  		<?php foreach($list_module_formation as $d){ 
	                      		$selected = ($d['id'] == $module_formation['id'])  ? ' selected' : '';
	                  		?>
	                       <option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
	                      <?php }?>	
	                   </select>
	                 </div>
	             <div class="col-md-5"></div>
		</div>
		<br>
		<div class="row">
	             <div class="col-md-1"></div>
	             <div class="col-md-3 libele_form">
	                    <label class="control-label "> Contenu de formation </label>
	             </div>
	                <div class="col-md-3">
	                  <select class="form-control" placeholder="theme de formation" name="contenu_formation" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="contenu_formation">
		                  <option  value="0">S&eacute;lectionner</option>
					  		<?php foreach($list_contenu_formation as $d){ 
	                      		$selected = ($d['id'] == $contenu_formation['id'])  ? ' selected' : '';
	                  			?>
	                        	<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
	                       <?php }?>
						  
	                   </select>
	                 </div>
	             <div class="col-md-5"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Votre disponibilit&eacute; (p&eacute;riode)</label>
                           
				</label>
			</div>
			<div class="col-md-7">
				<textarea name="disponibilite" id="disponibilite" class="form-control" rows=5 ><?php echo $disponibilite;?></textarea>
			</div>
			<div class="col-md-1">
			</div>
		</div>-->
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3">
				<label class="control-label">Avez-vous d&eacute;j&agrave; particip&eacute; au programme<br> de formation du MFB</label>
			</div>
			<div class="col-md-6">
				<input type="radio"  name="deja_participe" id="deja_participe1" value="1" <?php echo ($deja_participe ==1)  ? ' checked="checked"' : ''?>>Oui
				&nbsp;
				<input type="radio"  name="deja_participe" id="deja_participe2" value="0" <?php echo ($deja_participe ==0)  ? ' checked="checked"' : ''?>>Non
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div id="row_anne_module" class="row" style="display:<?php echo ($deja_participe ==1)  ? '' : 'none'?>">
			<div class="col-md-1"></div>
			<div class="col-md-3">
				<label class="control-label"> En quelle ann&eacute;e?/ Quel module?</label>
			</div>
			<div class="col-md-7">
				<textarea   class="form-control" placeholder="Annee / module" name="annee_module_participe" id="annee_module_participe" rows=5 ><?php echo $annee_module_participe;?></textarea>
			</div>
			<div class="col-md-1">
			</div>
		</div>
		
		<br>
		 <div class="row" >
		<div class="col-md-1">
			<input type="hidden"  name="id" value="<//?php echo $id; ?>">
		</div>
		</div> 
		<br>
		<div class="row">
			
			<div class="col-md-8">
			</div>
			<div class="col-md-2">
				<input type='submit' class="btn btn-primary form-control" value='Enregistrer'/>	
			</div>
            <!-- COMMENTAIRE D'IMPRIMER FORMATION            
             <div class="col-md-2">
				<input type='button' id="appercu" class="btn btn-primary form-control" value='Imprimer' />	
			</div>
			<div class="col-md-2"></div>-->				
		</div>
		<br>
	</div>
      <div id ="resultat_popup"></div>
	</form> 
  </div>
</div>

<?php } ?>
<style>
form { font-size:12px!important;}
.row {
	font-size:14px!important;
	padding-top:1rem;
}
h1 {
	text-align:center;
	font-size:20px;
}
h2 {
	text-align:center;
	font-size:20px;
}
.btn_close {
	padding:0px!important;
}
.encadre {
	background: #F9F9F9;
    border: 1px solid #bfbfbf;
    padding: 15px;
	text-align:center;
	color:#0088ff;
	font-size:16px;
}
</style>
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
	var zContent = $("#ajax").html() ; 
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
})
</script>

<?php if ($iAffiche == 1) { ?>
<script>
$(document).ready (function ()
{
	$( "#dialog" ).dialog({
		autoOpen: false,
		width: '75%',
		title: 'Inscription formation 2017',
		close: 'X',
		modal: true,
		
	});

	<?php if ($iAffiche == 1) ?>
	
	$( "#dialog" ).dialog( "open" );

	$('#deja_participe1').on('click',function(){
		$('#row_anne_module').show();
	});

	$('#deja_participe2').on('click',function(){
		$('#row_anne_module').hide();
	});

	$("#phone").mask("999 99 999 99");    

	$('#theme_formation').on('change',function(){
		var valeur = $('#theme_formation').val();
        if(valeur!='0'){
       		$.ajax({
                url: "<?php echo base_url();?>json/module_formation/"+valeur,
                type: 'get',
                success: function(data, textStatus, jqXHR) {
                      var obj = jQuery.parseJSON(data);
                      $('#module_formation').html('');
                      var select_option ='';
                      select_option += '<option value="0">Selectionner</option>';
                      obj.forEach(function(module) {
                          select_option += '<option value="'+module['id']+'">'+module['libele']+'</option>';
                      });
                      $('#module_formation').html(select_option);
                },
                async: false
       		 });
        }
	});

	$('#module_formation').on('change',function(){
		var valeur = $('#module_formation').val();
        if(valeur!='0'){
       		$.ajax({
                url: "<?php echo base_url();?>json/contenu_formation/"+valeur,
                type: 'get',
                success: function(data, textStatus, jqXHR) {
                      var obj = jQuery.parseJSON(data);
                      $('#contenu_formation').html('');
                      var select_option ='';
                      select_option += '<option value="0">Selectionner</option>';
                      obj.forEach(function(module) {
                          select_option += '<option value="'+module['id']+'">'+module['libele']+'</option>';
                      });
                      $('#contenu_formation').html(select_option);
                },
                async: false
       		 });
        }
	});
})
</script>
<?php } ?>

