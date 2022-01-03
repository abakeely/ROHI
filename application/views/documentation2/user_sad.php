<br><br>

 <style>
	.th_livre{
		background: Teal;
	}	
</style>
<script>
 setTimeout(function() { location.reload() },900000);
 function rechercher(){
	var dateDeb = document.getElementById("dateDeb").value;
	var dateFin = document.getElementById("dateFin").value;
	document.location.href = "<?php echo base_url()?>documentation/list_user_sad/"+dateDeb+"/"+dateFin;
 }
 $(document).ready(function() {
 $("#dateDeb").datepicker({
		 language: "fr",
		 autoclose: true,
		 todayHighlight: true,
		 format: "yyyy-mm-dd"
 });
 $("#dateFin").datepicker({
		 language: "fr",
		 autoclose: true,
		 todayHighlight: true,
		 format: "yyyy-mm-dd"
 });
 });
</script>
  <?php //var_dump($list_pret);?>
 <div id="content-wrap" class="row"> 
	
	<div class="col-md-12">
			<h3 style="color:Teal; font-size: 1.6em; font-weight: bold; font-family: Arial;">
			<div align="center">Listes des Agents connéctés A SAD</div></h3>  	
	<div align="right">
		<a href="<?php echo base_url();?>documentation/tableau_bord" class="btn btn-success">RETOUR</a>
	</div>
		
	<br>
	<div  class="row">
		<form action="#" method="POST" style="height: 53px; padding: 9px;">
			<div class="col-md-3">
					<input type="text" id="dateDeb" class="form-control" placeholder="Date D&eacute;ebut" data-placement="top">
					 <span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
			</div>
			<div class="col-md-3">
					<input type="text" id="dateFin" class="form-control datepicker" placeholder="Date Fin" data-placement="top">
					<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
			</div>
			<div class="col-md-2">
					<button type="button" class="form-control" onclick="rechercher()">AFFICHER</button>
			</div>
		</form>
	</div>
	<br><br>			
	<table class="table table-striped table-bordered table-hover" id="table_liste_pret">
	   <thead>
		<tr>
			<th style="width:5px"><font size="2"><font face="Times New Roman">Ordre</font></font></th>
			<th style="width:15px"><font size="2"><font face="Times New Roman">Date de connexion</font></font></th>
			<th style="width:5px"><font size="2"><font face="Times New Roman">IM</font></font></th>
			<th><font size="2"><font face="Times New Roman"> Nom et Pr&eacute;noms</font></font></th>
			<th><font size="2"><font face="Times New Roman">D&eacute;partement</font></font></th>
			<th><font size="2"><font face="Times New Roman">Région</font></font></th>
			<th><font size="2"><font face="Times New Roman">Localite de service</font></font></th>
		</tr>
	   </thead>	
	   <?php 
		$ordre = 0;
		//var_dump($list_pret);
		 foreach ($list_user as $user){
			$ordre++;
	   ?> 
		<tr>
			<td><?php echo $ordre;?></td>
			<td><?php echo $user['date_last_connection'];?></td>
			<td><?php echo $user['im'];?></td>
			<td><?php echo $user['nom']." ".$user['prenom'];?></td>
			<td><?php echo $user['departement'];?></td>
			<td><?php echo $user['region'];?></td>
			<td><?php echo $user['lacalite_service'];?></td>
		  </tr>
	   <?php } ?>
   </table>		
  </div>
<script>
 $(document).ready(function() {
  $('#table_liste_pret').dataTable();
	});
</script>		