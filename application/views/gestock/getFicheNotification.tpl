<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>
<form action="{$zBasePath}gestock/redirect/2" method="POST" name="formulaireEdit2" id="formulaireEdit2" enctype="multipart/form-data">
	<fieldset>
		<table>
			<div class="row clearfix">
				<div class="cell">
					<div class="field"> 
						<label>Date : </label>
						<input type="text" id="zDateStock" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" name="zDateStock" class="withDatePicker obligatoire1">
						<p id="iQuantiteMessage" class="message" style="width:500px">Veuillez entrer la date de rappel</p>
					</div>
				</div>
			</div>
		</table>
	</fieldset>
</form>