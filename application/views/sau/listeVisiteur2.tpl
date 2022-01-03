{include_php file=$zCssJs}
{include_php file=$zHeader}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<div id="container">
	
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<h2>Visiteurs</h2>
		<!--<form target="_self" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
			<fieldset>
				<div class="row1">
					<div class="cell small">
						<button class="dialog-link">Ajouter un visiteur</button>
					</div>
				</div>
			</fieldset>
		</form>-->

		<!------------------------------- -------------------------------------------------------->

		<div class="nav-tabs-custom">
			<div id="cssmenu">
				<ul class="nav nav-tabs" >
						<li><a href="#langText1" data-toggle="tab">AGENT</a></li>
						<li><a href="#langText2" data-toggle="tab">ADMINISTRATIVE</a></li>
						<li><a href="#langText3" data-toggle="tab">MOUVEMENT</a></li>
						<li class="active"><a href="#langText4" data-toggle="tab">LOCALITE SERVICE</a></li>
						<li><a href="#langText5" data-toggle="tab">ARCHIVE</a></li>
						<li><a href="#langText6" data-toggle="tab">BONIFICATION</a></li>
						<li><a href="#langText7" data-toggle="tab">DIPLOME</a></li>
						<li><a href="#langText8" data-toggle="tab">PARCOURS</a></li>
				</ul>
			</div>
			<div class="tab-content no-padding">
					<div class="tab-pane" id="langText1" style="padding:20px;">
					sds
					</div>
					<div class="tab-pane " id="langText2" style="padding:20px;">
					sdsd
					</div>
					<div class="tab-pane " id="langText3" style="padding:20px;">
					sds
					</div>
					<div class="tab-pane active" id="langText4" style="padding:20px">
					sds
					</div>
			</div>
		</div>
		
		<form enctype="multipart/form-data">
			<fieldset>
				<div class="row clearfix">
					<div class="cell">
						<label>Nom evaluateur *</label>
						<div class="field" id="searchCandidat" style="display:block">
							<input placeholder="Veuillez entrer le nom de l'evaluateur" type="text" id="zCandidatInfo" name="zCandidatInfo">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field" >
							<label><b>Nom :</label>
							<input type="text" name="visiteur_nom" id="visiteur_nom" value="" class="obligatoire">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>Pr&eacutenom : </label>
							<input type="text" name="visiteur_prenom" id="visiteur_prenom" value="" class="obligatoire">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>CIN :</label>
							<input type="text" name="visiteur_prenom" id="visiteur_prenom" value="" class="obligatoire">
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>Porte :</label>
							<select id="type_id" name="type_id" class="obligatoire">
								<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
								{foreach from=$oData.toPorte item=toPorte }
								<option value="{$toPorte.porte_id}">{$toPorte.porte_nom}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="cell">
						<div class="field">
							<label>Badge :</label>
							<select id="type_id" name="type_id" class="obligatoire">
								<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
								{foreach from=$oData.toBadge item=toBadge }
								<option value="{$toBadge.badge_id}">{$toBadge.badge_nom}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	


		<!------------------------------- -------------------------------------------------------->
		<div class="clear"></div>
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr>
					<th>Date</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Badge</th>
					<th>CIN ou autres</th>
					<th>Porte</th>
					
					<th>Heure d'entrée</th>
					
				</tr>
			</thead>
			<tbody>
				{assign var=iIncrement value="0"}
				{if sizeof($oData.oListe)>0}
				{foreach from=$oData.oListe item=oListeVisiteur }
				<tr {if $iIncrement%2 == 0} class="even" {/if}>
					<td>{$oListeVisiteur.visite_date|date_format:"%d/%m/%Y"}</td>
					<td>{$oListeVisiteur.visiteur_nom}</td>
					<td>{$oListeVisiteur.visiteur_prenom}</td>
					<td>{$oListeVisiteur.badge_num}</td>
					<td>{$oListeVisiteur.visiteur_cin}</td>
					<td>{$oListeVisiteur.porte_nom}</td>
					<td>{$oListeVisiteur.visite_heureEntree}</td>
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
				{else}
				<tr><td style="text-align:center;" colspan="11">Aucun enregistrement correspondant</td></tr>
				{/if}
			</tbody>
		</table>
	</div>
</section>
<!-- ui-dialog -->
<div id="dialog" title="Dialog Title">
	
</div>
<script>

{if sizeof($oData.oListe)>0}
{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
{/if}
</script>
{literal}
{literal}
	<style>

	/* NAV TABS */
.nav-tabs-custom {
  /*margin-bottom: 20px;
  background: #fff;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  border-radius: 3px;*/
  margin-bottom: 20px;
  padding: 20px;
  background: #fff;
  /*box-shadow: 2px 1px 26px rgb(92, 184, 92);*/
  border-radius: 13px;
}
.nav-tabs-custom > .nav-tabs {
  margin: 0;
  border-bottom-color: #f4f4f4;
  border-top-right-radius: 3px;
  border-top-left-radius: 3px;
}
.nav-tabs-custom > .nav-tabs > li {
  border-top: 3px solid transparent;
  margin-bottom: -2px;
  margin-right: 5px;
}
.nav-tabs-custom > .nav-tabs > li > a {
  color: #444!important;
  border-radius: 0;
}
.nav-tabs-custom > .nav-tabs > li > a.text-muted {
  color: #999;
}
.nav-tabs-custom > .nav-tabs > li > a,
.nav-tabs-custom > .nav-tabs > li > a:hover {
  background: transparent;
  margin: 0;
}
.nav-tabs-custom > .nav-tabs > li > a:hover {
  color: #999;
}
.nav-tabs-custom > .nav-tabs > li:not(.active) > a:hover,
.nav-tabs-custom > .nav-tabs > li:not(.active) > a:focus,
.nav-tabs-custom > .nav-tabs > li:not(.active) > a:active {
  border-color: transparent;
}
.nav-tabs-custom > .nav-tabs > li.active {
  border-top-color: #3c8dbc;

}
.nav-tabs-custom > .nav-tabs > li.active > a,
.nav-tabs-custom > .nav-tabs > li.active:hover > a {
  background-color: #fff;
  color: #444!important;
}
.nav-tabs-custom > .nav-tabs > li.active > a {
  border-top-color: transparent;
  border-left-color: #f4f4f4;
  border-right-color: #f4f4f4;
}
.nav-tabs-custom > .nav-tabs > li:first-of-type {
  margin-left: 0;
}

.nav-tabs-custom > .nav-tabs.pull-right {
  float: none!important;
}
.nav-tabs-custom > .nav-tabs.pull-right > li {
  float: right;
}
.nav-tabs-custom > .nav-tabs.pull-right > li:first-of-type {
  margin-right: 0;
}
.nav-tabs-custom > .nav-tabs.pull-right > li:first-of-type > a {
  border-left-width: 1px;
}
.nav-tabs-custom > .nav-tabs.pull-right > li:first-of-type.active > a {
  border-left-color: #f4f4f4;
  border-right-color: transparent;
}
.nav-tabs-custom > .nav-tabs > li.header {
  line-height: 35px;
  padding: 0 10px;
  font-size: 20px;
  color: #444;
}
.nav-tabs-custom > .nav-tabs > li.header > .fa,
.nav-tabs-custom > .nav-tabs > li.header > .glyphicon,
.nav-tabs-custom > .nav-tabs > li.header > .ion {
  margin-right: 5px;
}
.nav-tabs-custom > .tab-content {
  background: #fff;
  padding: 10px;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
}
.nav-tabs-custom .dropdown.open > a:active,
.nav-tabs-custom .dropdown.open > a:focus {
  background: transparent;
  color: #999;
}

#cssmenu,
#cssmenu ul,
#cssmenu ul li,
#cssmenu ul li a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  line-height: 1;
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
#cssmenu:after,
#cssmenu > ul:after {
  content: ".";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
#cssmenu {
  width: auto;
  font-family: Raleway, sans-serif;
  line-height: 1;
}
#cssmenu ul {
  background: #ffffff;
}
#cssmenu > ul > li {
  float: left;
}
#cssmenu.align-center > ul {
  font-size: 0;
  text-align: center;
}
#cssmenu.align-center > ul > li {
  display: inline-block;
  float: none;
}
#cssmenu.align-right > ul > li {
  float: right;
}
#cssmenu.align-right > ul > li > a {
  margin-right: 0;
  margin-left: -4px;
}
#cssmenu > ul > li > a {
  z-index: 2;
  padding: 10px 15px 10px 15px;
  font-weight: 400;
  text-decoration: none;
  color: #ffffff!important;
  -webkit-transition: all .2s ease;
  -moz-transition: all .2s ease;
  -ms-transition: all .2s ease;
  -o-transition: all .2s ease;
  transition: all .2s ease;
  margin-right: 2px;
  
}
#cssmenu > ul > li.active > a,
#cssmenu > ul > li:hover > a,
#cssmenu > ul > li > a:hover {
  color: #fffff!important;
}
#cssmenu > ul > li > a:after {
  content: '';
	position: absolute;
	top: 0; right: 0; bottom: 0; left: 0;
	z-index: -1;
	border-bottom: none;
	border-radius: 10px 10px 0 0;
	background: -webkit-gradient(linear,left top,left bottom,from(#0cacce),to(#1c6473));
	font-weight: normal;
}
#cssmenu > ul > li.active > a:after,
#cssmenu > ul > li:hover > a:after,
#cssmenu > ul > li > a:hover:after {
    background: -webkit-gradient(linear,left top,left bottom,from(#5cb85c),to(#2c822c));
	color: #459e00!important;
  
}
.tab-pane {
	padding: 20px;
    border: 2px solid #2d832d;
    /*background: #e8f0f5;*/
	border-radius:0 30px 30px 30px;
}
	select.input-sm {
		height: 29px;
		line-height: 13px;
		display: inline-block;
		width: auto;
		vertical-align: middle;
		border: 1px solid #53D00F !important;
		border-radius: 3px;
		padding: 0px 17px;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	.padding-info p{
		padding:5px;
	}
	.dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	select {
		width: 200px;
	}
	.ui-dialog .ui-dialog-content {
		position: relative;
		border: 0;
		padding: .5em 1em;
		background: none;
		overflow: auto;
	}
	</style>
<script>
$(document).ready (function ()
{

	$( "#dialog" ).dialog({
		autoOpen: false,
		width: '50%',
		title: 'Ajout visiteur',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {
					//$( this ).dialog( "close" );

					
				}
			},
			{
				text: "Annuler",
				click: function() {
					$( this ).dialog( "close" );
				}
			}
		]
	});

	 

	// Link to open the dialog
	$( ".dialog-link" ).click(function( event ) {
		
		$("#dialog").html();
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}sau/addUser" ,
			method: "POST",
			data: { iEvaluateur: 11},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog").html(data);	
				$( "#dialog" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});

	// Hover states on the static widgets
	$( ".dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);
})
</script>
{/literal}
{literal}
	
		<script>

		$(function() {

			$('#dialog').removeAttr('tabindex')

			var dataArrayInfo = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidatInfo").select2
			({
				initSelection: function (element, callback)
				{
					
					$(dataArrayInfo).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
				},
				allowClear: false,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
					dataType: 'jsonp',
					data: function (term)
					{
						return {q: term, iFiltre:1};
					},
					results: function (data)
					{
						return {results: data};
					}
				},
				dropdownCssClass: "bigdrop"
			}) ;

			$("#zCandidatInfo").select2('val',$("#idSelect").val());

		});

		</script>
		{/literal}
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
{include_php file=$zFooter}
</div>

</body>
</html>