<style>
fieldset {
    font-family: sans-serif;
    background: #9AA2B5;
    border-radius: 5px;
    padding: 15px;
}

fieldset legend {
    background: #C3B2B8;
    color     : #FFFFFF;
	
    padding: 5px 5px ;
    font-size: 18px;
    border-radius: 5px;
    margin-left: 15px;
}

	body{
   font-family:NOMDELAFONT, Lato;
}

</style>
<div class="row">
	<fieldset style="min-height:10px;">
	<legend>Creation Projet</legend>
		<form class="form-signin"  method="post" action="<?php echo base_url('gestionprojet/creation');?>">
			<div class="row">
				<div class="col-md-2 libele_form">
					<label class="control-label"> Nom du Projet </label>
				</div>
				<div class="col-md-5">
					<input type="text"  class="form-control" placeholder="Nom du Projet " id="nom_du_projet" name = "nom_du_projet" required autofocus>
				</div>
				<div class="col-md-2"></div>
			</div><br>
			<div class="row">
				<div class="col-md-2 libele_form">
					<label class="control-label">Description du Projet</label>
				</div>
				<div class="col-md-5">
					<textarea name = "description_du_projet" id="description_du_projet"  class="form-control" placeholder="ceci est un projet qui consiste à ..." required></textarea>
				</div>
				<div class="col-md-2">
				</div>
			</div><br>
			<div class="row">
			<div class="col-md-2 libele_form">
					<label class="control-label">Responsable du projet</label>
			</div>
			<div class="col-md-5">
				<select class="form-control" name = "responsable">
					<?php
					foreach($sResponsable as $sItem){
						echo '<option  value="'.$sItem->id.'">'.$sItem->prenom.'</option>';
					}
					?>
				</select>
			</div>
			</div><br>
			<div class="col-md-2"></div>
					<button class="btn  btn-info" type="submit">Créer un projet</button>
			<div class="col-md-2"></div>
		</form>	
    </fieldset>
	<br>
	<div id="tache" >
	<table class="table table-striped table-bordered table-hover" id="example">
			<caption class="text-center">Gestion de Planning</caption>
			<thead>
				<tr>
					<th>Date de création</th>
					<th>Nom du Projet</th>
					<th>Description du Projet</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($dep as $deps) {?>
				<tr>
					<td><?= $deps->date_creation ?></td>
					<td><?= $deps->pnom ?></th>
					<td><?= $deps->pdescr ?></td>
					<td><?php echo anchor("gestionprojet/consulter/{$deps->pnum}",'Consulter',['class'=>'btn btn-primary right-rounded']); ?>
					<?php echo anchor("liste/delete/{$deps->pnum}",'Supprimer',['class'=>'btn btn-danger right-rounded']); ?></td>
					
				</tr>
			<?php } ?>
			</tbody>
		</table>
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

</script>