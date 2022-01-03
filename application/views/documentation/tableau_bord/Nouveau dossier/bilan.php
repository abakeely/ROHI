<style>
	.class_td{
		font-size:20px!important;
		text-align:center;
	}
	
	.class_th{
		font-size:22px!important;
		text-weight : bold;
		text-align:center;
	}
	button{
		color:green;
		font-weight:bold;
		height:35px;
		border-radius: 5px;
		line-height:29px;
		width:191px;
	}
</style>

<div align="right">
	<a href="<?php echo base_url();?>tableau_bord/couv_bilan" class="btn btn-success">Retour</a>
</div>

<div class ="row " >
<form class="form-horizontal" role="form" name="lect_ajout" action="<?php echo base_url('tableau_bord/show_bilan')?>" method="POST">
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
	<div class="col-lg-8">
	<h1>Bilan pret</h1>	
	<table>
		<tr>
			<th class="class_th">Date</th>
			<th class="class_th">Nombre</th>
		</tr>
		<?php foreach($data_stat_pret as $pret){?>
		<tr>
			<td class="class_td"><?php echo $pret['date']?></td>
			<td class="class_td"><?php echo $pret['nb']?></td>
		</tr>
		<?php }?>
		<tr>
			<td class="class_th">Somme</td>
			<td class="class_th"><?php echo $tot_pret?></td>
		</tr>
	</table>
	</div>	

	<div class="col-lg-2"></div>		
	<div class="col-lg-8">	
		<h1>Bilan consultation internet</h1>
		<table>
			<tr>
				<th class="class_th">Date</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($data_stat_consul_net as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret['date']?></td>
				<td class="class_td"><?php echo $pret['nb']?></td>
			</tr>
			<?php }?>
			<tr>
				<td class="class_th">Somme</td>
				<td class="class_th"><?php echo $tot_net?></td>
			</tr>
		</table>
	</div>		
	
   <div class="col-lg-2"></div>		
	<div class="col-lg-8">	
	<h1>Bilan lecture sur place</h1>
	<table>
		<tr>
			<th class="class_th">Date</th>
			<th class="class_th">Nombre</th>
		</tr>
		<?php foreach($data_stat_consul_place as $pret){?>
		<tr>
			<td class="class_td"><?php echo $pret['date']?></td>
			<td class="class_td"><?php echo $pret['nb']?></td>
		</tr>
		<?php }?>
		<tr>
			<td class="class_th">Somme</td>
			<td class="class_th"><?php echo $tot_place?></td>
		</tr>
	</table>
	</div>		
</div>
</div>
<div id="chartContainer" style="height: 100px; width: 100%;"></div>
<script src="<?php echo base_url();?>assets/js/canvasjs.min.js"></script>
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
			<?php foreach($data_stat_pret as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Consultation internet",
			color: "#20B2AA",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_stat_consul_net as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Lecture sur place",
			color: "#20B000",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_stat_consul_place as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
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
		url: "<?php echo base_url('documentation/verifier_livre/')?>/"+cote,
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