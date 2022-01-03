
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
<br><br><br><br><br><br>
<center>
 <div class="row">
  <div class="col-md-12">
    <div class="row">

	<?php if($user['role'] == "biblio"){?>
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/consultation_surplace" title="CONSULTATION SUR PLACE">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cp.png" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/consultation_surplace" title="CONSULTATION SUR PLACE">
						 <img class="img_cat" id="cat_5" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cp.png" >
					</a>
				</div>								
	</div>		
	<div class="col-md-3"style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/conexion_cybernet" title="CONNEXION Cybernet">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cnx.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/conexion_cybernet" title="CONNEXION Cybernet">
						<img class="img_cat" id="cat_6" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cnx_.png">
					</a>
				</div>
	</div>
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/list_user_sad" title="AGENTS CONNECTES A SAD">
		  <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1consad.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/list_user_sad" title="AGENTS CONNECTES A SAD">
						<img class="img_cat" id="cat_7" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_consad.png">	
					</a>
				</div>
	</div>
	
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>tableau_bord/bilan" title="STATISTIQUES">
		  <img class="img_cat" id="cat_8" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1stat.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/bilan" title="STATISTIQUES">
						<img class="img_cat" id="cat_9" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_stat.png">	
					</a>
				</div>
	</div>
<?php }else{?>
<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/consultation_surplace" title="CONSULTATION SUR PLACE">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cp.png" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/consultation_surplace" title="CONSULTATION SUR PLACE">
						 <img class="img_cat" id="cat_5" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cp.png" >
					</a>
				</div>								
	</div>		
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/conexion_cybernet" title="CONNEXION Cybernet">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cnx.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/conexion_cybernet" title="CONNEXION Cybernet">
						<img class="img_cat" id="cat_6" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cnx_.png">
					</a>
				</div>
	</div>
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>documentation/list_user_sad" title="AGENTS CONNECTES A SAD">
		  <img class="img_cat" id="cat_3" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1consad.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>documentation/list_user_sad" title="AGENTS CONNECTES A SAD">
						<img class="img_cat" id="cat_7" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_consad.png">	
					</a>
				</div>
	</div>
	
	<div class="col-md-3" style=" background-color:#ededed;"><a href="<?php echo base_url();?>tableau_bord/bilan" title="STATISTIQUES">
		  <img class="img_cat" id="cat_8" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/1stat.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/bilan" title="STATISTIQUES">
						<img class="img_cat" id="cat_9" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_stat.png">	
					</a>
				</div>
	</div>
	<?php }?>
 </div>
 </div>
  <div class="col-md-1" style=" background-color:#ededed;"></div>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cp__.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cp.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cnx_.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1cnx.png";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	  var img3 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1consad_.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1consad.png"
	  $('#cat_3').on("mouseout",function(){
		  $('#cat_3').attr("src",img33);
	 });
	  $('#cat_3').on("mouseover",function(){
		  $('#cat_3').attr("src",img3);
	   });

	  var img4 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1stat_.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1stat.png";
	  $('#cat_4').on("mouseout",function(){
		  $('#cat_4').attr("src",img44);
	 });
	  $('#cat_4').on("mouseover",function(){
		  $('#cat_4').attr("src",img4);
	   }); 

	 var img5 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cp_.png";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cp.png";
	  $('#cat_5').on("mouseout",function(){
		  $('#cat_5').attr("src",img55);
	 });
	  $('#cat_5').on("mouseover",function(){
		  $('#cat_5').attr("src",img5);
	   });
	   
	 var img6 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cnx_.png";
	  var img66 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_cnx.png";
	  $('#cat_6').on("mouseout",function(){
		  $('#cat_6').attr("src",img66);
	 });
	  $('#cat_6').on("mouseover",function(){
		  $('#cat_6').attr("src",img6);
	   });
	   
	var img7 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_consad_.png";
	  var img77 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_consad.png";
	  $('#cat_7').on("mouseout",function(){
		  $('#cat_7').attr("src",img77);
	 });
	  $('#cat_7').on("mouseover",function(){
		  $('#cat_7').attr("src",img7);
	   });
	   
	var img8 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1stat_.png";
	  var img88 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/1stat.png";
	  $('#cat_8').on("mouseout",function(){
		  $('#cat_8').attr("src",img88);
	 });
	  $('#cat_8').on("mouseover",function(){
		  $('#cat_8').attr("src",img8);
	   });
	  
	 var img9 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_stat_.png";
	  var img99 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/bas_stat.png";
	  $('#cat_9').on("mouseout",function(){
		  $('#cat_9').attr("src",img99);
	 });
	  $('#cat_9').on("mouseover",function(){
		  $('#cat_9').attr("src",img9);
	   });
</script>