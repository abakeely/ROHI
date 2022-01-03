<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>

		<form action="{$zBasePath}gestock/save/stock/mercuriale" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
		<input type="hidden" name="iFournitureId" id="iFournitureId" value="{$oData.iFournitureId}">
		<input type="hidden" name="iRow" id="iRow" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
		<input type="hidden" name="iIncrement" id="iIncrement" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
			<fieldset>
				<table>
					{if sizeof($oData.toGetMercuriale)==0}
					<div class="row clearfix">
						<div class="cell">
							<div class="field"> 
								<label>Type de fourniture : </label>
								<select id="iTypeFournitureId" name="iTypeFournitureId" class="obligatoire" style="width:250px">
								<option value="">S&eacute;l&eacute;ctionner le type de fourniture</option>
								{foreach from=$oData.toGetListeFourniture item=oGetListeFourniture}
								<option {if $oData.toGetFourniture.0.fourniture_typeId == $oGetListeFourniture.typeFourniture_id} selected="selected" {/if}  value="{$oGetListeFourniture.typeFourniture_id}">{$oGetListeFourniture.typeFourniture_libelle}</option>
								{/foreach}
								</select>
								<p class="message" style="width:500px">Veuillez s&eacute;l&eacute;ctionner le type de fourniture</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell">
							<div class="field"> 
								<label>Article : </label>
								<input style="width:80%" placeholder="Veuillez s&eacute;l&eacute;ctionner un article" value="{$oData.toGetFourniture.0.fourniture_article}" type="text" class="obligatoire" id="zArticle" name="zArticle">
								<p class="message" style="width:500px">Veuillez remplir l'intitulé de l'article</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell">
							<div class="field"> 
								<label>Spécification : </label>
								<textarea style="width:80%;height:100px"  id="zSpecification" name="zSpecification" placeholder="Veuillez s&eacute;l&eacute;ctionner un article" >{$oData.toGetFourniture.0.fourniture_specification}</textarea>
								<!-- input placeholder="Veuillez s&eacute;l&eacute;ctionner un article" type="text" value="{$oData.toGetFourniture.0.fourniture_specification}" id="zSpecification" name="zSpecification" -->
								<p class="message" style="width:500px">Veuillez remplir la spécification de l'article</p>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="cell" style="width:65%">
							<div class="field"> 
								<label>Unité : </label>
								<select id="iUniteId" name="iUniteId" style="width:100px" class="obligatoire">
								<option value="">S&eacute;l&eacute;ctionner l'unité</option>
								{foreach from=$oData.toGetUnite item=oGetUnite}
								<option {if $oData.toGetFourniture.0.fourniture_uniteId == $oGetUnite.typeUnite_id} selected="selected" {/if}  value="{$oGetUnite.typeUnite_id}">{$oGetUnite.typeUnite_libelle}</option>
								{/foreach}
								</select>
								<p class="message" style="width:500px">Veuillez séléctionner l'unité</p>
							</div>
						</div>
					</div>
					{/if}
					<div class=" clearfix" id="decisionCorrespondant" style="display:block;">
					<div class="cell">
						<div class="field">
							{*
							<span style="color:blue;font-size:16px;" >Les prix mercuriale: <a href="#" onclick="addMoreRows(this.form);" ><i style="color:#0089DC;font-size:22px" class="la la-plus-square"></i></a></span>
							*}
							<table style="width:100%">
								<thead>
									<tr>
										<th>Date</th>
										<th>Prix</th>
										<!--<th>Action</th>-->
									</tr>
								</thead>
								<tbody id="addedRows">
									{assign var=iIncrement value="1"}
									{if sizeof($oData.toGetMercuriale)>0}
									
									{foreach from=$oData.toGetMercuriale item=oListe }
									<tr id="rowCount{$iIncrement}" class="even">
										<input type="hidden" name="iModif_{$iIncrement}" readonly="readonly" id="iModif_{$iIncrement}" value="{$oListe.mercuriale_id}">
										<td>&nbsp;&nbsp;<input style="width:150px" type="text" id="date_{$iIncrement}" name="date_{$iIncrement}" value="{$oListe.mercuriale_date|date_format:"%d/%m/%Y"}" readonly="readonly" class="obligatoire">&nbsp;&nbsp;
										<br><p class="message" style="width:200px">Veuillez remplir la date</p>
										</td>
										<td><input style="width:150px" type="text" readonly="readonly" value="{$oListe.mercuriale_prix}" id="zPrix_{$iIncrement}"  name="zPrix_{$iIncrement}" >&nbsp;&nbsp;Ar
										<br><p class="message" style="width:200px">Veuillez remplir le prix</p>
										</td>
										<!--<td style="text-align:center">&nbsp;</td>-->
									</tr>
									{assign var=iIncrement value=$iIncrement+1}
									{/foreach}
									{/if}
									<tr id="rowCount{$iIncrement}" class="even">
										<td>&nbsp;&nbsp;<input style="width:150px" type="text" value="{$oData.zDate}" readonly="readonly" id="date_{$iIncrement}" name="date_{$iIncrement}">&nbsp;&nbsp;
										<br><p class="message" style="width:200px">Veuillez remplir la date</p>
										</td>
										<td><input style="width:150px" type="text" value="" id="zPrix_{$iIncrement}" name="zPrix_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;Ar
										<br><p class="message" style="width:200px">Veuillez remplir le prix</p>
										</td>
										<!--<td style="text-align:center">&nbsp;</td>-->
									</tr>
									
								</tbody>
							</table>
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


var iRowCount = $("#iIncrement").val();
var ichecked = '';
function addMoreRows(frm) {
	$(document).ready (function ()
	{
		
		iRowCount ++;
		jQuery('#iRow').val(iRowCount);
		if (iRowCount==1){
			ichecked='checked="checked"';
		} else {
			ichecked='';
		}
		var recRow = '<tr id="rowCount'+iRowCount+'" class="even"><td>&nbsp;&nbsp;<input style="width:150px" type="text" value="" name="date_'+iRowCount+'" class="withDatePicker obligatoire" >&nbsp;&nbsp;<br><p class="message" style="width:200px">Veuillez remplir la date</p></td><td><input style="width:150px" type="text" value="" name="zPrix_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;Ar<br><p class="message" style="width:200px">Veuillez remplir le prix</p></td><!--<td style="text-align:center"><a href="#" onclick="removeRow('+iRowCount+');" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></td>--></tr>';
		jQuery('#addedRows').append(recRow);
		$.getScript( "{/literal}{$zBasePath}{literal}assets/common/js/app/main.js");
	})
}

function removeRow(removeNum) {
jQuery('#rowCount'+removeNum).remove();
}
</script>
{/literal}