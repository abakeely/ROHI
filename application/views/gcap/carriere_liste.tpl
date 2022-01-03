{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/app/carriere.js?{$zClearCache}"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste des projets</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des Carri&egrave;res</a></li>
									<li class="breadcrumb-item">Liste</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
										<div class="card punch-status">
											<h5>RECHERCHE</h5>
											<form action="{$zBasePath}carriere/liste/gestion-des-carrieres/" method="GET" name="formulaireSearch" id="formulaireSearch" style="display:block!important" enctype="multipart/form-data">
												<fieldset>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Identification par</label>
																<select  style="width:189px!important" id="identification" name="identification" onchange="changeMask()">
																	<option {if $oData.identification=="matricule"} selected="selected"{/if} value="matricule">Matricule</p>
																	<option {if $oData.identification=="cin"} selected="selected"{/if} value="cin">CIN</p>
																</select>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Matricule ou CIN</label>
																<input type="text" style="width:189px!important" name="matricule" id="matricule" value="{$oData.champMat}" placeholder="matricule">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Type de projet</label>
																<select  style="width:189px!important" id="type" name="type">
																	<option value="">Tous</p>
																	{foreach from=$oData.toType item=label key=key}
																	<option {if $oData.type==$key} selected="selected"{/if} value="{$key}">{$label}</p>
																	{/foreach}
																</select>
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Date des projets</label>
																<input type="text" style="width:189px!important" name="date" id="date" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$oData.date|date_format2}" value="{$oData.date}" placeholder="s&eacute;l&eacute;ctionner la date" class="withDatePicker">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field">
																<label>Nom et Pr&eacute;nom</label>
																<input type="text" style="width:300px!important" id="zCandidatSearch" name="zCandidatSearch" value="{$oData.nom} {$oData.prenom}" placeholder="Veuillez entrer le nom de l'agent">
															</div>
														</div>
													</div>
													<div class="row1">
														<div class="cell">
															<div class="field" style="text-align:center">
																<input type="button" class="button"  onClick="rechercherProjet();" name="" id="" value="Rechercher">
															</div>
														</div>
													</div>
												</fieldset>
											</form>
								</div>
								<br/><br/>
								<h3>Liste des projets</h3>
								<div class="">
									<table>
										<thead>
											<tr>
												<th>Matricule</th>
												<th>Nom</th>
												<th>Pr&eacute;nom</th>
												<th>Type de projet</th>
												<th>Date du projet</th>
												<th class="center">Actions</th>
											</tr>
										</thead>
										<tbody>
											{assign var=iIncrement value="0"}
											{if sizeof($oData.toProjet)>0}
											{foreach from=$oData.toProjet item=oProjet }
											<tr {if $iIncrement%2 == 0} class="even" {/if}>
												<td>{$oProjet.candidat_matricule}</td>
												<td>{$oProjet.candidat_nom}</td>
												<td>{$oProjet.candidat_prenom}</td>
												<td>{$oProjet.elaborationProjet_type}</td>
												<td>{$oProjet.elaborationProjet_date}</td>
												<td class="center">
													<a href="{$zBasePath}carriere/edit/gestion-des-carrieres/{$oProjet.zHashUrl}/verify/{$oProjet.elaborationProjet_id}"><i style="color:#53D00F;" class="la la-edit"></i></a>
													<a href="#" title="Supprimer" alt="Supprimer" dataSuppr="{$oProjet.elaborationProjet_id}" zhashurl={$oProjet.zHashUrl} class="action supprCarriere"><i style="color: #F10610;" class="la la-close"></i></a>
												</td>
											</tr>
											{assign var=iIncrement value=$iIncrement+1}
											{/foreach}
											{else}
											{if $oData.zMessage == ''}
											<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
											{else}
											<!--<tr><td style="text-align:center;color:red" colspan="7"><strong>{$oData.zMessage}</strong></td></tr>-->
											{/if}
											{/if}
										</tbody>
									</table>
									{$oData.zPagination}
								</div>
								<div id="calendar"></div>
								<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}carriere/liste/gestion-des-carrieres">
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Page Content -->
					
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


{literal}
<style>
.separateur.separateur1, h3 {
    border-bottom: none!important;
}
</style>
<script type="text/javascript">
		if($("#identification").val()=="cin")
   				$("#matricule").mask("999 999 999 999");
   			else
   				$("#matricule").mask("999999");

   		function changeMask(){
   			var type = $("#identification").val(); 
   			if(type=="cin")
   				$("#matricule").mask("999 999 999 999");
   			else
   				$("#matricule").mask("999999");   
   	   	}

		function rechercherProjet(){
			$("#formulaireSearch").submit();
		}

$(document).ready (function ()
		{
			
			$(".supprCarriere").click(function (){
				var iElement = $(this).attr("dataSuppr");
				var zHashUrl = $(this).attr("zhashurl");
				if (confirm ($("#zMessage").val()))
				{
					zAction = $("#formDelete").attr("action");
					$("#formDelete").removeAttr("action");
					$("#formDelete").attr("action", zAction + zHashUrl+ "/" + iElement);
					$("#formDelete").submit();
				}
			});

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
					url: "{/literal}{$zBasePath}{literal}carriere/candidat/",
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
		});
		
</script>
{/literal}
<form name="formDelete" id="formDelete" action="{$zBasePath}carriere/delete/gestion-des-carrieres/" method="GET">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
</form>
<style>
{literal}

.fa {
	font-size: 20px !important;
}

form .cell {
    width: 50%;
    float: left !important;
}
{/literal}
</style>
