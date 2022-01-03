<style>
 .pic{
	 width:190px;
	 height:60px;
	 opacity: 1; 
	 filter: alpha(opacity=100);
	  
	}
 .pic:hover { 
	 opacity: 0.3; 
	 filter: 
	 alpha(opacity=30); 
	} 
 </style>
 
 <div align="right">
			<a href="<?php echo base_url();?>documentation/couv_tableau_bord" class="btn btn-success">Retour</a>
</div>

<div style=" background-color:#ededed; text-align">
<div class="row" style ="margin-right: -3px;">

<br><br><br>
 <div class="col-md-12"></div>
	<?php if($user['role'] == "biblio"){?>
	
	<div class="col-md-3" style="background:none;"><a href="#" title="L">
		  						
	</div>	
	<div class="col-md-3" style="background:none;"><a href="<?php echo base_url();?>tableau_bord/bilan" title="BILAN GLOBAL">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_global.jpg" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/bilan" title="BILAN GLOBAL">
						 <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_bilanG.png" >
					</a>
				</div>								
	</div>	
	

	<div class="col-md-3" style="background:none;"><a href="<?php echo base_url();?>tableau_bord/form_bilan_2017" title="BILAN DETAILLES">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_detailles.jpg">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/form_bilan_2017" title="BILAN DETAILLES">
						<img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_bilanD.png">	
					</a>
				</div>
	</div>
<?php }else{?>
	<div class="col-md-3" style="background:none;"><a href="<?php echo base_url();?>tableau_bord/bilan" title="BILAN GLOBAL">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_global.jpg" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/bilan" title="BILAN GLOBALS">
						 <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_bilanG_1.png" >
					</a>
				</div>								
	</div>		

	<div class="col-md-3" style="background:none;"><a href="<?php echo base_url();?>tableau_bord/form_bilan_2017" title="BILAN DETAILLES">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_detailles.jpg">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/form_bilan_2017" title="BILAN DETAILLES">
						<img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_bilanD_1.png">	
					</a>
				</div>
	</div>
	<?php }?>
</center>
</div>
</div>
<script>
  function mouseEntre(i){
	 var height = $('#td_'+i).height();
	 var h3 = height*3;
	 $('#img_'+i).css("position","absolute");
     $('#img_'+i).css("height",h3+"px"); 
	 $('#td_'+i).css("height",height+"px"); 
  }
  function mouseSortie(i){
	 $('#img_'+i).css("position","");
     $('#img_'+i).css("height",""); 
	 $('#td_'+i).css("height",""); 
  }
  
  $(document).ready(function() {
	  $('#table_catalogue_liste').dataTable();
      });
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_global_1.jpg";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_global.jpg";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_global_2.jpg";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bilan_detailles.jpg";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	  
</script>