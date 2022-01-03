<!DOCTYPE html> 
<?php 
    
    $nom = "";
    $prenom = "";
   if(isset($user)){
       $nom = $user['matricule']['nom'];
       $prenom = $user['matricule']['prenom'];
   }
  // var_dump($user);
    
?>
<html style="height: 100%;"> 
	<head> 
		<meta charset="utf-8"> <title>Accueil</title> 
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
		
	</head> 
        
	<body>	
            <div class="row" style="background: green"> 
              <div class="col-md-1"> <img src="<?php echo base_url();?>assets/img/logo_titre.png" class="form-control logo_titre"/></div>	
              <div class="col-md-8"></div>
              <div class="col-md-3">
                  Bonjour <?php echo $nom .' '.$prenom; ?>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12 logo_home_div" >
                     <img src="<?php echo base_url();?>assets/css/fondRohy.jpg" class="form-control image_home"/>
                </div>
                <div class="div_text">
                    <p>Systeme Informatique DRHA</p>
                    Inscription on line a adadadad adadfadf  adfadfd Inscription on line a adadadad adadfadf  adfadfd Inscription on line a adadadad adadfadf  adfadfd 
                </div>
                <div class="div_option option1">
                    Inscription on line
                </div>
                <div class="div_option option2">
                    Gestion CV
                </div>
                <div class="div_option option3">
                    Gestion CV stagiaire
                </div>
            </div>
            <div class="row">
                afadfaf adfa dfa dfadf adfadf adf adf adf adf adfadf afadfaf adfa dfa dfadf adfadf adf adf adf adf adfadf afadfaf adfa dfa dfadf adfadf adf adf adf adf adfadf afadfaf adfa dfa dfadf adfadf adf adf adf adf adfadf afadfaf adfa dfa dfadf adfadf adf adf adf adf adfadf afadfaf adfa dfa dfadf adfadf adf adf adf adf adfadf 
            </div>
	</body>
</html> 