<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>
		<form action="{$zBasePath}gestock/save/stock/unite" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
		<input type="hidden" name="iTypeUniteId" id="iTypeUniteId" value="{if sizeof($oData.toGetListeTypeUnite)>0}{$oData.toGetListeTypeUnite.typeUnite_id}{/if}">
			<fieldset>
				<table>
					<div class="row clearfix">
						<div class="cell">
							<div class="field"> 
								<label>Libellé * : </label>
								<input style="width:100%" placeholder="Veuillez entrer le libellé" type="text" id="typeUnite_libelle" class="obligatoire" name="typeUnite_libelle"
								value="{if sizeof($oData.toGetListeTypeUnite)>0}{$oData.toGetListeTypeUnite.typeUnite_libelle}{/if}">
								<p id="iArticleSearchSingle" class="message" style="width:500px">Veuillez entrer le libellé</p>
							</div>
							<div class="field"> 
								<label>Libellé plurielle : </label>
								<input style="width:100%" placeholder="Veuillez entrer le libellé si plusieurs" type="text" id="typeUnite_plurielle" name="typeUnite_plurielle" value="{if sizeof($oData.toGetListeTypeUnite)>0}{$oData.toGetListeTypeUnite.typeUnite_plurielle}{/if}" >
								<p id="iArticleSearchPlurielle" class="message" style="width:500px">Veuillez entrer le libellé si plusieurs</p>
							</div>
						</div>
					</div>
				</table>
			</fieldset>
		</form>
{literal}
<style>
td.left {width:20%}
</style>
<script type="text/javascript">

	
</script>
{/literal}