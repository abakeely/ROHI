
<div align="right">
			<a href="<?php echo base_url();?>tableau_bord/couv_bilan" class="btn btn-success">Retour</a>
</div>

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

<div class ="row " style ="margin-right: -3px;" >
<form class="form-horizontal" role="form" name="lect_ajout" action="<?php echo base_url('tableau_bord/show_bilan_detaille')?>" method="POST">
	<div style=" background-color:#F5F5F5;" class="col-lg-12">	
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
		</div><br><br>	
	</div>
</form>
<br>


<div  class="row">	
	<div class="col-lg-2"></div>		
	<div class="col-lg-8">	
		<h1>Liste des Departements qui emprunté les plus de livres</h1>
		<table>
			<tr>
				<th class="class_th">Département</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($data_sListeAgentBcpLivre as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->dept?></td>
				<td class="class_td"><?php echo $pret->nombre?></td>
				
			</tr>
			<?php }?>
			
		</table>
	</div>
	<div class="col-lg-2"></div>		

<br/><br/>

<a href="<?php echo base_url();?>documentation/graph1" class="btn btn-primary btn-lg">Voir Graphe</a>
</div>


<div  class="row">	
	<div class="col-lg-2"></div>		
	<div class="col-lg-8">	
		<h1>Liste des Directions qui emprunte beaucoup de livre</h1>
		<table>
			<tr>
				<th class="class_th">Direction</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeDirection as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->direction?></td>
				<td class="class_td"><?php echo $pret->nombre?></td>
			</tr>
			<?php }?>
			
		</table>
	</div>
	<div class="col-lg-2"></div>		

<a href="<?php echo base_url();?>documentation/graph2" class="btn btn-primary btn-lg">Voir Graphe</a>
<br/><br/>
</div>

<div  class="row">	
	<div class="col-lg-2"></div>		
	<div class="col-lg-8">	
		<h1>Liste des Services qui emprunte beaucoup de livre</h1>
		<table >
			<tr>
				<th class="class_th">Service</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeService as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->service?></td>
				<td class="class_td"><?php echo $pret->nombre?></td>
			</tr>
			<?php }?>
			
		</table>
	</div>
	<div class="col-lg-2"></div>		

<a href="<?php echo base_url();?>documentation/graph3" class="btn btn-primary btn-lg">Voir Graphe</a>
<br/><br/>
</div>


<div  class="row">	
	<div class="col-lg-2"></div>		
	<div class="col-lg-8">	
		<h1>Liste des agents qui effectue le plus d'emprunts</h1>
		<table>
			<tr>
				<th class="class_th">Agent</th>
				<th class="class_th">Service</th>
				<th class="class_th">Direction</th>
				<th class="class_th">Departement</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeAgentBcpLivre as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->nom .' '.$pret->prenom   ?></td>
				<td class="class_td"> <?php echo $pret->service ?></td>
				<td class="class_td"> <?php echo $pret->direction ?></td>
				<td class="class_td"> <?php echo $pret->dept ?></td>
				<td class="class_td"><?php echo $pret->nombre ?></td>
			</tr>
			<?php }?>
			
		</table>
	</div>
	<div class="col-lg-2"></div>		

<a href="<?php echo base_url();?>documentation/graph4" class="btn btn-primary btn-lg">Voir Graphe</a>
<br/><br/>
</div>

<div  class="row">	
	<div class="col-lg-2"></div>		
	<div class="col-lg-8">	
		<h1>Liste des livres les plus empruntés</h1>
		<table>
			<tr>
				<th class="class_th">Livres</th>
				<th class="class_th">Cote</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeLivreEmpreinte as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->titre_livre ; ?></td>
				<td class="class_td"> <?php echo $pret->cote_livre ; ?></td>
				<td class="class_td"><?php echo $pret->nombre ;?></td>
			</tr>
			<?php }?>
			
		</table>
		<?php
		/* echo "<pre>";
		print_r($sListeAgentBcpLivre);
		echo "</pre>";
*/
		?>	
	</div>
	<div class="col-lg-2"></div>	

<a href="<?php echo base_url();?>documentation/graph5" class="btn btn-primary btn-lg">Voir Graphe</a>
<br/><br/>
</div>

</div>
<div id="chartContainer" style="height: 400px; width: 100%;"></div>
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
			name: "Agent",
			markerType: "square",
			color: "#F08080",
			dataPoints: [
			<?php foreach($data_sListeAgentBcpLivre as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Departement",
			color: "#20B2AA",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_sListeDepartement as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Direction",
			color: "#20B000",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_sListeDirection as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Service",
			color: "#20B000",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_sListeService as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "Agentun",
			color: "#20B000",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_sListeAgentUnLivre as $pret){?>
			{ x: new Date(<?php echo substr($pret['date'],0,2)?>,<?php echo substr($pret['date'],3,2)?>, <?php echo substr($pret['date'],6,4)?>), y: <?php echo $pret['nb']?>},
			<?php }?>
			]
		},
		{
			type: "line",
			showInLegend: true,
			name: "livre",
			color: "#20B000",
			lineThickness: 2,

			dataPoints: [
			<?php foreach($data_sListeLivreEmpreinte as $pret){?>
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

