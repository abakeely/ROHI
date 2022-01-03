
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
  <div class="col-md-12">
    <div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-3">
		<p><a href="<?php echo base_url();?>nouveaute/dico" title="Dictionnaire">
			<img  id="cat_dico" src="<?php echo base_url();?>assets/img/img_sad/cat_/7.png"  border="0" height="200" width="200">
		</a></p>
		<p><a href="<?php echo base_url();?>nouveaute/dico"><img  src="<?php echo base_url();?>assets/img/nouv_/pied/1.png" title="Dictionnaire"  border="0" height="37" width="105" /></a></p>
		</div>
		<div class="col-md-3">
		<p><a href="<?php echo base_url();?>nouveaute/droit" title="Droit">
			<img  id="cat_droit" src="<?php echo base_url();?>assets/img/img_sad/cat_/1.png"  border="0" height="200" width="200">
		</a></p>
		<p><a href="<?php echo base_url();?>nouveaute/droit"><img  src="<?php echo base_url();?>assets/img/nouv_/pied/2.png" title="Droit"  border="0" height="37" width="105" /></a></p>
		</div>
		<div class="col-md-3">
		<p><a href="<?php echo base_url();?>nouveaute/gestion" title="Gestion">
			<img  id="cat_gestion" src="<?php echo base_url();?>assets/img/img_sad/cat_/12.png"  border="0" height="200" width="200">
		</a></p>
		<p><a href="<?php echo base_url();?>nouveaute/gestion"><img  src="<?php echo base_url();?>assets/img/nouv_/pied/3.png" title="Economie"  border="0" height="37" width="105" /></a></p>
		</div>
    </div>
	<div class="col-md-1"></div>
	<br>
	
<div class="row">
	<div class="col-md-12">
	<div class="row">
	<div class="col-md-2"></div>
		<div class="col-md-3">
		<p><a href="<?php echo base_url();?>nouveaute/pas" title="Population et Affaire Sociale">
			<img  id="cat_pas" src="<?php echo base_url();?>assets/img/img_sad/cat_/13.png"  border="0" height="200" width="200">
		</a></p>
		<p><a href="<?php echo base_url();?>nouveaute/pas"><img  src="<?php echo base_url();?>assets/img/nouv_/pied/4.png" title="Economie"  border="0" height="37" width="105" /></a></p>	  
		</div>
		<div class="col-md-3">
		<p><a href="<?php echo base_url();?>nouveaute/infra" title="Infrastructure et Environnement">
			<img  id="cat_infra" src="<?php echo base_url();?>assets/img/img_sad/cat_/14.png"  border="0" height="200" width="200">
		</a></p>
		<p><a href="<?php echo base_url();?>nouveaute/infra"><img  src="<?php echo base_url();?>assets/img/nouv_/pied/5.png" title="Economie"  border="0" height="37" width="105" /></a></p>	  
		</div>
    </div>
	 <div class="col-md-2"></div>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/cat_/7_.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/cat_/7.png";
	  $('#cat_dico').on("mouseout",function(){
		  $('#cat_dico').attr("src",img11);
	 });
	  $('#cat_dico').on("mouseover",function(){
		  $('#cat_dico').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/cat_/1_.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/cat_/1.png";
	  $('#cat_droit').on("mouseout",function(){
		  $('#cat_droit').attr("src",img22);
	 });
	  $('#cat_droit').on("mouseover",function(){
		  $('#cat_droit').attr("src",img2);
	   });
    
	  var img4 = "<?php echo base_url();?>assets/img/img_sad/cat_/12_.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/cat_/12.png";
	  $('#cat_gestion').on("mouseout",function(){
		  $('#cat_gestion').attr("src",img44);
	 });
	  $('#cat_gestion').on("mouseover",function(){
		  $('#cat_gestion').attr("src",img4);
	   }); 
	  var img5 = "<?php echo base_url();?>assets/img/img_sad/cat_/13_.png";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/cat_/13.png";
	  $('#cat_pas').on("mouseout",function(){
		  $('#cat_pas').attr("src",img55);
	 });
	  $('#cat_pas').on("mouseover",function(){
		  $('#cat_pas').attr("src",img5);
	   });
	
	  var img3 = "<?php echo base_url();?>assets/img/img_sad/cat_/14_.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/cat_/14.png"
	  $('#cat_infra').on("mouseout",function(){
		  $('#cat_infra').attr("src",img33);
	 });
	  $('#cat_infra').on("mouseover",function(){
		  $('#cat_infra').attr("src",img3);
	   });

	
	 
	   
	var img6 = "<?php echo base_url();?>assets/img/img_sad/cat_/8_.png";
	  var img66 = "<?php echo base_url();?>assets/img/img_sad/cat_/8.png";
	  $('#cat_tresor').on("mouseout",function(){
		  $('#cat_tresor').attr("src",img66);
	 });
	  $('#cat_tresor').on("mouseover",function(){
		  $('#cat_tresor').attr("src",img6);
	   }); 
</script>