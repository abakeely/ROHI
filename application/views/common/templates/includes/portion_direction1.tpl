{if sizeof($toDirection)>0}
<div id="portionDirection">
<div>
	<div class="">
			<div class="field" style="font-size:14px;color:green;">
				<label>&nbsp;</label>
				Service :&nbsp; <input class="interchangeableDir" id="iRattacheDir" name="iRattacheDir" {if $iActif==0}checked="checked"{/if}  value="1" type="radio">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Direction :&nbsp; <input class="interchangeableDir" id="iRattacheDir" name="iRattacheDir" {if $iActif==1}checked="checked"{/if} value="0" type="radio">
				<p>&nbsp;</p>
			</div>
	</div>
</div>
<div id="serviceRattacheDir" {if $iActif==0}style="display:block"{else}style="display:none"{/if} >
	<div class="field">
		<label>Service</label>
			<select class="form-control surDir" placeholder="Service" name="service" onChange="getLocaliteAffiche('{$zBasePath}',3,this.value);" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="iServiceId11">
			<option value="0">s&eacute;l&eacute;ctionner un service</option>
			{foreach from=$toListe item=oListe }
				<option {if $iDirectionSelected==$oDirection.id}selected="selected"{/if} value="{$oListe.id}">{$oListe.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
<div id="directionRattacheDir" {if $iActif==1}style="display:block"{else}style="display:none"{/if}>
	<div class="field">
		<label>Coordonation</label>
		<select class="form-control notSurDir" placeholder="Direction" name="direction" onChange="getLocaliteAffiche('{$zBasePath}',23,this.value);" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="iDirectionId1">
			<option value="0">s&eacute;l&eacute;ctionner une direction</option>
			{foreach from=$toDirection item=$oDirection }
				<option {if $iDirectionSelected==$oDirection.id}selected="selected"{/if} value="{$oDirection.id}">{$oDirection.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
<style>
input[type=radio] {
    height: 17px;
    width: 17px;
    vertical-align: middle;
	margin-bottom: 4px;
}
</style>
<script>
$(document).ready (function ()
{
	$('.interchangeableDir').click(function(){
		
		var iValue = $(this).val();  

		switch (iValue) {
			case '1':
				$("#serviceRattacheDir").show();
				$("#directionRattacheDir").hide();
				$("#iLocalite_2").hide();
				$(".surSurDir").val(0);
				$(".sur").val(0);
				$("#iServiceId").val(0);
				break;

			case '0':
				$("#directionRattacheDir").show();
				$("#serviceRattacheDir").hide();
				$("#iLocalite_2").show();
				$(".surDir").val(0);
				$(".sur").val(0);
				$("#iServiceId").val(0);
				
				break;
		}

		
	});  
})
</script>
</div>

{/if}