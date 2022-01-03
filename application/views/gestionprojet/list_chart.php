</br>   
 <?php if(count($projets) > 0) { ?>
<div class="col-sm-10">
	<label> Choisir le projet à consulter</label><br><br>
</div>
<form method="post" action="<?php echo base_url('chartes');?>">
	<div class="col-sm-4">
		<div class="form-group">
			<select class="form-control" name="pnom">
			
			 <?php foreach($projets as $projet){
					echo '<option>'.$projet->pnom.'</option>';
					
				} ?>
			</select>
		</div>	
	</div>
	<div class="col-sm-4">
		<button  class="btn btn-success" type="submit">Consulter</button>
	</div>
</form>
<?php } ?>

<br>
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
			<div id="tache" class="table-responsive">
				 <table id="dataTable" class="table table-radius" cellspacing="0" width="100%">
					<caption class="text-center">Gestion de Planning</caption>
					<thead>
						<tr>
						<th>Date ceéation</th>
						<th>Nom du Projet</th>
						<th>Description du Projet</th>
						<th>Consulter</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($dep as $deps) {?>
						<tr>	
							<td><?= $deps->date_creation ?></td>
							<td><?= $deps->pnom ?></th>
							<td><?= $deps->pdescr ?></td>
							<td><button  class="btn btn-success" type="submit">Consulter</button></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
		$('#dataTable').DataTable();
	});

</script>
