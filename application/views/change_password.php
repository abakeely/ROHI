<!DOCTYPE html> 
<?php 
    $version = '?V2';
	
?>
<html style="height: 100%;"> 
	<head> 
		<meta charset="utf-8"> <title>Accueil</title> 
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min-3.0.0.css<?php echo $version;?>">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css<?php echo $version;?>">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/BrightSide.css<?php echo $version;?>">

		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css<?php echo $version;?>" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css<?php echo $version;?>" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/font-awesome.min.css<?php echo $version;?>" rel="stylesheet">

		<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-dialog.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.js<?php echo $version;?>"></script>
                
                <script src="<?php echo base_url();?>assets/js/formValidation.min.js<?php echo $version;?>"></script>
                <script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js<?php echo $version;?>"></script>
                
                <script src="<?php echo base_url();?>assets/js/home.js<?php echo $version;?>"></script>
		
	</head> 
<!--background="assets/css/fondRohy.jpg"-->
	<style>
		.help-block {width:180px!important;}
    </style>
	<body>	
	<div class = "fond">
            <input type="hidden" value="<?php echo base_url();?>" id="url_base"/>
            <div class="row" > 
              <div class="col-md-1 logo_titre"></div>	
              <div class="col-md-7" style="color:red">  
             
              </div>
              <div class="col-md-4 ">
              </div>	
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12"> 
                            <br><!--<RessOurces Humaines Informatis&eacute; -->
                            		
                        </div> 
                    </div>
                    <br><br><br><br><br>
                    <div class="row">
                        <div id="slide" class="col-md-10" style="top: 60%; left: 60%; ">
                               <div id="'id1" class="carousel slide" data-ride="carousel">
                                       <div class="carousel-inner">
                                               <div class="item active">
                                                   <a><img class="form-control imgLogo" src="<?php echo base_url();?>assets/img/def1.jpg" /></a>
                                               </div>
                                               <div class="item">
                                                   <a><img class="form-control imgLogo" src="<?php echo base_url();?>assets/img/def2.jpg" /></a>
                                               </div>
                                               <div class="item">
                                                       <a><img  class="form-control imgLogo" src="<?php echo base_url();?>assets/img/def3.jpg"  /></a>
                                               </div>
                                       </div>
                               </div>
                       </div>
                   </div>  
                   <br> 
                </div>
                
                <div class="col-md-1"></div>
                <div class="col-md-5">
               		 <br><br><br><br>
               		  <div class="row" > 
			              <div class="col-md-1 logo_titre"></div>	
			              <div class="col-md-7" style="color:red">  
			              <?php if(isset($msg))
			              			echo $msg;
			              	?>
			              </div>
			              <div class="col-md-4 ">
			              </div>	
           			 </div>
                    <div class="row"> 
                        <div class="col-md-15">  
                          <form class="form-horizontal form_inscription" role="form" name="create_form"  id="create_form" action="<?php echo base_url();?>user/change_mot_passe" method="POST">
                             <div class="row">
				                 <div class="col-md-3"></div>
								<div class="col-md-2" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left">CIN</div>
				                <div class="col-md-3">
				                <input type="text" id="cin" class="form-control" name="cin" data-original-title="Ampidiro ny laharan&acute;ny karampanodronao" value="<?php echo isset($cin)?$cin:'';?>">
				                 </div>
				                 <div class="col-md-1" style="padding-left: 0"> </div>
				                 </div>
				                 <br>
				                 <br>
								  <div class="row">
				                  <div class="col-md-3"></div>
								  <div class="col-md-2" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left">T&eacute;l&eacute;phone</div>
				                  <div class="col-md-3">
				                     <input type="text" id="phone" class="form-control" name="phone" data-original-title="Ampidiro ny laharan&acute;ny finday izay ao anatin&acute;ny CV anao "value="<?php echo isset($phone)?$phone:'';;?>">
				                  </div>
				                  <div class="col-md-1" style="padding-left: 0"> </div>
				                  </div>
				                  <br>
				                  <div class="row">
				                  <div class="col-md-3"></div>
								  <div class="col-md-2" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left">Matricule</div>
				                  <div class="col-md-3">
				                     <input type="text" id="matricule" class="form-control" name="matricule" data-original-title="Ampidiro ny «matricule-nao».Tsy asiana teboka na elanelana"value="<?php echo isset($im)?$im:'';?>">
				                  </div>
				                  <div class="col-md-1" style="padding-left: 0"> </div>
				                  </div>
				                  <br>
				                  <div class="row">
				                  <div class="col-md-3"></div>
								  <div class="col-md-2" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left">Pseudo</div>
				                  <div class="col-md-3">
				                     <input type="text" id="login" class="form-control" name="login" data-original-title="Ampidiro ny «pseudo» vaovao izay nosafidinao "value="<?php echo isset($login)?$login:'';?>">
				                  </div>
				                  <div class="col-md-1" style="padding-left: 0"> </div>
				                  </div>
				                  <br>
				                  <div class="row">
				                  <div class="col-md-3"></div>
								  <div class="col-md-2" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left">Mot de passe</div>
				                  <div class="col-md-3">
				                     <input type="password" id="password" class="form-control" name="password" data-original-title="Ampidiro ny teny miafina na «mot de passe» izay nosafidinao "value="">
				                  </div>
				                  <div class="col-md-1" style="padding-left: 0"> </div>
				                  </div>
				                  <br>
				                  <div class="row">
				                  <div class="col-md-3"></div>
								  <div class="col-md-2" style="font-weight:bold;font-size: 15px; margin-top:1%; text-align:left">Confirmation de mot de passe</div>
				                  <div class="col-md-3">
				                     <input type="password" id="confirm_password" class="form-control" name="confirm_password" data-original-title="Hamarino ilay teny miafina na «mot de passe» nosafidianao tery ambony  "value="">
				                  </div>
				                  <div class="col-md-1" style="padding-left: 0"> </div>
				                  </div>
				                  <br><br>
				                  <div class="row">
				           		<div class="col-md-4"></div>
				           		<div class="col-md-3"></div>
				           		<div class="col-md-2"><button class="form-control"  type="submit" onclick="clickValide()">Enregister</button></div>
				           		<div class="col-md-1"></div>
				           </div>
                             
                          </form> 
                        </div>
                      </div>
                </div>
            </div>
			</div>
			
				
           <br>
			<!--
			<div class="divChat">
				<table>
					<tr>
						<td colspan="2"><textarea id="contenu"></textarea><td>
					</tr>
					<tr>
						<td><input type="text"/></td>
						<td><button type="button" >ENVOYER</button></td>
					</tr>
				</table>
			</div>-->
	</body>
</html> 
<script>
$(document).ready(function() {
	$('input').tooltip();
    $('select').tooltip();
    $('button').tooltip();
	$("#matricule").mask("999999");
	
	
    $("#cin").mask("999 999 999 999");
	$("#cin").on("change", function(a) {
			$('#create_form').bootstrapValidator('revalidateField', 'cin');
	})
	
	
    $("#phone").mask("999 99 999 99");
	$("#phone").on("change", function(a) {
			$('#create_form').bootstrapValidator('revalidateField', 'phone');
	})
	
	$("#matricule").on("change", function(a) {
			$('#create_form').bootstrapValidator('revalidateField', 'matricule');
	})
	
    $('#create_form').bootstrapValidator({
            onError: function(e) {},
            onSuccess: function(e) {},
            fields : {
				 matricule : {
						validators : {
								notEmpty : {
										message : 'Ins&eacute;rez votre matricule'
								}
						}
				},
				phone: {
						validators : {
								notEmpty : {
										message : 'Ins&eacute;rez  votre num&eacute;ro de t&eacute;l&eacute;phone inscrit dans votre CV sur ROHI'
								}
						}
				},
				sexe: {
						validators : {
								notEmpty : {
										message : 'Veuillez s&eacute;lectionner votre genre'
								}
						}
				},
				cin: {
						validators : {
								notEmpty : {
										message : ' Ins&eacute;rez le num&eacute;ro de votre CIN'
								}
						}
				},
				login: {
						validators : {
								notEmpty : {
										message : 'Saisissez votre nouveau pseudo'
								}
						}
				},
				password: {
						validators : {
								notEmpty : {
										message : 'Saisissez votre nouveau mot de passe'
								},
								stringLength: {
									  min: 4,
									  max: 8,
									  message: 'Le mot de passe doit être compos&eacute; de 4 à 8 caractères'
								}
						}
				},
				confirm_password: {
					validators : {
								notEmpty : {
										message : ' Confirmez votre nouveau mot de passe'
								},
					}
				}
            }
    });
	
	$('#div_form_login').bootstrapValidator({
            onError: function(e) {},
            onSuccess: function(e) {},
            fields : {
				 login : {
						validators : {
								notEmpty : {
										message : 'Veuillez remplir votre pseudo'
								}
						}
				},
				password: {
						validators : {
								notEmpty : {
										message : 'Veuillez remplir votre mot de passe'
								}
						}
				}
			}
	});
});

function changeStatut(_iStatut){
	$(document).ready(function() {
		$("#matricule").val("");
		$("#nom").focus();
		switch(_iStatut)
		{
			case "1":
				$("#matricule").attr("readonly","readonly");
				$("#matricule").attr("placeholder","");
				$("#matricule").val("");
				break;
			case "2":
				$("#matricule").attr("readonly","readonly");
				$("#matricule").mask("AAA");
				$("#matricule").val("ECD");
				break;
			case "3":
				$("#matricule").attr("readonly","Votre matricule");
				$("#matricule").removeAttr("readonly");
				$("#matricule").mask("999 999");
				$("#matricule").focus();
				break;
			case "4":
				$("#matricule").attr("readonly","readonly");
				$("#matricule").mask("AAA");
				$("#matricule").val("EMO");
				break;
			case "5":
				$("#matricule").attr("placeholder","Votre matricule");
				$("#matricule").removeAttr("readonly");
				$("#matricule").mask("999 999");
				$("#matricule").focus();
				break;
			case "6":
				$("#matricule").attr("readonly","readonly");
				$("#matricule").mask("AAA");
				$("#matricule").val("ES");
				break;	
			case "7":
				$("#matricule").attr("placeholder","Votre matricule");
				$("#matricule").removeAttr("readonly");
				$("#matricule").mask("999 999");
				$("#matricule").focus();
				break;
		}
	});	
}
</script>