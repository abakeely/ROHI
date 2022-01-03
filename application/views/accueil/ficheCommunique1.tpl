{include_php file=$zHeader}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
	</div>
	<div id="innerContent">
		<h2>Mod&eacute;ration Communiqu&eacute;</h2>
		<form action="{$zBasePath}accueil/saveCommunique" method="POST" name="formulaireGet" id="formulaireGet" enctype="multipart/form-data">
		<fieldset>
		<div class="row clearfix"> 
		{$oData.zData}
		</div>
		
		<div class="row clearfix"> 
				<div class="cell">
					<div class="field">
						<input type="submit" class="submit" name="" id="" value="Enregistrer">
					</div>
				</div>
			</div>
		</fieldset>
		</form>
	</div>
</section>
{include_php file=$zFooter}