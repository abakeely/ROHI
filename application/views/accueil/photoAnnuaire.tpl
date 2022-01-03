{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Liste des Agents du MFB inscrit sur ROHI</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">les CV des agents du mfb</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
								<table id="table-liste-cv">
									<thead>
										<tr>
											<th>Id</th>
											<th>Photo</th>
											<th>Matricule</th>
											<th>CIN</th>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Sanction</th>
											<th>Localité de service</th>
											<th style="text-align:center;">Voir CV</th>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td><input type="text" id="iMatricule" class="iMatricule searchCv" placeholder="Matricule" /></td>
											<td><input type="text" id="iCin" class="searchCv" placeholder="CIN" /></td>
											<td><input type="text" id="zNom" class="searchCv" placeholder="Nom" /></td>
											<td><input type="text" id="zPrenom" class="searchCv" placeholder="Prénom" /></td>
											<td><input type="text" id="zSanction" class="searchCv" placeholder="Sanction" /></td>
											<td><input type="text" id="zLocalite" class="searchCv" placeholder="Localité" /></td>
											<td><input type="button" value="Rechercher" class="btn button" onClick="rechercheCv"></td>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
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
{literal}
<script>
$(document).ready(function() {
	var zListeCv = $('#table-liste-cv').DataTable( {
		"processing": true,
		"serverSide": true,
		"searching": false,
		"footer": true,
		"columnDefs": [
			{ className: "dt-center", "targets": [7] }
		 ],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}accueil/photoAll/liste/ajax", // json datasource
			data: function ( d ) {
				d.iMatricule = $("#iMatricule").val(),
				d.iCin = $("#iCin").val(),
				d.zNom = $("#zNom").val(),
				d.zPrenom = $("#zPrenom").val(),
				d.zSanction = $("#zSanction").val(),
				d.zLocalite = $("#zLocalite").val()
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

	$("#iCin").mask("999 999 999 999"); 
})
</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}
th.dt-center, td.dt-center { text-align: center; }
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
	padding:10px;
	font-size:14px;
}
</style>
{/literal}
{include_php file=$zFooter}
		