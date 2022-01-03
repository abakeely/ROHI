<style>
	.cellStat {
		border : solid
	}
	.centerStat {
		text-align:center;
	}
	
	.titre_stat{
		font-size: 22px; font-weight: bold;
	}
	th{
		background : palegoldenrod none repeat scroll 0 0;
	}
	td{
		border-width:1px !important;
	}
	
</style>
<script type="text/javascript">
	$(document).ready(function () {

		// prepare chart data
		<?php if(isset($titreX)){ ?>
		var sampleData = [
			<?php 
			$size = sizeof($data);
			$cp = 0;
			foreach($data as $stat){ $cp++;?>
			{ departement: '<?php echo $cp ;?> ', nombre :<?php echo $stat['nb'] ?> } 
			<?php
				if($cp != $size) echo ',';  
			} ?>
		]
		
		
		var settings = {
                title: "<?php echo $titreX;?>",
                description: "Statistique par <?php echo $titreX;?>",
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                categoryAxis:
                    {
                        dataField: 'departement',
                        showGridLines: false
                    },
                colorScheme: 'scheme04',
                showToolTips: false,
                enableAnimations: true,
                seriesGroups:
                    [
                        {
                            type: 'column',
                            valueAxis:
                            {
                                minValue: 0,
                                maxValue: <?php echo $max;?>,
                                unitInterval: <?php echo round($max/10, 0);?>,
                                description: 'Nombre'
                            },

                            series: [
                                    { dataField: 'nombre', displayText: 'nombre' }
                                ]
                        }
                    ]
            };
		// setup the chart
		$('#graphe').jqxChart(settings);
		<?php }?>
	});
</script>
	<div class="col-md-12">
		<br>
		<div class="row">
			<div class="col-md-12">
				<!-- FORME DE SELECTION-->
				<div  class="row">
					<form action="<?php echo base_url();?>statistique/statistic_main" method="POST" style="height: 53px; padding: 9px;">
						<div class="col-md-4">
							<select name="selection" class="form-control">
								<option value="1">PAR DEPARTEMENT</option>
								<option value="2">PAR DIRECTION</option>
								<option value="3">PAR SERVICE</option>
								
								<option value="6">PAR STATUT</option>
								<option value="10">PAR CORPS</option>
								<option value="11">PAR GRADE</option>
								<option value="12">PAR INDICE</option>
								
								<option value="5">PAR SEXE</option>
								<option value="8">PAR SITUATION MATRIMONIAL</option>
								
								<option value="7">PAR DISTRICT</option>
								<option value="4">PAR REGION</option>
								<option value="9">PAR PROVINCE</option>	
							</select>
						</div>
						<div class="col-md-3">
								<button type="submit" class="form-control"> VOIR STATISTIQUE </button>
						</div>
						<div class="col-md-4"></div>
					</form>
				</div>
				<?php if(isset($titreX)){?>
				<!-- TABLEAU DE RESULTAT -->
				<br>
				<div class="row">
				<div class="row separateur"> <div class="col-md-12 titre_stat">Statistique des Agents selon leur <?php echo $titreX;?></div></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<table border="3" style="width:100%">
							<tr>
								<th class="cellStat centerStat"style="width:10px"><font size="4"><font face="Times New Roman">Ordre</font></font></th>
								<th class="cellStat centerStat" style="width:1000px"><font size="4"><font face="Times New Roman">Libele</font></font></th>
								<th class="cellStat centerStat" style="width:100px"><font size="4"><font face="Times New Roman">Nombre</font></font></th>
								<th class="cellStat centerStat" style="width:100px"><font size="4"><font face="Times New Roman">Pourcentage</font></font></th>
							</tr>
						<?php 
							$size = sizeof($data);
							$cp = 0;
							foreach($data as $stat){ $cp++;?>
								<tr>
									<td class="cellStat centerStat" style="width:10px"><font size="4"><font face="Times New Roman"><?php echo $cp;?></font></font> </td>
									<td class="cellStat" style="width:1000px"><font size="4"><font face="Times New Roman"><?php echo isset($stat['libele'])?$stat['libele']:'' ?></font></font></td>
									<td class="cellStat centerStat"style="width:100px"><font size="4"><font face="Times New Roman"><?php echo $stat['nb']; ?></font></font </td>
									<td class="cellStat centerStat" style="width:100px"><font size="4"><font face="Times New Roman"><?php echo round(($stat['nb']/$total)*100, 2); ?> %</font></font></td>
								</tr>
							<?php } ?>
							<tr>
								<td class="cellStat centerStat" colspan="2"><font size="4"><font face="Times New Roman">TOTAL</font></font></td>
								<td class="cellStat centerStat" ><font size="4"><font face="Times New Roman"><?php echo $total; ?></font></font></td>
								<td class="cellStat centerStat"><font size="4"><font face="Times New Roman">100 %</font></font></td>
								<!-- <td class="cellStat centerStat"><?php echo ($stat['nb']*100); ?> %</td> -->
							</tr>
							
						</table>
					</div>
				</div>
				<br>
				<!-- GRAPHE -->
				<div class="row">
					<div class="col-md-12" id="graphe" style="width:1080px; height:1500px; position: relative; left: 0px; top: 0px;"></div>
				</div>
				<?php }?>
			</div>    
		</div>
	</div>


 