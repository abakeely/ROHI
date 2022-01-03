<script src="{$zBasePath}assets/easyweb/js/jquery_1.12.1.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>

<div id="innerContent">
	<div class="panel-body">
		<h3>Rapprochement en masse</h3>
	</div>
	<form action="{$zBasePath}GestionStructure/saveRapprochement" method="POST" name="formulaireSend" id="formulaireSend" enctype="multipart/form-data">
		<div class="row" id="div_localite_rapprochement">
				<div class="form col-md-3">
					<div class="libele_form">
						<label class="control-label label_rohi " data-original-title="" title=""><b> Ministere(*) </b></label>
					</div>
					<select onchange="getChild($(this),1)" class="form-control" placeholder="pays" name="pays" data-toggle="tooltip" data-original-title= "Safidio ny firenena misy anao" id="pays">
						<option  value="0">-------</option> 
							<option  value="1">MEF</option>
					</select>
				</div>
		</div>
		<div class="row" id="div_localite_organigramme"></div>
		<div class="row" id="div_org"></div>
		<div class="row " id="div_rap"></div>
			
		</div>

		<div class="row" id="div_detail_structure">
			<input type="hidden"   name="structure_id" id="structure_id">
			<div class="col-md-3">
				<div class="libele_form">
					<label class="control-label label_rohi " data-original-title="" title=""><b> Soa code(*) </b></label>
				</div>
				<input type="text" class="form-control obligatoire" placeholder="Soa code"  name="soa_code" data-placement="top" data-toggle="tooltip" data-original-title="Soa code"  id="soa_code">
			</div>
			<div class="col-md-3">
				<div class="libele_form">
					<label class="control-label label_rohi " data-original-title="" title=""><b> Chemin(*) </b></label>
				</div>
				<input type="text" class="form-control" placeholder="Chemin"  name="path" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="path" value="" readonly="true">
			</div>
		</div>

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