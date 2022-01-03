{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									{if $oData.iPvId>0}
										Modification
									{/if}
									PV d'inventiaire physique en date du {if $oData.iPvId>0}{$oData.oPv.pv_date|date_format:"%d/%m/%Y"}{else}{$oDate.zDate|date_format:"%d/%m/%Y"}{/if}

								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des stocks</a></li>
									<li class="breadcrumb-item">{$oData.zLibelle}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{if $oData.iPvId>0}
									<div class="SSttlPage">
										<div class="cell">
											<div class="field text-center">
												<form action="#" target="_self" method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
													<fieldset>
														<div class="row1 clearfix">
															<div class="cell" style="text-align:left;">
																<div class="field">
																	<label>&nbsp;</label>
																	
																	<a href="{$zBasePath}gestock/imprimer/stock/pv-edit-output?iPvId={$oData.iPvId}" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Exporter</a>
																	<a href="{$zBasePath}gestock/imprimer/stock/pv-edit?iPvId={$oData.iPvId}" target="_blank" style="text-decoration:none" class="btn button imprimer"><i class="la la-print"></i>&nbsp;&nbsp;Imprimer</a>
																	
																</div>
															</div>
														</div>
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								{/if}

								<div class="col-xs-12">
									<form action="{$zBasePath}gestock/save/stock/inventaire" method="POST" name="formulaireEdit" id="formulaireEdit" style="overflow:hidden" enctype="multipart/form-data">
										<input type="hidden" name="iRow" id="iRow" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
										<input type="hidden" name="iPvId" id="iPvId" value="{$oData.iPvId}">
										<input type="hidden" name="iIncrement" id="iIncrement" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
										<input type="hidden" name="iTypeFournitureIdSelected" id="iTypeFournitureIdSelected" value="{if $oData.iPvId>0}{$oData.oPv.pv_typeFournitureId}{else}0{/if}">
										<table>
											<tr>
												<td>
													<div class="row1 clearfix">
														<div class="cell1">
															<div class="field"> 
																<label>Type de fourniture : </label>
																<select id="iTypeFournitureId" {if $oData.iPvId>0}disabled="disabled"{/if} name="iTypeFournitureId" style="width:250px">
																{foreach from=$oData.toGetListeFourniture item=oGetListeFourniture}
																<option {if $oData.oPv.pv_typeFournitureId == $oGetListeFourniture.typeFourniture_id} selected="selected" {/if}  value="{$oGetListeFourniture.typeFourniture_id}">{$oGetListeFourniture.typeFourniture_libelle}</option>
																{/foreach}
																</select>
																<input type="button" class="button validerPv"  value="Valider">
																<input type="button" class="button dialog-add-mercuriale" onclick="addMoreRows(this.form);" value="Ajouter une ligne">
															</div>
														</div>
													</div>
												</td>
											</tr>
										</table>

										<table>
											<thead>
												<tr>
													<th>Article</th>
													<th>Stock actuel</th>
													<th>Stock physique</th>
													<th>Rebut</th>
													<th>Stock réel</th>
													<th>Observation</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="addedRows">
												{if sizeof($oData.toGetListeArticlePv)>0}
												{assign var=iIncrement value="1"}
												{foreach from=$oData.toGetListeArticlePv item=oListe }
													<tr id="rowCount{$iIncrement}" class="even">
														<input type="hidden" name="iModif_{$iIncrement}" id="iModif_{$iIncrement}" value="{$oListe.pvArticle_id}">
														<input type="hidden" name="iModifRebus_{$iIncrement}" id="iModifRebus_{$iIncrement}" value="{$oListe.rebut_id}">
														<input type="hidden" name="iArticleSelected_{$iIncrement}" id="iArticleSelected_{$iIncrement}" value="{$oListe.fourniture_id}">
														<input type="hidden" name="zArticleSelected_{$iIncrement}" id="zArticleSelected_{$iIncrement}" value="{$oListe.fourniture_article}">
														<td><input style="width:250px" type="text" id="iArticleId_{$iIncrement}" name="iArticleId_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;
														<br><p class="message" style="width:200px">Veuillez séléctionner l'article</p>
														</td>
														<td><input style="width:50px" type="text" readonly="readonly" value="{$oListe.pvArticle_stockInitiale}" id="iStockInital_{$iIncrement}" name="iStockInital_{$iIncrement}">&nbsp;&nbsp;
														</td>
														<td><input style="width:50px" type="text" value="{$oListe.pvArticle_StockPhysique}" id="iStockPhysique_{$iIncrement}" name="iStockPhysique_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;
														</td>
														<td><input style="width:50px" type="text" readonly="readonly"  value="{$oListe.pvArticle_rebut}" id="iRebus_{$iIncrement}" name="iRebus_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;
														</td>
														<td><input style="width:50px" type="text" readonly="readonly" value="{$oListe.pvArticle_stockFinale}" id="iStockFinal_{$iIncrement}" name="iStockFinal_{$iIncrement}">&nbsp;&nbsp;
														</td>
														<td><input style="width:250px" type="text" value="{$oListe.pvArticle_observation}" id="Observation_{$iIncrement}" name="Observation_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;
														</td>
														<td style="text-align:center">{if $iIncrement>1}<a href="#" onclick="removeRow('{$iIncrement}');" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>{/if}</td>
													</tr>
												{assign var=iIncrement value=$iIncrement+1}
												{/foreach}
												{else}
													<tr id="rowCount1" class="even">
														<td><input style="width:250px" type="text" value="" id="iArticleId_1" name="iArticleId_1" class="obligatoire">&nbsp;&nbsp;
														<br><p class="message" style="width:200px">Veuillez séléctionner l'article</p>
														</td>
														<td><input style="width:50px" type="text" readonly="readonly" value="" id="iStockInital_1" name="iStockInital_1">&nbsp;&nbsp;
														</td>
														<td><input style="width:50px" type="text" readonly="readonly" value="" id="iStockPhysique_1" name="iStockPhysique_1" class="obligatoire">&nbsp;&nbsp;
														</td>
														<td><input style="width:50px" type="text" readonly="readonly"  value="" id="iRebus_1" name="iRebus_1" class="obligatoire">&nbsp;&nbsp;
														</td>
														<td><input style="width:50px" type="text" readonly="readonly" value="" id="iStockFinal_1" name="iStockFinal_1">&nbsp;&nbsp;
														</td>
														<td><input style="width:250px" type="text" value="" id="Observation_1" name="Observation_1" class="obligatoire">&nbsp;&nbsp;
														</td>
														<td style="text-align:center">&nbsp;</td>
													</tr>
												{/if}
											</tbody>
										</table>
									</form>
									</table>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogEntreeStock" title="Dialog Title"></div>
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
td.left {width:20%}
th, td {
    width: 0px!important;
}
</style>
<script type="text/javascript">
function getArticle(_iRowCount){
	$(document).ready (function ()
	{
		$("#iArticleId_" + _iRowCount).select2
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
				return {q: term, iTypeFournitureId:$("#iTypeFournitureIdSelected").val()};
			},
			results: function (data)
			{
				return {results: data};
			}
			}
		})

		$("#iArticleId_" + _iRowCount).on("change", function(e) { 
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}gestock/getAjax/stock/nouveau-pv",
				type: 'post',
				data: {
					iFournitureId:$(this).val(),
				},
				success: function(data, textStatus, jqXHR) {
					var oReturn = jQuery.parseJSON(data);
					$("#iStockInital_"+_iRowCount).val(oReturn.iQuantiteDisponible);
				},
				async: false
			})

			$("#iTypeFournitureIdSelected").val($("#iTypeFournitureId").val());
			$("#iTypeFournitureId").attr("disabled","disabled");
			$("#iStockPhysique_" + _iRowCount).removeAttr("readonly");
			
			
		}).on("open", function() { 
			console.log("open"); 
		});

		$("#iStockPhysique_" + _iRowCount).on("keyup", function(e) { 
			
			var iSotckPhysiqueTest = is_int($(this).val());
			var iSotckPhysique = $(this).val();
			var iSotckInital = $("#iStockInital_" + _iRowCount).val();

			if (iSotckPhysique!=''){
				if (iSotckPhysiqueTest == true){
					if (iSotckPhysique > eval(iSotckInital)){
						$("#iRebus_" + _iRowCount).val('');
						$("#iStockFinal_" + _iRowCount).val('');
						alert("Le stock physique ne doit pas être supérieur au sotck inital");
					} else {
						$("#iRebus_" + _iRowCount).val(iSotckInital-iSotckPhysique);
						$("#iStockFinal_" + _iRowCount).val(iSotckPhysique);
					}
				} else {
					alert("Le stock physique entrée n'est pas un nombre entier");
				}
			} else {
				$("#iRebus_" + _iRowCount).val('');
				$("#iStockFinal_" + _iRowCount).val('');
			}
		})
	})
}
var iRowCount = $("#iIncrement").val();
getArticle(1);

function is_int(value){
  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
      return true;
  } else {
      return false;
  }
}
function addMoreRows(frm) {
	$(document).ready (function ()
	{
		iRowCount++;
		$('#iRow').val(iRowCount);
		var recRow = '<tr id="rowCount'+iRowCount+'" class="even"><td><input style="width:250px" type="text" value="" id="iArticleId_'+iRowCount+'" name="iArticleId_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;<br><p class="message" style="width:200px">Veuillez séléctionner l\'article</p></td><td><input style="width:50px" type="text" readonly="readonly" value="" id="iStockInital_'+iRowCount+'" name="iStockInital_'+iRowCount+'">&nbsp;&nbsp;</td><td><input style="width:50px" type="text" readonly="readonly" value="" id="iStockPhysique_'+iRowCount+'" name="iStockPhysique_'+iRowCount+'" readonly="readonly" class="obligatoire">&nbsp;&nbsp;</td><td><input style="width:50px" type="text"  value="" id="iRebus_'+iRowCount+'" name="iRebus_'+iRowCount+'" readonly="readonly" class="obligatoire">&nbsp;&nbsp;</td><td><input style="width:50px" type="text" readonly="readonly" value="" id="iStockFinal_'+iRowCount+'" name="iStockFinal_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;</td><td><input style="width:250px" type="text" value="" id="Observation_'+iRowCount+'" name="Observation_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;</td><td style="text-align:center"><a href="#" onclick="removeRow('+iRowCount+');" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></td></tr>';
		getArticle(iRowCount);
		$('#addedRows').append(recRow);
		$.getScript( "{/literal}{$zBasePath}{literal}assets/common/js/app/main.js");	
	})
}

function removeRow(removeNum) {
$('#rowCount'+removeNum).remove();
}

function getSelectArticle(_iRowCount){
	$(document).ready (function ()
	{
		zData = [{id:$("#iArticleSelected_"+_iRowCount).val(),text:$("#zArticleSelected_"+_iRowCount).val()}];

		$("#iArticleId_" + _iRowCount).select2
		({
			
			initSelection: function (element, callback)
			{
				$(zData).each(function()
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
			url: "{/literal}{$zBasePath}{literal}gestock/getFourniture/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iTypeFournitureId:$("#iTypeFournitureIdSelected").val()};
			},
			results: function (data)
			{
				return {results: data};
			}
			}
		})

		$("#iArticleId_" + _iRowCount).select2('val',$("#iArticleSelected_"+_iRowCount).val());

		$("#iArticleId_" + _iRowCount).on("change", function(e) { 
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}gestock/getAjax/stock/nouveau-pv",
				type: 'post',
				data: {
					iFournitureId:$(this).val(),
				},
				success: function(data, textStatus, jqXHR) {
					var oReturn = jQuery.parseJSON(data);
					$("#iStockInital_"+_iRowCount).val(oReturn.iQuantiteDisponible);
				},
				async: false
			})

			$("#iTypeFournitureIdSelected").val($("#iTypeFournitureId").val());
			$("#iTypeFournitureId").attr("disabled","disabled");
			$("#iStockPhysique_" + _iRowCount).removeAttr("readonly");
			
			
		}).on("open", function() { 
			console.log("open"); 
		});

		$("#iStockPhysique_" + _iRowCount).on("keyup", function(e) { 
			
			var iSotckPhysiqueTest = is_int($(this).val());
			var iSotckPhysique = $(this).val();
			var iSotckInital = $("#iStockInital_" + _iRowCount).val();

			if (iSotckPhysique!=''){
				if (iSotckPhysiqueTest == true){
					if (iSotckPhysique > eval(iSotckInital)){
						$("#iRebus_" + _iRowCount).val('');
						$("#iStockFinal_" + _iRowCount).val('');
						alert("Le stock physique ne doit pas être supérieur au sotck inital");
					} else {
						$("#iRebus_" + _iRowCount).val(iSotckInital-iSotckPhysique);
						$("#iStockFinal_" + _iRowCount).val(iSotckPhysique);
					}
				} else {
					alert("Le stock physique entrée n'est pas un nombre entier");
				}
			} else {
				$("#iRebus_" + _iRowCount).val('');
				$("#iStockFinal_" + _iRowCount).val('');
			}
		})

	})
} 

$(document).ready (function (){
	$("#iTypeFournitureIdSelected").val($("#iTypeFournitureId").val());
	$("#iTypeFournitureId").on("change", function(e) { 
		$("#iTypeFournitureIdSelected").val($(this).val());
	})
	$(".validerPv").click(function(event) {
		
		iRet = 1 ;
		$(".obligatoire").each (function ()
		{
			$(this).parent().removeClass("error");
			if($(this).val()=="" && $(this).attr("Name") != undefined)
			{
				$(this).parent().addClass("error");
				 iRet = 0 ;
			}
		}) ;
		
		if (iRet == 1){
			if (confirm("Êtes-vous sûr de valider ce PV?")){
				$("#formulaireEdit").submit();
			}
		}
	});
})

{/literal}
		{if sizeof($oData.toGetListeArticlePv)>0}
		{assign var=iIncrement value="1"}
		{foreach from=$oData.toGetListeArticlePv item=oListe }
				{literal}getSelectArticle({/literal}{$iIncrement}{literal}){/literal}
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
		{/if}
	{literal}
</script>
{/literal}