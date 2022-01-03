<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>
		<form action="{$zBasePath}gestock/save/stock/fourniture" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
		<input type="hidden" name="iTypeFournitureId" id="iTypeFournitureId" value="{if sizeof($oData.toGetListeTypeFourniture)>0}{$oData.toGetListeTypeFourniture.typeFourniture_id}{/if}">
			<fieldset>
				<table>
					<div class="row clearfix">
						<div class="cell">
							<div class="field"> 
								<label>Libellé * : </label>
								<input style="width:100%" placeholder="Veuillez entrer le libellé" type="text" id="typeFourniture_libelle" class="obligatoire" name="typeFourniture_libelle"
								value="{if sizeof($oData.toGetListeTypeFourniture)>0}{$oData.toGetListeTypeFourniture.typeFourniture_libelle}{/if}">
								<p id="iArticleSearchSingle" class="message" style="width:500px">Veuillez entrer le libellé</p>
							</div>
							<div class="field"> 
								<label>Sigle : </label>
								<input style="width:100%" placeholder="Veuillez entrer le sigle" type="text" id="typeFourniture_sigle" class="obligatoire" name="typeFourniture_sigle" value="{if sizeof($oData.toGetListeTypeFourniture)>0}{$oData.toGetListeTypeFourniture.typeFourniture_sigle}{/if}" >
								<p id="iArticleSearchPlurielle" class="message" style="width:500px">Veuillez le sigle</p>
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