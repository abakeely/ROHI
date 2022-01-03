
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
<div style=" background-color:#ededed;">
<br><br><br>
	<div align="right">
			<a href="<?php echo base_url();?>documentation/couverture_pret" class="btn btn-success">Retour</a>
	</div>	
<center>
 <div class="row">
  <div class="col-md-12">
    <div class="row">
	 <div class="col-md-3"></div>
	<?php if($user['role'] == "biblio"){?>
	<div class="col-md-3"><a href="<?php echo base_url();?>documentation/besoin_livre" title="AJOUT BESOIN LIVRE">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/3p.png" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/besoin_livre" title="AJOUT BESOIN LIVRE">
						 <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/ajb.png" >
					</a>
				</div>								
	</div>		
	<div class="col-md-3"><a href="<?php echo base_url();?>documentation/liste_besoin" title="LISTE BESOINS LIVRE">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/4p.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/liste_besoin" title="LISTE BESOINS LIVRE">
						<img class="img_cat" id="cat_4" src="<?php echo base_url();?>assets/img/img_sad/4pp.png">
					</a>
				</div>
	</div>
<?php }else{?>
	<div class="col-md-3"><a href="<?php echo base_url();?>documentation/besoin_livre" title="AJOUT BESOIN LIVRE">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/3p.png" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/besoin_livre" title="AJOUT BESOIN LIVRE">
						 <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/ajb.png" >
					</a>
				</div>								
	</div>		
	<div class="col-md-3"><a href="<?php echo base_url();?>documentation/liste_besoin" title="LISTE BESOINS LIVRE">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/4p.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/liste_besoin" title="LISTE BESOINS LIVRE">
						<img class="img_cat" id="cat_4" src="<?php echo base_url();?>assets/img/img_sad/4pp.png">
					</a>
				</div>
	</div>
	<?php }?>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/3pd.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/3p.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/4pd.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/4p.png";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	  var img3 = "<?php echo base_url();?>assets/img/img_sad/ajbd.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/ajb.png"
	  $('#cat_3').on("mouseout",function(){
		  $('#cat_3').attr("src",img33);
	 });
	  $('#cat_3').on("mouseover",function(){
		  $('#cat_3').attr("src",img3);
	   });

	  var img4 = "<?php echo base_url();?>assets/img/img_sad/4ppd.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/4pp.png";
	  $('#cat_4').on("mouseout",function(){
		  $('#cat_4').attr("src",img44);
	 });
	  $('#cat_4').on("mouseover",function(){
		  $('#cat_4').attr("src",img4);
	   }); 

	 var img5 = "<?php echo base_url();?>assets/img/img_sad/1ppd.png";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/1pp.png";
	  $('#cat_5').on("mouseout",function(){
		  $('#cat_5').attr("src",img55);
	 });
	  $('#cat_5').on("mouseover",function(){
		  $('#cat_5').attr("src",img5);
	   });
	   
	 var img6 = "<?php echo base_url();?>assets/img/img_sad/2ppd.png";
	  var img66 = "<?php echo base_url();?>assets/img/img_sad/2pp.png";
	  $('#cat_6').on("mouseout",function(){
		  $('#cat_6').attr("src",img66);
	 });
	  $('#cat_6').on("mouseover",function(){
		  $('#cat_6').attr("src",img6);
	   });
</script>