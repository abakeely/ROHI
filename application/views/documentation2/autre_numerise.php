<script type="text/javascript" src="<?php echo base_url();?>assets/sad/jquery.simplyscroll.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sad/jquery.simplyscroll.css" >

<ul id="scroller">
 	<a href="<?php echo base_url();?>documentation/autre_numerise/1"> <img src="<?php echo base_url();?>assets/img/politique.jpg"  border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/2"> <img src="<?php echo base_url();?>assets/img/infrastructure.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/3"> <img src="<?php echo base_url();?>assets/img/economie.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/4">  <img src="<?php echo base_url();?>assets/img/banque.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/5"> <img src="<?php echo base_url();?>assets/img/fond.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/6"> <img src="<?php echo base_url();?>assets/img/budget.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/7"> <img src="<?php echo base_url();?>assets/img/douane.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/8"> <img src="<?php echo base_url();?>assets/img/droit.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/9"> <img src="<?php echo base_url();?>assets/img/impot.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/10"> <img src="<?php echo base_url();?>assets/img/tresor.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/11"> <img src="<?php echo base_url();?>assets/img/gestion.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/12"> <img src="<?php echo base_url();?>assets/img/sociale.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/13"> <img src="<?php echo base_url();?>assets/img/dictionnaire.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/14"> <img src="<?php echo base_url();?>assets/img/journal.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/15"> <img src="<?php echo base_url();?>assets/img/serie.jpg" border="0" height="100" width="130"></a>
	<a href="<?php echo base_url();?>documentation/autre_numerise/16"> <img src="<?php echo base_url();?>assets/img/divers.png" border="0" height="100" width="130"></a>
</ul>	
<?php 

	$id = "";
	$cote_numerise = "";
	$titre_numerise = "";
	$numerise = "";
	$theme_livre = "";
	$image_url = base_url().'assets/upload_sad/default.jpg';
?>
 <style>
	.th_livre{
		background: Teal
	}	
</style>
<br><br>
<div class="col-md-12">
	<table class="table table-striped table-bordered table-hover" id="table_loi">
	   <thead>
		<tr >
		    <th class="th_livre" style="width:10px"><font size="5"><font face="Times New Roman">Ordre</font></font></th>
			<th class="th_livre" style="width:100px"><font size="5"><font face="Times New Roman">Titres</font></font></th>
			<th class="th_livre" style="width:50px"><font size="5"><font face="Times New Roman">Version pdf</font></font></th>
		</tr>
	   </thead>	
    <?php foreach($autre_numerise_liste as $autre_numerise){?>	
	    
		<tr>
			<td style="width:10px"><font size="5"><font face="Times New Roman"><?php echo $autre_numerise->id;?></font></font></td>
			<td style="width:100px"><font size="5"><font face="Times New Roman"><?php echo $autre_numerise->titre_numerise;?></font></font></td>
			<td style="width:50px"><a href="<?php echo base_url();?>assets/pdf_sad/<?php echo $autre_numerise->numerise;?>" target="_blank"><img src="<?php echo base_url();?>assets/img/lien-icon.jpg" border="0" height="60" width="70"></a></td>
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