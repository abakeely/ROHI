<!DOCTYPE html> 
<?php 
    $mat = "";
    $nom_edit = "";
    $login_edit = "";
    $new = false;
    $old = false;
    $password_edit = "";
    $confirm_password_edit = "";
    if(isset($type)){
        if($type == 1)
            $new = true;
        if($type == 2)
            $old = true;
        
    }
    
    if(isset($matricule))
        $mat = $matricule;
    if(isset($nom))
        $nom_edit = $nom;
    if(isset($login))
        $login_edit = $login;
    if(isset($password))
        $password_edit = $password;
    if(isset($confirm_password))
        $confirm_password_edit = $confirm_password;
    
    //$message = '';
	/*
    if(isset($messageError)){
            $message = $messageError;
    }
	*/
?>
<html style="height: 100%;"> 
	<head> 
		<meta charset="utf-8"> <title>Registration On Line</title> 
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min-3.0.0.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/BrightSide.css">

		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">

		<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-dialog.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
                
                <script src="<?php echo base_url();?>assets/js/formValidation.min.js"></script>
                <script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js"></script>
                
                <style>
                    .withValidate{
                        display:none
                    }
                </style>
               
                <script>
                    var nom_Current = '';
                    function validerMatricule(){
                        var matricule = $('#matricule').val();
                        $.ajax({
                            url : "<?php echo base_url();?>account/check_matricule/"+matricule,
                            type: 'GET',
                            async: false,
		            cache: false,
                            success: function(data, textStatus, jqXHR) {
                               var objetJSON = $.parseJSON(data);
                               if(objetJSON.status == 'ok'){
                                   $('#btnQuest').html('<i class="la la-check-square" style="font-size: 24pt;">')
                                   $('#nomRow').show();
                                   $('#nomRow').focus();
                                   nom_Current = objetJSON.nom;
                                   
                               }
                               else{
                                   $('#btnQuest').append('<i class="la la-times-circle-o" style="font-size: 24pt;">')
                               }
                               
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    alert("error=>" + errorThrown);
                                    // Une erreur s'est produite lors de la requete
                                    }
                         });	
                    }
                    function validerNom(){
                        var nom  = $("#nom").val();
                        if(nom_Current.indexOf(nom)>-1){
                           $('#nomConfirmRow').show();
                           $("#nomRow").hide();
                           $('#loginRow').show();
                           $('#passwordRow').show();
                           $('#confirm_passwordRow').show();
                           $('#btn_confirmRow').show();

                            $('#nomConfirm').val(nom_Current);  
                        }
                        
                    }
                    
                    function validerConfirmNom(){
                        $('#nomConfirmRow').hide();  
                    }
                    
                    function cliqueNouveau(){
                        $('#nom').hide();  
                    }
                    
                    function cliqueAncien(){
                        $('#nom').show();  
                    }
                    
                    $(document).ready(function() {  
                        $('#create_form').bootstrapValidator({
                            excluded:':not(:visible)',
                            onError: function(e) {},
                            onSuccess: function(e) {},
                            fields : {
                                    type : {
                                            validators : {
                                                    notEmpty : {
                                                            message : 'Choisir votre type'
                                                    }
                                            }
                                    },
                                    matricule : {
                                            validators : {
                                                    notEmpty : {
                                                            message : 'Veuillez saisir votre matricule'
                                                    }
                                            }
                                    },
                                    login : {
                                            validators : {
                                                    notEmpty : {
                                                            message : 'Veuillez saisir votre Pseudo'
                                                    }
                                            }
                                    },
                                    password : {
                                            validators : {
                                                    notEmpty : {
                                                            message : 'Veuillez saisir votre Password'
                                                    }
                                            }
                                    },
                                    confirm_password : {
                                            validators : {
                                                    notEmpty : {
                                                            message : 'Confirmer votre Password'
                                                    }
                                            }
                                    },
                                    nom: {
                                            validators : {
                                                    notEmpty : {
                                                            message : 'Confirmer votre Nom'
                                                    }
                                            }
                                    }
                            }
                        });
                    });
                    
                </script>
	</head> 
	<body style="background:none">	
            <div id="content-wrap" class="row" style="margin-top: 0%;background-color : #ececec"> 
              <div class="col-md-4"></div>
              <div class="col-md-4">  
                <form class="form-horizontal form_login" role="form" name="create_form"  id="create_form" action="<?php echo base_url();?>account/create" method="POST" style=" height: 45em !important;">
                      <br>
                     <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                    <img src="<?php echo base_url();?>assets/img/mfb.jpg" width="90%"/>
                            </div>
                            <div class="col-md-3"></div>
                     </div>
                     <?php if(isset($message)){?>
					 <br>
                         <div class="row" style="color: red;">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                  <?php echo $message ;?>  
                            </div>
                            <div class="col-md-1"></div>
                     </div>
                     <?php }?>
                     <br>
                      <div class="row">
                         <div class="col-md-3"></div>
                         <div class="col-md-6">
                           
                         </div>
                         <div class="col-md-1" style="padding-left: 0"> </div>
                      </div>
                      <br>
                      <div class="row">
                         <div class="col-md-3"></div>
                         <div class="col-md-6">
                            <input type="text" id="matricule" class="form-control" placeholder="Saisissez votre matricule" name="matricule" value="<?php echo $mat;?>">
                         </div>
                         <div class="col-md-1" style="padding-left: 0"> </div>
                      </div>
                      <br>
                      <div class="row" id="nomRow">
                         <div class="col-md-3"></div>
                         <div class="col-md-6">
                                <input type="text" id="nom" class="form-control" placeholder="Saisissez votre nom" name="nom" value="<?php echo $nom_edit;?>">
                         </div>
                         <div class="col-md-1"></div>
                     </div>
                     <br>
					  <div class="row" id="nomRow">
                         <div class="col-md-3"></div>
                         <div class="col-md-6">
                                <input type="text" id="nom" class="form-control" placeholder="Saisissez votre pr&eacute;nom" name="nom" value="<?php echo $nom_edit;?>">
                         </div>
                         <div class="col-md-1"></div>
                     </div>
					 <br>
                     <div class="row" id="loginRow">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                              <input type="text" id="login" class="form-control" placeholder="Pseudo" name="login" value="<?php echo $login_edit;?>">
                          </div>
                          <div class="col-md-3"> </div>
                    </div>
                    <br>
					 <div class="row">
                         <div class="col-md-3"></div>
                         <div class="col-md-6">
                            <input type="text" id="matricule" class="form-control" placeholder="Saisissez votre CIN" name="matricule" value="<?php echo $mat;?>">
                         </div>
                         <div class="col-md-1" style="padding-left: 0"> </div>
                      </div>
					  <br>
                    <div class="row" id="passwordRow">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="password" class="form-control" placeholder="Mot de passe" name="password" value="<?php echo $password_edit;?>">
                            </div>
                            <div class="col-md-3">
                            </div>
                    </div>
                    <br>
                    <div class="row" id="confirm_passwordRow">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirmation mot de passe" name="confirm_password" value="<?php echo $confirm_password_edit;?>">
                            </div>
                            <div class="col-md-3">
                            </div>
                    </div>
                    <br>
                    <div class="row" id="btn_confirmRow" >
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                              <input type='submit' class="btn btn-primary form-control" value='Cr&eacute;ation Compte' style="background:green"/>	
                      </div>
                      <div class="col-md-3"></div>				
                   </div>
                </form> 
              </div>
              <div class="col-md-4"></div>
            </div>
	</body>
</html> 