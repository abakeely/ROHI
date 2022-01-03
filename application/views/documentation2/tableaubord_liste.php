
<style>
button {
	padding: 20px 80px;
	background-color: #F5EEC9;
	border-radius: 20px;
	border: 1px solid white! important;
}

 </style>
<div style=" background-color:#ededed;">
<br>
<center>
 <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="row">
	<div class="col-md-4"><a href="<?php echo base_url();?>documentation/catalogue_livre" title="DIVERS OUVRAGES">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/1f.png"  border="0" height="150" width="150">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/catalogue_livre" title="DIVERS OUVRAGES">
						 <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/1_bas.jpg"  border="0" height="40" width="150">
					</a>
				</div>								
	</div>		
	<div class="col-md-4"><a href="<?php echo base_url();?>documentation/pret_livre/16" title="Politique">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/2f.png"  border="0" height="150" width="150">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/pret_livre/16" title="POLITIQUE">
						<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/2_bas.jpg"  border="0" height="40" width="150">							
				</div>
					</a>
	</div>
	<div class="col-md-4"><a href="<?php echo base_url();?>documentation/enam" title="Politique">
		  <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/3f.png"  border="0" height="150" width="150">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/enam" title="POLITIQUE">
						<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/3_bas.jpg"  border="0" height="40" width="150">							
				</div>
					</a>
	</div> 
  </div>
  <br><br>
   <div class="row">
	<div class="col-md-7"><a href="<?php echo base_url();?>documentation/texte_reglementaire" title="Politique">
		  <img class="img_cat" id="cat_4" src="<?php echo base_url();?>assets/img/img_sad/4f.png"  border="0" height="150" width="150">
		  </a><br><br>
			<div class="field">
				<a href="<?php echo base_url();?>documentation/texte_reglementaire" title="POLITIQUE">
					<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/4_bas.jpg"  border="0" height="40" width="150">							
			</div>
				</a>
	</div>
	<div class="col-md-1"><a href="<?php echo base_url();?>nouveaute/collection_num" title="Collections Numeriques">
		  <img class="img_cat" id="cat_5" src="<?php echo base_url();?>assets/img/img_sad/cnum.png"  border="0" height="150" width="150">
		  </a><br>
				<div class="field">
					<a href="<?php echo base_url();?>nouveaute/collection_num" title="Collections Numeriques">
						<img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/5_bas.jpg"  border="0" height="40" width="150">							
				</div>
					</a>
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
		
	 var img5 = "<?php echo base_url();?>assets/img/img_sad/cnum2.ico";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/cnum.png";
	  $('#cat_5').on("mouseout",function(){
		  $('#cat_5').attr("src",img55);
	 });
	  $('#cat_5').on("mouseover",function(){
		  $('#cat_5').attr("src",img5);
	   });
</script>