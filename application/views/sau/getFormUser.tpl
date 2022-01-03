<table id="evaluation-table">
	<tr>
		<td>
			<table id="information-table">
				<tr>
					<td style="width:30%;vertical-align:top;border:none" colspan="2">
						<form enctype="multipart/form-data">
							<fieldset>
								<div class="row clearfix">
									<div class="cell">
										<label>Nom evaluateur *</label>
										<div class="field" id="searchCandidat" style="display:block">
											<input placeholder="Veuillez entrer le nom de l'evaluateur" type="text" id="zCandidatInfo" name="zCandidatInfo">
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:100%">
										<div class="field" >
											<label><b>Nom :</label>
											<input type="text" name="visiteur_nom" id="visiteur_nom" value="" class="obligatoire">
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:100%">
										<div class="field">
											<label>Pr&eacutenom : </label>
											<input type="text" name="visiteur_prenom" id="visiteur_prenom" value="" class="obligatoire">
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:100%">
										<div class="field">
											<label>CIN :</label>
											<input type="text" name="visiteur_prenom" id="visiteur_prenom" value="" class="obligatoire">
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:100%">
										<div class="field">
											<label>Porte :</label>
											<select id="type_id" name="type_id" class="obligatoire">
												<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
												{foreach from=$toPorte item=toPorte }
												<option value="{$toPorte.porte_id}">{$toPorte.porte_nom}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:100%">
										<div class="field">
											<label>Badge :</label>
											<select id="type_id" name="type_id" class="obligatoire">
												<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
												{foreach from=$toBadge item=toBadge }
												<option value="{$toBadge.badge_id}">{$toBadge.badge_nom}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{literal}
<style>
table { margin:0 }
td  { border-bottom: none };
</style>
<script>

$(function() {

	$('#dialog').removeAttr('tabindex')

	var dataArrayInfo = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	
	$("#zCandidatInfo").select2
	({
		initSelection: function (element, callback)
		{
			
			$(dataArrayInfo).each(function()
			{
				if (this.id == element.val())
				{
					callback(this);
					return
				}
			})
		},
		allowClear: false,
		placeholder:"Sélectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#zCandidatInfo").select2('val',$("#idSelect").val());

});

</script>
{/literal}