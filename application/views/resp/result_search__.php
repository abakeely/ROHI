
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
	<form action="<?php echo base_url(). "user/search_matricule"; ?>" method="post">
	<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-2">
				<input class="form-control" placeholder="Veuillez entrer le matricule" name="im" value="<?php echo $candidat->matricule?>"/>
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
	<form action="<?php echo base_url(). "user/valide_respers"; ?>" method="post">
	<input type="hidden" value="<?php echo $user_edit['id'];?>" name="user_id"/>
	<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">D&eacute;partement  </label><b><font color="red"> * </font></b>
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
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Region </label>
			</div>
			<div class="col-md-6">
					<select class="form-control" placeholder="Service" name="region" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="service">
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
		
		<br>
          <div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><button class="form-control">Valider</button></div>
			<div class="col-md-4"></div>
		</div>
		</form>
		<br>
   </div>	