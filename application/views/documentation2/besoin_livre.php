<?php 

    $date_demande_besoin = date('d/m/Y');
	
	$description_besoin ="";
	$theme_besoin ="";
	//$cote_besoin ="";
	$titre_besoin ="";
	$auteur_besoin ="";
	$edition_besoin ="";
	$lieu_besoin ="";
	$langue_besoin ="";
	
	
?>
    <div id="content-wrap" class="row"> 
  		<form class="form-horizontal" role="form" name="documentation" id="besoin_livre" action="<?php echo base_url();?>documentation/ajout_besoin_livre" method="POST">
	<div class="col-md-12">
		<br><br>
		<div align="right">
			<a href="<?php echo base_url();?>documentation/couverture_besoin" class="btn btn-success">Retour</a>
		</div>
		&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;<h4><b>AJOUT BESOINS EN LIVRES</h4></b>
		<div class="row">
			<div class="col-md-1"></div>
			 <div class="col-md-3">
				<label class="control-label"> Description Livre</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<textarea   class="form-control" placeholder="Description Livre" name="description_besoin" id="description_besoin" rows=5 ><?php echo $description_besoin;?></textarea>
			</div>
			<div class="col-md-1">
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Theme</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="theme_besoin" class="form-control" placeholder="Theme Livre" name="theme_besoin" value="<?php echo $theme_besoin;?>">
			</div>
			<div class="col-md-4">
			</div>
		</div>		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Titre Livre </label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="titre_besoin" class="form-control" placeholder="Titre Livre" name="titre_besoin" value="<?php echo $titre_besoin;?>">
				
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Auteur Livre</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="auteur_besoin" class="form-control" placeholder="Auteur Livre" name="auteur_besoin" value="<?php echo $auteur_besoin;?>">
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Edition Livre</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="edition_besoin" class="form-control" placeholder="Edition Livre" name="edition_besoin" value="<?php echo $edition_besoin;?>">
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Lieu Livre</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="lieu_besoin" class="form-control" placeholder="Lieu Livre" name="lieu_besoin" value="<?php echo $lieu_besoin;?>">
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Langue Livre</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="langue_besoin" class="form-control" placeholder="Langue Livre" name="langue_besoin" value="<?php echo $langue_besoin;?>">
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-3">
				<label class="control-label">Date de demande</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" id="date_demande_besoin" class="form-control" placeholder="Date de demande" name="date_demande_besoin" value="<?php echo $date_demande_besoin;?>">
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<br>
   <div class="row">
	  <div class="col-md-2">
	   <div>
		<input type='submit' class="btn btn-primary form-control" value='Enregistrer'/>	
	   </div>
	  <div class="col-md-4"></div>
	 </div>
      <div id ="resultat_popup"></div>
	</form> 
   </div>
   <script> 
    $(document).ready(function() {	
		$('#besoin_livre').bootstrapValidator({
			onError: function(e) {},
			onSuccess: function(e) {},
			fields : {
				description_besoin: {
					validators : {
						notEmpty : {
							message : 'Veuillez decrire votre besoin'
						}
					}
				}
			}
		});
    });
	function base_url(){
        return $('#url_base').val();
     }  
  </script>
 	