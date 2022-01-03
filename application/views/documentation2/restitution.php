<div class="row" >
<center>
<div align="right">
		<a href="<?php echo base_url();?>documentation/planning_restitution" class="btn btn-success">Retour</a>
</div>
<div style=" background-color:#ededed;">
<div id="carousel-documentaion1" class="carousel slide" data-ride="carousel">
	
	<div  class="a-section as-title-block">
		<h2 class="as-title-block-left" role="heading">
			<span class="a-color-base"> S&eacute;lection des photos de restitution <?php echo $restitution_annee;?> </span>
		</h2>
		
	</div>
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
		<?php	$i=0; foreach($liste_groupe as $group){ ;?>
			<li data-target="#carousel-documentaion1" data-slide-to="<?php echo $i;?>" class="<?php echo $i==0?"active":"";?>"></li>
		<?php $i++;}?>
	  </ol>

	  <!-- Wrapper for slides -->
	  
	<div class="carousel-inner" role="listbox" style="text-align: center;">
	   <?php	$i=0; foreach($liste_groupe as $group){ ;?>
		<div class="item <?php echo $i==0?"active":"";?>">
			<?php foreach($group as $row){ ;?>
			<li class=" " data-sgproduct="{"asin":"B01I5KJHSM"}" aria-setsize="18" aria-posinset="14" aria-hidden="false" role="listitem" style="display: inline-block;">
			  <a href="<?php echo base_url();?>documentation/detail_restitution_image/<?php echo $row->restitution_id;?>">
				<img class="style_prevu_kit" src="<?php echo base_url();?>assets/img/restitution/image/<?php echo $row->restitution_icone_image;?>"  border="0" height="240" width="240">
				<!--<img  class="style_prevu_kit"src="<?php echo base_url();?>assets/img/restitution/video/<?php echo $row->restitution_icone_video;?>"  border="0" height="240" width="240">-->
			  </a>	
			</li>
			<?php }?>
		 </div>
		<?php $i++;}?>
	</div>

	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-documentaion1" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-documentaion1" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>
	<br>
	
<div style=" background-color:#CECECE;">
  <h2 class="as-title-block-left" role="heading">
		<span class="a-color-base"> S&eacute;lection des videos de restitution <?php echo $restitution_annee;?></span>
  </h2>
	<div id="carousel-documentaion2" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		<ol class="carousel-indicators">
			<?php	$i=0; foreach($liste_groupe as $group){ ;?>
				<li data-target="#carousel-documentaion1" data-slide-to="<?php echo $i;?>" class="<?php echo $i==0?"active":"";?>"></li>
			<?php $i++;}?>
	    </ol>

		  <!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox" style="text-align: center;">
		   <?php	$i=0; foreach($liste_groupe as $group){ ;?>
			<div class="item <?php echo $i==0?"active":"";?>">
				<?php foreach($group as $row){ ;?>
				<li class=" " data-sgproduct="{"asin":"B01I5KJHSM"}" aria-setsize="18" aria-posinset="14" aria-hidden="false" role="listitem" style="display: inline-block;">
				 <a href="<?php echo base_url();?>documentation/detail_restitution_video/<?php echo $row->restitution_id;?>">
					<img  class="style_prevu_kit"src="<?php echo base_url();?>assets/img/restitution/video/<?php echo $row->restitution_icone_video;?>"  border="0" height="240" width="240">
				 </a>
				</li>
				<?php }?>
			</div>
			<?php $i++;}?>
		</div>
		
		  <!-- Controls -->
		<a class="left carousel-control" href="#carousel-documentaion2" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-documentaion2" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
    </div><br><br>
</div>
</div>	
</center>
</div>
<style>
.carousel-control.left, .carousel-control.right {
    background-image: none
}
</style>
