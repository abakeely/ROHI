{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Liste des agents du MEF inscrits sur ROHI</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">les CV des agents du MEF</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-body">
									<table id="table-liste-cv">
									<thead>
										<tr>
											<th align="center"</th>
											<th>Matricule</th>
											<th>CIN</th>
											<th>Nom</th>
											<th>Prénoms</th>
											<th>Contact</th>
											<!--th>Sanction</th-->
											<th>Localité de service</th>
											<th>Diplôme</th>
											<th style="text-align:center;"></th>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>
												<input style="width:65px;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" type="text" id="iMatricule" class="form-control iMatricule" placeholder="" />
											</td>
											<td>
												<input style="width:100px;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" class="form-control" type="text" id="iCin" class="" placeholder="" />
											</td>
											<td>
												<input style="width:100%;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" class="form-control" type="text" id="zNom" placeholder="" />
											</td>
											<td>
												<input style="width:100%;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" type="text" id="zPrenom" class="form-control" placeholder="" />
											</td>
											<td>
												<input style="width:100%;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" type="text" id="zContact" class="form-control" placeholder="" />
											</td>
											<!---td>
												<input style="height:30px;border-radius:7px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" type="text" id="zSanction" class="" placeholder="Sanction" />
											</td-->
											<td>
												<input style="width:100%;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" type="text" id="zLocalite" class="form-control" placeholder="" />
											</td>
											<td style="width:50px;">
												<input style="width:100%;height:30px;border-radius:1px;box-shadow:inset 0 1px 3px #ddd;border: 1px solid #ccc;" type="text" id="zDiplome" class="form-control" placeholder="" />
											</td>
											<td ><input type="button" value="Rechercher" class="btn button" onClick="rechercheCv"></td>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
					</div></div>
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
$(document).ready(function() {
	var zListeCv = $('#table-liste-cv').DataTable( {
		"processing": true,
		"serverSide": true,
		"searching": true,
		"footer": true,
		"columnDefs": [
			{ className: "dt-center", "targets": [7] },
			{ className: "cin", "targets": [2] },
			{ className: "nom", "targets": [3,4] },
		 ],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}accueil/cvAll/liste/ajax", // json datasource
			data: function ( d ) {
				d.iMatricule = $("#iMatricule").val(),
				d.iCin = $("#iCin").val(),
				d.zNom = $("#zNom").val(),
				d.zPrenom = $("#zPrenom").val(),
				d.zSanction = $("#iMatricule").val(),
				d.zContact = $("#zContact").val(),
				d.zLocalite = $("#zLocalite").val(),
				d.zDiplome = $("#zDiplome").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		},
		language : {
		  sLoadingRecords : '<span style="width:100%;"><img src="{/literal}{$zBasePath}{literal}assets/accueil/images/ajaxload.gif"></span>',
		  processing: "<img src='{/literal}{$zBasePath}{literal}assets/accueil/images/w_load.gif'>"
		},  
    }); 
})
</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
th.dt-center, td.dt-center { text-align: ; }
th.cin, td.cin { width: 150px!important; }
th.nom, td.nom { width: 150px!important; }
td { vertical-align:middle!important}

.dataTables_wrapper {
    overflow: auto!important;
}

.searchCv {
	width:100%!important;
	height: 30px;
}

.button {
    border: 1px solid #00a4ff;
    font-family: 'Lato', Arial, Helvetica, sans-serif;
    color: #4c4b4b;
	padding:4px;
	font-size:5px;
}
#table-liste-cv td{
	max-width:150px;
	overflow:hidden;
}
#table-liste-cv td img{
	width: 50px;
	height: 50px;
	border-radius: 50px;
	min-width: 50px;
}
</style>
{/literal}		