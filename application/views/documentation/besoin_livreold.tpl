{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"> &nbsp;</div>
	
	<section id="content">
		{include_php file=$zLeft}	
		<div id="innerContent">
			<div id="ContentBloc">
				<h2>Besoins Livres</h2>
					<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> 
					<span>&gt;</span><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a>  
					<span>&gt;</span><a href="{$zBasePath}documentation/service/sad/service-propose">Servises Proposés</a><span>&gt;</span> Besoin Livre</div>

	{assign var=date_demande_besoin value="date('d/m/Y')"}
	{assign var=description_besoin value=""}
	{assign var=theme_besoin value=""}
	{assign var=titre_besoin value=""}
	{assign var=auteur_besoin value=""}
	{assign var=edition_besoin value=""}
	{assign var=lieu_besoin value=""}
	{assign var=langue_besoin value=""}	
				
<br>
<div align="right">
	<a href="{$zBasePath}documentation/couverture_besoin" class="btn">Retour</a>
</div><br>

<form class="form-horizontal" role="form" name="lect_ajout" action="{$zBasePath}documentation/ajout_besoin_livre/sad/besoins-specifiques" method="POST">		
	
	<div class="row">
		<div class="col-md-1"></div>
		 <div class="col-md-3">
			<label class="control-label"> Description Livre</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<textarea   class="form-control" placeholder="Description Livre" name="description_besoin" id="description_besoin" rows=5 >{$description_besoin}</textarea>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Theme</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="theme_besoin" class="form-control" placeholder="Theme Livre" name="theme_besoin" value="{$theme_besoin}">
		</div>
	</div>	
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Titre Livre </label>
		</div>
	</div>
	
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="titre_besoin" class="form-control" placeholder="Titre Livre" name="titre_besoin" value="{$titre_besoin}">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Auteur Livre</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="auteur_besoin" class="form-control" placeholder="Auteur Livre" name="auteur_besoin" value="{$auteur_besoin}">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Edition Livre</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="edition_besoin" class="form-control" placeholder="Edition Livre" name="edition_besoin" value="{$edition_besoin}">
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Lieu Livre</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="lieu_besoin" class="form-control" placeholder="Lieu Livre" name="lieu_besoin" value="{$lieu_besoin}">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Langue Livre</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="langue_besoin" class="form-control" placeholder="Langue Livre" name="langue_besoin" value={$langue_besoin}>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<label class="control-label">Date de demande</label>
		</div>
	</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-6">
			<input type="text" id="date_demande_besoin" class="form-control" placeholder="Date de demande" name="date_demande_besoin" value="{$date_demande_besoin}">
		</div>
	</div><br>

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
<br><br>

<!--*Fin Contenue*-->
</div>
</div>
<div id="calendar"></div>
</div>
</section>
<section id="rightContent" class="clearfix">
{include_php file=$zRight}
</section>
{include_php file=$zFooter}

{literal}
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
{/literal}