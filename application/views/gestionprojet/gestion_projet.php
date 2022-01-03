
<link rel="stylesheet" href="jquery-ui.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/iu/jquery-ui/jquery-ui.structure.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/iu/jquery-ui/jquery-ui.theme.css" />
<script src="<?php echo base_url();?>assets/iu/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/iu/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/iu/js/jquery-ui-i18n.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
		$('#data').DataTable();
	});
	
$(document).ready(function(){
		$('#dataTable').DataTable();
	});
	
</script>


<link rel="stylesheet" href="<?php echo base_url();?>assets/static/assets3/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/static/assets3/buttons.dataTables.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/static/assets3/jquery.dataTables.min.js"> </script>
<script src="<?php echo base_url();?>assets/static/bt-sp-v3.3.4/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/static/bt-sp-v3.3.4/js/main.js"></script>

    <!-----------------   --------------------->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header"><br>
							<p><span><b>Description du projet :</b> </span><?= $projet->pdescr; ?></p>
							<?php foreach( $utilisateurs as $utilisateur){?>
								<p></span><span><b>Personnes affect&eacute;es au projet</b></span></p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span><b>Nom :</b></span> <?=$utilisateur->nom?></p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span><b>Pr&eacute;noms :</b></span> <?=$utilisateur->prenom?></p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span><b>Comp&eacute;tence : </b></span> <?=$utilisateur->domaine?></p>
							<?php } ?>
						</div>
					</div>
				</nav> 
			</div>
		</div>
		<!-----------------   --------------------->
		<div class="panel-body">			
			<a class="btn btn-success " href="#creationProfil" onclick="document.getElementById('creationProfil').style='display:block'" >
			<span class="btn btn-success glyphicon glyphicon-plus"></span>
			Cr&eacute;ation T&acirc;che</a>
			
			<div id="creationProfil" class=container" style="display:none; width:50%">
				<a class="btn-block" onclick="document.getElementById('creationProfil').style='display:none';"><span class="btn btn-danger glyphicon glyphicon-minus"></span></a>
				<form class="form-signin"  method="post" action="gestionprojet/addTache">
					<div class="panel panel-white col-md-6">
						<input style="margin: 5px;" type="text" name="text" class="form-control" placeholder="Nom de la t&acirc;che" required autofocus>
						<input style="margin: 5px;" type="text" name="tdescr"  class="form-control" placeholder="Description de la t&acirc;che">  								 
						<select class="form-control"  style="margin: 5px;" name="user_id" required autofocus>
							<?php foreach($utilisateurs as $user){
								echo '<option value="'.$user->id.'">'.$user->prenom.'</option>';
							} ?>						 
						</select>	 
						<input style="margin: 5px;" type="number" class="form-control" name="parent" min="0" max="1000" placeholder="Parent de la t&acirc;che" required autofocus>  	
					</div>
					<div class="panel panel-white col-md-6">
						<div  class="panel panel-white col-md-4">
							<div class="form-group">
								<input  class="form-control"  style="margin: 5px;" name="start_date" id="start_date"  placeholder="Date Debut" required autofocus>
								<div id="calendarMain2" ></div>
							</div>
						</div>
						<div class="panel panel-white col-md-4">
							<div class="form-group">
								<input  class="form-control"  style="margin: 5px;" name="end_date" id="end_date"  placeholder="Date Fin" required autofocus >
								<div id="calendarMain3" ></div>
							</div>	
						</div>
						<div class="panel panel-white col-md-4">
							<div class="form-group">
									<input style="margin: 5px;" type="number" class="form-control" name="duration" id="duration"   placeholder="Dur&eacute;e" required autofocus >
								<div id="calendarMain3" ></div>
							</div>	
						</div>
						<br>
					 	<div align=left>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit">Cr&eacute;ation de la t&acirc;che</button>
						</div>
					</div>					
				</form>
			</div>
			</br></br>
		</div>
		<!-----------------   --------------------->
		<div class="panel panel-white">
			<div class="panel-body">
				<div id="tache" class="table-responsive">
					 <table id="dataTable" class="table table-radius" cellspacing="0" width="100%">
						<caption class="text-center"><b>Gestion de Planning</b></caption>
						<thead>
							<tr>
								<th class="green"><strong style="color:white">Id</strong></th>
								<th class="green"><strong style="color:white">Tache</strong></th>
								<th class="green"><strong style="color:white">Affectation</strong></th>
								<th class="green"><strong style="color:white">Description</strong></th>
								<th class="green"><strong style="color:white">Date initiale</strong></th>
								<th class="green"><strong style="color:white">dur&eacute;e</strong></th>
								<th class="green"><strong style="color:white">progression(%)</strong></th>
								<th class="green"><strong style="color:white">parent</strong></th>
								<th class="green"><strong style="color:white">date finale</strong></th>
								<th class="green"><strong style="color:white">Modifier</strong></th>
								<th class="green"><strong style="color:white">Supprimer</strong></th>
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
								<td><?php echo anchor("gestionprojet/edit/{$tache->gantt_id}",'Modifier',['class'=>'btn btn-success left-rounded']); ?></td>
								<td><?php echo anchor("gestionprojet/delete/{$tache->gantt_id}",'Supprimer',['class'=>'btn btn-danger right-rounded']); ?></td>
								
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!---------
<div class="panel-heading">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Ajout/Suppression de membre</a>
			</div>
		</div>
	</nav>
</div>

<!--
<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="panel-body">
			<?php if(count($utilisateurs_non_affecte) > 0) { ?>
			<form method="post" action="gestionprojet/addMembre">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 labelForm libele_form">
                            <label class="control-label">Choisir le membre &agrave; ajouter </label>
                    </div>
                     <div class="col-md-3">
                        <select class="form-control" name="id">
							<?php foreach($utilisateurs_non_affecte as $user){
								echo '<option value="'.$user->id.'">'.$user->prenom.'</option>';
							} ?>
					    </select>
                    </div></br>
					<button class="btn btn-primary" type="submit">Ajouter </button>
                    <div class="col-md-5"></div>
            </form>	
		    <?php } ?>
			
			<form method="post" action="gestionprojet/delMembre">
                    <div class="col-md-4 labelForm libele_form">
                            <label class="control-label">Choisir le membre &agrave; supprimer </label>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="id">
							<?php foreach($utilisateurs as $user){
								echo '<option value="'.$user->id.'">'.$user->prenom.'</option>';
							} ?>
					    </select>
                    </div></br>
					<button class="btn btn-danger" type="submit">Supprimer</button>
                    <div class="col-md-5"></div>
			</form>
		</div>
	</div>
</div>
</div>
</div>
		<!--
		<div id="configuration" class="panel panel-white col-md-6">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="panel-heading">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
								<div class="navbar-header">
									<a class="navbar-brand" href="#"><p style="text-align:center">Modification du projet</p> </a></br>
								</div>
							</div>
						</nav>
					</div>
					<div class="panel-body">
						<form class="form-signin"  method="post" action="gestionprojet/modificationProjet#configuration">
							<label class="">Nom du projet</label>
							<input type="text" name="pnom" class="form-control" placeholder="Nom du projet" required=""></br>
							<label class="">D&eacute;scription</label>
							<input type="text" name="pdescr" class="form-control" placeholder="Ceci est un projet qui consiste &agrave; ..." required="">
							<input type="hidden" name="pnum" value="<?= $projet->pnum ?>">
							<br/>
							<button class="btn btn-primary "  type="submit">Enregistrer</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		-->
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#dataTable').DataTable();
  });

$(document).ready(function(){
	$('#data').DataTable();
  });

$(document).ready(function() {
  $.datepicker.regional['fr'] = {
	closeText: 'Fermer',
	prevText: '<Préc',
	nextText: 'Suiv>',
	currentText: 'Courant',
	monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
	'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
	'Jul','Aoû','Sep','Oct','Nov','Déc'],
	dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
	dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
	dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
	weekHeader: 'Sm',
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['fr']);

$( "#start_date,#end_date" ).datepicker({
	changeMonth: true,
	changeYear: true,
	firstDay: 1,
	dateFormat: 'dd/mm/yy',
  })

$( "#start_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
$( "#end_date" ).datepicker({ dateFormat: 'dd-mm-yy' });

$('#end_date').change(function() {
	var start = $('#start_date').datepicker('getDate');
	var end   = $('#end_date').datepicker('getDate');

if (start<end) {
var days   = (end - start)/1000/60/60/24;
$('#duration').val(days);
}

else {
alert ("minimum une journee!");
$('#start_date').val("");
$('#end_date').val("");
$('#duration').val("");
}
}); //end change function
}); //end ready

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
	
	


</script>
