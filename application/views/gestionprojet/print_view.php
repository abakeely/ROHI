
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div id="tache" class="table-responsive">
                         <table id="dataTable" class="table table-radius" cellspacing="0" width="100%">
							<caption class="text-center">Gestion de Planning</caption>
                            <thead>
                                <tr>
								<th class="green"><strong style="color:white">Id</strong></th>
								<th class="green"><strong style="color:white">T&acirc;che</strong></th>
								<th class="green"><strong style="color:white">Affectation</strong></th>
                                <th class="green"><strong style="color:white">Description</strong></th>
								<th class="green"><strong style="color:white">Date initiale</strong></th>
								<th class="green"><strong style="color:white">dur&eacute;e</strong></th>
								<th class="green"><strong style="color:white">progression(%)</strong></th>
								<th class="green"><strong style="color:white">parent</strong></th>
								<th class="green"><strong style="color:white">date finale</strong></th>
                                </tr>
                            </thead>
                            <tbody>
							 <?php foreach($taches as $tache) {?>
                                <tr>	
									<td class="silver"><?= $tache->gantt_id ?></td>
                                    <td class="danger"><?= $tache->text ?></td>
                                    <td class="warning">
									<?= $tache->nom ?></br> 
									<?= $tache->prenom ?>
                                    </td>
                                    <td class="info"><?= $tache->tdescr ?></td>
								    <td class="active"><?= $tache->start_date ?></td>
									<td class="danger"><?= $tache->duration ?></td>
									<td class="warning"><?= round($tache->progress*100,0) ?></td>
									<td class="info"><?= $tache->parent ?></td>
									<td class="warning"><?= $tache->end_date ?></td> 
                                </tr>
							<?php } ?>
                            </tbody>
                        </table>
                    </div>
					<div class="col-md-2">
						<a href="<?php echo base_url();?>imprimerpdf" class="btn btn-primary form-control " data-toggle="tooltip" target="_blank" > <font style="font-size: 1em;">  PDF </font></a>
					</div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    
<script type="text/javascript">

	$(document).ready(function(){
		$('#dataTable').DataTable();
	});

</script>
