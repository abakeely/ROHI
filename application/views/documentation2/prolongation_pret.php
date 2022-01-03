<script type="text/javascript" src="<?php echo base_url();?>assets/sad/jquery.simplyscroll.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sad/jquery.simplyscroll.css" >

<ul id="scroller">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/prolonger_pret/1.png" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/img_sad/slide/prolonger_pret/2.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/prolonger_pret/3.jpg" alt="" title="" border="0" height="100" width="200">
	
</ul>
 <style>
	
	.th_livre{
		background: Teal
	}	

</style>
  <?php //var_dump($list_pret);?>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
			<div align="right">
				<a href="<?php echo base_url();?>documentation/couverture_pret" class="btn btn-success">RETOUR</a>
			</div>
	  <h3 style="color:Teal; font-size: 1.6em; font-weight: bold; font-family: Arial;">
			<div align="center">LISTES DES EMPRUNTS EN COURS</div></h3>  
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>
	<form action="pret_livre" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
	
	<div class="row">	
		<div style="font-size:90%; float:right;text-align:right;background:#fff; padding:0 0 2px 5px; border:0 solid #eee">
			<h4><u>L&eacute;gende</u></h4>
			<img src="<?php echo base_url();?>assets/img/accepter.jpg" alt="Accepter" title="Accepter" border="0" height="30" width="30"><b> Accept&eacute;</b><br>
			<img src="<?php echo base_url();?>assets/img/refuser.jpg" alt="R&eacute;fus&eacute;" title="R&eacute;fus&eacute;" border="0" height="30" width="30"><b> R&eacute;fus&eacute;</b>
		</div>
		<div class="col-md-12">
	 </div>	
	 
	 </div>
		
	</form>
	<br>
	<table class="table table-striped table-bordered table-hover" id="table_liste_pret">
	   <thead>
		
		<tr >
		   <th class="th_livre">Ordre</th>
      	   <th class="th_livre">Date de pr&ecirc;t</th>
		   <th class="th_livre">Th&ecirc;mes</th>
		   <th class="th_livre">C&ocirc;te</th>
		   <th class="th_livre">Titre</th>
		   <th class="th_livre">Auteur</th>
		   <th class="th_livre">Edition</th>
		   <th class="th_livre">Lieu</th>
		   <th class="th_livre">Langue</th>
		   <th class="th_livre">Date retour document</th>
		   <th class="th_livre">Action</th>
		   <th class="th_livre">Etat</th>
		</tr>
	   </thead>	
	   <?php 
		$ordre = 0;
		 foreach ($list_pret as $pret){
			$ordre++;
	   ?> 
		<tr>
			<td><?php echo $ordre;?></td>
		    <td><?php echo $pret->date_validation?></td>
			<td><?php echo $pret->livre->theme_livre['libele'];?></td>
			<td><?php echo $pret->livre->cote_livre;?></td>
			<td><?php echo $pret->livre->titre_livre;?></td>
			<td><?php echo $pret->livre->auteur_livre['libele'];?></td>
			<td><?php echo $pret->livre->edition_livre;?></td>
			<td><?php echo $pret->livre->lieu_livre['libele'];?></td>
			<td><?php echo $pret->livre->langue_livre['libele'];?></td>
			<td><?php echo $pret->date_retour?></td>
			<td>
			<form action="pret_livre/id" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
				<fieldset>
							<div>
								&nbsp;&nbsp;<button>Prolonger</button>							
							</div>
				</fieldset>
	        </form>
			</td>
			
			<td>			
				<?php if($pret->statut == 0){?>
					<?php if($user['role'] == "biblio"){?>
						<img src="<?php echo base_url();?>assets/img/en_pret.png" alt="Valider"  border="0" height="38" onclick="changeStatut(<?php echo $pret->id;?>,2)">
						<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Refuser"  border="0" height="28" width="28" onclick="changeStatut(<?php echo $pret->id;?>,1)">
					<?php } else {?>
						<img src="<?php echo base_url();?>assets/img/en_pret.png" alt="Valider"  border="0" height="38">
						<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Refuser"  border="0" height="28" width="28">
					<?php } ?>
				<?php } ?>
				<?php if($pret->statut == 1){?>
					<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Valider"  border="0" height="28" width="28">
				<?php } ?>
				<?php if($pret->statut == 2){?>
					<img src="<?php echo base_url();?>assets/img/en_pret.png" alt="Refuser"  border="0" height="30">
				<?php } ?>
			</td>
			
		</tr>
	  <?php }?> 
   </table>		
  </div>
<script>

(function($) {
	$(function() {
		$("#scroller").simplyScroll({direction:'backwards'});
	});
	})(jQuery);
	
 $(document).ready(function() {
  $('#table_liste_pret').dataTable();
	});
</script>		