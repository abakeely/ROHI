{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
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
									<li class="breadcrumb-item">Localité de service</li>
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
											<h2>Modification localité de service (Département / direction / service)</h2>
										<form action="{$zBasePath}gcap/search_matricule" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block;">
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
																	<input style="width:300px!important" placeholder="Veuillez entrer le nom de l'agent" type="text" id="zCandidatSearch" name="zCandidatSearch">
															</div>
														</div>
													</div>
													<div class="cell">
														<div class="field">
															<button onclick="setListeEvaluation()" class="form-control">Afficher</button>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
									
									</div>
								</div>

								{if $oData.msg != ''}
									<p>&nbsp;</p>
									<p style="color:red;text-align:center;font-size:20px;">{$oData.msg}</p>
								{/if}
								<div id="calendar"></div>
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
		});
</script>
{/literal}