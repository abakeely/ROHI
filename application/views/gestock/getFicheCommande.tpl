<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>

		<form action="{$zBasePath}gestock/save/stock/commande" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
		<input type="hidden" name="iSotckId" id="iSotckId" value="">
			<fieldset>
				<table>
					<div class="row clearfix">
						<div class="cell">
							<div class="field"> 
								<label>Article : </label>
								<input style="width:80%" placeholder="Veuillez s&eacute;l&eacute;ctionner un article" type="text" id="iArticleId" name="iArticleId">
								<p id="iArticleSearchMessage" class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner un article</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Quantité : </label>
								<input style="width:15%" type="text" id="iQuantite" name="iQuantite" class="obligatoire">
								<p id="iQuantiteMessage" class="message" style="width:500px">Veuillez entrer la quantité</p>
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

	
	$(document).ready (function ()
	{
		
			$("#iArticleId").select2
			({
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
				url: "{/literal}{$zBasePath}{literal}gestock/getFourniture/",
				dataType: 'jsonp',
				data: function (term)
				{
					return {q: term, iFiltre:1};
				},
				results: function (data)
				{
					return {results: data};
				}
				}
			}) ;

			/*$("#iArticleId").select2('val',$("#iUserAutoriteId").val());*/

	})
</script>
{/literal}