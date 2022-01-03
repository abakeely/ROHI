
 <?php 
	$id = "";
	$cote_enam= "";
	$titre_enam = "";
	$auteur_enam = "";
	
	$edition_enam = "";
	$lieu_enam = "";
	$langue_enam = "";

	$format_enam = "";
	$nombre_page_enam = "";
	$nombre_explaire_enam = "";

	
	//$lien_enam = "";
	
?>
 <style>
	.th_livre{
		background: Teal
	}
	.text_1 {
	  text-decoration : blink;
	  color:#FF4367;
	}
</style>
	<div class="text-center" >
		<div align="right">
			<a href="<?php echo base_url();?>documentation/couverture_memoirefinetude" class="btn btn-success">Retour</a>
		</div>
	</div>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>
	<h3 style="color:#008080; font-size: 1.9em; font-weight: bold; font-family: Algerian;">
        <div align="center">FORMATION ENAM</div></h3>
	<br>
	<table class="table table-striped table-bordered table-hover" id="table_enam">
	   <thead>
		<tr >
			<!--<th class="th_livre" style="width:10px" >Ordre</th>-->
			<th class="th_livre" style="width:100px"><font size="4"><font face="Times New Roman">Cote</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Titre</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Auteur</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Edition</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Lieu</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Langue</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Format</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Nombre page</font></font></th>
			<th class="th_livre"><font size="4"><font face="Times New Roman">Nombre explaire</font></font></th>
		</tr>
	   </thead>	
		<?php foreach($liste as $enam){?>	
	    
		<tr>
			<!--<td style="width:10px"><?php echo $planning->id;?></td>	-->

		    <td style="width:100px"><font size="4"><font face="Times New Roman"><?php echo $enam->cote_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->titre_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->auteur_enam;?></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->edition_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->lieu_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->langue_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->format_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->nombre_page_enam;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $enam->nombre_explaire_enam;?></font></font></td>
			
			<!--<td> <a href="<?php echo base_url();?>assets/pdf_sad/<?php echo $enam->lien_enam;?>" target="_blank"><img src="<?php echo base_url();?>assets/img/lien-icon.jpg" border="0" height="60" width="70"></a></td>-->
		</tr>
	<?php } ?>
   </table>		
  </div>
  <script>
    $(document).ready(function() {
        $('#table_enam').dataTable();
	});	
  </script>		
