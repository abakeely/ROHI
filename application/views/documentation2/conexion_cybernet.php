
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
<div align="right">
			<a href="<?php echo base_url();?>documentation/tableau_bord" class="btn btn-success">Retour</a>
</div>
<br><br><br><br><br><br>
<center>
 <div class="row">
  <div class="col-md-12">
    <div class="row">

	<?php if($user['role'] == "biblio"){?>
	<div class="col-md-6"><a href="<?php echo base_url();?>tableau_bord/connexion_internet" title="CONSULTATION SUR PLACE">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/ajoutconexnet.png" >
		  </a><br><br>
				<div class="field">
					 <a href="<?php echo base_url();?>tableau_bord/connexion_internet" title="CONSULTATION SUR PLACE">
						 <img class="img_cat" id="cat_5" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/ajout_bas.png" >
					</a>
				</div>								
	</div>		
	<div class="col-md-4"><a href="<?php echo base_url();?>tableau_bord/list_connexion_net" title="CONNEXION Cybernet">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/listeconsult1.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/list_connexion_net" title="CONNEXION Cybernet">
						<img class="img_cat" id="cat_6" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/liste_bas2.png">
					</a>
				</div>
	</div>
	
<?php }else{?>
<div class="col-md-3"><a href="<?php echo base_url();?>tableau_bord/consult_place" title="CONSULTATION SUR PLACE">
		  <img class="img_cat" id="cat_1" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/ajoutconexnet.png" >
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/consult_place" title="CONSULTATION SUR PLACE">
						 <img class="img_cat" id="cat_5" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/ajout_bas.png" >
					</a>
				</div>								
	</div>		
	<div class="col-md-3"><a href="<?php echo base_url();?>tableau_bord/list_connexion_net" title="CONNEXION Cybernet">
		  <img class="img_cat" id="cat_2" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/listeconsult1.png">
		  </a><br><br>
				<div class="field">
					<a href="<?php echo base_url();?>tableau_bord/list_connexion_net" title="CONNEXION Cybernet">
						<img class="img_cat" id="cat_6" src="<?php echo base_url();?>assets/img/img_sad/tableau_bord/liste_bas2.png">
					</a>
				</div>
	</div>
	
	<?php }?>
 </div>
 </div>
  <div class="col-md-1"></div>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/Ajoutconxnet.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/ajoutconexnet.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_1').attr("src",img11);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img1);
	   });

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/listeconexioncybernet.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/listeconsult1.png";
	  $('#cat_2').on("mouseout",function(){
		  $('#cat_2').attr("src",img22);
	 });
	  $('#cat_2').on("mouseover",function(){
		  $('#cat_2').attr("src",img2);
	   });

	 var img5 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/Ajoutbas.png";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/ajout_bas.png";
	  $('#cat_5').on("mouseout",function(){
		  $('#cat_5').attr("src",img55);
	 });
	  $('#cat_5').on("mouseover",function(){
		  $('#cat_5').attr("src",img5);
	   });
	   
	 var img6 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/liste_bas1.png";
	  var img66 = "<?php echo base_url();?>assets/img/img_sad/tableau_bord/liste_bas2.png";
	  $('#cat_6').on("mouseout",function(){
		  $('#cat_6').attr("src",img66);
	 });
	  $('#cat_6').on("mouseover",function(){
		  $('#cat_6').attr("src",img6);
	   });
	   

</script>