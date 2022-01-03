<form>
<input type="hidden" name="iUserLocaliteId" id="iUserLocaliteId" value="{$toLocalite.0.localite_userId}">
<input type="hidden" name="iSize" id="iSize" value="{$iSize}">
<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
	<div class="communiqueMfb" style="margin-bottom: 6px;padding: 10px 0px 22px 12px;min-height: 100px!important;width: 99%;">
		<div class="widget-body">
			<div style="width:30%;float:left;">
				<div class="left">
					<p class="photo1"><img width="200" src="{$zPathWithPhoto}"/></p>
				</div>
			</div>
			<div style="width:70%;float:right;">
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">&nbsp;</label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Nom : <span style="font-weight:normal">{$toLocalite.0.nom}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Pr&eacute;nom  : <span style="font-weight:normal">{$toLocalite.0.prenom}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Matricule  : <span style="font-weight:normal">{$toLocalite.0.matricule}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Pays  : <span style="font-weight:normal">{$toLocalite.0.zPays}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Province  : <span style="font-weight:normal">{$toLocalite.0.zProvince}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">R&eacute;gion  : <span style="font-weight:normal">{$toLocalite.0.zRegion}</span></label>
				</div>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">District  : <span style="font-weight:normal">{$toLocalite.0.zDistrict}</span></label>
				</div>
				{if $toLocalite.0.zDirection != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Direction  : <span style="font-weight:normal">{$toLocalite.0.zDirection}</span></label>
				</div>
				{/if}
				{if $toLocalite.0.zService != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Service  : <span style="font-weight:normal">{$toLocalite.0.zService}</span></label>
				</div>
				{/if}
				{if $toLocalite.0.zDivision != ""}
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px;font-weight:bold">Division  : <span style="font-weight:normal">{$toLocalite.0.zDivision}</span></label>
				</div>
				{/if}
				<div class="field">
					<input type="button" style="background: -webkit-gradient(linear,left top,left bottom,from(#5d919c),to(#1d3f46));color:white;cursor:pointer" class="button" style="width:226px;" onClick="sendLocalite(2);" name="validerChange" id="validerChange" value="Valider">
					<input type="button"  class="button" style="background: -webkit-gradient(linear,left top,left bottom,from(#5d919c),to(#1d3f46));color:white;cursor:pointer" onClick="sendLocalite(3);" name="validerChange1" id="validerChange1" value="Refuser">
				</div>
			</div>
		</div>
	</div>
</div>
</form>
