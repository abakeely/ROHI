
 <style>
 	.modal-header .modal-footer{
 		background : #91c149;
 	}
 </style>
 <div id="content-wrap" class="row"> 
  <div class="col-md-12">
		<br>
	<div class="row separateur"><div class="col-md-12">Recherche respers</div></div>
	<br>
	<form action="<?php echo base_url(). "gcap/search_matricule"; ?>" method="post">
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<select class="form-control" name="type" onchange="changeMask()" id="type">
					<option value="im" <?php echo $type=='im'?'selected="selected"':''; ?>>MATRICULE</option>
					<option value="cin" <?php echo $type=='cin'?'selected="selected"':''; ?>>CIN</option>
				</select>
			</div>
			<div class="col-md-2">
				<input class="form-control" placeholder="matricule ou CIN" name="im" id="num" value="<?php echo ($type=='im')?$candidat->matricule:$candidat->cin; ?>"/>
			</div>
			<div class="col-md-2"><button class="form-control">Rechercher</button></div>
			<div class="col-md-4"></div>
	</div>
	<br>
	<div class="row"><div class="col-md-12"><hr></div></div>
	<br>
	<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-2">
				<?php echo $candidat->nom . ' '. $candidat->prenom;?>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-4"></div>
	</div>
	
	</form>
	<br>
	<form action="<?php echo base_url(). "gcap/valide_respers"; ?>" method="post">
	<input type="hidden" value="<?php echo $user_edit['id'];?>" name="user_id"/>
	<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">Pays  </label>
			</div>
			 <div class="col-md-3">
                   <select class="form-control" placeholder="pays" name="pays" data-placement="top" data-toggle="tooltip" data-original-title="Safidio ny anarany ilay firenena nahazoanao ilay mari-pahaizana"id="pays">
                        <?php foreach($list_pays as $d){ 
							$selected = ($d['id'] == $pays_edit)  ? ' selected="selected"' : '';
                        ?>
                        <option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
                        <?php }?>
                   </select>
              </div>
             <div class="col-md-1">
			</div>
    </div>
    <br>
    <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 libele_form">
                            <label class="control-label ">Province </label>
                    </div>
                    <div class="col-md-3">
                            <select class="form-control" placeholder="province" name="province" data-toggle="tooltip" data-original-title="Safidio ny Faritany misy anao"  id="province">
                                <?php if($user_edit['exist_cv'] && $province_edit){ ?>      
                                <option  value=<?php echo $province_edit['id'];?>><?php echo $province_edit['libele'];?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="col-md-5"></div>
		</div>
	    <br>
	    <div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Region </label>
			</div>
			<div class="col-md-6">
					<select class="form-control" placeholder="Service" name="region" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="region">
						<option  value="0">-------</option> 
	                                        <?php foreach($list_region as $d){ 
						$selected = ($d['id'] == $reg_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">D&eacute;partement  </label>
			</div>
			<div class="col-md-6">
				<select class="form-control" placeholder="Departement" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement">
					<option  value="0">-------</option> 
                                        <?php foreach($list_departement as $d){ 
						$selected = ($d['id'] == $departement_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?> ><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Direction </label>
			</div>
			<div class="col-md-6">
                            <select class="form-control" placeholder="Direction" name="direction" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="direction">
					<option  value="0">-------</option> 
                                        <?php foreach($list_direction as $d){ 
						$selected = ($d['id'] == $direction_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
          <div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Service </label>
			</div>
			<div class="col-md-6">
					<select class="form-control" placeholder="Service" name="service" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="service">
						<option  value="0">-------</option> 
	                                        <?php foreach($list_service as $d){ 
						$selected = ($d['id'] == $service_edit)  ? ' selected="selected"' : '';
					?>
						<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
		<br>
          <div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><button class="form-control">Valider</button></div>
			<div class="col-md-4"></div>
		</div>
		</form>
		<br>
   </div>	
   <script type="text/javascript">
   	<?php if($type=="im"){?>
   		$("#num").mask("999999");  
   	<?php }else{?>
   		$("#num").mask("999 999 999 999");
   	<?php }?>
   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#num").mask("999 999 999 999");
   			else
   				$("#num").mask("999999");   
   	   	}
   </script>