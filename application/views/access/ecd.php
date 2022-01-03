<br><br><br>
<br><br><br><br><br><br>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4 form_login">
	<form class="form-horizontal form_inscription" role="form" name="create_form"  id="create_form" action="<?php echo base_url();?>access/save_ecd" method="POST">
		<br>
		<div class="toggleBloc">
			<div class="row separateur separateur1"><div class="col-md-12">Création compte ECD</div></div>
		</div>
		<br>
	    <div class="row">
		    <div class="col-md-12">
				<input type="text" id="nom" class="form-control" placeholder="Saisissez votre nom" name="nom" data-original-title="Ampidiro ny anaranao" value="<?php echo $nom;?>">
		    </div>
	    </div>
			<br>
		  <div class="row">
				<div class="col-md-12">
					  <input type="text"  onfocus="clickPrenom()" id="prenom" class="form-control" placeholder="Saisissez vos pr&eacute;noms" name="prenom" data-original-title="Rehefa tsindrinao ito «champ» ito dia mivoaka ny fanampin’anarana feno. Raha tsy mivoaka dia mila mameno" value="<?php echo $prenom;?>">
				</div>
		   </div>
		   <br>
		   <div class="row">
			  <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);">Genre</div>
			  <div class="col-md-9">
					<select class="form-control" placeholder="Corps" name="sexe" data-original-title="Misafidy na lahy na vavy" id="sexe">
						 <option  value="">Veuillez S&eacute;lectionner votre genre</option>
						 <option  value="1" <?php if($sexe==1)echo 'selected'?>>Masculin</option>
						 <option  value="0" value="1" <?php if($sexe_edit==2)echo 'selected'?>>Feminin</option>
					</select>
			  </div>
		  </div>
		  <br>
		  <div class="row">
			   <div class="col-md-3" style="font-weight:bold;font-size: 15px;margin-top:1%;text-align:left">CIN</div>
			   <div class="col-md-9">
					<input type="text" id="cin" class="form-control"  placeholder="CIN" name="cin"  data-original-title="Raha tsy mivoaka ny laharana karapanondro-nao dia mila mameno ianao"  value="<?php echo $cin;?>" />
			   </div>
		  </div>
		  <br>
		  <div class="row" id="loginRow" >
				  <div class="col-md-12">
					   <input type="text" id="login" class="form-control" placeholder="Pseudo" name="login" data-original-title="Ampidiro ny «pseudo» nosafidinao" value="<?php echo $login;?>">
				   </div>
			 <div class="col-md-3"> </div>
		  </div>
		  <br>
		  <div class="row" id="passwordRow">
			 <div class="col-md-12">
					 <input type="password" id="password" class="form-control" placeholder="Mot de passe" name="password" data-original-title="Ampidiro ny teny miafina na «mot de passe» nosafidinao" value="">
			  </div>
		  </div>
		  <br>
		  <div class="row" id="confirm_passwordRow">
			  <div class="col-md-12">
				 <input type="password" id="confirm_password" class="form-control" placeholder="Confirmez votre mot de passe" name="confirm_password" data-original-title="Avereno soratana ny teny miafina na « mot de passe »" value="">
			  </div>
		 </div>
		 <br> 
		 <div class="row" id="btnValide" >
			  <div class="col-md-12">
					<input type='submit'  class="btn btn-primary form-control" data-original-title="Rehefa feno ny « champs » rehetra dia tsindrio ito teboka ito. Tandremo : mila tadidinao tsara ny « pseudo » sy « mot de passe »-nao.»" style="font-size: 1.3em; font-weight: bold;arial: cursive" value='Creer compte' style="background:green"/>	
			  </div>			
		  </div>
		 <br>
		 <div class="row">
			  <div class="col-md-12"> </div>			
		  </div>
	  </form>
	  <br>
</div>
<div class="col-md-4"></div>
</div>
<script>
   <?php if($msg_error){?>
	alert('<?php echo $msg_error?>');
   <?php }?>
   <?php if($msg_success){?>
	alert('<?php echo $msg_success?>');
   <?php }?>
   
    $(document).ready(function() {
		 $("#cin").mask("999 999 999 999"); 
	 });
</script>
