<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<title>Histogramme</title>

		<script type='text/javascript' src="<?php echo base_url();?>assets/static/assets/js/jquery-1.10.2.min.js"></script>
		
<style type="text/css">
	${demo.css}
	

.contenu
{
        background-color:#dddddd;
        border:1px solid black;
        margin-top:-1px;
        padding:5px;
		
}
ul
{
        margin-top:0px;
        margin-bottom:0px;
        margin-left:-10px
}
h1
{
        margin:0px;
        padding:0px;
}


</style>	

<div class="row separateur"><div  class="text-center"><br><strong>Affichage de la tâche selon sa progression</strong> </div></div>
</br></br>
	<div id="graphe" style="min-width: 310px; height: 400px; margin: 0 auto">
			
	</div>

			<?php 
			
			foreach($taches as $tache)
			{

				$text[]= $tache->text;
				
				 $progress=$tache->progress;
				 $duration[]=$tache->duration;
				
				//$pourcent= round($progress, 2, PHP_ROUND_HALF_UP);
				$pourcent= round($progress*100,0);
				$c1[] = $pourcent;
			}
				
			
			?>

	<script type="text/javascript"> 
eval(<?php echo  "'var text =  ".json_encode($text)."'" ?>);
eval(<?php echo  "'var duration =  ".json_encode($duration)."'" ?>);

eval(<?php echo "'var c1 =".json_encode(  $c1)."'" ?>);


</script>
<script>

$(document).ready(function() {
		    
	$('#graphe').highcharts({
        chart: {
            type:'column'
        },
        title: {
            text: 'Progression de chaque tâche dans un projet'
        },
        subtitle: {
            text: 'AFFICHAGE DE LA PROGRESSION DE CHAQUE TACHE'
        },
        xAxis: {
            categories: text,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'PROGRESSION (%)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} agent</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'TACHE',
			color: '#3A9D23',
			data: c1
			
        }]
    });
	
	
});

  
</script>

</br></br>
<div class="row separateur"><div  class="text-center"><br><strong>Affichage de chaque tache selon sa durée</strong> </div></div>
</br>
	<div id="duree" style="min-width: 310px; height: 400px; margin: 0 auto">
			
	</div>	
	
	<?php 
			
			foreach($taches as $tache)
			{

				$nom[]= $tache->text;
				
				 $duration =$tache->duration;
				
				//$pc= round($duration, 0, PHP_ROUND_HALF_UP);
				$pc= round($duration);
				//$pc= round($duration*100,0);
				$c2[] = $pc;
				
			}
				
			
			?>

	<script type="text/javascript"> 
eval(<?php echo  "'var nom =  ".json_encode($nom)."'" ?>);

//eval(<?php echo "'var duration =".json_encode(  $duration)."'" ?>);
eval(<?php echo "'var c2 =".json_encode(  $c2)."'" ?>);


</script>
	
<script>

$(document).ready(function() {
		    
	$('#duree').highcharts({
        chart: {
            type:'column'
        },
        title: {
            text: 'Durée de chaque tâche dans un projet'
        },
        subtitle: {
            text: 'AFFICHAGE DE LA DUREE DE CHAQUE TACHE'
        },
        xAxis: {
            categories: nom,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DUREE(jour)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} agent</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'TACHE',
			color: 'blue',
			data: c2
			
        }]
    });
	
	
});

  
</script>

</br></br>
<div class="row separateur"><div  class="text-center"><br><strong>Affichage de chaque tache selon sa date initiale</strong> </div></div>
</br>
	<div id="date" style="min-width: 310px; height: 400px; margin: 0 auto">
			
	</div>	
	
	<?php 
			
			foreach($taches as $tache)
			{

				$noms[]= $tache->text;
				
				 $start[]=$tache->start_date;
				  $end[]=$tache->end_date;
				  
				 $duration =$tache->duration;
				
				
				$pc= round($duration);
				
				$c5[] = $pc;
				
				  
				
				
			}
				
			
			?>

	<script type="text/javascript"> 
	eval(<?php echo  "'var start =  ".json_encode($start)."'" ?>);
	eval(<?php echo  "'var c5 =  ".json_encode($c5)."'" ?>);
	eval(<?php echo "'var end =".json_encode(  $end)."'" ?>);	
	</script>
	
<script>

$(document).ready(function() {
		    
	$('#date').highcharts({
        chart: {
            type:'column'
        },
        title: {
            text: 'Date initiale de chaque tâche dans un projet'
        },
        subtitle: {
            text: 'AFFICHAGE DE LA DATE INITIALE DE CHAQUE TACHE'
        },
        xAxis: {
            categories: start,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DUREE(jour)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} agent</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'DATE INITIALE',
			color: 'red',
			data:c5
			
        }]
    });
	
	
});

  
</script>

</br></br>
<div class="row separateur"><div  class="text-center"><br><strong>Affichage de chaque tache selon sa date finale</strong> </div></div>
</br>
	<div id="fin" style="min-width: 310px; height: 400px; margin: 0 auto">
			
	</div>	
	
	<?php 
			
			foreach($taches as $tache)
			{

				
				  $end[]=$tache->end_date;
				 $duration =$tache->duration;
				$pc= round($duration);
				$c6[] = $pc;
				
				  
				
				
			}
				
			
			?>

	<script type="text/javascript"> 
	
	eval(<?php echo  "'var c6 =  ".json_encode($c5)."'" ?>);
	eval(<?php echo "'var end =".json_encode(  $end)."'" ?>);	
	</script>
	
<script>

$(document).ready(function() {
		    
	$('#fin').highcharts({
        chart: {
            type:'column'
        },
        title: {
            text: 'Date finale de chaque tâche dans un projet'
        },
        subtitle: {
            text: 'AFFICHAGE DE LA DATE FINALE DE CHAQUE TACHE'
        },
        xAxis: {
            categories: end,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DUREE (jour) '
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} agent</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'DATE FINALE',
			color: '#FFD700',
			data:c6
			
        }]
    });
	
	
});

  
</script>


</head>
	

	
<script type='text/javascript' src="<?php echo base_url();?>assets/static/Highcharts/js/highcharts.js"></script>
<script type='text/javascript' src="<?php echo base_url();?>assets/static/Highcharts/js/modules/exporting.js"></script>





</div>
</section>



