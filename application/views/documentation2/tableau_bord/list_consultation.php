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
	.col-md-12{
		background: #F5F5F5;
	}	
</style>
  <?php //var_dump($list_pret);?>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	  <div class="text-center" >
		<h3><font color="DarkCyan">LISTE DES AGENTS QUI CONSULTE DES OUVRAGES SUR PLACE</font></h43>
	  </div>
	  <div align="right">
		<a href="<?php echo base_url();?>documentation/consultation_surplace" class="btn btn-success">RETOUR</a>
	</div>
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>	
	<br><br>
	<table class="table table-striped table-bordered table-hover" id="table_liste_pret">
	   <thead>
		<tr >
		   <th class="th_livre" style="width:10px"><font size="4"><font face="Times New Roman">Ordre</font></font></th>
      	   <th class="th_livre"><font size="4"><font face="Times New Roman">Type usager</font></font></th>
		   <th class="th_livre"> <font size="4"><font face="Times New Roman">Nom & prenom</font></font></th>
		   <th class="th_livre"> <font size="4"><font face="Times New Roman">cote livre</font></font></th>
		   <th class="th_livre"> <font size="4"><font face="Times New Roman">responsable</font></font></th>
		   <th class="th_livre"> <font size="4"><font face="Times New Roman">date lecture</font></font></th>
		   <th class="th_livre"> <font size="4"><font face="Times New Roman">etablissement</font></font></th>
		</tr>
	   </thead>	
	   <?php 
		$ordre = 0;
		//var_dump($list_pret);
		 foreach ($list_consultation as $consul){
			$ordre++;
	   ?> 
		<tr>
			<td style="width:10px"><?php echo $ordre;?></td>
		    <td><font size="4"><font face="Times New Roman"><?php 
					$libele = $consul->statut;
					if($consul->statut==1)$libele="Agent";
					if($consul->statut==2)$libele="Etudiant";
					if($consul->statut==3)$libele="Autre usager";
					echo $libele;
				?></font></font>
			</td>
			<td ><font size="4"><font face="Times New Roman"><?php echo $consul->nom_prenom?></font></font></td>
			<td ><font size="4"><font face="Times New Roman"><?php echo $consul->cote_livre?></font></font></td>
			<td ><font size="4"><font face="Times New Roman"><?php echo $consul->responsable?></font></font></td>
			<td ><font size="4"><font face="Times New Roman"><?php echo $consul->date_lecture?></font></font></td>
			<td ><font size="4"><font face="Times New Roman"><?php echo $consul->etablissement?></font></font></td>
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