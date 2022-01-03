{assign var=iIncrement value=$iType+1}
{if sizeof($toService)>0}
<div>
	<div class="">
			<div class="field" style="font-size:14px;color:green;">
				<label>&nbsp;</label>
				Service :&nbsp; <input class="interchangeable" id="iRattache" name="iRattache" checked="checked" value="1" type="radio">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Direction :&nbsp; <input class="interchangeable" id="iRattache" name="iRattache" value="0" type="radio">
				<p>&nbsp;</p>
			</div>
	</div>
</div>
<div id="serviceRattache">
	<div class="field">
		<label>Service</label>
			<select class="form-control sur" placeholder="Service" name="service" onChange="getLocaliteAffiche('{$zBasePath}',3,this.value);" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="iServiceId11">
			<option value="0">s&eacute;l&eacute;ctionner un service</option>
			{foreach from=$toService item=$oService }
				<option value="{$oService.id}">{$oService.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
<div id="directionRattache" style="display:none">
	<div class="field">
		<label>{$zName|upper}</label>
		<select class="form-control notSur" placeholder="{$zName|upper}" name="{$zName}" onChange="getLocaliteAffiche('{$zBasePath}',{$iIncrement},this.value);" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="{$iIdName}">
			{if $iType==0}
			<option value="0">s&eacute;l&eacute;ctionner un departement</option>
			{/if}
			{if $iType==1}
			<option value="0">s&eacute;l&eacute;ctionner une direction</option>
			{/if}
			{if $iType==2}
			<option value="0">s&eacute;l&eacute;ctionner un service</option>
			{/if}
			{if $iType==3}
			<option value="0">s&eacute;l&eacute;ctionner une division</option>
			{/if}
			{foreach from=$toListe item=oListe }
				<option value="{$oListe.id}">{$oListe.libele}</option>
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
	$("#iLocalite_2").hide();
	$('.interchangeable').click(function(){
		
		var iValue = $(this).val();  

		switch (iValue) {
			case '1':
				$("#serviceRattache").show();
				$("#directionRattache").hide();
				$("#iLocalite_2").hide();
				$(".notSur").val(0);
				break;

			case '0':
				$("#directionRattache").show();
				$("#serviceRattache").hide();
				$("#iLocalite_2").show();
				$(".sur").val(0);
				break;
		}

		
	});  
})
</script>
{else}
<div>
	<div class="field">
		<label>{$zName|upper}</label>
		<select class="form-control" class="surSurDir" placeholder="{$zName|upper}" name="{$zName}" onChange="getLocaliteAffiche('{$zBasePath}',{$iIncrement},this.value);" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="{$iIdName}">
			{if $iType==0}
			<option value="0">s&eacute;l&eacute;ctionner un departement</option>
			{/if}
			{if $iType==1}
			<option value="0">s&eacute;l&eacute;ctionner une direction</option>
			{/if}
			{if $iType==2}
			<option value="0">s&eacute;l&eacute;ctionner un service</option>
			{/if}
			{if $iType==3}
			<option value="0">s&eacute;l&eacute;ctionner une division</option>
			{/if}
			{foreach from=$toListe item=oListe }
				<option value="{$oListe.id}">{$oListe.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
{/if}
