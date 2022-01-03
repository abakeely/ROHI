<br><br>
 <!--<style>
 	.modal-header .modal-footer{
 		background : #91c149;
 	}
 </style>-->
 <style>
	.th_livre{
		background: Teal
	}	
</style>
  <?php //var_dump($list_pret);?>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	  <div class="text-center" >
		<h4><font color="DarkCyan"><u>LISTE DE VOS EMPRUNTS</u></font></h4>
	  </div>
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>	
	<div class="row">	
		<div style="font-size:90%; float:right;text-align:right;background:#fff; padding:0 0 2px 5px; border:0 solid #eee">
			<h5><u>L&eacute;gende</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
			<img src="<?php echo base_url();?>assets/img/disponible.png" alt="Politique" title="Politique" border="0" height="30" width="30"> Valider<br>
			<img src="<?php echo base_url();?>assets/img/en_pret.png" alt="Politique" title="Politique" border="0" height="40" width="40">&nbsp;&nbsp; En pr&ecirc;t 
		</div>
		<div class="col-md-12">
	 </div>
	 </div>			
	<br>
	<table class="table table-striped table-bordered table-hover" id="table_liste_pret">
	   <thead>
		
		<tr>
		   <th class="th_livre">Ordre</th>
      	   <th class="th_livre">Date</th>
		   <th class="th_livre">sujet</th>
		   <th class="th_livre">message</th>
		   <th class="th_livre">Etat</th>
		</tr>
	   </thead>	
	   <?php 
		$ordre = 0;
		//var_dump($list_pret);
		 foreach ($list_notification as $notif){
			$ordre++;
	   ?> 
		<tr>
			<td><?php echo $ordre;?></td>
		    <td><?php echo $notif['date'];?></td>
			<td><?php echo $notif['sujet'];?></td>
			<td><?php echo $notif['message'];?></td>
			<td><?php echo $notif['etat']?></td>
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
		  msg = "Votre demande a ete pris en compte, vous pouvez recperer le document aupres de la sad : "+cote+" : "+title +" disponible ?";
	   else
		  msg = "Voulez-vous rendre le livre : "+cote+" : "+title +" en pret ?";
	  bootbox.confirm(msg,
				function(result) { 
						if (result === false) {
											//Do nothing
						} else {
							document.location.href = "<?php echo base_url();?>documentation/action_pret/"+statut+"/"+id;	
						}
				}
		);
 }
 
 $(document).ready(function() {
  $('#table_liste_pret').dataTable();
	});
</script>		