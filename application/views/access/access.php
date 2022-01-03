<style>
	body{
	 background: none repeat scroll 0% 0% ghostwhite;
	}

	.form-control {
		display: block;
		width: 100%;
		/* height: 34px; */
		padding: 4px 2px!important;
		font-size: 12px!important;
	}

	td, th {
		padding: 9px;
		font-size: 11px;
	}

	.help-block {width:500px!important;}

	#dataTables-example_paginate {display:none}
	
</style>
 <div id="content-wrap" class="row"> 
  <form class="form-horizontal" role="form" name="cv" id="cv_form" action="<?php echo base_url();?>access/save_im" method="POST" enctype="multipart/form-data">
	<div class="col-md-12">           
		<br>
<!----------------- bloc Toogle ---------------->
		<div class="toggleBloc">
			<div class="row separateur separateur1"><div class="col-md-12">Insertion des Données dans Matricule</div></div>
		</div>
<!----------------- bloc Toogle ---------------->
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> Matricule </label>
			</div>
			<div class="col-md-3">
                 <input type="text"  class="form-control" placeholder="matricule" name="im" id="im" value="<?php echo $nom; ?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> CIN </label>
			</div>
			<div class="col-md-3">
                 <input type="text"  class="form-control" placeholder="CIN" name="cin" id="cin" value="<?php echo $nom; ?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> Nom </label>
			</div>
			<div class="col-md-6">
                            <input type="text"  class="form-control" placeholder="Nom " name="nom" id="nom" value="<?php echo $nom; ?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label"> Pr&eacute;noms </label>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="<?php echo $prenom; ?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Statut </label>
			</div>
			<div class="col-md-3">
					<select class="form-control" placeholder="Status" name="statut" data-placement="top"  data-toggle="tooltip" data-original-title="Hamarino ny momba anao na ECD, na ELD, na EMO, na ES, na EFA, na Fonctionnaire"id="statut">
							<?php foreach($list_statut as $d){ 
									$selected = ($d['id'] == $statut)  ? ' selected="selected"' : '';
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
					</select>
			</div>
			<div class="col-md-5"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Corps </label>
			</div>
			
			<div class="col-md-3">
                            <select id="corps" class="form-control" placeholder="Status" name="corps"  data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « corps »-nao dia mila misafidy ianao">
							<?php
							
							
							foreach($list_corps as $d){ 

									$selected = "";

									if((string)$d['id'] == (string)$corps_id)
									{
										$selected = ' selected="selected"';
									}

									
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
							<option  value="0">AUTRES</option> 
                            </select>
			</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Grade </label>
			</div>
			<div class="col-md-3">
					<select class="form-control" placeholder="Grade" name="grade" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Grade »-nao dia mila misafidy ianao" id="grade">
							<?php 
							
								foreach($list_grade as $d){ 

									$selected = '';

									if((string)$d['id'] == (string)$grade_id)
									{
										$selected = ' selected="selected"';
									}
							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
									<option  value="0">AUTRES</option> 
					</select>
			</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form">
					<label class="control-label "> Indice </label>
			</div>
			<div class="col-md-3">
					<select class="form-control" placeholder="Status" name="indice" data-placement="top" data-toggle="tooltip" data-original-title="Raha tsy mivoaka ny « Indice »-nao nao dia mila misafidy ianao" id="indice">
							<?php 
								foreach($list_indice as $d){ 

									$selected = "";

									if((string)$d['id'] == (string)$indice_id)
									{
										$selected = ' selected="selected"';
									}

							?>
									<option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
							<?php }?>
									<option  value="0">AUTRES</option> 
					</select>
			</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 labelForm libele_form">
                            <label class="control-label">Date de prise de service</label>
                    </div>
                    <div class="col-md-3" id="date_prise_service_div">
                            <input type="text" id="date_prise_service" class="form-control" placeholder="Date de prise de service" data-placement="top" data-toggle="tooltip" data-original-title="Ampidiro ny  andro/volana/taona  nidiranao niasa teto amin’ny Ministeran’ny Fitantanambola sy ny Teti-bola" name="date_prise_service" value="<?php echo $date_prise_service;?>"/>
                            <span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
                    </div>
                    <div class="col-md-5"></div>
        </div>
		
		
		<br>
		<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 labelForm libele_form">
                            <label class="control-label">Date de Naissance</label>
                    </div>
                    <div class="col-md-3">
                            <input type="text" id="date_naiss" class="form-control"  placeholder="Date de Naissance" name="date_naiss" value="<?php echo $date_naiss;?>" >
                            <span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
                    </div>
                    <div class="col-md-5"></div>
        </div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 labelForm libele_form">
				<label class="control-label">Nombre d&acute;enfants</label>
			</div>
			<div class="col-md-3">
				<input type="text" id="nbr_enfant" style="width:45px;" maxlength="2" class="form-control" name="nbr_enfant" data-toggle="tooltip" data-original-title= " Soraty ny isan’ny ankizy"value="<?php echo $nbr_enfant;?>">
			</div>
		</div>	
		<br>
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-4"></div>
			<div class="col-md-2">
					<input type='submit' class="btn btn-primary form-control " data-toggle="tooltip" data-original-title=" Tsindrio rehefa feno daholo ny momba anao rehetra " value='Enregistrer' />	
			</div>
		</div>
	</div>
</form>	
<script>
   <?php if($msg_error){?>
	alert('<?php echo $msg_error?>');
   <?php }?>
   <?php if($msg_success){?>
	alert('<?php echo $msg_success?>');
   <?php }?>
 $(document).ready(function() {
	$("#date_prise_service").mask("99/99/9999");
	$("#date_naiss").mask("99/99/9999");
	$("#date_prise_service").datepicker({
		 language: "fr",
		 autoclose: true,
		 todayHighlight: true,
		 format: "dd/mm/yyyy"
	});
	$("#date_naiss").datepicker({
		 language: "fr",
		 autoclose: true,
		 todayHighlight: true,
		 format: "dd/mm/yyyy"
	});
	 $("#cin").mask("999 999 999 999"); 
	 $("#im").mask("999999");
 });
</script>