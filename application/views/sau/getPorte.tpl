
<form>
<input type="hidden" name="idSelect" id="idSelect" value="">
<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">
				<i class="ace-icon la la-tint"></i>
				Formulaire ajout porte
			</h4>
		</div>
		
		<div class="widget-body">
			<div class="widget-main">
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px">D&eacute;partement * :</label>
				</div>

				<div class="control-group">
					<div class="bootstrap-colorpicker"> 
						<select id="iDepartementId" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
							<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
							{foreach from=$oDepartement item=oDepartement }
							<option {if $oDepartement.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement.id}">{$oDepartement.libele}</option>
							{/foreach}
						</select>
					</div>
				</div>
				<br/>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px">Direction * :</label>
				</div>

				<div class="control-group">
					<div class="bootstrap-colorpicker"> 
						<select id="iOrganisation_1" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
							<option value="0">s&eacute;l&eacute;ctionner une direction</option>
							{foreach from=$oDirection item=oDirection }
							<option {if $oDirection.id == $oCandidat.0->direction} selected="selected" {/if} value="{$oDirection.id}">{$oDirection.libele}</option>
							{/foreach}
						</select>
					</div>
				</div>
				<br/>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px">Service *:</label>
				</div>

				<div class="control-group">
					<div class="bootstrap-colorpicker"> 
					<select id="iOrganisation_2" name="iServiceId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
						<option value="0">s&eacute;l&eacute;ctionner un service</option>
						{foreach from=$oService item=oService }
						<option {if $oService.id == $oCandidat.0->service} selected="selected" {/if} value="{$oService.id}">{$oService.libele}</option>
						{/foreach}
					</select>
					</div>
				</div>
				<br/>
				<div class="clearfix">
					<label for="colorpicker1" style="font-size:13px">Porte * :</label>
				</div>

				<div class="control-group">
					<div class="bootstrap-colorpicker"> 
						<input  style="width: 40%;" id="zPorte" name="zPorte" type="text" class="input-small" />
					</div>
				</div>
				
			</div>
		</div>
		
	</div>
	
</div>
</form>
