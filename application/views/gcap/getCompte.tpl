{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Gestion compte</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Compte</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="SSttlPage">
									<div id="searchAcc">
										<div class="card punch-status">
											<h2>Assignation de compte pour un Agent</h2>
										<form action="{$zBasePath}gcap/search_AgentCompte?sdsds" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block;">
										<input type="hidden" name="idSelect" id="idSelect" value="">
											<input type="hidden" name="textSelect" id="textSelect" value="">
												<fieldset>
													<div class="row1">
														<div class="cell">
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
														<div class="cell">
															<div class="field">
																<label>Matricule ou CIN</label>
																<input style="width:150px!important" class="form-control" placeholder="matricule ou CIN" name="im" id="num"/>
															</div>
														</div>
													</div>
													<div class="row1" id="searchCandidat">
														<div class="cell">
															<div class="field">
																	<label>&nbsp;</label>
																	<input style="width:300px!important" placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidat" name="zCandidat">
															</div>
														</div>
													</div>
													<div class="cell">
														<div class="field">
															<button>Rechercher</button>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
										
									</div>
								</div>
								<!---->
								<div class="clear"></div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/deleteCompte" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer le compte de cet utilisateur ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/compte">
								</form>
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
.matricule {
    padding: 10px 0;
}

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
	
	$("#zCandidat").select2
	({
		allowClear: true,
		placeholder:"Sélectionnez",
		minimumInputLength: 3,
		formatNoMatches: function () { return "Aucun résultat trouvé"; },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " caractères"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return "Chargement des résultats ..."; },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:0};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;
})

</script>
{/literal}