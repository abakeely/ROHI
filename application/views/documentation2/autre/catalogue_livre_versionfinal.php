
<style>
button {
	padding: 20px 70px;
	background-color: #F5EEC9;
	border-radius: 20px;
	border: 1px solid white! important;
}

 </style>
<div style=" background-color:#ededed;">
<br><br>
<center>
 <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="row">
	<div class="col-md-2"><a href="<?php echo base_url();?>documentation/pret_livre/8" title="DIVERS OUVRAGES">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/cat_/1.png"  border="0" height="150" width="150">
		  </a><br><br>
												
	</div>		
	<div class="col-md-2"><a href="<?php echo base_url();?>documentation/pret_livre/3" title="Politique">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/cat_/2.png"  border="0" height="150" width="160">
		  </a><br><br>
				
	</div>
	<div class="col-md-2"><a href="<?php echo base_url();?>documentation/pret_livre/4" title="Politique">
		  <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/cat_/3.png"  border="0" height="150" width="160">
		  </a><br><br>
				
	</div>
	<div class="col-md-2"><a href="<?php echo base_url();?>documentation/pret_livre/2" title="Politique">
		  <img class="img_cat" id="cat_4" src="<?php echo base_url();?>assets/img/img_sad/cat_/4.png"  border="0" height="150" width="160">
		  </a><br><br>
			
	</div>
	<div class="col-md-2"><a href="<?php echo base_url();?>documentation/pret_livre/2" title="Politique">
		  <img class="img_cat" id="cat_4" src="<?php echo base_url();?>assets/img/img_sad/cat_/5.png"  border="0" height="150" width="160">
		  </a><br><br>
			
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/1d.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/1f.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/2d.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/2f.png";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	  var img3 = "<?php echo base_url();?>assets/img/img_sad/3d.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/3f.png"
	  $('#cat_3').on("mouseout",function(){
		  $('#cat_3').attr("src",img33);
	 });
	  $('#cat_3').on("mouseover",function(){
		  $('#cat_3').attr("src",img3);
	   });

	  var img4 = "<?php echo base_url();?>assets/img/img_sad/4d.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/4f.png";
	  $('#cat_4').on("mouseout",function(){
		  $('#cat_4').attr("src",img44);
	 });
	  $('#cat_4').on("mouseover",function(){
		  $('#cat_4').attr("src",img4);
	   });   
</script>