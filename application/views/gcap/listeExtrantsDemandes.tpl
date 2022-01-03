{include_php file=$zCssJs}
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						

						<input type="button" class="btn btn-success" id="add-absence"  name="" id="" value="Demander une absence">
								
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Gestion des absences</li>
									<li class="breadcrumb-item active">Liste des demandes d'absence</li>
								</ul>
								
					
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-body">

									  <div class="table-responsive">
											<table id="table-liste-extrants" class="datatable table table-stripped mb-0">
												<thead>
													<tr>
														{if $oData.iSessionCompte != COMPTE_AGENT}
															<th>Photo</th>
														{/if}
														<th>Type</th>
														{if $oData.iSessionCompte != COMPTE_AGENT}
															<th>Matricule</th>
															<th>Nom et prénom/th>
														{else}
															<th>Matricule</th>
														{/if}
														<th>Date début</th>
														<th>Date fin</th>
														<th>Nbr de Jour</th>
														<th>Intérim</th>
														<th>Validateur</th>
														<th>Statut</th>
														<th>Action</th>
													</tr>
												</thead>
												
											</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!-- /Page Content -->
				
				<!-- ato -->
<br>
				<div class="row">
				
					<div class="col-sm-12">
						<div class="card mb-0">
							<div class="card-body">
								  <div class="row">
										
										<div class="col-sm-3 col-md-2">
											<div class="form-group">
												<label>Départ <span class="text-danger">*</span></label>
												<div class="cal-icon">
													<input type="text" name="zDateDebut" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateDebut|date_format2}"  id="zDateDebut11" value="{$oData.zDateDebut}" onChange="setFinDateTransaction(this.value)" placeholder="s&eacute;l&eacute;ctionner la date de d&eacute;but" class="form-control datedropper-range withDatePicker22 datetimepicker obligatoire1">
												</div>
											</div>
										</div>
										<div class="col-sm-3 col-md-2">
											<div class="form-group">
												<label>Retour <span class="text-danger">*</span></label>
												<div class="cal-icon">
													<input type="text" name="zDateFin" autocomplete="off" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.zDateFin|date_format2}"  id="zDateFin11" value="{$oData.zDateFin}" placeholder="s&eacute;l&eacute;ctionner la date fin" class="datedropper-range withDatePicker22 form-control  datetimepicker">
											<p class="message fin1" style="width:500px">&nbsp;</p>
												</div>
											</div>
										</div>
										<div class="submit-section1">
												<input type="button" class="btn btn-success btn-block" onclick="validerGantt(1);" name="" id="" value="rechercher">
										</div>
									</div>
								  <div id="calendarGantt" style="margin-bottom:15px;"></div>
								  
								  <table border="0" class="legendeM" style="width:100%">
										<tr>
											<td class="color1" style="background-color:DodgerBlue">&nbsp;</td>
											<td class="color2"><div align="left" style="padding-left:5px">Congés Annuels</div></td>

											<td class="color1" style="background-color:LightGreen">&nbsp;</td>
											<td class="color2"><div align="left" style="padding-left:5px">Autorisation d'Abscence</div></td>

											<td class="color1" style="background-color:LightCoral">&nbsp;</td>
											<td class="color2"><div align="left" style="padding-left:5px">Permision</div></td>

											<td class="color1" style="background-color:Gold">&nbsp;</td>
											<td class="color2"><div align="left" style="padding-left:5px">Repos Medical</div></td>

											<td class="color1" style="background-color:#9400D3!important">&nbsp;</td>
											<td class="color2"><div align="left" style="padding-left:5px">Mission</div></td>

											<td class="color1" style="background-color:#B8860B!important">&nbsp;</td>
											<td class="color2"><div align="left" style="padding-left:5px">Formation</div></td>

										</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- ato -->
							
				
				<div class="row">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
				</div>	
				<div class="row">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
				</div>	
				<div class="row">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
				</div>	
				<div class="row">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
				</div>	
            </div>
			<!-- /Page Wrapper -->


        </div>
		<!-- /Main Wrapper -->



	
	<script>
	var dataPlan = {$oData.jsonData};
	</script>

	
	<br><br>
	<!--*Fin Contenue*-->
	</div>
	</div>
	<div id="calendar"></div>
	</div>
<div id="dialogGcap" title="Demande d'absence"></div>
<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
<input type="hidden" name="azert" id="azert" value="&Ecirc;tes-vous s&ucirc;r de confirmer ">
<input type="hidden" name="azerty" id="azerty" value="cong&eacute;?">
<input type="hidden" name="iElementId" id="iValueId" value="">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/extrants/{$oData.zHashModule}/{$oData.zHashUrl}">
</form>
{include_php file=$zFooter}
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

	@-webkit-keyframes clignote {
		0%{box-shadow:0px 0px 10px #4183C4;}
		50%{box-shadow:0px 0px 0px #4183C4;}
		100%{box-shadow:0px 0px 10px #4183C4;}
	}
	
	.row1 {
    float: left;
		padding-left: 0px !important;
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

$(document).ready (function (){
		$('#table-liste-extrants').DataTable( {
			"processing": true,
			bDestroy : true,
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
})



function getListeExtrants(){
	var extrants = $('#table-liste-extrants').DataTable( {
		"processing": true,
		bDestroy : true,
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