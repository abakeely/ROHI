<br><br>
 <style>
	.th_livre{
		background: Teal
	}	

</style>
	<div align="right">
			<a href="<?php echo base_url();?>documentation/couverture_besoin" class="btn btn-success">Retour</a>
	</div>
  <?php ?>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	  <h3 style="color:Teal; font-size: 1.6em; font-weight: bold; font-family: Arial;">
			<div align="center">LISTE DES  BESOINS SPECIFIQUES</div></h3>  
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>
	<div class="row">	
		<div style="font-size:90%; float:right;text-align:right;background:#fff; padding:0 0 2px 5px; border:0 solid #eee">
			<h5><u>L&eacute;gende</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
			<img src="<?php echo base_url();?>assets/img/accepter.jpg"  border="0" height="30" width="30"> Accepter<br>
			<img src="<?php echo base_url();?>assets/img/refuser.jpg"  border="0" height="30" width="30">R&eacute;fuser&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  
		</div>
		<div class="col-md-12">
	 </div>
	 </div>
	<br>
	<table class="table table-striped table-bordered table-hover" id="table_liste_besoin">
	   <thead>
		
		<tr >
			<th class="th_livre">Ordre</th>
		    <th class="th_livre">Date de demande</th>
			<?php if($user['role'] == "biblio"){?>
			<th class="th_livre">Demandeur</th>
			<?php }?>
			<th class="th_livre">Description</th>
			<th class="th_livre">Th&ecirc;mes</th>
			<th class="th_livre">Titres</th>
			<th class="th_livre">Auteurs</th>
			<th class="th_livre">Edition</th>
			<th class="th_livre">Lieu</th>
			<th class="th_livre">Langue</th>
			<th class="th_livre">Action</th>
			<?php if($user['role'] == "biblio"){?>
		    <th class="th_livre">cv</th>
		    <?php }?>
		</tr>
	   </thead>	
	   <?php 
		$ordre = 0;
		 foreach ($liste_besoin as $besoin){
			$ordre++;
	   ?> 
		<tr>
			<td><?php echo $ordre;?></td>
		    <td><?php echo $besoin->date_demande_besoin;?></td>
			<?php if($user['role'] == "biblio"){?>
		    <td><?php echo $besoin->candidat?$besoin->candidat->matricule.'-'.$besoin->candidat->nom.' '.$besoin->candidat->prenom:'';?></td>
		    <?php }?>
			<td><?php echo $besoin->description_besoin;?></td>
			<td><?php echo $besoin->theme_besoin;?></td>
			<td><?php echo $besoin->titre_besoin;?></td>
			<td><?php echo $besoin->auteur_besoin;?></td>
			<td><?php echo $besoin->edition_besoin;?></td>
			<td><?php echo $besoin->lieu_besoin;?></td>
			<td><?php echo $besoin->langue_besoin;?></td>
			<td>			
				<?php if($besoin->statut == 0){?>
					<?php if($user['role'] == "biblio"){?>
						<img src="<?php echo base_url();?>assets/img/accepter.jpg"   border="0" height="30" onclick="changeStatut(<?php echo $besoin->id;?>,1)">
						<img src="<?php echo base_url();?>assets/img/refuser.jpg" a  border="0" height="30" width="30" onclick="changeStatut(<?php echo $besoin->id;?>,2)">
					<?php } else {?>
						<img src="<?php echo base_url();?>assets/img/refuser.jpg"   border="0" height="30">
						<img src="<?php echo base_url();?>assets/img/accepter.jpg"   border="0" height="30" width="30">
					<?php } ?>
				<?php } ?>
				<?php if($besoin->statut == 1){?>
					<img src="<?php echo base_url();?>assets/img/accepter.jpg"   border="0" height="30" width="30">
				<?php } ?>
				<?php if($besoin->statut == 2){?>
					<img src="<?php echo base_url();?>assets/img/refuser.jpg" a  border="0" height="30">
				<?php } ?>
			</td>
			<?php if($user['role'] == "biblio"){?>
			<td><a class="color2" href="<?php echo base_url();?>cv/fpdf_cv/<?php echo $besoin->candidat->id?>">lien CV</a></td><?php }?>
		  </tr>
	   <?php } ?>
   </table>		
  </div>
<script>
 function changeStatut(id,statut){
	 var title = $('#title_'+id).text();
	  var cote = $('#cote_'+id).text();
	  var msg = "";
	  if(statut==1)
		  msg = "Demande accepter";
	   else
		  msg = "Demande r&eacute;fuser";
	  bootbox.confirm(msg,
				function(result) { 
						if (result === false) {
											//Do nothing
						} else {
							document.location.href = "<?php echo base_url();?>documentation/action_besoin/"+statut+"/"+id;	
						}
				}
		);
 }
 $(document).ready(function() {
  $('#table_liste_besoin').dataTable();
	});
</script>		