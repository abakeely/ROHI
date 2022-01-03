<?php 

if(!isset($phone)){
	$phone  = "";
	$mail = "";
	$adresse_professionel = "";
	
	$attribution = "";
	$tache_journaliere = "";
	$poste_travail = "";
	$produit_periodique = "";
	$formation_academique = "";
	$formation_professionnelle = "";
	
	
	$savoir_requi = "";
	$savoir_faire = "";
	$savoir_etre = "";
	$theme_formation = "";
	$module_formation = "";
	$disponibilite = "";
	$contenu_formation = "";
	
	$annee_module_participe = "";
	$deja_participe = 1;
	
	$list_attribution = null;
	$list_tache = null;
	$list_post = null;
	$list_produit = null;
	$list_formation_acad = null;
	$list_formation_prof = null;
	$list_requi = null;
	$list_faire = null;
	$list_etre = null;
		
}

//($expression)

?>
    <div id="content-wrap" class="row"> 
  		<form class="form-horizontal" role="form" name="formation" id="demande_formation" action="ajout_demande_formation" method="POST">
	<div class="col-md-12">
     
      <!-- INFORMATION DU SFAO--> 
      <br>    
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
				<label class="control-label">Adresse professionnel</label>
			</div>
			<div class="col-md-6">
				<input type="text" id="adresse_professionel" class="form-control" placeholder="Adresse professionel" name="adresse_professionel" value="<?php echo $adresse_professionel;?>">
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
                           <div class="col-md-8"><input class="form-control" placeholder="tache" type="text" name="tache_journaliere[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo 'deleteTache('.$i.')';?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
                <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="tache" type="text" name="tache_journaliere[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
                           <div class="col-md-8"><input class="form-control" placeholder="produit periodique" type="text" name="produit_periodique[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'produit_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
			 <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="produit" type="text" name="produit_periodique[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
                           <div class="col-md-8"><input class="form-control" placeholder="formation academique" type="text" name="formation_academique[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'formation_academique_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
              <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="formation" type="text" name="formation_academique[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
                           <div class="col-md-8"><input class="form-control" placeholder="formation professionnelle" type="text" name="formation_professionnelle[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'formation_academique_prof')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="formation" type="text" name="formation_professionnelle[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
                           <div class="col-md-8"><input class="form-control" placeholder="savoir requi" type="text" name="savoir_requi[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'requi_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="formation" type="text" name="savoir_requi[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
                           <div class="col-md-8"><input class="form-control" placeholder="savoir faire" type="text" name="savoir_faire[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php  echo "deleteDiv(".$i.",'faire_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="formation" type="text" name="savoir_faire[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
				<label class="control-label">Savoir etre (qualit&eacute;s) requis pour la fonction  </label>
                            <br> (Exemple :
							<br>-Bon manager
                            <br>-Avoir de bonne relation avec les autre entit&eacute;s
				</label>
			</div>
			<div class="col-md-7" id="etre_row">
				<input type="hidden" value="<?php echo sizeof($list_etre)?>" id="size_faire"/>   
                <?php $i=0; if($list_etre){ foreach($list_etre as $elem){$i++;?>
                     <div class="row diplome_row" id="etre_row_<?php echo $i;?>">
                           <div class="col-md-8"><input class="form-control" placeholder="savoir etre" type="text" name="savoir_etre[]" value="<?php echo $elem['libele'];?>" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
                           <?php if($i!=1){ ?>
                           <div class="col-md-2"><button class="form-control btn_close" type="button" onclick="<?php echo "deleteDiv(".$i.",'etre_row')";?>"><i class="la la-minus-circle"></i></button></div>    
                           <?php } ?>
                      </div>
               <?php }
                	}else{
               	?>		
               			<div class="row diplome_row" id="attribution_row">
                           <div class="col-md-8"><input class="form-control" placeholder="formation" type="text" name="savoir_etre[]" value="" data-toggle="tooltip" data-original-title= "Soraty ny mari-pahaizana ambony azonao farany"/></div>
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
	                    <label class="control-label "> Th&egrave;me de formation </label>
	             </div>
	                <div class="col-md-3">
	                  <select class="form-control" placeholder="theme de formation" name="theme_formation" data-placement="top" data-toggle="tooltip" data-original-title="safidio ny lohahevitriny fiofanana tianao arahina" id="theme_formation">
	                  <option  value="0">S&eacute;lectionner</option>
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
		<div class="row">
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
		</div>
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
  <script>
    $("#phone").mask("999 99 999 99");    
     
    $(document).ready(function() {	
		$('#demande_formation').bootstrapValidator({
			onError: function(e) {},
			onSuccess: function(e) {},
			fields : {
				mail: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre e-mail'
						}
					}
				},

				adresse_professionel: {
					validators : {
						notEmpty : {
							message : 'Veuillez remplir votre adresse professionel'
						}
					}
				},
				attribution: {
					validators : {
						notEmpty : {
							message : 'L&acute;attribution est obligatoire'
						}
					}
				},
				tache_journaliere: {
					validators : {
						notEmpty : {
							message : 'La tache journali&egrave;re est obligatoire'
						}
					}
				},
				poste_travail: {
					validators : {
						notEmpty : {
							message : 'Le Postes de travail est obligatoire'
						}
					}
				},

				produit_periodique: {
					validators : {
						notEmpty : {
							message : 'Ce que vous produisez periodiquement est obligatoire'
						}
					}
				},
				formation_academique: {
					validators : {
						notEmpty : {
							message : 'Les formations academiques sont obligatoire'
						}
					}
				}, 

				formation_professionnelle: {
					validators : {
						notEmpty : {
							message : 'Les Formations professionnelles sont obligatoire'
						}
					}
				}, 
				savoir_requi: {
					validators : {
						notEmpty : {
							message : 'Le savoir (connaissances th&eacute;oriques) requis pour la formation  est obligatoire'
						}
					}
				}, 

				savoir_faire: {
					validators : {
						notEmpty : {
							message : 'Le savoir faire (technique) requis pour la formation   est obligatoire'
						}
					}
				}, 
				savoir_etre: {
					validators : {
						notEmpty : {
							message : 'Le savoir etre (qualit&eacute;s) requis pour la fonction  est obligatoire'
						}
					}
				}, 
				theme_formation: {
					validators : {
						notEmpty : {
							message : 'Le Th&egrave;me   est obligatoire'
						}
					}
				}, 
				module_demande: {
					validators : {
						notEmpty : {
							message : 'Le module demand&eacute;  est obligatoire'
						}
					}
				},
				contenu_formation: {
					validators : {
						notEmpty : {
							message : 'Le Contenu est obligatoire'
						}
					}
				}, 
				disponibilite: {
					validators : {
						notEmpty : {
							message : 'Votre disponibilit&eacute; (p&eacute;riode)  est obligatoire'
						}
					}
				}
			}
		});
    });
	$('#deja_participe1').on('click',function(){
		$('#row_anne_module').show();
	});

	$('#deja_participe2').on('click',function(){
		$('#row_anne_module').hide();
	});

	$('#theme_formation').on('change',function(){
		var valeur = $('#theme_formation').val();
        if(valeur!='0'){
       		$.ajax({
                url: base_url() + "json/module_formation/"+valeur,
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
                url: base_url() + "json/contenu_formation/"+valeur,
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

	function base_url(){
        return $('#url_base').val();
     }  
  </script>		