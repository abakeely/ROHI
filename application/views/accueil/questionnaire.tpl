<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Activités de microfinance</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Start Formoid form-->
	<link rel="stylesheet" href="{$zBasePath}assets/iles/bootstrap1.css" />
	<link rel="stylesheet" href="{$zBasePath}assets/accueil/css/components.css?sdsds" type="text/css">
	<link rel="stylesheet" href="{$zBasePath}assets/iles/iles-aux-tresors.css?09032018" type="text/css" />
	<script type="text/javascript" src="{$zBasePath}assets/iles/jquery.min.js"></script>
	
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-ui.js"></script>
	<script src="{$zBasePath}assets/js/bootstrap.min.js"></script>
	<script src="{$zBasePath}assets/sau/js/bootbox.js"></script>
	<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<script>
	$(document).ready (function ()
	{
		$('body').addClass('js');
		$("#anneeDemarrage").mask("9999"); 
		$("#iAnnee").mask("9999"); 
		$("#adressePostale").mask("999");
		
		var $hamburger = $('.hamburger'),
			$nav = $('#site-nav'),
			$masthead = $('#masthead');
	  
		$hamburger.click(function() {
		  $(this).toggleClass('is-active');
		  $nav.toggleClass('is-active');
		  $masthead.toggleClass('is-active');
		  return false; 
		})
	});
	</script>
	<script type="text/javascript" src="{$zBasePath}assets/iles/question.js?12032018"></script>
</head>

<body class="blurBg-false" style="background-color:#808080">
<div class="hero">
    <div id="masthead" role="banner">
      <div class="container">
        <button class="hamburger hamburger--boring" type="button">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
          <span class="hamburger-label">Menu</span>
        </button>
      <form id="masthead-search">
      <input type="search" name="s" aria-labelledby="search-label" placeholder="Recherche&hellip;" class="draw">
        <button type="submit">&rarr;</button>
        </form>        
        <nav id="site-nav" role="navigation">
          <div class="col">
            <h4>ASSURANCES</h4>
            <ul>
              <li><a href="#">Formulaire ajout</a></li>
              <li><a href="#">Recherche</a></li>
              <li><a href="#">Liste assurances</a></li>
            </ul>            
          </div>
          <div class="col">
            <h4>BANQUES</h4>
            <ul>
              <li><a href="#">Formulaire ajout</a></li>
              <li><a href="#">Recherche</a></li>
              <li><a href="#">Liste banques</a></li>
            </ul> 
          </div>
          <div class="col">
            <h4>CNAPS</h4>
            <ul>
              <li><a href="#">Formulaire ajout</a></li>
              <li><a href="#">Recherche</a></li>
              <li><a href="#">Liste CNAPS</a></li>
            </ul>             
          </div>
          <div class="col">
            <h4>IMF</h4>
            <ul>
              <li><a href="#">Formulaire ajout</a></li>
              <li><a href="#">Recherche</a></li>
              <li><a href="#">Liste IMF</a></li>
            </ul>               
          </div>
		  <div class="col">
            <h4>EME</h4>
            <ul>
              <li><a href="#">Formulaire ajout</a></li>
              <li><a href="#">Recherche</a></li>
              <li><a href="#">Liste EME</a></li>
            </ul>               
          </div>
      </nav>
    </div>
  </div>
</div>
<input type="hidden" name="iPagination" id="iPagination" value="1">
<input type="hidden" name="zMessageValidation" id="zMessageValidation" value="Êtes-vous sûr de vouloir d'enregistrer partiellement ce formulaire?">
<form class="iles-aux-tresors" id="form-question" name="form-question" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:80%;min-width:150px" 
action="{$zBasePath}accueil/saveQuestion" method="post">
<input type="hidden" name="question_userId" id="question_userId" value="{$oData.oUser.id}">
<input type="hidden" name="question_partiel" id="question_partiel" value="4">
<input type="hidden" name="zBasePath" id="zBasePath" value="{$zBasePath}">
<div id="logo">
	<table class="logo">
		<tr>
			<td colspan="2" style="text-align:center"><img style="width:15%" src="{$zBasePath}assets/iles/republique-madagascar.jpg"</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td class="rightLogo"><img style="width:70px"  src="{$zBasePath}assets/iles/logo_dgt.png"></td>
		</tr>
	</table>
</div>


<div class="title" style="text-align:center;">
	<h2>FICHE DE SUIVI TRIMESTRIEL DES ACTIVITES MICROFINANCE</h2>
</div> 
<div class="submit">
	<div class="element-input" style="text-align:center;">
		<select style="width:13%" class="small obligatoire">
			<option>1er Trimestre</option>
			<option>2e Trimestre</option>
			<option>3e Trimestre</option>
			<option>4e Trimestre</option>
		</select>
		<input class="tropSmall obligatoire" type="text" value=""  name="iAnnee" id="iAnnee" placeholder="2019"/>
	</div>
	<input style="float:left;margin-left:10px;" class="precedent"  type="button" value="< Précédent"/> 
	
	<input type="button" class="partiel" value="Sauvegarde partielle"/>
	<input type="button" class="suivant" value="Suivant >"/>
	<input type="button" class="SubmitValider" style="display:none;" onclick="valider()" value="Envoyer"/>
</div>

<!------------------------------------------------------------------------ Bloc 1  -------------------------------------------------------------------------->
	<div id="bloc-1" class="blocHideShow">
		
	</div>
<!------------------------------------------------------------------------ Bloc 2  -------------------------------------------------------------------------->
	<div id="bloc-2" class="blocHideShow">
		
	</div>

<!------------------------------------------------------------------------ Bloc 3  -------------------------------------------------------------------------->
	<div id="bloc-3" class="blocHideShow">
		
	</div>
<!------------------------------------------------------------------------ Bloc 4  -------------------------------------------------------------------------->
	<div id="bloc-4" class="blocHideShow">
	 
	</div>

	<!----------------------------------------------------------- bloc 5 ------------------------------------------->
	<div id="bloc-5" class="blocHideShow">
		
	</div>

	<!----------------------------------------------------------- bloc 6 ------------------------------------------->
	<div id="bloc-6" class="blocHideShow">
		
	</div>
	<div class="submit">
		<input style="float:left;margin-left:10px;" class="precedent"  type="button" value="< Précédent"/> 
		<input type="button" class="partiel" value="Sauvegarde partielle"/>
		<input type="button" class="suivant" value="Suivant >"/>
		<input type="button" class="SubmitValider" style="display:none;" onclick="validerQuestionnaire()" value="Envoyer"/>
	</div>
	<br><br><br><br>
	<div class="title">
		<p style="text-align:center;color:black" >&copy; 2019 - Direction Générale du Trésor</p>    
	</div> 
</form>
{literal}
<style>
select, form select, select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    padding-right: 20px;
    background: white url({/literal}{$zBasePath}{literal}assets/iles/selectBg.jpg) 98.5% center no-repeat;
    text-overflow: ellipsis;
    line-height: initial;
}
</style>
<script>
$(document).ready (function ()
{
	{/literal}{if $iErr==1}{literal}
	bootbox.alert("Le texte entré n'est pas valide, Veuillez réessayer. Merci!");
	{/literal}{/if}{literal}

	/*$(document).keypress(function (e) {
		if (e.which == 13) {
			//validerQuestionnaire();
			return ;
		}
	});*/

	$('form').keypress(function(e){
		return ;
	});
	
})
</script>
{/literal}
<script type="text/javascript" src="questionnaire_files/iles/iles-aux-tresors.js"></script>
<!-- Stop Formoid form-->
</body>
</html>
