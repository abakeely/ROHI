<form action="#" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
		<fieldset>
			<div class="row1">
				<div class="cell small">
					<div class="field">
						<label>Login</label>
						<input type="text" name="zLogin" autocomplete="off" id="zLogin" value="{$toUser.0->login}" placeholder="">
					</div>
				</div>
			</div>
			<div class="row1">
				<div class="cell small">
					<div class="field">
						<label>Mot de passe</label>
						<input type="text" name="zPass" id="zPass" autocomplete="off" value="{$toUser.0->password}" placeholder="" >
					</div>
				</div>
			</div>
		</fieldset>
</form>