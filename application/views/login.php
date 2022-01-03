<!DOCTYPE html> 
<?php 
    $version = '?2017V3';
	
    $mat = "";
    $nom_edit = "";
	$prenom_edit = "";
    $login_edit = "";
	$cin_edit = "";
	$sexe_edit = "";
	$statut_edit = "";
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
	if(isset($prenom))
        $prenom_edit = $prenom;
    if(isset($login))
        $login_edit = $login;
    if(isset($cin))
        $cin_edit = $cin;
    if(isset($sexe))
        $sexe_edit = $sexe;
	if(isset($statut))
        $statut_edit = $statut;
    
    //$message = '';
	/*
    if(isset($messageError)){
            $message = $messageError;
    }
	*/
?>
<html style="height: 100%;"> 
	<head> 
		<meta charset="utf-8"> <title>Accueil</title> 
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min-3.0.0.css<?php echo $version;?>">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css<?php echo $version;?>20180601">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/BrightSide.css<?php echo $version;?>">

		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css<?php echo $version;?>20180601" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css<?php echo $version;?>" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/font-awesome.min.css<?php echo $version;?>" rel="stylesheet">

		<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-dialog.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.js<?php echo $version;?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootbox.min.js<?php echo $version;?>"></script>
                
                <script src="<?php echo base_url();?>assets/js/formValidation.min.js<?php echo $version;?>"></script>
                <script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js<?php echo $version;?>"></script>
                
                <script src="<?php echo base_url();?>assets/js/home.js<?php echo $version;?>"></script>
		
	</head> 
<!--background="assets/css/fondRohy.jpg"-->
	<style>
		.help-block {width:180px!important;}
    </style>
	<body class = "fond" onload="showMessage()">	
	<input type="hidden" value="<?php echo base_url();?>" id="url_base"/>
	<div>
		<div class="row" style="height:5em"></div>
		<div class="bandeau row">
			<div class="col-md-12"><span style="color:#e01515">R</span>ess<span style="color:#e01515">O</span>urces <span style="color:#e01515">H</span>umaines <span style="color:#e01515">I</span>nformatis&eacute;es</div>
		</div>
		<?php
			$data = array();
			$data['list_statut'] = $list_statut;
			$data['mat'] = $mat;
			$data['nom_edit'] = $nom_edit;
			$data['prenom_edit'] = $prenom_edit;
			$data['sexe_edit'] = $sexe_edit;
			$data['cin_edit'] = $cin_edit;
			$data['login_edit'] = $login_edit;
			;?>
			
		<!-- Div pour le formulaire -->
		<div class="row" id="form_div">
			<?php 
				//var_dump($type);
				if(!isset($type) || $type==0){
					$this->load->view('login/form_login');
				}
				else if($type==1){
					$this->load->view('login/change_password',$data);
				}
				else if($type==2){
					$this->load->view('login/form_inscription',$data);
				}
			?>
			
	    </div>
	    <div id="form_login" style="display: none">
	    	<?php $this->load->view('login/form_login');?>
	    </div>
	    <div id="form_change" style="display: none">
	    	<?php $this->load->view('login/change_password',$data);?>
	    </div>
	    <div id="form_inscription" style="display: none">
	    	<?php $this->load->view('login/form_inscription',$data);?>
	    </div>
	    
	<!--  
          
       -->
		</div>
	</body>
</html> 
<script>
function showMessage(){
	<?php if(isset($message)) echo 'bootbox.alert("'.$message.'");' ;?> 
	   <?php if(!isset($type) || $type==0){ ?>
	   		validationLogin();
	    <?php } else if($type==1){?>
	    	validationChangePseudo();
	    <?php } else if($type==2){?>
	    	validationCreeCompte();
	    <?php }?>
}
/*
jQuery(document).ready(function() {
	<?php if(isset($message)) echo 'bootbox.alert("'.$message.'");' ;?> 
   <?php if(!isset($type) || $type==0){ ?>
   		validationLogin();
    <?php } else if($type==1){?>
    	validationChangePseudo();
    <?php } else if($type==2){?>
    	validationCreeCompte();
    <?php }?>
});
*/
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
			case "8":
				$("#matricule").attr("placeholder","Votre matricule");
				$("#matricule").removeAttr("readonly");
				$("#matricule").mask("999 999");
				$("#matricule").focus();
				break;
		}
	});	
}

function clickCreerCompte(){
	$("#form_div").html("");
	var html = $("#form_inscription").html();
	$("#form_div").html(html);
	validationCreeCompte();
}

function retour(){
	$("#form_div").html("");
	var html = $("#form_login").html();
	$("#form_div").html(html);
	validationLogin();
	
}

function changePassword(){
	$("#form_div").html("");
	var html = $("#form_change").html();
	$("#form_div").html(html);
	validationChangePseudo();
}

function validationCreeCompte(){
	$("#cin").mask("999 999 999 999");
	$("#matricule").attr("readonly","readonly");
	$('input').tooltip();
    $('select').tooltip();
    $('button').tooltip();
	$("#matricule").mask("999 999");
	
	//$("#matricule").attr("readonly","readonly");
	$("#matricule").attr("placeholder","");
	
	$("#cin").on("change", function(a) {
			$('#create_form').bootstrapValidator('revalidateField', 'cin');
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
										message : 'Veuillez remplir votre matricule'
								}
						}
				},
				nom: {
						validators : {
								notEmpty : {
										message : 'Veuillez remplir votre nom'
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
										message : 'Veuillez remplir votre CIN'
								}
						}
				},
				login: {
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
								}/*,
								stringLength: {
									  min: 4,
									  max: 8,
									  message: 'Le mot de passe doit être 4 à 8 caractères'
								}*/
						}
				},
				confirm_password: {
					validators : {
								notEmpty : {
										message : 'Veuillez remplir votre mot de passe'
								},
					}
				}
            }
    });
}

function validationChangePseudo(){
	$('input').tooltip();
    $('select').tooltip();
    $('button').tooltip();
	$("#matricule").mask("999999");
	$("#carte").mask("99999 99999");
	
	
	
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
								}/*,
								stringLength: {
									  min: 4,
									  max: 8,
									  message: 'Le mot de passe doit être compos&eacute; de 4 à 8 caractères'
								}*/
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
}

function validationLogin(){
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
	$('input').tooltip();
	$('select').tooltip();
	$('button').tooltip();
}

function validerMatricule(){
    var matricule = $('#matricule').val();
    $.ajax({
        url : "user/check_matricule/"+matricule,
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
</script>