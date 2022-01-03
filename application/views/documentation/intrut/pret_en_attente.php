<script type="text/javascript" src="<?php echo base_url();?>assets/sad/jquery.simplyscroll.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sad/jquery.simplyscroll.css" >

<ul id="scroller">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/bleu_final_2.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/bleu_final_1.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/orange_final_2.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/orange_final_1.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/rouge_final_2.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/rouge_final_1.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/vert_final_2.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/vert_final_1.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/img_sad/slide/pret/legend.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="#" alt="" title="" border="0" height="100" width="200">

	
</ul> 


<?php 
	$id = "";
	$livre_id= "";
	$user_id = "";
	$statut= "";
	$date_reservation = "";
	$date_modification = "";
	$date_validation = "";
	$date_retour = "";
	$date_retour2 = "";
	$date_email = "";

?>
 <style>
	.th_livre{
		background: Teal;
	}	
	.to_click{
		cursor:pointer
	}
</style><br>
	<div align="right">
			<a href="<?php echo base_url();?>documentation/liste_pret" class="btn btn-success">Retour</a>
	</div>
  <?php //var_dump($list_pret);?>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
					
		<div class="text-center" >
			<h4><font color="DarkCyan">
			<a href="<?php echo base_url();?>documentation/pret_en_pret" class="btn btn-success" border="0"><font color="black"><b>&nbsp;&nbsp;LISTE DES EMPRUNTS</b></font></a>&nbsp;&nbsp;
			<a href="<?php echo base_url();?>documentation/pret_en_attente" class="btn btn-success" border="0"><font color="black"><b>&nbsp;&nbsp;LISTE D'ATTENTE</b></font></a>&nbsp;&nbsp;
			
		</font></h4>
		
	  </div>

		
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>	
	<div class="row">	
		<div style="font-size:90%; float:right;text-align:right;background:#fff; padding:0 0 2px 5px; border:0 solid #eee">
			<h5><u>L&eacute;gende</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
			<img src="<?php echo base_url();?>assets/img/disponible.png"  border="0" height="30" width="30">Valider&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="<?php echo base_url();?>assets/img/en_pret.png"  border="0" height="42" width="42">En pr&ecirc;t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
			<img src="<?php echo base_url();?>assets/img/email.png"  border="0" height="35" width="35">Pret  par Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="<?php echo base_url();?>assets/img/retour2.png"  border="0" height="30" width="30">&nbsp;Rendu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		</div>
		<div class="col-md-12"> </div>
	 </div>	
	<table class="table table-striped table-bordered table-hover" id="table_loi">
	   <thead>
		<tr >
		  <th class="th_livre" style="width:10px" >Ordre</th>
      	   <th class="th_livre">Date de pr&ecirc;t</th>
      	   <?php if($user['role'] == "biblio"){?>
      	   <th class="th_livre">Demandeur</th>
      	   <?php }?>
		   <th class="th_livre">Th&ecirc;mes</th>
		   <th class="th_livre">C&ocirc;te</th>
		   <th class="th_livre">Titre</th>
		   <th class="th_livre">Auteur</th>
		   <th class="th_livre">Edition</th>
		   <?php if($user['role'] != "biblio"){?>
		   <th class="th_livre">Lieu</th>
		   <?php }?>
      	   <th class="th_livre">Langue</th>
		   <th class="th_livre">Date validation</th>
		   <th class="th_livre">Date retour</th>
		   <?php if($user['role'] == "biblio"){?>
		   <th class="th_livre">Date r&eacute;ception SAD</th>
		   <!--<th class="th_livre">Date Email</th>-->
		   <?php }?>
		   <th class="th_livre">Etat</th>
		   <?php if($user['role'] == "biblio"){?>
		   <th class="th_livre">cv</th>
		   <?php }?>
		   
		</tr>
	   </thead>	

		<?php 
		$ordre = 0;
		 foreach ($list_pret as $pret_en_attente){
			$ordre++;
	   ?> 
		<tr>
			<td style="width:10px"><font size="4"><font face="Times New Roman"><?php echo $ordre;?></font></font></td>
		    <td><font size="3"><font face="Times New Roman"><?php echo $pret_en_attente->date_reservation;?></font></font></td>
		    <?php if($user['role'] == "biblio"){?>
		    <td><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->candidat?$pret_en_attente->candidat->matricule.'-'.$pret_en_attente->candidat->nom.' '.$pret_en_attente->candidat->prenom:'';?></font></font></td>
		    <?php }?>
			<td><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->livre->theme_livre['libele'];?></font></font></td>
			<td id="cote_<?php echo $pret_en_attente->id;?>"><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->livre->cote_livre;?></font></font></td>
			<td id="title_<?php echo $pret_en_attente->id;?>"><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->livre->titre_livre;?></font></font></td>
			<td ><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->livre->auteur_livre['libele'];?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->livre->edition_livre;?></font></font></td>
			 <?php if($user['role'] != "biblio"){?>
			<td><font size="4"><font face="Times New Roman"><?php echo $pret_en_attente->livre->lieu_livre['libele'];?></font></font></td>
			 <?php }?>
			<td><font size="3"><font face="Times New Roman"><?php echo $pret_en_attente->livre->langue_livre['libele'];?></font></font></td>
			<td><font size="3"><font face="Times New Roman"><?php echo $pret_en_attente->date_validation?></font></font></td>
			<td><font size="3"><font face="Times New Roman"><?php echo $pret_en_attente->date_retour?></font></font></td>
			<?php if($user['role'] == "biblio"){?>
			<td><font size="3"><font face="Times New Roman"><?php echo $pret_en_attente->date_retour2?></font></font></td>
			<!--<td><//?php echo $pret_en_attente->date_email?></td>-->
			<?php }?>
			<td>			
				<?php if($pret_en_attente->statut == 0){?>
					<?php if($user['role'] == "biblio"){?>
						<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Disponible" class="to_click" border="0" height="30" onclick="changeStatut(<?php echo $pret_en_attente->id;?>,1)">
						<img src="<?php echo base_url();?>assets/img/en_pret_en_attente.png" alt=" En pr&ecirc;t"  class="to_click" border="0" height="38" width="38" onclick="changeStatut(<?php echo $pret_en_attente->id;?>,2)">
						<img src="<?php echo base_url();?>assets/img/email.png" title="Livre envoie par email" class="to_click"  border="0" height="30" onclick="changeStatut(<?php echo $pret_en_attente->id;?>,4)">
						<img src="<?php echo base_url();?>assets/img/retour2.png" alt="Rendu"  border="0" height="28" width="28">
						
					<?php } else {?>
						<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Disponible"  border="0" height="28" width="28">
						<img src="<?php echo base_url();?>assets/img/en_pret_en_attente.png" alt="En pr&ecirc;t"  border="0" height="40" width="40">
						<img src="<?php echo base_url();?>assets/img/retour2.png" alt="Rendu"  border="0" height="28" width="28">
						
					<?php } ?>
				<?php } ?>
				<?php if($pret_en_attente->statut == 1){?>
				<?php if($user['role'] == "biblio"){?>
					<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Disponible"  border="0" height="28" width="28">
					<img src="<?php echo base_url();?>assets/img/retour2.png" class="to_click" alt="Rendu"  border="0"  height="28" onclick="changeStatut(<?php echo $pret_en_attente->id;?>,3)">
					<?php } else {?>
						<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Disponible"  border="0" height="30">
						<img src="<?php echo base_url();?>assets/img/retour2.png" alt="Rendu"  border="0" height="38" width="38">
					<?php } ?>
					
				<?php } ?>
				<?php if($pret_en_attente->statut == 2){?>
					<img src="<?php echo base_url();?>assets/img/en_pret_en_attente.png" title="En pr&ecirc;t"  class="to_click" border="0" height="30" onclick="changeStatut(<?php echo $pret_en_attente->id;?>,1)">
				<?php } ?>
				<?php if($pret_en_attente->statut == 3){?>
					<img src="<?php echo base_url();?>assets/img/retour2.png" title="Rendu"  border="0" height="28">
				<?php } ?>
				<?php if($pret_en_attente->statut == 4){?>
					<img src="<?php echo base_url();?>assets/img/email.png" title="Livre envoie par email" border="0" height="28">
				<?php } ?>
				
				
				
			</td>
		  <?php if($user['role'] == "biblio"){?>
			<td><a class="color2" href="<?php echo base_url();?>cv/fpdf_cv/<?php echo $pret_en_attente->candidat->id?>"><img src="<?php echo base_url();?>assets/img/cv.png" border="0" height="53" width="60"></a></td><?php }?>
		  </tr>
	   <?php } ?>
   </table>			
  </div>
  <script>

	(function($) {
	$(function() {
		$("#scroller").simplyScroll({direction:'backwards'});
	});
	})(jQuery);

    $(document).ready(function() {
        $('#table_loi').dataTable();
	});	
  </script>		
