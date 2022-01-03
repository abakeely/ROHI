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
	
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_imp/CGI_2015.pdf"target="blanck"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_imp/couv_imp/CGI_2015.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_imp/cgi_2015_fra.pdf"target="blanck"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_imp/couv_imp/cgi_2015_fra.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_imp/cgi2013.pdf"target="blanck"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_imp/couv_imp/cgi2013.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_imp/code_general_des_impots_du.pdf"target="blanck"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_imp/couv_imp/code_general_des_impots_du.jpg">
	  </a><br><br>
	</td>
	<td class="zoom"><a href="<?php echo base_url();?>assets/pdf_sad/pdf_imp/LE_contribuable_face_administration_fiscale.pdf"target="blanck"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/pdf_sad/pdf_imp/couv_imp/LE_contribuable_face_administration_fiscale.jpg">
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