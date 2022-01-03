
        <?php if(count($sProjets) > 0) { ?>
		<div class="col-sm-10">
			<label> Choisir le projet à imprimer</label><br><br>
		</div>
        <form method="post" action="<?php echo base_url('imprimer');?>">
		
			<div class="col-sm-4">
				<select class="form-control" name="pnom">
                <?php foreach($sProjets as $sProjet){
                    echo '<option>'.$sProjet->pnom.'</option>';
                } ?>
				</select>
			
			</div>
			<div class="col-sm-4">
				<button  class="btn btn-success" type="submit">Imprimer</button>
			</div>
        </form>
	
	   <?php } ?>
	    <br><br><br><br> <br><br>
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div id="tache" class="table-responsive">
                         <table id="dataTable" class="table table-radius" cellspacing="0" width="100%">
							<caption class="text-center">Gestion de Planning</caption>
                            <thead>
                                <tr>
								<th>Nom du Projet</th>
								<th>Description du Projet</th>
								<th>Imprimer</th>
                                </tr>
                            </thead>
                            <tbody>
							 <?php foreach($dep as $deps) {?>
                                <tr>	
									<td><?= $deps->pnom ?></th>
                                    <td><?= $deps->pdescr ?></td>
									<td><button  class="btn btn-success" type="submit">Imprimer</button></td>
                                </tr>
							<?php } ?>
                            </tbody>
                        </table>
                    </div>
					
                </div>
            </div>
        </div>
		
		<script type="text/javascript">


    function addRow() 
	{
        console.log(document.getElementById('bouton_tache'));
        if(document.getElementById('addTache').style.display=="table-row")
		{
            document.getElementById('addTache').style.display="none";
            document.getElementById('bouton_tache').lastElementChild.className = "btn btn-success glyphicon glyphicon-plus";
        }
        else
		{
            document.getElementById('addTache').style.display="table-row";
            document.getElementById('bouton_tache').lastElementChild.className = "btn btn-danger glyphicon glyphicon-minus";
        }
    }
	
	$(document).ready(function()
	{
		$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
		});
	});

	$(document).ready(function(){
		$('#dataTable').DataTable();
	});

</script>
  