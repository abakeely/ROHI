<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gcap/css/app/select2.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/gcap/js/app/select2.js"></script>
 <style>
 	.modal-header .modal-footer{
 		background : #91c149;
 	}
 </style>
 <div id="content-wrap" class="row"> 
  <div class="col-md-12">
		<br>
	<div class="row separateur"><div class="col-md-12">Modification localité de service (Département / direction / service)</div></div>
	<br>
	<form action="<?php echo base_url(). "gcap/search_matricule"; ?>" method="post">
	<input type="hidden" name="idSelect" id="idSelect" value="<?php echo $candidat->user_id;?>">
	<input type="hidden" name="textSelect" id="textSelect" value="<?php echo $candidat->nom . ' '. $candidat->prenom;?>">
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<select class="form-control" name="type" onchange="changeMask()" id="type">
					<option value="im">MATRICULE</option>
					<option value="cin">CIN</option>
				</select>
			</div>
			<div class="col-md-2">
				<input class="form-control" placeholder="Veuillez entrer le matricule" name="im" value="<?php echo $candidat->matricule?>"/>
			</div>
			<div class="col-md-4"></div>
	</div>
	<br>
	<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-2" id="searchCandidat" style="display:block">
				<input placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
			</div>
	</div>
	<br>
	<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-2"><button class="form-control">Rechercher</button></div>
	</div>
	<div class="row"><div class="col-md-12"><hr></div></div>
	<br>
	<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
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
                            <label class="control-label "> Division </label>
                    </div>
                    <div class="col-md-6">
                        <select <?php echo $zDisabled; ?> class="form-control" placeholder="Division" name="division" data-toggle="tooltip" data-original-title="Safidio ny Division misy anao" id="division">
                                <option  value="999999">-------</option> 
                                <?php foreach($list_division as $d){ 
                                        $selected = ($d['id'] == $division_edit)  ? ' selected="selected"' : '';
                                ?>
                                        <option  value=<?php echo $d['id'];?> <?php echo $selected;?>><?php echo $d['libele'];?></option>
                                <?php }?>
                                <option  value="0">AUTRES</option>        
                        </select>
                    </div>
                    <div class="col-md-2">
                        <?php if($autre_division == ''){?>
                        <input type="text" name="autre_division" class="form-control" id="autre_division" style="display: none"/>
                        <?php } else{?>
                          <input type="text" name="autre_division" class="form-control" id="autre_division" value="<?php echo $autre_division;?>"/>
                        <?php }?>
                    </div>
                    <div class="col-md-2"></div>
	    </div>
		<br>
        <div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label "> Region </label>
			</div>
			<div class="col-md-6">
					<select class="form-control" placeholder="Région" name="region" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="region">
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
				<label class="control-label">T&eacute;l&eacute;phone <b><font color='red'>  </font></b> </label>
			</div>
			<div class="col-md-6">
				<input type="text" id="phone" class="form-control" placeholder="T&eacute;l&eacute;phone" name="phone" data-toggle="tooltip" data-original-title="" value="<?PHP echo $phone;?>">
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3 libele_form">
				<label class="control-label">CIN<b><font color='red'>  </font></b> </label>
			</div>
			<div class="col-md-6">
				<input type="text" id="cin" class="form-control" placeholder="CIN" name="cin" data-toggle="tooltip" data-original-title="" value="<?PHP echo $cin;?>">
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
   		$("#num").mask("999999"); 
		$("#phone").mask("999 99 999 99"); 
		$("#cin").mask("999 999 999 999");
   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#num").mask("999 999 999 999");
   			else
   				$("#num").mask("999999");   
   	   	}

		$(document).ready (function ()
		{
		
			var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidatSearch").select2
			({
				initSelection: function (element, callback)
				{
					
					$(dataArrayAgent).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
				},
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "<?php echo base_url();?>gcap/candidat/",
					dataType: 'jsonp',
					data: function (term)
					{
						return {q: term, iFiltre:1};
					},
					results: function (data)
					{
						return {results: data};
					}
				},
				dropdownCssClass: "bigdrop"
			}) ;

			$("#zCandidatSearch").select2('val',$("#idSelect").val());
		});

   </script>