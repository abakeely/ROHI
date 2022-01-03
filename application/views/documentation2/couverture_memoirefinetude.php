
<style>
button {
	padding: 20px 70px;
	background-color: #F5EEC9;
	border-radius: 20px;
	border: 1px solid white! important;
}

 </style>
 
<div style=" background-color:#ededed;">
	<div class="text-center" >
		<div align="right">
			<a href="<?php echo base_url();?>documentation/couverture" class="btn btn-success">Retour</a>
		</div>
	</div>
<br><br><br>
	
<center>
 <div class="row">
  <div class="col-md-10">
    <div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-4"><a href="<?php echo base_url();?>documentation/pret_livre/16" title="DIFFERENTS INSTITUTS ET UNIVERSITES">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/u63.png" border="0" height="250" width="280">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/pret_livre/16" title="DIFFERENTS INSTITUTS ET UNIVERSITES">
						 <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/10pp.png">
					</a>
				</div>								
	</div>		
	<div class="col-md-4"><a href="<?php echo base_url();?>documentation/enam" title="RAPPORT DE FORMATION">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/u61.png"  border="0" height="250" width="280">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/enam" title="RAPPORT DE FORMATION">
						<img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/11pp.png">							
				</div>
	</div>
	<div class="col-md-2"></div>
	</div>
 </div>
 </div>
  </center>
 </div>
<script>
  
  function mouseEntre(i){
	 var height = $('#td_'+i).height();
	 var h3 = height*3;
	 $('#img_'+i).css("position","absolute");
     $('#img_'+i).css("height",h3+"px"); 
	 $('#td_'+i).css("height",height+"px"); 
	 //alert(h3);
  }
  function mouseSortie(i){
	 $('#img_'+i).css("position","");
     $('#img_'+i).css("height",""); 
	 $('#td_'+i).css("height",""); 
  }
  
  $(document).ready(function() {
	  $('#table_catalogue_liste').dataTable();
      });
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/u63_.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/u63.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/u61.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/u61_.png";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	  
</script>