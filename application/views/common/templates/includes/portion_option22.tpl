{assign var=iIncrement value=$iType+1}
{if sizeof($toService)>0}
<div>
	<div class="">
			<div class="field" style="font-size:14px;color:green;">
				<label>&nbsp;</label>
				Service :&nbsp; <input class="interchangeable" id="iRattache" name="iRattache" {if $iSelected==1}checked="checked"{/if} value="1" type="radio">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Direction :&nbsp; <input class="interchangeable" id="iRattache" name="iRattache" {if $iSelected==0}checked="checked"{/if} value="0" type="radio">
				<p>&nbsp;</p>
			</div>
	</div>
</div>
<div id="serviceRattache" {if $iSelected==1}style="display:block"{else}style="display:none"{/if}>
	<div class="field">
		<label>Service</label>
			<select class="form-control sur" placeholder="Service" name="service" onChange="getLocaliteAffiche('{$zBasePath}',3,this.value);" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="iServiceId11">
			<option value="0">s&eacute;l&eacute;ctionner un service</option>
			{foreach from=$toService item=$oService }
				<option {if $iServiceSelected==$oService.id}selected="selected"{/if} value="{$oService.id}">{$oService.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
<div id="directionRattache" {if $iSelected==0}style="display:block"{else}style="display:none"{/if}>
	<div class="field">
		<label>Direction</label>
		<select class="form-control notSur" placeholder="{$zName|upper}" name="{$zName}" onChange="getLocaliteAffiche('{$zBasePath}',2,this.value);" data-toggle="tooltip" data-original-title= "Safidio ny Foibem-pitondrana misy anao " id="{$iIdName}">
			<option value="0">s&eacute;l&eacute;ctionner une direction</option>
			{foreach from=$toListe item=oListe }
				<option {if $iDirectionSelected==$oListe.id}selected="selected"{/if} value="{$oListe.id}">{$oListe.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
{$zSelectDirectionS}
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
	if($(".katsaka").val()==0){
		$("#iLocalite_2").hide();
	}
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
{/if}