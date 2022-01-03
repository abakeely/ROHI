<script src="{$zBasePath}assets/easyweb/js/jquery_1.12.1.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>

<div id="innerContent">
	<div class="panel-body">
		<h3>Rapprochement en masse</h3>
	</div>
	<form action="{$zBasePath}GestionStructure/saveRapprochementEnMasse" method="POST" name="formulaireSend" id="formulaireSend" enctype="multipart/form-data">
		<div class="row" >
			<div class="col-md-3">
				<div class="libele_form">
					<label class="control-label label_rohi " data-original-title="" title=""><b> Fichier(*) </b></label>
				</div>
				
				<input type="file" class="form-control obligatoire" placeholder="Fichier"  name="fichierExcel" data-placement="top" data-toggle="tooltip" data-original-title="Fichier"  id="fichierExcel">
			</div>
		</div>
		<div class="row" >
			<div class="col-md-4">
				<input type="submit" class="form-control btn-primary bouton"  value="ENREGISTRER" type="submit"/>
			</div>
		</div>
	</form>
</div>
{literal}
<script>
$(document).ready(function() {

});


</script>
{/literal}