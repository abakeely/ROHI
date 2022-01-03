{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>{$oData.zLibelle}</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> <a href="#">Gestion des absences</a> <span>&gt;</span> liste des demandes d'absence</div>
		<div class="clear"></div>
		{if $oData.iSessionCompte == COMPTE_AGENT || $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
			<div class="SSttlPage">
				<div class="cell">
					<div class="field">
						<form action="#" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
						<input type="button" class="button" id="add-absence" value="Demander une absence">
						</form>
					</div>
				</div>
			</div>
		{/if}
		{if $oData.iSessionCompte != COMPTE_AGENT && $oData.iSessionCompte != COMPTE_RESPONSABLE_PERSONNEL}
			<input type="hidden" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
			<input type="hidden" name="iCin" autocomplete="off" id="iCin" value="{$oData.iCin}" placeholder="">
		{else}
			<input type="hidden" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
			<input type="hidden" name="iCin" autocomplete="off" id="iCin" value="{$oData.iCin}" placeholder="">
		{/if}
		<div class="contenuePage" style="overflow: hidden;">

		<!--*Debut Contenue*-->
		<div class="col-xs-12 table-responsive">
		<table id="table-liste-extrants" width="100%">
			<thead>
				<tr>
					{if $oData.iSessionCompte != COMPTE_AGENT}
						<th>Photo</th>
					{/if}
					<th>Type</th>
					{if $oData.iSessionCompte != COMPTE_AGENT}
						<th>Matricule demandeur</th>
						<th>Nom et pr&eacute;nom demandeur</th>
					{else}
						<th>Matricule demandeur</th>
					{/if}
					<th>Date d&eacute;but</th>
					<th>Date fin</th>
					<th>Nbr de Jour</th>
					<th>Interim</th>
					<th>Validateur</th>
					<th>Statut</th>
					<th>Action</th>
				</tr>
				
			</thead>
		</table>
		<div><img width="30" height="30" id="photos_agent" src=""/></div>
					  <!-- Recherche -->
                <div class="SSttlPage">
                    <div id="searchAcc">
                        <div class="encadre popUpLocalite"></div>
						<div class="card punch-status">
                        <h2>DIAGRAMME DE GANTT ABSENCE</h2>	
						<form action="" method="POST" name="formulaireTransaction" id="formulaireTransaction"   enctype="multipart/form-data" style="display:block">
							<fieldset>
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
											<input type="text" name="zDateDebut" autocomplete="off" style="width:189px!important" id="zDateDebut" value="{$oData.zDateDebut}" onChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="withDatePicker obligatoire1">
											<p class="message debut1" style="width:500px">&nbsp;</p>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>Date fin *</label>
											<input type="text" name="zDateFin" autocomplete="off" style="width:189px!important" id="zDateFin" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="withDatePicker obligatoire1">
											<p class="message fin1" style="width:500px">&nbsp;</p>

										</div>
									</div>
								</div>
								<div class="cell">
									<div class="field">
										<input type="button" class="button"
											onClick="validerGantt(1);" name="" id="" value="rechercher">
									</div>
								</div>
							</fieldset>
						</form>
						</div>
					</div>
					 <!-- Recherche -->
				{if $oData.sizeTab!=0} 
					<div id="calendarGantt" style="width:100%"  align="center"></div></div>
				{/if}
				</div>
               
	</div>
	
	

	<script>
	var dataPlan = {$oData.jsonData};
	</script>

	<div><h3 style='border-bottom: none;'>Legende</h3></div>
	<table border="0" class="legendeM">
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
    <!--*Fin Contenue*-->
    </div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<div id="dialogGcap" title="Demande d'absence"></div>
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="azert" id="azert" value="&Ecirc;tes-vous s&ucirc;r de confirmer ">
<input type="hidden" name="azerty" id="azerty" value="cong&eacute;?">
<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/extrants/{$oData.zHashModule}/{$oData.zHashUrl}">
</form>
{include_php file=$zFooter}
</div>
{literal}
<style>

	@-webkit-keyframes ombre {
	  0% {
		box-shadow: 0 0 15px red;
	  }
	  100% {
		box-shadow: 0 0 15px yellow;
	  }
	}
	@-moz-keyframes ombre {
	  0% {
		box-shadow: 0 0 15px red;
	  }
	  100% {
		box-shadow: 0 0 15px yellow;
	  }
	}
	@keyframes ombre {
	  0% {
		box-shadow: 0 0 15px red;
	  }
	  100% {
		box-shadow: 0 0 15px yellow;
	  }
	}
	#add-absence {
	  -webkit-animation: ombre ease-in infinite alternate 500ms;
	  -moz-animation: ombre ease-in infinite alternate 500ms;
	  animation: ombre ease-in infinite alternate 500ms;
	}
	.legendeM td.color1 {
		width:25px!important;
	}
	.legendeM td.color2 {
		width:100px!important;
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

	@-webkit-keyframes clignote {
		0%{box-shadow:0px 0px 10px #4183C4;}
		50%{box-shadow:0px 0px 0px #4183C4;}
		100%{box-shadow:0px 0px 10px #4183C4;}
	}
</style>
<script>
$(function() {

	"use strict";

	$("#calendarGantt").gantt({
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

});

{/literal}{if $oData.zHash=='add'}{literal}
	$(document).ready (function ()
	{
		$("#add-absence").click();
	})
{/literal}{/if}{literal}

function sendSearch(){
	$("#formulaireSearch").submit();
}

var extrants = $('#table-liste-extrants').DataTable( {
	"processing": true,
	"serverSide": true,
	"order": [[ 0, "desc" ]],
	"pageLength": 5,
	"ajax":{
		url :"{/literal}{$zBasePath}{literal}gcap/extrants/gestion-absence/ajax", 
		data: function ( d ) {
			d.iMatricule = $("#iMatricule").val(),
			d.iCin = $("#iCin").val()
		},
		type: "post",  
		error: function(){  

		}
	}
}); 


function getListeExtrants(){
	extrants.ajax.reload();
}

function showImage(p_candidat_id){
	//alert(p_user_id);
	$("#photos_agent").attr("src","http://rohi.mef.gov.mg:8088/ROHI/assets/upload/"+p_candidat_id+".jpg");
}

</script>
{/literal}
</body>
</html>