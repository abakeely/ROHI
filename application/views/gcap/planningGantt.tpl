{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Calendrier d'abscence</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Journal et Planning</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
				
					<div class="col-sm-12">
						<div class="card mb-0">
							<div class="card-body">
								 
			  
								<!-- Recherche -->
								<!--div class="SSttlPage">
									<div id="searchAcc">
										<div class="encadre popUpLocalite"-->
										<!-- <h2>Sélection Matricule  / CIN </h2> -->
											
											
									
										
										<div class="card punch-status">
											<h5>Sélection Mois / Année </h5>	
											<form action="{$zBasePath}gcap/rattache/{$oData.zHashModule}/{$oData.zHashUrl}/" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block">
												
													{* <div class="row1">
														<div class="cell">
															<div class="field">
																<label>Mois</label>
																{assign var=iAnneeMoinsUn value=$oData.zAnneeAffiche-1}
																<select name="iMois" id="iMois">
																	{assign var=iIncrement value="1"}
																	{foreach from=$oData.toMonth item=zMonth}
																		<option {if $oData.oDataSearch.month == $iIncrement}selected="selected"{/if} value="{$iIncrement}">{$zMonth}</option>
																	{assign var=iIncrement value=$iIncrement+1}
																	{/foreach}
																</select>
																<p class="message debut" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Année</label>
																{assign var=iAnneeMoinsUn value=$oData.zAnneeAffiche-1}
																<select name="iAnnee" id="iAnnee">
																	{assign var=iBoucle value=$oData.zAnneeBoucle}
																	{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}
																		<option {if $oData.oDataSearch.year == $smarty.section.iAnnee.index}selected="selected"{/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
																	{/section}
																</select>
																<p class="message fin" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div> *}
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date d&eacute;but *</label>
																<input type="text" name="zDateDebut" autocomplete="off" style="width:189px!important" id="zDateDebut" value="{$oData.zDateDebut}" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}" onChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="withDatePicker obligatoire1">
																<p class="message debut1" style="width:500px">&nbsp;</p>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date fin *</label>
																<input type="text" name="zDateFin" autocomplete="off" style="width:189px!important" id="zDateFin" value="{$oData.zDateFin}" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="withDatePicker obligatoire1">
																<p class="message fin1" style="width:500px">&nbsp;</p>

															</div>
														</div>
													</div>
													<div class="cell">
														<div class="field">
															<div class="row1">
															<input type="button" class="button"
																onClick="sendSearch()" name="" id="" value="rechercher">
														</div>
													</div>
													</div>
												
											</form>
										</div>
								
								
								<!-- Recherche -->
								<div id="curseur" class="infobulle"></div>
								{if $oData.sizeTab!=0} 
									<div id="calendar" style="width:100%"  align="center"></div>
									</div>
								{/if}


								<!-- Affichage de la légende -->

								<script>
								var dataPlan = {$oData.jsonData};
								</script>

								<div><h5 style='border-bottom: none;'>Légende</h5></div>
								<table class="legendeM" border="0" cellspacing="5" cellpadding="2">
									<tr>
										<td class="color1" style="background-color:DodgerBlue">&nbsp;</td>
										<td class="color2"><div align="left">Congés Annuels</div></td>

										<td class="color1" style="background-color:LightGreen">&nbsp;</td>
										<td class="color2"><div align="left">Autorisation d'Abscence</div></td>

										<td class="color1" style="background-color:LightCoral">&nbsp;</td>
										<td class="color2"><div align="left">Permision</div></td>

										<td class="color1" style="background-color:Gold">&nbsp;</td>
										<td class="color2"><div align="left">Répos Medical</div></td>

										<td class="color1" style="background-color:#9400D3!important">&nbsp;</td>
										<td class="color2"><div align="left">Mission</div></td>

										<td class="color1" style="background-color:#B8860B!important">&nbsp;</td>
										<td class="color2"><div align="left">Formation</div></td>

									</tr>
								</table>
								<br><br>
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/planningGantt/{$oData.zHashModule}/{$oData.zHashUrl}">
								</form>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}




{literal}
<script>
	$(function() {

		"use strict";

		$("#calendar").gantt({
			source: dataPlan,
			navigate: "buttons",
			scale: "days",
			itemsPerPage: 100,
			months : ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
			dow : ["D", "L", "M", "M", "J", "V", "S"],
			onItemClick: function(data) {
				console.log("Item clicked - show some details");
			},
			onAddClick: function(dt, rowId) {
				console.log("Empty space clicked - add an item!");
			},
			onRender: function() {
				if (window.console && typeof console.log === "function") {
					console.log("chart rendered");
				}
			},
			onDataLoadFailed: function(data) {
				console.log("Data failed to load!")
			}
		});
		
		$(".gantt").popover({
			selector: ".bar",
			title: "I'm a popover",
			content: "And I'm the content of said popover.",
			trigger: "hover"
		});

		prettyPrint();

	});
</script>
{/literal}		

{literal}
<script type="text/javascript">
	

	/** Javascript pour info bulle a l'affichage du calendrier **/
	sfHover = function() {
		var sfEls = document.getElementById("menu").getElementsByTagName("LI");
		for (var i=0; i<sfEls.length; i++) {
			sfEls[i].onmouseover=function() {
				this.className+="sfhover";
			}
			sfEls[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp("sfhover\\b"), "");
			}
		}
	}
	if (window.attachEvent) window.attachEvent("onload", sfHover);



	function GetId(id) {
		return document.getElementById(id);
	}

	var i=false;

	function move(e) {
		if(i) {
			if (navigator.appName!="Microsoft Internet Explorer") {
				GetId("curseur").style.left=e.pageX + 5+"px";
				GetId("curseur").style.top=e.pageY + 10+"px";
			}
			else {
				if(document.documentElement.clientWidth>0) {
					GetId("curseur").style.left=20+event.x+document.documentElement.scrollLeft+"px";
					GetId("curseur").style.top=10+event.y+document.documentElement.scrollTop+"px";
				}
				else {
					GetId("curseur").style.left=20+event.x+document.body.scrollLeft+"px";
					GetId("curseur").style.top=10+event.y+document.body.scrollTop+"px";
				}
			}
		}
	}

	function montre(text) {
		if(i==false) {
			GetId("curseur").style.visibility="visible";
			GetId("curseur").innerHTML = text;
			i=true;
		}
	}

	function cache() {
		if(i==true) {
			GetId("curseur").style.visibility="hidden";
			i=false;
		}
	}
	document.onmousemove=move;
	/** FIN infobulle **/

	function cacheChargement() {
		document.getElementById('chargement').style.display = 'none';
	}
	
</script>
{/literal}

{literal}
<style>
	#ui-datepicker-div{
		z-index:100!important;
	}
	.legendeM td.color1 {
		width:5px!important;
	}
	.legendeM td.color2 {
		width:5px!important;
	}
	.ui-dialog {
		top:100px!important;
	}
	.conge{
		background : DodgerBlue!important
	}
	
	.abscence{
		background : LightGreen!important
	}
	
	.permision{
		background : LightCoral!important
	}
	
	.repos{
		background : Gold!important
	}

	.mission{
		background : #9400D3!important
	}
	
	.formation{
		background : #B8860B!important
	}
</style>
{/literal}
