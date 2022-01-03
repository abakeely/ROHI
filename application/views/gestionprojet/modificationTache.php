 
 
 <link rel="stylesheet" href="<?php echo base_url();?>assets/iu/jquery-ui/jquery-ui.structure.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/iu/jquery-ui/jquery-ui.theme.css" />
<script src="<?php echo base_url();?>assets/iu/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/iu/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/iu/js/jquery-ui-i18n.min.js"></script>
	

<?php echo form_open("gestionprojet/update/{$tache->gantt_id}",['class'=>'form-horizontal']);?>
	
		<fieldset>
			<legend>Gestion de Projet</legend>
			
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-4 control-label">Tache</label>
						<div class="col-lg-8">
							<input type="text" name="text" placeholder="Nom de la tache" class="form-control" value="<?php echo $tache->text;?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-4 control-label">Description</label>
						<div class="col-lg-8">
							<input type="text" name="tdescr" placeholder="Prenoms" class="form-control" value="<?php echo $tache->tdescr;?>">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-4 control-label">start_date</label>
						<div class="col-lg-8">
							<input  class="form-control"  style="margin: 5px;" name="start_date" id="start_date"  placeholder="Date initiale" value="<?php echo $tache->start_date;?>" required autofocus>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-4 control-label">date finale</label>
						<div class="col-lg-8">
							<input  class="form-control"  style="margin: 5px;" name="end_date" id="end_date"  placeholder="Date finale" value="<?php echo $tache->end_date;?>" required autofocus>
							
						</div>
					</div>
				</div>
				<div class="col-lg-6">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-4 control-label">duree</label>
						<div class="col-lg-8">
							<input style="margin: 5px;" type="number" class="form-control" name="duration"   id="duration" placeholder="Duree de la tache" value="<?php echo $tache->duration;?>" required autofocus>  
					
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-4 control-label">parent</label>
						<div class="col-lg-8">
							<input type="text" name="parent" placeholder="parent" class="form-control" value="<?php echo $tache->parent;?>">
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="form-group">
				<div class="col-lg-8 col-lg-offset-4">
					<input type="submit"  value="Submit" class="btn btn-primary">  
				</div>
			</div>
		</fieldset>
<?php echo form_close();?>
	
	
<script type="text/javascript">

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

</script>


	


	