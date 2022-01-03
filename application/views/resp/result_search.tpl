{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script src="{$zBasePath}assets/common/js/home.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Localité de service</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item">Localité de services111</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<!---->
								<div class="SSttlPage">
									<div id="searchAcc">
										<div class="card punch-status">
											<h2>Modification localité de service (Département / direction / service)</h2>
											<form action="{$zBasePath}gcap/search_matricule" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data" style="display:block;">
											<input type="hidden" name="idSelect2" id="idSelect2" value="{if isset($oData.oDetache[0].institution_id)}{$oData.oDetache[0].institution_id}{/if}">
											<input type="hidden" name="textSelect2" id="textSelect2" value="{if isset($oData.oDetache[0].institution_libelle)}{$oData.oDetache[0].institution_libelle}{/if}">
											<fieldset>
											<div class="row1">
												<div >
													<div class="field">
														<label>&nbsp;</label>
														<select style="width:150px!important" class="form-control" name="type" onchange="changeMask()" id="type">
															<option value="im">MATRICULE</option>
															<option value="cin">CIN</option>
														</select>

														<p class="message debut" style="width:500px">&nbsp;</p>
													</div>
												</div>
											</div>
											<div class="row1">
												<div >
													<div class="field">
														<label>Matricule ou CIN</label>
														<input style="width:150px!important" class="form-control" placeholder="matricule ou CIN" name="im" id="num" value="{$oData.candidat->matricule}"/>
													</div>
												</div>
											</div>
											<div class="row1" id="searchCandidat">
												<div >
													<div class="field">
															<label>&nbsp;</label>
															<input style="width:300px!important" placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
													</div>
												</div>
											</div>
											<div >
												<div class="field">
													<button onclick="setListeEvaluation()" class="form-control">Afficher</button>
												</div>
											</div>
											</fieldset>
											</form>
										</div>
										
									</div>
								</div>
								<!---->

								<table>
										<tr>
											<td><h3>{$oData.candidat->nom} {$oData.candidat->prenom}</h3></td>
										</tr>
										<tr>
											<td>
												
												<form action="{$zBasePath}user/valide_respers" method="POST" name="formulaire" id="formulaire" enctype="multipart/form-data">
												<input type="hidden" value="{$oData.user_edit.id}" name="user_id"/>
												<input type="hidden" name="iLocalite" id="iLocalite" value="">
												<input type="hidden" name="zLocaliteNiveau" id="zLocaliteNiveau" value="">
												<fieldset>
														<div class="col-md-6">
															
															<div class="labelForm libele_form">
																<label class="control-label " data-original-title="" title=""><b> D&eacute;partement </b><b><font color="red"> * </font></b></label>
															</div>
															<div class="form form-group">
																<select class="form-control" placeholder="Departement"  onChange="getLocaliteCv('{$zBasePath}',1,this.value);" name="departement" data-toggle="tooltip" data-original-title= "Safidio ny Departemanta na sampan-draharaha misy anao" id="departement"{if $zRole=='chef'}{/if}>
																	<option  value="0">-------</option> 
																	{foreach from=$oData.list_departement item=oDepartement}
																		{if $oDepartement.id != 1}
																		<option  value={$oDepartement.id} {if $oDepartement.id==$oData.user_edit.dep}selected="selected"{/if}>{$oDepartement.libele}</option>
																		{/if}
																	{/foreach}
																</select>
															</div>
															<div id="iLocalite_1" class="clearfix">
																{$oData.oData1.zSelectDirection}
															</div>
															<br>
															<div id="iLocalite_2" class="clearfix">
																{$oData.oData1.zSelectService}
															</div>
															<br>
															<div id="iLocalite_3" class="clearfix">
																{$oData.oData1.zSelectSouService}
															</div>
															<br>
															<div id="iLocalite_4" class="clearfix">
																{$oData.oData1.zSelectDivision}
															</div>
															<br>
															<div class="cell">
																<div class="field">
																	<input type="submit" value="valider">
																</div>
															</div>
														</div>
														<div class="col-md-5">
															<!--  -->
														</div>
														
												</fieldset>
												</form>
											</td>
										</tr>
								</table>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>		
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<style>
label {text-align:left!important;}

</style>
<script type="text/javascript">
   		$("#num").mask("999999"); 
		$("#phone").mask("999 99 999 99"); 
		$("#cin").mask("999 999 999 999");
   		function changeMask(){
   			var type = $("#type").val(); 
   			if(type=="cin")
   				$("#num").mask("999 999 999 999");
   			else
   				$("#num").mask("999999");   
   	   	}

		$(document).ready (function ()
		{
		
			var dataArrayAgent = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
			
			$("#zCandidatSearch").select2
			({
				initSelection: function (element, callback)
				{
					
					$(dataArrayAgent).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
				},
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

			$("#zCandidatSearch").select2('val',$("#idSelect").val());

			
			var dataArrayAgent1 = [{id:$("#idSelect2").val(),text:$("#textSelect2").val()}];
			
			$("#iInstitutionId").select2
			({
				initSelection: function (element, callback)
				{
					$(dataArrayAgent1).each(function()
					{
						if (this.id == element.val())
						{
							callback(this);
							return
						}
					})
				},
				allowClear: true,
				placeholder:"Sélectionnez",
				minimumInputLength: 3,
				multiple:false,
				width: "100%",
				formatNoMatches: function () { return $("#AucunResultat").val(); },
				formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
				formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
				formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
				formatSearching: function () { return "Recherche..."; },			
				ajax: { 
					url: "{/literal}{$zBasePath}{literal}gcap/getInstitution/",
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

			$("#iInstitutionId").select2('val',$("#idSelect2").val());
		});
</script>
{/literal}