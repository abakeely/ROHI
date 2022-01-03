
<style>
button {
	padding: 20px 70px;
	background-color: #F5EEC9;
	border-radius: 20px;
	border: 1px solid white! important;
}

 </style>
<div style=" background-color:#ededed;">
<br><br><br><br><br><br>
<center>
 <div class="row" >
  <div class="col-md-1"></div>
  <div class="col-md-12">
    <div class="row">
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/reglement" title="REGLEMENT INTERIEUR">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/1a.png"  border="0" height="200" width="200">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/reglement" title="REGLEMENT INTERIEUR">
						 <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/1couv_info.png"  border="0" height="50" width="180">
					</a>
				</div>								
	</div>		
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/guide" title="GUIDE DU LECTEUR">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/2a.png"  border="0" height="200" width="200">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/guide" title="GUIDE DU LECTEUR">
					<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/2couv_info.png"  border="0" height="50" width="180">							
				</div>
	</div>
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/plan_d_acces" title="PLAN D'ACCES">
		  <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/3A.png"  border="0" height="200" width="200">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/plan_d_acces" title="PLAN D'ACCES">
					<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/3couv_info.png"  border="0" height="50" width="180">							
				</div>
	</div>
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/personnel" title="PERSONNEL">
		  <img class="img_cat" id="cat_4" src="<?php echo base_url();?>assets/img/img_sad/4a.png"  border="0" height="200" width="200">
		  </a><br><br>
			<div class="field">
				<a href="<?php echo base_url();?>documentation/personnel" title="PERSONNEL">
				<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/4couv_info.png"  border="0" height="50" width="180">							
			</div>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/1b.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/1a.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/2b.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/2a.png";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	  var img3 = "<?php echo base_url();?>assets/img/img_sad/3b.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/3a.png"
	  $('#cat_3').on("mouseout",function(){
		  $('#cat_3').attr("src",img33);
	 });
	  $('#cat_3').on("mouseover",function(){
		  $('#cat_3').attr("src",img3);
	   });

	  var img4 = "<?php echo base_url();?>assets/img/img_sad/4b.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/4a.png";
	  $('#cat_4').on("mouseout",function(){
		  $('#cat_4').attr("src",img44);
	 });
	  $('#cat_4').on("mouseover",function(){
		  $('#cat_4').attr("src",img4);
	   });   
</script>