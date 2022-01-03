
 <style>
 	.modal-header .modal-footer{
 		background : #91c149;
 	}
 </style>
 <div id="content-wrap" class="row"> 
  <div class="col-md-12">
		<br>
		<div class="text-center" > 
			<h4><font color="DarkSlateGray">Recherche responsable personnel</font></h4>
		</div>
	<br>
	<form action="<?php echo base_url(). "user/search_matricule"; ?>" method="post">
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<select class="form-control" name="type" onchange="changeMask()" id="type">
					<option value="im">MATRICULE</option>
					<option value="cin">CIN</option>
				</select>
			</div>
			<div class="col-md-2">
				<input class="form-control" placeholder="matricule ou CIN" name="im" id="num"/>
			</div>
			<div class="col-md-2"><button class="form-control">Rechercher</button></div>
			<div class="col-md-4"></div>
	</div>
	</form>
	<br>
   </div>	
   <script type="text/javascript">
   		$("#num").mask("999999");  
   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#num").mask("999 999 999 999");
   			else
   				$("#num").mask("999999");   
   	   	}
   </script>