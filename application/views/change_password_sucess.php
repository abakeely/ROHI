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
                
		<script src="<?php echo base_url();?>assets/js/bootbox.min.js<?php echo $version;?>"></script>
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
              <div class="col-md-7">  
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
               		
                </div>
            </div>
			</div>
			
				
           <br>
			<div id="etat">
				<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
						<div class="modal-content" style="height:100%">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  
							</div>
							<div class="modal-body" id="detailPrint" style="text-align: center;">
								Changement de login et mot de passe effectu&eacute; avec succ&egrave;s!
							</div>
							<div class="modal-footer">
								  <button type="button" class="btn btn-default" data-dismiss="modal" id="fermerApropos">OK</button>
							</div> 
						</div>
				 </div>
				</div>
			</div>
	</body>
</html> 
<script>
$(document).ready(function() {
	$('#etat').show();
    $('#modalDetail').modal();
	jQuery('#modalDetail').on('hide.bs.modal', function (e) {
    	window.location = "<?php echo base_url();?>"; 
   }); 
    //bootbox.alert("Votre pseudo et mot de passe ont &eacute;t&eacute; bien reinitialis&eacute;s");
    //window.location = "<?php echo base_url();?>";
});
</script>