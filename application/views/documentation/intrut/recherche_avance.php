<?php 

    $date_demande_livre = date('d/m/Y');
	
	$theme_livre_edit =  0;
	$auteur_livre_edit =  0;
	$lieu_livre_edit =  0;
	$langue_livre_edit =  0;
    
	$id = "";
	$titre_livre = "";
	$cote_livre = "";
	$edition_livre = "";
	$format_livre = "";
	$nombre_page_livre = "";
	$nombre_explaire_livre = "";
	$observation_livre = "";
	 
	$image_url = base_url().'assets/upload_sad/default.jpg';
?>
 <div id="content-wrap" class="row"> 
  <form class="form-horizontal" role="form" name="documentation" id="pret_livre" action="<?php echo base_url();?>documentation/ajout_pret_livre" method="POST">
	<div class="col-md-12">
		<br><br><br>
	<div align="left">
          <h3> Cherchez un catalogue ou document num&eacute;rique, une texte reglementaire... </h3>
	</div><br>
	
 <div class="row">
	<div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622">Th&ecirc;me +</span>
	</label>
	</div>
	<div class="col-sm-9 col-md-10 col-lg-10">
	<select id="label_622" class="form-control" name="622[]" multiple="true">
	
	</select>
	</div>
 </div>
 <br>
 <div class="row">
  <div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622"> Titre +</span>
	</label>
  </div>
   <div class="col-sm-9 col-md-10 col-lg-10">
		<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="">
   </div>
 </div>
 <br>
 <div class="row">
  <div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622"> Auteurs +</span>
	</label>
  </div>
   <div class="col-sm-9 col-md-10 col-lg-10">
		<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="">
   </div>
 </div>
 <br>
 <div class="row">
  <div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622"> Edition +</span>
	</label>
  </div>
   <div class="col-sm-9 col-md-10 col-lg-10">
		<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="">
   </div>
 </div>
 <br>
 <div class="row">
  <div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622"> Langue +</span>
	</label>
  </div>
   <div class="col-sm-9 col-md-10 col-lg-10">
		<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="">
   </div>
 </div>
 <br>
 <div class="row">
  <div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622"> Mot(s) du r&eacute;sum&eacute; +</span>
	</label>
  </div>
   <div class="col-sm-9 col-md-10 col-lg-10">
		<input type="text" class="form-control" placeholder="Pr&eacute;nom(s)" name="prenom" id="nom" value="">
   </div>
 </div>
 <br>
 <div class="row">
	<div class="col-sm-3 col-md-2 col-lg-2 control-label">
	<label for="label_622">
	<span id="label622">Type de document</span>
	</label>
	</div>
	<div class="col-sm-9 col-md-10 col-lg-10">
	<select id="label_622" class="form-control" name="622[]" multiple="true">
	
	</select>
	</div>
 </div>
 <br><br>
 
  <div class="form-group pull-right">
	<div class="advanceSearchMargin">
	<button class="btn btn-default ermes_valid" title="Valider votre recherche avancée" name="submit" type="submit"> Rechercher</button>
	<button class="ermes_clear btn btn-primary" title="Effacer vos saisies du formulaire de recherche avancée" type="reset"> Effacer </button>
	<div id="jsonResult"></div>
	</div>
  </div>

 
 
 
 
 