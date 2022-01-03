
<style>
button {
	padding: 4px 20px;
	background-color: #FFDAB9;
	border:2px solid black;
	border-radius:7px;
}
 </style>
 <br>
<center>
<?php 
$dataList = array();
$dataList[1]  = "Formation";
$dataList[2]  = "Politique Economique";
$dataList[3]  = "Infrastructure et Environnement";
$dataList[4]  = "Economie";
$dataList[5]  = "Banque";
$dataList[6]  = "Bailleur de Fonds";
$dataList[7]  = "Budget";	
$dataList[8]  = "Douane";	
$dataList[9]  = "Droit";
$dataList[10] = "Tr&eacute;sor";
$dataList[11] = "Gestion Administration ";
$dataList[12] = "Affaires Sociales";
$dataList[13] = "Dictionnaire et Lexique";
$dataList[14] = "Journal Officiel";
$dataList[15] = "Publication en s&eacute;rie";
$dataList[16] = "Divers";
?>
<div style=" background-color:#ededed;">
	<div class="text-center" >
		<div align="right">
			<a href="<?php echo base_url();?>documentation/couverture" class="btn btn-success">Retour</a>
	</div>
	</div>
<br><br>
<center>
 <div class="row">
  <div class="col-md-12">
    <div class="row">
	<div class="col-md-2">
	  <p><a href="<?php echo base_url();?>documentation/pret_livre/8">
	    <img  class="img_cat" id="cat_droit" src="<?php echo base_url();?>assets/img/img_sad/cat_/1.png" title="Droit"  border="0" height="150" width="150">
	  </a></p>
	  <p><a href="<?php echo base_url();?>documentation/pret_livre/8"><img  src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/1.png" title="Droit"  border="0" height="37" width="105" /></a></p>
	</div>
	
	<div class="col-md-2">
	  <p><a href="<?php echo base_url();?>documentation/pret_livre/3">
		 <img  id="cat_economie" src="<?php echo base_url();?>assets/img/img_sad/cat_/2.png" title="Economie" border="0" height="150" width="160">
	  </a></p>
	  <p><a href="<?php echo base_url();?>documentation/pret_livre/3"><img  src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/2.png" title="Droit"  border="0" height="37" width="105" /></a></p>		
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/4">
		  <img id="cat_banque" src="<?php echo base_url();?>assets/img/img_sad/cat_/3.png" title="Banque" border="0" height="150" width="160">
		</a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/4"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/3.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/2">
		  <img  id="cat_infra" src="<?php echo base_url();?>assets/img/img_sad/cat_/4.png" title="Environnement" border="0" height="150" width="160">
		  </a></p>
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/2"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/4.png" title="Droit"  border="0" height="37" width="105" /></a></p>
	</div>
	
	<div class="col-md-2">
		<p><a href="<?php echo base_url();?>documentation/pret_livre/6">
		  <img  id="cat_budget" src="<?php echo base_url();?>assets/img/img_sad/cat_/5.png" title="Budge" border="0" height="150" width="160">
		</a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/6"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/5.png" title="Droit"  border="0" height="37" width="105" /></a></p>
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/9">
		  <img  id="cat_impot" src="<?php echo base_url();?>assets/img/img_sad/cat_/6.png"  title="Impot" border="0" height="150" width="160">
		</a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/9"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/6.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
 </div>
 <br>
 
 <div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-2">
	   <p><a href="<?php echo base_url();?>documentation/pret_livre/13" >
		  <img  id="cat_dico" src="<?php echo base_url();?>assets/img/img_sad/cat_/7.png" title="Dictionnaire" border="0" height="150" width="150">
		  </a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/13"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/7.png" title="Droit"  border="0" height="37" width="105" /></a></p>									
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/10">
		  <img id="cat_tresor" src="<?php echo base_url();?>assets/img/img_sad/cat_/8.png" title="Tresor"  border="0" height="150" width="160">
		  </a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/10"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/8.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/1">
		  <img  id="cat_politique" src="<?php echo base_url();?>assets/img/img_sad/cat_/9.png" title="Politique Economique" border="0" height="150" width="160">
		</a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/1"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/9.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/5">
		  <img  id="cat_bailleur" src="<?php echo base_url();?>assets/img/img_sad/cat_/10.png" title="" border="0" height="150" width="160">
		  </a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/5"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/10.png" title="Droit"  border="0" height="37" width="105" /></a></p>
			
	</div>
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/7" >
		  <img id="cat_douane" src="<?php echo base_url();?>assets/img/img_sad/cat_/11.png" title="Douane" border="0" height="150" width="160">
		  </a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/7"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/11.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
	<div class="col-md-1"></div>
</div>
	
	<br>
	<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/11">
		  <img  id="cat_gestion" src="<?php echo base_url();?>assets/img/img_sad/cat_/12.png" title="Gestion" border="0" height="150" width="150">
		  </a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/11"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/12.png" title="Droit"  border="0" height="37" width="105" /></a></p>									
	</div>		
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/12">
		  <img  id="cat_affaire" src="<?php echo base_url();?>assets/img/img_sad/cat_/13.png" title="Affaire Sociale" border="0" height="150" width="160">
		</a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/12"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/13.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/15" >
		  <img  id="cat_serie" src="<?php echo base_url();?>assets/img/img_sad/cat_/14.png" title="Publication en serie" border="0" height="150" width="160">
		</a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/15"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/14.png" title="Droit"  border="0" height="37" width="105" /></a></p>	
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/14">
		  <img id="cat_journal" src="<?php echo base_url();?>assets/img/img_sad/cat_/15.png" title="Journal Officiel" border="0" height="150" width="160">
		  </a></p>
		<p><a href="<?php echo base_url();?>documentation/pret_livre/14"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/15.png" title="Droit"  border="0" height="37" width="105" /></a></p>
	</div>
	
	<div class="col-md-2">
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/17" >
		  <img id="cat_divers" src="<?php echo base_url();?>assets/img/img_sad/cat_/16.png" title="Divers" border="0" height="150" width="160">
		</a></p>
	    <p><a href="<?php echo base_url();?>documentation/pret_livre/17"><img  id="cat_droit2" src="<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/16.png" title="Droit"  border="0" height="37" width="105" /></a></p>
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
  
	  var img1 = "<?php echo base_url();?>assets/img/img_sad/cat_/1_.png";
	  var img11 = "<?php echo base_url();?>assets/img/img_sad/cat_/1.png";
	  $('#cat_droit').on("mouseout",function(){
		  $('#cat_droit').attr("src",img11);
	 });
	  $('#cat_droit').on("mouseover",function(){
		  $('#cat_droit').attr("src",img1);
	   });
	   

	  var img2 = "<?php echo base_url();?>assets/img/img_sad/cat_/2_.png";
	  var img22 = "<?php echo base_url();?>assets/img/img_sad/cat_/2.png";
	  $('#cat_economie').on("mouseout",function(){
		  $('#cat_economie').attr("src",img22);
	 });
	  $('#cat_economie').on("mouseover",function(){
		  $('#cat_economie').attr("src",img2);
	   });

	  var img3 = "<?php echo base_url();?>assets/img/img_sad/cat_/3_.png";
	  var img33 = "<?php echo base_url();?>assets/img/img_sad/cat_/3.png"
	  $('#cat_banque').on("mouseout",function(){
		  $('#cat_banque').attr("src",img33);
	 });
	  $('#cat_banque').on("mouseover",function(){
		  $('#cat_banque').attr("src",img3);
	   });
	     
	  var img4 = "<?php echo base_url();?>assets/img/img_sad/cat_/4_.png";
	  var img44 = "<?php echo base_url();?>assets/img/img_sad/cat_/4.png";
	  $('#cat_infra').on("mouseout",function(){
		  $('#cat_infra').attr("src",img44);
	 });
	  $('#cat_infra').on("mouseover",function(){
		  $('#cat_infra').attr("src",img4);
	   });

	  var img5 = "<?php echo base_url();?>assets/img/img_sad/cat_/5_.png";
	  var img55 = "<?php echo base_url();?>assets/img/img_sad/cat_/5.png";
	  $('#cat_budget').on("mouseout",function(){
		  $('#cat_budget').attr("src",img55);
	 });
	  $('#cat_budget').on("mouseover",function(){
		  $('#cat_budget').attr("src",img5);
	   });
	   

	  var img6 = "<?php echo base_url();?>assets/img/img_sad/cat_/6_.png";
	  var img66 = "<?php echo base_url();?>assets/img/img_sad/cat_/6.png";
	  $('#cat_impot').on("mouseout",function(){
		  $('#cat_impot').attr("src",img66);
	 });
	  $('#cat_impot').on("mouseover",function(){
		  $('#cat_impot').attr("src",img6);
	   });

	  var img7 = "<?php echo base_url();?>assets/img/img_sad/cat_/7_.png";
	  var img77 = "<?php echo base_url();?>assets/img/img_sad/cat_/7.png";
	  $('#cat_dico').on("mouseout",function(){
		  $('#cat_dico').attr("src",img77);
	 });
	  $('#cat_dico').on("mouseover",function(){
		  $('#cat_dico').attr("src",img7);
	   });
	   
	  var img8 = "<?php echo base_url();?>assets/img/img_sad/cat_/8_.png";
	  var img88 = "<?php echo base_url();?>assets/img/img_sad/cat_/8.png";
	  $('#cat_tresor').on("mouseout",function(){
		  $('#cat_tresor').attr("src",img88);
	 });
	  $('#cat_tresor').on("mouseover",function(){
		  $('#cat_tresor').attr("src",img8);
	   });
	   
	  var img9 = "<?php echo base_url();?>assets/img/img_sad/cat_/9_.png";
	  var img99 = "<?php echo base_url();?>assets/img/img_sad/cat_/9.png";
	  $('#cat_politique').on("mouseout",function(){
		  $('#cat_politique').attr("src",img99);
	 });
	  $('#cat_politique').on("mouseover",function(){
		  $('#cat_politique').attr("src",img9);
	   });
	   
	  var img10 = "<?php echo base_url();?>assets/img/img_sad/cat_/10_.png";
	  var img100 = "<?php echo base_url();?>assets/img/img_sad/cat_/10.png";
	  $('#cat_bailleur').on("mouseout",function(){
		  $('#cat_bailleur').attr("src",img100);
	 });
	  $('#cat_bailleur').on("mouseover",function(){
		  $('#cat_bailleur').attr("src",img10);
	   });
	   
	  var img20 = "<?php echo base_url();?>assets/img/img_sad/cat_/11_.png";
	  var img200 = "<?php echo base_url();?>assets/img/img_sad/cat_/11.png";
	  $('#cat_douane').on("mouseout",function(){
		  $('#cat_douane').attr("src",img200);
	 });
	  $('#cat_douane').on("mouseover",function(){
		  $('#cat_douane').attr("src",img20);
	   });
	   
	  var img30 = "<?php echo base_url();?>assets/img/img_sad/cat_/12_.png";
	  var img300 = "<?php echo base_url();?>assets/img/img_sad/cat_/12.png";
	  $('#cat_gestion').on("mouseout",function(){
		  $('#cat_gestion').attr("src",img300);
	 });
	  $('#cat_gestion').on("mouseover",function(){
		  $('#cat_gestion').attr("src",img30);
	   });
	   
	  var img40 = "<?php echo base_url();?>assets/img/img_sad/cat_/13_.png";
	  var img400 = "<?php echo base_url();?>assets/img/img_sad/cat_/13.png";
	  $('#cat_affaire').on("mouseout",function(){
		  $('#cat_affaire').attr("src",img400);
	 });
	  $('#cat_affaire').on("mouseover",function(){
		  $('#cat_affaire').attr("src",img40);
	   });
	   var img60 = "<?php echo base_url();?>assets/img/img_sad/cat_/14_.png";
	  var img600 = "<?php echo base_url();?>assets/img/img_sad/cat_/14.png";
	  $('#cat_serie').on("mouseout",function(){
		  $('#cat_serie').attr("src",img600);
	 });
	  $('#cat_serie').on("mouseover",function(){
		  $('#cat_serie').attr("src",img60);
	   });
	   
	  var img50 = "<?php echo base_url();?>assets/img/img_sad/cat_/15_.png";
	  var img500 = "<?php echo base_url();?>assets/img/img_sad/cat_/15.png";
	  $('#cat_journal').on("mouseout",function(){
		  $('#cat_journal').attr("src",img500);
	 });
	  $('#cat_journal').on("mouseover",function(){
		  $('#cat_journal').attr("src",img50);
	   });
	  var img80 = "<?php echo base_url();?>assets/img/img_sad/cat_/16_.png";
	  var img800 = "<?php echo base_url();?>assets/img/img_sad/cat_/16.png";
	  $('#cat_divers').on("mouseout",function(){
		  $('#cat_divers').attr("src",img800);
	 });
	  $('#cat_divers').on("mouseover",function(){
		  $('#cat_divers').attr("src",img80);
	   });
	   
	   
	   
	   
	   
	var img01 = "<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/pied.png";
	  var img001 = "<?php echo base_url();?>assets/img/img_sad/cat_/cat_b/1.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_2').attr("src",img001);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img01);
	   });   
	   
</script>