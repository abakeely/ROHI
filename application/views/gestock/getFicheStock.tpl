<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>

<form action="{$zBasePath}gestock/save/stock/entree" method="POST" name="formulaireEdit" id="formulaireEdit" enctype="multipart/form-data">
<input type="hidden" name="iFournitureId" id="iFournitureId" value="{$oData.iFournitureId}">
<input type="hidden" name="iRow" id="iRow" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
<input type="hidden" name="iIncrement" id="iIncrement" value="{if $oData.iNombre>0}{$oData.iNombre}{else}1{/if}">
	<fieldset>
		<table>
			<div class=" clearfix">
			<div class="cell">
				<div class="field">
					<span style="color:blue;font-size:16px;" >Les entrées en stock: <a href="#" onclick="addMoreRows(this.form);" ><i style="color:#0089DC;font-size:22px" class="la la-plus-square"></i></a></span>
					<table style="width:90%">
						<thead>
							<tr>
								<th>Date</th>
								<th>Quantité</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="addedRows">
							{if sizeof($oData.toGetEnteeStock)>0}
							{assign var=iIncrement value="1"}
							{foreach from=$oData.toGetEnteeStock item=oListe }
							<tr id="rowCount{$iIncrement}" class="even">
								<input type="hidden" name="iModif_{$iIncrement}" id="iModif_{$iIncrement}" value="{$oListe.stock_id}">
								<td>&nbsp;&nbsp;<input style="width:150px" type="text" id="date_{$iIncrement}" name="date_{$iIncrement}" value="{$oListe.stock_date|date_format:"%d/%m/%Y"}" readonly="readonly" class="obligatoire">&nbsp;&nbsp;
								<br><p class="message" style="width:200px">Veuillez remplir la date</p>
								</td>
								<td><input style="width:150px" type="text" value="{$oListe.stock_quantite}" readonly="readonly" id="iQuantite_{$iIncrement}"  name="iQuantite_{$iIncrement}" class="obligatoire">&nbsp;&nbsp;
								<br><p class="message" style="width:200px">Veuillez remplir la quantité</p>
								</td>
								<td style="text-align:center">&nbsp;{*{if $iIncrement>1}<a href="#" onclick="removeRow('{$iIncrement}');" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a>{/if}*}</td>
							</tr>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
							{else}
							<tr id="rowCount1" class="even">
								<td>&nbsp;&nbsp;<input style="width:150px" type="text" value="" id="date_1" name="date_1" readonly="readonly" value="{$oData.zDate}" class="obligatoire">&nbsp;&nbsp;
								<br><p class="message" style="width:200px">Veuillez remplir la date</p>
								</td>
								<td><input style="width:150px" type="text" value="" id="iQuantite_1" name="iQuantite_1" class="obligatoire">&nbsp;&nbsp;
								<br><p class="message" style="width:200px">Veuillez remplir la quantité</p>
								</td>
								<td style="text-align:center">&nbsp;</td>
							</tr>
							{/if}
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
var zDate = '{/literal}{$oData.zDate}{literal}';
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
		var recRow = '<tr id="rowCount'+iRowCount+'" class="even"><td>&nbsp;&nbsp;<input style="width:150px" readonly="readonly" type="text" value="'+zDate+'" name="date_'+iRowCount+'" class="obligatoire" >&nbsp;&nbsp;<br><p class="message" style="width:200px">Veuillez remplir la date</p></td><td><input style="width:150px" type="text" value="" name="iQuantite_'+iRowCount+'" class="obligatoire">&nbsp;&nbsp;<br><p class="message" style="width:200px">Veuillez remplir la quantité</p></td><td style="text-align:center"><a href="#" onclick="removeRow('+iRowCount+');" ><i style="color: #F10610;font-size:22px" class="la la-close"></i></a></td></tr>';
		jQuery('#addedRows').append(recRow);
		$.getScript( "{/literal}{$zBasePath}{literal}assets/common/js/app/main.js");
	})
}

function removeRow(removeNum) {
jQuery('#rowCount'+removeNum).remove();
}
</script>
{/literal}