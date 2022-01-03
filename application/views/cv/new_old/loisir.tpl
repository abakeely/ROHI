 <div class="panel-body">
	<h3>Loisirs et Activit&eacute;s annexes</h3>

	<div class="libele_form">  
		<label class="control-label" data-original-title="" title=""><b>Loisirs</b><b><font color="red"> * </font></b></label>
	</div> 
	<div class="form-group">
		<table class="tableau" id="table_loisirs">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->loisirs_list item=oLoisir}
				<tr id="row_loisirs_{$iIncrement}">
					<td style="padding:2px;width:90%"><input type="text" class="form-control" placeholder="Loisirs" style="border: 1px solid #626D71 !important;" name="loisirs[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny fialamboly nareo"  value="{$oLoisir.libele}"></td>
					{if $iIncrement!=0}
					<td><button class="form-control btn_close" type="button" onclick="deleteLoisirs({$iIncrement})"><i class="la la-minus-circle"></i></button></td>   
					{/if}
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>	
	<div class="buttonForm">
		<button type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy stage" id="ajoutLoisirs"> Ajouter Loisirs</button>
	</div>
	
	<div class="libele_form">  
		<label class="control-label" data-original-title="" title=""><b>Activité Annexe</b><b><font color="red"> * </font></b></label>
	</div> 
	<div class="form-group">
		<table class="tableau" id="table_loisirsannexe">
			<tbody>
				{assign var=iIncrement value="0"}
				{foreach from=$oCandidatCv->loisirsannexe_list item=oLoisir}
				<tr id="row_loisirsannexe_{$iIncrement}">
							<td style="padding:2px;width:90%"><input type="text" class="form-control" placeholder="Activité Annexe" style="border: 1px solid #626D71 !important;" name="loisirsannexe[]" data-placement="top" data-toggle="tooltip" data-original-title="Soraty ny fialamboly nareo"  value="{$oLoisir.libele}"></td>
					{if $iIncrement!=0}
					<td><button class="form-control btn_close" type="button" onclick="deleteLoisirsannexe({$iIncrement})"><i class="la la-minus-circle"></i></button></td>   
					{/if}
				</tr>
				{assign var=iIncrement value=$iIncrement+1}
				{/foreach}
			</tbody>
		</table>
	</div>
	<div class="buttonForm">
		<button type="button" class="form-control" data-toggle="tooltip" data-original-title="Tsindrio ra hanampy stage" id="ajoutLoisirsannexe"> Ajouter Activité Annexe</button>
	</div>
</div>