{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>

    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}
			{include_php file=$zLeft}
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">liste des demandes d'absence</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Gestion des absences</li>
									<li class="breadcrumb-item active">liste des demandes d'absence</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-xs-12">
							<div class="col-xs-12 table-responsive">
								<table id="table-liste-extrants" class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											{if $oData.iSessionCompte != COMPTE_AGENT}
												<th>Photo</th>
											{/if}
											<th>Type</th>
											{if $oData.iSessionCompte != COMPTE_AGENT}
												<th>Matricule demandeur</th>
												<th>Nom et prénom demandeur</th>
											{else}
												<th>Matricule demandeur</th>
											{/if}
											<th>Date début</th>
											<th>Date fin</th>
											<th>Nbr de Jour</th>
											<th>Interim</th>
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
				<!-- /Page Content -->
					
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

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