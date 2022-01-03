<style>
button {
	padding: 4px 20px;
	background-color: #A9A9A9;
	border: 1px solid white! important;
}

th, td {
 border:1px solid #E6E6FA;
 width:20%;
 }
td {
 text-align:center;
 }
caption {
 font-weight:bold
 }
 
 /* Style des lignes de séparation */
.table-separateur {
  font-size : 12px;
  font-family : Verdana, arial, helvetica, sans-serif;
  color : #333333;
  background-color :#F5F5F5;
  }
  
  .zoom {
	height:200px;
		}
	.zoom p {
	text-align:center;
	}
	.zoom img {
	width:200px;
	height:200px;
	}
	.zoom img:hover {
	width:400px;
	height:420px;
}
   
 </style>
<br>
<div align="right">
		<a href="<?php echo base_url();?>nouveaute/collection_num" class="btn btn-success">Retour</a>
</div>
<br>
<center>
<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
<tr>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/II.DRT.058N.pdf"target="blanck"> 
	  <br> <img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/II.DRT.058N.png" >
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/II.DRT.059N.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/II.DRT.059N.png">
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/II.DRT.060N.pdf"> 
	  <br><img class="img_cat"  src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/II.DRT.060N.png">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/II.DRT.061N.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/II.DRT.061N.png">
	  </a><br><br>
	</td>

</tr>
<!--2eme autre--> 
<tr>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/Cours_Introduction_au_Droit_International.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/Cours_Introduction_au_Droit_International.jpg">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/code_civil.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/code_civil.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/code_du_travail.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/code_du_travail.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/Droit_administratif.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/Droit_administratif.jpg">
	  </a><br><br>
	</td>
</tr

<!--3eme autre--> 
<tr>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/Droit_commercial.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/Droit_commercial.jpg">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/droit_immob.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/droit_immob.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/Guide_pour_les _magistrats.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/Guide_pour_les _magistrats.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_drt/generalites_sur_le_droit_de_travail.pdf"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_drt/couv_drt/generalites_sur_le_droit_de_travail.jpg">
	  </a><br><br>
	</td>
</tr>

</table> 
</center> 
<script>
    $(document).ready(function() {	 
	  $('#table_nouveau_liste').dataTable();
      });
  
</script>