	    	<div class="col-md-8"></div>
			<div class="col-md-3 form_login">
				<form class="form-horizontal div_form_login" id="div_form_login" action="<?php echo base_url();?>user/connect" method="POST">
                       <br>
                      <div class="row ">
                       		<div class="col-md-12" style="text-align: center;">
                      			 <img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="200px" height="100px" align="center"/>
                     		</div>
                       </div>
                       <br>
                      <div class="row">
						<div class="col-md-12" style="color:black;font-size: 1.2em; ">
									Acc&eacute;der &agrave; mon compte
						</div>			
					 </div>
					  <br>
                      <div class="row ">
                          <div class="col-md-12">
                              <input placeholder="Pseudo" type="text" width="5" class="form-control" name="login" data-placement="bottom" data-toggle="tooltip" data-original-title="Raha efa manana « compte » ianao dia ampidiro ny « pseudo » anao"/>
                          </div>
                      </div>
                      <br>
                      <div class="row ">
                          <div class="col-md-12">
                              <input placeholder="Mot de passe" type="password" width="4" class="form-control" name="password" data-placement="bottom" data-toggle="tooltip" data-original-title="Ampidiro ny « mot de passe »-nao"/>
                          </div>
                      </div>
                      <br>
                      <div class="row ">
                          <div class="col-md-12">
                               <button style="font-size: 1.5em; font-weight: bold;arial: cursive;height:2em" type="submit" class="btn btn-primary btn-default form-control" onclick="printDetail()" data-placement="bottom" data-toggle="tooltip" data-original-title="Tsindrio rehefa tafiditra ny « pseudo » sy ny « mot de passe »">Se connecter </button>
                          </div>
                      </div>
                      <div class="row">
                      		<div class="col-md-12" style="text-align: center;">
                     			<a style="color:black;" href="#" onclick="changePassword()"><font size="1rem">Pseudo ou mot de passe oubli&eacute; ?</font></font></a>
				  	  		</div>
				  	  </div>
                      <br><br>
                      <div class="row" >
							<div class="col-md-12" style="text-align: center;color:black">
	                             Vous n'avez pas de compte ?<br>
	                             <a onclick="clickCreerCompte()" href="#" >Cr&eacute;er un compte</a>	
							</div>			
					 </div>
					 <br>
					 <div class="item active" style="text-align:center;">
                           <a><img src="<?php echo base_url();?>assets/img/manuel.png" width="60px" height="80px"/></a>
                           <br>
                           <a href="<?php echo base_url();?>assets/pdf/MANUEL_D_UTILISATION.pdf">Veuillez cliquer ici pour telecharger <br>le "Manuel D'Utilisation ROHI"</a><br><br>
						   <a href="<?php echo base_url();?>assets/pdf/DECRET.pdf">Code de Déontologie de l´Administration et de bonne conduite des agents de l´Etat</a>
                     </div>
                  </form>
                  <br>
			</div>
			<div class="col-md-1"></div>
	