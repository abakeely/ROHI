<script type="text/javascript" src="<?php echo base_url();?>assets/sad/jquery.simplyscroll.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sad/jquery.simplyscroll.css" >

<ul id="scroller">
	<img src="<?php echo base_url();?>assets/img/slide/resti/1.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/2.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/resti/3.jpg" alt="" title="" border="0" height="100" width="200">   
    <img src="<?php echo base_url();?>assets/img/slide/resti/4.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/5.jpg" alt="" title="" border="0" height="100" width="200">
	
	<img src="<?php echo base_url();?>assets/img/slide/resti/6.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/7.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/resti/8.jpg" alt="" title="" border="0" height="100" width="200">   
    <img src="<?php echo base_url();?>assets/img/slide/resti/9.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/10.jpg" alt="" title="" border="0" height="100" width="200">
	
	<img src="<?php echo base_url();?>assets/img/slide/resti/11.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/12.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/resti/13.jpg" alt="" title="" border="0" height="100" width="200">   
    <img src="<?php echo base_url();?>assets/img/slide/resti/14.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/15.jpg" alt="" title="" border="0" height="100" width="200">
	
	<img src="<?php echo base_url();?>assets/img/slide/resti/16.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/17.jpg" alt="" title="" border="0" height="100" width="200">
	<img src="<?php echo base_url();?>assets/img/slide/resti/18.jpg" alt="" title="" border="0" height="100" width="200">   
    <img src="<?php echo base_url();?>assets/img/slide/resti/19.jpg" alt="" title="" border="0" height="100" width="200">
    <img src="<?php echo base_url();?>assets/img/slide/resti/20.jpg" alt="" title="" border="0" height="100" width="200">
	
</ul> 
 
 <?php 
	$id = "";
	$date_restitution= "";
	$heure_restitution = "";
	$lieu_restitution1 = "";
	$nom_prenom_restitution = "";
	
	$fonction_restitution = "";
	$intitule_restitution = "";
	$lieu_restitution2 = "";
	$periode_restitution = "";
	
	$lien_restitution = "";
	$lien = "";
	
?>
 <style>
	.th_livre{
		background: #00CED1
	}
	.text_1 {
	  text-decoration : blink;
	  color:#FF4367;
	}
</style>
 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	   <div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/catalogue" method="POST">		
		</form>
	</div>
	<h2 style="color:#008080; font-size: 2em; font-weight: bold; font-family: Algerian;">
	<div align="right">
		<a href="<?php echo base_url();?>documentation/planning_restitution" class="btn btn-info">RETOUR</a>
	</div>
        <div align="center"><font color="#00CED1">PLANNING DE RESTITUTION</font></div></h2>
	<br>
	<MARQUEE scrollamount=2> <font color="#4682B4"; size="4"><B>Restitution : </B></font> <font color="D2B48C"; size="4">du 17 Mai 2017 à 10h <font color="008080"; size="4">Immeuble Finance Antaninarenina <font color="#D8BFD8"; size="4">Porte 401 </font><font color="FF6347"; size="4">sur le thème : Seminaire sur la viabilité de la Dette </font><font color="#6A5ACD"; size="4">Presenter par RAKOTONINDRAINY Zoely Narindra </font></MARQUEE>
	<table class="table table-striped table-bordered table-hover" id="table_planning">
	   <thead>
		<tr >
			<th class="th_livre" style="width:20px"><font size="3"><font face="Times New Roman">Date restitution</font></font></th>
			<th class="th_livre" style="width:10px" ><font size="3"><font face="Times New Roman">Heure</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">Lieu de la restitution</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">Nom et pr&eacute;noms</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">Fonction</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">Intitul&eacute; de la formation</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">Lieu de la formation</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">P&eacute;riode</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">PDF</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">SLIDE</font></font></th>
		</tr>
	   </thead>	
		<?php foreach($liste as $planning){?>	
	    
		<tr>
			<!--<td style="width:10px"><?php echo $planning->id;?></td>-->

		    <td style="font-size:17px"><?php echo $planning->date_restitution;?></td>
			<td style="font-size:17px"><?php echo $planning->heure_restitution;?></td>
			<td style="font-size:17px"><?php echo $planning->lieu_restitution1;?></td>
			<td style="font-size:17px"><?php echo $planning->nom_prenom_restitution;?></td>
			
			<td style="font-size:17px"><?php echo $planning->fonction_restitution;?></font></font></td>
			<td style="font-size:17px"><?php echo $planning->intitule_restitution;?></font></font></td>
			<td style="font-size:17px"><?php echo $planning->lieu_restitution2;?></font></font></td>
			<td style="font-size:17px"><?php echo $planning->periode_restitution;?></font></font></td>
			
			<td> <a href="<?php echo base_url();?>assets/pdf_sad/restitution/<?php echo $planning->lien_restitution;?>" target="_blank"><img src="<?php echo base_url();?>assets/img/pdf.png" title="version pdf" border="0" height="60" width="50"></a></td>
			<td> <a href="<?php echo base_url();?>assets/pdf_sad/slide/<?php echo $planning->lien;?>" target="_blank"><img src="<?php echo base_url();?>assets/img/powerpoint.png" title="Slide"border="0" height="58" width="50"></a></td>
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
       $('#table_planning').dataTable({
	   "ordering" : false
	   });	
	});	
  </script>		
