<script type="text/javascript" src="<?php echo base_url();?>assets/sad/jquery.simplyscroll.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sad/jquery.simplyscroll.css" >


<ul id="scroller">
	<img src="<?php echo base_url();?>assets/img/slide/texte/10.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/texte/9.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/texte/8.jpg" alt="" title="" border="0" height="100" width="200">   
    <img src="<?php echo base_url();?>assets/img/slide/texte/7.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/texte/6.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/texte/5.jpg" alt="" title="" border="0" height="100" width="200">
	
	<img src="<?php echo base_url();?>assets/img/slide/texte/4.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/texte/3.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/texte/2.jpg" alt="" title="" border="0" height="100" width="200">   
    <img src="<?php echo base_url();?>assets/img/slide/texte/1.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/texte/11.jpg" alt="" title="" border="0" height="100" width="200">
</ul>



<?php 
	$id = "";
	$type_texte= "";
	$sigle = "";
	$date = "";
	$intitule = "";
	$lien = "";
	
	$image_url = base_url().'assets/upload_sad/default.jpg';
?>
 <style>
	.th_livre{
		background: Teal
	}
</style>
<br>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	  <div class="text-center" >
		<h4><font color="DarkCyan">
		<a href="<?php echo base_url();?>documentation/texte_reglementaire/1" class="btn btn-success" border="0">&nbsp;&nbsp;LOIS</a>&nbsp;&nbsp;
		<a href="<?php echo base_url();?>documentation/texte_reglementaire/2" class="btn btn-success" border="0">&nbsp;&nbsp;ORDONNANCES</a>&nbsp;&nbsp;
		<a href="<?php echo base_url();?>documentation/texte_reglementaire/3" class="btn btn-success" border="0">&nbsp;&nbsp;D&Eacute;CRETS</a>&nbsp;&nbsp;
		<a href="<?php echo base_url();?>documentation/texte_reglementaire/4" class="btn btn-success" border="0">&nbsp;&nbsp;ARR&Ecirc;t&Eacute;S</a>&nbsp;&nbsp;
		<a href="<?php echo base_url();?>documentation/texte_reglementaire/5" class="btn btn-success" border="0">&nbsp;&nbsp;CIRCULAIRES</a>
		<a href="<?php echo base_url();?>documentation/texte_reglementaire/6" class="btn btn-success" border="0">&nbsp;&nbsp;NOTES</a>
		</font></h4>
			<div align="right">
				<a href="<?php echo base_url();?>documentation/couverture" class="btn btn-success">RETOUR</a>
			</div>
	  </div>
	<div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>
	<br>
	<table class="table table-striped table-bordered table-hover" id="table_loi">
	   <thead>
		<tr >
		    <th class="th_livre" style="width:10px">Ordre</th>
			<th class="th_livre" style="width:10px">Acte</th>
			<th class="th_livre" style="width:50px">Sigle</th>
			<th class="th_livre" style="width:10px">Date</th>
			<th class="th_livre" style="width:200px">Intitule</th>
			<th class="th_livre" style="width:10px">T&eacute;l&eacute;charger</th>
		</tr>
	   </thead>	
    <?php foreach($liste_texte as $texte_reglementaire){?>	
	    
		<tr>
			<td style="width:10px"><font size="4"><font face="Times New Roman"><?php echo $texte_reglementaire->id;?></font></font></td>
		    <td style="width:10px"><font size="4"><font face="Times New Roman"><?php echo $texte_reglementaire->acte;?></font></font></td>
			<td style="width:50px"><font size="4"><font face="Times New Roman"><?php echo $texte_reglementaire->sigle;?></font></font></td>
			<td style="width:10px"><font size="4"><font face="Times New Roman"><?php echo $texte_reglementaire->date;?></font></font></td>
			<td style="width:200px"><font size="4"><font face="Times New Roman"><?php echo $texte_reglementaire->intitule;?></font></font></td>
			<td style="width:10px"> <a href="<?php echo base_url();?>assets/pdf_sad/<?php echo $texte_reglementaire->contennue;?>" target="_blank"><img src="<?php echo base_url();?>assets/img/lien-icon.png" border="0" height="60" width="70"></a></td>
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
