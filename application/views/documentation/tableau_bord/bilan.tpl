{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Bilan</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Tableau de Bord</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
			
								<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
								<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
								<div class="SSttlPage"></div>
								<br><br>
								<script src="{$zBasePath}assets/js/canvasjs.min.js"></script>
								<div align="right">
										<a href="{$zBasePath}tableau_bord/couv_bilan/sad/statistique" class="btn">Retour</a>
								</div>
								<br>
								<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
									<div align="center">BILAN GLOBAL </div>
								</h3>

								<div class ="row " >
									<form class="form-horizontal" role="form" name="lect_ajout" action="{$zBasePath}tableau_bord/show_bilan" method="POST">
										<div style=" background-color:#F5F5F5;" class="col-lg-11">	
											<br><br>
											<div class="form-group">
												<label class="col-sm-2 control-label"><b>DATE DEBUT</b></label>
												<div class="row1">
													<input type="text" class="form-control" placeholder="Date D&eacute;but" name="debut" id="debut" data-placement="top">
													<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
												</div>		
												<label class="col-sm-2 control-label"><b>DATE FIN</b></label>	
												<div class="row1">
													<input type="text" class="form-control" placeholder="Date Fin" name="fin" id="fin" data-placement="top">
													<span class="la la-calendar txt-danger form-control-feedback" style="top:11px;right:12px;"></span>
												</div>
												<div class="col-sm-3">
													<button>AFFICHER</button>
												</div>			
											</div><br>
										</div>
									</form>
									<br><br>
									<div  class="row" style ="margin-right: -3px; margin-left: 197px;">	
										<div class="col-lg-10">
										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
											<div align="center">Bilan pret</div></h3>	
										<table>
											<tr>
												<th class="class_th">Date</th>
												<th class="class_th">Nombre</th>
											</tr>
											{foreach from=$oData.data_stat_pret item=pret}
											<tr>
												<td>{$pret.date}</td>
												<td>{$pret.nb}</td>
											</tr>
											{/foreach}
											<tr>
												<td class="class_th">Somme</td>
												<td class="class_th">{$tot_pret}</td>
											</tr>
										</table>
										</div>
										<div class="col-lg-2"></div>		
										<div class="col-lg-10">	
										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
											<div align="center">Bilan consultation internet</div></h3>
											<table>
												<tr>
													<th class="class_th">Date</th>
													<th class="class_th">Nombre</th>
												</tr>
												{foreach from=$oData.data_stat_consul_net item=pret}
												<tr>
													<td>{$pret.date}</td>
													<td>{$pret.nb}</td>
												</tr>
												{/foreach}
												<tr>
													<td>Somme</td>
													<td>{$tot_net}</td>
												</tr>
											</table>
										</div>
										<div class="col-lg-2"></div>		
										<div class="col-lg-10">	
										<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
											<div align="center">Bilan lecture sur place</div></h3>
										<table>
											<tr>
												<th class="class_th">Date</th>
												<th class="class_th">Nombre</th>
											</tr>
											{foreach from=$oData.data_stat_consul_place item=pret}
											<tr>
												<td>{$pret.date}</td>
												<td>{$pret.nb}</td>
											</tr>
											{/foreach}
											<tr>
												<td>Somme</td>
												<td>{$tot_place}</td>
											</tr>
										</table>
										</div>
									</div>
								</div>	
								<div id="chartContainer" style="height: 100px; width: 100%;"></div>
								<script src="{$zBasePath}assets/js/canvasjs.min.js"></script>

								{$oData.zPagination}
								<div id="calendar"></div>
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
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title: {
			text: "Bilan",
			fontSize: 30
		},
		animationEnabled: true,
		axisX: {
			gridColor: "Silver",
			tickColor: "silver",
			valueFormatString: "DD/MMM"
		},
		toolTip: {
			shared: true
		},
		theme: "theme2",
		axisY: {
			gridColor: "Silver",
			tickColor: "silver"
		},
		legend: {
			verticalAlign: "center",
			horizontalAlign: "right"
		},
		data: [
		{
			type: "line",
			showInLegend: true,
			lineThickness: 2,
			name: "Pret",
			markerType: "square",
			color: "#F08080",
			dataPoints: [
			{foreach from=$oData.data_stat_pret item=pret}
			{ x: new Date({substr($pret.date,0,2)},{substr($pret.date,3,2)}, {substr($pret.date,6,4)}), y: {$pret.nb},
			{/foreach}
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Consultation internet",
			color: "#20B2AA",
			lineThickness: 2,

			dataPoints: [
			{foreach from=$oData.data_stat_consul_net item=pret}
			{ x: new Date({substr($pret.date,0,2)},{substr($pret.date,3,2)}, {substr($pret['date'],6,4)}), y:{$pret.nb},
			{/foreach}
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Lecture sur place",
			color: "#20B000",
			lineThickness: 2,

			dataPoints: [
			{foreach from=$oData.data_stat_consul_place item=pret}
			{ x: new Date({substr($pret.date,0,2)},{substr($pret.date,3,2)}, {substr($pret.date,6,4)}), y: {$pret.nb},
			{/foreach}
			]
		}
		],
		legend: {
			cursor: "pointer",
			itemclick: function (e) {
				if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				}
				else {
					e.dataSeries.visible = true;
				}
				chart.render();
			}
		}
	});

	chart.render();
}
		
 $(document).ready(function() {
		$("#debut").datepicker({
			 language: "fr",
			 autoclose: true,
			 todayHighlight: true,
			 format: "dd/mm/yyyy"
		});
		$("#fin").datepicker({
			 language: "fr",
			 autoclose: true,
			 todayHighlight: true,
			 format: "dd/mm/yyyy"
		});
 });
 
function verifier_livre1(){
	var cote = $("#cote").val();
	$.ajax({
		url: "{$zBasePath}documentation/verifier_livre/"+cote,
		type: 'get',
		success: function(data, textStatus, jqXHR) {
			var obj = jQuery.parseJSON(data);
			if(obj.statut == "ko"){
				bootbox.alert("Ce cote n'existe pas !");
			}
			else{
				var libele = obj.livre.titre_livre + " - " +obj.livre.theme_livre.libele+ " - " +obj.livre.auteur_livre.libele;
				$("#titre").val(libele);
			}
				 
		},
		async: false
	});
}
</script>
{/literal}