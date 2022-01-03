<div class="col-md-8"></div>
<div class="col-md-3 form_login">  
  <form name="create_form"  id="create_form" action="<?php echo base_url();?>user/change_mot_passe" method="POST">
	  <input type="hidden" name="isCheckCarte" id="isCheckCarte" value="0">
	  <br>
	  <div class="row ">
			<div class="col-md-12" style="text-align: center;">
				 <img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="200px" height="100px" align="center"/>
			</div>
	   </div>
	   <br>
	   <div class="row">
			<div class="col-md-12" style="color:black;font-size: 1.2em; ">
			Changement  pseudo et  mot de passe
		</div>			
	</div>
	 <br>
	 <div class="row">
			<div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">CIN</div>
			<div class="col-md-9">
			<input type="text" id="cin" class="form-control" name="cin" data-original-title="Ampidiro ny laharan&acute;ny karampanodronao" value="<?php echo isset($cin)?$cin:'';?>">
			 </div>
	  </div>
	  <br>
	  <div class="row">
		  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">T&eacute;l&eacute;phone</div>
		  <div class="col-md-9">
			 <input type="text" id="phone" class="form-control" name="phone" data-original-title="Ampidiro ny laharan&acute;ny finday izay ao anatin&acute;ny CV anao "value="<?php echo isset($phone)?$phone:'';;?>">
		  </div>
	   </div>
	  <br>
	  <div class="row">
		<div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">Statut</div>
		<div class="col-md-9">
				<select class="form-control" placeholder="Status" name="statut" onChange="changeStatut(this.value);" data-placement="top" data-toggle="tooltip" data-original-title="Hamarino ny momba anao na Fonctionnaire, na HEE, na EFA, na ECD, na ELD, na EMO, na ES" id="statut">
						<?php foreach($list_statut as $d){ ?>
								<option  value=<?php echo $d['id'];?>><?php echo $d['libele'];?></option>
						<?php }?>
				</select>
		 </div>
	  </div>
	  <br>
	  <div class="row">
		  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">Matricule</div>
		  <div class="col-md-9">
			 <input type="text" id="matricule" class="form-control" name="matricule" data-original-title="Ampidiro ny «matricule-nao».Tsy asiana teboka na elanelana"value="<?php echo isset($im)?$im:'';?>">
		  </div>
	 </div>
	 <br>
	 <div class="row">
		  <div class="col-md-10">
			<table class="notationCritere" style="width:100%">
				<tr>
					<td style="width:100%;vertical-align:top;" colspan="2"><p class="check" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);"><label>Avez vous une carte ROHI?</label>
					
					</p>
					
					Oui : <input type="radio" style="width:14px;height:14px;" class="radioCarte" id="iCarteRohi" name="iCarteRohi" value="1">
					Non : <input type="radio" style="width:14px;height:14px;" class="radioCarte" name="iCarteRohi" checked="checked" value="0">
					
					</td>
				</tr>
			</table>
		  </div>
	 </div>
	 <div class="row" id="iCarteRohiAffiche" style="display:none;">
		  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">N° Carte</div>
		  <div class="col-md-9">
			 <input type="text" id="carte" class="form-control" name="carte" placeHolder="10 premiers chiffres" data-original-title="Ampidiro ny laharana 10 voalohany eo amin'ny Karatra ROHI eo ampelatananao" value="">
		  </div>
	 </div>

	  <br>
	  <div class="row">
		  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">Pseudo</div>
		  <div class="col-md-9">
			 <input type="text" id="login" class="form-control" name="login" data-original-title="Ampidiro ny «pseudo» vaovao izay nosafidinao "value="<?php echo isset($login)?$login:'';?>">
		  </div>
	  </div>
	  <br>
	  <div class="row">
		  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">Mot de passe</div>
		  <div class="col-md-9">
			 <input type="password" id="password" class="form-control" name="password" data-original-title="Ampidiro ny teny miafina na «mot de passe» izay nosafidinao "value="">
		  </div>
	  </div>
	  <br>
	  <div class="row">
		  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);;background: rgba(255, 255, 255, 0);">Confirmation mot de passe</div>
		  <div class="col-md-9">
			 <input type="password" id="confirm_password" class="form-control" name="confirm_password" data-original-title="Hamarino ilay teny miafina na «mot de passe» nosafidianao tery ambony  "value="">
		  </div>
		  <div class="col-md-1" style="padding-left: 0"> </div>
	  </div>
	  <br>
	  <div class="row">
		<div class="col-md-12"><button class="btn btn-primary form-control"  type="submit" onclick="clickValide()">Enregister</button></div>
	  </div>
	  <br> 
	  <div class="row">
		  <div class="col-md-12" style="text-align: center;">
				<a onclick="retour()" href="#" >Retour</a>
		  </div>			
	  </div>
	 <div class="row"><br> </div>
	 
  </form> 
  <div class="col-md-1"></div>
</div>
<script>
	$('.radioCarte').click(function(){
		
		var iValue = $(this).val();  

		switch (iValue) {
			case '1':
				$("#iCarteRohiAffiche").show();
				$("#isCheckCarte").val(1);
				break;

			case '0':
				$("#iCarteRohiAffiche").hide();
				$("#isCheckCarte").val(0);
				break;
		}

		
	});  
</script>