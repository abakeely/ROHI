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
   width: 200px; padding: 5px; border: 1px solid black;
   -webkit-transition: all .3s ease-out;
   -moz-transition: all .3s ease-out;
   -o-transition: all .3s ease-out;
   transition: all .3s ease-out;
}
.zoom:hover {
   -moz-transform: scale(2);
   -webkit-transform: scale(2);
   -o-transform: scale(2);
   transform: scale(2);
   -ms-transform: scale(2);
filter: progid:DXImageTransform.Microsoft.Matrix(sizingMethod='auto expand',
   M11=2, M12=-0, M21=0, M22=2);
   } 
 </style>
<br>
<div align="right">
		<a href="<?php echo base_url();?>nouveaute/nouveaute_liste1" class="btn btn-success">Voir plus</a>
</div>
<br>
<center>
<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
<tr>
	<td class="zoom"><a href="<?php echo base_url();?>nouveaute/collection_num"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/1.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/13/3519"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/22.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/13/3520"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/23.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 <td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/13/3521"> 
	  <br><img class="img_cat"  src="<?php echo base_url();?>assets/img/nouv_/24.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 <td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/8/3522"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/25.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 
</tr>

<tr>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/8/3523"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/26.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/8/3524"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/27.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/8/3525"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/28.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 <td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/8/3526"> 
	  <br><img class="img_cat"  src="<?php echo base_url();?>assets/img/nouv_/29.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 <td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/11/3527"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/30.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 
</tr>

<tr>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/11/3528"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/31.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/11/3529"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/32.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	<td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/11/3530"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/33.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 <td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/11/3531"> 
	  <br><img class="img_cat"  src="<?php echo base_url();?>assets/img/nouv_/34.jpg" border="0" height="200" width="220">
	  </a><br><br>
	 </td>
	 <td class="zoom"><a href="<?php echo base_url();?>documentation/pret_livre/11/3532"> 
	  <br><img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/35.jpg" border="0" height="200" width="220">
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