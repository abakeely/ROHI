
<style>
button {
	padding: 20px 70px;
	background-color: #F5EEC9;
	border-radius: 20px;
	border: 1px solid white! important;
}

 </style>
<div style=" background-color:#ededed;">

<div align="right">
		<a href="<?php echo base_url();?>documentation/couverture" class="btn btn-success">Retour</a>
</div>
<center>
	 <div class="text-center" >
		<h3><font color="DarkCyan">LES COLLECTIONS NUMERIQUES</font></h43>
	  </div>
	  
 <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="row">
	<div class="col-md-1"></div>
		
		<div class="col-md-2"><a href="<?php echo base_url();?>nouveaute/dico" title="Dictionnaire">
			  <img  id="cat_dico" src="<?php echo base_url();?>assets/img/img_sad/cat_/Dico_face.png"  border="0" height="240" width="170">
			  </a><br><br>
		</div>
		<div class="col-md-2"><a href="<?php echo base_url();?>nouveaute/droit" title="Droit">
			  <img  id="cat_droit" src="<?php echo base_url();?>assets/img/img_sad/cat_/DroitFace.png"  border="0" height="240" width="170">
			  </a><br><br>
		</div>
		<div class="col-md-2"><a href="<?php echo base_url();?>nouveaute/gestion" title="Gestion">
			  <img  id="cat_gestion" src="<?php echo base_url();?>assets/img/img_sad/cat_/GestionFace.png"  border="0" height="240" width="170">
			  </a><br><br>
		</div>
		<div class="col-md-2"><a href="<?php echo base_url();?>nouveaute/pas" title="Population et Affaire Sociale">
			  <img  id="cat_pas" src="<?php echo base_url();?>assets/img/img_sad/cat_/PASFace.png"  border="0" height="240" width="200">
			  </a><br><br>
		</div>
		<div class="col-md-3"></div>
    </div>
	<div class="row">
		<div class="col-md-1"></div>
			<div class="col-md-2"><a href="#" title="Budget">
				  <img  id="cat_budget" src="<?php echo base_url();?>assets/img/img_sad/cat_/BudgetFace.png"  border="0" height="240" width="170">
				  </a><br><br>							
			</div>		
			<div class="col-md-2"><a href="#" title="Douane">
				  <img  id="cat_douane" src="<?php echo base_url();?>assets/img/img_sad/cat_/DouaneFace.png"  border="0" height="240" width="170">
				  </a><br><br>
			</div>
			<div class="col-md-2"><a href="#" title="Economie">
				  <img  id="cat_eco" src="<?php echo base_url();?>assets/img/img_sad/cat_/EcoFace.png"  border="0" height="240" width="170">
				  </a><br><br>
			</div>
			<div class="col-md-2"><a href="#" title="Impôt">
				  <img  id="cat_impot" src="<?php echo base_url();?>assets/img/img_sad/cat_/ImpotFace.png"  border="0" height="240" width="200">
				  </a><br><br>
			</div>
		<div class="col-md-3"></div>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/cat_/Dico_face2.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/cat_/Dico_face.png";
	  $('#cat_dico').on("mouseout",function(){
		  $('#cat_dico').attr("src",img11);
	 });
	  $('#cat_dico').on("mouseover",function(){
		  $('#cat_dico').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/cat_/DroitFace2.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/cat_/DroitFace.png";
	  $('#cat_droit').on("mouseout",function(){
		  $('#cat_droit').attr("src",img22);
	 });
	  $('#cat_droit').on("mouseover",function(){
		  $('#cat_droit').attr("src",img2);
	   });

	  var img3 = "<?php echo base_url();?>assets/img/img_sad/cat_/GestionFace2.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/cat_/GestionFace.png"
	  $('#cat_gestion').on("mouseout",function(){
		  $('#cat_gestion').attr("src",img33);
	 });
	  $('#cat_gestion').on("mouseover",function(){
		  $('#cat_gestion').attr("src",img3);
	   });

	  var img4 = "<?php echo base_url();?>assets/img/img_sad/cat_/PASFace2.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/cat_/PASFace.png";
	  $('#cat_pas').on("mouseout",function(){
		  $('#cat_pas').attr("src",img44);
	 });
	  $('#cat_pas').on("mouseover",function(){
		  $('#cat_pas').attr("src",img4);
	   }); 

	  var img5 = "<?php echo base_url();?>assets/img/img_sad/cat_/BudgetFace2.png";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/cat_/BudgetFace.png";
	  $('#cat_budget').on("mouseout",function(){
		  $('#cat_budget').attr("src",img55);
	 });
	  $('#cat_budget').on("mouseover",function(){
		  $('#cat_budget').attr("src",img5);
	   }); 
	   
	  var img6 = "<?php echo base_url();?>assets/img/img_sad/cat_/DouaneFace2.png";
	  var img66 = "<?php echo base_url();?>assets/img/img_sad/cat_/DouaneFace.png";
	  $('#cat_douane').on("mouseout",function(){
		  $('#cat_douane').attr("src",img66);
	 });
	  $('#cat_douane').on("mouseover",function(){
		  $('#cat_douane').attr("src",img6);
	   });

	var img7 = "<?php echo base_url();?>assets/img/img_sad/cat_/EcoFace2.png";
	  var img77 = "<?php echo base_url();?>assets/img/img_sad/cat_/EcoFace.png";
	  $('#cat_eco').on("mouseout",function(){
		  $('#cat_eco').attr("src",img77);
	 });
	  $('#cat_eco').on("mouseover",function(){
		  $('#cat_eco').attr("src",img7);
	   }); 
	var img8 = "<?php echo base_url();?>assets/img/img_sad/cat_/ImpotFace2.png";
	  var img88 = "<?php echo base_url();?>assets/img/img_sad/cat_/ImpotFace.png";
	  $('#cat_impot').on("mouseout",function(){
		  $('#cat_impot').attr("src",img88);
	 });
	  $('#cat_impot').on("mouseover",function(){
		  $('#cat_impot').attr("src",img8);
	   }); 
</script>