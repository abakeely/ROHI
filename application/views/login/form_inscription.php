	    	<div class="col-md-8"></div>
			<div class="col-md-3 form_login">
				<form class="form-horizontal form_inscription" role="form" name="create_form"  id="create_form" action="<?php echo base_url();?>user/create" method="POST">
                       <br>
                      <div class="row ">
                       		<div class="col-md-12" style="text-align: center;">
                      			 <img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="200px" height="100px" align="center"/>
                     		</div>
                       </div>
                       
                      <div class="row">
                      		<div class="col-md-12" style="text-align: center;font-size:1.2em">
                     			Inscrivez-vous ici 
				  	  		</div>
				  	  </div>
				  	  <br>
                      <div class="row">
						<div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);">Statut</div>
						<div class="col-md-9">
								<select class="form-control" placeholder="Status" name="statut" onChange="changeStatut(this.value);" data-placement="top" data-toggle="tooltip" data-original-title="Hamarino ny momba anao na Fonctionnaire, na HEE, na EFA, na ECD, na ELD, na EMO, na ES" id="statut">
										<?php foreach($list_statut as $d){ 
											$select = "";
											if($d['id']==$statut_edit)$select = "selected";
										?>
												<option  <?php echo $select;?> value=<?php echo $d['id'];?>><?php echo $d['libele'];?></option>
										<?php }?>
								</select>
					     </div>
					  </div>
					  <br>
                      <div class="row">
						 <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);">Matricule</div>
                         <div class="col-md-9">
                                      <input type="text" id="matricule" class="form-control" name="matricule" data-original-title="Ampidiro ny «matricule»-nao. Tsy asiana teboka na elanelana. Raha tsy manana «matricule» ianao dia soraty mazava na ECD, na EMO, na ES  ny sokajy misy anao "value="<?php echo $mat;?>">
                         </div>
                      </div>
                      <br>
                      <div class="row">
                          <div class="col-md-12">
                             <input type="text" id="nom" class="form-control" placeholder="Saisissez votre nom" name="nom" data-original-title="Ampidiro ny anaranao" value="<?php echo $nom_edit;?>">
                          </div>
                       </div>
                        <br>
                      <div class="row">
                            <div class="col-md-12">
                                  <input type="text"  onfocus="clickPrenom()" id="prenom" class="form-control" placeholder="Saisissez vos pr&eacute;noms" name="prenom" data-original-title="Rehefa tsindrinao ito «champ» ito dia mivoaka ny fanampin’anarana feno. Raha tsy mivoaka dia mila mameno" value="<?php echo $prenom_edit;?>">
                            </div>
                       </div>
                       <br>
                       <div class="row">
                          <div class="col-md-3" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left;background: rgba(255, 255, 255, 0);">Genre</div>
                          <div class="col-md-9">
                                <select class="form-control" placeholder="Corps" name="sexe" data-original-title="Misafidy na lahy na vavy" id="sexe">
                                     <option  value="">Veuillez S&eacute;lectionner votre genre</option>
									 <option  value="1" <?php if($sexe_edit==1)echo 'selected'?>>Masculin</option>
                                     <option  value="0" value="1" <?php if($sexe_edit==2)echo 'selected'?>>Feminin</option>
                                </select>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                           <div class="col-md-3" style="font-weight:bold;font-size: 15px;margin-top:1%;text-align:left">CIN</div>
                           <div class="col-md-9">
								<input type="text" id="cin" class="form-control"  placeholder="CIN" name="cin"  data-original-title="Raha tsy mivoaka ny laharana karapanondro-nao dia mila mameno ianao"  value="<?php echo $cin_edit;?>" />
                           </div>
                      </div>
                      <br>
                      <div class="row" id="loginRow" >
                              <div class="col-md-12">
                                   <input type="text" id="login" class="form-control" placeholder="Pseudo" name="login" data-original-title="Ampidiro ny «pseudo» nosafidinao" value="<?php echo $login_edit;?>">
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
                                <input type='submit'  class="btn btn-primary form-control" data-original-title="Rehefa feno ny « champs » rehetra dia tsindrio ito teboka ito. Tandremo : mila tadidinao tsara ny « pseudo » sy « mot de passe »-nao.»" style="font-size: 1.3em; font-weight: bold;arial: cursive" value='Inscription' style="background:green"/>	
                          </div>			
                      </div>
                      <br> 
                     <div class="row">
                          <div class="col-md-12" style="text-align: center;">
                         		<a onclick="retour()" href="#" >Retour</a>
                          </div>			
                      </div>
                     <br>
                     <div class="row">
                          <div class="col-md-12"> </div>			
                      </div>
                  </form>
                  <br>
			</div>
			<div class="col-md-1"></div>
			<style>
			a {
				color: #428bca;
			}
			</style>