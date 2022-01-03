<fieldset>
	<div class="row1">
		<div class="cell small">
			<div class="field">
				<label>Matricule</label>
				<input type="text" name="iMatricule" id="iMatricule" value="{$iMatricule}" placeholder="">
				<p class="message debut" style="width:500px">&nbsp;</p>
			</div>
		</div>
	</div>
	<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
		<div class="cell small">
			<div class="field">
				<label>CIN</label>
				<input type="text" name="iCin" id="iCin" value="{$iCin}" placeholder="" >
				<p class="message fin" style="width:500px">&nbsp;</p>
			</div>
		</div>
	</div>
	<div class="row1 " style="padding: 7px 0 20px;">
		<div class="cell">
			<div class="field">
				<input type="button" class="button" onClick="rechercher();" name="" id="" value="rechercher">
			</div>
		</div>
	</div>
</fieldset>